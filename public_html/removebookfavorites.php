<?php
    session_start();
?>
<!--Last updated at 1500 hours-->
<!DOCTYPE html>
<html>
    <head>
        <!--This page is for adding a book to a list such as the Read list-->
        <title>Armchair Remove Book from Favorites</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:600&display=swap" rel="stylesheet">
        <link href="stylesheet.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>

    <body>
    <?php
        require 'dbAccess.php';
        $username = $_SESSION["login_username"];
        $favorites = getFavoriteBooksByUser($con, $username);
    ?>
		<header>
			<img src="web_hi_res_512.png" style="width:20%" alt="armchair logo">
				<div class="text">
					<h1>Armchair</h1>
				</div>  
				<?php include 'menu.php'; ?> 
		</header>

		<main>
		    <span class="listtitle"><h3>Remove Book from Favorites</h3></span>
			<div id = 'removefavorite'>
				<a href = "https://armchair.000webhostapp.com/profilebooks.php/?dispusername=<?php echo $username; ?>" class = "backbtn">Back to profile</a>
				    <form method="post" action="https://armchair.000webhostapp.com/removeBookFromFavorites.php">
					    <fieldset><legend>Select Book to Remove from Favorites</legend>
						    <select name = 'bookToRemove' style = 'width: 90%; height: 50px;'>
							    <?php //if (chHasComments($con, $isbn, $chTitle)) { could use some checking like this
								    for ($j = 0; $j<count($favorites); $j++){
									    $curbook = getBookInfo($con, $favorites[$j]); echo "<option value = " .$curbook[0]. ">" .$curbook[1]. "</option>"; 
								    } 
							    ?>
							    <input type = "hidden" name = "goback" value = "<?php echo 'https://armchair.000webhostapp.com/removebookfavorites.php' ?>">
						    </select>
						    <br><br>
					        <input type="submit" name="submit" value="Remove" style = "width: 90%;height: 50px;">
					   </fieldset>
				    </form>
				    <?php
				        if (isset($_SESSION['rembookfav'])){
					        $addread = $_SESSION['rembookfav'];
					    if ($addread){
				    ?>
					<span class = 'feedback'>
					    <?php echo "Removed ".getBookInfo($con, $addread)[1]." from favorites!"; ?>
					</span>
				    <?php
					    } unset($_SESSION['rembookfav']); 
				    }
				    ?>
			</div>
		</main>

		<script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }

            function myFunction() {
			    // Declare variables
			    var input, filter, ul, li, a, i;
			    input = document.getElementById("mySearch");
			    filter = input.value.toUpperCase();
			    ul = document.getElementById("myMenu");
			    li = ul.getElementsByTagName("li");

			    // Loop through all list items, and hide those who don't match the search query
			    for (i = 0; i < li.length; i++) {
				    a = li[i].getElementsByTagName("a")[0];
				    if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
					    li[i].style.display = "";
				    } else {
					    li[i].style.display = "none";
				    }
			    }
		    }
		</script>

    </body>
</html>