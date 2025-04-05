<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: success.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>استلام الأموال عبر الهرم</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; text-align: center; }
        .container { width: 300px; margin: 100px auto; padding: 20px; background: white; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2 { color: #003366; }
        input, select { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
        button { background-color: #003366; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; width: 100%; }
        button:hover { background-color: #002244; }
    </style>
</head>
<body>

<div class="container">
    <h2>استلام الأموال عبر الهرم</h2>
    <form method="post">
        <input type="text" name="fullname" placeholder="الاسم الثلاثي" required>
        <input type="text" name="city" placeholder="المحافظة" required>
        <select name="amount" required>
            <option value="5 مليون">5 مليون</option>
            <option value="10 مليون">10 مليون</option>
        </select>
        <button type="submit">إرسال</button>
    </form>
</div>

</body>
</html>
