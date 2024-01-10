<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <?php
    $email = $_GET['email'] ?? '';
    $token = $_GET['token'] ?? '';

    if ($email && $token) {
        ?>
        <h1>Password Reset</h1>
        <form id="reset-password-form">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <input type="password" name="new_password" placeholder="Enter new password" required>
            <input type="password" name="confirm_password" placeholder="Confirm new password" required>
            <button type="submit">Reset Password</button>
        </form>
        <script src="reset_script.js"></script>
        <?php
    } else {
        echo 'Invalid reset link.';
    }
    ?>
</body>
</html>
