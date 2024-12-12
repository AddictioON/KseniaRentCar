<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}
include 'db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM cars WHERE id='$id'");

header("Location: dashboard_admin.php");
