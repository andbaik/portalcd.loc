
<?php
$id = trim(filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS));
$edit = trim(filter_var($_POST['edit'], FILTER_SANITIZE_SPECIAL_CHARS));
$task = trim(filter_var($_POST['task'], FILTER_SANITIZE_SPECIAL_CHARS));
$date = trim(filter_var($_POST['date'], FILTER_SANITIZE_SPECIAL_CHARS));
$who = trim(filter_var($_POST['who'], FILTER_SANITIZE_SPECIAL_CHARS));
$number = trim(filter_var($_POST['number'], FILTER_SANITIZE_SPECIAL_CHARS));
$note = trim(filter_var($_POST['note'], FILTER_SANITIZE_SPECIAL_CHARS));
$zone = trim(filter_var($_POST['zone'], FILTER_SANITIZE_SPECIAL_CHARS));
$date_arch = trim(filter_var($_POST['date_arch'], FILTER_SANITIZE_SPECIAL_CHARS));
$text_status = trim(filter_var($_POST['text_status'], FILTER_SANITIZE_SPECIAL_CHARS));

/*
if ($edit !== 3 || $edit !== 4){
    $error = '';
    if (strlen($task) < 3)
        $error = 'Маленькое задание';
    else if (strlen($who) < 6)
        $error = 'Нет такого человека';

    if ($error != '') {
        echo $error;
        exit();
    }
}*/

include_once '../block/conect_db.php';

switch ($edit){
    case '1': 
        $query = $pdo->prepare("UPDATE todo SET task=?, date=?, who=?, number=?, note=?, zone=? WHERE id = ?");
        $query->execute([$task, $date, $who, $number, $note, $zone, $id]);
    break;
    case '2' : 
        $query = $pdo->prepare("INSERT INTO todo SET task=?, date=?, who=?, number=?, note=?, zone=?");
        $query->execute([$task, $date, $who, $number, $note, $zone]);
    break;
    case '3' :
        $pdo->exec("DELETE FROM todo WHERE id = $id");
    break;
    case '4' :
        $query = $pdo->prepare("UPDATE todo SET date_end=?, status=?, text_status=? WHERE id = ?");
        $query->execute([$date_arch, '1', $text_status, $id]);
    break;
    default :
    echo 'Сломалось!';
    break;
}

echo '1';


