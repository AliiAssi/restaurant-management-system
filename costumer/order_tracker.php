<?php
include '../components/connection.php';
if(!isset($_SESSION["userId"]))
{
    header("login.php");
}
else{
	$userId = $_SESSION["userId"];
    if(isset($_GET['id'])){
        

        $id = $_GET['id'];
        $SQL = "SELECT * FROM restorder  WHERE orderId = $id";
        $query = mysqli_query($con,$SQL);
        $res = mysqli_fetch_array($query);
        $order_id = $res['orderId'];
        $order_products = $res['totalProducts'];
        $order_totale = $res['totalPrice'];
        $placedOn = $res['placedOn'];
        $adress = $res['userAdress'];
        $payment = $res['paymentStatus'];

        
        $products_details = explode('-', $order_products);
        array_pop($products_details);
        $products = []; // Initialize the products array
        $countt = count($products_details);
        $i = 0;
        
        while ($i < $countt) {
            $index_of_first_parenthesis = strpos($products_details[$i], "(");
            $index_of_x = strpos($products_details[$i], "x");
            $index_of_second_parenthesis = strpos($products_details[$i], ")");
        
            $product_name = substr($products_details[$i], 0, $index_of_first_parenthesis);
            $product_qty = substr($products_details[$i], $index_of_x + 1, $index_of_second_parenthesis - $index_of_x - 1);
        
            $products[] = [$product_name, $product_qty]; // Add the product details to the array
        
            $i++;
        }


    }else{
        header("location:orders_summary.php");
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../components/css/order_tracker.css">
    <link rel="stylesheet" href="../components/css/orders_summary.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<?php include '../components/cosHeader.php'; ?>
<body style="background:#e2eaef;">
<div class="card">
            <div class="title">Order</div>
            <div class="info">
                <div class="row">
                    <div class="col-7">
                        <span id="heading">Date</span><br>
                        <span id="details"><?=$placedOn;?></span>
                    </div>
                    <div class="col-5 pull-right">
                        <span id="heading">Your Adress</span><br>
                        <span id="details"><?=$adress;?></span>
                    </div>
                </div>      
            </div>      
            <div class="pricing">
                <?php
                $i = 0;
                while($i < count($products)){
                ?>
                <div class="row">
                    <div class="col-9">
                        <span id="name"><?=$products[$i][0]?></span>  
                    </div>
                    <div class="col-3">
                    <span id="price"><?=$products[$i][1]?></span>
                    </div>
                    
                </div>
                <?php
                $i ++;
                 } ?>
                
            </div>
            <div class="total">
                <div class="row">
                    <div class="col-9">TOTAL</div>
                    <div class="col-3"><big>$<?=$order_totale?></big></div>
                </div>
            </div>
            <div class="tracking">
                <div class="title">Tracking Order</div>
            </div>

            <?php
            if($payment == ""){
            ?>
            <div class="progress-track">
                <ul id="progressbar">
                    <li class="step0 active " id="step1">Ordered</li>
                    <li class="step0  text-center" id="step2">pending</li>
                    <li class="step0   text-right" id="step3">On the way</li>
                    <li class="step0  text-right" id="step4">completed</li>
                </ul>
            </div>
            <?php } ?>
            <?php
            if($payment == "pending"){
            ?>
            <div class="progress-track">
                <ul id="progressbar">
                    <li class="step0 active " id="step1">Ordered</li>
                    <li class="step0  active text-center" id="step2">pending</li>
                    <li class="step0   text-right" id="step3">On the way</li>
                    <li class="step0  text-right" id="step4">completed</li>
                </ul>
            </div>
            <?php } ?>
            <?php
            if($payment == "complete"){
            ?>
            <div class="progress-track">
                <ul id="progressbar">
                    <li class="step0 active " id="step1">Ordered</li>
                    <li class="step0  active text-center" id="step2">pending</li>
                    <li class="step0 active  text-right" id="step3">On the way</li>
                    <li class="step0  text-right" id="step4">completed</li>
                </ul>
            </div>
            <?php } ?>
            

            
        </div>
</body>
</html>