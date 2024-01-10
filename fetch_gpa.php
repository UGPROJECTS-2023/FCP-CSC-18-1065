<?php
// Include your database connection here
require_once 'db_connect.php';

// Function to map grades to their corresponding GPA values
function mapGradeToGPA($grade) {
    $gradeGPA = [
        'A'=>5.0,
        'B' => 4.0,
        'C' => 3.0,
        'D' => 2.0,
        'E' => 1.0,
        'F' => 0.0
        // Add more grade-GPA mappings as needed
    ];

    return isset($gradeGPA[$grade]) ? $gradeGPA[$grade] : 0.0;
}

// Get form data
$selectedCourses = $_POST['course']; // Array of selected course IDs
$selectedGrades = $_POST['grade'];   // Array of selected grades
$selectedCredits = $_POST['credits']; // Array of selected credits

$totalWeightedGP = 0; // Total weighted grade points
$totalCredits = 0;     // Total credits

// Calculate GPA for each selected course
for ($i = 0; $i < count($selectedCourses); $i++) {
    $courseId = $selectedCourses[$i];
    $grade = $selectedGrades[$i];
    $credits = $selectedCredits[$i];

    // Fetch course grade points based on grade
    $courseGPA = mapGradeToGPA($grade);

    // Calculate weighted grade points for the course
    $weightedGP = $courseGPA * $credits;

    $totalWeightedGP += $weightedGP;
    $totalCredits += $credits;
}

// Calculate GPA
if ($totalCredits > 0) {
    $gpa = $totalWeightedGP / $totalCredits;
    // Round GPA to two decimal places
    $roundedGPA = round($gpa, 2);
} else {
    $roundedGPA = 0.0;
}

// Display GPA
echo "Your GPA: $roundedGPA";

// Close the database connection
mysqli_close($conn);
?>
