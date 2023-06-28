#!/usr/local/bin/php
<?php

/*** init ***/
require_once('./aion_common.php');
require_once('./aion_common_simple_html_dom.php');
AION_ECHO("START " . basename(__FILE__, '.php'));

/*** setup ***/
$keepers = array(
'bdv',
'bhd',
'dso',
'kxv',
'lbm',
'ahr',
'aka',
'benobcv',
'bfz',
'bgc',
'bodn',
'ces1613',
'ceslb',
'ckb',
'cmnfeb',
'deu1951',
'ekkpkp',
'engbsb',
'englee',
'englsv',
'englxxup',
'engnoy',
'engoke',
'engtcent',
'engtnt',
'engWycliffe',
'ewe',
'francl',
'frasbl',
'gaz',
'gmvggm',
'gofwftw',
'grcbrent',
'grcbyz',
'grcsbl',
'grctcgnt',
'hatbsa',
'hausa',
'hauulb',
'heblb',
'hincv',
'hun',
'ibo',
'indags',
'isl',
'kanokcv',
'kik',
'lin',
'lit',
'lug',
'luo',
'malc',
'mni',
'myajvb',
'nde',
'nld',
'nld1939',
'noblb',
'nya',
'pesopcb',
'polsz',
'porblt',
'porbr2018',
'porbrbsl',
'quctt',
'rmylovari',
'rmyservi',
'rmyvlakh',
'ron1924',
'ronlsb',
'sanasm',
'sanben',
'sanbur',
'sancol',
'sandev',
'sanguj',
'sanhk',
'sanias',
'saniso',
'sanitr',
'sankan',
'sankhm',
'sanmal',
'sanori',
'sanpun',
'sansin',
'santam',
'santel',
'santha',
'santib',
'sanurd',
'sanvel',
'sna',
'spablm',
'spapddpt',
'swhonen',
'tamtcv',
'tdx',
'tsn',
'twi',
'twiasante',
'ukr1871',
'ukronpu',
'unx',
'vieovcb',
'xnj',
'yao',
'yom',
'yor',
);

$database = array();
AION_FILE_DATA_GET( './aion_database/VERSIONS.txt',	'T_VERSIONS', $database, 'BIBLE', FALSE );
if (400 <= ($ecode=aion_curl( 'https://ebible.org/Scriptures/copyright.php', $html)) || empty($html)) { AION_ECHO("ERROR! curl() ebible failed  ecode=$ecode"); }
if (!preg_match_all(
	"#<tr><td><a href='http:\/\/www.ethnologue.com\/language\/([[:alnum:]]+)' target='_blank'>([^<]+)<\/a><\/td><td><a href='https:\/\/eBible.org\/details.php\?id=([[:alnum:]]+)' target='_blank'>([^<]+)<\/a><\/td><td>([^<]+)<\/td><\/tr>#ui",
	$html,
    $matches,
    PREG_SET_ORDER)) { AION_ECHO("ERROR! preg_match_all() failed"); }

/*** loop ***/
$output = <<<EOF
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width" />
<title>Bible copyright information</title>
</head>
<body>
<h1>eBible Parsed from <a href='https://ebible.org/Scriptures/copyright.php' target='_blank'>https://ebible.org/Scriptures/copyright.php</a></h1>
<table>
<tr><td>#</td><td>Priority</td><td>License</td><td>Code</td><td>Population</td><td>Language</td><td>Title</td><td>eBible</td><td>Year</td><td>Note</td></tr>

EOF;
$group = 'PD';
$rows = array();
foreach( $matches as $ebible ) {
	// last bible
	if ('aca' == $ebible[3]) { break; }
	// initial
	$priority = (in_array($ebible[3],$keepers) ? 0 : 1);
	$pop = '';
	$note = '';

	// Population
	// https://en.wikipedia.org/wiki/ISO_639:als
	if (400 <= ($ecode=aion_curl( 'https://en.wikipedia.org/wiki/ISO_639:'.$ebible[1], $html)) || empty($html)) { AION_ECHO("ERROR! aion_curl(lang) = {$ecode}, {$ebible[1]}"); }
	else if (preg_match("#\.1em 0;\">Native speakers</div></th><td class=\"infobox-data\" style=\"line-height:1\.3em;\">([\d.]+[^&]+)&\#160;#us",$html,$match)) {	$pop = $match[1]; }
	else if (!preg_match("#<table class=\"infobox vevent\">.+?</table>#us",$html,$match)) {	$pop = 'fail-parse1'; }
	else if (preg_match_all("#[0-9]{1}[0-9.,]+[ ]+[a-z]+#us",$match[0],$pops)) { $pop = implode(", ", array_slice($pops[0],0,3)); }
	else { $pop = 'fail-parse2'; }

	// license?
	// https://ebible.org/details.php?id=benirv
	if (400 <= ($ecode=aion_curl("https://ebible.org/details.php?id=".$ebible[3], $html)) || empty($html)) { AION_ECHO("ERROR! aion_curl(ebible) = {$ecode}, {$ebible[3]}"); }
	else if (preg_match("#public[\s]*domain#uis",$html)) { ; }
	else if (preg_match("#no[\s]*derivative#uis",$html)) {									$priority = 4; $note = "+NoDeriv"; }
	else if (preg_match("#no[\s]*commercial#uis",$html)) {									$priority = 3; $note = "+NoCom"; }
	else if (!preg_match("#creative[\s]*common#uis",$html)) {								$priority = 2; $note = "+NoCC"; }
	if (preg_match("#India#us",$html)) {													$note = "+India"; }

	// already?
	foreach( $database[T_VERSIONS] as $bible => $version ) {
		if ("https://ebible.org/details.php?id=".$ebible[3] == $version['SOURCELINK']) {	$priority = 5; $note = "+".$bible; break; }
	}

	// result
	$rows[$priority.$ebible[2].$ebible[4]] = "<td>{$priority}</td><td>{$group}</td><td><a href='https://en.wikipedia.org/wiki/ISO_639:{$ebible[1]}' target='_blank'>{$ebible[1]}</a></td><td>{$ebible[2]}</td><td>{$pop}</td><td>{$ebible[4]}</td><td><a href='https://ebible.org/details.php?id={$ebible[3]}' target='_blank'>{$ebible[3]}</a></td><td>{$ebible[5]}</td><td>{$note}</td>";
	echo "{$priority}\t{$group}\t{$ebible[1]}\t{$ebible[2]}\t{$pop}\t{$ebible[4]}\t{$ebible[3]}\t{$ebible[5]}\t{$note}\n";
	if ('wro' == $ebible[3]) { $group = 'CC'; }
}

/*** write output ***/
ksort($rows);
$number = 1;
foreach( $rows as $row ) { $output .= "<tr><td>{$number}</td>{$row}</tr>"; ++$number; }
$output .= "</table></body></html>";
$file = "../www-stage/library/Holy-Bible---AAA---Versions---eBible.htm";
if (!($bytes=file_put_contents($file, $output))) { AION_ECHO("ERROR! file_put_contents() failed: $file"); }
AION_ECHO("DONE $file: bytes = $bytes");
/*** bye ***/
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