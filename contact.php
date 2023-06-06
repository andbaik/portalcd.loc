<?php
include_once 'block/header.php';
$title = 'Форма обратной связи';
include_once 'block/conect_db.php';
$date_now = date("d.m.Y");
$query = $pdo->query('SELECT * FROM `regulations` JOIN `railways` ON regulations.id_railways = railways.id_railway');
?>

<main class="main">
    <div class="container">
        <h1>Форма обратной связи</h1>
        <form action="#">
            <label for="name">Ваше имя</label>
            <input type="text" id="name" placeholder="Укажите ваше имя">
            <label for="mail">Электронная почта</label>
            <input type="mail" id="mail" name="name" placeholder="Укажите электронную почту">
            <label for="text">Задайте вопрос или оставьте сообщение:</label>
            <textarea id="text" name="text" rows="7"> </textarea>
            

            <div class="error-mess" id="error-block"></div>
            <div class="info">
                <button type="button" id="send">Отправить</button>
                <button type="button" id="history-button">Назад</button>
            </div>
        </form>
    </div>
</main>
<?php include_once("block/footer.php"); ?>

<script>
        $('#send').click(function() {
            let name = $('#name').val();
            let mail = $('#mail').val();
            let text = $('#text').val();

            $.ajax({
                url: 'ajax/send_mess.php',
                type: 'POST',
                cache: false,
                data: {
                    'name': name,
                    'mail': mail,
                    'text': text
                },
                dataType: 'html',
                success: function(data) {
                    console.log(data);
                    if (data == 1) {
                        $("#send").text("Сообщение отправлено");
                        $("#error-block").hide();
                        setTimeout(window.location.replace("index.php"), 8000);
                        ;
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