<?php include 'log_config.php'; ?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">


<body>
<div class="topnav">
    <a class="active" href="http://athena.ecs.csus.edu/~deliver/home.php">Home</a>
    <a href="http://athena.ecs.csus.edu/~deliver/calendar.php">Appointments</a>
    <a href="http://athena.ecs.csus.edu/~deliver/logout.php">Logout</a>
</div>




<div class="navbar">
  <a href="#help" class="active">Helpful Links</a>
  <a href="http://www.ecs.csus.edu/wcm/csc/index.html">ECS Homepage</a>
  <a href="http://www.ecs.csus.edu/wcm/csc/academic/advising.html">Advising</a>
  <a href="http://www.ecs.csus.edu/wcm/csc/Faculty%20Information/facultyofficehours.pdf">Faculty Hours</a>
  <a href="http://www.ecs.csus.edu/wcm/csc/forms.html">Forms</a>
  <a href="http://catalog.csus.edu/academic-calendar/#fall2017text">Academic Calendar</a>
</div>

<div style="padding-left: 40%">
    <form method="post" action="appointments.php">
        <?php require 'error.php';?>

	<div class="row">
		<div class="col-25">
			<label for="type"><h3>Advising Type:</h3></label>
		</div>
		<div class="col-25">

			<select  id="type" name="type">
                <option value="0">Select Type</option>
                <?php
                require 'dbConnect.php';
                foreach (mysqli_query($con, "SELECT type FROM advisingtype") as $result){
                    echo '<option value="'.$result['type'].'">'.$result['type'].'</option>';
                }
                ?>
			</select>

		</div>
	</div>


	<div class="row">
		<div class="col-25">
			<label for="major"><h3>Select Your Major:</h3></label>
		</div>
		<div >
			<select id="major" name="major">
                <option value="0" >Select Major</option>
                <?php

				foreach (mysqli_query($con, "SELECT major FROM majors") as $result){
					echo '<option value="'.$result['major'].'">'.$result['major'].'</option>';
				}

				?>
			</select>

		</div>
	</div>



	<div class="row">
		<div class="col-25">
			<label for="advisor"><h3>Select An Advisor:</h3></label>
		</div>
		<div class="col-75" style="padding-bottom: 20px">
			<select id="advisor" name="advisor">
                <option value="0">Select Advisor</option>
                <option value="100">Any Advisor</option>
				<?php
				foreach (mysqli_query($con, "SELECT l_name, f_name, advisorkey FROM advisors") as $result){
					echo '<option value="'.$result['advisorkey'].'">'.$result['l_name'].', '.$result['f_name'].'</option>';

				}
				$con->close();
				?>
			</select>
            
		</div>
	</div>

	<button type="submit" name="searchApp" class="button">Search</button>
    </form>
</div>
</body>
</html>
