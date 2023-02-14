<?
$telephone = 89167744038;

function convertPhone($tel){
    $tel_1 = mb_substr($tel, 0, 1);
    $tel_cod = mb_substr($tel, 1, 3);
    $tel_3 = mb_substr($tel, 4, 3);
    $tel_2_1 = mb_substr($tel, 7, 2);
    $tel_2_2 = mb_substr($tel, 9, 2);
    $tel_ok = $tel_1 . ' (' . $tel_cod . ') ' . $tel_3 . '-' . $tel_2_1 . '-' . $tel_2_2;
    return $tel_ok;
}

echo convertPhone($telephone) . '<br>';
echo mb_substr($telephone, 0, 1) . '<br>';
echo mb_substr($telephone, 3);