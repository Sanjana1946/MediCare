<?php
  session_start();
  $med_ndc = $_GET['medndc'];
  // connec to database
  require_once "./functions/database_functions.php";
  $conn = db_connect();

  $query = "SELECT * FROM medicines WHERE med_ndc = '$med_ndc'";
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }

  $row = mysqli_fetch_assoc($result);
  if(!$row){
    echo "Empty medicine";
    exit;
  }

  $title = $row['med_name'];
  require "./template/header.php";
?>
      <!-- Example row of columns -->
      <p class="lead" style="margin: 25px 0"><a href="medicines.php">Medicines</a> > <?php echo $row['med_name']; ?></p>
      <div class="row">
        <div class="col-md-3 text-center">
          <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $row['med_image']; ?>">
        </div>
        <div class="col-md-6">
          <h4>Description</h4>
          <p><?php echo $row['med_descr']; ?></p>
          <h4>Details</h4>
          <table class="table">
          	<?php foreach($row as $key => $value){
              if($key == "med_descr" || $key == "med_image" || $key == "supplierid" || $key == "med_name"){
                continue;
              }
              switch($key){
                case "med_ndc":
                  $key = "ndc";
                  break;
                case "med_name":
                  $key = "Medicines Name";
                  break;
                case "weight":
                  $key = "Net. Weight";
                  break;
                case "med_price":
                  $key = "Price";
                  break;
              }
            ?>
            <tr>
              <td><?php echo $key; ?></td>
              <td><?php echo $value; ?></td>
            </tr>
            <?php 
              } 
              if(isset($conn)) {mysqli_close($conn); }
            ?>
          </table>
          <form method="post" action="cart.php">
            <input type="hidden" name="medndc" value="<?php echo $med_ndc;?>">
            
            <input type="submit" value="Add to cart" name="cart" class="btn btn-primary">
          </form>
       	</div>
      </div>
<?php
  require "./template/footer.php";
?>


