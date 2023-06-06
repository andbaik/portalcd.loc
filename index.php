<?php 
    include_once 'block/header.php';
    $title = 'Главная страница';
?>


        <main class="main">
            <div class="container">
                <div class="boxlink">
                    <div class="boxlink__row">
                        <div class="boxlink__item">
                            <div class="boxlink__item_img">
                                <i class="far fa-address-card"></i>
                            </div>
                            <a href="adressbook.php" class="boxlink__item_title"> 
                                Адресная книга
                            </a>
                        </div>
                        <div class="boxlink__item">
                            <div class="boxlink__item_img">
                                <i class="fas fa-external-link-alt"></i>
                            </div>
                            <a href="link.php" class="boxlink__item_title">
                                Перечень ресурсов
                            </a>
                        </div>
                        <div class="boxlink__item">
                            <div class="boxlink__item_img">
                                <i class="far fa-folder-open"></i>
                            </div>
                            <a href="documents.html" class="boxlink__item_title">
                                Нормативные документы
                            </a>
                        </div>
                    </div>
                    <div class="boxlink__row">
                        <div class="boxlink__item">
                            <div class="boxlink__item_img">
                                <i class="far fa-file-alt"></i>
                            </div>
                            <a href="todo.php" class="boxlink__item_title">
                                Контроль отдела
                            </a>
                        </div>
                        <div class="boxlink__item">
                            <div class="boxlink__item_img">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                            <a href="control.php" class="boxlink__item_title">
                                Контроль мероприятий
                            </a>
                        </div>
                        <div class="boxlink__item">
                            <div class="boxlink__item_img">
                                <i class="far fa-id-card"></i>
                            </div>
                            <a href="rp.php" class="boxlink__item_title">
                                Предписания
                            </a>
                        </div>
                    </div>
                    <div class="boxlink__row">
                        <div class="boxlink__item">
                            <div class="boxlink__item_img">
                                <i class="far fa-calendar-check"></i>
                            </div>
                            <a href="talon.php" class="boxlink__item_title">
                                Талоны по безопасности
                            </a>
                        </div>
                        <div class="boxlink__item">
                            <div class="boxlink__item_img">
                                <i class="far fa-address-card"></i>
                            </div>
                            <a href="audits.php" class="boxlink__item_title">
                                Контроль аудитов
                            </a>
                        </div>
                        <div class="boxlink__item">
                            <div class="boxlink__item_img">
                                <i class="far fa-question-circle"></i>
                            </div>
                            <a href="contact.php" class="boxlink__item_title">
                                Задать вопрос
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include_once ("block/footer.php"); ?>
    </div>
    <!--<script src="js/script.js"></script>-->
</body>
</html>