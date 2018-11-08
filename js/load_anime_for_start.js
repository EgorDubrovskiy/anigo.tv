function animeFlayerMainPageClickPlaySendAjaxAndScroll(idAnime,Seson,Episode)
{
    var commentsNumJB = getUrlVars()['comments'];
    if(commentsNumJB == null) commentsNumJB = -1;

     $.ajax({
        type: "GET",
        url: "php_handlers/animeFlayerClick.php",
        data: {idAnime: idAnime, Seson: Seson, Episode: Episode, commentsNumJB: commentsNumJB},
        success: function (data) {
            //alert(data);
            var res = jQuery.parseJSON(data);
            
            //меняем значение переменной get
            history.pushState(null, null, 'http://'+window.location.hostname+'?AnimeName='+res.EnglNameAnime+'&id='+idAnime+'&Seson='+Seson+'&Episode='+Episode+'&comments='+res.numJmpBut);
            
            document.getElementById("AnimeFlayrs").className = "row p-0";
            $("#AnimeFlayrs").html(res.video_player);
            $("#AnimeFlayrsButJump").hide();
            
            $(".ChoiceSeson")[Seson-1].className +=" ChoiceSesonActive";
            
            document.getElementById("numberSerForBigScrMask1_"+Episode).className +=" maskActive";
            document.getElementById("numberSerForBigScrMask2_"+Episode).className +=" maskActive";
            
            $('#chatContainer').html(res.comments);
            $('#chatContainer').show();
        }
    });
    
    //плавная прокруткаr
    $('body').mCustomScrollbar('scrollTo','#mainMenu',{
        timeout:1000
    });
}

//аналог var_dump из php дял js  
function objDump(object) {
    var out = "";
    if(object && typeof(object) == "object"){
        for (var i in object) {
            out += i + ": " + object[i] + "\n";
        }
    } else {
        out = object;
    }
        alert(out);
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}