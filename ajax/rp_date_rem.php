<?php

$date_rem = trim(filter_var($_POST['date_rem'], FILTER_SANITIZE_SPECIAL_CHARS));

include_once '../block/conect_db.php';

//$query = $pdo->prepare("INSERT INTO links SET shot_name=?, nameLink=?, link=?");
//$query->execute([$shot_name, $nameLink, $link]);

echo '1';