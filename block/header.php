<?php
//Запускаем сессию
session_start();

//Устанавливаем кодировку и вывод всех ошибок
//header('Content-Type: text/html; charset=UTF8');
//error_reporting(E_ALL);

//Включаем буферизацию содержимого
ob_start();

//Определяем переменную для переключателя
$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip_user = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip_user = $_SERVER['HTTP_X_FORWARDED_FOR'];
} elseif (!empty($_SERVER['HTTP_X_REAL_IP'])) {
    $ip_user = $_SERVER['HTTP_X_REAL_IP'];
} elseif (!empty($_SERVER['REMOTE_ADDR'])) {
    $ip_user = $_SERVER['REMOTE_ADDR'];
}

$_SESSION['ip_user'] = $ip_user;

$id_user = isset($user) ? $user['id'] : false;

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/all.css" rel="stylesheet">
    <!--load all styles -->
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
    <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#d55bc3">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#ffffff">

    <?php
    $url = trim(basename($_SERVER['PHP_SELF']));
    if ($url == 'edit_todo.php') {
        '<link rel="stylesheet" href="css/style_control.css">';
    }

    switch ($url) {
        case 'todo.php':
            echo '<link rel="stylesheet" href="css/style_todo.css">';
            break;
        case 'link.php':
            echo '<link rel="stylesheet" href="css/style_link.css">';
            break;
        case 'edit_todo.php':
            echo '<link rel="stylesheet" href="css/style_todo.css">';
            break;
        case 'rp.php':
            echo '<link rel="stylesheet" href="css/style_rp.css">';
            break;
        case 'talon.php':
            echo '<link rel="stylesheet" href="css/style_rp.css">';
            break;
        case 'registered.php':
            echo '<link rel="stylesheet" href="css/style_registered.css">';
            break;
        case 'enter.php':
            echo '<link rel="stylesheet" href="css/style_enter2.css">';
            break;
        case 'adressbook.php':
            echo '<link rel="stylesheet" href="css/style_adress.css">';
            break;
        case 'registration.php':
            echo '<link rel="stylesheet" href="css/style_enter2.css">';
            break;
        case 'adress_add.php':
            echo '<link rel="stylesheet" href="css/style_enter2.css">';
            break;
        case 'add_regulations.php':
            echo '<link rel="stylesheet" href="css/style_enter2.css">';
            break;
        case 'del_rp.php':
            echo '<link rel="stylesheet" href="css/style_enter2.css">';
            break;
        case 'contact.php':
            echo '<link rel="stylesheet" href="css/forms.css">';
        break;
        case 'rp_edit.php':
            echo '<link rel="stylesheet" href="css/style_rp.css">';
        break;
        case 'rp_modal.php':
            echo '<link rel="stylesheet" href="css/style_rp.css">';
        break;
        case 'edit_rp.php':
            echo '<link rel="stylesheet" href="css/style_adress.css">';
            break;
        case 'control.php':
            echo '<link rel="stylesheet" href="css/style_rp.css">';
            break;
        case 'diagramm_control.php':
            echo '<link rel="stylesheet" href="css/style_rp.css">';
            break;
        case 'diagramm_control_shot.php':
            echo '<link rel="stylesheet" href="css/style_rp.css">';
            break;
        case 'add_regulations2.php':
            echo '<link rel="stylesheet" href="css/style_enter2.css">';
            break;
    };

    ?>
    <title><?= $title ?></title>
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <div class="container">
                <div class="header__row">
                    <div class="header__logo"><a href="index.php"><img src="img/logo_p.png" alt="Logo"></a></div>
                    <div class="header__title">
                        <h1>Центральная дирекция управления движением</h1>
                        <h3>отдел безопасности движения поездов</h3>
                    </div>
                    <?php
                    if (empty($user)) {
                        echo '<div class="header__enter"><a href="enter.php" alt="Вход"><i class="fa-solid fa-right-to-bracket"></i></a></div>';
                    } else {
                        echo '<div class="header__enter"><a href="block/logout.php" alt="Выход"><i class="fa-solid fa-right-to-bracket"></i></a></div>';
                    }
                    ?>
                </div>
            </div>
        </header>
        <?php if (basename($_SERVER['REQUEST_URI']) !== 'index.php') {

            echo <<<END
            <div class="header__link container">
                <ul class="link__items">
                    <li> <a href="adressbook.php">Адресная&nbsp;книга</a></li>
                    <li> <a href="link.php">Перечень&nbsp;ресурсов</a></li>
                    <li> <a href="#"> Нормативные&nbsp;документы</a></li>
                    <li> <a href="todo.php"> Контроль&nbsp;отдела</a></li>
                    <li> <a href="control.php"> Контроль&nbsp;мероприятий</a></li>
                    <li> <a href="talon.php"> Талоны&nbsp;по&nbsp;безопасности</a></li>
                    <li> <a href="rp.php"> Ревизорские&nbsp;предписания</a></li>
                    <li> <a href="audits.php"> Контроль&nbsp;аудитов</a></li>
                    <li> <a href="contact.php">Задать&nbsp;вопрос</a></li>
                </ul>
            </div>
            END;
        }; ?>