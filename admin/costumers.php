<?php
    include '../components/connection.php';
    $adminId= 1;
    $admin_info_query_sql = "SELECT  * FROM restadmin WHERE adminId = $adminId";
    $admin_info_query = mysqli_query($con, $admin_info_query_sql);
    $admin_info = mysqli_fetch_array($admin_info_query);
    ?>
    <?php
    $admin_name = $admin_info["adminName"];
    $email = $admin_info["email"];
    $mobile = $admin_info["adminPhone"];
    $password = $admin_info["adminPassword"];
    ?>
    <?php
    $sql = "SELECT * FROM restuser LIMIT 1";
    $query = mysqli_query($con, $sql);
    $searching_sql = "SELECT * FROM restuser ";
    if(isset($_POST["search"])){
        $temp = $_POST["what"];
        $searching_sql = "SELECT * FROM restuser WHERE firstName like '$temp%'";
        $searching_query = mysqli_query($con, $searching_sql);
        if(!mysqli_fetch_array($searching_query)) {
            $searching_sql = "SELECT * FROM restuser WHERE lastName like '$temp%'";
            $query = mysqli_query($con, $searching_sql);
            if(!mysqli_fetch_array($query)){
                $searching_sql = "SELECT * FROM restuser";
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
                    window.location.href="costumers.php?sort=2";
                else if(sortOption === "a-z")    
                    window.location.href="costumers.php?sort=1";
            }
          

        </script>
        <link rel="stylesheet" href="css/index2.css">
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
        </style>
    <body>
    <div class="innercard p-2">
        <?php include 'components/header.php'; ?>
        <?php
            $query = mysqli_query($con, $searching_sql);
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
      <option value="a-z" <?php if(isset($_GET["sort"]) && $_GET["sort"] == 1) echo "selected";  ?> >A to Z</option>
      <option value="z-a" <?php if(isset($_GET["sort"]) && $_GET["sort"] == 2) echo "selected";  ?> >Z to A</option>
    </select>
  </div>
  <form action="costumers.php" method="post">
  <div class="search-container">
    <label for="search">Search:</label>
    <input type="text" id="what" name = "what" required placeholder="Type here to search..."> 
    <label for=""></label><button name="search" class="btn2 btn-sm btn-outline-primary w-50 mr-1"onclick="search()" >search</button>
    </form>
  </div>
</div>

    <?php
    $sql = $searching_sql;
        if(isset($_GET["sort"]) && $_GET["sort"]==1){
            $sql = "SELECT * FROM restuser ORDER BY firstName ASC, lastName ASC";}
        if(isset($_GET["sort"]) && $_GET["sort"]==2){
            $sql = "SELECT * FROM restuser ORDER BY firstName DESC, lastName DESC";
        }
    $query = mysqli_query($con, $sql);
    $records_per_row = 2; // Number of records per row
    $count = 0;
    while($res = mysqli_fetch_array($query)){
        $status = $res["block"];
        $userId = $res["userId"];
        $name = $res["firstName"]."  ".$res["lastName"]; 
        $image = $res['userImage'];
        $email = $res["email"]; 
        $profit_check_sql = "SELECT SUM(totalPrice) AS 'profit' FROM restorder WHERE paymentStatus='delivery' AND userId=$userId";
        $orders_count_sql ="SELECT count(*) AS 'count' FROM restorder WHERE paymentStatus='delivery' AND userId=$userId;" ;
        $profit_check_query = mysqli_query($con, $profit_check_sql);    
        $orders_count_query = mysqli_query($con, $orders_count_sql);
        $profit_check_res = mysqli_fetch_array($profit_check_query);
        $orders_count_res= mysqli_fetch_array($orders_count_query);
        if(!$profit_check_res) $profit_check = 0;
        else $profit_check = $profit_check_res["profit"];
        if(!$orders_count_res) $orders_count  =0;
        else $orders_count = $orders_count_res["count"];
        if (!$profit_check > 0 ) $profit_check = 0;
        $image = "../costumer/users_profiles_img/".$image;
        if($res['userImage'] == null || $res['userImage'] == '') $image = "../costumer/users_profiles_img/default.png";

        // Check if a new row needs to be created for every two records
        if($count % $records_per_row == 0){
            echo '<div class="row">';
        }
        ?>
        <div class="col-md-6">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <div class="image">
                                <img src="<?=$image;?>" class="rounded" width="155" alt="<?=$image;?>" >
                            </div>
                            <div class="ml-3 w-100">
                                 <h4 class="mb-0 mt-0"><?=$name;?></h4>
                                <span><?=$email;?></span>
                                <div class="p-2 mt-2  d-flex justify-content-between rounded text-white stats" >
                                    <div class="d-flex flex-column">
                                        <span class="articles"><b style="color:black">Orders</b></span>
                                        <span class="number1"><b style="color:black"><?=$orders_count;?></b></span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="followers"><b style="color:black">Generated_Profit</b></span>
                                        <span class="number2"><b style="color:black"><?=$profit_check;?></b></span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="rating"><b style="color:black">messages</b></span>
                                        <span class="number3"><b style="color:black">50</b></span>
                                    </div>
                                </div>
                                <div class="button-group mt-2 d-flex flex-row align-items-center">
                                <button class="btn2 btn-sm btn-outline-primary w-50 mr-1">Chat</button>
                                <?php if($status == 0){ ?>
                                    <a class="btn1 btn-sm btn-primary w-50 ml-1" href="control/block.php?id=<?=$userId;?>">Block</a> 
                                <?php }else if($status == 1){ ?>
                                    <a class="btn3 btn-sm btn-primary w-50 ml-1" href="control/block.php?id=<?=$userId;?>">UnBlock</a> 
                                <?php } ?>
                                </div>
                            </div>
                        </div>
 <!-- end div-->    </div>  
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

