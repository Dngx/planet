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
        <h1 class="p-1 text-start" style="color: #3f51b5;">Student - Attendance Records</h1>
    </div>
    <div class="col-md-4">
        <div class="text-end"><a href="m-attendances.php" class="btn btn-secondary btn-sm"><img src="img/icon-back.svg" height="30" width="30"></a></div>
    </div>       
<hr>
</div>

<?php
    if(isset($_SESSION['add'])) // checking whether the session is set or not
    {
        echo $_SESSION['add']; // displaying  the session message if set
        unset($_SESSION['add']); // remove session message
    } 
?>

<div class="container" style="width:83%; margin: auto;">

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Student</th>
      <th scope="col">Course</th>
      <th scope="col">Attendance date</th>
      <th scope="col">Status</th>
    </tr>
  </thead>

<?php
    
    // include('db_connection.php');
    $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, a.attendance_id, a.attenrollment_id, a.attendance_date, a.status  FROM students s 
    LEFT JOIN enrollments e
    ON s.student_id = e.enstudent_id
    LEFT JOIN courses c
    ON e.encourse_id = c.course_id
    LEFT JOIN attendances a
    ON e.enrollment_id = a.attenrollment_id
    -- GROUP BY s.first_name
    ";

    $result = mysqli_query($cxn, $query);

    $sn = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $cname = $row['course_name'];
        $att_id = $row['attendance_id'];
        $atten_id = $row['attenrollment_id'];
        $att_date = $row['attendance_date'];
        $att_stat = $row['status'];
        //echo $row['attendance_id'] . " | " . $row['attenrollment_id'] . " | " . $row['attendance_date'] . " | " . $row['status'] . "<br>";
    
    ?>

    <tr>
    <th scope="row"><?php echo $sn++?></th>
            <td>
                <?php echo $fname.' '.$lname; ?>
            </td>
            <td>
                <?php echo $cname; ?>
            </td>
            <td>
                <?php echo $att_date; ?>
            </td>
            <td>
                <?php echo $att_stat; ?>
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