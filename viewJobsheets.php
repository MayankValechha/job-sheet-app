<?php 

    //Requiring Session Variables
    session_start();

    //Database Connect
    require 'config/database.php';

    if(isset($_SESSION['username'])) {

        $shopID = $_SESSION['shop_id'];

        $query = "SELECT * FROM `jobsheet` WHERE shop_id = '$shopID' ";

        $results = mysqli_query($db_connect, $query); 

        //Fetching all rows
        $jobsheets = mysqli_fetch_all($results, MYSQLI_ASSOC);

        //Jobsheet number to show in ViewJobsheet page
        //Will be incremented on each loop
        $jobsheet_number = 1;

        //Checking if Repaired button is pressed
        if(isset($_POST['phone_repaired_submit'])) {
            
            //Grabbing customer id in $update_id
            $update_id = $_POST['update_id'];
            
            $query = " UPDATE `jobsheet`
                       SET isRepaired = 1
                       WHERE customer_id = {$update_id}
                    ";
            
        }
    }

    //Classes for Repaired or Not Repaired
    $phone_not_repaired = 'bg-danger text-white';
    $phone_repaired = 'bg-success text-dark'
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <title>View Jobsheets | Job Sheet Application</title>
</head>
<body>
    <!-- Checking if User is Logged! -->
    <?php if($_SESSION['username']): ?>
        <div class="container">
            <div class="row">
                <h1 class="my-5">View Jobsheets</h1>
                <table class="table-responsive table table-bordred table-hover">
                    <thead>
                        <tr>
                            <th>Jobsheet No</th>
                            <th>Recieving Date</th>
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
                    <?php foreach($jobsheets as $jobsheet): ?>
                        <tbody>
                                <tr>
                                    <td><?php echo $jobsheet_number; ?></td>
                                    <td><?php echo $jobsheet['recieving_date']; ?></td>
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
                                    <?php $jobsheet_number++; ?>
                                    
                                    <td>
                                        <form action="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-group">
                                            <input type="hidden" name="update_id" value="<?php echo $jobsheet['customer_id']; ?>">
                                            <input type="submit" value="Repaired" name="phone_repaired_submit" class="form-control btn-btn primary">
                                        </form>
                                    </td>
                                </tr>
                        </tbody>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    <?php endif;?>

    <!-- Footer file -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>