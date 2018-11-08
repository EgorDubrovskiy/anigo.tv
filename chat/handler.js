function sendAjaxByClickJBComments(numJmpBut, id_anime)
{
    $.ajax({
            type: "GET",
            url: "chat/handler.php",
            data: {numJmpBut: numJmpBut, id_anime: id_anime},
            success: function(data){
                
                var res = jQuery.parseJSON(data);
                $('#chat').html(res.res);
                var get = getUrlVars();
                history.pushState(null, null, 'http://'+window.location.hostname+'?AnimeName='+get['AnimeName']+'&id='+get['id']+'&Seson='+get['Seson']+'&Episode='+get['Episode']+'&comments='+res.numJmpBut);
            }
        });
}

$("document").ready(function(){
    $("#form_for_enter_message").submit(function(e){
        CKEDITOR.instances['message'].updateElement();//обновляем данные об элементе
        e.preventDefault();//убираем перезагрузку страницы
        var message = CKEDITOR.instances['message'].getData();
        if(message == "") return;
        var id_anime = getUrlVars()["id"];
        $.ajax({type: "GET",url: "chat/send.php",data: {id_anime: id_anime, message: message}});//send message
        sendAjaxByClickJBComments(-1, id_anime);
        CKEDITOR.instances['message'].setData('');
    });
});