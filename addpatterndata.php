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

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $pic = $_FILES["image"]["name"];

    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "./images/" . $filename;

    if ($name != "" && $description != "") {
         $sql = "INSERT INTO Pattern_Inventory (`name`, `description`, `image`, `status`) VALUES ('$name', '$description', '$pic', '$status')";
        if (mysqli_query($conn, $sql)) {
            echo ' ';
        } else {
            echo "Something went wrong. Please try again later.";
        }
    } else {
        echo "Name, description and status cannot be empty!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Pattern Inventory</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--goog font--> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=DM+Serif+Text:ital@0;1&family=Dancing+Script:wght@500&family=Dynalight&family=Playwrite+HR+Lijeva:wght@300&family=Roboto:wght@236&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Send Flowers' rel='stylesheet'>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Birthstone' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

       <!-- External CSS -->
    <link rel="stylesheet" href="layout.css">

    <title>Pattern page overview</title>
    <style>
  
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 header1">
                <img src="images/banner2.png">
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse navigationHeader" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto center col-md-12">
                <li class="nav-item active col-md-2">
                    <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown col-md-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Get in touch
                    </a>
                    <div class="dropdown-menu col-md-2" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item marginR" href="contact.html">Contact</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="newsletter.html">Newsletter</a>
                    </div>
                </li>
                <li class="nav-item col-md-2">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item col-md-2">
                    <a class="nav-link" href="dashboard.html">Dashboard</a>
                </li>
                <li class="nav-item col-md-2">
                    <a class="nav-link" href="store.html">Store</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="analysis.html">Analysis</a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <h1>Pattern Inventory</h1>
    <h3><a href="pattern_organizer.html">add a pattern</a></h3><br><br>
    <div class="filterbox">
        <form method="GET" action="">
            <label for="filter_status">Filter by Status:</label>
            <select name="filter_status" id="filter_status">
                <option value="">All Statuses</option>
                <option value="started" <?php if (isset($_GET['filter_status']) && $_GET['filter_status'] == 'started') echo 'selected'; ?>>Started</option>
                <option value="not started" <?php if (isset($_GET['filter_status']) && $_GET['filter_status'] == 'not started') echo 'selected'; ?>>Not Started</option>
                <option value="incomplete" <?php if (isset($_GET['filter_status']) && $_GET['filter_status'] == 'incomplete') echo 'selected'; ?>>Incomplete</option>
            </select>
            <label for="filter_name" style="margin-left: 20px;">Filter by Name:</label>
            <input type="text" name="filter_name" id="filter_name" value="<?php echo isset($_GET['filter_name']) ? htmlspecialchars($_GET['filter_name']) : ''; ?>" placeholder="Enter pattern name">
            <button type="submit" class="btn btn-secondary btn-sm" style="margin-left: 10px;">Filter</button>
            <?php if (isset($_GET['filter_status']) || isset($_GET['filter_name'])): ?>
                <a href="addpatterndata.php" class="btn btn-secondary btn-sm" style="margin-left: 10px;">Clear Filter</a>
            <?php endif; ?>
        </form>
    </div>
    <br>
    <div id="goup"></div>
    <?php
    $filter_status = isset($_GET['filter_status']) ? $_GET['filter_status'] : '';
    $filter_name = isset($_GET['filter_name']) ? $_GET['filter_name'] : '';

    $sqlContactInfo = "SELECT id, name, description, status, image FROM Pattern_Inventory WHERE 1=1";

    if (!empty($filter_status)) {
        $sqlContactInfo .= " AND status = '" . $conn->real_escape_string($filter_status) . "'";
    }

    if (!empty($filter_name)) {
        $sqlContactInfo .= " AND name LIKE '%" . $conn->real_escape_string($filter_name) . "%'";
    }

    $resultContactInfo = $conn->query($sqlContactInfo);

    if ($resultContactInfo->num_rows > 0) {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Pattern Name</th>";
        echo "<th>Description</th>";
        echo "<th>Picture</th>";
        echo "<th>Status</th>";
        echo "<th>Actions</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = $resultContactInfo->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
            echo "<td>";
            if (!empty($row["image"])) {
                echo "<img src='./images/" . htmlspecialchars($row["image"]) . "' alt='" . htmlspecialchars($row["name"]) . "' width='100'>";
            } else {
                echo "";
            }
            echo "</td>";
            if (!empty($row["status"])) {
                echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
            } else {
                echo "";
            }
            echo "</td>";
            echo "<td>";
            echo "<a href='editpattern.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-primary btn-sm me-2'>Edit</a>";
            echo "<a href='deletepattern.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this pattern?\");'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No user information found in Contact Info.</p>";
    }
    ?>
</body>
</html>
<?php
$conn->close();
?>
