<?php
$host = 'localhost';
$mysqluser = 'root';
$mysqlpassword = '';
$mysqldatabase = 'social';

function createpage($name, $bio) {													//TODO, clean up this function
	$file = '../profiles/' . $name . '.php';
	$content = '
<?php
if(isset($_COOKIE["USER"])) {
	$user = $_COOKIE["USER"];
	$pass = $_COOKIE["PASSWORD"];
	if ($user == '.$name.') {     //I can figure out what I can do with these later after I clean up my code 
		$canEdit = true;
	} else {
		$canEdit = false;
	}
?>	
<!doctype html>
<html>
	<style>
	body {
		margin: auto auto;
		width: 500px;
	}
	</style>
	<body>
		<h1><a href="../main.php">Social Network</a></h1>
		<hr>
		<h2>'. htmlspecialchars($name, ENT_QUOTES, 'UTF-8') .'</h4>
		<p>'. htmlspecialchars($bio, ENT_QUOTES, 'UTF-8') . '</p>
	</body>
</html> ';							//The template

	file_put_contents($file, $content);	//Write to the file
}	 //end function createpage

$mysqli = new mysqli($host, $mysqluser, $mysqlpassword, $mysqldatabase);
if (isset($_POST['submit'])) { 
	$user = $_POST['username'];
	$password = $_POST['pass'];
	
	if (!$user | !$pass | !$_POST['pass2'] ) {    						//Check if the user filled in the required stuff
 		die('You did not complete all of the required fields');
	}
	
	if ($password != $_POST['pass2']) {									//Check if they matched
 		die('Your passwords did not match. ');
 	}
	
	$query= mysqli_query($mysqli, 'SELECT username FROM users WHERE username="'.$usercheck.'"');
	if(mysqli_num_rows($query) > 0) {
		die('The username '.$username.' already exists');
	} else {
		
		$password = md5($password);										//Hash the password in md5 for security reasons 
		$insert = "INSERT INTO users (username, password)
		VALUES ('".$username."', '".$_POST['pass']."')";

		if ($mysqli->query($insert) === TRUE) {
			createpage($_POST['username'], $_POST['bio']);				//Create the page
			
			$hour = time() + 3600; 										//Set a login cookie for an hour, obviously changing it later to where I have to depend on this but will do 
			setcookie(USER, $_POST['username'], $hour); 
			setcookie(PASSWORD, $_POST['pass'], $hour);					//The pass cookie is the password hashed with md5, not the raw password
			
			echo '<h2>You have registered, <a href="../profiles/'.$usercheck.'.php">click here to view your page</a></h2>';
		} else {
			die("there's been an error");
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
	<h2>Register</h2>
	<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		Username:
		<input type='text' name='username' maxlength='60' required><br>
		Bio:
		<input type='text' name='bio' maxlength='60' required><br>
		Password:
		<input type='password' name='pass' maxlength='60' required><br>
		Confirm password:
		<input type='password' name='pass2' maxlength='60' required><br>
		<input type="submit" name="submit" value="Register">
	</form>
</html>
<?php }
?>
	