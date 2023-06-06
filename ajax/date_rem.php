<?php
include_once '../block/conect_db.php';

$id = trim(filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS));
$date_rem = trim(filter_var($_POST['date_rem'], FILTER_SANITIZE_SPECIAL_CHARS));

$query_report = $pdo->query("SELECT `what_closed_report` FROM `regulations` WHERE `id_regulations`=$id");
$records = $query_report->fetchAll();

//print_r ($query_report);



/*
echo "ID= $id";
echo "DATE= $date_rem";
echo gettype($date_rem);
*/
$date_now = date("d-m-Y");
$rem_date = date('d.m.Y', strtotime($date_rem));
$seconds = abs(strtotime($date_now) - strtotime(($rem_date)));
$date_diff = round($date_now - $rem_date) * -1;


$preg_name = '/^[0-9]{4}|[0-9]{2}|[0-9]{2}$/';


    if (!preg_match($preg_name, $date_rem))
        $error = 'Не выбрана дата!';
    elseif(empty($id))
        $error = 'Не определился ID предписания!';
    elseif($seconds<0)
        $error = 'Не корректно указана дата снятия предписания!';
    elseif(empty($records))
        $error = 'Вы не приложили направленный в РБ отчет';

    if ($error != '') {
        echo $error;
        exit();
    }

    try{
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $query = $pdo->prepare("UPDATE regulations SET `rem_control`=? WHERE `id_regulations`=?");
        $query->execute([$date_rem, $id]);
        
        
        //$info = $pdo->errorInfo();
        //print_r($info);
}
catch(Exception $e){
    echo 'Exception -> ';  
    var_dump($e->getMessage());
}


echo '1';


