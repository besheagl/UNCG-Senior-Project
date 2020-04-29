<?php
    session_start();
?>
<!--Last updated at 1220 hours 4/28/2020-->
<html>
    <head>
        <title>Armchair Profile</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:600&display=swap" rel="stylesheet">
        <link href="https://armchair.000webhostapp.com/stylesheet.css" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

        <style> /* styles specifically for show profile */
            .switchbooks{
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
            $watched = getWatchedByUser($con, $dispusername);
            $watching = getWatchingByUser($con, $dispusername);
            $favorites = getFavoriteShowsByUser($con, $dispusername);
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
            <a href="https://armchair.000webhostapp.com/profilepic.php" >
                <span class="profile-img" style="background-image: url('https://armchair.000webhostapp.com/uploads/<?php echo $userinfo[4]?>'); ">
                 </a>
             
            <div class="profileusername">
                <span class="profileusername"style="font-size: 5vw;
                      color: #6884b0; margin-left: 35%; margin-bottom: 40%"><?php echo $dispusername ?></span>
            </div>
            <span class="switch" style= "display: block; margin-left: 30px; margin-bottom: 20px"><a href="https://armchair.000webhostapp.com/profilebooks.php/?dispusername=<?php echo $dispusername; ?>" class="switchbooks"style=" font-weight: bold;  margin-bottom: 5%; padding-top: 8px;padding-right: 10px;padding-bottom: 8px; padding-left: 10px; ;" >Switch to Books</a>
                <a href="https://armchair.000webhostapp.com/likes.php" class="switchlikes" style="font-weight: bold;  padding-top: 5px;padding-right: 8px;padding-bottom: 5px;
                 padding-left: 6px;margin-left: 50px" >Likes</a></span>
        </section>

    <main>
        <section class="profilelist">
			<span class="listtitle"><h3>Watching</h3></span>
			    <ol class="profilemedialist">
			        <?php if (userHasWatching($con, $dispusername)) {foreach($watching as $retval) {
				        $info = getShowInfo($con, $retval);
			        ?>
				    <li>
					    <a href = "https://armchair.000webhostapp.com/show.php/?showID=<?php echo $info[0]; ?>">
						    <img src="<?php echo $info[6] ?>" alt="show image"/>
					    </a>
					    <div class="data">
						    <h4 class="title"><?php echo wordwrap($info[1], 15, "<br>\n") ?></h4>
						    <div class="subdata">
							    <p><span class="creator"><?php echo $info[3] ?></span></p>
							    <br><br>
						    </div>
					    </div>
				    </li>
			        <?php
				        }} else if ($username==$dispusername){
					    echo "<div style = 'margin: 10px;font-size: 6vw; color: #546a8c;'>Click here to add shows! </div>";
				        } else echo "<div style = 'margin: 10px;font-size: 6vw;color: #546a8c;'> Not watching anything!</div>";
			        ?>
			    </ol>
			    <?php if ($username==$dispusername){ ?>
			        <span class="edit">
				        <a href="https://armchair.000webhostapp.com/addshowwatching.php" class="editbtn"><span class="btntext">+</span></a>
			        </span> 
			        <span class="edit">
				        <a href="https://armchair.000webhostapp.com/removeshowwatching.php" class="editbtn"><span class="btntext" id="minus">_</span></a>
			        </span>
			    <?php } ?>
			    <br><br>
        </section>

        <section class="profilelist">
            <span class="listtitle"><h3>Favorite Shows</h3></span>
            <ol class="profilemedialist">
                <?php 
                    if(userHasFavoriteShows($con, $dispusername)) {
                        foreach($favorites as $retval) {
				            $info = getShowInfo($con, $retval);
			    ?>
                <li>
					<a href = "https://armchair.000webhostapp.com/show.php/?showID=<?php echo $info[0]; ?>">
						<img src="<?php echo $info[6] ?>" alt="show image"/>
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
					    echo "<div style = 'margin: 10px;font-size: 6vw; color: #546a8c;'>Click here to add shows! </div>";
				    }
				    else echo "<div style = 'margin: 10px;font-size: 6vw;color: #546a8c;'> Not watching anything!</div>";
			    ?>
            </ol>
			<?php if ($username==$dispusername){ ?>
                <span class="edit">
                    <a href="https://armchair.000webhostapp.com/addshowfavorites.php" class="editbtn"><span class="btntext">+</span></a>
                    </span> 
                <span class="edit">
                    <a href="https://armchair.000webhostapp.com/removeshowfavorites.php" class="editbtn"><span class="btntext" id="minus">_</span></a>
                </span>
			<?php } ?>
            <br><br>
		</section>

		<section class="profilelist">
			<span class=listtitle><h3>Watched</h3></span>
			<ol class="profilemedialist">
				<?php if (userHasWatched($con, $dispusername)) { foreach($watched as $retval) {
					$info = getShowInfo($con, $retval);
				?>
				<li>
					<a href = "https://armchair.000webhostapp.com/show.php/?showID=<?php echo $info[0]; ?>">
						<img src="<?php echo $info[6] ?>" alt="show image"/>
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
					    echo "<div style = 'margin: 10px;font-size: 6vw; color: #546a8c;'>Click here to add shows! </div>";
				    }
				    else echo "<div style = 'margin: 10px;font-size: 6vw;color: #546a8c;'> Not watching anything!</div>";
			    ?>
			</ol>
			<?php if ($username==$dispusername){ ?>
			<span class="edit">
			    <a href="https://armchair.000webhostapp.com/addshowwatched.php" class="editbtn"><span class="btntext">+</span></a>
			</span> 
			<span class="edit">
				<a href="https://armchair.000webhostapp.com/removeshowwatched.php" class="editbtn"><span class="btntext" id="minus">_</span></a>
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
