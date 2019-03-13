<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['email'])) {
        $_SESSION['error_message'] = 'Email is required. Enter your email first';
        header("Location: /?page=error");
    } else if (strlen($_POST['password']) < 6 || strlen($_POST['password']) > 20) {
        $_SESSION['error_message'] = 'Passwords must contain from 6 to 20 characters';
        header("Location: /?page=error");
    } else if ($_POST['password'] != $_POST['confirm_password']) {
        $_SESSION['error_message'] = 'Password and Confirm password dont match';
        header("Location: /?page=error");
    } else {
        $email = mysqli_real_escape_string($link, trim($_POST['email']));
        $result = mysqli_query($link, "SELECT * FROM users WHERE email='$email'")
        or die(mysqli_error($link));
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error_message'] = 'User with email <b>' . $email . '</b> has already existed. Enter another email';
            header("Location: /?page=error");
        } else {
            $password = mysqli_real_escape_string($link, password_hash($_POST['password'], PASSWORD_BCRYPT));
            $hash = md5(rand(0, 1000));
            $name = mysqli_real_escape_string($link, $_POST['name']);
            $surname = mysqli_real_escape_string($link, $_POST['surname']);
            $query = "INSERT INTO users (email, password, hash, name, surname, registration_date) 
            VALUES ('$email', '$password', '$hash', '$name', '$surname', NOW())";
            mysqli_query($link, $query) or die (mysqli_error($link));
            $_SESSION['name'] = !empty($name) ? $name : 'Anonym';
            $_SESSION['surname'] = $surname;
            $_SESSION['email'] = $email;
            $_SESSION['active'] = 0;
            $_SESSION['status'] = 2;
            $_SESSION['logged_in'] = true;
            $_SESSION['success_message'] = 'Thanks for registration,'.$name.'!<br>
Conformation link for activation your account has been sent to <b>' . $email . '
 </b><br>
 <a href="http://' . $site_name . '?page=verify&email=' . $email . '&hash=' . $hash . '">
 Click here to activate your account</a>';
            $title = 'Account Verification. From: ' . $site_name;
            $message = 'Hi, ' . $name . '!<br>
            Thanks for registration in ' . $site_name . '<br>
            Now we would like you to activate your account by clicking the link below<br>
            Activation link: <b>http://' . $site_name . '?page=verify&email=' . $email . '&hash=' . $hash . '</b>';
            header("Location: /?page=success");
        }
    }
}
?>
<form action="" method="post">
    <div class="form-group row">
        <div class="col-md-6">
            <label>Email</label>
            <input type="email" name="email" class="form-control form-control-lg">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label>Password <span class="small text-danger">from 6 to 20 characters</span> </label>
            <input type="password" name="password" class="form-control form-control-lg">
        </div>
        <div class="col-md-6">
            <label>Confirm password <span class="small text-danger">must correspond with a password</span></label>
            <input type="password" name="confirm_password" class="form-control form-control-lg">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label>Name</label>
            <input type="text" name="name" class="form-control form-control-lg">
        </div>
        <div class="col-md-6">
            <label>Surname</label>
            <input type="text" name="surname" class="form-control form-control-lg">
        </div>
    </div>

    <input type="submit" class="btn btn-outline-primary">
    <input type="reset" class="btn btn-outline-secondary">
</form>
