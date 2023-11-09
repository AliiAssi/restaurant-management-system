<?php
    include '../components/connection.php';
    $adminId= 1;

        function getSecondNumber($attribute) {
            // Find the position of the dash "-"
            $dashPos = strpos($attribute, '-');
        
            // Extract the part after the dash and convert it to an integer
            $secondNumber = (int) substr($attribute, $dashPos + 1);
        
            return $secondNumber;
        }
?>  
    <!DOCTYPE html>
    <html lang="en">
    <head>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css	">
        <link rel="stylesheet" href="css/index2.css">
        <link rel="stylesheet" href="css/costumers.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">    
        <link rel="stylesheet" href="css/pending.css">
        <style>
            
           
    .row{
        margin-top:5%;
    } 
    .btn1 {
        display: inline-block;
        color: #fff;
        background-image: linear-gradient(to right, #a81c07, #ff5a36 ); /* Gradient background */
        border: none;
        border-radius: 50px; /* Rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Shadow effect */
        cursor: pointer;
        position: relative;
        display: inline-block;
        text-align: center;
        transition: transform 0.3s ease-in-out; /* Animation on hover */
    }

    .btn1::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.2);
        transform: scale(0);
        transition: transform 0.3s ease-in-out; /* Animation on hover */
    }

    .btn1:hover {
        transform: translateY(-4px); /* Move the button slightly up on hover */
        text-decoration:none;
    }
    .btn3 {
        display: inline-block;
        color: #fff;
        background-image: linear-gradient(to right, #808000 , #b0c24a   ); /* Gradient background */
        border: none;
        border-radius: 50px; /* Rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Shadow effect */
        cursor: pointer;
        position: relative;
        display: inline-block;
        text-align: center;
        transition: transform 0.3s ease-in-out; /* Animation on hover */
    }
    .coll{
        width:100%;
        height:100%;
    }
    .col{
        height:100%;
    }
    .sub{
        width: 100%;
        height:100%;
    }

    .btn3::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.2);
        transform: scale(0);
        transition: transform 0.3s ease-in-out; /* Animation on hover */
    }
    .container{
        position: relative;
        background:#e2eaef;
        border:none;
    }
    .black{
        color:black;
    }
    .btn3:hover {
        transform: translateY(-4px); /* Move the button slightly up on hover */
        text-decoration:none;
    }

    .btn1:hover::before {
        transform: scale(1.1); /* Overlay effect on hover */
    }
    .btn2 {
        display: inline-block;
        color: #fff;
        background-image: linear-gradient(to right, #1c1cf0     , #1e90ff       ); /* Gradient background */
        border: none;
        border-radius: 50px; /* Rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Shadow effect */
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease-in-out; /* Animation on hover */
    }

    .btn2::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.2);
        transform: scale(0);
        transition: transform 0.3s ease-in-out; /* Animation on hover */
    }

    .btn2:hover {
        transform: translateY(-4px); /* Move the button slightly up on hover */
    }

    .btn2:hover::before {
        transform: scale(1.1); /* Overlay effect on hover */
    }
   body{
    position: relative;
   }
   .innercard{
        height:100%;
    }
    html{
        position: relative;

    }
    .card{
        border:none;
    }
    .red{
        color:#ff0000;
    }
    .red1{
        color:#fa8072;
    }
    .costumer_name{  
    display: inline-block;
    padding: 2px 6px;
    color:black; /* Customize the color to your preference */
    font-size: 25px;
    font-weight: bold;
  }
    .silver{
        color:#96ded1;
    }
    .container{
        height:100%;
    }
   
    .card{
        height:100%;
    }
    .center{
        margin-top:20%;
        width:30%;
        margin-left:34%;
    }
        </style>
    <body>
    <div class="innercard">
        <?php include 'components/header.php'; ?>
        <?php
            $sql = "SELECT * FROM restorder WHERE paymentStatus = 'pending' ";
            $query = mysqli_query($con, $sql);
            if(!mysqli_fetch_array($query)){
        ?>
        <div class="center">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>HELLO</strong> no pending orders yet
        </button>
        </div>
        </div>
        <?php
        }else{
        ?>
        
<div class="container mt-4">
    <?php
    $sql = "SELECT * FROM restorder,restuser WHERE restorder.userId = restuser.userId  AND  paymentStatus = 'pending' order by totalPrice desc ";
    }
    $query = mysqli_query($con, $sql);
    $records_per_row = 2; // Number of records per row
    $count = 0;
    $px = 75;
    while($res = mysqli_fetch_array($query)){
        $email = $res["email"];
        $costumer_name = $res["firstName"]."  ".$res["lastName"];
        $order_address = $res['userAdress'];
        $address_components = explode('/', $order_address);
        $mobile = $res['userPhoneCode']."/".$res['userPhoneNumber'];
        $email = $res["email"];
        $costumer_name = $res["firstName"] . " " . $res["lastName"];
        $costumer_country = $address_components[0];
        $costumer_city = $address_components[1];
        $costumer_area = $address_components[2];
        $costumer_other = $address_components[3];
        $order_totale = $res["totalPrice"];
        
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
        

        if($count % $records_per_row == 0){
            echo '<div class="row">';
        }
        ?>
<div class="col-md-6">
    <div class="card">
        <div class="container">
            <div class="sub">
                <div class="coll">
                    <div class="a">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body text-start text-black p-4">
                                    <h5 class="modal-title text-uppercase mb-5" id="exampleModalLabel">From: <b class="costumer_name"><?=$costumer_name;?></b></h5>
                                    <p class="mb-0" style="color: #35558a;">Customer Info</p>
                                    <hr class="mt-2 mb-4" >
                                    <div class="d-flex justify-content-between">
                                        <p class="small mb-0">Mobile</p>
                                        <p class="small mb-0"><?=$mobile;?></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="small mb-0">Email</p>
                                        <p class="small mb-0"><?=$email;?></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="small mb-0">Country</p>
                                        <p class="small mb-0"><?=$costumer_country;?></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="small mb-0">City</p>
                                        <p class="small mb-0"><?=$costumer_city;?></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="small mb-0">Area</p>
                                        <p class="small mb-0"><?=$costumer_area;?></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="small mb-0">Other Info</p>
                                        <p class="small mb-0"><?=$costumer_other;?></p>
                                    </div>

                                    <br>
                                    <p class="mb-0" style="color: #35558a;">Payment summary</p>
                                    <hr class="mt-2 mb-4" >
                                    <?php
                                    $i = 0;

                                    while ($i < count($products))
                                    {
                                    ?>
                                        <div class="d-flex justify-content-between">
                                            <p class="fw-bold mb-0"><?=$products[$i][0];?></p>
                                            <p class="text-muted mb-0">qty:<b class="black"><?=$products[$i][1];?></b></p>
                                        </div>
                                        <?php
                                        $i += 1; 
                                    }  
                                    ?>
                                    <br>
                                    <div class="d-flex justify-content-between">
                                        <p class="fw-bold"><span class="red">Total</span><span class="red1">(with shipping)</span></p>
                                        <p class="fw-bold"><span class="red"><?=$order_totale;?>$</span></p>
                                    </div>

                                </div>
                                <div class="modal-footer d-flex justify-content-center border-top-0 py-4">
                                <div class="button-container">
                                    <a href="control/complete.php?id=<?=$res['orderId'];?>" class="button1">
                                        <span class="button1-text">Complete</span>
                                        <span class="button1-icon">&#10003;</span>
                                    </a>
                                    <a href="control/delete.php?id=<?=$res['orderId'];?>&&page=pending" class="buttonn" onclick="return confirm('Do you really want to delete the item?');" >
                                        <span class="button-text">Delete</span>
                                        <span class="button-icon">&#128465;</span>
                                    </a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end of card -->
</div><!-- end of col-md-6 -->
   
        <?php
        if($count % $records_per_row == ($records_per_row - 1)){
            echo '</div>'; // Close the row
        }
        $count++;
    }

    if($count % $records_per_row != 0){
        echo '</div>';
    }
    ?>
</div> 
</div>
</body>
</html>
