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
// Check if an ID is provided in the URL
if (isset($_GET['project_id']) && is_numeric($_GET['project_id'])) {
    $id = $_GET['project_id'];
    echo' hey2';

    // Fetch the project data based on the ID
    $sql = "SELECT project_id, name, description, status, image FROM Project_Inventory WHERE project_id = ?"; // Assuming primary key is project_id
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $project = $result->fetch_assoc();
    } else {
        // If the ID is not found, redirect back to the inventory page
    //    header("Location: addprojectdata.php"); // Adjust to your inventory page
        exit();
    }
    $stmt->close();
} else {
    // If no valid ID is provided, redirect back to the inventory page
  //  header("Location: addprojectdata.php"); // Adjust to your inventory page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <section>
        <h1 style="text-align: center;margin: 50px 0;">Edit Project</h1>
        <div class="container">
            <form action="updateproject.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($project['project_id']); ?>">
                <div class="row">
                    <div class="form-group col-lg-2">
                        <label for="">Project Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($project['name']); ?>" required>
                    </div>
                    <div class="form-group  col-lg-3">
                        <label for="">Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="<?php echo htmlspecialchars($project['description']); ?>" required>
                    </div>

                    <div class="form-group col-lg-3">
                        <label for=""> Select new image to upload (optional):</label>
                        <input type="file" name="image" id="image">
                        <?php if (!empty($project['image'])): ?>
                            <p>Current Image: <img src='./images/<?php echo htmlspecialchars($project['image']); ?>' alt='Current Image' width='50'></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">Select a Status</option>
                            <option value="started" <?php if ($project['status'] == 'started') echo 'selected'; ?>>Started</option>
                            <option value="not started" <?php if ($project['status'] == 'not started') echo 'selected'; ?>>Not Started</option>
                            <option value="incomplete" <?php if ($project['status'] == 'incomplete') echo 'selected'; ?>>Incomplete</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-2" style="display: grid;align-items:  flex-end;">
                        <button type="submit" name="update" class="btn btn-primary">Update Project</button>
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