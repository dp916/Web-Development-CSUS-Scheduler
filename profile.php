<?php
session_start();
include 'dbConnect.php';
include 'log_config.php';

?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href=style.css>
<head>
    <style>
        body {
            margin: 0;
        }
        textarea{
            resize: none;
            width: 800px;
            height: auto;
            min-height: 100px;
        }
    </style>
</head>
<body>

<div class="topnav">
    <a class="active" href="http://athena.ecs.csus.edu/~deliver/home.php">Home</a>
    <a href="http://athena.ecs.csus.edu/~deliver/student_select.php">Appointments</a>
    <a href="http://athena.ecs.csus.edu/~deliver/logout.php">Logout</a>
</div>
<?php
$username = "";
if (isset($_POST['searchProfile']) && ((int)$_SESSION['admin'] == 104 || (int)$_SESSION['admin'] == 107)) {
	$username = $_POST['profile'];
} else {
	$username = $_SESSION['username'];
}

$queryString = "SELECT * FROM userprofile WHERE username = '$username'";
$fname = $lname = $stdid = $major = $email = $notes = "";
$app1 = $app2 = $app3 = $app4 = "";
$app1Adv = $app2Adv = $app3Adv = $app4Adv = "";
foreach (mysqli_query($con, $queryString) as $item) {
	$fname = ucfirst($item['f_name']);
	$lname = ucfirst($item['l_name']);
	$stdid = $_SESSION['std_id'] = $item['std_id'];
	$email = $item['email'];
	$major = $item['major'];
	$notes = $_SESSION['notes'] = $item['notes'];
	$app1 = $item['schd_app1'];
	$app1Adv = $item['schd_app1_advisor'];
	$app2 = $item['schd_app2'];
	$app2Adv = $item['schd_app2_advisor'];
	$app3 = $item['schd_app3'];
	$app3Adv = $item['schd_app3_advisor'];
	$app4 = $item['schd_app4'];
	$app4Adv = $item['schd_app4_advisor'];

}
?>
<div style="padding-left:16px">
    <h2>Welcome <?php echo $fname; ?>!</h2>


    <h3>Student Information:</h3>

    <div class="tab">
        <button class="tablinks" onclick="openItem(event, 'User')" id="defaultOpen">User</button>
        <button class="tablinks" onclick="openItem(event, 'Name')">Name</button>
        <button class="tablinks" onclick="openItem(event, 'Major')">Major</button>
        <button class="tablinks" onclick="openItem(event, 'Email')">Email</button>

    </div>

    <div id="User" class="tabcontent">
        <h3>User</h3>
        <p><?php echo "Username: " . $username ?></p><br>
        <p><?php echo "Student ID: " . $stdid ?></p><br>

    </div>

    <div id="Name" class="tabcontent">

        <h3>Student Name: </h3>
        <p><?php echo $fname . " " . $lname ?></p>
    </div>

    <div id="Major" class="tabcontent">
        <h3>Major: </h3>
        <p><?php echo $major ?></p>
    </div>

    <div id="Email" class="tabcontent">
        <h3>Email</h3>
        <p><?php echo $email ?></p>
    </div>

    <script>
        function openItem(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>

    <div class="vertical-menu">
        <a class="active">Scheduled Appointments</a>
		<?php
		if ($app1 != null) {
			$time = new DateTime($app1);
			echo '<a>';
			echo $time->format("M-d-Y g:i A");
			echo "    Advisor: " . $app1Adv;
			echo '</a>';
		}
		if ($app2 != null) {
			$time = new DateTime($app2);
			echo '<a>';
			echo $time->format("M-d-Y g:i A");
			echo "    Advisor: " . $app2Adv;
			echo '</a>';
		}
		if ($app3 != null) {
			$time = new DateTime($app3);
			echo '<a>';
			echo $time->format("M-d-Y g:i A");
			echo "    Advisor: " . $app3Adv;
			echo '</a>';
		}
		if ($app4 != null) {
			$time = new DateTime($app4);
			echo '<a>';
			echo $time->format("M-d-Y g:i A");
			echo "    Advisor: " . $app4Adv;
			echo '</a>';
		}

		?>
    </div>
    <div>

		<?php
		if (isset($_POST['searchProfile']) && (int)$_SESSION['admin'] == 107) {
			echo '<div>';
			echo nl2br($notes);
			echo '</div>';
		}
		$_SESSION['profile'] = $_POST['profile'];
		echo '<form action="newNotes.php" method="post">';
		echo '<td><label>Add Notes</label>';
		$timeStamp = new DateTime();
        echo '<textarea class="w3-input w3-border" name="notes">' . $timeStamp->format("M-d-Y h:i A") . '<br><br></textarea>';
        echo '</td>';
        echo '<button type="submit" name="newNotes" style="width: 50px; height: 30px; margin: 5px; ">Submit Notes</button>';
        echo '</form>';
        ?>
    </div>


</div>

<div class="navbar">
    <a href="#help" class="active">Helpful Links</a>
    <a href="http://www.ecs.csus.edu/wcm/csc/index.html">ECS Homepage</a>
    <a href="http://www.ecs.csus.edu/wcm/csc/academic/advising.html">Advising</a>
    <a href="http://www.ecs.csus.edu/wcm/csc/Faculty%20Information/facultyofficehours.pdf">Faculty Hours</a>
    <a href="http://www.ecs.csus.edu/wcm/csc/forms.html">Forms</a>
    <a href="http://catalog.csus.edu/academic-calendar/#fall2017text">Academic Calendar</a>
</div>


</body>
</html>