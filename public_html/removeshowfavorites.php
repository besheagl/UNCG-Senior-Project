<?php
    session_start();
    require 'dbAccess.php';
    $username = $_SESSION["login_username"];
    $favorites = getFavoriteShowsByUser($con, $username);
?>
<!--Last updated at 1500 hours-->
<html>
    <head>
        <!--This page is for removing a show from the Favorite Shows List-->
        <title>Armchair Remove Show from Favorites</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:600&display=swap" rel="stylesheet">
        <link href="stylesheet.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>

    <body>
		<header>
			<img src="web_hi_res_512.png" style="width:20%" alt="armchair logo">
			<div class="text">
				<h1>Armchair</h1>
			</div>  
			<?php include 'menu.php'; ?>        
		</header>
		
		<main>
			<span class="listtitle"><h3>Remove a Show from Favorites</h3></span>
			<div id = 'removefavorite'>
				<a href = "https://armchair.000webhostapp.com/profileshows.php/?dispusername=<?php echo $username; ?>" class = "backbtn">Back to profile</a>
				<form method="post" action="https://armchair.000webhostapp.com/removeShowFromFavorites.php">
					<fieldset><legend>Select Show to Remove from Favorites</legend>
						<select name = 'showToRemove' style = 'width: 90%; height: 50px;'>
							<?php //if (chHasComments($con, $isbn, $chTitle)) { could use some checking like this
								for ($j = 0; $j<count($favorites); $j++){
									$curshow = getShowInfo($con, $favorites[$j]);
									echo "<option value = " .$curshow[0]. ">" .$curshow[1]. "</option>"; 
								} ?>
							    <input type = "hidden" name = "goback" value = "<?php echo 'https://armchair.000webhostapp.com/removeshowfavorites.php' ?>">
						</select><br><br>
						<input type="submit" name="submit" value="Remove" style = "width: 90%;height: 50px;">
					</fieldset>
				</form>
				<?php
				if (isset($_SESSION['remfavshow'])){
					$addread = $_SESSION['remfavshow'];
					if ($addread){
				?>
					<span class = 'feedback'>
					<?php echo "Removed ".getShowInfo($con, $addread)[1]." from favorites!"; ?>
					</span>
				<?php
					} unset($_SESSION['remfavshow']); 
				}
				?>
			</div>
			<!--</ul>-->
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