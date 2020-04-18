<?php
require 'connect.php';

//	shows
function getShows($con, $prj) {
	$retval = array();
	
	//	creating projection
	$defaultFields = array("showID", "title", "year", "director", "producer", "description");
	$fields = array();
	if (is_array($prj)){
		if (count($prj) >= 1){
			for ($i = 0; $i<count($prj); $i++) {
				array_push($fields, $defaultFields[$prj[$i]]);
			}
		} else {
			//trigger_error("No fields selected. second argument should be an int or an array of ints.");
		}
	} else {
		if (is_int($prj)){
			array_push($fields, $defaultFields[$prj]);
		}
	}
	$sqlstr = "select " . $fields[0];
	for ($i=1;$i<count($fields);$i++){
		$sqlstr .= ", " . $fields[$i];
	}
	$sqlstr .= " from shows";
	
	$rows = $con->query($sqlstr);
	
	//	adding to array for return
	if ($rows->num_rows > 0){
		array_push($retval, $fields);
		while ($row = $rows->fetch_assoc()){
			$record = array();
			for($j = 0; $j < count($fields); $j++){
				array_push($record, $row[$fields[$j]]);
			}
			array_push($retval, $record);
		}
	}
	//makeTable($retval, $fields);
	return $retval;
}

function getShowsList($con, $a, $b) {
	$retval = array();
	$sqlstr = "SELECT showID FROM `shows` LIMIT " . $a . "," . $b;
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			array_push($retval, $row["showID"]);
		}
		return $retval;
	} else {
		trigger_error("No shows found in database");
	}
}

function getShowInfo($con, $showID) {
	$retval = array();
	$defaultFields = array("showID", "title", "year", "director", "producer", "description", "imgURL");
	$sqlstr = "select * from shows WHERE showID=" . $showID . ";";
	$rows = $con->query($sqlstr);
	
	if ($rows->num_rows > 0){
		$row = $rows->fetch_assoc();
		$record = array();
		for($j = 0; $j < count($defaultFields); $j++){
			array_push($record, $row[$defaultFields[$j]]);
		}
		return $record;
	}
}

function showHasEps($con, $showID) {
	$sqlstr = "SELECT * FROM `episodes` WHERE `episodes`.`showID`=".$showID.";";
	$rows = $con->query($sqlstr);
	$num = mysqli_num_rows($rows);
	if ($num>0) {
		return true;
	} else {
		return false;
	}
}

function getEpsList($con, $showID) {
	$retval = array();
	$sqlstr = "SELECT epTitle FROM `episodes`";
	$sqlstr .= "\n WHERE showID=" . $showID;
	$sqlstr .= "\n ORDER BY `episodes`.`date` ASC;";
	//$sqlstr .= "\n LIMIT " . $a . "," . $b;
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			array_push($retval, $row["epTitle"]);
		}
		return $retval;
	} else {
		trigger_error("No episodes for given showID");
	}
}

function getEpsListByDate($con, $showID) {
	$retval = array();
	$sqlstr = "SELECT epTitle FROM `episodes`";
	$sqlstr .= "\n WHERE showID=" . $showID;
	$sqlstr .= "\n ORDER BY `episodes`.`date` ASC;";
	//$sqlstr .= "\n LIMIT " . $a . "," . $b;
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			array_push($retval, $row["epTitle"]);
		}
		return $retval;
	} else {
		trigger_error("No episodes for given showID");
	}
}

function getEpInfo($con, $showID, $epTitle) {
	$retval = array();
	$defaultFields = array("epTitle", "showID", "date", "network", "description");
	$sqlstr = "select * from `episodes` WHERE showID=" . $showID . " and epTitle ='" . $epTitle . "'";
	$rows = $con->query($sqlstr);
	
	if ($rows->num_rows > 0){
		$row = $rows->fetch_assoc();
		$record = array();
		for($j = 0; $j < count($defaultFields); $j++){
			array_push($record, $row[$defaultFields[$j]]);
		}
		return $record;
	}
}

