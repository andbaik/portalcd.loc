<?php
include_once 'block/header.php';
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
                        <th style='width:80px;'>номер</th>
                        <th style='width:100px;'>Кем выдно </th>
                        <th>Что нарушено</th>
                        <th style='width:100px;'>Станции нарушений</th>
                        <th style='width:84px;'>Срок устранения</th>
                        <th style='width:130px;'>Чем закрыто</th>
                        <th style='width:84px;'>Снято с контроля</th>
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
        if (is_null($row->what_closed) & is_null($row->rem_control)) {
            $color_row = 'color_red';
        }
        if (!is_null($row->what_closed) & is_null($row->rem_control)) {
            $color_danger = 'color_red';
        }
    }

    $datediff = (strtotime($row->term_date) - strtotime('now')) / (60 * 60 * 24); //ищем разность дат

    if (round($datediff) <= 5 & round($datediff) >= 0) {
        $color_row = 'color_yellow';
    }

    $html .= "
            <tr class=\"{$color_row}\">
                <td> {$row->railway_shot} </td> 
                <td> {$given_date} </td>
                <td style='text-align:center';> <a href=\"{$row->path_file}\" title=\"Скачать\"> {$row->number_regulations}<i style=\"margin:0; padding:0; margin-left:5px;\" class=\"fa-solid fa-file-pdf\"></i></a> </td>
                <td> {$row->who_given} </td>
                <td> {$row->what_violation} </td>
                <td> {$row->object} </td>
                <td> {$term_date} </td>
                    <td style='margin:0; padding:0; '>                    
                        <a style=\"padding:0;\" href=\"#\">Телеграмма {$row->what_closed}<i class=\"fa-solid fa-file-pdf\" style=\"padding:0;\"></i></a><br>
                        <a style=\"padding:0;\" href=\"#\">Протокол {$row->what_closed}<i class=\"fa-solid fa-file-pdf\" style=\"padding:0;\"></i></a><br>
                        <a style=\"padding:0;\" href=\"#\">Отчет {$row->what_closed}<i class=\"fa-solid fa-file-pdf\" style=\"padding:0;\"></i></a>
                    </td>
                <td class=\"$color_danger\"> 10.01.2022 {$rem_date} </td>
            </tr>
            ";
};

echo $html;

echo <<<END
                </tbody>
            </table>
        </div>
        <p class="style__date">Сегодня: {$date_now} </p>
    </div>
</main>
END;

include_once("block/footer.php");

echo <<<END
</div>
</body>

</html>
END;
