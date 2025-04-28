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

 // Check  ID is provided in URL 
if (isset($_GET['project_id']) && is_numeric($_GET['project_id'])) {
    $id_to_delete = $_GET['project_id'];
    echo'hey2';

    //  DELETE query
    $sql = "DELETE FROM Project_Inventory WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_to_delete);
    echo'ehy';
    if ($stmt->execute()) {
        $msg = "Project deleted successfully!";
        // add code to delete the matching image file from the 'images' directory here
    } else {
        $msg = "Error deleting project: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();  

    header("Location: addprojectdata.php?message=" . urlencode($msg));  
    exit();
} else {
    // no valid ID  
    header("Location: addprojectdata.php?error=Invalid delete request");
    exit();
}

?>