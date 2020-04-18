<!DOCTYPE html>
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
        </style>
    </head>

    <body>

        <?php
            require 'dbAccess.php'; 
            $username = "fanAcct";
            $watched = getWatchedByUser($con, $username);
            $watching = getWatchingByUser($con, $username);
            $favorites = getFavoriteShowsByUser($con, $username);
        ?>

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
              </div>

              <button class="dropbtn" onclick="openNav()"><div></div><div></div><div></div>
                <i class="fa fa-caret-down"></i>
              </button>
            </div>        
    </header>

    <section class="user">
        <div class="profile-img" style="background-image: url('//via.placeholder.com/350x250');"></div>
        <div class="profileusername">
            <span class="profileusername"><?php echo $username ?></span>
        </div>
        <span class="switch"><a href="https://armchair.000webhostapp.com/profilebooks.php" class="switchbooks">Switch to Books</a><br><br><a href="https://armchair.000webhostapp.com/likes.php" class="switchlikes">Likes</a></span>
    </section>

    <main>
        <section class="profilelist">
        <span class="listtitle"><h3>Watching</h3></span>
        <ol class="profilemedialist">
        <?php foreach($watching as $retval) {
                    $info = getShowInfo($con, $retval);
                ?>
                <li>
                    <img src="<?php echo $info[6] ?>" alt="show image"/>
                    <div class="data">
                        <h4 class="title"><?php echo wordwrap($info[1], 15, "<br>\n") ?></h4>
                        <div class="subdata">
                            <p><span class="creator"><?php echo $info[3] ?></span></p>
                            <br><br>
                           <!-- <form class="progressform">
                                <label for="done">Episodes Watched</label>
                                <input type="number" class="done" id="done1"><span class="total">/178</span>
                            </form> -->
                        </div>
                    </div>
                </li>
                <?php } ?>
        </ol>
        <div class="add">
            <a href="https://armchair.000webhostapp.com/addshowwatching.php" class="addbtn"><span class="btntext">+</span></a>
        </div> 
          <br><br>
        </section>

        <section class="profilelist">
            <span class="listtitle"><h3>Favorite Shows</h3></span>
            <ol class="profilemedialist">
            <?php foreach($favorites as $retval) {
                    $info = getShowInfo($con, $retval);
                ?>
                <li>
                    <img src="<?php echo $info[6] ?>" alt="show image"/>
                    <div class="data">
                        <h4 class="title"><?php echo wordwrap($info[1], 15, "<br>\n")?></h4>
                        <div class="subdata">
                            <p><span class="creator"><?php echo $info[3] ?></span></p>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ol>
            <div class="add">
                <a href="https://armchair.000webhostapp.com/addshowfavorites.php" class="addbtn"><span class="btntext">+</span></a>
            </div> 
              <br><br>
            </section>

            <section class="profilelist">
                <span class=listtitle><h3>Watched</h3></span>
                <ol class="profilemedialist">
                    <?php foreach($watched as $retval) {
                        $info = getShowInfo($con, $retval);
                    ?>
                    <li>
                        <img src="<?php echo $info[6] ?>" alt="show image"/>
                        <div class="data">
                            <h4 class="title"><?php echo wordwrap($info[1], 15, "<br>\n")?></h4>
                            <div class="subdata">
                                <p><span class="creator"><?php echo $info[3] ?></span></p>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ol>
                <div class="add">
                    <a href="https://armchair.000webhostapp.com/addshowwatched.php" class="addbtn"><span class="btntext">+</span></a>
                </div> 
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