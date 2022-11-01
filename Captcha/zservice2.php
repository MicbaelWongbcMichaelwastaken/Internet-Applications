<?php
include ("config.php");
include 'functions.php';

//barrier code
if(!isset($_SESSION["pin"])){
	echo "Please set a pin.";
	header("refresh:3; url=zpin1.php");
	exit("...");
}

//Error Reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

//MySQL connection/verification
include (  "account.php"     ) ;
$db = mysqli_connect($hostname, $username, $password, $project);
if(mysqli_connect_error()){
	echo "Failed to connect to MySQL: ".mysqli_connect_error();
	exit();
}
mysqli_select_db($db, $project ); 

//getting safe values
$ucid = $_SESSION["ucid"];
$menu = safe("menu");

//decision logic 
if($menu=="LT"){echo"LT<br>"; list_transactions($ucid,$db);}
if($menu=="LA"){echo"LA<br>"; list_accounts($ucid,$db);}
if($menu=="C"){echo"Clear<br>"; $account=safe("account");
	Clear($ucid,$account,$db);}
if($menu == "D") { echo "D<br>";$amount=safe("amount"); $account=safe("account"); 
	PerformTransaction($ucid, $account, $amount, $db);}
if($menu == "W") { echo "W<br>"; $amount=safe("amount");$account=safe("account"); 
	PerformTransaction($ucid, $account, -$amount, $db);}


?>


<a href="zservice1.php">Back</a>
<a href="logout.php">Logout</a>