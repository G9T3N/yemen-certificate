document.addEventListener('DOMContentLoaded', function() {
    const subjects = [
        { id: 'quran-score', max: 100 },
        { id: 'islamic-score', max: 100 },
        { id: 'arabic-score', max: 100 },
        { id: 'english-score', max: 100 },
        { id: 'math-score', max: 100 },
        { id: 'physics-score', max: 100 },
        { id: 'chemistry-score', max: 100 },
        { id: 'biology-score', max: 100 }
    ];

    const totalScoreElement = document.getElementById('total-score');
    const percentageElement = document.getElementById('final-percentage');
    const finalResultElement = document.getElementById('final-result');

    subjects.forEach(subject => {
        document.getElementById(subject.id).addEventListener('input', updateScores);
    });

    function updateScores() {
        let totalScore = 0;
        const maxTotal = subjects.length * 100;

        subjects.forEach(subject => {
            const scoreInput = document.getElementById(subject.id);
            let score = parseFloat(scoreInput.value) || 0;

            // Ensure the score is between 0 and 100
            if (score < 0) score = 0;
            if (score > 100) score = 100;

            // Update the input value if it's out of bounds
            scoreInput.value = score;

            totalScore += score;
        });

        const finalPercentage = ((totalScore / maxTotal) * 100).toFixed(2);
        const finalResult = finalPercentage >= 50 ? "ناجح" : "راسب";

        // Update the DOM
        totalScoreElement.textContent = totalScore;
        percentageElement.textContent = `${finalPercentage}%`;
        finalResultElement.textContent = finalResult;
    }

    // PDF Generation
    document.getElementById('generate-pdf').addEventListener('click', function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Arabic custom font example
        doc.addFont('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/fonts/NotoSans-Regular.ttf', 'NotoSansArabic', 'normal');
        doc.setFont('NotoSansArabic');
        doc.setFontSize(12);

        // Title and header
        doc.text("بـيــان نتيـــجة الاخــتبارات العــامة", 60, 10);
        doc.text("الثالث ثانوي - القسم العلمي", 70, 20);
        doc.text("---------------------------------------------------", 60, 25);

        // Student Info Section
        const seatNumber = document.getElementById('seat-number').value;
        const studentName = document.getElementById('student-name').value;
        const school = document.getElementById('school').value;
        const province = document.getElementById('province').value;
        const schoolYear = document.getElementById('school-year').value;

        doc.text(`رقم الجلوس: ${seatNumber}`, 140, 40);
        doc.text(`الاسم: ${studentName}`, 140, 50);
        doc.text(`المدرسة: ${school}`, 140, 60);
        doc.text(`المديرية/المدينة: ${province}`, 140, 70);
        doc.text(`العام الدراسي: ${schoolYear}`, 140, 80);

        // Subjects and Scores
        doc.text('المواد الدراسية', 160, 100);
        doc.text('الدرجة الكبرى', 110, 100);
        doc.text('الدرجة الصغرى', 70, 100);
        doc.text('الدرجة المستحقة', 30, 100);

        let totalScore = 0;
        subjects.forEach((subject, index) => {
            const score = document.getElementById(subject.id).value || 0;
            totalScore += parseFloat(score);

            const yPosition = 110 + (index * 10); // Dynamic positioning

            doc.text(subject.id.replace('-score', ''), 160, yPosition);
            doc.text(subject.max.toString(), 110, yPosition);
            doc.text('50', 70, yPosition);
            doc.text(score, 30, yPosition);
        });

        const maxTotal = subjects.length * 100;
        const finalPercentage = ((totalScore / maxTotal) * 100).toFixed(2);
        const finalResult = finalPercentage >= 50 ? "ناجح" : "راسب";

        // Final Results Section
        doc.text(`المجموع العام: ${totalScore}`, 140, 200);
        doc.text(`المعدل: ${finalPercentage}%`, 140, 210);
        doc.text(`النتيجة النهائية: ${finalResult}`, 140, 220);

        // Footer
        doc.text('*ملاحظة: لا يعتبر هذا البيان وثيقة رسمية تغنيك عن الشهادة الاصلية', 40, 250);
        doc.text('© 2021 جميع الحقوق محفوظة للإدارة العامة للاختبارات', 60, 260);

        // Save the PDF
        doc.save('student-certificate.pdf');
    });
});
