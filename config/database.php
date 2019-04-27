<?php 

    //Defining Constants for Database
    define("HOST", 'localhost');
    define("USER", 'root');
    define("PASSWORD", '123456');
    define("DB", 'job_sheet_app');

    //Connect to MYSQL
    $db_connect = mysqli_connect(HOST, USER, PASSWORD, DB);

    //Test Connection
    if(mysqli_connect_errno()) {
        echo 'Failed to Connect to MYSQL'.mysqli_connect_errno();
    }
    
?>