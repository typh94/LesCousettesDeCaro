<?php
include 'db_connection.php';
session_start();

$message = "";
$toastClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email exists
    $stmt = $conn->prepare("SELECT password FROM userdata WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the entered password with the hashed password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['email'] = $email;

            // Redirect to dashboard
            header("Location: dashboard2.php");
            exit();
        } else {
            $message = "Invalid password. Please try again.";
            $toastClass = "bg-danger";
        }
    } else {
        $message = "No account found with this email.";
        $toastClass = "bg-warning";
    }

    $stmt->close();
    $conn->close();
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
  
 
  <link href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="shortcut icon" href=
"https://cdn-icons-png.flaticon.com/512/295/295128.png">
    <script src=
"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/login.css">
    <title>Login Page</title>
  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/buttonNewsletter.css">

    <title>Newsletter page</title>

  
    
    <style>
        .header{
            background-color: rgba(0, 255, 255, 0.513);
            padding: 3em;
            font-family: "cursiveF";
            margin-left: -1em;
            margin-right: 100em;
            color: rgb(49, 47, 47);
        } 
        .header1{
    height: fit-content;
 
} 
.title {
  color: var(--font-color);
  font-weight: 900;
  font-size: 20px;
  margin-bottom: 25px;
}

.title span {
  color: var(--font-color-sub);
  font-weight: 600;
  font-size: 17px;
}

.input {
  width: 250px;
  height: 40px;
  border-radius: 5px;
  border: 2px solid var(--main-color);
  background-color: var(--bg-color);
  box-shadow: 4px 4px var(--main-color);
  font-size: 15px;
  font-weight: 600;
  color: var(--font-color);
  padding: 5px 10px;
  outline: none;
  margin: .5em;
  margin-top:2em;
}

.input::placeholder {
  color: var(--font-color-sub);
  opacity: 0.8;
}

.input:focus {
  border: 2px solid var(--input-focus);
}
 

.button-log:active, .button-confirm:active {
  box-shadow: 0px 0px var(--main-color);
  transform: translate(3px, 3px);
}

.button-confirm {
  margin: 50px auto 0 auto;
  width: 120px;
  height: 40px;
  border-radius: 5px;
  border: 2px solid var(--main-color);
  background-color: var(--bg-color);
  box-shadow: 4px 4px var(--main-color);
  font-size: 17px;
  font-weight: 600;
  color: var(--font-color);
  cursor: pointer;
}

.body{
    background-color: white;
}




/*
 form  
*/
.container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  text-align: center;
}

.form_area {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background-color:rgba(237, 220, 217, 0.69);
  height: auto;
  width: auto;
  border: 2px solid #264143;
  border-radius: 20px;
  box-shadow: 3px 4px 0px 1px rgba(233, 160, 76, 0.61);
}

.title {
  color: #264143;
  font-weight: 900;
  font-size: 1.5em;
  margin-top: 20px;
}

.sub_title {
  font-weight: 600;
  margin: 5px 0;
}

.form_group {
  display: flex;
  flex-direction: column;
  align-items: baseline;
  margin: 10px;
}

.form_style {
  outline: none;
  border: 2px solid #264143;
  box-shadow: 3px 4px 0px 1px rgba(233, 160, 76, 0.61);
  width: 290px;
  padding: 12px 10px;
  border-radius: 4px;
  font-size: 15px;
}

.form_style:focus, .btn:focus {
  transform: translateY(4px);
  box-shadow: 1px 2px 0px 0px  rgba(233, 160, 76, 0.61);
}

.btn {
  padding: 15px;
  margin: 25px 0px;
  width: 290px;
  font-size: 15px;
  background:rgba(0, 255, 255, 0.29);
  border-radius: 10px;
  font-weight: 800;
  box-shadow: 3px 3px 0px 0px #E99F4C;
}

.btn:hover {
  opacity: .9;
}

.link {
  font-weight: 800;
  color: #264143;
  padding: 5px;
}
input{
    background-color: rgba(0, 255, 255, 0.29);
}

    </style>

  
  </head>




<body class=" ">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9Q+Y1QKtv3Rn7W3mgPxQ4U9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 

    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12 header1">
              <img src="images/banner2.png">
          </div>
      </div>
  </div>
  <!-- End container -->  
   
  <nav class="navbar navbar-expand-md navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse navigationHeader" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto center col-md-12">
          <li class="nav-item active col-md-2">
            <a class="nav-link" href="../home.php">Home  </a>
          </li>
          <li class="nav-item dropdown col-md-2">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Get in touch
            </a>
            <div class="dropdown-menu col-md-2" aria-labelledby="navbarDropdown">
              <a class="dropdown-item marginR" href="../contact.html">Contact</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="../newsletter.html">Newsletter</a>
            </div>
          </li>
          <li class="nav-item col-md-2">
            <a class="nav-link" href="#">Blog</a>
          </li>
          <li class="nav-item col-md-2">
            <a class="nav-link" href="dashboard2.html">Dashboard</a>
          </li>
          <li class="nav-item col-md-2">
            <a class="nav-link" href="../store.php">Store</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../analysis.php">Analysis</a>
          </li>
        </ul>
      </div>
    </nav>
    <br>


   <div class="container p-5 d-flex flex-column align-items-center">
        <?php if ($message): ?>
            <div class="toast align-items-center text-white 
            <?php echo $toastClass; ?> border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?php echo $message; ?>
                    </div>
                    <button type="button" class="btn-close
                    btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>



        <div class="container">
    <div class="form_area">
        <p class="title">LOGIN</p>
        <form action="" method="post">
            <div class="form_group">
                <label class="sub_title" for="email">Email</label>
                <input placeholder="Enter your email" id="email" name="email" class="form_style" type="email" required>
            </div>
            <div class="form_group">
                <label class="sub_title" for="password">Password</label>
                <input placeholder="Enter your password" id="password" name="password" class="form_style" type="password" required>
            </div>
            <div>
                <button type="submit" class="btn">Login</button>
                <p>Have an Account? <a class="link" href="./register.php">Register Here!</a><br>
                   Forgot Password? <a class="link" href="./resetpassword.php">Reset Password!
            </p >
            </div>
        </form>
    </div>
</div>




    </div>
    <script>
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl, { delay: 3000 });
        });
        toastList.forEach(toast => toast.show());
    </script>
</body>

</html>
