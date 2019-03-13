<?php
require_once 'config.php';
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = mysqli_real_escape_string($link, $_GET['page']);
    $result = mysqli_query($link, "SELECT * FROM pages WHERE name='$page'");
    if (mysqli_num_rows($result) == 0) {
        include_once 'page-not-found.php';
    } else {
        $page_name = mysqli_fetch_assoc($result)['name'];

        include_once $page_name . ".php";
    }
} else {
    include_once 'home.php';
}

?>
