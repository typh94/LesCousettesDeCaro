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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
     $email = $_POST['email'];
 

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO Email_List (email) VALUES (?)");

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $email);

    // Execute the query
    if ($stmt->execute()) {
        // Send confirmation email
        $subject = "Newsletter Subscription Confirmation";
        $message = "Hello,\n\nThank you for subscribing to our newsletter! We're excited to have you on board.\n\nBest regards,\nLes Cousettes De Caro";
        $headers = "From: no-reply@lescousettesdecaro.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "<!DOCTYPE html>";
            echo "<html lang='en'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Submission Successful</title>";
            echo "</head>";
            echo "<body>";
            echo "<h1>$email, you are now signed up for our newsletter!</h1>";
            echo "<p>A confirmation email has been sent to your address.</p>";
            echo "<p><a href='home.php'>Go back home</a></p>";
            echo "</body>";
            echo "</html>";
        } else {
            echo "<!DOCTYPE html>";
            echo "<html lang='en'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Email Sending Error</title>";
            echo "</head>";
            echo "<body>";
            echo "<h1>Subscription successful, but we couldn't send a confirmation email.</h1>";
            echo "<p>Please check your email address or contact support.</p>";
            echo "<p><a href='home.php'>Go back home</a></p>";
            echo "</body>";
            echo "</html>";
        }
    } else {
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Submission Error</title>";
        echo "</head>";
        echo "<body>";
        echo "<h1>Error submitting your message</h1>";
        echo "<p>Error: " . htmlspecialchars($stmt->error) . "</p>";
        echo "<p><a href='newsletter.html'>Try again</a></p>";
        echo "</body>";
        echo "</html>";
    }

    // Close the statement
    $stmt->close();
} else {
    // If the page is accessed directly without a POST request
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Error</title>";
    echo "</head>";
    echo "<body>";
    echo "<h1>Error</h1>";
    echo "<p>This page should be accessed via form submission.</p>";
    echo "<p><a href='home.php'>Go back Home</a></p>";
    echo "</body>";
    echo "</html>";
}

// Close the connection
$conn->close();
?>
