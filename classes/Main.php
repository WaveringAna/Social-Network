<?php
function createpage($name, $bio) {													
	$file = './profiles/' . $name . '.php';	//assuming the file calling this is in the root directory
	$content = '

<!doctype html>
<html>
	<style>
	body {
		margin: auto auto;
		width: 500px;
	}
	</style>
	<body>
		<h1><a href="../index.php">Social Network</a></h1>
		<hr>
		<h2>'. htmlspecialchars($name, ENT_QUOTES, 'UTF-8') .'</h4>
		<p>'. htmlspecialchars($bio, ENT_QUOTES, 'UTF-8') . '</p>
	</body>
</html> ';							    //The template
	file_put_contents($file, $content);	//Write to the file
}

function sendMail($name, $email) {
	$subject = "Hello there!";
	$mailcontent = "
<html>
	<body>
		<table style='width=100% height=50% background-color:black; color:#DC143C'>
			<tr>
				<td>Welcome $name!</td>
			</tr>
			<tr>
				<td>We are really happy you decided to join us in this new website!</td>
			</tr>
		</table>
	</body>
</html> ";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <Social-Network>' . "\r\n";
	
	mail($email,$subject,$mailcontent,$headers);
}	
?>
