<?php 
include('conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- CSS links -->
    <link rel="stylesheet" href="css/style-content.css">  
    <link rel="stylesheet" href="css/style-nav.css"> 

    <script type="text/javascript">
      window.addEventListener('scroll', function() {
          var header = document.querySelector('header');
          header.classList.toggle('sticky', window.scrollY > 0);
      });

      function toggleMenu() {
          var menuToggle = document.querySelector('.toggle');
          var menu = document.querySelector('.menu');
          menuToggle.classList.toggle('active');
          menu.classList.toggle('active');
      }   
    </script>
     

</head>
<body>

<header class="sticky">
        <a href="index.php" class="logo">PLANET ENGLISH</a>
        <div class="toggle" onclick="toggleMenu();"></div>
        <ul class="menu">
            <li><a href="courses.php" onclick="toggleMenu();">Courses</a></li>
            <li><a href="students.php" onclick="toggleMenu();">Students</a></li>
            <li><a href="enrollments.php" onclick="toggleMenu();">Enrollments</a></li>
            <li><a href="attendances.php" onclick="toggleMenu();">Attendances</a></li>
            <li><a href="grading.php" onclick="toggleMenu();">Grading</a></li>
            <li><a href="payments.php" onclick="toggleMenu();">Payments</a></li>
            <li><a href="expenses.php" onclick="toggleMenu();">Expenses</a></li>
        </ul>
</header>
















<!-- Navbar start / Header start -->

<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="#">Features</a>
      <a class="nav-item nav-link" href="#">Pricing</a>
      <a class="nav-item nav-link" href="#">Expenses</a>
    </div>
  </div>
</nav> -->

<!-- Navbar end / Header end -->











<!-- Menu START 

        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="">Courses</a></li>
                    <li><a href="">Students</a><li>
                    <li><a href="">Enrollments</a><li>
                    <li><a href="">Attendances</a><li>
                    <li><a href="">Grading</a><li>
                    <li><a href="">Payments</a><li>
                    <li><a href="">Expenses</a><li>
                </ul>
            </div>
        </div>
     

    Menu END -->