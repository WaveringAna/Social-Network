<?php 
$past = time() - 100; 
//this makes the time in the past to destroy the cookie 
setcookie(USER, gone, $past); 
setcookie(PASSWORD, gone, $past); 
header("Location: login.php"); 
?> 