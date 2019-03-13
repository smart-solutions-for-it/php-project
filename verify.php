<?php
require_once 'config.php';
if (!empty($_GET['email']) && !empty($_GET['hash'])) {
    $email = mysqli_real_escape_string($link, $_GET['email']);
    $hash = mysqli_real_escape_string($link, $_GET['hash']);
    $result = mysqli_query($link, "SELECT * FROM users WHERE email='$email'
    AND hash = '$hash' AND active='0'") or die(mysqli_error($link));
    if (mysqli_num_rows($result) == 0) {
        $_SESSION['error_message'] = 'Account has already been activated or incorrect data';
        header('Location: /?page=error');
    } else {
        mysqli_query($link, "UPDATE users SET active='1' WHERE email='$email'")
        or die(mysqli_error($link));
        $_SESSION['active'] = 1;
        $_SESSION['success_message'] = 'Account was activated successfully';
        header('Location: /?page=success');
    }

}

?>
