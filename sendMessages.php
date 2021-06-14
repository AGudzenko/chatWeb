<?php
session_start(); 

$login = $_SESSION['login'];
$id_chat = $_GET['id_chat'];
$messegs = $_POST[mes];
//echo $id_chat;
$mysqli = new mysqli('localhost', 'admin', 'paroll', 'chatik');

// Проверяем, удалось ли соединение
if (mysqli_connect_errno()) { 
    printf("Connect failed: %s\n", mysqli_connect_error()); 
    exit(); 
}
$mysqli->set_charset('utf8');
$sql_id_chat = "SELECT user_in, user_out FROM `chats` WHERE id_chat = '$id_chat'";
$result = $mysqli->query($sql_id_chat);

while($id_chats_result = mysqli_fetch_assoc($result)) {
    if($login ==  $id_chats_result['user_in']){
        $login_in = $id_chats_result['user_out'];
    }else {
        $login_in = $id_chats_result['user_in'];
    }
}
//echo $login_in;
$sql = "INSERT INTO `messages`(`id_chat`, `user_in`, `time`, `text`) VALUES ('$id_chat', '$login_in', NOW(), '$messegs')";
                //INSERT INTO `messages`(`id_chat`, `user_in`, `time`, `text`) VALUES ('1', 'lox2', NOW(), 'hi')
        if(!$mysqli->query($sql)){
            printf("Errormessage: %s\n", $mysqli->error);
        } else {
            echo "super";
        }
$mysqli->close();

?>