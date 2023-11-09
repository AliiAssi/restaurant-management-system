<?php
    include '../../components/connection.php';
    $adminId= 1;
    if(isset($_GET['id']))
    {
        $order_id = $_GET['id'];
        $order_id_sql = "UPDATE restOrder SET paymentStatus='complete' WHERE orderId=$order_id ";
        mysqli_query($con , $order_id_sql);
        header("location:../pending.php");
    }