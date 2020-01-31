<?php
$servername = 'athena.ecs.csus.edu';
$db_username = 'thedeliverers';
$db_password = 'thedeliverers_db';
$db_name = 'thedeliverers';

$con = mysqli_connect($servername, $db_username, $db_password, $db_name);

if($con == false){
	echo "no connection";
}
?>