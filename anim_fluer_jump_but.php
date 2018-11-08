<?php
require_once "connect_bd.php";
require_once "libs/functions.php";
connectBd();

$animeFlayers = '';
$anime;
$jump_buttons;

switch($_GET['type'])
{
    case "numButAnimFlayer": 
        //массив строк таблицы отсортированной по дате обновления строк (отсорт. по удыванию (DESC))
        $anime = R::getAll( 'SELECT id, img, name, views FROM `animeflyer` ORDER BY `date_update` DESC' );

        $jump_buttons = Jump_buttons::Get($_GET['num'],R::count('animeflyer'),24,"btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJump", "btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJumpActive", "animeFlJumpButOnClick(this.textContent, '?numBut', 'mainMenu', 'numButAnimFlayer')");
        break;
        
    case "searchByYear":
        //массив строк таблицы отсортированной по дате обновления строк (отсорт. по удыванию (DESC) где год = $_GET['param'])
        $anime = R::getAll( 'SELECT id, img, name, views FROM `animeflyer` WHERE `year` = ? ORDER BY `date_update` DESC', array($_GET['param']) );
        
        $jump_buttons = Jump_buttons::Get($_GET['num'],count($anime),24,"btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJump", "btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJumpActive", "buttonSearch(this.textContent, 'searchByYear', '?searchByYear='+'$_GET[param]'+'&numBut', $_GET[param])");
        break;
        
    case "searchByType":
        $param = urldecode($_GET['param']);//расшифровываем строку рус. символов
        
        $id_type = R::getAll( 'SELECT id FROM type_list WHERE type_name = ? ', array($param))[0]['id'];
        
        $anime = R::getAll( 'SELECT id, img, name, views FROM animeflyer WHERE id IN (SELECT id_anime FROM type WHERE id_type = ?) ORDER BY `date_update` DESC', array($id_type));
        $jump_buttons = Jump_buttons::Get($_GET['num'],count($anime),24,"btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJump", "btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJumpActive", "buttonSearch(this.textContent, 'searchByType', '?searchByType='+encodeURIComponent('$param')+'&numBut', encodeURIComponent('$param'))");
        break;
        
    case "searchByCategory":
        $param = urldecode($_GET['param']);//расшифровываем строку рус. символов
        $param = str_replace("_", " ",$param);
        
        $id_category = R::getAll( 'SELECT id FROM category_list WHERE category_name = ? ', array($param))[0]['id'];
        
        $anime = R::getAll( 'SELECT id, img, name, views FROM animeflyer WHERE id IN (SELECT id_anime FROM category WHERE id_category = ?) ORDER BY `date_update` DESC', array($id_category));
        
        $param = str_replace(" ", "_",$param);
        $jump_buttons = Jump_buttons::Get($_GET['num'],count($anime),24,"btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJump", "btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJumpActive", "buttonSearch(this.textContent, 'searchByCategory', '?searchByCategory='+encodeURIComponent('$param')+'&numBut', encodeURIComponent('$param'))");
        break;
        
    case "searchByTitle":
        $param = urldecode($_GET['param']);//расшифровываем строку рус. символов
        $param = str_replace("_", " ",$param);
        
        $anime = R::getAll("SELECT id, img, name, views FROM animeflyer WHERE name LIKE ? ORDER BY `date_update` DESC", array('%'.$param.'%'));
        
        $param = str_replace(" ", "_",$param);
        $jump_buttons = Jump_buttons::Get($_GET['num'],count($anime),24,"btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJump", "btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJumpActive", "buttonSearch(this.textContent, 'searchByTitle', '?searchByTitle='+encodeURIComponent('$param')+'&numBut', encodeURIComponent('$param'))");
        break;
}

for($i=$jump_buttons['iBegin']; $i<$jump_buttons['iEnd']; $i++)
{
    $animeFlayers.= '
                <div class="col-lg-2 col-sm-3 col-6 pl-1 pr-1 mt-2 animeFlayerMainPage">
                    <img src="images\animeFlayers\\'.$anime[$i]['img'].'" class="w-100 animeCover">
                    <div title="'.$anime[$i]['name'].'" class="animeFlayerMainPageImg text-uppercase pl-1 pr-1" idAnime = "'.$anime[$i]['id'].'">'.implode(preg_grep('~[а-яА-Я\s]~',str_split_utf8($anime[$i]['name']))).'</div>
                    <div class="animeFlayerMainPageViews pl-1 pr-1 m-0">
                        '.$anime[$i]['views'].' '.declOfNum($anime[$i]['views'],'просмотр','просмотра','просмотров').'
                    </div>
                    <img src="images/animeFlayers/button_Play.png" alt="перейти к просмотру" class="animeFlayerMainPagePlayImg" title="смотреть">
                </div>';
}

echo json_encode(array("buttons" =>$jump_buttons['buttons'], "flayers" => $animeFlayers));

?>