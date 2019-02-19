<?php
class BaseSQL{

	public $pdo;
	protected $table;

	public function __construct(){
		try{
			$this->pdo = new PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPWD);
			//$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(Exception $e){
			die("Erreur SQL : ".$e->getMessage());
		}

		$this->table = get_called_class();
	}


	public function setId($id){
		$this->id = $id;
		//va récupérer en base de données les élements pour alimenter l'objet
		$this->getOneBy(["id"=>$id], true);
		
	}


	// $where -> tableau pour créer notre requête sql
	// $object -> si vrai aliment l'objet $this sinon retourn un tableau
	public function getOneBy(array $where, $object = false){

		// $where = ["id"=>$id, "email"=>"y.skrzypczyk@gmail.com"];
		$sqlWhere = [];
		foreach ($where as $key => $value) {
			$sqlWhere[]=$key."=:".$key;
		}
		$sql = " SELECT * FROM ".$this->table." WHERE  ".implode(" AND ", $sqlWhere).";";
		$query = $this->pdo->prepare($sql);
		
		if($object){
			//modifier l'objet $this avec le contenu de la bdd
			$query->setFetchMode( PDO::FETCH_INTO, $this);
		}else{
			//on retourne un simple table php
			$query->setFetchMode( PDO::FETCH_ASSOC);
		}

		$query->execute( $where );
		return $query->fetch();

	}



	public function save(){

		//Array ( [id] => [firstname] => Yves [lastname] => SKRZYPCZYK [email] => y.skrzypczyk@gmail.com [pwd] => $2y$10$tdmxlGf.zP.3dd7K/kRtw.jzYh2CnSbFuXaUkDNl3JtDJ05zCI7AG [role] => 1 [status] => 0 [pdo] => PDO Object ( ) [table] => Users )
		$dataObject = get_object_vars($this);
		//Array ( [id] => [firstname] => Yves [lastname] => SKRZYPCZYK [email] => y.skrzypczyk@gmail.com [pwd] => $2y$10$tdmxlGf.zP.3dd7K/kRtw.jzYh2CnSbFuXaUkDNl3JtDJ05zCI7AG [role] => 1 [status] => 0)
		$dataChild = array_diff_key($dataObject, get_class_vars(get_class()));

		if( is_null($dataChild["id"])){
			//INSERT
			//array_keys($dataChild) -> [id, firstname, lastname, email]
			$sql ="INSERT INTO ".$this->table." ( ". 
			implode(",", array_keys($dataChild) ) .") VALUES ( :". 
			implode(",:", array_keys($dataChild) ) .")";

			$query = $this->pdo->prepare($sql);
			$query->execute( $dataChild );

		}else{
			//UPDATE
			$sqlUpdate = [];
			foreach ($dataChild as $key => $value) {
				if( $key != "id")
				$sqlUpdate[]=$key."=:".$key;
			}

			$sql ="UPDATE ".$this->table." SET ".implode(",", $sqlUpdate)." WHERE id=:id";

			$query = $this->pdo->prepare($sql);
			$query->execute( $dataChild );

		}

	}

}


