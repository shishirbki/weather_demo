<?php 
require_once("db.php");
$bdd = new DB();
$startDate = date('Y-m-d', strtotime(@$_POST['start_date']));
$endDate = date('Y-m-d', strtotime(@$_POST['end_date']));
$data = $bdd->getAllRecords("SELECT * FROM city_weather_details WHERE city LIKE '%$_POST[city]%' AND weather_date BETWEEN '$startDate' AND '$endDate' ORDER BY id ASC");
$_SESSION['gethistory'] = $data;
$bdd->redirect('get_history.php?show=msg');
?>				