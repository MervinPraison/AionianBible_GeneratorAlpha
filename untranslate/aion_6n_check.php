#!/usr/local/bin/php
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
	AION_FILE_DATA_GET( './aion_database/BOOKSSTANDARD.noia', 'T_BOOKSSTANDARD', $database, array('BOOK','CHAPTER','VERSE'), FALSE );
	AION_LOOP( array(
		'function'		=> 'AION_LOOP_ANALYSIS_DOIT',
		'source'		=> $source,
		'include'		=> "/---Source-Edition\.[^.]+\.txt$/",
		'database'		=> $database,
		'destiny'		=> $destiny,
		) );
	AION_unset($database); unset($database);
	AION_ECHO("DONE DID IT!");
}
function AION_LOOP_ANALYSIS_DOIT($args) {
	// BIBLE?
	if (!preg_match("/^Holy-Bible---(.*)---Source-Edition\.[^.]+\.txt$/", $args['filename'], $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']); }
	$bible = "Holy-Bible---$matches[1]";
	$file_original = $args['filepath'];
	$file_analysis = $args['destiny']."/$bible---Analysis.txt";
	$file_aionian  = $args['destiny']."/$bible---Aionian-Edition.noia";

	// SUPPORT?
	if (empty($args['database'][T_BOOKS][$bible])) {														AION_ECHO("ERROR! Analysiss Failed to find BOOK[bible] = $bible"); }
	if (($x=count($args['database'][T_BOOKS][$bible]))!=67) {												AION_ECHO("ERROR! Analysiss Count(args[T_BOOKS][BIBLE])!=67: $x"); }
	if (empty($args['database'][T_NUMBERS][$bible])) {														AION_ECHO("ERROR! Analysiss Failed to find NUMBERS[bible] = $bible"); }
	if (empty($args['database'][T_VERSIONS][$bible])) {														AION_ECHO("ERROR! Analysiss Failed to find VERSIONS[bible] = $bible"); }
	if (empty($args['database'][T_FORPRINT][$bible])) {														AION_ECHO("ERROR! Analysiss Failed to find FORPRINT[bible] = $bible"); }

	// INPUT
	$database = array();
	if (!($data_original=file_get_contents($file_original))) {												AION_ECHO("ERROR! Analysiss file_get_contents($file_original)"); }
	if (!($data_aionian =file_get_contents($file_aionian))) {												AION_ECHO("ERROR! Analysiss file_get_contents($file_aionian)"); }
	$encode_original = mb_detect_encoding($data_original);
	$encode_aionian = mb_detect_encoding($data_aionian);
	$encode_original = (empty($encode_original) ? "Unknown" : $encode_original);
	$encode_aionian = (empty($encode_aionian) ? "Unknown" : $encode_aionian);
	$data_original = Encoding::toUTF8($data_original);
	$data_aionian = Encoding::toUTF8($data_aionian);
	AION_FILE_DATA_GET( $file_aionian, 'T_BIBLE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	$byte_original = strlen($data_original);
	$byte_aionian  = strlen($data_aionian);
	$char_original = mb_strlen($data_original);
	$char_aionian  = mb_strlen($data_aionian);

	// REMOVE COMMENTS AND EMPTY LINES
	if(!($data_original=preg_replace("#[\r\n]+#uis","\n",$data_original))) {								AION_ECHO("ERROR! Analysiss preg_replace(original empty line) $file_original $byte_original ".preg_last_error()); }
	if(!($data_aionian=preg_replace("#[\r\n]+#uis","\n",$data_aionian))) {									AION_ECHO("ERROR! Analysiss preg_replace(aionian empty line) $file_aionian $byte_aionian"); }
	if(!($data_original=preg_replace("@(^|\n#|\n/)[^\n]*?@uis","",$data_original))) {						AION_ECHO("ERROR! Analysiss preg_replace(original comment) $file_original $byte_original"); }
	if(!($data_aionian=preg_replace("@(^|\n#|\n/)[^\n]*?@uis","",$data_aionian))) {							AION_ECHO("ERROR! Analysiss preg_replace(aionian comment) $file_aionian $byte_aionian"); }

	// ANALYIZE
	$analysis = "";
	//
	$analysis .= "\n\n=== EXPLANATION =========================================================================\n" .
		"Below are various analysis of the source Bible text and the resulting Aionian Edition text.\n" .
		"Analysis reports possible problems, and comparing current analysis with new reveals changes.\n" .
		"Some of analysis is relevant only to the Aionian Bible project and others are relevant to all.\n" .
		"The Aionian Bible project attempts to reversify to the KJV standard and reports any variances.\n" .
		"Search for these words below: NOTICE, WARNING, and PROBLEM\n";
	// 
	$analysis .= "\n\n=== FILE ENCODING =======================================================================\n" .
		$args['filename'] . " = $encode_original " . ($encode_original=="UTF-8" ? "" : ($encode_original=="Unknown" ? "(PROBLEM! Undefined)" : "(WARNING! Not UTF-8)")) . "\n" .
		"$bible---Aionian-Edition.noia = $encode_aionian " . ($encode_aionian=="UTF-8" ? "" : ($encode_aionian=="Unknown" ? "(PROBLEM! Undefined)" : "(WARNING! Not UTF-8)")) . "\n";
	// 
	$analysis .= "\n\n=== BYTE COUNTS =========================================================================\n" .
		"Original bytes/characters = $byte_original / $char_original " . ($byte_original==$char_original ? "(single-byte)" : "(multi-byte)") . "\n" .
		"Aionian bytes/characters = $byte_aionian / $char_aionian " . ($byte_aionian==$char_aionian ? "(single-byte)" : "(multi-byte)") . "\n";
	// 
	$analysis .= "\n\n=== 263 AIONIAN GLOSSARY VERSES =========================================================\n";
	$missingbook1 = $missingbook2 = $butbookfound = $missingchapter = $missingverse = $gotverse = 0;
	$args['database']['T_ANAVIGATION'][] = array('BIBLE'=>$bible,'STATUS'=>'','MISSING'=>'');
	foreach($args['database']['T_UNTRANSLATE'] as $key => $untranslate) {
		$key0 = preg_replace('/-\d\d\d-\d\d\d$/','',$key);
		if ($args['database']['T_BOOKS'][$bible][array_search($untranslate['BOOK'],$args['database']['T_BOOKS']['CODE'])]=='NULL') {
			if (!empty($database['T_BIBLE'][$key0.'-001-001']) || !empty($database['T_BIBLE'][$key0.'-001-002'])) {						++$butbookfound; }
																																		++$missingbook1;	continue; }
		if (!empty($database['T_BIBLE'][$key])) {																						++$gotverse;		continue; }
		if (empty($database['T_BIBLE'][$key0.'-001-001']) && empty($database['T_BIBLE'][$key0.'-001-002'])) {							++$missingbook2;	continue; }
		++$count;
		$key1 = preg_replace('/-\d\d\d$/','-001',$key);
		if (empty($database['T_BIBLE'][$key1])) {																						++$missingchapter;	$status = 'chapter missing'; }
		else {																															++$missingverse;	$status = 'verse missing'; }
		$args['database']['T_ANAVIGATION'][] = array('BIBLE'=>$bible,'STATUS'=>$status,'MISSING'=>$key);
		$analysis .= "Aionian glossary $status: $key";
	}
	$total = $missingbook1 + $missingbook2 + $missingchapter + $missingverse + $gotverse;
	$analysis .=
		"Missing because book not defined   = $missingbook1" . ($butbookfound ? " (PROBLEM! Book not defined but found.)" : "") . "\n" . 
		"Missing because book is missing    = $missingbook2\n" .
		"Missing because chapter is missing = $missingchapter\n" .
		"Missing because verse is missing   = $missingverse\n" .
		"Found = $gotverse".($gotverse==263 ? " (Yayyy!)" : "" ) . "\n" .
		"TOTAL = $total".($total==263 ? "" : " (PROBLEM! Why not 263?)" )."\n";

	// 
	$analysis .= "\n\n=== MISSING BIBLE BOOKS =================================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== KJV VERSIFICATION COMPARISON ========================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== ENCLOSURES COUNT ====================================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== UNEXPECTED PUNCTUATION ==============================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== UNPRINTABLES ========================================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== CHECK DATA ==========================================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== COMPARE TEXT WITH VERSE CAPTIONS ====================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== VERSE NUMERALS ======================================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== RAWFIX CHANGES ======================================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== SKIPPED =============================================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== TAGS FOUND ==========================================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== TALLIES =============================================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== TEST WORDS ==========================================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== TEXT REPAIR =========================================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== UNTRANSLATE COMPARE =================================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== UNTRANSLATE COUNT ===================================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== UNTRANSLATE REVERSE =================================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== UNICODE USAGE =======================================================================\n" .
		"";
	// 
	$analysis .= "\n\n=== DONE THANK YOU AND YOU ARE WELCOME ==================================================\n";
		
	// HEADER
	$header  =
		"# File Name: Holy-Bible---$bible---Analysis.txt\n" .
		"# File Size: 000000000000\n" .
		"# File Date: ".date('m/d/Y H:i:s')."\n" .
		"# File Purpose: Supporting resource for the Aionian Bible project\n" .
		"# File Location: http://resources.AionianBible.org\n" .
		"# File Copyright: Creative Commons Attribution No Derivative Works 4.0, 2018-".date('Y')."\n" .
		"# File Generator: ABCMS (alpha)\n" .
		"# File Accuracy: Contact publisher with corrections to file format or content\n" .
		"# Publisher Name: Nainoia Inc\n" .
		"# Publisher Contact: http://www.AionianBible.org/Publisher\n" .
		"# Publisher Mission: http://www.AionianBible.org/Preface\n" .
		"# Publisher Website: http://NAINOIA-INC.signedon.net\n" .
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
		(empty($args['database'][T_VERSIONS][$bible]['DESCRIPTION']) ? "" : ("# Bible Description: ".$args['database'][T_VERSIONS][$bible]['DESCRIPTION']."\n"));
	$header = preg_replace("#\r\n#uis","\n",$header);
	$analysis = preg_replace("#\r\n#uis","\n",$analysis);
	$header = preg_replace("#\n#uis","\r\n",$header);
	$analysis = preg_replace("#\n#uis","\r\n",$analysis);		
	if (!($header=preg_replace("#000000000000#uis",sprintf("%-12s", strlen($header.$analysis)),$header))) {	AION_ECHO("ERROR! AION_FILE_DATA_PUT preg_replace($file_analysis)"); }
	
	// ANALYSIS
	if (!file_put_contents($file_analysis, $header.$analysis)) {											AION_ECHO("ERROR! AION_FILE_DATA_PUT file_put_contents($file_analysis)"); }

	// DONE
	AION_unset($database);
	unset($database);
	unset($data_original);
	unset($data_aionian);
	unset($header);
	unset($analysis);
	gc_collect_cycles();
	AION_ECHO("ANALYSIS SUCCESS: $bible");
}

