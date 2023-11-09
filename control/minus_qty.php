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
    if($qty == 1){
        header("Location:../costumer/cart.php");
        exit();
    }
    $qty--;
    $minus_qty_sql = "UPDATE  restcart SET productQty = $qty  WHERE cartId = $id";
    mysqli_query($con,$minus_qty_sql);
    header("location:../costumer/cart.php");
}
?>