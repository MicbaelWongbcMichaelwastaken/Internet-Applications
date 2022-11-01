<?php
include ("config.php");
include 'functions.php';

//Barrier Code
if(!isset($_SESSION["logged"])){
	echo"<br><br>Redirecting to auth.php";
	header("refresh:3 ; url=auth.php");
	exit();
	}

//Error Reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

//randomly generate pin
$pin=mt_rand(10000,99999);
$_SESSION["pin"]=$pin;

//email pin
$to = "mw382@njit.edu";
$subject = "PIN";
$message = $pin;
mail($to, $subject, $message);

echo"<br>PIN is $pin.<br>";
?>

<!-- Form -->
<style>
	form {border: 3px solid red; width: 50%;
			margin:auto; margin-top: 5em;}
			
	#account,#amount{display: none;}
</style>

<form action = "zpin2.php">
	<input type = text name = "pin"> Enter PIN<br>
	<input type = submit>
</form>