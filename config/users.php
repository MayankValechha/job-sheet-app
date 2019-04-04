<?php
    session_start();

    /*  ##############################
        ______________________________
        ________REGISTER USER_________
        ______________________________
        ##############################
    */

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
                                contact = '$shop_contact' OR name = '$shop_name'
                                LIMIT 1";

        $results = mysqli_query($db_connect, $check_existing_user);
        $users = mysqli_fetch_assoc($results);

        //Checking if Shop Name and Contact Already exists in the database
        if($users) {
            if($users['contact'] === $shop_contact){ array_push($errors, 'Shopkeeper already exists'); }
            if($users['name'] === $shop_name){ array_push($errors, 'Shopkeeper Name already exists'); }
        }
        

        //Regitsering user if no errors in the error array
        if(count($errors) == 0) {
            //Encrypting Password before saving into database
            $password_enc = md5($password);

            $query = "INSERT INTO `shopkeepers` (name, address, email, contact, password) 
                    VALUES ('$shop_name', '$shop_address', '$shop_email', '$shop_contact', '$password_enc')";
            
            mysqli_query($db_connect, $query);

            $_SESSION['username'] = $shop_name;
            $_SESSION['success'] = "You are logged in!";

            header('Location: dashboard.php');
            
        }
    }

    /*  ##############################
        ______________________________
        __________LOGIN USER__________
        ______________________________
        ##############################
    */

    //Variables
    $username = $password = '';
    
    if(isset($_POST['login_user'])) {
        
        //Grabbing Values
        $username = mysqli_real_escape_string($db_connect, $_POST['username']);
        $password = mysqli_real_escape_string($db_connect, $_POST['password']);

        //Validation Username and Password
        if(empty($username) || strlen($username) != 10 ) {
            array_push($errors, 'Mobile Number cannot be empty or Not more than 10 Characters.');
        }
                                 

        if(empty($password) || strlen($password) < 6) {
            array_push($errors, 'Password cannot be empty or Password Incorrect.');
        }

        //Checking for Errors in errors array()

        if(count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM `shopkeepers` WHERE contact = '$username' AND password = '$password'";

            $results = mysqli_query($db_connect, $query);

            if(mysqli_num_rows($results) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in!";

                header('Location: dashboard.php');
            }
            else {
                array_push($errors, "Invalid Credentials!");
            }
        }
    }
?>