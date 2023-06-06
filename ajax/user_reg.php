<?php
session_start();
include_once '../block/conect_db.php';

$surname = trim(filter_var($_POST['surname'], FILTER_SANITIZE_SPECIAL_CHARS));
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$patronomic = trim(filter_var($_POST['patronomic'], FILTER_SANITIZE_SPECIAL_CHARS));
$branch = trim(filter_var($_POST['branch'], FILTER_SANITIZE_SPECIAL_CHARS));
$post = trim(filter_var($_POST['post'], FILTER_SANITIZE_SPECIAL_CHARS));
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
$password2 = trim(filter_var($_POST['password2'], FILTER_SANITIZE_SPECIAL_CHARS));

$query = $pdo->query("SELECT * FROM `base_cd` WHERE `login` ='$login'");
$row = $query->fetch(PDO::FETCH_OBJ);
$query = $pdo->query("SELECT `email` FROM `base_cd` WHERE `email` = '$email'");
$row_email = $query->fetch(PDO::FETCH_OBJ);



$preg_name = '/\w{3,}/';
$preg_mail = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]*.(?:rzd)$/m';

    $error = '';
    
    if (empty($surname))
        $error = 'Введите фамилию';
    elseif (empty($name))
        $error = 'Введите имя';
    elseif (empty($patronomic))
        $error = 'Введите отчество';
    elseif (empty($branch))
        $error = 'Введите подразделение';
    elseif (empty($post))
        $error = 'Введите должность';
    elseif (empty($login))
        $error = 'Введите логин';
    elseif($login == $row->login)
        $error = 'Указанный Вами логин занят';
    elseif (!preg_match($preg_name, $login))
        $error = 'Логин не менее 3 символов!';
    elseif (!preg_match($preg_mail, $email))
        $error = 'Можно указать только почту *.rzd';
    elseif ($email == $row_email->email)
        $error = 'Такой почтовый адрес уже используется';
    elseif (empty($password))
        $error = 'Введите пароль';
    elseif (empty($password2))
        $error = 'Повторите пароль';
    elseif ($password !== $password2)
        $error = 'Пароли не совпадают, введите еще раз!';

        if ($error != '') {
        echo $error;
        exit();
    }



        try{
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $password = md5(md5($password));

                $query = $pdo->prepare("INSERT INTO base_cd SET `surname`=?, `name`=?, `patronomic`=?, `branch`=?, `post`=?, `login`=?, `password`=?, `email`=?");
                $query->execute([$surname, $name, $patronomic, $branch, $post, $login, $password, $email]);
                
                
                //$info = $pdo->errorInfo();
                //print_r($info);
        }
        catch(Exception $e){
            echo 'Exception -> ';  
            var_dump($e->getMessage());
        }


echo '1';
