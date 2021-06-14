<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Чат</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src='jquery-3.6.0.min.js'></script>

</head>



<?php
$login = $_GET['login'];
//echo $login;
echo "<h3>Привет: @$login</h3>";
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">';
echo "<script src='jquery-3.6.0.min.js'></script>";
echo "<script src='chats.js'></script>";
echo "<link rel='stylesheet' href='html/chatsstyle.css'>";
?>
<body>
    <p><a href="index.php">Выйти</a></p>
    <form id = "form" class="container justify-content-center">
        <div id = "formdiv" class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Поиск пользователя:</label><br>
          <input type="text" name = "searchLogin" id = "login" class="form-control" aria-describedby="emailHelp">
          <input type="submit" name="send" value="Найти">
        </div>  
    </form>
<div class = "container justify-content-center yourChats">

<?php
$mysqli = new mysqli('localhost', 'admin', 'paroll', 'chatik');

// Проверяем, удалось ли соединение
if (mysqli_connect_errno()) { 
    printf("Connect failed: %s\n", mysqli_connect_error()); 
    exit(); 
}
$mysqli->set_charset('utf8');
	$sql = " SELECT id_chat, (user_out) AS log, user_in as chat, time_mes FROM chats WHERE user_out = '$login'
	UNION
	SELECT id_chat, (user_in) AS log, user_out as chat, time_mes FROM chats WHERE user_in = '$login'";
		$result = $mysqli->query($sql);
		
		
        if (!$mysqli->query($sql)) {
            echo "Сообщение ошибки: %s\n", $mysqli->error;
        } else {
            echo "<p>Твои чаты:</p>";
		    while($chats = mysqli_fetch_assoc($result)) {
			    echo "<div id = '{$chats['id_chat']}' class='container-fluid chats_class'>@{$chats['chat']} </div>";
		    
		    }
        }
?>

</div>
</body>
</html>
<script>
    $(document).ready(function() {
        $("#form").submit(function(event) {
            event.preventDefault();
            
        $.ajax({
            url: '/searchMessages.php',
            method: 'post',
            dataType: 'html',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(result){
                //alert(result);
                $(result).prependTo($(".yourChats"));

                $(document).ready(function(){
                    $('.searchLogin').click(function() {
                        var clickId = $(this).attr('id');
                        document.location.href="html/messages.html?id_chat=" + clickId;

                    });
                });

            },
        });

    });
});
</script>