function getEpComments($con, $showID, $epTitle) {
	$retval = array();
	$defaultFields = array("cmID", "showID", "epTitle", "poster", "date", "body", "cmRef");
	$sqlstr = "SELECT * FROM (epComments LEFT JOIN allComments ON epComments.cmID = allComments.cmID)";
	$sqlstr.="WHERE allComments.type = 'ep' AND epComments.epTitle='".$epTitle."' and epComments.showID=".$showID;
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			$record = array();
			for ($i=0; $i<count($defaultFields); $i++) {
				array_push($record, $row[$defaultFields[$i]]);
			}
			array_push($retval, $record);
		}
		return $retval;
	} else {
		trigger_error("No ep comments database");
	}
}

function epHasComments($con, $showID, $epTitle) {
	$sqlstr = "SELECT * FROM `epComments` WHERE epComments.epTitle='".$epTitle."' and epComments.showID=".$showID;
	$rows = $con->query($sqlstr);
	$num = mysqli_num_rows($rows);
	if ($num>0) {
		return true;
	} else {
		return false;
	}
}

function getActorsByShow($con, $showID) {
	$retval = array();
	$defaultFields = array("acID", "showID", "fName", "lName");
	$sqlstr = "SELECT * FROM `actors`";
	$sqlstr .= "\n WHERE showID=" . $showID . ";";
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			$record = array();
			for ($i = 0; $i < count($defaultFields); $i++){
				array_push($record, $row[$defaultFields[$i]]);
			}
			array_push($retval, $record);
		}
		return $retval;
	} else {
		trigger_error("No actors in database for given showID");
	}
}

//	books
function getBooksList($con, $a, $b) {
	$retval = array();
	$sqlstr = "SELECT isbn FROM `books` LIMIT " . $a . "," . $b;
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			array_push($retval, $row["isbn"]);
		}
		return $retval;
	} else {
		trigger_error("No books in database");
	}
}


function getBookInfo($con, $isbn) {
	$retval = array();
	$defaultFields = array("isbn", "title", "year", "author", "publisher", "description", "imgURL");
	$sqlstr = "select * from books WHERE isbn=" . $isbn . ";";
	$rows = $con->query($sqlstr);
	
	if ($rows->num_rows > 0){
		$row = $rows->fetch_assoc();
		$record = array();
		for($j = 0; $j < count($defaultFields); $j++){
			array_push($record, $row[$defaultFields[$j]]);
		}
		return $record;
	}
}

function getChsList($con, $isbn) {
	$retval = array();
	$sqlstr = "SELECT chTitle FROM `chapters`";
	$sqlstr .= "\n WHERE isbn=" . $isbn;
	$sqlstr .= "\n ORDER BY `chapters`.`chTitle` ASC;";
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			array_push($retval, $row["chTitle"]);
		}
		return $retval;
	} else {
		trigger_error("No chapters in database for given isbn");
	}
}

function bookHasChs($con, $isbn) {
	$sqlstr = "SELECT * FROM `chapters` WHERE `chapters`.`isbn`=".$isbn.";";
	$rows = $con->query($sqlstr);
	$num = mysqli_num_rows($rows);
	if ($num>0) {
		return true;
	} else {
		return false;
	}
}

function getChComments($con, $isbn, $chTitle) {
	$retval = array();
	$defaultFields = array("cmID", "isbn", "chTitle", "poster", "date", "body", "cmRef");
	$sqlstr = "SELECT * FROM (chComments LEFT JOIN allComments ON chComments.cmID = allComments.cmID)";
	$sqlstr.="WHERE allComments.type = 'ch' AND chComments.chTitle=".$chTitle." and chComments.isbn=".$isbn;
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			$record = array();
			for ($i=0; $i<count($defaultFields); $i++) {
				array_push($record, $row[$defaultFields[$i]]);
			}
			array_push($retval, $record);
		}
		return $retval;
	} else {
		trigger_error("No ch comments database");
	}
}

