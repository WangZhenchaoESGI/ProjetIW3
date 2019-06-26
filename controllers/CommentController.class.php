<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Core\FB;
use Core\View;
use Models\comment;
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

class CommentController extends BaseSQL{

    public function getAllComments($id){

        $sql = " SELECT comment.*,User.firstname FROM comment,Users where Users.id=comment.id_user AND comment.id_plat=".$id;
        $query = $this->pdo->query($sql);

        return $query->fetchAll();

    }

    public function defaultAction(){

        if ($this->isConnected() == false){
            header("Location: /connexion");
        }

    }

    public function addAction(){
        if ($this->isConnected() == false){
            header("Location: /connexion");
            exit();
        }else{
            $comment = new comment();
            $comment->setIdUser($_SESSION['id_user']);
            $comment->setIdRestaurant($_GET['id_restaurant']);
            $comment->setIdPlat($_GET['id_plat']);
            $comment->setStar($_POST['rate']);
            $comment->setContenu($_POST['comment']);
            $comment->save();

            header("Location: /plat?id=".$_GET['id_plat']);
            exit();
        }
    }

    public function saveAction(){

    }

    public function updateAction(){

    }

    public function deleteAction(){
        if ( (isset($_SESSION['role']['isConnected']) && $_SESSION['role']['isConnected']==true && $_SESSION['role']['admin']==true) ){
            if (isset($_POST['id'])){
                $comment = new comment();
                $comment->delete(["id"=>$_POST['id']]);
            }
        }
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