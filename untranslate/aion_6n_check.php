<?php

/*** init ***/
use \ForceUTF8\Encoding;
AION_LOOP_ANALYSIS(	'/home/inmoti55/public_html/domain.aionianbible.org/www-stageresources',
					'/home/inmoti55/public_html/domain.aionianbible.org/www-stageresources'
				);
AION_ECHO("DONE!");
return;

/*** aion rtfs make loop ***/
function AION_LOOP_ANALYSIS($source, $destiny) {
	$database = array();
	AION_FILE_DATA_GET( './aion_database/BOOKS.txt', 'T_BOOKS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/NUMBERS.txt', 'T_NUMBERS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/VERSIONS.txt', 'T_VERSIONS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/FORPRINT.txt', 'T_FORPRINT', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATE.txt', 'T_UNTRANSLATE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKSSTANDARD.noia', 'T_BOOKSSTANDARD', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( './aion_database/UNICODE_PLANES.txt', 'T_UNICODE_PLANES', $database, FALSE, FALSE );
	AION_LOOP( array(
		'function'		=> 'AION_LOOP_ANALYSIS_DOIT',
		'source'		=> $source,
		'include'		=> "/---Source-Edition\.[^.]+\.txt$/",
		//'include'		=> "/---A.+---Source-Edition\.[^.]+\.txt$/",
		//'include'		=> "/---American-Standard.+---Source-Edition\.[^.]+\.txt$/",
		//'include'		=> "/Holy-Bible---English---Webster-Bible-Revised---Source-Edition\.[^.]+\.txt$/",		
		//'include'		=> "/Holy-Bible---.+Amalgamant---Source-Edition\.[^.]+\.txt$/",
		'database'		=> $database,
		'destiny'		=> $destiny,
		) );
	AION_unset($database); unset($database);
	AION_ECHO("DONE DID IT!");
}
function AION_LOOP_ANALYSIS_DOIT($args) {

	// BIBLE?
	if (!preg_match("/^Holy-Bible---(.*)---Source-Edition\.[^.]+\.txt$/us", $args['filename'], $matches)) {	AION_ECHO("ERROR! Analysis INIT Failed to preg_match(Holy-Bible): ".$args['filepath']); }
	$bible = "Holy-Bible---$matches[1]";
	$short = "$matches[1]";

	// SUPPORT?
	if (empty($args['database'][T_BOOKS][$bible])) {														AION_ECHO("ERROR! Analysis INIT Failed to find BOOK[bible] = $bible"); }
	if (($x=count($args['database'][T_BOOKS][$bible]))!=67) {												AION_ECHO("ERROR! Analysis INIT Count(args[T_BOOKS][BIBLE])!=67: $x"); }
	if (empty($args['database'][T_NUMBERS][$bible])) {														AION_ECHO("ERROR! Analysis INIT Failed to find NUMBERS[bible] = $bible"); }
	if (empty($args['database'][T_VERSIONS][$bible])) {														AION_ECHO("ERROR! Analysis INIT Failed to find VERSIONS[bible] = $bible"); }
	if (empty($args['database'][T_FORPRINT][$bible])) {														AION_ECHO("ERROR! Analysis INIT Failed to find FORPRINT[bible] = $bible"); }

	// INIT
	if (!($sourcedomain=preg_replace("#http[s]{0,1}://#us", "", $args['database'][T_VERSIONS][$bible]['SOURCEDOMAIN']))) {	AION_ECHO("ERROR! Analysis INIT Failed to fix VERSIONS[sourcedomain] = $bible"); }
	if (!($sourcedomain=preg_replace("#\..+$#us", "", $sourcedomain))) {									AION_ECHO("ERROR! Analysis INIT Failed to find VERSIONS[sourcedomain] = $bible"); }
	$file_original = $args['filepath'];
	$file_analysis = $args['destiny']."/$bible---Analysis.$sourcedomain.txt";
	$file_aionian  = $args['destiny']."/$bible---Aionian-Edition.noia";

	// INPUT
	$database = array();
	if (!($data_original=file_get_contents($file_original))) {												AION_ECHO("ERROR! Analysis INIT file_get_contents($file_original)"); }
	if (!($data_aionian =file_get_contents($file_aionian))) {												AION_ECHO("ERROR! Analysis INIT file_get_contents($file_aionian)"); }
	$encode_original = mb_detect_encoding($data_original);
	$encode_aionian = mb_detect_encoding($data_aionian);
	$encode_original = (empty($encode_original) ? "Unknown" : $encode_original);
	$encode_aionian = (empty($encode_aionian) ? "Unknown" : $encode_aionian);
	$data_original = Encoding::toUTF8($data_original);
	$data_aionian = Encoding::toUTF8($data_aionian);
	AION_FILE_DATA_GET( $file_aionian, 'T_BIBLE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );

	// REMOVE COMMENTS AND EMPTY LINES
	$byte_original = strlen($data_original);
	$byte_aionian  = strlen($data_aionian);
	$char_original = mb_strlen($data_original);
	$char_aionian  = mb_strlen($data_aionian);
	if(!($data_original=preg_replace('/^\h*\v+/um', '', $data_original))) {									AION_ECHO("ERROR! Analysis INIT preg_replace(delete blanks) $file_original $byte_original"); }
	if(!($data_aionian=preg_replace('/^\h*\v+/um', '', $data_aionian))) {									AION_ECHO("ERROR! Analysis INIT preg_replace(delete blanks) $file_aionian $byte_aionian"); }
	if(!($data_original=preg_replace('/^#[^\v]*\v+/um', '', $data_original))) {								AION_ECHO("ERROR! Analysis INIT preg_replace(delete comments) $file_original $byte_original"); }	
	if(!($data_aionian=preg_replace('/^(#[^\v]*|INDEX\t[^\v]*)\v+/um', '', $data_aionian))) {				AION_ECHO("ERROR! Analysis INIT preg_replace(delete comments) $file_aionian $byte_aionian"); }
	if(!($data_original=preg_replace("#<[^<>\r\n]+>#us", "", $data_original))) {							AION_ECHO("ERROR! Analysis INIT preg_replace(delete markup) $file_original $byte_original"); }
	//if (!file_put_contents($file_analysis.'.aion', $data_aionian)) {										AION_ECHO("ERROR! Analysis CHEK file_put_contents($file_analysis.aion)"); }
	//if (!file_put_contents($file_analysis.'.orig', $data_original)) {										AION_ECHO("ERROR! Analysis CHEK file_put_contents($file_analysis.orig)"); }

	$byte_original2= strlen($data_original);
	$byte_aionian2 = strlen($data_aionian);
	$char_original2= mb_strlen($data_original);
	$char_aionian2 = mb_strlen($data_aionian);

	// HEADER
	$analysis  =
		"# File Name: Holy-Bible---$bible---Analysis.txt\n" .
		"# File Size: 000000000000\n" .
		"# File Date: ".date('m/d/Y H:i:s')."\n" .
		"# File Purpose: Supporting resource for the Aionian Bible project\n" .
		"# File Location: https://resources.AionianBible.org\n" .
		"# File Copyright: Creative Commons Attribution No Derivative Works 4.0, 2018-".date('Y')."\n" .
		"# File Generator: ABCMS (alpha)\n" .
		"# File Accuracy: Contact publisher with corrections to file format or content\n" .
		"# Publisher Name: Nainoia Inc\n" .
		"# Publisher Contact: https://www.AionianBible.org/Publisher\n" .
		"# Publisher Mission: https://www.AionianBible.org/Preface\n" .
		"# Publisher Website: https://NAINOIA-INC.signedon.net\n" .
		"# Publisher Facebook: https://www.Facebook.com/AionianBible\n" .
		"# Bible Name: ".$args['database'][T_VERSIONS][$bible]['NAME']."\n" .
		"# Bible Name English: ".$args['database'][T_VERSIONS][$bible]['NAMEENGLISH']."\n" .
		"# Bible Language: ".$args['database'][T_VERSIONS][$bible]['LANGUAGE']."\n" .
		"# Bible Language English: ".$args['database'][T_VERSIONS][$bible]['LANGUAGEENGLISH']."\n" .
		"# Bible Copyright Format: ".$args['database'][T_VERSIONS][$bible]['ABCOPYRIGHT']."\n" .
		"# Bible Copyright Text: ".$args['database'][T_VERSIONS][$bible]['COPYRIGHT']."\n" .
		"# Bible Source: ".$args['database'][T_VERSIONS][$bible]['SOURCE']."\n" .
		(filemtime($file_original)===FALSE ? '' : ("# Bible Source Version: ".date("n/j/Y", filemtime($file_original))."\n")) .
		"# Bible Source Link: ".$args['database'][T_VERSIONS][$bible]['SOURCELINK']."\n" .
		"# Bible Source Year: ".$args['database'][T_VERSIONS][$bible]['YEAR']."\n" .
		(empty($args['database'][T_VERSIONS][$bible]['DESCRIPTION']) ? "" : ("# Bible Description: ".$args['database'][T_VERSIONS][$bible]['DESCRIPTION']."\n")) .
		"#\n" .
		"# Following are analyses of the source Bible text and the resulting Aionian Edition text.\n" .
		"# Problems are noted and comparing past and updated analyses shows regressions and improvements.\n" .
		"# Some analyses are relevant only to the Aionian Bible project and others are relevant to everyone.\n" .
		"# Also note the Aionian Bible project reversifies to the KJV standard and reports variances.\n" .
		"# Search for these words below: NOTICE, WARNING, and ERROR\n" .
		"#\n" .
		"\n" .
		"BIBLE	ANALYSIS	CATEGORY	INPUT	RESULT	STATUS\n";

	// ENCODING
	$analysis .= "\n# ENCODING\n";
	$input = $args['filename'];
	$status = 	($encode_original=="UTF-8" ? "NOTICE" : ($encode_original=="Unknown" ? "ERROR" : "WARNING"));
	$analysis .= "$short	ENCODING	Source	$input	$encode_original	$status\n";
	$input = "$bible---Aionian-Edition.noia";
	$status = 	($encode_aionian=="UTF-8" ? "NOTICE" : ($encode_aionian=="Unknown" ? "ERROR" : "WARNING"));
	$analysis .= "$short	ENCODING	Aionian	$input	$encode_aionian	$status\n";

	// BYTES
	$analysis .= "\n# FILE BYTES\n";
	$result = "$byte_original / $char_original " . ($byte_original==$char_original ? "(single-byte)" : "(multi-byte)");
	$analysis .= "$short	BYTES	Source	bytes / chars	$result	NOTICE\n";
	$result = "$byte_aionian / $char_aionian " . ($byte_aionian==$char_aionian ? "(single-byte)" : "(multi-byte)");
	$analysis .= "$short	BYTES	Aionian	bytes / chars	$result	NOTICE\n";

	$result = "$byte_original2 / $char_original2 " . ($byte_original2==$char_original2 ? "(single-byte)" : "(multi-byte)");
	$analysis .= "$short	BYTES	SourceClean	bytes / chars	$result	NOTICE\n";
	$result = "$byte_aionian2 / $char_aionian2 " . ($byte_aionian2==$char_aionian2 ? "(single-byte)" : "(multi-byte)");
	$analysis .= "$short	BYTES	AionianClean	bytes / chars	$result	NOTICE\n";
	
	// AIONIAN
	$analysis .= "\n# AIONIAN VERSE COUNTS - LOOKING FOR 264\n";
	$missingbook1 = $missingbook2 = $butbookfound = $missingchapter = $missingverse = $gotverse = 0;
	foreach($args['database']['T_UNTRANSLATE'] as $key => $untranslate) {
		$key0 = preg_replace('/-\d\d\d-\d\d\d$/us','',$key);
		if ($args['database']['T_BOOKS'][$bible][array_search($untranslate['BOOK'],$args['database']['T_BOOKS']['CODE'])]=='NULL') {
			if (!empty($database['T_BIBLE'][$key0.'-001-001']) || !empty($database['T_BIBLE'][$key0.'-001-002'])) {
				++$butbookfound;
				$analysis .= "$short	AIONIAN	Aionian	book-exist-not-defined	$key0	ERROR\n";
			}
			++$missingbook1;
			continue;
		}
		if (!empty($database['T_BIBLE'][$key])) {
			++$gotverse;
			continue;
		}
		if (empty($database['T_BIBLE'][$key0.'-001-001']) && empty($database['T_BIBLE'][$key0.'-001-002'])) {
			++$missingbook2;
			continue;
		}
		$key1 = preg_replace('/-\d\d\d$/us','-001',$key);
		if (empty($database['T_BIBLE'][$key1])) {
			$analysis .= "$short	AIONIAN	Aionian	missing-chapter	$key1	ERROR\n";
			++$missingchapter;
			$status = 'chapter missing';
		}
		else {
			$analysis .= "$short	AIONIAN	Aionian	missing-verse	$key	NOTICE\n";
			++$missingverse;
			$status = 'verse missing';
		}
	}
	$total = $missingbook1 + $missingbook2 + $missingchapter + $missingverse + $gotverse;
	$analysis .= "$short	AIONIAN	Aionian	book-not-exist	$missingbook1	NOTICE\n";
	$analysis .= "$short	AIONIAN	Aionian	book-exist-not-defined	$butbookfound	".	($butbookfound ? "ERROR" : "NOTICE" ).	"\n";
	$analysis .= "$short	AIONIAN	Aionian	book-defined-not-exist	$missingbook2	NOTICE\n";
	$analysis .= "$short	AIONIAN	Aionian	missing-chapter	$missingchapter	".			($missingchapter ? "ERROR" : "NOTICE" )."\n";
	$analysis .= "$short	AIONIAN	Aionian	missing-verse	$missingverse	NOTICE\n";
	$analysis .= "$short	AIONIAN	Aionian	aionian-verses	$gotverse	NOTICE\n";
	$analysis .= "$short	AIONIAN	Aionian	tested-verses	$total	".					($total==264 ? "NOTICE" : "ERROR" ).	"\n";

	// UNPRINTABLES
	$analysis .= "\n# UNPRINTABLE\n";
	$count = 0; $line=FALSE; while(($line===FALSE && ($line=strtok($data_original, "\n"))!==FALSE) || ($line=strtok("\n")) !== FALSE) {
		if (preg_match("#[^[:print:]\t\r\n]+#us", $line, $match)) {
			if (!($line=preg_replace("#\s+#us", " ", $line))) {												AION_ECHO("ERROR! Analysis UNPRINTABLES preg_replace() $file_original $byte_original "); }
			$analysis .= "$short	UNPRINTABLE	Source	$line	($match[0])	WARN\n";
			++$count;
		}
	}
	$analysis .= "$short	UNPRINTABLE	Source	count	$count	".($count ? "WARN" : "NOTICE" )."\n";
	$count = 0; $line=FALSE; while(($line===FALSE && ($line=strtok($data_aionian, "\n"))!==FALSE) || ($line=strtok("\n")) !== FALSE) {
		if (preg_match("#[^[:print:]\t\r\n]+#us", $line, $match)) {
			if (!($line=preg_replace("#\s+#us", " ", $line))) {												AION_ECHO("ERROR! Analysis UNPRINTABLES preg_replace() $file_aionian $byte_aionian "); }
			$analysis .= "$short	UNPRINTABLE	Aionian	$line	($match[0])	WARN\n";
			++$count;
		}
	}
	$analysis .= "$short	UNPRINTABLE	Aionian	count	$count	".($count ? "WARN" : "NOTICE" )."\n";

	// UNICODE
	$analysis .= "\n# UNICODE\n";	
	$pointer = 0;
	$bible_stats = array();
	while(($uchar = aion_utf8_next($data_original, $pointer)) !== false) {
		if (FALSE===($value=aion_utf8_ord($uchar))) {														AION_ECHO("ERROR! Analysis UNICODE aion_utf8_ord($uchar): $file_original $byte_original"); }
		if ($value > 1114111) {																				AION_ECHO("ERROR! Analysis UNICODE ($value) > 1114111: $file_original $byte_original"); }
		$bible_stats[$value]['COUNT'] = (empty($bible_stats[$value]['COUNT']) ? 1 : $bible_stats[$value]['COUNT']+1);
		if (empty($bible_stats[$value]['MAP'])) {
			foreach($args['database']['T_UNICODE_PLANES'] as $plane) {
				if ($value >= (int)$plane['STARTDEC'] && $value <= (int)$plane['ENDDEC']) {
					$bible_stats[$value]['CHAR'] = ($uchar=="\t" ? '\t' : ($uchar=="\r" ? '\r' : ($uchar=="\n" ? '\n' : $uchar)));
					$bible_stats[$value]['MAP']  = $plane['BLOCK'];
					break;
				}
			}
			if (empty($bible_stats[$value]['MAP'])) {														AION_ECHO("ERROR! Analysis UNICODE plane not found: $file_original $byte_original"); }
		}
	}
	$pointer = 0;
	$bible_stats2 = array();
	while(($uchar = aion_utf8_next($data_aionian, $pointer)) !== false) {
		if (FALSE===($value=aion_utf8_ord($uchar))) {														AION_ECHO("ERROR! Analysis UNICODE aion_utf8_ord($uchar): $file_aionian $byte_aionian"); }
		if ($value > 1114111) {																				AION_ECHO("ERROR! Analysis UNICODE ($value) > 1114111: $file_aionian $byte_aionian"); }
		$bible_stats2[$value]['COUNT'] = (empty($bible_stats2[$value]['COUNT']) ? 1 : $bible_stats2[$value]['COUNT']+1);
		if (empty($bible_stats2[$value]['MAP'])) {
			foreach($args['database']['T_UNICODE_PLANES'] as $plane) {
				if ($value >= (int)$plane['STARTDEC'] && $value <= (int)$plane['ENDDEC']) {
					$bible_stats2[$value]['CHAR'] = ($uchar=="\t" ? '\t' : ($uchar=="\r" ? '\r' : ($uchar=="\n" ? '\n' : $uchar)));
					$bible_stats2[$value]['MAP']  = $plane['BLOCK'];
					break;
				}
			}
			if (empty($bible_stats2[$value]['MAP'])) {														AION_ECHO("ERROR! Analysis UNICODE plane not found: $file_aionian $byte_aionian"); }
		}
	}
	if (!function_exists('array_udiff_analysis')) { function array_udiff_analysis($a, $b) { return (($a['CHAR'] > $b['CHAR'] || ($a['CHAR'] == $b['CHAR'] && $a['COUNT'] > $b['COUNT'])) ? 1 : (($a['CHAR'] < $b['CHAR'] || ($a['CHAR'] == $b['CHAR'] && $a['COUNT'] < $b['COUNT'])) ? -1 : 0)); } }
	$minus_original = array_udiff($bible_stats, $bible_stats2, 'array_udiff_analysis');
	$added_aionian = array_udiff($bible_stats2, $bible_stats, 'array_udiff_analysis');
	$analysis .= "$short	UNICODE	Summary	(-)Orginal	".count($minus_original)."	NOTICE\n";
	$analysis .= "$short	UNICODE	Summary	(+)Aionian	".count($added_aionian)."	NOTICE\n";
	foreach($minus_original as $glyph) {	$analysis .= "$short	UNICODE	Source(-)	".	$glyph['MAP'].": (".$glyph['CHAR'].")	".$glyph['COUNT']."	NOTICE\n"; }
	foreach($added_aionian as $glyph) {		$analysis .= "$short	UNICODE	Aionian(+)	".	$glyph['MAP'].": (".$glyph['CHAR'].")	".$glyph['COUNT']."	NOTICE\n"; }
	foreach($bible_stats as $glyph) {		$analysis .= "$short	UNICODE	Source	".		$glyph['MAP'].": (".$glyph['CHAR'].")	".$glyph['COUNT']."	NOTICE\n"; }
	
	// VERSIFICATION
	$analysis .= "\n# VERSIFICATION\n";
	$missing = $extra = 0;
	foreach($args['database']['T_BOOKSSTANDARD'] as $ref => $line){
		$chap = preg_replace('/-\d\d\d-\d\d\d$/us','',$ref);
		if ((!empty($database['T_BIBLE'][$chap.'-001-001']) || !empty($database['T_BIBLE'][$chap.'-001-002'])) &&
			empty($database['T_BIBLE'][$ref])) {				++$missing;	$analysis .= "$short	VERSIFICATION	Aionian	missing	$ref	WARN\n"; }
	}
	foreach($database['T_BIBLE'] as $ref => $line) {
		if (empty($args['database']['T_BOOKSSTANDARD'][$ref])){	++$extra;	$analysis .= "$short	VERSIFICATION	Aionian	extra	$ref	WARN\n"; }
	}	
	$analysis .= "$short	VERSIFICATION	Summary	missing	$missing	".($missing ? 'WARN' : 'NOTICE')."\n";
	$analysis .= "$short	VERSIFICATION	Summary	extra	$extra	".($extra ? 'WARN' : 'NOTICE')."\n";

	// ENCLOSURES
	$analysis .= "\n# ENCLOSURES\n";	
	if (FALSE===($orig_open_pare=preg_match_all("#\(#us", $data_original)) ||
		FALSE===($orig_clos_pare=preg_match_all("#\)#us", $data_original)) ||
		FALSE===($orig_open_brak=preg_match_all("#\[#us", $data_original)) ||
		FALSE===($orig_clos_brak=preg_match_all("#\]#us", $data_original)) ||
		FALSE===($orig_open_brac=preg_match_all("#\{#us", $data_original)) ||
		FALSE===($orig_clos_brac=preg_match_all("#\}#us", $data_original)) ||
		FALSE===($orig_open_mark=preg_match_all("#\<#us", $data_original)) ||
		FALSE===($orig_clos_mark=preg_match_all("#\>#us", $data_original)) ||
		
		FALSE===($aion_open_pare=preg_match_all("#\(#us", $data_aionian)) ||
		FALSE===($aion_clos_pare=preg_match_all("#\)#us", $data_aionian)) ||
		FALSE===($aion_open_brak=preg_match_all("#\[#us", $data_aionian)) ||
		FALSE===($aion_clos_brak=preg_match_all("#\]#us", $data_aionian)) ||
		FALSE===($aion_open_brac=preg_match_all("#\{#us", $data_aionian)) ||
		FALSE===($aion_clos_brac=preg_match_all("#\}#us", $data_aionian)) ||
		FALSE===($aion_open_mark=preg_match_all("#\<#us", $data_aionian)) ||
		FALSE===($aion_clos_mark=preg_match_all("#\>#us", $data_aionian))) {								AION_ECHO("ERROR! Analysis ENCLOSURES preg_match_all() $file_original $byte_original "); }
	$analysis .= "$short	ENCLOSURES	Source	()	$orig_open_pare / $orig_clos_pare	".(($orig_open_pare - $orig_clos_pare) ? 'WARN' : 'NOTICE')."\n";
	$analysis .= "$short	ENCLOSURES	Source	[]	$orig_open_brak / $orig_clos_brak	".(($orig_open_brak - $orig_clos_brak) ? 'WARN' : 'NOTICE')."\n";
	$analysis .= "$short	ENCLOSURES	Source	{}	$orig_open_brac / $orig_clos_brac	".(($orig_open_brac - $orig_clos_brac) ? 'WARN' : 'NOTICE')."\n";
	$analysis .= "$short	ENCLOSURES	Source	<>	$orig_open_mark / $orig_clos_mark	".(($orig_open_mark - $orig_clos_mark) ? 'WARN' : 'NOTICE')."\n";
	$analysis .= "$short	ENCLOSURES	Aionian	()	$aion_open_pare / $aion_clos_pare	".(($aion_open_pare - $aion_clos_pare) ? 'WARN' : 'NOTICE')."\n";
	$analysis .= "$short	ENCLOSURES	Aionian	[]	$aion_open_brak / $aion_clos_brak	".(($aion_open_brak - $aion_clos_brak) ? 'WARN' : 'NOTICE')."\n";
	$analysis .= "$short	ENCLOSURES	Aionian	\{\}	$aion_open_brac / $aion_clos_brac	".(($aion_open_brac - $aion_clos_brac) ? 'WARN' : 'NOTICE')."\n";
	$analysis .= "$short	ENCLOSURES	Aionian	<>	$aion_open_mark / $aion_clos_mark	".(($aion_open_mark - $aion_clos_mark) ? 'WARN' : 'NOTICE')."\n";

	$original = 0; $line=FALSE; while(($line===FALSE && ($line=strtok($data_original, "\n"))!==FALSE) || ($line=strtok("\n")) !== FALSE) {
		if (FALSE===($orig_open_pare=preg_match_all("#\(#us", $line)) ||
			FALSE===($orig_clos_pare=preg_match_all("#\)#us", $line)) ||
			FALSE===($orig_open_brak=preg_match_all("#\[#us", $line)) ||
			FALSE===($orig_clos_brak=preg_match_all("#\]#us", $line)) ||
			FALSE===($orig_open_brac=preg_match_all("#\{#us", $line)) ||
			FALSE===($orig_clos_brac=preg_match_all("#\}#us", $line)) ||
			FALSE===($orig_open_mark=preg_match_all("#\<#us", $line)) ||
			FALSE===($orig_clos_mark=preg_match_all("#\>#us", $line))) {									AION_ECHO("ERROR! Analysis ENCLOSURES preg_match_all(line) $file_original $byte_original "); }
		if (!($line=preg_replace("#[\s]+#us"," ",$line))) {													AION_ECHO("ERROR! Analysis ENCLOSURES preg_replace() $file_original $byte_original "); }
		if (($orig_open_pare - $orig_clos_pare)) {	$analysis .= "$short	ENCLOSURES	Source	($orig_open_pare/$orig_clos_pare)	$line	WARN\n"; ++$original; }
		if (($orig_open_brak - $orig_clos_brak)) {	$analysis .= "$short	ENCLOSURES	Source	[$orig_open_brak/$orig_clos_brak]	$line	WARN\n"; ++$original; }
		if (($orig_open_brac - $orig_clos_brac)) {	$analysis .= "$short	ENCLOSURES	Source	\{$orig_open_brac/$orig_clos_brac\}	$line	WARN\n"; ++$original; }
		if (($orig_open_mark - $orig_clos_mark)) {	$analysis .= "$short	ENCLOSURES	Source	<$orig_open_mark/$orig_clos_mark>	$line	WARN\n"; ++$original; }
	}

	$aionian = 0; $line=FALSE; while(($line===FALSE && ($line=strtok($data_aionian, "\n"))!==FALSE) || ($line=strtok("\n")) !== FALSE) {
		if (FALSE===($aion_open_pare=preg_match_all("#\(#us", $line)) ||
			FALSE===($aion_clos_pare=preg_match_all("#\)#us", $line)) ||
			FALSE===($aion_open_brak=preg_match_all("#\[#us", $line)) ||
			FALSE===($aion_clos_brak=preg_match_all("#\]#us", $line)) ||
			FALSE===($aion_open_brac=preg_match_all("#\{#us", $line)) ||
			FALSE===($aion_clos_brac=preg_match_all("#\}#us", $line)) ||
			FALSE===($aion_open_mark=preg_match_all("#\<#us", $line)) ||
			FALSE===($aion_clos_mark=preg_match_all("#\>#us", $line))) {									AION_ECHO("ERROR! Analysis ENCLOSURES preg_match_all(line) $file_aionian $byte_aionian "); }
		if (!($line=preg_replace("#[\s]+#us"," ",$line))) {													AION_ECHO("ERROR! Analysis ENCLOSURES preg_replace() $file_aionian $byte_aionian "); }
		if (($aion_open_pare - $aion_clos_pare)) {	$analysis .= "$short	ENCLOSURES	Aionian	($aion_open_pare/$aion_clos_pare)	$line	WARN\n"; ++$aionian; }
		if (($aion_open_brak - $aion_clos_brak)) {	$analysis .= "$short	ENCLOSURES	Aionian	[$aion_open_brak/$aion_clos_brak]	$line	WARN\n"; ++$aionian; }
		if (($aion_open_brac - $aion_clos_brac)) {	$analysis .= "$short	ENCLOSURES	Aionian	\{$aion_open_brac/$aion_clos_brac\}	$line	WARN\n"; ++$aionian; }
		if (($aion_open_mark || $aion_clos_mark)) {	$analysis .= "$short	ENCLOSURES	Aionian	<$aion_open_mark/$aion_clos_mark>	$line	WARN\n"; ++$aionian; }
	}
	$analysis .= "$short	ENCLOSURES	Summary	lines	$original / $aionian	".(($original - $aionian) ? 'WARN' : 'NOTICE')."\n";
	
	// UNEXPECTED
	$analysis .= "\n# UNEXPECTED\n";
	if (!function_exists('array_unexpected_count')) { function array_unexpected_count($short, $orig, $aion, $char, &$total_orig, &$total_aion) {
		$total_orig += ($count_orig = mb_substr_count($orig, $char));
		$total_aion += ($count_aion = mb_substr_count($aion, $char));
		return "$short	UNEXPECTED	Source/Aionian	($char)	$count_orig/$count_aion	".(($count_orig+$count_aion) ? 'WARN' : 'NOTICE')."\n";
	} }
	$total_orig = $total_aion = 0;
	$analysis .= array_unexpected_count($short, $data_original, $data_aionian, '~', $total_orig, $total_aion);
	$analysis .= array_unexpected_count($short, $data_original, $data_aionian, '`', $total_orig, $total_aion);	
	$analysis .= array_unexpected_count($short, $data_original, $data_aionian, '@', $total_orig, $total_aion);
	$analysis .= array_unexpected_count($short, $data_original, $data_aionian, '#', $total_orig, $total_aion);
	$analysis .= array_unexpected_count($short, $data_original, $data_aionian, '$', $total_orig, $total_aion);
	$analysis .= array_unexpected_count($short, $data_original, $data_aionian, '%', $total_orig, $total_aion);
	$analysis .= array_unexpected_count($short, $data_original, $data_aionian, '^', $total_orig, $total_aion);
	$analysis .= array_unexpected_count($short, $data_original, $data_aionian, '&', $total_orig, $total_aion);
	$analysis .= array_unexpected_count($short, $data_original, $data_aionian, '*', $total_orig, $total_aion);
	$analysis .= array_unexpected_count($short, $data_original, $data_aionian, '_', $total_orig, $total_aion);
	$analysis .= array_unexpected_count($short, $data_original, $data_aionian, '+', $total_orig, $total_aion);
	$analysis .= array_unexpected_count($short, $data_original, $data_aionian, '=', $total_orig, $total_aion);
	$analysis .= array_unexpected_count($short, $data_original, $data_aionian, '|', $total_orig, $total_aion);
	$analysis .= array_unexpected_count($short, $data_original, $data_aionian, '\\',$total_orig, $total_aion);	
	$analysis .= array_unexpected_count($short, $data_original, $data_aionian, '/', $total_orig, $total_aion);
	$analysis .= "$short	UNEXPECTED	Source/Aionian	Summary	$total_orig/$total_aion	".(($total_orig+$total_aion) ? 'WARN' : 'NOTICE')."\n";	

	// NUMERALS
	$analysis .= "\n# NUMERALS\n";
	$count = 0; $line=FALSE; while(($line===FALSE && ($line=strtok($data_original, "\n"))!==FALSE) || ($line=strtok("\n")) !== FALSE) {
		if (preg_match("#^[^\dON]+[\s]+[\d]+[\s]+[\d]+[\s]+.*(\d+).*$#us", $line, $match) ||
			preg_match("#^[^\s]+[\s]+[\d]+:[\d]+[\s]+.*(\d+).*$#us", $line, $match)) {
			if (!($line=preg_replace("#\s+#us", " ", $line))) {												AION_ECHO("ERROR! Analysis NUMERALS preg_replace(spaces) $file_original $byte_original "); }
			$analysis .= "$short	NUMERALS	Source	$match[1]	$line	WARN\n";
			++$count;
		}
	}
	$analysis .= "$short	NUMERALS	Source	count	$count	".($count ? 'WARN' : 'NOTICE')."\n";

	$count = 0; foreach($database['T_BIBLE'] as $ref => $line) {
		if (!($lineT=preg_replace("#\([^()]+[gh]{1}\d+\)#us", "", $line['TEXT']))) {							AION_ECHO("ERROR! Analysis NUMERALS preg_replace(1) $file_aionian $byte_aionian, $ref ".$line['TEXT']); }
		if (preg_match("#\d+#us", $lineT, $match)) {
			$status = (preg_match("#[^ \t\d[:punct:]—/]+[\d]+#us", $lineT) || preg_match("#[\d]+[^ \t\d[:punct:]—/nrt]+#us", $lineT) ? 'ERROR' : 'WARN');
			if (!($lineT=preg_replace("#\s+#us", " ", "$ref ".$lineT))) {										AION_ECHO("ERROR! Analysis NUMERALS preg_replace(2) $file_aionian $byte_aionian "); }
			$analysis .= "$short	NUMERALS	Aionian	$match[0]	$lineT	$status\n";
			++$count;
		}
	}
	$analysis .= "$short	NUMERALS	Aionian	count	$count	".($count ? 'WARN' : 'NOTICE')."\n";

	// 
	$analysis .= "\n# CHECK DATA\n";	

	// 
	$analysis .= "\n# COMPARE TEXT WITH VERSE CAPTIONS\n";	

	// 
	$analysis .= "\n# RAWFIX CHANGES\n";	

	// 
	$analysis .= "\n# SKIPPED\n";	

	// 
	$analysis .= "\n# TALLIES\n";	

	// 
	$analysis .= "\n# TEST WORDS\n";	

	// 
	$analysis .= "\n# TEXT REPAIR\n";	

	// 
	$analysis .= "\n# UNTRANSLATE COMPARE\n";	

	// 
	$analysis .= "\n# UNTRANSLATE COUNT\n";	

	// 
	$analysis .= "\n# UNTRANSLATE REVERSE\n";	

	// 
	$analysis .= "\n# DONE THANK YOU AND YOU ARE WELCOME\n";	
		
	$analysis = preg_replace("#\r\n#us","\n",$analysis);
	$analysis = preg_replace("#\n#us","\r\n",$analysis);		
	if (!($analysis=preg_replace("#000000000000#us",sprintf("%-12s", strlen($analysis)),$analysis))) {		AION_ECHO("ERROR! Analysis END preg_replace($file_analysis)"); }
	
	// ANALYSIS
	if (!file_put_contents($file_analysis, $analysis)) {													AION_ECHO("ERROR! Analysis END file_put_contents($file_analysis)"); }

	// DONE
	AION_ECHO("ANALYSIS SUCCESS: $file_analysis");
	AION_unset($database);
	unset($database);
	unset($data_original);
	unset($data_aionian);
	unset($bible_stats);
	unset($bible_stats2);
	unset($minus_original);
	unset($added_aionian);	
	unset($analysis);
	gc_collect_cycles();
}

