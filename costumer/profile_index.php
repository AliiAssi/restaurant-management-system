<?php
include '../components/connection.php';
if (!isset($_SESSION["userId"])) {
  header("Location: login.php");
  exit();
}
$userId = $_SESSION["userId"];
?>
<?php include '../components/cosHeader.php'; ?>
<?php
$result = mysqli_query($con, "SELECT * FROM restuser WHERE userId = $userId");
if (!$result) {
    die("Error in database query: " . mysqli_error($con));
}
$row = mysqli_fetch_assoc($result);
$user_img= $row['userImage'];
$firstName = $row["firstName"];
$lastName = $row["lastName"];
$name = $firstName . " " . $lastName;
$name = strtoupper($name);
$databaseDate = $row["begin"];
$formattedDate = "joined " . date("F, Y", strtotime($databaseDate));
$email = $row["email"];
$number_of_telefone = $row["userPhoneCode"]."/".$row["userPhoneNumber"];
$adress_of_user = $row["userCountry"]."-".$row["userCity"]."-".$row["userArea"]."-".$row["userOther"];
$nb_orders_sql =  "SELECT count(*) as 'count' from restuser,restorder where restuser.userId = restorder.userId and restuser.userId = $userId";
$nb_of_query = mysqli_query($con, $nb_orders_sql);
$nb_of_orders_Res = mysqli_fetch_assoc ($nb_of_query);
$nb_of_orders = $nb_of_orders_Res["count"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
    .gris{
        color:#808080;
    }
.card {
    width: 100%;
    height: 100%;
    background-color: #efefef;
    border: none;
    transition: all 0.5s;
}

.image img {
    transition: all 0.5s
}

.card:hover .image img {
    transform: scale(1.5)
}


.btn1 {
    height: 140px;
    width: 140px;
    border-radius: 50%
}

.name {
    font-size: 24px; /* Larger font size */
    font-family: "Arial", sans-serif; /* Change font family to Arial or your preferred font */
    font-weight: bold; /* Bold font style */
    color: #DC143C;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Text shadow effect */
}



.btn2 {
    height: 40px;
    width: 150px;
    border: none;
    background-color: #000;
    color: #aeaeae;
    font-size: 15px
}






.containerr {
    background: linear-gradient(45deg, #4CAF50, #808000);    padding: 20px; /* Increased padding for more spacing */
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Refined box shadow for subtle depth */
    display: inline-block; /* Display as inline-block for auto-width */
}

        /* CSS styles for the span element with class "join" */
        .join {
            font-size: 36px; /* Larger font size for better impact */
            font-family: "Helvetica", Arial, sans-serif; /* Change font family to Helvetica or your preferred font */
            font-weight: bold; /* Bold font style */
            color: #fff; /* White text for better contrast on the gradient background */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Slightly adjusted text shadow */
            margin: 0; /* Remove default margin for better alignment */
            padding: 5px; /* Add padding for spacing between text and border */
        }

.date {
    background-color: #ccc
}
.a{
    margin:20%;
    margin-right:15%;
    margin-right:20%;
    margin-bottom:10%;
    height: 80%;
}
/* CSS styles for the div element with class "container" */
.container {
    background: linear-gradient(45deg, #4CAF50, #808000);            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: inline-block;
            text-align: center; /* Center-align the content within the container */
        }

        /* CSS styles for the span element with class "number" and "follow" */
        .number {
            font-size: 40px; /* Larger font size */
            font-family: "Helvetica", Arial, sans-serif;
            font-weight: bold;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            margin-right: 5px; /* Add some spacing between the number and "orders" text */
        }

        .follow {
            font-size: 18px; /* Smaller font size for "orders" text */
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* CSS styles for the "Edit Profile" button */
        .btn-edit {
            font-size: 18px;
            font-family: "Helvetica", Arial, sans-serif;
            font-weight: bold;
            color: #fff;
            background-color: #2196F3; /* Blue color for the button background */
            border: none;
            padding: 12px 24px;
            border-radius: 30px; /* Rounded corners for the button */
            cursor: pointer;
            transition: background-color 0.2s; /* Add a smooth transition on hover */
        }

        .btn-edit:hover {
            background-color: #1976D2; /* Darker blue color on hover */
        }

        /* CSS styles for the div element with class "text" */
        .text {
            font-size: 18px;
            font-family: "Helvetica", Arial, sans-serif;
            font-weight: bold;
            color: #333; /* Darker font color for better contrast */
            text-align: center;
        }
        /* CSS styles for the div element with class "text" */
        .text {
            font-size: 18px;
            font-family: "Helvetica", Arial, sans-serif;
            font-weight: bold;
            color: #333; /* Darker font color for better contrast */
            text-align: center;
        }
   </style>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>yumy  home</title>
    <!-- Font Awesome -->
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
    <script>
       function redirect() {
        window.location.href = "edit_profile.php";
    }
    </script>
   
</head>
<body>
<div class="a mt-4 mb-4 p-3 d-flex justify-content-center">
     <div class="card p-4">
          <div class=" image d-flex flex-column justify-content-center align-items-center">
            <?php
            if($user_img == null || $user_img == ""){
            ?>
               <button class="btn btn-secondary"> <img src="users_profiles_img/default.png" height="100" width="100" /></button>
            <?php }else{ ?>
                <button class="btn btn-secondary"> <img src="users_profiles_img/<?=$user_img;?>" height="100" width="100" /></button>

                <?php }?>   
               <br><br>
                <span class="gris">Hi,</span><span class="name"><?=$name;?></span>
                <br>
                <div class="container d-flex flex-row justify-content-center align-items-center mt-3">
                 <span class="number"><?=$nb_of_orders;?> <span class="follow">orders</span></span>
                </div>
    <br>
                <div class="d-flex justify-content-center mt-2"> <!-- Center-align the button -->
                <button class="btn-edit" onclick="redirect()">Edit Profile</button>
                </div>
    <br>
                <div class="text mt-3">
                <span class="gris">Email:</span><?=$email;?> <br>
                <span class="gris">Phone:</span><?=$number_of_telefone;?> <br>
                <span class="gris">Current Adress:</span><?=$adress_of_user;?> <br>
                </div>
                <br>
                
                <br> 
                <div class="containerr">
                   <span class="join"><?= $formattedDate; ?></span>
                 </div>
            </div>
        </div>
</div>
</body>
</html>
