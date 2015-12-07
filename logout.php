<?php
session_start();
// $_SESSION['loginstatus']=false;
$_SESSION=array();
session_destroy();
header("Location: index.php");

?>