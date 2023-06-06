<?php
include 'block/header.php';

$edit = ($_GET['edit']) ? ($_GET['edit']) : 0;
$id = ($_GET['id']) ? $_GET['id'] : 0;

echo "edit=$edit id=$id";

include_once('block/conect_db.php');

$query = $pdo->query("SELECT * FROM regulations WHERE id_regulations = $id");
$row = $query->fetch(PDO::FETCH_OBJ);

switch ($edit) {
    case '1':
        $title = 'Добавление файлов';
        $btn_edit = 'Добавить файлы';
        break;
    case '2':
        $title = 'Снять с контроля';
        $btn_edit = 'Снять с контроля';
        break;
    default:
        $title = 'Что-то пошло не так!';
        $btn_edit = 'Сообщить администратору';
        break;
};
?>
<div class="container">
    <h1><?= $title ?></h1>

<?php
    if ($edit == 1){
        //include_once ('html/add_doc_rp.html');
        echo <<<END
        <div class="form_files">
            <form class="files" id="data-files" method="POST" enctype="multipart/form-data">
                <label for="telegrama">В случае направления телеграммы, прикрепите файл: </label>
                <input type="file" id="telegrama">
                <label for="protocol">Если проведен разбор нарушений, прикрепите файл: </label>
                <input type="file" id="protocol">
                <label for="report">Прикрепите отчет, который был направлен для снятия с контроля предписание: </label>
                <input type="file" id="report">

                <div class="info">
                    <div class="error-mess" id="error-block"></div>
                    <button class="form_sub" id="add_files">$btn_edit</button>
                </div>
            </form>
        </div>
</div>
END;
}else{
        include_once ('html/add_date_rp.html');
    }
?>
<?=include_once("block/footer.php");?>
<script>
        $.ajax({
            type: "POST", //указываем что метод отправки POST
            url:"ajax/form.php", // указываем адрес обработчика
            data:$('.files').serialize(), //указываем данные которые будут передаваться обработчику
            /* Мы указываем id формы - $('#callbacks'), и методом serialize() забираем значения всех полей. */
               
        });

</script>