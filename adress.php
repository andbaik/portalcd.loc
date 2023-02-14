<?php
$title = 'Адресная книга ЦД';
include 'block/header.php';
?>

<body>
    <main class="main">
        <div class="container">

            <div class="main-table">
                <h2>Адресная книга:</h2>

                <div class="placeholder-form">
                    <div class="placeholder-container">
                        <input class="search-input" type="text" placeholder="Введите несколько букв для фильтрации" />
                        <label>Поиск по фамилии, введите несколько букв</label>
                    </div>
                    <div class="do__plus"> <a href="../adress_add.php?edit=2">Добавить работника: <i class="fa-solid fa-plus"></a></i></div>
                </div>

                <?php include_once 'block/conect_db.php';
                $query = $pdo->query("SELECT * FROM `depats` ORDER BY id_depat");
                foreach ($query as $row) {
                    $id_dep = $row['id_depat'];
                    echo "<h2> {$row['depat']} </h2>";


                    if ($id_dep > 1) {

                        $query_us = $pdo->query("SELECT * FROM adressbook   JOIN posts ON adressbook.id_post = posts.id_post WHERE id_depat='$id_dep' AND id_branch='42' ORDER BY id_sort");
                        foreach ($query_us as $row_us) {
                            echo '<table class="table  table-responsive table-hover filter-table">';
                            echo  '<tbody>';
                            echo '<tr class="filter-row">';
                            echo '<td class="filter-title">' . $row_us['surname'] . ' ' . $row_us['name'] . ' ' . $row_us['patronymic'] . '</td>';
                            echo '<td class="td_post">' . $row_us['post'] . '</td>';
                            echo '<td class="td_room">' . $row_us['room'] . '</td>';
                            echo '<td class="td_phone">' . 'т.' .  $row_us['telephone'] . '<br/>';
                            if (!empty($row_us['telephone_s'])) {
                                echo '<br> с.' . $row_us['telephone_s'] . '<br>';
                            }
                            if (!empty($row_us['telephone_f'])) {
                                echo ' ф. ' . $row_us['telephone_f'];
                            };
                            echo '</td>';
                            echo '<td class="td_mobi">' . $row_us['telephone_m'] . '</td>';
                            echo '</tr>';
                            echo '</tbody>';
                            echo '</table>';
                        }
                    }

                    $query_br = $pdo->query("SELECT * FROM `branch` WHERE id_depat = '$id_dep' ORDER BY id_branch");
                    foreach ($query_br as $row_br) {
                        echo '<h3>' . $row_br['branch'] . ' ' . $row_br['branch_sh'] . '</h3>';
                        $id_br = $row_br['id_branch'];

                        $query_user = $pdo->query("SELECT * FROM adressbook   JOIN posts ON adressbook.id_post = posts.id_post WHERE id_depat='$id_dep' AND id_branch= '$id_br' ORDER BY id_sort");
                        foreach ($query_user as $row_user) {
                            echo '<table class="table  table-responsive table-hover filter-table">';
                            echo  '<tbody>';
                            echo '<tr class="filter-row">';
                            echo '<td class="filter-title">' . $row_user['surname'] . ' ' . $row_user['name'] . ' ' . $row_user['patronymic'] . '</td>';
                            echo '<td class="td_post">' . $row_user['post'] . '</td>';
                            echo '<td class="td_room">' . $row_user['room'] . '</td>';
                            echo '<td class="td_phone">' . 'т.' .  $row_user['telephone'] . '<br/>';
                            if (!empty($row_user['telephone_s'])) {
                                echo '<br> с.' . $row_user['telephone_s'] . '<br>';
                            }
                            if (!empty($row_user['telephone_f'])) {
                                echo ' ф. ' . $row_user['telephone_f'];
                            };
                            echo '</td>';
                            echo '<td class="td_mobi">' . $row_user['telephone_m'] . '</td>';
                            echo '</tr>';
                        }
                    }
                    echo <<<END
                            </tbody>
                        </table>
                        <div class="no-found">По вашему запросу ничего не найдено</div>
                        END;
                }
                ?>
            </div>
        </div>

    </main>

    <?php include_once("block/footer.php"); ?>
    <!-- Кнопка наверх -->
    <div id="scrollup"><img class="up" alt="Прокрутить вверх" src="img/btn_up.png"></div>

    <script src="js/scroll_smoth.js"></script>
    <script src="js/scrollup.js"></script>
    <script src="js/popup.js"></script>
    <script src="js/search_input.js"></script>
    <script>
        $('.search-input').jcOnPageFilter();
    </script>
</body>

</html>