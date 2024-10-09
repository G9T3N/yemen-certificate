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
    <title>الإدارة العامة للاختبارات | الرئيسية</title>
    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Mastering Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
               function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //custom-theme -->
    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- font-awesome-icons -->
    <link
        href='assets/fonts/font.css'
        rel='stylesheet' type='text/css'>

    <!-- //font-awesome-icons -->

</head>

<body>


    ﻿

    <body>
        <div class="contact-form  text-center  " lang="ar" dir="rtl">
            <div class="text-center   modal-dialog modal-lg modal-content">

                <div class="row">

                    <div class="col-sm-12 ">
                        <center>
                            <br />
                            <h4 class=""><span>بيان نتيجة الاختبارات العامة</span> </h4>
                            <h4 class="nar" style="margin-top:0px"><span id="lblClass">الثالث ثانوي - القسم
                                    العلمي</span> </h4>
                            <h4 class=""><span>--------------------------------------</span> </h4>
                        </center>
                    </div>

                </div>
                <div class="row">

                    <table class="table" align="center" style="border: 2px solid; width: 96%">
                        <tbody>
                            <tr>
                                <td rowspan="3">
                                    <p>
                                        <b>
                                            رقم الجلوس :
                                            <?php echo htmlspecialchars($student_data['seat_number']); ?>
                                        </b>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <b>
                                            الإسم:

                                            <?php echo htmlspecialchars($student_data['student_name']); ?>
                                        </b>
                                    </p>
                                </td>

                                <td rowspan="3">
                                    <p>
                                        <b>
                                            العام الدراسي:
                                            <?php echo htmlspecialchars($student_data['school_year']); ?>
                                        </b>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>
                                        <b>
                                            المدرسة:
                                            <?php echo htmlspecialchars($student_data['school']); ?>

                                        </b>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>
                                        <b>
                                            المديرية/المدينة:
                                            <?php echo htmlspecialchars($student_data['province']); ?>
                                        </b>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="row">

                    <table class="table  table-responsive  table-bordered" align="center"
                        style="border: 2px solid; width: 96%;">
                        <thead>

                            <tr>
                                <th>
                                    <center>المواد الدراسية</center>
                                </th>
                                <th>
                                    <center>
                                        النهاية الكبرى
                                        <br />maximum grades
                                    </center>
                                </th>
                                <th class=" hidden-xs  ">
                                    <center>
                                        النهاية الصغرى
                                        <br />minimum grades
                                    </center>
                                </th>
                                <th>
                                    <center>
                                        الدرجة المستحقة
                                        <br />scores
                                    </center>
                                </th>
                                <th class="hidden-xs ">
                                    <center>
                                        <h3>SUBJECTS</h3>
                                    </center>
                                </th>
                        </thead>

                        <tbody id="tblResult">

                            <tr>
                                <td align='center'> القرآن الكريم </td>
                                <td align='center'>100</td>
                                <td class='hidden-xs ' align='center'>50</td>
                                <td align='center' class='text-bg-  nowrap'><b><?php echo htmlspecialchars($student_data['quran_score']); ?></b></td>
                                <td class='hidden-xs ' align='center'>Holy Quran</td>
                            </tr>
                            <tr>
                                <td align='center'> التربية الاسلامية </td>
                                <td align='center'>100</td>
                                <td class='hidden-xs ' align='center'>50</td>
                                <td align='center' class='text-bg-  nowrap'><b> <?php echo htmlspecialchars($student_data['islamic_score']); ?></b></td>
                                <td class='hidden-xs ' align='center'>Islamic Education </td>
                            </tr>
                            <tr>
                                <td align='center'> اللغة العربية </td>
                                <td align='center'>100</td>
                                <td class='hidden-xs ' align='center'>50</td>
                                <td align='center' class='text-bg-  nowrap'><b> <?php echo htmlspecialchars($student_data['arabic_score']); ?></b></td>
                                <td class='hidden-xs ' align='center'> Arabic Language</td>
                            </tr>
                            <tr>
                                <td align='center'> اللغة النجليزية </td>
                                <td align='center'>100</td>
                                <td class='hidden-xs ' align='center'>50</td>
                                <td align='center' class='text-bg-  nowrap'><b> <?php echo htmlspecialchars($student_data['english_score']); ?></b></td>
                                <td class='hidden-xs ' align='center'>English Language</td>
                            </tr>
                            <tr>
                                <td align='center'> الرياضيات </td>
                                <td align='center'>100</td>
                                <td class='hidden-xs ' align='center'>50</td>
                                <td align='center' class='text-bg-  nowrap'><b> <?php echo htmlspecialchars($student_data['math_score']); ?></b></td>
                                <td class='hidden-xs ' align='center'>Mathematics</td>
                            </tr>



                            <tr>
                                <td align='center'> الفيزياء </td>
                                <td align='center'>100</td>
                                <td class='hidden-xs ' align='center'>50</td>
                                <td align='center' class='text-bg-  nowrap'><b><?php echo htmlspecialchars($student_data['physics_score']); ?></b></td>
                                <td class='hidden-xs ' align='center'>physics</td>
                            </tr>
                            <tr>
                                <td align='center'> الكيمياء </td>
                                <td align='center'>100</td>
                                <td class='hidden-xs ' align='center'>50</td>
                                <td align='center' class='text-bg-  nowrap'><b><?php echo htmlspecialchars($student_data['chemistry_score']); ?></b></td>
                                <td class='hidden-xs ' align='center'>Chemistry</td>
                            </tr>
                            <tr>
                                <td align='center'> الاحياء </td>
                                <td align='center'>100</td>
                                <td class='hidden-xs ' align='center'>50</td>
                                <td align='center' class='text-bg-  nowrap'><b><?php echo htmlspecialchars($student_data['biology_score']); ?></b></td>
                                <td class='hidden-xs ' align='center'>Biology</td>
                            </tr>
                            <tr>
                                <td align='center'><b>المجموع العام</b> </td>
                                <td align='center'>800</td>
                                <td class='hidden-xs ' align='center'>400</td>
                                <td align='center' class='  nowrap'><b><?php echo htmlspecialchars($student_data['total_score']); ?></b></td>
                                <td class='hidden-xs ' align='center'><b>Total</b></td>
                            </tr>


                        </tbody>
                    </table>
                </div>
                <div style=" padding: 10px; margin-left: 10px; border: 1px solid rgb(3, 144, 131)" align="center">
                    <span>النتيجة النهائية&nbsp; &nbsp; &nbsp;</span>

                    <span style="color:red;" id="lblResult"><b><?php echo htmlspecialchars($student_data['pass_fail']); ?></b></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    المعدل : &nbsp; &nbsp; &nbsp; <span id="lblRate" style="color:red;"><b><?php echo htmlspecialchars($student_data['percentage']); ?> %</b></span>
                </div>
                <center><span style="color:red;"><b>*ملاحظة : </b></span> لا يعتبر هذا البيان وثيقة رسمية تغنيك عن
                    الشهادة الأصلية</center>
                <br />
            </div>
        </div>

        <div class="col-md-12  text-center">

            <p>© 2021 كل الحقوق محفوظة للإدارة العامة للاختبارات </p>
            <br />
        </div>
        <div class="clearfix"> </div>
        </div>

    </body>

