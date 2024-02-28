<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- ... -->
</head>

<body>
    <!-- ... -->
    <h1 id="title">Login</h1>

    <div class="login-container">
    <form id="login-form" method="post" action="">
        <div class="form-group">
            <label class="form-label" for="login_id">Username</label>
            <input type="text" class="form-control" id="login_id" name="id">
        </div>
        <div class="form-group">
            <label class="form-label" for="login_password">Password</label>
            <input type="password" class="form-control" id="login_password" name="password">
        </div>
        <button type="submit" class="btn dbbtn">Login</button>
        <button type="button" class="btn dbbtn" onclick="window.location.href='register.php'">Register</button>
    </form>
    </div>
    <style>
        #title {
            text-align: center;
        }

        .msg {
            text-align: center;
            color: red;
        }

        .login-container {
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>



    <?php 
    if($_GET['logout']){
        echo "<p class='msg'>You have been logged out.</p>";
    }

        require(__DIR__ . "/includes/db.inc.php");
    
        if($_POST['id'] & $_POST['password']) {
            $query = "SELECT * FROM users WHERE username = :username";

            $statement = $Conn->prepare($query);
            $statement->execute(array(
                ":username" => $_POST["id"]
            ));
            $username_check = $statement->fetch(PDO::FETCH_ASSOC);

            if(!$username_check){
                echo "User does not exist.";
            }else{
                // We know the user exists.
                // Check the password
                if (password_verify($_POST['password'], $username_check['password'])) {
                    // Start session
                    $_SESSION['id'] = $username_check['id'];
                    $_SESSION['user_data'] = $username_check;
                    header("Location: http://csadler.uosweb.co.uk/main.php");
                } else {
                    echo 'Invalid password.';
                }
            }
        }

    ?>

    <?php
        if($_GET['notAuthorised']){
            echo '<p class="msg">You Are Not Authorised To Use This Service</p>';
        }
    ?>

</body>

</html>