<?php
class Routing{

	public static $routeFile = "routes.yml";

	public static function getRoute($slug){

		// /creation_de_compte_allocine
		//récuperer toutes les routes dans le fichier yml
		$routes = yaml_parse_file(self::$routeFile);
		if( isset($routes[$slug])){
			if(empty($routes[$slug]["controller"]) || empty($routes[$slug]["action"])){
				die("Il y a une erreur dans le fichier routes.yml");
			}
			$c = ucfirst($routes[$slug]["controller"])."Controller";
			$a = $routes[$slug]["action"]."Action";
			$cPath = "controllers/".$c.".class.php";

		}else{
			return null;
		}

		return ["c"=>$c, "a"=>$a,"cPath"=>$cPath ];
	}


	public static function getSlug($c, $a){
		$routes = yaml_parse_file(self::$routeFile);

		foreach ($routes as $slug => $cAndA) {
			
			if( !empty($cAndA["controller"]) && 
				!empty($cAndA["action"]) && 
				$cAndA["controller"] == $c &&
				$cAndA["action"] == $a){
					return $slug;
				}

		}

		return null;

	}

}










