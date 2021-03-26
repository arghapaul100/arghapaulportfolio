<?php

	include 'db_connect.php';

	function search($email){

		$sql = "select * from tablename where email ='$email'";

		$result = mysqli_query($_SESSION['con'],$sql);

		$count = mysqli_num_rows($result);

		if($count > 0)
			return 1;
		else
			return 0;

	}






?>