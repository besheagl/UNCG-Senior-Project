<?PHP
	$email = $_POST['email'];
	$username = $_POST['uname'];
	$pass1 = $_POST['psw'];
	$pass2 = $_POST['cpsw'];
	echo $email;
	echo $username;
	echo $pass1;
	echo $pass2;
	
	include 'connect.php';
	
	if($pass1 == $pass2){
	$sql = "INSERT INTO accounts (username, email, password, options) VALUES ('$username','$email','$pass1','');";
	    if(mysqli_query($con,$sql))
	    {
	        echo "Account Created.";
	    }
	    else
	    {
	        echo "Error creating account.";
	    }
	    
	}else
	{
	    echo "Passwords entered do not match. Try again.";
	}
?>
