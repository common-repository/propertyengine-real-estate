<?php
/**
 * @author simonc
 */

class PropertyEngineWidgetsShortcodeConfiguration
{
   /**
   * Retrieves enabled widgets list
   *
   * @author  simonc
   * @version 1.0
   * @since   1.1
   */
  function getEnabledWidgets()
  {
    static $enabledWidgets;

    if (null === $enabledWidgets)
    {
      $enabledWidgets = array_flip(array_keys(PropertyEngineWidgetsShortcodeConfiguration::getShortcodes()));
      foreach (PropertyEngineWidgetsShortcodeConfiguration::getDisabledWidgets() as $w)
      {
        unset($enabledWidgets[$w]);
      }

      $enabledWidgets = array_flip($enabledWidgets);
    }

    return $enabledWidgets;
  }

    /**
     * Determines if the disabled widgets list
     *
     * @author	simonc
     * @version	1.0.1
     * @since	1.1
     */
    function getDisabledWidgets()
    {
        static $disabledWidgets;
        $trackingId = get_option('propertyengine_tracking_id', '');
        //invalid trackingId, all widgets are disabled
        if ($trackingId == '' || $trackingId == 'invalid'){
            $disabledWidgets = array();
            foreach (PropertyEngineWidgetsShortcodeConfiguration::getShortcodes() as $shortcode_id => $shortcode_config){
                array_push($disabledWidgets, ($shortcode_id));
            }
        }else{

            if (null === $disabledWidgets)
            {
                $disabledWidgets = get_option('propertyengine_disabled_widgets', array());

                if (!$disabledWidgets || $disabledWidgets = 'a:0:{}')
                {
                    $disabledWidgets = array();
                }

                if (is_string($disabledWidgets))
                {
                    $disabledWidgets = unserialize($disabledWidgets);
                }
            }
        }
        return $disabledWidgets;
    }

    /**
     * Easy way to get the whole list of registered options
     *
     * @author simonc
     * @version 1.0
     * @since 1.0
     * @return $options Array List of options and meta
     */
    function getOptions()
    {
        return array(
            'propertyengine_tracking_id' => array(
                'autoload' => true,
                'defaultValue' => '',
                'onSaveCallback' => 'activationKeyValidation',
                'possibleValues' => '',
            )
        );
    }

    /**
   * Return a region configuration
   *
   * @author simonc
   * @version 1.0
   * @since 1.0
   * @return $region Array Specific region settings
   * @param $region String[optional] Country code to get settings ; if null, grab the default region
   */
  function getRegion($region = null)
  {
    if (is_null($region) || !$region)
    {
      $region = get_option('propertyengine_region');
      $region = $region ? $region : 'us';
    }

    $regions = PropertyEngineWidgetsShortcodeConfiguration::getRegions();

    return $regions[$region];
  }

  /**
   * Returns all region configuration
   *
   * @author simonc
   * @version 1.0
   * @since 1.0
   * @return $regions Array
   */
  function getRegions()
  {
    return array(

      'us' => array(
        'lang_iso_code' => 'en_US',
        'marketplace' =>   'US',
        'name' =>          __('PropertyEngine', 'propertyengine'),
        'suffix' =>        '-20',
        'tld' =>           'com',
        'url' => array(
          'product' =>              'http://www.propertyengine.com/',
          'site' =>                 'http://www.propertyengine.com/',
        ),
      ),
    );
  }

  /**
   * Return a specific shortcode configuration
   *
   * @static
   * @author simonc
   * @version 1.0
   * @since 1.0
   * @return $settings Array
   * @param $shortcode String
   */
  function getShortcode($shortcode)
  {
    $shortcodes = PropertyEngineWidgetsShortcodeConfiguration::getShortcodes();

    return $shortcodes['propertyengine-'.$shortcode];
  }

  /**
   * Returns shortcodes configuration
   *
   * @static
   * @version 1.0
   * @since 1.0
   * @return $shortcodes Array Shortcodes configuration
   */
  function getShortcodes()
  {
    return array(
      'propertyengine-livelist' => array(
        'class' => 'PropertyEngineWidgetsShortcodeLiveList',
    	'name' => __('PropertyEngine LiveList', 'propertyengine'),
      )
    );
  }
}
