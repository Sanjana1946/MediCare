<?php
  session_start();
  $count = 0;
  // connecto database
  
  $title = "Index";
  require_once "./template/header.php";
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $row = select4LatestMedicine($conn);
?> 
     
     <br/> <br/>
      <p class="lead text-center text-muted">FREQUENTLY PURCHASED MEDICINES</p>
      <br><br>
      <div class="row">
        <?php foreach($row as $medicine) { ?>
      	<div class="col-md-3">
      		<a href="medicine.php?medndc=<?php echo $medicine['med_ndc']; ?>">
           <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $medicine['med_image']; ?>">
          </a>
      	</div>
        <?php } ?>
      </div>
<?php
  if(isset($conn)) {mysqli_close($conn);}
  require_once "./template/footer.php";
?>

