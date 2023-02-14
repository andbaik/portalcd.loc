<?php

use PHPMailer\PHPMailer\PHPMailer;

// Файлы phpmailer
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';

$day_now = date ('d.m.Y');


include_once('../block/conect_db.php');
$k = 0;
$query = $pdo->query('SELECT * FROM `adressbook`
WHERE MONTH (`date_br`) = MONTH(NOW()) AND DAY (`date_br`) = DAY (NOW())');
while ($row = $query->fetch(PDO::FETCH_OBJ)) {
    $k++;
    $html .=  $row->surname . ' ' . $row->name . ' ' . $row->patronymic . '<br> <hr>';
}

if ($k > 0){

// Формирование самого письма
$title = "Информация о днях рождения сегодня: $day_now";

$body = "
    <table style=\"width:600px; margin:0 auto; text-decoration: none; border-collapse:collapse; text-align:center; \">
        <thead>
            <th style=\"border: 1px solid #939b87;\"><img src=\"http://portalcd.loc:81/autosend/header_img.png\" alt=\"train\"></th>
        </thead>
        <tr>
            <td style=\"font-size:22px; text-align:center; border: 1px solid #939b87; color:red;\">Сегодня празднуют дни рождения:<p></td>
        </tr>
        <tr>
            <td style=\"font-size:22px; text-align:left; border: 1px solid #939b87; padding: 10px;\"> $html </td>
        </tr>
    </table>
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

    $resepient = array (
        'kuchinskyan@center.rzd',
        'makarenkoag@center.rzd',
        'yaichnikovaos@center.rzd',
        'KuzminaUS@center.rzd',
        'tarasovka@center.rzd',
        'beloguzoviv@center.rzd',
        'zobninvl@center.rzd',
        'greshnevala@center.rzd',
        'GrodAS@center.rzd',
        'kornishevdv@center.rzd',
        'RayzerRV@center.rzd',
        'kujelal@center.rzd',
        'kamynina@center.rzd',
        'cd_fedorovia@center.rzd',
        'kurbatova@center.rzd',
        'ilyinagn@center.rzd',
        'safronovvs@center.rzd',
        'garetovskiyoa@center.rzd',
        'poroykoav@center.rzd',
        'arustamovaar@center.rzd',
        'BulantsevVV@center.rzd',
        'piskuniv@center.rzd',
        'piskunovaoe@center.rzd',
        'hanturovav@center.rzd',
        'dudarevdv@center.rzd',
        'podchufarova@center.rzd',
        'kravaevaaa@center.rzd',
        'greshnevala@center.rzd',
        'cd_borisovnv@center.rzd',
        'semyonkin@center.rzd',
        'KukushkinIA@center.rzd',
        'avdeevav@center.rzd',
        'efanovvv@center.rzd',
        'BochihinIV@center.rzd',
        'chigirevva@center.rzd',
        'TrusovAI@center.rzd',
        'ribakovsv1@center.rzd',
        'NikitinaAV@center.rzd',
        'KofanovaNV@center.rzd',
        'kovalevanv@center.rzd',
        'shirokovanl@center.rzd',
        'KokinSV@center.rzd',
        'belousovavb@center.rzd',
        'birukovanv@center.rzd',
        'kamenevaia@center.rzd',
        'jukovaev@center.rzd',
        'martinovaen@center.rzd',
        'denisovatp@center.rzd',
        'kamishanovaiu@center.rzd',
        'GorbunovaNV@center.rzd',
        'SteninaMA@center.rzd',
        'BanatovaSN@center.rzd',
        'efanovvv@center.rzd',
        'MusaevaAN@center.rzd',
        'davydovavv@center.rzd',
        'MandrikDA@center.rzd',
        'LikhinAA@center.rzd',
        'guzanovvv@center.rzd',
        'shovkovayaln@center.rzd',
        'godovatn@center.rzd',
        'yagovkinsa@center.rzd',
        'samuylovaa@center.rzd',
        'StrelnikovaTA@center.rzd',
        'filatovna@center.rzd',
        'mikheeva@center.rzd',
        'samofalovok@center.rzd',
        'lepeshenkovsa@center.rzd',
        'makarovan@center.rzd',
        'MalyiEI@center.rzd',
        'markovia@center.rzd',
        'dmitrievkv@center.rzd',
        'ReznikovMS@center.rzd',
        'dominoek@center.rzd',
        'moklyakia@center.rzd',
        'krylovas@center.rzd'
    );

    foreach ($resepient as  $value) {
        $mail->addAddress($value);
    }
  


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
}else{
    exit();
}

