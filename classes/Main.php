<?php
function createpage($name, $bio) {													
	$file = './profiles/' . $name . '.php';	//assuming the file calling this is in the root directory
	$content = "
<?php
\$belongsto = ".htmlspecialchars($name, ENT_QUOTES, 'UTF-8').";  //To prevent XSS.

\$host = 'localhost';
\$mysqluser = 'root';
\$mysqlpassword = '';
\$mysqldatabase = 'social';
\$mysqli = new mysqli(\$host, \$mysqluser, \$mysqlpassword, \$mysqldatabase);

\$canEdit = false;

if (isset(\$_COOKIE['USER'])) {
	\$user = \$_COOKIE['USER'];
	\$pass= \$_COOKIE['PASS'];
	\$query= mysqli_query(\$mysqli, 'SELECT * FROM users WHERE username=\"'.\$user.'\"');
	\$info = mysqli_fetch_array(\$query);
	if (\$pass != \$info['password']) {
		setcookie('USER', 'deleted', time()-10, '/');
		setcookie('PASS', 'deleted', time()-10, '/');
	} else {
		if (\$belongsto == \$user) {
			\$canEdit = true;
		}
	}
} elseif (isset(\$_SESSION['USER'])) {
	\$user = \$_SESSION['USER'];
	\$pass = \$_SESSION['PASS'];
	\$query= mysqli_query(\$mysqli, 'SELECT * FROM users WHERE username=\"'.\$user.'\"');
	\$info = mysqli_fetch_array(\$query);
	if (\$pass != \$info['password']) { 
		unset(\$_SESSION['USER']); 
		unset(\$_SESSION['PASS']);
	} else {
		if (\$belongsto == \$user) {
			\$canEdit = true;
		}
	}
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
		<h1><a href='../index.php'>Social Network</a></h1>
		<hr>
		<h2>". htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ."</h4>
		<p>". htmlspecialchars($bio, ENT_QUOTES, 'UTF-8') . "</p>
	</body>
</html> ";							    //The template
	file_put_contents($file, $content);	//Write to the file
}

function sendMail($name, $email) {
	$subject = "Hello there!";
	$mailcontent = "
<html>
	<body style='margin: 0; padding: 0;'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
		<meta charset=UTF-8 />
		<table border='1' cellpadding='0' cellspacing='0' width='100%'>
			<tr>
				<td>
					<table align='center' border='1' cellpadding='0' cellspacing='0'  style='border-collapse: collapse;'>
						<tr>
							<td align='center' bgcolor='#70bbd9' style='padding: 40px 0;'>
								<img src='http://02df616.netsolhost.com/Welcome-transparent.gif' alt='Welcome!' style='display: block;' />
							</td>
						</tr>
						<tr bgcolor='#ffffff'>
							<td style='padding: 40px 30px;'>
								<table border='1' cellpadding='0' cellspacing='0' width='100%'>
									<tr>
										<td><h2>Welcome $name!</h2></td>
									</tr>
									<tr>
										<td>We are glad to welcome you to our community!</td>
									</tr>
									<tr>
										<td>
											<table border='1' cellpadding='0' cellspacing='0' width='100%'>
												<td width='260' valign='top'>
													<img src='http://simpleicon.com/wp-content/uploads/lock-10.png' alt='security' width='100%' height='200' style='display: block;'>
													We take customer security to heart. We never reveal passwords to anyone.
												</td>
												<td width='260' valign='top'>
													<img src='http://stockfresh.com/zooms/stockfresh_id342235_2c42d9.jpg' alt='friends' width='100%' height='200' style='display: block;'>
													Make friends. You can stay together and connected with friends far away!
												</td>
											</table>
										</td>
								</table>
							</td>
						</tr>
					</table>
				</td>
			<tr>
		</table>
	</body>
</html> ";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <Social-Network>' . "\r\n";
	
	mail($email,$subject,$mailcontent,$headers);
}	
?>
