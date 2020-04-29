<?php
    session_start();
    header("Location:".$_POST['goback']);
    require 'dbAccess.php';	//uses dbAccess.php library
    echo "Location:".$_POST['goback'];	//debug
    $isbn = htmlspecialchars($_POST["bookToRemove"]);
    echo $isbn . "<br>";	//debug
     $username = $_SESSION["login_username"];
    if ($isbn !== ''){
        removeReading($con, $username, $isbn);
		$_SESSION['remreading'] = $isbn;
    }
    exit();
?>