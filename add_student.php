
<!DOCTYPE html>
<html>
<head>
    <title>Add Student Details</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
</div>
<link rel="stylesheet" type="text/css" href="style.css">

    <h1>Add Student Details</h1>
    <form method="post" action="save_student.php">
        <label for="regNumber">Registration Number:</label>
        <input type="text" name="regNumber" id="regNumber" required><br>

        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="firstName" required><br>

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" id="lastName" required><br>

        <label for="phoneNumber">Phone Number:</label>
        <input type="text" name="phoneNumber" id="phoneNumber" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" id="address" required><br>

        <input type="submit" value="Save">
    </form>
</body>
</html>
