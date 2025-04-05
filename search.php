<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terrorist Database Search</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="search-container">
        <h1>قاعدة بيانات الإرهابيين</h1>
        <form action="search.php" method="get">
            <input type="text" name="query" placeholder="ابحث بالاسم ..." 
                   value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
            <button type="submit">بحث</button>
        </form>

        <div class="results">
            <?php
            if (isset($_GET['query']) && !empty($_GET['query'])) {
                $search = $conn->real_escape_string($_GET['query']);
                $sql = "SELECT * FROM terrorists 
                        WHERE name LIKE '%$search%' 
                        OR alias LIKE '%$search%' 
                        OR organization LIKE '%$search%' 
                        OR nationality LIKE '%$search%'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<table>';
                    echo '<tr><th>الاسم</th><th>اللقب</th><th>المنظمة</th><th>الجنسية</th><th>مستوى المطلوبية</th></tr>';
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['alias']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['organization']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['nationality']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['wanted_level']) . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<p>لا توجد نتائج مطابقة للبحث</p>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>