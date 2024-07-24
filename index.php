<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь экзаменов</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .calendar {
            display: flex;
            flex-wrap: wrap;
            width: 300px;
        }
        .calendar div {
            width: 14.28%;
            border: 1px solid #ddd;
            box-sizing: border-box;
            padding: 10px;
            text-align: center;
        }
        .calendar .active {
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Календарь экзаменов</h1>
    <a href="add_schedule.php" class="btn btn-primary mb-3">Добавить расписание</a>
    <div class="calendar">
        <?php
        // Вывод календаря с активными днями
        $conn = new mysqli('localhost', 'root', '', 'exam_schedule');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $currentYear = date('Y');
        $currentMonth = date('m');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = $currentYear . '-' . $currentMonth . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);

            $result = $conn->query("SELECT COUNT(*) AS count FROM schedule WHERE date = '$date'");
            $row = $result->fetch_assoc();

            if ($row['count'] > 0) {
                echo "<div class='active'><a href='view_day.php?date=$date' style='color: white;'>$day</a></div>";
            } else {
                echo "<div>$day</div>";
            }
        }

        $conn->close();
        ?>
    </div>
</div>
</body>
</html>
