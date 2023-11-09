<?php
include '../components/connection.php';
if (!isset($_SESSION["userId"])) {
    header("Location: login.php");
    exit();
}
$userId = $_SESSION["userId"];
if(isset($_GET['id']))
{
   $id = $_GET['id'];
   mysqli_query($con,"DELETE FROM restorder WHERE orderId = $id");
   header("location:../costumer/orders_summary.php"); 
}