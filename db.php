<?php
session_start();
class DB {
	private $conn;
	private $host;
	private $user;
	private $password;
	private $baseName;
	private $port;
	private $Debug;
 
    function __construct($params=array()) {
		$this->conn = false;
		$this->host = 'localhost'; //hostname
		$this->user = 'root'; //username
		$this->password = ''; //password
		$this->baseName = 'weatherdb'; //name of your database
		$this->port = '3306';
		$this->debug = true;
		$this->connect();
	}
 
	function __destruct() {
		$this->disconnect();
	}
	
	function connect() {
		if (!$this->conn) {
			try {
				$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->baseName.'', $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));  
			}
			catch (Exception $e) {
				die('Erreur : ' . $e->getMessage());
			}
 
			if (!$this->conn) {
				$this->status_fatal = true;
				echo 'Connection BDD failed';
				die();
			} 
			else {
				$this->status_fatal = false;
			}
		}
 
		return $this->conn;
	}
 
	function disconnect() {
		if ($this->conn) {
			$this->conn = null;
		}
	}
	
	function getSingleRecords($query) {
		$result = $this->conn->prepare($query);
		$ret = $result->execute();
		if (!$ret) {
			return $reponse = 'PDO::errorInfo():';		  
		}
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$reponse = $result->fetch();
		
		return $reponse;
	}
	
	function getAllRecords($query) {
		$result = $this->conn->prepare($query);
		$ret = $result->execute();
		if (!$ret) {
		   return $reponse = 'PDO::errorInfo():';
		}
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$reponse = $result->fetchAll();
		return $reponse; 
	}
	
	function savedata($params) {
		/* 	echo "<pre>";
		print_r($params);die; */
	 	$sql = $this->conn->prepare("INSERT INTO city_weather_details(city,	weather_date,weather,temprature,temp_min,temp_max,	humidity,air_speed,created) values(:city,:weather_date,:weather,:temprature,:temp_min,:temp_max,:humidity,:air_speed,:created)");
		$date = date('Y-m-d H:i:s',$params['dt']);
		$currdate = date('Y-m-d H:i:s');
		$sql->bindParam(':city',$params['name'],PDO::PARAM_STR);
		$sql->bindParam(':weather_date',$date,PDO::PARAM_STR);
		$sql->bindParam(':weather',$params['weather'][0]['main'],PDO::PARAM_STR);
		$sql->bindParam(':temprature',$params['main']['temp'],PDO::PARAM_STR);
		$sql->bindParam(':temp_min',$params['main']['temp_min'],PDO::PARAM_STR);
		$sql->bindParam(':temp_max',$params['main']['temp_max'],PDO::PARAM_STR);
		$sql->bindParam(':humidity',$params['main']['humidity'],PDO::PARAM_STR);
		$sql->bindParam(':air_speed',$params['wind']['speed'],PDO::PARAM_STR);
		$sql->bindParam(':created',$currdate,PDO::PARAM_STR);
		if($sql->execute()){
			$reponse = "Records save successfully";
		}
		else{
			$reponse = "Not able to save data please try again";
		}		
		return $reponse;		
	}
	
	function redirect($url){
		header("Location: $url");
	}	
}