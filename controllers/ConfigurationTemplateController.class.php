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
use Models\address;
use Core\Routing;
use Core\Validator;
use Core\Validator_login;
use Core\Mail;
use Controller\PagesController;
use Controller\FacebookController;
use Controller\UsersController;

class ConfigurationTemplateController extends BaseSQL{

    public function defaultAction(){

        if ($this->isConnected() == false){
            header("Location: /");
        }
        //Info Restaurateur
        $user = new Users();
        $u = $user->getOneBy(["email"=>$_SESSION['email']],false);

        $design = new restaurant();
        $a=$design->getOneBy(["id_user"=>$u['id']],false);

        //Ajouter or Modifier Le desgin de Restaurant
        if (empty($a)){
            $this->addAction();
        }else{

            $category = new category();
            $c = $category->getOneBy(["id"=>$a['id_category']],false);

            $fonts = new fonts();
            $f = $fonts->getOneBy(["id"=>$a['id_fonts']],false);

            $data['restaurant'] = $a;
            $data['category'] = $c;
            $data['fonts'] = $f;

            $v = new View("design", "back");
            $v->assign("data", $data);
        }

    }

    public function addAction(){

        $category = new category();
        $c = $category->getAll();

        $fonts = new fonts();
        $f = $fonts->getAll();

        $form['category'] = $c;
        $form['fonts'] = $f;
        $form['action'] = "save_design";

        $v = new View("addDesign", "back");
        $v->assign("form", $form);
    }

    public function saveAction(){

        if (!empty($_POST)){

            //Get ID restaurateur
            $user = new Users();
            $where = [ "email"=>$_SESSION['email'] ];
            $infoUser = $user->getOneBy($where,false);

            $restaurant = new restaurant();

            if (isset($_GET['id'])) {
                $d = $restaurant->getOneBy(["id"=>$_GET['id']],false);
                $_POST['image'] = $d['image'];
            }


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

            if (isset($_GET['id'])){
                $_POST['id'] = $_GET['id'];
                $restaurant->setId($_POST['id']);
            }
            $restaurant->setName($_POST['name']);
            $restaurant->setDescription($_POST['description']);
            $restaurant->setIdCategory($_POST['id_category']);
            $restaurant->setIdTemplate($_POST['template']);
            $restaurant->setIdFonts($_POST['id_fonts']);
            $restaurant->setImage($_POST['image']);
            $restaurant->setButton($_POST['button']);
            $restaurant->setText($_POST['text']);
            $restaurant->setIdUser($infoUser['id']);
            $restaurant->setStatus(1);
            $restaurant->save();

            header("Location: /design");
        }else{
            $this->addAction();
        }

    }

    public function updateAction(){

        if ($this->isConnected() == false){
            header("Location: /");
        }
        //Info Restaurateur
        $user = new Users();
        $u = $user->getOneBy(["email"=>$_SESSION['email']],false);

        $design = new restaurant();
        $a=$design->getOneBy(["id_user"=>$u['id']],false);

        $category = new category();
        $c = $category->getAll();

        $fonts = new fonts();
        $f = $fonts->getAll();

        $form['restaurant'] = $a;
        $form['category'] = $c;
        $form['fonts'] = $f;
        $form['action'] = "save_design?id=".$a['id'];

        $v = new View("addDesign", "back");
        $v->assign("form", $form);
    }

    public function redirectAction(){

        if ($this->isConnected() == false){
            header("Location: /");
        }
        //Info Restaurateur
        $user = new Users();
        $u = $user->getOneBy(["email"=>$_SESSION['email']],false);

        $design = new restaurant();
        $a=$design->getOneBy(["id_user"=>$u['id']],false);

        header("Location: /template?id=".$a['id']);
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