<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $res = $conn->query($sql);
    if($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        if(password_verify($pass, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Неверный пароль";
        }
    } else {
        $error = "Пользователь не найден";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Вход</title>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="animations.css">
<script src="scripts.js" defer></script>
</head>
<body>
<header>
    <div class="logo">CarRent</div>
</header>

<section class="auth-section main-content hidden-before-load">
    <h1>Вход</h1>
    <?php if(!empty($error)): ?>
    <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="" method="post" class="animate-form">
        <label>Логин:</label>
        <input type="text" name="username" required class="form-input">
        <label>Пароль:</label>
        <input type="password" name="password" required class="form-input">
        <button type="submit" class="btn-animate">Войти</button>
    </form>
    <p>Нет аккаунта? <a href="register.php">Зарегистрируйтесь</a></p>
</section>

<footer>
    <p>© 2024 CarRent</p>
</footer>
</body>
</html>
