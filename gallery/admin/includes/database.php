<?php

	class database{
		var $servername="localhost";
		var $username="root";
		var $passsword="";
		var $dbname="gallery";
		public $con=null;
		public function __construct(){
			$this->con=new mysqli($this->servername,$this->username,$this->passsword,$this->dbname);
			if($this->con->connect_error){
				die("connection Failed: ".$this->con->connect_error);
			}
			else{
				//echo"Connection Sucessfully.";
			}
			
		}
		public function query($sql){

			$result=mysqli_query($this->con,$sql);
			$this->query_confirm($result);
			return $result;
		}
		private function query_confirm($result){
			if(!$result){
				die("Query failed: ".$this->con->error);
			}
		}
		public function escape_string($string){
			$e_string=mysqli_real_escape_string($this->con,$string);
			return $e_string;
		}
		public function insert_id(){
			//return $this->con->insert_id;
			return mysqli_insert_id($this->con);
		}
	}
	$obj=new database();

?>