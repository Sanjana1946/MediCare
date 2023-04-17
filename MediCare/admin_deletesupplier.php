<?php
	$supid = $_GET['supid'];

	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "DELETE FROM supplier WHERE supplierid = '$supid'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "delete data unsuccessfully " . mysqli_error($conn);
		exit;
	}
	header("Location: admin_suppliers.php");
?>

