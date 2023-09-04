<?php include('partials/menu.php');?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Online Bootstrap CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">-->
    
    <!-- Offline Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
      
    <title>Planet English * Change, evolve, succeed.</title>
    <!-- css code to clearfix -->
        <style>
            body {
                overflow-x:hidden;
            }
        </style>
  </head>
  <body>
    
    <div class="container-fluid">
        

        <!-- Permbajtja start -->
        <div class="row text-center p-4 mb-auto" style="width:90%; margin: auto;">
            <div class="container-fluid">
                <!--<div class="col">
                   <p class="font-weight-bold">Kategoria</p>
                   <hr>
                    Ketu vendoset permbajtja per kategorite
                </div>-->
                <br><br>
                <p><h1 class="p-1 text-start" style="color: #3f51b5;">Paneli</h1></p>
                <hr>
                <?php 
                                if(isset($_SESSION['login']))
                                {
                                    echo $_SESSION['login'];
                                    unset ($_SESSION['login']);
                                }
                ?><br>
                
              <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">  
                <div class="col text-center text-light border" style="background-color:#90A4AE;">
                  
                  <?php 
                    // SQL QUERY
                    $sql = "SELECT * FROM courses";
                    // execute query
                    $res = mysqli_query($cxn, $sql);
                    // count rows
                    $count = mysqli_num_rows($res);
                  ?>
                  
                  <h1><?php echo $count; ?></h1>
                  <?php 
                  if ($count == 1){
                    echo "Course";
                  }
                  elseif($count < 1){
                    echo "There is no course registered yet!";
                  }
                  else{
                    echo "Courses";
                  }
                  ?>
                  <!-- Course -->
                </div>
                <div class="col text-center text-light border" style="background-color:#90A4AE;">
                  
                <?php 
                    // SQL QUERY
                    $sql2 = "SELECT * FROM students";
                    // execute query
                    $res2 = mysqli_query($cxn, $sql2);
                    // count rows
                    $count2 = mysqli_num_rows($res2);
                  ?>
                  
                  <h1><?php echo $count2; ?></h1>
                  <?php 
                  if ($count2 == 1){
                    echo "Student";
                  }
                  elseif($count2 < 1){
                    echo "There are no students registered yet!";
                  }
                  else{
                    echo "Students";
                  }
                  ?>
                </div>
                <div class="col text-center text-light border" style="background-color:#90A4AE;">
                  
                <?php 
                    // SQL QUERY
                    $sql3 = "SELECT SUM(amount) AS Totali FROM payments";
                    
                    // execute query
                    $res3 = mysqli_query($cxn, $sql3);
                    
                    //get the value
                    $row3 = mysqli_fetch_assoc($res3);

                    // get the total revenue
                    $totali_gjeneruar = $row3['Totali'];
                  ?>

                  <h1><?php echo $totali_gjeneruar; ?> &euro;</h1>
                  Income
                </div>
                <div class="col text-center text-light border" style="background-color:#90A4AE;">
                  
                <?php 
                    // SQL QUERY  TO GET TOTAL REVENUE
                    // agregate function in SQL
                    $sql4 = "SELECT SUM(amount) AS Totali FROM expenses";

                    // execute the query
                    $res4 = mysqli_query($cxn, $sql4);

                    //get the value
                    $row4 = mysqli_fetch_assoc($res4);

                    // get the total revenue
                    $totali_gjeneruar = $row4['Totali'];
                  ?>
                  
                  <h1><?php echo $totali_gjeneruar; ?> &euro;</h1>
                  Expenses
                </div>
              </div>  
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