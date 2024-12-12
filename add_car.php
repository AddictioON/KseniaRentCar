<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}
include 'db.php';

$brand = $_POST['brand'];
$model = $_POST['model'];
$year = $_POST['year'];
$price = $_POST['price_per_day'];

if(isset($_FILES['image'])) {
    $image_name = time().'_'.$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$image_name);

    $sql = "INSERT INTO cars (brand,model,year,price_per_day,image) VALUES ('$brand','$model','$year','$price','$image_name')";
    $conn->query($sql);
}

header("Location: dashboard_admin.php");
