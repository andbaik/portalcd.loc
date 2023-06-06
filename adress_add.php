<?php
$edit = $_GET['edit'];
$id_edit = $_GET['id'];
$title = 'Страница добавления в адрессную книгу';

switch ($edit) {
    case '1':
        $title = 'Редактирование записи';
        $btn_edit = 'Исправить';
        $h1 = 'Редактирование записи:';
        $h2 = 'Редактирование адресата:';
        $btn_title = 'user_add';
        break;
    case '2':
        $title = 'Добавление записи';
        $btn_edit = 'Добавить';
        $h1 = 'Добавление нового пользователя:';
        $h2 = 'Добавление нового адресата:';
        $btn_title = 'user_add';
        break;
        case '3':
            $title = 'Удаление записи';
            $btn_edit = 'Удалить';
            $h1 = 'Внимание! Удаление пользователя:';
            $h2 = 'Удаление пользователя:';
            $btn_title = 'user_add';
            break;
    default:
        $title = 'Что-то пошло не так!';
        $btn_edit = 'Сообщить администратору';
        $h1 = 'Ошибка входа, редактирование невозможно!!!';
        $h2 = 'Ошибка входа, редактирование невозможно!!!';
        break;
}

include_once('block/header.php');
include_once 'block/conect_db.php';

$depats_query = $pdo->query('SELECT * FROM `depats`');
while ($row = $depats_query->fetch(PDO::FETCH_OBJ)) {
    $html1 .= "<option value={$row->id_depat}> {$row->depat}</option>";
};

$branch_query = $pdo->query('SELECT * FROM `branch`');
while ($row1 = $branch_query->fetch(PDO::FETCH_OBJ)) {
    $html2 .= "<option value={$row1->id_branch}> {$row1->branch}</option>";
};

$posts_query = $pdo->query('SELECT * FROM `posts` ORDER BY `post`');
while ($row2 = $posts_query->fetch(PDO::FETCH_OBJ)) {
    $html3 .= "<option value={$row2->id_post}> {$row2->post}</option>";
};

$query = $pdo->prepare('SELECT * FROM `adressbook`  JOIN `depats` ON  adressbook.id_depat = depats.id_depat JOIN `branch` ON adressbook.id_branch = branch.id_branch JOIN `posts` ON adressbook.id_post = posts.id_post WHERE `id_user` = ?');
$query->execute(array($id_edit));
$row = $query->fetch(PDO::FETCH_OBJ);

?>

