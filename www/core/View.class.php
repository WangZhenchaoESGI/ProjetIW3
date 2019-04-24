<?php

declare(strict_types=1);

namespace Core;

class View{

	private $v;
	private $t;
	private $data = [];

	public function __construct($v, $t="back"){
		$this->setView($v);
		$this->setTemplate($t);
	}

	public function setView($v){
		$viewPath = "views/".$v.".view.php";
		if( file_exists($viewPath)){
			$this->v=$viewPath;
		}else{
			die("Attention le fichier view n'existe pas ".$viewPath);
		}
	}

	public function setTemplate($t){
		$templatePath = "views/templates/".$t.".tpl.php";
		if( file_exists($templatePath)){
			$this->t=$templatePath;
		}else{
			die("Attention le fichier template n'existe pas ".$templatePath);
		}

	}


	//$modal = form //"views/modals/form.mod.php"
	//$config = [ ..... ]
	public function addModal($modal, $config){
		//form.mod.php
		$modalPath = "views/modals/".$modal.".mod.php";
		if( file_exists($modalPath)){
			include $modalPath;
		}else{
			die("Attention le fichier modal n'existe pas ".$modalPath);
		}
	}

	//$this->data =["pseudo"=>"prof", "age"=>30, "city"=>"Paris"]
	public function assign($key, $value){
		$this->data[$key]=$value;
	}


	public function __destruct(){
		extract($this->data);
		//$this->data =["pseudo"=>"prof", "age"=>30, "city"=>"Paris"]
		//$pseudo = "prof"
		//$age = 30
		//$city = "Paris"
		include $this->t;
	}
}



