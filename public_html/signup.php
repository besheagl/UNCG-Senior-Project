<?PHP
    session_start();

	include 'connect.php';
	if($_SERVER["REQUEST_METHOD"] == "POST") {
	    	$email = $_POST['email'];
        	$username = $_POST['formusername'];
        	$pass1 = $_POST['formpsw'];
        	$pass2 = $_POST['cpsw'];
    
	if($pass1 == $pass2){
	$sql = "INSERT INTO accounts (username, email, password, options) VALUES ('$username','$email','".md5($pass1)."','');";
	    if(mysqli_query($con,$sql))
	    {
	        $_SESSION["login_username"] = $username;
         
            header("location: profileshows.php");
	    }
	    else
	    {
	        echo "<h1>Username already exists! </h1>";
	    }
	    
	}else
	{
	    echo "<h1>Passwords entered do not match. Try again.</h1>";
	}
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>Sign up</title>
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

<body>
<header>
        <img src="https://armchair.000webhostapp.com/web_hi_res_512.png" style="width:20%" alt="armchair logo">
            <div class="text">
                <h1>Sign up for Armchair</h1>
            </div>  
 </header>


<form action="signup.php" method="POST">

  <div>
    <label for="email"><h2>Enter your email:</h2></label>
    <input type="text" placeholder="Enter email address" name="email" required>
    
    <label for="formusername"><h2>Create a username: </h2></label>
    <input type="text" placeholder="Enter Username" name="formusername" required>

    <label for="formpsw"><h2>Create a password: </h2></label>
    <input type="password" placeholder="Enter Password" name="formpsw" id="psw"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}" title="Password must contain at least one number, one uppercase, one lowercase letter, and be between 8 and 16 characters" required>
    
        <div id="message">
             <h3>Password must contain the following:</h3>
             <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
             <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
             <p id="number" class="invalid">A <b>number</b></p>
             <p id="length" class="invalid">Minimum <b>8 characters</b></p>
        </div>
        
    <label for="cpsw"><h2>Re-enter your password: </h2></label>
    <input type="password" placeholder="Enter password" name="cpsw" required>
    
    <button class="button1" type="submit">Create Account</button>
    
  </div>
</form>
    <a href="index.php" class="cancelbtn">Cancel</a>
    
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
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
</body>
</html>