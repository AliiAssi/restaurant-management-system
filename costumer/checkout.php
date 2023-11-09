<?php
include '../components/connection.php';
if (!isset($_SESSION["userId"])) {
  header("Location: login.php");
  exit();
}
$userId = $_SESSION["userId"];

$sql = "SELECT   * FROM  restcart WHERE userId= $userId";
$query = mysqli_query($con,$sql);
if(!mysqli_fetch_array($query))
{
    header("location:cart.php");
    exit();
}



?>
<?php
$result = mysqli_query($con, "SELECT * FROM restuser WHERE userId = $userId");
if (!$result) {
    die("Error in database query: " . mysqli_error($con));
}
$row = mysqli_fetch_assoc($result);
$firstName = $row["firstName"];
$lastName = $row["lastName"];
$name = $firstName . " " . $lastName;
$name = strtoupper($name);
$databaseDate = $row["begin"];
$formattedDate = "joined " . date("F, Y", strtotime($databaseDate));
$email = $row["email"];
$phone_code =  $row["userPhoneCode"];
$number_of_telefone =$row["userPhoneNumber"];
$country = $row["userCountry"];
$city = $row["userCity"];
$area = $row["userArea"];
$other = $row["userOther"];
?>
<?php include '../components/cosHeader.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css"
        integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css"
    rel="stylesheet"
    />
    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"
    ></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="../menu.css">
    <title>checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../components/css/checkout.css">
    <style>
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <ol class="activity-checkout mb-0 px-4 mt-3">
                            <li class="checkout-item">
                                <div class="avatar checkout-icon p-1">
                                    <div class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-receipt text-white font-size-20"></i>
                                    </div>
                                </div>
                                <div class="feed-item-list">
                                    <div>
                                        <h5 class="font-size-16 mb-1">adress    Info</h5>
                                        <p class="text-muted text-truncate mb-4">your current adress</p>
                                        <div class="mb-3">
                                            <form>
                                                <span>
                                                    <b> <?=$country."/".$city."/".$area."/".$other;?></b>
                                                </span>
                                                <br>
                                                <br>
                                                <a class="btn1" href="edit_profile.php">change adress</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                           
                            <li class="checkout-item">
                                <div class="avatar checkout-icon p-1">
                                    <div class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-wallet-alt text-white font-size-20"></i>
                                    </div>
                                </div>
                                <div class="feed-item-list">
                                    <div>
                                        <h5 class="font-size-16 mb-1">Payment Info</h5>
                                        <p class="text-muted text-truncate mb-4"></p>
                                    </div>
                                    <div>
                                        <h5 class="font-size-14 mb-3">Payment method :</h5>
                                        <div class="row">
                                            <div class="col-lg-3 col-sm-6">
                                            <form>
                                                <div data-bs-toggle="collapse">
                                                    <label class="card-radio-label">
                                                        <input type="radio" onclick="credit()" name="pay-method" id="pay-methodoption1"
                                                            class="card-radio-input">
                                                        <span class="card-radio py-3 text-center text-truncate">
                                                            <i class="bx bx-credit-card d-block h2 mb-3"></i>
                                                            Credit / Debit Card
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-6">
                                                <div>
                                                    <label class="card-radio-label">
                                                        <input type="radio" onclick="paypal()" name="pay-method" id="pay-methodoption2"
                                                            class="card-radio-input">
                                                        <span class="card-radio py-3 text-center text-truncate">
                                                            <i class="bx bxl-paypal d-block h2 mb-3"></i>
                                                            Paypal
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-6">
                                                <div>
                                                    <label class="card-radio-label">
                                                        <input type="radio" onclick="delivery()" name="pay-method" id="pay-methodoption3"
                                                            class="card-radio-input" checked="">
                                                        <span class="card-radio py-3 text-center text-truncate">
                                                            <i class="bx bx-money d-block h2 mb-3"></i>
                                                            <span>Cash on Delivery</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </from>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col">
                        <a href="cosMenu.php" class="btn btn-link text-muted">
                            <i class="mdi mdi-arrow-left me-1"></i>menu </a>
                    </div>
                    <div class="col">
                        <div class="text-end mt-2 mt-sm-0">
                            <a href="../control/new_order.php" class="btn btn-success">
                                <i class="mdi mdi-cart-outline me-1"></i> Proceed
                            </a>
    
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card checkout-order-summary">
                    <div class="card-body">
                        <div class="p-3 bg-light mb-3">
                            <h5 class="font-size-16 mb-0">Order Summary <span class="float-end ms-2">#MN0124</span></h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-centered mb-0 table-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-top-0" style="width: 110px;" scope="col">Product</th>
                                        <th class="border-top-0" scope="col">Product Desc</th>
                                        <th class="border-top-0" scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM restmenu,restcart WHERE restmenu.productId = restcart.productId AND userId = $userId";
                                    $query = mysqli_query($con,$sql);
                                    $total = 0;
                                    while($result = mysqli_fetch_array($query)){
                                        $image = $result['productImage'];
                                        $category = $result['productCategory'];
                                        $name= $result['productName'];
                                        $price = $result['productPrice'];
                                        $qty = $result['productQty'];
                                        $sub_total = $qty * $price;
                                        $total += $sub_total;
                                    ?>
                                    <tr>
                                        <th scope="row"><img src="../uploaded_img/<?=$image;?>"
                                                alt="product-img" title="product-img" class="avatar-lg rounded"></th>
                                        <td>
                                            <h5 class="font-size-16 text-truncate"><span href="#"
                                                    class="text-dark"><?=$name;?></span></h5>
                                           
                                            <p class="text-muted mb-0 mt-1">$ <?=$price;?> x <?=$qty;?></p>
                                        </td>
                                        <td>$ <?=$sub_total;?></td>
                                    </tr>
                                    <?php } ?>
                                        <td colspan="2">
                                            <h5 class="font-size-14 m-0">Estimated Tax :</h5>
                                        </td>
                                        <td>
                                            $ 0.0
                                        </td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td colspan="2">
                                            <h5 class="font-size-14 m-0">Total:</h5>
                                        </td>
                                        <td>
                                            $ <?=$total;?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
</body>
</html>
<script>  
    var a = document.getElementById("payment");
   function credit()
    {
        a.value = 1;
    }
    function paypal()
    {
        a.value = 2;
    }
    function delivery()
    {
        a.value = 3;
    }
</script>