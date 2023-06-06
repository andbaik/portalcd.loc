<?php
    $user = 'u29306_andbaik';
    $password = '';
    $db = 'u29306_portalcd';
    $host = '109.95.211.97';

    $dsn = 'mysql:host='.$host.';dbname='.$db;
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
