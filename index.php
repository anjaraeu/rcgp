<?php
header("X-Author: skid9000 & leonekmi");

require_once('config.php');

$permalink;
$imagearr;
$imgurl;

if (!empty($_REQUEST['language'])) {
	if (!empty($_REQUEST['img'])) {
		if (!file_exists("imgs/".strtolower($_REQUEST["language"])."/".$_REQUEST['img'])) {
			http_response_code(404);
			exit("L'image demandée n'existe plus ou a été renommée, merci de contacter l'équipe si vous pensez que c'est une erreur");
		} else {
			$permalink = true;
			$imagename = $_REQUEST['img'];
			$imgurl = $config['url'] . "/imgs/".strtolower($_REQUEST["language"])."/".$_REQUEST['img'];
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
		$imgurl = $config['url'] . "/imgs/".strtolower($_REQUEST["language"])."/".$imagearr[0];
		$permalink = false;
	}
} else {
	if (!empty($_REQUEST['img'])) {
		if (!file_exists("img/".$_REQUEST['img'])) {
			http_response_code(404);
			exit("L'image demandée n'existe plus ou a été renommée, merci de contacter l'équipe si vous pensez que c'est une erreur");
		} else {
			$imgurl = $config['url'] . "/img/".$_REQUEST['img'];
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

		$imagename = $imagearr[0];
		$imgurl = $config['url'] . "/img/".$imagearr[0];
		$permalink = false;
	}
}

if (!empty($_REQUEST['language'])) {
	$lien = $config['url'] . "/?language=" . $_REQUEST['language'] . "&img=" . $imagename;
} else {
	$lien = $config['url'] . "/?img=" . $imagename;
}

header("X-OriginalLocation: ".$imgurl);
$facebook_link  = 'https://www.facebook.com/sharer/sharer.php?u='.urlencode($lien);
$twitter_link  = 'https://twitter.com/share?url=' . urlencode($lien) . '&text=Random%20Cute%20Girls%20Programming';
$diaspora_link = 'https://sharetodiaspora.github.io/?url=' . urlencode($lien) . '&title=Random%20Cute%20Girls%20Programming';
$mail_link = 'mailto:?subject=Random%20Cute%20Girls%20Programming&body=RCGP%20-%20' . urlencode($lien);
$mastodon_link = 'https://sharetomastodon.github.io/?url=' . urlencode($lien) . '&title=Random%20Cute%20Girls%20Programming';

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
		<meta name="twitter:site" content="@anjaraeu">
		<meta name="twitter:creator" content="@skid9000">
		<meta name="twitter:title" content="RCGP - Random Cute Girls Programming">
		<meta name="twitter:description" content="Random image of CGP generator">
		<meta name="twitter:image" content="<?php echo $config['url'] ?>/img/1492870106236.jpg">
		<meta property="og:title" content="RCGP - Random Cute Girls Programming">
		<meta property="og:description" content="Random image of CGP generator">
		<meta property="og:type" content="website">
		<meta property="og:image" content="<?php echo $config['url'] ?>/img/1492870106236.jpg">
		<meta property="og:url" content="<?php echo $config['url'] ?>">
			<?php
		} else {
				if (empty($_REQUEST['language'])) {
					?>
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@anjaraeu">
		<meta name="twitter:creator" content="@skid9000">
		<meta name="twitter:title" content="RCGP - Random Cute Girls Programming">
		<meta name="twitter:description" content="<?php echo $imagename ?>">
		<meta name="twitter:image" content="<?php echo $config['url'] ?>/img/<?php echo $imagename; ?>">
		<meta property="og:title" content="RCGP - Random Cute Girls Programming">
		<meta property="og:description" content="<?php echo $imagename ?>">
		<meta property="og:type" content="website">
		<meta property="og:image" content="<?php echo $config['url'] ?>/img/<?php echo $imagename; ?>">
		<meta property="og:url" content="<?php echo $lien; ?>">
				<?php
				} else {
					?>
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@anjaraeu">
		<meta name="twitter:creator" content="@skid9000">
		<meta name="twitter:title" content="RCGP - Random Cute Girls Programming">
		<meta name="twitter:description" content="<?php echo $imagename ?>">
		<meta name="twitter:image" content="<?php echo $config['url'] ?>/imgs/<?php echo $_REQUEST['language']; ?>/<?php echo $imagename; ?>">
		<meta property="og:title" content="RCGP - Random Cute Girls Programming">
		<meta property="og:description" content="<?php echo $imagename ?>">
		<meta property="og:type" content="website">
		<meta property="og:image" content="<?php echo $config['url'] ?>/imgs/<?php echo $_REQUEST['language']; ?>/<?php echo $imagename; ?>">
		<meta property="og:url" content="<?php echo $lien; ?>">
				<?php
				}
			}
		?>
		<link rel="stylesheet" href="assets/css/semantic.min.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/rcgp-icons.css">
	</head>

	<body>
		<a href="https://github.com/anjaraeu/rcgp"><img style="position: absolute; top: 0; right: 0; border: 0;" src="assets/img/forkme.png" alt="Fork me on GitHub" data-canonical-src="assets/img/forkme2.png"></a>
		<center>
		<a href="<?php echo $imgurl; ?>">
			<img src="<?php echo $imgurl; ?>" alt="<?php echo $imagename; ?>">
		</a>
		
		<p>
			<a href="<?php echo $imgurl; ?>"><?php echo $imagename; ?></a> / <a href="<?php echo $lien; ?>">Permalien (pour le partage)</a>
		</p>
		
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
		<p>
			<a href="<?php echo $mail_link; ?>" class="ui labeled icon yellow button">
			<i class="envelope icon"></i>
			E-Mail
			</a>
			<a href="javascript:;" onclick="window.open('<?php echo $twitter_link; ?>','das','location=no,links=no,scrollbars=no,toolbar=no,width=620,height=550'); return false;" class="ui labeled icon twitter button">
			<i class="twitter icon"></i>
			Twitter
			</a>
			<a href="javascript:;" onclick="window.open('<?php echo $facebook_link; ?>','das','location=no,links=no,scrollbars=no,toolbar=no,width=620,height=550'); return false;" class="ui labeled icon facebook button">
			<i class="facebook f icon"></i>
			Facebook
			</a>
			<a href="javascript:;" onclick="window.open('<?php echo $diaspora_link; ?>','das','location=no,links=no,scrollbars=no,toolbar=no,width=620,height=550'); return false;" class="ui labeled icon black button">
			<i class="rcgp-icon-diaspora icon"></i>
			Diaspora*
			</a>
			<a href="javascript:;" onclick="window.open('<?php echo $mastodon_link; ?>','das','location=no,links=no,scrollbars=no,toolbar=no,width=620,height=550'); return false;" class="ui labeled icon blue button">
			<i class="rcgp-icon-mastodon icon"></i>
			Mastodon
			</a>
		</p>
		<div class="credits">Powered by Tuto-Craft Corporation, nekmi corp software development and anjara.eu team.<br/>Majority of images are coming from <a href="https://github.com/MeyerHallot/Anime-Girls-Holding-Programming-Books" target="_blank">Anime-Girls-Holding-Programming-Books</a> GitHub repository.</div>
		</center>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/semantic.min.js"></script>
		<script src="assets/js/select.js"></script>
	</body>
</html>
