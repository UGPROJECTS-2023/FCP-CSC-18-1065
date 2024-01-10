 // Function to handle form submission
 document.getElementById('createAdvisorForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission
    
    const advisorName = document.getElementById('advisorName').value;
    const advisorEmail = document.getElementById('advisorEmail').value;
    const advisorPassword = document.getElementById('advisorPassword').value;
    const advisorRole = document.getElementById('advisorRole').value;
    const advisorPhone = document.getElementById('advisorPhone').value;
    const advisorAddress = document.getElementById('advisorAddress').value;

    const formData = new FormData();
    formData.append('advisorName', advisorName);
    formData.append('advisorEmail', advisorEmail);
    formData.append('advisorPassword', advisorPassword);
    formData.append('advisorRole', advisorRole);
    formData.append('advisorPhone', advisorPhone);
    formData.append('advisorAddress', advisorAddress);

    fetch('create_advisor.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            $('#createAdvisorModal').modal('hide');
            // You can update the advisor list here
            updateAdvisorList();
        } else {
            alert('Failed to create advisor. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while creating the advisor.');
    });
});

// Event listener for editing an advisor
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('edit-advisor')) {
        const advisorId = event.target.getAttribute('data-id');

        fetch(`get_advisor_details.php?advisorId=${advisorId}`)
            .then(response => response.json())
            .then(advisor => {
                if (advisor) {
                    populateEditModal(advisor);
                } else {
                    alert('Advisor details not found.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while fetching advisor details.');
            });
    }
});

// Event listener for deleting an advisor
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('delete-advisor')) {
        const advisorId = event.target.getAttribute('data-id');
        const confirmation = confirm('Are you sure you want to delete this advisor?');
        if (confirmation) {
            fetch(`delete_advisor.php?advisorId=${advisorId}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateAdvisorList();
                } else {
                    alert('Failed to delete advisor. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the advisor.');
            });
        }
    }
});


function populateEditModal(advisor) {
    const editModal = document.getElementById('editAdvisorModal');
    const advisorIdField = editModal.querySelector('#editAdvisorId');
    const advisorNameField = editModal.querySelector('#editAdvisorNmae');
    const advisorEmailField = editModal.querySelector('#editAdvisorEmail');
    const advisorPasswordField = editModal.querySelector('#editAdvisorPassword');
    const advisorRoleField = editModal.querySelector('#editAdvisorRole');
    const advisorPhoneField = editModal.querySelector('#editAdvisorPhone');
    const advisorAddressField = editModal.querySelector('#editAdvisorAddress');
    
    advisorIdField.value = advisor.advisor_id;
    advisorNameField.value = advisor.advisor_name;
    advisorEmailField.value = advisor.advisor_email;
    advisorPasswordField.value = advisor.advisor_Password;
    advisorRoleField.value = advisor.advisor_Role;
    advisorPhoneField.value = advisor.advisor_Phone;
    advisorAddressField.value = advisor.advisor_Address;


    $(editModal).modal('show');
}

// Event listener for updating an advisor
document.getElementById('updateAdvisorButton').addEventListener('click', function () {
    const advisorId = document.getElementById('editAdvisorId').value;
    const advisorName = document.getElementById('editAdvisorName').value;
    const advisorEmail = document.getElementById('editAdvisorEmail').value;
    const advisorPassword = document.getElementById('advisorPassword').value;
    const advisorRole = document.getElementById('advisorRole').value;
    const advisorPhone = document.getElementById('advisorPhone').value;
    const advisorAddress = document.getElementById('advisorAddress').value;




    const formData = new FormData();
    formData.append('advisorId', advisorId);
    formData.append('advisorName', advisorName);
    formData.append('advisorEmail', advisorEmail);
    formData.append('advisorPassword', advisorPassword);
    formData.append('advisorRole', advisorRole);
    formData.append('advisorPhone', advisorPhone);
    formData.append('advisorAddress', advisorAddress);

    fetch('update_advisor.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            $('#editAdvisorModal').modal('hide');
            updateAdvisorList();
        } else {
            alert('Failed to update advisor. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the advisor.');
    });
});

// Function to update the advisor list
function updateAdvisorList() {
    const tableBody = document.querySelector('tbody');
    tableBody.innerHTML = '';

    fetch('get_advisors.php') // Replace with the correct endpoint
    .then(response => response.json())
    .then(advisors => {
        if (advisors.length > 0) {
            advisors.forEach(advisor => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${advisor.advisor_id}</td>
                    <td>${advisor.advisor_name}</td>
                    <td>${advisor.advisor_email}</td>
                    <td>
                        <button class='btn btn-sm btn-primary edit-advisor' data-id='${advisor.advisor_id}'>Edit</button>
                        <button class='btn btn-sm btn-danger delete-advisor' data-id='${advisor.advisor_id}'>Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        } else {
            const row = document.createElement('tr');
            row.innerHTML = `<td colspan='4'>No advisors found</td>`;
            tableBody.appendChild(row);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the advisor list.');
    });
}


$(document).ready(function () {
    // Add an event listener for the form submission
    $('#createAdminForm').submit(function (e) {
        e.preventDefault(); // Prevent the default form submission
        
        // Get the form data
        var formData = {
            username: $('#username').val(),
            password: $('#password').val(),
            role: $('#role').val()
        };
        
        // Send an AJAX POST request to your server
        $.ajax({
            type: 'POST',
            url: 'insert_admin.php', // Replace with the correct URL to your PHP script
            data: formData,
            success: function (response) {
                // Handle the response from the server
                console.log(response); // You can display a success message or update the UI here
                $('#createAdminModal').modal('hide'); // Close the modal
                // Optionally, you can refresh the table to display the new data
                refreshTable();
            },
            error: function (error) {
                // Handle errors, display an error message, or log the error
                console.error(error);
            }
        });
    });
    
    // Function to refresh the table (you need to implement this)
    function refreshTable() {
        // You can use AJAX to reload the table content or simply refresh the page
        location.reload(); // This will refresh the page
    }
});
