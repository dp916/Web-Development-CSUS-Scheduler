<?php
session_start();

if (!isset($_SESSION['username'])) {
	header('location: login.php');
}
$time = $_SERVER['REQUEST_TIME'];
$time_out_minutes = 15;

$time_out = 60 * $time_out_minutes;

if(isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY'] > $time_out)){
	session_unset();
	session_destroy();
	header('location: login.html');
}
$_SESSION['LAST_ACTIVITY'] = $time;

?>
<?php
  date_default_timezone_set('America/Los_Angeles');
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<html>
	<head>

	<title>Admin Home</title>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 50px;
    text-align: left;
}
* {
    box-sizing: border-box;
}

body{
    margin: 0;
}

</style>
</head>
<body style="position: relative; min-height: 100%; top: 0px;">

<div class="row" style="background-color: #F0E1B0">
    <div class="top">
        <div style="width: 100% ">
            <h1>Header</h1>
            <form action="logout.php">
                <input type="submit" class="button button1" style="width: 50%";" value="Logout"/>
            </form>
        </div>
    </div>
    <div class="column left" style="background-color: #4CAF50; height: 100%; text-align: center">
        <h1 style="font-size:30px;">Admin Home</h1>
		<p>"Advisor's name"<br>"Admin's email"<br></p>

    </div>
    <div class="column right" style="background-color: #b4aa50; height: 100%; text-align: center">
        <p>appointments</p>
        <?php
			include 'calendar.php';
	
			$calendar = new Calendar();
			$calendar->show();
		?>
    </div>
</div>

</body>	
</html>