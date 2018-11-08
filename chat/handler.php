<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/chat/index.php';

echo json_encode(JBClick($_GET['numJmpBut'], $_GET['id_anime']));

?>