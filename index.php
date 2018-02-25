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

if (!empty($_REQUEST['language'])) {
    $lien = "https://rcgp.nsa.ovh/?language=" . $_REQUEST['language'] . "&img=" . $imagename;
} else {
    $lien = "https://rcgp.nsa.ovh/?img=" . $imagename;
}

header("X-OriginalLocation: ".$imgurl);
$facebook_link  = 'https://www.facebook.com/sharer/sharer.php?u='.urlencode($lien);
$twitter_link  = 'http://twitter.com/share?url=' . urlencode($lien) . '&text=Random%20Cute%20Girls%20Programming';
$diaspora_link = 'http://sharetodiaspora.github.io/?url=' . urlencode($lien) . '&title=Random%20Cute%20Girls%20Programming';
$mail_link = 'mailto:?subject=Random%20Cute%20Girls%20Programming&body=RCGP - ' . urlencode($lien);
$mastodon_link = 'http://sharetomastodon.github.io/?url=' . urlencode($lien) . '&title=Random%20Cute%20Girls%20Programming';

?>
<!doctype html>
<html>
<head>
<title>RCGP - Random Cute Girls Programming</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
if (!$permalink) {
    ?>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@nsaovh">
<meta name="twitter:creator" content="@skid9000">
<meta name="twitter:title" content="RCGP - Random Cute Girls Programming">
<meta name="twitter:description" content="Random image of CGP generator">
<meta name="twitter:image" content="https://rcgp.nsa.ovh/img/1492870106236.jpg">
<meta property="og:title" content="RCGP - Random Cute Girls Programming">
<meta property="og:description" content="Random image of CGP generator">
<meta property="og:type" content="website">
<meta property="og:image" content="https://rcgp.nsa.ovh/img/1492870106236.jpg">
<meta property="og:url" content="https://rcgp.nsa.ovh/">
    <?php
} else {
        if (empty($_REQUEST['language'])) {
            ?>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@nsaovh">
<meta name="twitter:creator" content="@skid9000">
<meta name="twitter:title" content="RCGP - Random Cute Girls Programming">
<meta name="twitter:description" content="<?php echo $imagename ?>">
<meta name="twitter:image" content="https://rcgp.nsa.ovh/img/<?php echo $imagename; ?>">
<meta property="og:title" content="RCGP - Random Cute Girls Programming">
<meta property="og:description" content="<?php echo $imagename ?>">
<meta property="og:type" content="website">
<meta property="og:image" content="https://rcgp.nsa.ovh/img/<?php echo $imagename; ?>">
<meta property="og:url" content="<?php echo $lien; ?>">
        <?php
        } else {
            ?>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@nsaovh">
<meta name="twitter:creator" content="@skid9000">
<meta name="twitter:title" content="RCGP - Random Cute Girls Programming">
<meta name="twitter:description" content="<?php echo $imagename ?>">
<meta name="twitter:image" content="https://rcgp.nsa.ovh/imgs/<?php echo $_REQUEST['language']; ?>/<?php echo $imagename; ?>">
<meta property="og:title" content="RCGP - Random Cute Girls Programming">
<meta property="og:description" content="<?php echo $imagename ?>">
<meta property="og:type" content="website">
<meta property="og:image" content="https://rcgp.nsa.ovh/imgs/<?php echo $_REQUEST['language']; ?>/<?php echo $imagename; ?>">
<meta property="og:url" content="<?php echo $lien; ?>">
        <?php
        }
    }
?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="semantic.min.css">
</head>

<body>
<a href="https://github.com/nsaovh"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/52760788cde945287fbb584134c4cbc2bc36f904/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f77686974655f6666666666662e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_white_ffffff.png"></a>
<center>
<a href="<?php echo $imgurl; ?>">
<img src="<?php echo $imgurl; ?>">
<p><?php echo $imagename; ?></a> / <a href="<?php echo $lien; ?>">Permalien (pour le partage)</a></p>
<p>Access the <a href="https://community.rcgp.nsa.ovh">RCGP community</a> to submit images and discuss about Random Cute Girls Programming !</p>
<select id="language" class="ui dropdown">
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
<ul>
    <a href="<?php echo $mastodon_link; ?>"><li>Mastodon</li></a>
</ul>
</div>
<br/>
<p class="credits">Powered by Tuto-Craft Corporation, nekmi corp software development and NSA.OVH team</p>
</center>
<script src="https://nocdn.nsa.ovh/cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="semantic.min.js"></script>
<script src="select.js"></script>
</body>

</html>
