<?php
    session_start();
    header("Location:".$_POST['goback']);
    require 'dbAccess.php';	//uses dbAccess.php library
    echo "Location:".$_POST['goback'];	//debug
    $cmRef = htmlspecialchars($_POST['commentToLike']);
    echo $cmRef . "<br>";	//debug
     $username = $_SESSION["login_username"];
    if ($cmRef !== ''){
        addLike($con, $username, $cmRef);
    }
    exit();
?>