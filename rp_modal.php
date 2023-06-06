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
            <tr class="{$color_row}">
                <td> {$row->railway_shot} </td> 
                <td> {$given_date} </td>
                <td style='text-align:center';> <a href="{$row->path_file}" title="Скачать"> {$row->number_regulations}<i style="margin:0; padding:0; margin-left:5px;" class="fa-solid fa-file-pdf"></i></a> </td>
                <td> {$row->who_given} </td>
                <td> {$row->what_violation} </td>
                <td> {$row->object} </td>
                <td> {$term_date} </td>
                    <td style='margin:0; padding:0; '>
                        <div id='edit'>
                            <span><a class="popup-open" eventid = "$row->id_regulations" href="#"><i class='fa-solid fa-pencil'></i></a></span><br>
                        </div>
END;
    if ($row->what_closed_telegram !== NULL) {
        echo "<a style='padding:0;' href='#'>Телеграмма {$row->what_closed_telegram}<i class='fa-solid fa-file-pdf' style='padding:0'; ></i></a><br>";
    };
    echo '<br>';
    if ($row->what_closed_protocol !== NULL) {
        echo "<a style='padding:0;'' href='#'>Протокол {$row->what_closed_protocol}<i class='fa-solid fa-file-pdf' style='padding:0;'></i></a><br>";
    };
    echo '<br>';
    if ($row->what_closed_report !== NULL) {
        echo "<a style='padding:0;' href='#'>Отчет {$row->what_closed_report}<i class='fa-solid fa-file-pdf' style='padding:0;'></i></a>";
    };
    echo '<br>';
    echo <<<END
                    </td>
                <td class="$color_danger" style='vertical-align: top;'>
                <div id='editt'>
                    <div id='edit_1'><span><a class="popup-open-date" eventid = "$row->id_regulations" href="#"><i class='fa-solid fa-pencil'></i></a></span></div>
                <div id='edit_2'>{$rem_date}</div> 
                </div>
                    </td>
            </tr>
END;
};

//echo $html;
?>

                </tbody>
            </table>
        </div>
        <p class="style__date">Сегодня: <?php echo $date_now ?> </p>
    </div>


    <!--                 модальное окно                    -->
    <div class="popup-fade">
    <div class="popup">
        <a class="popup-close" href="#">Закрыть</a>
        <p>Чем закрыт документ:</p>
        <form id="data-files" method="POST" enctype="multipart/form-data">
            <label for="telegrama">В случае направления телеграммы, прикрепите файл: </label>
            <input type="file" id="telegrama" name="telegrama">
            <label for="protocol">Если проведен разбор нарушений, прикрепите файл: </label>
            <input type="file" id="protocol" name="protocol">
            <label for="report">Прикрепите отчет, который был направлен для снятия с контроля предписание: </label>
            <input type="file" id="report" name="report">

            <input type="hidden" name="id_rp" id="id_rp" value=<?=$id?>>
            <input type="hidden" name="id_user" id="id_user" value="<?=$id_user?>" placeholder="<?=$id_user?>">

            <div class="info">
                <div class="error-mess" id="error-block"></div>
                <button id = "set_files">Записать</button>
                <button type="button" id="history-button">Назад</button>
            </div>
        </form>
        
    </div>
</div>

<!--                 модальное окно             -->       
    <div class="popup-fade-date">
    <div class="popup-date">
        <a class="popup-close-date" href="#">Закрыть</a>
        <p>Снять с контроля</p>
        <form class="close-date" id="close-date" method="POST">
            <label for="date_rem">Укажите дату снятия с контроля в АС РБ КН (предписания): </label>
            <input type="date" id="val_date_rem" name="date_rem">

            <div class="info">
                <div class="error-mess" id="error-block"></div>
                <button type="button" id="date_rem">Снять с контроля</button>
                <button type="button" id="history-button">Назад</button>
            </div>
        </form>
        
    </div>
</div>

</main>


<?php include_once("block/footer.php")?>

</div>

<script>
    // модалка1 
$(document).ready(function($) {
	$('.popup-open-date').click(function() {
		idevent = $(this).attr("eventid");
		$('.popup-fade-date').fadeIn();
		return false;
	});	
    
	
	$('.popup-close-date').click(function() {
		$(this).parents('.popup-fade-date').fadeOut();
		return false;
	});		

	$(document).keydown(function(e) {
		if (e.keyCode === 27) {
			e.stopPropagation();
			$('.popup-fade-date').fadeOut();
		}
	});
	
	$('.popup-fade-date').click(function(e) {
		if ($(e.target).closest('.popup-date').length == 0) {
			$(this).fadeOut();					
		}
	});	
});

// модалка1 

// модалка2
$(document).ready(function($) {
	$('.popup-open').click(function() {
		idevent = $(this).attr("eventid");
		$('.popup-fade-date').fadeIn();
		return false;
	});	
    
	
	$('.popup-close').click(function() {
		$(this).parents('.popup-fade').fadeOut();
		return false;
	});		

	$(document).keydown(function(e) {
		if (e.keyCode === 27) {
			e.stopPropagation();
			$('.popup-fade').fadeOut();
		}
	});
	
	$('.popup-fade').click(function(e) {
		if ($(e.target).closest('.popup').length == 0) {
			$(this).fadeOut();					
		}
	});	
});
// модалка2 

//обработка первого модального
$("form#data-files").submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: 'ajax/add_file.php',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    $("#set_files").text("Предписание внесено в БД!");
                    $("#error-block").hide();
                    window.location.replace("rp.php");
                    //header('Location:http://portalcd.loc/todo.php');
                    document.location.reload(true);
                    exit;
                } else {
                    $("#error-block").show();
                    $("#error-block").text(data);
                }
            }

        });
    });

    //обработка второго модального

    $('#date_rem').click(function() {
            let date_rem = $('#val_date_rem').val();
            let id_rp = $(this).attr("eventid");
            console.log(id_rp);

            $.ajax({
                url: 'ajax/rp_date_rem.php',
                type: 'POST',
                cache: false,
                data: {
                    'date_rem': date_rem,
                    'id_rp':id_rp
                },
                dataType: 'html',
                success: function(data) {
                    console.log(data);
                    if (data == 1) {
                        $("#date_rem").text("Внесено");
                        $("#error-block").hide();
                        window.location.replace("rp.php");
                        /*header('Location:http://portalcd.loc/todo.php');
                        document.location.reload(true);
                        exit;*/
                    } else {
                        $("#error-block").show();
                        $("#error-block").text(data);
                    }
                }
            });
        });
        /*----Кнопка назад----*/
        document.getElementById('history-button').addEventListener('click', () => {
            history.back();
        });







</script>


</body>
</html>

