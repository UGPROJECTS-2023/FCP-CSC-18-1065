<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    

<div class="col-md-9">
    <h2>Student Details</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Academic Level</th>
                <th>Phone Number</th>
            </tr>
        </thead>
        <tbody>
            <?php
         include'db_connect.php';
            // Loop through the $students array and filter based on advisor's level and student's academic level
            foreach ($students as $student) {
                // Check if the student's academic level matches the advisor's level
                if ($student['academic_level'] == $advisorLevel) {
                    echo "<tr>";
                    echo "<td>" . $student['student_id'] . "</td>";
                    echo "<td>" . $student['student_name'] . "</td>";
                    echo "<td>" . $student['student_email'] . "</td>";
                    echo "<td>" . $student['academic_level'] . "</td>";
                    echo "<td>" . $student['phone_number'] . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>