<?php
$hostname= "localhost";
$database = "test";
$username = "root";
$password = "";

$conn = mysqli_connect($hostname, $username, $password, $database);
if(!$conn){
	echo "cant connect \n";
}else{
	echo "success";
}
$year = 2017;
$month= 0;

$year = 2017;

$sql = "CREATE TABLE MyGuests (
id INT(6) UNSIGNED PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP
)";



