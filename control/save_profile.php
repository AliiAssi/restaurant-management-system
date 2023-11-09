<?php
include '../components/connection.php';
if (!isset($_SESSION["userId"])) {
  header("Location: login.php");
  exit();
}

$userId = $_SESSION["userId"];

if(isset($_POST["save"])){
    $fn = $_POST["first"];
    $ln = $_POST["last"];
    $code = $_POST["code"];
    $phone = $_POST["mobile"];
    $email = $_POST["email"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $area = $_POST["area"];
    $other = $_POST["other"];
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "")
    {
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        if ($image_size > 2000000) {
            $_SESSION['image_error'] = true;
        }
        else{
            $sql = "UPDATE `restuser`
            SET `firstName`='$fn',`lastName`='$ln',`email`='$email',`userPhoneCode`='$code',`userPhoneNumber`=$phone,userImage = '$image'
            ,`userCountry`='$country',`userCity`='$city',`userArea`='$area',`userOther`='$other'
            WHERE userId = $userId";
            // Assuming $image_tmp_name is the temporary name of the uploaded file and $folder_target is the target folder path
            $folder_target = "../costumer/users_profiles_img/";
            $image_name = $_FILES['image']['name']; // Get the original name of the uploaded file
            $image_tmp_name = $_FILES['image']['tmp_name']; // Get the temporary name of the uploaded file

            // Concatenate the target folder path with the original image name to get the full target path
            $target_path = $folder_target . $image_name;

            // Move the uploaded file to the target folder
            if (move_uploaded_file($image_tmp_name, $target_path)) {
                echo "File moved successfully.";
            } else {
                echo "Failed to move the file.";
            }
        }
    }
    else
    {
        $sql = "UPDATE `restuser`
        SET `firstName`='$fn',`lastName`='$ln',`email`='$email',`userPhoneCode`='$code',`userPhoneNumber`=$phone
        ,`userCountry`='$country',`userCity`='$city',`userArea`='$area',`userOther`='$other'
        WHERE userId = $userId ";
        

    }
   
    echo $sql;
   $query = mysqli_query($con, $sql);
    header("location:../costumer/edit_profile.php");
}
if(isset($_POST["pass"])){
    $old = $_POST["prev"];
    $new = $_POST["new"];

    $check_query = mysqli_query($con, "SELECT * from restuser Where userId = $userId");
    $check_res   = mysqli_fetch_assoc($check_query);
    $check       = $check_res["userPassword"];
    if($check == $old)
    {
    $sql = "UPDATE `restuser`
    SET userPassword = '$new'
    WHERE userId = $userId ";
    $query = mysqli_query($con, $sql);
    }
    else
    {
        $_SESSION["wrong"] = true;
    }
    header("location:../costumer/edit_profile.php");
}

?>