<?php 
  include('config/conn.php'); 
  //include('login-check.php'); use this line if you need to work with login page!
?>

<!-- Required meta tags -->
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Online Bootstrap CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">-->
    
    <!-- Offline Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    
    <!-- My ustomized CSS style -->
    <link href="css/admin.css" rel="stylesheet">

<!-- Navbar start / Header start -->
<div class="row">
            <nav class="navbar fixed-top navbar-expand-lg navbar-dark py-3" style="background-color: #3f51b5;">
                <div class="container-fluid">
                  <a class="navbar-brand" href="index.php">
                    <img src="img/icon-planet.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                    <strong>PLANET ENGLISH</strong>
                  </a>

                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo02">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="m-courses.php">
                          <img src="img/icon-courses.svg" title="Courses" height="30" width="30">
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="m-students.php" id="" role="" data-bs-toggle="" aria-expanded="">
                        <img src="img/icon-students.svg" title="Students" height="30" width="30">
                        </a>
                        </li>
                      <li class="nav-item ">
                        <a class="nav-link" href="m-enrollments.php">
                        <img src="img/icon-enrollments.svg" title="Enrollments" height="30" width="30">
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="m-attendances.php">
                        <img src="img/icon-attendancesW.svg" title="Attendances" height="30" width="30">
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="m-grading.php">
                        <img src="img/icon-grading.svg" title="Grading" height="30" width="30">
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="m-payments.php">
                        <img src="img/icon-payments.svg" title="Payments" height="30" width="30">
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="m-expenses.php">
                        <img src="img/icon-expenses.svg" title="Expenses" height="30" width="30">
                        </a>
                      </li>
                    </ul>

                    <!-- <a href="http://webmail.uniformaime.com/" target="_blank" style="color: white;">webmail</a>&nbsp;
                    <a class="navbar-brand" href="logout.php">
                    <img src="../img/icon-logout.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top text-center">
                    Ckyqu
                     </a> --> <!--Use this line if you need to work with logout system. -->
                  </div>
                  
                </div>
              </nav>
        </div>
        <!-- Navbar end / Header end -->