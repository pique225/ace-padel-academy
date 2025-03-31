<?php
// fetch_bookings.php

$host = 'localhost';
$dbname = 'padel_academy';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM bookings");
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "خطأ: " . $e->getMessage();
}
?>

<h2>جدول الحجوزات</h2>
<table border="1">
    <thead>
        <tr>
            <th>الاسم</th>
            <th>التاريخ</th>
            <th>الوقت</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?php echo htmlspecialchars($booking['name']); ?></td>
                <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                <td><?php echo htmlspecialchars($booking['booking_time']); ?></td>
                <td>
                    <a href="edit_booking.php?id=<?php echo $booking['id']; ?>">تعديل</a>
                    <a href="delete_booking.php?id=<?php echo $booking['id']; ?>" onclick="return confirm('هل أنت متأكد؟')">حذف</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>