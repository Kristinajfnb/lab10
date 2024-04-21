<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подключаемся к базе данных
    $connection = mysqli_connect("localhost", "root", "", "event_platform");

    // Проверяем подключение
    if (!$connection) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    // Получаем введенные данные из формы
    $username = $_POST['username'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];

    // Проверяем существование пользователя с указанными данными
    $sql = "SELECT * FROM users WHERE name = '$username' AND surname = '$surname' AND email = '$email' AND role_id = '2'";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        // Вход выполнен успешно
        // Перенаправляем пользователя на панель администратора
        header("Location: admin_panel.php");
        exit; // Важно добавить exit, чтобы прервать выполнение скрипта
    } else {
        // Вход не выполнен
        echo "<p>Ошибка входа. Пожалуйста, проверьте введенные данные и попробуйте снова.</p>";
    }

    // Закрываем соединение с базой данных
    mysqli_close($connection);
}
?>
