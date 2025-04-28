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
    <link href='https://fonts.googleapis.com/css?family=Send Flowers' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Birthstone' rel='stylesheet'>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" href="css/home.css">

    <style>
      #subscribeBox {
        display: none; 
      }
      .subscribe-box {
        position: fixed;
        bottom: 10px;
        right: 20px;
        width: 300px;
        padding: 1em;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: bottom 0.5s ease-in-out;
        z-index: 2000;
      }
      .subscribe-box.visible {
        bottom: 20px;
      }
      .imagefrmt{
        border-radius: 3em;
        max-width: 100%;
        width: 70%;
      }
      .imagefrmt2{
        border-radius: 3em;
        max-width: 100%;
        width: 90%;
        transform: rotate(-1.1turn);

      }
      .straight
      {
        text-align: left;
      }
      .welcomebox{
        text-align: justify;
      }
      .just{
        text-align: justify;

      }
    </style>

    <title>Landing page</title>

  </head>

  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxwU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/subscribeBox.js"></script>
    <script>
      // Show the subscribe box after 2.5 seconds
      setTimeout(() => {
        const subscribeBox = document.getElementById('subscribeBox');
        if (subscribeBox) {
          subscribeBox.style.display = 'block'; // Make the subscribe box visible
        }
      }, 2500);

  
    </script>

    <div class="container-fluid cursiveF">
      <div class="row">
        <div class="col-md-12 header1 cursiveF">
          <img src="images/banner2.png">
        </div>
      </div>
    </div><!-- End container -->

    <nav class="navbar navbar-expand-md navbar-light bg-light whitebag">
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
          <h4 class="titlefont">Welcome Message & Quick Links</h4>
          <br>
          Discover the joy of sewing and creativity with us! Whether you're a seasoned seamstress or just starting to thread your first needle, this is your space to keep track of your creative journey. Add your patterns and fabrics, log your projects, keep track of your favorite tutorials and watch your sewing story unfold. Let’s make something beautiful together—one stitch at a time!
        </div>
        <div class="col-lg-2"></div>
      </div>
    </div><!-- End container -->

    <div class="subscribe-box" id="subscribeBox">
       <form class="form2" id="newsletterForm" action="process_newletter.php" method="POST">
         <!-- Add onclick to ensure the box hides -->
         <button type="button" class="close-btn" id="closeSubscribeBox" onclick="document.getElementById('subscribeBox').style.display='none';">&times;</button>

         <div class="title">Join the Sewing Circle<br><span>sign up to our Newsletter</span></div>
         <div class="input-group">
           <input class="input" name="email" id="email" placeholder="uiverse@verse.io" type="email" autocomplete="off">
           <button class="button-confirm button--submit">Subscribe</button>
         </div>
       </form>
    </div>

    <!-- PHP CODE -->
    <!-- This code connects to the database and retrieves the 4 most recently added products -->
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cousettes";

    // Establish a MySQLi connection
    $mysqli = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Get the 4 most recently added products
    $query = "SELECT * FROM Products ORDER BY date_added DESC LIMIT 3";
    $result = $mysqli->query($query);

    $recently_added_products = [];
    if ($result) {
        $recently_added_products = $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get the total number of products
    $total_products_query = "SELECT COUNT(*) AS total FROM Products";
    $total_products_result = $mysqli->query($total_products_query);
    $total_products = $total_products_result->fetch_assoc()['total'];
    ?>

    <div class="container-fluid">
      <br><br>
      <div class="row">
        <div class="col-lg-12 mainBox">
          <h1 class="titlefont centerit">Recently Added Products <br><br></h1>
          <div class="row paddingproducts">
            <?php foreach ($recently_added_products as $index => $product): ?>
            <div class="col-md-4 mb-4 text-center">
              <a href="index.php?page=product&id=<?=$product['id']?>" class="product d-block">
                <img src="imgs/<?=$product['img']?>" class="img-fluid mb-2" style="max-width: 150px; height: auto;" alt="<?=$product['title']?>">
                <div class="name font-weight-bold"><?=$product['title']?></div>
                <div class="price text-muted">
                  &dollar;<?=$product['price']?>
                </div>
              </a>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div><!-- End container -->

    <!-- END PHP CODE-->
    <br><br>  
    <div class="container-fluid">
      <br><br>
      <div class="row">
      <div class="col-lg-1">
 
        </div>
        <div class="col-lg-3">
        <img  class="imagefrmt2" src="images/byourself2.png">

        </div>
        <div class="col-lg-7 just">

          <h4 class="titlefont">Behind the Needle: My Sewing Journey</h4>
          <br>
          <div>
            My name is Carole, I’m 56 years old, and sewing has always been a part of my life. However, it was during Christmas 2022 that my passion truly took a new turn. On that occasion, my daughter, inspired by the idea of helping me find a new hobby and making gift ideas easier, gave me sewing-related accessories and tools.
            <br>
            Since that day, I’ve fully immersed myself in this world and haven’t left my workshop. With the help of my partner Eric, we built a proper sewing workbench.
          </div>
        </div>
        <div class="col-lg-1">

        </div>
      </div>
    </div><!-- End container -->
    <br><br>  
    <div class="container-fluid">
      <br><br>
      <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-4 mainBox">
          <h4 class="titlefont">TEST</h4>
          <br><br>
          <h5>Check user data DATA _ FOR ADMIN</h5>
          <a href="retrieveUserInfo.php">View User Data</a>
          <a href="index.php/login">login php</a>
          <br><br>
          <a href="login.html">login html</a>
          <a href="index.php?page=products">Products</a>
          <a href="loginRegisterationSystem/register.php">Register</a>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4 mainBox">
          <h4 class="titlefont">Overview Analytics</h4>
          <br>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum pariatur blanditiis dolores, minus dolore repellat, ipsa iusto numquam atque facilis hic ducimus! Dolore eligendi nulla laudantium quisquam? Ea, illo aliquam.
        </div>
        <div class="col-lg-1"></div>
      </div>
    </div><!-- End container -->

    <div class="row text-center">
      <div class="col-lg-4"></div>
      <div class="col-lg-4">
        <br><br><br>
        <a href="#goup" class="goback">back to top</a><br><br>
      </div>
      <div class="col-lg-4"></div>
    </div>

    <div class="container-fluid footerstyle">
      <br><br>
      <div class="row">
      <div class="row ">
          <div class="col-lg-4">
            <img class="imagefrmt"src="images/cousettesdecaro_logoSmall.png">
          </div>
          <div class="col-lg-6 straight">
            Contact Info:<br><br>
            Carole Mercier <br>
            test@yahoo.com<br>
            (111) 222-3333<br><br>


          </div>
          <div class="col-lg-2">
            link to social media
          </div>
        </div>    
        </div><!-- End container -->

        <div class="row text-center">
          <div class="col-lg-12">
               &copy; 2025 Les Cousettes de Caro <br>
          </div>
           
        </div>
      </div>
    </div><!-- End container -->
  </body>
</html>
