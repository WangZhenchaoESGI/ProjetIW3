<?php

declare(strict_types=1);

class Users extends BaseSQL{

	public $id = null;
	public $firstname;
	public $lastname;
	public $email;
	public $pwd;
	/*
	 * Role 1 => Client
	 * ROle 2 => Restaurateur
	 * Role 3 => Admin
	 */
	public $role=1;

	//Après la vérification de mail, on update status de 0 à 1
	public $status=0;
	public $accesstoken;

	public function __construct(){
		parent::__construct();
	}


	public function setFirstname($firstname){
		$this->firstname = ucwords(strtolower(trim($firstname)));
	}
	public function setLastname($lastname){
		$this->lastname = strtoupper(trim($lastname));
	}
	public function setEmail($email){
		$this->email = strtolower(trim($email));
	}
	public function setPwd($pwd){
		$this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
	}
	public function setRole($role){
		$this->role = $role;
	}
	public function setStatus($status){
		$this->status = $status;
	}

	public function setAccesstoken($accesstoken){
	    $this->accesstoken = $accesstoken;
    }

	public function getRegisterForm(){
		return [
					"config"=>[ 
						"method"=>"POST", 
						"action"=>Routing::getSlug("Users", "save"), 
						"class"=>"", 
						"id"=>"",
						"submit"=>"S'inscrire",
						"reset"=>"Annuler" ],


					"data"=>[

							"firstname"=>[
								"type"=>"text",
								"placeholder"=>"Votre Prénom", 
								"required"=>true, 
								"class"=>"form__input form-control",
								"id"=>"firstname",
								"minlength"=>2,
								"maxlength"=>50,
								"error"=>"Le prénom doit faire entre 2 et 50 caractères"
							],

							"lastname"=>["type"=>"text","placeholder"=>"Votre nom", "required"=>true, "class"=>"form__input form-control", "id"=>"lastname","minlength"=>2,"maxlength"=>100,
								"error"=>"Le nom doit faire entre 2 et 100 caractères"],

							"email"=>["type"=>"email","placeholder"=>"Votre email", "required"=>true, "class"=>"form__input form-control", "id"=>"email","maxlength"=>250,
								"error"=>"L'email n'est pas valide ou il dépasse les 250 caractères"],

							"pwd"=>["type"=>"password","placeholder"=>"Votre mot de passe", "required"=>true, "class"=>"form__input form-control", "id"=>"pwd","minlength"=>6,
								"error"=>"Le mot de passe doit faire au minimum 6 caractères avec des minuscules, majuscules et chiffres"],

							"pwdConfirm"=>["type"=>"password","placeholder"=>"Confirmation", "required"=>true, "class"=>"form__input form-control", "id"=>"pwdConfirm", "confirm"=>"pwd", "error"=>"Les mots de passe ne correspondent pas"]

					]

				];
	}

	public function getLoginForm(){
		return [
					"config"=>[ 
						"method"=>"POST", 
						"action"=>"", 
						"class"=>"", 
						"id"=>"",
						"submit"=>"Se connecter",
						"reset"=>"Annuler" ],


					"data"=>[

							"email"=>["type"=>"email","placeholder"=>"Votre email", "required"=>true, "class"=>"form-control", "id"=>"email",
								"error"=>"L'email n'est pas valide"],

							"pwd"=>["type"=>"password","placeholder"=>"Votre mot de passe", "required"=>true, "class"=>"form-control", "id"=>"pwd",
								"error"=>"Veuillez préciser un mot de passe"]


					]

				];
	}


    public function save_user(){

        //Array ( [id] => [firstname] => Yves [lastname] => SKRZYPCZYK [email] => y.skrzypczyk@gmail.com [pwd] => $2y$10$tdmxlGf.zP.3dd7K/kRtw.jzYh2CnSbFuXaUkDNl3JtDJ05zCI7AG [role] => 1 [status] => 0 [pdo] => PDO Object ( ) [table] => Users )
        $dataObject = get_object_vars($this);
        //Array ( [id] => [firstname] => Yves [lastname] => SKRZYPCZYK [email] => y.skrzypczyk@gmail.com [pwd] => $2y$10$tdmxlGf.zP.3dd7K/kRtw.jzYh2CnSbFuXaUkDNl3JtDJ05zCI7AG [role] => 1 [status] => 0)
        $dataChild = array_diff_key($dataObject, get_class_vars(get_class()));

        if( is_null($dataChild["id"])){
            //INSERT
            //array_keys($dataChild) -> [id, firstname, lastname, email]
            $sql ="INSERT INTO ".$this->table." ( ".
                implode(",", array_keys($dataChild) ) .") VALUES ( :".
                implode(",:", array_keys($dataChild) ) .")";

            $query = $this->pdo->prepare($sql);
            $query->execute( $dataChild );

        }else{
            //UPDATE
            $sqlUpdate = [];
            foreach ($dataChild as $key => $value) {
                if( $key != "id")
                    $sqlUpdate[]=$key."=:".$key;
            }

            $sql ="UPDATE ".$this->table." SET ".implode(",", $sqlUpdate)." WHERE id=:id";

            $query = $this->pdo->prepare($sql);
            $query->execute( $dataChild );

        }

    }

}




