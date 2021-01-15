#!/usr/local/bin/php
<?php
require_once('./aion_common.php');
AION_ECHO("HTML VALIDATION: BEGIN");

// Essential URLs
w3validator("stage.aionianbible.org");
w3validator("stage.aionianbible.org/Preface");
w3validator("stage.aionianbible.org/History");
w3validator("stage.aionianbible.org/Readers-Guide");
w3validator("stage.aionianbible.org/Aionios-and-Aidios");
w3validator("stage.aionianbible.org/Maps");
w3validator("stage.aionianbible.org/Glossary");
w3validator("stage.aionianbible.org/Strongs");
w3validator("stage.aionianbible.org/Publisher");
w3validator("stage.aionianbible.org/Third-Party-Publisher-Resources");
w3validator("stage.aionianbible.org/Read");
w3validator("stage.aionianbible.org/Read/parallel-English---Aionian-Bible/strongs-g166");
w3validator("stage.aionianbible.org/Buy");
w3validator("stage.aionianbible.org/Parallel/English---Aionian-Bible");
w3validator("stage.aionianbible.org/Parallel/English---Aionian-Bible/John/3/strongs-g166");
w3validator("stage.aionianbible.org/Parallel/English---Aionian-Bible/John/3/16/strongs-g166");
w3validator("stage.aionianbible.org/Verse/All/John/3/16");
w3validator("stage.aionianbible.org/Verse/All/John/3/16/parallel-English---Aionian-Bible/strongs-g166");
w3validator("stage.aionianbible.org/Verse/Questioned");


// Bible URLs
$database = array();
AION_FILE_DATA_GET('./aion_database/BOOKS.txt','T_BOOKS',$database,'BIBLE',FALSE);
foreach($database['T_BOOKS'] as $bible => $value) {
	if (!preg_match("/Holy-Bible---/u",$bible)) { continue; }
	// CUSTOM CHECK
	//if (!preg_match("/Western/u",$bible)) { continue; }
	
	if (!($bibleurl=preg_replace("/Holy-Bible---/u","",$bible))) { AION_ECHO("ERROR! preg_replace($bible)"); }
	AION_FILE_DATA_GET("../www-stageresources/$bible---Aionian-Edition.noia",'T_BIBLE',$database,array('BOOK','CHAPTER','VERSE'),FALSE);
	w3validator("stage.aionianbible.org/Bibles/$bibleurl");
	w3validator("stage.aionianbible.org/Bibles/$bibleurl/Noted");
	w3validator("stage.aionianbible.org/Bibles/$bibleurl/parallel-English---Aionian-Bible/strongs-g166");
	w3validator("stage.aionianbible.org/Bibles/$bibleurl/Noted/parallel-English---Aionian-Bible/strongs-g166");
	$ot = $nt = FALSE;
	$count = 0;
	foreach($database['T_BOOKS']['CODE'] as $code) {
		++$count;
		if (empty($database['T_BIBLE']["$code-001-001"])) { continue; }
		if (NULL===($bookurl=array_search($code,$database['T_BOOKS']['CODE']))) { AION_ECHO("ERROR! Bible book code not found! ($bible/$code)"); }
		if ($count<40) { $ot = TRUE; }
		else { $nt = TRUE; }
		w3validator("stage.aionianbible.org/Bibles/$bibleurl/$bookurl/1");
		w3validator("stage.aionianbible.org/Bibles/$bibleurl/$bookurl/1/1");
		w3validator("stage.aionianbible.org/Bibles/$bibleurl/$bookurl/1/parallel-English---Aionian-Bible/strongs-g166");
		w3validator("stage.aionianbible.org/Bibles/$bibleurl/$bookurl/1/1/parallel-English---Aionian-Bible/strongs-g166");
	}
	if ($ot) {
		w3validator("stage.aionianbible.org/Bibles/$bibleurl/Old");
		w3validator("stage.aionianbible.org/Bibles/$bibleurl/Old/parallel-English---Aionian-Bible/strongs-g166");
	}
	if ($nt) {
		w3validator("stage.aionianbible.org/Bibles/$bibleurl/New");
		w3validator("stage.aionianbible.org/Bibles/$bibleurl/New/parallel-English---Aionian-Bible/strongs-g166");
	}
	AION_UNSET($database['T_BIBLE']);
	unset($database['T_BIBLE']);
	// early exit
	break;
}


// Done
AION_ECHO("HTML VALIDATION: END");
exit;


// Build automatic post to call https://validator.w3.org/
// define function to request validation
// here is how https://dev.w3.org/validator/htdocs/docs/users.html
function w3validator( $url ) {
	$agent = array();
	$agent[] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0';
	$agent[] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36 Edge/17.17134';
	$agent[] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36';
	$ch = curl_init();
	//$url = urlencode("$url");
	curl_setopt($ch, CURLOPT_URL, "https://validator.w3.org/check?uri=http://$url"); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_FAILONERROR, TRUE); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_USERAGENT,$agent[2]);
	$result = curl_exec($ch);
	curl_close($ch);
	if (empty($result)) {																			AION_ECHO("EMPTY: $url"); }
	else if (preg_match("/Illegal character in query/u",$result)) {									AION_ECHO("QUERY: $url");}
	else if (preg_match("/The document validates according to the specified schema/u",$result)) {	AION_ECHO("SUCCESS: $url"); }
	else {																							AION_ECHO("ERROR: $url"); }
	return;
}