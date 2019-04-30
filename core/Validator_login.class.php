<?php

declare(strict_types=1);

namespace Core;

class Validator_login extends BaseSQL {

    public $errors = [];

    //6LcZeZwUAAAAAPvv5wWfGBUP_5pbuXDxEHBDppbY
    //6LcZeZwUAAAAALNsF31A4rro-8cis4CBdQkn524z
    public function __construct( $config, $data ){

        parent::__construct();
        //1er vérification : le nb de champs
        if(count($data) != (count($config["data"])+1)){
            die("Tentative : faille XSS");
        }

        if( !self::checkCaptchat($data['g-recaptcha-response'])){
            $this->errors[]='Veuillez bien cocher le captcha !';
        }

        foreach ($config["data"] as $name => $info) {

            //Isset
            if( !isset($data[$name] )){
                die("Tentative : faille XSS");
            }else{

                //email - method
                if($info["type"]=="email" && !self::checkEmail($data[$name])){
                    $this->errors[]=$info["error"];
                }elseif($info["type"]=="email" && !self::checkStatus($data[$name])){
                    $this->errors[] = "Veuillez activer votre compte !";
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

    public function checkCaptchat($data){
        // Ma clé privée
        $secret = "6LcZeZwUAAAAALNsF31A4rro-8cis4CBdQkn524z";
        // Paramètre renvoyé par le recaptcha
        $response = $data;
        // On récupère l'IP de l'utilisateur
        $remoteip = $_SERVER['REMOTE_ADDR'];

        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
            . $secret
            . "&response=" . $response
            . "&remoteip=" . $remoteip ;

        $decode = json_decode(file_get_contents($api_url), true);

        if ($decode['success'] == true) {
            return true;
        }

        return false;
    }

    public function checkPassword($password,$email){

        $query = $this->pdo->prepare("SELECT pwd FROM Users WHERE email=:titi");
        $query->execute( ["titi" => $email] );
        $result = $query->fetch();

        //Utiliser la fonction native de php
        // password_verify ( string $password , string $hash )
        if ( !empty($result) && password_verify( $password ,  $result["pwd"] ) )
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

    public function checkStatus($email)
    {

        $query = $this->pdo->prepare("SELECT status FROM Users WHERE email=:titi");
        $query->execute(["titi" => $email]);
        $result = $query->fetch();

        //Utiliser la fonction native de php
        // password_verify ( string $password , string $hash )
        if (!empty($result) && $result['status']==1) {
            return true;
        }

        return false;

    }

}


