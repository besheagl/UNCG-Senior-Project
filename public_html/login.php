<?php
   include("config.php");
   session_start();
   $error = "";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['psw']); 
      // Prevent SQL injections
      $myusername = stripslashes($myusername);
      $mypassword = stripslashes($mypassword);
     // $myusername = mysql_real_escape_string($myusername);
     // $mypassword = mysql_real_escape_string($mypassword);
      $sql = "SELECT username FROM accounts WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      // $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_username'] = $myusername;
         
         header("location: welcometest.php");
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
<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Acme' rel='stylesheet'>
<style>

h1 {
	display: inline-block;
    font-family: 'Pacifico';
	font-size: 7vw;	
	text-shadow: 4px 2px #4ECDC7;
	color: black;
	letter-spacing: 2px;
	margin-left: 1vw;
}
h2 {
    font-family: 'Acme';
	font-size: 5vw;
	color: #4ECDC7;
	letter-spacing: 2px;
}
h3 {
	font-family: 'Acme';
	font-size: 5vw;
	letter-spacing: 2px;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 1px 1px;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

.button1 {
	box-shadow: 0px 11px 12px 1px #276873;
	background:linear-gradient(to bottom, #599bb3 5%, #73ecff 100%);
	background-color:#599bb3;
	border-radius:22px;
	display:block;
	font-style: bold;
	color:#ffffff;
	font-family: 'Pacifico';
	font-size:6vw;
	margin: 0 auto;
	margin-top: 8%;
	margin-bottom: 8%;
	padding:5px 5px;
	text-decoration:none;
	text-shadow:0px 2px 3px #3d768a;
	width: 70vw;
}
.button1:active {
	position:relative;
	top:1px;
}

.cancelbtn {
  background:linear-gradient(to bottom, #9A3329 5%, #E9756A 100%);
  border-radius:22px;
  box-shadow: 0px 11px 12px 1px #276873;
  color:#ffffff;
  font-family: 'Acme';
  font-size:6vw;
  margin: 0 auto;
  margin-bottom: 10%;
  padding:5px 5px;
  text-decoration:none;
  text-shadow:0px 2px 3px #3d768a;
  width: 30vw;
}


span.psw{
  float: right;
  font-family: 'Acme';
  font-size: 5vw;
  margin-right: 5%;
  padding-top: 5%;
}


</style>
</head>


<body>
<img src="logo.png" style="width:20%; margin-left: 5%; margin-top: 10%;">
<h1>Armchair Login</h1>

<form action="login.php" method="POST">

  <div>
    <label for="username"><h2>Username</h2></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><h2>Password</h2></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
        
    <button class="button1" type="submit">Login</button>
    
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button href="home.html" type="button"  class="cancelbtn">Cancel</button>
    <span class="psw"><a href="#"> Forgot password?</a></span>
  </div>
</form>

</body>
</html>
