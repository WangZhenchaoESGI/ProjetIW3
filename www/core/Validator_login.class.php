<?php

declare(strict_types=1);

class Validator_login extends BaseSQL {

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

                //email - method
                if($info["type"]=="email" && !self::checkEmail($data[$name])){
                    $this->errors[]=$info["error"];
                }

                if($info["type"]=="password" && !self::checkPassword($data[$name],$data['email'])){
                    $this->errors[]=$info["error"];
                }

            }

        }

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

    public function checkPassword($password,$email){

        $query = $this->pdo->prepare("SELECT pwd FROM Users WHERE status=0 AND email=:titi");
        $query->execute( ["titi" => $email] );
        $result = $query->fetch();

        //Utiliser la fonction native de php
        // password_verify ( string $password , string $hash )
        if ( password_verify( $password ,  $result["pwd"] ) )
        {
            //$_SESSION["accesstoken"] = generateAccessToken($_POST['email']);

            $token = md5(substr(uniqid().time(), 4, 10)."mxu(4il");

            //Mettre a jour l'utilisateur avec la nouvelle donnée
            $query = $this->pdo->prepare(" UPDATE Users SET accesstoken=:titi WHERE email=:tutu ");
            $query->execute(["titi"=>$token, "tutu"=>$email ]);

            $_SESSION["email"] = $email;

            return true;
        }else{

            //Ouvrir le fichier texte
            $handle = fopen("log.txt", "a+");
            fwrite($handle, $_POST['email']." -> ".$_POST['pwd']."\r\n");
            fclose($handle);
            return false;
        }

    }



}


