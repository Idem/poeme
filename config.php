<?php
$config_file = (file_exists("./config.ini")) ? "./config.ini" : "./tests/config.ini";
$config = parse_ini_file($config_file , true);
?>
