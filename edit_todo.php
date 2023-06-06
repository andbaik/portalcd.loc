<?php
include 'block/header.php';

$edit = $_GET['edit']; 
$id = $_GET['id'];
$section = $_GET['section'];

switch ($edit){
    case '1':
        $title = 'Редактирование записи';
        $btn_edit = 'Исправить';
        break;
    case '2':
        $title = 'Добавление записи';
        $btn_edit = 'Добавить';
        break;
    case '3':
        $title = 'Удалить запись';
        $btn_edit = 'Удалить';
        break;
    case '4':
        $title = 'Переместить в архив';
        $btn_edit = 'Архив';
        break;
    default:
        $title = 'Что-то пошло не так!';
        $btn_edit = 'Сообщить администратору';
        break;
     }
?>

    <?php 
    include_once 'block/conect_db.php';
    $query = $pdo->prepare('SELECT * FROM `todo` WHERE `id` = ?');
    $query->execute(array($id));
    $row = $query->fetch(PDO::FETCH_OBJ);
    ?>
    <div class="container">
        <h1><?=$title?></h1>
                    
        <form>
        <label for="task">Задание</label>
            <input type="text" name="task" id="task" <?php echo $edit == 1 || $edit == 2 ? 'value = "' : 'placeholder = "'?> <?=$row->task?>">

            <label for="date">Дата</label>
            <input type="date" name="date" id="date" value = "<?=$row->date?>">

            <label for="who">Исполнитель</label>
            <input type="text" name="who" id="who" <?php echo $edit == 1 || $edit == 2 ? 'value = "' : 'placeholder = "'?><?=$row->who?>">

            <label for="number">Номер документа</label>
            <input type="text" name="number" id="number" <?php echo $edit == 1 || $edit == 2 ? 'value = "' : 'placeholder = "'?><?=$row->number?>">

            <label for="note">Где сейчас</label>
            <input type="note" name="note" id="note" <?php echo $edit == 1 || $edit == 2 ? 'value = "' : 'placeholder = "'?><?=$row->note?>">


            <div class="select">
                <div class="select__left">
                    <label>Секция 1<input type="radio" name="zone" id="zone" value="1" <?php echo $section == 1 ? 'checked' : ''?>></label> 
                    <label>Секция 2<input type="radio" name="zone" id="zone" value="2" <?php echo $section == 2 ? 'checked' : ''?>></label> 
                </div>
                <div class="select__right">
                    <label>Секция 3<input type="radio" name="zone" id="zone" value="3" <?php echo $section == 3 ? 'checked' : ''?>></label> 
                    <label>Секция 4<input type="radio" name="zone" id="zone" value="4" <?php echo $section == 4 ? 'checked' : ''?>></label>              
                </div>
            </div>

            <?php
                if ($edit == 4){ ?>
                    <label for="date_arch">Дата перемещения в архив</label>
                    <input type="text" name="date_arch" id="date_arch" value = "<?=date("d.m.Y")?>">

                    <label for="text_status">Причина перемещения в архив</label>
                    <input type="text" name="text_status" id="text_status" placeholder = 'Внесите чем выполнено?'>

                <?php } ?>


<div class="info">
            <div class="error-mess" id="error-block"></div>
            <button type="button" id="edit_todo"><?=$btn_edit?></button>
            <button type="button" id="history-button">Назад</button>
</div>

        </form>

        
    </div>
    <?php include_once ("block/footer.php"); ?>
    

    </body>

    <script>
    //Ищем какой ID записи
    let searchParams = new URLSearchParams(window.location.search);
    searchParams.has('id');
    let id = searchParams.get('id');
    let edit = searchParams.get('edit');
    

        $('#edit_todo').click(function() {
            let task = $('#task').val();
            let date = $('#date').val();
            let who = $('#who').val();
            let number = $('#number').val();
            let note = $('#note').val();
            let zone = $('#zone:checked').val(); //берем значение активной радиокнопки
            let date_arch = $('#date_arch').val();
            let text_status = $('#text_status').val();
            

            $.ajax({
                url: 'ajax/edit_todo.php',
                type: 'POST',
                cache: false,
                data: {
                    'id': id,
                    'edit': edit,
                    'task': task,
                    'date': date,
                    'who': who,
                    'number': number,
                    'note': note,
                    'zone': zone,
                    'date_arch' : date_arch,
                    'text_status' : text_status

                },
                dataType: 'html',
                success: function(data) {
                    console.log(data);
                    if (data == 1) {
                        $("#edit_todo").text("Все готово");
                        $("#error-block").hide();
                        window.location.replace("todo.php");
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


</html>