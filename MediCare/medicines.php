<?php
  session_start();
  $count = 0;
  // connecto database
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  if(isset($_POST['title'])){
    if(isset($_POST['asc'])){
      $query = "SELECT * FROM medicines order by med_name asc";

    }
    else if(isset($_POST['desc'])){
      $query = "SELECT * FROM medicines order by med_name desc";
    }else{
      $query = "SELECT * FROM medicines";
    }
  }else if(isset($_POST['price'])){
    if(isset($_POST['asc'])){
      $query = "SELECT * FROM medicines order by med_price asc";

    }
    else if(isset($_POST['desc'])){
      $query = "SELECT * FROM medicines order by med_price desc";
    }else{
      $query = "SELECT * FROM medicines";
    }
  }else if(isset($_POST['weight'])){
    if(isset($_POST['asc'])){
      $query = "SELECT * FROM medicines order by weight asc";

    }
    else if(isset($_POST['desc'])){
      $query = "SELECT * FROM medicines order by weight desc";
    }else{
      $query = "SELECT * FROM medicines";
    }
  }else{
    $query = "SELECT * FROM medicines";
  }

  $result = mysqli_query($conn, $query);
  $title = "Medicines";
    require_once "./template/header.php";
?>

  <p class="lead text-center text-muted">Medicines in Stock</p>
<h5 class="lead text-muted">Filter By:</h5>

<form method="post" action="medicines.php">
  <div class="radio">
    <label><input type="radio" name="asc" >Ascending</label>
  </div>
  <div class="radio">
    <label><input type="radio" name="desc">Descending</label>
  </div>

  <button type="submit" class="btn btn-secondary" name="title">Medicine Name</button>
  <button type="submit" class="btn btn-warning" name="price">Price</button>
  
</form>

<br><br>

    <?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
      <div class="row">
        <?php while($query_row = mysqli_fetch_assoc($result)){ ?>
          <div class="col-md-3">
            <a href="medicine.php?medndc=<?php echo $query_row['med_ndc']; ?>">
              <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $query_row['med_image']; ?>">
              </a>
              <table>
                <tr>
                  <td><strong>  <?php echo $query_row['med_name']; ?></strong></td>
                </tr>
                <tr>
                <td> <?php echo $query_row['weight']; ?></td>
                </tr>
                <tr>
                <td><strong>$<?php echo $query_row['med_price'];?></strong>  </td>
                </tr>
              </table>
            </div>
        <?php
          $count++;
          if($count >= 4){
              $count = 0;
              break;
            }
          } ?> 
      </div>
      <br><br>
<?php
      }
  if(isset($conn)) { mysqli_close($conn); }
  require_once "./template/footer.php";
?>

 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    