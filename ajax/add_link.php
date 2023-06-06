
<?php
$shot_name = trim(filter_var($_POST['shot_name'], FILTER_SANITIZE_SPECIAL_CHARS));
$nameLink = trim(filter_var($_POST['nameLink'], FILTER_SANITIZE_SPECIAL_CHARS));
$link = trim(filter_var($_POST['link'], FILTER_SANITIZE_SPECIAL_CHARS));


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

$query = $pdo->prepare("INSERT INTO links SET shot_name=?, nameLink=?, link=?");
$query->execute([$shot_name, $nameLink, $link]);


echo '1';


