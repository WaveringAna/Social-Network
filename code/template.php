<?php
if(isset($_COOKIE["USER"])) {
	$user = $_COOKIE["USER"];
	$pass = $_COOKIE["PASSWORD"];
	if ($user == '.$name.') {     /*I can figure out what I can do with these later */
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
		<h1><a href="../index.php">Social Network</a></h1>
		<hr>
		<h2>'. htmlspecialchars($name, ENT_QUOTES, 'UTF-8') .'</h4>
		<p>'. htmlspecialchars($bio, ENT_QUOTES, 'UTF-8') . '</p>
	</body>
</html>