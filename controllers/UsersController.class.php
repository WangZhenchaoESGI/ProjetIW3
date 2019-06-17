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
use Controller\FacebookController;


class UsersController extends BaseSQL{

	public function defaultAction(){
		echo "users default";
	}
	
	public function addAction(){

        if ($this->isConnected()){
            $this->redirect();
        }

		$user = new Users();
		$form = $user->getRegisterForm();

        $facebook = new FB();
        $form['url_facebook'] = $facebook->Login();

		/*
		$config = [
                "config"=>[
                    "title"=>"tilte",
                    "js"=>"",
                    "css"=>""],


                "data"=>[

                    "email"=>["type"=>"email","placeholder"=>"Votre email", "required"=>true, "class"=>"form-control", "id"=>"email",
                        "error"=>"L'email n'est pas valide"],

                    "pwd"=>["type"=>"password","placeholder"=>"Votre mot de passe", "required"=>true, "class"=>"form-control", "id"=>"pwd",
                        "error"=>"Veuillez préciser un mot de passe"]


                ]

            ];
		*/

		$v = new View("addUser", "front");
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

	    if ($this->isConnected()){
	        $this->redirect();
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

                if ($this->isConnected()){
                    $this->redirect();
                }

            }

		}

		$v = new View("loginUser", "front");
		$v->assign("form", $form);

	}

    public function logoutAction(){

        unset($_SESSION['accesstoken']);
        unset($_SESSION['role']);
        session_destroy();
        header("Location: /");

    }

    public function isConnected(){

        //Vérifier que les variables de sessions existent
        if( !empty($_SESSION["accesstoken"]) && !empty($_SESSION["email"])){

            //Si oui se connecter a la base et vérifier qu'un utilisateur correspond
            $query = $this->pdo->prepare(" SELECT id FROM Users WHERE email=:titi AND accesstoken=:tutu AND status=1");
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

    public function redirect(){
        $query = $this->pdo->prepare("SELECT role FROM Users WHERE email=:tutu ");
        $query->execute([ "tutu"=>$_SESSION['email'] ]);

        $role = $query->fetch();

        switch ($role['role']){
            case 1:
                $config = [
                    "isConnected"=>true,
                    'client'=>true,
                    "admin"=> false,
                    "pro"=> false,
                ];

                break;

            case 2:
                $config = [
                    "isConnected"=>true,
                    'client'=>false,
                    "admin"=> false,
                    "pro"=> true,
                ];
                break;

            case 3:
                $config = [
                    "isConnected"=>true,
                    'client'=>false,
                    "admin"=> true,
                    "pro"=> false,
                ];
                break;
        }
        $_SESSION['role'] = $config;
        $v = new View("homepage", "front");
        $v->assign("config", $config);
        exit();
    }


	public function forgetPasswordAction(){
	
		$v = new View("forgetPasswordUser", "front");
		
	}
}