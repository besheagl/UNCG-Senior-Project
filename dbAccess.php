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
	$defaultFields = array("showID", "title", "year", "director", "producer", "description");
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

/*
function getShowComments($con, $showID) {
	$retval = array();
	$defaultFields = array("cmID", "showID", "poster", "date", "body");
	$sqlstr = "SELECT * FROM `showComments` WHERE showID=" . $showID . ";";
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
		trigger_error("No comments found for show in database");
	}
}
*/

function getEpsList($con, $showID) {
	$retval = array();
	$sqlstr = "SELECT epTitle FROM `episodes`";
	$sqlstr .= "\n WHERE showID=" . $showID . ";";
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
	$defaultFields = array("cmID", "showID", "epTitle", "poster", "date", "body");
	$sqlstr = "SELECT * FROM `epComments` WHERE showID=" . $showID . " AND epTitle='" . $epTitle . "';";
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
	$defaultFields = array("isbn", "title", "year", "author", "publisher", "description");
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

/*
function getBookComments($con, $isbn) {
	$retval = array();
	$defaultFields = array("cmID", "isbn", "poster", "date", "body");
	$sqlstr = "SELECT * FROM `bookComments` WHERE isbn=" . $isbn . ";";
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
		trigger_error("Nothing in database");
	}
}
*/

function getChsList($con, $isbn) {
	$retval = array();
	$sqlstr = "SELECT chTitle FROM `chapters`";
	$sqlstr .= "\n WHERE isbn=" . $isbn . ";";
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

function getChComments($con, $isbn, $chTitle) {
	$retval = array();
	$defaultFields = array("cmID", "isbn", "chTitle", "poster", "date", "body");
	$sqlstr = "SELECT * FROM `chComments` WHERE isbn=" . $isbn . " AND chTitle='" . $chTitle . "';";
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
		trigger_error("No comments for chapter in database");
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
	$retval = array();
	$defaultFields = array("showID"); //'watchedList' WHERE watchedList.username = username
	$sqlstr = "SELECT * FROM 'watchedList' ON watchedList.username = " . $username .";";
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
		trigger_error("Nothing watched by user in database");
	}
}

function addComment($con, $type, $user, $show, $episode, $body){
	
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

function dummy() {
	echo "ur dum";
}
?>