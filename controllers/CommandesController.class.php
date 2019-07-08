<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Core\View;
use Models\comment;
use Models\dishes;
use Models\method;
use Models\Users;
use Models\restaurant;
use Models\category;
use Models\fonts;
use Models\address;
use Models\livraison;
use Models\list_dishes_delivery;
use Core\Routing;
use Core\Validator;
use Core\Validator_login;
use Core\Mail;
use Controller\PagesController;
use Controller\FacebookController;
use Controller\UsersController;
use Controller\CommentController;

class CommandesController extends BaseSQL {

    public function defaultAction():void{

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

    public function addAction():void{
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

    public function removeAction():void{
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


    public function panierRemoveAction():void{
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

    public function saveAction():void{
        //generation le code pour lier Livraison list_dishes_delivery address
        $code = md5(substr(uniqid().time(), 4, 10)."mxu(4il");
        $total_price = 0;

        foreach ($_SESSION["cart_item"] as $item){
            $total_price += ($item["price"]*$item["quantity"]);

            $dishes = new list_dishes_delivery();
            $dishes->setIdDishes($item["id"]);
            $dishes->setCode($code);
            $dishes->save();
        }

        $livraison = new livraison();
        $livraison->setMontant($total_price);
        $livraison->setIdMethod($_POST['method']);
        $livraison->setIdRestaurant($_SESSION['id_restaurant']);
        $livraison->setIdClient($_SESSION['id_user']);
        $livraison->setStatus(2);
        $livraison->setCode($code);
        $livraison->save();

        $address = new address();
        $address->setCode($code);
        $address->setName($_POST['nom']);
        $address->setAddresse($_POST['address']);
        $address->setCity($_POST['ville']);
        $address->setPostal($_POST['cp']);
        $address->setPhone($_POST['tel']);
        $address->save();

        unset($_SESSION["cart_item"]);
        unset($_SESSION['id_restaurant']);

        header("Location: /commande_success");
    }

    public function successAction():void{
        $msg = "Votre commande est bien enregistré, on va livrer tout de suite !";
        $v = new View("success", "template1");
        $v->assign("msg",$msg);
    }

    public function emptyAction():void{
        unset($_SESSION["cart_item"]);
        header("Location: /plat?id=".$_GET['idPlat']);
    }

    public function isConnected(): bool {
        $user = new \Controller\UsersController();

        if ($user->isConnected()) return true;

        return false;
    }
}