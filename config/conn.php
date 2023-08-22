<?php 
    // This code creates connection with database.

    // Create constants to store non repeating values
    define('SITEURL', 'http://localhost/planet/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'planet');

    $cxn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($cxn)); // Database connection
    $db_select = mysqli_select_db($cxn, DB_NAME) or die(mysqli_error($cxn)); // selecting database

    // This conditional function echoes the status of db connection
    if(!$cxn){
        echo "Error: " .mysqli_connect_error();
        exit();
    }
    //echo "Connection Successful!";

?>