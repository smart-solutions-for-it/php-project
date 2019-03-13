<?php
if (isset($_SESSION['active'])) {
    $active_status = $_SESSION['active'];
    if ($active_status == 0) {
        $_SESSION['error_message'] = '<h5>Your account has not been activated</h5>
        In order to review or change your profile you are 
        supposed to activate your account. Go to your email and click activation link.<br>
        If you did not receive activation link yet click the link below to send it again
         to your email adress<br>
         <a href="/?page=activate">Send me activation link</a>';
        header('Location:/?page=error');
    }
}
?>
<h4> Hello, <?php echo $_SESSION['name']; ?>!</h4>
<hr>
<?php
if ($_SESSION['status'] == 1) {
    include 'users-list.php';
}

?>
