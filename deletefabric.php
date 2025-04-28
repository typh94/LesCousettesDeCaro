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
if (isset($_GET['fabric_id']) && is_numeric($_GET['fabric_id'])) {
    $id_to_delete = $_GET['fabric_id'];
 
    //  DELETE query
    $sql = "DELETE FROM Fabric_Inventory WHERE fabric_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_to_delete);
    if ($stmt->execute()) {
        $msg = "Fabric deleted successfully!";
        // add code to delete the matching image file from the 'images' directory here
    } else {
        $msg = "Error deleting fabric: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();  

    header("Location: addfabricdata.php?message=" . urlencode($msg));  
    exit();
} else {
    //  no valid ID 
    header("Location: addfabricdata.php?error=Invalid delete request");
    exit();
}

?>