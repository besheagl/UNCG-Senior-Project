<?php
    session_start();
?>
<!--Last updated at 1500 hours-->
<html>
    <head>
        <title>Armchair Profile</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:600&display=swap" rel="stylesheet">
        <link href="https://armchair.000webhostapp.com/stylesheet.css" rel="stylesheet">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        
        <style> /* styles specifically for book profile */
            .switchshows{
                margin: 1vw auto;
            }
            .username, .switch{
                display: inline-block;
            }
            /*Styling for profilebooks and profileshows*/    
            .profile-img, .profileusername{
	            display: inline-block;
	            vertical-align: bottom;
            }
        </style>
    </head>

    <body>       
	<?php
		require 'dbAccess.php';
		if (isset($_SESSION['login_username'])){
			$username = $_SESSION["login_username"];
		} else $username = '';
		if (isset($_GET['dispusername'])){
			$dispusername = htmlspecialchars($_GET["dispusername"]);
		} else $dispusername=$username;
		$read = getReadByUser($con, $dispusername);
		$reading = getReadingByUser($con, $dispusername);
		$favorites = getFavoriteBooksByUser($con, $dispusername);
		$userinfo = getUserInfo($con, $dispusername);
	?>
        <header>
            <img src="https://armchair.000webhostapp.com/web_hi_res_512.png" style="width:20%" alt="armchair logo">
            <div class="text">
                <h1>Armchair</h1>
            </div>
			<?php include 'menu.php'; ?> 
        </header>

        <section class="user">
            <a href="https://armchair.000webhostapp.com/profilepic.php">
            <div class="profile-img" style="background-image: url('https://armchair.000webhostapp.com/uploads/<?php echo $userinfo[4]?>');"></div>
            </a>
            <div class="profileusername">
                <span class="profileusername"style="font-size: 5vw;
                      color: #6884b0; margin-left: 35%; margin-bottom: 40%"><?php echo $dispusername ?></span>
            </div>
            <span class="switch" style= "display: block; margin-left: 30px; margin-bottom: 20px">
				<a href="https://armchair.000webhostapp.com/profileshows.php/?dispusername=<?php echo $dispusername; ?>" 
					class="switchshows" style=" font-weight: bold;  margin-bottom: 5%; padding-top: 8px;padding-right: 10px;padding-bottom: 8px; 
					padding-left: 10px; margin-left: 5%;" >Switch to Shows</a>
				<a href="likes.php" class="switchlikes" style="font-weight: bold;  padding-top: 5px;padding-right: 8px;padding-bottom: 5px;
					padding-left: 6px;margin-left: 50px" >Likes</a>
			</span>
        </section>

        <main>
            <section class="profilelist">
				<span class="listtitle"><h3>Reading</h3></span>
				    <ol class="profilemedialist">
					    <?php 
					        if(userHasReading($con, $dispusername)) {
					            foreach($reading as $retval) {
						            $info = getBookInfo($con, $retval);
					    ?>
					    <li>
						    <a href = "https://armchair.000webhostapp.com/book.php/?isbn=<?php echo $info[0]; ?>">
							    <img src="<?php echo $info[6] ?>" alt="book image"/>
						    </a>
						    <div class="data">
							    <?php
								    $title=strlen($info[1]) > 38 ? substr($info[1], 0, 38)."..." : $info[1];
								    $creator=strlen($info[3]) > 8 && strlen($info[1]) > 38 ? substr($info[3], 0, 8)."..." : $info[3];
							    ?>
							    <h4 class="title"><?php echo wordwrap($title, 15, "<br>\n") ?></h4>
							    <div class="subdata">
								    <p><span class="creator"><?php echo $creator ?></span></p>
								    <br><br>
							    </div>
						    </div>
					    </li>
					    <?php
						    }} else if ($username==$dispusername){
							    echo "<div style = 'margin: 10px;font-size: 6vw; color: #546a8c;'>Click here to add books! </div>";
						    }
						    else echo "<div style = 'margin: 10px;font-size: 6vw;color: #546a8c;'> Not reading anything!</div>";
					    ?>
				    </ol>
				    <?php 
				        if ($username==$dispusername){ 
				    ?>
				    <span class="edit">
					    <a href="https://armchair.000webhostapp.com/addbookreading.php" class="editbtn"><span class="btntext">+</span></a>
				    </span> 
				    <span class="edit">
					    <a href="https://armchair.000webhostapp.com/removebookreading.php" class="editbtn"><span class="btntext" id="minus">_</span></a>
				    </span>
				    <?php } ?>
				    <br><br>
			</section>

			<section class="profilelist">
				<span class="listtitle"><h3>Favorite Books</h3></span>
				<ol class="profilemedialist">
					<?php 
					    if (userHasFavoriteBooks($con, $dispusername)) { 
					        foreach($favorites as $retval) {
						        $info = getBookInfo($con, $retval);
					?>
					<li>
						<a href = "https://armchair.000webhostapp.com/book.php/?isbn=<?php echo $info[0]; ?>">
						    <img src="<?php echo $info[6] ?>" alt="book image"/>
						</a>
						<div class="data">
							<h4 class="title"><?php echo wordwrap($info[1], 15, "<br>\n")?></h4>
							<div class="subdata">
							    <p><span class="creator"><?php echo $info[3] ?></span></p>
							</div>
						</div>
				    </li>
					<?php
						}} else if ($username==$dispusername){
						        echo "<div style = 'margin: 10px;font-size: 6vw; color: #546a8c;'>Click here to add books! </div>";
						   }
						   else echo "<div style = 'margin: 10px;font-size: 6vw;color: #546a8c;'> Not reading anything!</div>";
					?>
				</ol>
				<?php if ($username==$dispusername){ ?>
				    <span class="edit">
					    <a href="https://armchair.000webhostapp.com/addbookfavorites.php" class="editbtn"><span class="btntext">+</span></a>
				    </span> 
				    <span class="edit">
					    <a href="https://armchair.000webhostapp.com/removebookfavorites.php" class="editbtn"><span class="btntext" id="minus">_</span></a>
				    </span> 
				<?php } ?>
				<br><br>
			</section>

			<section class="profilelist">
				<span class="listtitle"><h3>Read</h3></span>
				<ol class="profilemedialist">
					<?php if(userHasRead($con, $dispusername)){ foreach($read as $retval) {
						$info = getBookInfo($con, $retval);
					?>
					<li>
						<a href = "https://armchair.000webhostapp.com/book.php/?isbn=<?php echo $info[0]; ?>">
							<img src="<?php echo $info[6] ?>" alt="book image"/>
						</a>
						<div class="data">
							<h4 class="title"><?php echo wordwrap($info[1], 15, "<br>\n")?></h4>
							<div class="subdata">
								<p><span class="creator"><?php echo $info[3] ?></span></p>
							</div>
						</div>
					</li>
					<?php
						}} else if ($username==$dispusername){
						        echo "<div style = 'margin: 10px;font-size: 6vw; color: #546a8c;'>Click here to add books! </div>";
						}
						else echo "<div style = 'margin: 10px;font-size: 6vw;color: #546a8c;'> Not reading anything!</div>";
					?>
				</ol>
				<?php if ($username==$dispusername){ ?>
				    <span class="edit">
					    <a href="https://armchair.000webhostapp.com/addbookread.php" class="editbtn"><span class="btntext">+</span></a>
				    </span> 
				    <span class="edit">
					    <a href="https://armchair.000webhostapp.com/removebookread.php" class="editbtn"><span class="btntext" id="minus">_</span></a>
				    </span>
				<?php } ?>
				<br><br>
			</section>
		</main>
		
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
