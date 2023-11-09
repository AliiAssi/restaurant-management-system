<?php
    include '../components/connection.php';
    $adminId= 1;
    $admin_info_query_sql = "SELECT  * FROM restadmin WHERE adminId = $adminId";
    $admin_info_query = mysqli_query($con, $admin_info_query_sql);
    $admin_info = mysqli_fetch_array($admin_info_query);
?>
<?php
$products_sql = "SELECT * FROM restmenu";

if(isset($_GET['sort'])){
    $sort = $_GET["sort"];
    if($sort == 1){
        $products_sql = "SELECT * FROM restmenu order by productName asc";
        $_SESSION["sort"] = 1;
    }
    else if($sort ==2){
        $products_sql = "SELECT * FROM restmenu order by productName desc";
        $_SESSION["sort"] = 2;
    }
    else if($sort == 3){
        $products_sql = "SELECT * FROM restmenu order by productCategory";
        $_SESSION["sort"] = 3;
    }
}
if(isset($_POST["search"])){
    $search = $_POST["what"];
    $products_sql = "SELECT * FROM restmenu WHERE productName like '$search%' ";
    if(isset($_SESSION["sort"])){
        $sort = $_SESSION['sort'];
        if($sort == 1){
            $products_sql .= " order by productName asc";
            $_SESSION["sort"] = 1;
        }
        else if($sort ==2){
            $products_sql .= " order by productName desc";
            $_SESSION["sort"] = 2;
        }
        else if($sort == 3){
            $products_sql .= " order by productCategory";
            $_SESSION["sort"] = 3;
        }
    }
}
if(isset($_POST["undo"])){
    $products_sql = "SELECT * FROM restmenu";

    if(isset($_SESSION["sort"])){
        $sort = $_SESSION['sort'];
        if($sort == 1){
            $products_sql .= " order by productName desc";
            $_SESSION["sort"] = 1;
        }
        else if($sort ==2){
            $products_sql .= " order by productName asc";
            $_SESSION["sort"] = 2;
        }
        else if($sort == 3){
            $products_sql .= " order by productCategory";
            $_SESSION["sort"] = 3;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <script>
        function handleSortChange() {
            var sortOption = document.getElementById("sort").value;
            if (sortOption === "z-a")
                window.location.href = "products.php?sort=2";
            else if (sortOption === "a-z")
                window.location.href = "products.php?sort=1";
            else if (sortOption === "categories")
                window.location.href = "products.php?sort=3";
        }
    </script>
    <link rel="stylesheet" href="css/index2.css">
    <link rel="stylesheet" href="css/products.css">
    <link rel="stylesheet" href="css/costumers.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .center-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #bcd4e6;
            padding: 20px;
        }

        .sort-container,
        .search-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Add necessary styling to the popup */
        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            /* Add this property to position the div absolutely within its parent */
            position: absolute;
            /* Specify the position from the top and left of the parent container */
            top: 20%;
            left: 50%;
            /* Translate the div to center it on the parent container */
            transform: translate(-50%, -50%);

            /* Add other styles for the content */
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }


        /* Add any other necessary styling for buttons, etc. */


        .sort-container label,
        .search-container label {
            font-size: 18px;
            font-weight: bold;
            margin-right: 10px;
        }

        select,
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.2s ease-in-out;
        }

        select {
            min-width: 150px;
        }

        input[type="text"] {
            min-width: 300px;
        }

        select:focus,
        input[type="text"]:focus {
            border-color: #007bff;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        button:hover {
            background-color: #0056b3;
        }

        .row {
            margin-top: 5%;
        }

        .btn1 {
            display: inline-block;
            color: #fff;
            background-image: linear-gradient(to right, #a81c07, #ff5a36);
            /* Gradient background */
            border: none;
            border-radius: 50px;
            /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            /* Shadow effect */
            cursor: pointer;
            position: relative;
            display: inline-block;
            text-align: center;
            transition: transform 0.3s ease-in-out;
            /* Animation on hover */
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
            transition: transform 0.3s ease-in-out;
            /* Animation on hover */
        }

        .btn1:hover {
            transform: translateY(-4px);
            /* Move the button slightly up on hover */
            text-decoration: none;
        }

        .btn3 {
            display: inline-block;
            color: #fff;
            background-image: linear-gradient(to right, #808000, #b0c24a);
            /* Gradient background */
            border: none;
            border-radius: 50px;
            /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            /* Shadow effect */
            cursor: pointer;
            position: relative;
            display: inline-block;
            text-align: center;
            transition: transform 0.3s ease-in-out;
            /* Animation on hover */
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
            transition: transform 0.3s ease-in-out;
            /* Animation on hover */
        }

        .btn3:hover {
            transform: translateY(-4px);
            /* Move the button slightly up on hover */
            text-decoration: none;
        }

        .btn1:hover::before {
            transform: scale(1.1);
            /* Overlay effect on hover */
        }

        .btn2 {
            display: inline-block;
            color: #fff;
            background-image: linear-gradient(to right, #1c1cf0, #1e90ff);
            /* Gradient background */
            border: none;
            border-radius: 50px;
            /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            /* Shadow effect */
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            /* Animation on hover */
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
            transition: transform 0.3s ease-in-out;
            /* Animation on hover */
        }

        .btn2:hover {
            transform: translateY(-4px);
            /* Move the button slightly up on hover */
        }

        .btn2:hover::before {
            transform: scale(1.1);
            /* Overlay effect on hover */
        }
        .price-wrap{
            margin-left:45%;
        }

        .container {
            background: #e2eaef;
        }

        .card {
            background: #e2eaef;
            border: none;
        }

        .hot {
            color: red;
        }

        .cold {
            color: blue;
        }
        /* Common styles for the button */
/* Common styles for the button */
.buttonn {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    text-align: center;
    cursor: pointer;
    text-decoration: none;
    color: white;
    transition: background-color 0.2s ease, color 0.2s ease;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Styling for the "Delete" button */
.delete {
    background-color: #dc3545; /* Red background color */
    padding: 10px 15px;
}

.delete:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.1);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.delete:hover:before {
    opacity: 1;
}

.delete:hover {
    color: white;
    text-decoration: none;
    background-color: #c82333; /* Darker red on hover */
    transform: translateY(-2px); /* Move the button slightly up on hover */
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15); /* Add a deeper shadow on hover */
}
/* Common styles for the button */
.button1 {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    text-align: center;
    cursor: pointer;
    text-decoration: none;
    color: white;
    transition: background-color 0.2s ease, color 0.2s ease;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Styling for the "Update" button */
.update {
    background-color: green; /* Blue background color */
    padding: 10px 15px;
}

.update:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.1);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.update:hover:before {
    opacity: 1;
}

.update:hover {
    color: white;
    text-decoration: none;
    background-color: #0056b3; /* Darker blue on hover */
    transform: translateY(-2px); /* Move the button slightly up on hover */
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15); /* Add a deeper shadow on hover */
}
.bottom-wrap {
    display: flex;
    justify-content: space-between; /* Adjust as needed */
    align-items: center; /* Adjust as needed */
}

    </style>
    <?php
    $script_sql = "SELECT productId FROM restmenu";
    $script_query = mysqli_query($con,$script_sql);
    while($res = mysqli_fetch_array($script_query)){
        $id = $res['productId'];
    ?>
    <script>
        // Function to show the popup alert
        function showPopup<?=$id;?>() {
            const popup = document.getElementById('popupAlert<?=$id;?>');
            popup.style.display = 'flex';
        }
        // Function to hide the popup alert
        function hidePopup<?=$id;?>() {
            const popup = document.getElementById('popupAlert<?=$id;?>');
            popup.style.display = 'none';
        }
    </script>
    <?php } ?>

<body>
    <div class="innercard p-2">
        <?php include 'components/header.php'; ?>
        <?php
            $query = mysqli_query($con, "select * from restmenu LIMIT 1");
            if(!mysqli_fetch_array($query)){
        ?>
        not found
        <?php
        }else{
        ?>

        <div class="container mt-4">
            <div class="center-container">
                <div class="sort-container">
                    <label for="sort">Sort:</label>
                    <select id="sort" onchange="handleSortChange()">
                        <option value="a-z" <?php if(isset($_GET["sort"]) && $_GET["sort"] == 1) echo "selected";  ?>>A
                            to Z</option>
                        <option value="z-a" <?php if(isset($_GET["sort"]) && $_GET["sort"] == 2) echo "selected";  ?>>Z
                            to A</option>
                        <option value="categories"
                            <?php if(isset($_GET["sort"]) && $_GET["sort"] == 3) echo "selected";  ?>>categories
                        </option>
                    </select>
                </div>
                <form action="products.php" method="post">
                    <div class="search-container">
                        <label for="search">Search:</label>
                        <input type="text" id="what" name="what" required placeholder="Type here to search...">
                        <label for=""></label><button name="search"
                            class="btn2 btn-sm btn-outline-primary w-50 mr-1">search</button>
                        <label for=""></label>
                </form>
                <form action="">
                    <?php if(isset($_POST["search"])){ ?>
                    <button name="undo" class="btn2 btn-sm btn-outline-primary w-50 mr-1">UNDOOOOOO</button>
                    <?php } ?>
                </form>
            </div>
        </div>

        <?php
    $query = mysqli_query($con,$products_sql);
    $records_per_row = 2; // Number of records per row
    $count = 0;
    while($res = mysqli_fetch_array($query)){
        $productId=$res['productId'];
        $productName = $res['productName'];
        $productDesc=$res["productDesc"];
        $productCategory=$res["productCategory"];
        $productPrice = $res['productPrice'];
        $productImage = $res["productImage"];
        if($productCategory == "drinks"){
            $drink_cat = $productDesc;
        }

        // Check if a new row needs to be created for every two records
        if($count % $records_per_row == 0){
            echo '<div class="row">';
        }
        ?>
        <div class="col-md-6">
            <div class="card p-3">
                <div class="container d-flex justify-content-center">
                    <figure class="cardd card-product-grid card-lg"> <a href="#" class="img-wrap" data-abc="true"> <img
                                src="../uploaded_img/<?=$res['productImage'];?>" alt="produit"> </a>
                        <figcaption class="info-wrap">
                            <div class="row">
                                <div class="col-md-9 col-xs-9"> <a href="#" class="title"
                                        data-abc="true"><?=$productName;?>
                                    </a> <span class="rated"><?=$productCategory;?> <?php if(isset($drink_cat)){if($drink_cat=="cold"){
                                        ?>
                                        <span class="cold">cold</span>
                                        <?php } else{ ?>
                                        <span class="hot">hot</span>
                                        <?php }} ?> </span>
                                </div>
                            </div>
                        </figcaption>
                        <div class="bottom-wrap-payment">
                            <figcaption class="info-wrap">
                                <div class="row">
                                    <div class="col-md-9 col-xs-9"> <a href="#" class="title"
                                            data-abc="true"><?=$productPrice;?>$</a>
                                        <span class="rated"></span> </div>
                                    <div class="col-md-3 col-xs-3">
                                        <div class="rating text-right"></div>
                                    </div>
                                </div>
                            </figcaption>
                        </div>
                        <div class="bottom-wrap">
                            <div class="up">
                                <a href="update.php?update=<?=$productId;?>" class="button1 update" data-abc="true">Update</a>
                            </div>
                            <div class="price-wrap">
                                <input type="button" class="buttonn delete" data-abc="true" id="deleteBtn" onclick="showPopup<?=$productId;?>()" name="<?=$productId;?>" value="Delete">
                            </div>
                        </div>

                        <!-- Popup Alert -->
                        <div class="popup" id="popupAlert<?=$productId;?>">
                            <div class="popup-content">
                                <p>Are you sure you want to delete <span class="hot"><?=$productName;?></span></p>
                                <a class="btn btn-primary" id="confirmBtn"
                                    href="control/delete.php?product=<?=$productId;?>" onclick="hidePopup<?=$productId;?>()">Confirm</a>
                                <button class="btn btn-secondary" id="cancelBtn" onclick="hidePopup<?=$productId;?>()">Cancel</button>
                            </div>
                        </div>

                    </figure>
                </div>
                <!-- end div-->
            </div>
        </div>
        <?php
        // Check if the row needs to be closed after two records
        if($count % $records_per_row == ($records_per_row - 1)){
            echo '</div>'; // Close the row
        }
        $count++;
    }

    // If there are records left in the last row, close it
    if($count % $records_per_row != 0){
        echo '</div>';
    }
    ?>
    </div>
    <?php } ?>
    </div>
</body>