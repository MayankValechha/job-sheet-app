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
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">    
    <title>View Jobsheets | Job Sheet Application</title>
</head>
<body>

    <!-- If user is not logged in, below code will run -->
    <?php include 'includes/usernot_set.php'; ?>


    <!-- Checking if User is Logged! -->
    <?php if(isset($_SESSION['username'])): ?>
        <?php include 'includes/navbar.php'; ?>
        <div class="container">
            <h1 class="mt-5">View All Jobsheets</h1>
            <h4 class="mb-5">Click on <span class="bg-dark font-weight-bold text-white">View Jobsheet</span> to get more details.</h4>
            <table class="table-responsive table table-bordred table-hover">
                <thead>
                    <tr>
                        <th>Jobsheet No</th>
                        <th>Date & Time</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Model</th>
                        <th>Password</th>
                        <th>Problem Description</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Delivered</th>
                    </tr>
                </thead>
                <?php foreach($jobsheets as $jobsheet): ?>
                    <tbody>
                            <tr>
                                <td><?php echo $jobsheet_number; ?></td>
                                <td><?php echo date('d/M/Y h:i A', strtotime($jobsheet['recieving_date'])); ?></td>
                                <td><?php echo $jobsheet['customer_name']; ?></td>
                                <td><?php echo $jobsheet['customer_contact']; ?></td>
                                <td><?php echo $jobsheet['model']; ?></td>
                                <td><?php echo $jobsheet['password']; ?></td>                                
                                <td><?php echo $jobsheet['problem_description']; ?></td>
                                <td><?php echo $jobsheet['estimated_amount']; ?></td>

                                <!-- <?php if($jobsheet['isRepaired'] == 1 ):?>
                                        <?php echo "<td>Repaired</td>"; ?>
                                    <?php else :?>
                                        <?php echo "<td>Under Repairing</td>"; ?>
                                <?php endif;?>

                                <?php if($jobsheet['isDelivered'] == 1 ):?>
                                        <?php echo "<td>Delivered</td>"; ?>
                                    <?php else :?>
                                        <?php echo "<td>Not Yet</td>"; ?>
                                <?php endif;?> -->

                                <?php if($jobsheet['isRepaired'] == 1  && $jobsheet['isDelivered'] == 1): ?>
                                    <td class="bg-success text-white font-weight-bold"><?php echo "Phone is Repaired and Delivered"; ?></td>
                                <?php endif; ?>

                                <?php if($jobsheet['isRepaired'] == 0  && $jobsheet['isDelivered'] == 1): ?>
                                    <td class="bg-danger text-white font-weight-bold"><?php echo "Phone is Retuned without Repair"; ?></td>
                                <?php endif; ?>

                                <?php if($jobsheet['isRepaired'] == 1  && $jobsheet['isDelivered'] == 0): ?>
                                    <td class="bg-warning text-white font-weight-bold"><?php echo "Phone is Repaired but not Delivered"; ?></td>
                                <?php endif; ?>

                                <?php if($jobsheet['isRepaired'] == 0  && $jobsheet['isDelivered'] == 0): ?>
                                    <td class="bg-warning font-weight-bold"><?php echo "Phone is Under Repairing"; ?></td>
                                <?php endif; ?>
                                
                                <?php $jobsheet_number++; ?>
                                
                                <td>
                                    <a href="jobsheet.php?id=<?php echo $jobsheet['customer_id']; ?>" class="btn btn-primary font-weight-bold">View Jobsheet</a>
                                </td>
                            </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif;?>

    <!-- Footer file -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>