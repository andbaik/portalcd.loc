<?php
	//Запускаем сессию
	session_start();

	//Устанавливаем кодировку и вывод всех ошибок
	header('Content-Type: text/html; charset=UTF8');
	//error_reporting(E_ALL);

	//Включаем буферизацию содержимого
	ob_start();

	//Определяем переменную для переключателя
	$mode = isset($_GET['mode'])  ? $_GET['mode'] : false;
	$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;
	$err = array();


$title = 'Страница регистрации пользователей';
include_once('block/header.php');
?>
<div class="main">
    <div class="container">
        <h1>Страница регистрации пользователей:</h1>
        <?php include 'html/registr.html'?>
    </div>
</div>
<?php include_once 'block/footer.php'?>


<script>

    $('#user_reg').click(function() {
        let surname = $('#surname').val();
        let name = $('#name').val();
        let patronomic = $('#patronomic').val();
        let branch = $('#branch').val();
        let post = $('#post').val();
        let login = $('#login').val(); 
        let email = $('#email').val();
        let password = $('#password').val();
        let password2 = $('#password2').val();
        
        
        $.ajax({
            url: 'ajax/user_reg.php',
            type: 'POST',
            cache: false,
            data: {
                'surname': surname,
                'name': name,
                'patronomic': patronomic,
                'branch': branch,
                'post': post,
                'login': login,
                'email': email,
                'password': password,
                'password2': password2

            },
            dataType: 'html',
            success: function(data) {
                if (data == 1) {
                    $("#user_reg").text("Вы зарегистрированы!");
                    $("#error-block").hide();
                    window.location.replace("index.php");
                    /*header('Location:http://portalcd.loc/todo.php');
                    document.location.reload(true);
                    exit;*/
                } else {
                    $("#error-block").show();
                    $("#error-block").text(data);
                }
            }
        });
    });
    /*----Кнопка назад----*/
    document.getElementById('history-button').addEventListener('click', () => {
        history.back();
    });
</script>

</body>

</html>