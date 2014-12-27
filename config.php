<?php
$config_file = (file_exists("./test_config.ini")) ? "./test_config.ini" : "./config.ini";
$config = parse_ini_file($config_file , true);
?>
