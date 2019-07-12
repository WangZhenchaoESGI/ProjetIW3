<?php

declare(strict_types=1);

namespace Controller;

use Core\BaseSQL;
use Core\View;
use Models\restaurant;
use Models\livraison;

class AdminController extends BaseSQL{

    public function defaultAction(){
        $v = new View("dashboard", "back");
        $v->assign("pseudo","prof");
    }

    public function dashboardAction():void{
        if ($this->isConnected()) {
            $restaurant = new restaurant();
            $restaurant = $restaurant->getOneBy(['id_user'=>$_SESSION['id_user']],false);
            if (empty($restaurant)){
                header("Location: /design");
                exit();
            }else{
                if ($restaurant['status']==0){
                    $data['error'] = "Votre restaurant est fermé par Administrateur, Veuillez nous contacter, s'il vous plaît!";
                }
                // dashboard courbes
                $sql = "SELECT COUNT(id) as piece,DATE_FORMAT(date_inserted, '%Y-%m-%d') as month FROM livraison WHERE id_restaurant=".$restaurant['id']." GROUP BY DATE_FORMAT(date_inserted, '%Y-%m-%d')";
                $query = $this->pdo->query($sql);
                $data['courbes'] = $query->fetchAll();
                // dashboard la somme des plats du restaurant
                $sql = "SELECT COUNT(id) as total FROM dishes WHERE id_restaurant=".$restaurant['id'];
                $query = $this->pdo->query($sql);
                $total = $query->fetch();
                $data['total_plat'] = $total['total'];
                // la revenu du jour du restaurant
                $sql = "SELECT COUNT(id) as total, sum(montant) as montant FROM livraison WHERE id_restaurant=".$restaurant['id']." AND date_inserted >=  CURDATE()";
                $query = $this->pdo->query($sql);
                $total = $query->fetch();
                $data['total_livraison'] = $total['total'];
                $data['total_montant'] = $total['montant'];
                // la total de revenu du restaurant
                $sql = "SELECT sum(montant) as montant FROM livraison WHERE id_restaurant=".$restaurant['id'];
                $query = $this->pdo->query($sql);
                $total = $query->fetch();
                $data['total'] = $total['montant'];
                // la statistique du jour
                $sql ="SELECT COUNT(livraison.id) as total, sum(livraison.montant) as montant, method.name FROM livraison,method WHERE livraison.id_method=method.id AND livraison.id_restaurant=".$restaurant['id']." AND livraison.date_inserted >=CURDATE() GROUP BY livraison.id_method";
                $query = $this->pdo->query($sql);
                $s= $query->fetchAll();
                $data['statistique'] = $s;
                $v = new View("dashboard", "back");
                $v->assign("data",$data);
            }
        }else{
            header("Location: /connexion");
        }
    }

    public function produitsAction():void{
        $v = new View("produits", "back");
        $v->assign("pseudo","prof");
    }

    public function commandesAction():void{
        if ($this->isConnected()) {
            $restaurant = new restaurant();
            $restaurant = $restaurant->getOneBy(['id_user'=>$_SESSION['id_user']],false);
            $sql = "SELECT livraison.*,address.name as name,address.phone as phone FROM livraison,address WHERE livraison.id_restaurant =:id AND livraison.code=address.code ORDER BY livraison.id DESC ";
            $query = $this->pdo->prepare($sql);
            $query->execute(['id'=>$restaurant['id']]);
            $data = $query->fetchAll();
            $v = new View("commandes", "back");
            $v->assign("commandes",$data);
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
                    $sql = "UPDATE livraison SET vue=1 WHERE code=:code";
                    $query = $this->pdo->prepare($sql);
                    $query->execute(['code'=>$_GET['code']]);
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
        if ($user->isConnected() && ( $user->role()==2 ||  $user->role()==3 ) ) return true;
        return false;
    }
}