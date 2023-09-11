<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content_top']: Items for the header region.
 * - $page['content']: The main content of the current page.
 * - $page['content_bottom']: Items for the header region.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
 
 
 //print_r($page);
?>
    
<div id="page-wrapper">

    <header id="header" role="banner" class="clearfix">
        
        <div class="col-1">
            <?php if ($page['header-left']): ?>
                <?php print render($page['header-left']); ?>
            <?php endif; ?>
            <?php if ($page['menu-left']): ?>
                <?php print render($page['menu-left']); ?>
            <?php endif; ?>
        </div>

        <div class="col-2">
            <?php if ($logo): ?>
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
                    <img src="<?php print $logo; ?>" width="110px" height="152px" alt="<?php print t('Home'); ?>" />
                </a>
            <?php endif; ?>
            <?php if ($page['header-center']): ?>
                <?php print render($page['header-center']); ?>
            <?php endif; ?>
        </div>

        <div class="col-3">
            <?php if ($page['header-right']): ?>
                <?php print render($page['header-right']); ?>
            <?php endif; ?>
            <?php if ($page['menu-right']): ?>
                <?php print render($page['menu-right']); ?>
            <?php endif; ?>
        </div>

        <?php if ($page['menu']): ?>
            <?php print render($page['menu']); ?>
        <?php endif; ?>
        
    </header><!-- /#header -->

    <div id="page">

        <div class="container-24">
            <div id="main-wrapper">
            
                <?php if ($page['content_top']): ?>
                    <?php print render($page['content_top']); ?>
                <?php endif; ?>

            
                <div id="main" class="clearfix">
                    
                    <div id="content" class="column" role="main">
                        <div class="section">
                        
                            <?php if ($breadcrumb): ?>
                                <div id="breadcrumb" class="clearfix"><?php print $breadcrumb; ?></div>
                            <?php endif; ?>
                            
                            <?php if ($messages): ?>
                                <div id="messages"><div class="section clearfix">
                                  <?php print $messages; ?>
                                </div></div> <!-- /.section, /#messages -->
                              <?php endif; ?>
                            
                            <?php if (isset($node) && $node->type != 'basic_page_image_slider' && $node->type != 'page' && $node->type != 'menu') : ?>
                              <h1 class="title" id="page-title"><?php print $title; ?></h1>
                            <?php endif; ?>
                                                        
                            <?php if ($tabs): ?>
                              <div class="tabs"><?php print render($tabs); ?></div>
                            <?php endif; ?>
                            
                            <?php print render($page['help']); ?>
                            
                            <?php if ($action_links): ?>
                              <ul class="action-links"><?php print render($action_links); ?></ul>
                            <?php endif; ?>
                            
                            <?php print render($page['content']); ?>
                        
                        </div>
                    </div>
                    
                    <?php if ($page['sidebar_first']): ?>
                        <aside id="sidebar-first" class="column sidebar grid-9 rt-suffix-1" role="complementary">
                            <div class="section">
                                <?php print render($page['sidebar_first']); ?>
                            </div><!-- /.section -->
                        </aside><!-- /#sidebar-first -->
                    <?php endif; ?>
            
                    <?php if ($page['sidebar_second']): ?>
                        <aside id="sidebar-second" class="column sidebar grid-6 rt-prefix-1 grid-right" role="complementary">
                            <div class="section">
                                <?php print render($page['sidebar_second']); ?>
                            </div><!-- /.section -->
                        </aside><!-- /#sidebar-second -->
                    <?php endif; ?>
                    
                </div><!-- /#main -->

                <?php if ($page['content_bottom']): ?>
                    <?php print render($page['content_bottom']); ?>
                <?php endif; ?>

            </div>
        </div>

    </div><!-- /#page -->
    <footer id="footer" role="contentinfo">
        <div class="footer-wrapper clearfix">
            <div class="container-24">
                <div class="grid-24">
                    <?php print render($page['footer']); ?>
                </div>
            </div>
        </div><!-- /#footer-wrapper -->
    </footer><!-- /#footer -->

    <footer id="footer-bottom">
        <?php print render($page['footer-bottom']); ?>
    </footer>

</div><!-- /#page-wrapper -->