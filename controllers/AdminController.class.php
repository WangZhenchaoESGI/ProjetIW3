<?php

declare(strict_types=1);

namespace Controller;
use Core\View;

class AdminController{
    public function defaultAction(){
        $v = new View("dashboard", "back");
        $v->assign("pseudo","prof");
    }

    public function dashboardAction(){
        $v = new View("dashboard", "back");
        $v->assign("pseudo","prof");
    }

    public function commandesAction(){
        $v = new View("commandes", "back");
        $v->assign("pseudo","prof");
    }


    public function produitsAction(){
        $v = new View("produits", "back");
        $v->assign("pseudo","prof");
    }


}