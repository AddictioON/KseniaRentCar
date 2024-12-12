<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}
include 'db.php';

$cars = $conn->query("SELECT * FROM cars ORDER BY id DESC");
$requests = $conn->query("SELECT rr.*, u.username, c.brand, c.model FROM rent_requests rr
JOIN users u ON rr.user_id = u.id
JOIN cars c ON rr.car_id = c.id
ORDER BY rr.id DESC");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Добавлен метатег viewport -->
<title>Админ-панель</title>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="animations.css">
<script src="scripts.js" defer></script>
</head>
<body>
<header>
    <div class="logo">CarRent Admin</div>
    <nav>
        <a href="index.php" class="nav-link">Главная</a>
        <a href="logout.php" class="nav-link">Выход</a>
    </nav>
</header>

<section class="admin-section main-content hidden-before-load">
    <h1>Управление автопарком</h1>
    <a href="add_car_form.php" class="btn btn-animate">Добавить авто</a>
    <table>
        <tr><th>ID</th><th>Марка</th><th>Модель</th><th>Год</th><th>Цена/день</th><th>Действие</th></tr>
        <?php while($car = $cars->fetch_assoc()): ?>
        <tr>
            <td><?php echo $car['id']; ?></td>
            <td><?php echo htmlspecialchars($car['brand']); ?></td>
            <td><?php echo htmlspecialchars($car['model']); ?></td>
            <td><?php echo htmlspecialchars($car['year']); ?></td>
            <td><?php echo htmlspecialchars($car['price_per_day']); ?></td>
            <td>
                <a href="edit_car.php?id=<?php echo $car['id']; ?>">Редактировать</a> |
                <a href="delete_car.php?id=<?php echo $car['id']; ?>">Удалить</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h1>Заявки на аренду</h1>
    <table>
        <tr><th>ID</th><th>Пользователь</th><th>Авто</th><th>Период</th><th>Статус</th><th>Действие</th></tr>
        <?php while($req = $requests->fetch_assoc()): ?>
        <tr>
            <td><?php echo $req['id']; ?></td>
            <td><?php echo htmlspecialchars($req['username']); ?></td>
            <td><?php echo htmlspecialchars($req['brand'].' '.$req['model']); ?></td>
            <td><?php echo htmlspecialchars($req['start_date'].' - '.$req['end_date']); ?></td>
            <td><?php echo htmlspecialchars($req['status']); ?></td>
            <td>
                <?php if($req['status'] === 'pending'): ?>
                <a href="update_rent_status.php?id=<?php echo $req['id']; ?>&status=approved">Подтвердить</a> |
                <a href="update_rent_status.php?id=<?php echo $req['id']; ?>&status=denied">Отклонить</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</section>

<footer>
    <p>© 2024 CarRent Admin</p>
</footer>
</body>
</html>
