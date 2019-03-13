<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = mysqli_real_escape_string($link, trim($_POST['email']));
        $result = mysqli_query($link, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($result) == 0) {
            $_SESSION['error_message'] = 'users with email <b>' . $email . '</b> does not exist';
            header('Location: ?page=error');
        } else {
            $user = mysqli_fetch_assoc($result);
            $res = mysqli_real_escape_string($link, password_hash($_POST['password'], PASSWORD_BCRYPT));
            if (password_verify($_POST['password'], $user['password'])) {
                $_SESSION['name'] = $user['name'];
                $_SESSION['surname'] = $user['surname'];
                $_SESSION['email'] = $email;
                $_SESSION['active'] = $user['active'];
                $_SESSION['status'] = $user['status_id'];
                $_SESSION['logged_in'] = true;
                header("Location: /?page=profile");
            } else {
                $_SESSION['error_message'] = 'You entered wrong password. Try again';
                header("Location: /?page=error");
            }
        }
    } else {
        $_SESSION['error_message'] = 'You did not enter your email or password';
        header("Location: /?page=error");
    }

}
?>
<form action="" method="post" class="col-md-6">
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control form-control-lg">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control form-control-lg">
    </div>
    <input type="submit" value="Logged In" class="btn  btn-outline-primary mr-3">
    <a class="btn btn-link text-secondary" href="?page=forgot">Forgot password?</a>
</form>

