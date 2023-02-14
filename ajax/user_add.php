<?php

$user_id = trim(filter_var($_POST['user_id'], FILTER_SANITIZE_SPECIAL_CHARS));
$edit = trim(filter_var($_POST['edit'], FILTER_SANITIZE_SPECIAL_CHARS));
$surname = trim(filter_var($_POST['surname'], FILTER_SANITIZE_SPECIAL_CHARS));
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$patronomic = trim(filter_var($_POST['patronomic'], FILTER_SANITIZE_SPECIAL_CHARS));
$room = trim(filter_var($_POST['room'], FILTER_SANITIZE_SPECIAL_CHARS));
$telephone = trim(filter_var($_POST['telephone'], FILTER_SANITIZE_SPECIAL_CHARS));
$telephone_s = trim(filter_var($_POST['telephone_s'], FILTER_SANITIZE_SPECIAL_CHARS));
$telephone_f = trim(filter_var($_POST['telephone_f'], FILTER_SANITIZE_SPECIAL_CHARS));
$telephone_m = trim(filter_var($_POST['telephone_m'], FILTER_SANITIZE_SPECIAL_CHARS));
$post = trim(filter_var($_POST['post'], FILTER_SANITIZE_SPECIAL_CHARS));
$depat = trim(filter_var($_POST['depat'], FILTER_SANITIZE_SPECIAL_CHARS));
$branch = trim(filter_var($_POST['branch'], FILTER_SANITIZE_SPECIAL_CHARS));
$date_br = trim(filter_var($_POST['date_br'], FILTER_SANITIZE_SPECIAL_CHARS));
$sort = trim(filter_var($_POST['sort'], FILTER_SANITIZE_SPECIAL_CHARS));
$admin_branch = trim(filter_var($_POST['admin_branch'], FILTER_SANITIZE_SPECIAL_CHARS));

if (empty($surname) || empty($name) || empty($patronomic) || empty($room)  || empty($telephone)  || empty($post)  || empty($depat) || empty($branch)  || empty($sort)) {
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

    $query = $pdo->prepare("UPDATE adressbook SET `surname`=?, `name`=?, `patronymic`=?, `room`=?, `telephone`=?, `telephone_s`=?, `telephone_f`=?, `telephone_m`=?, `id_post`=?, `id_depat`=?, `id_branch`=?, `date_br`=?, `id_sort`=?, `id_admin_branch`=?  WHERE `id_user`=?");
    $query->execute([$surname, $name, $patronomic, $room, $telephone, $telephone_s, $telephone_f, $telephone_m, $post, $depat, $branch, $date_br, $sort, $admin_branch, $user_id]);

    $info = $pdo->errorInfo();
                print_r($info);
} catch (Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}



echo '1';
