<?php ob_start(); ?>
<?php include('partials/menu.php'); 
//error_reporting('E_ALL & ~E_NOTICE'); 
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
    <div class="col-md-8" style="padding-left: 0;">
        <h1 class="p-1 text-start" style="color: #3f51b5;">Student - Grading Records</h1>
    </div>
    <div class="col-md-4" style="padding-right: 0;">
        <div class="text-end"><a href="m-grades.php" class="btn btn-secondary btn-sm"><img src="img/icon-back.svg" height="30" width="30"></a></div>
    </div>       
<hr>

<div class="row mb-auto" style="margin: auto;">
            <div class="col-4" style="padding-left: 0;">
                  <form action="" method="POST" class="form-inline" style="padding-left: 0; padding-right:0;">
                  
                    <div class="col-8 text-start d-inline" style="padding-left: 0;">                
                            <select class="form-select w-50 d-inline" aria-label="Default select example" name="student">
                            
                                <?php
                                    // create php code to display categories from database
                                    // 1. create sql to get all active categories from database
                                    $sql = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, g.grade_id, g.grenrollment_id, g.grade, g.grade_description, g.grade_date FROM students s 
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
                            <a href="r-grades.php" class="btn btn-outline-primary" name="show">Show all</a>
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
                                        <a href="r-grades.php" class="btn btn-outline-primary" name="show2">Show all</a>
                                        </div>
                            </form>

                            <!-- Filter to show Yearly data -->
                            <form action="" method="POST" class="form-inline" style="padding-left: 0;">
                            
                            <div class="col-8 text-start d-inline" style="padding-left: 0;">
                                    <!-- <label for="period" class="form-label" style="padding-left: 0;">Filter records by payment period: </label>
                                    &nbsp;                    -->
                          
                                        <select class="form-select w-50 d-inline" aria-label="Default select example" name="period2-1">
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
                                        <a href="r-grades.php" class="btn btn-outline-primary" name="show2-1">Show all</a>
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
                    <form action="" method="POST" class="d-inline" >

                    <!-- Selektori 1/3 = Selektimi i studentit -->
                    <div class="d-inline">                
                            <select class="form-select d-inline" style="width:30%; margin-bottom: 15px" aria-label="Default select example" name="student3">
                            
                                <?php
                                    // create php code to display categories from database
                                    // 1. create sql to get all active categories from database
                                    $sql = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, g.grade_id, g.grenrollment_id, g.grade, g.grade_description, g.grade_date FROM students s 
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
                    &nbsp;&nbsp;
                    
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
                                       
                    <!-- Butoni Filter 4-->
                            <div class="d-inline">
                            <button type="submit" style="width:30%" class="btn btn-outline-success" name="filter4">Filter M & Y</button>
                            </div>
                            &nbsp;&nbsp;         
                    <!-- Butoni Filter 3/1 -->
                            <div class="d-inline">
                            <button type="submit" style="width:30%" class="btn btn-outline-success" name="filter3">Filter-M</button>
                            </div>
                            &nbsp;&nbsp;
                    <!-- Butoni Filter 3/2 -->
                            <div class="d-inline">
                            <button type="submit" style="width:30%" class="btn btn-outline-success" name="filter3-2">Filter-Y</button>
                            </div>
                            &nbsp;&nbsp;
                    

                </form>
                
                <!-- Butoni Generate 3 -->
                <form action="grades-report.php" method="POST" class="d-inline" target="_blank">
                    <input type="hidden" 
                        value="<?php 
                            if(isset($_POST['student3'])) 
                                {
                                echo $_POST['student3'];
                                }
                                else {
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
                                }
                                ?>" 
                        name="period4" class="text-end">
                <button type="submit" style="width:30%" class="btn btn-outline-success" name="pdf3">Generate PDF</button>
                </form>           

            </div>
                            
                        </div>


<?php
    if(isset($_SESSION['add'])) // checking whether the session is set or not
    {
        echo $_SESSION['add']; // displaying  the session message if set
        unset($_SESSION['add']); // remove session message
    } 

    if(isset($_SESSION['error']))
    {
        echo $_SESSION['error']; // displaying session message
        unset($_SESSION['error']); // removing session message
    }

    if(isset($_SESSION['delete']))
    {
        echo $_SESSION['delete']; // displaying session message
        unset($_SESSION['delete']); // removing session message
    }
