<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запись на мероприятие</title>
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
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        select, input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Запись на мероприятие</h1>
    <form action="handle_event_registration.php" method="post">
        <label for="event_id">Выберите мероприятие:</label>
        <select name="event_id" id="event_id" required>
            <?php
            // Подключение к базе данных
            $connection = mysqli_connect("localhost", "root", "", "event_platform");

            // Проверка подключения
            if (!$connection) {
                die("Ошибка подключения: " . mysqli_connect_error());
            }

            // Получение списка мероприятий из базы данных
            $sql = "SELECT * FROM events";
            $result = mysqli_query($connection, $sql);

            // Вывод списка мероприятий в виде опций выбора
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }

            // Закрытие соединения с базой данных
            mysqli_close($connection);
            ?>
        </select>
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Записаться</button>
    </form>
</body>
</html>
