<?php
    
    require 'config/database.php';

    //Vairbles for form fields
    $shop_name = $shop_address = $shop_contact = $shop_email = '';
    $password = $confirm_password = '';

    $errors = array();
    //Checking if user press Register Button
    if(isset($_POST['register_user'])) {
        
        
        //Grabbing form fields
        $shop_name = mysqli_real_escape_string($db_connect, $_POST['shop_name']);
        $shop_address = mysqli_real_escape_string($db_connect, $_POST['shop_address']);
        $shop_contact = mysqli_real_escape_string($db_connect, $_POST['shop_contact']);
        $shop_email = mysqli_real_escape_string($db_connect, $_POST['shop_email']);
        $password = mysqli_real_escape_string($db_connect, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($db_connect, $_POST['confirm_password']);

        
        //Checking if fields are empty
        if(empty($shop_name)){ array_push($errors, 'Shop Name cannot be empty!'); }
        if(empty($shop_address)){ array_push($errors, 'Shop Address cannot be empty!'); }
        if(empty($shop_contact)){ array_push($errors, 'Shop Contact cannot be empty!'); }
        
        if($password !== $confirm_password) { array_push($errors, 'Password does not match!'); }


        //Query to check any existing user in the database
        $check_existing_user = "SELECT * FROM `shopkeepers` 
                                WHERE 
                                contact = '$shop_contact' or email = '$shop_email' 
                                LIMIT 1";

        $results = mysqli_query($db_connect, $check_existing_user);
        $users = mysqli_fetch_assoc($results);

        if($users) {
            if($users['contact'] === $shop_contact){ array_push($errors, 'Shopkeeper already exists'); }
        }
        

        //Regitsering user if no errors in the error array
        if(count($errors == 0)) {
            //Encrypting Password before saving into database
            $password_enc = md5($password);
            
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <title>Job Sheet Application | Register Shopkeeper</title>
</head>
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
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="form-wrapper mx-auto mt-3">
                    <h3 class="mb-4">Register as Shopkeeper</h3>

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
                        <p>Already a Shopkeeper? <span><a href="login.html">Log in.</a></span></p>
                    </form>
                </div>
            </div>
        </div>
    </div>      
</body>
</html>