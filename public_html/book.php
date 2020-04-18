<html>
    <head>
        <title>Armchair Show</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="https://armchair.000webhostapp.com/stylesheet.css"> <!--stylesheet for styles that apply to many of the pages-->
        
        <style> /*style specifically for Show*/

            .showimg{
                max-width: 40%;
                float: right;
            }

            .showinfo{
                font-size: 3.5vw;
                font-family: Verdana, Geneva, sans-serif;
                margin: 0 2vw;
                color: #141414;
             }

             .infopiece{
                margin: 1vw auto;
                line-height: 5vw;
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
        $isbn = htmlspecialchars($_GET["isbn"]); //stores the variable showID from the url in php variable called $showID
        $info = getBookInfo($con, $isbn);	//gets show info using the showID via dbAccess.php lib
        $imgURL = $info[6];
		if (bookHasChs($con, $isbn)){
			$chsList = getChsList($con, $isbn);
		}
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
                <a href="https://armchair.000webhostapp.com/profileshows.php">Profile</a>
              </div>
    
                  <button class="dropbtn" onclick="openNav()"><div></div><div></div><div></div>
                    <i class="fa fa-caret-down"></i>
                  </button>
            </div>
        </header>

    <main>

        <div class="showinfo">
            <img src="<?php echo $imgURL ?>" alt="book image" class="showimg">
            <h3><?php echo $info[1]; //write title?></h3>
            <span class="infopiece">
                <span class="field">Author: </span><span class="director"><?php echo $info[3]; ?></span>
            </span>
            <br>
            <span class="infopiece">
                <span class="field">Publisher: </span><span class="producers"><?php echo $info[4]; ?></span>
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
        <span class="listtitle"><h3>Chapter Threads</h3></span>
        <ol class="medialist">
        <?php 
		if (bookHasChs($con, $isbn)){
			foreach ($chsList as $retval) { ?>
            <?php //$chInfo = getChInfo($con, $info[0], $retval);?>
            <a href="">
                <li>
                        <div class="location">
                            <a href=<?php echo "'/chapter.php/?isbn=" . $isbn . "&chTitle=".$retval."'";?> ><span class="title"><?php echo $retval; //write title?></span></a>
                        </div>
                </li>
		</a> <?php }} ?>
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