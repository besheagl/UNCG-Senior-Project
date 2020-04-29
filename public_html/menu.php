<style>
.sidenav span {
	padding: 8px 8px 8px 32px;
	text-decoration: none;
	font-size: 4vw;
	font-family: 'Goudy Bookletter 1911', serif;
	color: white;
	display: block;
	transition: 0.3s;
}
</style>
<div class="dropdown">
	<div id="mySidenav" class="sidenav">
		<span><?php
		if ($username) {
			echo $username;
		} else {
			echo "No User";
		}
		?></span>
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="https://armchair.000webhostapp.com/shows.php">Shows</a>
		<a href="https://armchair.000webhostapp.com/books.php">Books</a>
		<?php if ($username) { ?>
		<a href="https://armchair.000webhostapp.com/profileshows.php/?dispusername=<?php echo $username ?>">Profile</a>
		<a href="https://armchair.000webhostapp.com/Settings.php">Settings</a>
		<?php } ?>
		<a href="https://armchair.000webhostapp.com/">
		<?php if ($username) { ?> Log out
		<?php } else { ?> Log In <?php } ?>
		</a>
		
	</div>
	<button class="dropbtn" onclick="openNav()"><div></div><div></div><div></div>
		<i class="fa fa-caret-down"></i>
	</button>
</div>