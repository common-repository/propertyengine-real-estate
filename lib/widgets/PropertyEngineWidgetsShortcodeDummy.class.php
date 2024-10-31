<?php
/**
 * @author simonc
 */

class PropertyEngineWidgetsShortcodeDummy extends PropertyEngineWidgetsShortcodeBase
{
  /**
   * @see PropertyEngineWidgetsShortcode::displayAsHtml()
   * @see PropertyEngineWidgetsShortcodeBase::displayAsHtml()
   */
  function displayAsHtml($attributes, $value = null)
  {
    return '';
  }

  /**
   * @see PropertyEngineWidgetsShortcode::shortcodeToHtml()
   */
  function shortcodeToHtml($attributes, $value = null)
  {
    return '';
  }
}
