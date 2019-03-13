<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email'])) {
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $result = mysqli_query($link, "SELECT * FROM users WHERE email='$email'") or die (mysqli_error($link));
        if (mysqli_num_rows($result) == 0) {
            $_SESSION['error_message'] = 'users with email <b>' . $email . '</b> does not exist';
            header('Location: ?page=error');
        } else {
            $user = mysqli_fetch_assoc($result);
            $title = 'Password change';
            $message = 'Hello ' . $user['name'] . '!
You have received this letter since you probable forgot your password.<br>
If you want to change your password please click the lick below: <br>
http://' . $site_name . '?page=reset&email=' . $email . '&hash=' . $user['hash'];
            $from = 'From:My PHP Project: ' . $site_name;
            $hash = $user['hash'];
            $goto_mail = substr($email, strpos($email, '@') + 1);
            mail($email, $title, $message, $from);
            $_SESSION['success_message'] = 'We have just sent you a mail with a link for changing your password.<br>
 Please check out your email <b>' . $email . '</b><br>
 <a target="_blank" href="http://' . $goto_mail . '">Click here to go to ' . $goto_mail . '</a><br>
<a href="http://' . $site_name . '?page=reset&email=' . $email . '&hash=' . $hash . '">
 Press to change your password (временное решение)</a>';
            header('Location: ?page=success');
        }
    } else {
        $_SESSION['error_message'] = 'You did not enter your email. Try again.';
    }
}
?>
<form action="" method="post" class="col-md-6">
    <div class="form-group">
        <label for="">Enter your email</label>
        <input type="email" class="form-control" name="email">
    </div>
    <input type="submit" class="btn btn-primary">
</form>

