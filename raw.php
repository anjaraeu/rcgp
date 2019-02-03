<?php

require_once('config.php');

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

    header("Content-type: " . mime_content_type("imgs/".strtolower($_REQUEST["language"])."/".$imagearr[0]));
    header("X-Author: skid9000 & leonekmi");
    header("X-OriginalLocation: " . $config['url'] . "/imgs/".strtolower($_REQUEST["language"])."/".$imagearr[0]);

    readfile("img/".$imagearr[0]);
} else {
    $imagearr = scandir("img");
    // Avoid . and ..
    unset($imagearr[0]);
    unset($imagearr[1]);

    shuffle($imagearr);
    shuffle($imagearr);
    // YEAH ENTROPY

    header("Content-type: " . mime_content_type("img/".$imagearr[0]));
    header("X-Author: skid9000 & leonekmi");
    header("X-OriginalLocation: " . $config['url'] . "/img/".$imagearr[0]);

    readfile("img/".$imagearr[0]);
}
