<?php
    session_start();
    if (isset($_SESSION['login_username'])){
	    $username = $_SESSION["login_username"];
    } else $username = '';
?>

<!--Last updated at 1500 hours-->
<html>
    <head>
        <!--This page is for adding a book to the Favorite Books list-->
        <title>Armchair Add Book to Favorites</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:600&display=swap" rel="stylesheet">
        <link href="stylesheet.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>

    <body>
	    <?php
		    require 'dbAccess.php';
		    $books = getBooksList($con, 0, 1073741824);
	    ?>
	    
		<header>
		    <!--Armchair logo-->
			<img src="web_hi_res_512.png" style="width:20%" alt="armchair logo">
			<div class="text">
				<h1>Armchair</h1>
			</div>  
			<!--Side navigation-->
		    <?php include 'menu.php'; ?>       
		</header>

		<main>
			<span class="listtitle"><h3>Add Book to Favorites</h3></span>
			<div id = 'addfavorites'>
				<a href = "https://armchair.000webhostapp.com/profilebooks.php/?dispusername=<?php echo $username; ?>" class = "backbtn">Back to profile</a>
				<form method="post" action="https://armchair.000webhostapp.com/addBookToFavorites.php">
					<fieldset><legend>Select Book to Add to Favorites</legend>
						<select name = 'bookToAdd' style = 'width: 90%; height: 50px;'>
						    <?php 
							    for ($j = 0; $j<count($books); $j++){
								    $curbook = getBookInfo($con, $books[$j]);
								    //ISBN value is passed to addBookToFavorites. Title of option is displayed.
								    echo "<option value = " .$curbook[0]. ">" .$curbook[1]. "</option>"; 
							    }
							?>
						    <input type = "hidden" name = "goback" value = "<?php echo 'https://armchair.000webhostapp.com/addbookfavorites.php' ?>">
						</select>
						<br><br>
						<input type="submit" name="submit" value="Add" style = "width: 90%;height: 50px;">
					</fieldset>
				</form>

			    <?php
				    if (isset($_SESSION['addbookfav'])){
				        $addread = $_SESSION['addbookfav'];
					if ($addread){
			    ?>
			    <span class = 'feedback'>
				    <?php echo "Added ".getBookInfo($con, $addread)[1]." to favorites!"; ?>
			    </span>
			    <?php
				    } unset($_SESSION['addbookfav']); 
                }
			    ?>
		    </div>
        </main>

        <script>
            //Functions for opening and closing Side Navigation
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>

    </body>
</html>