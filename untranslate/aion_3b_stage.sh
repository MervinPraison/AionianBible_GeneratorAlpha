#!/usr/local/bin/php
<?php

/*** init ***/
require_once('./aion_common.php');
require_once('./aion_common_simple_html_dom.php');
AION_ECHO("START " . basename(__FILE__, '.php'));

/*** setup ***/
$keepers = array();

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
<tr><td>#</td><td>Priority</td><td>License</td><td>Code</td><td>Language</td><td>Population</td><td>Title</td><td>eBible</td><td>Year</td><td>Note</td><td>Extra</td><td>Link-Page</td><td>Link-VPL</td><td>Link-SWORD</td><td>Link-PDF</td><td>Link-EPUB</td></tr>

EOF;
$output2 = "FILE	FLAG	POST	VALUE	SOURCE	DESTINATION\n";


$group = 'PD';
$rows = array();
$tally = 0;
foreach( $matches as $ebible ) {
	// first bible AFTER public domain and CC section, so quit
	if ('aca' == $ebible[3]) { break; }
	//if (++$tally > 10) { break; }

	// initial
	$priority = (in_array($ebible[3],$keepers) ? 0 : 1);
	$pop = '';
	$note = '';
	$extra = '';
	
	// Population
	// https://en.wikipedia.org/wiki/ISO_639:als
	if (400 <= ($ecode=aion_curl( 'https://en.wikipedia.org/wiki/ISO_639:'.$ebible[1], $html)) || empty($html)) { AION_ECHO("ERROR! aion_curl(lang) = {$ecode}, {$ebible[1]}"); }
	else if (!preg_match("#<table class=\"infobox vevent.+?</table>#us",$html,$match)) {	$pop = 'fail-parse1'; }
	else if (preg_match_all("#[0-9]{1}[0-9.,]+(\&nbsp\;|[ ]+)[a-z]*#us",$match[0],$pops)) { $pop = implode(", ", array_slice($pops[0],0,3)); }
	else { $pop = 'fail-parse2'; }

	// license?
	// https://ebible.org/details.php?id=benirv
	if (400 <= ($ecode=aion_curl("https://ebible.org/details.php?id=".$ebible[3], $html)) || empty($html)) {
		AION_ECHO("WARN! aion_curl(ebible) = {$ecode}, {$ebible[3]}"); 						$priority = 1; $note = "ERR={$ecode}"; }
	else if (preg_match("#public[\s]*domain#uis",$html)) { ; }
	else if (preg_match("#no[\s]*derivative#uis",$html)) {									$priority = 4; $note = "NoDe"; }
	else if (preg_match("#no[\s]*commercial#uis",$html)) {									$priority = 3; $note = "NoCo"; }
	else if (!preg_match("#creative[\s]*common#uis",$html)) {								$priority = 2; $note = "NoCC"; }
	foreach( $database[T_VERSIONS] as $bible => $version ) {
		if ("https://ebible.org/details.php?id=".$ebible[3] == $version['SOURCELINK']) {	$priority = 5; $note = "".$bible; break; }
	}

	// Extra
	if (preg_match("#India#usi",$html)) { $extra .= "+India"; }
	if (preg_match("#(does not|extend|outside)#usi",$html)) { $extra .= "+Except"; }

	// links
	// https://ebible.org/sword/zip/engourb2016eb.zip
	// https://ebible.org/epub/engourb.epub
	// https://ebible.org/pdf/engourb/engourb_prt.pdf
	// https://ebible.org/Scriptures/engourb_vpl.zip
	// Link-Page / Link-VPL / Link-SWORD / Link-PDF / Link-EPUB
	$link_page = "https://ebible.org/details.php?id={$ebible[3]}";
	$link_vpls = "https://ebible.org/Scriptures/{$ebible[3]}_vpl.zip";
	$link_swrd = "https://ebible.org/sword/zip/{$ebible[3]}eb.zip";
	$link_swd2 = "https://ebible.org/sword/zip/{$ebible[3]}{$ebible[5]}eb.zip";
	$link_pdfs = "https://ebible.org/pdf/{$ebible[3]}/{$ebible[3]}_prt.pdf";
	$link_epub = "https://ebible.org/epub/{$ebible[3]}.epub";
	$font_page = ((($headers = get_headers($link_page)) && !empty($headers[0]) && strpos($headers[0],"200")) ? "" : " style='color: red;' ");
	$font_vpls = ((($headers = get_headers($link_vpls)) && !empty($headers[0]) && strpos($headers[0],"200")) ? "" : " style='color: red;' ");
	$font_swrd = ((($headers = get_headers($link_swrd)) && !empty($headers[0]) && strpos($headers[0],"200")) ? "" : " style='color: red;' ");
	if (!empty($font_swrd) && preg_match("#^\d+$#",$ebible[5])) {
	$link_swrd = $link_swd2;
	$font_swrd = ((($headers = get_headers($link_swrd)) && !empty($headers[0]) && strpos($headers[0],"200")) ? "" : " style='color: red;' ");
	}
	$font_pdfs = ((($headers = get_headers($link_pdfs)) && !empty($headers[0]) && strpos($headers[0],"200")) ? "" : " style='color: red;' ");
	$font_epub = ((($headers = get_headers($link_epub)) && !empty($headers[0]) && strpos($headers[0],"200")) ? "" : " style='color: red;' ");
	$mark_page = (empty($font_page) ? "" : "*BAD* " );
	$mark_vpls = (empty($font_vpls) ? "" : "*BAD* " );
	$mark_swrd = (empty($font_swrd) ? "" : "*BAD* " );
	$mark_pdfs = (empty($font_pdfs) ? "" : "*BAD* " );
	$mark_epub = (empty($font_epub) ? "" : "*BAD* " );

	// result
	$rows[$priority.$ebible[2].$ebible[4]] = "
	<td>{$priority}</td>
	<td>{$group}</td>
	<td><a href='https://en.wikipedia.org/wiki/ISO_639:{$ebible[1]}' target='_blank'>{$ebible[1]}</a></td>
	<td>{$ebible[2]}</td>
	<td>{$pop}</td>
	<td>{$ebible[4]}</td>
	<td><a href='{$link_page}' target='_blank'>{$ebible[3]}</a></td>
	<td>{$ebible[5]}</td>
	<td>{$note}</td>
	<td>{$extra}</td>
	<td><a href='{$link_page}' target='_blank' {$font_page}>{$mark_page} {$link_page}</a></td>
	<td><a href='{$link_vpls}' target='_blank' {$font_vpls}>{$mark_vpls} {$link_vpls}</a></td>
	<td><a href='{$link_swrd}' target='_blank' {$font_swrd}>{$mark_swrd} {$link_swrd}</a></td>
	<td><a href='{$link_pdfs}' target='_blank' {$font_pdfs}>{$mark_pdfs} {$link_pdfs}</a></td>
	<td><a href='{$link_epub}' target='_blank' {$font_epub}>{$mark_epub} {$link_epub}</a></td>
	";

	// source format file 
	if ($priority ==0) {
		$biblekey = preg_replace("#[\s[:punct:]]+#", "-", $ebible[4]);
		$biblelan = preg_replace("#[\s[:punct:]]+#", "-", $ebible[2]);
		$output2 .= "Holy-Bible---{$biblelan}---{$biblekey}				{$link_vpls}	Holy-Bible---{$biblelan}---{$biblekey}---Source-Edition.VPL.zip\n";
		$output2 .= "Holy-Bible---{$biblelan}---{$biblekey}				{$link_swrd}	Holy-Bible---{$biblelan}---{$biblekey}---Source-Edition.SWORD.zip\n";
		$output2 .= "Holy-Bible---{$biblelan}---{$biblekey}				{$link_pdfs}	Holy-Bible---{$biblelan}---{$biblekey}---Source-Edition.pdf\n";
		$output2 .= "Holy-Bible---{$biblelan}---{$biblekey}				{$link_epub}	Holy-Bible---{$biblelan}---{$biblekey}---Source-Edition.epub\n";
	}

	// echo progress
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
$file = "../www-stage/library/Holy-Bible---AAA---Versions---eBible-source.txt";
if (!($bytes=file_put_contents($file, $output2))) { AION_ECHO("ERROR! file_put_contents() failed: $file"); }
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