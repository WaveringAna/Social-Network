<?php
session_start();
error_reporting(E_ALL);

$host = 'localhost';
$mysqluser = 'root';
$mysqlpassword = '';
$mysqldatabase = 'social';
$mysqli = new mysqli($host, $mysqluser, $mysqlpassword, $mysqldatabase);

$isLoggedin = false;

if(isset($_SESSION['USER'])) {
	$user = $_SESSION['USER'];
	$pass = $_SESSION['PASS'];
	$query= mysqli_query($mysqli, 'SELECT * FROM users WHERE username="'.$user.'"');
	$info = mysqli_fetch_array($query);
	if ($pass != $info['password']) { 
		unset($_SESSION['USER']); 
		unset($_SESSION['PASS']);
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
		<li class='list'><a href='register.php'>Register</a></li>
		<li class='list'><a href='login.php'>Login</a></li>
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
			echo '<br>You\'re a member, hooray<br>';
			?>
			<h2>Chat</h2>
			<iframe src="https://kiwiirc.com/client?settings=d4f8bbdc038d74c9ff726025b47826b8" style="border:0; width:100%; height:450px;"></iframe>
			<?php
		} else {
			echo '<br>Looks like you\'re not a member or not logged in, <a href="register.php">sign up today</a> <a href="login.php">or log in</a><br>';
		}
		?>
	</div>
</html>
