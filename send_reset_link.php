<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Simulate checking if the email exists in your database
    // Replace with your actual database logic

    if ($email_exists) {
        // Generate a reset token (for simplicity, a random string)
        $reset_token = bin2hex(random_bytes(16));

        // Simulate storing the reset token in the database
        // Replace with your actual database logic

        // Simulate sending the reset link via email
        $reset_link = "http://localhost/reset_password.php?email=$email&token=$reset_token";
        
        $subject = "Password Reset";
        $message = "Click the link to reset your password: $reset_link";
        mail($email, $subject, $message);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Email not found']);
    }
}
?>
