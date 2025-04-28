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
 // Check if ID  in URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
 
    // Fetch data  
    $sql = "SELECT id, name, description, status, image FROM Pattern_Inventory WHERE id = ?";  
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $pattern = $result->fetch_assoc();
    } else {
        // If ID is not found, redirect  
       //  header("Location: addpatterndata.php");  
        exit();
    }
    $stmt->close();
} else {
        // If ID is not found, redirect  
       //  header("Location: addpatterndata.php");  
       exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pattern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <section>
        <h1 style="text-align: center;margin: 50px 0;">Edit Pattern</h1>
        <div class="container">
            <form action="updatepattern.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($pattern['id']); ?>">
                <div class="row">
                    <div class="form-group col-lg-2">
                        <label for="">Pattern Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($pattern['name']); ?>" required>
                    </div>
                    <div class="form-group  col-lg-3">
                        <label for="">Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="<?php echo htmlspecialchars($pattern['description']); ?>" required>
                    </div>

                    <div class="form-group col-lg-3">
                        <label for=""> Select new image to upload (optional):</label>
                        <input type="file" name="image" id="image">
                        <?php if (!empty($pattern['image'])): ?>
                            <p>Current Image: <img src='./images/<?php echo htmlspecialchars($pattern['image']); ?>' alt='Current Image' width='50'></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">Select a Status</option>
                            <option value="started" <?php if ($pattern['status'] == 'started') echo 'selected'; ?>>Started</option>
                            <option value="not started" <?php if ($pattern['status'] == 'not started') echo 'selected'; ?>>Not Started</option>
                            <option value="incomplete" <?php if ($pattern['status'] == 'incomplete') echo 'selected'; ?>>Incomplete</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-2" style="display: grid;align-items:  flex-end;">
                        <button type="submit" name="update" class="btn btn-primary">Update Pattern</button>
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