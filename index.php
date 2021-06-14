<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Чат</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link href="html/reg.css" rel="stylesheet">
<script src='jquery-3.6.0.min.js'></script>

</head>
<body>
    <form id = "form" class="container justify-content-center">
    <label class="form-label">Авторизация</label>
        <div class="mb-3">
          <label class="form-label">Логин:</label>
          <input type="text" name = "login" class="form-control">
          <div class="form-text"></div>
        </div>
        <div class="mb-3">
          <label class="form-label">Пароль:</label>
          <input type="password" name = "password" class="form-control">
        </div>
        <input type="submit" name="send" value="Войти">
        <p><a href="html/registration.html">Регистрация</a></p>
      </form>
</body>
</html>

<script>
    $(document).ready(function() {
        $("#form").submit(function(event) {
            event.preventDefault();
        $.ajax({
            url: 'authorization.php',
            method: 'post',
            dataType: 'html',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(result){
                //alert(result);
                if(result != 0){
                    document.location.href="chats.php?login=" + result;
                } else {
                    alert("Неправильный логин или пароль, или ты просто не заегистрировался");
                }

            },
        });

    });
});
   
    </script>