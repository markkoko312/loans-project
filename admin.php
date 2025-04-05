<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $alias = $conn->real_escape_string($_POST['alias']);
    $org = $conn->real_escape_string($_POST['organization']);
    $nationality = $conn->real_escape_string($_POST['nationality']);
    $wanted = $conn->real_escape_string($_POST['wanted_level']);
    $desc = $conn->real_escape_string($_POST['description']);
    $location = $conn->real_escape_string($_POST['last_known_location']);

    $sql = "INSERT INTO terrorists (name, alias, organization, nationality, wanted_level, description, last_known_location)
            VALUES ('$name', '$alias', '$org', '$nationality', '$wanted', '$desc', '$location')";

    if ($conn->query($sql) {
        $message = "تمت إضافة الإرهابي بنجاح";
    } else {
        $message = "خطأ في الإضافة: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم - إضافة إرهابي</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="admin-container">
        <h1>إضافة إرهابي جديد</h1>
        <?php if (isset($message)) echo "<p>$message</p>"; ?>
        <form method="POST">
            <div class="form-group">
                <label>الاسم الكامل:</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>الأسماء المستعارة:</label>
                <input type="text" name="alias">
            </div>
            <div class="form-group">
                <label>المنظمة:</label>
                <input type="text" name="organization" required>
            </div>
            <div class="form-group">
                <label>الجنسية:</label>
                <input type="text" name="nationality">
            </div>
            <div class="form-group">
                <label>مستوى المطلوبية:</label>
                <select name="wanted_level" required>
                    <option value="عالي">عالي</option>
                    <option value="متوسط">متوسط</option>
                    <option value="منخفض">منخفض</option>
                </select>
            </div>
            <div class="form-group">
                <label>آخر مكان معروف:</label>
                <input type="text" name="last_known_location">
            </div>
            <div class="form-group">
                <label>الوصف:</label>
                <textarea name="description" rows="4"></textarea>
            </div>
            <button type="submit">إضافة</button>
        </form>
    </div>
</body>
</html>