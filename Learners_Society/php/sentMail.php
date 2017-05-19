<?php

	session_start();

	$db_handle = mysql_connect('127.0.0.1','root','');
	$db_found = mysql_select_db('ls',$db_handle);

	$usr = $_POST['username'];
	$msg = $_POST['message'];

	$SQL = "INSERT INTO contactmessages(user,msg) VALUES ('$usr','$msg')";

	mysql_query($SQL);

	header("Location: ../home.php");
?>