<?php
    
    require 'config/database.php';
    include 'config/users.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <title>Job Sheet Application | Register Shopkeeper</title>

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
                <div class="form-wrapper mx-auto mt-3">
                    <h3 class="mb-4">Register as Shopkeeper</h3>
                    
                    <!-- File for showing errors -->
                    <?php include 'errors.php' ?>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-group">
                            <label for="shop-name">Shop Name</label>
                            <input type="text" name="shop_name" class="form-control" require autocomplete>
                        </div>
                        <div class="form-group">
                            <label for="shop-address">Shop Address</label>
                            <input type="text" name="shop_address"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="shop-contact">Contact Number</label>
                            <input type="number" name="shop_contact"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="shop-contact">Email (optional)</label>
                            <input type="email" name="shop_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="shop-contact">Password</label>
                            <input type="password" name="password" placeholder="Minimum 6 characters" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="shop-contact">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <input type="submit" name="register_user" value="Register" class="btn btn-primary" >
                        <br>
                        <br>
                        <p>Already a Shopkeeper? <span><a href="login.php">Log in.</a></span></p>
                    </form>
                </div>
            </div>
        </div>
    </div>      
</body>
</html>