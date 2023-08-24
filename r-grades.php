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
        <h1 class="p-1 text-start" style="color: #3f51b5;">Student - Grading Records</h1>
    </div>
    <div class="col-md-4">
        <div class="text-end"><a href="m-grades.php" class="btn btn-secondary btn-sm"><img src="img/icon-back.svg" height="30" width="30"></a></div>
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
      <th scope="col">Grade</th>
      <th scope="col">Description</th>
    </tr>
  </thead>

<?php
    
    // include('db_connection.php');
    $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, g.grade_id, g.grenrollment_id, g.grade, g.grade_description FROM students s 
    LEFT JOIN enrollments e
    ON s.student_id = e.enstudent_id
    LEFT JOIN courses c
    ON e.encourse_id = c.course_id
    LEFT JOIN grades g
    ON e.enrollment_id = g.grenrollment_id
    -- GROUP BY s.first_name
    ";

    $result = mysqli_query($cxn, $query);

    $sn = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $cname = $row['course_name'];
        $gr_id = $row['grade_id'];
        $gren_id = $row['grenrollment_id'];
        $grade = $row['grade'];
        $gr_desc = $row['grade_description'];
        //echo $row['attendance_id'] . " | " . $row['attenrollment_id'] . " | " . $row['attendance_date'] . " | " . $row['status'] . "<br>";
    
    ?>

    <tr>
    <th scope="row"><?php echo $sn++?></th>
            <td>
                <?php echo $fname.' '.$lname; ?>
            </td>
            <td>
                <?php echo $grade; ?>
            </td>
            <td>
                <?php echo $gr_desc; ?>
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