function chHasComments($con, $isbn, $chTitle) {
	$sqlstr = "SELECT * FROM `chComments` WHERE chComments.chTitle=".$chTitle." and chComments.isbn=".$isbn;
	$rows = $con->query($sqlstr);
	$num = mysqli_num_rows($rows);
	if ($num>0) {
		return true;
	} else {
		return false;
	}
}

function getAllComments($con, $a, $b) {
	$retval = array();
	$defaultFields = array("cmRef", "type", "cmID");
	$sqlstr = "SELECT * FROM `allComments` LIMIT " . $a . "," . $b;
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			$record = array();
			for ($i=0; $i<count($defaultFields); $i++) {
				array_push($record, $row[$defaultFields[$i]]);
			}
			array_push($retval, $record);
		}
		return $retval;
	} else {
		trigger_error("No comments in database");
	}
}

function getCommentInfo($con, $cmRef) {
	$retval = array();
	$sqlstr = "SELECT type, cmID FROM `allComments`";
	$sqlstr .= "\n WHERE cmRef=" . $cmRef . ";";
	$rows = $con->query($sqlstr);
	$type = "";
	$cmID = "";
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			$type = $row["type"];
			$cmID = $row["cmID"];
			array_push($retval, $type);
			array_push($retval, $cmID);
		}
		if ($type == "show") {
			$sqlStr = "SELECT * FROM `showComments`";
			$sqlStr .= "\nWHERE cmID=" . $cmID . ";";
			$qrows = $con->query($sqlStr);
			while ($qrow = $qrows->fetch_assoc()) {
				array_push($retval, $qrow["showID"]);
				array_push($retval, NULL);
				array_push($retval, $qrow["poster"]);
				array_push($retval, $qrow["date"]);
				array_push($retval, $qrow["body"]);
			}
		} else if ($type == "ep") {
			$sqlStr = "SELECT showID, epTitle, poster, date, body FROM `epComments`";
			$sqlStr .= "\nWHERE cmID=" . $cmID . ";";
			$rows = $con->query($sqlStr);
			while ($row = $rows->fetch_assoc()) {
				array_push($retval, $row["showID"]);
				array_push($retval, $row["epTitle"]);
				array_push($retval, $row["poster"]);
				array_push($retval, $row["date"]);
				array_push($retval, $row["body"]);
			}
		} else if ($type == "book") {
			$sqlStr = "SELECT isbn, poster, date, body FROM `bookComments`";
			$sqlStr .= "\nWHERE cmID=" . $cmID . ";";
			$rows = $con->query($sqlStr);
			while ($row = $rows->fetch_assoc()) {
				array_push($retval, $row["isbn"]);
				array_push($retval, NULL);
				array_push($retval, $row["poster"]);
				array_push($retval, $row["date"]);
				array_push($retval, $row["body"]);
			}
		} else if ($type == "ch") {
			$sqlStr = "SELECT isbn, chTitle, poster, date, body FROM `chComments`";
			$sqlStr .= "\nWHERE cmID=" . $cmID . ";";
			$rows = $con->query($sqlStr);
			while ($row = $rows->fetch_assoc()) {
				array_push($retval, $row["isbn"]);
				array_push($retval, $row["chTitle"]);
				array_push($retval, $row["poster"]);
				array_push($retval, $row["date"]);
				array_push($retval, $row["body"]);
			}
		}
		return $retval;
	} else {
		trigger_error("Nothing in database for given cmRef");
	}
}

