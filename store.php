<?php
require 'functions.php';
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cousettes";
 
// The amounts of products to show on each page
$num_products_on_each_page = 4;
 
// The current page in the URL
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
 
// Create a new mysqli connection
$pdo = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($pdo->connect_error) {
    die('Connection failed: ' . $pdo->connect_error);
}

//  SQL statement
$stmt = $pdo->prepare('SELECT * FROM Products ORDER BY date_added DESC LIMIT ?, ?');
 
// Check if the connection was successful
if (!$stmt) {
    die('Prepare failed: ' . $pdo->error);
}

// Calculate the offset for pagination
$offset = ($current_page - 1) * $num_products_on_each_page;

// Bind the parameters  
$stmt->bind_param('ii', $offset, $num_products_on_each_page);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the products  
$products = $result->fetch_all(MYSQLI_ASSOC);
 
// Get the total number of products
$total_products_result = $pdo->query('SELECT COUNT(*) AS total FROM Products');
$total_products_row = $total_products_result->fetch_assoc();
$total_products = $total_products_row['total'];
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
    <link href='https://fonts.googleapis.com/css?family=Indie Flower' rel='stylesheet'>

    <title>Landing page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link href="style.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

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
            padding: 3em;
            font-family: "cursiveF";
              color: rgb(49, 47, 47);
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
        .itembox{
          background-color: white; /*#FF4500 or rgba(220, 216, 84, 0.554)*/
          padding: 5em;
          border-radius: 10px;
          margin-right: 1.5em;
          border: 0.7px solid rgba(0, 0, 0, 0.65);

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
        .imgcntainer{
          
    
          }
          img{
            width: 90%;
            height: 90%;
            object-fit: contain;
           }
        
          .bottom{
            align-items: flex-end;

            }
            .whitebox{
              background-color: white;
              margin-right: 0.3;
            }
            .shadow {
              border: 1px solid;
              padding: 10px;
              box-shadow:    2px 5px 8px rgba(0, 0, 0, 0.232)
            }
            .itemname{
                font-family: 'Indie Flower';font-size: 22px;
                text-align: center;

            }
            .cartbox{
                padding: 0.5em;
                margin-top: 0.5em;
                display: block;
              margin-left:auto;
              margin-right: auto;
              text-align: center;

                
            }
            .centerit
            {
                display: block;

              margin-left: auto;
              margin-right: auto;

            }
            .product{
              max-width: 100%;
              width: 50%;
            }
            .header1{
                height: fit-content;
                text-align: center;
                padding: 1em;
            }
            .header1 img{

              width: 70%;
              height: 70%;            
            }        
            .header1 img:hover{
              transform: scale(1.05);
              transition: transform 0.3s ease-in-out;
            }
    </style>


<style>
  
</style>
  </head>


  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 

    <div class="container-fluid  ">
      <div class="row">
        <div class="col-md-12 header1   ">
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
                <a class="nav-link" href="#">Blog </a>
              </li>
  
              <li class="nav-item col-md-2">
              <a class="nav-link" href="loginRegisterationSystem/login.php">Dashboard</a>
              </li>
              <li class="nav-item col-md-2">
                <a class="nav-link" href="store.php">Store </a>
              </li>
  
              <li class="nav-item  ">
                <a class="nav-link  " href="analysis.php">Analysis </a>
              </li>
          </ul>
        </div>
      </nav>
      
      <br>
      <div id="goup"></div>


      <div class="products content-wrapper">
    <h1>Products</h1>
    <p><?=$total_products?> Products</p>
    <div class="container">
        <div class="row">
            <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                        <img class="card-img-top" src="imgs/<?=$product['img']?>" alt="<?=$product['title']?>">
                    <div class="card-body text-center">
                    <a href="index.php?page=product&id=<?=$product['id']?>">

                        <h5 class="card-title"><?=$product['title']?></h5>
                        </a>

                        <p class="card-text">
                            &dollar;<?=$product['price']?>
                            <?php if ($product['rrp'] > 0): ?>
                            <span class="text-muted"><s>&dollar;<?=$product['rrp']?></s></span>
                            <?php endif; ?>
                        </p>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="buttons text-center">
        <?php if ($current_page > 1): ?>
        <a href="index.php?page=products&p=<?=$current_page-1?>" class="btn btn-primary">Prev</a>
        <?php endif; ?>
        <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
        <a href="index.php?page=products&p=<?=$current_page+1?>" class="btn btn-primary">Next</a>
        <?php endif; ?>
    </div>
</div>



<div class="row text-center">
  <div class="col-lg-4  "></div>
   <div class=" col-lg-4 ">    
    <br><br>
      <a href="#goup" class="goback">back to top</a><br>
  </div>
  <div class="col-lg-4"></div>

</div>

<div class="container-fluid  ">
  <br>    <br>

  <div class="row footer ">
       
      <div class="col-lg-2">
        logo
      </div> 
      <div class="col-lg-8">
        Les Cousettes de Caro<br>
        Contact Info

      </div>
      <div class="col-lg-2">
        link to social media
      </div>
     
  </div>
</div><!--End container-->

 
</body>
</html>