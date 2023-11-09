<?php
include '../components/connection.php';
if (!isset($_SESSION["userId"])) {
    header("login.php");
} else {
    $userId = $_SESSION["userId"];
    $_SESSION['nono'] = true;
    header("location:orders_summary.php");   
}
?>