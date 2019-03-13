<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['status']) && !empty($_POST['banned'])) {
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $surname = mysqli_real_escape_string($link, $_POST['surname']);
        $status = mysqli_real_escape_string($link, $_POST['status']);
        $banned = mysqli_real_escape_string($link, $_POST['banned']);
        if ($status!='admin' OR $status!='user') {
            $_SESSION['error_message'] = 'Incorrect data. Status field should be either <b>admin</b> or <b>user</b>';
            header('Location: /?page=error');
        }
        if ($banned!=1 OR $banned!=0) {
            $_SESSION['error_message'] = 'Incorrect data. Banned field should be either <b>1</b> or <b>0</b>';
            header('Location: /?page=error');
        }
        mysqli_query($link, "UPDATE users SET name='$name', surname='$surname, banned='$banned', status='$status'");
        $_SESSION['success_message'] = 'Users info has been updated successfully<br>
    <a class="btn btn-link" href="/?page=profile">Go back to profile</a>';
        header('Location: /?page=success');
    }
    else {
        $_SESSION['error_message'] = 'You are supposed to fill out all the fields. Try again';
        header('Location: /?page=error');
    }
}
else {
    header('Location: /');
}
?>
