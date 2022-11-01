<?php
$zip=$_GET["zip"];
$url="http://api.openweathermap.org/data/2.5/weather?zip=$zip,us&units=imperial&APPID=dde48d23fde6be800380a91e020499fb";
$file = fopen($url,"r");
$contents = "";
while($more = fread($file,1000)){
    $contents .= $more;
}
echo($contents);
?>