<?php
/**
 * @author cornek
*/

/**
 * Query the PE server to determine if key is valid
 *
 * @author cornek
 * @version 1.0
 * @since 1.1.5
 * @return if authentication key is valid
 */
register_setting( 'propertyengine', 'propertyengine_tracking_id', '' );

$options = PropertyEngineWidgetsShortcodeConfiguration::getOptions();

function activationKeyValidation($value){
    if ($value){
        require_once(PEW_PLUGIN_BASEPATH.'/lib/PropertyEngineWidgetsShortcodesAdmin.class.php');
        $url = 'http://www.propertyengine.com/api/v2/'.$value.'/liveList/wordpress/authentication?domain='.$_SERVER['SERVER_NAME'];
        $result = loadXML($url);
        if (FALSE === $result){
            //If curl doesn't respond with anything due to server side error's
            return "valid";
        }else{
            $returnResult = "failed";
            $json = json_decode ($result, true);
            if ($json['result'] == "error"){
                PropertyEngineWidgetsShortcodesAdmin::printInvalidData($json['reasons'][0]);
            }
            else if ($json['result'] == "success" && $json['feedback'] == "validated"){
                PropertyEngineWidgetsShortcodesAdmin::printValidated();
                $returnResult = "valid";
            }
            else if ($json['result'] == "success" && $json['feedback'] == "valid"){
                $returnResult = "valid";
            }else{
                PropertyEngineWidgetsShortcodesAdmin::printInvalidData($json['reasons'][0]);
            }
            return $returnResult;
        }
    }
    return "";
}

foreach ($options as $id => $option)
{
    //If it is the tracking ID, check to see if the tracking code is legit and block it if it isn't
    if ($id == "propertyengine_tracking_id"){
        $response = call_user_func($option['onSaveCallback'], get_option($id));
        //Set it too blank
        if ($response != "valid"){
            update_option( $id, "invalid" );
        }
    }
}

function loadXML($url) {
    if (ini_get('allow_url_fopen') == true) {
        return load_fopen($url);
    } else if (function_exists('curl_init')) {
        return load_curl($url);
    } else {
        // Enable 'allow_url_fopen' or install cURL.
        throw new Exception("Can't load data.");
    }
}

function load_fopen($url) {
    return file_get_contents ($url);
}

function load_curl($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}
