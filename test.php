
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

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/js/jquery.qrcode.min.js"></script>
    
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Seat Number</th>
                            <th>Student Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['seat_number']; ?></td>
                                <td><?php echo $row['student_name']; ?></td>
                                <td>
                                    <button class="btn btn-primary btn-sm generate-qr" data-seat-number="<?php echo $row['seat_number']; ?>">Generate QR</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div id="qr-code-container" class="mt-3"></div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('.generate-qr').on('click', function() {
            const seatNumber = $(this).data('seat-number');
            console.log(seatNumber); // Debug log
            $('#qr-code-container').empty();
            $('#qr-code-container').qrcode({
                text: seatNumber,
                width: 128,
                height: 128
            });
        });
    });
    </script>
</body>
</html>
