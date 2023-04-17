<?php
	session_start();
	if((!isset($_SESSION['manager'])  && !isset($_SESSION['expert']))){
		header("Location:index.php");
	}
	$title = "Edit supplier";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	if(isset($_GET['supid'])){
		$supid = $_GET['supid'];
	} else {
		echo "Empty query!";
		exit;
	}

	if(!isset($supid)){
		echo "Empty ndc! check again!";
		exit;
	}

	// get medicine data
	$query = "SELECT * FROM supplier WHERE supplierid = '$supid'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	$row = mysqli_fetch_assoc($result);
?>
	<form method="post" action="edit_supplier.php" enctype="multipart/form-data">
		<table class="table">
        <th>Name</th>
			<tr>
				<td style="display:none"><input type="text" name="id" value="<?php echo $row['supplierid'];?>"></td>
				
				<td><input type="text" name="name" value="<?php echo $row['supplier_name'];?>" required></td>
			</tr>

		</table>
		<input type="submit" name="save_change" value="Change" class="btn btn-primary">
		<a href="admin_suppliers.php" class="btn btn-default">Cancel</a>
	</form>
	<br/>
	<!-- <a href="admin_suppliers.php" class="btn btn-success">Confirm</a> -->
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require "./template/footer.php"
?>


