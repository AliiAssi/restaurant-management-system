<?php
include '../../components/connection.php';
$adminId= 1;
?>

<?php
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Handle the image file upload
    if (isset($_FILES['image']['name'])) {
     
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        if ($image_size > 2000000) {
            $_SESSION['image_error'] = true;
            exit();
        }
        else {
        $target_folder = '../../uploaded_img/';
        $image_folder = $target_folder . $image;
        move_uploaded_file($image_tmp_name, $image_folder);}
        $desc="";
        if(isset($_POST['drink_category']) && $category == "drinks"){
            $desc = $_POST['drink_category'];
        }else{
            $desc = $_POST["drink_category"];
            echo $desc;
        }
       // Assuming $con is your database connection
        $sql = "INSERT INTO `restmenu`(`productName`, `productCategory`, `productPrice`, `productImage`, `productStatus`, `productDesc`, `prodDate`)
        VALUES ('$name', '$category', $price, '$image', 1, '$desc', NOW())";
        echo $sql;
        // Execute the query
        $query = mysqli_query($con, $sql);

        // Check if the query was successful
        if ($query) {
        // Query executed successfully
        $_SESSION["added"] = true;
        } else {
        echo "Error: " . mysqli_error($con);
        }
        header("location:../add_product.php");                 
    }
}

?>