<?php
    session_start();
    if (isset($_SESSION['login_username'])){
	    $username = $_SESSION["login_username"];
    } else $username = '';
    require 'dbAccess.php';	//uses dbAccess.php library
    $showID = htmlspecialchars($_GET["showID"]); //stores the variable showID from the url in php variable called $showID
    $info = getShowInfo($con, $showID);	//gets show info using the showID via dbAccess.php lib
    $imgURL = $info[6];
    if (showHasEps($con, $showID)){
	    $epsList = getEpsListByDate($con, $showID);
    }
?>
<!--Last updated at 1500 hours-->
<html>
    <head>
        <title><?php echo $info[1]; ?> - Armchair</title>
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
                position: absolute;
                margin-top: 2vw;
                margin-bottom: 1vw;
                margin-left: 1vw;
                width: 100%;
                text-align: center;
                color: white;
                font-size: 5vw;
            }
            /* Style the search box */
            #mySearch {
                display:inline-block;
                width: 100%;
                height:5%;
                font-size: 4vw;
                padding: 11px;
                border: 1px solid #ddd;
                font-family: Verdana, Geneva, sans-serif;
                font-weight: lighter;
                letter-spacing: .1vw;
            }
            #medialist{
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
                font-size: 5vw;
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
        <!--banner at top with armchair logo and navigation-->
        <header>
            <img src="https://armchair.000webhostapp.com/web_hi_res_512.png" style="width:20%" alt="armchair logo">
            <div class="text">
                <h1>Armchair</h1>
            </div>
			<?php include 'menu.php'; ?> 
        </header>

        <main>
            <div class="showinfo">
                <img src="<?php echo $imgURL; ?>" alt="tv show image" class="showimg">
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
                <section class="search">
                    <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search..." title="Type in a category">
		            <ul id="medialist">
                        <?php 
		                    if (showHasEps($con, $showID)){
			                    foreach ($epsList as $retval) { 
			            ?>
                        <?php $epInfo = getEpInfo($con, $info[0], $retval);?>
                            <li>
					            <a href=<?php echo "'/episode.php/?showID=" . $showID . "&epTitle=".$retval."'";?> class="show">
                                    <div class="location">
                                        <span class="title"><?php echo $epInfo[0]; //write title?></span>
                                    </div>
                                </a>
                            </li>
		                <?php 
		                    }} 
		                ?>
                    </ul>
            </div>
        </section>
    </main>

    <script>
        function openNav() {
          document.getElementById("mySidenav").style.width = "250px";
        }
        
        function closeNav() {
          document.getElementById("mySidenav").style.width = "0";
        }
        
        function myFunction() {
	        // Declare variables
	        var input, filter, ul, li, a, i;
	        input = document.getElementById("mySearch");
	        filter = input.value.toUpperCase();
	        ul = document.getElementById("medialist");
	        li = ul.getElementsByTagName("li");

	    // Loop through all list items, and hide those who don't match the search query
		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByTagName("a")[0];
			if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
				li[i].style.display = "";
			} else {
				li[i].style.display = "none";
			}
		}
	}
    </script>

    </body>
</html>