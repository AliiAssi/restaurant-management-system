<?php
include '../../components/connection.php';
?>
<?php
if (isset($_GET["id"]))
{   
    $id = $_GET['id'];
    $sql = "SELECT * FROM restuser WHERE userId = $id";
    $query = mysqli_query($con,$sql);
    $res = mysqli_fetch_array($query);
    if($res["block"] != 1){
        $sql = "UPDATE restuser SET block = 1 WHERE userId = $id";
        $query = mysqli_query($con, $sql);
        header("location:../costumers.php");}
    else{
        $sql = "UPDATE restuser SET block = 0 WHERE userId = $id";
        $query = mysqli_query($con, $sql);
        header("location:../costumers.php");
    }    
}
?>