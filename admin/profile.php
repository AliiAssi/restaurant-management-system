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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css.css">
    <script>
       function showAlert() {
    var overlay = document.getElementById('overlay');
    overlay.style.display = 'block';
}

function closeAlert() {
    var overlay = document.getElementById('overlay');
    overlay.style.display = 'none';
}

    </script>
    <style>
        .red{
            color:red;
        }
        .blue{
            color:blue;
        }
      body {
    display: flex;
    justify-content: center;
        }
 
      .padding   {
        margin-left:10px;
        width:100%;
    display: block; /* or any other appropriate display value */
    margin: 0 auto; /* This will horizontally center the element within its container */
        }

    </style>
</head>
<body>
   
<div class="innercard p-2">
<?php include 'components/header.php'; ?>
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                <span class="font-weight-bold"><?=$admin_name;?></span><span class="text-black-50"><?=$email;?></span><span> </span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <form action="control/profile.php" method="post" name="ff">
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" placeholder="name" name="name" value="<?=$admin_name;?>"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" name="mobile" placeholder="enter phone number" value="<?=$mobile;?>"></div>
                    <div class="col-md-12"><label class="labels">Email </label><input type="text" class="form-control" name="email" placeholder="enter email " value="<?=$email;?>"></div>
                </div>
                
                <div class="mt-5 text-center"><input type="submit" name="save" class="btn btn-primary profile-button" value="Save" onclick="submit()"/></div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <form action="control/profile.php" method="post">
                <div class="d-flex justify-content-between align-items-center experience"><div class="mt-5 text-center">
                    <input type="submit" class="btn btn-primary profile-button" value="change" name="change" >
                </div>
            </div>
            <br>
                <div class="col-md-12"><label class="labels">Old Password</label>
                <input type="text" class="form-control" placeholder="" name="old" value="" required>
                </div>
                <br>
                <div class="col-md-12"><label class="labels">New Password</label>
                </form>
                <input type="text" class="form-control" placeholder="" name="new" value="" required>
<?php
if(isset($_GET["changed"]) && $_GET["changed"] == 0){
?>
<div class="overlay" id="overlay">
    <div class="popup">
        <h2>Hello <b><?=$admin_info["adminName"];?></b></h2>
        <p class="red">wrong password !</p>
        <button class="btn btn-primary profile-button"onclick="closeAlert()">try again</button>
    </div>
</div>
<?php } elseif(isset($_GET["changed"]) && $_GET["changed"] == 1){ ?>
    <div class="overlay" id="overlay">
    <div class="popup">
        <h2>Hello <b><?=$admin_info["adminName"];?></b></h2>
        <p class="blue">password changed !</p>
        <button class="btn btn-primary profile-button"onclick="closeAlert()">skip</button>
    </div>
</div>
<?php } ?> 
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</body>
</html>    