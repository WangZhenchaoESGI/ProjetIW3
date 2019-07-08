<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Core\View;
use Models\Users;

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

    public function errorAction(){

        $v = new View("404", "front");

    }

    public function detailAction():void{
        if ($this->isConnected()){
            $user = new Users();
            $u = $user->getOneBy(['id'=>$_SESSION['id_user']],false);
            $v = new View("detail", "front");
            $v->assign("user",$u);
        }else {
            header("Location: /connexion");
        }
    }

    public function isConnected(): bool {
        $user = new \Controller\UsersController();

        if ($user->isConnected()) return true;

        return false;
    }
}