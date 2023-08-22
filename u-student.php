<?php ob_start(); ?>
<?php include('partials/menu.php'); ?>

<br><br>
<!-- Pjesa kryesore Perditeso admin / start -->
<div class="row text-center p-4 mb-auto" style="width:85%; margin: auto;">
<p><h1 class="p-1 text-start" style="color: #3f51b5;">Update student information</h1></p><hr>
</div>

<div class="row text-start p-0 mb-auto" style="width:30%; margin: auto;">
            <div class="container ">
                    
                    <?php 
                        // 1. Get the ID of selected Admin
                        $student_id = $_GET['student_id'];

                        // 2. create SQL query to get the details
                        $sql = "SELECT * FROM students WHERE student_id=$student_id";

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

                                $fname = $row['first_name'];
                                $lname = $row['last_name'];
                                $email = $row['email'];
                                $phone = $row['phone']; 
                                $address = $row['address'];
                            }
                            else{
                                // redirect to manage admin page
                                header("Location: " .SITEURL. 'm-students.php');
                            }
                        }
                    ?>

                    <form action="" method="POST">
                        <div class="mb-2">
                            <label for="fname" class="form-label">First name:</label>
                            <input type="text" class="form-control" name="fname" value="<?php echo $fname;?>">
                        </div>
                        <div class="mb-2">
                            <label for="lname" class="form-label">Last name:</label>
                            <input type="text" class="form-control" name="lname" value="<?php echo $lname;?>">
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $email;?>">
                        </div>
                        <div class="mb-2">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="number" class="form-control" name="phone" value="<?php echo $phone;?>">
                        </div>
                        <div class="mb-2">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" name="address" value="<?php echo $address;?>">
                        </div>
                        <br>
                        <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
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
        $student_id = $_POST['student_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        // create a SQL query to update admin
        $sql = "UPDATE students SET
        first_name = '$fname',
        last_name = '$lname',
        email = '$email',
        phone = '$phone',
        address = '$address'

        WHERE student_id = '$student_id'
        ";

        // execute the query
        $res = mysqli_query($cxn, $sql);

        // check whether the query executed successfully or not
        if($res == TRUE)
        {
            // query executed and query updated
            $_SESSION['update'] = "<div class='success'>Student information updated successfully!</div>";
            // redirect to manage admin page
            header("Location: " .SITEURL. 'm-students.php');
        }
        else
        {
            // failed to update admin
            $_SESSION['update'] = "<div class='error'>Update error!</div>";
            // redirect to manage admin page
            header("Location: " .SITEURL. 'm-students.php');
        }
    }
?>

<!-- Pjesa kryesore Perditeso admin / end -->

<?php include('partials/footer.php'); ?>
<?php ob_end_flush(); ?>