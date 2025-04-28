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
    $id = $_GET['fabric_id'];
 
    // Fetch data  
    $sql = "SELECT fabric_id, name, description, material, image, stock FROM Fabric_Inventory WHERE fabric_id = ?";  
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $fabric = $result->fetch_assoc();
    } else {
        // If ID is not found, redirect  
        // header("Location: addfabricdata.php");  
        exit();
    }
    $stmt->close();
} else {
    // no valid ID  
   //  header("Location: addfabricdata.php");  
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Fabric</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <section>
        <h1 style="text-align: center;margin: 50px 0;">Edit Fabric</h1>
        <div class="container">
            <form action="updatefabric.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="fabric_id" value="<?php echo htmlspecialchars($fabric['fabric_id']); ?>">
                <div class="row">
                    <div class="form-group col-lg-2">
                        <label for="">Fabric Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($fabric['name']); ?>" required>
                    </div>
                    <div class="form-group  col-lg-2">
                        <label for="">Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="<?php echo htmlspecialchars($fabric['description']); ?>" required>
                    </div>

                    <div class="form-group col-lg-3">
                        <label for=""> Select new image to upload (optional):</label>
                        <input type="file" name="image" id="image">
                        <?php if (!empty($fabric['image'])): ?>
                            <p>Current Image: <img src='./images/<?php echo htmlspecialchars($fabric['image']); ?>' alt='Current Image' width='50'></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group  col-lg-2">
                        <label for="">Material:</label>
                        <select name="material" id="material" class="form-control" required>
                            <option value="">Select a Fiiber</option>
                            <option value="synthetic"<?php if ($fabric['material'] == 'synthetic') echo 'synthetic'; ?>>Synthetic</option>
                            <option value="natural"<?php if ($fabric['material'] == 'natural') echo 'natural'; ?>>Natural</option>
                            <option value="blended"<?php if ($fabric['material'] == 'blended') echo 'blended'; ?>>Blended</option>
                         </select>
                    </div>

                    <div class="form-group  col-lg-1">
                        <label for="">Yardage:</label>
                        <input type="number" name="stock" id="stock" class="form-control" value="<?php echo htmlspecialchars($fabric['stock']); ?>"required>
                    </div>

                    <div class="form-group col-lg-2" style="display: grid;align-items:  flex-end;">
                        <button type="submit" name="update" class="btn btn-primary" >Update Fabric</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
<?php
$conn->close();
?>