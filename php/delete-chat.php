<?php
include_once "config.php";
$message_id = mysqli_real_escape_string($conn, $_GET['msg_id']);
$query = mysqli_query($conn, "DELETE FROM messages WHERE msg_id = {$message_id}");
if($query) {
    session_start();
    $user_id = $_SESSION['user_id'];
    header("location: ../chat.php?user_id=$user_id");
}