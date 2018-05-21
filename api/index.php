<?php

$json = array();
$json["author"] = "skid9000";
$json["developer"] = "leonekmi";
$json["IKEA (aka host)"] = "Luclu7Gaming";
header("Content-type: text/json");

if (isset($_REQUEST["listlanguages"])) {
	$array = scandir("../imgs", 1);
	unset($array[count($array)-1]);
	unset($array[count($array)-1]);
	echo json_encode($array, JSON_UNESCAPED_SLASHES + JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
	exit(0);
}
if (isset($_REQUEST["language"])) {
	$array = scandir("../imgs");
	if (in_array(strtolower($_REQUEST["language"]), $array)) {
		$imagearr = scandir("../imgs/".strtolower($_REQUEST["language"]));

		// Avoid . and ..
		unset($imagearr[0]);
		unset($imagearr[1]);

		shuffle($imagearr);
		shuffle($imagearr);
		// YEAH ENTROPY

		$json["category"] = strtolower($_REQUEST["language"]);
		$json["imglink"] = "https://rcgp.nsa.ovh/imgs/".strtolower($_REQUEST["language"])."/".$imagearr[0];
		$json["imgname"] = $imagearr[0];

		echo json_encode($json, JSON_UNESCAPED_SLASHES + JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
	} else {
		http_response_code(400);
		echo json_encode("Oops, looks like this category doesn't exist.", JSON_UNESCAPED_SLASHES + JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
	}
} else {
	$imagearr = scandir("../img");
	// Avoid . and ..
	unset($imagearr[0]);
	unset($imagearr[1]);

	shuffle($imagearr);
	shuffle($imagearr);
	// YEAH ENTROPY

	$json["imglink"] = "https://rcgp.nsa.ovh/img/".$imagearr[0];
	$json["imgname"] = $imagearr[0];

	echo json_encode($json, JSON_UNESCAPED_SLASHES + JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
}
