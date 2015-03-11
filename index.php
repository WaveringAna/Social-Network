<?php
error_reporting(E_ALL);

$host = 'localhost';
$mysqluser = 'root';
$mysqlpassword = '';
$mysqldatabase = 'social';
$mysqli = new mysqli($host, $mysqluser, $mysqlpassword, $mysqldatabase);
$isLoggedin = false;
if(isset($_COOKIE['USER'])) {
	$user = $_COOKIE['USER'];
	$pass = $_COOKIE['PASSWORD'];
	$query= mysqli_query($mysqli, 'SELECT * FROM users WHERE username="'.$user.'"');
	$info = mysqli_fetch_array($query);
	if ($pass != $info['password']) { 
		$past = time() - 100; 
		//this makes the time in the past to destroy the cookie 
		setcookie(USER, 'gone', $past); 
		setcookie(PASSWORD, 'gone', $past); 
	} else {
		$isLoggedin = true;
	}
}
?>
<!doctype html>
<html>
	<style>
	body {
		margin: auto auto;
		width: 750px;
	}
	.list {
		display: inline;
		list-style: none; 
		margin:0;
		padding:0;
	}
	</style>
	<h1><a href="#">Social Network</a></h1>
	<ul class='list'>
		<li class='list'><a href='code/register.php'>Register</a></li>
		<li class='list'><a href='code/login.php'>Login</a></li>
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
		
		if ($isLoggedin == true) {
			echo '<br>You\'re a member, hooray';
		} else {
			echo '<br>Looks like you\'re not a member or not logged in, <a href="code/register.php">sign up today</a>';
		}
		?>
	</div>
</html>
