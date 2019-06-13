<?php

declare(strict_types=1);

namespace Core;
use  Facebook\Facebook;

// Load Composer's autoloader
require_once __DIR__ . '/vendor/facebook/graph-sdk/src/Facebook/autoload.php'; // change path as needed
class FB{

    private $name;
    private $email;
    private $accesstoken;

    public function __construct(){
    }

    public function Login(){

        if (!session_id()) {
            session_start();
        }
        $fb = new \Facebook\Facebook([
            'app_id' => '539129156491498', // Replace {app-id} with your app id
            'app_secret' => '2580f6cdd4d6380f660ddff8a10258be',
            'default_graph_version' => 'v3.3'
        ]);

        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['public_profile','email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl('https://wantwant.eu/facebook_callback', $permissions);

        //echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
        return $loginUrl;

    }

    public function callbackFB(){

        if (!session_id()) {
            session_start();
        }

        $fb = new \Facebook\Facebook([
            'app_id' => '539129156491498', // Replace {app-id} with your app id
            'app_secret' => '2580f6cdd4d6380f660ddff8a10258be',
            'default_graph_version' => 'v3.3'
        ]);

        $oHelper = $fb->getRedirectLoginHelper();
        $_SESSION['FBRLH_state']=$_GET['state'];

        $oAccessToken = $oHelper->getAccessToken();
        if ($oAccessToken !== null) {
            $oResponse = $fb->get('/me?fields=id,name,first_name,last_name,email', $oAccessToken);
            //print_r($oResponse->getGraphUser());
            return $oResponse->getGraphUser();
        }

        return '';
}

}



