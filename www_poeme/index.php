<?php
require_once '../utils.php';

if (get($_GET['image'])) {
    $img_path = get_img(get($_GET['image']), $_GET);
    if ( get($_GET['debug'], false) == false) {
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
    <link rel="stylesheet" type="text/css" href="./poem.css" media="screen"/>
    <meta name="author" content="Christophe Berhault">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title>Po&egrave;me</title>
    <noscript>
        <meta http-equiv="Refresh" content="10;url=."/>
    </noscript>
</head>
<body>
    <div class="abstract">
        <h1>Po&egrave;me</h1>
        <h2><strong>Christophe Berhault</strong></h2>
        <p><a href="javascript:toggle_detail()">About</a></p>
    </div>
    <div id="detail" class="detail" onclick="javascript:toggle_detail();">
        <h1>Po&egrave;me</h1>
        <h2>Christophe Berhault</h2>
        <p><a href="http://poeme.me">poeme.me</a> is a visual poem in five screens<br/>
Each screen corresponds to one of the five strophes of the poem.<br/>
The strophes are of varying lengths and are composed <br/>of a specific group of
images (between 2000 and 7000).<br/>
The images follow one another in an order that is random.<br/>
Their exposure time varies, for each screen, from 17 to 21 seconds.<br/>
The uncontrolled switching of the images, combined with the slight time-lapse of
their showing and the varying length of the strophes, mean that the possible
associations are almost infinite. And reinforce the obsessive nature of certain
themes.</p>
<p>Christophe Berhault photographed this set of 26 600 images in Berlin between 2008 and 2012. He selected them day by day and according to his mood, but also chance, the news, and his findings, in second-hand books, newspapers and tabloids, postcards and brochures....
</p>
<p><a href="http://poeme.me">poeme.me</a> evokes automatic writing. Exquisite corpses.</p>
        <p><a target="_blank" href="http://www.christophe-berhault.com/">http://www.christophe-berhault.com</a></p>
        <p><a target="_blank" href="mailto:contact@25000paintings.com">contact@25000paintings.com</a></p>
<br/>
<p><a href="http://poeme.me">poeme.me</a> est un po&egrave;me visuel en cinq &eacute;crans.</p>
<p>A chaque &eacute;cran correspond l&#39;une des cinq strophes du po&egrave;me. <br/>
Les strophes sont plus ou moins longues et compos&eacute;es <br/>d&#39;un ensemble sp&eacute;cifique
d&#39;images (entre 2000 et 7000).<br/>
Les images se succ&egrave;dent de mani&egrave;re al&eacute;atoire.<br/>
Leur temps d&#39;exposition varie, selon  les &eacute;crans, de 17 &agrave; 21 secondes.<br/>
L&#39;alternance non contr&ocirc;l&eacute;e des images conjugu&eacute;e au l&eacute;ger d&eacute;calage de l&#39;affichage
et &agrave; la dur&eacute;e variable des strophes d&eacute;multiplie les associations possibles. Et
renforce l&#39;aspect obsessionnel de certains th&egrave;mes.</p>
<p>Christophe Berhault &agrave; photographi&eacute; &agrave; Berlin entre 2008 et 2012 cet ensemble
de 26 600  images. Il les a s&eacute;lectionn&eacute;es au fil des jours et au gr&eacute; de l&#39;humeur,
selon le hasard, l&#39;actualit&eacute;, les trouvailles, dans des livres d&#39;occasion, des
journaux et tablo&iuml;ds, des cartes postales, des brochures...</p>
<p><a href="http://poeme.me">poeme.me</a> &eacute;voque l&#39;&eacute;criture automatique. Les cadavres exquis.</p>
   </div>
    <div id="img_container" class="embeded_screen">
        <div class="ratio">
            <div class="inner">
<?php
    foreach (array_keys($config) as $key){
?>
              <img id="<?=$key?>" class="<?=$key?>" src="?image=<?=$key?>&get=1" onclick="javascript:full_screen();" alt="Po&egrave;me by Christophe Berhault"/>
<?php  }
?>
            </div>
        </div>
    </div>
    <div id="overlay" class="overlay"></div>
    <script type="text/javascript" src="./jquery.min.js"></script>
    <script type="text/javascript" src="./poem.js"></script>
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
<?php } ?>
