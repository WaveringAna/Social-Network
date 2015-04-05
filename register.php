<?php
ini_set('display_errors',1);
session_start();
require 'classes/Template.php';

$host = 'localhost';
$mysqluser = 'root';
$mysqlpassword = '';
$mysqldatabase = 'social';

$mysqli = new mysqli($host, $mysqluser, $mysqlpassword, $mysqldatabase);
if (isset($_POST['submit'])) { 
	echo '<pre>';
	print_r ($_POST);
	echo '</pre>';
	$user = $_POST['username'];
	$password = md5($_POST['pass']);		//Hash the password in md5 for security reasons
	$pass2 = md5($_POST['pass2']);	
	if (!$user | !$password| !$pass2 ) {    				//Check if the user filled in the required stuff
 		die('You did not complete all of the required fields');
	}
	
	if ($password != $pass2) {					//Check if they matched
 		die('Your passwords did not match. ');
 	}
	
	$query= mysqli_query($mysqli, 'SELECT username FROM users WHERE username="'.$user.'"');
	if(mysqli_num_rows($query) > 0) {
		die('The username '.$user.' already exists');
	} else {
		$insert = "INSERT INTO users (username, password)
		VALUES ('".$user."', '".$password."')";

		if ($mysqli->query($insert) === TRUE) {
			createpage($user, $_POST['bio']);		//Create the page, the function is from classes/Main.php
			if (isset($_POST['email'])) {
				sendMail($user, $_POST['email']);    //Send a welcome email, the function is from classes/Main.php
			}
			
			if (isset($_POST['remember'])) {
				$hour = time() + 7 * 24 * 60 * 60;      //Sets a remember me cookie for a week
				setcookie('USER', $user, $hour, '/');
				setcookie('PASS', $password, $hour, '/');
			} else {
				$_SESSION['USER'] = $user; 
				$_SESSION['PASS'] = $password;	//The pass session is the password hashed with md5, not the raw password
			}
			
			echo '<h2>You have registered, <a href="profiles/'.$user.'.php">click here to view your page</a></h2>';
		} else {
			die("there's been an error processing your request");
		}
	}			//endif
} else {		//If the form has not been submitted
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
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<h1><a href="../index.php">Social Network</a></h1>
	<ul class='list'>
		<li class='list'><a href='register.php'>Register</a></li>
		<li class='list'><a href='login.php'>Login</a></li>
	</ul>
	<hr>
	<h2>Register</h2>
	<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		Username:
		<input type='text' name='username' maxlength='60' required><br>
		Bio:<br>
		<textarea name='bio' required></textarea><br>
		Password:
		<input type='password' name='pass' maxlength='60' required><br>
		Confirm password:
		<input type='password' name='pass2' maxlength='60' required><br>
		Email: (not required)
		<input type='email' name='email' maxlength='60'><br>
		<input type='checkbox' name='remember'> Remember Me <br>
		<div class="g-recaptcha" data-sitekey="6Le4sQQTAAAAAIs8MbyLQAenfXSpdbAaiPvzc21V"></div>
		<input type="submit" name="submit" value="Register">
	</form>
</html>
<?php }
?>
	
