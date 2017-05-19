<?php
	session_start();
	if(!(isset($_SESSION['login']) && $_SESSION['login'] != '')){
		//print "thhsfg";
		header("Location: ../login/login.php");
	}

	$db_handle = mysql_connect('127.0.0.1','root','');
	$db_found = mysql_select_db('ls',$db_handle);
?>

<html>
<head>
<meta charset="UTF-8">
        <title> <?php
					$prof = $_GET['n'];
					$SQL = "SELECT * FROM users WHERE userName = '$prof'";
					
					$res = mysql_query($SQL);
					$det = mysql_fetch_assoc($res);

					$name = $det['userName'];
					echo $_GET['n'] . "'s Profile";
				?>
		</title>
	    <!-- BootStrap3 -->
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../css/bootstrap-grid.css">
		<link rel="stylesheet" href="../css/bootstrap-reboot.css">
		<!-- Resetting library -->
		<link rel="stylesheet" href="../css/normalize.css">
		    
		<!-- Fonts Library -->
		<link rel="stylesheet" href="../css/font-awesome.min.css">
		    
		<!-- My Styles -->
	    <link rel="stylesheet" href="../css/main.css">
	    <link rel="stylesheet" href="../css/subs.css">
	    <link rel="icon" href="../Images/icon.png">
	    <link rel="stylesheet" href="../css/fonts.css">
</head>
<body>

	<div class="container-fluid">
    		<div class="row"><div class="header">
    			<a href="../home.php" class="home"><big><big class="col-xs-6" style="color:white;">Learners Society</big></big></a>
    			<div style="float:right;">
	    			<span class="col-xs-3" style="color:#FF9">
    					<a class="but" href="../logout.php">Logout</a>
    				</span>
    			</div>
    			<div style="float:right;">
	    			<span class="col-xs-3" style="color:#FF9">
    					<a class="but" href="search.php">Search</a>
    				</span>
    			</div>
    			<div>
    				<span class="col-xs-3" style="color:#FF9; float:right">
    					<?php
    						$you =  "<a href='profile.php?n=" . $_SESSION['user'] ."' id='you'>" . $_SESSION['user'] ."</a>";
    						echo $you;
    						//echo "Hello, ". $_SESSION['user'] . "</a>"
    					?>
    				</span>
    			</div>
    		</div></div>
    </div>
	<br><br><br><br><br><br>	

	<h2 style="color:white; padding:10px; text-align:center; margin:auto; border:3px solid white; width:50%">
	<?php
		$prof = $_GET['n'];
		$SQL = "SELECT * FROM users WHERE userName = '$prof'";

		$res = mysql_query($SQL);
		$det = mysql_fetch_assoc($res);

		$name = $det['realName'];
		echo $name;
	?>
	 's Profile</h2><br><br>
	
	<div class="container profile">

			<?php

				$prof = $_GET['n'];
				$SQL = "SELECT * FROM users WHERE userName = '$prof'";
				
				$res = mysql_query($SQL);
				$det = mysql_fetch_assoc($res);
				$name = $det['realName'];
				$profname = $det['userName'];
				$scr = $det['score'];
				$stat = $det['status'];
				$school = $det['school'];
				$about = $det['about'];
				$pic = $det['picture'];

				if($pic=='../Images/'){
					echo ('
						<div class="row"><div class="col-xs-6 pic">'.
		 					'<img class="img-responsive" src="../Images/defimg.png" alt="Profile Picture">
		 				</div></div>
					');
				}else{
					echo ('
						<div class="row"><div class="col-xs-6 pic">
		 					<img style="border-radius:2%" class="img-responsive img-circle" width="236" height="236" src="'.$pic.'" alt="Profile Picture2">
		 				</div></div>
					');
				}

				if(is_null($scr)){
					echo ("
					 	<b>Real name (User name) : </b><span> $name ($profname)</span><br>
					 	<b>Score : </b><span>0</span><br>
					 ");
				}else{
					echo ("
					 	<b>Real name (User name) : </b><span> $name ($profname)</span><br>
					 	<b>Score : </b><span>$scr</span><br>
					 ");
				}


				if($scr<50) echo "<b>Rank : </b><span>*</span><br>";
				else if($scr>=50 && $scr<100) echo "<b>Rank : </b><span>**</span><br>";	
				else if($scr>=100 && $scr<300) echo "<b>Rank : </b><span>***</span><br>";
				else if($scr>=300 && $scr<800) echo "<b>Rank : </b><span>****</span><br>";
				else if($scr>=800 && $scr<1500) echo "<b>Rank : </b><span>*****</span><br>";	
				else if($scr>1500) echo "<b>Rank : </b><span>Hero</span><br>";		
				echo ("	
					 	<b>Status : </b><span>$stat</span><br>
					 	<b>School : </b><span>$school</span><br>
					 	<b>About : </b><br><span>$about</span><br>
					 ");
		 	?>
	</div>
	<br>
	<div style="border-top:2px solid white; color:white">
			<center>Learners Society - 2017
			<a href="contact.php">Contact Us</a></center>
		</div>

</body>
</html>