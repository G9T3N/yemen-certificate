<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "certificate_system";
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID from the POST request
if (isset($_POST['id'])) {
    $certificateId = $_POST['id'];

    // SQL to delete the certificate
    $sql = "DELETE FROM certificates WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $certificateId);

    if ($stmt->execute()) {
        echo "Certificate deleted successfully.";
    } else {
        echo "Error deleting certificate.";
    }

    $stmt->close();
} else {
    echo "No ID provided.";
}

$conn->close();
?>
