<?php
header("X-Author: skid9000 & leonekmi");

$permalink;
$imagearr;
$imgurl;

if (!empty($_REQUEST['language'])) {
    if (!empty($_REQUEST['img'])) {
        if (!file_exists("imgs/".strtolower($_REQUEST["language"])."/".$_REQUEST['img'])) {
            http_response_code(404);
            exit("L'image demandée n'existe plus ou a été renommée, merci de contacter l'équipe de nsa.ovh si vous pensez que c'est une erreur");
        } else {
            $permalink = true;
            $imagename = $_REQUEST['img'];
            $imgurl = "https://rcgp.nsa.ovh/imgs/".strtolower($_REQUEST["language"])."/".$_REQUEST['img'];
        }
    } else {
        $languages = scandir("imgs");
        unset($languages[0]);
        unset($languages[1]);

        if (!in_array(strtolower($_REQUEST["language"]), $languages)) {
            exit("lol t kon ou koa la katégori exist pa");
        }

        $imagearr = scandir("imgs/".strtolower($_REQUEST["language"]));
        unset($imagearr[0]);
        unset($imagearr[1]);
        shuffle($imagearr);
        shuffle($imagearr);
        // YEAH ENTROPY

        $imagename = $imagearr[0];
        $imgurl = "https://rcgp.nsa.ovh/imgs/".strtolower($_REQUEST["language"])."/".$imagearr[0];
        $permalink = false;
    }
} else {
    if (!empty($_REQUEST['img'])) {
        if (!file_exists("img/".$_REQUEST['img'])) {
            http_response_code(404);
            exit("L'image demandée n'existe plus ou a été renommée, merci de contacter l'équipe de nsa.ovh si vous pensez que c'est une erreur");
        } else {
            $imgurl = "https://rcgp.nsa.ovh/img/".$_REQUEST['img'];
            $imagename = $_REQUEST['img'];
            $permalink = true;
        }
    } else {
        $imagearr = scandir("img");
        // Avoid . and ..
        unset($imagearr[0]);
        unset($imagearr[1]);

        shuffle($imagearr);
        shuffle($imagearr);
        // YEAH ENTROPY

        // skid pète les couilles readfile("img/".$imagearr[0]);

        $imagename = $imagearr[0];
        $imgurl = "https://rcgp.nsa.ovh/img/".$imagearr[0];
        $permalink = false;
    }
}

if ($permalink) {
    $lien =  $imgurl;
} else {
    if (isset($_REQUEST['language'])) {
        $lien =  "https://rcgp.nsa.ovh/?language=" . $_REQUEST['language'] . "&img=" . $imagearr[0];
    } else {
        $lien =  "https://rcgp.nsa.ovh/?img=" . $imagearr[0];
    }
}

header("X-OriginalLocation: ".$imgurl);
$facebook_link  = 'https://www.facebook.com/sharer/sharer.php?u='.urlencode($lien);
$twitter_link  = 'http://twitter.com/share?url=' . urlencode($lien) . '&text=RCGP';
$diaspora_link = 'http://sharetodiaspora.github.io/?url=' . urlencode($lien) . '&title=RCGP';
$mail_link = 'mailto:?subject=RCGP&body=RCGP - ' . urlencode($lien);

?>
<!doctype html>
<html>
<head>
<title>RCGP - Random Cute Girls Programming</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@nsaovh">
<meta name="twitter:creator" content="@skid9000">
<meta name="twitter:title" content="RCGP - Random Cute Girls Programming">
<meta name="twitter:description" content="Random image of CGP generator">
<meta name="twitter:image" content="https://rcgp.nsa.ovh/img/1492870106236.jpg">
<link rel="stylesheet" href="style.css">
</head>

<body>
<a href="<?php echo $imgurl; ?>">
<img src="<?php echo $imgurl; ?>">
<p><?php echo $imagename; ?></a> / <a href="<?php echo $lien; ?>">Permalien (pour le partage)</a></p>
<p class="credits">Powered by Tuto-Craft Corporation, nekmi corp software development and NSA.OVH team</p>
<select id="language">
    <option value="default" selected>All (Default)</option>
    <?php
        $imgsarr = scandir("imgs");
        unset($imgsarr[0]);
        unset($imgsarr[1]);
        foreach ($imgsarr as $value) {
            ?><option value="<?php echo $value; ?>"><?php echo $value; ?></option><?php
        }
     ?>

</select>
<br/>
<div class="partage">
<div class="titre">Partager</div>
<ul>
    <a href="<?php echo $mail_link; ?>"><li>Mail</li></a>
</ul>
<ul>
    <a href="<?php echo $twitter_link; ?>"><li>Twitter</li></a>
</ul>
<ul>
    <a href="<?php echo $facebook_link; ?>"><li>Facebook</li></a>
</ul>
<ul>
	<a href="<?php echo $diaspora_link; ?>"><li>Diaspora*</li></a>
</ul>
</div>
<script src="https://nocdn.nsa.ovh/cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="select.js"></script>
</body>

</html>
