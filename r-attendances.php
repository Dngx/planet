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
<div class="row text-start mb-auto" style="width:90%; margin: auto; padding: 3rem; padding-bottom: unset;">
    <div class="col-md-8">
        <h1 class="p-1 text-start" style="color: #3f51b5;">Student - Attendance Records</h1>
    </div>
    <div class="col-md-4">
        <div class="text-end"><a href="m-attendances.php" class="btn btn-secondary btn-sm"><img src="img/icon-back.svg" height="30" width="30"></a></div>
    </div>       
<hr>

<div class="row mb-auto" style="margin: auto;">
<div class="col-12 text-start" style="padding-left: 0;">
                  <form action="" method="POST" class="form-inline" style="padding-left: 0;">
                  
                    <div class="col-8 text-start d-inline" style="padding-left: 0;">
                            <label for="student" class="form-label" style="padding-left: 0;">Filter records by student name: </label>
                            &nbsp;                   
                            
                            <select class="form-select w-25 d-inline" aria-label="Default select example" name="student">
                            
                                <?php
                                    // create php code to display categories from database
                                    // 1. create sql to get all active categories from database
                                    $sql = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, g.grade_id, g.grenrollment_id, g.grade, g.grade_description FROM students s 
                                            LEFT JOIN enrollments e
                                            ON s.student_id = e.enstudent_id
                                            LEFT JOIN courses c
                                            ON e.encourse_id = c.course_id
                                            LEFT JOIN grades g
                                            ON e.enrollment_id = g.grenrollment_id
                                            GROUP BY CONCAT(s.first_name, s.last_name)
                                            ";

                                    // executing the query
                                    $res = mysqli_query($cxn, $sql);
                                    
                                    //count rows to check whether we have categories or not
                                    $count = mysqli_num_rows($res);

                                    // if count is greater than zero, we have categories else we do not have categories
                                    if($count>0)
                                    {
                                        // we have categories
                                        while($row = mysqli_fetch_assoc($res))
                                        {
                                            //get the details of categories
                                            $gr_id = $row['grade_id'];
                                            $fname = $row['first_name'];
                                            $lname = $row['last_name'];
                                            $student = $fname .' '.$lname;
                                            
                                            ?>
                                            <option value="<?php echo $student; ?>"><?php echo $student; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        // we do not have categories
                                        ?>
                                        <option value="0">There are no students available</option>
                                        <?php
                                    }

                                    // 2. display on dropdown
                                ?>    
                            </select>
                            </div>
                            <div class="col-4 d-inline">&nbsp;
                            <button type="submit" class="btn btn-primary" name="filter">Filter</button>
                            </div>
                            <div class="col-4 d-inline">&nbsp;
                            <a href="r-attendances.php" class="btn btn-outline-primary" name="show">Show all</a>
                            </div>
                            </form>
                            </div>
</div>

<?php
    if(isset($_SESSION['add'])) // checking whether the session is set or not
    {
        echo $_SESSION['add']; // displaying  the session message if set
        unset($_SESSION['add']); // remove session message
    } 
    if(isset($_SESSION['error']))
    {
        echo $_SESSION['error']; // displaying session message
        unset($_SESSION['error']); // removing session message
    }
?>
</div>

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
    if(isset($_POST['filter'])){
        //echo "filter button clicked.";
        $student_n = $_POST['student'];
        echo "<div class='success'>Selected student name: " .$student_n. "</div><br>";
    
        //use following code to filter data by the selected student
    $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, a.attendance_id, a.attenrollment_id, a.attendance_date, a.status  FROM students s 
    LEFT JOIN enrollments e
    ON s.student_id = e.enstudent_id
    LEFT JOIN courses c
    ON e.encourse_id = c.course_id
    LEFT JOIN attendances a
    ON e.enrollment_id = a.attenrollment_id
    WHERE CONCAT(s.first_name, ' ' , s.last_name) = '".$student_n."'
    -- GROUP BY s.first_name
    ";
    } else{
        echo "<div class='error'>Showing all the existing students in database. You didn't select any student!</div> <br>";

    //use following code for else case - to show all the existing data in the grades table
    $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, a.attendance_id, a.attenrollment_id, a.attendance_date, a.status  FROM students s 
    LEFT JOIN enrollments e
    ON s.student_id = e.enstudent_id
    LEFT JOIN courses c
    ON e.encourse_id = c.course_id
    LEFT JOIN attendances a
    ON e.enrollment_id = a.attenrollment_id
    ORDER BY a.attendance_date DESC
    ";
    }

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