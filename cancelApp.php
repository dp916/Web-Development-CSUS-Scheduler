<?php
session_start();
include 'log_config.php';
include 'dbConnect.php';
include 'functions.php';

if (isset($_POST['cancel'])) {

	if ((int)$_SESSION['admin'] == 104 || (int)$_SESSION['admin'] == 107) {

		$date = $_POST['date'];
		$calName = $_POST['calName'];
		$std_id = $_POST['std_id'];
		$queryAdvisor = "DELETE FROM `thedeliverers`.`" . $calName . "` WHERE `appStart`='$date'";
		if (mysqli_query($con, $queryAdvisor)) {
			header('location: home.php');
		}

	} else {
		$date = $_POST['date'];
		$calName = $_POST['calName'];
		$std_id = $_SESSION['std_id'];
		$queryAdvisor = "DELETE FROM `thedeliverers`.`" . $calName . "` WHERE `appStart`='$date' AND `std_id`='$std_id'";
		if(mysqli_query($con, $queryAdvisor)){
			header('location: profile.php');
		}

	}
}