<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Core\FB;
use Core\View;
use Models\comment;
use Models\dishes;
use Models\method;
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
use Controller\CommentController;

class CommandesController extends BaseSQL {

    public function defaultAction(){

        if ($this->isConnected()){
            if(!empty($_SESSION["cart_item"])) {

                $paiement = new method();
                $p = $paiement->getAll();

                $v = new View("panier", "front");
                $v->assign("method",$p);

            }else{
                header("Location: /template");
            }
        }else{
            header("Location: /connexion");
        }
    }

    public function addAction(){
        if(!empty($_POST["quantity"])) {
            $dishs = new dishes();
            $d = $dishs->getOneBy(['id'=>$_GET['id']],false);
            $itemArray = array(
                "a".$_GET['id']=>array(
                    'id'=>$d["id"],
                    'name'=>$d["name"],
                    'description'=>$d["contenu"],
                    'quantity'=>$_POST["quantity"],
                    'price'=>$d["price"],
                    'image'=>$d["image"]
                )
            );

            //véfier si le meme restaurant
            if (isset($_SESSION['id_restaurant'])){
                if ($_SESSION['id_restaurant'] != $_GET['id_restaurant']){
                    unset($_SESSION["cart_item"]);
                    $_SESSION['id_restaurant'] = $_GET['id_restaurant'];
                }
            } else{
                $_SESSION['id_restaurant'] = $_GET['id_restaurant'];
            }

            if(!empty($_SESSION["cart_item"])) {
                if(in_array("a".$d["id"],array_keys($_SESSION["cart_item"]))) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                        if("a".$d["id"] == $k) {
                            if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                $_SESSION["cart_item"][$k]["quantity"] = 0;
                            }
                            $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                        }
                    }
                } else {
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                }
            } else {
                $_SESSION["cart_item"] = $itemArray;
            }

            $_SESSION['display_success'] = true;
        }
        /*
        echo "<pre>";
        print_r($_SESSION['cart_item']);
        */
        header("Location: /plat?id=".$_GET['id']);
    }

    public function removeAction(){
        if(!empty($_SESSION["cart_item"])) {
            foreach($_SESSION["cart_item"] as $k => $v) {
                if("a".$_GET["id"] == $k)
                    unset($_SESSION["cart_item"][$k]);
                if(empty($_SESSION["cart_item"]))
                    unset($_SESSION["cart_item"]);
            }
        }
        if(!empty($_SESSION["cart_item"])) {
            $_SESSION['display_success'] = true;
        }

        header("Location: /plat?id=".$_GET['id']);
    }


    public function panierRemoveAction(){
        if(!empty($_SESSION["cart_item"])) {
            foreach($_SESSION["cart_item"] as $k => $v) {
                if("a".$_GET["id"] == $k)
                    unset($_SESSION["cart_item"][$k]);
                if(empty($_SESSION["cart_item"]))
                    unset($_SESSION["cart_item"]);
            }
        }

        header("Location: /panier");
    }

    public function emptyAction(){
        unset($_SESSION["cart_item"]);
        header("Location: /plat?id=".$_GET['idPlat']);
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
                $_SESSION["id_user"] = $result['id'];
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