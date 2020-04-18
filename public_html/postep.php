<?php
    header("Location:".$_POST['goback']);
    //setcookie('style', $_POST['choice'], $year);
	echo "Location:".$_POST['goback'];	//debug
	require 'dbAccess.php';
	$showID = htmlspecialchars($_POST["showID"]);
	$epTitle = htmlspecialchars($_POST["epTitle"]);
	$body = htmlspecialchars($_POST["body"]);
	$target = htmlspecialchars($_POST["replyTo"]);
	echo $showID . " " . $epTitle . " " . $body . "<br>";	//debug
	$username = "test1";
	if ($body !== '')
		if ($target == 'mainThread'){
			addEpComment($con, $username, $showID, $epTitle, $body);
		} else {
			addReply($con, (int)$target, $username, $body);
		}
    exit();
?>