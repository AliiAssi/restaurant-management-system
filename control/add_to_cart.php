<?php
include '../components/connection.php';
if (!isset($_SESSION["userId"])) {
    header("Location: login.php");
    exit();
  }
$user_id = $_SESSION["userId"];
if(isset($_POST['add']))
{
    $product_id = $_POST['id'];

    #category
    $cat_query_sql = "SELECT productCategory FROM restmenu WHERE productId = $product_id";
    $cat_query = mysqli_query($con,$cat_query_sql);
    $cat_res = mysqli_fetch_array($cat_query);

    $cat = $cat_res['productCategory'];
    $qty = $_POST["qty"];

    $check_sql = "SELECT * FROM restcart WHERE userId=$user_id AND productId =$product_id";
    $check_query = mysqli_query($con,$check_sql);

    if(mysqli_fetch_array($check_query)){
        $_SESSION['already'] = true;
        header("location:../costumer/cosMenu.php#$cat");
    }
    else{
        $sql="INSERT INTO restcart (productId,productQty,userId)VALUES($product_id,$qty,$user_id)";
        mysqli_query($con,$sql);
        header("location:../costumer/cosMenu.php#$cat");
    }
}
?>