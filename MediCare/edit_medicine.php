<?php	
	// if save change happen
	if(!isset($_POST['save_change'])){
		echo "Something wrong!";
		exit;
	}

	$ndc = trim($_POST['ndc']);
	$title = trim($_POST['title']);
	$weight = trim($_POST['weight']);
	$descr = trim($_POST['descr']);
	$price = floatval(trim($_POST['price']));
	$supplier = trim($_POST['supplier']);
	$category = trim($_POST['category']);

	if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
		$image = $_FILES['image']['name'];
		$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
		$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
		$uploadDirectory .= $image;
		move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
	}

	require_once("./functions/database_functions.php");
	$conn = db_connect();

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
			$categoryid = $row['categoryid'];
		}


	$query = "UPDATE medicines SET  
	med_name = '$title', 
	weight = '$weight', 
	med_descr = '$descr', 
	med_price = '$price',
	supplierid = '$supplierid',
	categoryid = '$categoryid'";
	if(isset($image)){
		$query .= ", med_image='$image' WHERE med_ndc = '$ndc'";
	} else {
		$query .= " WHERE med_ndc = '$ndc'";
	}
	// two cases for fie , if file submit is on => change a lot
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't update data " . mysqli_error($conn);
		exit;
	} else {
		header("Location: admin_edit.php?medndc=$ndc");
	}
?>


