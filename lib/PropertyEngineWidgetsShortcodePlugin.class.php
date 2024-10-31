<?php
/**
 * @author simonc
 */

class PropertyEngineWidgetsShortCodePlugin
{
  /**
   * Register main functions for plugin's sake
   *
   * @static
   * @author simonc
   * @version 1.0
   * @since 1.0
   */
  function bootstrap($plugin_home_path)
  {
    $class = __CLASS__;
    list($filename, $i18n_path, $i18n_from_plugin_path) = call_user_func(array($class, 'getLocation'), $plugin_home_path);
    $pluginfile = preg_replace('#(.+)([^/]+/[^/]+)$#sU', "$2", $filename);
    load_plugin_textdomain('propertyengine', $i18n_path, $i18n_from_plugin_path);
    register_activation_hook($filename, array($class, 'executeActivation'));
    add_filter('plugin_action_links_'.$pluginfile, array($class, 'executeFilterPluginActionLinks'));

    define('PEW_PLUGIN_BASEPATH', dirname($filename));
    define('PEW_PLUGIN_PLUGINFILE', $pluginfile);
  }

  /**
   * Returns plugin location
   *
   * In case of symlink, it assumes you linked it with its original plugin name
   * eg: `ln -s /path/to/plugins/propertyengine-widgets-shortcodes /real/path/to/pe-plugin`
   *
   * @static
   * @author simonc
   * @version 1.0
   * @since 1.0
   * @return $location Array
   * @param $filepath String File location
   */
  function getLocation($filepath)
  {
    /*
     * The plugin is installed as a symlink
     */
    if (function_exists('is_link') && is_link(WP_PLUGIN_DIR.'/propertyengine-real-estate'))
    {
      return array(
        WP_PLUGIN_DIR.'/propertyengine-real-estate/'.basename($filepath),
        PLUGINDIR.'/propertyengine-real-estate/i18n',
        'propertyengine-real-estate/i18n'
      );
    }
    else
    {
      return array(
        $filepath,
        PLUGINDIR.'/'.dirname(plugin_basename($filepath)).'/i18n',
        dirname(plugin_basename($filepath)).'/i18n'
      );
    }
  }

  /**
   * Plugin activation processing
   *
   * @static
   * @author simonc
   * @version 1.0
   * @since 1.0
   * @return $state Mixed null if nothing, else false
   */
    function executeActivation()
    {
        /*
         * Default options
         */
        foreach (PropertyEngineWidgetsShortcodeConfiguration::getOptions() as $id => $option)
        {
            add_option(
                $id,
                $option['defaultValue'],
                '',
                (bool)$option['autoload'] ? 'yes' : 'no'
            );
        }

        /*
         * Purge TinyMCE config if the file exists
         */
        $cache_dir = WP_CONTENT_DIR.'/uploads/js_cache';
        if (file_exists($cache_dir ))
        {
            $dir_handler = opendir($cache_dir);
            while ($element = readdir($dir_handler))
            {
                if (preg_match('/^tinymce/', $element) && is_file($cache_dir.'/'.$element))
                {
                    unlink($cache_dir.'/'.$element);
                }
            }
            closedir($dir_handler);
        }
    }

  /**
   * Filter action plugin action links to add context links
   *
   * @author simonc
   * @version 1.0
   * @since 1.0
   * @return array
   * @param array $action_links
   */
  function executeFilterPluginActionLinks($action_links)
  {
        return array_merge(array('<a href="options-general.php?page=propertyengine-options">'.__('Configure').'</a>'), $action_links);
  }

  /**
   * Register shortcode class & syntax
   *
   * @author simonc
   * @version 1.0
   * @since 1.0
   * @return $registered_shortcodes Integer Number of registered shortcodes
   */
  function registerShortcodes()
  {
    $disabled_widgets = PropertyEngineWidgetsShortcodeConfiguration::getDisabledWidgets();

    require PEW_PLUGIN_BASEPATH.'/lib/widgets/PropertyEngineWidgetsShortcodeBase.class.php';

    foreach (PropertyEngineWidgetsShortcodeConfiguration::getShortcodes() as $shortcode_id => $shortcode_config)
    {
      /*
       * Standard HTML generator
       */
      if (empty($disabled_widgets) || !in_array($shortcode_id, $disabled_widgets))
      {
        // Include the plugins that are needed
        require PEW_PLUGIN_BASEPATH.'/lib/widgets/'.$shortcode_config['class'].'.class.php';
      }

      /*
       * Load dummy HTML generator, in case you don't want to display disabled widgets
       */
      else
      {
        $shortcode_config['class'] = 'PropertyEngineWidgetsShortcodeDummy';

        if (!class_exists($shortcode_config['class']))
        {
          require PEW_PLUGIN_BASEPATH.'/lib/widgets/'.$shortcode_config['class'].'.class.php';
        }
      }

      add_shortcode($shortcode_id, array($shortcode_config['class'], 'displayAsHtml'));
    }
  }
}
