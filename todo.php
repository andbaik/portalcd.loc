<?php
include_once("block/header.php");

$title = "Контроль документов отдела";


$admin = $user['AB_admin_cd'] == 1 ? $admin = 1 : $admin = 0;?>



    <main class="container">
        <h1>Контроль документов отдела</h1>
        <div class="table">
            <div class="table__row">
                <div class="row__title">
                    <div class="rotate">важно</div>
                </div>
                <div class="row__main">
                    <div class="do__left">
                        <div class="do__plus"> <a href="../edit_todo.php?edit=2&section=1">Добавить документ:  <i class="fa-solid fa-plus"></a></i></div>
                        <div class="do__table">
                            <table class="table grey">
                                <?php
                                include_once 'block/conect_db.php';
                                $query = $pdo->query('SELECT * FROM `todo` WHERE `zone` = 1 AND `status` = 0');
                                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                                    $date = date('d.m.Y', strtotime($row->date));
                                    if ($admin == 1){                                    
                                    $html .= "
                                            <tr>
                                                <td> {$row->task}  <strong>$date</strong>   {$row->who}  {$row->number}  {$row->note}</td> 
                                                <td>   <a href='../edit_todo.php?edit=1&id={$row->id}&section={$row->zone}' . ><i class='fa-solid fa-pencil'></i></..></td>
                                                <td> <a href='../edit_todo.php?edit=4&id={$row->id}&section={$row->zone}'> <i class='fa-solid fa-check'></i></a></td>
                                                <td> <a href='../edit_todo.php?edit=3&id={$row->id}&section={$row->zone}'> <i class='fa-solid fa-trash-can'></i></a></td>
                                            </tr>
                                            ";}
                                            else{
                                                $html .= "
                                                <tr>
                                                    <td> {$row->task}  <strong>$date</strong>   {$row->who}  {$row->number}  {$row->note}</td> 
                                                    <td>   <a href='../edit_todo.php?edit=1&id={$row->id}&section={$row->zone}' . ><i class='fa-solid fa-pencil'></i></..></td>
                                                    <td> <a href='../edit_todo.php?edit=4&id={$row->id}&section={$row->zone}'> <i class='fa-solid fa-check'></i></a></td>
                                                </tr>
                                                ";
                                            }
                                };
                                echo $html;
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="do__right">
                    <div class="do__plus"> <a href="../edit_todo.php?edit=2&section=3">Добавить документ:  <i class="fa-solid fa-plus"></a></i></div>
                        <div class="do__table">
                        <table class="table">
                                <?php
                                include_once 'block/conect_db.php';
                                $query = $pdo->query('SELECT * FROM `todo` WHERE `zone` = 3 AND `status` = 0');
                                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                                    $date = date('d.m.Y', strtotime($row->date));
                                    if ($admin == 1){
                                    $html2 .= "
                                            <tr>
                                                <td> {$row->task}  <strong>$date</strong>   {$row->who}  {$row->number}  {$row->note}</td> 
                                                <td>   <a href='../edit_todo.php?edit=1&id={$row->id}&section={$row->zone}' . ><i class='fa-solid fa-pencil'></i></..></td>
                                                <td> <a href='../edit_todo.php?edit=4&id={$row->id}&section={$row->zone}'> <i class='fa-solid fa-check'></i></a></td>
                                                <td> <a href='../edit_todo.php?edit=3&id={$row->id}&section={$row->zone}'> <i class='fa-solid fa-trash-can'></i></a></td>
                                            </tr>
                                            ";}
                                            else {
                                                $html2 .= "
                                            <tr>
                                                <td> {$row->task}  <strong>$date</strong>   {$row->who}  {$row->number}  {$row->note}</td> 
                                                <td>   <a href='../edit_todo.php?edit=1&id={$row->id}&section={$row->zone}' . ><i class='fa-solid fa-pencil'></i></..></td>
                                                <td> <a href='../edit_todo.php?edit=4&id={$row->id}&section={$row->zone}'> <i class='fa-solid fa-check'></i></a></td>
                                            </tr>
                                            ";
                                            }
                                };
                                echo $html2;
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table__row">
                <div class="row__title">
                    <div class="rotate">не&nbspважно</div>
                </div>
                <div class="row__main">
                    <div class="do__left">
                    <div class="do__plus"> <a href="../edit_todo.php?edit=2&section=2">Добавить документ:  <i class="fa-solid fa-plus"></a></i></div>
                        <div class="do__table">
                        <table class="table">
                                <?php
                                include_once 'block/conect_db.php';
                                $query = $pdo->query('SELECT * FROM `todo` WHERE `zone` = 2 AND `status` = 0');
                                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                                    $date = date('d.m.Y', strtotime($row->date));
                                    if ($admin == 1){
                                        $html3 .= "
                                                <tr>
                                                    <td> {$row->task}  <strong>$date</strong>   {$row->who}  {$row->number}  {$row->note}</td> 
                                                    <td>   <a href='../edit_todo.php?edit=1&id={$row->id}&section={$row->zone}' . ><i class='fa-solid fa-pencil'></i></..></td>
                                                    <td> <a href='../edit_todo.php?edit=4&id={$row->id}&section={$row->zone}'> <i class='fa-solid fa-check'></i></a></td>
                                                    <td> <a href='../edit_todo.php?edit=3&id={$row->id}&section={$row->zone}'> <i class='fa-solid fa-trash-can'></i></a></td>
                                                </tr>
                                                ";}
                                                else {
                                                    $html3 .= "
                                                <tr>
                                                    <td> {$row->task}  <strong>$date</strong>   {$row->who}  {$row->number}  {$row->note}</td> 
                                                    <td>   <a href='../edit_todo.php?edit=1&id={$row->id}&section={$row->zone}' . ><i class='fa-solid fa-pencil'></i></..></td>
                                                    <td> <a href='../edit_todo.php?edit=4&id={$row->id}&section={$row->zone}'> <i class='fa-solid fa-check'></i></a></td>
                                                </tr>
                                                ";
                                                }
                                };
                                echo $html3;
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="do__right">
                    <div class="do__plus"> <a href="../edit_todo.php?edit=2&section=4">Добавить документ:  <i class="fa-solid fa-plus"></a></i></div>
                        <div class="do__table">
                        <table class="table">
                                <?php
                                include_once 'block/conect_db.php';
                                $query = $pdo->query('SELECT * FROM `todo` WHERE `zone` = 4 AND `status` = 0');
                                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                                    $date = date('d.m.Y', strtotime($row->date));
                                    if ($admin == 1){
                                        $html4 .= "
                                                <tr>
                                                    <td> {$row->task}  <strong>$date</strong>  {$row->who}  {$row->number}  {$row->note}</td> 
                                                    <td>   <a href='../edit_todo.php?edit=1&id={$row->id}&section={$row->zone}' . ><i class='fa-solid fa-pencil'></i></..></td>
                                                    <td> <a href='../edit_todo.php?edit=4&id={$row->id}&section={$row->zone}'> <i class='fa-solid fa-check'></i></a></td>
                                                    <td> <a href='../edit_todo.php?edit=3&id={$row->id}&section={$row->zone}'> <i class='fa-solid fa-trash-can'></i></a></td>
                                                </tr>
                                                ";}
                                                else {
                                                    $html4 .= "
                                                <tr>
                                                    <td> {$row->task}  <b>$date</b>  {$row->who}  {$row->number}  {$row->note}</td> 
                                                    <td>   <a href='../edit_todo.php?edit=1&id={$row->id}&section={$row->zone}' . ><i class='fa-solid fa-pencil'></i></..></td>
                                                    <td> <a href='../edit_todo.php?edit=4&id={$row->id}&section={$row->zone}'> <i class='fa-solid fa-check'></i></a></td>
                                                </tr>
                                                ";
                                                }
                                };
                                echo $html4;
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="futer__title">
                <div class="title__left">не срочно</div>
                <div class="title__right">срочно</div>
            </div>
        </div>
        <p class="date"><?= date("Сегодня: d.m.Y") ?></p>
    </main>
    <?php include_once("block/footer.php"); ?>

        <!-- Кнопка наверх -->
        <div id="scrollup"><img class="up" alt="Прокрутить вверх" src="img/btn_up.png"></div>
        <script src="js/scroll_smoth.js"></script>
        <!--<script src="js/scrollup.js"></script>-->

</body>
</html>