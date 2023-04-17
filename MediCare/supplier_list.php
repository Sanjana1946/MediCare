<?php
	session_start();
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "SELECT * FROM supplier ORDER BY supplierid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	if(mysqli_num_rows($result) == 0){
		echo "Empty supplier ! Something wrong! check again";
		exit;
	}

	$title = "List Of Suppliers";
	require "./template/header.php";
?>
	<p class="lead">List of Suppliers</p>
	<ul>
	<?php 
		while($row = mysqli_fetch_assoc($result)){
			$count = 0; 
			$query = "SELECT supplierid FROM medicines";
			$result2 = mysqli_query($conn, $query);
			if(!$result2){
				echo "Can't retrieve data " . mysqli_error($conn);
				exit;
			}
			while ($supInmedicine = mysqli_fetch_assoc($result2)){
				if($supInmedicine['supplierid'] == $row['supplierid']){
					$count++;
				}
			}
	?>
		<li>
			<span class="badge"><?php echo $count; ?></span>
		    <a href="medicinePerSup.php?supid=<?php echo $row['supplierid']; ?>"><?php echo $row['supplier_name']; ?></a>
		</li>
	<?php } ?>
		<li>
			<a href="medicines.php">Show all Medicines</a>
		</li>
	</ul>
<?php
	mysqli_close($conn);
	require "./template/footer.php";
?>

