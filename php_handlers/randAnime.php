<?php
require_once "../connect_bd.php";
connectBd();

$anime = R::getAll( 'SELECT id FROM `animeflyer`');

echo $anime[rand(0,count($anime) - 1)]['id'];

?>