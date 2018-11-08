<?php //отправка письма для изменения пароля
require_once "../connect_bd.php";
connectBd();

require_once "../libs/functions.php";
    
function checkData(){
    if(recapCheck() == false)
        return 1;
    
    $email = $_POST['email'];
    $user=R::findOne('users', 'email = ?', array($email));
    $Activ_key = password_hash($email, PASSWORD_DEFAULT);//шифруем код (email)
    R::getRow("UPDATE `users` SET `activ_key`= ? WHERE `email` = ? ", array($Activ_key, $email));
    
    //отправляем письмо с ссылкой изменения пароля
    $subject = 'Изменение пароля на сайте на сайте '.$_SERVER['HTTP_HOST'];
    $message = 'Ссылка для изменения пароля: http://'.$_SERVER['HTTP_HOST'].'/user_login/changePass.php?login_active='.$user['login'].'&key='.$Activ_key;
    $headers = 'From: user@anogo.zzz.com.ua';
    mail($email, $subject, $message, $headers);
    
    return 0;
}

echo checkData();

?>