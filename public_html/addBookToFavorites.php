<?php
    session_start();
    header("Location:".$_POST['goback']);
    require 'dbAccess.php';
    $isbn = htmlspecialchars($_POST["bookToAdd"]);
    echo $isbn . "<br>";	//debug
     $username = $_SESSION["login_username"];
    if ($isbn !== ''){
        addFavoriteBooks($con, $username, $isbn);
		$_SESSION['addbookfav'] = $isbn;
    }
    exit();
?>