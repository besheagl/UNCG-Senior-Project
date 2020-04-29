<?php
   include("config.php");
   session_start();
   $error = "";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['formusername']);
      $mypassword = mysqli_real_escape_string($db,$_POST['formpsw']); 
      // Prevent SQL injections
      $myusername = stripslashes($myusername);
      $mypassword = stripslashes($mypassword);
      //md5 hashing is used
      $mypassword = md5($mypassword);

      $sqlusername = "SELECT username FROM accounts WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sqlusername);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count == 1) {
         //session_register("myusername");
         $_SESSION["login_username"] = $myusername;
         
         header("location: profileshows.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>Login</title>
 <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:600&display=swap" rel="stylesheet">
        <link href="https://armchair.000webhostapp.com/stylesheet.css" rel="stylesheet">  
<style>
h2 {
    font-family: 'Goudy Bookletter 1911', serif;
	font-size: 5vw;
	color: #6884b0;
	letter-spacing: 2px;
	padding: 1%;
	text-align: center;
}
h3 {
	font-family: 'Goudy Bookletter 1911', serif;
	font-size: 5vw;
	letter-spacing: 2px;
	padding: 5%;
	text-align: center;
}


input[type=text], input[type=password] {
  width: 90%;
  display: block;
  margin : 0 auto;
  padding: 20px 20px;
  border: 1px solid #ccc;
  box-sizing: border-box;
  text-align: center;
}

.button1 {
	width: 70vw;
	box-shadow: 0px 11px 12px 1px #9fa8b5;
	background:linear-gradient(to bottom, #809fd1 5%, #93B7EF 100%);
	border-radius:22px;
	display:block;
	color:#ffffff;
	font-family: 'Goudy Bookletter 1911', serif;
	font-size:7vw;
	margin: 0 auto;
	margin-top: 5%;
	margin-bottom: 5%;
	padding:5px 5px;
	text-decoration:none;
	text-shadow:0px 2px 3px #93B7EF;
}
.button1:active {
	position:relative;
	top:1px;
}
.cancelbtn {
  width: 40vw;
  box-shadow: 0px 11px 12px 1px #9fa8b5;
  background:linear-gradient(to bottom, #9A3329 5%, #E9756A 100%);
  	border-radius:22px;
	display:block;
	color:#ffffff;
	font-family: 'Goudy Bookletter 1911', serif;
	font-size:7vw;
	text-align: center;
	margin: 0 auto;
	margin-top: 10%;
	margin-bottom: 10%;
	padding:5px 5px;
	text-decoration:none;
	text-shadow:0px 2px 3px #93B7EF;
}


span.psw{
  display: block;
  margin : 0 auto;
  font-family: 'Acme';
  font-size: 5vw;
  padding-top: 5%;
  text-align:center;
}


</style>
</head>


 <header>
        <img src="https://armchair.000webhostapp.com/web_hi_res_512.png" style="width:20%" alt="armchair logo">
            <div class="text">
                <h1>Armchair Login</h1>
            </div>  
 </header>

<form action="login.php" method="POST">

  <div>
    <label for="formusername"><h2>Username</h2></label>
    <input type="text" placeholder="Enter Username" name="formusername" required>

    <label for="formpsw"><h2>Password</h2></label>
    <input type="password" placeholder="Enter Password" name="formpsw" required>
        
    <button class="button1" type="submit">Login</button>
    
  </div>

  <a href="index.php" class="cancelbtn">Cancel</a>
  </div>
</form>

</body>
</html>
