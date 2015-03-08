<?php
error_reporting(E_ALL);

$host = 'localhost';
$mysqluser = 'root';
$mysqlpassword = '';
$mysqldatabase = 'social';

$mysqli = new mysqli($host, $mysqluser, $mysqlpassword, $mysqldatabase);

if(isset($_COOKIE['USER'])) {
	$user = $_COOKIE['USER'];
	$pass = $_COOKIE['PASSWORD'];
	$query= mysqli_query($mysqli, 'SELECT * FROM users WHERE username="'.$user.'"');
	$info = mysqli_fetch_array($query);
	if ($pass != $info['password']) { 			
		header("Location: login.php"); 
 	} else { 
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
	}
	</style>
	<h1><a href="#">Social Network</a></h1>
	<ul class='list'>
		<li class='list'><a href='register.php'>Register</a></li>
		<li class='list'><a href='login.php'>Login</a></li>
	</ul>
	<hr>
	<h2>Hello there</h2>
	<p>You're a member huzzah</p>
</html>
<?php	
	}
} else {			 
	header("Location: login.php"); 
} 
 ?> 	