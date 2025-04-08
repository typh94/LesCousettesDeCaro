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
 
// Check if an ID is provided in the URL and is numeric
if (isset($_GET['fabric_id']) && is_numeric($_GET['fabric_id'])) {
    $id_to_delete = $_GET['fabric_id'];
 
    // Prepare and execute the DELETE query
    $sql = "DELETE FROM Fabric_Inventory WHERE fabric_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_to_delete);
    if ($stmt->execute()) {
        $msg = "Fabric deleted successfully!";
        // Optionally, you could also delete the associated image file from the 'images' directory here
        // if you want to keep the file system clean.
    } else {
        $msg = "Error deleting fabric: " . $stmt->error;
    }
    $stmt->close();
    $conn->close(); // Move this here to ensure the connection is closed before redirecting.

    header("Location: addfabricdata.php?message=" . urlencode($msg)); // Redirect back to the inventory page with a message
    exit();
} else {
    // If no valid ID is provided, redirect back to the inventory page with an error
    header("Location: addfabricdata.php?error=Invalid delete request");
    exit();
}

?>