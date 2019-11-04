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

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" /> 
<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css" /> 
<link rel="stylesheet" type="text/css" href="css/responsive.bootstrap.min.css" /> 
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" /> 
<link rel="stylesheet" type="text/css" href="css/common.css" /> 
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/buttons.flash.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/buttons.print.min.js"></script>
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
		<div class="msg"><?php if(isset($_SESSION['msg'])) { echo $_SESSION['msg'];}?></div>
		<div class="pull-left">   
			<form method="post" action="search.php">
				City Name: <input type="text" id="name" name="city" />
				<input type="submit" name="submit" value="Search" class="btn btn-secondary"/>
			</form>
		</div>
		<div class="pull-right"><a href="add.php" class="btn btn-secondary">Save</a></div>
		<div class='portlet box green frontend-datatable'>
			<div class='portlet-title'>
				<div class='caption'>
					<i style="font-size:20px;" class='fa fa-list'></i> Weather
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
						if(isset($_SESSION['WeatherTemp']) && !empty($_SESSION['WeatherTemp']))
						{ 
					?>
						<tr>
							<td><?php echo $_SESSION['WeatherTemp']['name']; ?></td>
							<td><?php echo date('Y-m-d h:i A',$_SESSION['WeatherTemp']['dt']); ?></td>
							<td><?php echo $_SESSION['WeatherTemp']['weather'][0]['main']; ?></td>
							<td><?php echo $tempC =ROUND((($_SESSION['WeatherTemp']['main']['temp'] - 32) * 5/9),2).'&deg;C' ; ?></td>
							<td><?php echo ROUND((($_SESSION['WeatherTemp']['main']['temp_min'] - 32) * 5/9),2).'&deg;C'. ' / '.ROUND((($_SESSION['WeatherTemp']['main']['temp_max'] - 32) * 5/9),2).'&deg;C'; ?></td>
							<td><?php echo $_SESSION['WeatherTemp']['main']['humidity'].'%'; ?></td>
							<td><?php echo $_SESSION['WeatherTemp']['wind']['speed']; ?></td>
						</tr>
					<?php 
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
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
		responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function ( row ) {
                        var data = row.data();
                        return 'Weather details for '+data[0];
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        buttons: [
            'pdf'
        ],
		 "searching": false
    });
	
});

</script>
</body>
</html>