<?php
if (!empty($_SESSION['logged_in']) && isset($_SESSION['email'])) {
    $_SESSION['logged_in'] = null;
    $_SESSION['success_message'] = 'There was successfully logout for user with email <b>'
        . $_SESSION['email'];
    header('Location:?page=success');
} else {
    $_SESSION['error_message'] = 'We have some problems with logout. Try it again';
    header('Location:?page=error');
}

?>
