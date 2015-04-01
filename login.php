<?php
session_start();
error_reporting(E_ALL);

$host = 'localhost';
$mysqluser = 'root';
$mysqlpassword = '';
$mysqldatabase = 'social';
$mysqli = new mysqli($host, $mysqluser, $mysqlpassword, $mysqldatabase);

if (isset($_POST['submit'])) {			 // if form has been submitted
 	if(!$_POST['username'] | !$_POST['pass']) {
 		die('You did not fill in a required field.');
 	}
	
	$usercheck = $_POST['username'];
	$query= mysqli_query($mysqli, 'SELECT * FROM users WHERE username="'.$usercheck.'"');
	if(mysqli_num_rows($query) == 0) {
		die('The username '.$_POST['username'].' doesn\'t exist. <a href="register.php">Click here to Register</a>');
	} else {
		$info = mysqli_fetch_array($query);
		$_POST['pass'] = md5($_POST['pass']);
		if ($_POST['pass'] != $info['password']) {
			die('Incorrect password, please try again.');
		} else {
			$hour = time() + 3600; 
			$_SESSION['USER'] = $_POST['username'];
			$_SESSION['PASS'] = $_POST['pass']; 
			header('Location: index.php');
		}
	}
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
	<h2>Login</h2>
	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
		Username:
		<input type='text' name='username' maxlength='60' required><br>
		Password:
		<input type='password' name='pass' maxlength='60' required><br>
		<input type="submit" name="submit" value="Login"> 
	</form>
	<a href='register.php'>Don't have an account?</a>
</html>
<?php } //endelse ?>