function getCommentsByUser($con, $username) {
	$retval = array();
	$defaultFields = array("cmRef", "type", "cmID");
	
	$sqlstr = "SELECT U.cmRef, U.type, U.cmID, U.poster FROM(";
	$sqlstr.= "SELECT allComments.cmRef, allComments.type, allComments.cmID, chComments.poster FROM `chComments` LEFT JOIN `allComments` ";
	$sqlstr.= "ON allComments.cmID = chComments.cmID ";
	$sqlstr.= "WHERE allComments.type = 'ch' ";
	$sqlstr.= "UNION SELECT allComments.cmRef, allComments.type, allComments.cmID, epComments.poster FROM `epComments` LEFT JOIN `allComments` ";
	$sqlstr.= "ON allComments.cmID = epComments.cmID ";
	$sqlstr.= "WHERE allComments.type = 'ep') AS U ";
	$sqlstr.= "WHERE U.poster = '" . $username ."';";
	//echo "\n" . $sqlstr . "\n";	//debug
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			$record = array();
			for ($i=0; $i<count($defaultFields); $i++) {
				array_push($record, $row[$defaultFields[$i]]);
			}
			array_push($retval, $record);
		}
		return $retval;
	} else {
		$retval = array(array("no", "comments"), array("for", "user"));
		return $retval;
		trigger_error("No comments by user in database");
	}
}

function getWatchedByUser($con, $username) { //by Brianna, can be removed if needed
	$retval = array();//'watchedList' WHERE watchedList.username = username
	$sqlstr = "SELECT * FROM watchedList WHERE watchedList.username = '" . $username ."';";
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			$record = array();
			array_push($retval, $row["showID"]);
		}
		return $retval;
	} else {
		trigger_error("Nothing watched by user in database");
	}
}

function getWatchingByUser($con, $username) {
	$retval = array();
	$sqlstr = "SELECT * FROM `watchingList` WHERE watchingList.username = '" . $username ."';";
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			$record = array();
			array_push($retval, $row["showID"]);
		}
		return $retval;
	} else {
		trigger_error("Nothing being watched by user in database");
	}
}

function getFavoriteShowsByUser($con, $username) {
	$retval = array();
	$sqlstr = "SELECT * FROM `favoriteShowsList` WHERE favoriteShowsList.username = '" . $username ."';";
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			$record = array();
			array_push($retval, $row["showID"]);
		}
		return $retval;
	} else {
		trigger_error("No favorite shows for user in database");
	}
}

function getReadByUser($con, $username) {
	$retval = array();
	$sqlstr = "SELECT * FROM `readList` WHERE readList.username = '" . $username ."';";
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			$record = array();
			array_push($retval, $row["isbn"]);
		}
		return $retval;
	} else {
		trigger_error("Nothing read by user in database");
	}
}

function getReadingByUser($con, $username) {
	$retval = array();
	$sqlstr = "SELECT * FROM `readingList` WHERE readingList.username = '" . $username ."';";
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			$record = array();
			array_push($retval, $row["isbn"]);
		}
		return $retval;
	} else {
		trigger_error("Nothing being read by user in database");
	}
}

function getFavoriteBooksByUser($con, $username) {
	$retval = array();
	$sqlstr = "SELECT * FROM `favoriteBooksList` WHERE favoriteBooksList.username = '" . $username ."';";
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			$record = array();
			array_push($retval, $row["isbn"]);
		}
		return $retval;
	} else {
		trigger_error("No favorite books for user in database");
	}
}

function getLikesByUser($con, $username) {
	$retval = array();
	$sqlstr = "SELECT * FROM `likes` WHERE likes.username = '" . $username ."'";
	$sqlstr .= "\n ORDER BY `likes`.`date` ASC;";
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			$record = getCommentInfo($con, $row["cmRef"]);
			array_push($record, $row["date"]);
			array_push($retval, $record);
		}
		return $retval;
	} else {
		trigger_error("Nothing liked by user in database");
	}
}

function userHasLikes($con, $username) {
	$retval = array();
	$sqlstr = "SELECT * FROM `likes` WHERE likes.username = '" . $username ."';";
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		return $true;
	} else {
		return false;
	}
}

function getLikesByComment($con, $cmRef) {
	$retval = array();
	$sqlstr = "SELECT * FROM `likes` WHERE likes.cmRef = '" . $cmRef ."'";
	$sqlstr .= "\n ORDER BY `likes`.`date` ASC;";
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			$record = array();
			array_push($record, $row["username"]);
			array_push($record, $row["date"]);
			array_push($retval, $record);
		}
		return $retval;
	} else {
		trigger_error("Nothing liked by user in database");
	}
}

