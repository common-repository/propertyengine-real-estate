<?php
/**
 * @author simonc
 * 
 * In PHP5, it would implement PropertyEngineWidgetsShortcode interface
 */

class PropertyEngineWidgetsShortcodeLiveList extends PropertyEngineWidgetsShortcodeBase
{
  /**
   * @see PropertyEngineWidgetsShortcode::displayAsHtml()
   * @see PropertyEngineWidgetsShortcodeBase::displayAsHtml()
   */
  function displayAsHtml($attributes, $value = null)
  {
    return parent::displayAsHtml($attributes, $value, __CLASS__);
  }

  /**
   * @see PropertyEngineWidgetsShortcode::shortcodeToHtml()
   */
  function shortcodeToHtml($attributes, $value = null)
  {

    extract(
        shortcode_atts(
            array(
              'align' => get_option('propertyengine_align'),
              'bgcolor' => 'fff',
              'height' => '200',
              'region' => get_option('propertyengine_region'),
              'tracking_id' => get_option('propertyengine_tracking_id'),
              'width' => '600',
            ),
            $attributes
        )
    );

    /*
    * Preparing data
    */

    if (empty($attributes) || is_null($attributes)){
        $attributes = array();
    }
    if (is_null($attributes['showsearch'])){
        $attributes['showsearch'] = 'yes';
    }

    if (is_null($attributes['showstatus'])){
        $attributes['showstatus'] = 'unreleased,available,under-offer,sold';
    }

    if (is_null($attributes['sharebutton'])){
        $attributes['sharebutton'] = 'email,download,print';
    }

    /*
     * Display
     */
    ob_start();
        include PEW_PLUGIN_BASEPATH.'/lib/widgets/PropertyEngineWidgetsShortcodeLiveList.tmpl.php';
        $content = ob_get_contents();
    ob_clean();
    return $content ;

  }
}
