<?php
include_once 'block/header.php';
$id = trim(filter_var($_REQUEST['id'], FILTER_SANITIZE_SPECIAL_CHARS));
$edit =  trim(filter_var($_REQUEST['edit'], FILTER_SANITIZE_SPECIAL_CHARS));
$title = 'Удаление ревизорского предписания';
include_once 'block/conect_db.php';
$date_now = date("d.m.Y");

$railways_query = $pdo->query('SELECT * FROM `railways`');
while ($row = $railways_query->fetch(PDO::FETCH_OBJ)) {
    $html1 .= "<option value={$row->id_railway}> {$row->railway_shot}</option>";
};

$branch_cd_query = $pdo->query('SELECT * FROM `branch_cd`');
while ($row = $branch_cd_query->fetch(PDO::FETCH_OBJ)) {
    $html2 .= "<option value={$row->id_branch_cd}> {$row->shot_name}</option>";
};



switch ($edit) {
    case '1':
        $title_h1 = 'Откорректировать ревизорское предписание от';
        $title_h2 = 'Откорректировать ревизорское предписание';
        $btn = 'Изменить';
        break;
    case '2':
        $title_h1 = 'Удалить ревизорское предписание от';
        $title_h2 = 'Удалить ревизорское предписание';
        $btn = 'Удалить';
        break;
}

$query = $pdo->prepare("SELECT * FROM `regulations` JOIN `railways` ON regulations.id_railways = railways.id_railway JOIN `branch_cd` ON regulations.whom_given_branch = branch_cd.id_branch_cd WHERE `id_regulations` = ?");
$query->execute([$id]);
$row = $query->fetch(PDO::FETCH_OBJ);
?>

<main class="main">
    <div class="container">
        <h1><?=$title_h1 . date('d.m.Y', strtotime($row->date_given)) ?> № <?=$row->number_regulations?></h1>
        <form class="forms_item" id="delete_rp" method="POST">
                <h2><?=$title_h2?></h2>
                

                <div class="first_section">
                    <div class="row railway">
                        <label for="railway">Дорога</label>
                        <!--<input type="text" name="railway" id="railway" value="<?=$row->railway_shot?>">-->
                        <select name="id_railways" id="id_railways">
                            <option value="<?=$row->id_railways?>"><?=$row->railway_shot?></option>
                            <?php echo $html1 ?>
                        </select>
                    </div>
                    <div class="row date">
                        <label for="date_given">Дата выдачи РП</label>
                        <input type="date" name="date_given" id="date_given" value="<?=$row->date_given?>">
                    </div>
                    <div class="row number">
                        <label for="number">Номер предписания </label>
                        <input type="text" name="number_regulations" id="number_regulations" value="<?=$row->number_regulations?>">
                    </div>
                </div>
                <div class="second_section">
                    <div class="row file_add">
                        <label for="file_add">Прикрепленный файл</label>
                        <input type="text" name="file" id="file" disabled placeholder="<?=$row->path_file?>">
                    </div>
                    <div class="row who_add">
                        <label for="who_add">Кем выдано предписание?</label>
                        <input type="text" name="who_given" id="who_given" value="<?=$row->who_given?>">
                    </div>
                </div>
                <div class="second_section">
                    <div class="row own">
                        <label for="whom_given_branch">Кому выдано предписание [ЦД, Д, ДЦС, ДС]?</label>
                        <!--<input type="text" name="whom_given_branch" id="whom_given_branch" value="<?=$row->shot_name?>">-->
                        <select name="whom_given_branch" id="whom_given_branch">
                            <option value="<?=$row->whom_given_branch?>"><?=$row->shot_name?></option>
                            <?php echo $html2 ?>
                        </select>
                    </div>
                    <div class="row own">
                        <label for="who_add">Кому выдано предписание [ФИО]?</label>
                        <input type="text" name="whom_given" id="whom_given" value="<?=$row->whom_given?>">
                    </div>
                </div>
                <div class="row what_violation">
                    <label for="what_violation">Что нарушено? (кратко, пункты и документы)</label>
                    <!--<input type="text" name="what_violation" id="what_violation" value="<?=$row->what_violation?>">-->
                    <textarea id="what_violation" name="what_violation" rows="7"><?=$row->what_violation?></textarea>
                </div>

                <div class="second_section">
                    <div class="row documents">
                        <label for="err_doc">Нормативные документы которые нарушены</label>
                        <input type="text" name="err_doc" id="err_doc" value="<?=$row->err_doc?>">
                    </div>
                    <div class="row err">
                        <label for="err_item">Пункты нарушенных документов</label>
                        <input type="text" name="err_item" id="err_item" value="<?=$row->err_item?>">
                    </div>
                </div>
                <div class="third_section">
                    <div class="row object">
                        <label for="object">Объект проверки</label>
                        <input type="text" name="object" id="object" value="<?=$row->object?>">
                    </div>
                    <div class="row date">
                        <label for="term_date">Срок исполнения</label>
                        <input type="date" name="term_date" id="term_date" value="<?=$row->term_date?>">
                    </div>
                </div>

                <input  type="hidden" name="ip_add_new" id="ip_add_new" value="<?= $ip_user ?>" placeholder="<?= $ip_user ?>">
                <input type="hidden" name="id_user" id="id_user" value="<?= $id_user ?>" placeholder="<?= $id_user ?>">

                <div class="error">
                    <div class="error-mess" id="error-block"></div>
                </div>

                <div class="form_btn">
                    <button type="button" id="del"><?=$btn?></button>
                    <button type="button" id="history-button">Назад</button>
                </div>



            </form>
        </form>

    </div>
