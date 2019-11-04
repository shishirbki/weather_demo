<?php 
require_once("openweathermap.php");
require_once("db.php");
$bdd = new DB();
$startDate = date('Y-m-d', strtotime(@$_POST['start_date']));
$endDate = date('Y-m-d', strtotime(@$_POST['end_date']));
$data = $bdd->getAllRecords("SELECT * FROM city_weather_details WHERE city LIKE '%$_POST[city]%' AND weather_date BETWEEN '$startDate' AND '$endDate' ORDER BY id ASC");
$currDate = date('Y-m-d');
if(!empty($data)){
	$_SESSION['gethistory'] = $data;
}else if($startDate == $currDate) {
	$openweathermap = new Openweathermap("76ef8e97ace486a507d8bca15057b0e4");
	$WeatherTemp = $openweathermap->getWeatherByCity($_POST['city']); 
		 /* echo "<pre>";
		print_r($WeatherTemp);die;  */
	if(isset($WeatherTemp) && !empty($WeatherTemp)){
		
		$_SESSION['gethistory'][0]['city'] = $WeatherTemp['name'];
		$_SESSION['gethistory'][0]['weather_date'] = $WeatherTemp['dt'];
		$_SESSION['gethistory'][0]['weather'] = $WeatherTemp['weather'][0]['main'];
		$_SESSION['gethistory'][0]['temprature'] = $WeatherTemp['main']['temp'];
		$_SESSION['gethistory'][0]['temp_min'] = $WeatherTemp['main']['temp_min'];
		$_SESSION['gethistory'][0]['temp_max'] = $WeatherTemp['main']['temp_min'];
		$_SESSION['gethistory'][0]['humidity'] = $WeatherTemp['main']['temp_min'];
		$_SESSION['gethistory'][0]['air_speed'] = $WeatherTemp['wind']['speed'];
	}
}else{
	$_SESSION['gethistory'] ="";
}	
$bdd->redirect('get_history.php?show=msg');
?>				