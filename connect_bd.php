<?php
    session_start();
	require_once 'libs/rb.php';//подключаем php файл (библиотеку для работы с бд)
    include 'config.php';
    
    function connectBd()
    {
        if(!R::testConnection()){
            R::setup('mysql:host='.Host.'; dbname='.BdAnimeName.'', ''.BdUserName.'', ''.BdPass.'');
        }
    }
    
?>
