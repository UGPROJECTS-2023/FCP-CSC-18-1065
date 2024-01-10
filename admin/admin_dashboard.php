<?php
// Database configuration
include 'db_connect.php';
// Create a database connection

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data from the database
$sql = "SELECT id, name, email, problem_type, description FROM reports";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Academic Advising System - Admin Dashboard</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@1,300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
    margin: 0;
    padding: 0;
   
}


.sidebar {
  margin: 0;
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


    </style>
   </head>
<body>
    <header>
        
        <div class="top-nav">
            <a href="#"><i class="fas fa-university"></i> FUD DUTSE  SAAS</a>
            <a href="logout.php" style="float: right;"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </header>
    <div class="dashboard-container">
        <nav class="sidebar">
        <a href="admin_dashboard.php" class="active"><i class="fas fa-home"></i> Home</a>
        <a href="manageadmin.php"><i class="fas fa-book"></i> Setting</a>
        <a href="../chatbot/admin/index.php"><i class="fas fa-chart-bar"></i> Manage ChatBot</a>
        
        </nav>
    
    <div class="content">
        <h2>Admin Dashboard Overview</h2>

        <div class="container mt-5">
    
        <button class="btn btn-primary mt-2 mb-2" data-toggle="modal" data-target="#createAdvisorModal">Create New Advisor</button>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Action</th>
                    <th></th>


                </tr>
            </thead>
            <tbody>
                <?php
                include 'db_connect.php';
                
                $sql = "SELECT * FROM advisors";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["advisor_id"] . "</td>";
                        echo "<td>" . $row["advisor_name"] . "</td>";
                        echo "<td>" . $row["advisor_email"] . "</td>";
                        echo "<td>" . $row["advisor_level"] . "</td>";
                        echo "<td><button class='btn btn-sm btn-primary edit-advisor' data-id='" . $row["advisor_id"] . "'>Edit</button></td>";
                        echo "<td><button class='btn btn-sm btn-danger delete-advisor' data-id='" . $row["advisor_id"] . "'>Delete</button></td>";
                        echo "</tr>";
                        
                    }
                } else {
                    echo "<tr><td colspan='5'>No advisors found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <h2>Report List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Problem Type</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through the result set and populate the table rows
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["problem_type"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo '<td>
                            <a href="#" class="btn btn-primary">View</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No reports found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    

    <!-- Create Advisor Modal -->
    <div class="modal fade" id="createAdvisorModal" tabindex="-1" aria-labelledby="createAdvisorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAdvisorModalLabel">Create New Advisor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createAdvisorForm">
                        <div class="form-group">
                            <label for="advisorName">Name</label>
                            <input type="text" class="form-control" id="advisorName" name="advisorName" required>
                        </div>
                        <div class="form-group">
                            <label for="advisorEmail">Email</label>
                            <input type="email" class="form-control" id="advisorEmail" name="advisorEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="advisorPassword">Password</label>
                            <input type="password" class="form-control" id="advisorPassword" name="advisorPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="advisorRole">Role</label>
                            <select class="form-control" id="advisorRole" name="advisorRole" required>
                                <option value="" disabled selected>Assign To</option>
                                <option value="Level 1">Level 1</option>
                                <option value="Level 2">Level 2</option>
                                <option value="Level 3">Level 3</option>
                                <option value="Level 4">Level 4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="advisorPhone">Phone Number</label>
                            <input type="tel" class="form-control" id="advisorPhone" name="advisorPhone" required>
                        </div>
                        <div class="form-group">
                            <label for="advisorAddress">Office Address</label>
                            <input type="text" class="form-control" id="advisorAddress" name="advisorAddress" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Advisor</button>
                        </div>
                    </form>

                    
                </div>
            </div>
           <!-- Modal for editing advisor -->
           <div class="modal fade" id="editAdvisorModal" tabindex="-1" aria-labelledby="editAdvisorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAdvisorModalLabel">Edit Advisor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editAdvisorForm">
                    <input type="hidden" id="editAdvisorId" name="editAdvisorId">
                    <div class="form-group">
                        <label for="editAdvisorName">Name</label>
                        <input type="text" class="form-control" id="editAdvisorName" name="editAdvisorName" required>
                    </div>
                    <div class="form-group">
                        <label for="editAdvisorEmail">Email</label>
                        <input type="email" class="form-control" id="editAdvisorEmail" name="editAdvisorEmail" required>
                    </div>

                    <div class="form-group">
                            <label for="advisorPassword">Password</label>
                            <input type="password" class="form-control" id="editAdvisorPassword" name="advisorPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="advisorRole">Role</label>
                            <select class="form-control" id="editAdvisorRole" name="editadvisorRole" required>
                                <option value="" disabled selected>Assign To</option>
                                <option value="Level 1">Level 1</option>
                                <option value="Level 2">Level 2</option>
                                <option value="Level 3">Level 3</option>
                                <option value="Level 4">Level 4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="advisorPhone">Phone Number</label>
                            <input type="tel" class="form-control" id="editAdvisorPhone" name="advisorPhone" required>
                        </div>
                        <div class="form-group">
                            <label for="advisorAddress">Office Address</label>
                            <input type="text" class="form-control" id="editAdvisorAddress" name="advisorAddress" required>
                        </div>
                    <!-- Additional fields for editing, if needed -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="updateAdvisorButton">Update Advisor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
     <script src="script.js"></script>

  <script>

  const sidebar = document.getElementById("sidebar");
        const content = document.getElementById("content");
        const toggleButton = document.getElementById("toggleSidebarButton");
        
        let isSidebarOpen = false; // Keep track of sidebar state

        toggleButton.addEventListener("click", () => {
            isSidebarOpen = !isSidebarOpen; // Toggle sidebar state
            
            // Update the icon based on the sidebar state
            if (isSidebarOpen) {
                toggleButton.innerHTML = '<i class="fas fa-angle-left"></i>';
                sidebar.classList.add("active");
                content.classList.add("active");
            } else {
                toggleButton.innerHTML = '<i class="fas fa-angle-right"></i>';
                sidebar.classList.remove("active");
                content.classList.remove("active");
            }
        });
       
    // Function to open the edit advisor modal with data
    function openEditAdvisorModal(advisorId, advisorName, advisorEmail, advisorRole, advisorPhone, advisorAddress) {
        // Populate the modal with the advisor's data
        $("#editAdvisorId").val(advisorId);
        $("#editAdvisorName").val(advisorName);
        $("#editAdvisorEmail").val(advisorEmail);
        $("#editAdvisorRole").val(advisorRole);
        $("#editAdvisorPhone").val(advisorPhone);
        $("#editAdvisorAddress").val(advisorAddress);

        // Show the modal
        $("#editAdvisorModal").modal("show");
    }

    // Event listener for editing an advisor
    $(".edit-advisor").click(function () {
        const advisorId = $(this).data("id");
        const advisorName = $(this).closest("tr").find("td:eq(1)").text();
        const advisorEmail = $(this).closest("tr").find("td:eq(2)").text();
        const advisorRole = $(this).closest("tr").find("td:eq(3)").text();
        const advisorPhone = $(this).closest("tr").find("td:eq(4)").text();
        const advisorAddress = $(this).closest("tr").find("td:eq(5)").text();

        openEditAdvisorModal(advisorId, advisorName, advisorEmail, advisorRole, advisorPhone, advisorAddress);
    });

    // Event listener for updating an advisor
    $("#updateAdvisorButton").click(function () {
        // Get data from the edit form
        const advisorId = $("#editAdvisorId").val();
        const advisorName = $("#editAdvisorName").val();
        const advisorEmail = $("#editAdvisorEmail").val();
        const advisorRole = $("#editAdvisorRole").val();
        const advisorPhone = $("#editAdvisorPhone").val();
        const advisorAddress = $("#editAdvisorAddress").val();

        // Make an AJAX request to update the advisor
        $.ajax({
            type: "POST",
            url: "update_advisor.php", // You need to create this PHP script
            data: {
                advisorId: advisorId,
                advisorName: advisorName,
                advisorEmail: advisorEmail,
                advisorRole: advisorRole,
                advisorPhone: advisorPhone,
                advisorAddress: advisorAddress,
            },
            success: function (response) {
                if (response.success) {
                    // Update the advisor's data in the table
                    const advisorRow = $(`tr[data-id='${advisorId}']`);
                    advisorRow.find("td:eq(1)").text(advisorName);
                    advisorRow.find("td:eq(2)").text(advisorEmail);
                    advisorRow.find("td:eq(3)").text(advisorRole);
                    advisorRow.find("td:eq(4)").text(advisorPhone);
                    advisorRow.find("td:eq(5)").text(advisorAddress);

                    // Close the edit modal
                    $("#editAdvisorModal").modal("hide");
                } else {
                    // Handle the error
                    alert("Error updating advisor: " + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred while updating the advisor.");
            },
        });
    });
</script>
</body>
</html>
