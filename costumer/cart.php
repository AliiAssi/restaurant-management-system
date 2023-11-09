<?php
include '../components/connection.php';
if(!isset($_SESSION["userId"]))
{
    header("login.php");
}
else{
	$userId = $_SESSION["userId"];
    $cart_sql = "SELECT * FROM restcart WHERE userId = $userId LIMIT 1";
    $cart_query = mysqli_query($con, $cart_sql);
    $cart_res = mysqli_fetch_array($cart_query);
    $found = true;
    if(!$cart_res)
        $found = false;
}
?>
<?php include '../components/cosHeader.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart shopping</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <style>
        /* Basic button styles */
.nextt {
  display: inline-block;
  padding: 15px 30px;
  font-size: 16px;
  text-align: center;
  text-decoration: none;
  border: none;
  border-radius: 5px;
  background-color: #4CAF50;
  color: #fff;
  cursor: pointer;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s, transform 0.2s;
  width: 100%;
}

.nextt:hover {
  background-color: #45a049;
  transform: scale(1.05);
}

.nextt:active {
  background-color: #408e3d;
}

/* Disabled state */
.nextt:disabled {
  pointer-events: none;
  opacity: 0.5;
  cursor: not-allowed;
  box-shadow: none;
  background-color: #ccc;
}

/* Additional styles for a complex look */
.nextt {
  position: relative;
  overflow: hidden;
  transition: background-color 0.3s, transform 0.2s;
}

.nextt:before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 0;
  height: 100%;
  background-color: rgba(255, 255, 255, 0.1);
  transition: width 0.3s;
}

.nextt:hover:before {
  width: 100%;
}

.nextt.disabled:before {
  background-color: rgba(0, 0, 0, 0.1);
}

.nextt span {
  position: relative;
  z-index: 2;
}

/* Media query for responsive design (adjust as needed) */
@media (max-width: 768px) {
  .nextt {
    padding: 10px 20px;
    font-size: 14px;
  }
}

        .no:hover {
            padding: 0px;
            letter-spacing: 0px;
        }

        body {
            align-items: center;
        }

        .test {
            margin-left: 10%;
        }

        .next {
            width: 100%;
            height: 100%;
        }

        .selectt {
            background: none;
            border: none;
        }

        .option {
            border: none;
        }

        /* Basic button styles */
        .next {
            display: inline-block;
            padding: 15px 30px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, transform 0.2s;
        }

        .next:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .next:active {
            background-color: #408e3d;
        }

        /* Loading animation */
        .next.loading {
            position: relative;
        }

        .next.loading:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            width: 25px;
            height: 25px;
            border-top: 3px solid #fff;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        /* Disabled state */
        .next.disabled {
            pointer-events: none;
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Media query for responsive design (adjust as needed) */
        @media (max-width: 768px) {
            .next {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
    <link rel="stylesheet" href="../components/css/cart.css">
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="test">
            <div class="d-flex justify-content-center row">
                <div class="col-md-8">
                    <div class="p-2">
                        <h4>Shopping cart</h4>
                    </div>
                    <!-- start of item -->
                    <?php
                    if(!$found){
                        ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>YUMY:</strong> no items yet
                        </div>
                        
                    <?php }
                    else{
                        $cart_sql = "SELECT * FROM restcart,restmenu WHERE restcart.productId = restmenu.productId AND userId = $userId";
                        $cart_query = mysqli_query($con, $cart_sql);
                        while($cart_res = mysqli_fetch_array($cart_query)){
                        $image = $cart_res['productImage'];
                        $category = $cart_res['productCategory'];
                        $name= $cart_res['productName'];
                        $price = $cart_res['productPrice'];
                        $qty = $cart_res['productQty'];
                        $sub_total = $qty * $price;
                        $id = $cart_res['cartId'];    
                    ?>
                    <div
                        class="d-flex flex-row justify-content-between align-items-center p-2 bg-white mt-4 px-3 rounded">
                        <div class="mr-1"><img class="rounded" src="../uploaded_img/<?=$image;?>" width="70"></div>
                        <div class="d-flex flex-column align-items-center product-details"><span
                                class="font-weight-bold"><?=$name;?></span>
                            <div class="d-flex flex-row product-desc">
                                <div class="color"><span class="text-grey">price:</span><span
                                        class="font-weight-bold">&nbsp;<?=$price;?>$</span></div>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center qty"><a href="../control/minus_qty.php?item=<?=$id;?>"><i
                                    class="fa fa-minus text-danger"></a></i>
                            <h5 class="text-grey mt-1 mr-1 ml-1"><?=$qty;?></h5><a href="../control/add_qty.php?item=<?=$id;?>"><i
                                    class="fa fa-plus text-success"></a></i>
                        </div>
                        <div>
                            <h5 class="text-grey"><?=$sub_total;?>$</h5>
                        </div>
                        <div class="d-flex align-items-center"><a href="../control/delete_item.php?item=<?=$id;?>" class="no"><i
                                    class="fa fa-trash mb-1 text-danger"></i></a></div>
                    </div>
                    <!-- end of item -->
                    <?php }} ?>
                    <form action="checkout.php" method="post">
                        <div class="d-flex flex-row align-items-center mt-3 p-2 bg-white rounded">
                        <?php
                        if(!$found){
                        ?>
                        <input type="submit" value="proceed to checkout" class="nextt" disabled>
                        <?php
                        }
                        else{
                        ?>
                            <input type="submit" value="proceed to checkout" class="next">
                        <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>