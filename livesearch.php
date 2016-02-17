<?php
$xmlDoc=new DOMDocument();
$xmlDoc->load("All Stocks.xml");

$x=$xmlDoc->getElementsByTagName('link');

//get the q parameter from URL
$q=$_GET["q"];

$hint="";

//lookup all links from the xml file if length of q>0
if (strlen($q)>2) {
	$hint="";
	for($i=0; $i<($x->length); $i++) {
	$y=$x->item($i)->getElementsByTagName('title');
	if ($y->item(0)->nodeType==1) {
		//find a link matching the search text
		if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q)) {
		if ($hint=="") {
			$hint=$y->item(0)->childNodes->item(0)->nodeValue;
		} else {
			$hint=$hint . "<br />".$y->item(0)->childNodes->item(0)->nodeValue;
		}
		}
	}
	}
}

// Set output to "Not valid stock symbol" if no hint was found
// or to the correct values
if ($hint=="" and strlen($q) > 2) {
	$response="Not valid stock symbol";
} else {
	$response=$hint;
}

//output the response
echo $response;
?>