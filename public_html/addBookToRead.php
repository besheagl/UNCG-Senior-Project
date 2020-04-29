<?php
    session_start();
    header("Location:".$_POST['goback']);
    require 'dbAccess.php';	//uses dbAccess.php library
    echo "Location:".$_POST['goback'];	//debug
    $isbn = htmlspecialchars($_POST["bookToAdd"]);
    echo $isbn . "<br>";	//debug
    $username = $_SESSION["login_username"];
    if ($isbn !== ''){
        addRead($con, $username, $isbn);
		$_SESSION['addread'] = $isbn;
    }
    exit();
?>