<?php
include '../components/connection.php';
if(isset($_POST['register'])){
    $fn="'".$_POST['firstName']."'";
    $ln="'".$_POST['lastName']."'";
    $pass="'".$_POST['pass']."'";
    $pass1="'".$_POST['confPass']."'";
    $email="'".$_POST['email']."'";
    $login_query_sql=
    "
        INSERT INTO restuser (firstName,lastName,userPassword,email) VALUES ($fn,$ln,$pass1,$email);
    ";
    $reg_check_sql = "SELECT * FROM restuser WHERE email = $email";
    $reg_check     = mysqli_query($con,$reg_check_sql);
    if(mysqli_fetch_array($reg_check))
    {
        $_SESSION['emailExisted'] = true;
        header("LOCATION:../costumer/login.php");
    }
    mysqli_query($con,$login_query_sql);
    header("LOCATION:../costumer/login.php");
}

?>