<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Текущие мероприятия</title>
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
        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
        }
        li {
            background-color: #fff;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        li:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<nav>
        <ul>
            <li><a href="index.php">Текущие мероприятия</a></li>
            <li><a href="event_registration.php">Запись на мероприятие</a></li>
            <li><a href="registration.php">Регистрация</a></li>
            <li><a href="login.php">Авторизация</a></li>
            <li><a href="admin_login.php">Вход в админ </a></li>
        </ul>
    </nav>
    <h1>Текущие мероприятия</h1>
    <ul>
        <?php
        // Подключение к базе данных
        
        $connection = mysqli_connect("localhost", "root", "", "event_platform");

        // Проверка подключения
        if (!$connection) {
            die("Ошибка подключения: " . mysqli_connect_error());
        }

        // Получение текущих мероприятий из базы данных
        $sql = "SELECT * FROM events";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>{$row['id']}- {$row['name']} -  {$row['date']}</li>";
            }
        } else {
            echo "<li>Нет текущих мероприятий</li>";
        }

        // Закрытие соединения с базой данных
        mysqli_close($connection);
        ?>
    </ul>
</body>
</html>
