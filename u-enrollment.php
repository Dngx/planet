<?php ob_start(); ?>
<?php include('partials/menu.php');?>

<br><br>
<!-- Pjesa kryesore Perditeso admin / start -->
<div class="row text-center p-4 mb-auto" style="width:85%; margin: auto;">
<p><h1 class="p-1 text-start" style="color: #3f51b5;">Update enrollment</h1></p><hr>
</div>
<style>
    .success {
    color:#27ae60;
    }

    .error {
        color: #e74c3c;
    }
</style>
<div class="row text-start p-0 mb-auto" style="width:30%; margin: auto;">
            <div class="container ">
                    
                    <?php 
                        // 1. Get the ID of selected Admin
                        $enrollment_id = $_GET['enrollment_id'];

                        // 2. create SQL query to get the details
                        $sql = "
                        SELECT s.first_name, s.last_name, c.course_name, e.enrollment_date, e.enrollment_id, e.enstudent_id, e.encourse_id  FROM students s 
                        LEFT JOIN enrollments e
                        ON s.student_id = e.enstudent_id
                        LEFT JOIN courses c
                        ON e.encourse_id = c.course_id
                        
                        WHERE e.enrollment_id=$enrollment_id";

                        // Eecute the query
                        $res = mysqli_query($cxn, $sql);

                        // Check whether the query is executed or not
                        if($res == TRUE)
                        {
                            //Check whether the data is available or not
                            $count = mysqli_num_rows($res);
                            //check whether we have admin data or not
                            if($count == 1)
                            {
                                // get the details
                                //echo "Ka perdorues admin!";
                                $row = mysqli_fetch_assoc($res);

                                //$enrollment_id = $row['enrollment_id'];
                                $enstudent_id = $row['enstudent_id'];
                                $fname = $row['first_name'];
                                $lname = $row['last_name'];
                                $cname = $row['course_name'];
                                $encourse_id = $row['encourse_id']; 
                                $endate = $row['enrollment_date']; 
                                
                                //echo $enrollment_id. ' '.$enstudent_id.' '.$encourse_id.' '.$endate;
                            }
                            else{
                                // redirect to manage admin page
                                header("Location: " .SITEURL. 'm-enrollments.php');
                            }
                        }
                    ?>

                    <form action="" method="POST">
                        <div class="mb-2">
                            <label for="student" class="form-label">Student: 
                                <?php 
                                if(!isset($fname) && !isset($lname))
                                    {echo isset($fname, $lname);} 
                                        else {echo $fname.' '.$lname;}
                                ?>
                            </label>
                            <!-- <input type="text" class="form-control" name="student" value="<?php //echo $fname.' '.$lname;?>"> -->
                                    
                                    <select class="form-select" aria-label="Default select example" name="enstudent_id2">

                                        <?php
                                            // create php code to display categories from database
                                            // 1. create sql to get all active categories from database
                                            $sql2 = "SELECT * FROM students";

                                            // executing the query
                                            $res2 = mysqli_query($cxn, $sql2);
                                            
                                            //count rows to check whether we have categories or not
                                            $count2 = mysqli_num_rows($res2);

                                            // if count is greater than zero, we have categories else we do not have categories
                                            if($count2>0)
                                            {
                                                // we have categories
                                                while($row = mysqli_fetch_assoc($res2))
                                                {
                                                    //get the details of categories
                                                    $student_id = $row['student_id'];
                                                    $fname = $row['first_name'];
                                                    $lname = $row['last_name'];
                                                    ?>
                                                    <option selected hidden>Choose here</option>
                                                    <option value="<?php echo $student_id; ?>"><?php echo $fname.' '.$lname; ?></option>
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
                        <div class="mb-2">
                            <label for="course" class="form-label">Course: 
                                <?php 
                                if(!isset($cname))
                                    {echo isset($cname);} 
                                        else {echo $cname;} 
                                ?>
                            </label>
                            
                            <select class="form-select" aria-label="Default select example" name="encourse_id2">

                                <?php
                                    // create php code to display categories from database
                                    // 1. create sql to get all active categories from database
                                    $sql3 = "SELECT * FROM courses";

                                    // executing the query
                                    $res3 = mysqli_query($cxn, $sql3);
                                    
                                    //count rows to check whether we have categories or not
                                    $count3 = mysqli_num_rows($res3);

                                    // if count is greater than zero, we have categories else we do not have categories
                                    if($count3>0)
                                    {
                                        // we have categories
                                        while($row = mysqli_fetch_assoc($res3))
                                        {
                                            //get the details of categories
                                            $course_id = $row['course_id'];
                                            $course = $row['course_name'];
                                            
                                            ?>
                                            <option selected hidden>Choose here</option>
                                            <option value="<?php echo $course_id; ?>"><?php echo $course; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        // we do not have categories
                                        ?>
                                        <option value="0">There are no courses available</option>
                                        <?php
                                    }

                                    // 2. display on dropdown
                                ?>    
                            </select>




                        </div>
                        <div class="mb-2">
                            <label for="endate" class="form-label">Enrollment date:</label>
                            <input type="date" class="form-control" name="endate2" value="<?php echo $endate;?>">
                        </div>
                        <br>
                        <input type="hidden" name="enrollment_id2" value="<?php echo $enrollment_id; ?>">
                        <input type="submit" name="submit" value="Update" class="btn btn-primary">
                    </form>
                    <?php 
                    //echo $enrollment_id. ' '.$enstudent_id.' '.$encourse_id.' '.$endate;                    
                    ?>
            </div>
</div>

<?php 
    // check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Butoni u klikua";
        // get all the values from form to update
        $enrollment_id = $_POST['enrollment_id2'];
        $st_id = $_POST['enstudent_id2'];
        $co_id = $_POST['encourse_id2'];
        $endt = $_POST['endate2'];

        // create a SQL query to update admin
        $sql = "UPDATE enrollments SET
        enstudent_id = '$st_id',
        encourse_id = '$co_id',
        enrollment_date = '$endt'

        WHERE enrollment_id = '$enrollment_id'
        ";

        // execute the query
        $res = mysqli_query($cxn, $sql);

        // check whether the query executed successfully or not
        if($res == TRUE)
        {
            // query executed and query updated
            $_SESSION['update'] = "<div class='success'>Enrollment updated successfully!</div>";
            // redirect to manage admin page
            header("Location: " .SITEURL. 'm-enrollments.php');
            //echo "Data updated successfully!";
        }
        else
        {
            // failed to update admin
            $_SESSION['update'] = "<div class='error'>Enrollment update error!</div>";
            // redirect to manage admin page
            //header("Location: " .SITEURL. 'm-enrollments.php');
            echo "<div class='error text-center'>Update failed! Please choose all the nessesary options from drop down lists!</div>";
        }
    }
?>

<!-- Pjesa kryesore Perditeso admin / end -->

<?php include('partials/footer.php'); ?>
<?php ob_end_flush(); ?>