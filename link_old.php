<?php
$title = 'Полезные ссылки';
include 'block/header.php';
?>

<body>

    <div class="container">
        <div class="main-table">
            <h2>Ссылки на ресурсы:</h2>
            <br>
            <?php
            include_once 'block/conect_db.php';

            echo <<<END
        <table class="table  table-responsive table-hover">
            <thead class="table-secondary">
                <tr>
                    <th>Короткое название </th>
                    <th>Полное название автоматизированной системы </th>
                </tr>
            </thead>
        <tbody>
        END;
            ?>

            <?php
            $query = $pdo->query('SELECT * FROM `links`');
            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $html .= "
        <tr href= \"{$row->link} \" target=\"_blank\" >
            <td> <a href= \" {$row->link} \" target=\"_blank\"> {$row->shot_name} </a> </td> 
            <td> <a href= \"{$row->link} \" target=\"_blank\"> {$row->nameLink} </a> </td>
        </tr>
        ";
            };

            echo $html;

            ?>
            </tbody>
            </table>
        </div>
    </div>
    <?php include_once ("block/footer.php"); ?>
</body>

</html>