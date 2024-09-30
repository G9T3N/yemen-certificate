<?php
session_start();
require 'db.php';

// Fetch all certificates from the database
$result = $conn->query("SELECT * FROM certificates");

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Your custom styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.qrcode.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="text-center">Certificate Dashboard</h2>

                        <!-- Button to navigate to the Add Certificate Page -->
                        <button class="btn btn-success float-end mb-3" onclick="window.location.href='add_certificate.php'">Add New Certificate</button>

                        <!-- Certificate Table -->
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Seat Number</th>
                                    <th>Student Name</th>
                                    <th>Pass/Fail</th>
                                    <th>Percentage</th>
                                    <th>Actions</th>
                                    <th>QRCode</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php while ($row = $result->fetch_assoc()) {
                                    $status = ($row['total_score'] >= 50) ? 'Pass' : 'Fail'; ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['seat_number']; ?></td>
                                        <td><?php echo $row['student_name']; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $row['percentage']; ?>%</td>
                                        <td>
                                            <a href="edit_certificate.php?id=<?php echo $row['id']; ?> " class="btn btn-warning btn-sm"data-id="<?php echo $row['id']; ?>">Edit</a>
                                            <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $row['id']; ?>">Delete</button>
                                        </td>
                                        <td>
                                            <!-- Each QR code div gets a unique ID based on index -->
                                            <div id="qrcode-<?php echo $i; ?>" data-qr-value="<?php echo $row['seat_number']; ?>"></div>
                                            
                                        </td>
                                    </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script> <!-- Your custom JS file -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
<script>$(document).ready(function () {
    // Iterate through each QR code div and generate QR code
    $('[id^="qrcode-"]').each(function () {
        // Get the seat number from the data attribute for each QR code div
        var seatNumber = $(this).data('qr-value');
        
        // Hash the seat number (for demonstration, using Base64 encoding)
        var hashedSeatNumber = btoa(seatNumber); // Base64 encode

        // Generate QR code for each div
        $(this).qrcode({
            text: hashedSeatNumber,
            width: 128,  // QR code width
            height: 128  // QR code height
        });
    });
});
</script>
</body>
</html>
