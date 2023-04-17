<?php

	session_start();
	require_once "./functions/database_functions.php";
	require_once "./functions/cart_functions.php";
	$conn = db_connect();
	// med_ndc got from form post method, change this place later.
	if(isset($_POST['medndc'])){
		$med_ndc = $_POST['medndc'];
	}

	if(isset($med_ndc)){
		// new iem selected
		if(!isset($_SESSION['cart'])){
			// $_SESSION['cart'] is associative array that medndc => qty
			$_SESSION['cart'] = array();

			$_SESSION['total_items'] = 0;
			$_SESSION['total_price'] = '0.00';
		}

		if(!isset($_SESSION['cart'][$med_ndc])){
			$_SESSION['cart'][$med_ndc] = 1;
		} elseif(isset($_POST['cart'])){
			$_SESSION['cart'][$med_ndc]++;
			unset($_POST);
		}
	}

	// if save change button is clicked , change the qty of each medndc
	if(isset($_POST['save_change'])){
		foreach($_SESSION['cart'] as $ndc =>$qty){
			if($_POST[$ndc] == '0'){
				unset($_SESSION['cart']["$ndc"]);
			} else {
				$_SESSION['cart']["$ndc"] = $_POST["$ndc"];
			}
		}
	}

	// print out header here
	$title = "Your shopping cart";
	require "./template/header.php";

	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
		$_SESSION['total_price'] = total_price($_SESSION['cart']);
		$_SESSION['total_items'] = total_items($_SESSION['cart']);
?>
   	<form action="cart.php" method="post">
	   	<table class="table">
	   		<tr>
	   			<th>Item</th>
	   			<th>Price</th>
	  			<th>Quantity</th>
	   			<th>Total</th>
	   		</tr>
	   		<?php
		    	foreach($_SESSION['cart'] as $ndc => $qty){
					$conn = db_connect();
					$medicine = mysqli_fetch_assoc(getMedicineByndc($conn, $ndc));
			?>
			<tr>
				<td><?php echo $medicine['med_name'] . " by " . $medicine['weight']; ?></td>
				<td><?php echo "$" . $medicine['med_price']; ?></td>
				<td><input type="text" value="<?php echo $qty; ?>" size="2" name="<?php echo $ndc; ?>"></td>
				<td><?php echo "$" . $qty * $medicine['med_price']; ?></td>
			</tr>
			<?php } ?>
		    <tr>
		    	<th>&nbsp;</th>
		    	<th>&nbsp;</th>
		    	<th><?php echo $_SESSION['total_items']; ?></th>
		    	<th><?php echo "$" . $_SESSION['total_price']; ?></th>
		    </tr>
	   	</table>
		   <button type="submit" class="btn btn-primary" name="save_change"><span class="glyphicon glyphicon-ok"></span>&nbsp;Save Changes</button>
	  
	</form>
	<br/><br/>
	<a href="checkout.php" class="btn btn-primary">Go To Checkout</a> 
	<a href="medicines.php" class="btn btn-primary">Continue Shopping</a>
<?php
	} else {
		echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some medicines in it!</p>";
	}
	if(isset($_SESSION['user'])){
	$customer=getCustomerIdbyEmail($_SESSION['email']);
	$customerid=$customer['id'];
	$query="SELECT * FROM cart join cartitems join medicines join customers
		on customers.id='$customerid' and cart.customerid='$customerid' and cart.id=cartitems.cartid and  cartitems.productid=medicines.med_ndc";
	 $result=mysqli_query($conn,$query);
	 if(mysqli_num_rows($result)!=0){
	 echo '	<br><br><br><h4>Your Purchase History</h4><table class="table">
	 <tr>
		 <th>Item</th>
		 <th>Quantity</th>
		<th>Date</th>
	 </tr>';
		for($i = 0; $i < mysqli_num_rows($result); $i++){
			
			while($query_row = mysqli_fetch_assoc($result)){
				echo '<tr>
				<td>
				<a href="medicine.php?medndc=';
				echo $query_row['med_ndc'];
				echo '">';
				echo '<img style="height:100px;width:80px"class="img-responsive img-thumbnail" src="./bootstrap/img/';
				echo $query_row['med_image'];
				echo '">';
				echo ' </a>
				</td>
				<td>';
				echo $query_row['quantity'];
				echo '
				</td>
				<td>';
				echo $query_row['date'];
				echo'
				</td>
				</tr>';
			}
		}
		echo '</table>';
	}
}
?>
<?php	 
	if(isset($conn)){ mysqli_close($conn); }
	// require_once "./template/footer.php";?>


