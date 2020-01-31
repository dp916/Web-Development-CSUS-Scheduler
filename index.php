
<?php
session_start();

if (!isset($_SESSION['username'])) {
	header('location: login.php');
}
$time = $_SERVER['REQUEST_TIME'];
$time_out_minutes = 15;

$time_out = 60 * $time_out_minutes;

if(isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY'] > $time_out)){
	@mysqli_ping($con) ? $con->close() : false;
	session_unset();
	session_destroy();
	header('location: login.php');
}
$_SESSION['LAST_ACTIVITY'] = $time;
include 'dbConnect.php';



