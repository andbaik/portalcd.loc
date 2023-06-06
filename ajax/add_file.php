<?php
/*
$what_closed_telegram= trim(filter_var($_POST['telegrama'], FILTER_SANITIZE_SPECIAL_CHARS));
$what_closed_protocol = trim(filter_var($_POST['protocol'], FILTER_SANITIZE_SPECIAL_CHARS));
$what_closed_report = trim(filter_var($_POST['report'], FILTER_SANITIZE_SPECIAL_CHARS));
*/

print_r($_REQUEST);
//print_r($_POST);
var_dump($files);

echo 'Сработало!';

/*
echo "FILE_EVETS ID = $eventsid";
if ($eventsid == 1){
    include_once '../block/conect_db.php';

    $query = $pdo->prepare("UPDATE regulations SET `date_given`=? WHERE id_regulations = ?");
    $query->execute(['2023-01-05', 1]);
};

*/




/*
$ip_add_new = trim(filter_var($_POST['ip_add_new'], FILTER_SANITIZE_SPECIAL_CHARS));
$id_user = trim(filter_var($_POST['id_user'], FILTER_SANITIZE_SPECIAL_CHARS));
$ip_add_new = ip2long($ip_add_new);


$date = date('Y-m-d');



if (empty($what_closed_telegram) || empty($what_closed_protocol) || empty($what_closed_report)) {
    $error = "Вы ничего не приложили";
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

    $query = $pdo->prepare("INSERT regulations SET `id_railways`=?, `date_given`=?, `number_regulations`=?, `who_given`=?, `what_violation`=?, `object`=?, `term_date`=?, `id_user_new`=?,`ip_add_new`=?, `date_new`=?");
    $query->execute([$id_railways, $date_given, $num_reg, $who_given, $what_violation, $object, $term_date, $id_user, $ip_add_new, $date]);

    $info = $pdo->errorInfo();
                print_r($info);
} catch (Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}
*/
