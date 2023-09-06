<?php ob_start(); ?>
<?php include('partials/menu.php'); ?>

<br><br>
<!-- Pjesa kryesore Perditeso admin / start -->
<div class="row text-center p-4 mb-auto" style="width:85%; margin: auto;">
<p><h1 class="p-1 text-start" style="color: #3f51b5;">Update grade</h1></p><hr>
</div>

<div class="row text-start p-0 mb-auto" style="width:30%; margin: auto;">
            <div class="container ">
                    
                    <?php 
                        // 1. Get the ID of selected Admin
                        $grade_id = $_GET['grade_id'];

                        // 2. create SQL query to get the details
                        $sql = "SELECT * FROM grades WHERE grade_id=$grade_id";

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

                                $grade = $row['grade'];
                                $gr_desc = $row['grade_description'];
                                
                            }
                            else{
                                // redirect to manage admin page
                                header("Location: " .SITEURL. 'm-grades.php');
                            }
                        }
                    ?>

                    <form action="" method="POST">
                        <div class="mb-2">
                            <label for="grade" class="form-label">Grade:</label>
                            <input type="text" class="form-control" name="grade" value="<?php 
                            if(isset($row['grade'])){
                            echo $grade;}
                            else{}?>">
                        </div>
                        <div class="mb-2">
                            <label for="gr_desc" class="form-label">Description:</label>
                            <input type="text" class="form-control" name="gr_desc" value="<?php 
                            if(isset($row['grade_description'])){
                                echo $gr_desc;}
                                else{}?>">
                        </div>
                        <br>
                        <input type="hidden" name="grade_id" value="<?php echo $grade_id; ?>">
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
        $grade_id = $_POST['grade_id'];
        $grade = $_POST['grade'];
        $gr_desc = $_POST['gr_desc'];
       
        // create a SQL query to update admin
        $sql = "UPDATE grades SET
        grade = '$grade',
        grade_description = '$gr_desc'
        
        WHERE grade_id = '$grade_id'
        ";

        // execute the query
        $res = mysqli_query($cxn, $sql);

        // check whether the query executed successfully or not
        if($res == TRUE)
        {
            // query executed and query updated
            $_SESSION['update'] = "<div class='success'>Course updated successfully!</div>";
            // redirect to manage admin page
            header("Location: " .SITEURL. 'r-grades.php');
        }
        else
        {
            // failed to update admin
            $_SESSION['update'] = "<div class='error'>Update error!</div>";
            // redirect to manage admin page
            header("Location: " .SITEURL. 'r-grades.php');
        }
    }
?>

<!-- Pjesa kryesore Perditeso admin / end -->

<?php include('partials/footer.php'); ?>
<?php ob_end_flush(); ?>