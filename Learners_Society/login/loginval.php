<?php

	$db_handle = mysql_connect('127.0.0.1','root','');

	$db_found = mysql_select_db('ls',$db_handle);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		global $uname;
		$uname = $_POST['name'];
		$pword = $_POST['pass'];

		$uname = htmlspecialchars($uname);
		$pword = htmlspecialchars($pword);

		$SQL = "SELECT * FROM users WHERE userName = '$uname' AND userPass = '$pword'";
		$result = mysql_query($SQL);

		if($result){
			$num_rows = mysql_num_rows($result);

			if($num_rows > 0){
				print "Logged in. Hello, $uname !";
				session_start();
				$_SESSION['login'] = '1';
				$_SESSION['user'] = $uname;
				header("Location: ../subs.php");
			}else{
				print "<center>No such user. <a href='../register/register.php'>Register</a> <a href='login.php'>Login</a></center>";
				session_start();
				$_SESSION['login'] = '';
			}

		}else{
			print "<center>No such user. <a href='../register/register.php'>Register</a> <a href='login.php'>Login</a></center>";
			session_start();
			$_SESSION['login'] = '';
		}
	}
?>