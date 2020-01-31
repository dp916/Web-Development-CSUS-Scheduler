<?php
session_start();
unset($err);
$err = array();

if(isset($_POST['searchApp'])){

	$type = $_POST['type'];
	
	$major = $_POST['major'];
	$advisor = $_POST['advisor'];

	if($type == "0"){
		array_push($err,"Please Select Advising Type");
	}
	if($major == "0"){
		array_push($err, "Please Select Your Major");
	}
	if($advisor == "0"){
		array_push($err, "Please Select An Adivosr");
	}

	if(count($err) == 0) {
		$_SESSION['type'] = $_POST['type'];
		$_SESSION['major'] = $_POST['major'];
		$_SESSION['advisor'] = $_POST['advisor'];
		header('location: availAppStd.php');
	}else{
		header('location: student_select.php');
	}
}




