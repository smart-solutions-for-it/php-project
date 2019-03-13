<?php
session_start();
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Project</title>
    <style>
        .logo {
            max-width: 100px;
        }

        body {
            padding: 20px;
        }

        section {
            height: 600px;
        }

        footer {
            height: 50px;
        }
    </style>
</head>
<body>
<div class="container">
    <header class="row">
        <div class="col-md-8">
            <a href="?page=home"><img src="./images/php.png" alt="php project" class="logo"></a>
            <h1 class="text-primary text-left d-inline align-middle">PHP Project</h1>
        </div>
        <div class="col-md-4 text-right">
            <?php
            if (!empty($_SESSION['logged_in'])) {
                $email = $_SESSION['email'];
                $result = mysqli_query($link, "SELECT name, surname, photo FROM users WHERE email='$email'")
                or die (mysqli_error($link));
                $user = mysqli_fetch_assoc($result) or die (mysqli_error($link));
                echo '<h5 class="text-primary">Welcome, <b>' . $user['surname'] . ' ' . $user['name'] . '</b></h5>
                   <div class="btn-group">
                   <a href="?page=profile" class="btn btn-link">Profile</a>
                   <a href="?page=logout" class="btn btn-link">Logout</a>
                   </div>
                   <img style="width:50px" src="' . $user['photo'] . '" alt="' . $user['name'] . '" class="rounded-circle">';
            } else {
                echo '      
            <div class="btn-group">
                <a href="?page=login" class="btn btn-link">Log In</a>
                <a href="?page=register" class="btn btn-link">Register</a>
            </div>';
            }
            ?>
        </div>
    </header>
    <hr>
    <section class="row">
        <aside class="col-md-3 col-md-offset-1">
            <nav>
                <ul class="list-group" id="menu">
                    <a href="?page=home">
                        <li class="list-group-item">Home</li>
                    </a>
                    <a href="?page=about">
                        <li class="list-group-item">About</li>
                    </a>
                    <a href="?page=history">
                        <li class="list-group-item">History</li>
                    </a>
                    <a href="?page=blog">
                        <li class="list-group-item">Users blog</li>
                    </a>
                    <a href="?page=feedback">
                        <li class="list-group-item">Feedback</li>
                    </a>
                </ul>
            </nav>
        </aside>
        <main class="col-md-8 text-secondary">
            <!-- Navigator php -->
            <?php include 'navigator.php'; ?>
        </main>
    </section>

    <footer class="row mt-5 bg-primary align-middle">
        <div class="col-md-12 text-center text-white ">
            &copy Nitsenko Vladimir | 2019 <br>
            email: nicenkovladimir@gmail.com
        </div>
    </footer>
</div>
</body>
</html>


