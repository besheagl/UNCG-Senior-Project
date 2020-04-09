<!DOCTYPE html>
<html>
    <head>
        <title>Armchair Show</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="stylesheet.css"> <!--stylesheet for styles that apply to many of the pages-->
        
        <style> /*style specifically for Show*/

            .showinfo{
                font-size: 3.5vw;
                font-family: Verdana, Geneva, sans-serif;
                margin: 0 2vw;
                color: #141414;
             }

             .infopiece{
                margin: 1vw auto;
                display: inline-block;
             }

             .showinfo h3{
                margin: 1vw auto;
             }

             .showinfo .field{
                font-weight: bold;
             }

             .threadlist{
                position: relative;
                top: 2vw;
             }

            .listtitle{
                margin: 0 0;
                position: relative;
                top: 0;
                background:linear-gradient(to bottom, #ff8878 5%,#ebc192 100%);
                background-color:#ff8878;
                color: white;
                max-width: 100%;
                height: 10vw;
                display: block;
            }
    
            .listtitle h3{
                font-family: 'Goudy Bookletter 1911', serif;;
                font-weight: lighter;
                position: absolute;
                margin-top: 2vw;
                margin-bottom: 1vw;
                margin-left: 1vw;
                width: 100%;
                text-align: center;
                color: white;
            }
    
            .medialist{
                list-style: none;
                margin: 0 auto;
                display: block;
                padding: 0;
            }
    
            li {
                background-color: #93B7EF;
                -webkit-box-shadow: 0 4px 6px -6px #222;
                -moz-box-shadow: 0 4px 6px -6px #222;
                box-shadow: 0 4px 6px -6px #222;
                max-width: 100%;
                height: 10vw;
                margin: 0 auto;
                position: relative;
                font-family: 'Arial';
                font-weight: lighter;
                color: white;
                font-size: 3.5vw;
                text-align: center;
                border-style: solid;
                border-color: #87a4d3;
                border-top: none;
                border-width: .25px;
            }

            .location {
                position: absolute;
                width: 100%;
                text-align: center;
                top: 50%;
                transform: translateY(-50%);
            }

        </style>

    </head>


    <body>
    
    <?php
        require 'dbAccess.php';	//uses dbAccess.php library
        $showID = 1;//htmlspecialchars($_GET["showID"]); //stores the variable showID from the url in php variable called $showID
        $info = getShowInfo($con, $showID);	//gets show info using the showID via dbAccess.php lib
        $epsList = getEpsListByDate($con, $showID);
        $epInfo = getEpInfo($con, $showID, "Remembrance");	//gets show info using the showID via dbAccess.php lib
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

    <main>

        <div class="showinfo">
            <h3><?php echo $info[1]; //write title?></h3>
            <span class="infopiece">
            <span class="field">Director: </span><span class="director"><?php echo $info[3]; ?></span>
            </span>
            <br>
            <span class="infopiece">
            <span class="field">Producers: </span><span class="producers"><?php echo $info[4]; ?></span>
            </span>
            <br>
            <span class="infopiece">
            <span class="field">Date: </span><span class="year"><?php echo $info[2]; ?></span>
            </span>
            <br>
            <span class="infopiece">
            <span class="field">Description: </span><span class="description"><?php echo $info[5]; ?></span> 
            </span>        
        </div>

        <div class="threadlist">
        <span class="listtitle"><h3>Episode Threads</h3></span>
        <ol class="medialist">
        <?php foreach ($epsList as $retval) { ?>
            <?php
                $epInfo = getEpInfo($con, $info[0], $retval);
                ?>
            <a href="">
                <li>
                        <div class="location">
                            <a href="" ><span class="title"><?php echo $epInfo[0]; //write title?></span></a>
                        </div>
                </li>
            </a> <?php } ?>
        </ol>
        <div class="threadlist">
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