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
      $newpassword = mysqli_real_escape_string($db,$_POST['newpassword']);
	  $cnewpassword = mysqli_real_escape_string($db,$_POST['cnewpassword']); 
      $newpassword = md5($newpassword);
      $cnewpassword = md5($cnewpassword);
      $oldpassword = md5($oldpassword);
      

      $sqlnewpass = mysqli_query($db,"SELECT password FROM accounts WHERE password = '$oldpassword'");
   
      $row = mysqli_fetch_array($sqlnewpass,MYSQLI_ASSOC);
      $oldpassworddb = $row ['password'];
	  if($oldpassword==$oldpassworddb)
		{
		//check the new password
			if ($newpassword==$cnewpassword)
			{
			$querychange = mysqli_query($db,"UPDATE accounts SET password='$newpassword' WHERE username='$user'");	
				session_destroy();
				echo "<p align='center'> <font color=#588bdb font face='serif' size='36pt' ><br><br>Your password has been updated. <br><br><a href='login.php'> Click here to log in with your new password</a> </font> </p>";
				die();

			}	
			else 
			echo "<p align='center'> <font color=#588bdb font face='serif' size='36pt' ><br><br>New passwords entered do not match.<br><br><a href='changePassword.php'>Click here to try again</a></font> </p>";
				die();
				
				
		}
		else 
			echo "<p align='center'> <font color=#588bdb font face='serif' size='36pt' ><br><br>Incorrect Password.<br><br><a href='changePassword.php'>Click here to try again</a></font> </p>";
				die();
     }
   }

else
	die("You must login to your account to change your password.");
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
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 5px 25px;
  font-size: 20px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -30px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -30px;
  content: "✖";
}

</style>
</head>


    <header>
        <img src="web_hi_res_512.png" style="width:20%" alt="armchair logo">
            <div class="text">
                <h1>Change Password</h1>
            </div>  
    </header>
    <a href="https://armchair.000webhostapp.com/profilepic.php" >
                <div class="profile-img" style="background-image: url('https://armchair.000webhostapp.com/uploads/<?php echo $userinfo[4]?>'); ">
                 </a>
             
                <div  class="profileusername" style="display:inline-block; font-size: 5vw; color: #6884b0; margin-left: 25vw; text-align:left; margin-top: 5vw; " ><?php echo $dispusername ?><br><?php echo $userinfo[1]?></div></div>

<form action="changePassword.php" method="POST">

  <div>
    <label for="oldpassword"><h2>Current Password</h2></label>
    <input type="password" placeholder="Enter Current Password" name="oldpassword" required>
    
    
    <label for="newpassword"><h2>Create a new password: </h2></label>
    <input type="password" placeholder="Enter New Password" name="newpassword" id="psw"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}" title="Password must contain at least one number, one uppercase, one lowercase letter, and be between 8 and 16 characters" required>
    
        <div id="message">
             <h3>Password must contain the following:</h3>
             <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
             <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
             <p id="number" class="invalid">A <b>number</b></p>
             <p id="length" class="invalid"> <b>8 to 16 characters</b></p>
        </div>
        
   <label for="cnewpassword"><h2>Reenter new password</h2></label>
    <input type="password" placeholder="Enter new password" name="cnewpassword" required>
        
    <button class="button1" type="submit">Change Password</button>
    <a href="Settings.php" class="cancelbtn">Cancel</a>
  </div>


</form>
<script>
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
      if(myInput.value.length <= 16) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  }} else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
</body>
</html>