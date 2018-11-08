<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/libs/rb.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/connect_bd.php';

connectBd();
$comments = R::dispense('comments');
$comments->id_user = $_SESSION['id_user'];
$comments->id_anime  = $_GET['id_anime'];
$comments->time = date ('Ymd H: i: s');
$comments->message = $_GET['message'];
R::store($comments);//сохраняем таблицу в бд

?>