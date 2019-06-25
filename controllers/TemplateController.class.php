<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Core\FB;
use Core\View;
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

            $dishes = new dishes();
            $d = $dishes->getAll();

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

    public function platAction(){

        if (isset($_GET['id'])){

            $dishes = new dishes();
            $d = $dishes->getOneBy(["id"=>$_GET['id']],false);

            $design = new restaurant();
            $a = $design->getOneBy(['id'=>$d['id_restaurant']],false);

            $fonts = new fonts();
            $f = $fonts->getOneBy(['id'=>$a['id_fonts']],false);

            $resto['restaurant'] = $a;
            $resto['dishes'] = $d;
            $resto['fonts'] = $f;
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

    public function contactAction(){

        $v = new View("contact", "front");
        $v->assign("pseudo","prof");
    }

    public function adminContactAction(){

        $v = new View("adminContact", "back");
        $v->assign("pseudo","prof");
    }

    public function faqsAction(){

        $v = new View("faqs", "back");
        $v->assign("pseudo","prof");
    }

    public function activeCompteAction(){

        $v = new View("mail", "front");
        $v->assign("mode",1);
    }

    public function templateAction(){

        $v = new View("template", "front");
        $v->assign("pseudo","prof");
    }

    public function templateCarteAction(){

        $v = new View("templateCarte", "front");
        $v->assign("pseudo","prof");
    }

    public function reservationAction(){

        $v = new View("reservation", "front");
        $v->assign("pseudo","prof");
    }
}