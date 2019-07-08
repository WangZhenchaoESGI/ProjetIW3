<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Models\comment;

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
            if (empty($_POST['rate']) || !isset($_POST['rate'])){
                $_POST['rate'] = 0;
            }
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
        if (isset($_POST['id'])){
            $sql = " SELECT * FROM comment where comment.id=".$_POST['id'];
            $query = $this->pdo->query($sql);
            $res = $query->fetch();

            if (!empty($res)){
                if ( (isset($_SESSION['role']['isConnected']) && $_SESSION['role']['isConnected']==true && ($_SESSION['role']['admin']==true || $res['id_user'] == $_SESSION['id_user'])) ){
                    $comment = new comment();
                    $comment->delete(["id"=>$_POST['id']]);
                }
            }

        }
    }

    public function isConnected(): bool {
        $user = new \Controller\UsersController();

        if ($user->isConnected()) return true;

        return false;
    }

}