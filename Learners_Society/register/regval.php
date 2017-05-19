<?php

	$db_handle = mysql_connect('127.0.0.1','root','');

	$db_found = mysql_select_db('ls',$db_handle);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$uname = $_POST['name'];
		$email = $_POST['email'];
		$pword = $_POST['pass'];

		$uname = htmlspecialchars($uname);
		$email = htmlspecialchars($email);
		$pword = htmlspecialchars($pword);

		$errormsg = "";

		// validate username
		$SQL = "SELECT userName FROM users WHERE userName = '$uname'";
		$names = mysql_query($SQL);

		$res = mysql_num_rows($names);

		if($res > 0) $errormsg .= "this username is already used<br>";

		// validate email
		$SQL = "SELECT userEmail FROM users WHERE userEmail = '$email'";
		$passes = mysql_query($SQL);

		$res = mysql_num_rows($passes);

		if($res > 0) $errormsg .= "this email is already used<br>";

		if($errormsg != ""){
			print '<center>' . $errormsg . "<a href='register.php'>Register Again</a></center>";
		}
		else{
			$SQL = "INSERT INTO users(userName,userEmail,userPass) values('$uname','$email','$pword')";
			$result = mysql_query($SQL);

			if($result){
				session_start();
				$_SESSION['login'] = '1';
				header("Location: ../subs.php");
			}
		}
	}
?>