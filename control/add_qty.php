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


    $sql = "SELECT productQty FROM restcart WHERE cartId = $id ";
    $query = mysqli_query($con,$sql);
    $res = mysqli_fetch_array($query);
    $qty = $res['productQty'];
    $qty++;
    $add_qty_sql = "UPDATE  restcart SET productQty = $qty  WHERE cartId = $id";
    mysqli_query($con, $add_qty_sql);
    header("location:../costumer/cart.php");
}
?>