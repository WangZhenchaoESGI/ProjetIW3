<?php
class Validator extends BaseSQL {

	public $errors = [];

	public function __construct( $config, $data ){

	    parent::__construct();
	    //1er vérification : le nb de champs
		if(count($data) != count($config["data"])){
			die("Tentative : faille XSS");
		}

		foreach ($config["data"] as $name => $info) {

			//Isset
			if( !isset($data[$name] )){
				die("Tentative : faille XSS");
			}else{

				//!empty if required - method
				if( ($info["required"]??false) && !self::notEmpty( $data[$name] ) ){
					$this->errors[]=$info["error"];
				}


				//minlength  - method
				if(isset($info["minlength"]) && !self::minLength($data[$name], $info["minlength"])){
					$this->errors[]=$info["error"];
				}

				//maxlength - method
				if(isset($info["maxlength"]) && !self::maxLength($data[$name], $info["maxlength"])){
					$this->errors[]=$info["error"];
				}

				//email - method
				if($info["type"]=="email" && !self::checkEmail($data[$name])){
					$this->errors[]=$info["error"];
				}

                //email - exist
                if($info["type"]=="email" && self::emailExist($data[$name]) == true){
                    $this->errors[]="L'email est déjà inscrit";
                }

				//confirm 
				if(isset($info["confirm"]) && $data[$name] != $data[$info["confirm"]]){
					$this->errors[]=$info["error"];
				}
				//password : maj min et chiffres - method
				else if($info["type"]=="password" && !self::checkPassword($data[$name])){
					$this->errors[]=$info["error"];
				}

			}

		}

	}


	public static function notEmpty($string){
		return !empty(trim($string));
	} 

	public static function minLength($string, $length){
		return strlen(trim($string))>=$length;
	} 

	public static function maxLength($string, $length){
		return strlen(trim($string))<=$length;
	}

	public static function checkEmail($string){
		return filter_var(trim($string), FILTER_VALIDATE_EMAIL);
	}

    public function emailExist( $email ){

        //Préparation de la requête
        $query = $this->pdo->prepare(" SELECT * FROM Users WHERE email = :titi");
        $query->execute( [ "titi" => $email] );
        $result = $query->fetch();

        if( empty($result) ){
            return false;
        }else{
            return true;
        }
    }

	public static function checkPassword($string){
		return (
					preg_match("#[a-z]#", $string) && 
					preg_match("#[A-Z]#", $string) && 
					preg_match("#[0-9]#", $string));
	}



}


