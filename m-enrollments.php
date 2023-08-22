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

    <title>Planet English * Manage enrollments</title>
  </head>
  <body>
    
    <div class="container-fluid">
        

        <!-- Permbajtja start -->
        <div class="row text-start p-4 mb-auto" style="width:90%; margin: auto;">
            <div class="container ">
               
                <br><br>
                <p><h1 class="p-1 text-start" style="color: #3f51b5;">Manage enrollments</h1>
                <!-- butoni per shtimin e adminit -->
                
                </p><hr>
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
                    <div class="text-start"><a href="add-enrollment.php" class="btn btn-primary btn-sm"><img src="img/icon-add.svg" height="30" width="30"> Add enrollment</a></div>
                    <br>
                <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Student</th>
      <th scope="col">Course</th>
      <th scope="col">Enrollment date</th>
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

    $sql = "
          SELECT s.first_name, s.last_name, c.course_name, e.enrollment_date, e.enrollment_id  FROM students s 
          LEFT JOIN enrollments e
          ON s.student_id = e.enstudent_id
          LEFT JOIN courses c
          ON e.encourse_id = c.course_id
    ";

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
          $enrollment_id = $rows['enrollment_id'];
          $firstname = $rows['first_name'];
          $lastname = $rows['last_name'];
          $cname = $rows['course_name'];
          $endate = $rows['enrollment_date'];

          // display the values in our table
          ?>
        
          <tr>
            <th scope="row"><?php echo $sn++?></th>
            <td><?php echo $firstname.' '.$lastname;?></td>
            <td>
              <?php 
              if(!$cname){
                echo "<div class='error'>Student is not assigned to any course! Use 'Add enrollment' button!</div>";
              }else {echo $cname;}
              ?>
            </td>
            <td><?php echo $endate;?></td>
            <td>
              <!-- Use this line if needed for data update: <a href="<?php //echo SITEURL; ?>admin/perditeso-psw.php?course$course_id=<?php //echo $course_id; ?>"><img src="../img/icon-chpsw.png" alt="Perditeso fjalekalimin"></a> -->
              <a href="<?php echo SITEURL; ?>u-enrollment.php?enrollment_id=<?php echo $enrollment_id; ?>"><img src="img/icon-update.png" alt="Update enrollment info"></a>
              <a href="<?php echo SITEURL; ?>d-enrollment.php?enrollment_id=<?php echo $enrollment_id; ?>"><img src="img/icon-delete.png" alt="Delete enrollment info"></a>
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