<div class="main">
    <div class="container">
        <h1><?= $h1 ?></h1>

        <div class="form_reg">

            <form action="#" class="forms_item">
                <h2><?= $h2 ?></h2>
                <h3>Поля со звездочкой обязательны для заполнения!</h3>
                <div class="block_reg">
                    <div class="surn">
                        <label for="surname">*Фамилия</label>
                        <input type="text" name="surname" id="surname" <?php echo $edit == 1 ? "value = {$row->surname}" : 'placeholder="*Фамилия"' ?>>
                    </div>

                    <div class="name">
                        <label for="branch">*Имя</label>
                        <input type="text" name="name" id="name" <?php echo $edit == 1 ? "value = {$row->name}" : 'placeholder="*Имя"' ?>>
                    </div>
                    <div class="patronomic">
                        <label for="patronomic">*Отчество</label>
                        <input type="text" name="patronomic" id="patronomic" <?php echo $edit == 1 ? "value = {$row->patronymic}" : 'placeholder="*Отчество"' ?>>
                    </div>
                    <div class="cab">
                        <label for="room">*№ кабинета</label>
                        <input type="text" name="room" id="room" <?php echo $edit == 1 ? "value = {$row->room}" : 'placeholder="*№ кабинета"' ?>>
                    </div>
                </div>

                <div class="block_reg">
                    <div class="tel">
                        <label for="telephone">*р. телефон</label>
                        <input type="text" name="telephone" id="telephone" <?php echo $edit == 1 ? "value = {$row->telephone}" : 'placeholder="*р. телефон"' ?>>
                    </div>
                    <div class="tel">
                        <label for="telephone_s">телефон секретаря</label>
                        <input type="text" name="telephone_s" id="telephone_s" <?php echo $edit == 1 ? "value = {$row->telephone_s}" : 'placeholder="* секретарь"' ?>>
                    </div>
                    <div class="tel">
                        <label for="telephone_f">факс</label>
                        <input type="text" name="telephone_f" id="telephone_f" <?php echo $edit == 1 ? "value = {$row->telephone_f}" : 'placeholder="* факс"' ?>>
                    </div>
                    <div class="tel">
                        <label for="telephone_m">*мобильный телефон</label>
                        <input type="text" name="telephone_m" id="telephone_m" <?php echo $edit == 1 ? "value = {$row->telephone_m}" : 'placeholder="* Мобильный"' ?>>
                    </div>
                </div>

                <div class="block_reg block_branch">
                    <div class="tel">
                        <label for="depat">*Укажите службу/управление</label>
                        <select name="depat" id="depat">
                            <option <?php echo $edit == 1 ? "value = $row->id_depat" : '' ?>><?php echo $edit == 1 ? $row->depat : 'Укажите службу/управление' ?></option>
                            <?php echo $html1 ?>
                        </select>
                    </div>
                    <div class="tel">
                        <label class="ruk" for="admin_branch">Руководитель?</label>
                        <div class="selected">
                            <label for="admin_branch">да</label>
                            <input type="radio" name="admin_branch" id="admin_branch" <?php echo $edit == 1 && $row->id_admin_branch == 1 ? 'value = "1" checked' : 'value="0"' ?>>
                            <label for="admin_branch">нет</label>
                            <input type="radio" name="admin_branch" id="admin_branch" <?php echo $edit == 1 && $row->id_admin_branch == 0 ? 'value="0" checked' : '' ?>>
                        </div>
                    </div>
                </div>
                <div class="block_reg block_br">
                    <div class="tel">
                        <label for="branch">*Выберите отдел</label>
                        <select name="branch" id="branch">
                            <option <?php echo $edit == 1 ? "value = $row->id_branch" : '' ?>><?php echo $edit == 1 ? $row->branch : 'Укажите отдел' ?></option>
                            <?php echo $html2 ?>
                        </select>
                    </div>
                    <div class="tel">
                        <label for="post">*Выберите должность</label>
                        <select name="post" id="post">
                            <option <?php echo $edit == 1 ? "value = $row->id_post" : '' ?>><?php echo $edit == 1 ? $row->post : 'Укажите должность' ?></option>
                            <?php echo $html3 ?>
                        </select>
                    </div>
                </div>

                <div class="block_reg block_last">
                    <div class="tel">
                        <label for="date_br">*Дата рождения</label>
                        <input type="date" name="date_br" id="date_br" <?php echo $edit == 1 ? "value = {$row->date_br}" : ''; ?>>
                    </div>
                    <div class="tel">
                        <label for="sort">*№ сортировки</label>
                        <input type="text" name="sort" id="sort" <?php echo $edit == 1 ? "value = {$row->id_sort}" : 'placeholder="* № сортировки"' ?>>
                    </div>
                </div>
                <div class="form_btn">
                    <button type="button"  id = "<?=$btn_title?>"><?= $btn_edit ?></button>
                    <button type="button" id="history-button">Назад</button>
                </div>

            </form>

            <div class="info">
                <div class="error-mess" id="error-block"></div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'block/footer.php'; ?>

<script>
    let searchParams = new URLSearchParams(window.location.search);
    searchParams.has('id');
    let id = searchParams.get('id');
    let edit = searchParams.get('edit');
    

    $('#user_add').click(function() {
        let surname = $('#surname').val();
        let name = $('#name').val();
        let patronomic = $('#patronomic').val();
        let room = $('#room').val();
        let telephone = $('#telephone').val();
        let telephone_s = $('#telephone_s').val();
        let telephone_f = $('#telephone_f').val();
        let telephone_m = $('#telephone_m').val();
        let post = $('#post').val();
        let depat = $('#depat').val();
        let branch = $('#branch').val();
        let date_br = $('#date_br').val();
        let sort = $('#sort').val();
        let admin_branch = $('#admin_branch:checked').val();



        $.ajax({
            url: 'ajax/user_add.php',
            type: 'POST',
            cache: false,
            data: {
                'user_id': id,
                'edit': edit,
                'surname': surname,
                'name': name,
                'patronomic': patronomic,
                'room': room,
                'telephone': telephone,
                'telephone_s': telephone_s,
                'telephone_f': telephone_f,
                'telephone_m': telephone_m,
                'post': post,
                'depat': depat,
                'branch': branch,
                'date_br': date_br,
                'sort': sort,
                'admin_branch': admin_branch

            },
            dataType: 'html',
            success: function(data) {
                if (data == 1) {
                    $("#user_add").text("Добавлено!");
                    $("#error-block").hide();
                    window.location.replace("adressbook.php");
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