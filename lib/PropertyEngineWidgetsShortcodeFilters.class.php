<?php
/**
 * @author simonc
 */

class PropertyEngineWidgetsShortcodeFilters
{
  /**
   * Removes tag wrapping from the shortcode
   * 
   * @author simonc
   * @version 1.0
   * @since 1.0
   * @return $html String Filtered HTML
   * @param $html String Post/page content to filter
   */
  function FormatXhtmlPost($html)
  {
    return preg_replace(
             '#<p>(<div .+ class="propertyengine-[a-z0-9]+">.+</div>)</p>#sU',
             "$1",
             $html
           );
  }
}
