<!doctype html>
<html>
	<style>
	body {
		margin: auto auto;
		width: 750px;
	}
	.list {
		display: inline;
	}
	</style>
	<h1><a href="#">Social Network</a></h1>
	<ul class='list'>
		<li class='list'><a href='login_system/login.php'>Register</a></li>
		<li class='list'><a href='login_system/login.php'>Login</a></li>
	</ul>
	<hr>
	<div> 
		<h2>Browse other's pages</h2>
		<?php
		$dir = './profiles';
		$files = array_slice(scandir('profiles'), 2);  							//The array_slice removes . and ..
		foreach($files as $file) {
			print("<a href='profiles/" . $file . "'>" . $file . "</a><br>");	//Creates links to all the html files in profiles, might create a problem because of XSS flaws
		}
		?>
	</div>
</html>
