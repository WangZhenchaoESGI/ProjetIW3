<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Core\FB;
use Core\View;
use Models\Users;
use Core\Routing;
use Core\Validator;
use Core\Validator_login;
use Core\Mail;
use Controller\UsersController;
use Controller\PagesController;
use Facebook\Facebook;



class FacebookController extends BaseSQL {

    public function defaultAction(){
        $fb =  new FB();
        return $fb->Login();
    }

    public function callbackAction(){
        $fb =  new FB();
        $user = $fb->callbackFB();

        $token = md5(substr(uniqid().time(), 4, 10)."mxu(4il");

        if ($this->isSave($user['email']) == true){

            $_user = new Users();
            $_user->setFirstname($user["first_name"]);
            $_user->setLastname($user["last_name"]);
            $_user->setEmail($user["email"]);
            $_user->setPwd($token);
            $_user->setStatus(1);

            $_user->setAccesstoken($token);

            $_user->save();
        }else{

            //Mettre a jour l'utilisateur avec la nouvelle donnée
            $query = $this->pdo->prepare(" UPDATE Users SET accesstoken=:titi WHERE email=:tutu ");
            $query->execute(["titi"=>$token, "tutu"=>$user['email'] ]);
        }

        $_SESSION['email'] = $user['email'];
        $_SESSION['accesstoken'] = $token;

        unset($_SESSION['FBRLH_state']);

        header("Location: /connexion");
        exit();

    }

    public function isSave($email){
        $query = $this->pdo->prepare("SELECT * FROM Users WHERE email=:titi");
        $query->execute(["titi" => $email]);
        $result = $query->fetch();

        //Utiliser la fonction native de php
        // password_verify ( string $password , string $hash )
        if (empty($result)) {
            return true;
        }

        return false;
    }

}