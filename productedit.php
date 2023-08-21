<?php
    session_start();
    
    include 'bootstrap.php';

    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }

    if (!isset($_GET['id'])) {
      header('Location: display.php');
      exit();
    }

    $conn = new mysqli("localhost", "root", "", "task3");

    // $id = $_GET['id'];

    // $productQuery = "SELECT p.*, v.vendor_name AS vendor_name FROM product p
    //                                 JOIN vendor v ON p.vendor_id = v.vendor_id
    //                                 WHERE p.id = '$id'";
    // $productResult = mysqli_query($conn, $productQuery);
    // $row = mysqli_fetch_assoc($productResult);

    // $vendorQuery = "SELECT * FROM vendor WHERE is_active = 1";
    // $vendorResult = mysqli_query($conn, $vendorQuery);

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $vendor_id = $_POST['vendor_id'];
        $product_name = $_POST['product_name'];
        $description = $_POST['description'];
        $sku = $_POST['sku'];
        $price = $_POST['price'];
        $stock_quantity = $_POST['stock_quantity'];
        $id = $_POST['id'];

        $sql = "UPDATE product SET product_name = '$product_name', description = '$description', sku = '$sku', price = '$price', stock_quantity = '$stock_quantity', id = '$id' WHERE id = '$id'";
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
        $sql = "SELECT id,updated_at FROM product WHERE id = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $updated_at = $row['updated_at'];
            // previous updated timestamp
            $update_previous_logout_sql = "UPDATE product SET previous_update = '$updated_at' WHERE id = '$id'";
            $conn->query($update_previous_logout_sql);
  
            // Current updated timestamp
            $update = "UPDATE product SET updated_at = Now() WHERE id = '$id'";
            $conn->query($update); 
        }
    }

    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql = "SELECT p.*, v.vendor_name AS vendor_name FROM product p
                                    JOIN vendor v ON p.vendor_id = v.vendor_id
                                    WHERE p.id = '$id'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      // if ($result->num_rows == 1) {
      //     $row = $result->fetch_assoc();
      //     var_dump($row);
      //     $id = $row['id'];
      //     $vendor_id = $row['vendor_id'];
      //     $product_name = $row['product_name'];
      //     $updated_at = $row['updated_at'];
      // }
      echo $row['id'];
      echo "<br>";
      echo $row['vendor_id'];
      echo "<br>";
      echo $row['product_name'];
      echo "<br>";
  }


    // if(isset($_GET['id'])){
    //     $id = $_GET['id'];

    //     $sql = "SELECT * FROM product WHERE id = '$id'";
    //     // echo "<pre>";
    //     // print_r($conn);
    //     $result = $conn->query($sql);
    //     if(!$result){
    //       echo "Error:" . $sql . "<br>" .$conn->error;
    //     }
    //     if($result->num_rows == 1){
    //         while($row=$result->fetch_assoc()) {
    //             $id = $row['id'];
    //             $vendor_id = $row['vendor_id'];
    //             $product_name = $row['product_name'];
    //             $description = $row['description'];
    //             $sku = $row['sku'];
    //             $price = $row['price'];
    //             $stock_quantity = $row['stock_quantity'];
    //       }
    //     }
    //     echo $id;
    //       echo "<br>";
    //       echo $vendor_id;
    //       echo "<br>";
    //       echo $product_name;
    //       echo "<br>";
    //       echo $description;
    //       echo "<br>";
    //       echo $sku;
    //       echo "<br>";
    //       echo $price;
    //       echo "<br>";
    //       echo $stock_quantity;
    //       echo "<br>";
?>

<!DOCTYPE html>
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
                  <h2 class="text-uppercase text-center mb-5"style="margin-top: -25px;color: seablue;" >Updating Product Details</h2>

                  <form action="" method="post">
                
                  <input type='hidden' name='id' value="<?php echo $row['id']; ?>">
                  <!-- <input type='hidden' name='vendor_id' value="<?php echo $vendor_id; ?>"> -->

                  <label style="margin-left: -40px;"><b>Vendor ID:</b></label>
                  <input disabled="disabled" type='number' name='vendor_id' value="<?php echo $row['vendor_id']; ?>">
                  <br> <br>

                  <label><b>Product Name:</b></label>
                  <input type='text' name='product_name' value="<?php echo $row['product_name']; ?>">
                  <br> <br>

                  <label style="margin-left: -40px;"><b>Description:</b></label>
                  <input type='text' name='description' value="<?php echo $row['description']; ?>">
                  <br> <br>
                
                  <label><b>SKU:</b></label>
                  <input type='text' name='sku' value="<?php echo $row['sku']; ?>">
                  <br> <br>

                  <label style="margin-left: 11px;"><b>Price:</b></label>
                  <input type='text' name='price' value="<?php echo $row['price']; ?>">
                  <br> <br>

                  <label style="margin-left: -13px;"><b>Stock Quantity:</b></label>
                  <input type='text' name='stock_quantity' value="<?php echo $row['stock_quantity']; ?>">
                  <br> <br>

                  <div class="d-flex justify-content-center">
                    <button type="submit" name="submit" value="submit" class="btn btn-dark">Update Product</button>
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