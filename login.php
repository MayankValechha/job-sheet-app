<?php 

    require 'config/database.php';
    include 'config/users.php';
    
    // //Variables
    // $username = $password = '';
        
    // if(isset($_POST['login_user'])) {
        
    //     //Grabbing Values
    //     $username = mysqli_real_escape_string($db_connect, $_POST['username']);
    //     $password = mysqli_real_escape_string($db_connect, $_POST['password']);

    //     //Validation Username and Password
    //     if(empty($username)) {
    //         if(strlen($username) != 10 ) {
    //             array_push($errors, 'Mobile Number cannot be empty or Not more than 10 Characters.');
    //         }
    //     }                         

    //     if(empty($password)) {
    //         if(strlen($password) < 6){
    //             array_push($errors, 'Password cannot be empty or Password Incorrect.');
    //         }
    //     }

    //     //Checking for Errors in errors array()

    //     if(count($errors) == 0) {
    //         $password = md5($password);
    //         $query = "SELECT * FROM `shopkeepers` WHERE contact = '$username' AND password = '$password' LIMIT 1";

    //         $results = mysqli_query($db_connect, $query);

    //         if(mysqli_num_rows($query) == 1) {
    //             $_SESSION['username'] = $username;
    //             $_SESSION['success'] = "You are now logged in!";

    //             header('Location: dashboard.php');
    //         }
    //         else {
    //             array($errors, "Invalid Credentials!");
    //         }
    //     }
    // }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <title>Job Sheet Application | Login Shopkeeper</title>

    <style>
        label {
            font-weight: bold;   
            font-size: 14px;
        }

        .form-wrapper {
            max-width: 450px;
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="form-wrapper mx-auto my-5">
                    <h3 class="mb-4">Login</h3>

                    <!-- File for showing errors -->
                    <?php include 'errors.php'; ?>
                    
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-group">
                            <label for="shop-contact">Contact Number</label>
                            <input type="number" name="username" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="shop-password">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <input type="submit" name="login_user" value="Login" class="btn btn-primary">
                        <br>
                        <br>
                        <p>Not a Member? <span><a href="register.php">Register.</a></span></p>
                    </form>
                </div>
            </div>
        </div>
    </div>      
</body>
</html>