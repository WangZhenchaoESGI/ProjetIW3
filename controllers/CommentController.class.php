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

    public function getAllComments($id):array {

        $sql = " SELECT comment.*,User.firstname FROM comment,Users where Users.id=comment.id_user AND comment.id_plat=".$id;
        $query = $this->pdo->query($sql);

        return $query->fetchAll();

    }

    public function defaultAction():void{

        if ($this->isConnected() == false){
            header("Location: /connexion");
        }

    }

    public function addAction():void{
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

    public function deleteAction():void{
        if ( (isset($_SESSION['role']['isConnected']) && $_SESSION['role']['isConnected']==true && $_SESSION['role']['admin']==true) ){
            if (isset($_POST['id'])){
                $comment = new comment();
                $comment->delete(["id"=>$_POST['id']]);
            }
        }
    }

    public function isConnected(): bool {
        $user = new \Controller\UsersController();

        if ($user->isConnected()) return true;

        return false;
    }

}