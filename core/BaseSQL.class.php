<?php
declare(strict_types=1);

namespace Core;

class BaseSQL
{

    public $pdo;
	protected $table;

	public function __construct(){
		try{

			//$this->pdo = new \PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPWD);
            $this->pdo = new \PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPWD);
            //$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}catch(\Exception $e){
			die("Erreur SQL : ".$e->getMessage());
		}

		$this->table = get_called_class();
	}


	public function setId($id):void{
		$this->id = $id;
		//va récupérer en base de données les élements pour alimenter l'objet
		$this->getOneBy(["id"=>$id], true);
		
	}

	// $where -> tableau pour créer notre requête sql
	// $object -> si vrai aliment l'objet $this sinon retourn un tableau
	public function getOneBy(array $where, $object = false) {

		// $where = ["id"=>$id, "email"=>"y.skrzypczyk@gmail.com"];
		$sqlWhere = [];
		foreach ($where as $key => $value) {
			$sqlWhere[]=$key."=:".$key;
		}
        $sql = " SELECT * FROM ". substr($this->table, strpos($this->table, '\\') + 1) ." WHERE  ".implode(" AND ", $sqlWhere).";";
		$query = $this->pdo->prepare($sql);
		
		if($object){
			//modifier l'objet $this avec le contenu de la bdd
			$query->setFetchMode( \PDO::FETCH_INTO, $this);
		}else{
			//on retourne un simple table php
			$query->setFetchMode( \PDO::FETCH_ASSOC);
		}

		$query->execute( $where );
		return $query->fetch();

	}

    public function getAll():array {

        $sql = " SELECT * FROM ". substr($this->table, strpos($this->table, '\\') + 1) ." ;";
        $query = $this->pdo->query($sql);

        return $query->fetchAll();

    }

    public function delete( array $where):void{

        $sqlWhere = [];
        foreach ($where as $key => $value) {
            $sqlWhere[]=$key."=:".$key;
        }
        $sql = " DELETE FROM ". substr($this->table, strpos($this->table, '\\') + 1) ." WHERE  ".implode(" AND ", $sqlWhere).";";

        $query = $this->pdo->prepare($sql);
        $query->execute( $where );

    }

	public function save():void{

		//Array ( [id] => [firstname] => Yves [lastname] => SKRZYPCZYK [email] => y.skrzypczyk@gmail.com [pwd] => $2y$10$tdmxlGf.zP.3dd7K/kRtw.jzYh2CnSbFuXaUkDNl3JtDJ05zCI7AG [role] => 1 [status] => 0 [pdo] => PDO Object ( ) [table] => Users )
		$dataObject = get_object_vars($this);
		//Array ( [id] => [firstname] => Yves [lastname] => SKRZYPCZYK [email] => y.skrzypczyk@gmail.com [pwd] => $2y$10$tdmxlGf.zP.3dd7K/kRtw.jzYh2CnSbFuXaUkDNl3JtDJ05zCI7AG [role] => 1 [status] => 0)
		$dataChild = array_diff_key($dataObject, get_class_vars(get_class()));

		if( is_null($dataChild["id"])){
			//INSERT
			//array_keys($dataChild) -> [id, firstname, lastname, email]
			$sql ="INSERT INTO ". substr($this->table, strpos($this->table, '\\') + 1) ." ( ".
			implode(",", array_keys($dataChild) ) .") VALUES ( :". 
			implode(",:", array_keys($dataChild) ) .")";

			try{
                $query = $this->pdo->prepare($sql);
                $query->execute( $dataChild );
            }catch (Exception $e){
                die('Erreur : ' . $e->getMessage());
            }

		}else{
			//UPDATE
			$sqlUpdate = [];
			foreach ($dataChild as $key => $value) {
				if( $key != "id")
				$sqlUpdate[]=$key."=:".$key;
			}

			$sql ="UPDATE ". substr($this->table, strpos($this->table, '\\') + 1) ." SET ".implode(",", $sqlUpdate)." WHERE id=:id";

            $query = $this->pdo->prepare($sql);
			$query->execute( $dataChild );

		}
	}

}


