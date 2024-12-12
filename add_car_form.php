<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Добавить авто</title>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="animations.css">
<script src="scripts.js" defer></script>
</head>
<body>
<header>
    <div class="logo">CarRent Admin</div>
    <nav>
        <a href="dashboard_admin.php" class="nav-link">Назад</a>
        <a href="logout.php" class="nav-link">Выход</a>
    </nav>
</header>

<section class="form-section main-content hidden-before-load">
    <h1>Добавить автомобиль</h1>
    <form action="add_car.php" method="post" enctype="multipart/form-data" class="animate-form">
        <label for="brand">Марка:</label>
        <input type="text" id="brand" name="brand" required class="form-input" placeholder="Например, Toyota">

        <label for="model">Модель:</label>
        <input type="text" id="model" name="model" required class="form-input" placeholder="Например, Camry">

        <label for="year">Год:</label>
        <input type="number" id="year" name="year" required class="form-input" placeholder="Например, 2020">

        <label for="price_per_day">Цена за день (руб.):</label>
        <input type="text" id="price_per_day" name="price_per_day" required class="form-input" placeholder="Например, 3500">

        <label for="image">Изображение:</label>
        <input type="file" id="image" name="image" required class="form-input">

        <button type="submit" class="btn-animate">Добавить</button>
    </form>
</section>

<footer>
    <p>© 2024 CarRent Admin</p>
</footer>
</body>
</html>
