<?php
    header("Location:".$_POST['goback']);
    //setcookie('style', $_POST['choice'], $year);
	echo "Location:".$_POST['goback'];	//debug
	require 'dbAccess.php';
	$showID = htmlspecialchars($_POST["isbn"]);
	$epTitle = htmlspecialchars($_POST["chTitle"]);
	$body = htmlspecialchars($_POST["body"]);
	$target = htmlspecialchars($_POST["replyTo"]);
	echo $isbn . " " . $chTitle . " " . $body . "<br>";	//debug
	$username = "test1";
	if ($body !== '')
		if ($target == 'mainThread'){
			addChComment($con, $username, $isbn, $chTitle, $body);
		} else {
			addReply($con, (int)$target, $username, $body);
		}
    exit();
?>