<?php ob_start(); ?>
<?php include('partials/menu.php'); ?>

<!-- css code to clearfix -->
<style>
            body {
                overflow-x:hidden;
            }
        </style>
<br><br>
<!-- Pjesa kryesore SHto admin / start -->
<div class="row text-start p-5 mb-auto" style="width:90%; margin: auto;">
    <div class="col-md-8">
        <h1 class="p-1 text-start" style="color: #3f51b5;">Student - Payment Records</h1>
    </div>
    <div class="col-md-4">
        <div class="text-end"><a href="m-payments.php" class="btn btn-secondary btn-sm"><img src="img/icon-back.svg" height="30" width="30"></a></div>
    </div>       
<hr>

<?php
    if(isset($_SESSION['add'])) // checking whether the session is set or not
    {
        echo $_SESSION['add']; // displaying  the session message if set
        unset($_SESSION['add']); // remove session message
    } 
    if(isset($_SESSION['delete'])) 
    {
        echo $_SESSION['delete']; 
        unset($_SESSION['delete']); 
    } 
?>

</div>



<div class="container" style="width:83%; margin: auto;">

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Student</th>
      <th scope="col">Amount</th>
      <th scope="col">Payment date</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>

<?php
    
    // include('db_connection.php');
    $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, p.payment_id, p.payenrollment_id, p.amount, p.payment_date FROM students s 
    LEFT JOIN enrollments e
    ON s.student_id = e.enstudent_id
    LEFT JOIN courses c
    ON e.encourse_id = c.course_id
    LEFT JOIN payments p
    ON e.enrollment_id = p.payenrollment_id
    -- GROUP BY s.first_name
    ";

    $result = mysqli_query($cxn, $query);

    $sn = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $cname = $row['course_name'];
        $pay_id = $row['payment_id'];
        $payen_id = $row['payenrollment_id'];
        $amount = $row['amount'];
        $pay_date = $row['payment_date'];
        //echo $row['attendance_id'] . " | " . $row['attenrollment_id'] . " | " . $row['attendance_date'] . " | " . $row['status'] . "<br>";
    
    ?>

    <tr>
    <th scope="row"><?php echo $sn++?></th>
            <td>
                <?php echo $fname.' '.$lname; ?>
            </td>
            <td>
                <?php echo $amount; ?>
            </td>
            <td>
                <?php echo $pay_date; ?>
            </td>
            <td>
            <a href="<?php echo SITEURL; ?>u-payment.php?payment_id=<?php echo $pay_id; ?>"><img src="img/icon-update.png" alt="Update Payment"></a>
            <a href="<?php echo SITEURL; ?>d-payment.php?payment_id=<?php echo $pay_id; ?>"><img src="img/icon-delete.png" alt="Delete Payment"></a>
            </td>
    </tr>
    <?php

        
    }
    
    mysqli_close($cxn);
?>

</table>


    
</div>


<?php include('partials/footer.php'); ?>
<?php ob_end_flush(); ?>