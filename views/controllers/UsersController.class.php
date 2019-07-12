<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Core\FB;
use Core\View;
use Models\Users;
use Core\Validator;
use Core\Validator_login;
use Core\Mail;

class UsersController extends BaseSQL{

	public function defaultAction(): void{
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

		$v = new View("addUser", "front");
		$v->assign("form", $form);
	}

	public function saveAction(): void{

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


	public function loginAction(): void{

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

	/*
	 * activer le compte depuis Email
	 */
	public function verificationAction(): void{
	    $sql = "UPDATE Users SET status=1 WHERE accesstoken='".$_GET['accesstoken']."';";
        $this->pdo->query($sql);
        $msg = "Votre compte de EatFood est bien activé!";
        $v = new View("success", "front");
        $v->assign("msg", $msg);
    }

    public function logoutAction(): void{

        unset($_SESSION['accesstoken']);
        unset($_SESSION['role']);
        session_destroy();
        header("Location: /");

    }

    public function isConnected(): bool {

        //Vérifier que les variables de sessions existent
        if( !empty($_SESSION["accesstoken"]) && !empty($_SESSION["email"])){

            //Si oui se connecter a la base et vérifier qu'un utilisateur correspond
            $query = $this->pdo->prepare(" SELECT id FROM Users WHERE email=:titi AND accesstoken=:tutu AND status=1");
            $query->execute(["titi"=>$_SESSION["email"], "tutu"=>$_SESSION["accesstoken"]]);
            $result = $query->fetch();
            //Si oui regenerer un accesstoken et retourner vrai
            if( !empty($result)){
                $_SESSION['id_user'] = $result['id'];
                $_SESSION["accesstoken"] = $this->generateAccessToken($_SESSION["email"]);
                return true;
            }
            return false;
        }
        //Sinon retourner faux
        return false;
    }

    public function changePasswordAction(){
	    if ($_POST['pwd1'] != $_POST['pwd2']){
	        $_SESSION['error'] = "Les mots de passe ne sont pas identique!";
        }else{
            $pwd = password_hash($_POST['pwd1'], PASSWORD_DEFAULT);
            $query = $this->pdo->prepare("Update Users set pwd=:pwd WHERE id = :id");
            $query->execute(["pwd"=>$pwd,"id"=>$_SESSION['id_user']]);
            $_SESSION['error'] = "Le nouveau mot de passe est enregistré!";
        }
        header("Location: /client");
    }

    public function generateAccessToken($email): string {
        //Générer un accesstoken
        $accesstoken = md5(substr(uniqid().time(), 4, 10)."mxu(4il");

        //Se connecter a la bdd
        //Mettre a jour l'utilisateur avec la nouvelle donnée
        $query = $this->pdo->prepare(" UPDATE Users SET accesstoken=:titi WHERE email=:tutu ");
        $query->execute(["titi"=>$accesstoken, "tutu"=>$email ]);

        return $accesstoken;
    }

    public function role(): int {
        $query = $this->pdo->prepare("SELECT role FROM Users WHERE email=:tutu ");
        $query->execute([ "tutu"=>$_SESSION['email'] ]);

        $role = $query->fetch();
        return intval($role['role']);
    }

    /*
     * recupre la role du user
     */
    public function redirect(): void{
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

	public function forgetPasswordAction(): void{
	
		$v = new View("forgetPasswordUser", "front");
		
	}
}