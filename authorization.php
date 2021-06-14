<?php
session_start(); 
 
$login = $_POST['login'];
$password = $_POST['password'];

$_SESSION['login']=$login;
         
$mysqli = new mysqli('localhost', 'admin', 'paroll', 'chatik');

// Проверяем, удалось ли соединение
if (mysqli_connect_errno()) { 
  printf("Connect failed: %s\n", mysqli_connect_error()); 
  exit(); 
}

// Устанавливаем кодировку подключения
  $mysqli->set_charset('utf8');
  $sql = " SELECT login FROM users WHERE login = '$login' and password = '$password'";
      $result = $mysqli->query($sql);
      

      while($user = mysqli_fetch_assoc($result)) {
          $a = count($user['login']);
          if($a == 1){
              echo $login; 
              exit;
          }else {
              echo 0;
          }
      }


$mysqli->close();
  
?>