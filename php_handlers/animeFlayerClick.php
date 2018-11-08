<?php
require_once "../connect_bd.php";
require_once "../libs/functions.php";
require_once "../chat/index.php";
require_once "../video_player/index.php";
connectBd();

$anime = R::getAll( 'SELECT name FROM `animeflyer` WHERE id = ?', array($_GET['idAnime']));

$EnglNameAnime = implode(preg_grep('~[a-z,A-Z]~',str_split_utf8($anime[0]['name'])));

$video_player = getVideoPlayer($EnglNameAnime,$_GET['Seson'],$_GET['Episode']);

//небольшой костыль
$count_comments = R::getAll( 'SELECT id FROM comments WHERE id_anime = ?', array($_GET['idAnime']) );

$numJmpBut = $_GET['commentsNumJB'];
if($numJmpBut == -1){
        if(count($count_comments)%10 == 0) $numJmpBut = count($count_comments)/10;
        else $numJmpBut = ((int)(count($count_comments)/10)) + 1;
}

$comments = getChat($_GET['idAnime'], isset($_SESSION['id_user']), $numJmpBut);

echo json_encode(array("video_player" =>$video_player, "EnglNameAnime" => $EnglNameAnime, "comments" => $comments, "numJmpBut" => $numJmpBut));

?>