<?PHP
	$email = $_GET['email'];
	$uname = $_GET['uname'];
	$pass1 = $_GET['psw'];
	$pass2 = $_GET['cpsw'];
	echo $email;
	echo $uname;
	echo $pass1;
	echo $pass2;
	
	$servername = "localhost";
	$username = "id12568920_armchairadmin";
	$password = "csc218armchaiR";
	$dbname = "id12568920_armchair";
	$con = mysqli_connect($servername,$username,$password,$dbname);
	if(!$con)
	{
	    die("Error: ".mysqli_connect_error());
	}
	if($pass1 == $pass2){
	$sql = "INSERT INTO `accounts`(`username`, `email`, `password`, `options`) VALUES ('$uname','$email','$pass1');";
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