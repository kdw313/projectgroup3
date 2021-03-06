<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		mysql_close();
		die("Unable to select database");
	}
	
	
	//Sanitize the REQUEST values - parameters may come from GET or POST
	$username = clean($_REQUEST['username']);
	$password = clean($_REQUEST['password']);
	
	// in case page referrer is not login page
	if($_SERVER['HTTP_REFERER'] == '') {
		mysql_close();
		header("location: ".HOMEURL);
		exit();
	}

	//Input Validations
	if($username == '') {
		$errmsg_arr[] = 'Username missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}

	//If there are input validations, redirect back to the login form
	if($errflag) {  
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		mysql_close();
		header("location: login.php");
		exit();
	}

	//Create query
	$qry="SELECT * FROM members WHERE username='$username' AND passcode='".md5($_REQUEST['password'])."'";

	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {

		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_USERNAME'] = $member['username'];
//			$_SESSION['SESS_PASSCODE'] = $member['passcode'];
			session_write_close();
			mysql_close();

			header("location: ".HOMEURL);
			exit();
		}else {
			//Login failed
			$errmsg_arr[] = 'Username or password wrong.';
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			mysql_close();
			header("location: login.php");
			exit();
		}
	}else {
		die("Query failed");
	}

?>
