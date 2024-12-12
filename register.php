<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];

    if($pass !== $pass2) {
        $error = "Пароли не совпадают";
    } else {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username','$hash','user')";
        if($conn->query($sql)) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Ошибка регистрации";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Регистрация</title>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="animations.css">
<script src="scripts.js" defer></script>
</head>
<body>
<header>
    <div class="logo">CarRent</div>
</header>

<section class="auth-section main-content hidden-before-load">
    <h1>Регистрация</h1>
    <?php if(!empty($error)): ?>
    <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="" method="post" class="animate-form">
        <label for="username">Логин:</label>
        <input type="text" id="username" name="username" required class="form-input" placeholder="Введите логин">

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required class="form-input" placeholder="Введите пароль">

        <label for="password2">Повтор пароля:</label>
        <input type="password" id="password2" name="password2" required class="form-input" placeholder="Повторите пароль">

        <button type="submit" class="btn-animate">Зарегистрироваться</button>
    </form>
    <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
</section>

<footer>
    <p>© 2024 CarRent</p>
</footer>
</body>
</html>
