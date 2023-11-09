<?php
include '../components/connection.php';
if(!isset($_SESSION["userId"]))
{
    header("login.php");
}
else{
	$userId = $_SESSION["userId"];
}
?>
<?php
$sql = "SELECT * FROM restorder WHERE userId = $userId";
if(isset($_POST['ici']))
{
    $record = $_POST['record'];
    $filter = $_POST['filter'];
    if($filter != "all")
        $sql = " SELECT * FROM restorder WHERE userId = $userId AND paymentStatus = '$filter' LIMIT $record";
    else
        $sql = "SELECT * FROM restorder WHERE userId = $userId LIMIT $record";    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders_summary</title>
    <link rel="stylesheet" href="../components/css/orders_summary.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
         .filter-button {
            right:0;
            margin-top: 50%;
        padding: 10px 20px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .filter-button:hover {
        background-color: #2980b9;
    }

    table td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ccc;
    }

    .link {
        display: inline-block;
        padding: 8px 12px;
        text-decoration: none;
        color: #333;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: background-color 0.2s, transform 0.2s;
    }

    .link:hover {
        background-color: #f0f0f0;
        transform: translateY(-2px);
    }

    .icon {
        margin-right: 6px;
    }

    .disabled {
        pointer-events: none;
        color: #ccc;
        border: 1px solid #ccc;
        background-color: #f5f5f5;
    }

    </style>
</head>
<?php include '../components/cosHeader.php'; ?>
<body style="background:#e2eaef;">
    <br> 
    <div class="filter-container">
    <div class="select-container">
            <label for="select-box"><b>Select nb of records:</b></label>
            <form action="" method="post">
            <select name="record" id="recording">
                <option value="10" <?php if(isset($_POST['record']) && $_POST['record'] == "10"){echo "selected"; } ?>>10</option>
                <option value="50" <?php if(isset($_POST['record']) && $_POST['record'] == "50"){echo "selected"; } ?>>50</option>
                <option value="100"<?php if(isset($_POST['record']) && $_POST['record'] == "100"){echo "selected"; } ?>>100</option>
            </select>
        </div>
        <div class="select-container">
            <label for="select-box"><b>types:</b></label>
            <select id="filtering" name="filter">
                <option value="all"<?php if(isset($_POST['filter']) && $_POST['filter'] == "all"){echo "selected"; } ?>>ALL</option>
                <option value="pending"<?php if(isset($_POST['filter']) && $_POST['filter'] == "pending"){echo "selected"; } ?>>Pending</option>
                <option value="complete"<?php if(isset($_POST['filter']) && $_POST['filter'] == "complete"){echo "selected"; } ?>>Delivered</option>
            </select>
        </div>
        <div>
            <input type="submit" class="filter-button" name="ici" value="Filter">
            </form>
        </div>
    </div>
    <br>
    <table>
        <tr>
            <th>ID</th>
            <th>details</th>
            <th>placed on</th>
            <th>Price</th>
            <th>Action</th>
            <th>tracker</th>
        </tr>
        <?php
        $query = mysqli_query($con,$sql);
        $find = true;
        while($res = mysqli_fetch_array($query)){
            $find = false;
            $paymentStatus = $res['paymentStatus'];
            $id = $res['orderId'];
        ?>
        <tr>
            <td><?=$res['orderId'];?></td>
            <td><?=$res['totalProducts']?></td>
            <td><?=$res['placedOn']?></td>
            <td><?=$res['totalPrice']?>$</td>
            <?php
                if($paymentStatus != ''){
            ?>
            <td>
                <a class="link disabled" href="#">
                    <span class="icon">🚫</span> Cancel
                </a>
            </td>    
                <?php }else{ ?>
            <td>
                <a class="link" href="../control/cancel.php?id=<?=$id;?>">
                    <span class="icon">🗑️</span> Cancel
                </a>
            </td>
                <?php } ?>
            </td>
            <td>
                <a class="link" href="order_tracker.php?id=<?=$id;?>">
                    <span class="icon">📍</span> Details
                </a>
            </td>
            
        </tr>
        <?php }
        if($find){
        ?>
        <tr>
            <td colspan="5">not found</td>
            <td></td>
        </tr>
        <?php } ?>
        <!-- Add more rows for additional products as needed -->
    </table>

</body>
</html>
         