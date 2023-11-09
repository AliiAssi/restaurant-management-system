<?php
include '../components/connection.php';
$adminId= $_SESSION['id'];

if(!isset($adminId)) header("location:login.php");

$admin_info_query_sql = "SELECT  * FROM restadmin WHERE adminId = $adminId";
$admin_info_query = mysqli_query($con, $admin_info_query_sql);
$admin_info = mysqli_fetch_array($admin_info_query);

$users_count_query_sql = "SELECT count(*) as 'users' FROM restuser";
$users_count_query     = mysqli_query($con, $users_count_query_sql);
$users_count_query     = mysqli_fetch_array($users_count_query);
$users_count           = $users_count_query["users"];

$admins_count_query_sql = "SELECT count(*) FROM restadmin";
$query = mysqli_query($con, $admins_count_query_sql);
$admins_count_res = mysqli_fetch_array($query);
$admins_count = $admins_count_res[0];

$profit_sql = "SELECT SUM(totalPrice) AS total_profit FROM restorder WHERE paymentStatus = 'delivery'";
$query = mysqli_query($con ,$profit_sql);
$result = mysqli_fetch_assoc($query);
$total_profit = $result['total_profit'];

$pending_sql = "SELECT COUNT(totalPrice) AS pending_count FROM restorder WHERE paymentStatus = 'pending'";
$query = mysqli_query($con, $pending_sql);
$result = mysqli_fetch_assoc($query);
$pending = $result['pending_count'];
$class="black";
$class1 = "";
if($pending > 0) {$class = "red";$class1 = "red1";}
$sql = "SELECT * FROM restorder WHERE paymentStatus='pending' ORDER BY placedOn LIMIT 1;";
$query = mysqli_query($con, $sql);
$res = mysqli_fetch_array($query);
if(!$res){$timeAgo="no pending orders";}else{
$placedOnStr = $res["placedOn"];
$currentDate = new DateTime();
$placedOnDate = new DateTime($placedOnStr);
$duration = $currentDate->diff($placedOnDate);
$years = $duration->y;
$months = $duration->m;
$days = $duration->d;
$hours = $duration->h;
$minutes = $duration->i;
$seconds = $duration->s;
if ($years > 0) {
    $timeAgo = $years . ($years == 1 ? ' year' : ' years') . ' ago';
} elseif ($months > 0) {
    $timeAgo = $months . ($months == 1 ? ' month' : ' months') . ' ago';
} elseif ($days > 0) {
    $timeAgo = $days . ($days == 1 ? ' day' : ' days') . ' ago';
} elseif ($hours > 0) {
    $timeAgo = $hours . ($hours == 1 ? ' hour' : ' hours') . ' ago';
} elseif ($minutes > 0) {
    $timeAgo = $minutes . ($minutes == 1 ? ' minute' : ' minutes') . ' ago';
} else {
    $timeAgo = $seconds . ($seconds == 1 ? ' second' : ' seconds') . ' ago';
}
}
$sql = "SELECT COUNT(totalPrice) AS count FROM restorder WHERE paymentStatus = ''";
$query = mysqli_query($con, $sql);
$result = mysqli_fetch_assoc($query);
$new = $result['count'];
$value = "black";$value1 = "";
if($new>0){$value="red";$value1="red1";}
$sql = "SELECT * FROM restorder WHERE paymentStatus='' ORDER BY placedOn LIMIT 1;";
$query = mysqli_query($con, $sql);
$res = mysqli_fetch_array($query);
if(!$res) {$timeAgo1="no orders yet";}
else{
$placedOnStr = $res["placedOn"];
$currentDate = new DateTime();
$placedOnDate = new DateTime($placedOnStr);
$duration = $currentDate->diff($placedOnDate);
$years = $duration->y;
$months = $duration->m;
$days = $duration->d;
$hours = $duration->h;
$minutes = $duration->i;
$seconds = $duration->s;
if ($years > 0) {
    $timeAgo1 = $years . ($years == 1 ? ' year' : ' years') . ' ago';
} elseif ($months > 0) {
    $timeAgo1 = $months . ($months == 1 ? ' month' : ' months') . ' ago';
} elseif ($days > 0) {
    $timeAgo1 = $days . ($days == 1 ? ' day' : ' days') . ' ago';
} elseif ($hours > 0) {
    $timeAgo1 = $hours . ($hours == 1 ? ' hour' : ' hours') . ' ago';
} elseif ($minutes > 0) {
    $timeAgo1 = $minutes . ($minutes == 1 ? ' minute' : ' minutes') . ' ago';
} else {
    $timeAgo1 = $seconds . ($seconds == 1 ? ' second' : ' seconds') . ' ago';
}
}
if (!$total_profit > 0 )
$total_profit = 0;


$products_count_sql = "SELECT COUNT(*) AS 'count' FROM restmenu";
$products_count_query = mysqli_query($con,$products_count_sql);
$products_count_query_res = mysqli_fetch_array($products_count_query);
$products_count = $products_count_query_res["count"];
if(! $products_count > 0) $products_count = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="css/index2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css.css">
    <style>
        .container{
            width:500%;
        }
        .host{
            font-size:15px;
            color:blue;
        }
        .red{
            color:#ef3038;
        }
        .red1{
            color:#fd5e53;
        }
        .black{
            color:black;
        }
    </style>
    <script>
