<?php
include '../../components/connection.php';
$adminId= 1;
if (isset($_POST["save"]))
{
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $name = $_POST["name"];
    $sql = "UPDATE `restadmin` SET `email`='$email',`adminName`='$name',`adminPhone`='$mobile' WHERE adminId = $adminId ";
    $query = mysqli_query($con, $sql);
    header("location:../profile.php");
}
else if(isset($_POST["change"]))
{
    $old = $_POST["old"];
    $sql = "SELECT * FROM restadmin WHERE adminId = $adminId AND adminPassword = '$old'";
    $query=mysqli_query($con,$sql);
    $res = mysqli_fetch_array($query);
    if($res){
        $new=$_POST["new"];
        $sql ="UPDATE `restadmin` SET adminPassword= '$new' WHERE adminId = $adminId ";
        $query = mysqli_query($con, $sql);
        header("location:../profile.php?changed=1");
    }
    else{
        header("location:../profile.php?changed=0");
    }
}
?>