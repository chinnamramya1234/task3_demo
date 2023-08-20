<?php 
    session_start();
    $conn = new mysqli("localhost", "root", "", "task3");

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM vendor WHERE id='$id'";

        $result = $conn->query($sql);

        if($result == TRUE) {
            //header('Location : display.php');
            echo "Record deleted successfully";
        }else{
            echo "Error: " . $sql . "<br>" .$conn->error;
        }
    }

    // if (isset($_SESSION["username"])) {
    //         $username = $_SESSION["username"];
    //         $sql = "SELECT deletedat FROM users WHERE id = '$id'";
    //         $result = $conn->query($sql);
    //         if ($result->num_rows == 1) {
    //             $row = $result->fetch_assoc();
    //             $username = $row["username"];
    //             $deletedat = $row["deletedat"];
    //             // Update previous_logout timestamp
    //             $update_previous_delete_sql = "UPDATE users SET deletedat = '$deletedat' WHERE username = '$username'";
    //             $conn->query($update_previous_delete_sql);
    //         }
    //     }
?>

<!DOCTYPE html>
<html>
<p><a href="display.php">Back to Dashboard</a></p>
</html>

