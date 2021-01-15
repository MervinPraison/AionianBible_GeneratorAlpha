#!/usr/local/bin/php
<?php

/*** init ***/
require_once('./aion_common.php');
require_once('./aion_common_simple_html_dom.php');
AION_ECHO("START " . basename(__FILE__, '.php'));

/*** test and optimism ***/
aion_review("TEST","","https://www.cnn.com");
//aion_review("TEST","","http://www.dgjc.org");
//aion_review("TEST","","https://www.amazon.com/dp/1581345038");
exit;
aion_review("OPTIMISM","","https://www.amazon.com/dp/151523990X");

/*** loop versions ***/
$database = array();
AION_FILE_DATA_GET( './aion_database/VERSIONS.txt',	'T_VERSIONS',	$database, 'BIBLE', TRUE );
$counter = 2;
foreach( $database[T_VERSIONS] as $key => $version ) {
	if ($version['AMAZON']!='NULL') {	aion_review($key,"",$version['AMAZON']); }
	if ($version['AMAZONNT']!='NULL') {	aion_review($key,"NT",$version['AMAZONNT']); }
	//if (--$counter<=0) { break; }
}
AION_ECHO("DONE!");
exit;

/*** read reviews ****/
function aion_review($key,$flag,$url) {
	if (400 <= ($ecode=aion_curl( $url, $html)) || empty($html)) { AION_ECHO("ERROR! cURL GET Failed error=$ecode, bible=$key, url=$url"); }
	echo $html;
	if (!($dom = str_get_html($html))) { AION_ECHO("ERROR! simplehtmldom failed  bible=$key, url=$url"); }
	$rtitle = aion_clean($dom->find('title',0)->plaintext);
	$Rtitle = (!empty($rtitle) ? $rtitle : aion_clean($html));
	$redate = date('Y-m-d');
	echo "$key\t$url\t$redate\tHTML\tTITLE\t$Rtitle\n";
	if (empty($rtitle)) { AION_ECHO("ERROR! NO PAGE TITLE!  bible=$key, url=$url"); }
	foreach($dom->find('div.review') as $review) {
		$rtitle = aion_clean($review->find('a.review-title'  ,0)->plaintext);
		if (empty($rtitle)) { AION_ECHO("ERROR! NO REVIEW TITLE!  bible=$key, url=$url"); }
		$rating = aion_clean($review->find('i.review-rating' ,0)->plaintext);
		$redate = aion_clean($review->find('span.review-date',0)->plaintext);
		$redate = date('Y-m-d',strtotime($redate));
		$retext = aion_clean($review->find('span.review-text',0)->plaintext);
		if (empty($retext)) { continue; }
		echo "$key\t$flag\t$url\t$redate\t$rating\t$rtitle\t$retext\n";
	}
	sleep(rand(120,300));
}

/*** cURL ***/
function aion_curl( $url, &$html ) {
	$agent = array();
	$agent[] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0';
	$agent[] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36 Edge/17.17134';
	$agent[] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36';
	$html = NULL;
	$resURL = curl_init(); 
	curl_setopt($resURL, CURLOPT_URL, $url);
	curl_setopt($resURL, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($resURL, CURLOPT_HEADER, FALSE);
	curl_setopt($resURL, CURLOPT_FAILONERROR, TRUE); 
	curl_setopt($resURL, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($resURL, CURLOPT_CONNECTTIMEOUT, 3); 
	curl_setopt($resURL, CURLOPT_TIMEOUT, 7);
	curl_setopt($resURL, CURLOPT_USERAGENT,$agent[2]);
	$html = curl_exec ($resURL);
	$intReturnCode = curl_getinfo($resURL, CURLINFO_HTTP_CODE); 
	$redirected = curl_getinfo($resURL, CURLINFO_EFFECTIVE_URL);
	curl_close ($resURL); 
	return $intReturnCode;
}

/*** clean result ***/
function aion_clean( $string ) {
	return str_replace(array("\t","\n","\r")," ",str_replace('"',"'",html_entity_decode(trim(strip_tags(str_replace('<', ' <',(empty($string) ? '' : iconv('UTF-8', 'ASCII//TRANSLIT', $string))))))));
}