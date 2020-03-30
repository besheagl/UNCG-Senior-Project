<?php
//	connection info
$sname = 	"localhost";
$uname = 	"id12568920_armchairadmin";
$password = 	"Csc218armchaiR";
$database = 	"id12568920_armchair";

$con = mysqli_connect($sname, $uname, $password, $database);
if (!$con) {
	die("failed to connect: " . mysqli_connect_error());
} else {
//	echo "did it";
}

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
		trigger_error("Nothing in database");
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
		trigger_error("Nothing in database");
	}
}

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
		trigger_error("Nothing in database for given showID");
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
		trigger_error("Nothing in database");
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
		trigger_error("Nothing in database for given showID");
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
		trigger_error("Nothing in database");
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
		trigger_error("Nothing in database for given isbn");
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
		trigger_error("Nothing in database");
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
		trigger_error("Nothing in database");
	}
}

function getCommentsByUser($con, $username) {
	$retval = array();
	$defaultFields = array("cmRef", "type", "cmID");
	$sqlstr = "SELECT * FROM `chComments` LEFT JOIN `allComments` ON allComments.cmID = chComments.cmID WHERE allComments.type = 'ch';";
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

// All of these should work i think

//echo getShowInfo($con, getShowsList($con, 0, 1)[0])[1];
//makeTable(getShows($con, array(2,1,2)));
//echo getEpInfo($con, 1, getEpsList($con, 1)[0])[0];
//echo getBookInfo($con, getBooksList($con, 0, 1)[0])[1];
//echo getChsList($con, getBooksList($con, 0, 100)[0])[0];
//makeTable(getBookComments($con, getBooksList($con, 0, 100)[0]));
//makeTable(getAllComments($con, 0, 100));
makeTable(getCommentsByUser($con,"armchairapp@outlook.com"));
/*
$showEx = getShowsList($con, 0, 100)[0];
makeTable(getEpComments($con, $showEx, getEpsList($con, $showEx)[0]));
*/
/*
$bookEx = getBooksList($con, 0, 100)[0];
makeTable(getChComments($con, $bookEx, getChsList($con, $bookEx)[0]));
*/
//makeTable(getActorsByShow($con, 1));
?>