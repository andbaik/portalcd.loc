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
                <button id="add_files"><?=$btn_edit?></button>
            </div>
        </form>
    </div>
</div>

<div class="container">
    <h1><?= $title ?></h1>

    <div class="form_files">
    <form action="#">
            <label for="date_rem">Укажите дату снятия с контроля в АС РБ КН (предписания): </label>
            <input type="date" id="date_rem">
            
            <div class="info">
                <div class="error-mess" id="error-block"></div>
                <button type="button" id="date">Снять с контроля</button>
            </div>
        </form>
    </div>
</div>