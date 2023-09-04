<?php ob_start(); ?>
<?php include('partials/menu.php'); ?>

<br><br>
<!-- Pjesa kryesore Perditeso admin / start -->
<div class="row text-center p-4 mb-auto" style="width:85%; margin: auto;">
<p><h1 class="p-1 text-start" style="color: #3f51b5;">Update expense</h1></p><hr>
</div>

<div class="row text-start p-0 mb-auto" style="width:30%; margin: auto;">
            <div class="container ">
                    
                    <?php 
                        // 1. Get the ID of selected Admin
                        $expense_id = $_GET['expense_id'];

                        // 2. create SQL query to get the details
                        $sql = "SELECT * FROM expenses WHERE expense_id=$expense_id";

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

                                $expense_description = $row['expense_description'];
                                $amount = $row['amount'];
                                $expense_date = $row['expense_date'];
                            }
                            else{
                                // redirect to manage admin page
                                header("Location: " .SITEURL. 'm-expenses.php');
                            }
                        }
                    ?>

                    <form action="" method="POST">
                        <div class="mb-2">
                            <label for="expense_description" class="form-label">Expense description:</label>
                            <input type="text" class="form-control" name="expense_description" value="<?php echo $expense_description;?>">
                        </div>
                        <div class="mb-2">
                            <label for="amount" class="form-label">Expense amount:</label>
                            <input type="number" step=".01" class="form-control" name="amount" value="<?php echo $amount; ?>">
                        </div>
                        <div class="mb-2">
                            <label for="expense_date" class="form-label">Expense date:</label>
                            <input type="date" class="form-control" name="expense_date" value="<?php echo $expense_date;?>">
                        </div>
                        <br>
                        <input type="hidden" name="expense_id" value="<?php echo $expense_id; ?>">
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
        $expense_id = $_POST['expense_id'];
        $expense_description = $_POST['expense_description'];
        $amount = $_POST['amount'];
        $expense_date = $_POST['expense_date'];

        // create a SQL query to update admin
        $sql = "UPDATE expenses SET
        expense_description = '$expense_description',
        amount = '$amount',
        expense_date = '$expense_date'

        WHERE expense_id = '$expense_id'
        ";

        // execute the query
        $res = mysqli_query($cxn, $sql);

        // check whether the query executed successfully or not
        if($res == TRUE)
        {
            // query executed and query updated
            $_SESSION['update'] = "<div class='success'>Expense updated successfully!</div>";
            // redirect to manage admin page
            header("Location: " .SITEURL. 'm-expenses.php');
        }
        else
        {
            // failed to update admin
            $_SESSION['update'] = "<div class='error'>Update error!</div>";
            // redirect to manage admin page
            header("Location: " .SITEURL. 'm-expenses.php');
        }
    }
?>

<!-- Pjesa kryesore Perditeso admin / end -->

<?php include('partials/footer.php'); ?>
<?php ob_end_flush(); ?>