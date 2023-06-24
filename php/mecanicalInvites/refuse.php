<?php
session_start();
include_once "../config.php";
$receiver = $_SESSION['unique_id'];
$sender = $_GET['sender'];
$query = mysqli_query($conn, "DELETE FROM friendships WHERE sender = {$sender} AND receiver = {$receiver}");
if ($query) {
    header('location: ../../users.php');
}