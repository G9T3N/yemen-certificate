<?php
session_start();
require 'db.php';

// Get the student ID from the query string
$student_id = isset($_GET['id']) ? intval($_GET['id']) : null;

// Fetch the certificate data if ID is available
if ($student_id) {
    $stmt = $conn->prepare("SELECT * FROM certificates WHERE id = ?");
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student_data = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Certificate</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="certificate-container">
        <header>
            <h1>Edit Certificate - Student: <?php echo $student_data['student_name']; ?></h1>
        </header>

        <section class="student-info">
            <p><strong>Seat Number:</strong> 
                <input type="text" id="seat-number" value="<?php echo htmlspecialchars($student_data['seat_number']); ?>">
            </p>
            <p><strong>Student Name:</strong> 
                <input type="text" id="student-name" value="<?php echo htmlspecialchars($student_data['student_name']); ?>">
            </p>
            <p><strong>School:</strong> 
                <input type="text" id="school" value="<?php echo htmlspecialchars($student_data['school']); ?>">
            </p>
            <p><strong>Province:</strong> 
                <input type="text" id="province" value="<?php echo htmlspecialchars($student_data['province']); ?>">
            </p>
            <p><strong>School Year:</strong> 
                <input type="text" id="school-year" value="<?php echo htmlspecialchars($student_data['school_year']); ?>">
            </p>
        </section>

        <table class="subjects-table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Maximum Grade</th>
                    <th>Minimum Grade</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Quran</td>
                    <td>100</td>
                    <td>50</td>
                    <td><input type="number" id="quran-score" value="<?php echo htmlspecialchars($student_data['quran_score']); ?>"></td>
                </tr>
                <tr>
                    <td>Islamic Studies</td>
                    <td>100</td>
                    <td>50</td>
                    <td><input type="number" id="islamic-score" value="<?php echo htmlspecialchars($student_data['islamic_score']); ?>"></td>
                </tr>
                <tr>
                    <td>Arabic</td>
                    <td>100</td>
                    <td>50</td>
                    <td><input type="number" id="arabic-score" value="<?php echo htmlspecialchars($student_data['arabic_score']); ?>"></td>
                </tr>
                <tr>
                    <td>English</td>
                    <td>100</td>
                    <td>50</td>
                    <td><input type="number" id="english-score" value="<?php echo htmlspecialchars($student_data['english_score']); ?>"></td>
                </tr>
                <tr>
                    <td>Math</td>
                    <td>100</td>
                    <td>50</td>
                    <td><input type="number" id="math-score" value="<?php echo htmlspecialchars($student_data['math_score']); ?>"></td>
                </tr>
                <tr>
                    <td>Physics</td>
                    <td>100</td>
                    <td>50</td>
                    <td><input type="number" id="physics-score" value="<?php echo htmlspecialchars($student_data['physics_score']); ?>"></td>
                </tr>
                <tr>
                    <td>Chemistry</td>
                    <td>100</td>
                    <td>50</td>
                    <td><input type="number" id="chemistry-score" value="<?php echo htmlspecialchars($student_data['chemistry_score']); ?>"></td>
                </tr>
                <tr>
                    <td>Biology</td>
                    <td>100</td>
                    <td>50</td>
                    <td><input type="number" id="biology-score" value="<?php echo htmlspecialchars($student_data['biology_score']); ?>"></td>
                </tr>
            </tbody>
        </table>

        <section class="final-result">
            <p><strong>Total Score:</strong> <span id="total-score"><?php echo htmlspecialchars($student_data['total_score']); ?></span></p>
            <p><strong>Result:</strong> <span id="final-result"><?php echo ($student_data['total_score'] >= 50) ? 'Pass' : 'Fail'; ?></span></p>
            <p><strong>Percentage:</strong> <span id="final-percentage"><?php echo htmlspecialchars($student_data['percentage']); ?>%</span></p>
        </section>

        <button id="update-certificate">Update Certificate</button>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
         $(document).ready(function () {
            
            $('#update-certificate').click(function(e) {
                e.preventDefault();
        
                // Collect data from the input fields
                var certificateData = {
                    seat_number: $('#seat-number').val(),
                    student_name: $('#student-name').val(),
                    school: $('#school').val(),
                    province: $('#province').val(),
                    school_year: $('#school-year').val(),
                    quran_score: $('#quran-score').val(),
                    islamic_score: $('#islamic-score').val(),
                    arabic_score: $('#arabic-score').val(),
                    english_score: $('#english-score').val(),
                    math_score: $('#math-score').val(),
                    physics_score: $('#physics-score').val(),
                    chemistry_score: $('#chemistry-score').val(),
                    biology_score: $('#biology-score').val(),
                    student_id:<?echo $student_id;?>
                };
        
                $.ajax({
                    type: 'POST',
                    url: 'php/update_certificate.php', // PHP script to handle the request
                    data: certificateData,
                    success: function(response) {
                        
                        alert(response); // Alert success or error message
                        window.location.href = 'dashboard.php'; // Redirect after update
                    },
                    error: function(error) {
                        console.log(error);
                        alert(toString(error) +"ajax");
                    }
                });
            });
                });
       
    </script>
</body>
</html>
