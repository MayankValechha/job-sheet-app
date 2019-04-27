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

        //Showing Query
        //var_dump($jobsheets);
    }

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
                <h2>View Jobsheets</h2>
                <?php foreach($jobsheets as $jobsheet): ?>
                    <div class="table-repsonsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Customer Name</th>
                                <th>Customer Contact</th>
                                <th>Customer Email</th>
                                <th>Model</th>
                                <th>IMEI</th>
                                <th>Password</th>
                                <th>Other Things</th>
                                <th>Condition of Mobile</th>
                                <th>Problem Description</th>
                                <th>Amount</th>
                            </tr>
                            <tr>
                                <td><?php echo $jobsheet['customer_name']; ?></td>
                                <td><?php echo $jobsheet['customer_contact']; ?></td>
                                <td><?php echo $jobsheet['customer_email']; ?></td>
                                <td><?php echo $jobsheet['imei']; ?></td>
                                <td><?php echo $jobsheet['model']; ?></td>
                                <td><?php echo $jobsheet['password']; ?></td>
                                <td><?php echo $jobsheet['other_things']; ?></td>
                                <td><?php echo $jobsheet['condition_of_mobile']; ?></td>
                                <td><?php echo $jobsheet['problem_description']; ?></td>
                                <td><?php echo $jobsheet['estimated_amount']; ?></td>
                            </tr>
                        </table>
                    </div>    
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif;?>
    <?php include 'includes/footer.php'; ?>
</body>
</html>