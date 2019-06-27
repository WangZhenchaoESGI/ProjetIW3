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

class TemplateController extends BaseSQL {

    public function defaultAction(){

        if (isset($_GET['id'])){
            $design = new restaurant();
            $a = $design->getOneBy(['id'=>$_GET['id']],false);

            if (empty($a)){
                $design = new restaurant();
                $a=$design->getAll();

                $v = new View("templateCarte", "front");
                $v->assign("resto",$a);
            }

            //dishes
            $d = $this->getAllDishes($_GET['id']);

            $fonts = new fonts();
            $f = $fonts->getOneBy(['id'=>$a['id_fonts']],false);

            $resto['restaurant'] = $a;
            $resto['dishes'] = $d;
            $resto['fonts'] = $f;

            switch ($a['template']){
                case 1:
                    $v = new View("template", "template1");
                    break;
                case 2:
                    $v = new View("template", "template2");
                    break;
                default:
                    $v = new View("template", "template1");
                    break;

            }

            $v->assign("resto",$resto);
        }else{
            $design = new restaurant();
            $a=$design->getAll();

            $v = new View("templateCarte", "front");
            $v->assign("resto",$a);
        }

    }

    public function getAllComments($id){

        $sql = " SELECT comment.*,Users.firstname FROM comment,Users where Users.id=comment.id_user AND comment.id_plat=".$id;
        $query = $this->pdo->query($sql);

        return $query->fetchAll();

    }

    public function getAllDishes($id){

        $sql = " SELECT * FROM dishes where id_restaurant=".$id;
        $query = $this->pdo->query($sql);

        return $query->fetchAll();

    }

    public function platAction(){

        if (isset($_GET['id'])){

            $dishes = new dishes();
            $d = $dishes->getOneBy(["id"=>$_GET['id']],false);

            $design = new restaurant();
            $a = $design->getOneBy(['id'=>$d['id_restaurant']],false);

            $fonts = new fonts();
            $f = $fonts->getOneBy(['id'=>$a['id_fonts']],false);

            $c = $this->getAllComments($_GET['id']);

            $resto['restaurant'] = $a;
            $resto['dishes'] = $d;
            $resto['fonts'] = $f;
            $resto['comments'] = $c;

            $resto['title_plat'] = true;

            switch ($a['template']){
                case 1:
                    $v = new View("plat", "template1");
                    break;
                case 2:
                    $v = new View("plat", "template2");
                    break;
                default:
                    $v = new View("plat", "template1");
                    break;

            }

            $v->assign("resto",$resto);
        }else{
            $design = new restaurant();
            $a=$design->getAll();

            $v = new View("templateCarte", "front");
            $v->assign("resto",$a);
        }

    }

}