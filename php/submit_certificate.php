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

// Retrieve form data from POST request
$seat_number = isset($_POST['seat_number']) ? $_POST['seat_number'] : null;
$student_name = isset($_POST['student_name']) ? $_POST['student_name'] : null;
$school = isset($_POST['school']) ? $_POST['school'] : null;
$province = isset($_POST['province']) ? $_POST['province'] : null;
$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : null;
$quran_score = isset($_POST['quran_score']) ? $_POST['quran_score'] : 0;
$islamic_score = isset($_POST['islamic_score']) ? $_POST['islamic_score'] : 0;
$arabic_score = isset($_POST['arabic_score']) ? $_POST['arabic_score'] : 0;
$english_score = isset($_POST['english_score']) ? $_POST['english_score'] : 0;
$math_score = isset($_POST['math_score']) ? $_POST['math_score'] : 0;
$physics_score = isset($_POST['physics_score']) ? $_POST['physics_score'] : 0;
$chemistry_score = isset($_POST['chemistry_score']) ? $_POST['chemistry_score'] : 0;
$biology_score = isset($_POST['biology_score']) ? $_POST['biology_score'] : 0;

// Calculate total score and percentage
$total_score = $quran_score + $islamic_score + $arabic_score + $english_score + $math_score + $physics_score + $chemistry_score + $biology_score;
$percentage = ($total_score / 800) * 100; // Max score 800

// Determine pass or fail
$pass_fail = ($percentage >= 50) ? 'Pass' : 'Fail';

// Prepare SQL query to insert data
$sql = "INSERT INTO certificates 
    (seat_number, student_name, school, province, school_year, 
    quran_score, islamic_score, arabic_score, english_score, 
    math_score, physics_score, chemistry_score, biology_score, 
    total_score, percentage, pass_fail) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare statement
$stmt = $conn->prepare($sql);

// Bind parameters (note: total_score and percentage should be treated as numbers)
$stmt->bind_param("issssiiiiiiiiids", 
    $seat_number, $student_name, $school, $province, $school_year, 
    $quran_score, $islamic_score, $arabic_score, $english_score, 
    $math_score, $physics_score, $chemistry_score, $biology_score, 
    $total_score, $percentage, $pass_fail);

// Execute the prepared statement
if ($stmt->execute()) {
    echo "Certificate added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();

