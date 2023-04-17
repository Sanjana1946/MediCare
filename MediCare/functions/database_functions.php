<?php
	if (!function_exists("db_connect")){

		function db_connect(){
			$conn = mysqli_connect("localhost", "root", "", "medicineshop");
			if(!$conn){
				echo "Can't connect database " . mysqli_connect_error($conn);
				exit;
			}
			return $conn;
		}
	}
	if (!function_exists("select4LatestMedicine")){
	function select4LatestMedicine($conn){
		$row = array();
		$query = "SELECT med_ndc, med_image FROM medicines ORDER BY med_ndc DESC";
		$result = mysqli_query($conn, $query);
		if(!$result){
		    echo "Can't retrieve data " . mysqli_error($conn);
		    exit;
		}
		for($i = 0; $i < 4; $i++){
			array_push($row, mysqli_fetch_assoc($result));
		}
		return $row;
	}
}
if (!function_exists("getMedicineByNdc")){
	function getMedicineByNdc($conn, $ndc){
		$query = "SELECT med_name, weight, med_price FROM medicines WHERE med_ndc = '$ndc'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
}
if (!function_exists("getCartId")){
	function getCartId($conn, $customerid){
		$query = "SELECT id FROM cart WHERE customerid = '$customerid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "retrieve data failed!" . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['id'];
	}
}

if (!function_exists("insertIntoCart")){
	function insertIntoCart($conn, $customerid,$date){
		$query = "INSERT INTO cart(customerid,date) VALUES('$customerid','$date') ";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Insert Cart failed " . mysqli_error($conn);
			exit;
		}
	}
}
if (!function_exists("getmedicineprice")){
	function getmedicineprice($ndc){
		$conn = db_connect();
		$query = "SELECT med_price FROM medicines WHERE med_ndc = '$ndc'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "get medicine price failed! " . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['med_price'];
	}
}
if (!function_exists("getCustomerId")){
	function getCustomerId($name, $address, $city, $zip_code, $country){
		$conn = db_connect();
		$query = "SELECT customerid from customers WHERE 
		name = '$name' AND 
		address= '$address' AND 
		city = '$city' AND 
		zip_code = '$zip_code' AND 
		country = '$country'";
		$result = mysqli_query($conn, $query);
		// if there is customer in db, take it out
		if($result){
			$row = mysqli_fetch_assoc($result);
			return $row['customerid'];
		} else {
			return null;
		}
	}
}
if (!function_exists("getCustomerIdbyEmail")){
	function getCustomerIdbyEmail($email){
		$conn = db_connect();
		$query = "SELECT * from customers WHERE 
		email = '$email'";
		$result = mysqli_query($conn, $query);
		// if there is customer in db, take it out
		if($result){
			$row = mysqli_fetch_assoc($result);
			return $row;
		} else {
			return null;
		}
	}
}

if (!function_exists("getSupName")){
	function getSupName($conn, $supid){
		$query = "SELECT supplier_name FROM supplier WHERE supplierid = '$supid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		if(mysqli_num_rows($result) == 0){
			echo "Not Set";
		}

		$row = mysqli_fetch_assoc($result);
		return $row['supplier_name'];
	}
}
	if (!function_exists("getCatName")){
		function getCatName($conn, $catid){
			$query = "SELECT category_name FROM category WHERE categoryid = '$catid'";
			$result = mysqli_query($conn, $query);
			if(!$result){
				echo "Can't retrieve data " . mysqli_error($conn);
				exit;
			}
			if(mysqli_num_rows($result) == 0){
				echo "Not Set";
			}

			$row = mysqli_fetch_assoc($result);  
			return $row['category_name'];
	}
}
if (!function_exists("getAll")){
	function getAll($conn){
		$query = "SELECT * from medicines ORDER BY med_ndc DESC";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
}
if (!function_exists("getAllsuppliers")){
	function getAllsuppliers($conn){
		$query = "SELECT * from supplier ORDER BY supplier_name ASC";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
}
if (!function_exists("getAllCategories")){
	function getAllCategories($conn){
		$query = "SELECT * from category ORDER BY category_name ASC";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
}
?>

