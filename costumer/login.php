<?php

include '../components/connection.php';






if(isset($_POST['login'])){
    $pass="'".$_POST['password']."'";
    $email="'".$_POST['email']."'";
    $login_query_sql=
    "
    SELECT * FROM restuser WHERE email = $email AND userPassword = $pass
    ";
    $login_query = mysqli_query($con,$login_query_sql);
    if($fetch_login = mysqli_fetch_array($login_query))
    {
      $_SESSION['userId'] = $fetch_login['userId'];
      $id = $fetch_login['userId'];
      $sql =  "UPDATE user_chat SET status = 1 WHERE userId = $id ";
      mysqli_query($con,$sql);
      header("LOCATION:cosHome.php");
    }
    else
    {
        $wrong_info = true;
    }

}
else{
    $wrong_info = false;
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>yumy sign </title>
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
    <script>
        function validateStrings(str1, str2) {
        if (str1 === str2) {
            if (str1.length >= 4 && str2.length >= 4) {
            const regex = /\d/;
            if (regex.test(str1) && regex.test(str2)) {
                return true;
            } else {
                alert("your password have to be at least 4 characters and at least one have to  be a digit from 0 to 9");
                return false;

            }
            } else {
            alert("your password have to be at least 4 characters and at least one have to  be a digit from 0 to 9");
            return false;
            }
        } else {
            alert("confirm your pass");
            return false;
        }
    }
    function valide(){
        const pass = document.getElementById('registerPassword').value;
        const pass1 = document.getElementById('registerRepeatPassword').value;
        return validateStrings(pass,pass1);
        return false;
    }
    </script>

    <style>
        .container{
            width:50%;
            margin-top:7%
        }
        .card-text{
          text-align:center;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">YUMY</a>
</nav>
    <!-- Pills navs -->
<div class="container">
<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
      aria-controls="pills-login" aria-selected="true">Login</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab"
      aria-controls="pills-register" aria-selected="false">Register</a>
  </li>
</ul>
<!-- Pills navs -->

<!-- Pills content -->
<div class="tab-content">
  <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
    <form method="post" action="login.php#pills-register">
      <div class="text-center mb-3">
        <p>Sign in with:</p>
      </div>


      <!-- Email input -->
      <div class="form-outline mb-4">
        <input name="email" type="email" id="loginName" class="form-control"  required />
        <label class="form-label" for="loginName">Email or username</label>
      </div>

      <!-- Password input -->
      <div class="form-outline mb-4">
        <input type="password" id="loginPassword" class="form-control" name="password" required />
        <label class="form-label" for="loginPassword">Password</label>
      </div>

      <!-- 2 column grid layout -->
      <div class="row mb-4">
        <div class="col-md-6 d-flex justify-content-center">
        </div>

        <div class="col-md-6 d-flex justify-content-center">
          <!-- Simple link -->
          <a href="#!">Forgot password?</a>
        </div>
      </div>
      <?php
      if(isset($wrong_info) && $wrong_info == true){
        $wrong_info = false;
      ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>HELLO:</strong>wrong info !
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">					
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
    <?php
      if(isset($_SESSION['emailExisted']) && $_SESSION['emailExisted']){
        $_SESSION['emailExisted'] = false;
      ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>HELLO:</strong>email already existed !!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">					
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
      <!-- Submit button -->
      <button type="submit" name="login" class="btn btn-primary btn-block mb-4">Sign in</button>
    </form>
  </div>
  <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register" >
    <form method="post" action="../control/registerController.php" onsubmit="return valide()">
      <div class="text-center mb-3">
        <p>Sign up with:</p>
      </div>


      <!-- fn input -->
      <div class="form-outline mb-4">
        <input  name="firstName" type="text" id="registerName" class="form-control" required />
        <label  class="form-label" for="registerName">first name</label>
      </div>
       <!-- ln input -->
       <div class="form-outline mb-4">
        <input name="lastName" type="text" id="registerName" class="form-control" required />
        <label class="form-label" for="registerName">last name</label>
      </div>

      

      <!-- Email input -->
      <div class="form-outline mb-4">
        <input name="email" type="email" id="registerEmail" class="form-control" required />
        <label class="form-label" for="registerEmail">Email</label>
      </div>

      <!-- Password input -->
      <div class="form-outline mb-4">
        <input  name="pass" type="password" id="registerPassword" class="form-control" required/>
        <label class="form-label" for="registerPassword">Password</label>
      </div>

      <!-- Repeat Password input -->
      <div class="form-outline mb-4">
        <input name="confPass" type="password" id="registerRepeatPassword" class="form-control" required />
        <label class="form-label" for="registerRepeatPassword">Repeat password</label>
      </div>
     
    
      <?php
      if(isset($_SESSION['emailExisted']) && $_SESSION['emailExisted']){
        $_SESSION['emailExisted'] = false;
      ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>HELLO:</strong>you must confirm your password right!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">					
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
   

      <!-- Submit button -->
      <button name="register" type="submit" class="btn btn-primary btn-block mb-3">Sign up</button>
    </form>
  </div>
</div>
</div>
<!-- Pills content -->
<div class="card">
  <h5 class="card-header">yumy</h5>
  <div class="card-body">
    <p class="card-text"><h2>Restraunt &copy; all rights reserved</h2></p>
  </div>
</div>
</body>
</html>