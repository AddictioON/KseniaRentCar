<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}
include 'db.php';

$user_id = $_SESSION['user_id'];
$car_id = $_POST['car_id'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$sql = "INSERT INTO rent_requests (user_id, car_id, start_date, end_date, status) 
        VALUES ('$user_id','$car_id','$start_date','$end_date','pending')";
$conn->query($sql);

header("Location: index.php");
