<!DOCTYPE html>

<html lang="en">
<head>
<meta charset ="utf-8"/>
<meta http-equiv="x-ua-compatible" content="ie=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<style>
*{
	box-sizing: border-box;
}
body {
	max-width: 
	padding: 25px;
	margin: 25px;
}
.group {
	display:float;
	float:left;
	margin: 0px 25px 50px 0px;
}
td.pkey {
	text-decoration: underline;
}
tr.fkey {
	background-color: lightgray;
}
div.entry {
	margin: 10px;
}
.entry tr{
}
.entry td {
	border:1px solid black;
	border-style:none none solid none;
	padding:0px 0px 0px 5px;
}
.entry table{
	font-family: "Lucida Console", Monaco, monospace;
	width: 350px;
}
.entry table, td {
	border-collapse: collapse;
}
.entry caption {
	text-align: left;
}
code {
	display: block;
	font-family: "Lucida Console", Monaco, monospace;
	background-color: lightgray;
	box-sizing: border-box;
	padding: 10px;
}
</style>
<body>
	<h1>dbAccess.php</h1>
	<div class = "group">
		<h3>Shows</h3>
		<ul>
		<li><strong>getShowsList</strong>(connection, int low, int high) returns int array</li>
			<ul>
				<li>returns an array of show id's from the range of low to high</li>
			</ul>
		</ul>
		
		<ul>
		<li><strong>getShows</strong>(connection, string[] fields) returns 2d string array</li>
			<ul>
				<li>returns an array of data for <strong>all</strong> shows</li>
				<li><strong>Mostly for debugging you probably dont wanna use me</strong></li>
				<li>"fields" paramater allows choice of fields returned, from 0 to the (number of fields -1) for a given record</li>
				<li>Refer to <a href = "dataDefs.html">MySQL DB/dbAccess library Data Dictionary</a></li>
			</ul>
		</ul>
		
		<ul>
		<li><strong>getShowInfo</strong>(connection, int showID) returns string array</li>
			<ul>
				<li>returns information for the show of given id</li>
			</ul>
		</ul>
		
		
		
		example:
		<pre><code>$info = getShowInfo($con, 1);
echo "&ltp&gt";
echo "" . $info[0] . "&ltbr&gt";
echo "by " . $info[1] . "&lt/p&gt";
</code></pre>

		<ul>
			<li><strong>getShowComments</strong>(connection, int showID) returns 2d string array</li>
			<ul>
				<li>returns comments for the show of given id</li>
			</ul>
		</ul>

		<ul>
			<li><strong>getEpsList</strong>(connection, int showID) returns string array</li>
				<ul>
					<li>returns an array of show episode titles for a given showID</li>
				</ul>
		</ul>

		<ul>
			<li><strong>getEpInfo</strong>(connection, int showID, string epTitle) returns string array</li>
				<ul>
					<li>returns an array of show episode info</li>
				</ul>
		</ul>
		
		<ul>
			<li><strong>getEpComments</strong>(connection, int showID, string epTitle) returns 2d string array</li>
			<ul>
				<li>returns comments for the episode of given showID and epTitle</li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>getActorsByShow</strong>(connection, int showID) returns 2d string array</li>
				<ul>
					<li>returns 2d array of actor infor for a given showID</li>
				</ul>
		</ul>
		
		
		<h3>Books</h3>
		<ul>
			<li><strong>getBooksList</strong>(connection, int low, int high) returns int array</li>
			<ul>
				<li>returns an array of isbn's from the range of low to high</li>
			</ul>
		</ul>
		<ul>
		<li><strong>getBookInfo</strong>(connection, int isbn) returns string array</li>
			<ul>
				<li>returns information for the book of given isbn</li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>getBookComments</strong>(connection, int isbn) returns 2d string array</li>
			<ul>
				<li>returns comments for the book of given isbn</li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>getChsList</strong>(connection, int isbn) returns string array</li>
				<ul>
					<li>returns an array of chapter titles for given isbn</li>
				</ul>
		</ul>
		<ul>
			<li><strong>getChComments</strong>(connection, int isbn, string chTitle) returns 2d string array</li>
			<ul>
				<li>returns comments for the chapter of given isbn and chTitle</li>
			</ul>
		</ul>
		
		<h3>Comments</h3>
		<ul>
			<li><strong>getAllComments</strong>(connection, int a, int b) returns 2d string array</li>
			<ul>
				<li>returns array of all comments from range a to b</li>
				<li>each entry has unique cmRef, type (show, ep, book, ch), and cmID which is unique only for its type</li>
			</ul>
		</ul>
		
	</div>
</body>
</html>