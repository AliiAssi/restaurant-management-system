<?php
include '../components/connection.php';
$adminId= 1;
$admin_info_query_sql = "SELECT  * FROM restadmin WHERE adminId = $adminId";
$admin_info_query = mysqli_query($con, $admin_info_query_sql);
$admin_info = mysqli_fetch_array($admin_info_query);
?>
<?php
if(isset($_GET['update'])){
    $_SESSION['product_id'] = $_GET['update'];
    $productId= $_GET['update'];
    $product_sql = "SELECT * FROM restmenu WHERE productId = $productId";
    $product_query = mysqli_query($con,$product_sql);
    $fetch_product = mysqli_fetch_array($product_query);
    header("location:update.php");
}else{
    $productId = $_SESSION['product_id'];
    $product_sql = "SELECT * FROM restmenu WHERE productId = $productId";
    $product_query = mysqli_query($con,$product_sql);
    $fetch_product = mysqli_fetch_array($product_query);
    $_SESSION['productId'] =   $fetch_product['productId'];
}
if(isset($_POST['update_product'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $desc = '';
            if($category == "drinks"){
                $desc = $_POST['drink_category'];
            }
    $id = $_SESSION['product_id'];

    // Handle the image file upload
    if (isset($_FILES['image']['name']) && $_FILES['image']['name']!= "") {
     
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        if ($image_size > 2000000) {
            $_SESSION['image_error'] = true;
        }
        else {
            $sql = "UPDATE  restmenu
            SET productName = '$name',productPrice = $price,productCategory = '$category',productDesc = '$desc',productImage='$image'
            WHERE productId = $id";
            }
}
else
{
    $idd =  $_SESSION['productId'];
    $sql = "select productImage from restmenu where productId = $idd";
    $query = mysqli_query($con,$sql);
    $res = mysqli_fetch_array($query);
    $i = $res['productImage'];
    $sql = "UPDATE  restmenu
    SET productName = '$name',productPrice = $price,productCategory = '$category',productDesc = '$desc',productImage='$i'
    WHERE productId = $idd";
}
mysqli_query($con,$sql);
header("location:products.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index2.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css.css">
    <script>
        function showAlert() {
            var overlay = document.getElementById('overlay');
            overlay.style.display = 'block';
        }

        function closeAlert() {
            var overlay = document.getElementById('overlay');
            overlay.style.display = 'none';
        }
                // Function to show the popup
        function showPopup() {
            document.getElementById("alertPopup").style.display = "block";
        }

        // Function to close the popup
       
        function closePopup() {
            document.getElementById("alertPopup").style.display = "none";
        }
        function closePopup1() {
            document.location.href = "products.php";
        }

        function showSelectedOption() {
            const selectedOption = document.getElementById("selectedOption").value;
            const o = document.querySelector(".o");
            const oo = document.querySelector(".oo");
            if (selectedOption === "drinks") {
                o.style.display = "block";
                oo.style.display = "block";
            } else {
                o.style.display = "none";
                oo.style.display = "none";
            }
        }
        function drinks(){

            value = document.getElementById('his_id').value;
            changeBorderColor(value);

        }
        function changeBorderColor(value) {
            if(value === "hot")
            {
            document.getElementById('his_id').style.backgroundColor = "red";
            document.getElementById('his_id').style.color = "white";
            document.getElementById('his_id').style.border = "2px solid red";
            }
            else if(value === "cold"){
            document.getElementById('his_id').style.border = "2px solid blue";
            document.getElementById('his_id').style.color = "white";
            document.getElementById('his_id').style.backgroundColor = "blue";}

        }
      

    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const selectedOptionDisplay = document.getElementById("selectedOption");
        // Check the initial value on page load
        if (selectedOptionDisplay.value === "drinks") {
            const o = document.querySelector(".o");
            const oo = document.querySelector(".oo");
            o.style.display = "block";
            oo.style.display = "block";
        }
    });
</script>
    <style>


/* Style the custom select wrapper */
.custom-select-wrapper {
    position: relative;
    width: 200px;
    margin: 30px;
}

/* Style the custom select element */
.custom-selectt {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    width: 100%;
    padding: 10px;
    font-size: 15px;
    border: 2px solid #3498db;
    border-radius: 5px;
    background-color: #f5f5f5;
    color: #333;
    cursor: pointer;
    position: relative;
    z-index: 1;
}

.custom-selectt:focus {
    outline: none;
}

/* Style the custom select arrow */
.select-arrow {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid #3498db;
    z-index: 0;
}

/* Style the option details display */
.option-details {
    display: none;
    margin-top: 10px;
    padding: 10px;
    background-color: #3498db;
    color: #fff;
    border-radius: 5px;
}

        .red {
            color: red;
        }

        .blue {
            color: blue;
        }
        .padding {
            margin-left: 10px;
            width: 100%;
            display: block;
            /* or any other appropriate display value */
            margin: 0 auto;
            /* This will horizontally center the element within its container */
        }
        .o{
            display:none;
        }
        .oo{
            display:none;
        }
    </style>
</head>

<body>

    <div class="innercard p-2">
        <?php include 'components/header.php'; ?>
        <?php
        if(isset($_SESSION["image_error"]) && $_SESSION["image_error"] ){ 
        ?>
        <div class="popup" id="alertPopup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <p>image size plus large !</p>
        </div>
        </div>
        <?php
        $_SESSION["image_error"] = false;
        }
        ?>
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="../uploaded_img/<?=$fetch_product['productImage'];?>">
                        <span class="font-weight-bold">update product</span><span class="text-black-50"></span><span>
                        </span>
                    </div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Product Info</h4>
                        </div>
                        <form action="" method="post" name="ff" enctype="multipart/form-data">
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels">name</label><input type="text"
                                        class="form-control" placeholder="enter the name" name="name" value="<?=$fetch_product['productName'];?>" required></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">price</label><input type="number"
                                        class="form-control" min="10" name="price"
                                        value="<?=$fetch_product['productPrice'];?>"></div>

                                <div class="col-md-12"><label class="labels">category</label>
                                    <div class="select-wrapper">
                                        <select class="custom-select" name="category" id="selectedOption" onchange="showSelectedOption()" required>
                                            <option value="main dish"<?php if($fetch_product['productCategory'] == "main dish") echo "selected"; ?>>Main Dish</option>
                                            <option value="fast food" <?php if($fetch_product['productCategory'] == "fast food") echo "selected"; ?>>Fast Food</option>
                                            <option value="drinks" <?php if($fetch_product['productCategory'] == "drinks") echo "selected"; ?>>Drinks</option>
                                            <option value="desserts" <?php if($fetch_product['productCategory'] == "desserts") echo "selected"; ?>>Desserts</option>
                                            <option value="others" <?php if($fetch_product['productCategory'] == "others") echo "selected"; ?>>Others</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="col-md-12"><label class="labels"><br><div class="oo">drink type</label></div>
                                <div class="o">
                                    <select id="his_id" class="custom-selectt" onchange="drinks()" name="drink_category" required>
                                        <?php
                                        if ($fetch_product['productDesc'] == "") {
                                        ?>
                                            <option value="" disabled selected>select an option</option>
                                        <?php } ?>
                                        <option value="hot" <?php if ($fetch_product['productDesc'] == "hot") echo "selected"; ?>>HOT</option>
                                        <option value="cold" <?php if ($fetch_product['productDesc'] == "cold") echo "selected"; ?>>COLD</option>
                                    </select>
                                </div>

                                <div class="row mt-3">
                                    <br>
                                    <div class="file-input-wrapper">
                                        <input type="file" name="image" accept="image/*" id="fileInput" class="input-file" >
                                        <label for="fileInput" class="custom-label">Choose an image</label>
                                    </div>
                                    <div class="mt-5 text-center">
                                        <input type="submit" name="update_product" class="btn btn-primary profile-button" value="Save" />
                                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>