<?php
require 'dbAccess.php';	//uses dbAccess.php library
$list = getShowsList($con, 0, 100);	//gets all showID's
for ($i = 0; $i < count($list); $i++){	//builds a list of all show names with links to show.php
	echo "<a href = '/show.php/?showID=" . $list[0] . "'>" . getShowInfo($con, $list[$i])[1] . "</a>";
}
?>