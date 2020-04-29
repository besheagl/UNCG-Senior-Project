<?php
	session_start();
    header("Refresh:2; url='".$_POST['goback']."'");
	//echo "Location:".$_POST['goback'];	//debug
	require 'dbAccess.php';
	$showID = htmlspecialchars($_POST["showID"]);
	$epTitle = htmlspecialchars($_POST["epTitle"]);
	$body = htmlspecialchars($_POST["body"]);
	$target = htmlspecialchars($_POST["replyTo"]);
	$username = htmlspecialchars($_POST["username"]);
?>

<html>
    <head>
        <title></title>
        <link href="https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:600&display=swap" rel="stylesheet">
        <link href="https://armchair.000webhostapp.com/feedbackstyle.css" rel="stylesheet"> 
        <link href="https://armchair.000webhostapp.com/stylesheet.css" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
	<header>
		<img src="https://armchair.000webhostapp.com/web_hi_res_512.png" style="width:20%" alt="armchair logo">
		<div class="text">
			<h1>Armchair</h1>
		</div>
		<?php include 'menu.php'; ?> 
	</header>
	<body>
		<p>
			<?php
			if ($body !== '') {
				if ($target == 'mainThread'){
					addEpComment($con, $username, $showID, $epTitle, $body);
					$_SESSION["reply"] = "1";
					echo "Posted to " .$target." ".$epTitle."!<br>";
					echo "Taking you back, or <a href = '".$_POST['goback']."' style ='color: purple;' >click here.</a>";
				} else {
					addReply($con, (int)$target, $username, $body);
					$_SESSION["reply"] = "2";
					echo "Posted reply on ".$epTitle."!<br>";
					echo "Taking you back, or <a href = '".$_POST['goback']."' style ='color: purple;' >click here.</a>";
				}
			}
			exit();
			?>
		</p>
	</body>
</html>