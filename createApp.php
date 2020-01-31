<?php 
	include 'log_config.php';
	session_start();
	if(!isset($_POST['confirm'])){
		header('location: denied.php');
	}
	include 'dbConnect.php';
	$advisor = (int)$_SESSION['advisor'];
	$notes = $_POST['notes'];

	$availResults = mysqli_query($con, "SELECT * FROM advisorcal203");
	$available = mysqli_fetch_array($availResults);

	
	
	
		if(!(in_array($_POST['confirm'], $available))){
			$appStart = new DateTime($_POST['confirm']);
			$appEnd = new DateTime($_POST['confirm']);
			$appEnd->add(new DateInterval('PT15M'));
			$type = $_SESSION['type'];
			$major = $_SESSION['major'];
			$username = $_SESSION['username'];
			//echo $_SESSION['username'];
			$query = mysqli_query($con, "SELECT * FROM userprofile WHERE username='$username'");
			$results = mysqli_fetch_array($query);
			$std_id = $results['std_id'];
			//printf("error: %s\n", mysqli_error($con));
			$startApp = $appStart->format("Y-m-d H:i:s");
			$endApp = $appEnd->format("Y-m-d H:i:s");
			$appCreate = "INSERT INTO advisorcal203 (appStart, appEnd, type, major, std_id, notes) VALUES ('$startApp', '$endApp', '$type', '$major', '$std_id', '$notes')";
			
			if(mysqli_query($con, $appCreate)){
				// column name in table metrics
				$typeMetrics = "other";
				switch ($type) {
					case "Forms":
						$typeMetrics = "forms";
						break;
					case "General Advising":
						$typeMetrics = "ge_advising";
						break;
					case "Graduation Applications":
						$typeMetrics = "grad_apps";
						break;
					case "Major Advising":
						$typeMetrics = "major_advising";
						break;
					case "MEP Bi-Weekly":
						$typeMetrics = "mep_bi";
						break;
					case "PASS Advising":
						$typeMetrics = "pass_advising";
						break;
					default:
						$typeMetrics = "other";
						break;
				}
				//initialize counters to get new count of visits
				$countUpdate = 0;
				$totalUpdate = 0;
				foreach ($getMetrics = mysqli_query($con, "SELECT * FROM userprofile WHERE std_id ='$std_id'") as $item) {
					$countUpdate = ((int) $item[$typeMetrics]);
					echo $countUpdate;
					$totalUpdate = ((int) $item['total']);
				}
				$countUpdate++;
				echo $countUpdate;
				$totalUpdate++;

				$metricUpdate = "UPDATE `thedeliverers`.`userprofile` SET `" . $typeMetrics . "`='" . $countUpdate .
					"', `total`='" . $totalUpdate . "' WHERE `std_id`='$std_id'";
				echo $metricUpdate;
				if($metricQuerry = mysqli_query($con, $metricUpdate)){
					echo 'success';
				}else{
					//echo 'fail';
				}

				//header('location: appSuccess.php');
			}else{
				header('location: notAvailable.php');
			}
			//echo "error 1";
		}
		//echo "not available";

	
?>