?>
</div>

<div class="container" style="width:83%; margin: auto;">

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Student</th>
      <th scope="col">Grade</th>
      <th scope="col">Description</th>
      <th scope="col">Grading date</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>

<?php 

    // the following code executes filtering data with 3 dropdown buttons

    if(isset($_POST['filter'])){
        //echo "filter button clicked.";
        $student_n = $_POST['student'];
        echo "<div class='success'>Selected student name: " .$student_n. "</div><br>";

    // include('db_connection.php');
    //use following code to filter data by the selected student
    $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, g.grade_id, g.grenrollment_id, g.grade, g.grade_description, g.grade_date FROM students s 
        LEFT JOIN enrollments e
        ON s.student_id = e.enstudent_id
        LEFT JOIN courses c
        ON e.encourse_id = c.course_id
        LEFT JOIN grades g
        ON e.enrollment_id = g.grenrollment_id
        WHERE CONCAT(s.first_name, ' ' , s.last_name) = '".$student_n."'
        -- GROUP BY s.first_name
        ";
    } 
    // second conditional to filter data by period/month/year
    elseif(isset($_POST['filter2'])){
        //echo "filter2 button clicked.";

        $period_m = $_POST['period'];
            if($period_m < 1) {
                echo "<div class='error'>You didn't select any period!</div>";
            }else {

        echo "<div class='success'>Selected month: " .$period_m. "</div><br>";
    
        //use following code to filter data by the selected period
        $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, g.grade_id, g.grenrollment_id, g.grade, g.grade_description, g.grade_date FROM students s 
        LEFT JOIN enrollments e
        ON s.student_id = e.enstudent_id
        LEFT JOIN courses c
        ON e.encourse_id = c.course_id
        LEFT JOIN grades g
        ON e.enrollment_id = g.grenrollment_id
        WHERE MONTH(g.grade_date) = '".$period_m."'
        -- GROUP BY g.grade_date
        ";    
        }
        }
            // second conditional to filter data by period/year
            elseif(isset($_POST['filter2-1'])){
            //echo "filter2-1 button clicked.";

            $period_y = $_POST['period2-1'];
                if($period_y < 1) {
                    echo "<div class='error'>You didn't select any period!</div>";
                }else {

            echo "<div class='success'>Selected year: " .$period_y. "</div><br>";
        
            //use following code to filter data by the selected period
            $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, g.grade_id, g.grenrollment_id, g.grade, g.grade_description, g.grade_date FROM students s 
            LEFT JOIN enrollments e
            ON s.student_id = e.enstudent_id
            LEFT JOIN courses c
            ON e.encourse_id = c.course_id
            LEFT JOIN grades g
            ON e.enrollment_id = g.grenrollment_id
            WHERE YEAR(g.grade_date) = '".$period_y."'
            -- GROUP BY g.grade_date
            ";    
            }
            }
                elseif(isset($_POST['filter3'])){
                    // filter for Name and Month.

                    //echo "button Filter 3 clicked.";
                    $student_n3 = $_POST['student3'];
                    $period_m3 = $_POST['period3'];
                    echo "<div class='success'>Selected student: " .$student_n3. " | Selected month: " .$period_m3. " </div><br>";
            
                    $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, g.grade_id, g.grenrollment_id, g.grade, g.grade_description, g.grade_date FROM students s 
                    LEFT JOIN enrollments e
                    ON s.student_id = e.enstudent_id
                    LEFT JOIN courses c
                    ON e.encourse_id = c.course_id
                    LEFT JOIN grades g
                    ON e.enrollment_id = g.grenrollment_id
                    WHERE CONCAT(s.first_name, ' ' , s.last_name) = '".$student_n3."' AND MONTH(g.grade_date) = '".$period_m3."'
                    -- GROUP BY s.first_name
                    ";
                    
                }
                    elseif(isset($_POST['filter3-2'])){
                        // filter for Name and Year.

                        //echo "button Filter 3-2 clicked.";
                        $student_n3 = $_POST['student3'];
                        $period_y4 = $_POST['period4'];
                        echo "<div class='success'>Selected student: " .$student_n3. " | Selected month: " .$period_y4. " </div><br>";
                
                        $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, g.grade_id, g.grenrollment_id, g.grade, g.grade_description, g.grade_date FROM students s 
                        LEFT JOIN enrollments e
                        ON s.student_id = e.enstudent_id
                        LEFT JOIN courses c
                        ON e.encourse_id = c.course_id
                        LEFT JOIN grades g
                        ON e.enrollment_id = g.grenrollment_id
                        WHERE CONCAT(s.first_name, ' ' , s.last_name) = '".$student_n3."' AND YEAR(g.grade_date) = '".$period_y4."'
                        -- GROUP BY s.first_name
                        ";
                    
                }
                        elseif(isset($_POST['filter4'])){
                        // filter for Name, Month and Year.

                        //echo "button Filter 3 clicked.";
                        $student_n3 = $_POST['student3'];
                        $period_m3 = $_POST['period3'];
                        $period_y4 = $_POST['period4'];
                        echo "<div class='success'>Selected student: " .$student_n3. " | Selected month: " .$period_m3. " | Selected year: " .$period_y4. "</div><br>";
                
                        $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, g.grade_id, g.grenrollment_id, g.grade, g.grade_description, g.grade_date FROM students s 
                        LEFT JOIN enrollments e
                        ON s.student_id = e.enstudent_id
                        LEFT JOIN courses c
                        ON e.encourse_id = c.course_id
                        LEFT JOIN grades g
                        ON e.enrollment_id = g.grenrollment_id
                        WHERE CONCAT(s.first_name, ' ' , s.last_name) = '".$student_n3."' AND MONTH(g.grade_date) = '".$period_m3."' AND YEAR(g.grade_date) = '".$period_y4."'
                        -- GROUP BY s.first_name
                        ";
                        }
        else{
        echo "<div class='error'>Showing all the existing students in database. You didn't select any student!</div> <br>";

    //use following code for else case - to show all the existing data in the grades table
    $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, g.grade_id, g.grenrollment_id, g.grade, g.grade_description, g.grade_date FROM students s 
    LEFT JOIN enrollments e
    ON s.student_id = e.enstudent_id
    LEFT JOIN courses c
    ON e.encourse_id = c.course_id
    LEFT JOIN grades g
    ON e.enrollment_id = g.grenrollment_id
    ORDER BY s.first_name
    ";
    }

    

    $result = mysqli_query($cxn, $query);

    $sn = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $cname = $row['course_name'];
        $gr_id = $row['grade_id'];
        $gren_id = $row['grenrollment_id'];
        $grade = $row['grade'];
        $gr_desc = $row['grade_description'];
        $gr_date = $row['grade_date'];
        //echo $row['attendance_id'] . " | " . $row['attenrollment_id'] . " | " . $row['attendance_date'] . " | " . $row['status'] . "<br>";

    ?>

    <tr>
    <th scope="row"><?php echo $sn++?></th>
            <td>
                <?php echo $fname.' '.$lname; ?>
            </td>
            <td>
                <?php echo $grade; ?>
            </td>
            <td>
                <?php echo $gr_desc; ?>
            </td>
            <td>
                <?php echo $gr_date; ?>
            </td>
            <td>
            <a href="<?php echo SITEURL; ?>u-grade.php?grade_id=<?php echo $gr_id; ?>"><img src="img/icon-update.png" alt="Update grade"></a>
            <a href="<?php echo SITEURL; ?>d-grade.php?grade_id=<?php echo $gr_id; ?>"><img src="img/icon-delete.png" alt="Delete grade"></a>
            </td>
    </tr>
    <?php

        
    }
    
    mysqli_close($cxn);
?>

</table>

<!-- <div class="col-4 d-inline">
    <form action="grades-report.php" method="POST" class="form-inline" style="padding-left: 0;">
    <input type="hidden" value="<?php //echo $student_n; ?>">
    <button type="submit" class="btn btn-outline-success" name="pdf">Generate PDF</button>
    </form>
</div> -->
    
</div>


<?php include('partials/footer.php'); ?>
<?php ob_end_flush(); ?>