<?php
// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем, существуют ли введенные данные
    if (!empty($_POST['event_name']) && !empty($_POST['event_price']) && !empty($_POST['event_seats']) && !empty($_POST['event_date'])) {
        // Подключаемся к базе данных
        $connection = mysqli_connect("localhost", "root", "", "event_platform");

        // Проверяем подключение
        if (!$connection) {
            die("Ошибка подключения: " . mysqli_connect_error());
        }

        // Получаем введенные данные из формы
        $event_name = $_POST['event_name'];
        $event_price = $_POST['event_price'];
        $event_seats = $_POST['event_seats'];
        $event_date = $_POST['event_date'];

        // Готовим SQL-запрос для добавления мероприятия в таблицу
        $sql = "INSERT INTO events (name, price, number_seats, date) VALUES ('$event_name', '$event_price', '$event_seats', '$event_date')";

        // Попытка выполнить SQL-запрос
        if (mysqli_query($connection, $sql)) {
            // Если запрос выполнен успешно, перенаправляем пользователя на административную панель
            header("Location: admin_panel.php");
            exit;
        } else {
            // Если возникла ошибка при выполнении запроса, выводим сообщение об ошибке
            echo "Ошибка добавления мероприятия: " . mysqli_error($connection);
        }

        // Закрываем соединение с базой данных
        mysqli_close($connection);
    } else {
        // Выводим сообщение об ошибке, если не все поля заполнены
        echo "<p>Все поля обязательны для заполнения.</p>";
    }
}
?>
