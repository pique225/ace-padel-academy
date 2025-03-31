<?php
// delete_booking.php

$id = $_GET['id'];

$host = 'localhost';
$dbname = 'padel_academy';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: fetch_bookings.php");
    exit;
} catch (PDOException $e) {
    echo "خطأ: " . $e->getMessage();
}
?>