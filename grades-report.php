<?php
include('config/conn.php'); 
require('partials/fpdf.php');

// Create a class that extends FPDF
class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 10, 'Grading Report', 0, 1, 'C');
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Fetch data from the database
//$query = "SELECT grade_id, grenrollment_id, grade, grade_description FROM grades";

if(isset($_POST['pdf'])){
    //echo "pdf button clicked.";
    $stud_name = $_POST['student_name'];
    //echo "<div class='success'>Selected student name: " .$student_n. "</div><br>";

// include('db_connection.php');
//use following code to filter data by the selected student

$query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, g.grade_id, g.grenrollment_id, g.grade, g.grade_description FROM students s 
    LEFT JOIN enrollments e
    ON s.student_id = e.enstudent_id
    LEFT JOIN courses c
    ON e.encourse_id = c.course_id
    LEFT JOIN grades g
    ON e.enrollment_id = g.grenrollment_id
    WHERE CONCAT(s.first_name, ' ' , s.last_name) = '".$stud_name."'
    -- GROUP BY s.first_name
    ";
} else{
    //echo "<div class='error'>You didn't select any student!</div> <br>";

//use following code for else case - to show all the existing data in the grades table
$query = "SELECT DISTINCT s.first_name, s.last_name, c.course_name, g.grade_id, g.grenrollment_id, g.grade, g.grade_description FROM students s 
LEFT JOIN enrollments e
ON s.student_id = e.enstudent_id
LEFT JOIN courses c
ON e.encourse_id = c.course_id
LEFT JOIN grades g
ON e.enrollment_id = g.grenrollment_id
ORDER BY s.first_name
";

//echo $row['first_name'];
}

$result = mysqli_query($cxn, $query);

// Create a PDF instance
$pdf = new PDF();
$pdf->AddPage();

// Create a table for the report
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 10, 'Student', 1);
$pdf->Cell(40, 10, 'Grade', 1);
$pdf->Cell(90, 10, 'Grade Description', 1);
$pdf->Ln(); // Move to the next row

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(60, 10, $row['first_name'].' '.$row['last_name'], 1);
    $pdf->Cell(40, 10, $row['grade'], 1);
    $pdf->MultiCell(90, 10, $row['grade_description'], 1);
}

// Close PDF and database connection
$pdf->Output();
mysqli_close($cxn);

?>