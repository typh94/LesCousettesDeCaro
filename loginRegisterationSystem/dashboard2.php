<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Start session and check if the user is logged in
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

$userEmail = $_SESSION['email']; // Fetch logged-in user's email

// Fetch the username associated with the logged-in user's email
$result = $conn->query("SELECT username FROM userdata WHERE email = '$userEmail'");
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
} else {
    $username = "Guest"; // Default value if no username is found
}
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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/button.css" >
    <title>Dashboard page</title>
    <style>
      .header {
        background-color: rgba(0, 255, 255, 0.513);
        padding: 3em;
        font-family: "cursiveF";
        margin-left: -1em;
        margin-right: 100em;
        color: rgb(49, 47, 47);
      }
      h1 {
        text-align: center;
        font-family: cursiveF;
      }
      .marginR {
        margin-right: 1em;
      }
      .container-fluid {
      }
      /*google font*/
      .dancing-script-cursiveF {
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
        font-variation-settings: "wdth" 100;
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
      .bg-light {
        background-color: rgba(0, 255, 255, 0.428) !important;
        box-shadow: 5.4px 10.7px 10.7px hsl(0deg 0% 0% / 0.33);
      }
      .nav-link:hover {
        background-color: white;
        border-radius: 10px;
      }
      .paddingColMd {
        padding-right: 2em;
      }
      .mainBox {
        background-color: rgba(220, 216, 84, 0.554);
        padding: 5em;
        border-radius: 10px;
      }
      .footer {
        background-color: rgba(0, 255, 255, 0.428);
        padding: 3em;
      }
      .contactBox {
        background-color: #8b4dd329;
        padding: 5em;
        border-radius: 10px;
        text-align: center;
        size: 3em;
      }
      .submit {
        background-color: red;
      }
      input {
        background-color: rgba(0, 0, 255, 0.131);
        border: none;
        border-radius: 10px;
        padding: 0.5em;
      }
      .buttonS {
        padding-left: 2em;
        padding-right: 2em;
      }
      .dashboardLayout {
        background-color: rgba(0, 255, 255, 0.428) !important;
        padding: 1em;
        padding-bottom: 25em;
      }
      .check {
        background-color: white;
        padding-bottom: 30em;
        border-radius: 1.5em;      }
      .welcomeMsg {
        background-color: rgba(0, 255, 255, 0.428);
        padding: 1em;
        border-radius: 10px;
      }
      .buttonCreate {
        background-color: white;/*rgba(255, 0, 234, 0.326);*/
        margin: 1em;
        border-radius: 10px;
        padding: 0.5em;
        text-align: center;
      }
      a {
        color: black;
      }
      .bannerfrmt {
        max-width: 100%;
      }
 
  .loader {
    color: rgb(124, 124, 124);
    font-family: "Poppins", sans-serif;
    font-weight: 500;
    font-size: 2em;
    -webkit-box-sizing: content-box;
    box-sizing: content-box;
    height: 50px;
    padding: 10px 10px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    border-radius: 8px;
    max-width: fit-content;
    margin-left: auto;
    margin-right: auto;
  
  }
  

    </style>
        <link rel="stylesheet" href="css/button.css" >

  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJQ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <div class="dashboardLayout">
      <div class="container-fluid  ">
        <div class="row">
          <div class="col-lg-3">
            <br>
            <a href="home.php">
              <img src="images/banner2.png" class="bannerfrmt"><br>
            </a>
            <p>Welcome, <span id="username"><?php echo htmlspecialchars($username); ?></span></p> <!-- Display logged-in user's username -->
            <a href="logout.php" class="btn btn-danger">Logout</a> <!-- Logout button -->
            <br><br><br>
            &#129525; <a href="dashboard.html">Dashboard<br><br></a>
            &#129525; <a href="addprojectdata.php">Projects Portfolio<br><br></a>
            &#129525; <a href="addpatterndata.php">Pattern gallery<br><br></a>
            &#129525; <a href="addtutorialdata.php">Tutorial Organizer<br><br></a>
            &#129525; <a href="addfabricdata.php">Fabric organizer<br><br></a>
            <br><br><br>
            <a href="logout.php">Logout<br><br></a>
          </div>
          <div class="col-lg-9 check">
            <br><br><br><br>
            <div class="row">
              <div class="col-lg-1"></div>
              <div class="col-lg-10"> 


                <div class="card">
                  <div class="loader">
                    <p>Organize</p>
                    <div class="words">
                      <span class="word">projects</span>
                      <span class="word">paterns</span>
                      <span class="word">fabrics</span>
                      <span class="word">tutorials</span>
                    </div>
                  </div>
                </div>
                <br>
 
                <div class="welcomeMsg">
                  <br> Welcome 
                  <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-4">
                        <a href="project_organizer.html">
                          <div class="buttonCreate">Create a project</div>
                        </a>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-4">
                      <div class="buttonCreate">Try a new tutorial</div>
                    </div>
                    <div class="col-lg-1"></div>
                  </div>
                </div>
                <br>
                <div class="welcomeMsg">
                    <br> Started Projects 
                    <div class="row">
                      <div class="col-lg-4"></div>
                      <div class="col-lg-4"></div>
                      <div class="col-lg-4">
                          <a href="addprojectdata.php">
                            <div class="buttonCreate">View all projects</div>
                          </a>
                      </div>
                    </div>
                  </div>  
                  <br>       
                  <div class="welcomeMsg">
                    <br> Add new 
                    <div class="row">
                      <div class="col-lg-3">
                        <a href="tutorial_organizer.html">
                            <div class="buttonCreate">Add a Tutorial</div>
                          </a>
                      </div>
                      <div class="col-lg-3">
                        <a href="pattern_organizer.html">
                            <div class="buttonCreate">Add a Patten</div>
                          </a>
                      </div>
                      <div class="col-lg-3">
                        <a href="fabric_organizer.html">
                            <div class="buttonCreate">Add a fabric</div>
                          </a>
                      </div>
                      <div class="col-lg-3">
                        <a href="project_organizer.html">
                            <div class="buttonCreate">Add a project</div>
                          </a>
                        </div>
                    </div>
                  </div>
                <br>
              </div>
              <div class="col-lg-1"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>