<?php

$id_railways = trim(filter_var($_POST['id_railways'], FILTER_SANITIZE_SPECIAL_CHARS));
$date_given = trim(filter_var($_POST['date_given'], FILTER_SANITIZE_SPECIAL_CHARS));
$num_reg = trim(filter_var($_POST['number_regulations'], FILTER_SANITIZE_SPECIAL_CHARS));
//$path_file = trim(filter_var($_POST['path_file'], FILTER_SANITIZE_SPECIAL_CHARS));
$who_given = trim(filter_var($_POST['who_given'], FILTER_SANITIZE_SPECIAL_CHARS));
$what_violation = trim(filter_var($_POST['what_violation'], FILTER_SANITIZE_SPECIAL_CHARS));
$object = trim(filter_var($_POST['object'], FILTER_SANITIZE_SPECIAL_CHARS));
$term_date = trim(filter_var($_POST['term_date'], FILTER_SANITIZE_SPECIAL_CHARS));
$ip_add_new = trim(filter_var($_POST['ip_add_new'], FILTER_SANITIZE_SPECIAL_CHARS));
$id_user = trim(filter_var($_POST['id_user'], FILTER_SANITIZE_SPECIAL_CHARS));
$ip_add_new = ip2long($ip_add_new);

$ip_2 = long2ip($ip_add_new); /* Преобразование IP адреса в число*/
$date = date('Y-m-d');

//echo "IP2 = " . $ip_2; /*преобразование числа в ip адрес*/

if (empty($id_railways ) || empty($date_given) || empty($num_reg)  || empty($who_given)  || empty($what_violation)  || empty($object) || empty($term_date)  || empty($ip_add_new )) {
    $error = "Проверьте и заполните все графы где есть * !";
}
if ($error != '') {
    echo $error;
    exit();
}

include_once '../block/conect_db.php';


try {
    include_once '../block/conect_db.php';
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $query = $pdo->prepare("INSERT regulations SET `id_railways`=?, `date_given`=?, `number_regulations`=?, `who_given`=?, `what_violation`=?, `object`=?, `term_date`=?, `id_user_new`=?,`ip_add_new`=?, `date_new`=?");
    $query->execute([$id_railways, $date_given, $num_reg, $who_given, $what_violation, $object, $term_date, $id_user, $ip_add_new, $date]);

    $info = $pdo->errorInfo();
                print_r($info);
} catch (Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}

