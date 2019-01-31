<?php
class Validator{

    public function __construct( $config, $data )
    {

        //1er vérification : le nb de champs
        if ( count($data) != count($config["data"]) ){
            die("Tentative : faille XSS");
        }

        $errors = [];

        foreach ( $config["data"] as $name => $info ) {

            //Isset
            if ( !isset($data[$name]) ){

            }else{

                //!empty if required - method
                if ( $info["required"]??false && !self::notEmpty( $data[$name] ) ){

                }

                //minlength - method

                //maxlength - method

                //email - method

                //password : maj min et chiffres - method

                //confirm - method
                if ( isset($data[$info["confirm"]]) && $data["name"] !=  $data[$info["confirm"]] ){

                }

            }

        }

        return $errors;

    }

    public static function notEmpty( $string ){
        return !empty( trim( $string ) );
    }

    public static function minLength($string,$lenght){
        return strlen( trim($string) ) >= $lenght;
    }

    public static function maxLength($string,$lenght){
        return strlen( trim($string) ) <= $lenght;
    }

    public static function checkEmail($string){
        return filter_var($string,FILTER_VALIDATE_EMAIL);
    }

    public static function checkPassword($string){
        return (
                preg_match("#[a-z]#",$string) &&
                preg_match("#[A-Z]#",$string) &&
                preg_match("#[0-9]#",$string)
                );
    }
}