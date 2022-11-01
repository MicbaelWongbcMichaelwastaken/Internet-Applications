<?php
function safe($fieldname) //For brevity no DB connection
{global $gooddata;
$gooddata=true;
	$v = $_GET[$fieldname];
	$v = trim($v);
	//$v = mysqli_real_escape_string($db, $v);
	echo "<br>$fieldname is $v";
	
	if($fieldname=="ucid")
	{ $count = preg_match('/^[a-z]{2,4}[0-9]{0,3}$/', $v, $matches);
		if ($count == 0)
		{ $gooddata = false; echo "bad ucid";
	return "Illegal ucid format.";
	}
}
	return $v;
}


$gooddata = true;

	$ucid = safe("ucid"); //tested also by preg
	
	$pass = safe("pass"); //no added preg data
	
	if(!$gooddata){echo"<br>Bad input"; exit();}
	
	
	
	echo"<br>Continue"