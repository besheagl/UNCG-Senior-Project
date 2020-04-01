<!DOCTYPE html>
<html>
    <head>
        <title>Armchair Profile</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:600&display=swap" rel="stylesheet">
        <link href="stylesheet.css" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>

    <body>

        <?php
        require 'dbAccess.php';	//uses dbAccess.php library
        $showID = 1;//htmlspecialchars($_GET["showID"]); //stores the variable showID from the url in php variable called $showID
        $info = getShowInfo($con, $showID);	//gets show info using the showID via dbAccess.php lib
        $username = "besheagl";
    ?>
    <header>
        <img src="web_hi_res_512.png" style="width:20%" alt="armchair logo">
            <div class="text">
                <h1>Armchair</h1>
            </div>  
            
            <div class="dropdown">
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="home.html">Home</a>
                <a href="feed.html">My Feed</a>
                <a href="discovery.html">Discovery</a>
                <a href="settings.html">Settings</a>
                <a href="">Log Out</a>
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
        <span class="switch"><a href="profilebooks.html">Switch to Books</a></span>
    </section>

    <main>
        <section class="profilelist">
        <span class="listtitle"><h3>Watching</h3></span>
        <ol class="profilemedialist">
        <?php foreach () { ?> <!-- this will be completed once Ian finishes the database -->
            <li>
                <img src="img/startrektng.jpg" alt="tv show image">
                <div class="data">
                    <h4 class="title">Title</h4>
                    <div class="subdata">
                        <p><span class="year">Year&nbsp;&middot;&nbsp;</span><span class="producers">Producers</span></p>
                        <br><br>
                        <form class="progressform">
                            <label for="done">Episodes Watched</label>
                            <input type="number" class="done" id="done"><span class="total">/178</span>
                        </form>
                    </div>
                </div>
            </li>

            <li>
                <img src="img/startrektng.jpg" alt="tv show image">
                <div class="data">
                    <h4 class="title">Title</h4>
                    <div class="subdata">
                        <p><span class="year">Year&nbsp;&middot;&nbsp;</span><span class="producers">Producers</span></p>
                        <br><br>
                        <form class="progressform">
                            <label for="done">Episodes Watched</label>
                            <input type="number" class="done" id="done"><span class="total">/178</span>
                        </form>
                    </div>
                </div>
            </li>

           <li>
                <img src="img/startrektng.jpg" alt="tv show image">
                <div class="data">
                    <h4 class="title">Title</h4>
                    <div class="subdata">
                        <p><span class="year">Year&nbsp;&middot;&nbsp;</span><span class="producers">Producers</span></p>
                        <br><br>
                        <form class="progressform">
                            <label for="done">Episodes Watched</label>
                            <input type="number" class="done" id="done"><span class="total">/178</span>
                        </form>
                    </div>
                </div>
            </li>

            <li>
                <img src="img/startrektng.jpg" alt="tv show image">
                <div class="data">
                    <h4 class="title">Title</h4>
                    <div class="subdata">
                        <p><span class="year">Year&nbsp;&middot;&nbsp;</span><span class="producers">Producers</span></p>
                        <br><br>
                        <form class="progressform">
                            <label for="done">Episodes Watched</label>
                            <input type="number" class="done" id="done"><span class="total">/178</span>
                        </form>
                    </div>
                </div>
            </li>

            <li>
                <img src="img/startrektng.jpg" alt="tv show image">
                <div class="data">
                    <h4 class="title">Title</h4>
                    <div class="subdata">
                        <p><span class="year">Year&nbsp;&middot;&nbsp;</span><span class="producers">Producers</span></p>
                        <br><br>
                        <form class="progressform">
                            <label for="done">Episodes Watched</label>
                            <input type="number" class="done" id="done"><span class="total">/178</span>
                        </form>
                    </div>
                </div>
            </li>
        </ol>
        <div class="add">
            <a href="addbook.html" class="addbtn"><span class="btntext">+</span></a>
        </div> 
          <br><br>
        </section>

        <section class="profilelist">
            <span class="listtitle"><h3>Favorite Shows</h3></span>
            <ol class="profilemedialist">
                <li>
                    <img src="img/startrektng.jpg" alt="tv show image">
                    <div class="data">
                        <h4 class="title">Title</h4>
                        <div class="subdata">
                            <p><span class="year">Year&nbsp;&middot;&nbsp;</span><span class="producers">Producers</span></p>
                        </div>
                    </div>
                </li>

                <li>
                    <img src="img/startrektng.jpg" alt="tv show image">
                    <div class="data">
                        <h4 class="title">Title</h4>
                        <div class="subdata">
                            <p><span class="year">Year&nbsp;&middot;&nbsp;</span><span class="producers">Producers</span></p>
                        </div>
                    </div>
                </li>

                <li>
                    <img src="img/startrektng.jpg" alt="tv show image">
                    <div class="data">
                        <h4 class="title">Title</h4>
                        <div class="subdata">
                            <p><span class="year">Year&nbsp;&middot;&nbsp;</span><span class="producers">Producers</span></p>
                        </div>
                    </div>
                </li>

                <li>
                    <img src="img/startrektng.jpg" alt="tv show image">
                    <div class="data">
                        <h4 class="title">Title</h4>
                        <div class="subdata">
                            <p><span class="year">Year&nbsp;&middot;&nbsp;</span><span class="producers">Producers</span></p>
                        </div>
                    </div>
                </li>

                <li>
                    <img src="img/startrektng.jpg" alt="tv show image">
                    <div class="data">
                        <h4 class="title">Title</h4>
                        <div class="subdata">
                            <p><span class="year">Year&nbsp;&middot;&nbsp;</span><span class="producers">Producers</span></p>
                        </div>
                    </div>
                </li>
            </ol>
            <div class="add">
                <a href="addbook.html" class="addbtn"><span class="btntext">+</span></a>
            </div> 
              <br><br>
            </section>

            <section class="profilelist">
                <span class=listtitle><h3>Watched</h3></span>
                <ol class="profilemedialist">
                    <li>
                        <img src="img/startrektng.jpg" alt="tv show image">
                        <div class="data">
                            <h4 class="title">Title</h4>
                            <div class="subdata">
                                <p><span class="year">Year&nbsp;&middot;&nbsp;</span><span class="producers">Producers</span></p>
                            </div>
                        </div>
                    </li>

                <li>
                    <img src="img/startrektng.jpg" alt="tv show image">
                    <div class="data">
                        <h4 class="title">Title</h4>
                        <div class="subdata">
                            <p><span class="year">Year&nbsp;&middot;&nbsp;</span><span class="producers">Producers</span></p>
                        </div>
                    </div>
                </li>

                <li>
                    <img src="img/startrektng.jpg" alt="tv show image">
                    <div class="data">
                        <h4 class="title">Title</h4>
                        <div class="subdata">
                            <p><span class="year">Year&nbsp;&middot;&nbsp;</span><span class="producers">Producers</span></p>
                        </div>
                    </div>
                </li>

                <li>
                    <img src="img/startrektng.jpg" alt="tv show image">
                    <div class="data">
                        <h4 class="title">Title</h4>
                        <div class="subdata">
                            <p><span class="year">Year&nbsp;&middot;&nbsp;</span><span class="producers">Producers</span></p>
                        </div>
                    </div>
                </li>

                <li>
                    <img src="img/startrektng.jpg" alt="tv show image">
                    <div class="data">
                        <h4 class="title">Title</h4>
                        <div class="subdata">
                            <p><span class="year">Year&nbsp;&middot;&nbsp;</span><span class="producers">Producers</span></p>
                        </div>
                    </div>
                </li>
                </ol>
                <div class="add">
                    <a href="addbook.html" class="addbtn"><span class="btntext">+</span></a>
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