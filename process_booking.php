<?php
// process_booking.php

$host = 'localhost';
$dbname = 'padel_academy';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $stmt = $pdo->prepare("INSERT INTO bookings (name, booking_date, booking_time) VALUES (?, ?, ?)");
    $stmt->execute([$name, $date, $time]);

    echo "تم الحجز بنجاح!";
} catch (PDOException $e) {
    echo "خطأ: " . $e->getMessage();
}
?>