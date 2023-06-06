<?php
$title = 'Адресная книга ЦД';



include 'block/header.php';
include 'func/convertphone.php';

$admin = $user['AB_admin_cd'] == 1 ? $admin = 1 : $admin = 0;
?>

<body>
    <main class="main">
        <div class="container">

            <div class="main-table">
                <h2>Адресная книга:</h2>

                <div class="search_block">
                    <div class="placeholder-form">
                        <div class="placeholder-container">
                            <input class="search-input" type="text" placeholder="Введите несколько букв для фильтрации" />
                            <label>Поиск по фамилии, введите несколько букв</label>
                        </div>
                        <?php
                        if ($admin == 1) {
                            echo '<div class="do__plus"> <a href="../adress_add.php?edit=2">Добавить работника: <i class="fa-solid fa-plus"></a></i></div>';
                        }
                        ?>
                    </div>
                </div>

                <?php include_once 'block/conect_db.php';
                $query_depats = $pdo->query("SELECT * FROM depats");
                foreach ($query_depats as $row_depats) {

                    echo <<<HTML
                        <h2 class="center filter-row"> {$row_depats['depat']} </h2>
                    HTML;
                    if ($row_depats['id_depat'] == 1) {
                        $query_admin = $pdo->query("SELECT * FROM adressbook JOIN posts ON adressbook.id_post = posts.id_post WHERE id_depat=1 AND id_branch=42 ORDER BY id_sort");

                        echo '<table class="filter-table">';
                        echo '<tbody>';

                        foreach ($query_admin as $row_admin) {
                            echo '<tr class="filter-row">';
                            echo '<td class="filter-title">' . $row_admin['surname'] . ' ' . $row_admin['name'] . ' ' . $row_admin['patronymic'] . '</td>';
                            echo '<td class="td_post">' . $row_admin['post'] . '</td>';
                            echo '<td class="td_room">' . $row_admin['room'] . '</td>';
                            echo '<td class="td_phone">';
                            echo '<p>т. ' . $row_admin['telephone'] . '</p>';
                            if (!empty($row_admin['telephone_s'])) {
                                echo '<p> с. ' . $row_admin['telephone_s'] . '<p>';
                            }
                            if (!empty($row_admin['telephone_f'])) {
                                echo '<p> ф. ' . $row_admin['telephone_f'] . '</p>';
                            }
                            echo '</td>';
                            if (!empty($row_admin['telephone_m'])) {
                                if ($admin == 1) {
                                    echo '<td class="td_mobi"><p>сот. ' . convertPhone($row_admin['telephone_m']) . '</p></td>';
                                    echo "<td> <a href='../adress_add.php?edit=1&id={$row_admin['id_user']}'> <i class='fa-solid fa-pencil'></i></a></td>";
                                }
                            } else {
                                echo '<td></td>';
                            }

                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo '<table class="filter-table">';
                        echo '<tbody>';
                        $query_admin_branch = $pdo->query("SELECT * FROM adressbook JOIN posts ON adressbook.id_post = posts.id_post WHERE id_depat={$row_depats['id_depat']} AND id_admin_branch=1 ORDER BY id_sort");
                        foreach ($query_admin_branch as $row_admin_branch) {

                            echo '<tr class="filter-row">';
                            echo '<td class="filter-title">' . $row_admin_branch['surname'] . ' ' . $row_admin_branch['name'] . ' ' . $row_admin_branch['patronymic'] . '</td>';
                            echo '<td class="td_post">' . $row_admin_branch['post'] . '</td>';
                            echo '<td class="td_room">' . $row_admin_branch['room'] . '</td>';
                            echo '<td class="td_phone">';
                            echo '<p>т. ' . $row_admin_branch['telephone'] . '</p>';
                            if (!empty($row_admin_branch['telephone_s'])) {
                                echo '<br> с. ' . $row_admin_branch['telephone_s'] . '<br>';
                            }
                            if (!empty($row_admin_branch['telephone_f'])) {
                                echo ' ф. ' . $row_admin_branch['telephone_f'];
                            }
                            echo '</td>';
                            if (!empty($row_admin_branch['telephone_m'])) {
                                if ($admin == 1) {
                                    echo '<td class="td_mobi"><p>сот. ' . convertPhone($row_admin_branch['telephone_m']) . '</p></td>';
                                    echo "<td> <a href='../adress_add.php?edit=1&id={$row_admin_branch['id_user']}'> <i class='fa-solid fa-pencil'></i></a></td>";
                                }
                            } else {
                                echo '<td></td>';
                            }
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    }

                    $query_branch = $pdo->query("SELECT * FROM branch WHERE id_depat={$row_depats['id_depat']}");
                    foreach ($query_branch as $row_branch) {
                        if ($row_branch['id_branch'] <> 42) {
                            echo  '<h3 class="filter-row">' . $row_branch['branch'] . '</h3><br/>';

                            $query_all = $pdo->query("SELECT * FROM adressbook JOIN posts ON adressbook.id_post = posts.id_post WHERE id_depat={$row_depats['id_depat']} AND id_branch={$row_branch['id_branch']} AND id_admin_branch=0 ORDER BY id_sort");
                            echo '<table class="filter-table">';
                            echo '<tbody>';
                            foreach ($query_all as $row_all) {
                                echo '<tr class="filter-row">';
                                echo '<td class="filter-title">' . $row_all['surname'] . ' ' . $row_all['name'] . ' ' . $row_all['patronymic'] . '</td>';
                                echo '<td class="td_post">' . $row_all['post'] . '</td>';
                                echo '<td class="td_room">' . $row_all['room'] . '</td>';
                                echo '<td class="td_phone">';
                                echo '<p>т. ' . $row_all['telephone'] . '</p>';
                                if (!empty($row_all['telephone_s'])) {
                                    echo '<br> с. ' . $row_all['telephone_s'] . '<br>';
                                }
                                if (!empty($row_all['telephone_f'])) {
                                    echo ' ф. ' . $row_all['telephone_f'];
                                }
                                echo '</td>';
                                if (!empty($row_all['telephone_m'])) {
                                    if ($admin == 1) {
                                        echo '<td class="td_mobi"><p>сот. ' . convertPhone($row_all['telephone_m']) . '</p></td>';
                                        echo "<td> <a href='../adress_add.php?edit=1&id={$row_all['id_user']}'> <i class='fa-solid fa-pencil'></i></a></td>";
                                    }
                                } else {
                                    echo '<td></td>';
                                }
                                echo '</tr>';
                            }
                            echo '</tbody>';
                            echo '</table>';
                        }
                    }
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