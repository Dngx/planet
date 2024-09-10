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
<div class="col-4" style="padding-left: 0;">
                <!-- First filter to show data according to student name -->
                <form action="" method="POST" class="form-inline" style="padding-left: 0; padding-right:0;">
                  
                    <div class="col-8 text-start d-inline" style="padding-left: 0;">
                            <!-- <label for="student" class="form-label" style="padding-left: 0;">Filter records by student name: </label>
                            &nbsp;                    -->
                            
                            <select class="form-select w-50 d-inline" aria-label="Default select example" name="student">
                            
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
                            
                            <select class="form-select w-50 d-inline" aria-label="Default select example" name="period">
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
                            <button type="submit" class="btn btn-outline-danger" style="width: 86px;" name="filter-x" title="Extract students who didn't make payments!">Filter</button> 
                            </div>
                </form>

                            <!-- Filter to show Yearly data -->
                            <form action="" method="POST" class="form-inline" style="padding-left: 0;">
                            
                            <div class="col-8 text-start d-inline" style="padding-left: 0;">
                                    <!-- <label for="period" class="form-label" style="padding-left: 0;">Filter records by payment period: </label>
                                    &nbsp;                    -->
                          
                                        <select class="form-select w-50 d-inline" aria-label="Default select example" name="period2">
                                            <option value="" default>-- Select year --</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                        </select>
                                        </div>
                                        <div class="col-4 d-inline">&nbsp;
                                        <button type="submit" class="btn btn-primary" name="filter2-1">Filter</button>
                                        </div>
                                        <div class="col-4 d-inline">&nbsp;
                                        <!-- <a href="r-payments.php" class="btn btn-outline-primary" name="show2-1">Show all</a> -->
                                        </div>
                            </form>

                            <form action="" method="POST" class="form-inline" style="padding-left: 0;">
                  
                    <div class="col-8 text-start d-inline">
                            
                            <select class="form-select w-50 d-inline" aria-label="Default select example" name="course">
                            
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
                                            <option value="<?php echo $course; ?>"><?php echo $course; ?></option>
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
                            <div class="col-4 d-inline">&nbsp;
                            <button type="submit" class="btn btn-primary" name="filter-g">Filter</button>
                            </div>
                            </form>

</div>

