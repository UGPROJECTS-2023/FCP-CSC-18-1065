<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Edit Admin Information</h2>
    <form id="editAdminForm">
        <input type="hidden" id="adminId" name="adminId" value="<?php echo $adminId; ?>">
        <div class="form-group">
            <label for="adminName">Name:</label>
            <input type="text" class="form-control" id="adminName" name="adminName" value="<?php echo $adminName; ?>">
        </div>
        <div class="form-group">
            <label for="adminEmail">Email:</label>
            <input type="email" class="form-control" id="adminEmail" name="adminEmail" value="<?php echo $adminEmail; ?>">
        </div>
        <div class="form-group">
                            <label for="advisorRole">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="" disabled selected>Assign As </option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function() {
    $("#editAdminForm").submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Serialize the form data into a format that can be sent via AJAX
        var formData = $(this).serialize();

        // Make an AJAX POST request to update the admin's information
        $.ajax({
            type: "POST",
            url: "update_admin.php", // PHP script for updating admin data
            data: formData,
            success: function(response) {
                if (response.success) {
                    // If the update was successful, display a success message
                    alert("Admin information updated successfully.");
                    // You can also update the user interface to reflect the changes if needed
                } else {
                    // If there was an error, display an error message
                    alert("Error updating admin information. Please try again.");
                }
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the AJAX request
                console.error(xhr.responseText);
                alert("An error occurred while updating admin information.");
            },
        });
    });
});
</script>
</body>
</html>