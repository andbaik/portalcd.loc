<?php
session_start();
include_once '../block/conect_db.php';
$ip_user = $_SESSION['ip_user'];

/*  Параметры  */
$max_size = 1024 * 1024 * 40;



$id_rp = trim(filter_var($_POST['id_rp'], FILTER_SANITIZE_SPECIAL_CHARS));
$id_user = trim(filter_var($_POST['id_user'], FILTER_SANITIZE_SPECIAL_CHARS));
$file_size_rep = $_FILES['report']['size'] > 0 ? $_FILES['report']['size'] : -1;




if (empty($id_user)) {
    $error = 'Вы не авторизованы!';
} elseif ($file_size_rep > $max_size) {
    $error = 'Слишком большой файл, ограничение 40Мб';
} elseif ($file_size_rep == -1) {
    $error = 'Вы ничего не приложили';
} 
if ($error != '') {
    echo $error;
    exit();
}

$query = $pdo->prepare('SELECT `path_file` FROM `regulations` WHERE `id_regulations` = ?');
$query->execute([$id_rp]);
$row = $query->fetch(PDO::FETCH_OBJ);

if (empty($row->path_file)){
    $error = "Не найдено такое предписание!";
    echo $error;
    exit();
}


$folder_rep = substr($row->path_file, 7, 4); //папка куда складывать документы (ответы)
$name_rep = pathinfo(substr($row->path_file, 12, ),basename(PATHINFO_FILENAME)) . '_answ';
$path = 'orders/' . $folder_rep . '/' . 'answers/';       // путь до папки


$input_name = 'file';
$allow = array('doc', 'docx', 'rtf', 'pdf');
$deny  = array(
    'phtml', 'php', 'php3', 'php4', 'php5', 'php7', 'phps', 'cgi', 'pl', 'asp',
    'aspx', 'shtml', 'htaccess', 'htpaswd', 'ini', 'log', 'sh', 'js', 'html', 'htm', 'css', 'sql',
    'spl', 'scgi', 'fcgi'
);

//количество отрезаемых символов (название файла)
$simbol = strrpos($row->path_file,'/');

$end_folder = substr($row->path_file, 0, $simbol);

$sait = 'http://portalcd.loc:81/';
$path =  $end_folder . '/answers/';





$files = array();

$files[0] = $_FILES['report'];


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

        $name_pats = substr($row->path_file, ($simbol)+1);
        $name = substr($name_pats, 0,  strlen($name_pats)-4) . '_answ';
        $parts = pathinfo($name_pats);

        //echo "PATH= $path";
        //echo "NAME= $name";

        if (empty($name) || empty($parts['extension'])) {
            $error = 'Недопустимое тип файла';
        } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
            $error = 'Недопустимый тип файла';
        } elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
            $error = 'Недопустимый тип файла';
        } elseif (is_file('../' . $path . $name . '.' . $parts['extension'])) {
            $error = "Такое ответ уже загружен!";

        } else {
            
            $name = $name . '.' . $parts['extension'];
            // Перемещаем файл в директорию.
            if (move_uploaded_file($file['tmp_name'], '../' . $path . $name)) {
                $file_path = $path . $name;
            } else {
                $error = 'Не удалось загрузить файл.';
            }
        }
    }
}

try {
    include_once '../block/conect_db.php';
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $query = $pdo->prepare("UPDATE regulations SET what_closed_report=? WHERE id_regulations=?");
    $query->execute([$file_path, $id_rp]);

    $info = $pdo->errorInfo();
    //print_r($info);
    echo '1';
    exit();


} catch (Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}

if ($error != '') {
    echo $error;
    exit();
}
echo '1';
