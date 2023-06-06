<?php
session_start();
print_r ('USER =' . $user);
$title = 'Полезные ссылки';
include 'block/header.php';
$admin = $user['AB_admin_cd'] == 1 ? $admin = 1 : $admin = 0;
?>

<body>

    <div class="container">
        <div class="main-table">
            <h2>Ссылки на ресурсы:</h2>
            <br>
            <?php
            include_once 'block/conect_db.php';?>

        <table class="table  table-responsive table-hover">
            <thead class="table-secondary">
                <tr>
                    <th>Короткое название </th>
                    <th>Полное название автоматизированной системы </th>

                    <?php if ($admin == 1)
                        echo '<th><a class="popup-open" href="#">+</a></th>';?>

                </tr>
            </thead>
        <tbody>

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

    <div class="popup-fade">
        <div class="popup">
            <a class="popup-close" href="#">Закрыть</a>
            <p>Добавить ссылку</p>
            <form action="#">
                <label for="shot_name">Короткое имя </label>
                <input type="text" id="shot_name">
                <label for="nameLink">Полное наименование </label>
                <input type="text" id="nameLink">
                <label for="link">Ссылка на ресурс </label>
                <input type="text" id="link">

                <div class="info">
                    <div class="error-mess" id="error-block"></div>
                    <button type="button" id="add_link">Добавить ресурс</button>
                </div>
            </form>
            
        </div>
    </div>


    <?php include_once ("block/footer.php"); ?>

            <!-- Кнопка наверх -->
            <div id="scrollup"><img class="up" alt="Прокрутить вверх" src="img/btn_up.png"></div>

        <script src="js/scroll_smoth.js"></script>
        <script src="js/scrollup.js"></script>
        <script src="js/popup.js"></script>
        


        <!-- реализовать добавление ресурсов -->
        <script>
            $('#add_link').click(function() {
            let shot_name = $('#shot_name').val();
            let nameLink = $('#nameLink').val();
            let link = $('#link').val();

            $.ajax({
                url: 'ajax/add_link.php',
                type: 'POST',
                cache: false,
                data: {
                    'shot_name': shot_name,
                    'nameLink': nameLink,
                    'link': link,
                },
                dataType: 'html',
                success: function(data) {
                    console.log(data);
                    if (data == 1) {
                        $("#add_link").text("Все готово");
                        $("#error-block").hide();
                        /*window.location.replace("todo.php");
                        header('Location:http://portalcd.loc:81/link1.php');*/
                        document.location.reload(true);
                        exit;
                    } else {
                        $("#error-block").show();
                        $("#error-block").text(data);
                    }
                }
            });
        });
        </script>
        <!-- добавление ресурса -->


</body>

</html>