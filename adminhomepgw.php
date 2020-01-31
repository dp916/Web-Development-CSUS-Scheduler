<?php
date_default_timezone_set('America/Los_Angeles');

/**
session_start();

if (!isset($_SESSION['username'])) {
	header('location: login.php');
}
$time = $_SERVER['REQUEST_TIME'];
$time_out_minutes = 15;

$time_out = 60 * $time_out_minutes;

if(isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY'] > $time_out)){
	session_unset();
	session_destroy();
	header('location: index.html');
}
$_SESSION['LAST_ACTIVITY'] = $time;
**/
?>

<?php
  date_default_timezone_set('America/Los_Angeles');
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="w3.css">
<html>
	<head>

	<title>Admin Home</title>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 50px;
    text-align: left;
}
* {
    box-sizing: border-box;
}
body{
    margin: 0;
}

table#t1 {
	width:100%;
}
table#t1 th {
    background-color: black;
    color: white;
    padding: 5px;
    text-align: left;
}
table#t1 td {
	padding: 5px;
	text-align: left;
}
table#t1 tr:nth-child(even) {
    background-color: #eee;
}
table#t1 tr:nth-child(odd) {
   background-color:#fff;
}

</style>
</head>
<body style="position: relative; min-height: 100%; top: 0px;">

<div class="row" style="background-color: #F0E1B0">
	<div class="w3-row-padding">
    	<div class="top">
        	<div style="width: 100% ">
            	<h1>Header</h1>
            	<form action="logout.php">
                	<input type="submit" class="button button1" style="width: 50%";" value="Logout"/>
                	</form>
            </div>
        </div>
        
    <div class="column left" style="background-color: #4CAF50; height: 100%; text-align: center">
        <h1 style="font-size:30px;">Admin Home</h1>
		<p>"Advisor's name"<br>"Admin's email"<br></p>
		
		<h2 style="font-size:25px;">Useful Links</h2>
		<p><a href="http://www.csus.edu/acaf/calendars/" target="_blank">Academic Calendar</a></p>
		<p><a href="http://www.ecs.csus.edu/" target="_blank">ECS Homepage</a></p>
		<p><a href="https://www.ecs.csus.edu/index.php?content=keyfob" target="_blank">ECS Key Fob request</a> </p>
		
		<h3 style="font-size:25px;">Advising Forms</h3>
		<p><a href="http://www.ecs.csus.edu/wcm/ce/resources.html" target="_blank">Civil Engineering</a></p>
		<p><a href="http://www.ecs.csus.edu/wcm/cpe/cpe%20forms.html" target="_blank">Computer Engineering</a></p>
		<p><a href="http://www.ecs.csus.edu/wcm/csc/forms.html" target="_blank">Computer Science</a></p>		
		<p><a href="http://www.ecs.csus.edu/wcm/cm/current%20students/curriculum.html" target="_blank">Construction Management</a></p>
		<p><a href="http://www.ecs.csus.edu/wcm/eee/eee%20forms.html" target="_blank">Electrical Engineering</a></p>
		<p><a href="http://www.ecs.csus.edu/wcm/me/student%20resources.html" target="_blank">Mechanical Engineering</a></p>
    </div>
    
    <div class="column right" style="background-color: #b4aa50; height: 100%; text-align: center">
        <p>Appointments</p>
        <?php
        	/*include 'weeklycalendar.php';
        	$weeklyCalendar = new WeeklyCalendar();
        	
        	$weeklyCalendar->setDate();
        	$weeklyCalendar->currentMonth();*/
        ?>
        
        <button type="button">Previous Week</button>
        <button type="button">Next Week</button>
		<table id="t1">
		  <tr>
			<th>Time:</th>
			<th>Sunday</th>
			<th>Monday</th> 
			<th>Tuesday</th>
			<th>Wednesday</th>
			<th>Thursday</th>
			<th>Friday</th>
			<th>Saturday</th>
		  </tr>
		  <tr>
		  <tr>
			<td>  </td>
			<td> <?php
        	$day = date('w');
			$week_start = date('m-d-Y', strtotime('-'.$day.' days'));
			echo $week_start;
        	?>
         		  </td>
			<td> <?php
			$day = date('w');
			$week_start = date('m-d-Y', strtotime('-'.$day.' days'.'+1 days'));
			echo $week_start;
			 ?> 
        		  </td>
			<td><?php
			$day = date('w');
			$week_start = date('m-d-Y', strtotime('-'.$day.' days'.'+2 days'));
			echo $week_start;
			 ?>   </td>
			<td> <?php
			$day = date('w');
			$week_start = date('m-d-Y', strtotime('-'.$day.' days'.'+3 days'));
			echo $week_start;
			 ?>   </td>
			<td> <?php
			$day = date('w');
			$week_start = date('m-d-Y', strtotime('-'.$day.' days'.'+4 days'));
			echo $week_start;
			 ?>   </td>
			<td> <?php
			$day = date('w');
			$week_start = date('m-d-Y', strtotime('-'.$day.' days'.'+5 days'));
			echo $week_start;
			 ?>   </td>
			<td> <?php
			$day = date('w');
			$week_start = date('m-d-Y', strtotime('-'.$day.' days'.'+6 days'));
			echo $week_start;
			 ?>   </td>
		  </tr>
			<td>9:00am</td>
			<td><button type="button" onclick="alert('James De La Cruz \n sacID \n major \n reason')">James De La Cruz</button>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
		  </tr>
		  <tr>
			<td>9:30am</td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
		  </tr>
		  <tr>
			<td>10:00am</td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
		  </tr>
		  <tr>
			<td>10:30am</td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
		  </tr>
		  <tr>
			<td>11:00am</td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
		  </tr>
		  <tr>
			<td>11:30am</td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
		  </tr>
		  <tr>
			<td>12:00pm</td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
		  </tr>
		  <tr>
			<td>12:30pm</td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
		  </tr>
		  <tr>
			<td>1:00pm</td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
		  </tr>
		  <tr>
			<td>1:30pm</td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
		  </tr>
		  <tr>
			<td>2:00pm</td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
		  </tr>
		  <tr>
			<td>2:30pm</td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
		  </tr>
		  <tr>
			<td>3:00pm</td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
		  </tr>
		  <tr>
			<td>3:30pm</td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
		  </tr>
	
		</table>
        
    </div>
    </div>
</div>

</body>	
</html>