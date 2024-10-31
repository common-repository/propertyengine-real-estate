<?php
/*
Plugin Name: PropertyEngine Widgets Shortcodes
Description: Easy management of PropertyEngine Links & Widgets on your blog. Preserve your post consistency, use copy/paste PropertyEngine code or build your links with an easy to use interface.
Author: PropertyEngine
Version: 1.2.5
Author URI: http://www.propertyengine.com/
Plugin URI: http://www.propertyengine.com/product/livelist

  This plugin is released under version 3 of the GPL:
  http://www.opensource.org/licenses/gpl-3.0.html
*/

/*
 * Compatibility with WP 2.5
 */
if (!defined('WP_PLUGIN_DIR'))
{
    define('WP_PLUGIN_DIR', ABSPATH.PLUGINDIR);
    define('WP_PLUGIN_URL', get_bloginfo('url').'/'.PLUGINDIR);
}
if (!defined('WP_CONTENT_DIR'))
{
    define('WP_CONTENT_DIR', ABSPATH.'wp-content');
}


/*
 * Bootstrap
 */
require_once dirname(__FILE__).'/lib/PropertyEngineWidgetsShortcodePlugin.class.php';
require_once dirname(__FILE__).'/lib/PropertyEngineWidgetsShortcodeConfiguration.class.php';
PropertyEngineWidgetsShortcodePlugin::bootstrap(__FILE__);


//Global Code
$class = 'PropertyEngineWidgetsShortcodeRteTinyMce';
require_once PEW_PLUGIN_BASEPATH.'/lib/rte/'.$class.'.class.php';
add_action('init', array($class, 'bootstrap'));


/*
 * Frontend plugin code
 */
if (get_option('propertyengine_tracking_id') && !is_admin())
{
    PropertyEngineWidgetsShortcodePlugin::registerShortcodes();

    $class = 'PropertyEngineWidgetsShortcodeFilters';
    require_once PEW_PLUGIN_BASEPATH.'/lib/'.$class.'.class.php';
    add_filter('the_excerpt', array($class, 'FormatXhtmlPost'), 999);
    add_filter('the_content', array($class, 'FormatXhtmlPost'), 999);

    /*
    * We enqueue PropertyEngine JS at the bottom
    */
    if (get_option('propertyengine_context_links'))
    {
        $class = 'PropertyEngineWidgetsShortcodeContextLink';
        require_once PEW_PLUGIN_BASEPATH.'/lib/tools/'.$class.'.class.php';
        add_filter('the_excerpt', array($class, 'filterContextLinks'), 900);
        add_filter('the_content', array($class, 'filterContextLinks'), 900);
        add_action('wp_footer', array($class, 'getHtmlCode'));
    }

    if (get_option('propertyengine_product_preview'))
    {
        $class = 'PropertyEngineWidgetsShortcodeProductPreview';
        require_once PEW_PLUGIN_BASEPATH.'/lib/tools/'.$class.'.class.php';
        add_action('wp_footer', array($class, 'getHtmlCode'));
    }
}

/*
 *  If user is admin, give access to TinyMCE menu
 */
if (is_admin())
{
    $class = 'PropertyEngineWidgetsShortcodesAdmin';
    require_once(PEW_PLUGIN_BASEPATH.'/lib/'.$class.'.class.php');
    add_action('admin_menu', array($class, 'setupAdminMenu'));
    add_action('wpmu_new_blog', array($class, 'setupNewMuBlog'), 20, 2);
    add_filter('whitelist_options', array($class, 'setupOptionsWhitelist'));

    if (get_option('propertyengine_inline_documentation'))
    {
        add_action('edit_form_advanced', array($class, 'displayDocumentation'));
    }

    if (!get_option('propertyengine_tracking_id'))
    {
        add_action('admin_notices', array($class, 'printNotice'));
    }
}
