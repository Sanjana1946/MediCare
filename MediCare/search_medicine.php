<?php

  $text = trim($_POST['text']);
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $query = "SELECT * FROM medicines join supplier on medicines.supplierid=supplier.supplierid where med_ndc like'%$text%' or weight like '%$text%' or med_name like '%$text%' or supplier_name like  '%$text%' ";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result)==0){
    echo '
    <div class="alert alert-warning" role="alert">
    Nothing Found... 
    </div>' . ' <div class="search_top" >
       
 </div>';
  }else{
    $number=mysqli_num_rows($result);
   echo  '<div class="alert alert-success" role="success"> ';
   echo $number;
   echo ' Medicines Found</div>' . ' <div class="search_top" >       
</div>';

  }

  require_once "./template/header.php";
?>
     
  <p class="lead text-center text-muted">Search Result</p>
    <?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
      <div class="row">
        <?php while($query_row = mysqli_fetch_assoc($result)){ ?>
          <div class="col-md-3">
            <a href="medicine.php?medndc=<?php echo $query_row['med_ndc']; ?>">
              <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $query_row['med_image']; ?>">
            </a>
          </div>
        <?php
          } ?> 
      </div>
<?php
      }
  if(isset($conn)) { mysqli_close($conn); }
  require_once "./template/footer.php";
?>

