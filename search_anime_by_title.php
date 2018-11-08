<?php 
require_once "connect_bd.php";
require_once "libs/functions.php";
connectBd();

$anime = R::getAll("SELECT id, name FROM animeflyer WHERE name LIKE ? LIMIT 10", array('%'.$_GET['title'].'%'));

for($i=0; $i<count($anime); $i++)
{
    $listAnime .='<li class="fastSearchLi" idAnime="'.$anime[$i]['id'].'">'.$anime[$i]['name'].'</li>';
}

echo $listAnime;

?>