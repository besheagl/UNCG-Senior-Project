<!DOCTYPE html>

<html lang="en">
<head>
<meta charset ="utf-8"/>
<meta http-equiv="x-ua-compatible" content="ie=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>dbAccess.php Documentation</title>
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
ul.soon{
	color: gray;
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
				<li>returns data for the show of given id</li>
			</ul>
		</ul>
		
		
		
		example:
		<pre><code>$info = getShowInfo($con, 1);
echo "&ltp&gt";
echo "" . $info[0] . "&ltbr&gt";
echo "by " . $info[1] . "&lt/p&gt";
</code></pre>

		<!--ul>
			<li><strong>getShowComments</strong>(connection, int showID) returns 2d string array</li>
			<ul>
				<li>returns comments data for the show of given id</li>
				<li>extra column is at the end for cmRef</li>
			</ul>
		</ul-->

		<ul>
			<li><strong>getEpsList</strong>(connection, int showID) returns string array</li>
				<ul>
					<li>returns an array of episode titles for a given showID</li>
				</ul>
		</ul>
		
		<ul>
			<li><strong>getEpsListByDate</strong>(connection, int showID) returns string array</li>
				<ul>
					<li>returns an array of episode titles for a given showID ordered by date</li>
				</ul>
		</ul>
		
		<ul class = 'soon'>
			<li><strong>isWatched</strong>(connection, int showID, string username) returns boolean</li>
				<ul>
					<li>returns true if a show with showID has been watched by user. Else, false</li>
				</ul>
		</ul>

		<ul>
			<li><strong>getEpInfo</strong>(connection, int showID, string epTitle) returns string array</li>
				<ul>
					<li>returns an array of episode data</li>
				</ul>
		</ul>
		
		<ul>
			<li><strong>addEpComment</strong>(connection, string username, string showID, string epTitle, string body)</li>
			<ul>
				<li>adds a comment for an episode</li>
				<li>server does little validation, so validate input before calling this function</li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>epHasComments</strong>(connection, int showID, string epTitle) returns boolean</li>
				<ul>
					<li>returns true if a show has comments. Else, false</li>
				</ul>
		</ul>
		
		<ul>
			<li><strong>getEpComments</strong>(connection, int showID, string epTitle) returns 2d string array</li>
			<ul>
				<li>returns comments data for the episode of given showID and epTitle</li>
				<li>extra column is at the end for cmRef</li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>getActorsByShow</strong>(connection, int showID) returns 2d string array</li>
				<ul>
					<li>returns 2d array of actor data for a given showID</li>
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
				<li>returns data for the book of given isbn</li>
			</ul>
		</ul>
		
		<!--ul>
			<li><strong>getBookComments</strong>(connection, int isbn) returns 2d string array</li>
			<ul>
				<li>returns comments data for the book of given isbn</li>
			</ul>
		</ul-->
		
		<ul>
			<li><strong>getChsList</strong>(connection, int isbn) returns string array</li>
				<ul>
					<li>returns an array of chapter titles for given isbn</li>
				</ul>
		</ul>
		
		<ul class = 'soon'>
			<li><strong>isRead</strong>(connection, int isbn, string username) returns boolean</li>
				<ul>
					<li>returns true if a book with isbn has been read by user. Else, false</li>
				</ul>
		</ul>
		
		<ul>
			<li><strong>addChComment</strong>(connection, string username, string isbn, string chTitle, string body)</li>
			<ul>
				<li>adds a comment for a chapter</li>
				<li>server does little validation, so validate input before calling this function</li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>chHasComments</strong>(connection, int isbn, string chTitle) returns boolean</li>
				<ul>
					<li>returns true if a chapter has comments. Else, false</li>
				</ul>
		</ul>
		
		<ul>
			<li><strong>getChComments</strong>(connection, int isbn, string chTitle) returns 2d string array</li>
			<ul>
				<li>returns comments data for the chapter of given isbn and chTitle</li>
				<li>extra column is at the end for cmRef</li>
			</ul>
		</ul>
		
		
		<h3>Comments</h3>
		
		<ul>
			<li><strong>getAllComments</strong>(connection, int a, int b) returns 2d string array</li>
			<ul>
				<li>returns array of references for all comments from range a to b</li>
				<li>each entry has unique cmRef, type (show, ep, book, ch), and cmID which is unique only for its type</li>
				<li><strong>Use cmRef with getCommentInfo</strong></li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>getCommentsByUser</strong>(connection, string username) returns 2d string array</li>
			<ul>
				<li>returns array of references for all comments from given user</li>
				<li>each entry has unique cmRef, type (show, ep, book, ch), and cmID which is unique only for its type</li>
				<li><strong>Use cmRef with getCommentInfo</strong></li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>getCommentInfo</strong>(connection, int cmRef) returns string array</li>
			<ul>
				<li>returns comment data for given cmRef in this structure:</li>
				<ul>
					<li>[0] type</li>
					<li>[1] cmID</li>
					<li>[2] isbn or showID</li>
					<li>[3] chID or epID</li>
					<li>[4] poster's username</li>
					<li>[5] date</li>
					<li>[6] body</li>
				</ul>
			</ul>
		</ul>
		
		<ul>
			<li><strong>getLikesByUser</strong>(connection, string username) returns 2d string array</li>
			<ul>
				<li>Sorted by date of like</li>
				<li>returns like date comment data for given user</li>
				<ul>
					<li>[0...6] structure of data is that of getCommentInfo...</li>
					<li>[7] plus date of like</li>
				</ul>
			</ul>
		</ul>
		
		<ul>
			<li><strong>getLikesByComment</strong>(connection, int cmRef) returns 2d string array</li>
			<ul>
				<li>Sorted by date of like</li>
				<li>returns like data for given cmRef in this structure:</li>
				<ul>
					<li>[0] username</li>
					<li>[1] date of like</li>
				</ul>
			</ul>
		</ul>
		
		<ul>
			<li><strong>cmHasReplies</strong>(connection, int cmRef) returns boolean</li>
				<ul>
					<li>returns true if a comment has replies. Else, false</li>
				</ul>
		</ul>
		
		<ul>
			<li><strong>cmHasLikes</strong>(connection, int cmRef) returns boolean</li>
				<ul>
					<li>returns true if a comment has likes. Else, false</li>
				</ul>
		</ul>
		
		<ul>
			<li><strong>getRepliesByComment</strong>(connection, int cmRef) returns 2d string array</li>
			<ul>
				<li>returns replies data for a comment of given cmRef</li>
			</ul>
		</ul>

		
		<h3>Accounts</h3>
		
		<ul class="soon">
			<li><strong>getAllWatched</strong>(connection, int a, int b) returns 2d string array<strong> COMING SOON</strong></li>
			<ul>
				<li>returns showID and epTitle for <strong>all</strong> watched episodes for all users in the range of a to b</li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>getReadByUser</strong>(connection, string username) returns string array</li>
			<ul>
				<li>returns isbn for books read by the given user</li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>getReadingByUser</strong>(connection, string username) returns string array</li>
			<ul>
				<li>returns isbn for books being currently read by the given user</li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>getFavoriteBooksByUser</strong>(connection, string username) returns string array</li>
			<ul>
				<li>returns isbn for books favorited by the given user</li>
			</ul>
		</ul>
		
			<ul>
			    <li><strong>addRead</strong>(connection, string username, int isbn)</li>
			<ul>
				<li>inserts book into user's readList table</li>
			</ul>
		</ul>

		<ul>
			<li><strong>addReading</strong>(connection, string username, int isbn)</li>
			<ul>
				<li>inserts book into user's readingList table</li>
			</ul>
		</ul>

		<ul>
			<li><strong>addFavoriteBooks</strong>(connection, string username, int isbn)</li>
			<ul>
				<li>inserts book into user's favoriteBooksList table</li>
			</ul>
		</ul>
		
		<ul class="soon">
			<li><strong>getAllRead</strong>(connection, int a, int b) returns 2d string array<strong> COMING SOON</strong></li>
			<ul>
				<li>returns isbn and chTitle for <strong>all</strong> read chapters for all users in the range of a to b</li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>getWatchedByUser</strong>(connection, string username) returns string array</li>
			<ul>
				<li>returns showID for shows watched by the given user</li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>getWatchingByUser</strong>(connection, string username) returns string array</li>
			<ul>
				<li>returns showID for shows being currently watched by the given user</li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>getFavoriteShowsByUser</strong>(connection, string username) returns string array</li>
			<ul>
				<li>returns showID for shows that are favorites of the given user</li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>addWatched</strong>(connection, string username, int showID)</li>
			<ul>
				<li>inserts show into user's watchedList table</li>
			</ul>
		</ul>

		<ul>
			<li><strong>addWatching</strong>(connection, string username, int showID)</li>
			<ul>
				<li>inserts show into user's watchingList table</li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>addFavorites</strong>(connection, string username, int showID)</li>
			<ul>
				<li>inserts show into user's favoriteShowsList table</li>
			</ul>
		</ul>
		
		<ul>
			<li><strong>userHasLikes</strong>(connection, int cmRef) returns boolean</li>
				<ul>
					<li>returns true if a user has liked any comments. Else, false</li>
				</ul>
		</ul>
		
		<ul class="soon">
			<li><strong>getAllLikes</strong>(connection, int a, int b) returns 2d string array<strong> COMING SOON</strong></li>
			<ul>
				<li>returns info for likes by all users in the range of a to b</li>
			</ul>
		</ul>
		
	</div>
</body>
</html>