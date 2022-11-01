<?php
include ("config.php");
$path = "/~mw382/download/";
session_set_cookie_params(0, "$path", "web.njit.edu");
session_start();

$id = session_id();
echo"<br>Session on $path started with session id $id.";

$_SESSION = array();
echo"<br>Session on $path started with session id $id.";

$_SESSION = array();
session_destroy();
setcookie("PHPSESSID", "", time()-3600, $path, "", 0,0);

echo "Session terminated";
echo "<br>To see effect, reconnect to site observe new PHPSESSID is generated.";