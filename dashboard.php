<?php
    //Requiring Session Variables
    session_start();

    //Database Connect
    require 'config/database.php';

    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        
        $query = "SELECT * FROM `shopkeepers` WHERE contact = '$username'";

        $results = mysqli_query($db_connect, $query); 

        $shop = mysqli_fetch_assoc($results);

        //Setting Shop ID in SESSIONS for CreateJobsheet page
        $_SESSION['shop_id'] = $shop['shop_id'];
        // Dashboard Main Functionalities
        // $query = "SELECT * FROM `jobsheet`";

        // $results = mysqli_query($db_connect, $query);

        // $data = mysqli_fetch_all($results, MYSQLI_ASSOC);
        
        // var_dump($data);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <title>Dashboard | Job Sheet Application</title>
</head>
<body>
    <?php if(isset($_SESSION['username'])): ?>
        
        <h3>Welcome <b><?php echo $shop['name']; ?></b></h3>
        
        <h4 class="alert alert-success"><?php echo $_SESSION['success']; ?></h4>
        
        <br><br>
        
        <?php $_SESSION['shopID'] = $shop['shop_id'];?> 
        <h3><a href="createJobsheet.php">Create Jobsheet</a></h3>
        <br>
        <h3><a href="viewJobsheets.php">View Jobsheets</a></h3>
        <br>
        <h3><a href="viewProfile.php">View Profile</a></h3>

        <br><br>
        
        <!-- Shopkeeper Details -->
        <ul class="list-group">
            <h5><b>Data for Testing</b></h5>
            <li class="list-group-item"><?php echo $shop['shop_id']; ?></li>
            <li class="list-group-item"><?php echo $shop['name']; ?></li>
            <li class="list-group-item"><?php echo $shop['contact']; ?></li>
            <li class="list-group-item"><?php echo $shop['address']; ?></li>
        </div> 
        <br>
        <h3><a href="logout.php">Logout</a></h3>
    <?php endif; ?>

    <!-- If user is not logged in, below code will run -->
    <?php include 'includes/usernot_set.php'; ?>

    <!-- Testing Purpose -->    
    <!-- Will be deleted later -->
    <div class="bg-dark text-white">
        <p>Testing Content</p>
        <?php var_dump($_SESSION); ?>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html> 