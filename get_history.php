<?php
require("common_functions.php");   
require_once("db.php");   
$bdd = new DB();
$common = new Common();
$url = $common->getBaseUrl();
if(!isset($_GET['show']) && empty($_GET['show'])){
	session_destroy();
}	
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Weather API demo</title> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/common.css" />
</head> 
<body> 
<header class="container-fluid text-center">
  <nav class="navbar navbar-expand-sm navbar-dark"> 
	  <a class="navbar-brand" href="<?php echo $url; ?>"><img src="<?php echo $url; ?>images/weather_logo.png" style="width:50px;"></a>
	  <!-- Links -->
	  <ul class="navbar-nav">
		<li class="nav-item">
		  <a class="nav-link" href="<?php echo $url; ?>">Search Weather</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link" href="<?php echo $url; ?>get_history.php">Get Weather History</a>
		</li>
	</ul>
   </nav>
</header>
<div class="body_section">	
	<div class="container" style="padding-left:1px;padding-top:50px;">
		<div class="search">   
			<form method="post" action="history.php">		
				 <div class="container">
					<div class="col-md-4"><div class="form-group">City Name: <input type="text" id="name" name="city" class="form-control" /></div></div>
					<div class='col-md-4'>
					  <div class="form-group">
						From Date<div class='input-group date' id='datetimepicker6'>
						  <input type='text' class="form-control" name="start_date"/>
						  <span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						  </span>
						</div>
					  </div>
					</div>
					<div class='col-md-4'>
					  <div class="form-group">
						To Date<div class='input-group date' id='datetimepicker7'>
						  <input type='text' class="form-control" name="end_date"/>
						  <span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						  </span>
						</div>
					  </div>
					</div>
				  </div>
				  <input type="submit" name="search" value="search" class="btn btn-secondary"/>
			</form>
		</div> 
		<div class='portlet box green frontend-datatable'>
			<div class='portlet-title'>
				<div class='caption'>
					<i style="font-size:20px;" class='fa fa-list'></i> Weather History
				</div>
				<div class='tools'></div>
			</div>
			<div class="portlet-body">							
				<table id="example" class="table table-striped table-bordered nowrap" width="100%">
					<thead>
						<tr>
							<th>City</th>
							<th>Weather Date</th>
							<th>Weather</th>
							<th>Temprature</th>
							<th>Temp Min / Temp Max</th>
							<th>Humidity</th>
							<th>Air Speed</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						if(isset($_SESSION['gethistory']) && !empty($_SESSION['gethistory']))
						{ 
						
						foreach($_SESSION['gethistory'] as $k=>$v){
							
					?>
						<tr>
							<td><?php echo $v['city']; ?></td>
							<td><?php echo date('Y-m-d H:i:s',strtotime($v['weather_date'])); ?></td>
							<td><?php echo $v['weather']; ?></td>
							<td><?php echo ROUND((($v['temprature'] - 32) * 5/9),2).'&deg;C'; ?></td>
							<td><?php echo ROUND((($v['temp_min'] - 32) * 5/9),2).'&deg;C'. ' / '.ROUND((($v['temp_max'] - 32) * 5/9),2).'&deg;C'; ?></td>
							<td><?php echo $v['humidity'].'%'; ?></td>
							<td><?php echo $v['air_speed']; ?></td>
						</tr>
						<?php }
						}
					?>		
					</tbody>
				</table>		
			</div>
		</div>
	</div>
</div> 
<footer class="container-fluid text-center">
  <p>Footer</p>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
<script>
$('#datetimepicker6').datetimepicker();
    $('#datetimepicker7').datetimepicker({
      useCurrent: false //Important! See issue #1075
    });
    $("#datetimepicker6").on("dp.change", function(e) {
      $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepicker7").on("dp.change", function(e) {
      $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
    });
</script>