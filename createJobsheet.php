<?php
    
    // Setting Time format for India
    date_default_timezone_set("Asia/Kolkata");

    session_start();

    require 'config/database.php';

    if(isset($_SESSION['shopID'])) {
        $shop_id = $_SESSION['shopID'];

        $query = "SELECT * FROM `shopkeepers` WHERE shop_id = '$shop_id'";

        $result = mysqli_query($db_connect, $query);
    
        $shop_info = mysqli_fetch_assoc($result);
    }
    

    //Getting a new Jobsheet Number
    $query = "SELECT * FROM `jobsheet` where shop_id = '$shop_id'";
    
    $result = mysqli_query($db_connect, $query);

    $data = mysqli_num_rows($result);

    /*
        Storing Jobsheet number in $totalJobsheets variable
        Incrementing $data variable's value to get a new number sequentially
    */
    $totalJobsheets = ++$data;


    //Checking if Jobsheet is Submitted
    if(isset($_POST['submit_job'])) {

        //Grabbing all form fields
        $shop_ID = $_SESSION['shopID'];
        $customer_name = mysqli_real_escape_string($db_connect, $_POST['customer_name']);
        $customer_contact = mysqli_real_escape_string($db_connect, $_POST['customer_contact']);
        $customer_email = mysqli_real_escape_string($db_connect, $_POST['customer_email']);

        $mobile_model = mysqli_real_escape_string($db_connect, $_POST['mobile_model']);
        $mobile_imei = mysqli_real_escape_string($db_connect, $_POST['mobile_imei']);
        $other_things = mysqli_real_escape_string($db_connect, $_POST['other_things']);
        $password_of_mobile = mysqli_real_escape_string($db_connect, $_POST['password_of_mobile']);
        $condition_of_mobile = mysqli_real_escape_string($db_connect, $_POST['condition_of_mobile']);
        
        //Getting Checkbox values
        $liquid_damaged = $_POST['liquid_damaged'];
        $physical_damaged = $_POST['physical_damaged'];
        $tempered = $_POST['tempered'];

        if(isset($_POST['liquid_damaged'])) {
            $liquid_damaged = true;
        }

        if(isset($_POST['physical_damaged'])) {
            $physical_damaged = true;
        }

        if(isset($_POST['tempered'])) {
            $tempered = true;
        }

        //Casting amount variable into int
        $problem = mysqli_real_escape_string($db_connect, $_POST['problem_in_mobile']);
        $amount = (int)mysqli_real_escape_string($db_connect, $_POST['estimate']);

        $query = "
                    INSERT INTO `jobsheet`
                    (customer_name, 
                    customer_contact, 
                    customer_email, 
                    imei, 
                    model, 
                    password, 
                    other_things, 
                    condition_of_mobile,
                    isLiquidDamaged,
                    isPhysicalDamaged,
                    isTempered,
                    problem_description, 
                    estimated_amount, 
                    shop_id)
                    VALUES
                    ('$customer_name', 
                    '$customer_contact', 
                    '$customer_email', 
                    '$mobile_imei', 
                    '$mobile_model', 
                    '$password_of_mobile', 
                    '$other_things', 
                    '$condition_of_mobile',
                    '$liquid_damaged',
                    '$physical_damaged',
                    '$tempered',
                    '$problem', 
                    '$amount', 
                    '$shop_ID')";
                            
        if(!mysqli_query($db_connect, $query)) 
        {
            die('Error : '.mysqli_errno($db_connect));
        }
        else 
        {  
            header('Location: dashboard.php');
            //Alert: New Jobsheet has been created.
            exit();
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
    <title>Create Jobsheet | Job Sheet Application</title>
    <link rel="stylesheet" href="css/jobsheet-style.css">
    
    <!-- Refreshing Page every 10 seconds -->
    <!-- <meta http-equiv="refresh" content="10" >  -->
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
                            <p><b>Job No. : </b><?php echo $totalJobsheets; ?></p>
                            <p><b>Date : </b><?php echo date("d/M/Y"); ?></p>
                            <p><b>Time : </b><?php echo date("h:i:s A"); ?></p>
                        </div>
                    </div>
                    <!-- END OF SUB-ROW -->
                </div>
                <hr>
                <!-- END OF .header -->

                <!-- START OF FORM -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST">
                    <div class="form-group" style="margin:0;">
                        <!-- 100% Width of Inputs -->
                        <label for="customer name">Customer Name : </label>
                        <input type="text" name="customer_name" class="form-control" placeholder="Customer Name">
                        <label for="customer contact">Customer Contact : </label>
                        <input type="text" name="customer_contact" class="form-control" placeholder="Customer Contact">
                        <label for="customer email">Customer Email : </label>
                        <input type="text" name="customer_email" class="form-control" placeholder="Customer Email">
                        

                        <!-- 50% Width of Inputs -->
                        <label for="customer email">Model: </label>
                        <input type="text" name="mobile_model" class="form-control half-width" placeholder="Model">
                        <label for="customer email">IMEI : </label>
                        <input type="text" name="mobile_imei" class="form-control half-width" maxlength="15" placeholder="IMEI">


                        <!-- 50% Width of Inputs -->
                        <label for="customer email">Others: </label>
                        <input type="text" name="other_things" class="form-control half-width" placeholder="Others">
                        <label for="customer email">Password: </label>
                        <input type="text" name="password_of_mobile" class="form-control half-width" placeholder="Password">
                        

                        <!-- 100% Width of Inputs -->
                        <input type="checkbox" class="full-width" name="liquid_damaged">
                        <label class="checkbox" for="ld">Liquid Damaged</label>
                        <input type="checkbox" class="full-width" name="physical_damaged">
                        <label class="checkbox" for="pd">Physical Damaged</label>
                        <input type="checkbox" class="full-width" name="tempered">
                        <label class="checkbox" for="temp">Tempered</label>
                        <hr>


                        <label for="condition">Condition</label>
                        <input type="text" name="condition_of_mobile" class="form-control" placeholder="Condition of Mobile">
                        <br>
                        <br>

                        <label for="problem">Problem Description</label>
                        <input type="text" name="problem_in_mobile" class="form-control" placeholder="Problem Description">
                        <label for="amount">Amount</label>
                        <input type="text" name="estimate" class="form-control" placeholder="Amount">
                        <br>
                        <hr>

                        <!-- NOTE COLUMN -->
                        <div class="note">
                            <p><b>NOTE :</b></p>
                            <ol>
                                <li>In case if your phone has been repaired elsewhere, It will be repaired on customer's risk.</li>
                                <li>If phone is completely dead due to water damaged, after the phone has been repaired to working condition, will be leived extra charges for repair.</li>
                                <li>By singing the Jobsheet, <b>I agree to all terms and conditions above.</b></li>
                                <br>
                                <p><b>THANKYOU FOR YOUR BUSINESS!!!</b></p>
                            </ol>                       
                        </div>
                        
                        <!-- END OF NOTE COLUMN -->

                        <!-- SIGNATURE COLUMN -->
                        <div class="signature">
                            <p><b>Customer's Signature</b></p>
                        </div>  
                        <br><br>
                        <!-- END OF SIGNATURE COLUMN -->
                        <input type="submit" value="Submit Jobsheet" id="submit" name="submit_job" class="font-weight-bold btn btn-primary">
                        <input type="button" value="Print Jobsheet" id="print" onClick="getPrintDialog();" class="font-weight-bold btn btn-secondary">
                    </div>
                </form>
                <!-- END OF FORM -->
            </div>
        </div>
        <!-- END OF MAIN ROW -->
    </div>
    <!-- END OF CONTAINER -->

    <!-- File for opening print dialog box -->
    <script>
        function getPrintDialog() {
            const submitButton = document.getElementById('submit');
            const printButton = document.getElementById('print');

            //Not Displaying both the Buttons when Print Jobsheet
            document.title = window.parent.document.title = "<?php echo $shop_info['name']." : Jobsheet No ".$totalJobsheets?>";

            submitButton.style.display = "none";
            printButton.style.display = "none";
            window.print();

            document.title = window.parent.document.title = "";

            //When Back on the CreateJobsheet page, buttons will be back
            submitButton.style.display = "";
            printButton.style.display = "";
        }
    </script>
</body>
</html>