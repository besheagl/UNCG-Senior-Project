<?php
   session_start();
   require 'dbAccess.php';
			if (isset($_SESSION['login_username'])){
				$username = $_SESSION["login_username"];
			} else $username = '';
			if (isset($_GET['dispusername'])){
				$dispusername = htmlspecialchars($_GET["dispusername"]);
			} else $dispusername=$username;
         $error = "";
         $userinfo = getUserInfo($con, $dispusername);
         
if ($username)
  {
	  //make sure user is logged in
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // old and new password sent from form 
      
      $oldpassword = mysqli_real_escape_string($db,$_POST['oldpassword']);      

      $sqlnewpass = mysqli_query($db,"SELECT password FROM accounts WHERE password = '$oldpassword'");
   
      $row = mysqli_fetch_array($sqlnewpass,MYSQLI_ASSOC);
      $oldpassworddb = $row ['password'];
	  if($oldpassword==$oldpassworddb)
		{
		//check the new password
			
			$querychange = mysqli_query($db,"DELETE FROM accounts WHERE password='$oldpassword' AND username='$user'");	
				session_destroy();
				die ("<h1>Your account was deleted.<a href='login.php'>Return </a>to the main page</h1>");
				
		}
		else 
			die("Incorrect Password <a href='login.php'> Click to Return </a>");
     }
   }

else
	die("You must login to your account to delete your account.");
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>Change Password</title>
 <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:600&display=swap" rel="stylesheet">
        <link href="https://armchair.000webhostapp.com/stylesheet.css" rel="stylesheet">  
<style>
h2 {
      font-family: 'Goudy Bookletter 1911', serif;
	font-size: 6vw;
	color: #93B7EF;
	letter-spacing: 2px;
	padding: 2%;
	text-align: center;
	margin-top: 2%;
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
	 text-align: center;
	box-shadow: 0px 11px 12px 1px #9fa8b5;
	background:linear-gradient(to bottom, #809fd1 5%, #93B7EF 100%);
	border-radius:22px;
	display:block;
	color:#ffffff;
	font-family: 'Goudy Bookletter 1911', serif;
	font-size:7vw;
	margin: 0 auto;
	margin-top: 10%;
	margin-bottom: 10%;
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
        <img src="web_hi_res_512.png" style="width:20%" alt="armchair logo">
            <div class="text">
                <h1>Delete Account</h1>
            </div>  
    </header>
    <a href="https://armchair.000webhostapp.com/profilepic.php" >
                <div class="profile-img" style="background-image: url('https://armchair.000webhostapp.com/uploads/<?php echo $userinfo[4]?>'); ">
                 </a>
             
                <div  class="profileusername" style="display:inline-block; font-size: 5vw; color: #6884b0; margin-left: 25vw; text-align:left; margin-top: 5vw; " ><?php echo $dispusername ?><br><?php echo $userinfo[1]?></div></div>
   <form action="deleteAccount.php" method="POST">

   <div>
    <label for="oldpassword"><h2>Current Password</h2></label>
    <input type="password" placeholder="Enter Current Password" name="oldpassword" required>

   
        
    <button class="button1" type="submit">Delete my account</button>
    <a href="Settings.php" class="cancelbtn">Cancel</a>
   </div>


   </form>

</body>
</html>