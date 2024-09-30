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

// Function to generate random names
function randomName() {
    $firstNames = ['Ahmed', 'Mohamed', 'Ali', 'Wael', 'Salem', 'Hassan', 'Omar', 'Yousef', 'Karim', 'Mahmoud'];
    $lastNames = ['Alam', 'Hassan', 'Salem', 'Ali', 'Gamal', 'Nasser', 'Hamad', 'Khaled', 'Osman', 'Fahmy'];
    return $firstNames[array_rand($firstNames)] . ' ' . $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)] . ' ' . $lastNames[array_rand($lastNames)];
}

// Function to generate random scores between 40 and 100 (to introduce fails)
function randomScore() {
    return rand(40, 100); // Some scores below 50 will ensure fails
}

// Function to determine pass/fail based on percentage
function passOrFail($percentage) {
    return $percentage >= 50 ? 'Pass' : 'Fail'; // If percentage >= 50, Pass; else Fail
}

for ($i = 1; $i <= 50; $i++) {
    // Data to be inserted
    $seat_number = 400000 + $i;
    $student_name = randomName();
    $school = "School " . rand(1, 10);
    $province = "Province " . rand(1, 10);
    $school_year = "2023/2024";
    
    // Randomly generated scores
    $quran_score = randomScore();
    $islamic_score = randomScore();
    $arabic_score = randomScore();
    $english_score = randomScore();
    $math_score = randomScore();
    $physics_score = randomScore();
    $chemistry_score = randomScore();
    $biology_score = randomScore();

    // Calculate total score and percentage
    $total_score = $quran_score + $islamic_score + $arabic_score + $english_score + $math_score + $physics_score + $chemistry_score + $biology_score;
    $percentage = ($total_score / 800) * 100; // Total max score is 800

    // Determine pass or fail based on percentage
    $pass_fail = passOrFail($percentage);

    // SQL query to insert the data
    $sql = "INSERT INTO certificates 
            (seat_number, student_name, school, province, school_year, quran_score, islamic_score, arabic_score, english_score, math_score, physics_score, chemistry_score, biology_score, total_score, percentage, pass_fail) 
            VALUES ('$seat_number', '$student_name', '$school', '$province', '$school_year', '$quran_score', '$islamic_score', '$arabic_score', '$english_score', '$math_score', '$physics_score', '$chemistry_score', '$biology_score', '$total_score', '$percentage', '$pass_fail')";

    if ($conn->query($sql) === TRUE) {
        echo "Record $i inserted successfully<br>";
    } else {
        echo "Error inserting record $i: " . $conn->error . "<br>";
    }
}

// Close the connection
$conn->close();

