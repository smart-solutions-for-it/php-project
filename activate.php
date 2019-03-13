<?php
require_once 'config.php';
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $result = mysqli_query($link, "SELECT * FROM users WHERE email='$email'")
    or die(mysqli_error($link));
    $user = mysqli_fetch_assoc($result);
    $activation_link = "http://" . $site_name . "?page=verify&email=" . $email . "&hash=" . $user['hash'];
    $title = 'Account Verification. From: ' . $site_name;
    $from = 'From:My PHP Project: ' . $site_name;
    $goto_mail = substr($email, strpos($email, '@') + 1);
    $message = 'Hi, ' . $name . '!<br>
            Thanks for registration in ' . $site_name . '<br>
            Now we would like you to activate your account by clicking the link below<br>
            Activation link: <b>' . $activation_link . '</b>';
    mail($email, $title, $message);
    $_SESSION['success_message'] = 'Conformation link for activation your account has been 
sent to <b>' . $email . '.</b><br>
<a href="' . $goto_mail . '">Click here to go to ' . $goto_mail . '</a><br>
<a href="' . $activation_link . '">Click here (временное решение)</a>
';
    header('Location: /?page=success');
} else {
    $_SESSION['error_message'] = 'Something is going wrong. Email does not exist in session';
    header('Location: /?page=error');
}


?>
