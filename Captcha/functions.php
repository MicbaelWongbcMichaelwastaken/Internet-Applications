<?php
include ("config.php");

function safe($fieldname)
{
	global $gooddata;
	$v = $_GET[$fieldname];
    $v = trim($v);
	echo "<br>$fieldname is $v";
	if($fieldname=="ucid"){ 
		$count = preg_match('/^[a-z]{2,4}[0-9]{0,3}$/', $v, $matches);
		if ($count == 0){
            $gooddata = false;
            echo ("bad ucid");}
}
//safeAmount() except it's just part of safe
if($fieldname =="amount"){
    $count = preg_match('/^[0-9]+(?:.[0-9]{1,3})?$/im', $v, $matches);
    if($count == 0){
        $gooddata = false;
        echo "Illegal amount format.";}
}
	return $v;
}

function authenticate($ucid, $pass, $db) {
	$s = "select * from users where ucid = '$ucid'";
	echo "<br>sql insert statement is: $s<br><br>";
	($t = mysqli_query($db, $s)) or die(mysqli_error($db));
	echo"<br>SQL select succeeded";

    //Check UCID
    $count = mysqli_num_rows( $t);
	if($count == 0) { 
        return false;
    }

    //Check Password
    $row = mysqli_fetch_array($t, MYSQLI_ASSOC);
    $hash = $row['hash'];
    return password_verify($pass, $hash);

}

function list_transactions($ucid, $db){
	$s = "select * from transactions where ucid = '$ucid'";
	echo "<br>sql select transactions for $ucid: $s<br><br>";
	
	($t = mysqli_query($db, $s)) or die(mysqli_error($db));
	$num = mysqli_num_rows($t);
	echo"<br>SQL list transactions";

	while($r = mysqli_fetch_array($t, MYSQLI_ASSOC)){
		$timestamp = $r["timestamp"];
		$account = $r["account"];
		$amount = $r["amount"];
		echo"<br> ucid: $ucid || account: $account || amount: $amount || timestamp: $timestamp<br>";
	};
	mysqli_free_result($t);
}

function list_accounts($ucid, $db){
	$sql = "select * from accounts where ucid = '$ucid'";
	echo "<br><i>SQL select accounts for $sql: </i><br><br>";
	($run = mysqli_query($db, $sql)) or die (mysqli_error($db));
	
	while($r = mysqli_fetch_array($run, MYSQLI_ASSOC)){
		$mrt = $r["mostRecentTransaction"];
		$account = $r["account"];
		$amount = $r["balance"];
		if ($amount<0){
			$finalAmount = "-$" . abs($amount);
		}
		else{
			$finalAmount = "$" . $amount;
		}
		echo"<br> ucid: $ucid || account: $account || amount: $amount || most recent transaction: $mrt<br>";
	}
}

function clear($ucid, $account, $db){
	$sql = "delete from transactions where ucid = '$ucid' and account = '$account'";
	echo "<br><i>SQL to delete transactions: $sql </i><br><br>";
	($run = mysqli_query($db, $sql)) or die(mysqli_error($db));
}

function PerformTransaction($ucid,$account,$amount,$db){
		
		$s= "update accounts
					set balance = balance+ '$amount', mostRecentTransaction = NOW()
					where
						ucid = '$ucid'
						and account = '$account'
						and balance + '$amount' >= 0
						";
		echo "sql update is: $s<br><br>";
		($t = mysqli_query($db, $s)) or die(mysqli_error($db));
		
		$count = mysqli_affected_rows($db);
		if($count==0){ echo"Not updated: "; return;}
		
		$s = "insert into transactions values ('$ucid', '$account', '$amount', NOW())";
		echo "sqlupdate is:$s<br><br>";
		($t = mysqli_query($db,$s)) or die(mysqli_error($db));
}
?>