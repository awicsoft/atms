<?php
require_once 'connect.php';

class Database extends Connection{
	
		var $con;
		var $db;
	
	function DBConection(){
		$this->con = mysql_connect($this->getHOST(),$this->getUSERNAME(),$this->getPASSWORD());
		if(!$this->con)
		 die('Could not connect to DATABASE: ' . mysql_error());
		$this->db = mysql_select_db($this->getDATABASE(),$this->con);
	}
	function closeDBConnection(){
		if(!$this->con)
		 die('Could not connect to DATABASE: ' . mysql_error());
		mysql_close($this->con);
		
		}
	function run($query){
		$check = 0;
		
			$this->DBConection();
			
		
		$run = mysql_query($query);
		
			$this->closeDBConnection();
		
		return $run;
	}
	function giveRow($query){
		$run = mysql_query($query);
		$row = mysql_fetch_array($run);
		return $row;
		}
			
	
	}

?>