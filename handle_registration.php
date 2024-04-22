<?php
/**
 * Файл для обработки регистрации нового пользователя.
 * Принимает данные из формы, проверяет их и осуществляет регистрацию пользователя в системе.
 */
// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подключение к базе данных
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "event_platform";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверяем соединение
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Получаем данные из формы
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $role_id = 1; // Здесь указывается ID роли пользователя (например, ID роли "user")

    // Готовим и выполняем SQL-запрос для вставки данных в базу данных
    $sql = "INSERT INTO users (name, surname, email, role_id) VALUES ('$name', '$surname', '$email', $role_id)";

    if ($conn->query($sql) === TRUE) {
        echo "Вы успешно зарегестировались";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }

    // Закрываем соединение с базой данных
    $conn->close();
} else {
    // Если форма не была отправлена, перенаправляем пользователя на страницу регистрации
    header("Location: registration.php");
    exit();
}
?>
