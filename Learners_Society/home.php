<?php

	$db_handle = mysql_connect('127.0.0.1','root','');
	$db_found = mysql_select_db('ls',$db_handle);

	/*
		Creating Database Tables
	*/

	// ContactMessages
	$SQL = "CREATE TABLE IF NOT EXISTS `ContactMessages` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `user` char(60) DEFAULT NULL,
		   `msg` varchar(500) DEFAULT NULL,
		  PRIMARY KEY (`id`)
	)";
	mysql_query($SQL);

	// Users
	$SQL = "CREATE TABLE IF NOT EXISTS `ContactMessages` (
			userId int(11) NOT NULL AUTO_INCREMENT,
			userName varchar(30),
			realName varchar(100),	
			userEmailIndex varchar(60),	
			userPass varchar(255),
			score int(11),	
			status varchar(40),
			school varchar(100),
			about varchar(500),
			picture	varchar(300),
			PRIMARY KEY (`userId`)
	)";
	mysql_query($SQL);

	// likes
	$SQL = "CREATE TABLE IF NOT EXISTS `postslikes` (
			likesId int(11) NOT NULL AUTO_INCREMENT,
			postId int(11),
			likerId	int(11),
			posterName varchar(50)
			PRIMARY KEY (`likesId`)
	)";
	mysql_query($SQL);
	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Learners Society</title>

	    <!-- BootStrap3 -->
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.css">
		<!-- Resetting library -->
		<!--<link rel="stylesheet" href="css/normalize.css">-->
		    
		<!-- Fonts Library -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		    
		<!-- My Styles -->
	    <link rel="stylesheet" href="css/main.css">
	    <link rel="stylesheet" href="css/fonts.css">
	    <link rel="icon" href="Images/icon.png">
	
	<!--[if lt IE 9]>
	    <script src="Js/html5shiv.min.js"></script>
	<![endif]-->
    </head>
    <body dir="ltr">
    	
    <div class="container-fluid">
		<div class="raw header">
			<big><big class="col-xs-6" style="color:white;">Welcome!</big></big>
			<div style="float:right;">
    			<?php
    				session_start();
    				if(isset($_SESSION['login']) && $_SESSION['login']=='1')
    					echo
    					'<span class="col-xs-3" style="color:#FF9">
    						<a class="but" href="subs.php">Enter</a>
    					</span>';
    				else
    					echo
    				   '<span class="col-xs-3" style="color:#FF9">
    					<a class="but" href="login/login.php">Login</a>
		    			</span>
		    			<span class="col-xs-3" style="color:#FF9">
		    				<a class="but" href="register/register.php">Register</a>
		    			</span>';
    			?>
			</div>
		</div>
    </div>
    	<div class="container">
			<center>
			<div class="raw cover" style="padding:50px;">
				<h1 style="color:#088CC9;" class="ls col-xs-12"><big><big>Learners Society</big></big></h1><br>
				<span style="padding:5px 10px; font:20px BioRhyme; color:white; background-color:#088CC9;">join us in our resources-sharing community</span>
			</div>
			</center>
		</div>

		<footer class="container-fluid about">
			<h3 class="raw" style='color:white;'>Who we are ?</h3>
			<p class="raw" style="color:white;">
				We are first-year Computers and Systems Engineering students from Alexandria University, Egypt<br>
				This site was designed mainly to supply learners in different fields with some good resources
				to make<br> the learning process easier and more productive.<br>
				So, join us to make benefit yourself and benefit other learners with the best resources you know.
			</p>
		</footer>

		<div class="container">
			<p style="text-align:center; color:white;">
				Launched in 2017<br>Alexandria, Egypt
			<br><a href="php/contact.php">Contact Us</a>
			</p>
		</div>
	
		<!-- jQuery LIbrary -->
		<script href="Js/jquery-3.0.0.min.js"></script>
		
		<!-- My Javascript File -->
		<script src="Js/plugins.js"></script>
    </body>
</html>