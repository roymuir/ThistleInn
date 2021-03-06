<?php
/**
 * ClickTale - PHP Integration Module
 *
 * LICENSE
 *
 * This source file is subject to the ClickTale(R) Integration Module License that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.clicktale.com/Integration/0.2/LICENSE.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@clicktale.com so we can send you a copy immediately.
 *
 */
?>
<?php
/**
 * ClickTale - PHP Integration Module
 *
 * LICENSE
 *
 * This source file is subject to the ClickTale(R) Integration Module License that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.clicktale.com/Integration/0.2/LICENSE.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@clicktale.com so we can send you a copy immediately.
 *
 */
?>
<?php

/*
 * This page retrieves the cached page from cache using the provided token
 */

header("X-Robots-Tag: noindex, nofollow", true);
if (!defined('ClickTale_Root'))
{
	$pathinfo = pathinfo(__FILE__);
	define ("ClickTale_Root", $pathinfo["dirname"]);
}

require_once(ClickTale_Root."/ClickTale.inc.php");
require_once(ClickTale_Root."/ClickTale.CacheFactory.php");
require_once(ClickTale_Root."/ClickTale.Settings.php");
require_once(ClickTale_Root."/ClickTale.Logger.php");

$allowedAccessList = explode(',',ClickTale_Settings::Instance()->AllowedAddresses);
$ipsMasks = array();
$hostNames = array();
$wildCards = array();

foreach($allowedAccessList as $calItem)
{
	if (preg_match('/[^A-Za-z.-]/', $calItem)) {
		if(strpos($calItem,'*') !== false){
			array_push($wildCards,$calItem);
		}
		else{
			array_push($ipsMasks,$calItem);}
	}
	else
		array_push($hostNames,$calItem);


}





// get and validate token
@$token = $_GET["t"];
if (preg_match('/[^A-Za-z0-9]/', $token))
{
	$message = "Invalid token value.";
	ClickTale_Logger::Write($message);
	header("HTTP/1.0 403 ".$message);
	header("X-ClickTale-Fetcher:no-store");
	die ($message);
}

// get part of token to use for debug and log
@$tok = substr($token, strlen($token) - 4);


// New ip filter
if(!ClickTale_IsAllowedIp($ipsMasks))
{
	if(!ClickTale_IsAllowedHostname($hostNames))
	{
		if(!ClickTale_IsAllowedWildcard($wildCards))
		{
				if(ClickTale_Settings::Instance()->FetcherUnauthorizedURL != "")
				{
					header( 'Location: '.ClickTale_Settings::Instance()->FetcherUnauthorizedURL ) ;
					die;
				}
				else
				{
					$message = "Request from unauthorized ip: ".$_SERVER["REMOTE_ADDR"].", user agent: ".$_SERVER["HTTP_USER_AGENT"].".";
					ClickTale_Logger::Write($message);
					header("HTTP/1.0 403 ".$message);
					header("X-ClickTale-Fetcher:no-store");
					die ("Request from unauthorized source.");
				}
		}
	}
}
  
try
{
	$cacheProvider = ClickTale_CacheFactory::DefaultCacheProvider();
}
catch (Exception $ex)
{
	ClickTale_Logger::Write($ex->getMessage());
	header("X-ClickTale-Fetcher:no-store");
	header("HTTP/1.0 500 ".$ex->getMessage());
	die($ex->getMessage());
}

$config = ClickTale_Settings::Instance()->getCacheProviderConfig();

if (!$cacheProvider->exists($token, $config))
{
	$message = "Request to '$tok' could not be retrieved";
	ClickTale_Logger::Write($message);
	header("X-ClickTale-Fetcher:no-store");
	header("HTTP/1.0 404 "."Could not retrieve the cached page.");
	die ("Could not retrieve the cached page.");
}
$settings = ClickTale_Settings::Instance();
if(!empty($settings->LogFetching)) {
	ClickTale_Logger::Write("Cache for '$tok' was retrieved");
}

$contents = ($cacheProvider->Pull($token, $config));


$cacheProvider->refresh($token, $config);

 
print $contents;
?>