</html>


<script type="text/javascript" src="assets/js/jquery-2.1.4.min.js"></script>
<!-- //js -->
<script src="/js/JiSlider.js"></script>
<script>
    $(window).load(function () {
        $('#JiSlider').JiSlider({ color: '#fff', start: 3, reverse: true }).addClass('ff')
    })
</script>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
<!-- stats -->
<script src="/js/jquery.waypoints.min.js"></script>
<script src="/js/jquery.countup.js"></script>
<script>
    $('.counter').countUp();
</script>
<!-- //stats -->
<!-- //footer -->
<!-- flexSlider -->
<script defer src="/js/jquery.flexslider.js"></script>
<script type="text/javascript">
    $(window).load(function () {
        $('.flexslider').flexslider({
            animation: "slide",
            start: function (slider) {
                $('body').removeClass('loading');
            }
        });
    });
</script>
<!-- //flexSlider -->


<script type="text/javascript" src="/js/move-top.js"></script>
<script type="text/javascript" src="/js/easing.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
            event.preventDefault();
            $('html,body').animate({ scrollTop: $(this.hash).offset().top }, 1000);
        });
    });
</script>
<!-- start-smoth-scrolling -->
<!-- for bootstrap working -->
<script src="bootstrap.js"></script>
<!-- //for bootstrap working -->
<!-- here stars scrolling icon -->
<script type="text/javascript">
    $(document).ready(function () {
        /*
            var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
            };
        */

        $().UItoTop({ easingType: 'easeOutQuart' });

    });
</script>
<!-- //here ends scrolling icon -->
</body>

</html>