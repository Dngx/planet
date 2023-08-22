<?php ob_start(); ?>
<?php include('partials/menu.php'); ?>

<br><br>
<!-- Pjesa kryesore Perditeso admin / start -->
<div class="row text-center p-4 mb-auto" style="width:85%; margin: auto;">
<p><h1 class="p-1 text-start" style="color: #3f51b5;">Update course</h1></p><hr>
</div>

<div class="row text-start p-0 mb-auto" style="width:30%; margin: auto;">
            <div class="container ">
                    
                    <?php 
                        // 1. Get the ID of selected Admin
                        $course_id = $_GET['course_id'];

                        // 2. create SQL query to get the details
                        $sql = "SELECT * FROM courses WHERE course_id=$course_id";

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

                                $course_name = $row['course_name'];
                                $sdate = $row['start_date'];
                                $edate = $row['end_date'];
                                $instructor = $row['instructor'];
                            }
                            else{
                                // redirect to manage admin page
                                header("Location: " .SITEURL. 'm-courses.php');
                            }
                        }
                    ?>

                    <form action="" method="POST">
                        <div class="mb-2">
                            <label for="course" class="form-label">Course:</label>
                            <input type="text" class="form-control" name="course_name" value="<?php echo $course_name;?>">
                        </div>
                        <div class="mb-2">
                            <label for="sdate" class="form-label">Start date:</label>
                            <input type="date" class="form-control" name="sdate" value="<?php echo $sdate; ?>">
                        </div>
                        <div class="mb-2">
                            <label for="edate" class="form-label">End date:</label>
                            <input type="date" class="form-control" name="edate" value="<?php echo $edate;?>">
                        </div>
                        <div class="mb-2">
                            <label for="instructor" class="form-label">Instructor:</label>
                            <input type="text" class="form-control" name="instructor" value="<?php echo $instructor;?>">
                        </div>
                        <br>
                        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                        <input type="submit" name="submit" value="Update" class="btn btn-primary">
                    </form>
            </div>
</div>

<?php 
    // check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Butoni u klikua";
        // get all the values from form to update
        $course_id = $_POST['course_id'];
        $course_name = $_POST['course_name'];
        $sdate = $_POST['sdate'];
        $edate = $_POST['edate'];
        $instructor = $_POST['instructor'];

        // create a SQL query to update admin
        $sql = "UPDATE courses SET
        course_name = '$course_name',
        start_date = '$sdate',
        end_date = '$edate',
        instructor = '$instructor'

        WHERE course_id = '$course_id'
        ";

        // execute the query
        $res = mysqli_query($cxn, $sql);

        // check whether the query executed successfully or not
        if($res == TRUE)
        {
            // query executed and query updated
            $_SESSION['update'] = "<div class='success'>Course updated successfully!</div>";
            // redirect to manage admin page
            header("Location: " .SITEURL. 'm-courses.php');
        }
        else
        {
            // failed to update admin
            $_SESSION['update'] = "<div class='error'>Update error!</div>";
            // redirect to manage admin page
            header("Location: " .SITEURL. 'm-courses.php');
        }
    }
?>

<!-- Pjesa kryesore Perditeso admin / end -->

<?php include('partials/footer.php'); ?>
<?php ob_end_flush(); ?>