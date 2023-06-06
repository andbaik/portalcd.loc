<?php
$user_id = trim(filter_var($_POST['user_id'], FILTER_SANITIZE_SPECIAL_CHARS));


include_once '../block/conect_db.php';

        $query = $pdo->prepare("DELETE `adressbook` WHERE `id_user`=?");
        $query->execute([$user_id]);

echo '1';
