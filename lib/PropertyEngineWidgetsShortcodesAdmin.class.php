<?php
/**
 * Admin functions
 *
 * @author simonc
 * @version 1.0
 * @since 1.0 alpha 2
 */
class PropertyEngineWidgetsShortcodesAdmin
{
  /**
   * Display tags help
   *
   * @author simonc
   * @since 1.0 beta 1
   * @return null
   */
  function displayDocumentation()
  {
    include PEW_PLUGIN_BASEPATH.'/admin/view/documentation.php';
  }

  /**
   * Display options page
   *
   * @author simonc
   * @since 1.0 alpha 2
   * @return null
   */
  function displayOptions()
  {
    global $wp_version, $wpmu_version;
    /*
     * Including elements
     */
    include PEW_PLUGIN_BASEPATH.'/admin/form/options.php';
    include PEW_PLUGIN_BASEPATH.'/admin/view/options.php';
  }

  /**
   * Include our own javascript
   * @author simonc
   * @since 1.0 beta 1
   * @return null
   */
  function printJavaScript()
  {
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script("jquery");
    wp_enqueue_script('propertyengine-dataTables', WP_PLUGIN_URL.'/propertyengine-real-estate/web/javascript/jquery.dataTables.min.js');
    wp_enqueue_script('propertyengine-underscore', WP_PLUGIN_URL.'/propertyengine-real-estate/web/javascript/underscore-min.js');
    wp_enqueue_script('propertyengine-backbone', WP_PLUGIN_URL.'/propertyengine-real-estate/web/javascript/backbone-min.js');
    wp_enqueue_script('propertyengine-main', WP_PLUGIN_URL.'/propertyengine-real-estate/web/javascript/propertyengine.js');
  }

  /**
   * Show a notice to the user if (s)he has not setup the plugin yet
   *
   * @author simonc
   * @since 1.0 alpha 2
   * @return null
   */
  function printNotice()
  {
    ?>
    <div class="updated fade">
      <p><strong><?php _e('PropertyEngine Widget Shortcodes requires activation', 'propertyengine') ?></strong>.</p>
      <p><?php printf(
              __('You need to <a href="%s">setup your PropertyEngine Activation Key</a> in order to see your shortcodes display PropertyEngine Widgets.', 'propertyengine'),
              'options-general.php?page=propertyengine-options'
            ) ?></p>
    </div>
    <?php
  }

    /**
     * Show a notice to the user if (s)he has not setup the plugin yet
     *
     * @author simonc
     * @since 1.0 alpha 2
     * @return null
     */
    function printInvalidKey()
    {
        ?>
    <div class="updated fade">
        <p><strong><?php _e('Error while activating the PropertyEngine Widget Shortcodes plugin', 'propertyengine') ?></strong>.</p>
        <p><?php printf(
            __('The key you entered is not valid, or is already in use. ','propertyengine')
        ) ?></p>
    </div>
    <?php
    }

    function printInvalidData($reason)
    {
        ?>
    <div class="updated fade">
        <p><strong><?php _e('Error while activating the PropertyEngine Widget Shortcodes plugin', 'propertyengine') ?></strong>.</p>
        <p><?php printf(
            __($reason,'propertyengine')
        ) ?></p>
    </div>
    <?php
    }

    function printValidated()
    {
        ?>
    <div class="updated fade">
        <p><strong><?php _e('Successfully registered the PropertyEngine Widget Shortcodes plugin', 'propertyengine') ?></strong>.</p>
        <p><?php printf(
            __('The plugin has been successfully registered with <a href="http://www.propertyengine.com">www.propertyengine.com</a>.','propertyengine')
        ) ?></p>
    </div>
    <?php
    }

  /**
   * Include our own stylesheet
   * @author simonc
   * @since 1.0 beta 1
   * @return null
   */
  function printStylesheet()
  {
    echo '<link rel="stylesheet" type="text/css" media="screen" href="'.WP_PLUGIN_URL.'/propertyengine-real-estate/web/css/propertyengine.css" />';
  }

  /**
   * Setup admin pages
   *
   * Includes menu
   * Hook scripts & stylesheets
   *
   * @author simonc
   * @version 1.1
   * @since 1.0 alpha 2
   * @return null
   */
  function setupAdminMenu()
  {
    /*
     * Hooking pages
     */
    $options_page = add_options_page(
      __('PropertyEngine Widgets Shortcodes', 'propertyengine'),
      __('PropertyEngine Widgets Shortcodes', 'propertyengine'),
      8,'propertyengine-options',
      array('PropertyEngineWidgetsShortcodesAdmin', 'displayOptions')
    );

    /*
     * Hooking styles
     */
    add_action('admin_head-'.$options_page, array('PropertyEngineWidgetsShortcodesAdmin', 'printStylesheet'));
    add_action('admin_print_scripts-'.$options_page, array('PropertyEngineWidgetsShortcodesAdmin', 'printJavascript'));
  }

  /**
   * @since 1.5.3
   * @author simonc
   * @param $blog_id integer
   * @param $user_id integer
   */
  function setupNewMuBlog($blog_id, $user_id)
  {
    $dashblog = get_dashboard_blog();
    $copy_options = array('tracking_id', 'region');
    $copied_values = array();

    if (!(int)$blog_id || (int)$blog_id === (int)$dashblog->blog_id)
    {
      return false;
    }

    /*
     * Copy Options
     */
    foreach ($copy_options as $option_id)
    {
      $copied_values['propertyengine_'.$option_id] = get_option('propertyengine_'.$option_id);
    }

    switch_to_blog($blog_id);

    activate_plugin(PEW_PLUGIN_PLUGINFILE);
    foreach ($copied_values as $option_id => $option_value)
    {
      update_option($option_id, $option_value);
    }

    restore_current_blog();
  }

  /**
   * Add whitelist options for WPMU
   * @author simonc
   * @since 1.1.1
   * @return $whitelist Array
   * @param $whitelist Array
   */
  function setupOptionsWhitelist($whitelist)
  {
    if (is_array($whitelist))
    {
      $whitelist = array_merge(
        $whitelist,
        array(
          'propertyengine' => array_keys(PropertyEngineWidgetsShortcodeConfiguration::getOptions())
        ));
    }

    return $whitelist;
  }
}