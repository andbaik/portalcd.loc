<?php 
session_start();

    if (!isset($_SESSION['user'])){
        echo 'Вывод';
        echo '<form action="" method="post">' . '<br/>';
        echo '<input name="login">' . '<br/>';
        echo '<input name="password" type="password">';
        echo '<input type="submit">' . '<br/>';
        echo '</form>';
        $s =  $_SESSION['user'];
        echo 'SESION = ' . $s;
        
        if (isset($_POST['login']) or isset($_POST['password'])){
            $login = $_POST['login'];
            $pas = $_POST['password'];
            echo 'Pass = ' . $pas;
            include_once 'block/conect_db.php';
            $query = $pdo->prepare("SELECT * FROM `users_id` WHERE `login`= ? AND `password`= ?");
            $query->execute([$login, $pas]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            echo '<br>';
            var_dump($result);
            echo '<br>';
            echo 'Login = ' . $login . 'Password = ' . $pas;

            if ($result){
                echo 'Пользователь с логином ' . $login . 'есть в базе данных';
                $_SESSION ['user'] = $login;
                echo '<form action="" method="post">' . '<br/>';
                echo '<input type="submit">' . '<br/>';
                echo '</form>';
                    
            }
            else {
                echo 'Пользователь не зарегистрирован';
            }
        }
        else{
            echo 'Значения не введены';
        }
    }
    else{
    echo 'Выводим код страницы' . '<br>';
    echo 'SESION = ' .$_SESSION['user'];
    echo '<form action="" method="post">' . '<br/>';
    echo '<input type="submit">' . '<br/>';
    echo '</form>';
  
        $_SESSION['user'] = false;
        session_destroy();

    }
?>