<!DOCTYPE html>
<html lang="en">
<head>

<title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form id="forgot-password-form">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit">Send Reset Link</button>
    </form>
    <script>
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
        // Display a success message to the user
    } else {
        console.log('Reset link sending failed:', response.message);
        // Display an error message to the user
    }
}

    </script>


</body>
</html>
