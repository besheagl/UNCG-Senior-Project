<html>
    <head>
        <title>Armchair Episode</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://armchair.000webhostapp.com/stylesheet.css">
        
        <style> /*style specifically for episode page*/

            /*for the episode information at the top of the page*/
            .episodeinfo{
                font-size: 3.5vw;
                font-family: Verdana, Geneva, sans-serif;
                margin: 0 2vw;
             }

             .episodeinfo h3{
                font-weight: bold;
             }

             .field{
                font-weight: bold;
             }
    
            .medialist{
                list-style: none;
                margin: 0 auto;
                padding: 0;
            }
    
            /*for each comment*/
            .comment-with-replies{
                background-color: #93B7EF;
                -webkit-box-shadow: 0 4px 6px -6px #222;
                -moz-box-shadow: 0 4px 6px -6px #222;
                box-shadow: 0 4px 6px -6px #222;
                max-width: 100%;
                margin: 3vw auto;
                font-family: 'Arial';
            }

            /*for info about comment like username and date*/
            .subdata{
                list-style: none;
                font-family: 'arial';
                font-weight: lighter;
                color: #f3d9bb;
                font-size: 3.5vw;
                position: relative;
                /*top: 1vw;*/
                text-align: left;
            }

            .username{
                top: 1vw;
                margin: 0 2vw;
            }

            /*for the comment text*/
            .post{
                display: inline-block;
                font-size: 4vw;
                position: relative;
                color: black;
                font-weight: bold;
                margin: 0 2vw;
                text-align: left;
            }
            
            /*for the like button*/
            .medialist img{
                position: relative;
                display: flex;
                max-width: 100%;
                margin: 0 auto;
                text-align: center;
            }

            .like, .date{
                display: inline-block;
                vertical-align: top;
            }

            hr{
                border-width: .25vw;
            }

            .reply{
                margin: 0 4vw;
                /*border-style: solid;
                border-color: #87a4d3;
                border-bottom: none;
                border-width: .25px;*/
                width: 100%;
            }

            .reply .username{
                margin: 0 0;
            }
			main{
				margin: 0;
				padding: 0;
            }
            
            input.like{
                    background-color: #ff8878;
                    color: white;
                    font-family: 'Nunito Sans', sans-serif;
                    font-size: 2vw;
                    -moz-box-shadow: 0 0 1vw #ccc;
                    -webkit-box-shadow: 0 0 1vw #ccc;
                    box-shadow: 0 0 1vw #ccc;
                    border-radius: 1%;
                    border-style: none;
                    border-color: none;
                    border-image: none;
                    width: 15vw;
                    height: 9vw;
                    width: 10vw;
                    height: 5vw;
                    font-size: 3.5vw;
                    margin-bottom: 3vw;
                }

            form.likeform {
                display: inline;
            }   
            
            input.like, .date {
                display: inline;
            }

        </style>

    </head>


    <body>

        <?php
            require 'dbAccess.php';	//uses dbAccess.php library
            $showID = htmlspecialchars($_GET["showID"]);
            $epTitle = htmlspecialchars($_GET["epTitle"]);
			$info = getEpInfo($con, $showID, $epTitle);
            if (epHasComments($con, $showID, $epTitle)) {$comments = getEpComments($con, $showID, $epTitle);}
			
        ?>
    
        <!--banner at top with armchair logo and navigation-->
        <header>
            <img src="https://armchair.000webhostapp.com/web_hi_res_512.png" style="width:20%" alt="armchair logo">
            <div class="text">
                <h1>Armchair</h1>
            </div>
    
            <div class="dropdown">
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="https://armchair.000webhostapp.com/shows.php">Shows</a>
                <a href="https://armchair.000webhostapp.com/books.php">Books</a>
                <a href="https://armchair.000webhostapp.com/profileshows.php">Profile</a>
              </div>
    
                  <button class="dropbtn" onclick="openNav()">
                    <div></div><div></div><div></div> <!--These are made into the lines for the 
                                                            nav button using css in stylesheet (.dropbtn div)-->
                  </button>
            </div>
        </header>

    <main>

        <div class="episodeinfo">
            <h3><?php echo $info[0]; //write episode title ?></h3>
            <span class="field">Network: </span><?php echo $info[3]; //write director ?>
            <br>
            <span class="field">Date: </span><?php echo $info[2]; //write date ?>
            <br>
            <span class="field">Description: </span><?php echo $info[4]; //write description ?>        
        </div>

        <!--list of comments-->
        <ol class="medialist">
            <?php if (epHasComments($con, $showID, $epTitle)) {
				foreach ($comments as $retval=>$defaultfields) { ?>  
                <li class="comment-with-replies">
                    <div class="data" style = 'display: block;'>
                        <a href=""><span class = "subdata" style = 'display: float; float:top; width: 100%;'>
							<span class = "username"><?php echo $defaultfields[3]; //write username ?></span>
							<span class = "cmID">Comment# <?php echo $defaultfields[0]; //write cmID ?></span>
						</span></a><br>
                        <div class="post" style = 'display: float; float: bottom;'>
                            <p><?php echo $defaultfields[5]; //write comment text ?></p>
                        </div>
                    </div>
                    <!--like button and date comment was posted-->
                    <span>
                    <form method="post" action="https://armchair.000webhostapp.com/addCommentToLikes.php" class="likeform"> 
                        <!--defaultfields[6] is cmRef of liked comment-->
                        <input type="submit" name="likebutton" class="like" value="Like"/> 
                        <input type="hidden" name="commentToLike" class="likevalue" value=<?php echo $defaultfields[6] ?> />
                        <input type = "hidden" name = "goback" value = "<?php echo 'https://armchair.000webhostapp.com/episode.php/?showID=' . $showID . '&epTitle=' . $epTitle ?>">
                    </form>
						<!--<button href="" class="like"><img src="https://armchair.000webhostapp.com/img/heart.png" alt="Like button, in shape of a heart"></button>-->
						<span class = "subdata"><span class = "date"><?php echo $defaultfields[4]; ?></span></span>
					</span>
                    <!--replies-->
                    <?php if (cmHasReplies($con, $defaultfields[6])){
					$replies = getRepliesByComment($con, $defaultfields[6]); ?>
                    <ol class="medialist">
                        <?php foreach ($replies as $retval2=>$info) { ?>
                            <hr>
                            <li class="reply">
                                <div class="data">
									<a href=""><span class = "subdata"><span class = "username"><?php echo $info[2]; //write username ?></span></span></a>
									<div class="replytext">
										<p><?php echo $info[4]; //write reply text ?></p>
									</div>
                                </div>
                                <!--date reply was posted-->
                                <span class = "subdata"><span class = "date"><?php echo $info[3]; ?></span></span>
                            </li> 
			<?php } ?>
                    </ol>
			<?php } ?>
                </li>
            <?php } ?>
			<?php } ?>
        </ol>     

        <div id = 'addstuff'>
            <form method="post" action="https://armchair.000webhostapp.com/postep.php">
                <fieldset><legend>Comment</legend>
                  <!--input type="text" name="username" value=""><br><br-->
					<select name = 'replyTo' style = 'width: 90%; height: 50px;'>
						<option value = "mainThread">Post to Main Thread</option>
						<?php if (epHasComments($con, $showID, $epTitle)) { 
							for ($j = 0; $j<count($comments); $j++){
								echo "<option value = ".$comments[$j][6].">Reply to comment #".$comments[$j][0]."</option>";
							}
						} ?>
                  <textarea name="body" rows="10" cols="30" value="" style = "width: 90%;height: 150px;"></textarea><br><br>
				  <input type = "hidden" name = "showID" value = "<?php echo $showID; ?>">
				  <input type = "hidden" name = "epTitle" value = "<?php echo $epTitle; ?>">
				  <input type = "hidden" name = "goback" value = "<?php echo 'https://armchair.000webhostapp.com/episode.php/?showID='.$showID.'&epTitle='.$epTitle; ?>">
                  </select><br><br>
				  <!--input type = "hidden" name = "goback" value = "<?php //echo $_SERVER["PHP_SELF"]; ?>"-->
                  <input type="submit" name="submit" value="Post" style = "width: 90%;height: 50px;">
              </fieldset>
            </form>
        </div>
    </main>

    <script>
        /*for opening and closing the sidenav menu*/
        function openNav() {
          document.getElementById("mySidenav").style.width = "250px";
        }
        
        function closeNav() {
          document.getElementById("mySidenav").style.width = "0";
        }
	</script>

    </body>
    
</html>