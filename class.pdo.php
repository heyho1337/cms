<?php
class PDO_FUNCTIONS{
	private $db;
    function __construct($DB_con){
		$this->db = $DB_con;
    }
	
	//Used for simple databse updates
	public function pdo_up($sql) {
		global $db;
		$this->db->query($sql);
		return true;
	}
	
	//Insert row into database
	public function pdo_insert($table,$col,$var) {
		global $db;
		$sql="INSERT INTO ".$GLOBALS['DB_pref'].$table."(".$col.") VALUES(".$var.")";
		$this->db->query($sql);
		return true;
	}
	
	//database query with 1 where clause
    public function pdo_query1($sql,$var){
		try{
			global $db;
			$result = $this->db->prepare($sql);
			$result->execute(array($var));
			$sor = $result->fetch(PDO::FETCH_ASSOC);
			return $sor;
		}
       catch(PDOException $e){
           echo $e->getMessage();
		}
	}
	
	//database query with 2 where clause
	public function pdo_query2($sql,$var,$var2){
		try{
			global $db;
			$result = $this->db->prepare($sql);
			$result->execute(array($var,$var2));
			$sor = $result->fetch(PDO::FETCH_ASSOC);
			return $sor;
		}
		catch(PDOException $e){
		   echo $e->getMessage();
		}
	}
	
	//database query with 3 three clause
	public function pdo_query3($sql,$var,$var2,$var3){
		try{
			global $db;
			$result = $this->db->prepare($sql);
			$result->execute(array($var,$var2,$var3));
			$sor = $result->fetch(PDO::FETCH_ASSOC);
			return $sor;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	//Used for simple database query
	public function pdo_query_simple($sql){
		try{
			global $db;
			$sor = $this->db->query($sql);
			return $sor;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
?>