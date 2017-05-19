<?php
    session_start();
    if(!(isset($_SESSION['login']) && $_SESSION['login'] != '')){
        //print "thhsfg";
        header("Location: login/login.php");
    }
?>

<html>
    <head>
        <title>Learners Society - Contact us</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/contact.css">
        <link rel="stylesheet" href="../css/bootstrap.css">
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
        </div><br><br><br><br>
        <div class="container">
            <div class="row">
            <span style="font-size:25px; cursor:pointer; margin-left:-67px; z-index:20; position:fixed; background-color:white; padding:3px; border-radius:5px; opacity:0.5" onclick="openNav()">Show Categories</span>
            <div id="mySidenav" class="sidenav col-xs-3">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <h3 class="navh">&#9776; Categories</h3>
                    <a href="../subs.php">All</a>
                    <a href="../subjects/tpc.php?n=Arts">Arts</a>
                    <a href="../subjects/tpc.php?n=Books">Books</a>
                    <a href="../subjects/tpc.php?n=Circuits">Circuits</a>
                    <a href="../subjects/tpc.php?n=Chemistry">Chemistry</a>
                    <a href="../subjects/tpc.php?n=Computer Engineering">Computer Engineering</a>
                    <a href="../subjects/tpc.php?n=Competitive Programming">Competitive Programming</a>
                    <a href="../subjects/tpc.php?n=Design">Design</a>
                    <a href="../subjects/tpc.php?n=Drawing">Drawing</a>
                    <a href="../subjects/tpc.php?n=Economy">Economy</a>
                    <a href="../subjects/tpc.php?n=Languages">Languages</a>
                    <a href="../subjects/tpc.php?n=Math">Math</a>
                    <a href="../subjects/tpc.php?n=Security">Security</a>
                    <a href="../subjects/tpc.php?n=Programming">Programming</a>
                    <a href="../subjects/tpc.php?n=Physics">Physics</a>
                    <a href="../subjects/tpc.php?n=Philosophy">Philosophy</a>
                    <a href="../subjects/tpc.php?n=Web Design">Web Design</a>
                    <a href="../subjects/tpc.php?n=Web Development">Web Development</a>
            </div></div></div>
        <div class="container">
            <h2 style="color:white; padding:10px; text-align:center; margin:auto; border:3px solid white; width:50%">Contact Us</h2><br><br> 
            <div class="form">
                <form class="form-group" action="sentMail.php" method="post">
                    <label>Name <span>*</span></label>
                    <input type="text" class="form-control" name="username" required>
                    <label>E-mail <span>*</span></label>
                    <input type="email" class="form-control" name="mail">
                    <label>Phone</label>
                    <input type="tel" class="form-control" name="phone">
                    <label>Message</label>
                    <textarea class="form-control" name="message"></textarea>
                    <input type="submit" class="btn btn-info btn-lg text-center">
                </form>
            </div>
        </div>

        <div style="border-top:2px solid white; color:white">
            <center>Learners Society - 2017 - 
            <a href="contact.php">Contact Us</a></center>
        </div>

        <script> // show and hide categories
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>

    </body>
</html>