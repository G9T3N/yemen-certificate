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


    // Collect data from the POST request sent by AJAX
    $seat_number = isset($_POST['seat_number']) ? $_POST['seat_number'] : 0;
    $student_name = isset($_POST['student_name']) ? $_POST['student_name'] : '';
    $school = isset($_POST['school']) ? $_POST['school'] : '';
    $province = isset($_POST['province']) ? $_POST['province'] : '';    
    $school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
    $quran_score = isset($_POST['quran_score']) ? $_POST['quran_score'] : 0;
    $islamic_score = isset($_POST['islamic_score']) ? $_POST['islamic_score'] : 0;
    $arabic_score = isset($_POST['arabic_score']) ? $_POST['arabic_score'] : 0;
    $english_score = isset($_POST['english_score']) ? $_POST['english_score'] : 0;
    $math_score = isset($_POST['math_score']) ? $_POST['math_score'] : 0;
    $physics_score = isset($_POST['physics_score']) ? $_POST['physics_score'] : 0;
    $chemistry_score = isset($_POST['chemistry_score']) ? $_POST['chemistry_score'] : 0;
    $biology_score = isset($_POST['biology_score']) ? $_POST['biology_score'] : 0;
    $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : 0;

// Calculate total score and percentage
$total_score = $quran_score + $islamic_score + $arabic_score + $english_score + $math_score + $physics_score + $chemistry_score + $biology_score;
$percentage = ($total_score / 800) * 100; // Max score is 800

// Determine pass or fail
$pass_fail = ($percentage >= 50) ? 'Pass' : 'Fail';

// Prepare SQL query to update data
$sql ="UPDATE `certificates` SET `seat_number`=?,
`student_name`=?,`school`=?,`province`=?,`school_year`=?,
`quran_score`=?,`islamic_score`=?,`arabic_score`=?,`english_score`=?,
`math_score`=?,`physics_score`=?,`chemistry_score`=?,
`biology_score`=?,`total_score`=?,`percentage`=?,`pass_fail`=? WHERE id=?
";
// Prepare statement
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
    exit();
}

// Bind parameters (seat_number is treated as string, total_score and percentage are numbers)
$stmt->bind_param("issssiiiiiiiiidsi", 
    $seat_number, $student_name, $school, $province, $school_year, 
    $quran_score, $islamic_score, $arabic_score, $english_score, 
    $math_score, $physics_score, $chemistry_score, $biology_score, 
    $total_score, $percentage, $pass_fail, $student_id);
    
// Execute the prepared statement
if ($stmt->execute()) {
    
    echo "Student No. $seat_number Certificate updated successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();

$conn->close();
?>
