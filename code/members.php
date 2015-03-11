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
		header("Location: login.php"); 			//Send them to the login page if the cookie password is wrong or they don't have one.
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
		list-style: none; 
		margin:0;
		padding:0;
	}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	
	<h1><a href="#">Social Network</a></h1>
	<ul class='list'>
		<li class='list'><a href='register.php'>Register</a></li>
		<li class='list'><a href='login.php'>Login</a></li>
	</ul>
	<hr>
	<h2>Hello there</h2>
	<p>You're now a member, huzzah.  This is the member's zone.  Here you can hang out with other members</p>
	<hr>
	<h2>Chat</h2>
	<iframe src="https://kiwiirc.com/client?settings=d4f8bbdc038d74c9ff726025b47826b8" style="border:0; width:100%; height:450px;"></iframe>
</html>
<?php	
	}
} else {			 
	header("Location: login.php"); 
} 
 ?> 	