<?php
session_start();
include_once '../block/conect_db.php';


$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

$password = md5(md5($password));


$error = '';
if (empty($login))
    $error = 'Введите логин';
else if (empty($password))
    $error = 'Введите пароль';
if ($error != '') {
    echo $error;
    exit();
}

try{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //$password = md5(md5($password));
    $query = $pdo->prepare("SELECT * FROM `base_cd`  WHERE `login` = ?");
    $query->execute([$login]);
    $row = $query->fetch(PDO::FETCH_OBJ);

    
    //$info = $pdo->errorInfo();
    //print_r($info);
}
catch(Exception $e){
echo 'Exception -> ';  
var_dump($e->getMessage());
}



if (empty($row))
    $error = 'Логин или пароль введен не верно';
    if ($error != ''){
        echo $error;
        exit();
    }



if ($row->password == $password and $row->status == 1){
        $_SESSION['user'] = [
            "id" => $row->id_user,
            "login" => $row->login,
            "AB_admin_cd" => $row->AB_admin_cd,
            "AB_reader_sot" => $row->AB_reader_sot,
            "AB_admin_raiway" => $row->AB_admin_railway
    ];
    }
    else {$error = 'Пароль введен неверно, или запись еще не активирована!';}
    if ($error != '') {
        echo $error;
        exit();
    }



echo '1';