</main>
<?php include_once("block/footer.php");?>

<script>
//Ищем какой ID записи
let searchParams = new URLSearchParams(window.location.search);
    searchParams.has('id');
    searchParams.has('edit');
    let id = searchParams.get('id');
    let edit = searchParams.get('edit');
    //let edit = searchParams.get('edit');
    

//Удаление предписания
        $('#del').click(function() {
           // let task = $('#task').val();
            let id_railways = $('#id_railways').val();
            let date_given = $('#date_given').val();
            let num_reg = $('#number_regulations').val();
            let who_given = $('#who_given').val();
            let whom_given_branch = $('#whom_given_branch').val();
            let whom_given = $('#whom_given').val();
            let what_violation = $('#what_violation').val();
            let err_item = $('#err_item').val();
            let err_doc = $('#err_doc').val();
            let object = $('#object').val();
            let term_date = $('#term_date').val();
            let id_user = $('#id_user').val();
            let ip_add_new = $('#ip_add_new').val();

            console.log('ID' + id_railways);


            var result = confirm('Вы уверены?')
            if (result){
                $.ajax({
                    url: 'ajax/del_rp.php',
                    type: 'POST',
                    cache: false,
                    data: {
                        'id': id,
                        'edit': edit,

                        'id_railways': id_railways,
                        'date_given': date_given,
                        'num_reg': num_reg,
                        'who_given': who_given,
                        'whom_given_branch': whom_given_branch,
                        'whom_given': whom_given,
                        'what_violation': what_violation,
                        'err_item': err_item,
                        'err_doc': err_doc,
                        'object': object,
                        'term_date': term_date,
                        'id_user': id_user,
                        'ip_add_new' : ip_add_new

                    },
                    dataType: 'html',
                    success: function(data) {
                        console.log(data);
                    if (data == 1) {
                            $("#edit_todo").text("РП Удалено!");
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
            }
            else{
                alert('Удаление не выполнено!')
            }
        });


        /*----Кнопка назад----*/
        document.getElementById('history-button').addEventListener('click', () => {
            history.back();
        });

</script>

</body>
</html>



































