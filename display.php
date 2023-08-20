<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];
// Establish connection to the database using phpMyAdmin credentials
$conn = new mysqli("localhost", "root", "", "task3");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $username = $row["username"];
    $lastname = $row["lastname"];
    $email = $row["email"];
} else {
    header("Location: login.php");
    exit();

}

?>

<!DOCTYPE html>
<html>
<head>

<script>
function showVendorManagement() {
    document.getElementById("vendor").style.display = "block";
    document.getElementById("product").style.display = "none";
}
function showProductManagement() {
    document.getElementById("product").style.display = "block";
    document.getElementById("vendor").style.display = "none";
}
</script>

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}
.topnav {
  overflow: hidden;
  background-color: #333;
}
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

</style>
</head>
<body>
<h1 class="fontWeightB" style="text-align: center;">Vendor and Product Management System</h1>
<p style="margin-left: 1030px;margin-top: -20px;"><b>Username : <?php echo $row['username']?></b></p>
<p><a style="margin-left: 1125px;" href="logout.php">Logout</a></p>
<!-- Navigation Links -->
<div class="topnav">
    <a style="margin-left: 200px;" href="#" onclick="showVendorManagement()">Vendor Management</a>
    <a style="margin-left: 480px;" href="#" onclick="showProductManagement()">Product Management</a>
</div>

<!-- Vendor Management Section -->
<section id="vendor" style="display: block;">
    <?php include 'vendors.php'; ?>
</section>

<!-- Product Management Section -->
<section id="product" style="display: none;">
    <?php include 'product.php'; ?>
</section>

</body>
</html>