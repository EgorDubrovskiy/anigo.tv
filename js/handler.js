$('.searchAnime').children("button").click(function(){
    buttonSearch(1, 'searchByTitle', '?searchByTitle='+this.textContent.replace(/\s/g, "_")+'&numBut', encodeURIComponent(this.parentElement[0].value));
});

//появление результатов поиска во время ввода
$('.searchAnime').children("input").focus(function(){$('.searchAnime').children("ul").show();});
$('.searchAnime').children("input").blur(function(){
    if ($('.fastSearchLi:hover').length != 0) {
        $('.searchAnime').children("input").focus();//устанавливаем фокус
    }
    else{$('.searchAnime').children("ul").hide();}
});

function searchAnimeByTitle(title)
{
    if (title != "")
    $.ajax({
        type: "GET",
        url: "search_anime_by_title.php",
        data: {title: title},
        success: function (data) {
            $('.searchAnime').children("ul").html(data);
        }
    });
    else  $('.searchAnime').children("ul").html("");
}

//клик по кнопкам перехода между аниме статьями
function animeFlJumpButOnClick(numBut, get, idScr, typeQuery)
{
    $.ajax({
        type: "GET",
        url: "anim_fluer_jump_but.php",
        data: {num: numBut, type: typeQuery},
        success: function (data) {
            var res = jQuery.parseJSON(data);
            $("#AnimeFlayrs").html(res.flayers);
            $("#AnimeFlayrsButJump").html(res.buttons);
            $("#AnimeFlayrsButJump").show();
        }
    });
    
    //меняем значение переменной get
    history.pushState(null, null, 'http://'+window.location.hostname+get+'='+numBut);
    
    //плавная прокруткаr
    $('body').mCustomScrollbar('scrollTo','#'+idScr,{
        scrollInertia:700,
        scrollEasing:"easeOut"
    });
    
    $('#chatContainer').hide();
    
}

//клик по кнопкам перехода между аниме статьями выбранным по параметру поиска
function buttonSearch(numBut, typeQuery, get, valParam)
{
    $.ajax({
        type: "GET",
        url: "anim_fluer_jump_but.php",
        data: {num: numBut, type: typeQuery, param: valParam},
        success: function (data) {
            var res = jQuery.parseJSON(data);
            $("#AnimeFlayrs").html(res.flayers);
            $("#AnimeFlayrsButJump").html(res.buttons);
            $("#AnimeFlayrsButJump").show();
            $('#chatContainer').hide();
        }
    });
    
    //меняем значение переменной get
    history.pushState(null, null, 'http://'+window.location.hostname+get+'='+numBut);
    
    //плавная прокруткаr
    $('body').mCustomScrollbar('scrollTo','#mainMenu',{
        scrollInertia:700,
        scrollEasing:"easeOut"
    });
    
    $('#chatContainer').hide();
}

//клик на кнопки для поиска по критерию
$('#dropdownMenuYearBut').children().click(function() {
     buttonSearch(1, 'searchByYear', '?searchByYear='+this.textContent+'&numBut', this.textContent);
 });

$('#dropdownMenuTypeBut').children().click(function() {
     buttonSearch(1, 'searchByType', '?searchByType='+this.textContent+'&numBut', encodeURIComponent(this.textContent));
 });

$('#dropdownMenuCategoryBut').children().click(function() {
     buttonSearch(1, 'searchByCategory', '?searchByCategory='+this.textContent.replace(/\s/g, "_")+'&numBut', encodeURIComponent(this.textContent));
 });

//переход на главную
$('.mainPage').click(function() {
    animeFlJumpButOnClick(1, '?numBut', 'carouselExampleIndicators', 'numButAnimFlayer');
});

function animeFlayerMainPageClickPlay(animeFlayer,Seson,Episode)
{
    var NameData =  animeFlayer.getElementsByClassName("animeFlayerMainPageImg")[0];
    
    var idAnime = NameData.getAttribute("idAnime");
    
    animeFlayerMainPageClickPlaySendAjaxAndScroll(idAnime,Seson,Episode);
}

/*scroll right*/
(function($){
    
    $(document).ready(function() {
        $("body").css("height", $( window ).height() + "px");
        $("body").mCustomScrollbar({
            theme: "inset-dark",
            scrollInertia: 0,
            callbacks:{
                whileScrolling:function(){
                    /*scroll top*/
                    var ratio = this.mcs.top / (($('body').height () - $('#mCSB_1_container').height ()) / 100);
                    $("#progress").width (ratio + "%");
                }
            },
            scrollButtons:{ enable: true},
            keyboard:
            { 
                enable: true,
                scrollAmount: 10
            }
        });
    });
})(jQuery);

$(function(){
    $(document).on("click", "#randAnime", function() {
         $.ajax({
            type: "GET",
            url: "php_handlers/randAnime.php",
            success: function (idAnime) {
                animeFlayerMainPageClickPlaySendAjaxAndScroll(idAnime,1,1);
            }
        });
    });
    
    $(document).on("click", ".animeFlayerMainPage", function() {
        animeFlayerMainPageClickPlay(this,1,1);
    });
    
    $(document).on("click", ".fastSearchLi", function() {
        $(this).parents(".searchAnime").children("input")[0].value = "";
        $(this).parent("ul").html("");
        history.pushState(null, null, 'http://'+window.location.hostname);
        animeFlayerMainPageClickPlaySendAjaxAndScroll(this.getAttribute("idAnime"),1,1);
    });
    
    $(".chat_message_user_message").mCustomScrollbar({
            theme: "inset-2-dark",
            axis:"x",
            scrollButtons:{ enable: true},
            keyboard:
            { 
                enable: true,
                scrollAmount: 10
            }
        });
    
});