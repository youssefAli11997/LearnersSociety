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
        <title><?php
        	$id =  mysql_real_escape_string($_GET['n']);
        	$head = mysql_query("SELECT postHead FROM posts WHERE postId = $id");
        	$res = mysql_fetch_assoc($head);
        	echo $res['postHead'];
        ?> - Learners Society</title>

	    <!-- BootStrap3 -->
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.css">
		<!-- Resetting library -->
		<link rel="stylesheet" href="../css/normalize.css">
		    
		<!-- Fonts Library -->
		<link rel="stylesheet" href="../css/font-awesome.min.css">
		    
		<!-- My Styles -->
	    <link rel="stylesheet" href="../css/main.css">
	    <link rel="stylesheet" href="../css/subs.css">
	    <link rel="icon" href="../Images/icon.png">
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
    					<a class="but" href="../php/search.php">Search</a>
    				</span>
    			</div>
    			<div>
    				<span class="col-xs-3" style="color:#FF9; float:right">
    					<?php
    						$you =  "<a href='../php/profile.php?n=" . $_SESSION['user'] ."' id='you'>" . $_SESSION['user'] ."</a>";
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
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<h3 class="navh">&#9776; Categories</h3>
			<a href="../subs.php">All</a>
			<a href="tpc.php?n=Arts">Arts</a>
			<a href="tpc.php?n=Books">Books</a>
			<a href="tpc.php?n=Circuits">Circuits</a>
			<a href="tpc.php?n=Chemistry">Chemistry</a>
			<a href="tpc.php?n=Computer Engineering">Computer Engineering</a>
			<a href="tpc.php?n=Competitive Programming">Competitive Programming</a>
			<a href="tpc.php?n=Design">Design</a>
			<a href="tpc.php?n=Drawing">Drawing</a>
			<a href="tpc.php?n=Economy">Economy</a>
			<a href="tpc.php?n=Languages">Languages</a>
			<a href="tpc.php?n=Math">Math</a>
			<a href="tpc.php?n=Security">Security</a>
			<a href="tpc.php?n=Programming">Programming</a>
			<a href="tpc.php?n=Physics">Physics</a>
			<a href="tpc.php?n=Philosophy">Philosophy</a>
			<a href="tpc.php?n=Web Design">Web Design</a>
			<a href="tpc.php?n=Web Development">Web Development</a>
	</div></div></div><br>
		
		<?php

			$db_handle = mysql_connect('127.0.0.1','root','');
			$db_found = mysql_select_db('ls',$db_handle);

			$id = mysql_real_escape_string($_GET['n']);

			$SQL = "SELECT * FROM posts WHERE postID = '$id'";
			$res = mysql_query($SQL);

			while($ftch = mysql_fetch_assoc($res)){
				//$color = '#088CC9';
				$cont = $ftch['postCont'];
				$head = $ftch['postHead'];
				$dat = $ftch['postDate'];
				$usr = $ftch['postUser'];
				$tpc = $ftch['topic'];
				$lks = $ftch['postLikes'];
				$dslks = $ftch['postDisLikes'];
				$id = $ftch['postId'];

				$url = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i'; 
				$cont = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $cont);
				//echo $cont;

				$cont = nl2br($cont);

				$liker = $_SESSION['user'];

				echo "<div class='exPost container' style='background-color:white; overflow:scroll'>
				<a style='color:darkblue' href='tpc.php?n=$tpc'>$tpc</a>
				<h1 style='padding:5px; border-bottom:2px solid #555'><a style='text-decoration:none;' href='post.php?n=$id'>$head</a><span style='color:#555;font-size:15px;float:right;'>$dat</span></h1>
				
				<div><h4 style='color:#555; font-size:20px; font-family:Dosis'>By <a href='../php/profile.php?n=$usr' style='color:green'>$usr</a></h4><p>$cont</p>";
					echo"<a href='../php/processLike.php?s=1&pid=".$id."' style='float:left; padding:5px; margin:5px; text-decoration:none;";
						//check if liked already
						$SQL = "SELECT userId FROM users WHERE userName = '$liker' ";
						$acting = mysql_query($SQL);
						$acting = mysql_fetch_assoc($acting);
						$idOfLiker = $acting['userId'];
						$SQL = "SELECT * FROM postslikes WHERE postId = '$id' AND likerId = '$idOfLiker'";
						$out = mysql_query($SQL);
						$rows = mysql_num_rows($out);

						if($rows > 0){
							echo "background-color: grey; color:white' title='You liked it!'";
						}
						else echo "background-color: darkblue; color:white' title='Like it!'";
					echo ">Like</a>";

					echo"<a it' href='../php/processLike.php?s=2&pid=".$id."' style='float:left; padding:5px; margin:5px; text-decoration:none;";
						//check if disliked already
						$SQL = "SELECT * FROM postdislikes WHERE postId = '$id' AND dislikerId = '$idOfLiker'";
						$out = mysql_query($SQL);
						$rows = mysql_num_rows($out);

						if($rows > 0){
							echo "background-color: grey; color:white' title='You disliked it!'";
						}
						else echo "background-color: darkred; color:white' title='Dislike it!'";
					echo ">Dislike</a>";

					echo "<br><br><span style='padding:5px; margin:5px; color:darkblue; font-size:20px'>".$lks . '</span>'
					  	. '<span style=\'padding:5px; margin:30px; color:darkred; font-size:20px\'>' . $dslks . "</span>";

				echo"</div>
				
				
				</div>";
			}

		?>

		<div style="border-top:2px solid white; color:white">
			<center>Learners Society - 2017 - 
			<a href="../php/contact.php">Contact Us</a></center>
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