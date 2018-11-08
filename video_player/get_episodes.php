<?php

require_once "index.php";
if($_GET['type'] == "BigScrean") echo getEpisodesForBigScr($_GET['AnimeName'], $_GET['numSeson']);
elseif($_GET['type'] == "SmallScrean") echo getEpisodesForBigScr($_GET['AnimeName'], $_GET['numSeson']);
else echo 'Error: invalid GET('.$_GET['type'].')';

?>