<?php
session_start();
include_once "config.php";
$output = "";
$outgoing_id = $_SESSION['unique_id'];
$unique_id= $_SESSION['unique_id'];
$ids_receivers = array();
$users = array();
$all_ids_friends = array();
$query1 = mysqli_query($conn, "SELECT * FROM friendships WHERE sender = {$unique_id}");
$query2 = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$unique_id} ORDER BY user_id DESC");
$query3 = mysqli_query($conn, "SELECT * FROM friendships WHERE sender = {$unique_id} AND accepted = 1");
$query4 = mysqli_query($conn, "SELECT * FROM friendships WHERE receiver = {$unique_id} AND accepted = 1");
if (mysqli_num_rows($query3) > 0) {
    while ($row1 = mysqli_fetch_assoc($query3)) {
        array_push($all_ids_friends, $row1['receiver']);
    }
}
if (mysqli_num_rows($query4) > 0) {
    while ($row2 = mysqli_fetch_assoc($query4)) {
        array_push($all_ids_friends, $row2['sender']);
    }
}
while ($row1 = mysqli_fetch_assoc($query1)) {
    array_push($ids_receivers, $row1['receiver']);
}
while ($row2 = mysqli_fetch_assoc($query2)) {
    array_push($users, $row2['unique_id']);
}
$size = sizeof($users);
$ids = array();
for ($i=0; $i < $size; $i++) { 
    if (!in_array($users[$i], $ids_receivers) and !in_array($users[$i], $all_ids_friends)) {
        array_push($ids, $users[$i]);
    }
}
if (sizeof($ids) == 0) {
    $output = 'Nenhum usuário online!';
} else {
    for ($i=0; $i < sizeof($ids); $i++) { 
        $uniqId = mysqli_real_escape_string($conn, $ids[$i]);
        $query = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$uniqId} ORDER BY user_id DESC");
        while($row = mysqli_fetch_assoc($query)){
            $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                    OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                    OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
            (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="";
            (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
            if(isset($row2['outgoing_msg_id'])){
                ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "Você: " : $you = "";
            }else{
                $you = "";
            }
            ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
            ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";
            $output .= '<a href="#" style="cursor:default;">
                        <div class="content" style="cursor:default;">
                        <img src="php/images/'. $row['img'] .'" alt="" style="cursor:default;">
                        <div class="details" style="cursor:default;">
                            <span>'. $row['fname']. " " . $row['lname'] .'</span>
                            <p>'. $you . $msg .'</p>
                        </div>
                        </div>
                        <div class="status-dot '. $offline .'" style="cursor:default;"><i class="fas fa-circle"></i></div>
                        <a href="php/mecanicalInvites/request.php?receiver='.$row['unique_id'].'" style="cursor:default;"><button class="invites" onclick="adicionarList()"><i class="fas fa-user-plus"></i></button></a>
                    </a>
                    ';
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
</style>