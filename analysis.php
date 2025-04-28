<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=DM+Serif+Text:ital@0;1&family=Dancing+Script:wght@500&family=Dynalight&family=Playwrite+HR+Lijeva:wght@300&family=Roboto:wght@236&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Send+Flowers" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Birthstone" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Analysis page</title>

    <style>
      .styleFont {
        font-family: 'Send Flowers';
        font-size: 3em;
        color: #000080; /* or #008080 or #333333 or #000080 */
      }

      .header1 {
        background-color: rgba(0, 255, 255, 0.428);
        padding: 3em;
        font-family: "cursiveF";
        color: rgb(49, 47, 47);
        height: fit-content;
        text-align: center;
      }

      .header1 img {
        width: 70%;
        height: 70%;
      }

      h1 {
        text-align: center;
        font-family: cursiveF;
      }

      .marginR {
        margin-right: 1em;
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
        background-color: #a0512d55; /* #FF4500 or rgba(220, 216, 84, 0.554) */
        padding: 5em;
        border-radius: 10px;
      }

      .footer {
        background-color: #00ffff7e;
        padding: 3em;
      }

      .adjust {
        background-color: rgba(255, 0, 0, 0.601);
        padding: 5em;
        border-radius: 10px;
      }

      .imgBox {
        padding: 1em;
        background: white;
        border: 1px solid black;
        margin-right: 1em;
        padding-bottom: 2em;
      }

      img {
        width: 90%;
        height: 90%;
        object-fit: contain;
      }

      .bottom {
        align-items: flex-end;
      }

      .welcomebox {
        padding: 2em;
        border-radius: 10px;
      }

      .titlefont {
        font-family: 'Birthstone';
        font-size: 2.5em;
      }

      .img-bottom {
        width: 50%;
        height: 50%;
      }

      .footerstyle {
        background-color: rgba(0, 255, 255, 0.428);
        text-align: center;
        padding: 2em;
      }
    </style>
  </head>

  <body>
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7w3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <div class="container-fluid cursiveF">
      <div class="row">
        <div class="col-md-12 header1 cursiveF">
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
          <a class="nav-link" href="loginRegisterationSystem/login.php">Dashboard</a>
          </li>
          <li class="nav-item col-md-2">
            <a class="nav-link" href="store.php">Store</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="analysis.php">Analysis</a>
          </li>
        </ul>
      </div>
    </nav>

    <br>
    <div id="goup"></div>

    <div class="container-fluid">
      <br><br>
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 welcomebox">
          <h4 class="titlefont">Analysis Overview</h4>
          <br>
          On this page, you will find insightful data visualizations and trends analysis to help you understand key patterns and metrics.
          Explore the Google Trends graph and other analytical tools to gain valuable insights.
          <br><br>
        </div>
        <div class="col-lg-2"></div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 text-center">
          <?php
          ob_start();

          // Path to the Python script
          $pythonScript = '/Applications/XAMPP/xamppfiles/htdocs/LesCousettesDeCaro/test3.py';

          // Execute the Python script
          $output = shell_exec("python3 $pythonScript 2>&1");

          // Display the generated graph
          $graphPath = 'trends_graph.png';
          if (file_exists($graphPath)) {
            echo "<h3>Google Trends Graph: </h3>";
            echo "<div style='overflow: auto; padding: 1em; background-color: #f9f9f9; border: 1px solid #ddd;'>";
            echo "<img src='$graphPath' alt='Google Trends Graph' style='max-width: 100%; width: 50%;'>";
            echo "</div>";
          } else {
            echo "<p>Graph not found. Please check if the Python script ran successfully.</p>";
          }

          ob_end_flush();
          ?>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <br><br>
      <div class="row footerstyle">
        <div class="col-lg-4">
          <img src="images/banner2.png">
        </div>
        <div class="col-lg-6">
          Contact Info
        </div>
        <div class="col-lg-2">
          Link to social media
        </div>
      </div>
    </div>
  </body>
</html>