<?php
session_start();
include_once "../config.php";
$sender = $_SESSION['unique_id'];
$receiver = $_GET['receiver'];
$query = mysqli_query($conn, "INSERT INTO friendships (sender, receiver, accepted) VALUES ({$sender}, {$receiver}, 0)");
if ($query) {
    header('location: ../../users.php');
}
