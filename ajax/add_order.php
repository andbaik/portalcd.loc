<?php

use PHPMailer\PHPMailer\PHPMailer;

$id_railways = trim(filter_var($_POST['id_railways'], FILTER_SANITIZE_SPECIAL_CHARS));
$date_given = trim(filter_var($_POST['date_given'], FILTER_SANITIZE_SPECIAL_CHARS));
$num_reg = trim(filter_var($_POST['number_regulations'], FILTER_SANITIZE_SPECIAL_CHARS));
//$file = trim(filter_var($_POST['file'], FILTER_SANITIZE_SPECIAL_CHARS));
$who_given = trim(filter_var($_POST['who_given'], FILTER_SANITIZE_SPECIAL_CHARS));
$whom_given_branch = trim(filter_var($_POST['whom_given_branch'], FILTER_SANITIZE_SPECIAL_CHARS));
$whom_given = trim(filter_var($_POST['whom_given'], FILTER_SANITIZE_SPECIAL_CHARS));
$what_violation = trim(filter_var($_POST['what_violation'], FILTER_SANITIZE_SPECIAL_CHARS));
$err_doc = trim(filter_var($_POST['err_doc'], FILTER_SANITIZE_SPECIAL_CHARS));
$err_item = trim(filter_var($_POST['err_item'], FILTER_SANITIZE_SPECIAL_CHARS));
$object = trim(filter_var($_POST['object'], FILTER_SANITIZE_SPECIAL_CHARS));
$term_date = trim(filter_var($_POST['term_date'], FILTER_SANITIZE_SPECIAL_CHARS));
//$ip_add_new = trim(filter_var($_POST['ip_add_new'], FILTER_SANITIZE_SPECIAL_CHARS));
$id_user = trim(filter_var($_POST['id_user'], FILTER_SANITIZE_SPECIAL_CHARS));
$ip_add_new = ip2long($ip_add_new);

$ip_2 = long2ip($ip_add_new); /* Преобразование IP адреса в число*/
$date = date('Y-m-d');
$month = date('m', strtotime($date));

$url = 'rp.php';

if (strpos($num_reg, '/') !== false) {
    $num_reg = strstr($num_reg, '/', true);
}

include_once('../block/conect_db.php');


$query = $pdo->prepare('SELECT * FROM `railways` WHERE `id_railway` = ?');
$query->execute([$id_railways]);

while ($row = $query->fetch(PDO::FETCH_OBJ)) {
    $kod_railway = $row->railway_shot_file;
    $railway_name = $row->railway;
}
$name1 = $kod_railway . '_' . $month . '_' . $num_reg;

$file_size = $_FILES['file']['size'] > 0 ? $_FILES['file']['size'] : -1;
$max_size = 1024 * 1024 * 40;


$preg_reg = '/^\d{1,}$/';


if (empty($id_user)) {
    $error = 'Вы не авторизованы!';
} elseif ($id_railways == 'Выберите из списка') {
    $error = 'Укажите дорогу';
} elseif (empty($date_given)) {
    $error = 'Укажите дату выдачи предписания';
} elseif (empty($num_reg)) {
    $error = 'Укажите номер предписания';
} elseif ($file_size < 0) {
    $error = 'Прикрепите файл';
} elseif ($file_size > $max_size) {
    $error = 'Слишком большой файл';
} elseif (empty($who_given)) {
    $error = 'Укажите кем выдано предписание';
}elseif (empty($whom_given_branch)) {
    $error = 'Укажите кому выдано';
}elseif (empty($whom_given)) {
    $error = 'Укажите ФИО кому выдано';
}elseif (empty($what_violation)) {
    $error = 'Укажите что нарушено';
}elseif (empty($err_doc)) {
    $error = 'Укажите какой документ нарушен';
}elseif (empty($err_item)) {
    $error = 'Укажите какие пункты нарушены';
}elseif (empty($object)) {
    $error = 'Укажите объект проверки';
} elseif (empty($term_date)) {
    $error = 'Укажите срок устранения';
} elseif (!preg_match($preg_reg, $num_reg)) {
    $error = 'В номере предписания должны быть только цифры (исключить /23)';
}

if ($error != '') {
    echo $error;
    exit();
}



include_once '../block/conect_db.php';


$input_name = 'file';
$allow = array('doc', 'docx', 'rtf', 'pdf');
$deny  = array(
    'phtml', 'php', 'php3', 'php4', 'php5', 'php7', 'phps', 'cgi', 'pl', 'asp',
    'aspx', 'shtml', 'htaccess', 'htpaswd', 'ini', 'log', 'sh', 'js', 'html', 'htm', 'css', 'sql',
    'spl', 'scgi', 'fcgi'
);
$end_folder = date('Y', strtotime($date_given));
$date_shot = substr($end_folder, 2, 2);


$sait = 'http://portalcd.loc:81/'; //Задается для отправки почты
$sait_rp='rp.php';

$path = 'orders/' . $end_folder . '/';
if (!is_dir('../orders/' . $end_folder)) {
    mkdir('../orders/' . $end_folder);
}

$files = array();
$diff = count($_FILES[$input_name]) - count($_FILES[$input_name], COUNT_RECURSIVE);
if ($diff == 0) {
    $files = array($_FILES[$input_name]);
} else {
    foreach ($_FILES[$input_name] as $k => $l) {
        foreach ($l as $i => $v) {
            $files[$i][$k] = $v;
        }
    }
}

