<?php
		$host = 'localhost';
		$username = 'root';
		$password = '';
		$database = 'databasename';

		$_SESSION['con'] = mysqli_connect($host, $username, $password, $database);
?>