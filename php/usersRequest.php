<?php
session_start();
include_once "config.php";
$output = "";
$outgoing_id = $_SESSION['unique_id'];
$unique_id = $_SESSION['unique_id'];
$query1 = mysqli_query($conn, "SELECT * FROM friendships WHERE receiver = {$unique_id} AND accepted = 0");
if(mysqli_num_rows($query1) == 0){
    $output .= "Nenhum convite!";
}else if(mysqli_num_rows($query1) > 0){
    while ($result = mysqli_fetch_assoc($query1)) {
        $uniq_id = $result['sender'];
        $query3 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$uniq_id}");
    while($row = mysqli_fetch_assoc($query3)){
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";
        $output .= '<a href="#" style="cursor:default;">
                    <div class="content">
                    <img src="php/images/'. $row['img'] .'" alt="" style="cursor:default;">
                    <div class="details" style="cursor:default;">
                        <span>'. $row['fname']. " " . $row['lname'] .'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'" style="cursor:default;"><i class="fas fa-circle"></i></div>
                    <div class="invite" style="cursor:default;">
                    <a href="php/mecanicalInvites/accept.php?sender='.$row['unique_id'].'" style="cursor:default;"><button class="invites" id="yes" style="cursor:default;"><i class="fas fa-user-check"></i></button></a>
                    <a href="php/mecanicalInvites/refuse.php?sender='.$row['unique_id'].'" style="cursor:default;"><button class="invites" id="no" style="cursor:default;"><i class="fas fa-user-times"></i></button></a>
                    </div>
                </a>';          
    }

    }
}
echo $output;
?>
<style>
.invites:hover{
  opacity: 0.6;
}
#yes{
  display: block;
  background: #2ed573;
  color: #fff;
  outline: none;
  border: none;
  padding: 7px 15px;
  text-decoration: none;
  border-radius: 5px;
  font-size: 17px;
}
#no{
  display: block;
  background: #eb4d4b;
  color: #fff;
  outline: none;
  border: none;
  padding: 7px 15px;
  text-decoration: none;
  border-radius: 5px;
  font-size: 17px;
}
</style>