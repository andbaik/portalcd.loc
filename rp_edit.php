<?php
include_once 'block/header.php';
$edit = ($_GET['edit']) ? ($_GET['edit']) : 0;
$id = ($_GET['id']) ? $_GET['id'] : 0;
echo "edit=$edit id=$id";


$title = 'Добавление данных по РП';
include_once 'block/conect_db.php';
$date_now = date("d.m.Y");
$query = $pdo->query('SELECT * FROM `regulations` JOIN `railways` ON regulations.id_railways = railways.id_railway');

switch ($edit) {
    case '1':
        $title = 'Добавление файла [отчета в РБ]';
        $btn_edit = 'Добавить файл';
        $btn_id = 'edit_file';
        $btn_txt = 'Файл добавлен';
        break;
    case '2':
        $title = 'Снять с контроля';
        $btn_edit = 'Снять с контроля';
        $btn_id = 'edit_date';
        $btn_txt = 'Дата установлена';
        break;
    default:
        $title = 'Что-то пошло не так!';
        $btn_edit = 'Сообщить администратору';
        $btn_id = 'error';
        break;
};

?>

<main class="main">
    <div class="container">
        <h1><?= $title ?></h1>
        <?php
        if ($edit == 1) {
            include_once('html/add_doc_rp.html');
        }else {
            include_once('html/add_date_rp.html');
        }
        ?>
    </div>
</main>

<?php include_once("block/footer.php"); ?>

<script>
    $("form#data").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: 'ajax/form.php',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    $("#user_reg").text("<?=$btn_txt?>");
                    $("#error-block").hide();
                    window.location.replace("rp.php");
                    //header('Location:http://portalcd.loc/todo.php');
                    document.location.reload(true);
                    exit;
                } else {
                    $("#error-block").show();
                    $("#error-block").text(data);
                }
            }

        });
    });

        //Ищем какой ID записи
    let searchParams = new URLSearchParams(window.location.search);
    searchParams.has('id');
    let id = searchParams.get('id');

    // обработка даты
    $('#edit_date').click(function() {
            
            let date_rem = $('#date_rem').val();

            $.ajax({
                url: 'ajax/date_rem.php',
                type: 'POST',
                cache: false,
                data: {
                    'id': id,
                    'date_rem': date_rem,
                },
                dataType: 'html',
                success: function(data) {
                    console.log(data);
                    if (data == 1) {
                        $("#edit_date").text("Дата записана");
                        $("#error-block").hide();
                        window.location.replace("rp.php");
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