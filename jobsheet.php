<?php 

    //Requring Database
    require 'config/database.php';

    //Session Start
    session_start();

    //Getting jobsheet id from ViewJobsheets page via url and storing it in $id variable 
    
    if(isset($_GET['id'])) {
        $customer_id = $_GET['id'];
    }

    //Storing shop_id value in $shopID variable
    $shopID = $_SESSION['shop_id']; 

    //Create a Query
    $query = "SELECT * FROM jobsheet WHERE customer_id = {$customer_id} AND shop_id = {$shopID}";
    
    // Get Result
    $result = mysqli_query($db_connect, $query);

    //Fetch Single Jobsheet in $jobsheet varibale
    $jobsheet = mysqli_fetch_assoc($result);
    
    if(!mysqli_query($db_connect, $query)){
        echo '<b>Got Error : </b>'. mysqli_error($db_connect);
    }


    /* 
        Checking if Repaired Button is pressed!
        In this condtion the Jobsheet is Repaired
    */
    if(isset($_POST['repaired'])) {

        if(isset($_GET['id'])) {
            $customer_id = $_GET['id'];
        }

        if(isset($_POST['update_id'])) {
            $update_id = $_POST['update_id'];
        }

        //Query for Updating
        $query = "UPDATE `jobsheet` SET isRepaired=1 WHERE customer_id={$update_id}";
        
        if(mysqli_query($db_connect, $query)) {
            header('Location: viewJobsheets.php');
        } 
        else {
            echo 'Got Error : '. mysqli_error($db_connect);
        }
    }


    /*  
        Checking if Delivered Button is pressed!
        In this condtion the Jobsheet is Repaired and Delivered
    */
    if(isset($_POST['delivered'])) {

        if(isset($_GET['id'])) {
            $customer_id = $_GET['id'];
        }

        if(isset($_POST['update_id'])) {
            $update_id = $_POST['update_id'];
        }

        //Query for Updating
        $query = "UPDATE `jobsheet` SET isRepaired=1, isDelivered=1 WHERE customer_id={$update_id}";
        
        if(mysqli_query($db_connect, $query)) {
            header('Location: viewJobsheets.php');
        } 
        else {
            echo 'Got Error : '. mysqli_error($db_connect);
        }
    }


    /*  
        Checking if Delivered Button is pressed!
        In this condtion the Jobsheet is Returned Without Repair
    */
    if(isset($_POST['returned'])) {

        if(isset($_GET['id'])) {
            $customer_id = $_GET['id'];
        }

        if(isset($_POST['update_id'])) {
            $update_id = $_POST['update_id'];
        }

        //Query for Updating
        $query = "UPDATE `jobsheet` SET isRepaired=0, isDelivered=1, isReturned=1, estimated_amount=0 WHERE customer_id={$update_id}";
        
        if(mysqli_query($db_connect, $query)) {
            header('Location: viewJobsheets.php');
        } 
        else {
            echo 'Got Error : '. mysqli_error($db_connect);
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
    <title>Jobsheet | Job Sheet App</title>
</head>

<body>
    <?php if($_SESSION['username']): ?>
            <div class="container">
                <h1 class="my-5">Jobsheet</h1>
                <table class="table-responsive table table-bordred">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Customer Name</th>
                            <th>Customer Contact</th>
                            <th>Customer Email</th>
                            <th>Model</th>
                            <th>IMEI</th>
                            <th>Password</th>
                            <th>Other Things</th>
                            <th>Physical Damaged</th>
                            <th>Liquid Damaged</th>
                            <th>Tempered</th>
                            <th>Condition of Mobile</th>
                            <th>Problem Description</th>
                            <th>Amount</th>
                            <th>Repaired</th>
                            <th>Delivered</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo date('d/M/Y h:i A', strtotime($jobsheet['recieving_date'])); ?></td>
                            <td><?php echo $jobsheet['customer_name']; ?></td>
                            <td><?php echo $jobsheet['customer_contact']; ?></td>
                            <td><?php echo $jobsheet['customer_email']; ?></td>
                            <td><?php echo $jobsheet['imei']; ?></td>
                            <td><?php echo $jobsheet['model']; ?></td>
                            <td><?php echo $jobsheet['password']; ?></td>
                            <td><?php echo $jobsheet['other_things']; ?></td>
                            
                            <!-- Changing Values from 0 to No and 1 to Yes -->
                            <td>
                                <?php if($jobsheet['isPhysicalDamaged'] == 1 ):?>
                                    <?php echo "Physical Damaged"; ?>
                                <?php else :?>
                                    <?php echo "No"; ?>
                                <?php endif;?>
                            </td>
                            <td>
                                <?php if($jobsheet['isLiquidDamaged'] == 1 ):?>
                                    <?php echo "Liquid Damaged"; ?>
                                <?php else :?>
                                    <?php echo "No"; ?>
                                <?php endif;?>
                            </td>
                            <td>
                                <?php if($jobsheet['isTempered'] == 1 ):?>
                                    <?php echo "Tempered"; ?>
                                <?php else :?>
                                    <?php echo "No"; ?>
                                <?php endif;?>
                            </td>

                            <td><?php echo $jobsheet['condition_of_mobile']; ?></td>
                            <td><?php echo $jobsheet['problem_description']; ?></td>
                            <td><?php echo $jobsheet['estimated_amount']; ?></td>
                            <td><?php echo $jobsheet['isRepaired']; ?></td>
                            <td><?php echo $jobsheet['isDelivered']; ?></td>                            
                        </tr>
                    </tbody>
                </table>

                <!-- Buttons for Marking as Repaired and Delivered -->
                <form class="mb-5" action="<?php echo $_SERVER['PHP_SELF']."?id=".$jobsheet['customer_id']; ?>" method="POST">
                    <input type="hidden" name="update_id" value="<?php echo $jobsheet['customer_id']; ?>">
                    <input type="submit" name="repaired" value="Repaired &#9989;" class="btn bg-success btn-lg text-white font-weight-bold"><br><br>
                    <input type="submit" name="delivered" value="Repaired and Delivered &#9989;" class="btn bg-primary btn-lg text-white font-weight-bold"><br><br>
                    <input type="submit" name="returned" value="Return Without Repair &#10060;" class="btn bg-danger btn-lg text-white font-weight-bold">
                </form>
            </div>
        <?php endif;?>
        
        <!-- Footer file -->
        <?php include 'includes/footer.php'; ?>
</body>
</html>