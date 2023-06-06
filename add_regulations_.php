<?php
	//Запускаем сессию
	session_start();

	
	//Определяем переменную для переключателя
	$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;
	$err = array();

$title = 'Страница добавления ревизорского предписания';
include_once('block/header.php');
include_once('block/conect_db.php');

$railways_query = $pdo->query('SELECT * FROM `railways`');
while ($row = $railways_query->fetch(PDO::FETCH_OBJ)) {
    $html1 .= "<option value={$row->id_railway}> {$row->railway_shot}</option>";
};


?>
<div class="main">
    <div class="container">
        <h1>Страница добавления ревизорского предписания:</h1>
        
<!--<?php include 'html/regulations.html'?> -->
<div class="form_reg">

    <form class="forms_item" id="data" method="POST" enctype="multipart/form-data">
        <h2>Регистрация на сайте:</h2>
        <h3>Поля со звездочкой обязательны для заполнения!</h3>

            <div class="first_section">
                <div class="row railway">
                    <label for="railway">* Укажите дорогу</label>
                    <select name="id_railways" id="id_railways">
                    <option>Выберите из списка</option>
                        <?php echo $html1 ?>
                    </select>
                </div>
                <div class="row date">
                    <label for="date_given">* Укажите дату выдачи РП</label>
                    <input type="date" name="date_given" id="date_given" placeholder="Дата выдачи">
                </div>
                <div class="row number">
                    <label for="number">* Номер предписания </label>
                    <input type="text" name="number_regulations" id="number_regulations" placeholder="Укажите номер предписания">
                </div>
            </div>
            <div class="second_section">
                <div class="row file_add">
                    <label for="file_add">* Прикрепите файл</label>
                    <input type="file" name="file" id="file" placeholder="Файл">
                </div>
                <div class="row who_add">
                    <label for="who_add">* Кем выдано предписание?</label>
                    <input type="text" name="who_given" id="who_given" placeholder="Кем выдано предписание">
                </div>
            </div>

            <div class="row what_violation">
                <label for="what_violation">* Что нарушено? (кратко, пункты и документы)</label>
                <textarea id="what_violation" name="what_violation" rows="7"> </textarea>
            </div>
            <div class="third_section">
            <div class="row object">
                <label for="object">* Объект проверки</label>
                <input type="text" name="object" id="object" placeholder="Объект проверки">
            </div>
            <div class="row date">
                <label for="term_date">* Укажите срок исполнения</label>
                <input type="date" name="term_date" id="term_date" placeholder="Срок устранения">
            </div>
            
            </div>

            <input type="hidden" name="ip_add_new" id="ip_add_new" value="<?=$ip?>" placeholder="<?=$ip?>">
            <input type="hidden" name="id_user" id="id_user" value="<?=$id_user?>" placeholder="<?=$id_user?>">
            
        <div class="error">
            <div class="error-mess" id="error-block"></div>
        </div>

        <div class="form_btn">
            <button>Submit</button>
            <button type="button" id = "history-button">Назад</button>            
        </div>



    </form>
</div>

<!-- -->
    </div>
</div>
<?php include_once 'block/footer.php';?>


<script>

    $("form#data").submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);

        console.log(formData);

        $.ajax({
            url: 'ajax/add_order.php',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    $("#user_reg").text("Предписание внесено в БД!");
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

    /*----Кнопка назад----*/
    document.getElementById('history-button').addEventListener('click', () => {
        history.back();
    });
</script>

</body>

</html>