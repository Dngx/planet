<?php include('partials/menu.php'); ?>


<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">

  <!-- css code to clearfix -->
  <style>
            body {
                overflow-x:hidden;
            }
  </style>

    <title>Planet English * Manage attendances</title>
  </head>
  <body>
    
    <div class="container-fluid">
        

        <!-- Permbajtja start -->
        <div class="row text-start p-4 mb-auto" style="width:90%; margin: auto;">
            <div class="container ">
               
                <br><br><br>
                <div class="row mb-auto" style="margin: auto;">
                <div class="col-md-8">
                  <h1 class="text-start" style="color: #3f51b5;">Manage attendances</h1>
                </div>
                <div class="col-md-4">
                <div class="text-end"><a href="r-attendances.php" class="btn btn-primary btn-sm"><img src="img/icon-records.svg" height="30" width="30"> Attendance records</a></div>
                </div>
                </div>
                <hr>

                
                <div class="mb-2">
                  <form action="" method="POST" class="form-inline">
                  <div class="form-row align-items-center">
                    <div class="col-sm-3">
                            <label for="course" class="form-label">Filter records by course name:</label>
                            </div>
                  
                            <div class="col-auto">
                            <select class="form-select w-25" aria-label="Default select example" name="course">
                            
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
                            <div class="col-auto">
                            <button type="submit" class="btn btn-primary btn-sm mb-2" name="filter">Filter</button>
                            </div>
                            </form>
                        </div>
                

                <?php 
                  if(isset($_SESSION['add']))
                  {
                      echo $_SESSION['add']; // displaying session message
                      unset($_SESSION['add']); // removing session message
                  }

                  if(isset($_SESSION['delete']))
                  {
                    echo $_SESSION['delete']; // displaying session message
                    unset($_SESSION['delete']); // removing session message
                  }

                  if(isset($_SESSION['update']))
                  {
                    echo $_SESSION['update']; // displaying session message
                    unset($_SESSION['update']); // removing session message
                  }

                  if(isset($_SESSION['perdorues-jo']))
                  {
                    echo $_SESSION['perdorues-jo']; // displaying session message
                    unset($_SESSION['perdorues-jo']); // removing session message
                  }

                  if(isset($_SESSION['fjalekalimi-nuk-perputhet']))
                  {
                    echo $_SESSION['fjalekalimi-nuk-perputhet']; // displaying session message
                    unset($_SESSION['fjalekalimi-nuk-perputhet']); // removing session message
                  }

                  if(isset($_SESSION['fjalekalimi-nderrohet']))
                  {
                    echo $_SESSION['fjalekalimi-nderrohet']; // displaying session message
                    unset($_SESSION['fjalekalimi-nderrohet']); // removing session message
                  }

                  if(isset($_SESSION['fjalekalimi-nuk-nderrohet']))
                  {
                    echo $_SESSION['fjalekalimi-nuk-nderrohet']; // displaying session message
                    unset($_SESSION['fjalekalimi-nuk-nderrohet']); // removing session message
                  }
                ?>
                <!-- butoni per shtimin e adminit -->
                    
                    
                <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Student</th>
      <th scope="col">Course</th>
      <th scope="col">Attendance date</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>

  <?php
    // query to get all admin
    // $sql = "SELECT students.first_name, students.last_name, enrollments.enrollment_date 
    //         FROM enrollments 
    //         INNER JOIN students 
    //         ON enrollments.enstudent_id = students.student_id
    //         UNION ALL
    //         SELECT courses.course_name, courses.instructor, enrollments.enrollment_date
    //         FROM courses
    //         INNER JOIN enrollments 
    //         ON courses.course_id = enrollments.encourse_id
    //         ";
    // Above SQL query code has to be reviewed!
    if(isset($_POST['filter'])){
      //echo "filter button clicked.";
      $course_n = $_POST['course'];
      echo "Selected course name: " .$course_n. "<br>";

      $sql = "
          SELECT DISTINCT s.first_name, s.last_name, c.course_name, e.enrollment_date, e.enrollment_id, a.attendance_id, a.attenrollment_id  FROM students s 
          LEFT JOIN enrollments e
          ON s.student_id = e.enstudent_id
          LEFT JOIN courses c
          ON e.encourse_id = c.course_id
          LEFT JOIN attendances a
          ON e.enrollment_id = a.attenrollment_id
          WHERE c.course_name = '".$course_n."'
          GROUP BY s.first_name
    ";
    } else{
      echo "You didn't select any course group! <br>";
    $sql = "
          SELECT DISTINCT s.first_name, s.last_name, c.course_name, e.enrollment_date, e.enrollment_id, a.attendance_id, a.attenrollment_id  FROM students s 
          LEFT JOIN enrollments e
          ON s.student_id = e.enstudent_id
          LEFT JOIN courses c
          ON e.encourse_id = c.course_id
          LEFT JOIN attendances a
          ON e.enrollment_id = a.attenrollment_id
          GROUP BY s.first_name
    ";
  }

    // execute the query
    $res = mysqli_query($cxn, $sql);

    //check whether the query is executed or not
    if ($res == TRUE)
    {
      // count rows to check whether we have data in database or not
      $count = mysqli_num_rows($res); // function to get all the rows in database

      $sn = 1; //create a variable and assign the value

      // check the num of rows
      if($count > 0){
        // we have data in database
        while($rows = mysqli_fetch_assoc($res))
        {
          // using while loop to get all the data from database
          // and while loop will run as long as we have data in databse
          
          //get individual data
          $attendance_id = $rows['attendance_id'];
          $attenrollment_id = $rows['attenrollment_id'];
          $enrollment_id = $rows['enrollment_id'];
          $firstname = $rows['first_name'];
          $lastname = $rows['last_name'];
          $cname = $rows['course_name'];
          $attendance_date = isset($rows['attendance_date']);
          $status = isset($rows['status']);
          

          // display the values in our table
          ?>
        
          <tr>
            <th scope="row"><?php echo $sn++?></th>
            <td>
            
            <!-- Getting input values from form -->
            <form action="" method="POST" enctype="multipart/form-data">
              <?php echo $firstname.' '.$lastname;?>
              <input type="hidden" name="attenrollment_id[]" value="<?php echo $enrollment_id; ?>">
            </td>
            <td>
              <?php 
              if(!$cname){
                echo "<div class='error'>Student is not assigned to any course! Use 'Add enrollment' button!</div>";
              }else {echo $cname;}
              ?>
            </td>
            <td>
              
                    
                    <input type="date" class="form-control" name="attendance_date[]" value="">
            </td>
            <td>

                <select name="status[]" id="" class="form-control">
                  <option selected value="Present">Present</option>
                  <option value="Absent">Absent</option>
                  <option value="Tardy">Tardy</option>
                </select>
              
            </td>
            <td>
              <!-- Use this line if needed for data update: <a href="<?php //echo SITEURL; ?>admin/perditeso-psw.php?course$course_id=<?php //echo $course_id; ?>"><img src="../img/icon-chpsw.png" alt="Perditeso fjalekalimin"></a> -->
              <!-- <input type="hidden" name="attendance_id" value="<?php //echo $attendance_id; ?>"> -->
              
              <!--  vendos butonin e meposhtem per te paraqitur per secilin record 
                <input type="submit" name="submit" value="submit"></input>-->

              <!-- <input type="submit" name="submit" value="Enroll" class="btn btn-primary"> -->
            
              <!-- This code has been cut from the a submit button above
              href="<?php //echo SITEURL; ?>s-attendance.php?attendance_id=<?php //echo $attendance_id; ?>" -->
            <!-- End of input values taken by form -->
            
            <!-- ky rresht eshte anulur per shkaqe te testimit </form> -->

              
              


              <!-- <a href="<?php //echo SITEURL; ?>u-enrollment.php?enrollment_id=<?php //echo $enrollment_id; ?>"><img src="img/icon-update.png" alt="Update enrollment info"></a> -->
              
            </td>
            
          </tr>
          
        <?php

        }
      }
      else {
        // we do not have data in databse
      }
      
    }
    
  ?>

