<?php
session_start();

// Подключение к базе данных
$connection = mysqli_connect("localhost", "root", "", "event_platform");

// Проверка подключения
if (!$connection) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// Получение данных из формы авторизации
$email = $_POST['email'];

// Запрос к базе данных для получения информации о пользователе
$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($connection, $query);

// Проверка, найден ли пользователь с указанным email
if (mysqli_num_rows($result) == 1) {
    // Пользователь найден, устанавливаем сеанс аутентификации
    $_SESSION['logged_in'] = true;
    echo "Вы успешно авторизовались!";
} else {
    // Пользователь не найден, выводим сообщение об ошибке
    echo "Ошибка входа. Пожалуйста, проверьте правильность введенных данных.";
}

// Закрытие соединения с базой данных
mysqli_close($connection);
?>
