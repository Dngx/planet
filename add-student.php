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
<p><h1 class="p-1 text-start" style="color: #3f51b5;">Student registration form</h1></p><hr>
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
                            <label for="fname" class="form-label">First name:</label>
                            <input type="text" class="form-control" name="fname" placeholder="Student first name...">
                        </div>
                        <div class="mb-2">
                            <label for="lname" class="form-label">Last name:</label>
                            <input type="text" class="form-control" name="lname" placeholder="Student last name...">
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="Contact email...">
                        </div>
                        <div class="mb-2">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="number" class="form-control" name="phone" placeholder="Phone number...">
                        </div>
                        <div class="mb-2">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" name="address" placeholder="Living address...">
                        </div>
                        <div class="mb-2">
                            <label for="parent" class="form-label">Parent:</label>
                            <input type="text" class="form-control" name="parent" placeholder="Parent's full name...">
                        </div><br>
                        <input type="submit" name="submit" value="Register" class="btn btn-primary">
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

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $parent = $_POST['parent'];
        //$fjalekalimi = md5($_POST['fjalekalimi']); // Password encryption with md5 ! cannot be decrypted.
            // use the above code line to include passwords!

        // 2. SQL query to save the data into database

        $sql = "INSERT INTO students SET 
            first_name  = '$fname',
            last_name  = '$lname',
            email = '$email',
            phone = '$phone',
            address = '$address',
            parent = '$parent'
        ";

        // 3. Executing query and saving data into database
        $res = mysqli_query($cxn, $sql) or die(mysqli_error());


        //4. Check whether the (query is executed) data is inserted or not and display appropriate message
        if($res == TRUE){
            // Data inserted
            //echo "Data inserted.";
            // create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Student registered!</div>";
            // redirect page to manage admin
            header("Location:" .SITEURL. 'm-students.php');
        }
        else{
            // failed to insert data
            //echo "Failed to insert data!";
            // create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Error registering student!</div>";
            // redirect page to add admin
            header("Location:" .SITEURL. 'add-student.php');
            }
    }
    

?>

<?php include('partials/footer.php'); ?>
<?php ob_end_flush(); ?>