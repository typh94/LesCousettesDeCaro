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
echo'hey';

 // Check if an ID is provided in the URL and is numeric
if (isset($_GET['project_id']) && is_numeric($_GET['project_id'])) {
    $id_to_delete = $_GET['project_id'];
    echo'hey2';

    // Prepare and execute the DELETE query
    $sql = "DELETE FROM Project_Inventory WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_to_delete);
    echo'ehy';
    if ($stmt->execute()) {
        $msg = "Project deleted successfully!";
        // Optionally, you could also delete the associated image file from the 'images' directory here
        // if you want to keep the file system clean.
    } else {
        $msg = "Error deleting project: " . $stmt->error;
    }
    $stmt->close();

    header("Location: addprojectdata.php?message=" . urlencode($msg)); // Redirect back to the inventory page with a message
    exit();
} else {
    // If no valid ID is provided, redirect back to the inventory page with an error
   header("Location: addprojectdata.php?error=Invalid delete request");
    exit();
}

$conn->close();
?>