<?php
/**
 * @author simonc
 */

class PropertyEngineWidgetsShortcodeContextLink
{
  /**
   * Display HTML Code
   *
   * @author simonc
   * @version 1.0
   * @since 1.1
   * @return 
   */
  function getHtmlCode()
  {
    $tracking_id = get_option('propertyengine_tracking_id');
    $region = PropertyEngineWidgetsShortcodeConfiguration::getRegion();
    $src = $region['url']['tool-contextlinks'];

    if (!$src)
    {
      return;
    }

    echo <<<EOF
<script type="text/javascript">//<![CDATA[
var amzn_cl_tag = '{$tracking_id}';
//]]></script><script type="text/javascript" src="{$src}"></script>
EOF;
  }

  /**
   * Wraps content in PropertyEngine proprietary HTML comments tag
   * 
   * Context links are added by PropertyEngine engine only between those parts.
   * 
   * @author simonc
   * @version 2.0
   * @since 1.3
   * @return $html String Filtered HTML
   * @param $html String Post/page content to filter
   */
  function filterContextLinks($html)
  {
    return
      '<!--PropertyEngine_CLS_IM_START-->'.
      $html.
      '<!--PropertyEngine_CLS_IM_END-->';
  }
}
