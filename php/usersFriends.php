<?php
session_start();
include_once "config.php";
$output = "";
$outgoing_id = $_SESSION['unique_id'];
$unique_id = $_SESSION['unique_id'];
$all_ids_friends = array();
$ids_friends = array();
$query1 = mysqli_query($conn, "SELECT * FROM friendships WHERE sender = {$unique_id} AND accepted = 1");
$query2 = mysqli_query($conn, "SELECT * FROM friendships WHERE receiver = {$unique_id} AND accepted = 1");
if (mysqli_num_rows($query1) == 0 and mysqli_num_rows($query2) == 0) {
    $output = 'Você não tem nenhum amigo!';
} else {
    if (mysqli_num_rows($query1) > 0) {
        while ($row1 = mysqli_fetch_assoc($query1)) {
            array_push($all_ids_friends, $row1['receiver']);
        }
    }
    if (mysqli_num_rows($query2) > 0) {
        while ($row2 = mysqli_fetch_assoc($query2)) {
            array_push($all_ids_friends, $row2['sender']);
        }
    }
    array_unique($all_ids_friends);
    for ($i=0; $i < sizeof($all_ids_friends); $i++) { 
        if ($all_ids_friends[$i] != $unique_id) {
            array_push($ids_friends, $all_ids_friends[$i]);
        }
    }
    for ($i=0; $i < sizeof($ids_friends); $i++) { 
        $id_friend = $ids_friends[$i];
        $query3 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$id_friend}");
        while($row = mysqli_fetch_assoc($query3)){
            $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                    OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                    OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
            (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="Nenhuma messagem disponível";
            (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
            if(isset($row2['outgoing_msg_id'])){
                ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "Você: " : $you = "";
            }else{
                $you = "";
            }
            ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
            ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";
            $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'"id="userProfile">
                        <div class="content">
                        <img src="php/images/'. $row['img'] .'" alt="">
                        <div class="details">
                            <span>'. $row['fname']. " " . $row['lname'] .'</span>
                            <p>'. $you . $msg .'</p>
                        </div>
                        </div>
                        <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                        <a href="php/mecanicalInvites/deleteFriend.php?friend='.$row['unique_id'].'" style="cursor:default;"><button class="invites" onclick="removeList()"><i class="fas fa-user-minus"></i></button></a>
                    </a>';
            }
    }
}

echo $output;
?>
<style>
.invites{
  display: block;
  background: rgba(0,0,0,0.3);
  color: #fff;
  outline: none;
  border: none;
  padding: 7px 15px;
  text-decoration: none;
  border-radius: 5px;
  font-size: 17px;
}
.invites:hover{
    opacity: 0.6;
}
#userProfile:hover{
    opacity: 0.8;
}
</style>