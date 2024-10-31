<?php
/**
 * @author simonc
 */

class PropertyEngineWidgetsShortcodeProductPreview
{
  /**
   * Displays context links on PropertyEngine links
   *
   * @static
   * @author simonc
   * @version 1.0
   * @since 1.1
   * @return null
   */
  function getHtmlCode()
  {
    $region = PropertyEngineWidgetsShortcodeConfiguration::getRegion();
    $src = sprintf(
            $region['url']['tool-productpreview'],
            get_option('propertyengine_tracking_id')
           );

    echo <<<EOF
<script type="text/javascript" src="{$src}"></script>
EOF;
  }
}
