<?php
session_start();
include_once "../config.php";
$uniq_id = $_SESSION['unique_id'];
$friend = $_GET['friend'];
$query = mysqli_query($conn, "DELETE FROM friendships WHERE accepted = 1 AND (sender = {$friend} AND receiver = {$uniq_id}) OR (sender = {$uniq_id} AND receiver = {$friend})");
if ($query) {
    header('location: ../../users.php');
}