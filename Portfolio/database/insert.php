<?php
	include 'db_connect.php';

	function connect($field1,$field2,$field3){
	$sql = "insert into tablename(field1,field2,field3) values ('$field1','$field2','$field3')";

		$result = mysqli_query($_SESSION['con'],$sql);
	}
?>