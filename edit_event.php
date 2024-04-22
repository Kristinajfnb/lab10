<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование мероприятия</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        form {
            width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"],
        input[type="datetime-local"] {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            width: calc(100% - 20px);
            margin-top: 10px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Редактирование мероприятия</h1>
    <?php
    /**
 * Функция для редактирования мероприятия.
 *
 * Форма заполняется данными о мероприятии из базы данных.
 * После отправки формы данные обрабатываются в файле handle_edit_event.php.
 * 
 * @param string $event_id Идентификатор мероприятия.
 * @param string $event_name Название мероприятия.
 * @param float $event_price Цена мероприятия.
 * @param int $event_seats Количество мест на мероприятии.
 * @param string $event_date Дата и время мероприятия.
 */
    // Подключение к базе данных
    $connection = mysqli_connect("localhost", "root", "", "event_platform");

    // Проверка подключения
    if (!$connection) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    // Получение идентификатора мероприятия из запроса
    $event_id = $_GET['id'];

    // Получение данных о мероприятии из базы данных
    $sql = "SELECT * FROM events WHERE id = $event_id";
    $result = mysqli_query($connection, $sql);

    // Проверка наличия мероприятия
    if (mysqli_num_rows($result) > 0) {
        $event = mysqli_fetch_assoc($result);
        
    ?>
    <!-- Форма для редактирования данных мероприятия -->
    <form action="handle_edit_event.php" method="post">
        <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
        <label for="event_name">Название мероприятия:</label>
        <input type="text" id="event_name" name="event_name" value="<?php echo $event['name']; ?>" required><br>
        <label for="event_price">Цена:</label>
        <input type="text" id="event_price" name="event_price" value="<?php echo $event['price']; ?>" required><br>
        <label for="event_seats">Количество мест:</label>
        <input type="text" id="event_seats" name="event_seats" value="<?php echo $event['number_seats']; ?>" required><br>
        <label for="event_date">Дата и время:</label>
        <input type="datetime-local" id="event_date" name="event_date" value="<?php echo date('Y-m-d\TH:i', strtotime($event['date'])); ?>" required><br>
        <button type="submit">Сохранить изменения</button>
    </form>
    <?php
    } else {
        echo "Мероприятие не найдено.";
    }

    // Закрытие соединения с базой данных
    mysqli_close($connection);
    ?>
</body>
</html>