function cmHasLikes($con, $cmRef) {
	$retval = array();
	$sqlstr = "SELECT * FROM `likes` WHERE likes.cmRef = '" . $cmRef ."';";
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		return true;
	} else {
		return false;
	}
}

function getRepliesByComment($con, $cmRef) {
	$retval = array();
	$defaultFields = array("replyID", "cmRef", "poster", "date", "body");
	$sqlstr = "SELECT * FROM `replies` WHERE replies.cmRef=" . $cmRef;
	$sqlstr .= "\n ORDER BY `replies`.`date` ASC;";
	$rows = $con->query($sqlstr);
	if ($rows->num_rows > 0){
		while ($row = $rows->fetch_assoc()) {
			$record = array();
			for ($i=0; $i<count($defaultFields); $i++) {
				array_push($record, $row[$defaultFields[$i]]);
			}
			array_push($retval, $record);
		}
		return $retval;
	} else {
		trigger_error("No replies for comment");
	}
}

function cmHasReplies($con, $cmRef) {
	$sqlstr = "SELECT * FROM `replies` WHERE replies.cmRef=" . $cmRef .";";
	$rows = $con->query($sqlstr);
	$num = mysqli_num_rows($rows);
	if ($num>0) {
		return true;
	} else {
		return false;
	}
}

function addRead($con, $username, $isbn){
	$username = mysqli_real_escape_string($con, $username);
	$isbn = mysqli_real_escape_string($con, $isbn);
    $sqlstr = "INSERT INTO `readList` (`username`, `isbn`) VALUES ('$username', '$isbn')";
    echo $sqlstr; //debug
    //reference: $sqlstr = "INSERT INTO epComments(cmID, epTitle, showID, poster, date, body) VALUES(NULL, '" . $epTitle . "'," . $showID . ", '".$username."','2020-04-07', '".$body."')";
     $con->query($sqlstr);
}

function addReading($con, $username, $isbn){
	$username = mysqli_real_escape_string($con, $username);
	$isbn = mysqli_real_escape_string($con, $isbn);
    $sqlstr = "INSERT INTO `readingList` (`username`, `isbn`) VALUES ('$username', '$isbn')";
    echo $sqlstr; //debug
    //reference: $sqlstr = "INSERT INTO epComments(cmID, epTitle, showID, poster, date, body) VALUES(NULL, '" . $epTitle . "'," . $showID . ", '".$username."','2020-04-07', '".$body."')";
     $con->query($sqlstr);
}

function addFavoriteBooks($con, $username, $isbn){
	$username = mysqli_real_escape_string($con, $username);
	$isbn = mysqli_real_escape_string($con, $isbn);
    $sqlstr = "INSERT INTO `favoriteBooksList` (`username`, `isbn`) VALUES ('$username', '$isbn')";
    echo $sqlstr; //debug
    //reference: $sqlstr = "INSERT INTO epComments(cmID, epTitle, showID, poster, date, body) VALUES(NULL, '" . $epTitle . "'," . $showID . ", '".$username."','2020-04-07', '".$body."')";
     $con->query($sqlstr);
}

function addWatched($con, $username, $showID){
	$username = mysqli_real_escape_string($con, $username);
	$showID = mysqli_real_escape_string($con, $showID);
    $sqlstr = "INSERT INTO `watchedList` (`username`, `showID`) VALUES ('$username', '$showID')";
    echo $sqlstr; //debug
    //reference: $sqlstr = "INSERT INTO epComments(cmID, epTitle, showID, poster, date, body) VALUES(NULL, '" . $epTitle . "'," . $showID . ", '".$username."','2020-04-07', '".$body."')";
     $con->query($sqlstr);
}

