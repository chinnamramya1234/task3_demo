<?php
    session_start();

    include 'bootstrap.php';

    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }

    $conn = new mysqli("localhost", "root", "", "task3");

    if(isset($_POST['submit'])) {
        $vendor_id = $_POST['vendor_id'];
        $product_name = $_POST['product_name'];
        $description = $_POST['description'];
        $sku = $_POST['sku'];
        $price = $_POST['price'];
        $stock_quantity = $_POST['stock_quantity'];

        $sql = "INSERT INTO product (product_name, description, sku, price, stock_quantity, vendor_id) VALUES ('$product_name', '$description', '$sku', '$price', '$stock_quantity', '$vendor_id')";

        // echo "<pre>";
        // print_r($conn);

        $result = $conn->query($sql);

        if($result == TRUE){
            $id = $_SESSION['id'];
            echo $id;
            header('Location: display.php');
            echo "New record created successfully";
            exit();
        }else{
            echo "Error " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body style="background-color: #5f9ea0;">
<section class="vh-100" style="margin-top: 2%;margin-bottom: 10%;">
  <div class="mask d-flex align-items-center h-100" style="text-align: center;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-10"style="margin-top: -25px;color: seablue;" >Adding New Product</h2>

              <form action="" method="post">

              <!-- <div class="form-outline mb-4">
                  <input type="text" placeholder="Vendor ID" name="vendor_id" class="form-control form-control-lg" required/>
                  <label class="form-label" for="form3Example1cg"></label>
                </div>
                <br> -->

                <div class="form-outline mb-4">
                  <input type="text" placeholder="Product Name" name="product_name" class="form-control form-control-lg"  style="margin-top: 10px;" required/>
                  <label class="form-label" for="form3Example1cg"></label>
                </div>
                <br>

                <div class="form-outline mb-4">
                  <input type="text" placeholder="Description" name="description" class="form-control form-control-lg" style="margin-top: -60px;" required/>
                  <label class="form-label" for="form3Example4cg"></label>
                </div>
                
                <div class="form-outline mb-4">
                  <input type="text" placeholder="SKU" name="sku"class="form-control form-control-lg" style="margin-top: -35px;" required/>
                  <label class="form-label" for="form3Example1cg"></label>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" placeholder="Price" name="price" class="form-control form-control-lg" style="margin-top: -35px;" required/>
                  <label class="form-label" for="form3Example1cg"></label>
                </div>

                <div class="form-outline mb-0">
                  <input type="text" placeholder="Stock Quantity" name="stock_quantity" class="form-control form-control-lg" style="margin-top: -35px;margin-bottom: -25px;" required/>
                  <label class="form-label" for="form3Example3cg"></label>
                </div>

                <div class="row">
                        <div class="col-sm-3 form-group row">
                            <label for="vendor_id" class="col-form-label text-md-right name mb-0"><b>Vendor:</b></label>      
                        </div>    
                        <div class="col-sm-9">
                        <select id="vendor_id" name="vendor_id" style="margin-top: 10px;margin-bottom: 20px;margin-left: -26px;width: 380px;">
                        <?php
                            $query = "SELECT * FROM vendor WHERE is_active = 1";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['vendor_id']}'>{$row['vendor_name']}</option>";
                            }
                        ?>
                        </select><br><br>
                        </div>   
                </div>

                <!-- <div class="form-outline mb-4">
                  <input type="text" placeholder="Address" name="address" class="form-control form-control-lg" style="margin-top: -35px;" required/>
                  <label class="form-label" for="form3Example3cg"></label>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" placeholder="Taxid" name="taxid" class="form-control form-control-lg" style="margin-top: -35px;" required/>
                  <label class="form-label" for="form3Example3cg"></label>
                </div> -->

                <div class="d-flex justify-content-center">
                  <button type="submit" name="submit" value="submit" class="btn btn-dark" style="margin-top: -25px;">Add Product</button>
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
