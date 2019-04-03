<?php 

    //Connect to MYSQL
    $db_connect = mysqli_connect('localhost', 'root', '123456', 'job_sheet_app');

    //Test Connection
    if(mysqli_connect_errno()) {
        echo 'Failed to Connect to MYSQL'.mysqli_connect_errno();
    }
    
?>