<?php
$title = 'Страница аторизации пользователя';
include_once('block/header.php');

?>
<div class="main">
    <div class="container">
        <h1>Страница авторизации пользователя:</h1>
        <?php include 'html/author.html'?>


    </div>
</div>
<?php include_once 'block/footer.php' ?>

<script>
    $('#user_auth').click(function() {

        let login = $('#login_in').val();
        let password = $('#password_in').val();

        $.ajax({
            url: 'ajax/user_auth.php',
            type: 'POST',
            cache: false,
            data: {
                'login': login,
                'password': password,
            },
            dataType: 'html',
            success: function(data) {
                if (data == 1) {
                    $("#user_reg").text("Вы авторизованы!");
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