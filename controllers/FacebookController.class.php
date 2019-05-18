<?php

declare(strict_types=1);

namespace Controller;
use Core\FB;
use Core\View;
use Models\Users;
use Core\Routing;
use Core\Validator;
use Core\Validator_login;
use Core\Mail;
use Controller\PagesController;
use Facebook\Facebook;



class FacebookController{

    public function defaultAction(){
        $facebook = new FB();
        $facebook->callback();
    }


}