<?php

use PHPMailer\PHPMailer\PHPMailer;

$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['mail'], FILTER_SANITIZE_SPECIAL_CHARS));
$text = trim(filter_var($_POST['text'], FILTER_SANITIZE_SPECIAL_CHARS));



$date_now = date('Y-m-d');
$ip = $_SERVER["REMOTE_ADDR"];
$ip = ip2long($ip);

$preg_mail = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]*.(?:rzd)$/m';

if (empty($name)){
    $error = "Введите имя";
}elseif (empty($email)){
    $error = "Введите почту";
}elseif (!preg_match($preg_mail, $email)){
    $error = 'Можно указать только почту *.rzd';
}elseif (empty($text)){
    $error = "Введите сообщение";
}else{
    $error = "";}
if ($error != '') {
    echo $error;
    exit();
}

include_once '../block/conect_db.php';

// Файлы phpmailer
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';


// Формирование самого письма
$title = "Письмо с сайта ЦД";
$body = "
<h2 style='color: red;'>Кто-то оставил сообщение на сайте!</h2>
<b>Имя:</b> $name<br>
<b>Почта:</b> $email<br><br>
<b>Сообщение:</b><br>$text
";

// Настройки PHPMailer
$mail = new PHPMailer(true);
try {
    $mail->isSendmail();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'uc.center.rzd'; // SMTP сервера вашей почты
    $mail->Username   = 'kuchinskyan'; // Логин на почте
    $mail->Password   = 'W@wrvonq'; // Пароль на почте
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 143;
    $mail->setFrom('kuchinskyan@center.rzd', 'Сайт ЦДРБ'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('kuchinskyan@center.rzd');  
    //$mail->addAddress('kuchinskyan@center.rzd'); // Ещё один, если нужен

// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

try {
    include_once '../block/conect_db.php';
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $query = $pdo->prepare("INSERT INTO `questions` SET `name`=?, `email`=?, `text`=?, `ip_add_new`=?, `date`=?");
    $query->execute([$name, $email, $text, $ip, $date_now]);

    //$info = $pdo->errorInfo();
                //print_r($info);
} catch (Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}

echo '1';


