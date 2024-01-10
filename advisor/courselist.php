<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advisor Dashboard</title>
    <link rel="stylesheet" href="style1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

   </head>
<body>
    
<div class="top-nav">
            <a href="#"><i class="fas fa-university"></i> Portal Name</a>
            <a href="logout.php" style="float: right;"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </header>
    <div class="dashboard-container">
        <nav class="sidebar">
        <a href="advisor_dashboard.php" class="active"><i class="fas fa-home"></i> Home</a>
        <a href="#"><i class="fas fa-book"></i> Courses</a>
        <div class="sub-menu">
        <a href="courses.php"><i class="fas fa-book"></i> Course Details</a>
        <a href="course.php"><i class="fas fa-book"></i> Enroll in Courses</a>
        </div>
        <a href="grade.php"><i class="fas fa-chart-bar"></i> Grades</a>
        <a href="schedule_appoinement1.php"><i class="fas fa-calendar"></i> Schedule</a>
        <a href="chat.php"><i class="fas fa-bell"></i> Notifications</a>
        <a href="setting.php"><i class="fas fa-cog"></i> Settings</a>
        <div class="sub-menu">
        <a href="profile.php"><i class="fas fa-book"></i> Profile</a>
        <a href="Cus.php"><i class="fas fa-book"></i> Enroll in Courses</a>
        </nav>
        <div class="content">
            <h1>Welcome to the Advisor Dashboard</h1>
        </header>
        

<div class="content">
    <h2>List of Courses</h2>
    <ul id="courseList">
        <!-- Course list will be added here dynamically -->
    </ul>
</div>
    </div>
    <script>
    // Fetch courses using AJAX and update the course list
    function fetchCourses() {
        console.log('Fetching courses...');
        
        fetch('get_courses.php')
            .then(response => response.json())
            .then(data => {
                console.log('Received course data:', data);
                const courseList = document.getElementById('courseList');
                courseList.innerHTML = ''; // Clear previous course list
                
                data.forEach(course => {
                    const courseItem = document.createElement('li');
                    courseItem.textContent = `${course.course_code} - ${course.course_name} (${course.department})`;
                    courseList.appendChild(courseItem);
                });
            })
            .catch(error => {
                console.error('Error fetching courses:', error);
            });
    }
    
    // Call the function to fetch and display courses
    fetchCourses();
</script>

</body>
</html>
