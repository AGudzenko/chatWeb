<?php
session_start(); 

$login = $_SESSION['login'];
$searchLogin = $_POST[searchLogin];
//echo $searchLogin;

$mysqli = new mysqli('localhost', 'admin', 'paroll', 'chatik');

// Проверяем, удалось ли соединение
if (mysqli_connect_errno()) { 
    printf("Connect failed: %s\n", mysqli_connect_error()); 
    exit(); 
}
$mysqli->set_charset('utf8');
	$sql = "SELECT * FROM `users` WHERE login = '$searchLogin'";
	$result = $mysqli->query($sql);
	if (!$mysqli->query($sql)) {
            echo "Сообщение ошибки: %s\n", $mysqli->error;
    } else {
            $countlogin = $result->num_rows;
            if($countlogin == 1){
		        $sql = "INSERT INTO `chats`(`user_in`, `user_out`, `time_mes`) VALUES ('$searchLogin', '$login', NOW())";
                $result = $mysqli->query($sql);

                $sqlChat = "SELECT * FROM `chats` WHERE ( user_in = '$login' AND user_out = '$searchLogin') OR (user_in = '$searchLogin' AND user_out = '$login')";
                $resultchat = $mysqli->query($sqlChat);
                if (!$mysqli->query($sqlChat)) {
                    echo "Сообщение ошибки: %s\n", $mysqli->error;
                } else {
                    while($chats = mysqli_fetch_assoc($resultchat)) {
                    echo "<div id = '{$chats['id_chat']}' class='container-fluid chats_class searchLogin'>$searchLogin </div>";
                    }
                }
                  
            } else {
                echo "такого юзера не существует";
            }
    }

            
        
?>