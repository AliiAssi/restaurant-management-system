<?php
include '../components/connection.php';
if (!isset($_SESSION["userId"])) {
  header("Location: login.php");
  exit();
}
$userId = $_SESSION["userId"];
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
<head>
    <link rel="stylesheet" href="../components/css/edit_profile.css">
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
    <style>
        .labels{
            font-size: medium;
        }
    </style>
</head>
<body>
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <?php 
                if($row['userImage'] == null && $row['userImage'] ==''){
                ?>
                <img class="rounded-circle mt-5" width="150px" src="users_profiles_img/default.png">
                <?php
                }else{$image =$row['userImage'];
                ?>
                <img class="rounded-circle mt-5" width="150px" src="users_profiles_img/<?=$image;?>">
                <?php } ?>
                
                <span class="font-weight-bold"><?=$name;?></span><span class="text-black-50"><?=$email;?></span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <form action="../control/save_profile.php" method="post" enctype="multipart/form-data">  
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Profile Picture</label><input type="file" name="image" id="" accept="image/*"></div>
                </div>              
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">First name</label><input name="first" type="text" class="form-control" placeholder="first name" value="<?=$firstName;?>" required></div>
                    <div class="col-md-6"><label class="labels">Last name</label><input name="last" type="text" class="form-control" value="<?=$lastName;?>" placeholder="last name" required></div>
                </div>
                <br> <br>
                <div class="row mt-3">
                <div class="dropdown-container">
                    phone code
                    <select class="styled-dropdown" required name="code">
                        <option value="" disabled selected>Select an option</option>
                        <option value="+961"> +961</option>
                        <option value="+932">+932</option>
                        <option value="+967">+97</option>
                    </select>
                </div>
                <br> <br>
                <br> <br>
                    <div class="col-md-12"><label class="labels">Mobile Number</label><input name="mobile" type="text" class="form-control" placeholder="enter phone number" value="<?=$number_of_telefone;?>" required></div>
                <br><br><br><br>
                    <div class="col-md-12"><label class="labels">Email</label><input name="email" type="text" class="form-control" placeholder="enter email" value="<?=$email;?>" required></div>
                </div>
                <div class="row mt-3">
                <div class="col-md-12"><label class="labels">country</label><input name="country" type="text" class="form-control" placeholder="enter your country adress" value="<?=$country;?>" required></div>
                    <div class="col-md-6"><label class="labels">city</label><input name="city" type="text" class="form-control" placeholder="enter your city adress" value="<?=$city;?>" required></div>
                    <div class="col-md-6"><label class="labels">area</label><input name="area" type="text" class="form-control" placeholder="enter your area adress" value="<?=$area;?>" required></div>
                    <div class="col-md-6"><label class="labels">other information</label><input name="other" type="text" class="form-control" placeholder="enter any other information about your adress" value="<?=$other?>"></div>

                </div>
                <div class="mt-5 text-center"><button name="save" type="submit" class="submit-button">save informations</button></div>
            </div>
        </div>
    </form>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <form action="../control/save_profile.php" method="post">
                <div class="d-flex justify-content-between align-items-center experience"><span>PRIVACY</span> <button name="pass" type="submit" class="submit-button">change password</button></div><br>
                <div class="col-md-12"><label class="labels">previous password</label><input name="prev" type="text" class="form-control" placeholder="" value="" required></div> <br>
                <div class="col-md-12"><label class="labels">new password</label><input name="new" type="text" class="form-control" placeholder="enter your new password" value="" required></div>
                <?php
                if(isset($_SESSION["wrong"]) && $_SESSION["wrong"]){
                    $_SESSION["wrong"] = false;
                ?>
                <br><br>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>HELLO</strong> wrong password
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">					
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php }?>
                </form> 
            </div>
        </div>
    </div>
</div>
</div>
</div>
