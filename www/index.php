<?php

require "conf.inc.php";

function myAutoloader($class){
	$classPath = "core/".$class.".class.php";
	$classModel = "models/".$class.".class.php";
	if(file_exists($classPath)){
		include $classPath;
	}else if(file_exists($classModel)){
		include $classModel;
	}
}

//Cela veut dire que si j'essaye d'instancier une class qui n'existe pas
//La fonction myAutoloader va être lancée
spl_autoload_register("myAutoloader");

//Récuperer l'url apres le nom de domaine
//Utilisation d'une variable SUPER GLOBALE
//Accessible partout, commenence par $_ et en majuscule
//c'est toujours un tableau
//Elle est créée par le serveur et alimenté par le serveur
//Vous ne pouvez que la consulter

$slug = $_SERVER["REQUEST_URI"];

//pour palier aux paramètres GET
$slugExploded = explode("?", $slug);
$slug = $slugExploded[0];

$routes = Routing::getRoute($slug);
extract($routes);


//vérifier l'existence du fichier et de la class controller
if( file_exists($cPath) ){
	include $cPath;
	if( class_exists($c)){
		//instancier dynamiquement le controller
		$cObject = new $c();
		//vérifier que la méthode (l'action) existe
		if( method_exists($cObject, $a) ){
			//appel dynamique de la méthode	
			$cObject->$a();
		}else{
			die("La methode ".$a." n'existe pas");
		}
		
	}else{
		die("La class controller ".$c." n'existe pas");
	}
}else{
	die("Le fichier controller ".$c." n'existe pas");
}


