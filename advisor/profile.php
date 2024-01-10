<?php
session_start();
require_once 'db_connect.php'; 

if (!isset($_SESSION['advisor_id'])) {
    header("Location: advisor_login.php"); 
    exit;
}

$advisorLevel = $_SESSION['advisor_level'];
$advisorid = $_SESSION['advisor_id'];
$advisorname = $_SESSION['advisor_name'];


// Fetch user data based on registration number
$query = "SELECT * FROM advisors WHERE advisor_id = '$advisorid'";
$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) === 0) {
    // User not found
    header("Location: advisor_login.php"); // Redirect to login if user not found
    exit;
}

$userData = mysqli_fetch_assoc($result);

?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>

        
.sidebar {
 padding: 0;
  width: 200px;
  background-color: #dff0dd;
  position: fixed;
  height: 100%;
  overflow: auto;
}

/* Sidebar links */
.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
.text-danger{
  color: red;
}
/* Active/current link */
.sidebar a.active {
  background-color: #04AA6D;
  color: white;
}

/* Links on mouse-over */
.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

/* Page content. The value of the margin-left property should match the value of the sidebar's width property */
div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

/* On screens that are less than 700px wide, make the sidebar into a topbar */
@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

/* On screens that are less than 400px, display the bar vertically, instead of horizontally */
@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}


  .user-profile {
    margin-bottom: 20px;
}

.profile-link {
    display: block;
    text-align: center;
    color: white;
}

.profile-picture {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin: 0 auto;
    display: block;
}


.profile-header {

    
    text-align: center;
    padding: 20px;
    overflow-x: hidden;
    background-color: white;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
   

    z-index: 1000;
}

.profile-header img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
    border: 3px solid #fff;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
}

.profile-header h1 {
    font-size: 28px;
    margin-bottom: 5px;
    color: black;
}

.profile-header p {
    font-size: 18px;
    margin-bottom: 10px;
    color: black;
    font-family:Georgia, 'Times New Roman', Times, serif;
}

.profile-header strong {
    font-weight: bold;
    color: black;
}

/* Additional styles for responsiveness */
@media screen and (max-width: 768px) {
    .profile-header img {
        width: 120px;
        height: 120px;
    }

    .profile-header h1 {
        font-size: 24px;
    }

    .profile-header p {
        font-size: 16px;
    }
}


.top-nav {
    z-index: 1;
    background-color: #333;
    color: white;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.top-nav a {
    color: white;
    text-decoration: none;
}

.top-nav a:hover {
    text-decoration: underline;
}

/* Style for the logout link */
.top-nav a.logout-link {
    margin-left: auto;
}

  .top-nav i {
    margin-right: 5px;
}
@media screen and (max-width: 600px) {
    .topnav a:not(:first-child) {display: none;}
    .topnav a.icon {
      float: right;
      display: block;
    }
  }
  
  /* The "responsive" class is added to the topnav with JavaScript when the user clicks on the icon. This class makes the topnav look good on small screens (display the links vertically instead of horizontally) */
  @media screen and (max-width: 600px) {
    .topnav.responsive {position: relative;}
    .topnav.responsive a.icon {
      position: absolute;
      right: 0;
      top: 0;
    }
    .topnav.responsive a {
      float: none;
      display: block;
      text-align: left;
    }
  }

  .topnav {
    background-color: #333;
    overflow: hidden;
  }
  
  .topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }
  
  /* Change the color of links on hover */
  .topnav a:hover {
    background-color: #ddd;
    color: black;
  }
  
  /* Add an active class to highlight the current page */
  .topnav a.active {
    background-color: #04AA6D;
    color: white;
  }
  
  /* Hide the link that should open and close the topnav on small screens */
  .topnav .icon {
    display: none;
  }

  .catalog-container {
    display: flex;
    justify-content: space-between;
    margin: 20px;
   }
    </style>
</head>
<body>
    <header>
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
<div class="dashboard-container">
        <nav class="sidebar">
        <a href="advisor_dashboard.php" class="active"><i class="fas fa-home"></i> Home</a>
        <a href="add_course.php"><i class="fas fa-book"></i> Courses</a>
        <a href="send_notification.php"><i class="fas fa-bell"></i> Notifications</a>
        <a href="setting.php"><i class="fas fa-cog"></i> Settings</a>
        <a href="profile.php"><i class="fas fa-book"></i> Profile</a>
       
        </nav>
<div class="content">
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                User Profile
            </div>
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-md-8">
                        <h2 class="card-title"><?php echo $userData['advisor_name']; ?></h2>
                       
                        <p><strong>Email:</strong> <?php echo $userData['advisor_email']; ?></p>
                        <p><strong>Academic Level:</strong> <?php echo $userData['advisor_level']; ?></p>
                        <p><strong>Pasword:</strong> <?php echo $userData['advisor_password']; ?></p>
                        <p><strong>Phone Number:</strong> <?php echo $userData['advisor_phone']; ?></p>
                        <p><strong>Office Location:</strong> <?php echo $userData['advisor_office_location']; ?></p>
                        <button type="button" class="btn btn-primary" id="editProfileButton">
    Edit Profile
</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="editProfileForm" enctype="multipart/form-data">
          
                    <div class="form-group">
                        <label for="fullname">Fullname:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $userData['advisor_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="regNumber">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $userData['advisor_email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Advisor_Level:</label>
                        <input type="text" class="form-control" id="level" name="level" value="<?php echo $userData['advisor_level']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="academicLevel">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $userData['advisor_password']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="academicLevel">Phone </label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $userData['advisor_phone']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="academicLevel">Office Location</label>
                        <input type="text" class="form-control" id="office" name="office" value="<?php echo $userData['advisor_office_location']; ?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    jQuery(document).ready(function ($) {
        // Open the Edit Profile modal when the button is clicked
        $("#editProfileButton").click(function () {
            $("#editProfileModal").modal("show");
        });

        // Handle form submission
        $("#saveChangesBtn").click(function () {
            // Serialize the form data into a format that can be sent via AJAX
            var formData = $("#editProfileForm").serialize();

            // Make an AJAX POST request to update the user's profile
            $.ajax({
                type: "POST",
                url: "update_profile.php", // Replace with the actual URL for updating the profile
                data: formData,
                success: function (response) {
                    if (response.success) {
                        // If the update was successful, display a success message and close the modal
                        alert("Profile updated successfully.");
                        $("#editProfileModal").modal("hide");
                        // You can also update the user interface to reflect the changes if needed
                    } else {
                        // If there was an error, display an error message
                        alert("Error updating profile. Please try again.");
                    }
                },
                error: function (xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error(xhr.responseText);
                    alert("An error occurred while updating the profile.");
                },
            });
        });
    });

    function toggleNav() {
        var x = document.getElementById("myTopnav");
        if (x.className === "top-nav") {
            x.className += " responsive";
        } else {
            x.className = "top-nav";
        }
    }
</script>
</body>
</html>
