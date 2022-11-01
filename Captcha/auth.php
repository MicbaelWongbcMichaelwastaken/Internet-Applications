
<?php
//begin session
include ("config.php");
include ('functions.php');

//barrier code
if(!isset($_SESSION["captchapassed"])){
	echo"<br><br>Redirecting to auth.php";
	header("refresh:3 ; url=auth.php");
	exit();
	}
//error reporting
error_reporting(E_ALL);
include ("account.php");

//database code
$db = mysqli_connect($hostname, $username, $password, $project);
if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
echo "Successfully connected to MySQL.<br><br><br>";

mysqli_select_db($db, $project ); 

//making ucid safe
$ucid = safe("ucid");

//gooddata, making password safe, redirecting
$gooddata = true;
$password = safe("password");
if($gooddata){
    if (authenticate($ucid, $password, $db) == true){
        echo "<br><br>Credentials Valid";
        $_SESSION["logged"] = true;
        $_SESSION["ucid"] = $ucid;
        header("refresh: 3; url=zpin1.php");
        exit();
    }
    else{
        echo("<br> bad input.<br>");
    }
}
?>

<!-- HTML Code -->

<!-- Border Creation -->
<style>
	form {border: 3px solid red; width: 50%;
			margin:auto; margin-top: 5em;}
			
	#account,#amount{display: none;}
</style>

<!-- Form -->
    <form action = "auth.php">
	<h3> LOGIN <br></h1>
        UCID:<input type = text name = "ucid" autocomplete = "off" value =<?php if (isset($ucid)){echo($ucid);}?>> <br>
        Password:<input type = text name = "password" autocomplete = "off" value =<?php if (isset($password)){echo($password);}?>> <br>
        <input type = "submit" value = "Login"> 
    </form>