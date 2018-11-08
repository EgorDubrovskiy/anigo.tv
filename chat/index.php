<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/libs/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/libs/rb.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/connect_bd.php';

function getChat($idAnime, $isUser, $numJmpBut)
{
    connectBd();
    
    $res = '';
    if($isUser)
    {
        $res .= '
            <script src="/chat/ckeditor/ckeditor.js"></script>
            <div id="form_enter_message"></div>
            <div>
             <form id="form_for_enter_message">
                <textarea class="ChatMessage" name="message" placeholder="Текст сообщения" required></textarea>
                <input type="submit" name="enter" value="Отправить" class="btn btn-success mt-2 mb-2"> <input type="reset" value="Очистить" class="btn btn-secondary mt-2 mb-2" onclick = "CKEDITOR.instances[\'message\'].setData(\'\');">
            </form>
            </div>
            <script>CKEDITOR.replace("message");</script>
        ';
    }
    
    $comments = R::getAll( 'SELECT comments.id, comments.time, comments.message, users.login, users.avatar_img FROM comments INNER JOIN users ON comments.id_user = users.id WHERE comments.id_anime = ? ORDER BY comments.id ', array($idAnime) );
    
    //echo var_dump($comments);

    $jump_buttons = Jump_buttons::Get($numJmpBut,count($comments),10,"btn btn-success m-0 pl-0 pr-0 ComentButJump", "btn btn-dark m-0 pl-0 pr-0 ComentButJumpActive", "sendAjaxByClickJBComments(this.textContent, getUrlVars().id)");
    
    $res .= '<div id="chat">
        <div class="chat_messages">';
    //вывод истории чата
    for($i=$jump_buttons['iEnd']-1;$i>=$jump_buttons['iBegin'];$i--)
    {
        $message = $comments[$i];
        
        $res .='
        <div class="alert alert-success user_info_com_container">
            <div class="row">
                <div class="chat_message_user_info">
                    <div class="user_name row">'.$message['login'].'</div>
                    <img src="'.$message['avatar_img'].'" class="chat_message_user_img row">
                    <div class="time row">'.$message['time'].'</div>
                </div>
                <div class="chat_message_user_message">'.$message['message'].'</div>
            </div>
        </div>';
    }
    $res .= '</div>
        <div class="commentsJB">'.$jump_buttons['buttons'].'</div>
    </div>
    <link rel=\'stylesheet\' href=\'/chat/style.css\'>
    <script src="/chat/handler.js"></script>';
    
    return $res;
}

function JBClick($numJmpBut, $id_anime)
{
    connectBd();

    $comments = R::getAll( 'SELECT comments.id, comments.time, comments.message, users.login, users.avatar_img FROM comments INNER JOIN users ON comments.id_user = users.id WHERE comments.id_anime = ? ORDER BY comments.id ', array($id_anime));
    
    if($numJmpBut == -1){
        if(count($comments)%10 == 0) $numJmpBut = count($comments)/10;
        else $numJmpBut = ((int)(count($comments)/10)) + 1;
    }

    $jump_buttons = Jump_buttons::Get($numJmpBut,count($comments),10,"btn btn-success m-0 pl-0 pr-0 ComentButJump", "btn btn-dark m-0 pl-0 pr-0 ComentButJumpActive", "sendAjaxByClickJBComments(this.textContent, getUrlVars().id)");
    
    $res .= '
        <div class="chat_messages">';
    //вывод истории чата
    for($i=$jump_buttons['iEnd']-1;$i>=$jump_buttons['iBegin'];$i--)
    {
        $message = $comments[$i];
        
        $res .='
        <div class="alert alert-success user_info_com_container">
            <div class="row">
                <div class="chat_message_user_info">
                    <div class="user_name row">'.$message['login'].'</div>
                    <img src="'.$message['avatar_img'].'" class="chat_message_user_img row">
                    <div class="time row">'.$message['time'].'</div>
                </div>
                <div class="chat_message_user_message">'.$message['message'].'</div>
            </div>
        </div>';
    }
    $res .= '</div>
        <div class="commentsJB">'.$jump_buttons['buttons'].'</div>';
    
    return array("res" =>$res, "numJmpBut" => $numJmpBut);
}

?>