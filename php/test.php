
<?php

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "certificate_system";

$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


    // Output received POST data
    print_r($_SERVER    ); // This will print the entire POST data received from AJAX
    echo "<pre>";
    print_r($_POST); // This will print the entire POST data received from AJAX
    echo "</pre>";
    echo "else";
    exit(); // Exit to prevent further processing


?>