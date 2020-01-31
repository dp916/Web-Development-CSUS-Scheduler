<?php

session_start();

require 'dbConnect.php';
$err = array();
if(isset($_POST['sign_in'])){

	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);

	if(empty($username)){
		array_push($err, "*Please enter a username");
	}
	if(empty($password)){
		array_push($err, "*Please enter a password");
	}

	if(count($err) == 0){
		
		$validate = mysqli_query($con,"SELECT * FROM users WHERE username = '$username' AND password = '$password'" );
		if($validate == false){
			echo "failed";
		}
		if(mysqli_num_rows($validate) > 0){
			$admin = mysqli_query($con,"SELECT admin FROM users where username ='$username' AND password = '$password'");
			$adminResult = mysqli_fetch_array($admin);
			$_SESSION['username'] = $username;
			$_SESSION['admin'] = $adminResult['admin'];
			if((int)$adminResult['admin'] == 107 || (int)$adminResult['admin'] == 104){
				foreach(mysqli_query($con, "SELECT * FROM advisors WHERE username='$username'") as $item){
					$_SESSION['calName'] = $item['calendarname'];
					break;
				}
				header('location: home.php');
			}else if((int)$adminResult['admin'] == 100){
				foreach(mysqli_query($con, "SELECT calendarname FROM advisors") as $item){
					$_SESSION['calName'] = $item['calendarname'];
					break;
				}
				header('location: home.php');
			}else if((int)$adminResult['admin'] == 0){
				header('location: home2.php');
			}
		}else{
			array_push($err, "*Incorrect Username or Password");
		}
	}
}

?>
