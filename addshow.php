<!DOCTYPE html>
<html>
    <head>
        <!--This page is for adding a show to a list such as the Watched list-->
        <title>Armchair Add Show</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:600&display=swap" rel="stylesheet">
        <link href="stylesheet.css" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>

    <style>
                        /*Styling peach "Add Shows" banner*/
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

    /* Style the search box */
#mySearch {
  width: 100%;
  font-size: 18px;
  padding: 11px;
  border: 1px solid #ddd;
  font-family: Verdana, Geneva, sans-serif;
  font-weight: lighter;
  letter-spacing: .1vw;
}

/* Style the navigation menu */
#myMenu {
  list-style-type: none;
  padding: 0;
  margin: 0;
  font-family: Verdana, Geneva, sans-serif; 
}

/* Style the navigation links */
#myMenu li a {
  padding: 12px;
  text-decoration: none;
  color: black;
  display: block
}

#myMenu li a:hover {
  background-color: #eee;
}
    </style>

    <body>

        <?php
        require 'dbAccess.php';	//uses dbAccess.php library
        $list = getShowsList($con, 0, 100);	//gets all showID's
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
    <span class="listtitle"><h3>Add Show</h3></span>
    <section class="search">
    <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search..." title="Type in a category">

<ul id="myMenu">
<?php for ($i = 0; $i < count($list); $i++){	//builds a list of all show names with links to show.php ?>
  <li><a href="#"> <?php echo getShowInfo($con, $list[$i])[1]; ?></a></li>
<?php } ?>
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
  // Declare variables
  var input, filter, ul, li, a, i;
  input = document.getElementById("mySearch");
  filter = input.value.toUpperCase();
  ul = document.getElementById("myMenu");
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