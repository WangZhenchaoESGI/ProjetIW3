<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Core\FB;

class LoginController extends BaseSQL {


    public function defaultAction() {

        switch ($_GET['type']){
            case "facebook":
                $login =  new FB();
                $l = $login->Login();
                break;
        }


        echo $l;


    }

    public function callbackAction()
    {

        switch ($_GET['type']){
            case "facebook":
                $fb = new FB();
                $user = $fb->callbackFB();
                break;
        }
        
        echo "<pre>";
        print_r($user);
    }


}