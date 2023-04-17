<?php
	$med_ndc = $_GET['medndc'];

	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "DELETE FROM medicines WHERE med_ndc = '$med_ndc'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "delete data unsuccessfully " . mysqli_error($conn);
		exit;
	}
	header("Location: admin_medicine.php");
?>



