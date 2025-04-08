
 
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Import the Composer Autoloader to make the SDK classes accessible:
require 'vendor/autoload.php';

// Load our environment variables from the .env file:
(Dotenv\Dotenv::createImmutable(__DIR__))->load();
echo"hey";

// Now instantiate the Auth0 class with our configuration:
$auth0 = new \Auth0\SDK\Auth0([
    'domain' => $_ENV['AUTH0_DOMAIN'],
    'clientId' => $_ENV['AUTH0_CLIENT_ID'],
    'clientSecret' => $_ENV['AUTH0_CLIENT_SECRET'],
    'cookieSecret' => $_ENV['AUTH0_COOKIE_SECRET']
]);



// Import our router library:
use Steampixel\Route;

// Define route constants:
define('ROUTE_URL_INDEX', rtrim($_ENV['AUTH0_BASE_URL'], '/'));
define('ROUTE_URL_LOGIN', ROUTE_URL_INDEX . '/login');
define('ROUTE_URL_CALLBACK', ROUTE_URL_INDEX . '/callback');
define('ROUTE_URL_LOGOUT', ROUTE_URL_INDEX . '/logout');


Route::add('/', function() use ($auth0) {
    $session = $auth0->getCredentials();

    if ($session === null) {
        echo '<p>Please <a href="' . ROUTE_URL_LOGIN . '">log in</a>.</p>';
        return;
    }

    echo '<pre>';
    print_r($session->user);
    echo '</pre>';
    echo '<p>You can now <a href="/logout">log out</a>.</p>';
});


Route::add('/login', function() use ($auth0) {
  // Clear the user's session to avoid "invalid state" errors
  echo "Login route is working!";

  $auth0->clear();

  // Redirect the user to the Auth0 Universal Login Page
  header("Location: " . $auth0->login(ROUTE_URL_CALLBACK));
  exit;
});

Route::add('/callback', function() use ($auth0) {
    // Have the SDK complete the authentication flow:
    $auth0->exchange(ROUTE_URL_CALLBACK);

    // Finally, redirect our end user back to the / index route, to display their user profile:
    header("Location: " . ROUTE_URL_INDEX);
    exit;
});


Route::add('/logout', function() use ($auth0) {
    // Clear the user's local session with our app, then redirect them to the Auth0 logout endpoint to clear their Auth0 session.
    header("Location: " . $auth0->logout(ROUTE_URL_INDEX));
    exit;
});

// This tells  router that we've finished configuring our routes
//Route::run('/');
Route::run('/LesCousettesDeCaro/');

?>


<?php

session_start();
// Include functions and connect to the database using PDO MySQL
include 'functions.php';
$pdo = pdo_connect_mysql();
// Page is set to home (home.php)
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
// Include and show the requested page
include $page . '.php';

?>
