<?php
include ("config.php");
include 'functions.php';

//Barrier Code
if(!isset($_SESSION["pin"])){
	echo"<br><br>Redirecting to zpin1.php";
	header("refresh:3 ; url=zpin1.php");
	exit();
	}

//Error Reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
include("account.php");

//MySQL verify connection
include (  "account.php"     ) ;
$db = mysqli_connect($hostname, $username, $password, $project);
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL: ".mysqli_connect_error();
	exit();
}
print"Successfully connected to MySQL.<br><br><br>";
mysqli_select_db($db,$project);


$pin = $_GET["pin"]; echo "<br>pin: $pin"; $pin=mysqli_real_escape_string($db, $pin);
$pinreal = $_SESSION["pin"];

//Checks if pin is correct
if($pinreal != $pin){
		echo"<br><br>Bad pin. Redirecting to zpin1.php";
		header("refresh:3 ; url=zpin1.php");
		exit();
}

else{
	$_SESSION["identity"]=true;
	echo"<br><br>Good pin. Redirecting to zservice1.php";
	header("refresh:3 ; url=zservice1.php");
	exit();
;}

echo"<br>PIN is $pin.<br>";

?>