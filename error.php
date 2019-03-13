<?php
if (isset($_SESSION['error_message']) && !empty($_SESSION['error_message'])) {
    $message = $_SESSION['error_message'];
} else {
    header('Location: ?page=home');
}
?>
<div class="card">
    <h5 class="card-header text-danger"><b>Error message</b></h5>
    <div class="card-body">
        <p class="card-text text-danger"><?php echo $message ?></p>
        <button onclick="window.history.back()" class="btn btn-outline-warning text-danger">Go back</a>
    </div>
</div>

