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

class AdminController extends BaseSQL{
    public function defaultAction(){
        $v = new View("dashboard", "back");
        $v->assign("pseudo","prof");
    }

    public function dashboardAction(){
        $v = new View("dashboard", "back");
        $v->assign("pseudo","prof");
    }

    public function produitsAction(){
        $v = new View("produits", "back");
        $v->assign("pseudo","prof");
    }

    public function commandesAction():void{
        if ($this->isConnected()) {

            $restaurant = new restaurant();
            $restaurant = $restaurant->getOneBy(['id_user'=>$_SESSION['id_user']],false);
            $sql = "SELECT livraison.*,address.* FROM livraison,address WHERE livraison.id_restaurant =:id AND livraison.code=address.code";
            //$sql2 = "SELECT * FROM address WHERE code=:code";
            //$sql3 = "SELECT list_dishes_delivery.*,dishes.* FROM list_dishes_delivery,dishes WHERE list_dishes_delivery.code=:code AND list_dishes_delivery.id_dishes = dishes.id";

            $query = $this->pdo->prepare($sql);
            $query->execute(['id'=>$restaurant['id']]);

            $v = new View("commandes", "back");
            $v->assign("commandes",$query->fetchAll());

        }else{
            header("Location: /connexion");
        }
    }

    public function commandeDetailAction():void{
        if ($this->isConnected()) {

            if (isset($_GET['code'])){

                $restaurant = new restaurant();
                $restaurant = $restaurant->getOneBy(['id_user'=>$_SESSION['id_user']],false);

                $livraison = new livraison();
                $livraison = $livraison->getOneBy(['code'=>$_GET['code']],false);

                if ($restaurant['id']==$livraison['id_restaurant']){

                    $sql2 = "SELECT * FROM address WHERE code=:code";
                    $sql3 = "SELECT list_dishes_delivery.*,dishes.* FROM list_dishes_delivery,dishes WHERE list_dishes_delivery.code=:code AND list_dishes_delivery.id_dishes = dishes.id";

                    $query = $this->pdo->prepare($sql2);
                    $query->execute(['code'=>$_GET['code']]);
                    $address = $query->fetch();

                    $query = $this->pdo->prepare($sql3);
                    $query->execute(['code'=>$_GET['code']]);
                    $dishes = $query->fetchAll();

                    $data['livraison'] = $livraison;
                    $data['address'] = $address;
                    $data['dishes'] = $dishes;

                    $v = new View("commandesDetail", "back");
                    $v->assign("data",$data);
                }else{
                    header("Location: /commandes");

                }

            }else{
                header("Location: /commandes");
            }

        }else{
            header("Location: /connexion");
        }
    }

    public function isConnected(): bool {
        $user = new \Controller\UsersController();

        if ($user->isConnected() && ( $user->role()==2 || $user->role()==3 ) ) return true;

        return false;
    }


}