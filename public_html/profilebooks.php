<!DOCTYPE html>
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
        </style>

    </head>

    <body>

                    
        <?php
            require 'dbAccess.php'; 
            $username = "fanAcct";
            $read = getReadByUser($con, $username);
            $reading = getReadingByUser($con, $username);
            $favorites = getFavoriteBooksByUser($con, $username);
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
            <span class="switch"><a href="profileshows.php" class="switchshows">Switch to Shows</a><br><br><a href="likes.php" class="switchlikes">Likes</a></span>
        </section>

        <main>
            <section class="profilelist">
            <span class="listtitle"><h3>Reading</h3></span>
            <ol class="profilemedialist">
                <?php foreach($reading as $retval) {
                    $info = getBookInfo($con, $retval);
                ?>
                <li>
                    <img src="<?php echo $info[6] ?>" alt="book image"/>
                    <div class="data">
                        <?php
                            $title=strlen($info[1]) > 38 ? substr($info[1], 0, 38)."..." : $info[1];
                            $creator=strlen($info[3]) > 8 && strlen($info[1]) > 38 ? substr($info[3], 0, 8)."..." : $info[3];
                        ?>
                        <h4 class="title"><?php echo wordwrap($title, 15, "<br>\n") ?></h4>
                        <div class="subdata">
                            <p><span class="creator"><?php echo $creator ?></span></p>
                            <br><br>
                           <!-- <form class="progressform">
                                <label for="done">Chapters Read</label>
                                <input type="number" class="done" id="done1"><span class="total">/178</span>
                            </form> -->
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ol>
            <div class="add">
                <a href="https://armchair.000webhostapp.com/addbookreading.php" class="addbtn"><span class="btntext">+</span></a>
            </div> 
            <br><br>
        </section>

        <section class="profilelist">
            <span class="listtitle"><h3>Favorite Books</h3></span>
            <ol class="profilemedialist">
                <?php foreach($favorites as $retval) {
                    $info = getBookInfo($con, $retval);
                ?>
                <li>
                    <img src="<?php echo $info[6] ?>" alt="book image"/>
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
                <a href="https://armchair.000webhostapp.com/addbookfavorites.php" class="addbtn"><span class="btntext">+</span></a>
            </div> 
              <br><br>
            </section>

        <section class="profilelist">
            <span class="listtitle"><h3>Read</h3></span>
            <ol class="profilemedialist">
                <?php foreach($read as $retval) {
                    $info = getBookInfo($con, $retval);
                ?>
                <li>
                    <img src="<?php echo $info[6] ?>" alt="book image"/>
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
                <a href="https://armchair.000webhostapp.com/addbookread.php" class="addbtn"><span class="btntext">+</span></a>
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