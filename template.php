<?php
$name = $_POST['name'];
$bio = $_POST['bio'];

$file = 'profiles/' . $name . '.html';
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
		<h1><a href="../main.php">Social Network</a></h1>
		<hr>
		<h2>'. htmlspecialchars($name, ENT_QUOTES, 'UTF-8') .'</h4>
		<p>'. htmlspecialchars($bio, ENT_QUOTES, 'UTF-8') . '</p>
	</body>
</html> ';							//The template

file_put_contents($file, $content);	//Write to the file

header('Location: ' . $file);		//redirect to the newly created page.
?>
