<?php
session_start(); 

$login = $_SESSION['login'];
$id_chat = $_GET[id_chat];

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

$sql_get_messages = "SELECT * FROM `messages` WHERE id_chat = '$id_chat' ORDER BY time";
$result2 = $mysqli->query($sql_get_messages);

while($messages_result = mysqli_fetch_assoc($result2)) {
    $messages['user_in'][] = $messages_result['user_in'];
    $messages['time'][] = $messages_result['time'];
    $messages['text'][] = $messages_result['text'];
        
}
//echo $messages;
// Формируем масив данных для отправки
$out = array(
    'login' => $login,
    'login_in' => $login_in,
	'messages' => $messages
);

// Устанавливаем заголовот ответа в формате json
header('Content-Type: text/json; charset=utf-8');

// Кодируем данные в формат json и отправляем
echo json_encode($out);
?>