<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Core\FB;
use Core\View;
use Models\Users;
use Models\restaurant;
use Models\category;
use Models\fonts;
use Models\address;
use Core\Routing;
use Core\Validator;
use Core\Validator_login;
use Core\Mail;
use Controller\PagesController;
use Controller\FacebookController;
use Controller\UsersController;


class ConfigurationTemplateController extends BaseSQL{

    public function defaultAction(){

        if ($this->isConnected() == false){
            header("Location: /");
        }

        //Info Restaurateur
        $user = new Users();
        $u = $user->getOneBy(["email"=>$_SESSION['email']],false);

        $design = new restaurant();
        $a=$design->getOneBy(["id_user"=>$u['id']],false);

        //Ajouter or Modifier Le desgin de Restaurant
        if (empty($a)){

            $this->addAction();

        }


    }

    public function addAction(){

        $category = new category();
        $c = $category->getAll();

        $fonts = new fonts();
        $f = $fonts->getAll();

        $form['category'] = $c;
        $form['fonts'] = $f;

        $v = new View("addDesign", "back");
        $v->assign("form", $form);
    }

    public function saveAction(){

        $user = new Users();
        $form = $user->getRegisterForm();

        //Est ce qu'il y a des données dans POST ou GET($form["config"]["method"])
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];


        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){

            $validator = new Validator($form,$data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])){
                $user->setFirstname($data["firstname"]);
                $user->setLastname($data["lastname"]);
                $user->setEmail($data["email"]);
                $user->setPwd($data["pwd"]);

                $token = md5(substr(uniqid().time(), 4, 10)."mxu(4il");
                $user->setAccesstoken($token);

                $user->save();

                $url = "http://".$_SERVER['HTTP_HOST']."/verification?accesstoken=".$token;

                $content = "Veuillez cliquer le lien ci-dessous pour activer votre compte ".TITLE." <br> ".$url;

                $mail = new Mail($data["lastname"],$data["email"],'Activation du compte de '.TITLE,$content);
                $mail->sendMail();

                header("Location: /active_compte");
                exit();
            }

        }

        $v = new View("addUser", "front");
        $v->assign("form", $form);

    }


    public function loginAction(){

        if ($this->isConnected() == false){
            header("Location: /");
        }

        $user = new Users();
        $form = $user->getLoginForm();

        $facebook = new FB();
        $form['url_facebook'] = $facebook->Login();

        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){

            $validator = new Validator_login($form,$data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])){

                //var_dump($data);
                //$data['email'];

                $where = [ "email"=>$data['email'] ];
                $infoUser = $user->getOneBy($where,false);

                //var_dump($infoUser);

                //Connexion avec token
                //$token = md5(substr(uniqid().time(), 4, 10)."mxu(4il");

                /*
                 *  Après la vérification de connexion, redirect
                 */

                $_SESSION["accesstoken"] = $infoUser['accesstoken'];
                $_SESSION["email"] = $data['email'];

                header("Location: /");
                exit();

            }

        }

        $v = new View("loginUser", "front");
        $v->assign("form", $form);

    }

    public function isConnected(){

        //Vérifier que les variables de sessions existent
        if( !empty($_SESSION["accesstoken"]) && !empty($_SESSION["email"])){

            //Si oui se connecter a la base et vérifier qu'un utilisateur correspond
            $query = $this->pdo->prepare(" SELECT id FROM Users WHERE email=:titi AND accesstoken=:tutu AND status=1 AND role=2");
            $query->execute(["titi"=>$_SESSION["email"], "tutu"=>$_SESSION["accesstoken"]]);
            $result = $query->fetch();
            //Si oui regenerer un accesstoken et retourner vrai
            if( !empty($result)){
                $_SESSION["accesstoken"] = $this->generateAccessToken($_SESSION["email"]);
                return true;
            }
            return false;
        }
        //Sinon retourner faux
        return false;
    }

    public function generateAccessToken($email){
        //Générer un accesstoken
        $accesstoken = md5(substr(uniqid().time(), 4, 10)."mxu(4il");

        //Se connecter a la bdd
        //Mettre a jour l'utilisateur avec la nouvelle donnée
        $query = $this->pdo->prepare(" UPDATE Users SET accesstoken=:titi WHERE email=:tutu ");
        $query->execute(["titi"=>$accesstoken, "tutu"=>$email ]);

        return $accesstoken;
    }

}