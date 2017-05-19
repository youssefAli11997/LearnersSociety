<?php

	session_start();

	$db_handle = mysql_connect('127.0.0.1','root','');
	$db_found = mysql_select_db('ls',$db_handle);

	$state = $_GET['s'];
	$pId = $_GET['pid'];

	$liker = $_SESSION['user'];

	$SQL = "SELECT postUser FROM posts WHERE postId = '$pId' ";
	$res = mysql_query($SQL);

	$num = mysql_num_rows($res);

	$SQL = "SELECT userId FROM users WHERE userName = '$liker' ";
	$acting = mysql_query($SQL);

	$acting = mysql_fetch_assoc($acting);
	$res = mysql_fetch_assoc($res);

	$pName = $res['postUser'];

	$idOfLiker = $acting['userId'];

	if($num > 0){


		if($state == 1){ // like is pressed

			$SQL = "SELECT * FROM postslikes WHERE postId = '$pId' AND likerId = '$idOfLiker'";
			$res = mysql_query($SQL);
			$rows = mysql_num_rows($res);

			if($rows > 0){ //liked it before //undo like
				$SQL = "DELETE FROM postslikes WHERE postId = '$pId' AND likerId = '$idOfLiker'";
				mysql_query($SQL);
				// update poster score
				$SQL = "UPDATE users SET score = score-1 WHERE userName = '$pName'";
				mysql_query($SQL);
				$SQL = "UPDATE posts SET postLikes = postLikes-1 WHERE postId = '$pId'";
				mysql_query($SQL);
			}

			else{
				$SQL = "INSERT INTO postslikes(postId, likerId, posterName) VALUES ('$pId', '$idOfLiker', '$pName')";
				mysql_query($SQL);
				// update poster score
				$SQL = "UPDATE users SET score = score+1 WHERE userName = '$pName'";
				mysql_query($SQL);
				//update post likes
				$SQL = "UPDATE posts SET postLikes = postLikes+1 WHERE postId = '$pId'";
				mysql_query($SQL);
			}

		}

		else if($state == 2){ // dislike is pressed

			$SQL = "SELECT * FROM postdislikes WHERE postId = '$pId' AND dislikerId = '$idOfLiker'";
			$res = mysql_query($SQL);
			$rows = mysql_num_rows($res);

			if($rows > 0){
				$SQL = "DELETE FROM postdislikes WHERE postId = '$pId' AND dislikerId = '$idOfLiker'";
				mysql_query($SQL);
				// update poster score
				$SQL = "UPDATE users SET score = score+1 WHERE userName = '$pName'";
				mysql_query($SQL);
				//update post dislikes
				$SQL = "UPDATE posts SET postDisLikes = postDisLikes-1 WHERE postId = '$pId'";
				mysql_query($SQL);
			}
			else{
				$SQL = "INSERT INTO postdislikes(postId, dislikerId, posterName) VALUES ('$pId', '$idOfLiker', '$pName')";
				mysql_query($SQL);
				// update poster score
				$SQL = "UPDATE users SET score = score-1 WHERE userName = '$pName'";
				mysql_query($SQL);
				//update post dislikes
				$SQL = "UPDATE posts SET postDisLikes = postDisLikes+1 WHERE postId = '$pId'";
				mysql_query($SQL);
			}
		}

	}

	header("Location: ../subjects/post.php?n=$pId");

?>