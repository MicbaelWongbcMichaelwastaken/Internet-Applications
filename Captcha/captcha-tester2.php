<?php
include ("config.php");

//if form data is recieved
if(isset($_GET["guess"])){
    $captcha = $_SESSION["captcha"];
    $guess = $_GET["guess"];

    //correct captcha redirect
    if($captcha == $guess){
        echo "Good redirect";
        $_SESSION["captchapassed"]= true;
        header("refresh: 3; url = auth.php");
        exit();
        }
    //bad captcha redirect to self
    else{
        echo "Bad redirect";
        header("refresh: 3; url = captcha-tester2.php");
        exit();
        }
}

//HTML code form code
?>
<img src="captcha.php"><br><br>
<form action = "captcha-tester2.php">
    Captcha<input type = "text" size = 10 name="guess"><br>
    <input type = "submit" value = "submit">
</form>