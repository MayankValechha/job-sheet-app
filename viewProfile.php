<?php  

    //Requiring Session Variables
    session_start();

    //Database Connect
    require 'config/database.php';

    if(isset($_SESSION['username'])) {

        $shopID = $_SESSION['shop_id'];

        $query = "SELECT * FROM `shopkeepers` WHERE shop_id = '$shopID' ";

        $result = mysqli_query($db_connect, $query); 

        //Fetching all rows
        $shop = mysqli_fetch_assoc($result);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">    
    <title>Profile | Job Sheet Application</title>
</head>
<body>
    <div class="container">
        <?php if(isset($_SESSION['username'])) : ?>
            <h1>Your Profile</h1>
            <h5>Shop Name : <?php echo $shop['name']; ?></h5>
            <h5>Shop Address : <?php echo $shop['address']; ?></h5>
            <h5>Shop Contact : <?php echo $shop['contact']; ?></h5>
            <h5>Account Created On : <?php echo $shop['created_at']; ?></h5>
        <?php endif; ?>
    </div>
    <?php include 'includes/footer.php';?>
</body>
</html>