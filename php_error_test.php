<?php
include 'log_config.php';

echo "Starting to Test:\n";
$conn = new mysqli('athena.ecs.csus.edu','bridge_user','wrong_password','bridge');
echo "END TEST";
?>
