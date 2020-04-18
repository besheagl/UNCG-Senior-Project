<?php
require 'dbAccess.php';

// All of these should work i think

echo getShowInfo($con, getShowsList($con, 0, 1)[0])[1];
makeTable(getShows($con, array(2,1,2)));
echo getEpInfo($con, 1, getEpsList($con, 1)[0])[0] . "<br>";
echo getBookInfo($con, getBooksList($con, 0, 1)[0])[1] . "<br>";
echo getChsList($con, getBooksList($con, 0, 100)[0])[0] . "<br>";
//makeTable(getBookComments($con, getBooksList($con, 0, 100)[0]));
makeTable(getAllComments($con, 0, 100));

$allComments = getAllComments($con, 0, 100);
$allCmData = array();
echo "<br>All comments: <br>";
for ($i = 0; $i < count($allComments); $i++){
	$temp = getCommentInfo($con, $allComments[$i][0]);
	for ($j = 0; $j < count($temp); $j++){
		echo $temp[$j]. "-";
	}
	echo "<br>";
}
makeTable($allCmData);

echo "<br>All comments by 'besheagl': <br>";
makeTable(getCommentsByUser($con,"besheagl"));

echo "<br>All comments by 'IDontExist': <br>";
makeTable(getCommentsByUser($con,"IDontExist"));

$showEx = getShowsList($con, 0, 100)[0];
echo "<br>All comments from first ep of first show: <br>";
makeTable(getEpComments($con, $showEx, getEpsList($con, $showEx)[0]));
echo getEpComments($con, $showEx, getEpsList($con, $showEx)[0])[0][3];
echo "<br>replies for cmRef = 2: <br>";
echo getRepliesByComment($con, 2)[0][0] .  getRepliesByComment($con, 2)[0][1] .  getRepliesByComment($con, 2)[0][2] .  getRepliesByComment($con, 2)[0][3] . "<br>";
echo getRepliesByComment($con, 2)[0][4] . "<br>";
echo getRepliesByComment($con, getEpComments($con, getShowsList($con, 0, 100)[0], getEpsList($con, getShowsList($con, 0, 100)[0])[0])[0][6])[0][4];

$bookEx = getBooksList($con, 0, 100)[0];
echo "<br>All comments from first ch of first book: <br>";
makeTable(getChComments($con, $bookEx, getChsList($con, $bookEx)[0]));

makeTable(getActorsByShow($con, 1));

echo getAllComments($con, 0, 100)[0][0] . "<br>";
echo getCommentInfo($con, getAllComments($con, 0, 100)[0][0])[0] . "<br>";


echo "<br>Watched List for username 'Green': <br>";
echo getShowInfo($con, getWatchedByUser($con, "Green")[0])[1];
echo "<br>Likes by username 'Green': <br>";
makeTable(getLikesByUser($con, 'Green'));
echo "<br>Likes for first comment of first ep of first show 'Green': <br>";
makeTable(getLikesByComment($con, getEpComments($con, getShowsList($con, 0, 100)[0], getEpsList($con, getShowsList($con, 0, 100)[0])[0])[0][6]));
?>