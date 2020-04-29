<?php
    session_start();
    if (isset($_SESSION['login_username'])){
	    $username = $_SESSION["login_username"];
    } else $username = '';
?>
<!--Last updated at 1500 hours-->
<html>
    <head>
        <!--This page is for adding a show to a list such as the Watching list-->
        <title>Armchair Upload Profile Image</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:600&display=swap" rel="stylesheet">
        <link href="stylesheet.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>

    <style>
        .file {
            width: auto;
            height: auto;
        }
                
        input.file {
            font-size: 5vw;
        }
                
        button {
            font-size: 5vw;
            margin: 4vw 0;
        }
    </style>

    <body>
        <?php require 'dbAccess.php'; ?>
        <header>
            <!--Armchair logo-->
            <img src="web_hi_res_512.png" style="width:20%" alt="armchair logo">
            <div class="text">
                <h1>Armchair</h1>
            </div>  
            <!--Side Navigation-->
		    <?php include 'menu.php'; ?>                        
        </header>
    
        <span class="listtitle"><h3>Upload Profile Image</h3></span>
            <form method="post" action="upload.php" enctype="multipart/form-data">
                <input type="file" name="file" class="file">
                <input type = "hidden" name = "goback" value = "<?php echo 'https://armchair.000webhostapp.com/profilepic.php' ?>">
                <button type="submit" name="submit">UPLOAD IMAGE</button>
            </form>
        
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>

    </body>
</html>