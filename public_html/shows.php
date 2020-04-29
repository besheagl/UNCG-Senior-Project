<?php
    session_start();
    if (isset($_SESSION['login_username'])){
	    $username = $_SESSION["login_username"];
    } else $username = '';
    require 'dbAccess.php';	//uses dbAccess.php library
    if (isset($_GET["rangea"])&&isset($_GET["rangeb"])){
	    $rangea = $_GET["rangea"]-1;
	    $rangeb = $_GET["rangeb"]-1;
    } else {
	    $rangea = 0;
	    $rangeb = 99;
    }
    $list = getShowsList($con, 0, 100);	//gets all showID's
?>
<style> /*style specifically for Shows*/
            
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
                color:white;
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
                font-size: 5vw;
                text-align: left;
                border-style: solid;
                border-color: #87a4d3;
                border-top: none;
                border-width: .25px;
            }
            
        </style>
<html>
    <head>
        <!--This page is for adding a show to a list such as the Watched list-->
        <title>Shows - Armchair</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:600&display=swap" rel="stylesheet">
        <link href="https://armchair.000webhostapp.com/stylesheet.css" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>

    <body>
        <header>
            <img src="web_hi_res_512.png" style="width:20%" alt="armchair logo">
		    <div class="text">
			    <h1>Armchair</h1>
		    </div>  
		    <?php include 'menu.php'; ?>       
        </header>

        <main>
            <span class="listtitle" style="font-size:4.5vw; font-weight:bold;"><h3>Shows</h3></span>
            <section class="search">
                <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search..." title="Type in a category">
		        <ul id="myMenu">
		            <form action="post">
		                <?php for ($i = 0; $i < count($list); $i++){	//builds a list of all show names with links to show.php ?>
		                <li> 
			                <a style = "color:white" href = "<?php echo "https://armchair.000webhostapp.com/show.php/?showID=" . getShowInfo($con, $list[$i])[0]; ?>"><?php echo getShowInfo($con, $list[$i])[1]; ?></a>
		                </li>
		                <?php } ?>
		            </form>
		        </ul>
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
	            //Declare variables
	            var input, filter, ul, li, a, i;
	            input = document.getElementById("mySearch");
	            filter = input.value.toUpperCase();
	            ul = document.getElementById("myMenu");
	            li = ul.getElementsByTagName("li");

	            //Loop through all list items, and hide those who don't match the search query
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