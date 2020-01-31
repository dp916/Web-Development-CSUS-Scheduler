
<?php
session_start();
$time = $_SERVER['REQUEST_TIME'];

$time_out = 10;

if(isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY'] > $time_out)){
	session_unset();
	session_destroy();
	session_start();
	header('location: index.html');
}
$_SESSION['LAST_ACTIVITY'] = $time;

if (isset($_SESSION['username'])) {
		session_unset();
		session_destroy();
		header('location: login.php');

}else{
header('location: login.php');
}