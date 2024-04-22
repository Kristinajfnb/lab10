<?php
/**
 * Обновляет данные мероприятия в базе данных.
 *
 * Эта функция получает данные из формы редактирования мероприятия, подготавливает SQL-запрос для обновления данных мероприятия и выполняет его.
 *
 * @param string $_POST['event_id'] ID мероприятия.
 * @param string $_POST['event_name'] Название мероприятия.
 * @param string $_POST['event_price'] Цена мероприятия.
 * @param string $_POST['event_seats'] Количество мест на мероприятии.
 * @param string $_POST['event_date'] Дата и время мероприятия.
 * @return void
 */
// Подключение к базе данных
$connection = mysqli_connect("localhost", "root", "", "event_platform");

// Проверка подключения
if (!$connection) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// Получение данных из формы
$event_id = $_POST['event_id'];
$event_name = $_POST['event_name'];
$event_price = $_POST['event_price'];
$event_seats = $_POST['event_seats'];
$event_date = $_POST['event_date'];

// Подготовка SQL-запроса для обновления данных мероприятия
$sql = "UPDATE events SET name='$event_name', price='$event_price', number_seats='$event_seats', date='$event_date' WHERE id=$event_id";

// Выполнение SQL-запроса
if (mysqli_query($connection, $sql)) {
    echo "Изменения сохранены успешно."; // Выводим сообщение об успешном сохранении изменений
} else {
    echo "Ошибка при сохранении изменений: " . mysqli_error($connection);
}

// Закрытие соединения с базой данных
mysqli_close($connection);
?>
