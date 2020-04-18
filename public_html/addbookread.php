<!DOCTYPE html>
<html>
    <head>
        <!--This page is for adding a book to a list such as the Read list-->
        <title>Armchair Add Book</title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:600&display=swap" rel="stylesheet">
        <link href="stylesheet.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>

    <style>
                        /*Styling peach "Add Books" banner*/
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
#myMenu li {
  padding: 12px;
  text-decoration: none;
  color: black;
  display: block
}

#myMenu li {
  background-color: #eee;
}
    </style>

    <body>

    <?php
        require 'dbAccess.php';
        $books = getBooksList($con, 0, 1073741824);
    ?>

    <header>
        <img src="web_hi_res_512.png" style="width:20%" alt="armchair logo">
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
    <span class="listtitle"><h3>Add Book</h3></span>

<!--<ul id="myMenu">-->
<div id = 'addread'>
<form method="post" action="https://armchair.000webhostapp.com/addBookToRead.php">
    <fieldset><legend>Select Book to Add to Read</legend>
    <select name = 'bookToAdd' style = 'width: 90%; height: 50px;'>
        <?php //if (chHasComments($con, $isbn, $chTitle)) { could use some checking like this
			for ($j = 0; $j<count($books); $j++){
                $curbook = getBookInfo($con, $books[$j]);
                echo "<option value = " .$curbook[0]. ">" .$curbook[1]. "</option>"; 
			} ?>
         <!--<input type = "hidden" name = "isbn" value = "<?php echo $isbn; ?>">-->
         <input type = "hidden" name = "goback" value = "<?php echo 'https://armchair.000webhostapp.com/addbookread.php' ?>">
    </select><br><br>
    <input type="submit" name="submit" value="Add" style = "width: 90%;height: 50px;">
    </fieldset>
</form>
</div>
<!--</ul>-->
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