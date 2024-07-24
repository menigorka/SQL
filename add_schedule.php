<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить расписание</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Добавить расписание</h1>
    <form action="process_add_schedule.php" method="post">
        <div class="form-group">
            <label for="date">Дата</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="time">Время</label>
            <input type="time" class="form-control" id="time" name="time" required>
        </div>
        <div class="form-group">
            <label for="subject">Предмет</label>
            <select class="form-control" id="subject" name="subject_id" required>
                <option value="1">Арифметика</option>
                <option value="2">Алгебра</option>
                <option value="3">Геометрия (планиметрия и стереометрия)</option>
                <option value="4">Тригонометрия</option>
                <option value="5">Высшая математика</option>
                <option value="6">Греческий язык</option>
                <option value="7">Философия</option>
                <option value="8">Психология и педагогика</option>
                <option value="9">Социология</option>
                <option value="10">Концепции современного естествознания</option>
            </select>
        </div>
        <div class="form-group">
            <label for="specialities">Специальности</label>
            <select multiple class="form-control" id="specialities" name="specialities[]">
                <option value="1">001 Математика</option>
                <option value="2">002 Языковая культура</option>
                <!-- Добавьте другие специальности здесь -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>
</body>
</html>
