<?php
include '../components/connection.php';
if (!isset($_SESSION["userId"])) {
    header("login.php");
} else {
    $userId = $_SESSION["userId"];
    if(isset($_SESSION['nono']))
    header("location:my_orders.php");
}
?>

<html lang="en">

<head>
    <style>
        body {
            background: red;
            display: flex;
        }

        .card {
            margin: auto;
            width: 50%;
            max-width: 600px;
            border-radius: 20px
        }

        .mt-50 {
            margin-top: 50px;
        }

        .mb-50 {
            margin-bottom: 50px;
        }



        #orderno {
            padding: 1vh 2vh 0;
            font-size: smaller
        }

        .gap .col-2 {
            background-color: rgb(213, 217, 233);
            width: 1.2rem;
            padding: 1.2rem;
            margin-top: -2.5rem;
            border-radius: 1.2rem
        }

        .title {
            display: flex;
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            padding: 12%
        }

        .main {
            padding: 0 2rem
        }

        .main img {
            border-radius: 7px
        }

        .main p {
            margin-bottom: 0;
            font-size: 0.75rem
        }

        #sub-title p {
            margin: 1vh 0 2vh 0;
            font-size: 1rem
        }

        .row-main {
            padding: 1.5vh 0;
            align-items: center
        }

        hr {
            margin: 1rem -1vh;
            border-top: 1px solid rgb(214, 214, 214)
        }

        .total {
            font-size: 1rem
        }



        .btn1 {
            background-color: rgb(3, 122, 219);
            border-color: rgb(3, 122, 219);
            color: white;
            margin: 7vh 0;
            border-radius: 7px;
            width: 60%;
            font-size: 0.8rem;
            padding: 0.8rem;
            justify-content: center
        }

        .btn1:focus {
            box-shadow: none;
            outline: none;
            box-shadow: none;
            color: white;
            -webkit-box-shadow: none;
            transition: none
        }

        .btn1:hover {
            color: white
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../components/css/orders_summary.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<?php include '../components/cosHeader.php'; ?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM restorder WHERE orderId = $id";
$auery = mysqli_query($con,$sql);
$res = mysqli_fetch_array($auery);
$products_details = explode('-', $res['totalProducts']);
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
?>

<body style="background:#e2eaef;">
    <div class="card mt-50 mb-60" style="margin-top:90px;">
        <div class="col d-flex"><span class="text-muted" id="orderno">order <?= $_GET['count'] + 1; ?></span></div>
        <div class="gap">
            <div class="col-2 d-flex mx-auto"> </div>
        </div>
        <div class="title mx-auto"> Thank you for your order! </div>
        <div class="main"> <span id="sub-title">
                <p><b>Payment Summary</b></p>
            </span>
            <!-- start of item -->
        
            <?php
            $i = count($products) - 1;
            $totale = 0;
            while($i >= 0){
                $name = $products[$i][0];
                $sql = "SELECT * FROM restmenu WHERE productName = '$name'";
                $query = mysqli_query($con,$sql);
                $res = mysqli_fetch_array($query);
                $image = "../uploaded_img/".$res['productImage'];
            ?>
            <div class="row row-main">
                <div class="col-3"> <img class="img-fluid" src="<?=$image?>"> </div>
                <div class="col-6">
                    <div class="row d-flex">
                        <p><b><?=$products[$i][0]?></b></p>
                    </div>
                    <div class="row d-flex">
                        <p class="text-muted">qty:<?=$products[$i][1] ?></p>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-end">
                    <p><b>$<?=$products[$i][1] * $res['productPrice']; ?></b></p>
                </div>
            </div>
            <?php             $totale +=  $products[$i][1] * $res['productPrice']; $i --;
            } ?>
            <!-- end of item -->

            <hr>
            <div class="total">
                <div class="row">
                    <div class="col"> <b> Total:</b> </div>
                    <div class="col d-flex justify-content-end"> <b>$<?=$totale?></b> </div>
                </div> <button class="btn1 d-flex mx-auto" onclick="redirect()"> Track your order </button>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    function redirect(){
        document.location.href="my_orders.php";
    }
</script>