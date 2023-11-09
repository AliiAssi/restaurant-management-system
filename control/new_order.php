<?php
include '../components/connection.php';
if(!isset($_SESSION["userId"]))
{
    header("login.php");
}
else{
	$userId = $_SESSION["userId"];
}
function q($con, $sql) {
    $query = mysqli_query($con,$sql);
    $res = mysqli_fetch_array($query);
    return  $res;
}

$sql = "SELECT * FROM restcart WHERE userId = $userId LIMIT 1";
$query = mysqli_query($con,$sql);
if(mysqli_fetch_array($query))
{
$sql = "SELECT count(*) AS 'count' FROM restorder WHERE userId = $userId";
$res = q($con, $sql);
$count = $res['count'];

$sql = "SELECT * FROM restmenu a , restuser b, restcart c WHERE a.productId = c.productId AND c.userId = b.userId AND c.userId = $userId";
$query = mysqli_query($con,$sql);

$userAdress = "";
$products = "";
$products_total_price = 0 ;
$currentDateTime = date('Y-m-d H:i:s');
while($res = mysqli_fetch_array($query)){
$userAdress = $res['userCountry']."/" .$res['userCity']."/".$res['userArea']."/".$res['userOther'];   
$products .= $res['productName']."(".$res['productPrice']."x".$res['productQty'].")-";
$products_total_price += $res['productPrice'] * $res['productQty'];
}

$sql = "INSERT INTO `restorder`(`userId`, `method`, `userAdress`, `totalProducts`, `totalPrice`, `placedOn`, `paymentStatus`) 
        VALUES ('$userId', 'cash', '$userAdress', '$products', '$products_total_price', '$currentDateTime', '')";

mysqli_query($con, $sql);

$sql = "DELETE FROM restcart WHERE userId = $userId";
mysqli_query($con,$sql);

$sql = "SELECT orderId   FROM restorder WHERE userId= $userId order by placedOn desc LIMIT 1  ";
$query  = mysqli_query($con,$sql);
$res= mysqli_fetch_array($query);
$id = $res['orderId'];

header("location:../costumer/new_order.php?count=$count&&id=$id");

}
else{
    header("../costumer/cart.php");
}

?>