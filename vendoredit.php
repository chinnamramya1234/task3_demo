<?php
    session_start();

    include 'bootstrap.php';

    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }

    $conn = new mysqli("localhost", "root", "", "task3");

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $vendor_id = $_POST['vendor_id'];
        $vendor_name = $_POST['vendor_name'];
        $description = $_POST['description'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $website = $_POST['website'];
        $address = $_POST['address'];
        $taxid = $_POST['taxid'];
        $id = $_POST['id'];

        $sql = "UPDATE vendor SET vendor_name = '$vendor_name', description = '$description', phone = '$phone', email = '$email', website = '$website', address = '$address', taxid = '$taxid', id = '$id' WHERE id = '$id'";
        // echo "<pre>";
        // print_r($conn);
        $result = $conn->query($sql);

        if($result == TRUE){
            header('Location: display.php');
            echo "Record updated successfully";
        }else{
            echo "Error:" . $sql . "<br>" .$conn->error;
        }
    }

    if (isset($_POST['submit'])) {
      $sql = "SELECT id,updated_at FROM vendor WHERE id = '$id'";
      $result = $conn->query($sql);
      if ($result->num_rows == 1) {
          $row = $result->fetch_assoc();
          $id = $row['id'];
          $updated_at = $row['updated_at'];
          // previous updated timestamp
          $update_previous_logout_sql = "UPDATE vendor SET previous_update = '$updated_at' WHERE id = '$id'";
          $conn->query($update_previous_logout_sql);

          // Current updated timestamp
          $update = "UPDATE vendor SET updated_at = Now() WHERE id = '$id'";
          $conn->query($update); 
      }
  }

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM vendor WHERE id = '$id'";

        $result = $conn->query($sql);

        if($result->num_rows == 1){
            while($row=$result->fetch_assoc()) {
                $id = $row['id'];
                $vendor_id = $row['vendor_id'];
                $vendor_name = $row['vendor_name'];
                $description = $row['description'];
                $phone = $row['phone'];
                $email = $row['email'];
                $website = $row['website'];
                $address = $row['address'];
                $taxid = $row['taxid'];
            }
            ?>

<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body style="background-color: #5f9ea0;">
<section class="vh-100" style="margin-top: 2%;margin-bottom: 8%;">
  <div class="mask d-flex align-items-center h-100" style="text-align: center;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5"style="margin-top: -25px;color: seablue;" >Updating Vendor Details</h2>

              <form action="" method="post">

                <label style="margin-left: -40px;"><b>Vendor ID:</b></label>
                <input disabled="disabled" type='number' name='vendor_id' value="<?php echo $vendor_id ?>">
                <!-- <p type="number" name='vendor_id'><?php echo $vendor_id ?></p> -->
                <input type='hidden' name='id' value="<?php echo $id ?>">
                <br> <br>

                <label><b>Name:</b></label>
                <input type='text' name='vendor_name' value="<?php echo $vendor_name ?>">
                <br> <br>

                <label style="margin-left: -40px;"><b>Description:</b></label>
                <input type='text' name='description' value="<?php echo $description ?>">
                <br> <br>
                
                <label><b>Phone:</b></label>
                <input type='text' name='phone' value="<?php echo $phone ?>">
                <br> <br>

                <label style="margin-left: 11px;"><b>Email:</b></label>
                <input type='email' name='email' value="<?php echo $email ?>">
                <br> <br>

                <label style="margin-left: -13px;"><b>Website:</b></label>
                <input type='text' name='website' value="<?php echo $website ?>">
                <br> <br>

                <label style="margin-left: -5px;"><b>Address:</b></label>
                <input type='text' name='address' value="<?php echo $address ?>">
                <br> <br>

                <label style="margin-left: 8px;"><b>TAX ID:</b></label>
                <input type='text' name='taxid' value="<?php echo $taxid ?>">
                <br> <br>

                <div class="d-flex justify-content-center">
                  <button type="submit" name="submit" value="submit" class="btn btn-dark">Update Vendor</button>
                </div>

                <p style="margin-top: 3%;"><a href="display.php">Back to Dashboard</a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
    <?php
        }else{
            header('Location: display.php');
        }
    }
    ?>
