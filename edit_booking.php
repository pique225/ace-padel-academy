<?php
// edit_booking.php

$id = $_GET['id'];

$host = 'localhost';
$dbname = 'padel_academy';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        $stmt = $pdo->prepare("UPDATE bookings SET name = ?, booking_date = ?, booking_time = ? WHERE id = ?");
        $stmt->execute([$name, $date, $time, $id]);

        header("Location: fetch_bookings.php");
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE id = ?");
    $stmt->execute([$id]);
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "خطأ: " . $e->getMessage();
}
?>

<form method="POST">
    <label for="name">اسمك:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($booking['name']); ?>" required>

    <label for="date">التاريخ:</label>
    <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($booking['booking_date']); ?>" required>

    <label for="time">الوقت:</label>
    <input type="time" id="time" name="time" value="<?php echo htmlspecialchars($booking['booking_time']); ?>" required>

    <button type="submit">تحديث الحجز</button>
</form>