<?php
if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) {
    $message = $_SESSION['success_message'];
} else {
    header('Location: ?page=home');
}
?>
<div class="card">
    <h5 class="card-header text-success"><b>Success message</b></h5>
    <div class="card-body">
        <p class="card-text text-success"><?php echo $message ?></p>
        <a href="?page=home" class="btn btn-outline-success">Go home</a>
    </div>
</div>
