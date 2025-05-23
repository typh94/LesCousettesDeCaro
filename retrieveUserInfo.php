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

// Update reply_status if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['answered'])) {
    foreach ($_POST['answered'] as $id) {
        $id = intval($id); // Sanitize input
        $updateQuery = "UPDATE Contact_Info SET reply_status = 1 WHERE contact_id = $id";
        $conn->query($updateQuery);
    }
}

// filter selection
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$whereClause = '';
if ($filter === 'answered') {
    $whereClause = "WHERE reply_status = 1";
} elseif ($filter === 'pending') {
    $whereClause = "WHERE reply_status = 0";
}

// Update the query to include the filter
$sqlContactInfo = "SELECT contact_id, first_name, last_name, message, email, reply_status FROM Contact_Info $whereClause";
$resultContactInfo = $conn->query($sqlContactInfo);

?>

<!doctype html>
<html lang="en">
  <head>
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


    <title>Landing page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <style>
    .styleFont {
    /*  font-family: "Sofia", sans-serif;*/
    font-family: 'Send Flowers';font-size: 3em;
      color: #000080; /*or #008080 or #333333 or #000080*/
    }
    </style>
    
 
    
    <style>
        .header1{
            background-color: rgba(0, 255, 255, 0.428);
            padding: 1em;
            font-family: "cursiveF";
              color: rgb(49, 47, 47);
              text-align: center;
 
        }
        h1{
            text-align: center;
            font-family: cursiveF;
        }
        .marginR{
            margin-right: 1em;
        }
        .container-fluid{
            
        }

        /*google font*/

        .dancing-script-cursiveF{
            font-family: "Dancing Script", cursive;
            font-optical-sizing: auto;
            font-weight: 500;
            font-style: normal;
        }
        .playwrite-hr-lijeva-cursiveF {
            font-family: "Playwrite HR Lijeva", cursive;
            font-optical-sizing: auto;
            font-weight: 300;
            font-style: normal;
        }
        
        .roboto-cursiveF {
            font-family: "Roboto", sans-serif;
            font-optical-sizing: auto;
            font-weight: 236;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
        }
        
        .bruno-ace-sc-regular {
            font-family: "Bruno Ace SC", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        
        .dm-serif-text-regular {
            font-family: "DM Serif Text", serif;
            font-weight: 400;
            font-style: normal;
        }

        .dm-serif-text-regular-italic {
            font-family: "DM Serif Text", serif;
            font-weight: 400;
            font-style: italic;
        }
        
        .dynalight-regular {
            font-family: "Dynalight", cursive;
            font-weight: 400;
            font-style: normal;
        }

        .bg-light{
          background-color: rgba(0, 255, 255, 0.428)!important;
           box-shadow: 5.4px 10.7px 10.7px hsl(0deg 0% 0% / 0.33);

        }
        .nav-link:hover{
          background-color: white;
          border-radius: 10px;
        }
       .paddingColMd{
        padding-right: 2em;
       }
       .mainBox{
        background-color: #a0512d55; /*#FF4500 or rgba(220, 216, 84, 0.554)*/
        padding: 5em;
        border-radius: 10px;
       }
       .footer
       {
        background-color:#00ffff7e ;
        padding: 3em;
 

       }
       .adjust{
        background-color: rgba(255, 0, 0, 0.601);
        padding: 5em;
        border-radius: 10px;
       }
       .imgBox{
        padding: 1em;
        background: white;
        border: 1px solid black;
        margin-right: 1em;
        padding-bottom: 2em;
        
   
         }
        img{
          width: 70%;
          height: 70%;
          object-fit: contain;

         }
      
         .bottom{
          align-items: flex-end;

          }
          .welcomebox{
             padding: 2em;
            border-radius: 10px;
          }
          .titlefont{
            font-family: 'Birthstone';font-size: 2.5em;

          }
          .img-bottom{

            width: 50%;
            height: 50%;
           }
           .footerstyle{
            background-color: rgba(0, 255, 255, 0.428);
            text-align: center;
            padding: 2em;
           }

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
                background-color: #00343a;
                color: white;
                text-align: center;

            }
            table{
              box-shadow: 0 4px 6px rgba(0, 0, 0, 0.22);
            }
            th, td {
                text-align: center;
            }
            .checkbox-cell {
                width: 10%;
            }
            .centerit{
              text-align: center;
              align-items: center;
            }
            button{
                background-color: #00343a!important;
                color: white;
                border: 1px solid #00343a!important;
                padding: 10px 20px!important;
                border-radius: 5px;
                cursor: pointer;
            }
            .leftbox{
              padding-left: 10rem;
            }
    </style>
  </head>

<body>


    <div class="container-fluid ">
        <div class="row">
          <div class="col-md-12 header1 ">
            <img src="images/banner2.png">
          </div>
        </div>
     
      </div><!--End container-->
  
      <nav class="navbar navbar-expand-md navbar-light bg-light">
      
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse navigationHeader" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto center col-md-12">
              <li class="nav-item active col-md-2">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
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
                  <a class="nav-link" href="#">Blog </a>
                </li>
    
                <li class="nav-item col-md-2">
                <a class="nav-link" href="loginRegisterationSystem/dashboard2.php">Dashboard</a>
                </li>
                <li class="nav-item col-md-2">
                  <a class="nav-link" href="store.php">Store </a>
                </li>
    
                <li class="nav-item  ">
                  <a class="nav-link  " href="analysis.php">Analysis </a>
                </li>
            </ul>
         
          </div>
        </nav><br>
     <section>

    <h1>Messages from Contact Form: </h1>
    <div class="text-center  mb-3"> <!-- text-center-->
        <form method="GET" action="">
            <label for="filter">Filter by Reply Status:</label><br>
            <select name="filter" id="filter" onchange="this.form.submit()">
                <option value="all" <?php echo $filter === 'all' ? 'selected' : ''; ?>>All</option>
                <option value="answered" <?php echo $filter === 'answered' ? 'selected' : ''; ?>>Answered</option>
                <option value="pending" <?php echo $filter === 'pending' ? 'selected' : ''; ?>>Pending</option>
            </select>
        </form>
    </div>
    <form method="POST" action="">
        <?php
        if ($resultContactInfo->num_rows > 0) {
            echo "<div class='text-center'>";
            echo "<button type='submit' class='btn btn-primary mt-3'>Update Reply Status</button>";
            echo "</div>";

            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Message</th>";
            echo "<th>Email</th>";
            echo "<th>Reply Status</th>";
            echo "<th>Mark as Answered</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = $resultContactInfo->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["first_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["last_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["message"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>" . ($row["reply_status"] ? "Answered" : "Pending") . "</td>";
                echo "<td class='checkbox-cell'>";
                if (!$row["reply_status"]) {
                    echo "<input type='checkbox' name='answered[]' value='" . $row["contact_id"] . "'>";
                }
                echo "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No user information found in Contact Info.</p>";
        }
        ?>
    </form>

   
</body>
<!-- Required JavaScript for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</html>
<?php
// Close the connection  
$conn->close();
?>
