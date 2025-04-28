<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cousettes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 // Check if ID in URL  
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_to_delete = $_GET['id'];
    echo'hey2';

    //   DELETE query
    $sql = "DELETE FROM Tutorial_Inventory WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_to_delete);
    echo'ehy';
    if ($stmt->execute()) {
        $msg = "Patten deleted successfully!";
        // add code to delete the matching image file from the 'images' directory here
    } else {
        $msg = "Error deleting tutorial: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();  

    header("Location: addtutorialdata.php?message=" . urlencode($msg));  
    exit();
} else {
    // no valid ID  
    header("Location: addtutorialdata.php?error=Invalid delete request");
    exit();
}

?>