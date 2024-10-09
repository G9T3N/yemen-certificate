$(document).ready(function() {
    // Handle certificate form submission
   
    // Fetch and display certificates in the table
    // function fetchCertificates() {
    //     $.ajax({
    //         url: 'php/fetch_certificates.php', // The PHP script for fetching certificates
    //         method: 'GET',
    //         success: function(response) {
    //             $('#certificateTableBody').html(response); // Populate the table with certificates
    //         },
    //         error: function() {
    //             alert('Error fetching certificates.');
    //         }
    //     });
    // }

    // // Call fetchCertificates when the page loads
    // fetchCertificates();

    // Delete certificate using event delegation
    $(document).on('click', '.delete-btn', function() {
        var certificateId = $(this).data('id');

        if (confirm('Are you sure you want to delete this certificate?')) {
            $.ajax({
                url: 'php/delete_certificate.php',
                method: 'POST',
                data: { id: certificateId },
                success: function(response) {
                    alert(response); // Show the result message
                    fetchCertificates(); // Reload the certificate list
                },
                error: function() {
                    alert('Error deleting certificate.');
                }
            });
        }
    });
    
    // Separate submit button for adding a certificate without form submission
    // $('#submit-certificate').click(function(e) {
    //     e.preventDefault();

    //     var certificateData = {
    //         seat_number: $('#seat-number').val(),
    //         student_name: $('#student-name').val(),
    //         school: $('#school').val(),
    //         province: $('#province').val(),
    //         school_year: $('#school-year').val(),
    //         quran_score: $('#quran-score').val(),
    //         islamic_score: $('#islamic-score').val(),
    //         arabic_score: $('#arabic-score').val(),
    //         english_score: $('#english-score').val(),
    //         math_score: $('#math-score').val(),
    //         physics_score: $('#physics-score').val(),
    //         chemistry_score: $('#chemistry-score').val(),
    //         biology_score: $('#biology-score').val()
    //     };

    //     $.ajax({
    //         type: 'POST',
    //         url: 'php/submit_certificate.php',
    //         data: certificateData,
    //         success: function(response) {
    //             alert(response); // Alert success or error message
    //             fetchCertificates(); // Reload the certificate list after adding a new certificate
    //         },
    //         error: function(error) {
    //             console.log(error);
    //         }
    //     });
    // });

    

    $('#submit-certificate').click(function(e) {
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
            biology_score: $('#biology-score').val()
        };

        $.ajax({
            type: 'POST',
            url: 'php/submit_certificate.php', // PHP script to handle the request
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
    //   $('.generate-qr').on('click', function() {
      
    // });
});
// $(document).ready(function() {
//     // Submit certificate data via AJAX
  
// });
