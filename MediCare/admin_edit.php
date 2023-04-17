<?php
	session_start();
	if((!isset($_SESSION['manager'])  && !isset($_SESSION['expert']))){
		header("Location:index.php");
	}
	$title = "Edit medicine";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	if(isset($_GET['medndc'])){
		$med_ndc = $_GET['medndc'];
	} else {
		echo "Empty query!";
		exit;
	}

	if(!isset($med_ndc)){
		echo "Empty ndc! check again!";
		exit;
	}

	// get medicine data
	$query = "SELECT * FROM medicines WHERE med_ndc = '$med_ndc'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	$row = mysqli_fetch_assoc($result);
?>
	<form method="post" action="edit_medicine.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>ndc</th>
				<td><input type="text" name="ndc" value="<?php echo $row['med_ndc'];?>" readOnly="true"></td>
			</tr>
			<tr>
				<th>Medicines Name</th>
				<td><input type="text" name="title" value="<?php echo $row['med_name'];?>" required></td>
			</tr>
			<tr>
				<th>Net. Weight</th>
				<td><input type="text" name="weight" value="<?php echo $row['weight'];?>" required></td>
			</tr>
			<tr>
				<th>Image</th>
				<td><input type="file" name="image"></td>
			</tr>
			<tr>
				<th>Description</th>
				<td><textarea name="descr" cols="40" rows="5"><?php echo $row['med_descr'];?></textarea>
			</tr>
			<tr>
				<th>Price</th>
				<td><input type="text" name="price" value="<?php echo $row['med_price'];?>" required></td>
			</tr>
			<tr>
				<th>Supplier</th>
				<td><input type="text" name="supplier" value="<?php echo getSupName($conn, $row['supplierid']); ?>" required></td>
			</tr>
			
		</table>
		<input type="submit" name="save_change" value="Change" class="btn btn-primary">
		<a href="admin_medicine.php" class="btn btn-default">Cancel</a>
	</form>
	<br/>
	<a href="admin_medicine.php" class="btn btn-success">Confirm</a>
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require "./template/footer.php"
?>
