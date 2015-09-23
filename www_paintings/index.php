<?php
require_once '../utils.php';

if (get($_GET['image'])) {
    $img_path = get_img(get($_GET['image']), $_GET);
    if ( get($_GET['debug'], false) === false) {
        header("Content-Type: image/jpeg");
        header("No-Cache: True");
        readfile($img_path);
    }
}
else
{ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="./paintings.css" media="screen"/>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title>25000 PAINTINGS</title>
    <noscript>
        <meta http-equiv="Refresh" content="10;url=."/>
    </noscript>
</head>
<body>
    <div class="abstract">
        <h1>25 000 PAINTINGS</h1>
        <h2><strong>Christophe Berhault</strong></h2>
        <p><a href="javascript:toggle_detail()">About</a></p>
    </div>
    <div id="detail" class="detail" onclick="javascript:toggle_detail();">
        <h1>25 000 PAINTINGS</h1>
        <h2>Christophe Berhault</h2>
        <p>
25 000 Paintings is a selection of 25 000 amateurs photos taken from family albums, from boxes of photos found in the flea-markets and antique-shops of Berlin.
<br/>
The photos cover roughly a century : 1890-1995.
<br/>
They appear in no particular chronological order.
<br/>
Each one shows for 10 seconds. In its entirety, 25 000 Paintings lasts for three days and three nights.
<br/>
Viewing 24 hours a day, non-stop, it plays on ad infinitum.
<br/>
Artist Christophe Berhault has chosen these photographs from amongst thousands, has re-photographed, edited, sometimes re-cropped them.
<br/>
It is the very course of life that files past in front of us, its celebrations, anniversaries, love-stories, holidays.
<br/>
A century of history too, wars, tragedies, the dividing of a country in two, its reconstruction.
<br/>
Personal stories join hands with History, for this hypnotizing link-up of shots saved from oblivion.</p>
        <p><a target="_blank" href="http://www.christophe-berhault.com/">http://www.christophe-berhault.com</a></p>
        <p><a target="_blank" href="mailto:contact@25000paintings.com">contact@25000paintings.com</a></p>
    </div>
    <div id="img_container" class="embeded_screen">
        <div class="ratio">
            <div class="inner">
<?php
    foreach (array_keys($config) as $key){
?>
                <img id="<?=$key?>" class="<?=$key?>" src="?image=<?=$key?>&get=1" onclick="javascript:full_screen();" alt="25000 paintings by Christophe Berhault"/>
<?php  }
?>
            </div>
        </div>
    </div>
    <div id="overlay" class="overlay"></div>
    <script type="text/javascript" src="./jquery.min.js"></script>
    <script type="text/javascript" src="./paintings.js"></script>
    <script type="text/javascript">
<?php
    foreach ($config as $key => $settings){
?>
        setInterval(function(){refresh_image('<?=$key?>');}, <?=$settings["refresh"]?>000);
<?php  }
?>
    </script>
</body>
</html>
<?php }