</table>


  <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm justify-content-center"></input>
</form>

<?php 
    // Process the value from form and save it in database
    // Check whether the submit button is clicked or not

    if (isset($_POST['submit']))
    {
        // BUtton clicked 
        //echo "Clicked";

        // the legacy part of the code
        // // 1. Get the data from form

        // $attenrollment_id = 1;//$_POST['attenrollment_id'];
        // $attendance_date = //$_POST['attendance_date'];
        // $status = //$_POST['status'];

        // // 2. SQL query to save the data into database

        // $sql = "INSERT INTO attendances 
        //         (attenrollment_id, attendance_date, status) 
        //         VALUES 
        //         ('$attenrollment_id', '$attendance_date', '$status')";
                
        // //$fjalekalimi = md5($_POST['fjalekalimi']); // Password encryption with md5 ! cannot be decrypted.
        //     // use the above code line to include passwords!

        // // 2. SQL query to save the data into database

        // // $sql = "INSERT INTO attendances SET 
        // //     attenrollment_id  = '$enrollment',
        // //     attendance_date  = '$attendance',
        // //     status = '$status'
        // // ";
      
    $attenrollment_ids = $_POST['attenrollment_id'];
    $attendance_dates = $_POST['attendance_date'];
    $statuses = $_POST['status'];
    
    // test code from AI
    for ($i = 0; $i < count($attenrollment_ids); $i++) {
        $data = array(
            'attenrollment_id' => $attenrollment_ids[$i],
            'attendance_date' => $attendance_dates[$i],
            'status' => $statuses[$i]
        );
        
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", $data) . "'";
        
        $query = "INSERT INTO attendances ($columns) VALUES ($values)";

        if (mysqli_query($cxn, $query)) {
            echo "<br>Attendance marked successfully!";
        } else {
            echo "<br><br>Error marking attendance: " . mysqli_error($cxn);
        }
        
    }

    // legacy code
    // $query = "
    // INSERT INTO attendances (attenrollment_id, attendance_date, status) 
    // VALUES ('$attenrollment_id', '$attendance_date', '$status')
    // WHERE attendance_id = '$attendance_id'
    // ";
    
    // if (mysqli_query($cxn, $query)) {
    //     echo "Attendance marked successfully!";
    // } else {
    //     echo "<br><br>Error marking attendance: " . mysqli_error($cxn);
    // }
    
    mysqli_close($cxn);


        // 3. Executing query and saving data into database
        // $res = mysqli_query($cxn, $sql) or die(mysqli_error());


        // //4. Check whether the (query is executed) data is inserted or not and display appropriate message
        // if($res == TRUE){
        //     // Data inserted
        //     //echo "Data inserted.";
        //     // create a session variable to display message
        //     $_SESSION['add'] = "<div class='success'>Enrollment done!</div>";
        //     // redirect page to manage admin
        //     header("Location:" .SITEURL. 'm-attendances.php');
        // }
        // else{
        //     // failed to insert data
        //     //echo "Failed to insert data!";
        //     // create a session variable to display message
        //     $_SESSION['add'] = "<div class='error'>Error on student enrollment!</div>";
        //     // redirect page to add admin
        //     header("Location:" .SITEURL. 's-attendance.php');
        //     }
    }
    

?>

<!-- Test code from AI -->


<!-- <h1>Student Attendance Tracking</h1> -->
    
    <!-- <form action="mark_attendance.php" method="post">
        Enrollment ID: <input type="text" name="attenrollment_id" value="" required><br>

        Date: <input type="date" name="attendance_date" value="" required><br>

        Status: <label for="endate" class="form-label"></label>
                <select name="" id="" class="form-control w-25">
                  <option selected value="Present">Present</option>
                  <option value="Absent">Absent</option>
                  <option value="Tardy">Tardy</option>
                </select><br>

        <input type="submit" value="Submit" class="btn btn-primary btn-sm">
    </form> -->
    <br><br>
    
    

<br>


<!-- Test code from AI -->


            </div>
            
        </div>
        <!-- Permbajtja end -->

        

        
                 
        <?php include('partials/footer.php');?>
        
    </div>

  <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

  
  </body>
</html>