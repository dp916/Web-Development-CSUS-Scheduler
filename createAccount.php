<?php
session_start();
include 'log_config.php';
include 'dbConnect.php';
include 'funtions.php';
$err = array();
if (isset($_POST['newAccount'])) {

	$f_name = mysqli_real_escape_string($con, $_POST['f_name']);
	$l_name = mysqli_real_escape_string($con, $_POST['l_name']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$stdid = mysqli_real_escape_string($con, $_POST['stdid']);
	$role = "Student";
	$major = $_POST['major'];
	$classLevel = $_POST['classlevel'];


	if (empty($f_name)) {array_push($err, "Please enter a First name");}
	if (empty($l_name)) {array_push($err, "Please enter a Last name");}
	if (empty($email)) {array_push($err, "Please enter an email");}
	if (empty($username)) {array_push($err, "Please enter a username");}
	if(empty($stdid)){array_push($err, "Please enter your Student ID");}
	if ($major === "0" ) {array_push($err, "Please select your major");}
	if($classLevel === "0"){array_push($err, "Please Select your class level");}
	echo $classLevel . "level";

	echo count($err);
	if (count($err) == 0) {
		$tempPW = tempPass(8);
		echo "hello2";
		$sqlString = 'INSERT INTO `userprofile` (`l_name`, `f_name`, `username`, `std_id`, `email`,`major`,`class_level`';
		$sqlString .= ') VALUES (' . '\' ' . $l_name . '\', \'' . $f_name . '\', \'' . $username . '\', \'' . $stdid .
			'\', \'' . $email . '\', ' . '\'' . $major . '\',' . '\'' . $classLevel . '\');';
		echo $sqlString;
		//create login info
		$loginStr = 'INSERT INTO `thedeliverers`.`users` (`username`, `password`, `admin`) VALUES (\'' .
			$username . '\',' . ' \'' . $tempPW . '\',' . '\'0\');';

		echo 'hello';
		echo '<br><br>' . $loginStr;
		//creation unsuccessful
		if (mysqli_query($con, $sqlString) == false || mysqli_query($con, $loginStr) == false) {
			echo mysqli_errno($con);
			array_push($err, "Username is taken");
			return;
		} else {
			array_push(mysqli_errno($con));
			$_SESSION['temppw'] = $tempPW;
			$_SESSION['newusername'] = $username;
			$_SESSION['register'] = "Student";
			header('location: newAccount.php');
		}
	}
}
