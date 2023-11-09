<?php
include '../components/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 320px;
            padding: 30px;
            text-align: center;
        }

        .profile-image-pic {
            display: block;
            margin: 0 auto 20px;
            height: 120px;
            width: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #0e1c36;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #0e1c36;
        }

        .btn-login {
            background-color: #0e1c36;
            color: #fff;
            border: none;
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
            font-weight: bold;
        }

        .btn-login:hover {
            background-color: #0a1529;
        }

        .signup-link {
            margin-top: 15px;
        }

        .signup-link a {
            color: #0e1c36;
            text-decoration: none;
            font-weight: bold;
        }
        .error-message {
    background-color: #ffdddd;
    border: 1px solid #ff7f7f;
    border-radius: 5px;
    padding: 10px;
    margin: 10px 0;
    color: #ff0000;
    font-weight: bold;
    }

    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div>
                <img src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" class="profile-image-pic" alt="profile">
            </div>
            <form action="control/login.php"method="post">
                <div class="form-group">
                    <input type="text" class="form-control" id="Username" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <button type="submit" name="login" class="btn-login">Login</button>
            </form>
            <?php
            if(isset($_SESSION['error']))
            {
            ?>
            <div class="error-message">
                <p> wrong info </p>
            </div>
            <?php
            unset($_SESSION['error']); // Clear the error message after displaying it
            }
            ?>
   
        </div>
    </div>
</body>
</html>
