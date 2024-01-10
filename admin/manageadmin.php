<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advisors</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
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
        <a href="../chatbot/admin/index.php"><i class="fas fa-chart-bar"></i> Manage ChatBot</a>
        <a href="manageadmin.php"><i class="fas fa-book"></i> Setting</a>
        
        </nav>
    <div class="content">
    <div class="container mt-5">
        <h1>Admin</h1>
        <button class="btn btn-primary mt-2 mb-2" data-toggle="modal" data-target="#createAdminModal">Manage Admin</button>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Action</th>
                    <th></th>


                </tr>
            </thead>
            <tbody>
                <?php
                include 'db_connect.php';
                
                $sql = "SELECT * FROM admin";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>" . $row["password"] . "</td>";
                        echo "<td>" . $row["role"] . "</td>";
                        echo "<td><button class='btn btn-sm btn-primary edit-admin' data-id='" . $row["id"] . "'>Edit</button></td>";
                        echo " <td><button class='btn btn-sm btn-danger delete-admin' data-id='" . $row["id"] . "'>Delete</button></td>
                        ";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No admin found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>


    <!-- Create Advisor Modal -->
    <div class="modal fade" id="createAdminModal" tabindex="-1" aria-labelledby="createAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAdminModalLabel">Create New Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="createAdminForm" action="insert_admin.php" method="POST">

                        <div class="form-group">
                            <label for="advisorName">UserName</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="advisorPassword">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="advisorRole">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="" disabled selected>Assign As </option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create </button>
                        </div>
                    </form>

                    
                </div>
            </div>

<!-- Edit Admin Modal -->
<div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAdminModalLabel">Edit Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editAdminForm" action="update_admin.php" method="POST">
                    <input type="hidden" id="editAdminId" name="editAdminId">

                    <!-- Username -->
                    <div class="form-group">
                        <label for="editUsername">Username</label>
                        <input type="text" class="form-control" id="editUsername" name="editUsername" required>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="editPassword">Password</label>
                        <input type="password" class="form-control" id="editPassword" name="editPassword" required>
                    </div>

                    <!-- Role -->
                    <div class="form-group">
                        <label for="editRole">Role</label>
                        <select class="form-control" id="editRole" name="editRole" required>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="updateAdminBtn" type="button" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>

    <script>
        // JavaScript code to handle "Delete" button click event
// JavaScript code to handle "Delete" button click event
$(document).on('click', '.delete-admin', function () {
    var adminId = $(this).data('id');
    var rowToRemove = $(this).closest('tr'); // Store the row to remove
    
    // Confirm the deletion with the user (you can customize this confirmation)
    if (confirm("Are you sure you want to delete this admin?")) {
        // Make an AJAX request to delete the admin
        $.ajax({
            type: "POST",
            url: "delete-admin.php", // Replace with the actual URL to delete admin
            data: { id: adminId },
            success: function (response) {
                if (response.success) {
                    // If the deletion was successful, remove the deleted row from the table
                    alert("Admin deleted successfully.");
                    rowToRemove.remove(); // Remove the row from the table
                } else {
                    alert("Error deleting admin. Please try again.");
                }
            },
            error: function (xhr) {
                // Handle errors if necessary
                console.error(xhr.responseText);
                alert("An error occurred while deleting the admin.");
            },
        });
    }
});


    jQuery(document).ready(function ($) {
        // Open the Edit Admin modal when the "Edit" button is clicked
        $(document).on('click', '.edit-admin', function () {
            // Get the admin ID associated with the clicked "Edit" button
            var adminId = $(this).data('id');
            
            // Make an AJAX request to fetch admin details by adminId
            $.ajax({
                type: "GET",
                url: "get_admin_details.php", // Replace with the actual URL to fetch admin details
                data: { id: adminId },
                dataType: "json", // Assuming the response will be in JSON format
                success: function (response) {
                    // Populate the modal form fields with admin details
                    $('#editAdminId').val(response.id);
                    $('#editUsername').val(response.username);
                    $('#editPassword').val(response.password);
                    $('#editRole').val(response.role);

                    // Show the modal
                    $('#editAdminModal').modal('show');
                },
                error: function (xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error(xhr.responseText);
                    alert("An error occurred while fetching admin details.");
                },
            });
        });

        // Handle form submission for updating admin details
        $("#updateAdminBtn").click(function () {
            // Serialize the form data into a format that can be sent via AJAX
            var formData = $("#editAdminForm").serialize();

            // Make an AJAX POST request to update the admin's details
            $.ajax({
                type: "POST",
                url: "update_admin.php", // Replace with the actual URL for updating admin details
                data: formData,
                success: function (response) {
                    if (response.success) {
                        // If the update was successful, display a success message and close the modal
                        alert("Admin details updated successfully.");
                        $('#editAdminModal').modal('hide');
                        // You can also update the user interface to reflect the changes if needed
                    } else {
                        // If there was an error, display an error message
                        alert("Error updating admin details. Please try again.");
                    }
                },
                error: function (xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error(xhr.responseText);
                    alert("An error occurred while updating admin details.");
                },
            });
        });
    });


    </script>
</body>
</html>


    