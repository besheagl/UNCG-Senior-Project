<?php
require 'dbAccess.php';	//uses dbAccess.php library
$showID = htmlspecialchars($_GET["showID"]); //stores the variable showID from the url in php variable called $showID
$info = getShowInfo($con, $showID);	//gets show info using the showID via dbAccess.php lib
$comments = getShowComments($con, $showID);
?>
<h1><?php echo $info[1]; //write title?></h1>
<p><?php echo $info[5]; //write description?></p>
<h3>Comments</h3>
<?php echo "<span style = 'border:1px solid black;'>" . $comments[0][0] . "-" . $comments[0][2] . " " . $comments[0][3] . "</span><br>" . $comments[0][4]
//write comments ?>
