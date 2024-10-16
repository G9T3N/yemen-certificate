<?php
session_start();
require 'db.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

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
  
</head>
<body>
    <div class="container mt-5">
        <div class="row">
    <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Logout Button -->
                        <h2 class="text-center">Certificate Dashboard</h2>
                        <!-- Button to navigate to the Add Certificate Page -->
                        <button class="btn btn-danger float-end mb-3" onclick="window.location.href='php/logout.php'">Logout</button>
                        <button class="btn btn-success float-start mb-3" onclick="window.location.href='add_certificate.php'">Add New Certificate</button>

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
                                        <td><?php echo $row['pass_fail']; ?></td>
                                        <td><?php echo $row['percentage']; ?>%</td>
                                        <td>
                                            <!-- View Button to see student details -->
                                            <a href="view_certificate.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a>

                                            <!-- View QR Code Button to see QR code in a modal -->
                                            <button class="btn btn-secondary btn-sm view-qr-code" data-id="<?php echo $i; ?>" data-bs-toggle="modal" data-bs-target="#qrModal">View QR-Code</button>

                                            <a href="edit_certificate.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $row['id']; ?>">Delete</button>
                                        </td>
                                        <td>
                                            <!-- Each QR code div gets a unique ID based on index -->
                                            <div id="qrcode-<?php echo $i; ?>" data-qr-value="www.google.com/<?php echo $row['seat_number']; ?>"></div>
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

    <!-- Modal for QR Code Display -->
    <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrModalLabel">QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="modal-qrcode" style="display: inline-block;"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.qrcode.min.js"></script>
    <script src="script.js"></script> <!-- Your custom JS file -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function () {
        // Iterate through each QR code div and generate QR code
        $('[id^="qrcode-"]').each(function () {
            var seatNumber = $(this).data('qr-value');
            $(this).qrcode({
                text: seatNumber,
                width: 128,
                height: 128
            });
        });

        // Handle QR Code modal
        $('.view-qr-code').click(function () {
            var qrId = $(this).data('id');
            var qrValue = $('#qrcode-' + qrId).data('qr-value');
            
            // Clear previous QR code in modal
            $('#modal-qrcode').empty();
            
            // Generate QR code in modal
            $('#modal-qrcode').qrcode({
                text: qrValue,
                width: 200,
                height: 200
            });
        });
    });
    </script>
</body>
</html>
