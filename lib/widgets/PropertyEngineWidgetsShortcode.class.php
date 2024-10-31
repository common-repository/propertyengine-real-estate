<?php
/**
 * @author simonc
 * @php5
 * 
 * Basic skeleton for all widgets
 * It is not used for now to keep Wordpress + PHP4 compatibility
 */

abstract class PropertyEngineWidgetsShortcode
{
  /**
   * Returns HTML code corresponding to a shortcode, if available
   * 
   * @author simonc
   * @version 1.0
   * @since 1.0
   * @return $html String Shortcode HTML
   * @param $attributes Array
   * @param $value String[optional]
   */
  abstract public function displayAsHtml(array $attributes, $value = null);

  /**
   * Converts a shortcode as HTML
   * 
   * @author simonc
   * @version 1.0
   * @since 1.0
   * @return $html String Shortcode HTML
   * @param $attributes Array
   * @param $value String[optional]
   */
  abstract public function shortcodeToHtml(array $attributes, $value = null);
}
