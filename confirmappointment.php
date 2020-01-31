<?php session_start();
include 'dbConnect.php';
$advisor = (int)$_SESSION['advisor'];
$availResults = mysqli_query($con, "SELECT * FROM advisors WHERE advisorkey = '$advisor'");
$available = mysqli_fetch_array($availResults);
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">

<head>
	<style type="text/css">

		body {margin:0;}
		.w3-display-container{
            width: 300px;
			height: 200px !important;
		}
        textarea{
            resize: none;
            width: 800px;
            height: auto;
            min-height: 100px;
        }

	</style>
</head>

<body>
<div class="topnav">
	<a class="active" href="http://athena.ecs.csus.edu/~deliver/index.php">Home</a>
	<a href="http://athena.ecs.csus.edu/~deliver/calendar.php">Appointments</a>
	<a href="http://athena.ecs.csus.edu/~deliver/logout.php">Logout</a>
</div>

<div class="w3-display-container" style="padding-top: 380px;">
	<div class="w3-padding w3-display-bottommiddle w3-green" style="left: 220%; width: 500px;">
		<form action="createApp.php" method="post">
		<tr>
			<th>Appointment Type:</th>
			<th><?php echo $_SESSION['type'] ?></th>
		</tr>
		<br>
		<tr>
			<th>Advisor:</th>
			<th><?php echo $available['l_name'] . ', ' .$available['f_name'] ?></th>
		</tr>
		<br>
		<tr>
			<th>Major:</th>
			<th><?php echo $_SESSION['major'] ?></th>
		</tr>
		<br>
		<tr>
			<th>Date:</th>
			<th> <?php
				echo $_SESSION['date'];
				?>
			</th>
		</tr>
		<br>
		<tr>
			<th>Time:</th>
			<th> <?php
				$time = new DateTime($_POST['time']);
				echo $time->format("g:i A") . '</th>';

				?>
			</th>
		</tr>
		<br>
        <tr>
            <th style=>Reason for Appointment (optional)</th>
            <td>
                <textarea class="w3-input w3-border" name="notes"></textarea>
            </td>
        </tr>
		<button style="position: static; margin-top: 5px; margin-left: 28%" type="submit" name="confirm" value=" <?php echo $time->format("Y-m-d H:i:s")?> "class="w3-button w3-yellow w3-hover-orange">Confirm Appointment</button>
		
		</form>
	</div>

</div>

<div class="navbar">
	<a href="#help" class="active">Helpful Links</a>
	<a href="http://www.ecs.csus.edu/wcm/csc/index.html">ECS Homepage</a>
	<a href="http://www.ecs.csus.edu/wcm/csc/academic/advising.html">Advising</a>
	<a href="http://www.ecs.csus.edu/wcm/csc/Faculty%20Information/facultyofficehours.pdf">Faculty Hours</a>
	<a href="http://www.ecs.csus.edu/wcm/csc/forms.html">Forms</a>
	<a href="http://catalog.csus.edu/academic-calendar/#fall2017text">Academic Calendar</a>
</div>
</body>
</html>