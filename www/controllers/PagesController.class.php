<?php
class PagesController{
	
	public function defaultAction(){
		$v = new View("homepage", "front");
		$v->assign("pseudo","prof");
	}

    public function contactAction(){
        $v = new View("contact", "front");
        $v->assign("pseudo","prof");
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