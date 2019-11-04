<?php
require_once("db.php");
$bdd = new DB();
$data = $bdd->savedata($_SESSION['WeatherTemp']);
$_SESSION['msg'] = $data;
$bdd->redirect('index.php?show=msg');
?>