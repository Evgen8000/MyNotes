<?php
include_once ('Controller.php');

$temp = $_SESSION['ID'];
$_SESSION['ID'] = null;
session_destroy();
setcookie("REMEMBERED", "", time()-3600);
$controller = new DBController();

mysqli_query($controller->dbConnection,"DELETE FROM remembered WHERE id = '$temp'");



include_once ('html/header.html');
include_once ('html/logout.html');