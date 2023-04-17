<?php
	session_start();
	if((!isset($_SESSION['manager'])  && !isset($_SESSION['expert']))){
		header("Location:index.php");
	}
	$title = "List medicine";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getAll($conn);
?>	
	<div>
	<a href="admin_signout.php" class="btn btn-danger"><span class="glyphicon glyphicon-off"></span>&nbsp;Logout</a>
	<a href="admin_suppliers.php" class="btn btn-primary"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Suppliers</a>
	
	<?php
	if (isset($_SESSION['manager']) && $_SESSION['manager']==true){
		echo '<a class="btn btn-primary" href="admin_add.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Medicines</a>';
	}
	?>
	</div>
	
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>NDC</th>
			<th>Medicines Name</th>
			<th>Net. Weight</th>
			<th>Image</th>
			<th>Description</th>
			<th>Price</th>
			<th>Supplier</th>
			
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['med_ndc']; ?></td>
			<td><?php echo $row['med_name']; ?></td>
			<td><?php echo $row['weight']; ?></td>
			<td><?php echo $row['med_image']; ?></td>
			<td><?php echo $row['med_descr']; ?></td>
			<td><?php echo $row['med_price']; ?></td>
			<td><?php echo getSupName($conn, $row['supplierid']); ?></td>
			
			<?php
				if( isset($_SESSION['expert']) && $_SESSION['expert']==true){
					echo '<td><a href="admin_edit.php?medndc=';
					echo $row['med_ndc'];
					echo'"><span class="glyphicon glyphicon-pencil"></span>Edit</a></td>';
				}else if (isset($_SESSION['manager']) && $_SESSION['manager']==true){
					echo '<td><a href="admin_delete.php?medndc=';
					echo $row['med_ndc']; 
					echo '"><span class="glyphicon glyphicon-trash"></span>Delete</a></td>';
				}
			?>

		</tr>
		<?php } ?>
	</table>

<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>