function add() {
    window.location.href = "add_product.php";
}
function admin() {
    window.location.href = "admins.php";
}        
function profile() {
    window.location.href = "profile.php";
}
function costumers() {
    window.location.href = "costumers.php";
}
function history() {
    window.location.href = "history.php";
}
function pending() {
    window.location.href = "pending.php";
}
function neww() {
    window.location.href = "new.php";
}
function menu() {
    window.location.href = "products.php";
}

    </script>
</head>
<body>
    <div class="">
    <div class="innercard p-2">
           <?php
           include 'components/header.php';
            ?>
            
            <div class="row mt-3 p-2 g-3 d-flex justify-content-center">
                <div class="col-md-4">
                    <div class="card2 p-2 py-3">
                        <div class="text-center d-flex flex-column align-items-center">
                            <div> <img src="images/R.png" height="50px" width="50px" /> </div> <span class="stellar">Hello,<b> <?=$admin_info["adminName"];?></b></span>
                            <span class="host">begin in:<b><?=$admin_info["begin"];?></b></span>
                            <span class="price mt-2">WELECOME BACK</span>
                            <span class="year"><?=$admin_info["email"];?></span>
                            <button class="btn btn-success mt-2" onclick="profile()">Edit</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card2 p-2 py-3">
                        <div class="text-center d-flex flex-column align-items-center">
                            <div> <img src="images/R1.jpg" height="50px" width="50px" />
                            </div>
                                <span class="stellar">COSTUMERS</span>
                                <span class="hosting">informations</span>
                                <span class="price mt-2"><?=$users_count;?><span class="small"> COSTUMERS</span></span>
                                <span class="year">actions</span> 
                                <button class="btn btn-success mt-2" onclick="costumers()">Show</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card2 p-2 py-3">
                        <div class="text-center d-flex flex-column align-items-center">
                            <div> <img src="images/R2.jpg" height="50px" width="50px" />
                            </div>
                                <span class="stellar">ADMINS</span>
                                <span class="hosting">informations</span>
                                <span class="price mt-2"><?=$admins_count;?><span class="small"> ADMINS</span></span>
                                <span class="year">actions</span>
                                <button class="btn btn-success mt-2" onclick="admin()">Show</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 p-2 g-3 d-flex justify-content-center">
                <div class="col-md-4">
                    <div class="card2 p-2 py-3">
                        <div class="text-center d-flex flex-column align-items-center">
                            <div>
                            <img src="https://i.imgur.com/YzEqP6e.png" height="50px" width="50px" /> </div>
                            <span class="stellar">PROFIT</span>
                            <span class="hosting">history table</span>
                            <span class="price mt-2"><?=$total_profit;?><span class="small">$</span></span>
                            <span class="year">total profit</span>
                            <button class="btn btn-success mt-2" onclick="history()">Show</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card2 p-2 py-3">
                        <div class="text-center d-flex flex-column align-items-center">
                            <div> <img src="images/pending.png" height="50px" width="50px" /> </div>
                            <span class="stellar">PENDING</span>
                            <span class="hosting">in pending </span>
                            <span class="price mt-2"><b class="<?=$class;?>"><?=$pending;?></b> <span class="small"><b class="<?=$class1;?>">orders</b></span></span>
                            <span class="year"><?=$timeAgo;?></span>
                            <button class="btn btn-success mt-2" onclick="pending()">Show</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card2 p-2 py-3">
                        <div class="text-center d-flex flex-column align-items-center">
                            <div> <img src="images/new.png" height="50px" width="50px" /> </div>
                            <span class="stellar">NEW ORDERS</span>
                            <span class="hosting">comming</span>
                            <span class="price mt-2"><b class="<?=$value;?>"><?=$new;?></b> <span class="small"><b class="<?=$value1;?>">orders</b></span></span>
                            <span class="year"><?=$timeAgo1;?></span>
                            <button class="btn btn-success mt-2" onclick="neww()">Show</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 p-2 g-3 d-flex justify-content-center">
            <div class="col-md-4">
                <div class="card2 p-2 py-3">
                    <div class="text-center d-flex flex-column align-items-center">
                        <div> <img src="images/akl.png" height="50px" width="50px" /> </div>
                        <span class="stellar">Menu</span>
                        <span class="hosting">products</span>
                        <span class="price mt-2"><b><?=$products_count;?></b> <span class="small"><b>products</b></span></span>
                        <span class="year">update/View</span>
                        <button class="btn btn-success mt-2" onclick="menu()">Show</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card2 p-2 py-3">
                    <div class="text-center d-flex flex-column align-items-center">
                        <div> <img src="images/add.png" height="50px" width="50px" /> </div>
                        <span class="stellar">Add Product</span>
                        <span class="hosting">details</span>
                        <span class="price mt-2"><b>what s</b> <span class="small"><b>new</b></span></span>
                        <span class="year">Add</span>
                        <button class="btn btn-success mt-2" onclick="add()">Show</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card2 p-2 py-3">
                    <div class="text-center d-flex flex-column align-items-center">
                        <div> <img src="images/chat.png" height="50px" width="50px" /> </div>
                        <span class="stellar">Yummy Chat</span>
                        <span class="hosting">customrs messages</span>
                        <span class="price mt-2"><b><?=$products_count;?></b> <span class="small"><b>messages</b></span></span>
                        <span class="year">chat</span>
                        <button class="btn btn-success mt-2">Show</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
</body>
</html>
