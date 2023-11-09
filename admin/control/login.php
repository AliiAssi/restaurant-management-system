<?php
include '../../components/connection.php';
?>
<?php
if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $sql = "SELECT * FROM restadmin WHERE email='$email' AND adminPassword='$pass' ";
    $query = mysqli_query($con,$sql);
    $res = mysqli_fetch_array($query);
    if($res)
    {
        $_SESSION['id'] = $res['adminId'];
        header("location:../index2.php");
    }
    else
    {
        $_SESSION['error'] = true;
        header("location:../login.php?d=d");
    }
}
?>