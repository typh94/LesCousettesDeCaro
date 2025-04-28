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
    $id = $_GET['id'];
 
    // Fetch data
    $sql = "SELECT id, name, description, status, link FROM Tutorial_Inventory WHERE id = ?";  
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $tutorial = $result->fetch_assoc();
    } else {
        // If no ID redirect 
       // header("Location: addtutorialdata.php");  
        exit();
    }
    $stmt->close();
} else {
        // If no ID redirect 
       // header("Location: addtutorialdata.php");  
       exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <section>
        <h1 style="text-align: center;margin: 50px 0;">Edit Tutorial</h1>
        <div class="container">
            <form action="updatetutorial.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($tutorial['id']); ?>">
                <div class="row">
                    <div class="form-group col-lg-2">
                        <label for="">Tutorial Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($tutorial['name']); ?>" required>
                    </div>
                    <div class="form-group  col-lg-3">
                        <label for="">Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="<?php echo htmlspecialchars($tutorial['description']); ?>" required>
                    </div> 
                    
                    <div class="form-group  col-lg-3">
                        <label for="">Link</label>
                        <input type="text" name="link" id="link" class="form-control" value="<?php echo htmlspecialchars($tutorial['link']); ?>" required>
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">Select a Status</option>
                            <option value="started" <?php if ($tutorial['status'] == 'started') echo 'selected'; ?>>Started</option>
                            <option value="not started" <?php if ($tutorial['status'] == 'not started') echo 'selected'; ?>>Not Started</option>
                            <option value="incomplete" <?php if ($tutorial['status'] == 'incomplete') echo 'selected'; ?>>Incomplete</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-2" style="display: grid;align-items:  flex-end;">
                        <button type="submit" name="update" class="btn btn-primary">Update Tutorial</button>
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