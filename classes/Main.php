<?php
function createpage($name, $bio) {													
	$file = '/profiles/' . $name . '.php';	//assuming the file calling this is in the root directory
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
</html> ';							//The template
	file_put_contents($file, $content);	//Write to the file
}	
?>