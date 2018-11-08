<?php
require_once "../connect_bd.php";
connectBd();

$login = $_GET['login_active'];
$key = $_GET['key'];

$user = R::findOne('users', "`login` = ?", array($login));

$real_key = $user['activ_key'];//ключ сохранённый в бд
if($real_key === $key)//если ключ из бд совпадает с ключом на ссылке 
{
    $_SESSION['user_login'] = $user['login'];
    $_SESSION['user_img'] = '/user/'.$user['avatar_img'];
    R::getRow("UPDATE `users` SET `activ_key`='' WHERE `login` = ? ", array($login));//отчищаем поле для хранения ключа активации 
}

header("Location: ../index.php");//редирект на главную страницу

?>