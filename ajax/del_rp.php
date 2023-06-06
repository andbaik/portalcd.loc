<?php
include_once '../block/conect_db.php';

$id = trim(filter_var($_REQUEST['id'], FILTER_SANITIZE_SPECIAL_CHARS));
$edit = trim(filter_var($_REQUEST['edit'], FILTER_SANITIZE_SPECIAL_CHARS));

$id_railways = trim(filter_var($_POST['id_railways'], FILTER_SANITIZE_SPECIAL_CHARS));
$date_given = trim(filter_var($_POST['date_given'], FILTER_SANITIZE_SPECIAL_CHARS));
$num_reg = trim(filter_var($_POST['num_reg'], FILTER_SANITIZE_SPECIAL_CHARS));
$who_given = trim(filter_var($_POST['who_given'], FILTER_SANITIZE_SPECIAL_CHARS));
$whom_given_branch = trim(filter_var($_POST['whom_given_branch'], FILTER_SANITIZE_SPECIAL_CHARS));
$whom_given = trim(filter_var($_POST['whom_given'], FILTER_SANITIZE_SPECIAL_CHARS));
$what_violation = trim(filter_var($_POST['what_violation'], FILTER_SANITIZE_SPECIAL_CHARS));
$err_item = trim(filter_var($_POST['err_item'], FILTER_SANITIZE_SPECIAL_CHARS));
$err_doc = trim(filter_var($_POST['err_doc'], FILTER_SANITIZE_SPECIAL_CHARS));
$object = trim(filter_var($_POST['object'], FILTER_SANITIZE_SPECIAL_CHARS));
$term_date = trim(filter_var($_POST['term_date'], FILTER_SANITIZE_SPECIAL_CHARS));

$ip_add_new = trim(filter_var($_POST['ip_add_new'], FILTER_SANITIZE_SPECIAL_CHARS));
$id_user = trim(filter_var($_POST['id_user'], FILTER_SANITIZE_SPECIAL_CHARS));
$ip_add_new = ip2long($ip_add_new);
$date = date('Y-m-d');



switch ($edit) {
    case '2':
        $file_path_rp=$pdo->query("SELECT * FROM regulations WHERE id_regulations = $id");
        $row = $file_path_rp->fetch(PDO::FETCH_OBJ);
        if(!empty($row->path_file) & file_exists('../' . $row->path_file)){
            unlink('../' .$row->path_file);
        };
        if(!empty($row->what_closed_report) & file_exists('../' . $row->what_closed_report)){
            unlink('../' .$row->what_closed_report);
        };

        $pdo->exec("DELETE FROM regulations WHERE id_regulations = $id");

        echo '1';
        break;

    case '1':
            if (empty($id_railways ) || empty($date_given) || empty($num_reg)  || empty($who_given)  || empty($what_violation)  || empty($object) || empty($term_date)  || empty($ip_add_new )) {
                $error = "Проверьте и заполните все графы где есть * !";
                echo "ID_R=$id_railways date_G=$date_given NUM_REG=$num_reg WHO_GIV=$who_given  WAT_VIO=$what_violation OBJ=$object TERM_D=$term_date IP ADD=$ip_add_new";
            }
            if ($error != '') {
                echo $error;
                exit();
            }

            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $query = $pdo->prepare("UPDATE regulations SET `id_railways`=?, `date_given`=?, `number_regulations`=?, `who_given`=?,   `whom_given_branch`=?, `whom_given`=?, `what_violation`=?, `err_item`=?, `err_doc`=?, `object`=?, `term_date`=?, `id_user_new`=?,`ip_add_new`=?, `date_new`=? WHERE `id_regulations`=?");
                $query->execute([$id_railways, $date_given, $num_reg, $who_given, $whom_given_branch, $whom_given, $what_violation, $err_item, $err_doc, $object, $term_date, $id_user, $ip_add_new, $date, $id]);
            
                $info = $pdo->errorInfo();
                            //print_r($info);
            } catch (Exception $e) {
                echo 'Exception -> ';
                var_dump($e->getMessage());
            }

            echo '1';

        break;


    default:
        $error = 'Неизвестная ошибка!';
        break;
}



