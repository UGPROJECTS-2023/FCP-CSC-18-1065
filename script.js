document.getElementById('login-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    // Send formData using AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'login.php', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // For server-side detection
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                handleLoginResponse(response);
            } else {
                console.error('Login request failed.');
            }
        }
    };
    xhr.send(formData);
});

function handleLoginResponse(response) {
    if (response.success) {
        // Redirect to dashboard or other appropriate page
        window.location.href = response.redirect;
    } else {
        // Display error message to the user
        const errorContainer = document.getElementById('error-container');
        errorContainer.textContent = response.message;
    }
}

document.getElementById('forgot-password-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    // Send formData using AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'send_reset_link.php', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                handleResetLinkResponse(response);
            } else {
                console.error('Send reset link request failed.');
            }
        }
    };
    xhr.send(formData);
});

function handleResetLinkResponse(response) {
    if (response.success) {
        console.log('Reset link sent successfully');
        // Optionally, provide a success message to the user
    } else {
        console.log('Reset link sending failed:', response.message);
        // Display an error message to the user
    }
}

document.getElementById('reset-password-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    // Send formData using AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'reset_password_process.php', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                handleResetPasswordResponse(response);
            } else {
                console.error('Reset password request failed.');
            }
        }
    };
    xhr.send(formData);
});

function handleResetPasswordResponse(response) {
    if (response.success) {
        console.log('Password reset successful');
        // Optionally, provide a success message to the user
    } else {
        console.log('Password reset failed:', response.message);
        // Display an error message to the user
    }
}

function loadContent(page) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('content').innerHTML = xhr.responseText;
            } else {
                console.error('Error loading content:', xhr.status, xhr.statusText);
            }
        }
    };
    xhr.open('GET', page, true);
    xhr.send();
}
