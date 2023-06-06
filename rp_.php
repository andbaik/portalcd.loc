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
                        <th>Дорога</th>
                        <th>Дата выдачи представления</th>
                        <th>номер представления</th>
                        <th>Кто выдал представление</th>
                        <th>Что нарушено</th>
                        <th>Станции нарушений</th>
                        <th>Срок устранения</th>
                        <th>Чем закрыто</th>
                        <th>Снято с контроля</th>
                    </tr>
                </thead>
                <tbody>
END;
                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    $given_date= date('d.m.Y',strtotime($row->date_given));
                    $term_date = date('d.m.Y',strtotime($row->term_date));
                                        
                    $rem_date = is_null($row->rem_control) ? 'Не снято' : date('d.m.Y',strtotime($row->rem_control));

                    /* Приведение даты чтобы можно было сравнивать */
                    $date1 = new DateTime($date_now);
                    $date2 = new DateTime ($term_date);

                if ($date1 > $date2) { /*Просрочено*/
                    if (is_null($row->what_closed)){
                        $color_row = 'color_red';
                    }else{
                        $color_row = 'color_yellow';
                        $color_danger = 'color_red';}
                }
                if ($date_now < $term_date){ /*не просрочено */
                    $color_row = '';
                    $color_danger = '';
                }

                    $html .= "
            <tr class=\"{$color_row}\">
                <td> {$row->railway_shot} </td> 
                <td> {$given_date} </td>
                <td> {$row->number_regulations} </td>
                <td> {$row->who_given} </td>
                <td> {$row->what_violation} </td>
                <td> {$row->object} </td>
                <td> {$term_date} </td>
                <td> {$row->what_closed} </td>
                <td class=\"$color_danger\"> {$rem_date} </td>
            </tr>
            ";
                };
    
                echo $html;

echo <<<END
                </tbody>
            </table>
        </div>
        <p>Сегодня: {$date_now} </p>
    </div>
</main>
END;

include_once("block/footer.php");

echo <<<END
</div>
</body>

</html>
END;