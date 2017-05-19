<?php
	session_start();
	if(isset($_SESSION['login']) && $_SESSION['login'] = '1'){
		//print "thhsfg";
		header("Location: ../subs.php");
	}
?>

<html>
<head>
	<title>Register</title>
	<meta charset="UTF-8">
    <!-- BootStrap3 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<!-- Resetting library -->
	<link rel="stylesheet" href="../css/normalize.css">    
	<!-- Fonts Library -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">	    
	<!-- My Styles -->
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="icon" href="../Images/icon.png">
</head>
<body dir="ltr">
    	
    	<div class="container-fluid">
    		<div class="raw header">
    			<a href="../home.php" class="home"><big><big class="col-xs-6" style="color:white;">Learners Society</big></big></a>
    			<div style="float:right;">
	    			<!--<span class="col-xs-3" style="color:#FF9">
	    				<a style="border-radius:3px; border:2px solid #555; cursor:pointer; color:#555; text-decoration:none; background-color:#DDD; padding:2px 5px" href="#">Guest</a>
	    			</span>-->
	    			<span class="col-xs-3" style="color:#FF9">
	    				<a class="but" href="../login/login.php">Login</a>
	    			</span>
	    			<span class="col-xs-3" style="color:#FF9">
	    				<a class="but" href="../register/register.php">Register</a>
	    			</span>
    			</div>
    		</div>
    	</div>

    	<h2 style="color:white; padding:10px; text-align:center; margin:auto; border:3px solid white; width:50%">Register</h2><br>
		
		<div class="container" 
			style="margin: 10px auto; background: rgba(0, 0, 0, 0.25);background-size: 70%; border-radius: 2%;"
		>
			<form method="post" action="register.php" class="reg" enctype="multipart/form-data">
				<div class="container">
					<input type="hidden" name="size" value="1000000">
					<span style="color: white; float:left;">Username <b style="color:#F11">*</b>:</span> <input placeholder="Enter Username" type="text" name="name" style='float:right' required>
					<span style="color: white;  float:left;">Email <b style="color:#F11">*</b>:</span> <input placeholder="Enter Email" type="email" name="email" style='float:right' required>
					<span style="color: white; float:left;">Password <b style="color:#F11">*</b>:</span> <input autocomplete="off" placeholder="Enter Password" type="password" name="pass" style='float:right' required>
					<span style="color: white; float:left;">Real Name :</span> <input placeholder="What your name?" type="text" name="real" style='float:right'>
					<span style="color: white; float:left;">Status : </span>
					<select name="status" style="width:100%">
						<option>Undergraduate</option>
						<option>Graduate</option>
					</select>
					<span style="color: white; float:left;">School and Major :</span> <input placeholder="Enter your school and Major" type="text" name="school" style='float:right'>
					<!--<span class="col-xs-3" style="color:#FF9"></span>-->
					<span style="color: white; float:left; padding: 5px 0 5px">Profile Picture :</span><br><br><input type="file" name="img">
    				<span style="color: white; float:left; padding-bottom: 10px">About : </span>
    				<textarea name="about" rows="5" style="width:100%; padding: 10px" placeholder="Who are you? Write Briefly."></textarea>
    				<button type="submit" class="sub" name="reg" value="Register">Register</button>
    			</div>
				<br></span>
			</form>
		</div>

		<div class="container-fluid" style="text-align:center; color:white;">
		<?php
			$db_handle = mysql_connect('127.0.0.1','root','');

			$db_found = mysql_select_db('ls',$db_handle);

			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$uname = $_POST['name'];
				$email = $_POST['email'];
				$pword = $_POST['pass'];
				$stat = $_POST['status'];
				$sch = $_POST['school'];
				$who = $_POST['about'];
				$real = $_POST['real'];
				$pic = $_FILES['img']['name'];

				//echo $pic . "<br>";

				$img = "../Images/" . basename($pic);

				$uname = htmlspecialchars($uname);
				$email = htmlspecialchars($email);
				$pword = htmlspecialchars($pword);
				$stat = htmlspecialchars($stat);
				$sch = htmlspecialchars($sch);
				$who = htmlspecialchars($who);
				$real = htmlspecialchars($real);

				$errormsg = 0;

				// validate username
				$SQL = "SELECT userName FROM users WHERE userName = '$uname'";
				$names = mysql_query($SQL);

				$res = mysql_num_rows($names);

				if($res > 0) $errormsg += 1;

				$res = "";

				// validate email
				$SQL = "SELECT userEmail FROM users WHERE userEmail = '$email'";
				$passes = mysql_query($SQL);

				$res = mysql_num_rows($passes);

				if($res > 0) $errormsg += 2;

				if($errormsg > 0){
					//echo '<script>alert("Invalid username or password.");</script>';
					if($errormsg==1)
						echo '<script> alert("Username has already been used") </script>';
					if($errormsg==2)
						echo '<script> alert("Email has already been used") </script>';
					if($errormsg==3)
						echo '<script> alert("Username & Email have already been used") </script>';
					header("Refresh:0");
					//echo "Hello";
				}
				else{
					$SQL ="INSERT INTO users(userName,userEmail,userPass,picture,status,school,about,realName) 
										values('$uname','$email','$pword','$img','$stat','$sch','$who','$real')";
					$result = mysql_query($SQL);

					if(isset($_POST['reg'])){
						if( move_uploaded_file($_FILES['img']['tmp_name'], $img) ){
							echo "Ok.";
						}
					}

					if($result){
						session_start();
						$_SESSION['login'] = '1';
						$_SESSION['user'] = $uname;
						header("Location: ../subs.php");
					}
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