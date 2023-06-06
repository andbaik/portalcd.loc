<?php

$title = "Контроль мероприятий";

include_once("block/header.php"); ?>

<body>




  <main class="main">
    <div class="container">
      <h1>Контроль мероприятий</h1>
      <div class="headerTable flex">
        <div class="headerTable__left"><a href="../diagramm_control.php">Диаграмма:  <i class="fa-solid fa-chart-gantt"></a></i></div>
        <div class="headerTable__right"> <a href="../new_control.php">Добавить документ:  <i class="fa-solid fa-plus"></a></i></div>
    </div>
      <table class="iksweb" style="table-layout: fixed; width: 100%">
        <colgroup>
          <col style="width: 45px">
          <col style="width: 100px">
          <col style="width: 50px">
          <col style="width: 50px">
          <col style="width: auto">
          <col style="width: 80px">
          <col style="width: 75px">
          <col style="width: 85px">
          <col style="width: 220px">
          <col style="width: 34px">
          <col style="width: 34px">
          <col style="width: 34px">
          <col style="width: 34px">
        </colgroup>
        <thead>
          <tr>
            <th class="tg-lboi">№</th>
            <th class="tg-lboi">Документ</th>
            <th class="tg-lboi">Файл</th>
            <th class="tg-cly1">Пункт</th>
            <th class="tg-nrix">Поручение</th>
            <th class="tg-cly1">Отв.</th>
            <th class="tg-baqh">Отв. по ЦД</th>
            <th class="tg-nrix">Срок</th>
            <th class="tg-cly1">Кратко исполнение</th>
            <th class="tg-0lax">кор</th>
            <th class="tg-0lax">вып</th>
            <th class="tg-0lax">арх</th>
            <th class="tg-0lax">удл</th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            <td>1</td>
            <td rowspan="3">МГ-22/пр от 29.03.2023</td>
            <td rowspan="3"><a href="#"><i style="font-size: 20px" class="fa-solid fa-file-word"></i></a></td>
            <td>13</td>
            <td>Актуализировать до 29 декабря 2023 г. Положение о ревизорах движения, с учетом ввода профессионального стандарта "Инструктор по безопасности движения на железнодорожной станции"</td>
            <td>ЦДЗ-1, ЦДГ, ЦДЗБ</td>
            <td>ЦДЗБ</td>
            <td>29.12.2023</td>
            <td>Распоряжение ОАО "РЖД" от 01.12.2023 № 2838/р</td>
            <td><i class="fa-solid fa-pencil"></i></td>
            <td><i class="fa-solid fa-check"></i></td>
            <td><i class="fa-solid fa-file-zipper"></i></td>
            <td><i class="fa-solid fa-trash-can"></i></td>
          </tr>

          <tr>
          <td>2</td>
          
            <td>13</td>
            <td>Актуализировать до 29 декабря 2023 г. Положение о ревизорах движения, с учетом ввода профессионального стандарта "Инструктор по безопасности движения на железнодорожной станции"</td>
            <td>ЦДЗ-1, ЦДГ, ЦДЗБ</td>
            <td>ЦДЗБ</td>
            <td>29.12.2023</td>
            <td>Распоряжение ОАО "РЖД" от 01.12.2023 № 2838/р</td>
            <td><i class="fa-solid fa-pencil"></i></td>
            <td><i class="fa-solid fa-check"></i></td>
            <td><i class="fa-solid fa-file-zipper"></i></td>
            <td><i class="fa-solid fa-trash-can"></i></td>
          </tr>
          <tr>
          <td>3</td>
          
            <td>13</td>
            <td>Актуализировать до 29 декабря 2023 г. Положение о ревизорах движения, с учетом ввода профессионального стандарта "Инструктор по безопасности движения на железнодорожной станции"</td>
            <td>ЦДЗ-1, ЦДГ, ЦДЗБ</td>
            <td>ЦДЗБ</td>
            <td>29.12.2023</td>
            <td>Распоряжение ОАО "РЖД" от 01.12.2023 № 2838/р</td>
            <td><i class="fa-solid fa-pencil"></i></td>
            <td><i class="fa-solid fa-check"></i></td>
            <td><i class="fa-solid fa-file-zipper"></i></td>
            <td><i class="fa-solid fa-trash-can"></i></td>
          </tr>

          <tr>
            <td>4</td>
            <td>МГ-22/пр от 29.03.2023</td>
            <td><a href="#"><i style="font-size: 20px" class="fa-solid fa-file-word"></i></a></td>
            <td>13</td>
            <td>Актуализировать до 29 декабря 2023 г. Положение о ревизорах движения, с учетом ввода профессионального стандарта "Инструктор по безопасности движения на железнодорожной станции"</td>
            <td>ЦДЗ-1, ЦДГ, ЦДЗБ</td>
            <td>ЦДЗБ</td>
            <td>29.12.2023</td>
            <td>Распоряжение ОАО "РЖД" от 01.12.2023 № 2838/р</td>
            <td><i class="fa-solid fa-pencil"></i></td>
            <td><i class="fa-solid fa-check"></i></td>
            <td><i class="fa-solid fa-file-zipper"></i></td>
            <td><i class="fa-solid fa-trash-can"></i></td>
          </tr>



        </tbody>
      </table>
      <p class="date"><?= date("Сегодня: d.m.Y") ?></p>
    </div>
  </main>
  <?php include_once("block/footer.php"); ?>
</body>

</html>