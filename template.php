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
		<h2>'. $name .'</h4>
		<p>'. $bio . '</p>
	</body>
</html> ';				//The template

file_put_contents($file, $content);	//Write to the file

header('Location: ' . $file);		//redirect to the newly created page.
?>
