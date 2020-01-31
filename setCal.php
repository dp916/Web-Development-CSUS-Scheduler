<?php
session_start();
$_SESSION['calName'] = $_POST['calName'];
header('location: home.php');
?>