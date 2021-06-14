<?php
	   
	   // Переменные с формы
   $login = $_POST['login'];
   $password = $_POST['password'];

		   
$mysqli = new mysqli('localhost', 'admin', 'paroll', 'chatik');

// Проверяем, удалось ли соединение
if (mysqli_connect_errno()) { 
   printf("Connect failed: %s\n", mysqli_connect_error()); 
   exit(); 
}

// Устанавливаем кодировку подключения
$mysqli->set_charset('utf8');

	   $sql = " SELECT login FROM users WHERE login = '$login'";
	   $result = $mysqli->query($sql);
	   debug_to_console(($result)?'Проверка наличия записи выполнена!':'Error : ('. $mysqli->errno .') '. $mysqli->error);
	   $countlogin = $result->num_rows;
	   
	   if($countlogin > 0){
		   echo "Такой логин уже у кого-то есть, придумай другой";
		   
	   } else {
		   $sql = " INSERT INTO users(login, password) VALUES ('$login', '$password')";
		   $result = $mysqli->query($sql);
		   //debug_to_console( ($result)?'Запись пользователя выполнена!':'Ошибка записи : ('. $mysqli->errno .') '. $mysqli->error);
		   echo "Поздравляю такого логина ни у кого нет. Ты можешь входить в наш чат";
		   
	   }


// Закрываем соединение
$mysqli->close();

	   
function debug_to_console($data) {
   $output = $data;
   if (is_array($output))
	   $output = implode(',', $output);

   //echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
?>
