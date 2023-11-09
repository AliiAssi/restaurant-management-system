<?php
include '../components/connection.php';
if (!isset($_SESSION["userId"])) {
    header("Location: login.php");
    exit();
}
$userId = $_SESSION["userId"];
echo $_GET['fav'];
if(isset($_GET['fav']))
{
    $index=$_GET['fav'];
    $pid = $_GET['pid'];
    if (isset($_GET["drink"]) && $_GET["drink"] == "cold" ){
        if($index == "false")
        {
            $sql_query = "INSERT INTO fav (productId,userId) VALUES ($pid,$userId);";
            $query     = mysqli_query($con,$sql_query);
            header("location:../costumer/cosMenu.php?drink=cold#$pid");
        }
        else if ($index == "true")
        {
            $sql_query = "DELETE FROM  fav WHERE  productId=$pid AND userId=$userId;";
            $query     = mysqli_query($con,$sql_query);
            header("location:../costumer/cosMenu.php?drink=cold#$pid");
        }}
        else if (isset($_GET["drink"]) && $_GET["drink"]=="hot"){
            if($index == "false")
            {
                $sql_query = "INSERT INTO fav (productId,userId) VALUES ($pid,$userId);";
                $query     = mysqli_query($con,$sql_query);
                header("location:../costumer/cosMenu.php?drink=hot#$pid");
            }
            else if ($index == "true")
            {
                $sql_query = "DELETE FROM  fav WHERE  productId=$pid AND userId=$userId;";
                $query     = mysqli_query($con,$sql_query);
                header("location:../costumer/cosMenu.php?drink=hot#$pid");
            }
        }
        else{
            if($index == "false")
            {
                $sql_query = "INSERT INTO fav (productId,userId) VALUES ($pid,$userId);";
                $query     = mysqli_query($con,$sql_query);
                header("location:../costumer/cosMenu.php#$pid");
            }
            else if ($index == "true")
            {
                $sql_query = "DELETE FROM  fav WHERE  productId=$pid AND userId=$userId;";
                $query     = mysqli_query($con,$sql_query);
                header("location:../costumer/cosMenu.php#$pid");
            }
        }
}
else{
    echo "error";
}
?>