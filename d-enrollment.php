<?php

// include conn.php file here
include('config/conn.php');

// 1. get the ID of admin to be deleted
$enrollment_id = $_GET['enrollment_id'];

// 2. Create SQL query to delete admin
$sql = "DELETE FROM enrollments WHERE enrollment_id=$enrollment_id";

//Execute the query
$res = mysqli_query($cxn, $sql);

// check whether the query executed succesfully or not
if($res == TRUE)
{
    // query executed successfully and admin deleted
    //echo "Admini u fshi!";
    // create session variable to display message
    $_SESSION['delete'] = "<div class='success'>Enrollment deleted successfully!</div>";
    // redirect to manage admin page
    header("Location:" .SITEURL.'m-enrollments.php');
}
else{
    // faile to delete admin
    //echo "Fshirja deshtoi!";
    $_SESSION['delete'] = "<div class='error'>'Delete error. Please try again!</div>";
    // redirect to manage admin page
    header("Location:" .SITEURL.'m-enrollments.php');
}

//3. redirect to Managa admin page with message (success/error)

?>