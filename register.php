<!doctype html>
<html lang="en">

<head>
    <!-- ... -->
</head>

<body>
    <!-- ... -->

    <div class="tableinfo">
        <h1>Register</h1>
    </div>

    <br>
    <hr><br>

    <?php

    require(__DIR__ . "/includes/db.inc.php");

    if(isset($_POST['id'])) {
        // Form has been submitted
        // Check that username is less than or greater x characters
        // Check that password is less than or greater than x characters

        // Check that username is not already taken.
        $query = "SELECT * FROM users WHERE username = :username";

        $statement = $Conn->prepare($query);
        $statement->execute(array(
            ":username" => $_POST["id"]
        ));
        $username_check = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$username_check){
            // Register the user
            $query = "INSERT INTO users (username, password) VALUES (:username, :password)";

            $statement = $Conn->prepare($query);
            $statement->execute(array(
                ":username" => $_POST["id"],
                ":password" => password_hash($_POST["password"], PASSWORD_DEFAULT)
            ));
            
            // Redirect to index.php after successful registration
            header("Location: http://csadler.uosweb.co.uk/index.php");
            exit; // Terminate the script after redirection
        }else{
            echo "<p>Username is taken</p>";
        }
        
    }

?>


    <div class="login-container">
        <form id="login-form" method="post" action="">
            <div class="form-group">
                <label class="form-label" for="login_id">Username</label>
                <input type="text" class="form-control" id="login_id" name="id" placeholder="Enter your username">
            </div>
            <div class="form-group">
                <label class="form-label" for="login_password">Password</label>
                <input type="password" class="form-control" id="login_password" name="password" placeholder="Enter your password">
            </div>
            <button type="submit" class="btn dbbtn">Register</button>
        </form>
    </div>

    <style>
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



</body>

</html>