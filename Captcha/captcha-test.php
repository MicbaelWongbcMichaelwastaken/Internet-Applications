<?php
include ("config.php");
$captcha = $_SESSION["captcha"];
$guess = $_GET["guess"];

//good captcha redirect
if($captcha == $guess){
	echo "Good redirect";
	$_SESSION["captchapassed"]= true;
	header("refresh: 3; url = nonexistant.php");
	exit();
}
//bad captcha redirect to self
else{
	echo "Bad redirect";
	header("refresh: 3; url = captcha.html");
	exit();
}



?>