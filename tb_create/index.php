<?php
require_once '../config.php';
$query_users = "CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(55) NOT NULL,
    password VARCHAR(60) NOT NULL,
    hash VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL DEFAULT 'Anonym',
    surname VARCHAR(50),
    photo VARCHAR(255) DEFAULT 'images/logo.jpg',
    registration_date DATE NOT NULL,
    active BOOLEAN NOT NULL DEFAULT '0',
    banned BOOLEAN NOT NULL DEFAULT '0',
    status_id INT NOT NULL DEFAULT '2'
    )";

$query_statuses = "CREATE TABLE statuses (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   status VARCHAR(20) NOT NULL)";

$query_pages = "CREATE TABLE pages (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(50) NOT NULL)";

$password = password_hash('root', PASSWORD_BCRYPT);
$hash = md5(rand(0, 1000));

mysqli_query($link, $query_users) or die (mysqli_error($link));
echo 'table *users* has succesfully created <hr>';

mysqli_query($link, "INSERT INTO users (email, password, hash, name, surname, 
registration_date, active, banned, status_id) VALUES ('nicenkovladimir@gmail.com', '$password',
'$hash', 'Vladimir','Nitsenko', NOW(),0, 0, 1)") or die (mysqli_error($link));

mysqli_query($link, $query_statuses) or die (mysqli_error($link));
mysqli_query($link, "INSERT INTO statuses (status) VALUES ('admin'), ('user')") or die (mysqli_error($link));
echo 'table *statuses* has succesfully created <hr>';

mysqli_query($link, $query_pages) or die (mysqli_error($link));
echo 'table *pages* has succesfully created <hr>';
mysqli_query($link, "INSERT INTO pages (name) VALUES ('about'), ('feedback'),
('history'), ('home'), ('error'), ('success'), ('login'),( 'logout'),
('register'), ('page-not-found'), ('profile'), ('reset'),
 ('reset_password'), ('verify'), ('blog'), ('activate'), ('forgot')") or die (mysqli_error($link));

echo 'redirecting to index.php...';
header("Refresh:2; url='../'");

