<?php
    session_start();
?>
<!--Last updated at 1500 hours-->
<html>
    <head>
        <!--This page is for removing a book from the Reading List-->
        <title>Armchair Remove Book from Reading</title>
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
            $reading = getReadingByUser($con, $username);
        ?>
		
		<header>
			<img src="web_hi_res_512.png" style="width:20%" alt="armchair logo">
			<div class="text">
				<h1>Armchair</h1>
			</div>  
			<?php include 'menu.php'; ?>        
		</header>
		
		<main>
			<span class="listtitle"><h3>Remove Book from Reading</h3></span>
			<!--<ul id="myMenu">-->
			<div id = 'removereading'>
				<a href = "https://armchair.000webhostapp.com/profilebooks.php/?dispusername=<?php echo $username; ?>" class = "backbtn">Back to profile</a>
				<form method="post" action="https://armchair.000webhostapp.com/removeBookFromReading.php">
					<fieldset><legend>Select Book to Remove from Reading</legend>
						<select name = 'bookToRemove' style = 'width: 90%; height: 50px;'>
							<?php //if (chHasComments($con, $isbn, $chTitle)) { could use some checking like this
								for ($j = 0; $j<count($reading); $j++){
									$curbook = getBookInfo($con, $reading[$j]);
									echo "<option value = " .$curbook[0]. ">" .$curbook[1]. "</option>"; 
								} ?>
							 <!--<input type = "hidden" name = "isbn" value = "<?php echo $isbn; ?>">-->
							 <input type = "hidden" name = "goback" value = "<?php echo 'https://armchair.000webhostapp.com/removebookreading.php' ?>">
						</select><br><br>
						<input type="submit" name="submit" value="Remove" style = "width: 90%;height: 50px;">
					</fieldset>
				</form>
				<?php
				if (isset($_SESSION['remreading'])){
					$addread = $_SESSION['remreading'];
					if ($addread){
				?>
					<span class = 'feedback'>
					<?php echo "Removed ".getBookInfo($con, $addread)[1]." from reading!"; ?>
					</span>
				<?php
					} unset($_SESSION['remreading']); 
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