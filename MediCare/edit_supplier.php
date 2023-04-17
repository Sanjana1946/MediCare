<?php	
	// if save change happen
	if(!isset($_POST['save_change'])){
		echo "Something wrong!";
		exit;
	}

	$supplier = trim($_POST['name']);
	$id = trim($_POST['id']);

    require_once("./functions/database_functions.php");
	$conn = db_connect();


	$query = "UPDATE supplier SET  
	supplier_name = '$supplier' where supplierid='$id'";
	
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't update data " . mysqli_error($conn);
		exit;
	} else {
		header("Location: admin_suppliers.php?medndc=$ndc");
	}
?>


