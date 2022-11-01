<?php
include ("config.php");
include 'functions.php';

//Barrier Code
if(!isset($_SESSION["pin"])){
	echo "Please set a pin.";
	header("refresh:3; url=zpin1.php");
	exit("...");
}

//Error Reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
?>

<!-- Creating Border  -->
<meta charset="UTF-8">
<style>
	form {border: 3px solid red; width: 50%;
			margin:auto; margin-top: 5em;}
			
	#account,#amount{display: none;}
</style>


<!-- Form and Assigning Choices -->
<form action = "zservice2.php" >

	<select name ="menu" id="menu">
		<option value="S" > Select </option>
		<option value="LT" > List Transaction </option>
		<option value="LA" > List Accounts </option>
		<option value="C" > Clear </option>
		<option value="D" > Deposit </option> <br><br>
		<option value="W" > Withdraw </option>
		</select><br><br>

<div id="account"><input type= text name ="account" >account</div>
<div id="amount"><input type= text name ="amount" >amount</div>

<input type=submit>
</form>

<!-- Input Boxes Visiblity -->
<script>
var ptrMenu = document.getElementById("menu")
	ptrMenu.addEventListener("change", F)
	
var ptrAccount = document.getElementById("account")
var ptrAmount = document.getElementById("amount")

	
function F(){
	var v = this.value;
	if(v=="S") {ptrAccount.style.display="none"
				ptrAmount.style.display="none";}
	if(v=="LT") {ptrAccount.style.display="none";
				ptrAmount.style.display="none";}
	if(v=="LA") {ptrAccount.style.display="none";
				ptrAmount.style.display="none";}
	if(v=="C"){ptrAccount.style.display="block";
				ptrAmount.style.display="none";}
	if(v=="D"){ptrAccount.style.display="block";
				ptrAmount.style.display="block";}
	if(v=="W"){ptrAccount.style.display="block";
				ptrAmount.style.display="block";}
}
</script>