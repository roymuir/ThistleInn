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

$config = array();

// Url pattern for getting a cached page
// use %CacheToken% as a placeholder for the token
// use %ClickTaleCacheUrl% can be used as the url to ClickTaleCache.php
$config['CacheFetchingUrl'] = "http://%ClickTaleCacheUrl%/ClickTaleCache.php?t=%CacheToken%";

// Cache provider name (for example "APC").
// Look into "ClickTale\ClickTale.CachingProviders" for all aviable providers.
//$config['CacheProvider'] = "MySQLMemory";
$config['CacheProvider'] = "FileSystem";

// The path(relative to ClickTale root directory) of the file that
// contains clicktale scripts.
$config['ScriptsFile'] = ClickTale_Root.ClickTale_DS."ClickTaleScripts.xml";

$config['FilterRulesFile'] = ClickTale_Root.ClickTale_DS."FilterRules.xml";

// When used with some CacheProviders, this will improve performance.
$config['CacheScriptsFile'] = true;

// Number of seconds to keep data in cache provider. Infinite if false or 0.
$config['MaxCachedSeconds'] = 60;

// Represents a path to the log file (relative to the "ClickTale\Logs" directory.
// "{0}" will be replaced with actual date. For disabling logging,
// set this param to false or empty string.
$config['LogPathMask'] = ClickTale_Root.ClickTale_DS."Logs".ClickTale_DS."Log_{0}.txt";

// If false, data will not be deleted after 1 request. Allows more than once fetch per data item.
$config['DeleteAfterPull'] = true;

$config['AllowDebug'] = false;

$config['DisableCache'] = false;

$config['DisableFilter'] = false;

// If there is a cookie with DoNotProcessCookieName and DoNotProcessCookieValue value
$config['DoNotProcessCookieName'] = "WRUID";

// then there will be no caching or filtering.
$config['DoNotProcessCookieValue'] = "0";

// A list of allowed sources to ClickTaleCache.php
// This list is a comma seperated list that may contain the following values:
// - Single IP/CIDR notated range (ex: 192.168.0.1,192.168.0.1/16)
// - A single host name (ex: tp1.clicktale.net)
// - A wildcard hostname (ex: *.clicktale.net) - NOTE: All wildcard hostnames must start with *.
$config['AllowedAddresses'] = "*.clicktale.net";

// Redirect on unauthorized access for fetcher. Leave blank for no redirect
$config['FetcherUnauthorizedURL'] = "";

// The location where cached files will be stored (works with FileSystem provider).
$config['CacheLocation'] = ClickTale_Root.ClickTale_DS."Cache";
//$config['CacheLocation'] = "http://<username>:<password>@<host>:<port>/<db name>.<table name>";

//Cache block size for SQLMemory cache provider
$config['CacheBlockSize'] = 230;
	
// Must be integers. Measured in megabytes.
$config['MaxFolderSize'] = 50;

$config['SystemTempDir'] = sys_get_temp_dir();

// used to log the token generated in the cache phase
$config['LogCaching'] = false;
// used to log the token requested in the fetch phase
$config['LogFetching'] = false;


// APPENDED BY DRUPAL CLICKTALE MODULE
$config['ScriptsFile'] = '/home/thistleinn/public_html/sites/default/files/clicktale/ClickTaleScripts.xml';
$config['CacheFetchingUrl'] = 'http://%ClickTaleCacheUrl%/ClickTaleCache.php?t=%CacheToken%';
$config['LogPathMask'] = '/home/thistleinn/public_html/sites/default/files/clicktale/Logs/Log_{0}.txt';
$config['CacheLocation'] = '/home/thistleinn/public_html/sites/default/files/clicktale/Cache';
$config['CacheProvider'] = 'FileSystem';
$config['MaxFolderSize'] = 50;
$config['DeleteAfterPull'] = true;
$config['MaxCachedSeconds'] = 60;

?>