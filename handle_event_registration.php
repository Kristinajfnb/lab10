<?php
/**
 * Обработчик формы записи пользователя на мероприятие.
 *
 * Этот скрипт проверяет, были ли переданы данные из формы методом POST.
 * Подключается к базе данных, получает данные из формы, подготавливает SQL-запрос
 * для вставки записи о пользователе на мероприятие и выполняет этот запрос.
 * Выводит сообщение об успешной записи на мероприятие или сообщение об ошибке.
 */
// Проверяем, были ли переданы данные из формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подключаемся к базе данных
    $connection = mysqli_connect("localhost", "root", "", "event_platform");

    // Проверяем соединение
    if (!$connection) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    // Получаем данные из формы
    $event_id = $_POST['event_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Подготавливаем SQL-запрос для вставки записи о пользователе на мероприятие
    $sql = "INSERT INTO event_records (user_id, event_id) VALUES ((SELECT id FROM users WHERE email='$email'), $event_id)";

    // Выполняем SQL-запрос
    if (mysqli_query($connection, $sql)) {
        echo "Вы успешно записались на мероприятие!";
    } else {
        echo "Ошибка при записи на мероприятие: " . mysqli_error($connection);
    }

    // Закрываем соединение с базой данных
    mysqli_close($connection);
}
?>
