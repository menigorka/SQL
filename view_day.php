<?php
// Подключение к базе данных с указанным именем пользователя и паролем по умолчанию
$host = 'localhost';
$dbname = 'exam_schedule';
$charset = 'utf8';

// Учетные данные, которые могут подключаться
$username = 'guest'; // Обязательно укажите имя пользователя
$password = ''; // Оставьте пустым, если настроено таким образом

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to database successfully";
} catch (PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
    exit;
}

// Получение даты из GET параметра
$date = isset($_GET['date']) ? $_GET['date'] : null;

if ($date) {
    // Подготовка SQL-запроса
    $sql = "SELECT schedule.time, GROUP_CONCAT(DISTINCT subjects.title ORDER BY subjects.title SEPARATOR ', ') AS subjects,
            GROUP_CONCAT(DISTINCT specialities.title ORDER BY specialities.title SEPARATOR ', ') AS specialities 
            FROM schedule 
            JOIN subjects ON schedule.subject_id = subjects.id 
            JOIN subjects_to_specialities ON subjects.id = subjects_to_specialities.subject_id 
            JOIN specialities ON subjects_to_specialities.speciality_id = specialities.id 
            WHERE schedule.date = :date 
            GROUP BY schedule.time, specialities.title";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->execute();
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "Дата не указана.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Расписание экзаменов на <?= htmlspecialchars($date) ?></title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .back-button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Расписание экзаменов на <?= htmlspecialchars($date) ?></h1>

    <a href="index.php" class="back-button">Вернуться к календарю</a>

    <?php if (!empty($results)): ?>
        <table>
            <thead>
                <tr>
                    <th>Время экзамена</th>
                    <th>Названия предметов</th>
                    <th>Список специальностей</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['time']) ?></td>
                        <td><?= htmlspecialchars($row['subjects']) ?></td>
                        <td><?= htmlspecialchars(removeNumbers($row['specialities'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Нет запланированных экзаменов на эту дату.</p>
    <?php endif; ?>

    <?php
    // Функция для удаления цифр из строки
    function removeNumbers($string) {
        return preg_replace('/\d+\s*/', '', $string);
    }
    ?>
</body>
</html>
