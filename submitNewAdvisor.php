<?php
session_start();
include 'log_config.php';
include 'dbConnect.php';
include 'funtions.php';
$err = array();
if (isset($_POST['newAdvisor'])) {

	$f_name = mysqli_real_escape_string($con, $_POST['f_name']);
	$l_name = mysqli_real_escape_string($con, $_POST['l_name']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$role = mysqli_real_escape_string($con, $_POST['role']);

	if (empty($f_name)) {

		array_push($err, "Please enter a First name");
	}
	if (empty($l_name)) {
		array_push($err, "Please enter a Last name");
	}
	if (empty($email)) {
		array_push($err, "Please enter an email");
	}
	if (empty($username)) {
		array_push($err, "Please enter a username");
	} else {
		$_SESSION['username'] = $username;
	}
	if ($_POST['role'] == "0") {
		array_push($err, "Please select Role");
	}

	$major1 = mysqli_real_escape_string($con, $_POST['major1']);
	$major2 = mysqli_real_escape_string($con, $_POST['major2']);
	$major3 = mysqli_real_escape_string($con, $_POST['major3']);
	if (($major1 === "0" && $major2 === "0" && $major3 === "0") && $role != "Secretary") {
		array_push($err, "Please select at least one major");
	}
	if (count($err) == 0) {
		$m1 = false;
		$m2 = false;
		$m3 = false;

		$tempPW = tempPass(8);

		$sqlString = 'INSERT INTO `thedeliverers`.`advisors` (`l_name`, `f_name`, `username`, `role`, `email`';
		if ($role != "Secretary") {
			if ($major1 != "0") {
				$sqlString .= ',`major1`';
				$m1 = true;
			}
			if ($major2 != "0") {
				$sqlString .= ', `major2`';
				$m2 = true;
			}
			if ($major3 != "0") {
				$sqlString .= ', `major3`';
				$m3 = true;
			}
		}
		$sqlString .= ') VALUES (' . '\' ' . $l_name . '\', \'' . $f_name . '\', \'' . $username . '\', \'' . $role . '\', \'' . $username . '\'' ;
		if ($m1 == true || $m2 == true || $m3 == true) {

			if ($m1 == true) {
				$sqlString .= ', ' . '\'' . $major1 . '\'';
			}
			if ($m2 == true) {
				$sqlString .= ', ' . '\'' . $major2 . '\'';
			}
			if ($m3 == true) {
				$sqlString .= ', ' . '\'' . $major3 . '\'';
			}

		}
		$sqlString .= ');';
		$insertNewAccount = mysqli_query($con, $sqlString);
		if ($insertNewAccount == false) {
			array_push($err, "Username is taken");
			//header('location: login.php');
		} else {

			//create login info
			$loginStr = 'INSERT INTO `thedeliverers`.`users` (`username`, `password`, `admin`) VALUES (\'' .
				$username . '\',' . ' \'' . $tempPW . '\',';
			if ($role === "Secretary") {
				$loginStr .= '\'100\'); ';
			} else if ($role === "Advisor") {
				$loginStr .= '\'104\'); ';
			} else if ($role === "Administrator") {
				$loginStr .= '\'107\'); ';
			}
			$createLogin = mysqli_query($con, $loginStr);


			if ($createLogin == false) {
				array_push($err, "Could not Create profile");
			} else{
				//create new calendar for user if not Secretary
				if($role != "Secretary"){

					$calName = "advisorcal" . $username;
					$newCal = "CREATE TABLE `thedeliverers`.`" . $calName .
						"` (`appStart` DATETIME NOT NULL,`appEnd` DATETIME NOT NULL,
						  `type` VARCHAR(45) NOT NULL,
						  `major` VARCHAR(45) NOT NULL,
						  `std_id` VARCHAR(45) NOT NULL,
                         `notes` MEDIUMTEXT NULL,
						  PRIMARY KEY (`appStart`))";
					mysqli_query($con, $newCal);
					$_SESSION['temppw'] = $tempPW;
					$_SESSION['newusername'] = $username;
					$_SESSION['register'] = "admin";
					header('location: newAccount.php');


				}
			}
		}
		}else {
			unset($_POST['newAdvisor']);
			header('location: createAdvisor.php');
			echo 'success';
		}
	} else {
		header('location createAdvisor.php');
	}
