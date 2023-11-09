<?php
    include '../../components/connection.php';
    $adminId= 1;
    
    if(isset($_GET['id']))
    {
        $order_id = $_GET['id'];
        $order_id_sql = "DELETE FROM restorder WHERE orderId=$order_id ";
        mysqli_query($con , $order_id_sql);

        if($_GET['page'] == "new")
            header("location:../new.php");
        else if($_GET['pending'] =="pending")
            header("location:../pending.php");
    }

    if(isset($_GET['product']))
    {
        $order_id = $_GET['product'];
        $order_id_sql = "DELETE FROM restmenu WHERE productId=$order_id ";
        mysqli_query($con , $order_id_sql);
        header("location:../products.php");
    }
    
?>