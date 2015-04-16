<?php
session_start();
if($_POST['password'] === "women%$1354"){
	$_SESSION['userid'] = 1;
	header("Location:index.php");
} else {
	header("Location:login.php");
}