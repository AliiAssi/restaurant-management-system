<?php
include '../components/connection.php';
if (!isset($_SESSION["userId"])) {
    header("Location: login.php");
    exit();
}
$userId = $_SESSION["userId"];
if(isset($_GET['item']))
{
    $id = $_GET['item'];
    $delete_item_sql = "DELETE FROM restcart WHERE cartId = $id";
    mysqli_query($con,$delete_item_sql);
    header("location:../costumer/cart.php");
}
?>