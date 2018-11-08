$('.ChoiceSeson').click(function() {
    var numSeson = this.textContent.trim()[0];
    var get = getUrlVars();
    
    history.pushState(null, null, 'http://'+window.location.hostname+'?AnimeName='+get["AnimeName"]+'&id='+get["id"]+'&Seson='+numSeson+'&Episode='+1);
    
    var get = getUrlVars();
    document.getElementById("my-video_html5_api").setAttribute("src",'/anime/'+get["AnimeName"]+'/Seson'+numSeson+'/'+1+'.mp4');
    $.ajax({
        type: "GET",
        url: "video_player/get_episodes.php",
        data: {type: "BigScrean", AnimeName: get["AnimeName"], numSeson: get["Seson"]},
        success: function (data) {
            $($('#ChoiceSerForBigScr').find (".mCSB_container")[0]).html(data);
            
            var activeEp = $($('#ChoiceSerForBigScr').find (".ChoiceSer")[0]);
            changeStyleEp(activeEp);
            
            //помечаем кнопку с выбором сезона как отмечанную
            $(".ChoiceSesonActive").removeClass("ChoiceSesonActive");
            $(".ChoiceSeson")[numSeson-1].className +=" ChoiceSesonActive";
        }
    });
});

function changeStyleEp(Episode)
{
    //меняем стиль выделенного элемента
    $(".maskActive").removeClass("maskActive");
    Episode.children(".mask1")[0].className +=" maskActive";
    Episode.children(".mask2")[0].className +=" maskActive";
}

$(function(){
    $(document).on("click", ".ChoiceSer", function() {
    
        changeStyleEp($(this));

        var get = getUrlVars();
        var numEpisode = $(this).children(".numberSerForBigScr")[0].textContent[0];
        document.getElementById("my-video_html5_api").setAttribute("src",'/anime/'+get["AnimeName"]+'/Seson'+get["Seson"]+'/'+numEpisode+'.mp4');

        history.pushState(null, null, 'http://'+window.location.hostname+'?AnimeName='+get["AnimeName"]+'&id='+get["id"]+'&Seson='+get["Seson"]+'&Episode='+numEpisode);
    });
    
    /*скроллер для выбора серии*/
    $(".ChoiceSerForBigScr").mCustomScrollbar({
	    theme: "inset-2",
        scrollInertia: 0,
        alwaysShowScrollbar: 1,//показывать скролл даже еслион не нужен
	    scrollButtons:{ enable: true}
    });
});

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
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
        return out;
}

//убираем стандартный скроллер 
$(document).ready(
    function() {
      $("html").niceScroll({
        cursorcolor:"none", 
        background:"none", 
        autohidemode:"false", 
        cursorborder:"none", 
        cursorborderradius:"none"
      });
  });