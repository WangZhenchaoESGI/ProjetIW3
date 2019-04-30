<?php

declare(strict_types=1);

namespace Controller;
use Core\View;
use Models\Users;
use Core\Routing;
use Core\Validator;
use Core\Validator_login;
use Core\Mail;
use Controller\PagesController;

class UsersController{

	public function defaultAction(){
		echo "users default";
	}
	
	public function addAction(){
		$user = new Users();
		$form = $user->getRegisterForm();

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

		$user = new Users();
		$form = $user->getLoginForm();

		$method = strtoupper($form["config"]["method"]);
		$data = $GLOBALS["_".$method];
		if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){
			
			$validator = new Validator_login($form,$data);
			$form["errors"] = $validator->errors;

			if(empty($form["errors"])){

				//Connexion avec token
				//$token = md5(substr(uniqid().time(), 4, 10)."mxu(4il");

                /*
                 *  Après la vérification de connexion, redirect
                 */

                header("Location: /");
                exit();

            }

		}
	
		$v = new View("loginUser", "front");
		$v->assign("form", $form);
		
	}

    public function logoutAction(){

        unset($_SESSION['accesstoken']);
        header("Location: /");

    }


	public function forgetPasswordAction(){
	
		$v = new View("forgetPasswordUser", "front");
		
	}
}