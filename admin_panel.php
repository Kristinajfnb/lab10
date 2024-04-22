<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Административная панель</title>
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
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Административная панель</h1>

    <!-- Форма для добавления мероприятия -->
    <form action="handle_add_event.php" method="post">
        <label for="event_name">Название мероприятия:</label>
        <input type="text" id="event_name" name="event_name" required><br>
        <label for="event_price">Цена:</label>
        <input type="text" id="event_price" name="event_price" required><br>
        <label for="event_seats">Количество мест:</label>
        <input type="text" id="event_seats" name="event_seats" required><br>
        <label for="event_date">Дата и время:</label>
        <input type="datetime-local" id="event_date" name="event_date" required><br>
        <button type="submit">Добавить мероприятие</button>
    </form>

    <!-- Таблица для просмотра и управления мероприятиями -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Количество мест</th>
                <th>Дата и время</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
               /**
             * Функция для вывода списка мероприятий в таблицу.
             *
             * Эта функция извлекает список мероприятий из базы данных и выводит их в виде таблицы.
             * Каждое мероприятие представлено в виде строки таблицы с указанием его ID, названия, цены,
             * количества мест, даты и времени. Для каждого мероприятия также добавлена ссылка на
             * страницу редактирования.
             *
             * @param mysqli $connection Соединение с базой данных.
             */
            // Подключение к базе данных
            $connection = mysqli_connect("localhost", "root", "", "event_platform");

            // Проверка подключения
            if (!$connection) {
                die("Ошибка подключения: " . mysqli_connect_error());
            }

            // Получение списка мероприятий из базы данных
            $sql = "SELECT * FROM events";
            $result = mysqli_query($connection, $sql);

            // Вывод данных о мероприятиях в таблицу
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['price']}</td>";
                echo "<td>{$row['number_seats']}</td>";
                echo "<td>{$row['date']}</td>";
                echo "<td>";
                echo "<a href='edit_event.php?id={$row['id']}'>Редактировать</a>";
                echo "</td>";
                echo "</tr>";
            }

            // Закрытие соединения с базой данных
            mysqli_close($connection);
            ?>
        </tbody>
    </table>
</body>
</html>
