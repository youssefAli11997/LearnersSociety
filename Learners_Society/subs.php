<?php
	session_start();
	if(!(isset($_SESSION['login']) && $_SESSION['login'] != '')){
		//print "thhsfg";
		header("Location: login/login.php");
	}
?>

<html>
<head>
<meta charset="UTF-8">
        <title>Learners Society - All</title>
	    <!-- BootStrap3 -->
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.css">
		<!-- Resetting library -->
		<link rel="stylesheet" href="css/normalize.css">
		    
		<!-- Fonts Library -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		    
		<!-- My Styles -->
	    <link rel="stylesheet" href="css/main.css">
	    <link rel="stylesheet" href="css/subs.css">
	    <link rel="icon" href="Images/icon.png">
	    <link rel="stylesheet" href="css/fonts.css">
</head>
<body>
	
	<div class="container-fluid">
    		<div class="row"><div class="header">
    			<a href="home.php" class="home"><big><big class="col-xs-6" style="color:white;">Learners Society</big></big></a>
    			<div style="float:right;">
	    			<span class="col-xs-3" style="color:#FF9">
    					<a class="but" href="logout.php">Logout</a>
    				</span>
    			</div>
    			<div style="float:right;">
	    			<span class="col-xs-3" style="color:#FF9">
    					<a class="but" href="php/search.php">Search</a>
    				</span>
    			</div>
    			<div>
    				<span class="col-xs-3" style="color:#FF9; float:right">
    					<?php
    						$you =  "<a href='php/profile.php?n=" . $_SESSION['user'] ."' id='you'>" . $_SESSION['user'] ."</a>";
    						echo $you;
    						//echo "Hello, ". $_SESSION['user'] . "</a>"
    					?>
    				</span>
    			</div>
    		</div></div>
    </div>
	<br><br><br>
	<div class="container">
	<div class="row">
	<span style="font-size:25px; cursor:pointer; margin-left:-67px; z-index:20; position:fixed; background-color:white; padding:3px; border-radius:5px; opacity:0.5" onclick="openNav()">Show Categories</span>
	<div id="mySidenav" class="sidenav col-xs-3">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<h3 class="navh">&#9776; Categories</h3>
			<a href="subs.php">All</a>
			<a href="subjects/tpc.php?n=Arts">Arts</a>
			<a href="subjects/tpc.php?n=Books">Books</a>
			<a href="subjects/tpc.php?n=Circuits">Circuits</a>
			<a href="subjects/tpc.php?n=Chemistry">Chemistry</a>
			<a href="subjects/tpc.php?n=Computer Engineering">Computer Engineering</a>
			<a href="subjects/tpc.php?n=Competitive Programming">Competitive Programming</a>
			<a href="subjects/tpc.php?n=Design">Design</a>
			<a href="subjects/tpc.php?n=Drawing">Drawing</a>
			<a href="subjects/tpc.php?n=Economy">Economy</a>
			<a href="subjects/tpc.php?n=Languages">Languages</a>
			<a href="subjects/tpc.php?n=Math">Math</a>
			<a href="subjects/tpc.php?n=Security">Security</a>
			<a href="subjects/tpc.php?n=Programming">Programming</a>
			<a href="subjects/tpc.php?n=Physics">Physics</a>
			<a href="subjects/tpc.php?n=Philosophy">Philosophy</a>
			<a href="subjects/tpc.php?n=Web Design">Web Design</a>
			<a href="subjects/tpc.php?n=Web Development">Web Development</a>
	</div></div></div>
	
	<div>

	<h2 style="color:white; padding:10px; text-align:center; margin:auto; border:3px solid white; width:50%">All Posts</h2><br><br>
	
		<div class="newPost container">
			<h3 style="color:white">New Post</h3>
			<form method="post" action="php/addPost.php">
			<input type="text" name="newHead" placeholder="Head of your post" style="width:100%; padding:3px;" required><br><br>
			<textarea name="newPost" rows="5" style="width:100%" placeholder="Type here" required></textarea><br><br>
			<span style="color:white">Topic: </span>
			<select name="topic" required>
				<option>Arts</option>
				<option>Books</option>
				<option>Circuits</option>
				<option>Chemistry</option>
				<option>Computer Engineering</option>
				<option>Competitive Programming</option>
				<option>Design</option>
				<option>Drawing</option>
				<option>Economy</option>
				<option>Languages</option>
				<option>Math</option>
				<option>Security</option>
				<option>Programming</option>
				<option>Physics</option>
				<option>Philosophy</option>
				<option>Web Development</option>
				<option>Web Design</option>
			</select>
			<input type="submit" value="Post" class="sub">
			</form>
		</div>
		<br>
		<?php

			$db_handle = mysql_connect('127.0.0.1','root','');
			$db_found = mysql_select_db('ls',$db_handle);

			$SQL = "SELECT * FROM posts ORDER BY postId DESC";
			$res = mysql_query($SQL);

			while($ftch = mysql_fetch_assoc($res)){
				$color = '#088CC9';
				$cont = $ftch['postCont'];
				$head = $ftch['postHead'];
				$dat = $ftch['postDate'];
				$usr = $ftch['postUser'];
				$tpc = $ftch['topic'];
				$lks = $ftch['postLikes'];
				$dslks = $ftch['postDisLikes'];
				$id = $ftch['postId'];
				echo "<div class='exPost container' style='background-color:white'>
				<a style='color:darkblue' href='subjects/tpc.php?n=$tpc'>$tpc</a>
				<h1><a style='text-decoration:none;' href='subjects/post.php?n=$id'>$head</a><span style='color:#555;font-size:15px;float:right;'>$dat</span>
				<br><span style='color:#555; font-size:20px; font-family:Dosis'>By <a href='php/profile.php?n=$usr' style='color:green'>$usr</a></span></h1>
				";

				echo "<span style='padding:5px; margin:5px; color:darkblue; font-size:20px'>".$lks . '</span>'
					  	. '<span style=\'padding:5px; margin:5px; color:darkred; font-size:20px\'>' . $dslks . "</span>";
				echo "</div>";
			}

		?>
		
		</div> <!--end of posts container-->

		<div style="border-top:2px solid white; color:white">
			<center>Learners Society - 2017 - 
			<a href="php/contact.php">Contact Us</a></center>
		</div>

		<script> // show and hide categories
			function openNav() {
			    document.getElementById("mySidenav").style.width = "250px";
			}

			function closeNav() {
			    document.getElementById("mySidenav").style.width = "0";
			}
		</script>

	
		<!-- jQuery LIbrary -->
		<script href="Js/jquery-3.0.0.min.js"></script>
		
</body>
</html>