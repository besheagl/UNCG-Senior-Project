<?php
    session_start();
    if (isset($_SESSION['login_username'])){
	    $username = $_SESSION["login_username"];
    } else $username = '';
    require 'dbAccess.php';	//uses dbAccess.php library
    $isbn = htmlspecialchars($_GET["isbn"]);
    $chTitle = htmlspecialchars($_GET["chTitle"]);
    $bookTitle = getBookInfo($con, $isbn)[1];
    if (chHasComments($con, $isbn, $chTitle)) {
        $comments = getChComments($con, $isbn, $chTitle);
    }
?>
<!--Last updated at 1500 hours-->
<html>
    <!--Show/Episode terminology is used for Book/Chapter pages' front end design as well-->
    <head>
        <title><?php echo $bookTitle; ?> - Armchair</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://armchair.000webhostapp.com/stylesheet.css">
        
        <style> /*style specifically for Chapter page*/
		    /*for the chapter information at the top of the page*/
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
					
			.replytext{
				font-size: 4vw;
			}
			
			.reply .username{
				margin: 0 0;
			}
			
			.username{
				height:5vw;
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
				width: 13vw;
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
			
			.profile-img{
				display: inline-block;
				vertical-align: top;
			}
		
	    </style>
    </head>

    <body>
        <!--banner at top with armchair logo and navigation-->
        <header>
            <img src="https://armchair.000webhostapp.com/web_hi_res_512.png" style="width:20%" alt="armchair logo">
            <div class="text">
                <h1>Armchair</h1>
            </div>
			<?php include 'menu.php'; ?> 
        </header>

    <main>
        <div class="episodeinfo">
            <h3>Chapter <?php echo $chTitle; //write episode title ?></h3>
			<?php
			if (isset($_SESSION['reply'])){
				$sreply = $_SESSION['reply'];
				if ($sreply == '1'){
					echo "Comment posted!";
				} else {
					echo "Reply posted!";
				}
				unset($_SESSION['reply']);
			}
			?>
        </div>

        <!--list of comments-->
        <ol class="medialist">
		<?php if (chHasComments($con, $isbn, $chTitle)) {
			foreach ($comments as $retval=>$defaultfields) {  
			    $userinfo = getUserInfo($con, $defaultfields[3]);?>   
			<li class="comment-with-replies">
				<div class="data" style = 'display: block;'>
					<span class = "subdata" style = 'display: float; float:top; width: 100%;'>
						<!--username and profile image of commenter link to their profile-->
						<a class="thread-username" href="https://armchair.000webhostapp.com/profilebooks.php/?dispusername=<?php echo $defaultfields[3]; ?>">
							<!--commenter profile image-->
							<span class="profile-img" style="background-image: url('https://armchair.000webhostapp.com/uploads/<?php echo $userinfo[4]?>');"></span>
							<!--commenter username-->
							<span class = "username"><?php echo $defaultfields[3]; //write username ?></span>
						</a>
						<span class = "cmID">Comment# <?php echo $defaultfields[0]; //write cmID ?></span>
					</span>
					<br>
					<div class="post" style = 'display: float; float: bottom;'>
						<p><?php echo $defaultfields[5]; //write comment text ?></p>
					</div>
				</div>
				<!--like button and date comment was posted-->
				<span>
					<!--REPLY TO SPECIFIC COMMENT WITH REPLY BUTTON-->
					<form method="post" action="https://armchair.000webhostapp.com/reply.php" class="likeform"> 
						<!--defaultfields[6] is cmRef of liked comment-->
						<input type="submit" name="replybutton" class="like" value="Reply"/>
						<input type="hidden" name="cmRef" class="likevalue" value=<?php echo $defaultfields[6]; ?> />
						<input type="hidden" name="isbn" class="likevalue" value=<?php echo $isbn; ?> />
						<input type="hidden" name="type" class="likevalue" value=<?php echo "ch"; ?> />
						<input type="hidden" name="cmID" class="likevalue" value=<?php echo $defaultfields[0]; ?> />
						<input type="hidden" name="chTitle" class="likevalue" value=<?php echo $chTitle; ?> />
						<input type = "hidden" name = "goback" value = "<?php echo 'https://armchair.000webhostapp.com/chapter.php/?isbn=' . $isbn . '&chTitle=' . $chTitle; ?>">
						<!--<button href="" class="like"><img src="https://armchair.000webhostapp.com/img/heart.png" alt="Like button, in shape of a heart"></button>-->
					</form>
					<form method="post" action="https://armchair.000webhostapp.com/addCommentToLikes.php" class="likeform"> 
						<!--defaultfields[6] is cmRef of liked comment-->
						<input type="submit" name="likebutton" class="like" value="Like"/> 
						<input type="hidden" name="commentToLike" class="likevalue" value=<?php echo $defaultfields[6] ?> />
						<input type = "hidden" name = "goback" value = "<?php echo 'https://armchair.000webhostapp.com/chapter.php/?isbn=' . $isbn . '&chTitle=' . $chTitle ?>">
					</form>
					<!-- like count -->
					<?php if (cmHasLikes($con, $defaultfields[6])) { ?>
					<span class = "subdata"><span class = "date">
					<?php echo " ".count(getLikesByComment($con, $defaultfields[6]))." likes"; ?>
					</span></span>
					<?php }?>
					<span class = "subdata"><span class = "date"><?php echo $defaultfields[4]; ?></span></span>
				    </span>
				    <!--replies-->
				    <?php if (cmHasReplies($con, $defaultfields[6])){
					    $replies = getRepliesByComment($con, $defaultfields[6]);
				    ?>
				    <ol class="medialist">
				    <?php 
				        foreach ($replies as $retval2=>$info) {                     
				            $userinfo = getUserInfo($con, $info[2]);
				    ?>  
					<hr>
					<li class="reply">
					    <div class="data">
						    <!--profile image and username linked to profile of person replying-->
							<a class="thread-username" href="https://armchair.000webhostapp.com/profilebooks.php/?dispusername=<?php echo $info[2]; ?>">
                                <!--profile image of person replying-->
                                <span class="reply-profile-img">
                                    <span class="profile-img" style="background-image: url('https://armchair.000webhostapp.com/uploads/<?php echo $userinfo[4]?>');"></span>
								</span>
								<!--username of person replying-->
								<span class = "subdata"><span class = "username"><?php echo $info[2]; //write username ?></span></span>
							</a>
						    <div class="replytext">
							    <p><?php echo $info[4]; //write reply text ?></p>
					        </div>
					    </div>
						<!--like button and date reply was posted-->
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
		<?php if ($username) { ?>
            <form method="post" action="https://armchair.000webhostapp.com/postch.php">
                <fieldset><legend>Comment</legend>
					<select name = 'replyTo' style = 'width: 90%; height: 50px;'>
						<option value = "mainThread">Post to Main Thread</option>
						<?php
							if (chHasComments($con, $isbn, $chTitle)) { 
								for ($j = 0; $j<count($comments); $j++){
									echo "<option value = ".$comments[$j][6].">Reply to comment #".$comments[$j][0]."</option>";
								}
							} 
						?>
					</select>
					<textarea name="body" rows="10" cols="30" value="" style = "width: 90%;height: 150px;"></textarea><br><br>
					<input type = "hidden" name = "isbn" value = "<?php echo $isbn; ?>">
					<input type = "hidden" name = "chTitle" value = "<?php echo $chTitle; ?>">
					<input type = "hidden" name = "username" value = "<?php echo $username; ?>">
					<input type = "hidden" name = "goback" value = "<?php echo 'https://armchair.000webhostapp.com/chapter.php/?isbn='.$isbn.'&chTitle='.$chTitle; ?>"><br><br>
					<input type="submit" name="submit" value="Post" style = "width: 90%;height: 50px;">
				</fieldset>
            </form>
		<?php } else echo "<p style = 'margin-left: 5vw;font-size: 4vw;'>You must be logged in to post!</p>"; ?>
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