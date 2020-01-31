<?php
if((int)$_SESSION['admin'] == 0){
    header('location: denied.php');
}
?>