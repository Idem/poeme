<?php
if (! in_array( $_GET['id'], array('1', '2', '3', '4', '5'))) {
    echo 'invalid verse';
    return;
}
$sec_per_image = 20;
$verse = 'verse' . $_GET['id'] ;
$file_path = '../verse' . $_GET['id'] ;
session_start();
require_once './functions.php';

// echo count($_SESSION[$verse]);
// echo Print_r($_SESSION[$verse]);
if (! $_SESSION[$verse] or $_GET['refresh']==true)
{
    $flist = array();
#$lfile = scandir($file_path);
    if ($handle = opendir($file_path)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {
                $flist[] = $file;
            }
        }
        closedir($handle);
    }
    $flist = array_filter($flist, is_picture);
    $_SESSION[$verse] = array_values($flist);
    sort($_SESSION[$verse]);
}

$file_name = $_SESSION[$verse][array_rand($_SESSION[$verse])];
$file_name = $file_path.'/'.$file_name;
if ($_GET['status']==true)
{
    echo "Displaying random image out of ".count($_SESSION[$verse])."";
    echo "<br/>Current image name is: ".$file_name;
}
else
{
    header("Content-Type: image/jpeg");
    header("No-Cache: True");
    readfile($file_name);
}
?>
