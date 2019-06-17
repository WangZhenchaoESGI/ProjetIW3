<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Core\View;
use Models\Users;
use Core\Routing;
use Core\Validator;
use Core\Validator_login;
use Core\Mail;
use Controller\UsersController;

class PagesController extends BaseSQL {
	
	public function defaultAction(){

		$v = new View("homepage", "front");
		$v->assign("pseudo","prof");
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