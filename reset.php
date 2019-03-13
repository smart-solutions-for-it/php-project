<?php
require_once 'config.php';
if (isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash'])) {
    $email = mysqli_real_escape_string($link, $_GET['email']);
    $hash = mysqli_real_escape_string($link, $_GET['hash']);
    $result = mysqli_query($link, "SELECT * FROM users WHERE email='$email' AND hash = '$hash'");
    if (mysqli_num_rows($result) == 0) {
        $_SESSION['error_message'] = 'Incorrect users parameters';
        header('Location:?page=error');
    } else {
        $user = mysqli_fetch_assoc($result) or die (mysqli_error($link));
    }
} else {
    $_SESSION['error_message'] = 'Incorrect URL or other problems with entered parameters';
    header('Location:?page=error');
}
?>
<form action="?page=reset_password" method="post" class="col-md-6">
    <div class="form-group">
        <label for="">New password <span class="small text-danger">(from 6 to 20 characters)</span></label>
        <input type="password" class="form-control" name="new_password">
    </div>
    <div class="form-group">
        <label for="">Confirm password</label>
        <input type="password" class="form-control" name="confirm_password">
    </div>
    <input type="hidden" name="email" value="<?php echo $email ?>">
    <input type="hidden" name="hash" value="<?php echo $hash ?>">
    <input type="submit" class="btn btn-primary" value="Submit new password">
</form>
