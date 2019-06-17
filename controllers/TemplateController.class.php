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

class TemplateController extends BaseSQL {

    public function defaultAction(){

        $design = new restaurant();
        $a=$design->getAll();

        $v = new View("templateCarte", "front");
        $v->assign("resto",$a);

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