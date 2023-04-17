<?php
	session_start();
	if((!isset($_SESSION['manager'])  && !isset($_SESSION['expert']))){
		header("Location:index.php");
	}
	$title = "Add new medicine";
	require "./template/header.php";
	require "./functions/database_functions.php";
	$conn = db_connect();

	if(isset($_POST['add'])){
		$ndc = trim($_POST['ndc']);
		$ndc = mysqli_real_escape_string($conn, $ndc);
		
		$title = trim($_POST['title']);
		$title = mysqli_real_escape_string($conn, $title);

		$weight = trim($_POST['weight']);
		$weight = mysqli_real_escape_string($conn, $weight);
		
		$descr = trim($_POST['descr']);
		$descr = mysqli_real_escape_string($conn, $descr);
		
		$price = floatval(trim($_POST['price']));
		$price = mysqli_real_escape_string($conn, $price);
		
		$supplier = trim($_POST['supplier']);
		$supplier = mysqli_real_escape_string($conn, $supplier);
		
		

		// add image
		if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
			$image = $_FILES['image']['name'];
			$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
			$uploadDirectory .= $image;
			move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
		}

		// find supplier and return supid
		// if supplier is not in db, create new
		$findsup = "SELECT * FROM supplier WHERE supplier_name = '$supplier'";
		$findResult = mysqli_query($conn, $findsup);
		if(mysqli_num_rows($findResult)==0){
			// insert into supplier table and return id
			$insertsup = "INSERT INTO supplier(supplier_name) VALUES ('$supplier')";
			$insertResult = mysqli_query($conn, $insertsup);
			if(!$insertResult){
				echo "Can't add new supplier " . mysqli_error($conn);
				exit;
			}
			$supplierid = mysqli_insert_id($conn);
		} else {
			$row = mysqli_fetch_assoc($findResult);
			$supplierid = $row['supplierid'];
		}
		// find category and return catid
		// if category is not in db, create new
		$findCat = "SELECT * FROM category WHERE category_name = '$category'";
		$findResult = mysqli_query($conn, $findCat);
		if(mysqli_num_rows($findResult)==0){
			// insert into category table and return id
			$insertCat = "INSERT INTO category(category_name) VALUES ('$category')";
			$insertResult = mysqli_query($conn, $insertCat);
			if(!$insertResult){
				echo "Can't add new category " . mysqli_error($conn);
				exit;
			}
			$categoryid = mysqli_insert_id($conn);
		} else {
			$row = mysqli_fetch_assoc($findResult);
			$category = $row['category'];
		}


		$query = "INSERT INTO medicines VALUES ('" . $ndc . "', '" . $title . "', '" . $weight . "', '" . $image . "', '" . $descr . "', '" . $price . "', '" . $supplierid . "', '" . $categoryid . "')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't add new data " . mysqli_error($conn);
			exit;
		} else {
			header("Location: admin_medicine.php");
		}
	}
?>
	<form method="post" action="admin_add.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>ndc</th>
				<td><input type="text" name="ndc"></td>
			</tr>
			<tr>
				<th>Medicines Name</th>
				<td><input type="text" name="title" required></td>
			</tr>
			<tr>
				<th>Net. Weight</th>
				<td><input type="text" name="weight" required></td>
			</tr>
			<tr>
				<th>Image</th>
				<td><input type="file" name="image"></td>
			</tr>
			<tr>
				<th>Description</th>
				<td><textarea name="descr" cols="40" rows="5"></textarea></td>
			</tr>
			<tr>
				<th>Price</th>
				<td><input type="text" name="price" required></td>
			</tr>
			<tr>
				<th>Supplier</th>
				<td><input type="text" name="supplier" required></td>
			</tr>
			
		</table>
		<input type="submit" name="add" value="Add new medicine" class="btn btn-primary">
		<input type="reset" value="cancel" class="btn btn-default">
	</form>
	<br/>
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
	
?>


