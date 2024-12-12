<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}
include 'db.php';

$id = $_GET['id'];
$status = $_GET['status'];

$allowed = ['approved','denied'];
if(in_array($status, $allowed)) {
    $conn->query("UPDATE rent_requests SET status='$status' WHERE id='$id'");
}

header("Location: dashboard_admin.php");
