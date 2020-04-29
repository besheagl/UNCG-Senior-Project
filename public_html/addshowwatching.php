<?php
    session_start();
    if (isset($_SESSION['login_username'])){
	    $username = $_SESSION["login_username"];
    } else $username = '';
    require 'dbAccess.php';
    $shows = getShowsList($con, 0, 1073741824);
?>
<!--Last updated at 1500 hours-->
<html>
    <head>
        <!--This page is for adding a show to the Watching list-->
        <title>Armchair Add Show to Watching</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:600&display=swap" rel="stylesheet">
        <link href="stylesheet.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>

    <body>
		<header>
		    <!--Armchair logo-->
			<img src="web_hi_res_512.png" style="width:20%" alt="armchair logo">
			<div class="text">
				<h1>Armchair</h1>
			</div>  
			<!--side navigation-->
			<?php include 'menu.php'; ?>               
		</header>

		<main>
		    <span class="listtitle"><h3>Add Show</h3></span>
			    <div id = 'addwatching'>
				    <a href = "https://armchair.000webhostapp.com/profileshows.php/?dispusername=<?php echo $username; ?>" class = "backbtn">Back to profile</a>
				    <form method="post" action="https://armchair.000webhostapp.com/addShowToWatching.php">
					    <fieldset><legend>Select Show to Add to Watching</legend>
						    <select name = 'showToAdd' style = 'width: 90%; height: 50px;'>
							    <?php 
								    for ($j = 0; $j<count($shows); $j++){
									    $curshow = getShowInfo($con, $shows[$j]);
									    echo "<option value = " .$curshow[0]. ">" .$curshow[1]. "</option>"; 
								    } 
								?>
							    <input type = "hidden" name = "goback" value = "<?php echo 'https://armchair.000webhostapp.com/addshowwatching.php' ?>">
						    </select>
						    <br><br>
						    <input type="submit" name="submit" value="Add" style = "width: 90%;height: 50px;">
					    </fieldset>
				    </form>
				    <?php
				        if (isset($_SESSION['addwatching'])){
					        $addread = $_SESSION['addwatching'];
					    if ($addread){
				    ?>
					<span class = 'feedback'>
					    <?php echo "Added ".getShowInfo($con, $addread)[1]." to watching!"; ?>
					</span>
				    <?php
					    } unset($_SESSION['addwatching']); 
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