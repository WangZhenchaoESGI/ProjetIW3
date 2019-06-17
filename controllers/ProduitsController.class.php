<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Core\FB;
use Core\View;
use Models\Users;
use Models\restaurant;
use Models\category;
use Models\fonts;
use Models\dishes;
use Models\address;
use Core\Routing;
use Core\Validator;
use Core\Validator_login;
use Core\Mail;
use Controller\PagesController;
use Controller\FacebookController;
use Controller\UsersController;

class ProduitsController extends BaseSQL{

    public function getAllProduits($id){

        $sql = " SELECT * FROM dishes where id_restaurant=".$id;
        $query = $this->pdo->query($sql);

        return $query->fetchAll();

    }

    public function defaultAction(){

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

    public function addAction(){

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

    public function saveAction(){

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

    public function updateAction(){

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

    public function deleteAction(){

        if ($this->isConnected() == false){
            header("Location: /");
        }

        if (isset($_GET['id'])){
            $dishe = new dishes();
            $dishe->delete(["id"=>$_GET['id']]);
        }
        header("Location: /produits");
    }

    public function isConnected(){

        //Vérifier que les variables de sessions existent
        if( !empty($_SESSION["accesstoken"]) && !empty($_SESSION["email"])){

            //Si oui se connecter a la base et vérifier qu'un utilisateur correspond
            $query = $this->pdo->prepare(" SELECT id FROM Users WHERE email=:titi AND accesstoken=:tutu AND status=1 AND role=2");
            $query->execute(["titi"=>$_SESSION["email"], "tutu"=>$_SESSION["accesstoken"]]);
            $result = $query->fetch();
            //Si oui regenerer un accesstoken et retourner vrai
            if( !empty($result)){
                $_SESSION["accesstoken"] = $this->generateAccessToken($_SESSION["email"]);
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