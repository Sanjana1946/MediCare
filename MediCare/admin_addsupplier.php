<?php
	session_start();
	if((!isset($_SESSION['manager'])  && !isset($_SESSION['expert']))){
		header("Location:index.php");
	}
	$title = "Add new supplier";
	require "./template/header.php";
	require "./functions/database_functions.php";
	$conn = db_connect();

	if(isset($_POST['add'])){
		$name = trim($_POST['name']);
		$name = mysqli_real_escape_string($conn, $name);
		
		// find supplier and return supid
		// if supplier is not in db, create new
		$findsup = "SELECT * FROM supplier WHERE supplier_name = '$name'";
		$findResult = mysqli_query($conn, $findsup);
		if(mysqli_num_rows($findResult)==0){
			// insert into supplier table and return id
			$insertsup = "INSERT INTO supplier(supplier_name) VALUES ('$name')";
			$insertResult = mysqli_query($conn, $insertsup);
			if(!$insertResult){
				echo "Can't add new supplier " . mysqli_error($conn);
				exit;
			}
			header("Location: admin_suppliers.php");
		} else {
            echo '<p style="color:red;">supplier already exists</p>';
		}
	}
?>
	<form method="post" action="admin_addsupplier.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>Name</th>
				<td><input type="text" name="name"></td>
			</tr>
		</table>
		<input type="submit" name="add" value="Add new supplier" class="btn btn-primary">
		<a href="admin_suppliers.php" class="btn btn-default">Cancel</a>
	</form>
	<br/>
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>

