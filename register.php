<?php

session_start();
include 'dbConnect.php';
include 'createAccount.php';
include 'functions.php';
include 'log_config.php';
?>

<!DOCTYPE html>

<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<body>
<header>
<form method="post" action="register.php">
	<?php require 'error.php'; ?>
    <center><h2>Student Registration</h2></center>
    <center>First Name:<br>
    <input type="text" name="f_name" >
    <br></center>

    <center>Last Name:<br>
    <input type="text" name="l_name" >
    <br></center>

    <center>E-mail:<br>
    <input type="text" name="email" >
    <br></center>

    <center>Username:<br>
    <input type="text" name="username" value="">
    <br></center>

    <center>Student ID:<br>
    <input type="text" name="stdid" >
    <br></center>
    <br>

    <center>Major:<br>
    <select name="major">
        <option value="0" >Select</option>
		<?php

		foreach (mysqli_query($con, "SELECT major FROM majors") as $result){
			echo '<option value="'.$result['major'].'">'.$result['major'].'</option>';
		}
		?>
    </select></center>

    <br>
    <br>
    <center>Class Level:<br>
    <center><select name="classlevel">
        <option value="0">Select</option>
        <?php
        foreach (mysqli_query($con, "SELECT idclassLevel FROM classLevel")as $result){
	        echo '<option value="'.$result['idclassLevel'].'">'.$result['idclassLevel'].'</option>';
        }
        ?>
    </select></center>
    <br>
    <center><button type="submit" name="newAccount" class="button">Submit</button></center>

</form>
</html>
