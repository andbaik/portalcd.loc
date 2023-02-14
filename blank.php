<?php
include_once 'block/header.php';
$title = 'Ревизорские предписания';
include_once 'block/conect_db.php';
$date_now = date("d.m.Y");
$query = $pdo->query('SELECT * FROM `regulations` JOIN `railways` ON regulations.id_railways = railways.id_railway');
?>

<main class="main">
    <div class="container">
        <form action="#">
            
        </form>
    </div>
</main>
<?php include_once("block/footer.php");?>
</body>
</html>
