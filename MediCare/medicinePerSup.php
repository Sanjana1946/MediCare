<?php
	session_start();
	require_once "./functions/database_functions.php";
	// get supid
	if(isset($_GET['supid'])){
		$supid = $_GET['supid'];
	} else {
		echo "Wrong query! Check again!";
		exit;
	}

	// connect database
	$conn = db_connect();
	$supName = getSupName($conn, $supid);

	$query = "SELECT med_ndc, med_name, med_image FROM medicines WHERE supplierid = '$supid'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	if(mysqli_num_rows($result) == 0){
		echo "Empty medicines ! Please wait until new medicines coming!";
		exit;
	}

	$title = "Medicines Per Supplier";
	require "./template/header.php";
?>
	<p class="lead"><a href="supplier_list.php">Suppliers</a> > <?php echo $supName; ?></p>
	<?php while($row = mysqli_fetch_assoc($result)){
?>
	<div class="row">
		<div class="col-md-3">
			<img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $row['med_image'];?>">
		</div>
		<div class="col-md-7">
			<h4><?php echo $row['med_name'];?></h4>
			<a href="medicine.php?medndc=<?php echo $row['med_ndc'];?>" class="btn btn-primary">Get Details</a>
		</div>
	</div>
	<br>
<?php
	}
	if(isset($conn)) { mysqli_close($conn);}
	require "./template/footer.php";
?>

