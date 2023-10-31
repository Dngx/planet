<?php ob_start(); ?>
<?php include('partials/menu.php'); ?>
<?php 
// Turn off all error reporting
error_reporting(0); 
?>


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
        <h1 class="p-1 text-start" style="color: #3f51b5;">Student - Payment Records</h1>
    </div>
    <div class="col-md-4">
        <div class="text-end"><a href="m-payments.php" class="btn btn-secondary btn-sm"><img src="img/icon-back.svg" height="30" width="30"></a></div>
    </div>       
<hr>

<!-- Filter part -->
<div class="row mb-auto" style="margin: auto;">
<div class="col-12 text-start" style="padding-left: 0;">
                <!-- First filter to show data according to student name -->
                <form action="" method="POST" class="form-inline" style="padding-left: 0;">
                  
                    <div class="col-8 text-start d-inline" style="padding-left: 0;">
                            <!-- <label for="student" class="form-label" style="padding-left: 0;">Filter records by student name: </label>
                            &nbsp;                    -->
                            
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
                            <a href="r-payments.php" class="btn btn-outline-primary" name="show">Show all</a>
                            </div>
                </form>

                <!-- Second filter to show monthly data -->
                <form action="" method="POST" class="form-inline" style="padding-left: 0;">
                  
                    <div class="col-8 text-start d-inline" style="padding-left: 0;">
                            <!-- <label for="period" class="form-label" style="padding-left: 0;">Filter records by payment period: </label>
                            &nbsp;                    -->
                            
                            <select class="form-select w-25 d-inline" aria-label="Default select example" name="period">
                                <option value="" default>-- Select month --</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>     
                            </select>
                            </div>
                            <div class="col-4 d-inline">&nbsp;
                            <button type="submit" class="btn btn-primary" name="filter2">Filter</button>
                            </div>
                            <div class="col-4 d-inline">&nbsp;
                            <a href="r-payments.php" class="btn btn-outline-primary" name="show">Show all</a>
                            </div>
                </form>
                            </div>
</div>
<!-- Filter part end -->

<?php
    if(isset($_SESSION['add'])) // checking whether the session is set or not
    {
        echo $_SESSION['add']; // displaying  the session message if set
        unset($_SESSION['add']); // remove session message
    } 
    if(isset($_SESSION['delete'])) 
    {
        echo $_SESSION['delete']; 
        unset($_SESSION['delete']); 
    } 
?>

</div>



<div class="container" style="width:83%; margin: auto;">

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Student</th>
      <th scope="col">Amount</th>
      <th scope="col">Payment date</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>

<?php
    // first conditional to filter by student name

    if(isset($_POST['filter'])){
        //echo "filter button clicked.";

        $student_n = $_POST['student'];
        echo "<div class='success'>Selected student name: " .$student_n. "</div><br>";
    
        //use following code to filter data by the selected student
        $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, p.payment_id, p.payenrollment_id, p.amount, p.payment_date FROM students s 
        LEFT JOIN enrollments e
        ON s.student_id = e.enstudent_id
        LEFT JOIN courses c
        ON e.encourse_id = c.course_id
        LEFT JOIN payments p
        ON e.enrollment_id = p.payenrollment_id
        WHERE CONCAT(s.first_name, ' ' , s.last_name) = '".$student_n."'
        -- GROUP BY s.first_name
        ";
        } 

        // second conditional to filter data by period/month
        elseif(isset($_POST['filter2'])){
        //echo "filter2 button clicked.";

        $period_m = $_POST['period'];
            if($period_m < 1) {
                echo "<div class='error'>You didn't select any period!</div>";
            }else {

        echo "<div class='success'>Selected month: " .$period_m. "</div><br>";
    
        //use following code to filter data by the selected period
        $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, p.payment_id, p.payenrollment_id, p.amount, p.payment_date FROM students s 
        LEFT JOIN enrollments e
        ON s.student_id = e.enstudent_id
        LEFT JOIN courses c
        ON e.encourse_id = c.course_id
        LEFT JOIN payments p
        ON e.enrollment_id = p.payenrollment_id
        WHERE MONTH(p.payment_date) = '".$period_m."'
        -- GROUP BY p.payment_date
        ";    
        }
        }
        else{
        echo "<div class='error'>Showing all the existing students in database. You didn't select any filter type!</div> <br>";

    //use following code for else case - to show all the existing data in the grades table
    $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, p.payment_id, p.payenrollment_id, p.amount, p.payment_date FROM students s 
    LEFT JOIN enrollments e
    ON s.student_id = e.enstudent_id
    LEFT JOIN courses c
    ON e.encourse_id = c.course_id
    LEFT JOIN payments p
    ON e.enrollment_id = p.payenrollment_id
    -- GROUP BY s.first_name
    ";
    }

    

    $result = mysqli_query($cxn, $query);

    $sn = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $cname = $row['course_name'];
        $pay_id = $row['payment_id'];
        $payen_id = $row['payenrollment_id'];
        $amount = $row['amount'];
        $pay_date = $row['payment_date'];
        //echo $row['attendance_id'] . " | " . $row['attenrollment_id'] . " | " . $row['attendance_date'] . " | " . $row['status'] . "<br>";
    
    ?>

    <tr>
    <th scope="row"><?php echo $sn++?></th>
            <td>
                <?php echo $fname.' '.$lname; ?>
            </td>
            <td>
                <?php echo $amount; ?>
            </td>
            <td>
                <?php echo $pay_date; ?>
            </td>
            <td>
            <a href="<?php echo SITEURL; ?>u-payment.php?payment_id=<?php echo $pay_id; ?>"><img src="img/icon-update.png" alt="Update Payment"></a>
            <a href="<?php echo SITEURL; ?>d-payment.php?payment_id=<?php echo $pay_id; ?>"><img src="img/icon-delete.png" alt="Delete Payment"></a>
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