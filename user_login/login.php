<?php
    //Авторизация
    require_once "../connect_bd.php";
    connectBd();

	function checkData()
    {
        $user=R::findOne('users', 'login = ?', array($_GET['login']));
        switch($_GET['type'])
        {
            case "login":
                if($user)
                {
                    if($user['activ_key'] != "") return 2;//если пользователь не подтвердил регистрацию
                    return 0;
                }
                else return 1;//Пользователь с таким логином не найден!
                
            
            case "pass":
                if(password_verify($_GET['pass'], $user->password))//если пароль введён верно
                {
                    return 0;
                }
                else
                {
                    return 1;//Неверно введён пароль!
                }
                
            //для восстановления пароля
            case "email":
                if(trim($_GET['data'])=='')
                    return 1;
                
                if(!preg_match('~.@.~',$_GET['data']))
                return 2;
                    
                $userByEmail=R::findOne('users', 'email = ?', array($_GET['data']));
                if($userByEmail)
                {
                    if($userByEmail['activ_key'] != "") return 3;//если пользователь не подтвердил регистрацию
                    return 0;
                }
                else return 4;//Пользователь с таким email не найден!
        }

        $_SESSION['user_login'] = $user->login;
        $_SESSION['user_img'] = '/user/'.$user->avatar_img;
        $_SESSION['id_user'] = $user->id;
        return '<div class="container-fluid pl-0 pr-0 pt-2 d-none d-xl-block">
            <div class="row">
                <div class="w-100 mb-1 text-uppercase"><b>'.$_SESSION['user_login'].'</b></div>
            </div>
            <div class="row">
                <div class="w-100 user_ava"><img class="rounded w-100" src="'.$_SESSION['user_img'].'" class="w-100" alt="аватарка"></div>
            </div>
            <div class="row">
                <div class="w-100">
                    <form action="" method="POST">
                        <button type="submit" name="exit" class="btn btn-danger pl-0 pr-0 ml-0 w-100 text-uppercase mt-xl-1 exitUser"><b>Выйти</b></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="userDataForSmallScrean d-xl-none">
            <div class="userLogin">
                '.$_SESSION['user_login'].'
            </div>
            <form class="exitUserForm" method="POST">
                <button type="submit" name="exit" class="btn pl-0 pt-0 pb-0 pr-0 ml-0 exitUser">
               <img src="images/user_login/userExit.png" alt="выйти" class="w-100">
            </button>
            </form>
        </div>';
        
    }
    echo checkData();

?>
