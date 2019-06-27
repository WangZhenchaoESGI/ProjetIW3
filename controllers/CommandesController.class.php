<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Core\FB;
use Core\View;
use Models\comment;
use Models\dishes;
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
        header("Location: /plat?id=".$_GET['idPlat']);

    }

    public function emptyAction(){
        unset($_SESSION["cart_item"]);
    }

}