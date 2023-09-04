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
<p><h1 class="p-1 text-start" style="color: #3f51b5;">Add expense</h1></p><hr>
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
                            <label for="exp_desc" class="form-label">Expense description:</label>
                            <input type="text" class="form-control" name="exp_desc" placeholder="Give expense a description...">
                        </div>
                        <div class="mb-2">
                            <label for="eamount" class="form-label">Expense amount:</label>
                            <input type="number" class="form-control" name="eamount" step=".01" placeholder="What's the amount of expense?">
                        </div>
                        <div class="mb-2">
                            <label for="edate" class="form-label">Expense date:</label>
                            <input type="date" class="form-control" name="edate" placeholder="When did you make the expense?">
                        </div>
                        <br>
                        <input type="submit" name="submit" value="Add" class="btn btn-primary">
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

        $exp_desc = $_POST['exp_desc'];
        $eamount = $_POST['eamount'];
        $edate = $_POST['edate'];
        //$fjalekalimi = md5($_POST['fjalekalimi']); // Password encryption with md5 ! cannot be decrypted.
            // use the above code line to include passwords!

        // 2. SQL query to save the data into database

        $sql = "INSERT INTO expenses SET 
            expense_description  = '$exp_desc',
            amount  = '$eamount',
            expense_date = '$edate'
        ";

        // 3. Executing query and saving data into database
        $res = mysqli_query($cxn, $sql) or die(mysqli_error());


        //4. Check whether the (query is executed) data is inserted or not and display appropriate message
        if($res == TRUE){
            // Data inserted
            //echo "Data inserted.";
            // create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Expense added!</div>";
            // redirect page to manage admin
            header("Location:" .SITEURL. 'm-expenses.php');
        }
        else{
            // failed to insert data
            //echo "Failed to insert data!";
            // create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Error adding expense!</div>";
            // redirect page to add admin
            header("Location:" .SITEURL. 'add-expense.php');
            }
    }
    

?>

<?php include('partials/footer.php'); ?>
<?php ob_end_flush(); ?>