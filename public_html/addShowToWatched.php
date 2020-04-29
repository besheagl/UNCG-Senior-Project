<?php
    session_start();
    header("Location:".$_POST['goback']);
    require 'dbAccess.php';	//uses dbAccess.php library
    echo "Location:".$_POST['goback'];	//debug
    $showID = htmlspecialchars($_POST["showToAdd"]);
    echo $showID . "<br>";	//debug
    $username = $_SESSION["login_username"];
    if ($showID !== ''){
        addWatched($con, $username, $showID);
		$_SESSION['addwatched'] = $showID;
    }
    exit();
?>