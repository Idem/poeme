<?php
require_once './utils.php';

if (get($_GET['id'])) {
    $img_path = get_img(get($_GET['id']), $_GET);
    if ( get($_GET['debug'], false) == false) {
        header("Content-Type: image/jpeg");
        header("No-Cache: True");
        readfile($img_path);
    }
}
?>
