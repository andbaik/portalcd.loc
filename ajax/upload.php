<?php
$uploaddir = 'img/some/';
$path_parts = pathinfo($_FILES['file']['name']);
$ext = $path_parts['extension'];

$filename = time().".".$ext;
$file = $uploaddir . basename($filename);

move_uploaded_file($_FILES['file']['tmp_name'], $file);
echo '1';