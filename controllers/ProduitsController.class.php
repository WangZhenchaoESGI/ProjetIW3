<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Core\View;
use Models\Users;
use Models\restaurant;
use Models\dishes;

class ProduitsController extends BaseSQL{

    public function getAllProduits($id): array {

        $sql = " SELECT * FROM dishes where id_restaurant=".$id;
        $query = $this->pdo->query($sql);

        return $query->fetchAll();

    }

    public function defaultAction(): void {

        if ($this->isConnected() == false){
            header("Location: /");
        }
        //Info Restaurateur
        $user = new Users();
        $u = $user->getOneBy(["email"=>$_SESSION['email']],false);

        $restaurant = new restaurant();
        $r = $restaurant->getOneBy(["id_user"=>$u['id']],false);

        if (empty($r)) header("Location: /design");

        //afficher tous les produits du restaurant
        $dishes = $this->getAllProduits($r['id']);

        $v = new View("produits", "back");
        $v->assign("dishes",$dishes);

    }

    public function addAction(): void {

        if ($this->isConnected() == false){
            header("Location: /");
        }

        //Info Restaurateur
        $user = new Users();
        $u = $user->getOneBy(["email"=>$_SESSION['email']],false);

        $restaurant = new restaurant();
        $r = $restaurant->getOneBy(["id_user"=>$u['id']],false);

        $form['action'] = "save_produit?id_restaurant=".$r["id"];

        $v = new View("addProduit", "back");
        $v->assign("form", $form);
    }

    public function saveAction(): void {

        if ($this->isConnected() == false){
            header("Location: /");
        }

        if (!empty($_POST)){

            //Info Restaurateur

            if (isset($_GET['id'])){
                $dishe = new dishes();
                $d = $dishe->getOneBy(["id"=>$_GET['id']],false);
                $_POST['image'] = $d['image'];
            }

            $produit = new dishes();

            if (isset($_FILES['photo']['name']) && !empty($_FILES['photo']['name']) ){
                $allowedExts = array("gif", "jpeg", "jpg", "png");
                $temp = explode(".", $_FILES["photo"]["name"]);
                $extension1 = end($temp);     // 获取文件后缀名
                if (
                    (($_FILES["photo"]["type"] == "image/gif")
                        || ($_FILES["photo"]["type"] == "image/jpeg")
                        || ($_FILES["photo"]["type"] == "image/jpg")
                        || ($_FILES["photo"]["type"] == "image/pjpeg")
                        || ($_FILES["photo"]["type"] == "image/x-png")
                        || ($_FILES["photo"]["type"] == "image/png"))
                    && ($_FILES["photo"]["size"] < 104857600)   // 小于 200 kb
                    && in_array($extension1, $allowedExts)
                ) {

                    $photo = md5(substr(uniqid().time(), 4, 10)."mxu(4il");

                    $_FILES["photo"]["name"]=$photo.".".$extension1;
                    move_uploaded_file($_FILES["photo"]["tmp_name"], "/var/www/ProjetAnnuel/public/upload/".$_FILES["photo"]["name"]);
                    $_POST['image'] = $_FILES["photo"]["name"];
                }
            }

            //Get ID restaurateur
            if (isset($_GET['id'])){
                $produit->setId($_GET['id']);
            }
            $produit->setName($_POST['name']);
            $produit->setContenu($_POST['contenu']);
            $produit->setPrice($_POST['price']);
            $produit->setImage($_POST['image']);
            $produit->setIdRestaurant($_GET['id_restaurant']);
            $produit->setStatus(1);
            $produit->save();

            header("Location: /produits");
        }else{
            $this->addAction();
        }

    }

    public function updateAction(): void {

        if ($this->isConnected() == false){
            header("Location: /");
        }

        //Info Restaurateur
        $dishe = new dishes();
        $d = $dishe->getOneBy(["id"=>$_GET['id']],false);

        $form['action'] = "save_produit?id_restaurant=".$d["id_restaurant"]."&id=".$d["id"];
        $form['produit'] = $d;

        $v = new View("addProduit", "back");
        $v->assign("form", $form);
    }

    public function deleteAction(): void {

        if ( $this->isConnected() ){
            if (isset($_POST['id'])){
                $dishe = new dishes();
                $dishe->delete(["id"=>$_POST['id']]);
            }
        }
    }

    public function enableAction(): void {

        if ( $this->isConnected() ){
            if (isset($_POST['id'])){
                $dishe = new dishes();
                $d = $dishe->getOneBy(["id"=>$_POST['id']]);

                if ($d['status']==1){
                    $this->pdo->query("UPDATE dishes SET status=0 WHERE id=".$_POST['id']);
                    echo 0;
                }else{
                    $this->pdo->query("UPDATE dishes SET status=1 WHERE id=".$_POST['id']);
                    echo 1;
                }
            }
        }
    }

    public function isConnected(): bool {
        $user = new \Controller\UsersController();

        if ($user->isConnected() && ($user->role() == 2 || $user->role() == 3)) return true;

        return false;
    }

}