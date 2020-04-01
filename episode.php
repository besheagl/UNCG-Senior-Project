<!DOCTYPE html>
<html>
    <head>
        <title>Armchair Episode</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="stylesheet.css"> <!--stylesheet for styles that apply to many of the pages-->
        
        <style> /*style specifically for Show*/

            .showinfo{
                font-size: 3.5vw;
                font-family: Verdana, Geneva, sans-serif;
                margin: 0 2vw;
             }

             .showinfo h3{
                font-weight: bold;
             }

             .showinfo .field{
                font-weight: bold;
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
                color: white;
            }
    
            .medialist{
                list-style: none;
                margin: 0 auto;
                display: inline-block;
                padding: 0;
            }
    
            .medialist li{
                background-color: #93B7EF;
                -webkit-box-shadow: 0 4px 6px -6px #222;
                -moz-box-shadow: 0 4px 6px -6px #222;
                box-shadow: 0 4px 6px -6px #222;
                max-width: 100%;
                margin: 3vw auto;
                font-family: 'Arial';
            }
    
            .medialist img{
                position: relative;
                display: flex;
                max-width: 100%;
                margin: 0 auto;
                text-align: center;
            }
    
            .medialist li .location{
                list-style: none;
                font-family: 'arial';
                font-weight: lighter;
                color: #f3d9bb;
                font-size: 3.5vw;
                position: relative;
                top: 1vw;
                margin: 0 2vw;
                text-align: left;
            }
    
            .medialist li .post{
                display: inline-block;
                /*vertical-align: bottom;*/
                font-size: 4vw;
                position: relative;
                right: 50;
                color: black;
                font-weight: bold;
                margin: 0 2vw;
                text-align: left;
            }
    
             .medialist li .like{
                color: white;
                background-color: #93B7EF;
                border: none;
                max-width: 8%;
                margin: 10px 10px;
             }
        </style>

    </head>


    <body>

        <?php
            require 'dbAccess.php';	//uses dbAccess.php library
            $showID = 1;//htmlspecialchars($_GET["showID"]); //stores the variable showID from the url in php variable called $showID
            $info = getEpInfo($con, $showID, "Remembrance");	//gets show info using the showID via dbAccess.php lib
            $comments = getEpComments($con, $showID, "Remembrance");

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
            <h3><?php echo $info[0]; //write title?></h3>
            <span class="field">Network: </span><span class="director"><?php echo $info[3];?></span>
            <br>
            <span class="field">Date: </span><span class="producers"><?php echo $info[2];?></span>
            <br>
            <span class="field">Description: </span><span class="description"><?php echo $info[4];?></span>         
        </div>
        <ol class="medialist">
            <?php foreach ($comments as $retval=>$defaultfields) { ?>
            <a href="">
                <li>
                    <div class="data">
                        <div class="location"><a href="" ><span class="username"><?php echo $defaultfields[3]; ?></span></a>
                        <a href="">
                        <div class="post">
                            <p><?php echo $defaultfields[5]; ?></p>
                        </div>
                        </a>
                    </div>
                    <a href="img/startrektng.png"><img src="img/startrektng.png" alt="tv show image"></a>
                    <button href="" class="like"><img src="img/heart.png" alt="Like button, in shape of a heart"></div>
                </li>
            </a> <?php } ?>
        </ol>
        </div> 

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