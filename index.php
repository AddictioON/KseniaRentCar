<?php
session_start();
include 'db.php';

$sql = "SELECT * FROM cars";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Аренда автомобилей</title>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="animations.css">
<script src="scripts.js" defer></script>
</head>
<body>
<div id="page-wrapper">
<header>
    <div class="logo">CarRent</div>
    <nav class="nav-links">
        <?php if(isset($_SESSION['username'])): ?>
            <?php if($_SESSION['role'] === 'admin'): ?>
                <a class="nav-link" href="dashboard_admin.php">Админ-панель</a>
            <?php endif; ?>
            <span class="nav-user">Привет, <?php echo $_SESSION['username']; ?></span>
            <a class="nav-link" href="logout.php">Выход</a>
        <?php else: ?>
            <a class="nav-link" href="login.php">Вход</a>
            <a class="nav-link" href="register.php">Регистрация</a>
        <?php endif; ?>
    </nav>
</header>

<main class="main-content hidden-before-load">

    <section class="about-company">
        <div class="about-content">
            <h1>О компании CarRent</h1>
            <p>CarRent – ведущая компания по аренде автомобилей, предлагающая широкий выбор машин на любой вкус и бюджет. Мы работаем на рынке уже более 10 лет, обеспечивая высокий уровень сервиса, удобство и безопасность для наших клиентов.</p>
            <p>Наша миссия – сделать процесс аренды автомобиля максимально простым и приятным, чтобы вы могли сосредоточиться на своем путешествии или деловой поездке. Мы гордимся нашей командой специалистов и современным автопарком, который регулярно обновляется и проверяется.</p>
            <p>Выберите CarRent – и вы получите надёжного партнёра в любых поездках!</p>
        </div>
        <div class="about-image">
            <img src="images/1.png" alt="О компании CarRent" />
        </div>
    </section>

    <section class="cars-list">
        <h2>Наш автопарк</h2>
        <p>Выберите подходящий автомобиль из нашего обширного автопарка. Мы предлагаем эконом-класс, бизнес-класс, а также премиальные автомобили для особых случаев.</p>
        <div class="cars-container">
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="car-card animated-card">
                <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['brand'].' '.$row['model']); ?>">
                <h3><?php echo htmlspecialchars($row['brand'].' '.$row['model']); ?></h3>
                <p><strong>Год:</strong> <?php echo htmlspecialchars($row['year']); ?></p>
                <p><strong>Цена за сутки:</strong> <?php echo htmlspecialchars($row['price_per_day']); ?> руб.</p>
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'user'): ?>
                    <a class="rent-button" href="rent.php?car_id=<?php echo $row['id']; ?>">Арендовать</a>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>
    </section>

</main>

<footer>
    <p>© 2024 CarRent</p>
</footer>
</div>
</body>
</html>
