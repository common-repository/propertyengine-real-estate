<?php
/* Basic checks to make sure plugin is uninstallable */
if (!defined('ABSPATH') || !defined('WP_UNINSTALL_PLUGIN'))
{
  exit('Error occured while uninstalling the PropertyEngine plugin.');
}

require_once dirname(__FILE__) . '/propertyengine-widgets-shortcodes.php';

/* deleting known options */
foreach (array_keys(PropertyEngineWidgetsShortcodeConfiguration::getOptions()) as $option_id)
{
  delete_option($option_id);
}