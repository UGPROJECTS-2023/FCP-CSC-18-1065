<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Problem Reporting</title>
    <!-- Add Bootstrap CSS CDN link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <link rel="stylesheet" href="style1.css">
     <style>
       .content{
        background-color: whitesmoke;
    
  }
     </style>
</head>
<body>
 
  
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
    <i class="fas fa-university"></i> <span class="bold-text">FUD DUTSE</span>
   
    SAAS
  </a>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a href="logout.php" class="nav-link">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </li>
  </ul>
</div>

        <nav class="sidebar">
        <a href="dashboard.php" class="active"><i class="fas fa-home"></i> Home</a>
        <a href="courses.php"><i class="fas fa-book"></i> Course Catelog</a>
        <a href="course.php"><i class="fas fa-book"></i> Courses</a>
        <a href="gpa.php"><i class="fas fa-chart-bar"></i>GPA Calculator</a>
        <a href="schedule_appoinement1.php"><i class="fas fa-calendar"></i> Schedule</a>
        <a href="profile.php"><i class="fas fa-book"></i> Profile</a>
        <a href="report.php"><i class="fas fa-book"></i> Report Problem</a>
        </nav>
       
       
    </header>
    <div class="content">
   <center> <h1>Academic Problem Reporting</h1></center>
    <main class="container mt-4">
    <form id="reportForm" action="submit.php" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="form-group">
    <label for="problemType">Select Problem Type:</label>
    <select class="form-control" id="problemType" name="problemType" required>
        <option value="">Select a Problem Type</option>
        <option value="Course Registration Issues">Course Registration Issues</option>
        <option value="Academic Progress and Performance">Academic Progress and Performance</option>
        <option value="Scheduling Conflicts">Scheduling Conflicts</option>
        <option value="Major or Program Changes">Major or Program Changes</option>
        <option value="Degree Planning and Requirements">Degree Planning and Requirements</option>
        <option value="Financial Aid and Scholarships">Financial Aid and Scholarships</option>
        <option value="Internship or Career Guidance">Internship or Career Guidance</option>
        <option value="Personal or Health Challenges">Personal or Health Challenges</option>
        <option value="Study Skills and Time Management">Study Skills and Time Management</option>
        <option value="Technology and Access">Technology and Access</option>
        <option value="Graduate School Preparation">Graduate School Preparation</option>
        <option value="Accessibility and Accommodations">Accessibility and Accommodations</option>
        <option value="Financial Advising">Financial Advising</option>
        <option value="Conflict Resolution">Conflict Resolution</option>
        <option value="General Academic Advising">General Academic Advising</option>
    </select>
</div>


    <div class="form-group">
        <label for="description">Problem Description:</label>
        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
    </div>

    <div class="form-group">
        <label for="file">Supporting Documents (if any):</label>
        <input type="file" class="form-control-file" id="file" name="file">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

    </main>
    <!-- Add Bootstrap JavaScript CDN link and your script.js file here -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
