<?php 
require_once "connect_bd.php";
require_once "libs/functions.php";
connectBd();

//вывод всех ошибок
/*error_reporting(E_ALL);
ini_set("display_errors", 1);*/
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <!-- Подключаем Bootstrap styles begin -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Подключаем Bootstrap styles end -->

    <title>Anigo.tv - самое активное аниме сообщество!</title>
    <link rel="shortcut icon" href="/images/ico.ico" type="image/x-icon">
    <!-- подключаем стили -->
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/media.css">
    <!-- recaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <!-- for video player begin-->
    <link href="http://vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">

    <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    <!-- подключаем стили -->
    <link rel="stylesheet" href="video_player/css/fonts.css">
    <link rel="stylesheet" href="video_player/css/main.css">
    <link rel="stylesheet" href="video_player/css/media.css">
    <!-- for video player begin-->

    <!-- for scroll -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    
    <link rel="stylesheet" href="chat/style.css">

    <!-- for ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>

    <script src="js/load_anime_for_start.js"></script>

</head>

<body>
    <!-- scroll top -->
    <div id="cont">
        <div id="progress"></div>
    </div>

    <header>
        <!-- слайдер для новостей на сайте начало-->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <!-- ссылки на слайды -->
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            </ol>
            <!-- слайды -->
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="images/arts/1.jpg">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Звёздное небо</h3>
                        <p>автор: Джамаль Имурович 01:01:2018</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="images/arts/2.jpg">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Ребёнок и лис</h3>
                        <p>автор: Вася Пупкин 21:01:2018</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="images/arts/3.jpg">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Будущее</h3>
                        <p>автор: Катюха Каргигстанова 21:03:2018</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="images/arts/8.jpg">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Утречько</h3>
                        <p>автор: Пётр Петров 05:15:2018</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="images/arts/9.jpg">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>3 сын боруто - "Даруто"</h3>
                        <p>автор: Катюха Каргигстанова 09:04:2018</p>
                    </div>
                </div>
            </div>
            <!-- ссылки на предыдущий и следующий слайды -->
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span><!-- для незрячих -->
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!-- слайдер для новостей на сайте конец-->

        <!-- авторизация и регистрация пользователя -->
        <div>
            <?php require_once "user_login/index.php"; ?>
        </div>

        <!-- главное меню начало -->
        <div class="mainMenu" id="mainMenu">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <img src="images/logotype.png" class="navbar-brand p-0 d-lg-none logotypeLi h-100 mb-1 mainPage" title="на главную">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainMenuContent" aria-controls="mainMenuContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

                <div class="collapse navbar-collapse" id="mainMenuContent">
                    <ul class="navbar-nav mr-0">
                        <li class="logotypeLi d-none d-lg-block">
                            <img src="images/logotype.png" class="w-100 mainPage" title="на главную">
                        </li>
                        <!-- жанр -->
                        <li>
                            <div class="dropdown">
                                <button class="btn btn-outline-danger dropdownMenuButton  text-uppercase" type="button" id="dropdownMenuType" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        жанр
                        </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuType" id="dropdownMenuTypeBut">
                                    <button class="dropdown-item text-uppercase" type="button">приключения</button>
                                    <button class="dropdown-item text-uppercase" type="button">комедия</button>
                                    <button class="dropdown-item text-uppercase" type="button">фэнтези</button>
                                    <button class="dropdown-item text-uppercase" type="button">сёнэн</button>
                                    <button class="dropdown-item text-uppercase" type="button">детектив</button>
                                    <button class="dropdown-item text-uppercase" type="button">мистика</button>
                                    <button class="dropdown-item text-uppercase" type="button">повседневность</button>
                                    <button class="dropdown-item text-uppercase" type="button">фантастика</button>
                                    <button class="dropdown-item text-uppercase" type="button">школа</button>
                                    <button class="dropdown-item text-uppercase" type="button">романтика</button>
                                    <button class="dropdown-item text-uppercase" type="button">драма</button>
                                    <button class="dropdown-item text-uppercase" type="button">спорт</button>
                                    <button class="dropdown-item text-uppercase" type="button">сёдзё</button>
                                </div>
                            </div>
                        </li>
                        <!-- тип -->
                        <li>
                            <div class="dropdown">
                                <button class="btn btn-outline-danger dropdownMenuButton  text-uppercase" type="button" id="dropdownMenuCategory" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        тип
                        </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuCategory" id="dropdownMenuCategoryBut">
                                    <button class="dropdown-item text-uppercase" type="button">Аниме TV</button>
                                    <button class="dropdown-item text-uppercase" type="button">Законченные сериалы</button>
                                    <button class="dropdown-item text-uppercase" type="button">Аниме Ongoing</button>
                                    <button class="dropdown-item text-uppercase" type="button">Аниме OVA</button>
                                </div>
                            </div>
                        </li>
                        <!-- год -->
                        <li>
                            <div class="dropdown">
                                <button class="btn btn-outline-danger dropdownMenuButton  text-uppercase" type="button" id="dropdownMenuYear" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        год
                        </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuYear" id="dropdownMenuYearBut">
                                    <button class="dropdown-item text-uppercase" type="button">2017</button>
                                    <button class="dropdown-item text-uppercase" type="button">2016</button>
                                    <button class="dropdown-item text-uppercase" type="button">2004</button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <button id="randAnime" class="btn btn-outline-danger dropdownMenuButton text-uppercase" type="button" title="случайное аниме">???</button>
                        </li>
                        <li class="mainMenuAuthors">
                            <button class="btn btn-outline-danger dropdownMenuButton text-uppercase" type="button">авторы</button>
                        </li>
                        <li class="m-0 p-0 d-none d-none d-md-block">
                            <!-- поиск -->
                            <form class="form-inline searchAnime">
                                <input class="form-control mr-sm-2" type="text" placeholder="НАЗВАНИЕ АНИМЕ" oninput="searchAnimeByTitle(this.value.trim())">
                                <button class="btn btn-outline-info my-2 my-sm-0" type="button">ПОИСК</button>
                                <ul>
                                </ul>
                            </form>
                        </li>
                    </ul>
                    <!-- поиск -->
                    <form class="form-inline searchAnime searchAnime2 d-none">
                        <input class="form-control" type="text" placeholder="НАЗВАНИЕ АНИМЕ" oninput="searchAnimeByTitle(this.value.trim())">
                        <button class="btn btn-outline-info m-0" type="button">ПОИСК</button>
                        <ul>
                        </ul>
                    </form>
                </div>
            </nav>
        </div>
        <!-- главное меню конец -->
    </header>
    <div class="containerBodyAndFoot">
        <!-- аниме статьи -->
        <div class="container-fluid text-center">
            <div class="row pl-2 pr-2" id="AnimeFlayrs">
                <?php
        //определяем тип выборки из бд начало
        if(isset($_GET['AnimeName']))
        {
            echo '
            <script>
                animeFlayerMainPageClickPlaySendAjaxAndScroll('.$_GET['id'].','.$_GET['Seson'].','.$_GET['Episode'].');
            </script>';
        }
        elseif(isset($_GET['searchByTitle']))
        {
            $param = $_GET['searchByTitle'];//расшифровываем строку рус. символов
            $param = str_replace("_", " ",$param);

            $anime = R::getAll("SELECT id, img, name, views FROM animeflyer WHERE name LIKE ? ORDER BY `date_update` DESC", array('%'.$param.'%'));

            $param = str_replace(" ", "_",$param);
            $jump_buttons = Jump_buttons::Get($_GET['numBut'],count($anime),24,"btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJump", "btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJumpActive", "buttonSearch(this.textContent, 'searchByTitle', '?searchByTitle='+encodeURIComponent('$param')+'&numBut', encodeURIComponent('$param'))"); 
        }
        elseif(isset($_GET['searchByCategory']))
        {
            $param = $_GET['searchByCategory'];
            $param = str_replace("_", " ",$param);
        
            $id_category = R::getAll( 'SELECT id FROM category_list WHERE category_name = ? ', array($param))[0]['id'];

            $anime = R::getAll( 'SELECT id, img, name, views FROM animeflyer WHERE id IN (SELECT id_anime FROM category WHERE id_category = ?) ORDER BY `date_update` DESC', array($id_category) );
            
            $param = str_replace(" ", "_",$param);
            $jump_buttons = Jump_buttons::Get($_GET['numBut'],count($anime),24,"btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJump", "btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJumpActive", "buttonSearch(this.textContent, 'searchByCategory', '?searchByCategory='+encodeURIComponent('$param')+'&numBut', encodeURIComponent('$param'))");
        }
        elseif(isset($_GET['searchByType']))
        {
            $param = $_GET['searchByType'];
        
            $id_type = R::getAll( 'SELECT id FROM type_list WHERE type_name = ? ', array($param))[0]['id'];
            
            $anime = R::getAll( 'SELECT id, img, name, views FROM animeflyer WHERE id IN (SELECT id_anime FROM type WHERE id_type = ?) ORDER BY `date_update` DESC', array($id_type));

            $jump_buttons = Jump_buttons::Get($_GET['numBut'],count($anime),24,"btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJump", "btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJumpActive", "buttonSearch(this.textContent, 'searchByType', '?searchByType='+encodeURIComponent('$param')+'&numBut', encodeURIComponent('$param'))");
        }
        elseif(isset($_GET['searchByYear']))
        {
            $anime = R::getAll( 'SELECT id, img, name, views FROM `animeflyer` WHERE `year` = ? ORDER BY `date_update` DESC', array($_GET['searchByYear']) );
            
            $jump_buttons = Jump_buttons::Get($_GET['numBut'],count($anime),24,"btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJump", "btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJumpActive", "buttonSearch(this.textContent, 'searchByYear', '?searchByYear='+'$_GET[searchByYear]'+'&numBut', $_GET[searchByYear])");
        }
        else
        {
            //массив строк таблицы отсортированной по дате обновления строк (отсорт. по удыванию - DESC)
            $anime = R::getAll( 'SELECT id, img, name, views FROM `animeflyer` ORDER BY `date_update` DESC' );
            if(is_numeric($_GET['numBut'])) $numBut = (int)$_GET['numBut'];
            else $numBut = 1;
            
            $jump_buttons = Jump_buttons::Get($numBut,R::count('animeflyer'),24,"btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJump", "btn btn-danger mt-2 pl-0 pr-0 AnimeFlayrsButJumpActive", "animeFlJumpButOnClick(this.textContent, '?numBut', 'mainMenu', 'numButAnimFlayer')");
        }
        //определяем тип выборки из бд конец

        //выводим выборку из бд
        for($i=$jump_buttons['iBegin']; $i<$jump_buttons['iEnd']; $i++)
        {
            //EnglName="'.implode(preg_grep('~[a-z,A-Z]~',str_split_utf8($anime[$i]['name']))).'"
              echo '
                <div class="col-lg-2 col-sm-3 col-6 pl-1 pr-1 mt-2 animeFlayerMainPage">
                    <img src="images\animeFlayers\\'.$anime[$i]['img'].'" class="w-100 animeCover">
                    <div title="'.$anime[$i]['name'].'" class="animeFlayerMainPageImg text-uppercase pl-1 pr-1" idAnime = "'.$anime[$i]['id'].'">'.implode(preg_grep('~[а-яА-Я\s]~',str_split_utf8($anime[$i]['name']))).'</div>
                    <div class="animeFlayerMainPageViews pl-1 pr-1 m-0">
                        '.$anime[$i]['views'].' '.declOfNum($anime[$i]['views'],'просмотр','просмотра','просмотров').'
                    </div>
                    <img src="images/animeFlayers/button_Play.png" alt="перейти к просмотру" class="animeFlayerMainPagePlayImg" title="смотреть">
                </div>';
        }
        
        ?>
            </div>
        </div>

        <!-- кнопки перехода по аниме статьям-->
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-12 p-0">
                    <div class="btn-group" role="group" id="AnimeFlayrsButJump">
                        <?php echo $jump_buttons['buttons']; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="chatContainer" class="w-100 pl-3 pr-3"></div>
        
        <footer class="mt-2">
            <div class=".container-fluid p-0">
                <div class="footer-help">
                    <img src="images/footer-tian.png"> поддержи проект<br> vebmoney t1341523<br> яндекс деньги<br> 48204029492930
                    <br>
                </div>
                <div class="footer_main_content pr-2">
                    Весь материал на сайте представлен исключительно для домашнего ознакомительного просмотра.<span class="footer_main_content_top940"> Весь контент взят из свободных источников.</span> <span class="footer_main_content_top871">Если какой-либо материал нарушает ваши авторские права, свяжитись с нами и мы его сразу же удалим, но мы не гарантируем что он не будет добавлен заново другим пользователем. </span><span class="footer_main_content_top1086"> Копирование материала с сайта разрешено только при согласии администрации!</span><span class="footer_main_content_top525"> Возрастное ограничение 16+</span>
                </div>
            </div>
        </footer>
    </div>
    <!-- scripts for Bootstrap begin-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- scripts for Bootstrap end-->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="user_login/js/dialog_login.js"></script>
    <script src="user_login/js/handler.js"></script>
    <!-- убираем  стандартный скроллер -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.js"></script>
    <script src="js/handler.js"></script>
</body>

</html>