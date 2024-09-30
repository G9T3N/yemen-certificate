<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate System - Certificate</title>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Certificate</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="certificate-container">
        <header>
            <h1>بـيــان نتيـــجة الاخــتبارات العــامة</h1>
            <h2>الثالث ثانوي - القسم العلمي</h2>
            <hr>
        </header>

        <section class="student-info">
            <p><strong>رقم الجلوس:</strong> <input type="text" id="seat-number" placeholder="400000 مثال"></p>
          <section>
            <p><strong>الاسم الرباعي:</strong> <input type="text" id="student-name" placeholder="مثال احمد محمد علي حسن"></p>
            <p><strong>المدرسة:</strong> <input type="text" id="school" placeholder="مثال جمال عبد الناصر"></p>
            <p><strong>المديرية/المدينة:</strong> <input type="text" id="province" placeholder=" مثال صنعاء/السبعين "></p>
          </section>
            
            <p><strong>العام الدراسي:</strong> <input type="text" id="school-year" placeholder="مثال 2020/2021"></p>
        </section>

        <table class="subjects-table">
            <thead>
                <tr>
                    <th>المواد الدراسية</th>
                    <th>الدرجة الكبرى<br>Maximum Grades</th>
                    <th>الدرجة الصغرى<br>Minimum Grades</th>
                    <th>الدرجة المستحقة<br>Scores</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>القرآن الكريم</td>
                    <td>100</td>
                    <td>50</td>
                    <td><input type="number" id="quran-score" placeholder="Enter grade" ></td>
                </tr>
                <tr>
                    <td>التربية الإسلامية</td>
                    <td>100</td>
                    <td>50</td>
                    <td><input type="number" id="islamic-score" placeholder="Enter grade" ></td>
                </tr>
                <tr>
                    <td>اللغة العربية</td>
                    <td>100</td>
                    <td>50</td>
                    <td><input type="number" id="arabic-score" placeholder="Enter grade" ></td>
                </tr>
                <tr>
                    <td>اللغة الانجليزية</td>
                    <td>100</td>
                    <td>50</td>
                    <td><input type="number" id="english-score" placeholder="Enter grade" ></td>
                </tr>
                <tr>
                    <td>الرياضيات</td>
                    <td>100</td>
                    <td>50</td>
                    <td><input type="number" id="math-score" placeholder="Enter grade" ></td>
                </tr>
                <tr>
                    <td>الفيزياء</td>
                    <td>100</td>
                    <td>50</td>
                    <td><input type="number" id="physics-score" placeholder="Enter grade" ></td>
                </tr>
                <tr>
                    <td>الكيمياء</td>
                    <td>100</td>
                    <td>50</td>
                    <td><input type="number" id="chemistry-score" placeholder="Enter grade" ></td>
                </tr>
                <tr>
                    <td>الاحياء</td>
                    <td>100</td>
                    <td>50</td>
                    <td><input type="number" id="biology-score" placeholder="Enter grade" ></td>
                </tr>
            </tbody>
            
        </table>

        <section class="final-result">
            <p><strong>المجموع العام:</strong> <span id="total-score">800</span></p>
            <p><strong>النتيجة النهائية:</strong> <span id="final-result">ناجح</span></p>
            <p><strong>المعدل:</strong> <span id="final-percentage">81.25%</span></p>
        </section>

        <footer>
            <p>*ملاحظة: لا يعتبر هذا البيان وثيقة رسمية تغنيك عن الشهادة الاصلية</p>
            <p>© 2021 جميع الحقوق محفوظة للإدارة العامة للاختبارات</p>
        </footer>

        <button id="generate-pdf">Generate PDF</button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="script.js"></script>
</body>
</html>

        