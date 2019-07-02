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
use Controller\PagesController;


class GoogleController extends BaseSQL {

    public function defaultAction(): void{

        $token = md5(substr(uniqid().time(), 4, 10)."mxu(4il");

        if ($this->isSave($_GET['email']) == true){

            $_user = new Users();
            $_user->setFirstname($_GET["firstname"]);
            $_user->setLastname($_GET["lastname"]);
            $_user->setEmail($_GET['email']);
            $_user->setPwd($token);
            $_user->setStatus(1);

            $_user->setAccesstoken($token);

            $_user->save();
        }else{

            //Mettre a jour l'utilisateur avec la nouvelle donnée
            $query = $this->pdo->prepare(" UPDATE Users SET accesstoken=:titi WHERE email=:tutu ");
            $query->execute(["titi"=>$token, "tutu"=>$_GET['email'] ]);
        }

        $_SESSION['email'] = $_GET['email'];
        $_SESSION['accesstoken'] = $token;

        unset($_SESSION['FBRLH_state']);

        header("Location: /connexion");
        exit();

    }

    public function isSave($email): bool {
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