function addWatching($con, $username, $showID){
	$username = mysqli_real_escape_string($con, $username);
	$showID = mysqli_real_escape_string($con, $showID);
    $sqlstr = "INSERT INTO `watchingList` (`username`, `showID`) VALUES ('$username', '$showID')";
    echo $sqlstr; //debug
    //reference: $sqlstr = "INSERT INTO epComments(cmID, epTitle, showID, poster, date, body) VALUES(NULL, '" . $epTitle . "'," . $showID . ", '".$username."','2020-04-07', '".$body."')";
     $con->query($sqlstr);
}

function addFavorites($con, $username, $showID){
	$username = mysqli_real_escape_string($con, $username);
	$showID = mysqli_real_escape_string($con, $showID);
    $sqlstr = "INSERT INTO `favoriteShowsList` (`username`, `showID`) VALUES ('$username', '$showID')";
    echo $sqlstr; //debug
    //reference: $sqlstr = "INSERT INTO epComments(cmID, epTitle, showID, poster, date, body) VALUES(NULL, '" . $epTitle . "'," . $showID . ", '".$username."','2020-04-07', '".$body."')";
     $con->query($sqlstr);
}

function addEpComment($con, $username, $showID, $epTitle, $body){
	$sqlstr = "INSERT INTO epComments(cmID, epTitle, showID, poster, date, body) VALUES(NULL, '" . $epTitle . "'," . $showID . ", '".$username."','".date("y-m-d")."', '".$body."')";
	if ($con->query($sqlstr) === TRUE){
		$newcmID = $con->insert_id;
		echo "GOOD " . $newcmID;	//debug
		$sqlstr = "INSERT INTO allComments(cmRef, type, cmID) VALUES(NULL, 'ep', " . $newcmID . ")";
		$con->query($sqlstr);
	} else {
		$newcmID = $con->insert_id;
		echo "BAD " . $newcmID;	//debug
	}
}

function addChComment($con, $username, $isbn, $chTitle, $body){
	$sqlstr = "INSERT INTO chComments(cmID, chTitle, isbn, poster, date, body) VALUES(NULL, " . $chTitle . "," . $isbn . ", '".$username."','".date("y-m-d")."', '".$body."')";
	if ($con->query($sqlstr) === TRUE){
		$newcmID = $con->insert_id;
		//echo "GOOD " . $newcmID;	//debug
		$sqlstr = "INSERT INTO allComments(cmRef, type, cmID) VALUES(NULL, 'ep', " . $newcmID . ")";
		$con->query($sqlstr);
	} else {
		$newcmID = $con->insert_id;
		//echo "BAD " . $newcmID;	//debug
	}
}

function addReply($con, $cmRef, $poster, $body){
	$sqlstr = "INSERT INTO replies(replyID, cmRef, poster, date, body) VALUES(NULL, " . $cmRef . ",'" . $poster . "','".date("y-m-d")."', '".$body."')";
	echo $sqlstr;	//debug
	$con->query($sqlstr);
}

function makeTable($input) {
	echo "<table>";
	for ($i = 0; $i < count($input); $i++){
		echo "<tr>";
		for ($j = 0; $j < count($input[$i]); $j++){
			echo "<td style = 'border:1px solid black; margin:0px; padding:0px;'>" . $input[$i][$j] . "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}

function addLike($con, $username, $cmRef){
	$username = mysqli_real_escape_string($con, $username);
    $cmRef = mysqli_real_escape_string($con, $cmRef);
    $date = getCommentInfo($con, $cmRef)[5];
    $sqlstr = "INSERT INTO `likes` (`cmRef`, `username`, `date`) VALUES ('$cmRef', '$username', '$date')";
    echo $sqlstr; //debug
    //reference: $sqlstr = "INSERT INTO epComments(cmID, epTitle, showID, poster, date, body) VALUES(NULL, '" . $epTitle . "'," . $showID . ", '".$username."','2020-04-07', '".$body."')";
     $con->query($sqlstr);
}

function dummy() {
	echo "ur dum";
}

$username = "fanAcct";
?>