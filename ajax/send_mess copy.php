<?php

$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['mail'], FILTER_SANITIZE_SPECIAL_CHARS));
$text = trim(filter_var($_POST['text'], FILTER_SANITIZE_SPECIAL_CHARS));
$ip = trim(filter_var($_POST['ip'], FILTER_SANITIZE_SPECIAL_CHARS));


if (empty($name)){
    $error = "Введите имя";
}elseif (empty($email)){
    $error = "Введите почту";
}elseif (empty($text)){
    $error = "Введите сообщение";
}else{
    $error = "";}
if ($error != '') {
    echo $error;
    exit();
}

include_once '../block/conect_db.php';

/*
header('Content-Type: text/html; charset=utf-8');
$email = "kuchinskyan@center.rzd";
$pagetitle = "Новое сообщение с сайта";
$text = "Имя: ".$name. ' '. $email . "\n Текст: ".$text;
if (mail($mail, $pagetitle, $text, "Content-type: text/plain; charset=utf-8"))
{
	echo '<script> alert("Сообщение успешно отправлено"); </script>';
	}
else{
echo '<script>alert("Сообщение ne отправлено"); </script>';
}

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
*/

// Файлы phpmailer
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';


// Формирование самого письма
$title = "Заголовок письма";
$body = "
<h2>Новое письмо</h2>
<b>Имя:</b> $name<br>
<b>Почта:</b> $email<br><br>
<b>Сообщение:</b><br>$text
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'uc.center.rzd'; // SMTP сервера вашей почты
    $mail->Username   = 'kuchinskyan@center.rzd'; // Логин на почте
    $mail->Password   = 'W@wrvonq'; // Пароль на почте
    $mail->SMTPSecure = 'none';
    $mail->Port       = 25;
    $mail->setFrom('kuchinskyan@center.rzd', 'Сайт ЦДРБ'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('kuchinskyan@center.rzd');  
    $mail->addAddress('kuchinskyan@center.rzd'); // Ещё один, если нужен

 /*   // Прикрипление файлов к письму
if (!empty($file['name'][0])) {
    for ($ct = 0; $ct < count($file['tmp_name']); $ct++) {
        $uploadfile = tempnam(sys_get_temp_dir(), sha1($file['name'][$ct]));
        $filename = $file['name'][$ct];
        if (move_uploaded_file($file['tmp_name'][$ct], $uploadfile)) {
            $mail->addAttachment($uploadfile, $filename);
            $rfile[] = "Файл $filename прикреплён";
        } else {
            $rfile[] = "Не удалось прикрепить файл $filename";
        }
    }   
}*/
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

echo $result . ' ' . $status;
echo '1';
