Last Name : <?php echo htmlspecialchars($_POST['lname']);  ?><br>
First Name : <?php echo htmlspecialchars($_POST['fname']);?><br>
Message : <?php echo htmlspecialchars($_POST['message']);  ?><br>

<?php

// Set your connection variables
//$servername = "DESKTOP-PGED1TP\SQLEXPRESS";
//trying localhost instead, sometiumes works better
$servername = "localhost\SQLEXPRESS";

//$username = "username"; //using windows integrated so not needed
//$password = "password"; //using windows integrated so not needed
$dbname = "cousette";

// Create connection
//$conn = new mysqli($servername,
//    $username, $password, $dbname);
$conn = new mysqli($servername, NULL, NULL, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
}


// Step 1: Insert the user's first and last name into the `userContact` table
$first_name = $_POST["fname"];
$last_name = $_POST["lname"];

// prepare SQL statement to iinserty into userContact table using prepared statement for safety
$sqlContact = "INSERT INTO userContact (first_name, last_name) VALUES (?, ?)";

// Prepare the statement to avoid SQL injection
$stmtContact = $conn->prepare($sqlContact);
$stmtContact->bind_param("ss", $first_name, $last_name); // "ss" means two string parameters

// Execute the query
if ($stmtContact->execute()) {
    echo "User contact record inserted successfully.<br>";
/*
    // Step 2: Get the inserted user's `id` (to reference in the `userMessages` table)
    $user_id = $stmtContact->insert_id; // Get the last inserted `id` from the `userContact` table

    // Step 3: Insert the message into the `userMessages` table
    $message = $_POST['message'];

    // Prepare the SQL statement to insert into the `userMessages` table
    $sqlMessage = "INSERT INTO userMessages (user_id, message) VALUES (?, ?)";
    
    // Prepare the statement to avoid SQL injection
    $stmtMessage = $conn->prepare($sqlMessage);
    $stmtMessage->bind_param("is", $user_id, $message); // "is" means an integer (user_id) and a string (message)

    // Execute the query
    if ($stmtMessage->execute()) {
        echo "Message inserted successfully.<br>";
    } else {
        echo "Error inserting message: " . $stmtMessage->error . "<br>";
    }
        */

} else {
    echo "Error inserting user contact: " . $stmtContact->error . "<br>";
}

// Close the prepared statements and the connection
$stmtContact->close();
//$stmtMessage->close();
$conn->close();

?>