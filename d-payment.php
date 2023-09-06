<?php

// include conn.php file here
include('config/conn.php');

// 1. get the ID of admin to be deleted
$pay_id = $_GET['payment_id'];

// 2. Create SQL query to delete admin
$sql = "DELETE FROM payments WHERE payment_id=$pay_id";

//Execute the query
$res = mysqli_query($cxn, $sql);

// check whether the query executed succesfully or not
if($res == TRUE)
{
    // query executed successfully and admin deleted
    //echo "Admini u fshi!";
    // create session variable to display message
    $_SESSION['delete'] = "<div class='success'>Payment deleted!</div>";
    // redirect to manage admin page
    header("Location:" .SITEURL.'r-payments.php');
}
else{
    // faile to delete admin
    //echo "Fshirja deshtoi!";
    $_SESSION['delete'] = "<div class='error'>'Delete error. Please try again!</div>";
    // redirect to manage admin page
    header("Location:" .SITEURL.'r-payments.php');
}

//3. redirect to Managa admin page with message (success/error)

?>