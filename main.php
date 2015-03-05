<!doctype html>
<html>
	<h1>Social Network</h1>
	<hr>
	<h2>Create a page</h2>
	<form action='template.php' method="POST">
		Name:<br>
		<input type='text' name='name' required><br>
		Bio:<br>
		<textarea name='bio' required></textarea>
		<button type='submit'>submit</button>
	</form>
	<div>
		<h2>Browse other's pages</h2>
		<?php
		$dir = './profiles';
		$files = array_slice(scandir('profiles'), 2);  //The array_slice removes . and ..
		foreach($files as $file) {
			print("<a href='profiles/" . $file . "'>" . $file . "</a><br>");
		}
		?>
	</div>
</html>