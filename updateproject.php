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

if (isset($_POST['update']) && isset($_POST['project_id']) && is_numeric($_POST['project_id'])) {
    $project_id = $_POST['project_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $sql = "UPDATE Project_Inventory SET name = ?, description = ?, status = ? WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $description, $status, $project_id);

    if ($stmt->execute()) {
        $msg = "Project updated successfully!";
    } else {
        $msg = "Error updating project: " . $stmt->error;
    }
    $stmt->close();

    // Handle image update if a new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $uploadDir = "./images/";
        $folder = $uploadDir . $filename;

        // Move the new uploaded image
        if (move_uploaded_file($tempname, $folder)) {
            // Update image path  
            $sql_image = "UPDATE Project_Inventory SET image = ? WHERE project_id = ?";
            $stmt_image = $conn->prepare($sql_image);
            $stmt_image->bind_param("si", $filename, $project_id);
            $stmt_image->execute();
            $stmt_image->close();
            $msg .= " New image uploaded.";
        } else {
            $msg .= " Failed to upload new image.";
        }
    }

    header("Location: addprojectdata.php?message=" . urlencode($msg));  
    exit();
} else {
    // If the update form wasn't submitted correctly
    header("Location: addprojectdata.php?error=Invalid update request");
    exit();
}

$conn->close();
?>