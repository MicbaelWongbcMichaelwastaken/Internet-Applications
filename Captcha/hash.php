<?php
include ("config.php");
$pass = $_GET["pass"];
echo "<br>pass is: $pass<br><br>";
$hash = password_hash( $pass, PASSWORD_DEFAULT);
echo "<br>hash is: $hash<br><br>";

?>