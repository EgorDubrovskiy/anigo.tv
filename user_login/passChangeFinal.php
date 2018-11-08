<?php
require_once "../connect_bd.php";
connectBd();

$user=R::findOne('users', 'login = ?', array($_SESSION['login_active']));

$login = $user['login'];
$newPass = password_hash($_GET['pass'], PASSWORD_DEFAULT);

R::getRow("UPDATE `users` SET `password`= ? WHERE `login` = ? ", array($newPass, $login));//изменяем пароль

//запоминаем пользователя
$_SESSION['user_login'] = $login;
$_SESSION['user_img'] = '/user/'.$user['avatar_img'];

R::getRow("UPDATE `users` SET `activ_key`='' WHERE `login` = ? ", array($login));//отчищаем поле для хранения ключа активации 

?>