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
<div class="row text-center p-4 mb-auto" style="width:85%; margin: auto;">
<p><h1 class="p-1 text-start" style="color: #3f51b5;">Student - Course enrollments</h1></p><hr>
</div>

<?php
    if(isset($_SESSION['add'])) // checking whether the session is set or not
    {
        echo $_SESSION['add']; // displaying  the session message if set
        unset($_SESSION['add']); // remove session message
    } 
?>

<div class="row p-0 mb-auto" style="width:30%; margin-left: 10%;">
            <div class="container ">
                            
                    <form action="" method="POST">
                        <div class="mb-2">
                            <label for="student" class="form-label">Student:</label>
                            <select class="form-select" aria-label="Default select example" name="student">

                                <?php
                                    // create php code to display categories from database
                                    // 1. create sql to get all active categories from database
                                    $sql = "SELECT * FROM students";

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
                                            $student_id = $row['student_id'];
                                            $fname = $row['first_name'];
                                            $lname = $row['last_name'];
                                            ?>
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
                            <label for="course" class="form-label">Course:</label>
                            <select class="form-select" aria-label="Default select example" name="course">

                                <?php
                                    // create php code to display categories from database
                                    // 1. create sql to get all active categories from database
                                    $sql = "SELECT * FROM courses";

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
                                            $course_id = $row['course_id'];
                                            $course = $row['course_name'];
                                            
                                            ?>
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
                            <label for="enrollment" class="form-label">Enrollment date:</label>
                            <input type="date" class="form-control" name="enrollment" placeholder="Enter enrollment date...">
                        </div>
                        <br>
                        <input type="submit" name="submit" value="Enroll" class="btn btn-primary">
                    </form>
            </div>
</div>



<!-- Pjesa kryesore SHto admin / end -->



<?php 
    // Process the value from form and save it in database
    // Check whether the submit button is clicked or not

    if (isset($_POST['submit']))
    {
        // BUtton clicked 
        // echo "Clicked";

        // 1. Get the data from form

        $student = $_POST['student'];
        $course = $_POST['course'];
        $enrollment = $_POST['enrollment'];
        
        //$fjalekalimi = md5($_POST['fjalekalimi']); // Password encryption with md5 ! cannot be decrypted.
            // use the above code line to include passwords!

        // 2. SQL query to save the data into database

        $sql = "INSERT INTO enrollments SET 
            enstudent_id  = '$student',
            encourse_id  = '$course',
            enrollment_date = '$enrollment'
        ";

        // 3. Executing query and saving data into database
        $res = mysqli_query($cxn, $sql) or die(mysqli_error());


        //4. Check whether the (query is executed) data is inserted or not and display appropriate message
        if($res == TRUE){
            // Data inserted
            //echo "Data inserted.";
            // create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Enrollment done!</div>";
            // redirect page to manage admin
            header("Location:" .SITEURL. 'm-enrollments.php');
        }
        else{
            // failed to insert data
            //echo "Failed to insert data!";
            // create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Error on student enrollment!</div>";
            // redirect page to add admin
            header("Location:" .SITEURL. 'add-enrollments.php');
            }
    }
    

?>

<?php include('partials/footer.php'); ?>
<?php ob_end_flush(); ?>