<?php 
    require 'config/database.php';
    include 'config/users.php';

    if(isset($_SESSION['username'])) {
        header('Location: dashboard.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Login Shopkeeper | Job Sheet Application</title>
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

                    <?php if(isset($_SESSION['successful'])) : ?>
                        <h5 class="alert alert-success"> <?php echo $_SESSION['successful']; ?></h5>
                    <?php endif; ?>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-group">
                            <label for="shop-contact">Contact Number</label>
                            <input type="number" name="username" required class="form-control" required oninvalid="this.setCustomValidity('Please Enter Your Registere Contact Number')"
                        oninput="this.setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="shop-password">Password</label>
                            <input type="password" name="password" class="form-control" required oninvalid="this.setCustomValidity('Enter Password')"
                        oninput="this.setCustomValidity('')">
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