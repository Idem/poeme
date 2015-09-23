<?php
$config_file = (file_exists("./test_config.ini")) ? "./test_config.ini" : "./config.ini";
$config = parse_ini_file($config_file , true);

$br_table = array("cli" => "\n",
                  "cgi-fcgi" => "<br/>",
                  "cli-server" => "<br/>");
$br = get($br_table[php_sapi_name()], "<br/>");

$ACCEPTED_EXTENSIONS = array("jpg", "png", "gif", "bmp", "jpeg");

function is_picture($file_name)
{
    // return true if provided filename is an accepted image format.
    global $ACCEPTED_EXTENSIONS;
    $exploded_filename = explode(".", $file_name);
    $upper_ext = array_pop($exploded_filename);
    $extension = strtolower($upper_ext);
    return in_array($extension, $ACCEPTED_EXTENSIONS);
}

function get_img_list($img_list, $params=array()) {
    // Retreive, set (or reset) an image list
    try {
        session_start();
    }
    catch (Exception $e) {
        // pokemon!
    }


    if (get($params["debug"], false) === true) {
        print_debug("retreiving img list for ".$img_list);
    }

    if (! array_key_exists($img_list, get($_SESSION, array())) or
        get($params["force_refresh"], false) === true or
        count($_SESSION[$img_list]) == 0)
    {
        $file_path = get_config($img_list, "path");
        if (get($params["debug"], false) === true) {
            print_debug("Compute image list from '".$file_path."'");
        }
        $file_list = array();
        if ($handle = opendir($file_path)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    $file_list[] = $file;
                }
            }
            closedir($handle);
        }
        $file_list = array_filter($file_list, "is_picture");
        $_SESSION[$img_list] = array_values($file_list);
        if (get_config($img_list, "random", false) === true) {
            shuffle($_SESSION[$img_list]);
        }
        else {
            sort($_SESSION[$img_list]);
        }
    }
    elseif (get($params["debug"], false) === true) {
        print_debug("Retreiving image list from SESSION");
    }

    if (get($params["debug"], false) === true) {
        print_debug(count($_SESSION[$img_list])." img found");
    }

    return $_SESSION[$img_list];
}

function print_debug($text) {
    // print a debug line and line break
    global $br;
    print($text.$br);
}

function get_img($img_list, $params=array()) {
    // Retreive current image file_name to display for an image list
    $list = get_img_list($img_list, $params);
    $refresh = get_config($img_list, "refresh");
    $image_path = get_config($img_list, "path")."/".$list[(time() / $refresh % count($list))];
    if (get($params["debug"], false) === true) {
        print_debug("image is valid for ".$refresh."s");
        print_debug("displayed img: '".$image_path."'");
    }

    return $image_path;
}

function get(&$var, $default=null) {
    // return a value with a default is array key do not exists
    return isset($var) ? $var : $default;
}

function get_config($img_list, $key, $default=null) {
    // return the config value for an image list + key
    if (! array_key_exists($img_list, $GLOBALS["config"])) {
        throw new InvalidArgumentException("Unknown img list:".$img_list, 1);
    }
    return get($GLOBALS["config"][$img_list][$key], $default);
}
