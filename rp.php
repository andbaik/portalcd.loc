<?php

include_once 'block/header.php';

$admin = $user['AB_admin_cd'] == 1 ? $admin = 1 : $admin = 0;
echo "ADMIN = $admin";
$title = 'Ревизорские предписания';
include_once 'block/conect_db.php';
$date_now = date("d.m.Y");
$query = $pdo->query('SELECT * FROM `regulations` JOIN `railways` ON regulations.id_railways = railways.id_railway');

echo <<<END
<main class="main">
    <div class="container">
        <h1>Контроль выполнения ревизорских предписаний</h1>
        <p><a href="/add_regulations.php">Добавить ревизорское предписание</a></p>
        <div class="mobile-table">
            <table class="iksweb">
                <thead>
                    <tr>
                        <th style='width:61px;'>Дорога</th>
                        <th style='width:84px;'>Дата выдачи</th>
                        <th style='width:84px;'>Номер</th>
                        <th style='width:100px;'>Кем выдно </th>
                        <th style='width:100px;'>Кому выдно </th>
                        <th>Что нарушено</th>
                        <th style='width:100px;'>Где нарушено</th>
                        <th style='width:84px;'>Срок устранения</th>
                        <th style='width:90px;'>Отчет в РБ</th>
                        <th style='width:84px;'>Снято с контроля</th>
END;
            if ($admin == 1){
                echo '<th style="width:40px;"><i class="fa-solid fa-pencil"></i></th>';
                echo '<th style="width:40px;"><i class="fa-solid fa-trash-can"></i></th>';
            }
echo <<<END

                    </tr>
                </thead>
                <tbody>
END;
while ($row = $query->fetch(PDO::FETCH_OBJ)) {
    //Приводим даты к единому стилю
    $given_date = date('d.m.Y', strtotime($row->date_given));
    $term_date = date('d.m.Y', strtotime($row->term_date));
    $rem_date = date('d.m.Y', strtotime($row->rem_control));
    $color_row = '';
    $color_danger = '';

    //Выводим даты в нужном формате
    if (is_null($row->what_closed) & is_null($row->rem_control)) {
        $rem_date = '';
    }
    if (!is_null($row->what_closed) & is_null($row->rem_control)) {
        $rem_date = 'Не устранено';
    } else {
        $rem_date = date('d.m.Y', strtotime($row->rem_control));
    }
    if ($rem_date == '01.01.1970') {
        $rem_date = '';
    }

    $date1 = new DateTime(date('d.m.Y'));
    $date2 = new DateTime($row->term_date);
    $date3 = strtotime('+5 days');


    if ($date1 > $date2) { /*Просрочено*/
        if (is_null($row->what_closed_report) & is_null($row->rem_control)) {
            $color_row = 'color_red';
        }
        if (!is_null($row->what_closed_report) & is_null($row->rem_control)) {
            $color_danger = 'color_red';
        }
    }

    $datediff = round((strtotime($row->term_date) - strtotime('now')) / (60 * 60 * 24)); //ищем разность дат


    if (round($datediff) <= 5 & round($datediff) >= 0) {
        $color_row = 'color_yellow';
    }
echo <<<END
            <tr class="$color_row">
                <td> {$row->railway_shot} </td> 
                <td> {$given_date} </td>
                <td style="text-align:center";> <a href="{$row->path_file}" title="Скачать"> {$row->number_regulations}<i style="margin:0; padding:0; margin-left:5px;" class="fa-solid fa-file-pdf"></i></a> </td>
                <td> {$row->who_given} </td>
                <td> {$row->whom_given} </td>
                <td> {$row->err_doc} {$row->err_item} {$row->what_violation}</td>
                <td> {$row->object} </td>
                <td> {$term_date} </td>

                <td  style="vertical-align: top;">
                    <div class="edit">
                        <div class="edit_1"><span><a href="../rp_edit.php?edit=1&id={$row->id_regulations}"><i class="fa-solid fa-pencil"></i></a></span><br></div>
END;
                        if($row->what_closed_report != NULL){
                            echo "<div class='edit_2'> <a href='" . $row->what_closed_report . "'> Ответ <i class='fa-solid fa-file-pdf'></i> </a> </div>";
                        };

                        $rem_control1 = date('d.m.Y', strtotime($row->rem_control));
echo <<<END
                    </div>
                </td>
                <td class="$color_danger" style="vertical-align: top;">
                    <div class="edit">
                        <div class="edit_1"><span><a href="../rp_edit.php?edit=2&id=$row->id_regulations"><i class="fa-solid fa-pencil"></i></a></span></div>
END;
                        if ($rem_control1 !== '01.01.1970'){
                            echo '<div class="edit_3">' . $rem_control1 . '</div>';
                        }
echo <<<END
                    </div>
                </td>
END;
                if ($admin == 1){
                    echo '<td><a href="../del_rp.php?edit=1&id=$row->id_regulations"><i class="fa-solid fa-pencil"></i></a></td>';
                    echo '<td><a href="../del_rp.php?edit=2&id=$row->id_regulations"><i class="fa-solid fa-trash-can"></i></a></td>';
                };
echo <<<END
            </tr>

END;
};



//echo $html;
?>

                </tbody>
            </table>
        </div>
        <p class="style__date">Сегодня: <?=$date_now?> </p>
    </div>
</main>


<?php include_once("block/footer.php"); ?>


</div>
</body>

</html>

