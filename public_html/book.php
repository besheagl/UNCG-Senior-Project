<?php
    session_start();
    if (isset($_SESSION['login_username'])){
	    $username = $_SESSION["login_username"];
    } else $username = '';
    require 'dbAccess.php';	//uses dbAccess.php library
    $isbn = htmlspecialchars($_GET["isbn"]); //stores the variable showID from the url in php variable called $showID
    $info = getBookInfo($con, $isbn);	//gets show info using the showID via dbAccess.php lib
    $imgURL = $info[6];
    if (bookHasChs($con, $isbn)){
	    $chsList = getChsList($con, $isbn);
    }
?>

<!--Last updated at 1500 hours-->

<html>
    <!--Show terminology is being used for books as well on the front end-->
    <head>
        <!--Page for viewing the chapter threads of a book-->
        <title><?php echo $info[1]; ?> - Armchair</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="https://armchair.000webhostapp.com/stylesheet.css"> <!--stylesheet for styles that apply to many of the pages-->
        
        <style> /*style specifically for Book*/
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
             
            .showinfo h3{
                margin: 1vw auto;
             }
             
             .showinfo .field{
                font-weight: bold;
             }
             
             .infopiece{
                margin: 1vw auto;
                line-height: 5vw;
             }
             
             .threadlist{ /*For the chapter threads and the chapter info*/
                position: relative;
                top: 2vw;
             }
            
            #medialist{ /*For the chapter threads*/
                list-style: none;
                margin: 0 auto;
                display: block;
                padding: 0;
            }
            
            li { /*For each chapter thread*/
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
            
            #medialist li:hover {
                background-color: #a7c3f1;
            }
            
            .chapter { /*For each chapter thread title*/
                position: absolute;
                width: 100%;
                text-align: center;
                top: 50%;
                transform: translateY(-50%);
            }
        </style>
    </head>

    <body>
        <header>
            <!--Armchair logo-->
            <img src="https://armchair.000webhostapp.com/web_hi_res_512.png" style="width:20%" alt="armchair logo">
            <div class="text">
                <h1>Armchair</h1>
            </div>
            <!--Side Navigation-->
			<?php include 'menu.php'; ?>
        </header>

        <main>
            <div class="showinfo">
                <img src="<?php echo $imgURL ?>" alt="book image" class="showimg">
                <h3><?php echo $info[1]; //write title?></h3>
                <span class="infopiece">
                    <span class="field">Author: </span><?php echo $info[3]; ?>
                </span>
                <br>
                <span class="infopiece">
                    <span class="field">Publisher: </span><?php echo $info[4]; ?>
                </span>
                <br>
                <span class="infopiece">
                    <span class="field">Date: </span><?php echo $info[2]; ?>
                </span>
                <br>
                <span class="infopiece">
                    <span class="field">Description: </span><?php echo $info[5]; ?> 
                </span>      
            </div>

            <div class="threadlist">
                <span class="listtitle"><h3>Chapter Threads</h3></span>
                <section class="search">
                    <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search..." title="books">
                    <ul id="medialist">
                        <?php 
		                    if (bookHasChs($con, $isbn)){
			                    foreach ($chsList as $retval) { 
			            ?>
                        <li>
					        <a href=<?php echo "'/chapter.php/?isbn=" . $isbn . "&chTitle=".$retval."'";?> class="book" >
                                <div class="chapter">
                                    <?php echo $retval; //write title?>
                                </div>
                            </a>
                        </li>
		                <?php }} ?>
                    </ul>
                </section>
            </div>
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