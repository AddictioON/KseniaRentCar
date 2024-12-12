<?php
session_start();
include 'db.php';
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price_per_day'];
    $image_sql = "";

    if(!empty($_FILES['image']['name'])) {
        $image_name = time().'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$image_name);
        $image_sql = ", image='$image_name'";
    }

    $sql = "UPDATE cars SET brand='$brand', model='$model', year='$year', price_per_day='$price' $image_sql WHERE id='$id'";
    $conn->query($sql);
    header("Location: dashboard_admin.php");
    exit;
} else {
    $res = $conn->query("SELECT * FROM cars WHERE id='$id'");
    $car = $res->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Редактировать авто</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <div class="logo">CarRent Admin</div>
    <nav>
        <a href="dashboard_admin.php">Назад</a>
        <a href="logout.php">Выход</a>
    </nav>
</header>

<section class="form-section">
    <h1>Редактировать автомобиль</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Марка:</label>
        <input type="text" name="brand" value="<?php echo htmlspecialchars($car['brand']); ?>" required>
        <label>Модель:</label>
        <input type="text" name="model" value="<?php echo htmlspecialchars($car['model']); ?>" required>
        <label>Год:</label>
        <input type="number" name="year" value="<?php echo htmlspecialchars($car['year']); ?>" required>
        <label>Цена за день (руб.):</label>
        <input type="text" name="price_per_day" value="<?php echo htmlspecialchars($car['price_per_day']); ?>" required>
        <label>Изображение (если хотите изменить):</label>
        <input type="file" name="image">
        <button type="submit">Сохранить</button>
    </form>
</section>

<footer>
    <p>© 2024 CarRent Admin</p>
</footer>
</body>
</html>
