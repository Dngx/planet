<?php ob_start(); ?>
<?php include('partials/menu.php'); ?>

<br><br>
<!-- Pjesa kryesore Perditeso admin / start -->
<div class="row text-center p-4 mb-auto" style="width:85%; margin: auto;">
<p><h1 class="p-1 text-start" style="color: #3f51b5;">Update payment</h1></p><hr>
</div>

<div class="row text-start p-0 mb-auto" style="width:30%; margin: auto;">
            <div class="container ">
                    
                    <?php 
                        // 1. Get the ID of selected Admin
                        $payment_id = $_GET['payment_id'];

                        // 2. create SQL query to get the details
                        $sql = "SELECT * FROM payments WHERE payment_id=$payment_id";

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

                                $amount = $row['amount'];
                                $pay_date = $row['payment_date'];
                                
                            }
                            else{
                                // redirect to manage admin page
                                header("Location: " .SITEURL. 'm-grades.php');
                            }
                        }
                    ?>

                    <form action="" method="POST">
                        <div class="mb-2">
                            <label for="amount" class="form-label">Amount:</label>
                            <input type="number" class="form-control" name="amount" value="<?php echo $amount;?>">
                        </div>
                        <div class="mb-2">
                            <label for="pay_date" class="form-label">Payment date:</label>
                            <input type="date" class="form-control" name="pay_date" value="<?php echo $pay_date; ?>">
                        </div>
                        <br>
                        <input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>">
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
        $payment_id = $_POST['payment_id'];
        $amount = $_POST['amount'];
        $pay_date = $_POST['pay_date'];
       
        // create a SQL query to update admin
        $sql = "UPDATE payments SET
        amount = '$amount',
        payment_date = '$pay_date'
        
        WHERE payment_id = '$payment_id'
        ";

        // execute the query
        $res = mysqli_query($cxn, $sql);

        // check whether the query executed successfully or not
        if($res == TRUE)
        {
            // query executed and query updated
            $_SESSION['update'] = "<div class='success'>Course updated successfully!</div>";
            // redirect to manage admin page
            header("Location: " .SITEURL. 'r-payments.php');
        }
        else
        {
            // failed to update admin
            $_SESSION['update'] = "<div class='error'>Update error!</div>";
            // redirect to manage admin page
            header("Location: " .SITEURL. 'r-payments.php');
        }
    }
?>

<!-- Pjesa kryesore Perditeso admin / end -->

<?php include('partials/footer.php'); ?>
<?php ob_end_flush(); ?>