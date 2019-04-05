<?php
    
    session_start();
    // var_dump($_SESSION);    

    require 'config/database.php';

    if(isset($_SESSION['shopID'])) {
        $shop_id = $_SESSION['shopID'];

        $query = "SELECT * FROM `shopkeepers` WHERE shop_id = '$shop_id'";

        $result = mysqli_query($db_connect, $query);
    
        $shop_info = mysqli_fetch_assoc($result);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <title>Create Jobsheet | Job Sheet Application</title>
    <style>
        .jobsheet-wrapper {
            border: 2px solid black;
        }

        .header{
            padding:10px;
            border:1px solid black;
        }
        ::placeholder {
            font-weight:bold;
            color:black !important;
        }
        input, textarea{
            border:1px solid black !important;
            padding:25px 10px !important;
        }
        .sub-header {
            width:60%;
        }
        
        .sub-sub-header {
            width:40%;
        }
        
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xm-12 col-sm-12">
                <div class="jobsheet-wrapper">

                    <div class="header">
                        <!-- Shop Name -->
                        <h2><?php echo $shop_info['name']; ?></h2>
                        <div class="sub-header">

                            <!-- Address and Contact Info of Shopkeeper -->
                            <p class="lead"><?php echo $shop_info['address']; ?></p>
                            <p class="lead"><?php echo $shop_info['contact']; ?></p>

                            <!-- Date and Jobsheet Number Goes here -->
                            <div class="sub-sub-header">
                                <?php echo date("d/m/Y"); ?>
                            </div>
                        </div>
                    </div>
                    <form action="">
                        <div class="form-group">
                            <input type="text" name="customer_name" class="form-control" placeholder="Customer Name">
                            <input type="text" name="customer_contact" class="form-control" placeholder="Customer Contact">
                            <div class="form-inline">
                                <input type="text" name="mobile_model" class="form-control" placeholder="Model" style="width: 50%;">
                                <input type="text" name="mobile_imei" class="form-control" placeholder="IMEI" style="width: 50%;">
                            </div>
                            <div class="form-inline">
                                <input type="text" name="other_things" class="form-control" placeholder="Others" style="width: 50%;">
                                <input type="text" name="condition_of_mobile" class="form-control" placeholder="Condition" style="width: 50%;">
                            </div>
                            <input type="text" name="condition_of_mobile" class="form-control" placeholder="Condition of Mobile">
                            <label for="description">DESCRIPTION</label>
                            <br>
                            <div class="clearfix">
                                <textarea name="problem" class="form-control float-left" placeholder="Problem" style="width:70%; resize:none;"></textarea>
                                <input type="text" name="estimated_amount" class="form-control float-right" style="width:30%"; placeholder="Amount">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>