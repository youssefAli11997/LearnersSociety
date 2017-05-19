<?php

	session_start();

	$db_handle = mysql_connect('127.0.0.1','root','');

	$db_found = mysql_select_db('ls',$db_handle);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$newhead = $_POST['newHead'];
		$newpost = $_POST['newPost'];
		$newtopic = $_POST['topic'];
		//$user = $_POST['postU'];
		$user = $_SESSION['user'];
		$datep = date("Y/m/d");

		$newhead = htmlspecialchars($newhead);
		$newpost = htmlspecialchars($newpost);
		$user = htmlspecialchars($user);

		$SQL = "INSERT INTO posts(postHead,postCont,topic,postUser,postDate) values ('$newhead','$newpost','$newtopic','$user','$datep')";
		$result = mysql_query($SQL);

		if($result)
			header('Location: ../subs.php');

	}
?>