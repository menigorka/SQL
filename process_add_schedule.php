<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $subject_id = $_POST['subject_id'];
    $specialities = $_POST['specialities'];

    $conn = new mysqli('localhost', 'root', '', 'exam_schedule');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Добавление записи в таблицу schedule
    $stmt = $conn->prepare("INSERT INTO schedule (subject_id, date, time) VALUES (?, ?, ?)");
    $stmt->bind_param('iss', $subject_id, $date, $time);
    if ($stmt->execute()) {
        $schedule_id = $stmt->insert_id;

        // Добавление записей в таблицу subjects_to_specialities
        foreach ($specialities as $speciality_id) {
            $stmt2 = $conn->prepare("INSERT INTO subjects_to_specialities (subject_id, speciality_id) VALUES (?, ?)");
            $stmt2->bind_param('ii', $subject_id, $speciality_id);
            $stmt2->execute();
            $stmt2->close();
        }
    }
    $stmt->close();
    $conn->close();

    header('Location: index.php');
    exit;
}
?>
