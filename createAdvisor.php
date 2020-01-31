<?php
session_start();
include 'dbConnect.php';
include 'submitNewAdvisor.php';
?>

<!DOCTYPE html>

<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<body>
<header>

    <div class="topnav" style=" padding-top: 5px; padding-left:5px; overflow: hidden;">
        <div style="display:inline-block;" >
            <a class="active" href="http://athena.ecs.csus.edu/~deliver/home.php">Home</a>
        </div>

        <div style="display:inline-block;">
            <a href="http://athena.ecs.csus.edu/~deliver/createAdvisor.php">Registration</a>
        </div>

        <div style="display:inline-block;">
            <a href="http://www.csus.edu/acaf/calendars">Academic Calendar</a>
        </div>

        <div style="display:inline-block; ">
            <a href="https://www.ecs.csus.edu/index.php?content=keyfob">Request Key Fob</a>
        </div>

        <div style="display:inline-block; ">
            <a href="http://athena.ecs.csus.edu/~deliver/logout.php">Logout</a>
        </div>

        <div class="search-container" style="position:absolute; right:1px; top:10px">

        <form action="/action_page.php">

                <input type="text" placeholder="Search.." name="search">

                <button type="submit"><i class="fa fa-search"></i></button>

        </form>
        </div>

    </div>
</header>
<footer>
    <div class="navbar" style="padding-top: 5px; padding-left: 5px; overflow: hidden" ;>

        <div style="display:inline-block; ">
            <a href="#help" class="active">Advising Resources</a>
        </div>
        <div style="display:inline-block; ">
            <a href="http://www.ecs.csus.edu/wcm/ce/resources.html">Civil Engineering</a>
        </div>
        <div style="display:inline-block; ">
            <a href="http://www.ecs.csus.edu/wcm/cpe/cpe%20forms.html">Computer Engineering</a>
        </div>
        <div style="display:inline-block; ">
            <a href="http://www.ecs.csus.edu/wcm/csc/forms.html">Computer Science</a>
        </div>
        <div style="display:inline-block; ">
            <a href="http://catalog.csus.edu/academic-calendar/#fall2017text">Electrical Engineering</a>
        </div>
        <div style="display:inline-block; ">
            <a href="http://www.ecs.csus.edu/wcm/me/student%20resources.html">Mechanical Engineering</a>
        </div>

    </div>
</footer>

<form method="post" action="createAdvisor.php">
	<?php require 'error.php'; ?>

    <center><h2>Admin Registration</h2></center>
    <center>First Name:<br>
    <input type="text" name="f_name" >
    <br></center>

    <center>Last Name:<br>
    <input type="text" name="l_name" >
    <br></center>

    <center>E-mail:<br>
    <input type="text" name="email" >
    <br></center>

    <center>Username:<br></center>

    <center><input type="text" name="username" value=""></center>
    <br>

    <center>Occupation:</center>
    <center><select name="role">
        <option value="0">Select</option>
	  <?php

	    foreach (mysqli_query($con, "SELECT role FROM position") as $result){
		    echo '<option value="'.$result['role'].'">'.$result['role'].'</option>';
	    }
	  ?>
    </select></center>
    <br>

    <center>Major:</center>
    <center><select name="major1">
        <option value="0" >Select</option>
		<?php

		foreach (mysqli_query($con, "SELECT major FROM majors") as $result){
			echo '<option value="'.$result['major'].'">'.$result['major'].'</option>';
		}

		?>

    </select></center>
    <br>

    <center><select name="major2">
        <option value="0" >Select</option>
		<?php

		foreach (mysqli_query($con, "SELECT major FROM majors") as $result){
			echo '<option value="'.$result['major'].'">'.$result['major'].'</option>';
		}

		?>
    </select></center>
    <br>

    <center><select name="major3">
        <option value="0" >Select</option>
		<?php

		foreach (mysqli_query($con, "SELECT major FROM majors") as $result){
			echo '<option value="'.$result['major'].'">'.$result['major'].'</option>';
		}

		?>
    </select></center>
    <br>
    <center><button type="submit" name="newAdvisor" class="button">Submit</button></center>

</form>

</html>
