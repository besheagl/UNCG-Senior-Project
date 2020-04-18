<?php
    header("Location:".$_POST['goback']);
    require 'dbAccess.php';	//uses dbAccess.php library
    echo "Location:".$_POST['goback'];	//debug
    $showID = htmlspecialchars($_POST["showToAdd"]);
    echo $showID . "<br>";	//debug
    $username = "fanAcct";
    if ($showID !== ''){
        addWatched($con, $username, $showID);
    }
    exit();
?>