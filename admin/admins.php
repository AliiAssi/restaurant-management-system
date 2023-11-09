<?php
    include '../components/connection.php';
    $adminId= 1;
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
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
<div class="container mt-4">


    <?php
    $sql = "SELECT * FROM restadmin";
    $query = mysqli_query($con, $sql);
    $records_per_row = 2; // Number of records per row
    $count = 0;
    while($res = mysqli_fetch_array($query)){
        $name = $res["adminName"];
        $email = $res["email"];
        // Check if a new row needs to be created for every two records
        if($count % $records_per_row == 0){
            echo '<div class="row">';
        }
        ?>
        <div class="col-md-6">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <div class="image">
                                <img src="https://i.imgur.com/wvxPV9S.png" class="rounded" width="90" >
                            </div>
                            <div class="ml-3 w-100">
                                 <h4 class="mb-0 mt-0"><?=$name;?></h4>
                                <span><?=$email;?></span>
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
</div>
</body>    

