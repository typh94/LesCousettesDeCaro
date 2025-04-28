<?php
// Path to the Python script
$pythonScript = '/Applications/XAMPP/xamppfiles/htdocs/LesCousettesDeCaro/test3.py';

// Execute the Python script
$output = shell_exec("python3 $pythonScript 2>&1");

// Debugging: Display the output of the Python script
//echo "<pre>$output</pre>";

// Display the generated graph
$graphPath = 'trends_graph.png';
if (file_exists($graphPath)) {
    echo "<h3>Google Trends Graph: </h3>";
    echo "<img src='$graphPath' alt='Google Trends Graph' style='max-width: 100%; height: auto;'>";
} else {
    echo "<p>Graph not found. Please check if the Python script ran successfully.</p>";
}
?>