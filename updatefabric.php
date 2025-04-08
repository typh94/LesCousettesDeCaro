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

if (isset($_POST['update']) && isset($_POST['fabric_id']) && is_numeric($_POST['fabric_id'])) {
    $fabric_id = $_POST['fabric_id']; // Assign fabric_id from POST data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $material = $_POST['material'];
    $stock = $_POST['stock'];

    $sql = "UPDATE Fabric_Inventory SET name = ?, description = ?, material = ? , stock = ? WHERE fabric_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $description, $material, $stock, $fabric_id);

    if ($stmt->execute()) {
        $msg = "Fabric updated successfully!";
    } else {
        $msg = "Error updating fabric: " . $stmt->error;
    }
    echo $msg;
    echo 'hey';
    $stmt->close();

    // Handle image update if a new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $uploadDir = "./images/";
        $folder = $uploadDir . $filename;

        // Move the new uploaded image
        if (move_uploaded_file($tempname, $folder)) {
            // Update the image path in the database
            $sql_image = "UPDATE Fabric_Inventory SET image = ? WHERE fabric_id = ?";
            $stmt_image = $conn->prepare($sql_image);
            $stmt_image->bind_param("si", $filename, $fabric_id);
            $stmt_image->execute();
            $stmt_image->close();
            $msg .= " New image uploaded.";
        } else {
            $msg .= " Failed to upload new image.";
        }
    }

    header("Location: addfabricdata.php?message=" . urlencode($msg)); // Redirect back to your fabric list
    exit();
} else {
    // If the update form wasn't submitted correctly
    header("Location: addfabricdata.php?error=Invalid update request");
    exit();
}

$conn->close();
?>