<div class="col-2" style="padding-left:0; padding-right:0; margin-top: 5px;">
                            <!-- ketu eshte vendi per te vendosur divin e butonit Generate PDF-->
                            <div class="d-inline">
                                <form action="grades-report.php" method="POST" class="form-inline text-start" target="_blank">
                                <input type="hidden" 
                                    value="<?php 
                                    if(isset($_POST['student'])) 
                                        {
                                        echo $_POST['student']; 
                                        }
                                        else {
                                        }
                                    ?>" 
                                    name="student_name" class="text-end">
                                <button type="submit" class="btn btn-outline-primary" name="pdf">Generate PDF</button>
                                </form>
                            </div>
                            <div class="d-inline" style="padding-left: 0; padding-right: 0;">
                                <form action="grades-report.php" method="POST" class="form-inline text-start" target="_blank">
                                <input type="hidden" 
                                    value="<?php 
                                    if(isset($_POST['period'])) 
                                        {
                                        echo $_POST['period']; 
                                        }
                                        else {
                                        }
                                    ?>" 
                                    name="period_name" class="text-end">
                                <button type="submit" class="btn btn-outline-primary" name="pdf2">Generate PDF</button>
                                </form>
                            </div>
                            </div>

                <div class="col-6" style="margin-top: 5px;">
                    <form action="" method="POST" class="d-inline">

                    <!-- Selektori 1/3 = Selektimi i studentit -->
                    
                    
                    
                    <!-- Selektori 2/3 = Selektimi i muajit -->
                    <div class="d-inline">
                                    <!-- <label for="period" class="form-label" style="padding-left: 0;">Filter records by payment period: </label>
                                    &nbsp;                    -->
                          
                                        <select class="form-select d-inline" style="width:30%" aria-label="Default select example" name="period3">
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

                    &nbsp;&nbsp;
                    
                    <!-- Selektori 3/3 = Selektimi i vitit -->
                    <div class="d-inline">
                                    <!-- <label for="period" class="form-label" style="padding-left: 0;">Filter records by payment period: </label>
                                    &nbsp;                    -->
                          
                                        <select class="form-select d-inline" style="width:30%" aria-label="Default select example" name="period4">
                                        <option value="" default>-- Select year --</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                                
                                        </select>
                    </div>
                                       
                                        <br>
                    <!-- Butoni Filter 3-->
                            
                    <!-- Butoni Filter 4-->
                            <div class="d-inline">
                            <button type="submit" style="width:30%" class="btn btn-outline-success" name="filter4">Filter by M & Y</button>
                            </div>
                            &nbsp;&nbsp;

                </form>
                <!-- Butoni Generate 3 -->
                <form action="payments-report.php" method="POST" class="d-inline" target="_blank">
                    <input type="hidden" 
                        value="<?php 
                            if(isset($_POST['student3'])) 
                                {
                                echo $_POST['student3'];
                                }
                                else {
                                    echo $_POST['student3'];
                                }
                                ?>" 
                        name="student_name3" class="text-end">
                    <input type="hidden" 
                        value="<?php 
                            if(isset($_POST['period3'])) 
                                {
                                echo $_POST['period3'];
                                }
                                else {
                                    echo $_POST['period3'];
                                }
                                ?>" 
                        name="period_month3" class="text-end">
                        <input type="hidden" 
                        value="<?php 
                            if(isset($_POST['period4'])) 
                                {
                                echo $_POST['period4'];
                                }
                                else {
                                    echo $_POST['period4'];
                                }
                                ?>" 
                        name="period_year4" class="text-end">
                <button type="submit" style="width:30%" class="btn btn-outline-success" name="pdf3">Generate PDF</button>
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
        elseif(isset($_POST['filter-x'])){
            //echo "filter-x button clicked.";
          
            //use following code to filter data by the selected period
            $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, p.payment_id, p.payenrollment_id, p.amount, p.payment_date FROM students s 
            LEFT JOIN enrollments e
            ON s.student_id = e.enstudent_id
            LEFT JOIN courses c
            ON e.encourse_id = c.course_id
            LEFT JOIN payments p
            ON e.enrollment_id = p.payenrollment_id
            WHERE p.amount IS NULL
            -- GROUP BY p.payment_date
            ";    
            }
            elseif(isset($_POST['filter-g'])){
                //echo "filter-group button clicked.";
                $course_n = $_POST['course'];
                echo "<div class='success'>Selected course name: " .$course_n. "</div><br>";
          
                //use following code to filter data by the selected period
                $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, e.enrollment_date, e.enrollment_id, p.payment_id, p.payenrollment_id  FROM students s 
                    LEFT JOIN enrollments e
                    ON s.student_id = e.enstudent_id
                    LEFT JOIN courses c
                    ON e.encourse_id = c.course_id
                    LEFT JOIN payments p
                    ON e.enrollment_id = p.payenrollment_id
                    WHERE c.course_name = '".$course_n."'
                    GROUP BY CONCAT(s.first_name, s.last_name)
                ";    
                }

        // third conditional to filter data by period/year
        elseif(isset($_POST['filter2-1'])){
            //echo "filter2-1 button clicked.";

            $period_y = $_POST['period2'];
                if($period_y < 1) {
                    echo "<div class='error'>You didn't select any period!</div>";
                }else {

            echo "<div class='success'>Selected year: " .$period_y. "</div><br>";
        
            //use following code to filter data by the selected period
            $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, p.payment_id, p.payenrollment_id, p.amount, p.payment_date FROM students s 
            LEFT JOIN enrollments e
            ON s.student_id = e.enstudent_id
            LEFT JOIN courses c
            ON e.encourse_id = c.course_id
            LEFT JOIN payments p
            ON e.enrollment_id = p.payenrollment_id
            WHERE YEAR(p.payment_date) = '".$period_y."'
            -- GROUP BY p.payment_date
            ";    
            }
            }
            elseif(isset($_POST['filter4'])){
                //echo "button Filter 4 clicked. Filter with Month AND Year.";
                $period_m3 = $_POST['period3'];
                $period_y4 = $_POST['period4'];
                echo "<div class='success'>Selected month: " .$period_m3. " | Selected year: " .$period_y4. "</div><br>";
        
                $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, p.payment_id, p.payenrollment_id, p.amount, p.payment_date FROM students s 
                LEFT JOIN enrollments e
                ON s.student_id = e.enstudent_id
                LEFT JOIN courses c
                ON e.encourse_id = c.course_id
                LEFT JOIN payments p
                ON e.enrollment_id = p.payenrollment_id
                WHERE MONTH(p.payment_date) = '".$period_m3."' AND YEAR(p.payment_date) = '".$period_y4."'
                -- GROUP BY s.first_name
                ";
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
        // kjo pjese eshte brenda kushtit while

        $shuma = $shuma + $amount;
        $dec_shuma = number_format($shuma, 2, '.', '');
        
    }
    
    mysqli_close($cxn);
?>

</table>
    <?php 
        // kjo pjese eshte jashta kushtit while
        echo "Total payment: " .$dec_shuma. " €";
    ?>

    
</div>


<?php include('partials/footer.php'); ?>
<?php ob_end_flush(); ?>