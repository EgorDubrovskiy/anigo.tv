<?php
	//Регистрация пользователя
    require_once "../connect_bd.php";
    connectBd();

    require "passwordValidation.php";
    require_once "../libs/functions.php";

    function checkData()
    {
        switch($_GET['type'])
        {
            case "login": 
            if(trim($_GET['data'])=='')//trim - убирает пробелы
                return 1;//Введите логин!

            //проверка на наличие введённого логина для регистрации в бд
            if(R::count('users', "login = ?", array($_GET['data']))>0)
                return 2;//Пользователь с таким логином уже существует!
            $size = strlen(trim($_GET['data']));
            if(($size >= 5 && $size <= 10) == false)
                return 3;
            
            return 0;
            
            case "email":
            if(R::count('users', "email = ?", array($_GET['data']))>0)
            {
                return 1;//Пользователь с таким Email уже существует!
            }
            if(trim($_GET['data'])=='')
            {
                return 2;
            }
            if(!preg_match('~.@.~',$_GET['data']))
                return 3;
            return 0;
            
            case "pass":
            //проверка на корректность пароля
            return passwordValidation($_GET['data']);
            
            case "pass2":
            if(trim($_GET['data2'])=='')
            {
                return 1;//Подтвердите пароль!
            } 
            if($_GET['data'] != $_GET['data2'])
            {
                return 2;//Повторный пароль введён не верно!
            }
            return 0;
            
            case "img":
            //проверка на корректность выбранного файла(изобр. для аватарки)
            if($_GET['size'] > 2097152)
                return 1;//Размер изображения не должен превышать 2-х мегабайт
            else
            {
                if($_GET['fileType'] != 'image/jpeg' && $_GET['fileType'] != 'image/jpg' && $_GET['fileType'] != 'image/png')
                {
                    return 2;//Невырный формат файла (выберите файл с расширение png, jpeg, или jpg)
                }
            }
            return 0;
        }
        if(isset($_POST))
        {
            if(recapCheck() == false)//Капча введена не верно!
                return 1;


            //загрузка аватарки
            $fileName;
            if($_FILES['image']['type'] == 'image/jpeg')
                $fileName = 'avatar'.R::count('users').'.jpeg';
                else if($_FILES['image']['type'] == 'image/jpg')
                    $fileName = 'avatar'.R::count('users').'.jpg';
                else if($_FILES['image']['type'] == 'image/png')
                    $fileName = 'avatar'.R::count('users').'.png';

            //сохраняем аватарку на сервер
            move_uploaded_file($_FILES['image']['tmp_name'], '../user/'.$fileName.'');

            //регистрируем пользователя в базу данных
            $user = R::dispense('users');//создаём таблицу users если она не создана
            $user->login = $_POST['signup_login'];
            $user->email = $_POST['email'];
            $user->avatarImg = $fileName;
            $user->password = password_hash($_POST['signup_password'], PASSWORD_DEFAULT);//шифруем пароль
            $Activ_key = password_hash($_POST['signup_login'], PASSWORD_DEFAULT);//шифруем код (логин) для подтверждения регистрации
            $user->activ_key = $Activ_key;
            R::store($user);//сохраняем таблицу в бд*/


            //отправляем письмо с ссылкой для подтверждения регистрации
            $subject = 'Подтверждение регистрации на сайте Anigo.ru';
            $message = 'Ссылка для активации: http://'.$_SERVER['HTTP_HOST'].'/user_login/active.php?login_active='.$_POST['signup_login'].'&key='.$Activ_key;
            $headers = "Content-type: text/html; charset=utf-8\r\n"."From: user@anogo.zzz.com.ua";
            mail($_POST['email'], $subject, $message, iconv('utf-8', 'windows-1251', $headers));


            return 0; //Вы успешно зарегистрированы
        }
            
    }

    echo checkData();
?>
