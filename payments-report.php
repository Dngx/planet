<?php
//error_reporting('E_ALL & ~E_NOTICE'); //use this code to remove or hide the error messages and warnings.
ob_start();
include('config/conn.php'); 
require('partials/fpdf.php');



// Create a class that extends FPDF
class PDF extends FPDF {
    function Header() {
        $this->Image('logo.png',10,6,30);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 10, 'Payments Report', 0, 1, 'C');
        $this->Ln(15);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Fetch data from the database
//$query = "SELECT grade_id, grenrollment_id, grade, grade_description FROM grades";

if(isset($_POST['pdf3'])){
    //echo "pdf button clicked.";
    $stud_name = $_POST['student'];
    $period_m3 = $_POST['period_month3'];
    $period_y4 = $_POST['period_year4'];
    //echo $stud_name;
    //echo "<div class='success'>Selected student name: " .$student_n. "</div><br>";

// include('db_connection.php');
//use following code to filter data by the selected student

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

    else {
        echo "<div class='error'>You didn't select any student!</div><br>";

    //use following code for else case - to show all the existing data in the grades table
    // $query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, g.grade_id, g.grenrollment_id, g.grade, g.grade_description, g.grade_date FROM students s 
    // LEFT JOIN enrollments e
    // ON s.student_id = e.enstudent_id
    // LEFT JOIN courses c
    // ON e.encourse_id = c.course_id
    // LEFT JOIN grades g
    // ON e.enrollment_id = g.grenrollment_id
    // ORDER BY s.first_name
    // ";

    //echo $row['first_name'];
    }

$result = mysqli_query($cxn, $query);

// Create a PDF instance
$pdf = new PDF();
$pdf->AddPage();

// Create a table for the report
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 10, 'Student', 1);
$pdf->Cell(25, 10, 'Amount', 1);
$pdf->Cell(40, 10, 'Payment Date', 1);

$pdf->Ln(); // Move to the next row

while ($row = mysqli_fetch_assoc($result)) {
$pdf->Cell(60, 10, $row['first_name'].' '.$row['last_name'], 1);
$pdf->Cell(25, 10, $row['amount'], 1);
$pdf->Cell(40, 10, $row['payment_date'], 1);

$pdf->Ln(); // Move to the next row (after each record)
}

ob_end_clean();
// Close PDF and database connection
$pdf->Output();
mysqli_close($cxn);

//ob_end_flush(); 
?>