<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}
include 'db.php';

$car_id = $_GET['car_id'] ?? 0;
$sql = "SELECT * FROM cars WHERE id = ".(int)$car_id;
$result = $conn->query($sql);
$car = $result->fetch_assoc();
if(!$car) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Оформление аренды</title>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="animations.css">
<script src="scripts.js" defer></script>
</head>
<body>
<header>
    <div class="logo">CarRent</div>
    <nav class="nav-links">
        <a class="nav-link" href="index.php">Главная</a>
        <a class="nav-link" href="logout.php">Выход</a>
    </nav>
</header>

<section class="rent-section main-content hidden-before-load">
    <h1>Заявка на аренду: <?php echo htmlspecialchars($car['brand'].' '.$car['model']); ?></h1>
    <form action="process_rent.php" method="post" class="animate-form">
        <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">

        <label for="start_date">Дата начала аренды:</label>
        <input type="date" id="start_date" name="start_date" required class="form-input" placeholder="Выберите дату начала">

        <label for="end_date">Дата окончания аренды:</label>
        <input type="date" id="end_date" name="end_date" required class="form-input" placeholder="Выберите дату окончания">
        
        <button type="submit" class="btn-animate">Отправить заявку</button>
    </form>
</section>

<footer>
    <p>© 2024 CarRent</p>
</footer>
</body>
</html>
