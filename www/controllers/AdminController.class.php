<?php
/**
 * Created by PhpStorm.
 * User: zhenchao
 * Date: 13/02/2019
 * Time: 23:01
 */

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