<?php
	$db = mysqli_connect('localhost','root','','media') or
	die(mysqli_connect_error());
	mysqli_set_charset($db, 'utf8');
?>