<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Core\View;
use Models\Users;

class PagesController extends BaseSQL {
	
	public function defaultAction():void{

		$v = new View("homepage", "front");
		$v->assign("pseudo","prof");
	}

    public function contactAction():void{

        $v = new View("contact", "front");
        $v->assign("pseudo","prof");
    }

    public function adminContactAction():void{

        $v = new View("adminContact", "back");
        $v->assign("pseudo","prof");
    }

    public function faqsAction():void{

        $v = new View("faqs", "back");
        $v->assign("pseudo","prof");
    }

    public function activeCompteAction():void{

        $v = new View("mail", "front");
        $v->assign("mode",1);
    }

    public function templateAction():void{

        $v = new View("template", "front");
        $v->assign("pseudo","prof");
    }

    public function templateCarteAction():void{

        $v = new View("templateCarte", "front");
        $v->assign("pseudo","prof");
    }

    public function reservationAction():void{

        $v = new View("reservation", "front");
        $v->assign("pseudo","prof");
    }

    public function errorAction():void{

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