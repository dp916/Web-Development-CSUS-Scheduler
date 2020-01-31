<?php
session_start();
include 'dbConnect.php';
include 'log_config.php';

if(isset($_POST['newNotes']) && ((int)$_SESSION['admin'] == 107)){
    $notes = $_POST['notes'];
    $notes = $_SESSION['notes'] . "\n\n" . $notes;
    $profile = $_SESSION['profile'];
    $sqlString = "UPDATE `userprofile` SET `notes`='" . $notes . "' WHERE `username`='$profile'";
    if(mysqli_query($con, $sqlString)){
        unset($_POST['searchProfile']);
        header('location: home.php');
    }
}

?>