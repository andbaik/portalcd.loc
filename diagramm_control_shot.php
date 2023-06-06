<?php

$title = "Контроль мероприятий [диаграмма кратко]";

include_once("block/header.php"); ?>

<body>




  <main class="main">
    <div class="container">
      <h1>Контроль мероприятий [диаграмма кратко]</h1>
      <div class="headerTable flex">
        <div class="headerTable__left"><a href="../control.php">Перечень поручений:  <i class="fa-solid fa-list-check"></a></i></div>
        <div class="headerTable__right"> <a href="../new_control.php">Добавить документ:  <i class="fa-solid fa-plus"></a></i></div>
    </div>
      <table class="iksweb" style="table-layout: fixed; width: 100%">
        <colgroup>

 
        </colgroup>
        <thead>
          <tr>

            <th class="tg-nrix" colspan="3">Янв</th>
            <th class="tg-cly1" colspan="3">Фев</th>
            <th class="tg-baqh" colspan="3">Мар</th>
            <th class="tg-nrix" colspan="3">Апр</th>
            <th class="tg-cly1" colspan="3">Май</th>
            <th class="tg-0lax" colspan="3">Июн</th>
            <th class="tg-0lax" colspan="3">Июл</th>
            <th class="tg-0lax" colspan="3">Авг</th>
            <th class="tg-0lax" colspan="3">Сен</th>
            <th class="tg-0lax" colspan="3">Окт</th>
            <th class="tg-0lax" colspan="3">Нояб</th>
            <th class="tg-0lax" colspan="3">Дек</th>
          </tr>

          <tr>
            <th class="tg-nrix">I</th>
            <th class="tg-cly1">II</th>
            <th class="tg-baqh">III</th>
            <th class="tg-nrix">I</th>
            <th class="tg-cly1">II</th>
            <th class="tg-0lax">III</th>
            <th class="tg-0lax">I</th>
            <th class="tg-0lax">II</th>
            <th class="tg-0lax">III</th>
            <th class="tg-0lax">I</th>
            <th class="tg-0lax">II</th>
            <th class="tg-0lax">III</th>
            <th class="tg-nrix">I</th>
            <th class="tg-cly1">II</th>
            <th class="tg-baqh">III</th>
            <th class="tg-nrix">I</th>
            <th class="tg-cly1">II</th>
            <th class="tg-baqh">III</th>
            <th class="tg-nrix">I</th>
            <th class="tg-cly1">II</th>
            <th class="tg-baqh">III</th>
            <th class="tg-nrix">I</th>
            <th class="tg-cly1">II</th>
            <th class="tg-baqh">III</th>
            <th class="tg-nrix">I</th>
            <th class="tg-cly1">II</th>
            <th class="tg-baqh">III</th>
            <th class="tg-nrix">I</th>
            <th class="tg-cly1">II</th>
            <th class="tg-baqh">III</th>
            <th class="tg-nrix">I</th>
            <th class="tg-cly1">II</th>
            <th class="tg-baqh">III</th>
            <th class="tg-nrix">I</th>
            <th class="tg-cly1">II</th>
            <th class="tg-baqh">III</th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            <td></td>
            <td></td>
            <td>3</td>
            <td></td>
            <td></td>
            <td>1</td>
            <td></td>
            <td></td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>4</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>5</td>
            <td></td>
            <td></td>
            <td></td>
            <td>7</td>
            <td></td>
            <td></td>
            <td>6</td>
            <td></td>
            <td></td>
            <td>8</td>
            <td></td>
            <td>2</td>
            <td></td>
            <td>10</td>
            <td></td>
          </tr>
          
        </tbody>
      </table>
      <p class="date"><?= date("Сегодня: d.m.Y") ?></p>
    </div>
  </main>
  <?php include_once("block/footer.php"); ?>
</body>

</html>