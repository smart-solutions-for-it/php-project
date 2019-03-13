<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (strlen($_POST['new_password']) < 6 || strlen($_POST['new_password']) > 20) {
        $_SESSION['error_message'] = 'Password must contain 6 to 20 characters';
        header('Location:?page=error');
    } else if ($_POST['new_password'] != $_POST['confirm_password']) {
        $_SESSION['error_message'] = 'Password and Confirm password do not correspond.
         Try again';
        header('Location:?page=error');
    } else {
        $new_password = mysqli_real_escape_string($link, password_hash($_POST['new_password'], PASSWORD_BCRYPT));
        $hash = $_POST['hash'];
        $email = $_POST['email'];
        mysqli_query($link, "UPDATE users SET password ='$new_password'
        WHERE email ='$email' AND hash ='$hash'") or die (mysqli_error($link));
        $_SESSION['success_message'] = 'Password has been reset successfully. <br>
         To try log in again click the link below:<br>
          <a href="?page=login" class="btn btn-link">Log In</a>';
        header('Location: ?page=success');
    }
} else {
    $_SESSION['error_message'] = 'You did not enter a password for change. Try it again';
    header('Location:?page=error');
}


?>
