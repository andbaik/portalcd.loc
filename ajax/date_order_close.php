<?php
$date_rem = trim(filter_var($_POST['date_rem'], FILTER_SANITIZE_SPECIAL_CHARS));
$id_even = $_POST['eventsid'];


if ($date_rem == NULL){
    $error = 'Вы не выбрали дату!';
    
    if ($error != '') {
        echo $error;
        exit();
    }
}
/*
include_once '../block/conect_db.php';

        $query = $pdo->prepare("UPDATE regulations SET rem_control=? WHERE id = ?");
        $query->execute([$date_rem, $id]);
   */
  echo 'DATE_ID_ EVEN ' . $id_even;

echo '1';