foreach ($files as $file) {
    $error = $success = '';

    if (!empty($file['error']) || empty($file['tmp_name'])) {
        switch (@$file['error']) {
            case 1:
            case 2:
                $error = 'Превышен размер загружаемого файла';
                break;
            case 3:
                $error = 'Файл был получен только частично';
                break;
            case 4:
                $error = 'Файл не был загружен';
                break;
            case 6:
                $error = 'Файл не загружен отсутствует временная директория';
                break;
            case 7:
                $error = 'Не удалось записать файл на диск';
                break;
            case 8:
                $error = 'Система остановила загрузку файла';
                break;
            case 9:
                $error = 'Файл не был загружен - отсутствует директория загрузки';
                break;
            case 10:
                $error = 'Превышен максимально допустимый размер файла';
                break;
            case 11:
                $error = 'Данный тип файла запрещен';
                break;
            case 12:
                $error = 'Ошибка при копировании файла';
                break;
            default:
                $error = 'Файл не был загружен - неизвестная ошибка';
                break;
        }
    } elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
        $error = 'Не удалось загрузить файл';
    } else {

        // Оставляем в имени файла только буквы, цифры и некоторые символы.
        $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
        $name = mb_eregi_replace($pattern, '-', $file['name']);
        $name = mb_ereg_replace('[-]+', '-', $name);
//
//        // Т.к. есть проблема с кириллицей в названиях файлов (файлы становятся недоступны).
//        // Сделаем их транслит:
//        $converter = array(
//            'а' => 'a',   'б' => 'b',   'в' => 'v',    'г' => 'g',   'д' => 'd',   'е' => 'e',
//            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',    'и' => 'i',   'й' => 'y',   'к' => 'k',
//            'л' => 'l',   'м' => 'm',   'н' => 'n',    'о' => 'o',   'п' => 'p',   'р' => 'r',
//            'с' => 's',   'т' => 't',   'у' => 'u',    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
//            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',  'ь' => '',    'ы' => 'y',   'ъ' => '',
//            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
//
//            'А' => 'A',   'Б' => 'B',   'В' => 'V',    'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
//            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',    'И' => 'I',   'Й' => 'Y',   'К' => 'K',
//            'Л' => 'L',   'М' => 'M',   'Н' => 'N',    'О' => 'O',   'П' => 'P',   'Р' => 'R',
//            'С' => 'S',   'Т' => 'T',   'У' => 'U',    'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
//            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',  'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
//            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
//        );
//
//        $name = $name;
        $parts = pathinfo($name);

        $name = $name1;

        if (empty($name) || empty($parts['extension'])) {
            $error = 'Недопустимое тип файла';
        } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
            $error = 'Недопустимый тип файла';
        } elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
            $error = 'Недопустимый тип файла';
        } elseif (is_file('../' . $path . $name1 . $prefix . '.' . $parts['extension'])) {
            $error = "Такое предписание уже есть!";

        } else {
            // Чтобы не затереть файл с таким же названием, добавим префикс.
            $i = 0;
            $prefix = '';
            while (is_file('../' . $path . $name1 . $prefix . '.' . $parts['extension'])) {
                $prefix = '(' . ++$i . ')';
            }
            $name = $name1 . $prefix . '.' . $parts['extension'];
            // Перемещаем файл в директорию.
            if (move_uploaded_file($file['tmp_name'], '../' . $path . $name)) {
                $file_path = $path . $name;
                //echo "PATH = $file_path";
            } else {
                $error = 'Не удалось загрузить файл.';
            }
        }
    }
}

if ($error != '') {
    echo $error;
    exit();
}


// Файлы phpmailer
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';

$date = date("d-m-Y",strtotime($date_given));
$term_date = date('d.m.Y', $term_date);

// Формирование самого письма
$title = "Письмо с сайта ЦД";
$body = "
<h2 style='color: red;'>$railway_name дирекция  получила предписание</h2>
<b>Дата:</b> $date  № $num_reg  выдано $who_given<br>
<b>Нарушения:</b> $what_violation<br><br>
<b>Срок устранения: </b>$term_date<br>
<i>Посмотреть можно по адресу: <a>$sait$file_path</a></i><br>
<i>Перейти на сайт: <a>$sait$sait_rp</a></i>
";

// Настройки PHPMailer
$mail = new PHPMailer(true);
try {
    $mail->isSendmail();
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = function ($str, $level) {
        $GLOBALS['status'][] = $str;
    };

    // Настройки вашей почты
    $mail->Host       = 'uc.center.rzd'; // SMTP сервера вашей почты
    $mail->Username   = 'kuchinskyan'; // Логин на почте
    $mail->Password   = 'Hoot@elah100315'; // Пароль на почте
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 143;
    $mail->setFrom('kuchinskyan@center.rzd', 'Сайт ЦДРБ'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('kuchinskyan@center.rzd', 'samofalovok@center.rzd');
    //$mail->addAddress('kuchinskyan@center.rzd'); // Ещё один, если нужен

    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;

    // Проверяем отравленность сообщения
    if ($mail->send()) {
        $result = "success";
    } else {
        $result = "error";
    }
} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
    $error = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

if ($error != '') {
    echo $error;
    exit();
}


try {
    include_once '../block/conect_db.php';
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $query = $pdo->prepare("INSERT regulations SET `id_railways`=?, `date_given`=?, `number_regulations`=?, `path_file`=?, `who_given`=?, `whom_given_branch`=?, `whom_given`=?, `what_violation`=?, `err_doc`=?, `err_item`=?, `object`=?, `term_date`=?, `id_user_new`=?,`ip_add_new`=?, `date_new`=?");
    $query->execute([$id_railways, $date_given, $num_reg . '/' . $date_shot, $file_path, $who_given, $whom_given_branch, $whom_given, $what_violation, $err_doc, $err_item, $object, $term_date, $id_user, $ip_add_new, $date]);

    $info = $pdo->errorInfo();
    //print_r($info);
} catch (Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}


echo '1';