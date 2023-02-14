<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Выборка</h1>
       
        <?php include_once 'block/conect_db.php' ?>

        <?php 
            $depats_query = $pdo->query('SELECT * FROM `depats`');
            while ($row = $depats_query->fetch(PDO::FETCH_OBJ)) {
                $html1 .= "<option value={$row->id_depat}> {$row->depat}</option>";
            };


            $branch_query = $pdo->query('SELECT * FROM `branch`');
            while ($row1 = $branch_query->fetch(PDO::FETCH_OBJ)) {
                $html2 .= "<option value={$row1->id_branch}> {$row1->branch}</option>";
            };

            $posts_query = $pdo->query('SELECT * FROM `posts`');
            while ($row2 = $posts_query->fetch(PDO::FETCH_OBJ)) {
                $html3 .= "<option value={$row2->id_post}> {$row2->post}</option>";
            };

    ?>
     <select name="branch" id="id_depats">
        <option>Выберите службу/управление</option>
        <?php  echo $html1 ?>
     </select>
     <select name="branch" id="id_branch">
        <option>Выберите службу/управление</option>
        <?php  echo $html2 ?>
     </select>
     <select name="branch" id="id_posts">
        <option>Выберите службу/управление</option>
        <?php  echo $html3 ?>
     </select>
        
    
</body>
</html>