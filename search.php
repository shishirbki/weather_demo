<?php		
    require_once("openweathermap.php");     
    require_once("db.php");
    try {
        $openweathermap = new Openweathermap("76ef8e97ace486a507d8bca15057b0e4");	
        if(isset($_POST['submit'])) { 
			//get the weather of city			
			$WeatherTemp = $openweathermap->getWeatherByCity($_POST['city']);  
			$bdd = new db();			
				/* echo "<pre>";
				print_r($WeatherTemp);die("asdasdasd");  */
			if(isset($WeatherTemp) && !empty($WeatherTemp)){
				$_SESSION['WeatherTemp'] = $WeatherTemp;
				$bdd->redirect('index.php?show=msg');
			}else{
				$bdd->redirect('index.php?show=msg');
			}	
        }         
    } catch (Exception $e) {
        echo $e->getMessage();
    }
?>
 