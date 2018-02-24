<?php
header("X-Author: skid9000 & leonekmi");

if (isset($_REQUEST['language'])) {
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

    $imgurl = "https://rcgp.nsa.ovh/imgs/".strtolower($_REQUEST["language"])."/".$imagearr[0];
} else {
    $imagearr = scandir("img");
    // Avoid . and ..
    unset($imagearr[0]);
    unset($imagearr[1]);

    shuffle($imagearr);
    shuffle($imagearr);
    // YEAH ENTROPY

    // skid pète les couilles readfile("img/".$imagearr[0]);

    $imgurl = "https://rcgp.nsa.ovh/img/".$imagearr[0];
}

header("X-OriginalLocation: ".$imgurl);

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
<style>
body {
	background-color: #515151;
}
a {
	color: #e0e0e0;
}
img {
	object-fit: contain;
	max-width: 100%;
	height: auto;
}
</style>
</head>

<body>
<a href="<?php echo $imgurl; ?>">
<img src="<?php echo $imgurl; ?>">
<p><?php echo $imagearr[0]; ?></p>
</a>
<p style="font-size: 10px; color: #e0e0e0;">Powered by Tuto-Craft Corporation, nekmi corp software development and NSA.OVH team</p>
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
<script src="https://nocdn.nsa.ovh/cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="select.js"></script>
</body>

</html>
