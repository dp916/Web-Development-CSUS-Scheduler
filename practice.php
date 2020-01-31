<?php
include 'log_config.php';
/*
//$currentWeek = date($_SESSION['nextWk']);
$currentWeek = new DateTime();
$curDate = date_format($currentWeek, "Y-m-d");
$time = new DateTime($curDate);
echo $time->format("Y-m-d") . "\n";
// number of day
$day = date('w');
$time->sub(new DateInterval('P' . $day . 'D'));
echo $time->format("Y-m-d");
*/

function getFirstDayOfWeek($x){
	$time = new DateTime($x);
	$day = date_format($time,'w');
	$time->sub(new DateInterval('P' . $day . 'D'));
	return $time;
}


function tempPass($length){
	$characters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r',
		's','t','u','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O',
		'P','Q','R','S','T','U','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9','!','@',
		'#','$','%','&','*');
	$pass = "";
	$possibleVal = count($characters);
	for($x = 0; $x < $length; $x++){
		$ran = rand(0, $possibleVal);
		$pass .= $characters[$ran];
	}
	return $pass;
}

echo tempPass(8);
