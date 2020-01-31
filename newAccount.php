<?php
session_start();
include 'log_config.php';
include 'dbConnect.php';

?>

<!DOCTYPE html>

<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<head>
    <style>
        .w3-container {
            width: 300px;

            overflow: auto;
            position: absolute;
            top: 10%;
            left: 35%;
        }

        .w3-button {
            background-color: white;
            font-size: 16px;
            border: 5px black;
            margin-bottom: 10px;
            margin-left: 22.5%;
        }

        .w3-button:hover {
            background-color: yellow;
        }

    </style>

</head>

<body>
<header>

    <div class="topnav" style=" padding-top: 5px; padding-left:5px; overflow: hidden;">
        <div style="display:inline-block;">
            <a class="active" href="http://athena.ecs.csus.edu/~deliver/home.php">Home</a>
        </div>

        <div style="display:inline-block;">
            <a href="http://athena.ecs.csus.edu/~deliver/calendar.php">Appointments</a>
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

<div class="w3-container w3-green" style="margin-bottom: 30px;">

	<?php
	$tempPW = $_SESSION['temppw'];
	$username = $_SESSION['newusername'];
    if($_SESSION['register'] === "admin"){
	    $queryString = "SELECT f_name FROM advisors";
	    foreach (mysqli_query($con, "SELECT * FROM advisors WHERE username = '$username'") as $item) {
		    echo '<h4>First Name: ' . $item['f_name'] . '</h4><br>';
		    echo '<h4>Last Name: ' . $item['l_name'] . '</h4><br>';
		    echo '<h4>Email: ' . $item['email'] . '</h4><br>';
		    echo '<h4>Role: ' . $item['role'] . '</h4><br>';
		    echo '<h4>Temporary Password: ' . $tempPW . '</h4><br>';

	    }
	    unset($tempPW);
    }else if($_SESSION['register'] === "Student")
        foreach (mysqli_query($con, "SELECT * FROM userprofile WHERE username = '$username'") as $item){
	        echo '<h4>First Name: ' . $item['f_name'] . '</h4><br>';
	        echo '<h4>Last Name: ' . $item['l_name'] . '</h4><br>';
	        echo '<h4>Email: ' . $item['email'] . '</h4><br>';
	        echo '<h4>Studen ID: ' . $item['std_id'] . '</h4><br>';
	        echo '<h4>Major: ' . $item['major'] . '</h4><br>';
	        echo '<h4>Class Level: ' . $item['class_level'] . '</h4><br>';
	        echo '<h4>Temporary Password: ' . $tempPW . '</h4><br>';
    }

	?>

    <form><input type="button" value="Home" style="width: 150px"
                                   class="w3-button" onclick="window.location.href='index.php'"></form>

</div>

</body>

</html>
