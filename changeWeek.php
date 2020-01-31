<?php
session_start();
include 'log_config.php';
$_SESSION['time'] = $_GET['time'];
header('location: home.php');
