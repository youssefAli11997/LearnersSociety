<?php
	session_start();
	if(isset($_SESSION['login']) && $_SESSION['login'] = '1'){
		//print "thhsfg";
		header("Location: ../subs.php");
	}
?>

<html>
<head>
	<title>Login</title>
	<meta charset="UTF-8">
    <!-- BootStrap3 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<!-- Resetting library -->
	<link rel="stylesheet" href="../css/normalize.css">    
	<!-- Fonts Library -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">	    
	<!-- My Styles -->
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="icon" href="../Images/icon.png">
</head>
<body>
<body dir="ltr">
    	
    	<div class="container-fluid">
    		<div class="raw header">
    			<a href="../home.php" class="home"><big><big class="col-xs-6" style="color:white;">Learners Society</big></big></a>
    			<div style="float:right;">
	    			<!--<span class="col-xs-3" style="color:#FF9">
	    				<a style="border-radius:3px; border:2px solid #555; cursor:pointer; color:#555; text-decoration:none; background-color:#DDD; padding:2px 5px" href="#">Guest</a>
	    			</span>-->
	    			<span class="col-xs-3" style="color:#FF9">
	    				<a class="but" href="login.php">Login</a>
	    			</span>
	    			<span class="col-xs-3" style="color:#FF9">
	    				<a class="but" href="../register/register.php">Register</a>
	    			</span>
    			</div>
    		</div>
    	</div>

		<br>

		<h2 style="color:white; padding:10px; text-align:center; margin:auto; border:3px solid white; width:50%">Login</h2><br>


		<div class="container" 
			style="margin: 10px auto; background: rgba(0, 0, 0, 0.25); border-radius: 2%;"
		>
			<form method="post" class="log">
				 <div class="raw">
					<span style="color: white; float:left">Username :</span> <input required placeholder="Enter Username" type="text" name="name" style="float:right"><br><br>
					<span style="color: white; float:left">Password :</span> <input autocomplete="off" required placeholder="Enter Password" type="password" name="pass" style="float:right"><br><br>
					<span class="col-xs-3" style="color:#FF9">
    					<button type="submit" class="sub">Login</button>
    				</span>
    			</div><br>
			</form>
		</div>
		<div class="container-fluid" style="text-align:center; color:white;">
			<?php

				$db_handle = mysql_connect('127.0.0.1','root','');

				$db_found = mysql_select_db('ls',$db_handle);

				if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
							//print "<p>Invalid username or password. <a href='../register/register.php'>Register</a></p>";
							echo '<script>alert("Invalid username or password.");</script>';
							//session_start();
							//$_SESSION['login'] = '';
							header("Refresh:0");
						}

					}else{
						//print "<p>Invalid username or password. <a href='../register/register.php'>Register</a></p>";
						echo "<script>alert('Invalid username or password.');</script>";
						//session_start();
						//$_SESSION['login'] = '';
						header("Refresh:0");
					}
				}
			?>
		</div>

		<div style="border-top:2px solid white; color:white">
			<center>Learners Society - 2017</center>
		</div>
	
		<!-- jQuery LIbrary -->
		<script href="Js/jquery-3.0.0.min.js"></script>
		
		<!-- My Javascript File -->
		<script src="Js/plugins.js"></script>
    </body>
</html>