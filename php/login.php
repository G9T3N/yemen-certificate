<?php
session_start();

$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "certificate_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prevent SQL Injection
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Query the database for the user
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Verify password (Assuming passwords are hashed)
        if ($password== $user['password']) {
            $_SESSION['username'] = $username;
            header('Location:dashboard.php'); // Redirect to certificate generation
            exit();
        } else {
            echo '<p class="message">Invalid password!</p>';
        }
    } else {
        echo '<p class="message">No user found with that username!</p>';
    }
}

$conn->close();
