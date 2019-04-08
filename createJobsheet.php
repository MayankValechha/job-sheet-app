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

    if(isset($_POST['submit_job'])) {
        echo 'Submitted';
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

        .wrapper {
            border:2px solid black;
            padding:0;
        }

        .wrapper .header {
            padding:10px 20px;
        }

        .header h1 {
            border-bottom:1px solid black;
        }
        
        p {
            margin:0 0 8px 0;
        }

        .sub-header {
            border-right:1px solid black;
        }
    </style>
</head>

<body>
    <!-- NEW STYLING -->
    
    <!-- START OF CONTAINER -->
    <div class="container">
        <!-- START OF MAIN ROW -->
        <div class="row">
            <div class="wrapper col-lg-12- col-md-12 col-sm-12">
                <div class="header">
                    <h1><?php echo $shop_info['name']; ?></h1>

                    <!-- START OF SUB-ROW  -->
                    <div class="row">
                        <div class="sub-header col-md-8 col-lg-9 col-sm-6">
                            <div class="">
                                <p><?php echo $shop_info['address']; ?></p>
                                <p><?php echo "+91".$shop_info['contact']; ?></p>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-3 col-sm-6">
                            <p><b>Job No.:</b> 50</p>
                            <p><b>Date: </b><?php echo date("d/M/Y"); ?></p>
                        </div>
                    </div>
                    <!-- END OF SUB-ROW -->
                </div>
                <!-- END OF .header -->

                <!-- START OF FORM -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST">
                    <div class="form-group" style="margin:0;">
                        <!-- 100% Width of Inputs -->
                        <input type="text" name="customer_name" class="form-control" placeholder="Customer Name">
                        <input type="text" name="customer_contact" class="form-control" placeholder="Customer Contact">
                        
                        <!-- 50% Width of Inputs -->
                        <div class="form-inline">
                            <input type="text" name="mobile_model" class="form-control" placeholder="Model" style="width: 50%;">
                            <input type="text" name="mobile_imei" class="form-control" placeholder="IMEI" style="width: 50%;">
                        </div>

                        <!-- 50% Width of Inputs -->
                        <div class="form-inline">
                            <input type="text" name="other_things" class="form-control" placeholder="Others" style="width: 50%;">
                            <input type="text" name="password_of_mobile" class="form-control" placeholder="Password" style="width: 50%;">
                        </div>

                        <!-- 100% Width of Inputs -->
                        <input type="text" name="condition_of_mobile" class="form-control" placeholder="Condition of Mobile">
                        <br>
                        <br>
                    </div>

                    <!-- START OF FORM ROW -->
                    <div class="row">
                        <div class="col-md-8 col-lg-9 col-sm-6 col-xs-6" style="padding-right:0;">
                            <input type="text" name="problem_in_mobile" class="form-control" placeholder="Problem">
                            <input type="text" name="problem_in_mobile" class="form-control" placeholder="">
                            <input type="text" name="problem_in_mobile" class="form-control" placeholder="">
                            <input type="text" name="problem_in_mobile" class="form-control" placeholder="">
                            <input type="text" name="problem_in_mobile" class="form-control" placeholder="">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3" style="padding-left:0;">
                            <input type="text" name="estimate1" class="form-control" placeholder="Amount">
                            <input type="text" name="estimate2" class="form-control" placeholder="">
                            <input type="text" name="estimate3" class="form-control" placeholder="">
                            <input type="text" name="estimate4" class="form-control" placeholder="">
                            <input type="text" name="estimate5" class="form-control" placeholder="">
                        </div>
                    </div>

                    <input type="submit" value="Submit Jobsheet" name="submit_job" class="btn btn-primary">
                    <!-- END OF FORM ROW -->
                </form>
                <!-- END OF FORM -->
            </div>
        </div>
        <!-- END OF MAIN ROW -->
    </div>
    <!-- END OF CONTAINER -->
</body>
</html>