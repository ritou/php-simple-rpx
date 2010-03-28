<?php

include("rpx_config.inc");

define ("RPX_AUTHINFO_URL", "https://rpxnow.com/api/v2/auth_info");
class rpx_util{
 
  public static function getAuthUrl( $token_url ){
    $auth_url = RPX_SIGNIN_URL . "?token_url=".urlencode($token_url);
    return $auth_url;
  }

  public static function getAuthInfoUrl( $token ){
    $authinfo_url = RPX_AUTHINFO_URL . "?apiKey=".urlencode( RPX_API_KEY )
                  . "&token=".urlencode( $token );
    return $authinfo_url;
  }

  public static function getAuthInfo( $authinfo_url ){
    // curl access
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $authinfo_url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $json_response = curl_exec($curl);
    curl_close($curl);

    $auth_info = json_decode( $json_response );
    return $auth_info;
  }

  public static function getEmbeddedMarkUp( $token_url ){
    $markup = "<iframe src=\"" . 
              RPX_EMBEDDED_URL .
              "?token_url=" .
              urlencode( $token_url ) .
              "\"  scrolling=\"no\"  frameBorder=\"no\"  allowtransparency=\"true\"  style=\"width:400px;height:240px\"></iframe>";
    return $markup;
  }
}
