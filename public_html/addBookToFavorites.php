<?php
    header("Location:".$_POST['goback']);
    require 'dbAccess.php';	//uses dbAccess.php library
    echo "Location:".$_POST['goback'];	//debug
    $isbn = htmlspecialchars($_POST["bookToAdd"]);
    echo $isbn . "<br>";	//debug
    $username = "fanAcct";
    if ($isbn !== ''){
        addFavoriteBooks($con, $username, $isbn);
    }
    exit();
?>