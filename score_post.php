<?php
require_once('config.php');

// Connect to server and select database.
mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)or die("cannot connect");
mysql_select_db(DB_DATABASE)or die("cannot select DB");
$tb_name="leaderboards"; // Table name

$gameMode=$_GET['gameMode'];
$username=$_GET['username'];
// get values that sent from form
$score=base64_decode(@$_GET['random']);

$datetime=date("d/m/y H:i:s"); // create date and time

$username = mysql_real_escape_string($username);
$score = mysql_real_escape_string($score);

if($username == '')
    $username = 'null';

// Insert topic to database
$sql="INSERT INTO $tb_name(username, score, gamemode, datetime) VALUES('$username', '$score', '$gameMode', '$datetime')";

$result=mysql_query($sql);

if($result)

	header("Location:result.php?random=" .$_GET['random']);
else {
	echo "ERROR".mysql_error();
}

mysql_close();
?>

