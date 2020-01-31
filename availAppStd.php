<?php session_start(); ?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">

<head>
	<style type="text/css">

		body {margin:0;}

		.main {
			padding: 16px;
			margin-bottom: 30px;
		}



		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}
		tr:nth-child(even) {
			background-color: #dddddd;
		}




	</style>
</head>

<body>
<div class="topnav">
	<a class="active" href="http://athena.ecs.csus.edu/~deliver/index.php">Home</a>
	<a href="http://athena.ecs.csus.edu/~deliver/calendar.php">Appointments</a>
	<a href="http://athena.ecs.csus.edu/~deliver/logout.php">Logout</a>
</div>

<div class="navbar">
	<a href="#help" class="active">Helpful Links</a>
	<a href="http://www.ecs.csus.edu/wcm/csc/index.html">ECS Homepage</a>
	<a href="http://www.ecs.csus.edu/wcm/csc/academic/advising.html">Advising</a>
	<a href="http://www.ecs.csus.edu/wcm/csc/Faculty%20Information/facultyofficehours.pdf">Faculty Hours</a>
	<a href="http://www.ecs.csus.edu/wcm/csc/forms.html">Forms</a>
	<a href="http://catalog.csus.edu/academic-calendar/#fall2017text">Academic Calendar</a>
</div>


<table>
	<?php
	require 'dbConnect.php';

	$advisor = (int)$_SESSION['advisor'];

	$hours = array("0:00", "0:15", "0:30", "0:45", "1:00", "1:15", "1:30", "1:45", "2:00", "2:15", "2:30",
		"2:45", "3:00", "3:15", "3:30", "3:45", "4:00", "4:15", "4:30", "4:45", "5:00", "5:15", "5:30", "5:45", "6:00",
		"6:15", "6:30", "6:45", "7:00", "7:15", "7:30", "7:45", "8:00", "8:15", "8:30", "8:45", "9:00", "9:15", "9:30",
		"9:45", "10:00", "10:15", "10:30", "10:45", "11:00", "11:15", "11:30", "11:45", "12:00", "12:15", "12:30", "12:45",
		"13:00", "13:15", "13:30", "13:45", "14:00", "14:15", "14:30", "14:45", "15:00", "15:15", "15:30", "15:45", "16:00",
		"16:15", "16:30", "16:45", "17:00", "17:15", "17:30", "17:45", "18:00", "18:15", "18:30", "18:45", "19:00", "19:15",
		"19:30", "19:45", "20:00", "20:15", "20:30", "20:45", "21:00", "21:15", "21:30", "21:45", "22:00", "22:15", "22:30",
		"22:45", "23:00", "23:15", "23:30", "23:00", "23:45");
	if ($advisor == 100) {

	} else {
		// array to store scheduled appointments
		$scheduledApp = array();
		$availableValues = array();
		//table name
		$advisorTable = $_SESSION['advisor'];
		
		//querry of advisors scheduled appointments
		$querry = mysqli_query($con, "SELECT * FROM advisors WHERE advisorkey='$advisorTable'");
		if($querry == false){echo 'fail';}
		$querryarray = mysqli_fetch_array($querry);
		$tablename = $querryarray['calendarname'];
		$querryCalendar = mysqli_query($con, "SELECT * FROM $tablename");
		//querry of advisor availablity
		$availResults = mysqli_query($con, "SELECT * FROM advisors WHERE advisorkey = $advisor");
		$available = mysqli_fetch_array($availResults);
		//stores scheduled appointments in array
		
		while ($row = mysqli_fetch_assoc($querry)) {
			$scheduledApp[] .= $row['appStart'];
		}

		$curDay = new DateTime();
		$curDay->add(new DateInterval('P1D'));

		$endDate;
		foreach (mysqli_query($con, "SELECT * FROM semester_length") as $result) {


			if ((new DateTime($result['startSemester']) < new DateTime($curDay->format("Y-m-d H:i:s"))) &&
				(new DateTime($result['endSemester']) >  new DateTime($curDay->format("Y-m-d H:i:s")))) {
				$endDate = new DateTime($result['endSemester']);
				break;
			}
		}

		while ($curDay <= $endDate) {
			foreach ($hours as $curHour) {
				if ($available[$curHour] == 1) {

					$temptime = $curDay->format('Y-m-d ') . $curHour . ':00';
					foreach(mysqli_query($con, "SELECT * FROM $tablename") as $temp){
						if(!($temp['appStart'] === $temptime)){
							array_push($availableValues ,new DateTime($temptime));
							break;
						}
					}
					//echo $temptime;
					//$timeSlot = new DateTime($temptime);
					//if (!in_array('$timeSlot', $scheduledApp)) {
					//	array_push($availableValues, $timeSlot);
					//}

				}


			}
			$numberday = $curDay->format("w");
			if($numberday == 5){
				$curDay->add(new DateInterval('P3D'));
			}else{
				$curDay->add(new DateInterval('P1D'));
			}
			
			$numberday = $curDay->format("w");
		}
		//echo count($availableValues);
		?>

		<form action="confirmappointment.php" method="post">


		<table id="appList">
		<?php
		echo "<tr>";
			echo "<th>Reason for Visit</th>";
			echo "<th>Major</th>";
			echo "<th>Advisor</th>";
			echo "<th>Time</th>";
			echo "<th>Date</th>";
			echo "<th></th>";
			echo "</tr>";

		foreach ($availableValues as $item) {
			$item1 = clone $item;
			$item2 = clone $item;
			
			echo '<tr>';
			echo '<th>' . $_SESSION['type'] . '</th>';
			echo '<th>' . $_SESSION['major'] . '</th>';
			echo '<th>' . $available['l_name'] . ', ' . $available['f_name'] . '</th>';
			echo '<th>' . $item1->format("g:i A") . '</th>';
			echo '<th>' . $item2->format("d-M-Y") . '</th>';
				$_SESSION['date'] = $item->format("d-M-Y");
			echo '<td>' . '<button type="submit" name="time" value="'. $item->format("Y-m-d H:i:s") . '"' . 'class="btn success"' . '>Select</button></td>';
			echo '<tr>' ;
		}

	}
		?>
		</table>
		</form>

</body>
</html>