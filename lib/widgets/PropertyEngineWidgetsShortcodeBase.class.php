<?php

class PropertyEngineWidgetsShortcodeBase
{

  function displayAsHtml($attributes, $value = null, $class = null)
  {
    if (is_feed() && !get_option('propertyengine_feed'))
    {
      return '';
    }

    $class = !is_null($class) && class_exists($class) ? $class : __CLASS__;
    return call_user_func(array($class, 'shortcodeToHtml'), $attributes, $value);
  }

}
?>