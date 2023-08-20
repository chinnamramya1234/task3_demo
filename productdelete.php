<?php 
    session_start();
    $conn = new mysqli("localhost", "root", "", "task3");

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM product WHERE id='$id'";

        $result = $conn->query($sql);

        if($result == TRUE) {
            //header('Location : display.php');
            echo "Record deleted successfully";
        }else{
            echo "Error: " . $sql . "<br>" .$conn->error;
        }
    }
?>

<!DOCTYPE html>
<html>
<p><a href="display.php">Back to Dashboard</a></p>
</html>

