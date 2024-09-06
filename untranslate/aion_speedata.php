#!/usr/local/bin/php
<?php

/*** GLOBALS ***/
static $speedata_version = NULL;

/*** aion rtfs make loop ***/
function AION_LOOP_PDF_POD($source, $destiny) {
	//system("zip -r - ../www-stageresources/AB-Fonts	> ../www-stageresources/AB-Fonts.zip");
	//system("zip -r - ../www-stageresources/AB-Images	> ../www-stageresources/AB-Images.zip");
	//system("zip -r - ../www-stageresources/AB-ISBN	> ../www-stageresources/AB-ISBN.zip");
	//exit;
	$database = array();
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATE.txt', 'T_UNTRANSLATE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKS.txt', 'T_BOOKS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/NUMBERS.txt', 'T_NUMBERS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/VERSIONS.txt', 'T_VERSIONS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/FORPRINT.txt', 'T_FORPRINT', $database, 'BIBLE', FALSE );
	AION_LOOP( array(
		'function'	=> 'AION_LOOP_PDF_POD_DOIT',
		'source'	=> $source,
		'q_onebook'	=> FALSE,	// TRUE = only do first bible book, otherwise all
		'q_rtlhuh'	=> 'ALL',	// 'RTL' = RTL only,  'RTLNO' = Skip RTL, 'ALL' = all
		'q_allall'	=> TRUE,	// TRUE = do all bibles not marked FALSE -OR- FALSE = do all bibles marked TRUE
		'q_pdfall'	=> TRUE,	// TRUE = do ALL PDFs
		'q_pdfpo'	=> FALSE,	// TRUE = do KDP PDFs
		'q_pdfnt'	=> FALSE,	// TRUE = do KDP NT PDFs
		'q_pdflu'	=> FALSE,	// TRUE = do LULU PDFs
		'q_pdfon'	=> FALSE,	// TRUE = do Online PDFs
		'q_pdfoo'	=> FALSE,	// TRUE = do One Online PDFs
		'q_epubc'	=> TRUE,	// TRUE = do ePub covers
		//'include'	=> "/Holy-Bible---.*(Albanian|Aionian-Bible).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Hebrew-Aleppo-Miqra-Mesorah).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(English---Trans-Trans).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(STEP).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Traditional|Aionian-Bible|Oriya|Vietnamese).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Syriac-Peshitta|Assamese-Bible|Palya-Bareli-Bible|Sorani-Bible|Marathi-Bible|Nepali-Bible|Urdu-Script|Tagalog-Bible-1905).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---(Kannada|Myanmar|Malayalam|Tamil|Sanskrit).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Gujarati|Aionian-Bible).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Aionian-Bible|New-Arabic|Burmese-Common|Bulgarian|Basque|Japanese-Yougo|Uyghur-Bible-Pinyin|Sencillo-Bible|Chinese-Union-Version-Traditional).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(King-James-Version-Updated).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Arabic---New-Arabic-Bible).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Arabic|Nepali).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(New-Heart|Rote-Dela|French---Vulgate|Yombe|Hebrew---Living|Hebrew---Modern|Bangwinji|Bhadrawahi|Blackfoot|Borna|Chin-Daai|Chin--Thaiphum).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---[N-Z]+.*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---(Ndebele---Ndebele-Bible|Ndengereko---Ndengereko-Bible|N[e-z]+|[O-Z]+).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---(German---German-Luther-Bible-1545|Haitian---Haitian-Creole-Smith|Portuguese---World-Portuguese-Bible).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Uyghur-Bible-Arabic).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Basque|Breton).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Chiyawo).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---(Ahirani|Hebrew---Living-Bible).*---Aionian-Edition\.noia$/",
		'include'	=> "/Holy-Bible---.*(Burmese|Myanmar).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Nepali-Bible|Oriya-Bible|Uyghur-Bible-Cyrillic|Uyghur-Bible-Pinyin).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(LXX|Khan).*---Aionian-Edition\.noia$/",
		//'include'	=> "/(Holy-Bible---Latvian---Latvian-Gluck-Bible|Holy-Bible---Japanese---Japanese-Yougo-yaku)---Aionian-Edition\.noia$/",
		//'include'	=> "/.*Arapaho.*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Irish|Living-Oracles).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Rote-Dela).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---(Coptic|Myanmar---Burmese-Common|Sanskrit---Burmese|Sanskrit---Cologne|Sanskrit---Harvard|Sanskrit---IAST|Sanskrit---ISO|Sanskrit---ITRANS|Sanskrit---Tamil|Sanskrit---Velthuis).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Arapaho|Cherokee|Malayalam|Myanmar-Burmese-Judson|Sanskrit|Tamil).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Tsakhur|Burmese-Common).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---(Kannada|Malayalam|Myanmar|Sanskrit|Tamil).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---(Coptic).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Greek-STEP|Hebrew-STEP|1910-Contemp|Romanian---BTF|Tsakhur).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---.*(Sanskrit---Urdu).*---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---Coptic---Coptic-Boharic-NT---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---English---Catholic-Public-Domain---Aionian-Edition\.noia$/",
		//'include'	=> "/Holy-Bible---English---Aionian-Bible---Aionian-Edition\.noia$/",
		//'include'	=> "/---Aionian-Edition\.noia$/",
		'database'	=> $database,
		'destiny'	=> $destiny,
		) );
	AION_unset($database); unset($database);
	system("cat Holy-Bible*.messages > BIBLE-PROOF.messages");
	system("grep 'COUNT_READ'  BIBLE-PROOF.messages | sed -e 's/  <Message>PAGE COUNT_//g' -e 's/<\/Message>//g' > BIBLE-PROOF.count_read");
	system("grep 'COUNT_STUDY' BIBLE-PROOF.messages | sed -e 's/  <Message>PAGE COUNT_//g' -e 's/<\/Message>//g' > BIBLE-PROOF.count_study");
	system("grep 'COUNT_NEW'   BIBLE-PROOF.messages | sed -e 's/  <Message>PAGE COUNT_//g' -e 's/<\/Message>//g' > BIBLE-PROOF.count_new");
	system("grep 'COUNT_POD'   BIBLE-PROOF.messages | sed -e 's/  <Message>PAGE COUNT_//g' -e 's/<\/Message>//g' > BIBLE-PROOF.count_pod");
	// ok really do the whole thing!
	//chdir('/home/inmoti55/public_html/domain.aionianbible.org/untranslate');
	//system("./aion_5_index.sh 2>&1 > aion_5_index.sh.aionian.out");
	//system("./aion_X_proofer.sh 2>&1 > aion_X_proofer.out");
	//system("./aion_X_proofer_diff.sh 2>&1 > aion_X_proofer_diff.out");
	AION_ECHO("TODO! REMINDER!!! RUN AION_5_INDEX.SH TO UPDATE PDF LINKS!");
	AION_ECHO("TODO! REMINDER!!! RUN PROOFER AFTER COMPLETE RUNS!");
}
function AION_LOOP_PDF_POD_DOIT($args) {
	// BIBLE
	if (!preg_match("/\/(Holy-Bible---.*)---Aionian-Edition\.noia/", $args['filepath'], $matches)) { AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']); }
	$bible = $matches[1];
	if (empty($args['database'][T_BOOKS][$bible])) {			AION_ECHO("ERROR! Failed to find BOOK[bible] = $bible"); }
	if (($x=count($args['database'][T_BOOKS][$bible]))!=67) {	AION_ECHO("ERROR! Count(args[T_BOOKS][BIBLE])!=67: $x"); }

	// SKIP
	$forprint = $args['database']['T_FORPRINT'][$bible];
	if ($forprint['NOPDO']=="TRUE") {
		if ($args['q_allall']) { $args['q_pdfon'] = TRUE; }
		$args['q_pdfall'] = $args['q_pdfpo'] = $args['q_pdfnt'] = $args['q_pdflu'] = FALSE;
	}
	if (($args['q_rtlhuh'] == 'RTL' && empty($forprint['RTL'])) || ($args['q_rtlhuh'] == 'RTLNO' && !empty($forprint['RTL']))) { AION_ECHO("SPEEDATA SKIPPING! $bible"); return; } // RTL Only. NO RTL, or ALL
	if (( $args['q_allall'] && $forprint['DOIT']=="FALSE") || (!$args['q_allall'] && $forprint['DOIT']!="TRUE")) { AION_ECHO("SPEEDATA SKIPPING! $bible"); return; }
	if ($args['q_pdflu']) { $args['q_pdfpo'] = $args['q_pdfnt'] = TRUE;	}
	AION_ECHO("SPEEDATA BUILDING: $bible");
	AION_ECHO("SPEEDATA MEMORY: PHP=".(int)(memory_get_usage(false)/1000)." SYSTEM=".(int)(memory_get_usage(true)/1000));
	system("free");

	// SOURCE VERSION
	$base = $args['source'].'/'.$bible;
	$sour = (
		(is_file($base.'---Source-Edition.STEP.txt')	? '---Source-Edition.STEP.txt' :
		(is_file($base.'---Source-Edition.NHEB.txt')	? '---Source-Edition.NHEB.txt' :
		(is_file($base.'---Source-Edition.VPL.txt')		? '---Source-Edition.VPL.txt' :
		(is_file($base.'---Source-Edition.UNBOUND.txt')	? '---Source-Edition.UNBOUND.txt' :
		(is_file($base.'---Source-Edition.B4U.txt')		? '---Source-Edition.B4U.txt' :
		(is_file($base.'---Source-Edition.SWORD.txt')	? '---Source-Edition.SWORD.txt' : NULL)))))));
	if (empty($sour) || !AION_filesize($base.$sour)) { AION_ECHO("ERROR! AION_FILE_DATABASE_PUT no source extension found! $bible"); }
	$forprint['SOURCEVERSION'] = (filemtime($base.$sour)===FALSE ? '' : ("<Value>Source version: ".date("n/j/Y", filemtime($base.$sour))."</Value><Br />"));

	// VARIABLES
	$speed = '../AB-Speedata/bin/sp';
	$speed2 = '../www-stageresources/AB-Speedata/bin/sp';
	static $rundate = NULL; if ($rundate===NULL) { $rundate = date("n/j/Y"); }
	global $speedata_version;
	$speedata_version =
		($speedata_version !== NULL ? $speedata_version :
		(!preg_match("/^(.*)\s+([^ ]+)\s+([^ ]+)$/", system("$speed2 --version 2>&1"), $match) || empty($match[2]) || empty($match[3]) ? "Speedata Publisher on $rundate" :
		"Speedata Publisher $match[2] $match[3] on $rundate"));
	$lua = "runtime = require('runtime')\nschema = '../AB-Speedata/share/schema/layoutschema-en.rng'\nok, msg = runtime.validate_relaxng('XMLTOVALIDATE',schema)\nif not ok then\nprint(msg)\nos.exit(-1)\nend";
	$versions = $args['database']['T_VERSIONS'][$bible];
	$default = $args['database']['T_FORPRINT']['DEFAULT'];
	$forprint['ISBN'] = NULL;
	$numarialfont = ($args['database']['T_NUMBERS'][$bible][1] === '1' ? TRUE : FALSE);
	$FOLDERS= '../AB-Fonts:../AB-Images:../AB-ISBN';
	$DATA	= 'bible_data.xml';
	$CONFIGVALS  = "data=$DATA\nautoopen=false\nextra-dir=$FOLDERS\ngrid=false\nruns=1\nxmlparser=lua\nverbose=true\nloglevel=info\nfontloader=fontforge\n";
	$CONFIGFILE  = 'bible_config.cfg';
	// tags
	$destiny_READ					= '---Aionian-Edition';
	$destiny_STUDY					= '---Aionian-Edition---STUDY';
	$destiny_POD_INTERIOR			= '---POD_KDP_ALL_BODY';
	$destiny_POD_COVER				= '---POD_KDP_ALL_COVER';
	$destiny_POD_INTERIOR_NT		= '---POD_KDP_NEW_BODY';
	$destiny_POD_COVER_NT			= '---POD_KDP_NEW_COVER';
	$destiny_POD_INTERIOR_22		= '---POD_KDP_X22_BODY';
	$destiny_POD_COVER_22			= '---POD_KDP_X22_COVER';	
	$destiny_POD_LULU				= '---POD_LULU_ALL_BODY';
	$destiny_POD_COVER_LULU			= '---POD_LULU_ALL_COVER';
	$destiny_POD_LULU_HARD			= '---POD_LULU_HAR_BODY';
	$destiny_POD_COVER_LULU_HARD	= '---POD_LULU_HAR_COVER';
	$destiny_POD_LULU_NT			= '---POD_LULU_NEW_BODY';
	$destiny_POD_COVER_LULU_NT		= '---POD_LULU_NEW_COVER';
	$destiny_POD_LULU_22			= '---POD_LULU_X22_BODY';
	$destiny_POD_COVER_LULU_22		= '---POD_LULU_X22_COVER';
	$destiny_EPUB					= '---EPUB_COVER';
	$destiny_SPEEDATA				= '---SPEEDATA';
	// replacements
	$replace_temp = (empty($forprint['REPLACE']) ? NULL : mb_split("\|", $forprint['REPLACE']));
	$replace_char = (empty($replace_temp[0]) || empty($replace_temp[1]) ? NULL : mb_split(",", $replace_temp[0]));
	$replace_with = (empty($replace_temp[0]) || empty($replace_temp[1]) ? NULL : mb_split(",", $replace_temp[1]));
	if (!empty($replace_char)) { AION_ECHO("JEFF NOTICE! Replacement patterns found for $bible: ".$forprint['REPLACE']); }
	if (!empty($replace_char) && count($replace_char) != count($replace_with)) { AION_ECHO("ERROR! Replace format error, ".$forprint['REPLACE']); }
	static $TwentyTwo = array(
'GEN' => 'Genesis',
'EXO' => 'Exodus',
'JOS' => 'Joshua',
'JDG' => 'Judges',
'RUT' => 'Ruth',
'1SA' => '1 Samuel',
'2SA' => '2 Samuel',
'EZR' => 'Ezra',
'NEH' => 'Nehemiah',
'EST' => 'Esther',
'PSA' => 'Psalms',
'PRO' => 'Proverbs',
'JON' => 'Jonah',
'MAL' => 'Malachi',
'JOH' => 'John',
'ACT' => 'Acts',
'ROM' => 'Romans',
'EPH' => 'Ephesians',
'TIT' => 'Titus',
'HEB' => 'Hebrews',
'1JO' => '1 John',
'REV' => 'Revelation of John',
);
	AION_ECHO("SPEEDATA $bible: VARAIBLES SUCCESS!");
	
	// WORKSPACE
	$TEMP = $args['destiny']."/$bible"."---SPEEDATA";
	system("rm -rf $TEMP");
	if (is_dir($TEMP)) {		AION_ECHO("ERROR! rm -rf failed: $TEMP"); }
	if (!mkdir($TEMP,0755)) {	AION_ECHO("ERROR! mkdir failed: $TEMP"); }
	if (!chdir($TEMP)) {		AION_ECHO("ERROR! chdir: $TEMP"); }	
	AION_ECHO("SPEEDATA $bible: WORKSPACE SUCCESS! $TEMP");
	
	// FILE > CONFIG
	if (!file_put_contents($CONFIGFILE,  $CONFIGVALS)) {	AION_ECHO("ERROR! file_put_contents: $CONFIGFILE"); }
	AION_ECHO("SPEEDATA $bible: CONFIG CREATION SUCCESS! $CONFIGFILE");
	
	// FILE > DATA
	if (($fp = fopen($DATA, 'w'))==FALSE) { AION_ECHO("ERROR! fopen: $DATA"); }
	if (!fwrite($fp, "<?xml version='1.0' encoding='utf-8'?>\n")) { AION_ECHO("ERROR! fwrite: $DATA"); }
	$NAME = $args['database']['T_VERSIONS'][$bible]['NAME'];
	$NAMEENGLISH = $args['database']['T_VERSIONS'][$bible]['NAMEENGLISH'];
	$forprint['LANGCHAP'] = (1 == $args['database']['T_NUMBERS'][$bible][1] ? "English (USA)" : (empty($forprint['LANGSPEED']) ? "Other" : $forprint['LANGSPEED']));
	if(strpos($NAME,'"')!==FALSE || strpos($NAMEENGLISH,'"')!==FALSE) { AION_ECHO("ERROR! bible name quote problem! $NAME $NAMEENGLISH"); }
	if (!fwrite($fp, '<bible NAME="'.$NAME.'" NAMEENGLISH="'.$NAMEENGLISH.'">'."\n")) { AION_ECHO("ERROR! fwrite: $DATA"); }
	$current_book = NULL;
	$current_chap = NULL;
	$closetag = 'oldtest';
	$database = array();
	AION_FILE_DATA_GET( $args['filepath'], 'T_BIBLE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_BIBLE_RESORT( $forprint, $database );
	AION_GLOSSARY_REFERENCES_GET( $bible, $database, $args );

	// MANUAL EXPLICIT HYPHENATION
	// ugly adjustments needed for PDF hyphenation and line wrap
	// mainly because I do not use Speedata to hyphenate because too many languages to consider, so no auto hyphenation!
	if ("Holy-Bible---Finnish---Finnish-Bible"===$bible) {
		$ref='023-ISA-036-001';
		if (!($database['T_BIBLE'][$ref]['TEXT']=preg_replace("/Ja tapahtui kuningas Hiskian neljännellätoistakymmenennellä /u","Ja tapahtui kuningas Hiskian neljännellätoista-kymmenennellä ",$database['T_BIBLE'][$ref]['TEXT'],-1,$n)) || 1!=$n) {
			AION_ECHO("ERROR! $bible preg_replace(manual hyphen) error: ".preg_last_error() . " $ref ".$database['T_BIBLE'][$ref]['TEXT']);
		}
	}
	else if ("Holy-Bible---Kannada---Kannada-Bible"===$bible) {
		$ref='040-MAT-025-001';
		if (!($database['T_BIBLE'][$ref]['TEXT']=preg_replace("/ಪರಲೋಕ ರಾಜ್ಯವು ತಮ್ಮ ದೀಪಾರತಿಗಳನ್ನುತೆಗೆದುಕೊಂಡು /u","ಪರಲೋಕ ರಾಜ್ಯವು ತಮ್ಮ ದೀಪಾರತಿಗಳನ್ನು ತೆಗೆದುಕೊಂಡು ",$database['T_BIBLE'][$ref]['TEXT'],-1,$n)) || 1!=$n) {
			AION_ECHO("ERROR! $bible preg_replace(manual hyphen) error: ".preg_last_error() . " $ref ".$database['T_BIBLE'][$ref]['TEXT']);
		}				
		$ref='054-1TI-003-001';
		if (!($database['T_BIBLE'][$ref]['TEXT']=preg_replace("/ಸಭಾಧ್ಯಕ್ಷನ ಉದ್ಯೋಗವನ್ನು ಪಡೆದುಕೊಳ್ಳಬೇಕೆಂದಿರುವವನು /u","ಸಭಾಧ್ಯಕ್ಷನ ಉದ್ಯೋಗವನ್ನು ಪಡೆದುಕೊಳ್ಳ ಬೇಕೆಂದಿರುವವನು ",$database['T_BIBLE'][$ref]['TEXT'],-1,$n)) || 1!=$n) {
			AION_ECHO("ERROR! $bible preg_replace(manual hyphen) error: ".preg_last_error() . " $ref ".$database['T_BIBLE'][$ref]['TEXT']);
		}
	}
	else if ("Holy-Bible---Kannada---Open-Contemporary"===$bible) {
		$ref='040-MAT-025-001';
		if (!($database['T_BIBLE'][$ref]['TEXT']=preg_replace("/ಪರಲೋಕ ರಾಜ್ಯವು ತಮ್ಮ ದೀಪಗಳನ್ನು ತೆಗೆದುಕೊಂಡು ಮದುಮಗನನ್ನು ಎದುರುಗೊಳ್ಳುವುದಕ್ಕಾಗಿ /u","ಪರಲೋಕ ರಾಜ್ಯವು ತಮ್ಮ ದೀಪಗಳನ್ನು ತೆಗೆದುಕೊಂಡು ಮದುಮಗನನ್ನು ಎದುರುಗೊಳ್ಳು ವುದಕ್ಕಾಗಿ ",$database['T_BIBLE'][$ref]['TEXT'],-1,$n)) || 1!=$n) {
			AION_ECHO("ERROR! $bible preg_replace(manual hyphen) error: ".preg_last_error() . " $ref ".$database['T_BIBLE'][$ref]['TEXT']);
		}
	}

	// loop
	foreach($database['T_BIBLE'] as $ref => $verse) {
		// BOOK
		if ($current_book != $verse['BOOK']) {
			if ($current_book != NULL) {
				if ($args['q_onebook']) { break; } // TRUE = fast testing, one bible book only!
				if (!fwrite($fp, "</chapter>\n</$closetag>\n")) { AION_ECHO("ERROR! fwrite: $DATA"); }
			}
			$BOOKX = array_search($verse['BOOK'], $args['database']['T_BOOKS']['CODE']);
			$BOOKENGLISH = $args['database']['T_BOOKS']['ENGLISH'][$BOOKX];
			$BOOK = $args['database']['T_BOOKS'][$bible][$BOOKX];
			if($BOOK=='NULL') { AION_ECHO("ERROR! book name == NULL! $BOOK $BOOKENGLISH"); }
			$LANGSPEED = ($BOOK == $BOOKENGLISH ? "English (USA)" : (empty($forprint['LANGSPEED']) ? "Other" : $forprint['LANGSPEED']));
			if(strpos($BOOK,'"')!==FALSE || strpos($BOOKENGLISH,'"')!==FALSE) { AION_ECHO("ERROR! book name quote problem! $BOOK $BOOKENGLISH"); }
			$CHAPTER = $args['database']['T_NUMBERS'][$bible][(int)$verse['CHAPTER']];
			$GoTwentyTwo = (empty($TwentyTwo[$verse['BOOK']]) ? "" : "GO");
			if ((int)$verse['INDEX']<40) {
				if (!fwrite($fp, '<oldtest BOOK="'.$BOOK.'" BOOKENGLISH="'.$BOOKENGLISH.'" TWENTYTWO="'.$GoTwentyTwo.'" LANG="'.$LANGSPEED.'">'."\n<chapter CHAP='$CHAPTER'>")) { AION_ECHO("ERROR! fwrite: $DATA"); } 
				$closetag = 'oldtest';
			}
			else {
				if (!fwrite($fp, '<newtest BOOK="'.$BOOK.'" BOOKENGLISH="'.$BOOKENGLISH.'" TWENTYTWO="'.$GoTwentyTwo.'" LANG="'.$LANGSPEED.'">'."\n<chapter CHAP='$CHAPTER'>")) { AION_ECHO("ERROR! fwrite: $DATA"); } 
				$closetag = 'newtest';
			}
		}
		// CHAPTER
		else if ($current_chap != $verse['CHAPTER']) {
			$CHAPTER = $args['database']['T_NUMBERS'][$bible][(int)$verse['CHAPTER']];
			if (!fwrite($fp, "</chapter>\n<chapter CHAP='$CHAPTER'>")) { AION_ECHO("ERROR! fwrite: $DATA"); }
		}
		$current_book = $verse['BOOK'];
		$current_chap = $verse['CHAPTER'];
		// REPLACE
		if (!empty($replace_char)) {
			$verse_orig = $verse['TEXT'];
			$verse['TEXT'] = str_replace($replace_char, $replace_with, $verse['TEXT']);
			if ($verse['TEXT'] != $verse_orig) { AION_ECHO("JEFF NOTICE! Replacement in $bible at ".$verse['INDEX']." ".$verse['BOOK']." ".$verse['CHAPTER']." ".$verse['VERSE']." ".$verse['TEXT']); }
		}
		// HYPHEN
		// begin each word part with \p{Letter} hoping that \p{Mark} are connected to correct letter, do not separate Marks from Letters
		//https://www.regular-expressions.info/unicode.html
		// \p{L}\p{M}\p{Z}\p{S}\p{N}\p{P}\p{C}
		// currently only used by Finnish
		// this worked but using above explicit hyphenation above instead for greater control
		/*
		if (!empty($forprint['HYPHEN'])) {
			$hyphen_count = 0;
			$before = $verse['TEXT'];
			if (!($verse['TEXT'] = preg_replace("/([\p{L}\p{M}\p{S}\p{N}\p{C}]{{$forprint['HYPHEN']}})(\p{L}[\p{L}\p{M}\p{S}\p{N}\p{C}]{{$forprint['HYPHEN']}})/ui", '$1-$2', $verse['TEXT'], -1, $hyphen_count))) {
				AION_ECHO("ERROR! $bible preg_replace(hyphen) error: ".preg_last_error() . " $ref $before ".$verse['TEXT']);
			}
			if ($hyphen_count) {
				AION_ECHO("HYPHEN VERSE\t$hyphen_count\t$bible\t$ref\t$before\t".$verse['TEXT']);
				$hyphen_total += $hyphen_count;
			}
		}
		*/

		// VERSE FORMAT
		$count_q = $count_g = 0;
		// question span
		if (!($verse['TEXT'] = preg_replace('/\(questioned\)/ui', "</span><span class='vo'>(questioned)</span><span class='va'>", $verse['TEXT'],-1,$count_q))) { AION_ECHO("ERROR! preg_replace(gXXX)"); }
		if ($count_q > 0) {
			AION_ECHO("SPEEDATA GLOSSARY QUES: $bible ".$verse['BOOK']." ".$verse['CHAPTER']." ".$verse['VERSE']);
			$database['T_GLOSSARY_REFERENCES'][]=array_merge($verse,array('WORD'=>'QUESTIONED'));
		}
		// aionian note span
		if (!($verse['TEXT'] = preg_replace('/(\([^()]+[gGhH]{1}[[:digit:]]+[^()]*\))/ui', '</span><span class=\'vo\'>$1</span><span class=\'va\'>', $verse['TEXT'],-1,$count_g))) { AION_ECHO("ERROR! preg_replace(gXXX)"); }
		if (!$count_g && !empty($database['T_GLOSSARY_REFERENCES'][$ref])) {
			AION_ECHO("SPEEDATA GLOSSARY MOVE: $bible ".$verse['BOOK']." ".$verse['CHAPTER']." ".$verse['VERSE']);
			$database['T_GLOSSARY_REFERENCES'][$ref]['MARK']='*';
		}
		if ($count_g && empty($database['T_GLOSSARY_REFERENCES'][$ref])) {
			AION_ECHO("SPEEDATA GLOSSARY SKIP: $bible ".$verse['BOOK']." ".$verse['CHAPTER']." ".$verse['VERSE']);
		}
		// mark 16:9 note span and others
		if ($verse['INDEX']==41 && $verse['CHAPTER']==16 && $verse['VERSE']==9 &&
			!($verse['TEXT'] = preg_replace('/(\(note:[^()]+\))/ui', "</span><span class='vo'>$1</span><span class='v'>", $verse['TEXT'],1))) { AION_ECHO("ERROR! preg_replace(MAR 16:9)"); }
		if ('Holy-Bible---Myanmar---Myanmar-Burmese-Judson'==$bible &&
			!($verse['TEXT'] = preg_replace('/(\(note:[^()]+\))/ui', "</span><span class='vo'>$1</span><span class='v'>", $verse['TEXT'],1))) { AION_ECHO("ERROR! preg_replace(Myanmar note!)"); }
		$VNUM = (int)$verse['VERSE'];
		$VERSE = $args['database']['T_NUMBERS'][$bible][(int)$verse['VERSE']];
		if ($count_q || $count_g) { $verse['TEXT'] = "<span class='vna' V='$VNUM' VN='$VERSE'> $VERSE </span><span class='va'>".$verse['TEXT']." </span>"; }
		else { $verse['TEXT'] = "<span class='vn' V='$VNUM' VN='$VERSE'> $VERSE </span><span class='v'>".$verse['TEXT']." </span>"; }
		if (!fwrite($fp, $verse['TEXT'])) { AION_ECHO("ERROR! fwrite: $DATA"); }
	}
	if (!fwrite($fp, "</chapter>\n</$closetag>\n</bible>\n")) { AION_ECHO("ERROR! fwrite: $DATA"); }
	if(!fclose($fp)) { AION_ECHO("ERROR! fclose: $DATA"); }
	$langspeed	= trim(!empty($forprint['LANGSPEED']) ? $forprint['LANGSPEED'] : "English (USA)" );
	AION_GLOSSARY_REFERENCES_PUT( $bible, $database, $args, !empty($forprint['ISBNLU22']), $langspeed);
	AION_ECHO("SPEEDATA $bible: BIBLE CREATION SUCCESS! $DATA");
	
	// UNSET
	AION_unset($database['T_BIBLE']); unset($database['T_BIBLE']); $database['T_BIBLE']=NULL;
	AION_unset($database); unset($database); $database=NULL;
	
	// XML LAYOUT AND VALIDATION
	$outxml = "bible_layout$destiny_READ.xml";
	$outlua = "bible_luachk$destiny_READ.lua";
	$outpdf = "$bible$destiny_READ.pdf";
	if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_BODY($versions,$forprint,$default,FALSE,'READ',$numarialfont,$outpdf))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
	if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }

	$outxml = "bible_layout$destiny_STUDY.xml";
	$outlua = "bible_luachk$destiny_STUDY.lua";
	$outpdf = "$bible$destiny_STUDY.pdf";
	if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_BODY($versions,$forprint,$default,FALSE,'STUDY',$numarialfont,$outpdf))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
	if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }

	$outxml = "bible_layout$destiny_EPUB.xml";
	$outlua = "bible_luachk$destiny_EPUB.lua";
	$outpdf = "$bible$destiny_EPUB.pdf";
	if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_EPUB($versions,$forprint,$default,FALSE,'EPUB',$numarialfont,$outpdf))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
	if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }
	
	$outxml = "bible_layout$destiny_POD_INTERIOR.xml";
	$outlua = "bible_luachk$destiny_POD_INTERIOR.lua";
	$outpdf = "$bible$destiny_POD_INTERIOR.pdf";
	if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_BODY($versions,$forprint,$default,FALSE,'POD',$numarialfont,$outpdf))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
	if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }
	$outxml = "bible_layout$destiny_POD_COVER.xml";
	$outlua = "bible_luachk$destiny_POD_COVER.lua";
	if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_COVR($versions,$forprint,$default,"$bible$destiny_POD_INTERIOR.pdf",FALSE,$numarialfont,NULL,NULL,FALSE))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
	if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }

	if (!empty($forprint['ISBNLU22'])) {
		$outxml = "bible_layout$destiny_POD_INTERIOR_22.xml";
		$outlua = "bible_luachk$destiny_POD_INTERIOR_22.lua";
		$outpdf = "$bible$destiny_POD_INTERIOR_22.pdf";
		if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_BODY($versions,$forprint,$default,'22 Book Digest, Special Edition','POD22',$numarialfont,$outpdf))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
		if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }
		$outxml = "bible_layout$destiny_POD_COVER_22.xml";
		$outlua = "bible_luachk$destiny_POD_COVER_22.lua";
		if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_COVR($versions,$forprint,$default,"$bible$destiny_POD_INTERIOR_22.pdf",'22 Book Digest, Special Edition',$numarialfont,NULL,NULL,FALSE))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
		if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }
	}
	
	if ($forprint['YESNEW']=="TRUE" || !empty($forprint['ISBNLUNT'])) {
		$outxml = "bible_layout$destiny_POD_INTERIOR_NT.xml";
		$outlua = "bible_luachk$destiny_POD_INTERIOR_NT.lua";
		$outpdf = "$bible$destiny_POD_INTERIOR_NT.pdf";
		if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_BODY($versions,$forprint,$default,'New Testament','NEW',$numarialfont,$outpdf))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
		if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }
		$outxml = "bible_layout$destiny_POD_COVER_NT.xml";
		$outlua = "bible_luachk$destiny_POD_COVER_NT.lua";
		if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_COVR($versions,$forprint,$default,"$bible$destiny_POD_INTERIOR_NT.pdf",'New Testament',$numarialfont,NULL,NULL,FALSE))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
		if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }
	}

	if (!empty($forprint['ISBNLU'])) {
		$forprint['ISBN'] = $forprint['ISBNLU'];
		$outxml = "bible_layout$destiny_POD_LULU.xml";
		$outlua = "bible_luachk$destiny_POD_LULU.lua";
		$outpdf = "$bible$destiny_POD_LULU.pdf";
		if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_COPY($versions,$forprint,$default,FALSE,$numarialfont))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
		if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }
		$outxml = "bible_layout$destiny_POD_COVER_LULU.xml";
		$outlua = "bible_luachk$destiny_POD_COVER_LULU.lua";
		$outisb = (filenotzero("../AB-ISBN/$bible$destiny_POD_COVER_LULU"."_ISBN.pdf") ? "$bible$destiny_POD_COVER_LULU"."_ISBN.pdf" : "ISBN.pdf" );
		if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_COVR($versions,$forprint,$default,"$bible$destiny_POD_INTERIOR.pdf",FALSE,$numarialfont,$outisb,'ISBNLU',FALSE))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
		if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }
	}

	if (!empty($forprint['ISBNLU22'])) {
		$forprint['ISBN'] = $forprint['ISBNLU22'];
		$outxml = "bible_layout$destiny_POD_LULU_22.xml";
		$outlua = "bible_luachk$destiny_POD_LULU_22.lua";
		$outpdf = "$bible$destiny_POD_LULU_22.pdf";
		if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_COPY($versions,$forprint,$default,'22 Book Digest, Special Edition',$numarialfont))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
		if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }
		$outxml = "bible_layout$destiny_POD_COVER_LULU_22.xml";
		$outlua = "bible_luachk$destiny_POD_COVER_LULU_22.lua";
		$outisb = (filenotzero("../AB-ISBN/$bible$destiny_POD_COVER_LULU_22"."_ISBN.pdf") ? "$bible$destiny_POD_COVER_LULU_22"."_ISBN.pdf" : "ISBN.pdf" );
		if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_COVR($versions,$forprint,$default,"$bible$destiny_POD_INTERIOR_22.pdf",'22 Book Digest, Special Edition',$numarialfont,$outisb,'ISBNLU22',FALSE))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
		if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }
	}
	
	if (!empty($forprint['ISBNLUNT'])) {
		$forprint['ISBN'] = $forprint['ISBNLUNT'];
		$outxml = "bible_layout$destiny_POD_LULU_NT.xml";
		$outlua = "bible_luachk$destiny_POD_LULU_NT.lua";
		$outpdf = "$bible$destiny_POD_LULU_NT.pdf";
		if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_COPY($versions,$forprint,$default,'New Testament',$numarialfont))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
		if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }
		$outxml = "bible_layout$destiny_POD_COVER_LULU_NT.xml";
		$outlua = "bible_luachk$destiny_POD_COVER_LULU_NT.lua";
		$outisb = (filenotzero("../AB-ISBN/$bible$destiny_POD_COVER_LULU_NT"."_ISBN.pdf") ? "$bible$destiny_POD_COVER_LULU_NT"."_ISBN.pdf" : "ISBN.pdf" );
		if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_COVR($versions,$forprint,$default,"$bible$destiny_POD_INTERIOR_NT.pdf",'New Testament',$numarialfont,$outisb,'ISBNLUNT',FALSE))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
		if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }
	}
	
	if (!empty($forprint['ISBNLUHARD'])) {
		$forprint['ISBN'] = $forprint['ISBNLUHARD'];		
		$outxml = "bible_layout$destiny_POD_LULU_HARD.xml";
		$outlua = "bible_luachk$destiny_POD_LULU_HARD.lua";
		$outpdf = "$bible$destiny_POD_LULU_HARD.pdf";
		if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_COPY($versions,$forprint,$default,FALSE,$numarialfont))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
		if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }
		$outxml = "bible_layout$destiny_POD_COVER_LULU_HARD.xml";
		$outlua = "bible_luachk$destiny_POD_COVER_LULU_HARD.lua";
		$outisb = (filenotzero("../AB-ISBN/$bible$destiny_POD_COVER_LULU_HARD"."_ISBN.pdf") ? "$bible$destiny_POD_COVER_LULU_HARD"."_ISBN.pdf" : "ISBN.pdf" );
		if (!file_put_contents($outxml,AION_LOOP_PDF_POD_LAYOUT_COVR($versions,$forprint,$default,"$bible$destiny_POD_INTERIOR.pdf",FALSE,$numarialfont,$outisb,'ISBNLUHARD',TRUE))) { AION_ECHO("ERROR! file_put_contents: $outxml"); }
		if (!file_put_contents($outlua,str_replace('XMLTOVALIDATE',$outxml,$lua))) { AION_ECHO("ERROR! file_put_contents: $outlua"); }
	}
	AION_ECHO("SPEEDATA $bible: LAYOUT CREATION SUCCESS!");

	// UNSET
	AION_unset($versions); unset($versions); $versions=NULL;
	AION_unset($default); unset($default); $default=NULL;
	
	// SCRIPT
	$SCRIPT = <<<EOT
#!/bin/bash
# AB-README_RUNME.sh
#
# DESCRIPTION:
# 	This script and associated data files produce high quality PDFS of the $bible
#	Developed and Coprighted by Nainoia Inc, PO Box 462, Bellefonte, PA 16823, (814) 470-8028, https://NAINOIA-INC.signedon.net
#	Copyright 2020, Creative Commons Attribution 4.0 International, https://creativecommons.org/licenses/by/4.0/
#
# OPERATION:
#	AB-README_RUNME.sh	`						// Help and cat the script
#	AB-README_RUNME.sh ALL						// Build all PDFs types
#	AB-README_RUNME.sh +PO +LU +NT +ON +OO +EP	// Build all selected type(s):  POD | LULU | NEW TESTAMENT | ONLINE | ONE-ONLINE | EPUB COVER
#
# FILETYPES:
#	[prefix].[suffix]							// Online cover page + interior
#	[prefix]---STUDY.[suffix]					// Online cover page + interior, wide margin study format
#	[prefix]---POD_KDP_ALL_BODY.[suffix]		// Print on demand interior for Amazon KDP specifications
#	[prefix]---POD_KDP_ALL_COVER.[suffix]		// Print on demand cover for Amazon KDP specifications
#	[prefix]---POD_KDP_X22_BODY.[suffix]		// Print on demand interior 22 books for Amazon KDP specifications
#	[prefix]---POD_KDP_X22_COVER.[suffix]		// Print on demand cover 22 books for Amazon KDP specifications
#	[prefix]---POD_KDP_NEW_BODY.[suffix]		// Print on demand interior New Testament for Amazon KDP specifications
#	[prefix]---POD_KDP_NEW_COVER.[suffix]		// Print on demand cover New Testament for Amazon KDP specifications
#	[prefix]---POD_LULU_ALL_BODY.[suffix]		// Print on demand interior paperback for LuLu specifications
#	[prefix]---POD_LULU_ALL_COVER.[suffix]		// Print on demand cover for LuLu specifications
#	[prefix]---POD_LULU_X22_BODY.[suffix]		// Print on demand interior 22 books paperback for LuLu specifications
#	[prefix]---POD_LULU_X22_COVER.[suffix]		// Print on demand cover 22 books for LuLu specifications
#	[prefix]---POD_LULU_NEW_BODY.[suffix]		// Print on demand interior paperback New Testament for LuLu specifications
#	[prefix]---POD_LULU_NEW_COVER.[suffix]		// Print on demand cover New Testament for LuLu specifications
#	[prefix]---POD_LULU_HAR_BODY.[suffix]		// Print on demand interior hardback for LuLu specifications
#	[prefix]---POD_LULU_HAR_COVER.[suffix]		// Print on demand cover hardback for LuLu specifications
#
error_exit()
{
	echo "\${1:-"Unknown Error"}" 1>&2
	exit 1
}
SPEED="$speed"

if [ "\$#" = "0" ] ; then echo "ERROR, NO ARGUMENTS `basename "$0"`, IN DIRECTORY `dirname "$0"` IN PWD `pwd`"; fi
name="$destiny_READ"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+ON}" != "\$@" ]] || [[ "\${@#+OO}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi
name="$destiny_STUDY"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+ON}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi
name="$destiny_EPUB"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+EP}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi

name="$destiny_POD_INTERIOR"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+PO}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi
name="$destiny_POD_COVER"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+PO}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE  --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi

name="$destiny_POD_INTERIOR_22"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+PO}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi
name="$destiny_POD_COVER_22"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+PO}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE  --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi

name="$destiny_POD_INTERIOR_NT"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+NT}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi
name="$destiny_POD_COVER_NT"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+NT}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE  --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi

name="$destiny_POD_LULU"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+LU}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi
name="$destiny_POD_COVER_LULU"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+LU}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE  --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi

name="$destiny_POD_LULU_22"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+LU}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi
name="$destiny_POD_COVER_LULU_22"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+LU}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE  --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi

name="$destiny_POD_LULU_NT"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+LU}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi
name="$destiny_POD_COVER_LULU_NT"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+LU}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE  --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi

name="$destiny_POD_LULU_HARD"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+LU}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi
name="$destiny_POD_COVER_LULU_HARD"
if ( [ "\$1" = "+ALL" ] || [[ "\${@#+LU}" != "\$@" ]] ) && [ -f bible_layout\$name.xml ] ; then \$SPEED --config $CONFIGFILE  --jobname=$bible\$name --filter=bible_luachk\$name.lua --layout=bible_layout\$name.xml || error_exit "ERROR $bible\$name.pdf"; fi

echo "SPEEDATA $bible: SCRIPT SUCCESS!"

EOT;
	$SCRIPTFILE = "./AB-README-RUNME.sh";
	if (!file_put_contents($SCRIPTFILE,$SCRIPT)) { AION_ECHO("ERROR! SPEEDATA file_put_contents: $SCRIPTFILE"); }
	if (!chmod($SCRIPTFILE, 0755)) { AION_ECHO("ERROR! SPEEDATA chmod: $SCRIPTFILE"); }
	AION_ECHO("SPEEDATA $bible: SCRIPT CREATION SUCCESS!");

	// RUN FLAGS
	$runflag = "";
	$runflag .= ($args['q_pdfall']	? " +ALL"	: "");
	$runflag .= ($args['q_pdfon']	? " +ON"	: "");
	$runflag .= ($args['q_pdfoo']	? " +OO"	: "");
	$runflag .= ($args['q_pdfpo']	? " +PO"	: "");
	$runflag .= ($args['q_pdfnt']	? " +NT"	: "");
	$runflag .= ($args['q_pdflu']	? " +LU"	: "");
	$runflag .= ($args['q_epubc']	? " +EP"	: "");
	// RUN
	$scripterr = FALSE;
	AION_ECHO("SPEEDATA $bible: running $SCRIPTFILE $runflag");
	if (!system($SCRIPTFILE.$runflag, $error)) { 																	AION_ECHO("WARN! $error SPEEDATA: $bible > $SCRIPTFILE $runflag");			$scripterr = TRUE; }
	AION_ECHO("SPEEDATA $bible: SCRIPT FINISHED!");
	
	// MOVE PDFS
	if ($args['q_pdfall'] || $args['q_pdfon']) {
		if (!rename("$bible$destiny_READ.pdf",					"../$bible$destiny_READ.pdf")) {					AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_READ.pdf");				$scripterr = TRUE; }
		if (!rename("$bible$destiny_STUDY.pdf",					"../$bible$destiny_STUDY.pdf")) {					AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_STUDY.pdf");				$scripterr = TRUE; }
	}
	else if ($args['q_pdfoo']) {
		if (!rename("$bible$destiny_READ.pdf",					"../$bible$destiny_READ.pdf")) {					AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_READ.pdf");				$scripterr = TRUE; }
	}
	if ($args['q_pdfall'] || $args['q_epubc']) {
		system("convert $bible$destiny_EPUB.pdf -resize 1707x2560 -sharpen 0x3 ../$bible$destiny_EPUB.jpg");
		if (!unlink("$bible$destiny_EPUB.pdf")) {																	AION_ECHO("WARN! SPEEDATA: unlink $bible$destiny_EPUB.pdf");				$scripterr = TRUE; }
	}
	if ($args['q_pdfall'] || $args['q_pdfpo']) {
		if (!rename("$bible$destiny_POD_INTERIOR.pdf",			"../$bible$destiny_POD_INTERIOR.pdf")) {			AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_INTERIOR.pdf");		$scripterr = TRUE; }
		if (!rename("$bible$destiny_POD_COVER.pdf",				"../$bible$destiny_POD_COVER.pdf")) {				AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_COVER.pdf");			$scripterr = TRUE; }
	}
	if (($args['q_pdfall'] || $args['q_pdfpo']) && !empty($forprint['ISBNLU22'])) {
		if (!rename("$bible$destiny_POD_INTERIOR_22.pdf",		"../$bible$destiny_POD_INTERIOR_22.pdf")) {			AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_INTERIOR_22.pdf");		$scripterr = TRUE; }
		if (!rename("$bible$destiny_POD_COVER_22.pdf",			"../$bible$destiny_POD_COVER_22.pdf")) {			AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_COVER_22.pdf");		$scripterr = TRUE; }
	}
	if (($args['q_pdfall'] || $args['q_pdfnt']) && ($forprint['YESNEW']=="TRUE" || !empty($forprint['ISBNLUNT']))) {
		if (!rename("$bible$destiny_POD_INTERIOR_NT.pdf",		"../$bible$destiny_POD_INTERIOR_NT.pdf")) {			AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_INTERIOR_NT.pdf");		$scripterr = TRUE; }
		if (!rename("$bible$destiny_POD_COVER_NT.pdf",			"../$bible$destiny_POD_COVER_NT.pdf")) {			AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_COVER_NT.pdf");		$scripterr = TRUE; }
	}
	if (($args['q_pdfall'] || $args['q_pdflu']) && !empty($forprint['ISBNLU'])) {
		if (!rename("$bible$destiny_POD_LULU.pdf",				"../$bible$destiny_POD_LULU.pdf")) {				AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_LULU.pdf");			$scripterr = TRUE; }
		if (!rename("$bible$destiny_POD_COVER_LULU.pdf",		"../$bible$destiny_POD_COVER_LULU.pdf")) {			AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_COVER_LULU.pdf");		$scripterr = TRUE; }
	}
	if (($args['q_pdfall'] || $args['q_pdflu']) && !empty($forprint['ISBNLU22'])) {
		if (!rename("$bible$destiny_POD_LULU_22.pdf",			"../$bible$destiny_POD_LULU_22.pdf")) {				AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_LULU_22.pdf");			$scripterr = TRUE; }
		if (!rename("$bible$destiny_POD_COVER_LULU_22.pdf",		"../$bible$destiny_POD_COVER_LULU_22.pdf")) {		AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_COVER_LULU_22.pdf");	$scripterr = TRUE; }
	}
	if (($args['q_pdfall'] || $args['q_pdflu']) && !empty($forprint['ISBNLUNT'])) {
		if (!rename("$bible$destiny_POD_LULU_NT.pdf",			"../$bible$destiny_POD_LULU_NT.pdf")) {				AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_LULU_NT.pdf");			$scripterr = TRUE; }
		if (!rename("$bible$destiny_POD_COVER_LULU_NT.pdf",		"../$bible$destiny_POD_COVER_LULU_NT.pdf")) {		AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_COVER_LULU_NT.pdf");	$scripterr = TRUE; }
	}
	if (($args['q_pdfall'] || $args['q_pdflu']) && !empty($forprint['ISBNLUHARD'])) {
		if (!rename("$bible$destiny_POD_LULU_HARD.pdf",			"../$bible$destiny_POD_LULU_HARD.pdf")) {			AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_LULU_HARD.pdf");		$scripterr = TRUE; }
		if (!rename("$bible$destiny_POD_COVER_LULU_HARD.pdf",	"../$bible$destiny_POD_COVER_LULU_HARD.pdf")) {		AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_COVER_LULU_HARD.pdf");	$scripterr = TRUE; }
	}
	
	// MOVE STATUS
	system("cat *.status > $bible.messages");	
	if (!rename("$bible.messages",								"../$bible.messages")) {							AION_ECHO("WARN! SPEEDATA: rename $bible.messages");						$scripterr = TRUE; }

	// CHANGE DIRECTORY
	if (!chdir('../')) { AION_ECHO("ERROR! chdir: ../"); }
	
	// CREATE LULU INTERIORS
	if (($args['q_pdfall'] || $args['q_pdflu']) && !empty($forprint['ISBNLU'])) {
		$output = $bible.$destiny_POD_LULU."_ISBN.pdf";
		system("pdftk A=$bible$destiny_POD_INTERIOR.pdf B=$bible$destiny_POD_LULU.pdf cat A1-3 B1 A5-end output $output");
		if (!rename("$output",									"$bible$destiny_POD_LULU.pdf")) {					AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_LULU.pdf");			$scripterr = TRUE; }
		if ($forprint['RTL']=='TRUE') {
			system("pdftk $bible$destiny_POD_LULU.pdf cat end-1 output $bible$destiny_POD_LULU.rev.pdf");
			if (!rename("$bible$destiny_POD_LULU.rev.pdf",		"$bible$destiny_POD_LULU.pdf")) {					AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_LULU.rev.pdf");		$scripterr = TRUE; }
		}
	}
	if (($args['q_pdfall'] || $args['q_pdflu']) && !empty($forprint['ISBNLU22'])) {
		$output = $bible.$destiny_POD_LULU_22."_ISBN.pdf";
		system("pdftk A=$bible$destiny_POD_INTERIOR_22.pdf B=$bible$destiny_POD_LULU_22.pdf cat A1-3 B1 A5-end output $output");
		if (!rename("$output",									"$bible$destiny_POD_LULU_22.pdf")) {				AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_LULU_22.pdf");			$scripterr = TRUE; }
		if ($forprint['RTL']=='TRUE') {
			system("pdftk $bible$destiny_POD_LULU_22.pdf cat end-1 output $bible$destiny_POD_LULU_22.rev.pdf");
			if (!rename("$bible$destiny_POD_LULU_22.rev.pdf",	"$bible$destiny_POD_LULU_22.pdf")) {				AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_LULU_22.rev.pdf");		$scripterr = TRUE; }
		}
	}
	if (($args['q_pdfall'] || $args['q_pdflu']) && !empty($forprint['ISBNLUNT'])) {
		$output = $bible.$destiny_POD_LULU_NT."_ISBN.pdf";
		system("pdftk A=$bible$destiny_POD_INTERIOR_NT.pdf B=$bible$destiny_POD_LULU_NT.pdf cat A1-3 B1 A5-end output $output");
		if (!rename("$output",									"$bible$destiny_POD_LULU_NT.pdf")) {				AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_LULU_NT.pdf");			$scripterr = TRUE; }
		if ($forprint['RTL']=='TRUE') {
			system("pdftk $bible$destiny_POD_LULU_NT.pdf cat end-1 output $bible$destiny_POD_LULU_NT.rev.pdf");
			if (!rename("$bible$destiny_POD_LULU_NT.rev.pdf",	"$bible$destiny_POD_LULU_NT.pdf")) {				AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_LULU_NT.rev.pdf");		$scripterr = TRUE; }
		}
	}
	if (($args['q_pdfall'] || $args['q_pdflu']) && !empty($forprint['ISBNLUHARD'])) {
		$output = $bible.$destiny_POD_LULU_HARD."_ISBN.pdf";
		system("pdftk A=$bible$destiny_POD_INTERIOR.pdf B=$bible$destiny_POD_LULU_HARD.pdf cat A1-3 B1 A5-end output $output");
		if (!rename("$output",									"$bible$destiny_POD_LULU_HARD.pdf")) {				AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_LULU_HARD.pdf");		$scripterr = TRUE; }
		if ($forprint['RTL']=='TRUE') {
			system("pdftk $bible$destiny_POD_LULU_HARD.pdf cat end-1 output $bible$destiny_POD_LULU_HARD.rev.pdf");
			if (!rename("$bible$destiny_POD_LULU_HARD.rev.pdf",	"$bible$destiny_POD_LULU_HARD.pdf")) {				AION_ECHO("WARN! SPEEDATA: rename $bible$destiny_POD_LULU_HARD.rev.pdf");	$scripterr = TRUE; }
		}
	}
	
	// CLEANUP
	AION_unset($forprint); unset($forprint); $forprint=NULL;
	
	// ZIP
	system("zip -r - $bible$destiny_SPEEDATA > $bible$destiny_SPEEDATA.zip");
	AION_ECHO("SPEEDATA $bible: ZIP SUCCESS!");
	system("rm -rf $bible$destiny_SPEEDATA");
	if ($scripterr) {	AION_ECHO("SPEEDATA $bible: FINAL ERROR"); }
	else {				AION_ECHO("SPEEDATA $bible: FINAL SUCCESS"); }
}


/*** LAYOUT POD */
function foreignlink($search,$replace,$replaceplus,$font,$langforeign,$langenglish,$text,$langspeed,$rtl) {
// add link	to foreign translation
$count = 0;
if (empty($langforeign) || $langforeign=='English') {
	$count = 1;
}
else if ($langforeign==$langenglish) {
	$text = preg_replace(
		'/(<Fontface fontfamily=\'FF-Pref\'><U><Value>AionianBible\.or)/',
		"<Fontface fontfamily='FF-Pre2'><Value>$langforeign</Value></Fontface><Fontface fontfamily='FF-Pref'><Value> at </Value></Fontface>$1",
		$text,-1,$count);
}
else if ($rtl=="TRUE") {
	$text = preg_replace('/^(<Paragraph )/',"$1 bidi='yes' direction='ltr' ",$text,-1,$count);
	if ($count!=1) { AION_ECHO("ERROR! Problem editing RTL header link: $langenglish $search count=$count"); }
	$count = 0;
	$text = preg_replace(
		'/(<Fontface fontfamily=\'FF-Pref\'><U><Value>AionianBible\.or)/',
		"<Span $langspeed><Fontface fontfamily='FF-Pre2'><Value> $langforeign </Value></Fontface></Span><Fontface fontfamily='FF-Pref'><Value> at </Value></Fontface>$1",
		$text,-1,$count);
}
else {
	$text = preg_replace(
		'/(<Fontface fontfamily=\'FF-Pref\'><U><Value>AionianBible\.or)/',
		"<Span $langspeed><Fontface fontfamily='FF-Pre2'><Value>$langforeign</Value></Fontface></Span><Fontface fontfamily='FF-Pref'><Value> at </Value></Fontface>$1",
		$text,-1,$count);
}
if ($count!=1) { AION_ECHO("ERROR! Problem editing header link: $langenglish $search count=$count"); }
// swap english page title with foreign
$count = 0;
if (empty($replace) || (empty($replaceplus) && $search==$replace)) {
	$count = 1;
}
else if ($search==$replace) {
	$text = preg_replace("#<Value>$search</Value><Br />#","<Value>$replace$replaceplus</Value><Br />",$text,1,$count);
}
else if ($font=='FOREIGN') {
	$text = preg_replace("#<Value>$search</Value><Br />#","<Span $langspeed><Fontface fontfamily='FF-HeaF'><Value>$replace$replaceplus</Value></Fontface></Span><Br />",$text,1,$count);
}
else {
	$text = preg_replace("#<Value>$search</Value><Br />#","<Span $langspeed><Value>$replace$replaceplus</Value></Span><Br />",$text,1,$count);
}
if ($count!=1) { AION_ECHO("ERROR! Problem editing header:  $langenglish $search count=$count"); }
return $text;
}
function hyperlink(&$text, $notedlink="") {
	$text = preg_replace("#<U><Value>eBible.or</Value></U><Value>g</Value>#",
		"<A href='https://ebible.org'><U><Value>eBible.or</Value></U><Value>g</Value></A>", $text);
	$text = preg_replace("#<U><Value>unbound.Biola.edu</Value></U>#",
		"<A href='https://unbound.biola.edu'><U><Value>unbound.Biola.edu</Value></U></A>", $text);
	$text = preg_replace("#<U><Value>Crosswire.or</Value></U><Value>g</Value>#",
		"<A href='https://crosswire.org'><U><Value>Crosswire.or</Value></U><Value>g</Value></A>", $text);
	$text = preg_replace("#<U><Value>NHEB.net</Value></U>#",
		"<A href='https://nheb.net/'><U><Value>NHEB.net</Value></U></A>", $text);
	$text = preg_replace("#<U><Value>Bible4u.net</Value></U>#",
		"<A href='https://bible4u.net/'><U><Value>Bible4u.net</Value></U></A>", $text);
	$text = preg_replace("#<U><Value>creativecommons.or</Value></U><Value>g</Value><U><Value>/licenses/b</Value></U><Value>y</Value><U><Value>/4.0</Value></U>#",
		"<A href='https://creativecommons.org/licenses/by/4.0/'><U><Value>creativecommons.or</Value></U><Value>g</Value><U><Value>/licenses/b</Value></U><Value>y</Value><U><Value>/4.0</Value></U></A>", $text);
	// extra space added BELOW to prevent overlap replace
	$text = preg_replace("#<U><Value>AionianBible.or</Value></U><Value>g</Value><U><Value>/History</Value></U>#",
		"<A href='https://www.AionianBible.org/History'><U> <Value>AionianBible.or</Value></U><Value>g</Value><U><Value>/History</Value></U></A>", $text);
	$text = preg_replace("#<U><Value>AionianBible.or</Value></U><Value>g</Value><U><Value>/Preface</Value></U>#",
		"<A href='https://www.AionianBible.org/Preface'><U> <Value>AionianBible.or</Value></U><Value>g</Value><U><Value>/Preface</Value></U></A>", $text);
	$text = preg_replace("#<U><Value>AionianBible.or</Value></U><Value>g</Value><U><Value>/Aionios-and-Aidios</Value></U>#",
		"<A href='https://www.AionianBible.org/Aionios-and-Aidios'><U> <Value>AionianBible.or</Value></U><Value>g</Value><U><Value>/Aionios-and-Aidios</Value></U></A>", $text);
	$text = preg_replace("#<U><Value>AionianBible.or</Value></U><Value>g</Value><U><Value>/Readers-Guide</Value></U>#",
		"<A href='https://www.aionianbible.org/Readers-Guide'><U> <Value>AionianBible.or</Value></U><Value>g</Value><U><Value>/Readers-Guide</Value></U></A>", $text);
	$text = preg_replace("#<U><Value>AionianBible.or</Value></U><Value>g</Value><U><Value>/Glossar</Value></U><Value>y</Value>#",
		"<A href='https://www.aionianbible.org/Glossary'><U> <Value>AionianBible.or</Value></U><Value>g</Value><U><Value>/Glossar</Value></U><Value>y</Value></A>", $text);
	if (!empty($notedlink)) {
		$text = preg_replace("#<U><Value>AionianBible.or</Value></U><Value>g</Value><U><Value>/Bibles/English---Aionian-Bible/Noted</Value></U>#",
			"<A href='$notedlink'><U ><Value>AionianBible.or</Value></U><Value>g</Value><U><Value>/Bibles/English---Aionian-Bible/Noted</Value></U></A>", $text);
	}
	$text = preg_replace("#<U><Value>AionianBible.or</Value></U><Value>g</Value><U><Value>/Destiny</Value></U>#",
		"<A href='https://www.AionianBible.org/Destiny'><U> <Value>AionianBible.or</Value></U><Value>g</Value><U><Value>/Destiny</Value></U></A>", $text);
	// extra space added in all the ABOVE to prevent overlap replace following
	$text = preg_replace("#<U><Value>AionianBible.or</Value></U><Value>g</Value>#",
		"<A href='https://www.AionianBible.org'><U><Value>AionianBible.or</Value></U><Value>g</Value></A>", $text);
}


function AION_LOOP_PDF_POD_LAYOUT_BODY($versions,$forprint,$default,$newtonly,$format,$numarialfont,$outpdf) {
global $speedata_version;
// settings	
$langforeign= (!empty($versions['LANGUAGE'])		? trim($versions['LANGUAGE']): NULL						);
$langenglish= (!empty($versions['LANGUAGEENGLISH'])	? trim($versions['LANGUAGEENGLISH']): NULL				);
$language	= trim(!empty($forprint['LANGUAGE'])	? $forprint['LANGUAGE']		: $default['LANGUAGE']		);
$langspeed	= trim(!empty($forprint['LANGSPEED'])	? "language='".$forprint['LANGSPEED']."'"	: ""		);
$langchap	= trim(!empty($forprint['LANGCHAP'])	? "language='".$forprint['LANGCHAP']."'"	: ""		);
$yesnew		= trim(!empty($forprint['YESNEW'])		? $forprint['YESNEW']		: $default['YESNEW']		);
$rtl		= trim(!empty($forprint['RTL'])			? $forprint['RTL']			: $default['RTL']			);
$column1	= trim(!empty($forprint['COLUMN1'])		? $forprint['COLUMN1']		: NULL						);
$studwide	= trim(!empty($forprint['STUDWIDE'])	? $forprint['STUDWIDE']		: NULL						);
$font		= trim(!empty($forprint['FONT'])		? $forprint['FONT']			: $default['FONT']			);
$bsize		= trim(!empty($forprint['BSIZE'])		? $forprint['BSIZE']		: $default['BSIZE']			);
$bleading	= trim(!empty($forprint['BLEADING'])	? $forprint['BLEADING']		: $default['BLEADING']		);
$tsize		= trim(!empty($forprint['TSIZE'])		? $forprint['TSIZE']		: $default['TSIZE']			);
$tleading	= trim(!empty($forprint['TLEADING'])	? $forprint['TLEADING']		: $default['TLEADING']		);
$rsize		= trim(!empty($forprint['RSIZE'])		? $forprint['RSIZE']		: $default['RSIZE']			);
$rleading	= trim(!empty($forprint['RLEADING'])	? $forprint['RLEADING']		: $default['RLEADING']		);

/* FONT / LEADING 

Setting the font and leading size for the body text is a challenge because the different languages and glyphs
require different font and leading size ratios for proper display and also because Amazon and Lulu have a hard
limit of 800 pages for printed books. So it is a challenge for some texts especially to maximize font and leading 
size for readability and stay under 800 pages. Originally I had one font and leading size specified for each translation
regardless of the PDF type, whether the online PDF, the study PDF, the POD PDF, or the NT POD PDF. This was simple 
but compromised readability for the online PDF, the study PDF, and the NT POD PDF

Then I increased the font size and also the leading ratio for the study PDF with additional values in FORPRINT 
to allow for better note taking with a taller line height.

Now most recently I also programmatically increased the font and leading for the online PDF, the study PDF, and
the NT POD PDF. However the POD PDF remains exactly as specified in the input.  In a nutshell if the font is < 9.0
I increase to 9.0 as a minimum, except for the Kannada and Myanmar language. See below. And I also
increase the leading by 10%, but again not for the POD PDF.

This allows us to increase font and leading size for the PDF types where the 800 page maximum is not a concern.
This also brings a curious question. In the case when the translation is OT or NT or partial books and there is
not a NT POD PDF, but only a POD PDF, then in this case the font and leading are not programmatically increased
but only the online PDF and the study PDF are increased. This does seem inconsistent and probably is, though the
POD PDF font and leading is explicitly set at a readable level in FORPRINT. I guess we could argue that there is
reason to keep the POD PDF smaller than the online and study PDF in order to keep page counts down and price down
whereas there is no reason to spare pages for the online PDF and the study PDF and readability is the only concern.

*/
if ($format=='STUDY') {
	$size	= trim(!empty($forprint['SIZEST'])		? $forprint['SIZEST']		: $default['SIZEST']		);
	$leading= trim(!empty($forprint['LEADINGST'])	? $forprint['LEADINGST']	: $default['LEADINGST']		);
}
else if ($format!='POD') {
	$size	= $size2	= trim(!empty($forprint['SIZE'])	? $forprint['SIZE']		: $default['SIZE']		);
	$leading= $leading2	= trim(!empty($forprint['LEADING'])	? $forprint['LEADING']	: $default['LEADING']	);
	$ratio	= ((float)$leading / (float)$size) * 1.1; // 10% increase in non-POD leading
	$newsize=
		("Holy-Bible---Myanmar---Burmese-Common-Bible" == $versions['BIBLE']	? 6.6 : 
		(preg_match("/Holy-Bible---(Kannada|Myanmar)/u", $versions['BIBLE'])	? 8.4 : 9.0)); // exceptions for Kannada and Myanmar
	if ((float)$size < $newsize) { $size = sprintf("%.1f", $newsize); }
	$leading = number_format( ceil((float)$size * $ratio * 100) / 100, 2); // calculate new leading from previous leading ratio
	AION_ECHO("JEFF NOTICE! SIZE/LEADING was $size2/$leading2 now $size/$leading");
}
else {
	$size	= trim(!empty($forprint['SIZE'])		? $forprint['SIZE']			: $default['SIZE']			);
	$leading= trim(!empty($forprint['LEADING'])		? $forprint['LEADING']		: $default['LEADING']		);
}
$footsize	= trim(!empty($forprint['FOOTSIZE'])	? $forprint['FOOTSIZE']		: $default['FOOTSIZE']		);
$backvl		= trim(!empty($forprint['BACKVL'])		? $forprint['BACKVL']		: $default['BACKVL']		);
$backtl		= trim(!empty($forprint['BACKTL'])		? $forprint['BACKTL']		: $default['BACKTL']		);
$backal		= trim(!empty($forprint['BACKAL'])		? $forprint['BACKAL']		: $default['BACKAL']		);
$backll		= trim(!empty($forprint['BACKLL'])		? $forprint['BACKLL']		: $default['BACKLL']		);
$headfont	= trim(!empty($forprint['HEADFONT'])	? $forprint['HEADFONT']		: $default['HEADFONT']		);
$pixtext	= trim(!empty($forprint['PIXTEXT'])		? $forprint['PIXTEXT']		: $default['PIXTEXT']		);
$pixlead	= trim(!empty($forprint['PIXLEAD'])		? $forprint['PIXLEAD']		: $default['PIXLEAD']		);
$copyff		= trim(!empty($forprint['COPYFF'])		? $forprint['COPYFF']		: $default['COPYFF']		);
$versionff	= trim(!empty($forprint['VERSIONFF'])	? $forprint['VERSIONFF']	: $default['VERSIONFF']		);
// text
$version	= (!empty($forprint['VERSION'])			? $forprint['VERSION']		: $default['VERSION']		); // no trim here to allow for spaces in Tamil version name
$versionE	= trim(!empty($forprint['VERSIONE'])	? $forprint['VERSIONE']		: $default['VERSIONE']		);
$isbn		= trim(!empty($forprint['ISBN'])		? $forprint['ISBN']			: ''						);
$extension	= trim(!empty($forprint['EXTENSION'])	? "true()"					: "false()"					);
$keizer		= trim(!empty($forprint['KEIZER'])		? "true()"					: "false()"					);
$history	= trim(!empty($forprint['HIST'])		? $forprint['HIST']			: $default['HIST']			);
$pref		= trim(!empty($forprint['PREF'])		? $forprint['PREF']			: $default['PREF']			);
$pref2		= trim(!empty($forprint['PREF2'])		? $forprint['PREF2']		: $default['PREF2']			);
$read		= trim(!empty($forprint['READ'])		? $forprint['READ']			: $default['READ']			);
$glos1		= trim(!empty($forprint['GLOS1'])		? $forprint['GLOS1']		: $default['GLOS1']			);
$glos2		= trim(!empty($forprint['GLOS2'])		? $forprint['GLOS2']		: $default['GLOS2']			);
$glos3		= trim(!empty($forprint['GLOS3'])		? $forprint['GLOS3']		: $default['GLOS3']			);
$loff		= trim(!empty($forprint['LOF'])			? $forprint['LOF']			: $default['LOF']			);
// words
$w_font		= trim(!empty($forprint['W_FONT'])		? $forprint['W_FONT']		: $default['W_FONT']		);
$w_hist		= trim(!empty($forprint['W_HIST'])		? $forprint['W_HIST']		: $default['W_HIST']		);
$w_pref		= trim(!empty($forprint['W_PREF'])		? $forprint['W_PREF']		: $default['W_PREF']		);
$w_old		= trim(!empty($forprint['W_OLD'])		? $forprint['W_OLD']		: $default['W_OLD']			);
$w_new		= trim(!empty($forprint['W_NEW'])		? $forprint['W_NEW']		: $default['W_NEW']			);
$w_toc		= trim(!empty($forprint['W_TOC'])		? $forprint['W_TOC']		: $default['W_TOC']			);
$w_apdx		= trim(!empty($forprint['W_APDX'])		? $forprint['W_APDX']		: $default['W_APDX']		);
$w_read		= trim(!empty($forprint['W_READ'])		? $forprint['W_READ']		: $default['W_READ']		);
$w_glos		= trim(!empty($forprint['W_GLOS'])		? $forprint['W_GLOS']		: $default['W_GLOS']		);
$w_map		= trim(!empty($forprint['W_MAP'])		? $forprint['W_MAP']		: $default['W_MAP']			);
$w_ilus		= trim(!empty($forprint['W_ILUS'])		? $forprint['W_ILUS']		: $default['W_ILUS']		);
$w_dest		= trim(!empty($forprint['W_DESTINY'])	? $forprint['W_DESTINY']	: $default['W_DESTINY']		);
$w_life		= trim(!empty($forprint['W_LIFE'])		? $forprint['W_LIFE']		: $default['W_LIFE']		);
$w_lifex	= trim(!empty($forprint['W_LIFEX'])		? $forprint['W_LIFEX']		: $default['W_LIFEX']		);
$w_worl		= trim(!empty($forprint['W_WORL'])		? $forprint['W_WORL']		: $default['W_WORL']		);
$w_free		= trim(!empty($forprint['W_FREE'])		? $forprint['W_FREE']		: $default['W_FREE']		);
$w_aka		= trim(!empty($forprint['W_AKA'])		? $forprint['W_AKA']		: $default['W_AKA']			);
$w_purp		= trim(!empty($forprint['W_PURP'])		? $forprint['W_PURP']		: $default['W_PURP']		);
$w_nudge	= trim(!empty($forprint['W_NUDGE'])		? $forprint['W_NUDGE']		: $default['W_NUDGE']		);
// RTL EXTRAS
$bidi_plain	= ($rtl=="TRUE" ? 'bidi="yes"' : '' );
$bidi_center= ($rtl=="TRUE" ? 'bidi="yes" direction="rtl"' : '' );
$bidi_right	= ($rtl=="TRUE" && !empty($w_free.$w_aka) ? 'bidi="yes" direction="rtl"' : '' ); // very kludgey thing to do, but RTL bibles with default English free and aka must set this to ''
$bidi_table	= ($rtl=="TRUE" ? 'bidi="yes" direction="rtl"' : '' );
$bidi_bible	= ($rtl=="TRUE" ? 'bidi="yes" direction="rtl"' : '' );
$bidi_3col	= ($rtl=="TRUE" ? 'bidi="yes" direction="rtl"' : '' );
$rtlcols	= ($rtl=="TRUE" ? 'columnordering="rtl"' : '' );
$rtlinit	= ($rtl=="TRUE" ? 'true()' : 'false()' );
$rtlbook	= ($rtl=="TRUE" ? 'right' : 'left' );
// bookmarks
$bm_old		= str_replace("'","’",(empty($w_old) ? "OLD TESTAMENT" : $w_old));
$bm_new		= str_replace("'","’",(empty($w_new) ? "NEW TESTAMENT" : $w_new));
$bm_hist	= str_replace("'","’",$w_hist);
$bm_pref	= str_replace("'","’",$w_pref);
$bm_toc		= str_replace("'","’",(empty($w_toc) ? "Table of Contents" : $w_toc));
$bm_apdx	= str_replace("'","’",$w_apdx);
$bm_read	= str_replace("'","’",$w_read);
$bm_glos	= str_replace("'","’",$w_glos);
$bm_map		= str_replace("'","’",$w_map);
$bm_loff	= str_replace("'","’",$w_dest);
// verses
$v_font		= trim(!empty($forprint['V_FONT'])		? $forprint['V_FONT']		: $default['V_FONT']		);
$joh3_16	= trim(!empty($forprint['JOH3_16'])		? $forprint['JOH3_16']		: $default['JOH3_16']		);
$gen3_24	= trim(!empty($forprint['GEN3_24'])		? $forprint['GEN3_24']		: $default['GEN3_24']		);
$luk23_34	= trim(!empty($forprint['LUK23_34'])	? $forprint['LUK23_34']		: $default['LUK23_34']		);
$rev21_2_3	= trim(!empty($forprint['REV21_2_3'])	? $forprint['REV21_2_3']	: $default['REV21_2_3']		);
$heb11_8	= trim(!empty($forprint['HEB11_8'])		? $forprint['HEB11_8']		: $default['HEB11_8']		);
$exo13_17	= trim(!empty($forprint['EXO13_17'])	? $forprint['EXO13_17']		: $default['EXO13_17']		);
$mar10_45	= trim(!empty($forprint['MAR10_45'])	? $forprint['MAR10_45']		: $default['MAR10_45']		);
$rom1_1		= trim(!empty($forprint['ROM1_1'])		? $forprint['ROM1_1']		: $default['ROM1_1']		);
$mat28_19	= trim(!empty($forprint['MAT28_19'])	? $forprint['MAT28_19']		: $default['MAT28_19']		);
// references
if ($language=="Hebrew") {
	$front = "</Value><Span language='English (USA)'><Fontface fontfamily='FF-Pixt'><Value> ) </Value></Fontface></Span><Value>";
	$back   = "</Value><Span language='English (USA)'><Fontface fontfamily='FF-Pixt'><Value> ( </Value></Fontface></Span><Value>";
	$backot = "</Value><Span language='English (USA)'><Fontface fontfamily='FF-Pixt'><Value> ( </Value></Fontface></Span><Value>";
	$joh3_16_b	= $front.trim($forprint['JOH3_16_B'])	.$back;
	$gen3_24_b	= $front.trim($forprint['GEN3_24_B'])	.$backot;
	$luk23_34_b	= $front.trim($forprint['LUK23_34_B'])	.$back;
	$rev21_2_3_b= $front.trim($forprint['REV21_2_3_B'])	.$back;
	$heb11_8_b	= $front.trim($forprint['HEB11_8_B'])	.$back;
	$exo13_17_b	= $front.trim($forprint['EXO13_17_B'])	.$backot;
	$mar10_45_b	= $front.trim($forprint['MAR10_45_B'])	.$back;
	$rom1_1_b	= $front.trim($forprint['ROM1_1_B'])	.$back;
	$mat28_19_b	= $front.trim($forprint['MAT28_19_B'])	.$back;
}
else {
	$joh3_16_b	= trim(!empty($forprint['JOH3_16_B'])	? $forprint['JOH3_16_B']	: $default['JOH3_16_B']		);
	$gen3_24_b	= trim(!empty($forprint['GEN3_24_B'])	? $forprint['GEN3_24_B']	: $default['GEN3_24_B']		);
	$luk23_34_b	= trim(!empty($forprint['LUK23_34_B'])	? $forprint['LUK23_34_B']	: $default['LUK23_34_B']	);
	$rev21_2_3_b= trim(!empty($forprint['REV21_2_3_B'])	? $forprint['REV21_2_3_B']	: $default['REV21_2_3_B']	);
	$heb11_8_b	= trim(!empty($forprint['HEB11_8_B'])	? $forprint['HEB11_8_B']	: $default['HEB11_8_B']		);
	$exo13_17_b	= trim(!empty($forprint['EXO13_17_B'])	? $forprint['EXO13_17_B']	: $default['EXO13_17_B']	);
	$mar10_45_b	= trim(!empty($forprint['MAR10_45_B'])	? $forprint['MAR10_45_B']	: $default['MAR10_45_B']	);
	$rom1_1_b	= trim(!empty($forprint['ROM1_1_B'])	? $forprint['ROM1_1_B']		: $default['ROM1_1_B']		);
	$mat28_19_b	= trim(!empty($forprint['MAT28_19_B'])	? $forprint['MAT28_19_B']	: $default['MAT28_19_B']	);
}
// cover words
$w_worl	=
	($w_font=='FOREIGN' && !empty($w_worl)
	? "<Span $langspeed><Fontface fontfamily='FF-BteF'><Value>$w_worl</Value></Fontface></Span>"
	: (!empty($w_worl)
	? "<Span $langspeed><Value>$w_worl</Value></Span>"
	: "<Span language='English (USA)'><Value>The world’s first Holy Bible untranslation</Value></Span>"));
$w_free	=
	($w_font=='FOREIGN' && !empty($w_free)
	? "<Span $langspeed><Fontface fontfamily='FF-BteF'><Value>$w_free</Value></Fontface></Span>"
	: (!empty($w_free)
	? "<Span $langspeed><Value>$w_free</Value></Span>"
	: "<Span language='English (USA)'><Value>100% free to copy and print</Value></Span>"));
$w_akaEng = FALSE;
$w_aka	=
	($w_font=='FOREIGN' && !empty($w_aka)
	? "<Span $langspeed><Fontface fontfamily='FF-BteF'><Value>$w_aka</Value></Fontface></Span>"
	: (!empty($w_aka)
	? "<Span $langspeed><Value>$w_aka</Value></Span>"
	: ($w_akaEng="<Span language='English (USA)'><Value>also known as</Value></Span>")));	
$w_purp	=
	($w_purp=="SKIP"
	? ""
	: ($rtl=='TRUE' && !empty($w_purp)
	? "<Span language='English (USA)'><Value> \" </Value></Span><Span $langspeed><Fontface fontfamily='FF-BteF'><Value>$w_purp</Value></Fontface></Span><Span language='English (USA)'><Value> \" </Value></Span>"
	: ($w_font=='FOREIGN' && !empty($w_purp)
	? "<Span language='English (USA)'><Value> “ </Value></Span><Span $langspeed><Fontface fontfamily='FF-BteF'><Value>$w_purp</Value></Fontface></Span><Span language='English (USA)'><Value> ”</Value></Span>"
	: (!empty($w_purp)
	? "<Span language='English (USA)'><Value> “ </Value></Span><Span $langspeed><Value>$w_purp</Value></Span><Span language='English (USA)'><Value> ”</Value></Span>"
	: "<Span language='English (USA)'><Value> “ The Purple Bible ”</Value></Span>"))));
$w_akapurp = (empty($w_purp) ? $w_aka : "$w_aka<Value> </Value>$w_purp");
// arial font for numbers, percents, hyphen, space
if ($w_font=='FOREIGN' && (!($w_free=preg_replace("/([\-0-9:% ]{3,})/","</Value><Span language='English (USA)'><Fontface fontfamily='FF-Btex'><Value> $1 </Value></Fontface></Span><Value>",$w_free,-1,$count)) || $count>1)) { AION_ECHO("JEFF NOTICE! preg_replace(numbers)"); }
// fix the preface and other headers
$history	= foreignlink($default['W_HIST'],	$w_hist,	"",		$w_font,	$langforeign,	$langenglish,	$history,	$langspeed, $rtl);
$pref		= foreignlink($default['W_PREF'],	$w_pref,	"",		$w_font,	$langforeign,	$langenglish,	$pref,		$langspeed, $rtl);
$read		= foreignlink($default['W_READ'],	$w_read,	"",		$w_font,	$langforeign,	$langenglish,	$read,		$langspeed, $rtl);
$glos1		= foreignlink($default['W_GLOS'],	$w_glos,	"",		$w_font,	$langforeign,	$langenglish,	$glos1,		$langspeed, $rtl);
$glos3		= foreignlink($default['W_GLOS'],	$w_glos,	" +",	$w_font,	"",				$langenglish,	$glos3,		$langspeed, $rtl);
$loff		= foreignlink($default['W_DESTINY'],$w_dest,	"",		$w_font,	$langforeign,	$langenglish,	$loff,		$langspeed, $rtl);
// add the PDF hyperlinks
$bibleurl = preg_replace("/Holy-Bible---/","",$versions['BIBLE']);
$link_tor = "<Value>TOR Anonymously</Value><Br />";
$link_ab = "<U><Value>https://AionianBible.or</Value></U><Value>g</Value>";
$link_na = "<U><Value>https://Nainoia-Inc.si</Value></U><Value>g</Value><U><Value>nedon.net</Value></U>";
$link_tr = "<U><Value>https://AionianBible.or</Value></U><Value>g</Value><U><Value>/Third-Part</Value></U><Value>y</Value><U><Value>-Publisher-Resources</Value></U>";
if (($format=="READ" || $format=="STUDY")) {
	hyperlink($history);
	hyperlink($pref);
	hyperlink($pref2);
	hyperlink($read);
	hyperlink($glos1);
	hyperlink($glos3,"https://www.AionianBible.org/Bibles/$bibleurl/Noted");
	hyperlink($loff);
	$link_tor = "<A href='https://www.AionianBible.org/TOR'><U><Value>TOR Anonymousl</Value></U><Value>y</Value></A><Br />";
	$link_ab = "<A href='https://www.AionianBible.org'><U><Value>https://AionianBible.or</Value></U><Value>g</Value></A>";
	$link_na = "<A href='https://nainoia-inc.signedon.net'><U><Value>https://Nainoia-Inc.si</Value></U><Value>g</Value><U><Value>nedon.net</Value></U></A>";
	$link_tr = "<A href='https://nainoia-inc.signedon.net'><U><Value>https://AionianBible.or</Value></U><Value>g</Value><U><Value>/Third-Part</Value></U><Value>y</Value><U><Value>-Publisher-Resources</Value></U></A>";
}
// adjust the Glossary Noted url
if (!($glos3=preg_replace("#<Value>/Bibles/English---Aionian-Bible/Noted#","<Value>/Bibles/$bibleurl/Noted",$glos3,-1,$count)) || $count!=1) { AION_ECHO("ERROR! $bible: Glossary + preg_replace()"); }
// old and new testament fonts
$w_old2 =
	(!empty($w_old) && $w_font=='FOREIGN'
	? "<Span $langspeed><Fontface fontfamily='FF-TocF'><Value>$w_old</Value></Fontface></Span>"
	: (!empty($w_old)
	? "<Span $langspeed><Fontface fontfamily='FF-TocF'><Value>$w_old</Value></Fontface></Span>"
	: "<Span language='English (USA)'><Fontface fontfamily='FF-Toc2'><Value>OLD TESTAMENT</Value></Fontface></Span>"));
$w_old =
	(!empty($w_old) && $w_font=='FOREIGN'
	? "<Span $langspeed><Fontface fontfamily='FF-HeaF'><Value>$w_old</Value></Fontface></Span>"
	: (!empty($w_old)
	? "<Span $langspeed><Fontface fontfamily='FF-HeaF'><Value>$w_old</Value></Fontface></Span>"
	: "<Span language='English (USA)'><Fontface fontfamily='FF-Head'><Value>OLD TESTAMENT</Value></Fontface></Span>"));
$w_new2 =
	(!empty($w_new) && $w_font=='FOREIGN'
	? "<Span $langspeed><Fontface fontfamily='FF-TocF'><Value>$w_new</Value></Fontface></Span>"
	: (!empty($w_new)
	? "<Span $langspeed><Fontface fontfamily='FF-TocF'><Value>$w_new</Value></Fontface></Span>"
	: "<Span language='English (USA)'><Fontface fontfamily='FF-Toc2'><Value>NEW TESTAMENT</Value></Fontface></Span>"));
$w_new =
	(!empty($w_new) && $w_font=='FOREIGN'
	? "<Span $langspeed><Fontface fontfamily='FF-HeaF'><Value>$w_new</Value></Fontface></Span>"
	: (!empty($w_new)
	? "<Span $langspeed><Fontface fontfamily='FF-HeaF'><Value>$w_new</Value></Fontface></Span>"
	: "<Span language='English (USA)'><Fontface fontfamily='FF-Head'><Value>NEW TESTAMENT</Value></Fontface></Span>"));
$w_toc =
	(!empty($w_toc) && $w_font=='FOREIGN'
	? "<Span $langspeed><Fontface fontfamily='FF-HeaF'><Value>$w_toc</Value></Fontface></Span>"
	: (!empty($w_toc)
	? "<Span $langspeed><Fontface fontfamily='FF-HeaF'><Value>$w_toc</Value></Fontface></Span>"
	: "<Span language='English (USA)'><Fontface fontfamily='FF-Head'><Value>Table of Contents</Value></Fontface></Span>"));
// toc appendix
if ($w_apdx == $default['W_APDX']) {
	$w_app = "<Span language='English (USA)'><B><Value>$w_apdx</Value></B><Br /><Value>$w_read</Value><Br /><Value>$w_glos</Value><Br /><Value>$w_map</Value><Br /><Value>$w_dest</Value><Br /><Value>$w_ilus, Doré</Value></Span>";
}
else if ($rtl=="TRUE") {
	$w_app = "<Span $langspeed><Fontface fontfamily='FF-TocF'><B><Value>$w_apdx</Value></B><Br /><Value>$w_read</Value><Br /><Value>$w_glos</Value><Br /><Value>$w_map</Value><Br /><Value>$w_dest</Value><Br /><Value>$w_ilus</Value></Fontface></Span><Span language='English (USA)'><Value> Doré </Value></Span>";
}
else if ($w_font=='FOREIGN') {
	$w_app = "<Span $langspeed><Fontface fontfamily='FF-TocF'><B><Value>$w_apdx</Value></B><Br /><Value>$w_read</Value><Br /><Value>$w_glos</Value><Br /><Value>$w_map</Value><Br /><Value>$w_dest</Value><Br /><Value>$w_ilus</Value></Fontface></Span><Span language='English (USA)'><Value>, Doré</Value></Span>";
}
else {
	$w_app = "<Span $langspeed><B><Value>$w_apdx</Value></B><Br /><Value>$w_read</Value><Br /><Value>$w_glos</Value><Br /><Value>$w_map</Value><Br /><Value>$w_dest</Value><Br /><Value>$w_ilus</Value></Span><Span language='English (USA)'><Value>, Doré</Value></Span>";
}
// fix pix verses
$gen3_24 =
	($v_font=='FOREIGN' && !empty($gen3_24)
	? "<Paragraph $langspeed textformat='center' fontfamily='FF-PixF' $bidi_center><I><Value>$gen3_24</Value></I><Br /><Value>$gen3_24_b</Value></Paragraph>"
	: (!empty($gen3_24) && $language
	? "<Paragraph $langspeed textformat='center' fontfamily='FF-Pixt' $bidi_center><I><Value>$gen3_24</Value></I><Br /><Value>$gen3_24_b</Value></Paragraph>"
	: (!empty($gen3_24)
	? "<Paragraph language='English (USA)' textformat='center' fontfamily='FF-Pixx'><B><Value>Adam and Eve Driven Out of the Garden of Eden</Value></B></Paragraph><Paragraph textformat='center' fontfamily='FF-Pixt'><I><Value>$gen3_24</Value></I><Br /><Value>$gen3_24_b</Value></Paragraph>"
	: "<Paragraph language='English (USA)' textformat='center' fontfamily='FF-Pixx'><B><Value>Adam and Eve Driven Out of the Garden of Eden</Value></B></Paragraph><Paragraph textformat='center' fontfamily='FF-Pixt'><I><Value>“So he drove out the man; and he placed cherubim at the east of the garden of Eden,</Value><Br /><Value>and a flaming sword which turned every way, to guard the way to the tree of life.”</Value></I><Br /><Value>Genesis 3:24</Value></Paragraph>")));

$luk23_34 = 
	($v_font=='FOREIGN' && !empty($luk23_34)
	? "<Paragraph $langspeed textformat='center' fontfamily='FF-PixF' $bidi_center><I><Value>$luk23_34</Value></I><Br /><Value>$luk23_34_b</Value></Paragraph>"
	: (!empty($luk23_34) && $language
	? "<Paragraph $langspeed textformat='center' fontfamily='FF-Pixt' $bidi_center><I><Value>$luk23_34</Value></I><Br /><Value>$luk23_34_b</Value></Paragraph>"
	: (!empty($luk23_34)
	? "<Paragraph language='English (USA)' textformat='center' fontfamily='FF-Pixx'><B><Value>The Crucifixion</Value></B></Paragraph><Paragraph textformat='center' fontfamily='FF-Pixt'><I><Value>$luk23_34</Value></I><Br /><Value>$luk23_34_b</Value></Paragraph>"
	: "<Paragraph language='English (USA)' textformat='center' fontfamily='FF-Pixx'><B><Value>The Crucifixion</Value></B></Paragraph><Paragraph textformat='center' fontfamily='FF-Pixt'><I><Value>“Jesus said, ‘Father, forgive them, for they don’t know what they are doing.’</Value><Br /><Value>Dividing his garments among them, they cast lots.”</Value></I><Br /><Value>Luke 23:34</Value></Paragraph>")));
	
$rev21_2_3 =
	($v_font=='FOREIGN' && !empty($rev21_2_3)
	? "<Paragraph $langspeed textformat='center' fontfamily='FF-PixF' $bidi_center><I><Value>$rev21_2_3</Value></I><Br /><Value>$rev21_2_3_b</Value></Paragraph>"
	: (!empty($rev21_2_3) && $language
	? "<Paragraph $langspeed textformat='center' fontfamily='FF-Pixt' $bidi_center><I><Value>$rev21_2_3</Value></I><Br /><Value>$rev21_2_3_b</Value></Paragraph>"
	: (!empty($rev21_2_3)
	? "<Paragraph language='English (USA)' textformat='center' fontfamily='FF-Pixx'><B><Value>The New Jerusalem</Value></B></Paragraph><Paragraph textformat='center' fontfamily='FF-Pixt'><I><Value>$rev21_2_3</Value></I><Br /><Value>$rev21_2_3_b</Value></Paragraph>"
	: "<Paragraph language='English (USA)' textformat='center' fontfamily='FF-Pixx'><B><Value>The New Jerusalem</Value></B></Paragraph><Paragraph textformat='center' fontfamily='FF-Pixt'><I><Value>“I saw the holy city, New Jerusalem, coming down out of heaven from God, prepared like a bride adorned for her husband. I heard a loud voice out of heaven saying, ‘Behold, God’s dwelling is with people, and he will dwell with them, and they will be his people,</Value><Br /><Value>and God himself will be with them as their God.’”</Value></I><Br /><Value>Revelation 21:2-3</Value></Paragraph>")));
	
$heb11_8 =
	($v_font=='FOREIGN' && !empty($heb11_8)
	? "<Paragraph $langspeed textformat='center' fontfamily='FF-PmaF' $bidi_center><I><Value>$heb11_8</Value></I><Value> - $heb11_8_b</Value></Paragraph>"
	: (!empty($heb11_8)
	? "<Paragraph $langspeed textformat='center' fontfamily='FF-Pmap'><I><Value>$heb11_8</Value></I><Value> - $heb11_8_b</Value></Paragraph>"
	: "<Paragraph language='English (USA)' textformat='center' fontfamily='FF-Pmap'><I><Value>“By faith, Abraham, when he was called, obeyed to go out to the place which he was to receive for an inheritance. He went out, not knowing where he went”</Value></I><Br /><Value>Hebrews 11:8</Value></Paragraph>"));
	
$exo13_17 =
	($v_font=='FOREIGN' && !empty($exo13_17)
	? "<Paragraph $langspeed textformat='center' fontfamily='FF-PmaF' $bidi_center><I><Value>$exo13_17</Value></I><Value> - $exo13_17_b</Value></Paragraph>"
	: (!empty($exo13_17)
	? "<Paragraph $langspeed textformat='center' fontfamily='FF-Pmap'><I><Value>$exo13_17</Value></I><Value> - $exo13_17_b</Value></Paragraph>"
	: "<Paragraph language='English (USA)' textformat='center' fontfamily='FF-Pmap'><I><Value>“When Pharaoh had let the people go, God didn’t lead them by the way of the land of the Philistines, although that was near;</Value><Br /><Value>for God said, ‘Lest perhaps the people change their minds when they see war, and they return to Egypt’” </Value></I><Value> Exodus 13:17</Value></Paragraph>"));
	
$mar10_45 =
	($v_font=='FOREIGN' && !empty($mar10_45)
	? "<Paragraph $langspeed textformat='center' fontfamily='FF-PmaF' $bidi_center><I><Value>$mar10_45</Value></I><Value> - $mar10_45_b</Value></Paragraph>"
	: (!empty($mar10_45)
	? "<Paragraph $langspeed textformat='center' fontfamily='FF-Pmap'><I><Value>$mar10_45</Value></I><Value> - $mar10_45_b</Value></Paragraph>"
	: "<Paragraph language='English (USA)' textformat='center' fontfamily='FF-Pmap'><I><Value>“For the Son of Man also came not to be served, but to serve, and to give his life as a ransom for many”</Value></I><Br /><Value>Mark 10:45</Value></Paragraph>"));
	
$rom1_1 =
	($v_font=='FOREIGN' && !empty($rom1_1)
	? "<Paragraph $langspeed textformat='center' fontfamily='FF-PmaF' $bidi_center><I><Value>$rom1_1</Value></I><Value> - $rom1_1_b</Value></Paragraph>"
	: (!empty($rom1_1)
	? "<Paragraph $langspeed textformat='center' fontfamily='FF-Pmap'><I><Value>$rom1_1</Value></I><Value> - $rom1_1_b</Value></Paragraph>"
	: "<Paragraph language='English (USA)' textformat='center' fontfamily='FF-Pmap'><I><Value>“Paul, a servant of Jesus Christ, called to be an apostle, set apart for the Good News of God”</Value></I><Br /><Value>Romans 1:1</Value></Paragraph>"));
	
$mat28_19 =
	($v_font=='FOREIGN' && !empty($mat28_19)
	? "<Paragraph $langspeed textformat='center' fontfamily='FF-PmaF' $bidi_center><I><Value>$mat28_19</Value></I><Value> - $mat28_19_b</Value></Paragraph>"
	: (!empty($mat28_19)
	? "<Paragraph $langspeed textformat='center' fontfamily='FF-Pmap'><I><Value>$mat28_19</Value></I><Value> - $mat28_19_b</Value></Paragraph>"
	: "<Paragraph language='English (USA)' textformat='center' fontfamily='FF-Pmap'><I><Value>“Go and make disciples of all nations, baptizing them in the name of the Father and of the Son and of the Holy Spirit”</Value></I><Br /><Value>Matthew 28:19</Value></Paragraph>"));
	
// arial font for numbers, percents, hyphen, space
if ($v_font=='FOREIGN' && (!($gen3_24=preg_replace("/([\-0-9:%, ]{3,})/","</Value><Span language='English (USA)'><Fontface fontfamily='FF-Pixt'><Value> </Value><Value>$1</Value><Value> </Value></Fontface></Span><Value>",$gen3_24,-1,$count)) || $count>1)) {		AION_ECHO("JEFF NOTICE! preg_replace(numbers)"); }
if ($v_font=='FOREIGN' && (!($luk23_34=preg_replace("/([\-0-9:%, ]{3,})/","</Value><Span language='English (USA)'><Fontface fontfamily='FF-Pixt'><Value> </Value><Value>$1</Value><Value> </Value></Fontface></Span><Value>",$luk23_34,-1,$count)) || $count>1)) {		AION_ECHO("JEFF NOTICE! preg_replace(numbers)"); }
if ($v_font=='FOREIGN' && (!($rev21_2_3=preg_replace("/([\-0-9:%, ]{3,})/","</Value><Span language='English (USA)'><Fontface fontfamily='FF-Pixt'><Value> </Value><Value>$1</Value><Value> </Value></Fontface></Span><Value>",$rev21_2_3,-1,$count)) || $count>1)) {	AION_ECHO("JEFF NOTICE! preg_replace(numbers)"); }
if ($v_font=='FOREIGN' && (!($heb11_8=preg_replace("/([\-0-9:%, ]{3,})/","</Value><Span language='English (USA)'><Fontface fontfamily='FF-Pixt'><Value> </Value><Value>$1</Value><Value> </Value></Fontface></Span><Value>",$heb11_8,-1,$count)) || $count>1)) {		AION_ECHO("JEFF NOTICE! preg_replace(numbers)"); }
if ($v_font=='FOREIGN' && (!($exo13_17=preg_replace("/([\-0-9:%, ]{3,})/","</Value><Span language='English (USA)'><Fontface fontfamily='FF-Pixt'><Value> </Value><Value>$1</Value><Value> </Value></Fontface></Span><Value>",$exo13_17,-1,$count)) || $count>1)) {		AION_ECHO("JEFF NOTICE! preg_replace(numbers)"); }
if ($v_font=='FOREIGN' && (!($mar10_45=preg_replace("/([\-0-9:%, ]{3,})/","</Value><Span language='English (USA)'><Fontface fontfamily='FF-Pixt'><Value> </Value><Value>$1</Value><Value> </Value></Fontface></Span><Value>",$mar10_45,-1,$count)) || $count>1)) {		AION_ECHO("JEFF NOTICE! preg_replace(numbers)"); }
if ($v_font=='FOREIGN' && (!($rom1_1=preg_replace("/([\-0-9:%, ]{3,})/","</Value><Span language='English (USA)'><Fontface fontfamily='FF-Pixt'><Value> </Value><Value>$1</Value><Value> </Value></Fontface></Span><Value>",$rom1_1,-1,$count)) || $count>1)) {			AION_ECHO("JEFF NOTICE! preg_replace(numbers)"); }
if ($v_font=='FOREIGN' && (!($mat28_19=preg_replace("/([\-0-9:%, ]{3,})/","</Value><Span language='English (USA)'><Fontface fontfamily='FF-Pixt'><Value> </Value><Value>$1</Value><Value> </Value></Fontface></Span><Value>",$mat28_19,-1,$count)) || $count>1)) {		AION_ECHO("JEFF NOTICE! preg_replace(numbers)"); }
// fonts
$fonts = AION_LOOP_PDF_POD_FONTS($font,$bsize,$bleading,$tsize,$tleading,$rsize,$rleading,$size,$leading,$numarialfont,$footsize,$backvl,$backtl,$backal,$backll,$headfont,$pixtext,$pixlead);
$versenumberlanguage = ($numarialfont ? "language='English (USA)'" : "" );
// options
$versionsMETA = "Holy Bible Aionian Edition, $versionE";
$keywordsMETA = (empty($language) ? "English" : $language) . ", Holy Bible, Scriptures, Aionian, Aion, Aionios, eleese, Hades, Gehenna, Tartarus, Abyss, Lake of Fire, Aiōn, Aiōnios, Aïdios, Sheol, Hadēs, Geenna, Tartaroō, Abyssos, Limnē Pyr, Purple Bible, Untranslation";
// title page
$versionFO_TI = "<Span $langspeed><Fontface fontfamily='$versionff'><Value>$version</Value></Fontface></Span>";
$versionEN_TI = ($version == $versionE ? "" : "<Br /><Fontface fontfamily='FF-VerE'><Value>$versionE</Value></Fontface>" );
$versionNT_TI = (!$newtonly ? "" : "<Br /><Fontface fontfamily='FF-VerE'><Value>$newtonly</Value></Fontface>");
// copyright
$versionFO_CP = "<Span $langspeed><Fontface fontfamily='$copyff'><Value>$version</Value></Fontface></Span>";
$versionEN_CP = ($version == $versionE ? "" : "<Br /><Fontface fontfamily='FF-Copy'><Value>$versionE</Value></Fontface>" );
$versionNT_CP = (!$newtonly ? "" : "<Br /><Fontface fontfamily='FF-Copy'><Value>$newtonly</Value></Fontface>");
$versionSS_CP = "<Value>".(empty($versions['ABCOPYRIGHT']) ? ("Creative Commons Attribution 4.0 International, 2018-".date("Y")) : $versions['ABCOPYRIGHT'])."</Value><Br />";
$versionSS_CP .= "<Value>Source text: ".$versions['SOURCEDOMAIN']."</Value><Br />";
$versionSS_CP .= $forprint['SOURCEVERSION'];
$versionSS_CP .= "<Value>Source copyright: ".$versions['COPYRIGHT']."</Value><Br />";
$versionSS_CP .= "<Value>".$versions['SOURCE'].(empty($versions['YEAR']) ? "" : ", ".$versions['YEAR'])."</Value><Br />";
$versionSS_CP .= (empty($versions['DESCRIPTION']) ? "" : "<Value>".$versions['DESCRIPTION']."</Value><Br />");
$versionSS_CP .= (empty($isbn) || $isbn=="UNKNOWN" ? "" : "<Value>ISBN: ".$isbn."</Value><Br />");
// extension
$extension_text = '';
$copyright_row = '50';
if (!empty($forprint['EXTENSION'])) {
	$extension_text = trim($forprint['EXTENSION']);
	$copyright_row = '6';
}
// KEIZER
$web72 = '';
// newtonly
$oldtestno = ($newtonly=="New Testament" ? "true()" : "false()");
$testflag = "_$format";
// twenty-two only
$allbooks = ($format=='POD22' ? 'false()' : 'true()');
// online and study format
$onlineformat = (($format=="READ" || $format=="STUDY") ? "true()" : "false()" );
$rotated = (($format=="READ") ? "true()" : "false()" );
$studyformat = (($format=="STUDY") ? "true()" : "false()" );
$adjustpagenumbers = (($format=="READ" || $format=="STUDY") ? "false()" : "true()" );
$format_1col = ($format=='STUDY' || $column1 ? "true()" : "false()" );
$format_2col = ($format=='STUDY' || $column1 ? "false()" : "true()" );
if (($format=="READ" || $format=="STUDY")) {
	$PIX_COVER			= 'COVER-web.jpg';
	$PIX_MAP_ABRAHAM	= 'MAP-1-ABRAHAM-web.jpg';
	$PIX_MAP_EXODUS		= 'MAP-2-EXODUS-web.jpg';
	$PIX_MAP_JESUS		= 'MAP-3-JESUS-web.jpg';
	$PIX_MAP_PAUL		= 'MAP-4-PAUL-web.jpg';
	$PIX_MAP_WORLD		= 'MAP-5-WORLD-web.jpg';
	$PIX_END			= 'PIX-END-web.jpg';
	$PIX_NEW			= 'PIX-NEW-web.jpg';
	$PIX_OLD			= 'PIX-OLD-web.jpg';
	$PIX_TIMEA			= 'MAP-TIME-WEB-A.pdf';	
	$PIX_TIMEB			= 'MAP-TIME-WEB-B.pdf';
	$PIX_TIME1			= 'MAP-TIME-1.jpg'; // unused, but assigned to something	
	$PIX_TIME2			= 'MAP-TIME-2.jpg'; // unused, but assigned to something
	$PIX_TIME3			= 'MAP-TIME-3.jpg';	// unused, but assigned to something
	$PIX_TIME4			= 'MAP-TIME-4.jpg'; // unused, but assigned to something
}
else {
	$PIX_COVER			= 'COVER.jpg';
	$PIX_MAP_ABRAHAM	= 'MAP-1-ABRAHAM.jpg';
	$PIX_MAP_EXODUS		= 'MAP-2-EXODUS.jpg';
	$PIX_MAP_JESUS		= 'MAP-3-JESUS.jpg';
	$PIX_MAP_PAUL		= 'MAP-4-PAUL.jpg';
	$PIX_MAP_WORLD		= 'MAP-5-WORLD.jpg';
	$PIX_END			= 'PIX-END.jpg';
	$PIX_NEW			= 'PIX-NEW.jpg';
	$PIX_OLD			= 'PIX-OLD.jpg';
	$PIX_TIME1			= 'MAP-TIME-1.jpg';	
	$PIX_TIME2			= 'MAP-TIME-2.jpg';
	$PIX_TIME3			= 'MAP-TIME-3.jpg';	
	$PIX_TIME4			= 'MAP-TIME-4.jpg';
	if ($rtl=='TRUE') { 
		$PIX_TIME1		= 'MAP-TIME-2.jpg';	
		$PIX_TIME2		= 'MAP-TIME-1.jpg';
		$PIX_TIME3		= 'MAP-TIME-4.jpg';	
		$PIX_TIME4		= 'MAP-TIME-3.jpg';
	}
	$PIX_TIMEA			= 'MAP-TIME-WEB-A.pdf';	// unused, but assigned to something
	$PIX_TIMEB			= 'MAP-TIME-WEB-B.pdf'; // unused, but assigned to something
}
// page
$PAGE_WIDTH					= '6in';
$PAGE_HEIGHT				= '9in';
// margins
$MARGIN_SINGLE_INSIDE		= '0.8125in';
$MARGIN_SINGLE_OUTSIDE		= '0.3125in';
$REFER_SINGLE_INSIDE		= '0.8125in';
$REFER_SINGLE_OUTSIDE		= '0.3125in';
$MARGIN_SINGLE_TOP			= '0.3125in';
$MARGIN_SINGLE_BOTTOM		= '0.3125in';
$MARGIN_SINGLE_WIDTH		= '78';
$MARGIN_SINGLE_HEIGHT		= '134';
$MARGIN_SINGLE_HEIGHT_PNUM	= '130';	
$BOTTOM_ROW_PNUM			= '131';
// maps
$MARGIN_MAPS_HEIGHT			= '134';
$MARGIN_MAPS_HEIGHT_W		= '130';
$MARGIN_MAPS_WIDTH			= '70';
$MARGIN_MAPS_HEIGHT_TIME	= '134';
$MARGIN_MAPS_WIDTH_TIME		= '78';
$MARGIN_MAPS_COLUMN			= '72';
// TOC
$MARGIN_TOCS_LEFT			= '1';
$MARGIN_TOCS_MID			= '21';
$MARGIN_TOCS_RIGHT			= '41';
$MARGIN_TOCS_BOTTOM			= '116';
if ($rtl=='TRUE') {
	$MARGIN_TOCS_LEFT = $MARGIN_TOCS_RIGHT;
	$MARGIN_TOCS_RIGHT = 1;;
}
// ONLINE BOTTOM BLURB
$MARGIN_ONLINE_BLURB_NUDGE	= 115 - (empty($w_nudge) ? 0 : $w_nudge);
// Glossary References +
$REFERENCE_ROW		= '23';
$REFERENCE_WIDTH	= '25';
$REFERENCE_HEIGHT	= '134';
$REFERENCE_HEIGHT1	= '111';
$REFERENCE_LEFT		= '1';
$REFERENCE_MIDDLE	= '27';
$REFERENCE_RIGHT	= '53';
// page name assignments
$TITLEJUSTIFICATION		= "right";
$page1colright			= "page1colright";
$page1colleft			= "page1colleft";
$page1colrightrotated	= "page1colrightrotated";
$page1colleftrotated	= "page1colleftrotated";
// MARGINS ALL
if ($format=="STUDY") {
	$web72 = '-web';
	$PAGE_WIDTH				= '8.5in';		$PAGE_HEIGHT			= '11in';
	$MARGIN_SINGLE_INSIDE	= '1in';		$MARGIN_SINGLE_OUTSIDE	= '1in';		$REFER_SINGLE_INSIDE	= '1in';		$REFER_SINGLE_OUTSIDE	= '1in';
	$MARGIN_SINGLE_TOP		= '1in';		$MARGIN_SINGLE_BOTTOM	= '1in';
	$MARGIN_RIGHT_LEFT		= '1in';		$MARGIN_RIGHT_RIGHT		= '1in';		$MARGIN_RIGHT_TOP		= '1in';		$MARGIN_RIGHT_BOTTOM	= '1in';
	$MARGIN_LEFT_LEFT		= '1in';		$MARGIN_LEFT_RIGHT		= '1in';		$MARGIN_LEFT_TOP		= '1in';		$MARGIN_LEFT_BOTTOM		= '1in';
	$COLUMN_LEFT_COLUMN		= '1';			$COLUMN_LEFT_WIDTH		= '56';			$COLUMN_LEFT_HEIGHT		= '140';
	$BOTTOM_ROW				= '142';		$BOTTOM_WIDTH			= '50';			$BOTTOM_CENTER			= '51';
	$COLUMN_RIGHT_COLUMN	= '46';			$COLUMN_RIGHT_WIDTH		= '43';			$COLUMN_RIGHT_HEIGHT	= '132'; // unused but defined
	$BOTTOM_RIGHT_RIGHT		= '47'; // unused but defined
	if ($studwide) { $COLUMN_LEFT_WIDTH		= '80'; }
}
else if ($format=="READ") {
	$web72 = '-web';
	$MARGIN_SINGLE_INSIDE	= '0.5625in';	$MARGIN_SINGLE_OUTSIDE	= '0.5625in';	$REFER_SINGLE_INSIDE	= '0.5625in';	$REFER_SINGLE_OUTSIDE	= '0.5625in';
	$MARGIN_RIGHT_LEFT		= '0.25in';		$MARGIN_RIGHT_RIGHT		= '0.25in';		$MARGIN_RIGHT_TOP		= '0.25in';		$MARGIN_RIGHT_BOTTOM	= '0.25in';
	$MARGIN_LEFT_LEFT		= '0.25in';		$MARGIN_LEFT_RIGHT		= '0.25in';		$MARGIN_LEFT_TOP		= '0.25in';		$MARGIN_LEFT_BOTTOM		= '0.25in';
	$COLUMN_LEFT_COLUMN		= '1';			$COLUMN_LEFT_WIDTH		= '43';			$COLUMN_LEFT_HEIGHT		= '132';
	$COLUMN_RIGHT_COLUMN	= '46';			$COLUMN_RIGHT_WIDTH		= '43';			$COLUMN_RIGHT_HEIGHT	= '132';
	$BOTTOM_ROW				= '134';		$BOTTOM_RIGHT_RIGHT		= '47';			$BOTTOM_WIDTH			= '42';			$BOTTOM_CENTER			= '44';
	if ($column1) { $COLUMN_LEFT_WIDTH		= '88'; }
}
else if ($rtl=='TRUE') { // margins flipped
	$MARGIN_SINGLE_INSIDE	= '0.875in';
	$MARGIN_SINGLE_WIDTH	= '77';
	$MARGIN_MAPS_WIDTH		= '69';
	$MARGIN_MAPS_WIDTH_TIME	= '77';
	$MARGIN_MAPS_COLUMN		= '71';
	$REFER_SINGLE_INSIDE	= '0.3125in';	$REFER_SINGLE_OUTSIDE	= '0.875in';
	$MARGIN_RIGHT_LEFT		= '0.3125in';	$MARGIN_RIGHT_RIGHT		= '0.875in';	$MARGIN_RIGHT_TOP		= '0.3125in';	$MARGIN_RIGHT_BOTTOM	= '0.3125in';
	$MARGIN_LEFT_LEFT		= '0.875in';	$MARGIN_LEFT_RIGHT		= '0.3125in';	$MARGIN_LEFT_TOP		= '0.3125in';	$MARGIN_LEFT_BOTTOM		= '0.3125in';
	$COLUMN_LEFT_COLUMN		= '1';			$COLUMN_LEFT_WIDTH		= '38';			$COLUMN_LEFT_HEIGHT		= '130';
	$COLUMN_RIGHT_COLUMN	= '40';			$COLUMN_RIGHT_WIDTH		= '38';			$COLUMN_RIGHT_HEIGHT	= '130';
	$BOTTOM_ROW				= '132';		$BOTTOM_RIGHT_RIGHT		= '42';			$BOTTOM_WIDTH			= '36';			$BOTTOM_CENTER			= '38';
	$TITLEJUSTIFICATION		= "left";
	$page1colright			= "page1colleft";
	$page1colleft			= "page1colright";
	$page1colrightrotated	= "page1colleftrotated";
	$page1colleftrotated	= "page1colrightrotated";
	$pref1colright			= "pref1colleft";
	$pref1colleft			= "pref1colright";
	$TITLEJUSTIFICATION		= "left";
	if ($column1) { $COLUMN_LEFT_WIDTH		= '77'; }
}
else {
	$MARGIN_SINGLE_INSIDE	= '0.875in';
	$REFER_SINGLE_INSIDE	= '0.875in';
	$MARGIN_SINGLE_WIDTH	= '77';
	$MARGIN_MAPS_WIDTH		= '69';
	$MARGIN_MAPS_WIDTH_TIME	= '77';
	$MARGIN_MAPS_COLUMN		= '71';
	$MARGIN_RIGHT_LEFT		= '0.875in';	$MARGIN_RIGHT_RIGHT		= '0.3125in';	$MARGIN_RIGHT_TOP		= '0.3125in';	$MARGIN_RIGHT_BOTTOM	= '0.3125in';
	$MARGIN_LEFT_LEFT		= '0.3125in';	$MARGIN_LEFT_RIGHT		= '0.875in';	$MARGIN_LEFT_TOP		= '0.3125in';	$MARGIN_LEFT_BOTTOM		= '0.3125in';
	$COLUMN_LEFT_COLUMN		= '1';			$COLUMN_LEFT_WIDTH		= '38';			$COLUMN_LEFT_HEIGHT		= '130';
	$COLUMN_RIGHT_COLUMN	= '40';			$COLUMN_RIGHT_WIDTH		= '38';			$COLUMN_RIGHT_HEIGHT	= '130';
	$BOTTOM_ROW				= '132';		$BOTTOM_RIGHT_RIGHT		= '42';			$BOTTOM_WIDTH			= '36';			$BOTTOM_CENTER			= '38';
	if ($column1) { $COLUMN_LEFT_WIDTH		= '77'; }
}
// RTL tune up, footer book opposite side
$BOTTOM_LEFT_LEFT = 1;
$FOOTERRIGHT = "footerright";
$FOOTERLEFT = "footerleft";
if ($rtl=="TRUE") {
	$BOTTOM_LEFT_LEFT = $BOTTOM_RIGHT_RIGHT;
	$BOTTOM_RIGHT_RIGHT = 1;
	$FOOTERRIGHT = "footerleft";
	$FOOTERLEFT = "footerright";
}

// help needed
$helpneeded = "<Value>We pray for a modern Creative Commons translation in every language</Value><Br /><Value>Translator resources at </Value>$link_tr<Br /><Value>Report content and format concerns to Nainoia Inc</Value><Br /><Value>Volunteer help is welcome and appreciated!</Value>";

return <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<Layout xmlns="urn:speedata.de:2009/publisher/en" xmlns:sd="urn:speedata:2009/publisher/functions/en">
<PDFOptions author="https://NAINOIA-INC.signedon.net" title="$versionsMETA (CC BY-ND 4.0)" subject="The World's First Holy Bible Untranslation, the Gospel of Jesus Christ" keywords="$keywordsMETA" displaymode="bookmarks" />
<Options reportmissingglyphs="warning" mainlanguage="English (USA)" />
$fonts

<!-- DEFINE FORMATS -->
<DefineTextformat name="toc"				alignment="justified"		hyphenate="no"								/>
<DefineTextformat name="text"				alignment="justified"		hyphenate="no"		margin-bottom="4pt"		/>
<DefineTextformat name="bible"				alignment="justified"		hyphenate="no"		margin-bottom="4pt"		/>
<DefineTextformat name="center"				alignment="centered"		hyphenate="no"								/>
<DefineTextformat name="centerpad"			alignment="centered"		hyphenate="no"		padding-top="10pt"		/>
<DefineTextformat name="prefaceparagraph"	alignment="justified"		hyphenate="no"		padding-top="7pt"		/>
<DefineTextformat name="left"				alignment="leftaligned"		hyphenate="no"								/>
<DefineTextformat name="leftpad"			alignment="leftaligned"		hyphenate="no"		padding-top="10pt"		/>
<DefineTextformat name="right"				alignment="rightaligned"	hyphenate="no"								/>
<DefineTextformat name="footercenter"		alignment="centered"		hyphenate="no"		padding-top="4pt"		/>
<DefineTextformat name="footerleft"			alignment="leftaligned"		hyphenate="no"		padding-top="4pt"		/>
<DefineTextformat name="footerright"		alignment="rightaligned"	hyphenate="no"		padding-top="4pt"		/>
<DefineColor name='white'		model='cmyk'	c='0'	m='0'	y='0'	k='0' />
<DefineColor name='black'		model='cmyk'	c='0'	m='0'	y='0'	k='100' />

<!-- DEFINE STYLESHEET -->
<Stylesheet>
	.v { }
	.vn { }
	.va { background-color: #E0E0E0; }
	.vna { background-color: #E0E0E0; }
	.vo { background-color: #E0E0E0; }
</Stylesheet>

<!-- DEFINE PAGES -->
<SetGrid width="4.5pt" height="4.5pt"/>
<Pageformat width="$PAGE_WIDTH" height="$PAGE_HEIGHT"/>

<!-- INTRO PAGES -->
<Pagetype name="pagetoc" test="\$newpagetype = 'toc'">
	<Margin left="$MARGIN_SINGLE_INSIDE" right="$MARGIN_SINGLE_OUTSIDE" top="$MARGIN_SINGLE_TOP" bottom="$MARGIN_SINGLE_BOTTOM"/>
	<PositioningArea name="area1col">
		<PositioningFrame row="1" column="1" width="$MARGIN_SINGLE_WIDTH" height="$MARGIN_SINGLE_HEIGHT"/>
	</PositioningArea>
</Pagetype>
<Pagetype name="page1colright" test="\$newpagetype != 'biblepage' and \$newpagetype != 'page1rotated' and sd:odd(sd:current-page())">
	<Margin left="$MARGIN_SINGLE_INSIDE" right="$MARGIN_SINGLE_OUTSIDE" top="$MARGIN_SINGLE_TOP" bottom="$MARGIN_SINGLE_BOTTOM"/>
	<PositioningArea name="area1col">
		<PositioningFrame row="1" column="1" width="$MARGIN_SINGLE_WIDTH" height="$MARGIN_SINGLE_HEIGHT"/>
	</PositioningArea>
</Pagetype>
<Pagetype name="page1colleft" test="\$newpagetype != 'biblepage' and \$newpagetype != 'page1rotated' and sd:even(sd:current-page())">
	<Margin left="$MARGIN_SINGLE_OUTSIDE" right="$MARGIN_SINGLE_INSIDE" top="$MARGIN_SINGLE_TOP" bottom="$MARGIN_SINGLE_BOTTOM"/>
	<PositioningArea name="area1col">
		<PositioningFrame row="1" column="1" width="$MARGIN_SINGLE_WIDTH" height="$MARGIN_SINGLE_HEIGHT"/>
	</PositioningArea>
</Pagetype>
<Pagetype name="page1colrightrotated" width="$PAGE_HEIGHT" height="$PAGE_WIDTH" test="\$newpagetype = 'page1rotated' and sd:odd(sd:current-page())">
	<Margin left="$MARGIN_SINGLE_BOTTOM" right="$MARGIN_SINGLE_TOP" top="$MARGIN_SINGLE_OUTSIDE" bottom="$MARGIN_SINGLE_INSIDE"/>
	<PositioningArea name="area1col">
		<PositioningFrame row="1" column="1" width="$MARGIN_SINGLE_HEIGHT" height="$MARGIN_SINGLE_WIDTH"/>
	</PositioningArea>
</Pagetype>
<Pagetype name="page1colleftrotated"  width="$PAGE_HEIGHT" height="$PAGE_WIDTH" test="\$newpagetype = 'page1rotated' and sd:even(sd:current-page())">
	<Margin left="$MARGIN_SINGLE_BOTTOM" right="$MARGIN_SINGLE_TOP" top="$MARGIN_SINGLE_INSIDE" bottom="$MARGIN_SINGLE_OUTSIDE"/>
	<PositioningArea name="area1col">
		<PositioningFrame row="1" column="1" width="$MARGIN_SINGLE_HEIGHT" height="$MARGIN_SINGLE_WIDTH"/>
	</PositioningArea>
</Pagetype>

<!-- ONE COLUMN -->
<Pagetype name="bible1colright" test="$format_1col and \$newpagetype = 'biblepage' and sd:odd(sd:current-page())">
	<Margin left="$MARGIN_RIGHT_LEFT" right="$MARGIN_RIGHT_RIGHT" top="$MARGIN_RIGHT_TOP" bottom="$MARGIN_RIGHT_BOTTOM"/>
	<PositioningArea name="area2col">
		<PositioningFrame row="1" column="1"  width="$COLUMN_LEFT_WIDTH" height="$COLUMN_LEFT_HEIGHT"/>
	</PositioningArea>
	<AtPageCreation>
		<PlaceObject row="$BOTTOM_ROW" column="1">
			<Textblock width="$BOTTOM_WIDTH" minheight="3" fontfamily="FF-Foot" textformat="footerleft"><Paragraph language="{\$lang}"><B><Value select="\$book"/></B></Paragraph></Textblock>
		</PlaceObject>
		<PlaceObject row="$BOTTOM_ROW" column="$BOTTOM_CENTER">
			<Textblock width="3" minheight="3" fontfamily="FF-Fnum" textformat="footercenter"><Paragraph><Value select="sd:current-page() - \$pagesextra"/></Paragraph></Textblock>
		</PlaceObject>
	</AtPageCreation>
</Pagetype>
<Pagetype name="bible1colleft" test="$format_1col and \$newpagetype = 'biblepage' and sd:even(sd:current-page())">
	<Margin left="$MARGIN_LEFT_LEFT" right="$MARGIN_LEFT_RIGHT" top="$MARGIN_LEFT_TOP" bottom="$MARGIN_LEFT_BOTTOM"/>
	<PositioningArea name="area2col">
		<PositioningFrame row="1" column="1"  width="$COLUMN_LEFT_WIDTH" height="$COLUMN_LEFT_HEIGHT"/>
	</PositioningArea>
	<AtPageCreation>
		<PlaceObject row="$BOTTOM_ROW" column="1">
<Textblock width="$BOTTOM_WIDTH" minheight="3" fontfamily="FF-Foot" textformat="footerleft"><Paragraph language="{\$lang}"><B><Value select="\$book"/></B></Paragraph></Textblock>
		</PlaceObject>
		<PlaceObject row="$BOTTOM_ROW" column="$BOTTOM_CENTER">
			<Textblock width="3" minheight="3" fontfamily="FF-Fnum" textformat="footercenter"><Paragraph><Value select="sd:current-page() - \$pagesextra"/></Paragraph></Textblock>
		</PlaceObject>
	</AtPageCreation>
</Pagetype>

<!-- TWO COLUMN -->
<Pagetype name="bible2colright" test="$format_2col and \$newpagetype = 'biblepage' and sd:odd(sd:current-page())" $rtlcols>
	<Margin left="$MARGIN_RIGHT_LEFT" right="$MARGIN_RIGHT_RIGHT" top="$MARGIN_RIGHT_TOP" bottom="$MARGIN_RIGHT_BOTTOM"/>
	<PositioningArea name="area2col">
		<PositioningFrame row="1" column="$COLUMN_LEFT_COLUMN"  width="$COLUMN_LEFT_WIDTH" height="$COLUMN_LEFT_HEIGHT"/>
		<PositioningFrame row="1" column="$COLUMN_RIGHT_COLUMN" width="$COLUMN_RIGHT_WIDTH" height="$COLUMN_RIGHT_HEIGHT"/>
	</PositioningArea>
	<AtPageCreation>
		<PlaceObject row="$BOTTOM_ROW" column="$BOTTOM_RIGHT_RIGHT">
			<Textblock width="$BOTTOM_WIDTH" minheight="3" fontfamily="FF-Foot" textformat="$FOOTERRIGHT"><Paragraph language="{\$lang}"><B><Value select="\$book"/></B></Paragraph></Textblock>
		</PlaceObject>
		<PlaceObject row="$BOTTOM_ROW" column="$BOTTOM_CENTER">
			<Textblock width="3" minheight="3" fontfamily="FF-Fnum" textformat="footercenter"><Paragraph><Value select="sd:current-page() - \$pagesextra"/></Paragraph></Textblock>
		</PlaceObject>
	</AtPageCreation>
</Pagetype>
<Pagetype name="bible2colleft" test="$format_2col and \$newpagetype = 'biblepage' and sd:even(sd:current-page())" $rtlcols>
	<Margin left="$MARGIN_LEFT_LEFT" right="$MARGIN_LEFT_RIGHT" top="$MARGIN_LEFT_TOP" bottom="$MARGIN_LEFT_BOTTOM"/>
	<PositioningArea name="area2col">
		<PositioningFrame row="1" column="$COLUMN_LEFT_COLUMN"  width="$COLUMN_LEFT_WIDTH" height="$COLUMN_LEFT_HEIGHT"/>
		<PositioningFrame row="1" column="$COLUMN_RIGHT_COLUMN" width="$COLUMN_RIGHT_WIDTH" height="$COLUMN_RIGHT_HEIGHT"/>
	</PositioningArea>
	<AtPageCreation>
		<PlaceObject row="$BOTTOM_ROW" column="$BOTTOM_LEFT_LEFT">
			<Textblock width="$BOTTOM_WIDTH" minheight="3" fontfamily="FF-Foot" textformat="$FOOTERLEFT"><Paragraph language="{\$lang}"><B><Value select="\$book"/></B></Paragraph></Textblock>
		</PlaceObject>
		<PlaceObject row="$BOTTOM_ROW" column="$BOTTOM_CENTER">
			<Textblock width="3" minheight="3" fontfamily="FF-Fnum" textformat="footercenter"><Paragraph><Value select="sd:current-page() - \$pagesextra"/></Paragraph></Textblock>
		</PlaceObject>
	</AtPageCreation>
</Pagetype>

<!-- GLOSSARY REFERENCES -->
<Pagetype name="page2colrightref" test="\$newpagetype = 'page2colref' and sd:odd(sd:current-page())">
	<Margin left="$REFER_SINGLE_INSIDE" right="$REFER_SINGLE_OUTSIDE" top="$MARGIN_SINGLE_TOP" bottom="$MARGIN_SINGLE_BOTTOM"/>
	<PositioningArea name="area2colref">
		<PositioningFrame row="1" column="$REFERENCE_LEFT"  width="$REFERENCE_WIDTH" height="$REFERENCE_HEIGHT"/>
		<PositioningFrame row="1" column="$REFERENCE_MIDDLE" width="$REFERENCE_WIDTH" height="$REFERENCE_HEIGHT"/>
		<PositioningFrame row="1" column="$REFERENCE_RIGHT" width="$REFERENCE_WIDTH" height="$REFERENCE_HEIGHT"/>
	</PositioningArea>
</Pagetype>
<Pagetype name="page2colleftref" test="\$newpagetype = 'page2colref' and sd:even(sd:current-page())">
	<Margin left="$REFER_SINGLE_OUTSIDE" right="$REFER_SINGLE_INSIDE" top="$MARGIN_SINGLE_TOP" bottom="$MARGIN_SINGLE_BOTTOM"/>
	<PositioningArea name="area1colref">
		<PositioningFrame row="1" column="1" width="$MARGIN_SINGLE_WIDTH" height="$REFERENCE_ROW"/>
	</PositioningArea>
	<PositioningArea name="area2colref">
		<PositioningFrame row="$REFERENCE_ROW" column="$REFERENCE_LEFT"  width="$REFERENCE_WIDTH" height="$REFERENCE_HEIGHT1"/>
		<PositioningFrame row="$REFERENCE_ROW" column="$REFERENCE_MIDDLE" width="$REFERENCE_WIDTH" height="$REFERENCE_HEIGHT1"/>
		<PositioningFrame row="$REFERENCE_ROW" column="$REFERENCE_RIGHT" width="$REFERENCE_WIDTH" height="$REFERENCE_HEIGHT1"/>
	</PositioningArea>
</Pagetype>

  
<!-- PRINT DOCUMENT -->
<Record element="bible">
	<!-- VARIABLES -->
	<SetVariable variable="lang" select="'Other'"/>
	<SetVariable variable="pagesextra" select="'0'"/>
	<SetVariable variable="newpagetype" select="'page1col'"/>
	<SetVariable variable="gotold" select="'false'"/>
	<ForAll select="oldtest[1]"><SetVariable variable="gotold" select="'true'"/></ForAll>
	<Switch><Case test="$oldtestno"><SetVariable variable="gotold" select="'false'"/></Case></Switch>
	<SetVariable variable="gotnew" select="'false'"/>
	<ForAll select="newtest[1]"><SetVariable variable="gotnew" select="'true'"/></ForAll>
	
	<!-- BIBLE TITLE -->
	<Switch>
		<Case test="$onlineformat">
			<Bookmark level="1" select="'Title Page'" open="no" />
			<PlaceObject row="0 in" column="0 in" allocate="no"><Image file='$PIX_COVER' height='11in' width='8.5in' clip='yes' /></PlaceObject>
			<PlaceObject row="7" column="1"><Textblock><Paragraph textformat="right" color="white">
				<Fontface fontfamily="FF-Holy"><Value>Holy Bible</Value></Fontface><Br />
				<Fontface fontfamily="FF-Aion"><Value>Aionian </Value></Fontface>
				<Fontface fontfamily="FF-AioE"><Value>Edition</Value></Fontface>
				<Fontface fontfamily="FF-AioR"><Value>®</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>

			<PlaceObject row="62" column="1"><Textblock><Paragraph language="English (USA)" textformat="right" color="white" $bidi_right>
				$versionFO_TI
				$versionEN_TI
				$versionNT_TI
			</Paragraph></Textblock></PlaceObject>
			<PlaceObject row="$MARGIN_ONLINE_BLURB_NUDGE" column="1"><Textblock><Paragraph language="English (USA)" textformat="right" color="white" fontfamily="FF-Btex" $bidi_right>
				<Value>AionianBible.org</Value><Br />
				$w_worl<Br />
				$w_free<Br />
				$w_akapurp
			</Paragraph></Textblock></PlaceObject>
		</Case>
		<Otherwise>
			<ClearPage openon="right" pagetype="$page1colright" force="yes" />
			<ClearPage openon="right" pagetype="$page1colright" />
			<Bookmark level="1" select="'Title Page'" open="no" />
			<PlaceObject row="7" column="1"><Textblock><Paragraph textformat="$TITLEJUSTIFICATION">
				<Fontface fontfamily="FF-Holy"><Value>Holy Bible</Value></Fontface><Br />
				<Fontface fontfamily="FF-Aion"><Value>Aionian </Value></Fontface>
				<Fontface fontfamily="FF-AioE"><Value>Edition</Value></Fontface>
				<Fontface fontfamily="FF-AioR"><Value>®</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
			<PlaceObject row="66" column="1"><Textblock><Paragraph language="English (USA)" textformat="$TITLEJUSTIFICATION" $bidi_plain>
				$versionFO_TI
				$versionEN_TI
				$versionNT_TI
			</Paragraph></Textblock></PlaceObject>
		</Otherwise>
	</Switch>
	<Message select="concat('ABPROOFER $outpdf TITLE ',sd:current-page())" />

	<!-- BIBLE COPYRIGHT -->
	<ClearPage openon="left" pagetype="$page1colleft" />
	<Bookmark level="1" select="'Copyright'" open="no" />
	<PlaceObject row="$copyright_row" column="1"><Textblock>
		<Paragraph language="English (USA)" textformat="center" $bidi_center><Fontface fontfamily='FF-Copy'>
			<I><Value>Holy Bible Aionian Edition ®</Value></I><Br />
			$versionFO_CP
			$versionEN_CP
			$versionNT_CP
		</Fontface></Paragraph><Paragraph textformat="centerpad"><Fontface fontfamily='FF-Copy'>
			$versionSS_CP
		</Fontface></Paragraph><Paragraph textformat="centerpad"><Fontface fontfamily='FF-Copy'>
			<Value>Formatted by $speedata_version</Value><Br />
			<Value>100% Free to Copy and Print</Value><Br />
			$link_tor
			$link_ab
		</Fontface></Paragraph><Paragraph textformat="centerpad"><Fontface fontfamily='FF-Copy'>
			<Value>Published by Nainoia Inc</Value><Br />
			$link_na
		</Fontface></Paragraph><Paragraph textformat="centerpad"><Fontface fontfamily='FF-Copy'>
			$helpneeded
		</Fontface></Paragraph>
		<Switch><Case test="$extension">
			<Paragraph textformat="leftpad"><Fontface fontfamily='FF-Copy'>
				<Value>Additional Information:</Value>
			</Fontface></Paragraph>
			$extension_text
			</Case></Switch>
	</Textblock></PlaceObject>
	<Message select="concat('ABPROOFER $outpdf COPYRIGHT ',sd:current-page())" />

	<!-- HISTORY -->
	<ClearPage openon="right" pagetype="$page1colright" />
	<PlaceObject row="50" column="1"><Textblock><Paragraph textformat="center"><Fontface fontfamily='FF-Copy'>
		<I><Value>Celebrate Jesus Christ’s victory of grace!</Value></I>
	</Fontface></Paragraph></Textblock></PlaceObject>

	<!-- BIBLE PREFACE -->
	<Switch>
		<Case test="$keizer">
			<ClearPage openon="left" pagetype="$page1colleft" /><Bookmark level="1" select="'$bm_pref'" open="no" /><Output area="area1col"><Text>$pref</Text></Output>
			<ClearPage openon="right" pagetype="$page1colright"  /><Output area="area1col"><Text>$pref2</Text></Output>
		</Case>
		<Otherwise>
			<ClearPage openon="left" pagetype="$page1colleft"  />
			<ClearPage openon="right" pagetype="$page1colright" /><Bookmark level="1" select="'$bm_pref'" open="no" /><Output area="area1col"><Text>$pref</Text></Output>
		</Otherwise>
	</Switch>
	<Message select="concat('ABPROOFER $outpdf PREFACE ',sd:current-page())" />

	<!-- VICTORY -->
	<ClearPage openon="left" pagetype="$page1colleft" />
	<Bookmark level="1" select="'$bm_hist'" open="no" />
	<Output area="area1col"><Text>$history</Text></Output>
	<Message select="concat('ABPROOFER $outpdf HISTORY ',sd:current-page())" />

	<!-- BIBLE TOC -->
	<ClearPage openon="right" pagetype="$page1colright" />
	<InsertPages name="toc" pages="1" />
    <SetVariable variable="toc_variable"/>
	<Message select="concat('ABPROOFER $outpdf TOC ',sd:current-page() - 1 )" />
	
	<!-- BIBLE OLD INTRO -->
	<Switch><Case test="\$gotold='true'">
		<ClearPage openon="right" pagetype="$page1colright" />
		<Bookmark level="1" select="'$bm_old'" open="no" />
		<PlaceObject row="1" column="1"><Textblock><Paragraph language="Other" textformat="$TITLEJUSTIFICATION">$w_old</Paragraph></Textblock></PlaceObject>
		<Message select="concat('ABPROOFER $outpdf OT-INTRO ',sd:current-page())" />
		<ClearPage openon="left" pagetype="$page1colleft" />
		<PlaceObject row="1" column="1"><Image file='$PIX_OLD' width='$MARGIN_SINGLE_WIDTH' /></PlaceObject>
		<PlaceObject row="105" column="5"><Textblock width="69">$gen3_24</Textblock></PlaceObject>
		<Message select="concat('ABPROOFER $outpdf OT-PIX ',sd:current-page())" />
	</Case>
	<Otherwise>
		<Message select="concat('ABPROOFER $outpdf OT-INTRO 0')" />
		<Message select="concat('ABPROOFER $outpdf OT-PIX 0')" />
		<Message select="concat('ABPROOFER $outpdf OT-PAGE1 0')" />
	</Otherwise>
	</Switch>

	<!-- BIBLE OLD -->
    <SetVariable variable="proof_gotfirst" select="'false'"/>
	<Switch><Case test="$adjustpagenumbers"><SetVariable variable="pagesextra" select="sd:current-page()"/></Case></Switch>
	<Switch><Case test="\$gotold='true'">
		<ProcessNode select="oldtest" />
	</Case></Switch>
		
	<!-- BIBLE NEW INTRO -->
	<Switch><Case test="\$gotnew='true'">
		<ClearPage openon="right" pagetype="$page1colright" skippagetype="$page1colleft" />
		<Bookmark level="1" select="'$bm_new'" open="no" />
		<PlaceObject row="1" column="1"><Textblock><Paragraph language="Other" textformat="$TITLEJUSTIFICATION">$w_new</Paragraph></Textblock></PlaceObject>
		<Message select="concat('ABPROOFER $outpdf NT-INTRO ',sd:current-page())" />
		<ClearPage openon="left" pagetype="$page1colleft" />
		<PlaceObject row="1" column="1"><Image file='$PIX_NEW' width='$MARGIN_SINGLE_WIDTH' /></PlaceObject>
		<PlaceObject row="105" column="5"><Textblock width="69">$luk23_34</Textblock></PlaceObject>
		<Message select="concat('ABPROOFER $outpdf NT-PIX ',sd:current-page())" />
	</Case>
	<Otherwise>
		<Message select="concat('ABPROOFER $outpdf NT-INTRO 0')" />
		<Message select="concat('ABPROOFER $outpdf NT-PIX 0')" />
		<Message select="concat('ABPROOFER $outpdf NT-PAGE1 0')" />
	</Otherwise>
	</Switch>

	<!-- BIBLE NEW TESTAMENT -->
    <SetVariable variable="proof_gotfirst" select="'false'"/>
	<Switch><Case test="$adjustpagenumbers and \$gotold='false'"><SetVariable variable="pagesextra" select="sd:current-page()"/></Case></Switch>
	<ProcessNode select="newtest" />
	
	<!-- BIBLE PICTURE -->
	<ClearPage openon="left" pagetype="$page1colleft" skippagetype="$page1colright"/>	
	<Bookmark level="1" select="'$bm_apdx'" open="no" />
	<PlaceObject row="1" column="1"><Image file='$PIX_END' width='$MARGIN_SINGLE_WIDTH' /></PlaceObject>
	<PlaceObject row="105" column="5"><Textblock width="69">$rev21_2_3</Textblock></PlaceObject>
	<Message select="concat('ABPROOFER $outpdf END-PIX ',sd:current-page())" />
	
	<!-- READERS GUIDE -->
	<ClearPage openon="right" pagetype="$page1colright" />
	<Bookmark level="1" select="'$bm_read'" open="no" />
	<Output area="area1col"><Text>$read</Text></Output>
	<Message select="concat('ABPROOFER $outpdf READERS ',sd:current-page())" />

	<!-- BIBLE GLOSSARY -->
	<ClearPage openon="left" pagetype="$page1colleft" />
	<Bookmark level="1" select="'$bm_glos'" open="no" />
	<Output area="area1col"><Text>$glos1</Text></Output>
	<Message select="concat('ABPROOFER $outpdf GLOSSARY1 ',sd:current-page())" />
	
	<ClearPage openon="right" pagetype="$page1colright" />
	<Output area="area1col"><Text>$glos2</Text></Output>
	<Message select="concat('ABPROOFER $outpdf GLOSSARY2 ',sd:current-page())" />

	<!-- BIBLE GLOSSARY+ -->
	<SetVariable variable="newpagetype" select="'page2colref'"/>
	<ClearPage openon="left" pagetype="page2colleftref" />
	<Output area="area1colref"><Text>$glos3</Text></Output>
	<Bookmark level="1" select="'$bm_glos +'" open="no" />
	<Message select="concat('ABPROOFER $outpdf GLOSSARYA ',sd:current-page())" />
	<LoadDataset name="references_dataset"/>
	<Message select="concat('ABPROOFER $outpdf GLOSSARYB ',sd:current-page())" />

	<!-- BIBLE MAPS -->
	<Switch>
		<Case test="$rotated">
			<ClearPage openon="left" pagetype="$page1colleftrotated"/>
			<Bookmark level="1" select="'$bm_map'" open="no" />
			<PlaceObject row="1" column="1" background='full' background-color='white' frame='solid' framecolor='black' rulewidth='1pt' allocate='no'><Image file='$PIX_MAP_ABRAHAM' height='$MARGIN_MAPS_WIDTH' width='$MARGIN_MAPS_HEIGHT' clip='no' rotate='90' /></PlaceObject>
			<PlaceObject row="$MARGIN_MAPS_COLUMN" column="1" allocate="no"><Textblock width='$MARGIN_MAPS_HEIGHT_W'>$heb11_8</Textblock></PlaceObject>
			<Message select="concat('ABPROOFER $outpdf MAP1 ',sd:current-page())" />

			<ClearPage openon="right" pagetype="$page1colrightrotated"/>
			<PlaceObject row="1" column="1" background='full' background-color='white' frame='solid' framecolor='black' rulewidth='1pt'><Image file='$PIX_MAP_EXODUS' height='$MARGIN_MAPS_WIDTH' width='$MARGIN_MAPS_HEIGHT' clip='no' rotate='90' /></PlaceObject>
			<PlaceObject row="$MARGIN_MAPS_COLUMN" column="1" allocate="no"><Textblock width='$MARGIN_MAPS_HEIGHT_W'>$exo13_17</Textblock></PlaceObject>
			<Message select="concat('ABPROOFER $outpdf MAP2 ',sd:current-page())" />

			<ClearPage openon="left" pagetype="$page1colleft"/>
			<PlaceObject row="1" column="1" background='full' background-color='white' frame='solid' framecolor='black' rulewidth='1pt' allocate='no'><Image file='$PIX_MAP_JESUS' height='$MARGIN_MAPS_HEIGHT' width='$MARGIN_MAPS_WIDTH' clip='no' /></PlaceObject>
			<PlaceObject row="$MARGIN_MAPS_HEIGHT" column="$MARGIN_MAPS_COLUMN" rotate="-90" allocate="no"><Textblock width='$MARGIN_MAPS_HEIGHT_W'>$mar10_45</Textblock></PlaceObject>
			<Message select="concat('ABPROOFER $outpdf MAP3 ',sd:current-page())" />

			<ClearPage openon="right" pagetype="$page1colrightrotated"/>
			<PlaceObject row="1" column="1" background='full' background-color='white' frame='solid' framecolor='black' rulewidth='1pt' allocate='no'><Image file='$PIX_MAP_PAUL' height='$MARGIN_MAPS_WIDTH' width='$MARGIN_MAPS_HEIGHT' clip='no' rotate='90' /></PlaceObject>
			<PlaceObject row="$MARGIN_MAPS_COLUMN" column="1" allocate="no"><Textblock width='$MARGIN_MAPS_HEIGHT_W'>$rom1_1</Textblock></PlaceObject>
			<Message select="concat('ABPROOFER $outpdf MAP4 ',sd:current-page())" />

			<ClearPage openon="left" pagetype="$page1colleftrotated"/>
			<PlaceObject row="1" column="1" background='full' background-color='white' frame='solid' framecolor='black' rulewidth='1pt'><Image file='$PIX_TIMEA' height='$MARGIN_MAPS_WIDTH_TIME' width='$MARGIN_MAPS_HEIGHT_TIME' clip='no' /></PlaceObject>
			<Message select="concat('ABPROOFER $outpdf TIMEA ',sd:current-page())" />

			<ClearPage openon="right" pagetype="$page1colrightrotated"/>
			<PlaceObject row="1" column="1" background='full' background-color='white' ><Image file='$PIX_TIMEB' height='$MARGIN_MAPS_WIDTH_TIME' width='$MARGIN_MAPS_HEIGHT_TIME' clip='no' /></PlaceObject>
			<Message select="concat('ABPROOFER $outpdf TIMEB ',sd:current-page())" />

			<!-- LAKE OF FIRE -->
			<ClearPage openon="left" pagetype="$page1colleft" />
			<Bookmark level="1" select="'$bm_loff'" open="no" />
			<Output area="area1col"><Text>$loff</Text></Output>
			<Message select="concat('ABPROOFER $outpdf LAKEOFFIRE ',sd:current-page())" />

			<ClearPage openon="right" pagetype="$page1colrightrotated"/>
			<PlaceObject row="1" column="1" background='full' background-color='white' frame='solid' framecolor='black' rulewidth='1pt'><Image file='$PIX_MAP_WORLD' height='$MARGIN_MAPS_WIDTH' width='$MARGIN_MAPS_HEIGHT' clip='no' rotate='90' /></PlaceObject>
			<PlaceObject row="$MARGIN_MAPS_COLUMN" column="1" allocate="no"><Textblock width='$MARGIN_MAPS_HEIGHT_W'>$mat28_19</Textblock></PlaceObject>
			<Message select="concat('ABPROOFER $outpdf MAP5 ',sd:current-page())" />
		</Case>
		<Otherwise>
			<ClearPage openon="left" pagetype="$page1colleft"/>
			<Bookmark level="1" select="'$bm_map'" open="no" />
			<PlaceObject row="1" column="1" background='full' background-color='white' frame='solid' framecolor='black' rulewidth='1pt'><Image file='$PIX_MAP_ABRAHAM' height='$MARGIN_MAPS_HEIGHT' width='$MARGIN_MAPS_WIDTH' clip='no' /></PlaceObject>
			<PlaceObject row="$MARGIN_MAPS_HEIGHT" column="$MARGIN_MAPS_COLUMN" rotate="-90" allocate="no"><Textblock width='$MARGIN_MAPS_HEIGHT_W'>$heb11_8</Textblock></PlaceObject>
			<Message select="concat('ABPROOFER $outpdf MAP1 ',sd:current-page())" />

			<ClearPage openon="right" pagetype="$page1colright"/>
			<PlaceObject row="1" column="1" background='full' background-color='white' frame='solid' framecolor='black' rulewidth='1pt'><Image file='$PIX_MAP_EXODUS' height='$MARGIN_MAPS_HEIGHT' width='$MARGIN_MAPS_WIDTH' clip='no' /></PlaceObject>
			<PlaceObject row="$MARGIN_MAPS_HEIGHT" column="$MARGIN_MAPS_COLUMN" rotate="-90" allocate="no"><Textblock width='$MARGIN_MAPS_HEIGHT_W'>$exo13_17</Textblock></PlaceObject>
			<Message select="concat('ABPROOFER $outpdf MAP2 ',sd:current-page())" />

			<ClearPage openon="left" pagetype="$page1colleft"/>
			<PlaceObject row="1" column="1" background='full' background-color='white' frame='solid' framecolor='black' rulewidth='1pt'><Image file='$PIX_MAP_JESUS' height='$MARGIN_MAPS_HEIGHT' width='$MARGIN_MAPS_WIDTH' clip='no' /></PlaceObject>
			<PlaceObject row="$MARGIN_MAPS_HEIGHT" column="$MARGIN_MAPS_COLUMN" rotate="-90" allocate="no"><Textblock width='$MARGIN_MAPS_HEIGHT_W'>$mar10_45</Textblock></PlaceObject>
			<Message select="concat('ABPROOFER $outpdf MAP3 ',sd:current-page())" />

			<ClearPage openon="right" pagetype="$page1colright"/>
			<PlaceObject row="1" column="1" background='full' background-color='white' frame='solid' framecolor='black' rulewidth='1pt'><Image file='$PIX_MAP_PAUL' height='$MARGIN_MAPS_HEIGHT' width='$MARGIN_MAPS_WIDTH' clip='no' /></PlaceObject>
			<PlaceObject row="$MARGIN_MAPS_HEIGHT" column="$MARGIN_MAPS_COLUMN" rotate="-90" allocate="no"><Textblock width='$MARGIN_MAPS_HEIGHT_W'>$rom1_1</Textblock></PlaceObject>
			<Message select="concat('ABPROOFER $outpdf MAP4 ',sd:current-page())" />

			<Switch>
				<Case test="$studyformat">
					<ClearPage openon="left" pagetype="$page1colleft"/>
					<PlaceObject row="1" column="1" background='full' background-color='white' frame='solid' framecolor='black' rulewidth='1pt'><Image file='$PIX_TIMEA' height='$MARGIN_MAPS_HEIGHT_TIME' width='$MARGIN_MAPS_WIDTH_TIME' clip='no' rotate='-90'  /></PlaceObject>
					<Message select="concat('ABPROOFER $outpdf TIMEA ',sd:current-page())" />

					<ClearPage openon="right" pagetype="$page1colright"/>
					<PlaceObject row="1" column="1" background='full' background-color='white' ><Image file='$PIX_TIMEB' height='$MARGIN_MAPS_HEIGHT_TIME' width='$MARGIN_MAPS_WIDTH_TIME' clip='no' rotate='-90'  /></PlaceObject>
					<Message select="concat('ABPROOFER $outpdf TIMEB ',sd:current-page())" />
				</Case>			
				<Otherwise>
					<ClearPage openon="left" pagetype="$page1colleft"/>
					<PlaceObject row="1" column="1" background='full' background-color='white' frame='solid' framecolor='black' rulewidth='1pt'><Image file='$PIX_TIME1' height='$MARGIN_MAPS_HEIGHT_TIME' width='$MARGIN_MAPS_WIDTH_TIME' clip='no' /></PlaceObject>
					<Message select="concat('ABPROOFER $outpdf TIME1 ',sd:current-page())" />

					<ClearPage openon="right" pagetype="$page1colright"/>
					<PlaceObject row="1" column="1" background='full' background-color='white' frame='solid' framecolor='black' rulewidth='1pt'><Image file='$PIX_TIME2' height='$MARGIN_MAPS_HEIGHT_TIME' width='$MARGIN_MAPS_WIDTH_TIME' clip='no' /></PlaceObject>
					<Message select="concat('ABPROOFER $outpdf TIME2 ',sd:current-page())" />

					<ClearPage openon="left" pagetype="$page1colleft"/>
					<PlaceObject row="1" column="1" background='full' background-color='white' ><Image file='$PIX_TIME3' height='$MARGIN_MAPS_HEIGHT_TIME' width='$MARGIN_MAPS_WIDTH_TIME' clip='no' /></PlaceObject>
					<Message select="concat('ABPROOFER $outpdf TIME3 ',sd:current-page())" />

					<ClearPage openon="right" pagetype="$page1colright"/>
					<PlaceObject row="1" column="1" background='full' background-color='white' ><Image file='$PIX_TIME4' height='$MARGIN_MAPS_HEIGHT_TIME' width='$MARGIN_MAPS_WIDTH_TIME' clip='no' /></PlaceObject>
					<Message select="concat('ABPROOFER $outpdf TIME4 ',sd:current-page())" />
				</Otherwise>
			</Switch>

			<!-- LAKE OF FIRE -->
			<ClearPage openon="left" pagetype="$page1colleft" />
			<Bookmark level="1" select="'$bm_loff'" open="no" />
			<Output area="area1col"><Text>$loff</Text></Output>
			<Message select="concat('ABPROOFER $outpdf LAKEOFFIRE ',sd:current-page())" />
		
			<ClearPage openon="right" pagetype="$page1colright"/>
			<PlaceObject row="1" column="1" background='full' background-color='white' frame='solid' framecolor='black' rulewidth='1pt'><Image file='$PIX_MAP_WORLD' height='$MARGIN_MAPS_HEIGHT' width='$MARGIN_MAPS_WIDTH' clip='no' /></PlaceObject>
			<PlaceObject row="$MARGIN_MAPS_HEIGHT" column="$MARGIN_MAPS_COLUMN" rotate="-90" allocate="no"><Textblock width='$MARGIN_MAPS_HEIGHT_W'>$mat28_19</Textblock></PlaceObject>
			<Message select="concat('ABPROOFER $outpdf MAP5 ',sd:current-page())" />
		</Otherwise>
	</Switch>
	
	<!-- BIBLE BLANKS -->
	<Switch><Case test="$onlineformat"></Case><Otherwise>
		<ClearPage openon="left" pagetype="$page1colleft"/>
	</Otherwise></Switch>
	
	<!-- SAVE DATASET -->
	<Message select="concat('PAGE COUNT','$testflag',': ',@NAMEENGLISH,', ',sd:current-page())" />
	<SaveDataset name="toc_dataset" elementname="toc_element" select="\$toc_variable" />

	<!-- CREATE TOC -->
	<SavePages name="toc">
		<Bookmark level="1" select="'$bm_toc'" open="no" />
		<LoadDataset name="toc_dataset"/>
	</SavePages>
</Record>


<!-- PRINT TOC -->
<Record element="toc_element">
	<PlaceObject row="1" column="1"><Textblock><Paragraph textformat="center">$w_toc<Br /></Paragraph></Textblock></PlaceObject>
	<Switch>
		<Case test="\$gotold='true'">
			<PlaceObject row="8" column="$MARGIN_TOCS_LEFT" allocate="no"><Textblock fontfamily="FF-TOCS" textformat="toc" width="37"><Paragraph $bidi_table>
				<B>$w_old2</B><Br /><Br />
				<ForAll select="oldtoc"><Span language="{@LANG}"><Value select="@BOOK" /></Span><Value select="' '" /><HSpace leader="."/><Fontface fontfamily="FF-TNUM"><Value select="@PAGE" /></Fontface><Br /></ForAll>
			</Paragraph></Textblock></PlaceObject>
		</Case>
	</Switch>
	<Switch>
		<Case test="\$gotold='true' and \$gotnew='true'">
			<PlaceObject row="8" column="$MARGIN_TOCS_RIGHT" allocate="no"><Textblock fontfamily="FF-TOCS" textformat="toc" width="37"><Paragraph $bidi_table>
				<B>$w_new2</B><Br /><Br />
				<ForAll select="newtoc"><Span language="{@LANG}"><Value select="@BOOK" /></Span><Value select="' '" /><HSpace leader="."/><Fontface fontfamily="FF-TNUM"><Value select="@PAGE" /></Fontface><Br /></ForAll>
			</Paragraph></Textblock></PlaceObject>
		</Case>
		<Case test="\$gotnew='true'">
			<PlaceObject row="8" column="$MARGIN_TOCS_MID" allocate="no"><Textblock fontfamily="FF-TOCS" textformat="toc" width="37"><Paragraph $bidi_table>
				<B>$w_new2</B><Br /><Br />
				<ForAll select="newtoc"><Span language="{@LANG}"><Value select="@BOOK" /></Span><Value select="' '" /><HSpace leader="."/><Fontface fontfamily="FF-TNUM"><Value select="@PAGE" /></Fontface><Br /></ForAll>
			</Paragraph></Textblock></PlaceObject>
		</Case>
	</Switch>
	<Switch>
		<Case test="\$gotold='true' and \$gotnew='true'"><PlaceObject row="$MARGIN_TOCS_BOTTOM" column="$MARGIN_TOCS_RIGHT" allocate="no"><Textblock fontfamily="FF-Toc2" textformat="toc" width="37"><Paragraph $bidi_plain>$w_app</Paragraph></Textblock></PlaceObject></Case>
		<Case test="\$gotold='true'"><PlaceObject row="14" column="$MARGIN_TOCS_RIGHT" allocate="no"><Textblock fontfamily="FF-Toc2" textformat="toc" width="37"><Paragraph $bidi_plain>$w_app</Paragraph></Textblock></PlaceObject></Case>
		<Otherwise><PlaceObject row="$MARGIN_TOCS_BOTTOM" column="$MARGIN_TOCS_MID" allocate="no"><Textblock fontfamily="FF-Toc2" textformat="toc" width="37"><Paragraph $bidi_plain>$w_app</Paragraph></Textblock></PlaceObject></Otherwise>
	</Switch>	
</Record>


<!-- PRINT OLD TESTAMENT -->
<Record element="oldtest">
	<SetVariable variable="twentytwo" select="@TWENTYTWO"/>
	<Switch><Case test="$allbooks or \$twentytwo='GO'" >
		<SetVariable variable="newpagetype" select="'biblepage'"/>
		<SetVariable variable="book" select="@BOOK"/>
		<SetVariable variable="lang" select="@LANG"/>
		<ClearPage />
		<Switch><Case test="\$proof_gotfirst='false'"><Message select="concat('ABPROOFER $outpdf OT-PAGE1 ',sd:current-page())" /></Case></Switch>
		<SetVariable variable="proof_gotfirst" select="'true'"/>
		<Bookmark level="1" select="@BOOK" open="no" />
		<SetVariable variable="toc_variable"><Copy-of select="\$toc_variable" />\n<Element name="oldtoc"><Attribute name="BOOK" select="@BOOK" /><Attribute name="LANG" select="@LANG" /><Attribute name="PAGE" select="sd:current-page() - \$pagesextra" /></Element></SetVariable>
		<Output area="area2col"><Text fontfamily="FF-Book" textformat="$rtlbook"><Paragraph language="{\$lang}"><Value select="@BOOK"/></Paragraph></Text></Output>
		<ProcessNode select="chapter"/>
	</Case></Switch>		
</Record>


<!-- PRINT NEW TESTAMENT -->
<Record element="newtest">
	<SetVariable variable="twentytwo" select="@TWENTYTWO"/>
	<Switch><Case test="$allbooks or \$twentytwo='GO'" >
		<SetVariable variable="newpagetype" select="'biblepage'"/>
		<SetVariable variable="book" select="@BOOK"/>
		<SetVariable variable="lang" select="@LANG"/>
		<ClearPage />
		<Switch><Case test="\$proof_gotfirst='false'"><Message select="concat('ABPROOFER $outpdf NT-PAGE1 ',sd:current-page())" /></Case></Switch>
		<SetVariable variable="proof_gotfirst" select="'true'"/>
		<Bookmark level="1" select="@BOOK" open="no" />
		<SetVariable variable="toc_variable"><Copy-of select="\$toc_variable" />\n<Element name="newtoc"><Attribute name="BOOK" select="@BOOK" /><Attribute name="LANG" select="@LANG" /><Attribute name="PAGE" select="sd:current-page() - \$pagesextra" /></Element></SetVariable>
		<Output area="area2col"><Text fontfamily="FF-Book" textformat="$rtlbook"><Paragraph language="{\$lang}"><Value select="@BOOK"/></Paragraph></Text></Output>
		<ProcessNode select="chapter"/>
	</Case></Switch>
</Record>


<!-- PRINT CHAPTER -->
<Record element="chapter">
	<Output area="area2col">
		<Text fontfamily="FF-Bibl" textformat="bible">
			<Paragraph $langspeed $bidi_bible>
				<Switch>
					<Case test="$rtlinit"><Span $langchap><Fontface fontfamily="FF-Init"><Value select="@CHAP"/><Value>&#xa0;&#xa0;</Value></Fontface></Span></Case>
					<Otherwise><Initial fontfamily="FF-Init" padding-right="2pt"><Value select="@CHAP"/></Initial></Otherwise>
				</Switch>
				<ForAll select="*">
					<Switch>
						<Case test="@V=1">						</Case>
						<Case test="@class='vn' and @V!=1">		<Span $versenumberlanguage class='vn'><Fontface fontfamily="FF-Bnum"><B><Value select="."/></B></Fontface></Span></Case>
						<Case test="@class='vna' and @V!=1">	<Span $versenumberlanguage class='verseaioniannumber'><Fontface fontfamily="FF-Bnum"><B><Value select="."/></B></Fontface></Span></Case>
						<Case test="@class='v'">				<Span class='v'><Value select="."/></Span></Case>
						<Case test="@class='va'">				<Span class='verseaionian'><Value select="."/></Span></Case>
						<Case test="@class='vo'">				<Span language='English (USA)' class='versenote'><Fontface fontfamily="FF-Bnot"><B><Value select="."/></B></Fontface></Span></Case>
						<Otherwise>								<Message select="'ERROR, BAD DATA FILE TAG'" errorcode='1' exit='yes' /></Otherwise>
					</Switch>
				</ForAll>
			</Paragraph>
		</Text>
	</Output>
</Record>

<!-- PRINT GLOSSARY+ -->
<Record element="references_element">
<SetVariable variable="QuestionedCount" select="0"/>
<Output area="area2colref"><Text fontfamily="FF-Refs" textformat="left"><Paragraph language="Other" $bidi_3col>

<B><I><Fontface fontfamily='FF-Glos'><Value>Abyssos</Value></Fontface></I></B><Br />
<ForAll select="ABYSS">		<Span language="{@LANG}"><Value select="@BOOK" /></Span><HSpace width="5pt"/><Value select="@CHAPTER" /><Value select="':'" /><Value select="@VERSE" /><Value select="@MARK" /><Br /></ForAll>
<Fontface fontfamily='FF-Tiny'><Br /></Fontface>

<B><I><Fontface fontfamily='FF-Glos'><Value>aïdios</Value></Fontface></I></B><Br />
<ForAll select="AIDIOS">	<Span language="{@LANG}"><Value select="@BOOK" /></Span><HSpace width="5pt"/><Value select="@CHAPTER" /><Value select="':'" /><Value select="@VERSE" /><Value select="@MARK" /><Br /></ForAll>
<Fontface fontfamily='FF-Tiny'><Br /></Fontface>

<B><I><Fontface fontfamily='FF-Glos'><Value>aiōn</Value></Fontface></I></B><Br />
<ForAll select="AIONS">		<Span language="{@LANG}"><Value select="@BOOK" /></Span><HSpace width="5pt"/><Value select="@CHAPTER" /><Value select="':'" /><Value select="@VERSE" /><Value select="@MARK" /><Br /></ForAll>
<Fontface fontfamily='FF-Tiny'><Br /></Fontface>

<B><I><Fontface fontfamily='FF-Glos'><Value>aiōnios</Value></Fontface></I></B><Br />
<ForAll select="AIONIAN">	<Span language="{@LANG}"><Value select="@BOOK" /></Span><HSpace width="5pt"/><Value select="@CHAPTER" /><Value select="':'" /><Value select="@VERSE" /><Value select="@MARK" /><Br /></ForAll>
<Fontface fontfamily='FF-Tiny'><Br /></Fontface>

<B><I><Fontface fontfamily='FF-Glos'><Value>eleēsē</Value></Fontface></I></B><Br />
<ForAll select="ELEESE">	<Span language="{@LANG}"><Value select="@BOOK" /></Span><HSpace width="5pt"/><Value select="@CHAPTER" /><Value select="':'" /><Value select="@VERSE" /><Value select="@MARK" /><Br /></ForAll>
<Fontface fontfamily='FF-Tiny'><Br /></Fontface>

<B><I><Fontface fontfamily='FF-Glos'><Value>Geenna</Value></Fontface></I></B><Br />
<ForAll select="GEHENNA">	<Span language="{@LANG}"><Value select="@BOOK" /></Span><HSpace width="5pt"/><Value select="@CHAPTER" /><Value select="':'" /><Value select="@VERSE" /><Value select="@MARK" /><Br /></ForAll>
<Fontface fontfamily='FF-Tiny'><Br /></Fontface>

<B><I><Fontface fontfamily='FF-Glos'><Value>Hadēs</Value></Fontface></I></B><Br />
<ForAll select="HADES">		<Span language="{@LANG}"><Value select="@BOOK" /></Span><HSpace width="5pt"/><Value select="@CHAPTER" /><Value select="':'" /><Value select="@VERSE" /><Value select="@MARK" /><Br /></ForAll>
<Fontface fontfamily='FF-Tiny'><Br /></Fontface>

<B><I><Fontface fontfamily='FF-Glos'><Value>Limnē Pyr</Value></Fontface></I></B><Br />
<ForAll select="LOF">		<Span language="{@LANG}"><Value select="@BOOK" /></Span><HSpace width="5pt"/><Value select="@CHAPTER" /><Value select="':'" /><Value select="@VERSE" /><Value select="@MARK" /><Br /></ForAll>
<Fontface fontfamily='FF-Tiny'><Br /></Fontface>

<B><I><Fontface fontfamily='FF-Glos'><Value>Sheol</Value></Fontface></I></B><Br />
<ForAll select="SHEOL">		<Span language="{@LANG}"><Value select="@BOOK" /></Span><HSpace width="5pt"/><Value select="@CHAPTER" /><Value select="':'" /><Value select="@VERSE" /><Value select="@MARK" /><Br /></ForAll>
<Fontface fontfamily='FF-Tiny'><Br /></Fontface>

<B><I><Fontface fontfamily='FF-Glos'><Value>Tartaroō</Value></Fontface></I></B><Br />
<ForAll select="TARTARUS">	<Span language="{@LANG}"><Value select="@BOOK" /></Span><HSpace width="5pt"/><Value select="@CHAPTER" /><Value select="':'" /><Value select="@VERSE" /><Value select="@MARK" /><Br /></ForAll>
<Fontface fontfamily='FF-Tiny'><Br /></Fontface>

<ForAll select="QUESTIONED"><SetVariable variable="QuestionedCount" select="(\$QuestionedCount+1)"/></ForAll>
<B><I><Fontface fontfamily='FF-Glos'><Value>Questioned</Value></Fontface></I></B><Br />
<Switch><Case test="(\$QuestionedCount>0)">
<Message select="concat('ABPROOFER $outpdf QUESTIONED ',\$QuestionedCount)" />
<ForAll select="QUESTIONED"><Span language="{@LANG}"><Value select="@BOOK" /></Span><HSpace width="5pt"/><Value select="@CHAPTER" /><Value select="':'" /><Value select="@VERSE" /><Value select="@MARK" /><Br /></ForAll>
</Case>
<Otherwise><Fontface fontfamily='FF-Pmap'><Value>None yet noted</Value></Fontface></Otherwise>
</Switch>

</Paragraph></Text></Output>
</Record>

</Layout>
EOT;
}



function AION_LOOP_PDF_POD_LAYOUT_EPUB($versions,$forprint,$default,$newtonly,$format,$numarialfont,$outpdf) {
// settings	
$language	= trim(!empty($forprint['LANGUAGE'])	? $forprint['LANGUAGE']		: $default['LANGUAGE']		);
$langspeed	= trim(!empty($forprint['LANGSPEED'])	? "language='".$forprint['LANGSPEED']."'"	: ""		);
$yesnew		= trim(!empty($forprint['YESNEW'])		? $forprint['YESNEW']		: $default['YESNEW']		);
$rtl		= trim(!empty($forprint['RTL'])			? $forprint['RTL']			: $default['RTL']			);
$font		= trim(!empty($forprint['FONT'])		? $forprint['FONT']			: $default['FONT']			);
$bsize		= trim(!empty($forprint['BSIZE'])		? $forprint['BSIZE']		: $default['BSIZE']			);
$bleading	= trim(!empty($forprint['BLEADING'])	? $forprint['BLEADING']		: $default['BLEADING']		);
$tsize		= trim(!empty($forprint['TSIZE'])		? $forprint['TSIZE']		: $default['TSIZE']			);
$tleading	= trim(!empty($forprint['TLEADING'])	? $forprint['TLEADING']		: $default['TLEADING']		);
$rsize		= trim(!empty($forprint['RSIZE'])		? $forprint['RSIZE']		: $default['RSIZE']			);
$rleading	= trim(!empty($forprint['RLEADING'])	? $forprint['RLEADING']		: $default['RLEADING']		);
$size		= trim(!empty($forprint['SIZE'])		? $forprint['SIZE']			: $default['SIZE']			);
$leading	= trim(!empty($forprint['LEADING'])		? $forprint['LEADING']		: $default['LEADING']		);
$footsize	= trim(!empty($forprint['FOOTSIZE'])	? $forprint['FOOTSIZE']		: $default['FOOTSIZE']		);
$backvl		= trim(!empty($forprint['BACKVL'])		? $forprint['BACKVL']		: $default['BACKVL']		);
$backtl		= trim(!empty($forprint['BACKTL'])		? $forprint['BACKTL']		: $default['BACKTL']		);
$backal		= trim(!empty($forprint['BACKAL'])		? $forprint['BACKAL']		: $default['BACKAL']		);
$backll		= trim(!empty($forprint['BACKLL'])		? $forprint['BACKLL']		: $default['BACKLL']		);
$headfont	= trim(!empty($forprint['HEADFONT'])	? $forprint['HEADFONT']		: $default['HEADFONT']		);
$pixtext	= trim(!empty($forprint['PIXTEXT'])		? $forprint['PIXTEXT']		: $default['PIXTEXT']		);
$pixlead	= trim(!empty($forprint['PIXLEAD'])		? $forprint['PIXLEAD']		: $default['PIXLEAD']		);
$copyff		= trim(!empty($forprint['COPYFF'])		? $forprint['COPYFF']		: $default['COPYFF']		);
$versionff	= trim(!empty($forprint['VERSIONFF'])	? $forprint['VERSIONFF']	: $default['VERSIONFF']		);
// text
$version	= (!empty($forprint['VERSION'])			? $forprint['VERSION']		: $default['VERSION']		); // no trim here to allow for spaces in Tamil version name
$versionE	= trim(!empty($forprint['VERSIONE'])	? $forprint['VERSIONE']		: $default['VERSIONE']		);
// words
$w_font		= trim(!empty($forprint['W_FONT'])		? $forprint['W_FONT']		: $default['W_FONT']		);
$w_worl		= trim(!empty($forprint['W_WORL'])		? $forprint['W_WORL']		: $default['W_WORL']		);
$w_free		= trim(!empty($forprint['W_FREE'])		? $forprint['W_FREE']		: $default['W_FREE']		);
$w_aka		= trim(!empty($forprint['W_AKA'])		? $forprint['W_AKA']		: $default['W_AKA']			);
$w_purp		= trim(!empty($forprint['W_PURP'])		? $forprint['W_PURP']		: $default['W_PURP']		);
$w_nudge	= trim(!empty($forprint['W_NUDGE'])		? $forprint['W_NUDGE']		: $default['W_NUDGE']		);
// RTL EXTRAS
$bidi_right	= ($rtl=="TRUE" && !empty($w_free.$w_aka) ? 'bidi="yes" direction="rtl"' : '' ); // very kludgey thing to do, but RTL bibles with default English free and aka must set this to ''
// cover words
$w_worl	=
	($w_font=='FOREIGN' && !empty($w_worl)
	? "<Span $langspeed><Fontface fontfamily='FF-BteF'><Value>$w_worl</Value></Fontface></Span>"
	: (!empty($w_worl)
	? "<Span $langspeed><Value>$w_worl</Value></Span>"
	: "<Span language='English (USA)'><Value>The world’s first Holy Bible untranslation</Value></Span>"));
$w_free	=
	($w_font=='FOREIGN' && !empty($w_free)
	? "<Span $langspeed><Fontface fontfamily='FF-BteF'><Value>$w_free</Value></Fontface></Span>"
	: (!empty($w_free)
	? "<Span $langspeed><Value>$w_free</Value></Span>"
	: "<Span language='English (USA)'><Value>100% free to copy and print</Value></Span>"));
$w_akaEng = FALSE;
$w_aka	=
	($w_font=='FOREIGN' && !empty($w_aka)
	? "<Span $langspeed><Fontface fontfamily='FF-BteF'><Value>$w_aka</Value></Fontface></Span>"
	: (!empty($w_aka)
	? "<Span $langspeed><Value>$w_aka</Value></Span>"
	: ($w_akaEng="<Span language='English (USA)'><Value>also known as</Value></Span>")));
$w_purp	=
	($w_purp=="SKIP"
	? ""
	: ($rtl=='TRUE' && !empty($w_purp)
	? "<Span language='English (USA)'><Value> \" </Value></Span><Span $langspeed><Fontface fontfamily='FF-BteF'><Value>$w_purp</Value></Fontface></Span><Span language='English (USA)'><Value> \" </Value></Span>"
	: ($w_font=='FOREIGN' && !empty($w_purp)
	? "<Span language='English (USA)'><Value> “ </Value></Span><Span $langspeed><Fontface fontfamily='FF-BteF'><Value>$w_purp</Value></Fontface></Span><Span language='English (USA)'><Value> ”</Value></Span>"
	: (!empty($w_purp)
	? "<Span language='English (USA)'><Value> “ </Value></Span><Span $langspeed><Value>$w_purp</Value></Span><Span language='English (USA)'><Value> ”</Value></Span>"
	: "<Span language='English (USA)'><Value> “ The Purple Bible ”</Value></Span>"))));
$w_akapurp = (empty($w_purp) ? $w_aka : "$w_aka<Value> </Value>$w_purp");
// arial font for numbers, percents, hyphen, space
if ($w_font=='FOREIGN' && (!($w_free=preg_replace("/([\-0-9:% ]{3,})/","</Value><Span language='English (USA)'><Fontface fontfamily='FF-Btex'><Value> $1 </Value></Fontface></Span><Value>",$w_free,-1,$count)) || $count>1)) { AION_ECHO("JEFF NOTICE! preg_replace(numbers)"); }
// stuff
$PIX_COVER = 'COVER-web.jpg';
//$PIX_COVER = 'COVER.jpg';
$MARGIN_ONLINE_BLURB_NUDGE	= 115 - (empty($w_nudge) ? 0 : $w_nudge);
// fonts
$fonts = AION_LOOP_PDF_POD_FONTS($font,$bsize,$bleading,$tsize,$tleading,$rsize,$rleading,$size,$leading,$numarialfont,$footsize,$backvl,$backtl,$backal,$backll,$headfont,$pixtext,$pixlead);
// title page
$versionFO_TI = "<Span $langspeed><Fontface fontfamily='$versionff'><Value>$version</Value></Fontface></Span>";
$versionEN_TI = ($version == $versionE ? "" : "<Br /><Span language='English (USA)'><Fontface fontfamily='FF-VerE'><Value>$versionE</Value></Fontface></Span>" );

return <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<Layout xmlns="urn:speedata.de:2009/publisher/en" xmlns:sd="urn:speedata:2009/publisher/functions/en">
<Options reportmissingglyphs="warning" mainlanguage="English (USA)" />
$fonts

<!-- DEFINE FORMATS -->
<DefineTextformat name="right" alignment="rightaligned" hyphenate="no" />
<DefineColor name='white'		model='cmyk'	c='0'	m='0'	y='0'	k='0' />

<!-- DEFINE PAGES -->
<SetGrid width="4.5pt" height="4.5pt"/>
<Pageformat width="6in" height="9in"/>
<Pagetype name="page" test="true()"></Pagetype>

<!-- PRINT DOCUMENT -->
<Record element="bible">

	<!-- EPUB COVER -->	
	<PlaceObject row="0 in" column="0 in" allocate="no"><Image file='$PIX_COVER' height='11in' width='8.5in' clip='yes' /></PlaceObject>
	<PlaceObject row="7" column="1"><Textblock><Paragraph textformat="right" color="white">
		<Fontface fontfamily="FF-Holy"><Value>Holy Bible</Value></Fontface><Br />
		<Fontface fontfamily="FF-Aion"><Value>Aionian </Value></Fontface>
		<Fontface fontfamily="FF-AioE"><Value>Edition</Value></Fontface>
		<Fontface fontfamily="FF-AioR"><Value>®</Value></Fontface>
	</Paragraph></Textblock></PlaceObject>
	<PlaceObject row="62" column="1"><Textblock><Paragraph language="English (USA)" textformat="right" color="white" $bidi_right>
		$versionFO_TI
		$versionEN_TI
	</Paragraph></Textblock></PlaceObject>
	<PlaceObject row="$MARGIN_ONLINE_BLURB_NUDGE" column="1"><Textblock><Paragraph language="English (USA)" textformat="right" color="white" fontfamily="FF-Btex" $bidi_right>
		<Value>AionianBible.org</Value><Br />
		$w_worl<Br />
		$w_free<Br />
		$w_akapurp
	</Paragraph></Textblock></PlaceObject>
	
</Record>
</Layout>
EOT;
}



function AION_LOOP_PDF_POD_LAYOUT_COPY($versions,$forprint,$default,$newtonly,$numarialfont) {
global $speedata_version;
// settings	
$language	= trim(!empty($forprint['LANGUAGE'])	? $forprint['LANGUAGE']		: $default['LANGUAGE']		);
$langspeed	= trim(!empty($forprint['LANGSPEED'])	? "language='".$forprint['LANGSPEED']."'"	: ""		);
$yesnew		= trim(!empty($forprint['YESNEW'])		? $forprint['YESNEW']		: $default['YESNEW']		);
$rtl		= trim(!empty($forprint['RTL'])			? $forprint['RTL']			: $default['RTL']			);
$font		= trim(!empty($forprint['FONT'])		? $forprint['FONT']			: $default['FONT']			);
$bsize		= trim(!empty($forprint['BSIZE'])		? $forprint['BSIZE']		: $default['BSIZE']			);
$bleading	= trim(!empty($forprint['BLEADING'])	? $forprint['BLEADING']		: $default['BLEADING']		);
$tsize		= trim(!empty($forprint['TSIZE'])		? $forprint['TSIZE']		: $default['TSIZE']			);
$tleading	= trim(!empty($forprint['TLEADING'])	? $forprint['TLEADING']		: $default['TLEADING']		);
$rsize		= trim(!empty($forprint['RSIZE'])		? $forprint['RSIZE']		: $default['RSIZE']			);
$rleading	= trim(!empty($forprint['RLEADING'])	? $forprint['RLEADING']		: $default['RLEADING']		);
$size		= trim(!empty($forprint['SIZE'])		? $forprint['SIZE']			: $default['SIZE']			);
$leading	= trim(!empty($forprint['LEADING'])		? $forprint['LEADING']		: $default['LEADING']		);
$footsize	= trim(!empty($forprint['FOOTSIZE'])	? $forprint['FOOTSIZE']		: $default['FOOTSIZE']		);
$backvl		= trim(!empty($forprint['BACKVL'])		? $forprint['BACKVL']		: $default['BACKVL']		);
$backtl		= trim(!empty($forprint['BACKTL'])		? $forprint['BACKTL']		: $default['BACKTL']		);
$backal		= trim(!empty($forprint['BACKAL'])		? $forprint['BACKAL']		: $default['BACKAL']		);
$backll		= trim(!empty($forprint['BACKLL'])		? $forprint['BACKLL']		: $default['BACKLL']		);
$headfont	= trim(!empty($forprint['HEADFONT'])	? $forprint['HEADFONT']		: $default['HEADFONT']		);
$pixtext	= trim(!empty($forprint['PIXTEXT'])		? $forprint['PIXTEXT']		: $default['PIXTEXT']		);
$pixlead	= trim(!empty($forprint['PIXLEAD'])		? $forprint['PIXLEAD']		: $default['PIXLEAD']		);
$copyff		= trim(!empty($forprint['COPYFF'])		? $forprint['COPYFF']		: $default['COPYFF']		);
$versionff	= trim(!empty($forprint['VERSIONFF'])	? $forprint['VERSIONFF']	: $default['VERSIONFF']		);
// text
$version	= (!empty($forprint['VERSION'])			? $forprint['VERSION']		: $default['VERSION']		); // no trim here to allow for spaces in Tamil version name
$versionE	= trim(!empty($forprint['VERSIONE'])	? $forprint['VERSIONE']		: $default['VERSIONE']		);
$isbn		= trim(!empty($forprint['ISBN'])		? $forprint['ISBN']			: ''						);
$extension	= trim(!empty($forprint['EXTENSION'])	? "true()"					: "false()"					);
// RTL EXTRAS
$bidi_center= ($rtl=="TRUE" ? 'bidi="yes" direction="rtl"' : '' );
// fonts
$fonts = AION_LOOP_PDF_POD_FONTS($font,$bsize,$bleading,$tsize,$tleading,$rsize,$rleading,$size,$leading,$numarialfont,$footsize,$backvl,$backtl,$backal,$backll,$headfont,$pixtext,$pixlead);
// options
$versionsMETA = "Holy Bible Aionian Edition, $versionE";
$keywordsMETA = (empty($language) ? "English" : $language) . ", Holy Bible, Scriptures, Aionian, Aion, Aionios, eleese, Hades, Gehenna, Tartarus, Abyss, Lake of Fire, Aiōn, Aiōnios, Aïdios, Sheol, Hadēs, Geenna, Tartaroō, Abyssos, Limnē Pyr, Purple Bible, Untranslation";
// copyright
$versionFO_CP = "<Span $langspeed><Fontface fontfamily='$copyff'><Value>$version</Value></Fontface></Span>";
$versionEN_CP = ($version == $versionE ? "" : "<Br /><Fontface fontfamily='FF-Copy'><Value>$versionE</Value></Fontface>" );
$versionNT_CP = (!$newtonly ? "" : "<Br /><Fontface fontfamily='FF-Copy'><Value>$newtonly</Value></Fontface>");
$versionSS_CP = "<Value>".(empty($versions['ABCOPYRIGHT']) ? ("Creative Commons Attribution 4.0 International, 2018-".date("Y")) : $versions['ABCOPYRIGHT'])."</Value><Br />";
$versionSS_CP .= "<Value>Source text: ".$versions['SOURCEDOMAIN']."</Value><Br />";
$versionSS_CP .= $forprint['SOURCEVERSION'];
$versionSS_CP .= "<Value>Source copyright: ".$versions['COPYRIGHT']."</Value><Br />";
$versionSS_CP .= "<Value>".$versions['SOURCE'].(empty($versions['YEAR']) ? "" : ", ".$versions['YEAR'])."</Value><Br />";
$versionSS_CP .= (empty($versions['DESCRIPTION']) ? "" : "<Value>".$versions['DESCRIPTION']."</Value><Br />");
$versionSS_CP .= (empty($isbn) || $isbn=="UNKNOWN" ? "" : "<Value>ISBN: ".$isbn."</Value><Br />");
// extension
$extension_text = '';
$copyright_row = '50';
if (!empty($forprint['EXTENSION'])) {
	$extension_text = trim($forprint['EXTENSION']);
	$copyright_row = '6';
}
// page
$PAGE_WIDTH					= '6in';
$PAGE_HEIGHT				= '9in';
// margins
if ($rtl=='TRUE') {
	$MARGIN_SINGLE_INSIDE		= '0.3125in';
	$MARGIN_SINGLE_OUTSIDE		= '0.8125in';
}
else {
	$MARGIN_SINGLE_INSIDE		= '0.8125in';
	$MARGIN_SINGLE_OUTSIDE		= '0.3125in';
}
$MARGIN_SINGLE_TOP			= '0.3125in';
$MARGIN_SINGLE_BOTTOM		= '0.3125in';
$MARGIN_SINGLE_WIDTH		= '78';
$MARGIN_SINGLE_HEIGHT		= '134';

// help needed
$helpneeded = "<Value>We pray for a modern Creative Commons translation in every language</Value><Br /><Value>Translator resources at </Value><U><Value>https://AionianBible.or</Value></U><Value>g</Value><U><Value>/Third-Part</Value></U><Value>y</Value><U><Value>-Publisher-Resources</Value></U><Br /><Value>Report content and format concerns to Nainoia Inc</Value><Br /><Value>Volunteer help is welcome and appreciated!</Value>";


return <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<Layout xmlns="urn:speedata.de:2009/publisher/en" xmlns:sd="urn:speedata:2009/publisher/functions/en">
<PDFOptions author="https://NAINOIA-INC.signedon.net" title="$versionsMETA (CC BY-ND 4.0)" subject="The World's First Holy Bible Untranslation, the Gospel of Jesus Christ" keywords="$keywordsMETA" displaymode="bookmarks" />
<Options reportmissingglyphs="warning" mainlanguage="English (USA)" />
$fonts

<!-- DEFINE FORMATS -->
<DefineTextformat name="toc"				alignment="justified"		hyphenate="no"								/>
<DefineTextformat name="text"				alignment="justified"		hyphenate="no"		margin-bottom="4pt"		/>
<DefineTextformat name="bible"				alignment="justified"		hyphenate="no"		margin-bottom="4pt"		/>
<DefineTextformat name="center"				alignment="centered"		hyphenate="no"								/>
<DefineTextformat name="centerpad"			alignment="centered"		hyphenate="no"		padding-top="10pt"		/>
<DefineTextformat name="prefaceparagraph"	alignment="justified"		hyphenate="no"		padding-top="7pt"		/>
<DefineTextformat name="left"				alignment="leftaligned"		hyphenate="no"								/>
<DefineTextformat name="leftpad"			alignment="leftaligned"		hyphenate="no"		padding-top="10pt"		/>
<DefineTextformat name="right"				alignment="rightaligned"	hyphenate="no"								/>
<DefineTextformat name="footercenter"		alignment="centered"		hyphenate="no"		padding-top="4pt"		/>
<DefineTextformat name="footerleft"			alignment="leftaligned"		hyphenate="no"		padding-top="4pt"		/>
<DefineTextformat name="footerright"		alignment="rightaligned"	hyphenate="no"		padding-top="4pt"		/>

<!-- DEFINE PAGES -->
<SetGrid width="4.5pt" height="4.5pt"/>
<Pageformat width="$PAGE_WIDTH" height="$PAGE_HEIGHT"/>

<!-- INTRO PAGES -->
<Pagetype name="page" test="true()">
	<Margin left="$MARGIN_SINGLE_OUTSIDE" right="$MARGIN_SINGLE_INSIDE" top="$MARGIN_SINGLE_TOP" bottom="$MARGIN_SINGLE_BOTTOM"/>
	<PositioningArea name="area1col">
		<PositioningFrame row="1" column="1" width="$MARGIN_SINGLE_WIDTH" height="$MARGIN_SINGLE_HEIGHT"/>
	</PositioningArea>
</Pagetype>

<!-- PRINT DOCUMENT -->
<Record element="bible">

	<!-- BIBLE COPYRIGHT -->
	<PlaceObject row="$copyright_row" column="1"><Textblock>
		<Paragraph language="English (USA)" textformat="center" $bidi_center><Fontface fontfamily='FF-Copy'>
			<I><Value>Holy Bible Aionian Edition ®</Value></I><Br />
			$versionFO_CP
			$versionEN_CP
			$versionNT_CP
		</Fontface></Paragraph><Paragraph textformat="centerpad"><Fontface fontfamily='FF-Copy'>
			$versionSS_CP
		</Fontface></Paragraph><Paragraph textformat="centerpad"><Fontface fontfamily='FF-Copy'>
			<Value>Formatted by $speedata_version</Value><Br />
			<Value>100% Free to Copy and Print</Value><Br />
			<Value>TOR Anonymously</Value><Br />
			<U><Value>AionianBible.or</Value></U><Value>g</Value>
		</Fontface></Paragraph><Paragraph textformat="centerpad"><Fontface fontfamily='FF-Copy'>
			<Value>Published by Nainoia Inc</Value><Br />
			<U><Value>https://Nainoia-Inc.si</Value></U><Value>g</Value><U><Value>nedon.net</Value></U>
		</Fontface></Paragraph><Paragraph textformat="centerpad"><Fontface fontfamily='FF-Copy'>
			$helpneeded
		</Fontface></Paragraph>
		<Switch><Case test="$extension">
			<Paragraph textformat="leftpad"><Fontface fontfamily='FF-Copy'>
				<I><Value>Additional Information:</Value></I>
			</Fontface></Paragraph>
			$extension_text
			</Case></Switch>
	</Textblock></PlaceObject>

</Record>
</Layout>
EOT;
}




function AION_LOOP_PDF_POD_LAYOUT_COVR($versions,$forprint,$default,$bodyfile,$newtonly,$numarialfont,$isbnpix,$isbntype,$hardmargin) {
// settings	
$bible		= $forprint['BIBLE'];
$language	= trim(!empty($forprint['LANGUAGE'])	? $forprint['LANGUAGE']		: $default['LANGUAGE']		);
$langspeed	= trim(!empty($forprint['LANGSPEED'])	? "language='".$forprint['LANGSPEED']."'"	: ""		);
$yesnew		= trim(!empty($forprint['YESNEW'])		? $forprint['YESNEW']		: $default['YESNEW']		);
$rtl		= trim(!empty($forprint['RTL'])			? $forprint['RTL']			: $default['RTL']			);
$font		= trim(!empty($forprint['FONT'])		? $forprint['FONT']			: $default['FONT']			);
$bsize		= trim(!empty($forprint['BSIZE'])		? $forprint['BSIZE']		: $default['BSIZE']			);
$bleading	= trim(!empty($forprint['BLEADING'])	? $forprint['BLEADING']		: $default['BLEADING']		);
$tsize		= trim(!empty($forprint['TSIZE'])		? $forprint['TSIZE']		: $default['TSIZE']			);
$tleading	= trim(!empty($forprint['TLEADING'])	? $forprint['TLEADING']		: $default['TLEADING']		);
$rsize		= trim(!empty($forprint['RSIZE'])		? $forprint['RSIZE']		: $default['RSIZE']			);
$rleading	= trim(!empty($forprint['RLEADING'])	? $forprint['RLEADING']		: $default['RLEADING']		);
$size		= trim(!empty($forprint['SIZE'])		? $forprint['SIZE']			: $default['SIZE']			);
$leading	= trim(!empty($forprint['LEADING'])		? $forprint['LEADING']		: $default['LEADING']		);
$footsize	= trim(!empty($forprint['FOOTSIZE'])	? $forprint['FOOTSIZE']		: $default['FOOTSIZE']		);
$backvl		= trim(!empty($forprint['BACKVL'])		? $forprint['BACKVL']		: $default['BACKVL']		);
$backtl		= trim(!empty($forprint['BACKTL'])		? $forprint['BACKTL']		: $default['BACKTL']		);
$backal		= trim(!empty($forprint['BACKAL'])		? $forprint['BACKAL']		: $default['BACKAL']		);
$backll		= trim(!empty($forprint['BACKLL'])		? $forprint['BACKLL']		: $default['BACKLL']		);
$headfont	= trim(!empty($forprint['HEADFONT'])	? $forprint['HEADFONT']		: $default['HEADFONT']		);
$pixtext	= trim(!empty($forprint['PIXTEXT'])		? $forprint['PIXTEXT']		: $default['PIXTEXT']		);
$pixlead	= trim(!empty($forprint['PIXLEAD'])		? $forprint['PIXLEAD']		: $default['PIXLEAD']		);
$copyff		= trim(!empty($forprint['COPYFF'])		? $forprint['COPYFF']		: $default['COPYFF']		);
$versionff	= trim(!empty($forprint['VERSIONFF'])	? $forprint['VERSIONFF']	: $default['VERSIONFF']		);
// text
$version	= (!empty($forprint['VERSION'])			? $forprint['VERSION']		: $default['VERSION']		); // no trim here to allow for spaces in Tamil version name
$versionE	= trim(!empty($forprint['VERSIONE'])	? $forprint['VERSIONE']		: $default['VERSIONE']		);
$extension	= trim(!empty($forprint['EXTENSION'])	? "true()"					: "false()"					);
$keizer		= trim(!empty($forprint['KEIZER'])		? "true()"					: "false()"					);
$pref		= trim(!empty($forprint['PREF'])		? $forprint['PREF']			: $default['PREF']			);
$pref2		= trim(!empty($forprint['PREF2'])		? $forprint['PREF2']		: $default['PREF2']			);
$read		= trim(!empty($forprint['READ'])		? $forprint['READ']			: $default['READ']			);
$glos1		= trim(!empty($forprint['GLOS1'])		? $forprint['GLOS1']		: $default['GLOS1']			);
$glos2		= trim(!empty($forprint['GLOS2'])		? $forprint['GLOS2']		: $default['GLOS2']			);
// words
$w_font		= trim(!empty($forprint['W_FONT'])		? $forprint['W_FONT']		: $default['W_FONT']		);
$w_pref		= trim(!empty($forprint['W_PREF'])		? $forprint['W_PREF']		: $default['W_PREF']		);
$w_old		= trim(!empty($forprint['W_OLD'])		? $forprint['W_OLD']		: $default['W_OLD']			);
$w_new		= trim(!empty($forprint['W_NEW'])		? $forprint['W_NEW']		: $default['W_NEW']			);
$w_toc		= trim(!empty($forprint['W_TOC'])		? $forprint['W_TOC']		: $default['W_TOC']			);
$w_apdx		= trim(!empty($forprint['W_APDX'])		? $forprint['W_APDX']		: $default['W_APDX']		);
$w_read		= trim(!empty($forprint['W_READ'])		? $forprint['W_READ']		: $default['W_READ']		);
$w_glos		= trim(!empty($forprint['W_GLOS'])		? $forprint['W_GLOS']		: $default['W_GLOS']		);
$w_map		= trim(!empty($forprint['W_MAP'])		? $forprint['W_MAP']		: $default['W_MAP']			);
$w_ilus		= trim(!empty($forprint['W_ILUS'])		? $forprint['W_ILUS']		: $default['W_ILUS']		);
$w_life		= trim(!empty($forprint['W_LIFE'])		? $forprint['W_LIFE']		: $default['W_LIFE']		);
$w_lifex	= trim(!empty($forprint['W_LIFEX'])		? $forprint['W_LIFEX']		: $default['W_LIFEX']		);
$w_worl		= trim(!empty($forprint['W_WORL'])		? $forprint['W_WORL']		: $default['W_WORL']		);
$w_free		= trim(!empty($forprint['W_FREE'])		? $forprint['W_FREE']		: $default['W_FREE']		);
$w_aka		= trim(!empty($forprint['W_AKA'])		? $forprint['W_AKA']		: $default['W_AKA']			);
$w_purp		= trim(!empty($forprint['W_PURP'])		? $forprint['W_PURP']		: $default['W_PURP']		);
// verses
$v_font		= trim(!empty($forprint['V_FONT'])		? $forprint['V_FONT']		: $default['V_FONT']		);
$joh3_16	= trim(!empty($forprint['JOH3_16'])		? $forprint['JOH3_16']		: $default['JOH3_16']		);
$gen3_24	= trim(!empty($forprint['GEN3_24'])		? $forprint['GEN3_24']		: $default['GEN3_24']		);
$luk23_34	= trim(!empty($forprint['LUK23_34'])	? $forprint['LUK23_34']		: $default['LUK23_34']		);
$rev21_2_3	= trim(!empty($forprint['REV21_2_3'])	? $forprint['REV21_2_3']	: $default['REV21_2_3']		);
$heb11_8	= trim(!empty($forprint['HEB11_8'])		? $forprint['HEB11_8']		: $default['HEB11_8']		);
$exo13_17	= trim(!empty($forprint['EXO13_17'])	? $forprint['EXO13_17']		: $default['EXO13_17']		);
$mar10_45	= trim(!empty($forprint['MAR10_45'])	? $forprint['MAR10_45']		: $default['MAR10_45']		);
$rom1_1		= trim(!empty($forprint['ROM1_1'])		? $forprint['ROM1_1']		: $default['ROM1_1']		);
$mat28_19	= trim(!empty($forprint['MAT28_19'])	? $forprint['MAT28_19']		: $default['MAT28_19']		);
// references
$joh3_16_b	= trim(!empty($forprint['JOH3_16_B'])	? $forprint['JOH3_16_B']	: $default['JOH3_16_B']		);
$gen3_24_b	= trim(!empty($forprint['GEN3_24_B'])	? $forprint['GEN3_24_B']	: $default['GEN3_24_B']		);
$luk23_34_b	= trim(!empty($forprint['LUK23_34_B'])	? $forprint['LUK23_34_B']	: $default['LUK23_34_B']	);
$rev21_2_3_b= trim(!empty($forprint['REV21_2_3_B'])	? $forprint['REV21_2_3_B']	: $default['REV21_2_3_B']	);
$heb11_8_b	= trim(!empty($forprint['HEB11_8_B'])	? $forprint['HEB11_8_B']	: $default['HEB11_8_B']		);
$exo13_17_b	= trim(!empty($forprint['EXO13_17_B'])	? $forprint['EXO13_17_B']	: $default['EXO13_17_B']	);
$mar10_45_b	= trim(!empty($forprint['MAR10_45_B'])	? $forprint['MAR10_45_B']	: $default['MAR10_45_B']	);
$rom1_1_b	= trim(!empty($forprint['ROM1_1_B'])	? $forprint['ROM1_1_B']		: $default['ROM1_1_B']		);
$mat28_19_b	= trim(!empty($forprint['MAT28_19_B'])	? $forprint['MAT28_19_B']	: $default['MAT28_19_B']	);
// RTL EXTRAS
$bidi_left	= ($rtl=="TRUE" ? 'bidi="yes" direction="rtl"' : '' );
$bidi_center= ($rtl=="TRUE" && !empty($w_free.$w_aka) ? 'bidi="yes" direction="rtl"' : ($rtl=="TRUE" ? 'bidi="yes"' : '' )); // very kludgey thing to do, but RTL bibles with default English free and aka must set this to ''
// fix cover stuff
$joh3_16 =
	($v_font=='FOREIGN' && !empty($joh3_16)
	? "<Span $langspeed><Fontface fontfamily='FF-BakF'><Value>$joh3_16</Value></Fontface></Span>"
	: (!empty($joh3_16)
	? "<Span $langspeed><Fontface fontfamily='FF-BakV'><Value>$joh3_16</Value></Fontface></Span>"
	: "<Span language='English (USA)'><Fontface fontfamily='FF-BakV'><Value>For God so loved the world</Value><Br /><Value>that he gave his only begotten Son</Value><Br /><Value>that whoever believes in him</Value><Br /><Value>should not perish, but have ...</Value></Fontface></Span>"));
$w_life	=
	($w_font=='FOREIGN' && !empty($w_life)
	? "<Span $langspeed><Fontface fontfamily='FF-AioF'><Value>$w_life</Value></Fontface></Span>"
	: (!empty($w_life)
	? "<Span $langspeed><Fontface fontfamily='FF-AioL'><Value>$w_life</Value></Fontface></Span>"
	: "<Span language='English (USA)'><Fontface fontfamily='FF-AioL'><Value>Life</Value></Fontface></Span>"));
$w_life	=
	($w_lifex
	? "$w_life<Br /><Fontface fontfamily='FF-AioB'><Value>Aionian!</Value></Fontface>"
	: ($rtl=="TRUE"
	? "<Span language='English (USA)'><Fontface fontfamily='FF-AioB'><Value>Aionian</Value></Fontface></Span><Br /><Span language='English (USA)'><Fontface fontfamily='FF-AioX'><Value>!</Value></Fontface></Span>$w_life"
	: "<Span language='English (USA)'><Fontface fontfamily='FF-AioB'><Value>Aionian</Value></Fontface></Span><Br />$w_life<Span language='English (USA)'><Fontface fontfamily='FF-AioX'><Value>!</Value></Fontface></Span>"));
$w_worl	=
	($w_font=='FOREIGN' && !empty($w_worl)
	? "<Span $langspeed><Fontface fontfamily='FF-BteF'><Value>$w_worl</Value></Fontface></Span>"
	: (!empty($w_worl)
	? "<Span $langspeed><Value>$w_worl</Value></Span>"
	: "<Span language='English (USA)'><Value>The world’s first Holy Bible untranslation</Value></Span>"));
$w_free	=
	($w_font=='FOREIGN' && !empty($w_free)
	? "<Span $langspeed><Fontface fontfamily='FF-BteF'><Value>$w_free</Value></Fontface></Span>"
	: (!empty($w_free)
	? "<Span $langspeed><Value>$w_free</Value></Span>"
	: "<Span language='English (USA)'><Value>100% free to copy and print</Value></Span>"));
$w_aka	=
	($w_font=='FOREIGN' && !empty($w_aka)
	? "<Span $langspeed><Fontface fontfamily='FF-BteF'><Value>$w_aka</Value></Fontface></Span><Br />"
	: (!empty($w_aka)
	? "<Span $langspeed><Value>$w_aka</Value></Span><Br />"
	: '<Span language="English (USA)"><Value>also known as</Value></Span><Br />'));
$w_purp	=
	($w_purp=="SKIP"
	? ""
	: ($rtl=='TRUE' && !empty($w_purp)
	? "<Span language='English (USA)'><Value> \" </Value></Span><Span $langspeed><Fontface fontfamily='FF-BteF'><Value>$w_purp</Value></Fontface></Span><Span language='English (USA)'><Value> \" </Value></Span>"	
	: ($w_font=='FOREIGN' && !empty($w_purp)
	? "<Span language='English (USA)'><Value>“ </Value></Span><Span $langspeed><Fontface fontfamily='FF-BteF'><Value>$w_purp</Value></Fontface></Span><Span language='English (USA)'><Value> ”</Value></Span><Br />"
	: (!empty($w_purp)
	? "<Span language='English (USA)'><Value>“ </Value></Span><Span $langspeed><Value>$w_purp</Value></Span><Span language='English (USA)'><Value> ”</Value></Span><Br />"
	: "<Span language='English (USA)'><Value>“ The Purple Bible ”</Value></Span><Br />"))));
// arial font for numbers, percents, hyphen, space
if ($w_font=='FOREIGN' && (!($w_free=preg_replace("/([\-0-9:% ]{3,})/","</Value><Span language='English (USA)'><Fontface fontfamily='FF-Btex'><Value> $1 </Value></Fontface></Span><Value>",$w_free,-1,$count)) || $count>1)) { AION_ECHO("JEFF NOTICE! preg_replace(numbers)"); }
// fonts
$fonts = AION_LOOP_PDF_POD_FONTS($font,$bsize,$bleading,$tsize,$tleading,$rsize,$rleading,$size,$leading,$numarialfont,$footsize,$backvl,$backtl,$backal,$backll,$headfont,$pixtext,$pixlead);
// options
$versionsMETA = "Holy Bible Aionian Edition, $versionE";
$keywordsMETA = (empty($language) ? "English" : $language) . ", Holy Bible, Scriptures, Aionian, Aion, Aionios, eleese, Hades, Gehenna, Tartarus, Abyss, Lake of Fire, Aiōn, Aiōnios, Aïdios, Sheol, Hadēs, Geenna, Tartaroō, Abyssos, Limnē Pyr, Purple Bible, Untranslation";
// title page
$versionFO_TI = "<Span $langspeed><Fontface fontfamily='$versionff'><Value>$version</Value></Fontface></Span>";
$versionEN_TI = ($version == $versionE ? "" : "<Br /><Span language='English (USA)'><Fontface fontfamily='FF-VerE'><Value>$versionE</Value></Fontface></Span>" );
$versionNT_TI = (!$newtonly ? "" : "<Br /><Span language='English (USA)'><Fontface fontfamily='FF-VerE'><Value>$newtonly</Value></Fontface></Span>");
// Binding version name
$versionEN_BI = (!$newtonly ? $versionE : ($newtonly=="New Testament" ? "$versionE NT" : "$versionE 22"));
// isbn
if ((empty($isbnpix) || $isbnpix=='ISBN.pdf') && (!empty($forprint[$isbntype]) && trim($forprint[$isbntype])!='UNKNOWN')) { AION_ECHO("JEFF WARNING! $bible/$isbntype number but no image!"); }
if ((!empty($isbnpix) && $isbnpix!='ISBN.pdf') && (empty($forprint[$isbntype]) || trim($forprint[$isbntype])=='UNKNOWN')) { AION_ECHO("JEFF WARNING! $bible/$isbntype image but no number!"); }
$isbnpixtest = (empty($isbnpix) || $isbnpix=='ISBN.pdf' ? "false()" : "true()");
// lulu extra 0.06" on spine
$spineadj = (empty($isbnpix) ? 0 : 0.06);
// hardbound margin
$hardmargin = ($hardmargin ? 0.75 : 0 );

if ($rtl!="TRUE") {
return <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<Layout xmlns="urn:speedata.de:2009/publisher/en" xmlns:sd="urn:speedata:2009/publisher/functions/en">
<PDFOptions author="https://NAINOIA-INC.signedon.net" title="$versionsMETA (CC BY-ND 4.0)" subject="The World's First Holy Bible Untranslation, the Gospel of Jesus Christ" keywords="$keywordsMETA" displaymode="bookmarks" />
<Options reportmissingglyphs="warning" mainlanguage="English (USA)" />
$fonts

<!-- DEFINE FORMATS -->
<DefineColor name='white'			model='cmyk'	c='0'	m='0'	y='0'	k='0' />
<DefineColor name='black'			model='cmyk'	c='0'	m='0'	y='0'	k='100' />
<DefineColor name='purpledark'		model='cmyk'	c='83'	m='100'	y='32'	k='28' />
<DefineColor name='purplelight'		model='cmyk'	c='72'	m='100'	y='15'	k='0' />
<DefineTextformat name="left"		alignment="leftaligned"		hyphenate="no" />
<DefineTextformat name="right"		alignment="rightaligned"	hyphenate="no" />
<DefineTextformat name="center"		alignment="centered"		hyphenate="no" />
<DefineTextformat name="centerpad"	alignment="centered"		hyphenate="no"		padding-top="10pt"		/>

<!-- CUSTOM VALUES -->
<SetVariable variable="cover_count"  select="sd:number-of-pages('$bodyfile')"/>
<SetVariable variable="cover_spine"  select="((\$cover_count * 0.002252252) + $spineadj)"/>
<Switch><Case test='$hardmargin > 0'><Switch>
<Case test='\$cover_count &lt;= 84'	><SetVariable variable="cover_spine"  select="0.25"	/></Case>
<Case test='\$cover_count &lt;= 140'><SetVariable variable="cover_spine"  select="0.5"	/></Case>
<Case test='\$cover_count &lt;= 168'><SetVariable variable="cover_spine"  select="0.625"/></Case>
<Case test='\$cover_count &lt;= 194'><SetVariable variable="cover_spine"  select="0.688"/></Case>
<Case test='\$cover_count &lt;= 222'><SetVariable variable="cover_spine"  select="0.75"	/></Case>
<Case test='\$cover_count &lt;= 250'><SetVariable variable="cover_spine"  select="0.813"/></Case>
<Case test='\$cover_count &lt;= 278'><SetVariable variable="cover_spine"  select="0.875"/></Case>
<Case test='\$cover_count &lt;= 306'><SetVariable variable="cover_spine"  select="0.938"/></Case>
<Case test='\$cover_count &lt;= 334'><SetVariable variable="cover_spine"  select="1"	/></Case>
<Case test='\$cover_count &lt;= 360'><SetVariable variable="cover_spine"  select="1.063"/></Case>
<Case test='\$cover_count &lt;= 388'><SetVariable variable="cover_spine"  select="1.125"/></Case>
<Case test='\$cover_count &lt;= 416'><SetVariable variable="cover_spine"  select="1.188"/></Case>
<Case test='\$cover_count &lt;= 444'><SetVariable variable="cover_spine"  select="1.25"	/></Case>
<Case test='\$cover_count &lt;= 472'><SetVariable variable="cover_spine"  select="1.313"/></Case>
<Case test='\$cover_count &lt;= 500'><SetVariable variable="cover_spine"  select="1.375"/></Case>
<Case test='\$cover_count &lt;= 528'><SetVariable variable="cover_spine"  select="1.438"/></Case>
<Case test='\$cover_count &lt;= 556'><SetVariable variable="cover_spine"  select="1.5"	/></Case>
<Case test='\$cover_count &lt;= 582'><SetVariable variable="cover_spine"  select="1.563"/></Case>
<Case test='\$cover_count &lt;= 610'><SetVariable variable="cover_spine"  select="1.625"/></Case>
<Case test='\$cover_count &lt;= 638'><SetVariable variable="cover_spine"  select="1.688"/></Case>
<Case test='\$cover_count &lt;= 666'><SetVariable variable="cover_spine"  select="1.75"	/></Case>
<Case test='\$cover_count &lt;= 694'><SetVariable variable="cover_spine"  select="1.813"/></Case>
<Case test='\$cover_count &lt;= 722'><SetVariable variable="cover_spine"  select="1.875"/></Case>
<Case test='\$cover_count &lt;= 750'><SetVariable variable="cover_spine"  select="1.938"/></Case>
<Case test='\$cover_count &lt;= 778'><SetVariable variable="cover_spine"  select="2"	/></Case>
<Case test='\$cover_count &lt;= 799'><SetVariable variable="cover_spine"  select="2.063"/></Case>
<Case test='\$cover_count >= 800'	><SetVariable variable="cover_spine"  select="2.125"/></Case>
</Switch></Case></Switch>
<SetVariable variable="cover_spineX" select="(\$cover_spine - 0.0625 - 0.0625 - $spineadj)"/>
<SetVariable variable="cover_width"  select="(0.125 + 6 + \$cover_spine + 6 + 0.125 + $hardmargin + $hardmargin)"/>
<SetVariable variable="cover_bindR"  select="(\$cover_width - 0.125 - 6 - 0.0625 - ($spineadj div 2) - $hardmargin)"/>
<SetVariable variable="cover_bindM"  select="($hardmargin + 0.125 + 6 + (\$cover_spine div 2))"/>
<SetVariable variable="cover_bindL"  select="($hardmargin + 0.125 + 6 + 0.0625 + ($spineadj div 2))"/>
<SetVariable variable="cover_height" select="(9 + 0.125 + 0.125 + $hardmargin + $hardmargin)"/>
<SetVariable variable="cover_margin" select="(0.375 + $hardmargin)"/>

<!-- DEFINE PAGES -->
<SetGrid width="4.5pt" height="4.5pt"/>
<Pageformat width="{\$cover_width} in" height="{\$cover_height} in"/>
<Pagetype name="page" test="true()"><Margin left="{\$cover_margin} in" right="{\$cover_margin} in" top="{\$cover_margin} in" bottom="{\$cover_margin} in"/></Pagetype>

<!-- BIBLE COVER -->
<Record element="bible">

	<!-- BACKGROUND -->
	<PlaceObject row="0 in" column="0 in" allocate="no"><Image file='COVER.jpg' height='10.75in' width='16.125in' clip='yes' /></PlaceObject>


	<!-- MARKERS -->
	<Switch><Case test='false()'>
		<PlaceObject row="0 in" column="{\$cover_bindL} in" allocate="no"><Rule direction="vertical" length="{\$cover_height} in" rulewidth="1pt" color="white" /></PlaceObject>
		<PlaceObject row="0 in" column="{\$cover_bindM} in" allocate="no"><Rule direction="vertical" length="{\$cover_height} in" rulewidth="1pt" color="white" /></PlaceObject>
		<PlaceObject row="0 in" column="{\$cover_bindR} in" allocate="no"><Rule direction="vertical" length="{\$cover_height} in" rulewidth="1pt" color="white" /></PlaceObject>
	</Case></Switch>
	
	<!-- BACK -->
	<SetVariable variable="xlocation" select="(0.75 + $hardmargin)"/>
	<SetVariable variable="ylocation" select="(1.375 + $hardmargin)"/>
	<PlaceObject row="{\$ylocation} in" column="{\$xlocation} in" background='full' background-color='purpledark' allocate="no">
	<Table width='4.75in' stretch='max' padding='0.125in'><Tr><Td>
	<Paragraph language="English (USA)" textformat="center" color='white' fontfamily="FF-Btex">
	$joh3_16<Br />
	$w_life<Br />
	<Image width="4in" height="1pt" file="COVER-rule-purplelight.jpg"/>
	</Paragraph>
	<Paragraph language="English (USA)" textformat="centerpad" color='white' fontfamily="FF-Btex">
	$w_worl<Br />
	$w_free<Br />
	<Value>AionianBible.org</Value><Br />
	<Value>Nainoia Inc</Value>
	</Paragraph>
	<Paragraph language="English (USA)" textformat="centerpad" color='white' fontfamily="FF-Btex">
	$w_aka
	$w_purp
	</Paragraph></Td></Tr></Table>
	</PlaceObject>

	<!-- ISBN WHITE BOX -->
	<SetVariable variable="xlocation" select="(3.425 + $hardmargin)"/>
	<SetVariable variable="ylocation" select="(7.775 + $hardmargin)"/>
	<Switch><Case test='$isbnpixtest'><PlaceObject row="{\$ylocation} in" column="{\$xlocation} in" allocate="no" background="full" background-color="white"><Image file='$isbnpix' /></PlaceObject></Case></Switch>
	
	<!-- BINDING -->
	<Switch>
		<Case test='\$cover_count >= 495'>
			<!-- BINDER FONTS -->
			<DefineFontfamily name="FX-Holy" fontsize="66" leading="72"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-Aion" fontsize="51" leading="51"><Regular fontface="FT-ALEX"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioE" fontsize="25" leading="25"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioR" fontsize="12" leading="12"><Regular fontface="FT-REGU"/></DefineFontfamily>
			<DefineFontfamily name="FX-VerE" fontsize="18" leading="18"><Regular fontface="FA-BOLD"/></DefineFontfamily>
			<SetVariable variable="cover_bindX" select="\$cover_bindR - max((0,((\$cover_spineX - 0.825) div 2)))"/>
			<SetVariable variable="ylocation" select="(0.375 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='4.125in'><Paragraph textformat="left" color='white'>
				<Fontface fontfamily="FX-Holy"><Value>Holy Bible</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
			<SetVariable variable="cover_bindZ" select="\$cover_bindR - max((0,((\$cover_spineX - 1) div 2)))"/>
			<SetVariable variable="ylocation" select="(4.25 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindZ} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="left" color='white'>
				<Fontface fontfamily="FX-Aion"><Value>Aionian </Value></Fontface>
				<Fontface fontfamily="FX-AioE"><Value>Edition</Value></Fontface>
				<Fontface fontfamily="FX-AioR"><Value>®</Value></Fontface><Br />
				<Fontface fontfamily="FX-VerE"><Value>$versionEN_BI</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
		</Case>
		<Case test='\$cover_count >= 210'>
			<!-- BINDER FONTS -->
			<DefineFontfamily name="FX-Holy" fontsize="23" leading="23"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-Aion" fontsize="26" leading="26"><Regular fontface="FT-ALEX"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioE" fontsize="19" leading="26"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioR" fontsize="14" leading="26"><Regular fontface="FT-REGU"/></DefineFontfamily>
			<DefineFontfamily name="FX-VerE" fontsize="19" leading="22"><Regular fontface="FA-BOLD"/></DefineFontfamily>
			<SetVariable variable="cover_bindX" select="\$cover_bindR - max((0,((\$cover_spineX - 0.33) div 2)))"/>
			<SetVariable variable="ylocation" select="(0.375 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="left" color='white'>
				<Fontface fontfamily="FX-Holy"><Value>Holy Bible</Value></Fontface>
				<Fontface fontfamily="FX-Aion"><Value> Aionian </Value></Fontface>
				<Fontface fontfamily="FX-AioE"><Value>Edition</Value></Fontface>
				<Fontface fontfamily="FX-AioR"><Value>®</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
			<SetVariable variable="ylocation" select="(3.875 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="right" color='white'>
				<Fontface fontfamily="FX-VerE"><Value>$versionEN_BI</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
		</Case>
		<Case test='\$cover_count >= 192'>
			<!-- BINDER FONTS -->
			<DefineFontfamily name="FX-Holy" fontsize="21" leading="21"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-Aion" fontsize="24" leading="24"><Regular fontface="FT-ALEX"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioE" fontsize="17" leading="24"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioR" fontsize="12" leading="24"><Regular fontface="FT-REGU"/></DefineFontfamily>
			<DefineFontfamily name="FX-VerE" fontsize="17" leading="20"><Regular fontface="FA-BOLD"/></DefineFontfamily>
			<SetVariable variable="cover_bindX" select="\$cover_bindR - max((0,((\$cover_spineX - 0.28) div 2)))"/>
			<SetVariable variable="ylocation" select="(0.375 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="left" color='white'>
				<Fontface fontfamily="FX-Holy"><Value>Holy Bible</Value></Fontface>
				<Fontface fontfamily="FX-Aion"><Value> Aionian </Value></Fontface>
				<Fontface fontfamily="FX-AioE"><Value>Edition</Value></Fontface>
				<Fontface fontfamily="FX-AioR"><Value>®</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
			<SetVariable variable="ylocation" select="(3.875 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="right" color='white'>
				<Fontface fontfamily="FX-VerE"><Value>$versionEN_BI</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
		</Case>
		<Case test='\$cover_count >= 182'>
			<!-- BINDER FONTS -->
			<DefineFontfamily name="FX-Holy" fontsize="19" leading="19"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-Aion" fontsize="22" leading="22"><Regular fontface="FT-ALEX"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioE" fontsize="15" leading="22"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioR" fontsize="10" leading="22"><Regular fontface="FT-REGU"/></DefineFontfamily>
			<DefineFontfamily name="FX-VerE" fontsize="15" leading="18"><Regular fontface="FA-BOLD"/></DefineFontfamily>
			<SetVariable variable="cover_bindX" select="\$cover_bindR - max((0,((\$cover_spineX - 0.26) div 2)))"/>
			<SetVariable variable="ylocation" select="(0.375 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="left" color='white'>
				<Fontface fontfamily="FX-Holy"><Value>Holy Bible</Value></Fontface>
				<Fontface fontfamily="FX-Aion"><Value> Aionian </Value></Fontface>
				<Fontface fontfamily="FX-AioE"><Value>Edition</Value></Fontface>
				<Fontface fontfamily="FX-AioR"><Value>®</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
			<SetVariable variable="ylocation" select="(3.875 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="right" color='white'>
				<Fontface fontfamily="FX-VerE"><Value>$versionEN_BI</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
		</Case>
		<Case test='\$cover_count >= 150'>
			<!-- BINDER FONTS -->
			<DefineFontfamily name="FX-Holy" fontsize="15" leading="15"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-Aion" fontsize="17" leading="17"><Regular fontface="FT-ALEX"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioE" fontsize="11" leading="17"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioR" fontsize="8"  leading="17"><Regular fontface="FT-REGU"/></DefineFontfamily>
			<DefineFontfamily name="FX-VerE" fontsize="14" leading="16"><Regular fontface="FA-BOLD"/></DefineFontfamily>
			<SetVariable variable="cover_bindX" select="\$cover_bindR - max((0,((\$cover_spineX - 0.21) div 2)))"/>
			<SetVariable variable="ylocation" select="(0.375 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="left" color='white'>
				<Fontface fontfamily="FX-Holy"><Value>Holy Bible</Value></Fontface>
				<Fontface fontfamily="FX-Aion"><Value> Aionian </Value></Fontface>
				<Fontface fontfamily="FX-AioE"><Value>Edition</Value></Fontface>
				<Fontface fontfamily="FX-AioR"><Value>®</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
			<SetVariable variable="ylocation" select="(3.875 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="right" color='white'>
				<Fontface fontfamily="FX-VerE"><Value>$versionEN_BI</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
		</Case>
		<Otherwise>
			<SetVariable variable="cover_bindX" select="'NA'"/>
		</Otherwise>
	</Switch>

	<!-- TITLE -->
	<SetVariable variable="xlocation" select="(\$cover_width - 0.5 - $hardmargin)"/>
	<SetVariable variable="ylocation" select="(0.875 + $hardmargin)"/>
	<PlaceObject row="{\$ylocation} in" column="0 in" allocate="no"><Textblock width='{\$xlocation} in'><Paragraph textformat="right" color='white'>
		<Fontface fontfamily="FF-Holy"><Value>Holy Bible</Value></Fontface><Br />
		<Fontface fontfamily="FF-Aion"><Value>Aionian </Value></Fontface>
		<Fontface fontfamily="FF-AioE"><Value>Edition</Value></Fontface>
		<Fontface fontfamily="FF-AioR"><Value>®</Value></Fontface>
	</Paragraph></Textblock></PlaceObject>

	<!-- TITLE continued -->
	<SetVariable variable="ylocation" select="(7.125 + $hardmargin)"/>
	<PlaceObject row="{\$ylocation} in" column="0 in" allocate="no"><Textblock width='{\$xlocation} in'><Paragraph language="English (USA)" textformat="right" color='white'>
		$versionFO_TI
		$versionEN_TI
		$versionNT_TI
		<Br /><Span language='English (USA)'><Fontface fontfamily='FF-VerE'><I><Value>- Nainoia Inc</Value></I></Fontface></Span>
	</Paragraph></Textblock></PlaceObject>
	
</Record>
</Layout>
EOT;
}
else {
return <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<Layout xmlns="urn:speedata.de:2009/publisher/en" xmlns:sd="urn:speedata:2009/publisher/functions/en">
<PDFOptions author="https://NAINOIA-INC.signedon.net" title="$versionsMETA (CC BY-ND 4.0)" subject="The World's First Holy Bible Untranslation, the Gospel of Jesus Christ" keywords="$keywordsMETA" displaymode="bookmarks" />
<Options reportmissingglyphs="warning" mainlanguage="English (USA)" />
$fonts

<!-- DEFINE FORMATS -->
<DefineColor name='white'			model='cmyk'	c='0'	m='0'	y='0'	k='0' />
<DefineColor name='black'			model='cmyk'	c='0'	m='0'	y='0'	k='100' />
<DefineColor name='purpledark'		model='cmyk'	c='83'	m='100'	y='32'	k='28' />
<DefineColor name='purplelight'		model='cmyk'	c='72'	m='100'	y='15'	k='0' />
<DefineTextformat name="left"		alignment="leftaligned"		hyphenate="no" />
<DefineTextformat name="right"		alignment="rightaligned"	hyphenate="no" />
<DefineTextformat name="center"		alignment="centered"		hyphenate="no" />
<DefineTextformat name="centerpad"	alignment="centered"		hyphenate="no"		padding-top="10pt"		/>

<!-- CUSTOM VALUES -->
<SetVariable variable="cover_count"  select="sd:number-of-pages('$bodyfile')"/>
<SetVariable variable="cover_spine"  select="((\$cover_count * 0.002252252) + $spineadj)"/>
<Switch><Case test='$hardmargin > 0'><Switch>
<Case test='\$cover_count &lt;= 84'	><SetVariable variable="cover_spine"  select="0.25"	/></Case>
<Case test='\$cover_count &lt;= 140'><SetVariable variable="cover_spine"  select="0.5"	/></Case>
<Case test='\$cover_count &lt;= 168'><SetVariable variable="cover_spine"  select="0.625"/></Case>
<Case test='\$cover_count &lt;= 194'><SetVariable variable="cover_spine"  select="0.688"/></Case>
<Case test='\$cover_count &lt;= 222'><SetVariable variable="cover_spine"  select="0.75"	/></Case>
<Case test='\$cover_count &lt;= 250'><SetVariable variable="cover_spine"  select="0.813"/></Case>
<Case test='\$cover_count &lt;= 278'><SetVariable variable="cover_spine"  select="0.875"/></Case>
<Case test='\$cover_count &lt;= 306'><SetVariable variable="cover_spine"  select="0.938"/></Case>
<Case test='\$cover_count &lt;= 334'><SetVariable variable="cover_spine"  select="1"	/></Case>
<Case test='\$cover_count &lt;= 360'><SetVariable variable="cover_spine"  select="1.063"/></Case>
<Case test='\$cover_count &lt;= 388'><SetVariable variable="cover_spine"  select="1.125"/></Case>
<Case test='\$cover_count &lt;= 416'><SetVariable variable="cover_spine"  select="1.188"/></Case>
<Case test='\$cover_count &lt;= 444'><SetVariable variable="cover_spine"  select="1.25"	/></Case>
<Case test='\$cover_count &lt;= 472'><SetVariable variable="cover_spine"  select="1.313"/></Case>
<Case test='\$cover_count &lt;= 500'><SetVariable variable="cover_spine"  select="1.375"/></Case>
<Case test='\$cover_count &lt;= 528'><SetVariable variable="cover_spine"  select="1.438"/></Case>
<Case test='\$cover_count &lt;= 556'><SetVariable variable="cover_spine"  select="1.5"	/></Case>
<Case test='\$cover_count &lt;= 582'><SetVariable variable="cover_spine"  select="1.563"/></Case>
<Case test='\$cover_count &lt;= 610'><SetVariable variable="cover_spine"  select="1.625"/></Case>
<Case test='\$cover_count &lt;= 638'><SetVariable variable="cover_spine"  select="1.688"/></Case>
<Case test='\$cover_count &lt;= 666'><SetVariable variable="cover_spine"  select="1.75"	/></Case>
<Case test='\$cover_count &lt;= 694'><SetVariable variable="cover_spine"  select="1.813"/></Case>
<Case test='\$cover_count &lt;= 722'><SetVariable variable="cover_spine"  select="1.875"/></Case>
<Case test='\$cover_count &lt;= 750'><SetVariable variable="cover_spine"  select="1.938"/></Case>
<Case test='\$cover_count &lt;= 778'><SetVariable variable="cover_spine"  select="2"	/></Case>
<Case test='\$cover_count &lt;= 799'><SetVariable variable="cover_spine"  select="2.063"/></Case>
<Case test='\$cover_count >= 800'	><SetVariable variable="cover_spine"  select="2.125"/></Case>
</Switch></Case></Switch>
<SetVariable variable="cover_spineX" select="(\$cover_spine - 0.0625 - 0.0625 - $spineadj)"/>
<SetVariable variable="cover_width"  select="(0.125 + 6 + \$cover_spine + 6 + 0.125 + $hardmargin + $hardmargin)"/>
<SetVariable variable="cover_bindR"  select="(\$cover_width - 0.125 - 6 - 0.0625 - ($spineadj div 2) - $hardmargin)"/>
<SetVariable variable="cover_bindM"  select="($hardmargin + 0.125 + 6 + (\$cover_spine div 2))"/>
<SetVariable variable="cover_bindL"  select="($hardmargin + 0.125 + 6 + 0.0625 + ($spineadj div 2))"/>
<SetVariable variable="cover_height" select="(9 + 0.125 + 0.125 + $hardmargin + $hardmargin)"/>
<SetVariable variable="cover_margin" select="(0.375 + $hardmargin)"/>

<!-- DEFINE PAGES -->
<SetGrid width="4.5pt" height="4.5pt"/>
<Pageformat width="{\$cover_width} in" height="{\$cover_height} in"/>
<Pagetype name="page" test="true()"><Margin left="{\$cover_margin} in" right="{\$cover_margin} in" top="{\$cover_margin} in" bottom="{\$cover_margin} in"/></Pagetype>

<!-- BIBLE COVER -->
<Record element="bible">

	<!-- BACKGROUND -->
	<PlaceObject row="0 in" column="0 in" allocate="no"><Image file='COVER.jpg' height='10.75in' width='16.125in' clip='yes' /></PlaceObject>

	<!-- MARKERS -->
	<Switch><Case test='false()'>
		<PlaceObject row="0 in" column="{\$cover_bindL} in" allocate="no"><Rule direction="vertical" length="{\$cover_height} in" rulewidth="1pt" color="white" /></PlaceObject>
		<PlaceObject row="0 in" column="{\$cover_bindM} in" allocate="no"><Rule direction="vertical" length="{\$cover_height} in" rulewidth="1pt" color="white" /></PlaceObject>
		<PlaceObject row="0 in" column="{\$cover_bindR} in" allocate="no"><Rule direction="vertical" length="{\$cover_height} in" rulewidth="1pt" color="white" /></PlaceObject>
	</Case></Switch>

	<!-- RTL TITLE -->
	<SetVariable variable="xlocation" select="(0.5 + $hardmargin)"/>
	<SetVariable variable="ylocation" select="(0.875 + $hardmargin)"/>
	<PlaceObject row="{\$ylocation} in" column="{\$xlocation} in" allocate="no"><Textblock width='5.5in'><Paragraph textformat="left" color='white'>
		<Fontface fontfamily="FF-Holy"><Value>Holy Bible</Value></Fontface><Br />
		<Fontface fontfamily="FF-Aion"><Value>Aionian </Value></Fontface>
		<Fontface fontfamily="FF-AioE"><Value>Edition</Value></Fontface>
		<Fontface fontfamily="FF-AioR"><Value>®</Value></Fontface>
	</Paragraph></Textblock></PlaceObject>

	<!-- TITLE continued -->
	<SetVariable variable="ylocation" select="(7.125 + $hardmargin)"/>
	<PlaceObject row="{\$ylocation} in" column="{\$xlocation} in" allocate="no"><Textblock width='5.5in'><Paragraph language="English (USA)" textformat="left" color='white' $bidi_left>
		$versionFO_TI
		$versionEN_TI
		$versionNT_TI
		<Br /><Span language='English (USA)'><Fontface fontfamily='FF-VerE'><I><Value>- Nainoia Inc</Value></I></Fontface></Span>
	</Paragraph></Textblock></PlaceObject>
	
	<!-- BINDING -->
	<Switch>
		<Case test='\$cover_count >= 495'>
			<!-- BINDER FONTS -->
			<DefineFontfamily name="FX-Holy" fontsize="66" leading="72"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-Aion" fontsize="51" leading="51"><Regular fontface="FT-ALEX"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioE" fontsize="25" leading="25"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioR" fontsize="12" leading="12"><Regular fontface="FT-REGU"/></DefineFontfamily>
			<DefineFontfamily name="FX-VerE" fontsize="18" leading="18"><Regular fontface="FA-BOLD"/></DefineFontfamily>
			<SetVariable variable="cover_bindX" select="\$cover_bindR - max((0,((\$cover_spineX - 0.825) div 2)))"/>
			<SetVariable variable="ylocation" select="(0.375 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='4.125in'><Paragraph textformat="left" color='white'>
				<Fontface fontfamily="FX-Holy"><Value>Holy Bible</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
			<SetVariable variable="cover_bindZ" select="\$cover_bindR - max((0,((\$cover_spineX - 1) div 2)))"/>
			<SetVariable variable="ylocation" select="(4.25 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindZ} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="left" color='white'>
				<Fontface fontfamily="FX-Aion"><Value>Aionian </Value></Fontface>
				<Fontface fontfamily="FX-AioE"><Value>Edition</Value></Fontface>
				<Fontface fontfamily="FX-AioR"><Value>®</Value></Fontface><Br />
				<Fontface fontfamily="FX-VerE"><Value>$versionEN_BI</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
		</Case>
		<Case test='\$cover_count >= 210'>
			<!-- BINDER FONTS -->
			<DefineFontfamily name="FX-Holy" fontsize="23" leading="23"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-Aion" fontsize="26" leading="26"><Regular fontface="FT-ALEX"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioE" fontsize="19" leading="26"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioR" fontsize="14" leading="26"><Regular fontface="FT-REGU"/></DefineFontfamily>
			<DefineFontfamily name="FX-VerE" fontsize="19" leading="22"><Regular fontface="FA-BOLD"/></DefineFontfamily>
			<SetVariable variable="cover_bindX" select="\$cover_bindR - max((0,((\$cover_spineX - 0.33) div 2)))"/>
			<SetVariable variable="ylocation" select="(0.375 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="left" color='white'>
				<Fontface fontfamily="FX-Holy"><Value>Holy Bible</Value></Fontface>
				<Fontface fontfamily="FX-Aion"><Value> Aionian </Value></Fontface>
				<Fontface fontfamily="FX-AioE"><Value>Edition</Value></Fontface>
				<Fontface fontfamily="FX-AioR"><Value>®</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
			<SetVariable variable="ylocation" select="(3.875 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="right" color='white'>
				<Fontface fontfamily="FX-VerE"><Value>$versionEN_BI</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
		</Case>
		<Case test='\$cover_count >= 192'>
			<!-- BINDER FONTS -->
			<DefineFontfamily name="FX-Holy" fontsize="21" leading="21"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-Aion" fontsize="24" leading="24"><Regular fontface="FT-ALEX"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioE" fontsize="17" leading="24"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioR" fontsize="12" leading="24"><Regular fontface="FT-REGU"/></DefineFontfamily>
			<DefineFontfamily name="FX-VerE" fontsize="17" leading="20"><Regular fontface="FA-BOLD"/></DefineFontfamily>
			<SetVariable variable="cover_bindX" select="\$cover_bindR - max((0,((\$cover_spineX - 0.28) div 2)))"/>
			<SetVariable variable="ylocation" select="(0.375 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="left" color='white'>
				<Fontface fontfamily="FX-Holy"><Value>Holy Bible</Value></Fontface>
				<Fontface fontfamily="FX-Aion"><Value> Aionian </Value></Fontface>
				<Fontface fontfamily="FX-AioE"><Value>Edition</Value></Fontface>
				<Fontface fontfamily="FX-AioR"><Value>®</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
			<SetVariable variable="ylocation" select="(3.875 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="right" color='white'>
				<Fontface fontfamily="FX-VerE"><Value>$versionEN_BI</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
		</Case>
		<Case test='\$cover_count >= 182'>
			<!-- BINDER FONTS -->
			<DefineFontfamily name="FX-Holy" fontsize="19" leading="19"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-Aion" fontsize="22" leading="22"><Regular fontface="FT-ALEX"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioE" fontsize="15" leading="22"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioR" fontsize="10" leading="22"><Regular fontface="FT-REGU"/></DefineFontfamily>
			<DefineFontfamily name="FX-VerE" fontsize="15" leading="18"><Regular fontface="FA-BOLD"/></DefineFontfamily>
			<SetVariable variable="cover_bindX" select="\$cover_bindR - max((0,((\$cover_spineX - 0.26) div 2)))"/>
			<SetVariable variable="ylocation" select="(0.375 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="left" color='white'>
				<Fontface fontfamily="FX-Holy"><Value>Holy Bible</Value></Fontface>
				<Fontface fontfamily="FX-Aion"><Value> Aionian </Value></Fontface>
				<Fontface fontfamily="FX-AioE"><Value>Edition</Value></Fontface>
				<Fontface fontfamily="FX-AioR"><Value>®</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
			<SetVariable variable="ylocation" select="(3.875 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="right" color='white'>
				<Fontface fontfamily="FX-VerE"><Value>$versionEN_BI</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
		</Case>
		<Case test='\$cover_count >= 150'>
			<!-- BINDER FONTS -->
			<DefineFontfamily name="FX-Holy" fontsize="15" leading="15"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-Aion" fontsize="17" leading="17"><Regular fontface="FT-ALEX"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioE" fontsize="11" leading="17"><Regular fontface="FT-IMPA"/></DefineFontfamily>
			<DefineFontfamily name="FX-AioR" fontsize="8"  leading="17"><Regular fontface="FT-REGU"/></DefineFontfamily>
			<DefineFontfamily name="FX-VerE" fontsize="14" leading="16"><Regular fontface="FA-BOLD"/></DefineFontfamily>
			<SetVariable variable="cover_bindX" select="\$cover_bindR - max((0,((\$cover_spineX - 0.21) div 2)))"/>
			<SetVariable variable="ylocation" select="(0.375 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="left" color='white'>
				<Fontface fontfamily="FX-Holy"><Value>Holy Bible</Value></Fontface>
				<Fontface fontfamily="FX-Aion"><Value> Aionian </Value></Fontface>
				<Fontface fontfamily="FX-AioE"><Value>Edition</Value></Fontface>
				<Fontface fontfamily="FX-AioR"><Value>®</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
			<SetVariable variable="ylocation" select="(3.875 + $hardmargin)"/>
			<PlaceObject row="{\$ylocation} in" column="{\$cover_bindX} in" allocate="no" rotate='90'><Textblock width='5in'><Paragraph textformat="right" color='white'>
				<Fontface fontfamily="FX-VerE"><Value>$versionEN_BI</Value></Fontface>
			</Paragraph></Textblock></PlaceObject>
		</Case>
		<Otherwise>
			<SetVariable variable="cover_bindX" select="'NA'"/>
		</Otherwise>
	</Switch>

	<!-- RTL BACK -->
	<SetVariable variable="xlocation" select="(\$cover_width - 0.75 - 4.75 - $hardmargin)"/>
	<SetVariable variable="ylocation" select="(1.375 + $hardmargin)"/>
	<PlaceObject row="{\$ylocation} in" column="{\$xlocation} in" background='full' background-color='purpledark' allocate="no">
	<Table width='4.75in' stretch='max' padding='0.125in'><Tr><Td>
	<Paragraph language="English (USA)" textformat="center" color='white' fontfamily="FF-Btex" $bidi_center>
	$joh3_16<Br />
	$w_life<Br />
	<Image width="4in" height="1pt" file="COVER-rule-purplelight.jpg"/>
	</Paragraph>
	<Paragraph language="English (USA)" textformat="centerpad" color='white' fontfamily="FF-Btex" $bidi_center>
	$w_worl<Br />
	$w_free<Br />
	<Value>AionianBible.org</Value><Br />
	<Value>Nainoia Inc</Value>
	</Paragraph>
	<Paragraph language="English (USA)" textformat="centerpad" color='white' fontfamily="FF-Btex" $bidi_center>
	$w_aka
	$w_purp
	</Paragraph></Td></Tr></Table>
	</PlaceObject>

	<!-- ISBN WHITE BOX -->
	<SetVariable variable="xlocation" select="(\$cover_width - $hardmargin - 6 + 3.425)"/>
	<SetVariable variable="xlocation" select="(3.425 + $hardmargin)"/>
	<SetVariable variable="ylocation" select="(7.775 + $hardmargin)"/>
	<Switch><Case test='$isbnpixtest'><PlaceObject row="{\$ylocation} in" column="{\$xlocation} in" allocate="no" background="full" background-color="white"><Image file='$isbnpix' /></PlaceObject></Case></Switch>
	
</Record>
</Layout>
EOT;
}
}



/*** LAYOUT POD */
function AION_LOOP_PDF_POD_FONTS($font,$bsize,$bleading,$tsize,$tleading,$rsize,$rleading,$size,$leading,$numarialfont,$fsize,$backvl,$backtl,$backal,$backll,$headfont,$pixtext,$pixlead) {

$harfbuzz = "mode=\"harfbuzz\"";
$loadfontfile = (
// Arabic
// Arabic - notonaskharabicui-regular.ttf used for online only for NOTO consistency, BUT missing \x{28}, \x{29}, \x{2d}, \x{2b}, '()-+', so easily found with CSS secondary fonts!
($font == "Arabic" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"amiri-regular.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"amiri-bold.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"amiri-slanted.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"amiri-boldslanted.ttf\"/>"
:
// Aramaic
($font == "Aramaic" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"estrangelo_edessa_plus.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"estrangelo_edessa_plus.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"estrangelo_edessa_plus.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"estrangelo_edessa_plus.ttf\" />"
:
// Armenian
($font == "Armenian" ?
"<LoadFontfile name=\"FB-REGU\" filename=\"arnamu_serif.ttf\"/>
 <LoadFontfile name=\"FB-BOLD\" filename=\"arnamu_serif_bold.ttf\"/>
 <LoadFontfile name=\"FB-ITAL\" filename=\"arnamu_serif_italic.ttf\"/>
 <LoadFontfile name=\"FB-BOIT\" filename=\"arnamu_serif_italic_bold.ttf\"/>"
:
// Bengali and Assamese
($font == "Bengali" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"solaimanlipi-plus.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"solaimanlipi_bold-plus.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"solaimanlipi-plus.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"solaimanlipi_bold-plus.ttf\" />"
:
// Cherokee
($font == "Cherokee" ?
"<LoadFontfile name=\"FB-REGU\" filename=\"donisiladv.ttf\"/>
 <LoadFontfile name=\"FB-BOLD\" filename=\"tsulehisanvhi.ttf\"/>
 <LoadFontfile name=\"FB-ITAL\" filename=\"donisiladv.ttf\"/>
 <LoadFontfile name=\"FB-BOIT\" filename=\"tsulehisanvhi.ttf\"/>"
:
// Chinese and Japanese
($font == "Babelstonehan" ?
"<LoadFontfile name=\"FB-REGU\" filename=\"babelstonehan.ttf\"/>
 <LoadFontfile name=\"FB-BOLD\" filename=\"babelstonehan.ttf\"/>
 <LoadFontfile name=\"FB-ITAL\" filename=\"babelstonehan.ttf\"/>
 <LoadFontfile name=\"FB-BOIT\" filename=\"babelstonehan.ttf\"/>"
:
// Coptic
($font == "Coptic" ?
"<LoadFontfile name=\"FB-REGU\" filename=\"newathu5_5.ttf\"/>
 <LoadFontfile name=\"FB-BOLD\" filename=\"newathubold5_5.ttf\"/>
 <LoadFontfile name=\"FB-ITAL\" filename=\"newathuitalic5_5.ttf\"/>
 <LoadFontfile name=\"FB-BOIT\" filename=\"newathubolditalic5_5.ttf\"/>"
:
// Devanagari - Marathi
($font == "Devanagari" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"notoserifdevanagari-regular.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"notoserifdevanagari-bold.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"notoserifdevanagari-regular.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"notoserifdevanagari-bold.ttf\"/>"
:
// Ezra, Hebrew
($font == "Ezra" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"ezra_sil.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"ezra_sil.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"ezra_sil.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"ezra_sil.ttf\"/>"
:
// Gentium
($font == "Gentium" ?
"<LoadFontfile name=\"FB-REGU\" filename=\"gentiumplus-r.ttf\"/>
 <LoadFontfile name=\"FB-BOLD\" filename=\"gentiumplus-r.ttf\"/>
 <LoadFontfile name=\"FB-ITAL\" filename=\"gentiumplus-i.ttf\"/>
 <LoadFontfile name=\"FB-BOIT\" filename=\"gentiumplus-i.ttf\"/>"
:
// Gujarati
($font == "Gujarati" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"notoserifgujarati-regular.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"notoserifgujarati-bold.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"notoserifgujarati-regular.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"notoserifgujarati-bold.ttf\"/>"
:
// Hindi / Urdu
($font == "Hindi" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"akshar_unicode.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"akshar_unicode.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"akshar_unicode.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"akshar_unicode.ttf\"/>"
:
// Kannada
($font == "Kannada" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"notoserifkannada-regular.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"notoserifkannada-bold.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"notoserifkannada-regular.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"notoserifkannada-bold.ttf\"/>"
:
// Khmer
($font == "Khmer" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"busra.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"busra-bold.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"busra-italics.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"busra-bolditalics.ttf\"/>"
:
// Korean
($font == "Korean" ?
"<LoadFontfile name=\"FB-REGU\" filename=\"unbatang.ttf\"/>
 <LoadFontfile name=\"FB-BOLD\" filename=\"unbatangbold.ttf\"/>
 <LoadFontfile name=\"FB-ITAL\" filename=\"unbatang.ttf\"/>
 <LoadFontfile name=\"FB-BOIT\" filename=\"unbatangbold.ttf\"/>"
:
// Liberation
($font == "Liberation" ?
"<LoadFontfile name=\"FB-REGU\" filename=\"liberationsansnarrow-regular.ttf\"/>
 <LoadFontfile name=\"FB-BOLD\" filename=\"liberationsansnarrow-bold.ttf\"/>
 <LoadFontfile name=\"FB-BOIT\" filename=\"liberationsansnarrow-bolditalic.ttf\"/>
 <LoadFontfile name=\"FB-ITAL\" filename=\"liberationsansnarrow-italic.ttf\"/>"
:
// Malayalam
($font == "Malayalam" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"notoserifmalayalam-regular-plus.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"notoserifmalayalam-bold-plus.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"notoserifmalayalam-regular-plus.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"notoserifmalayalam-bold-plus.ttf\" />"
:
// Myanmar
($font == "Myanmar" ?
//"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"mmrtext.ttf\" />
// <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"mmrtextb.ttf\" />
// <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"mmrtext.ttf\" />
// <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"mmrtextb.ttf\" />"
//"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"notosansmyanmar-regular-plus.ttf\" />
// <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"notosansmyanmar-bold-plus.ttf\" />
// <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"notosansmyanmar-italic-plus.ttf\" />
// <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"notosansmyanmar-bolditalic-plus.ttf\" />"
//"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"notoserifmyanmar-regular-plus.ttf\" />
// <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"notoserifmyanmar-bold-plus.ttf\" />
// <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"notoserifmyanmar-italic-plus.ttf\" />
// <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"notoserifmyanmar-bolditalic-plus.ttf\" />"
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"padauk-regular.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"padauk-bold.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"padauk-regular.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"padauk-bold.ttf\" />"
:
// Oriya
($font == "Oriya" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"notosansoriyaui-regular-plus.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"notosansoriyaui-bold-plus.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"notosansoriyaui-regular-plus.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"notosansoriyaui-bold-plus.ttf\" />"
:
// Panjabi
($font == "Panjabi" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"notosansgurmukhiui-regular-plus.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"notosansgurmukhiui-bold.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"notosansgurmukhiui-regular-plus.ttf\" />
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"notosansgurmukhiui-bold.ttf\" />"
:
// Persian, Scheherazade or notonaskharabicui-regular.ttf
($font == "Persian" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"scheherazade-regular.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"scheherazade-bold.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"scheherazade-regular.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"scheherazade-bold.ttf\"/>"
:
// Sinhala
($font == "Sinhala" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"abhayalibre.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"abhayalibre-bold.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"abhayalibre.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"abhayalibre-bold.ttf\"/>"
:
// Tamil
($font == "Tamil" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"notoseriftamil-semicondensed.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"notoseriftamil-semicondensedbold.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"notoseriftamil-semicondensed.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"notoseriftamil-semicondensedbold.ttf\"/>"
:
// Telugu
($font == "Telugu" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"notoseriftelugu-regular.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"notoseriftelugu-bold.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"notoseriftelugu-regular.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"notoseriftelugu-bold.ttf\"/>"
:
// Thai
($font == "Thai" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"notoserifthai_semicondensed.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"notoserifthai_semicondensed-bold.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"notoserifthai_semicondensed.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"notoserifthai_semicondensed-bold.ttf\"/>"
:
// Tibetan
($font == "Tibetan" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"notoseriftibetan.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"notoseriftibetan-bold.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"notoseriftibetan.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"notoseriftibetan-bold.ttf\"/>"
:
// Tibetan
($font == "NotoSans" ?
"<LoadFontfile $harfbuzz name=\"FB-REGU\" filename=\"notosans-basic-regular.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOLD\" filename=\"notosans-basic-bold.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-ITAL\" filename=\"notosans-basic-italic.ttf\"/>
 <LoadFontfile $harfbuzz name=\"FB-BOIT\" filename=\"notosans-basic-bolditalic.ttf\"/>"
:
// ERROR
AION_ECHO("ERROR! Font not found $font")))))))))))))))))))))))))))));

if ($numarialfont) {	$initfont = '<Regular fontface="FT-BOLD"/><Bold fontface="FT-BOLD"/><Italic fontface="FT-BOIT"/><BoldItalic fontface="FT-BOIT"/>';
						$numbfont = '<Regular fontface="FT-REGU"/><Bold fontface="FT-BOLD"/><Italic fontface="FT-ITAL"/><BoldItalic fontface="FT-BOIT"/>'; }
else {					$initfont = '<Regular fontface="FB-BOLD"/><Bold fontface="FB-BOLD"/><Italic fontface="FB-BOIT"/><BoldItalic fontface="FB-BOIT"/>';
						$numbfont = '<Regular fontface="FB-REGU"/><Bold fontface="FB-BOLD"/><Italic fontface="FB-ITAL"/><BoldItalic fontface="FB-BOIT"/>'; }
$nsize = min($size,max(7,$size-2));

$backvl		= (empty($backvl) ? "17.5" : $backvl);
$backtl		= (empty($backtl) ? "16.5" : $backtl); 
$backal		= (empty($backal) ? "55" : $backal);
$backll		= (empty($backll) ? "65" : $backll); 
$headfont	= (empty($headfont) ? "20" : $headfont);
$pixtext2	= (empty($pixtext) ? "9" : $pixtext);
$pixlead2	= (empty($pixlead) ? "13" : $pixlead);
$maptext	= (empty($pixtext) ? "9" : $pixtext);
$maplead	= (empty($pixlead) ? "12" : $pixlead);
	
return <<<EOT
<!-- LOAD FONT -->
<LoadFontfile name="FT-IMPA" filename="anton-regular.ttf"/>
<LoadFontfile name="FT-ALEX" filename="alexbrush-regular.ttf"/>
<LoadFontfile name="FT-REGU" filename="liberationsansnarrow-regular.ttf"/>
<LoadFontfile name="FT-BOLD" filename="liberationsansnarrow-bold.ttf"/>
<LoadFontfile name="FT-ITAL" filename="liberationsansnarrow-italic.ttf"/>
<LoadFontfile name="FT-BOIT" filename="liberationsansnarrow-bolditalic.ttf"/>
<LoadFontfile name="FA-REGU" filename="liberationsans-regular.ttf"/>
<LoadFontfile name="FA-BOLD" filename="liberationsans-bold.ttf"/>
<LoadFontfile name="FA-ITAL" filename="liberationsans-italic.ttf"/>
<LoadFontfile name="FA-BOIT" filename="liberationsans-bolditalic.ttf"/>
$loadfontfile

<!-- DEFINE FONT GLOBAL -->
<DefineFontfamily name="FF-Holy" fontsize="72"		leading="72"		><Regular fontface="FT-IMPA"/></DefineFontfamily>
<DefineFontfamily name="FF-Aion" fontsize="52"		leading="52"		><Regular fontface="FT-ALEX"/></DefineFontfamily>
<DefineFontfamily name="FF-AioB" fontsize="50"		leading="$backal"	><Regular fontface="FT-ALEX"/></DefineFontfamily>
<DefineFontfamily name="FF-AioE" fontsize="30"		leading="30"		><Regular fontface="FT-IMPA"/></DefineFontfamily>
<DefineFontfamily name="FF-AioR" fontsize="12"		leading="12"		><Regular fontface="FT-REGU"/></DefineFontfamily>

<!-- DEFINE FONT ENGLISH -->
<DefineFontfamily name="FF-VerE" fontsize="20"		leading="30"		><Regular fontface="FA-BOLD"/><Bold fontface="FA-BOLD"/><Italic fontface="FA-BOIT"/><BoldItalic fontface="FA-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-Copy" fontsize="10"		leading="11.5"		><Regular fontface="FT-REGU"/><Bold fontface="FT-BOLD"/><Italic fontface="FT-ITAL"/><BoldItalic fontface="FT-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-Pref" fontsize="11.2"	leading="12.4"		><Regular fontface="FT-REGU"/><Bold fontface="FT-BOLD"/><Italic fontface="FT-ITAL"/><BoldItalic fontface="FT-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-Toc2" fontsize="12"		leading="14"		><Regular fontface="FT-REGU"/><Bold fontface="FT-BOLD"/><Italic fontface="FT-ITAL"/><BoldItalic fontface="FT-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-Head" fontsize="20"		leading="20"		><Regular fontface="FA-BOLD"/><Bold fontface="FA-BOLD"/><Italic fontface="FA-BOIT"/><BoldItalic fontface="FA-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-Pixx" fontsize="14"		leading="16"		><Regular fontface="FT-REGU"/><Bold fontface="FT-BOLD"/><Italic fontface="FT-ITAL"/><BoldItalic fontface="FT-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-Pixt" fontsize="9"		leading="13"		><Regular fontface="FT-REGU"/><Bold fontface="FT-BOLD"/><Italic fontface="FT-ITAL"/><BoldItalic fontface="FT-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-Pmap" fontsize="9"		leading="12"		><Regular fontface="FT-REGU"/><Bold fontface="FT-BOLD"/><Italic fontface="FT-ITAL"/><BoldItalic fontface="FT-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-Glos" fontsize="13"		leading="14.5"		><Regular fontface="FT-REGU"/><Bold fontface="FT-BOLD"/><Italic fontface="FT-ITAL"/><BoldItalic fontface="FT-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-BakV" fontsize="14"		leading="17"		><Regular fontface="FT-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-Btex" fontsize="13"		leading="17"		><Regular fontface="FT-BOLD"/></DefineFontfamily>
<DefineFontfamily name="FF-AioL" fontsize="50"		leading="$backll"	><Regular fontface="FT-IMPA"/></DefineFontfamily>
<DefineFontfamily name="FF-AioX" fontsize="100"		leading="60"		><Regular fontface="FT-ALEX"/></DefineFontfamily>
<DefineFontfamily name="FF-Tiny" fontsize="5"	leading="5"				><Regular fontface="FT-REGU"/><Bold fontface="FT-BOLD"/><Italic fontface="FT-ITAL"/><BoldItalic fontface="FT-BOIT"/></DefineFontfamily>

<!-- DEFINE FONT FOREIGN -->
<DefineFontfamily name="FF-Vers" fontsize="20"		leading="30"		><Regular fontface="FB-BOLD"/><Bold fontface="FB-BOLD"/><Italic fontface="FB-BOIT"/><BoldItalic fontface="FB-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-Cver" fontsize="10"		leading="20"		><Regular fontface="FB-REGU"/><Bold fontface="FB-BOLD"/><Italic fontface="FB-ITAL"/><BoldItalic fontface="FB-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-Pre2" fontsize="11.2"	leading="12.4"		><Regular fontface="FB-REGU"/><Bold fontface="FB-BOLD"/><Italic fontface="FB-ITAL"/><BoldItalic fontface="FB-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-TOCS" fontsize="$tsize"	leading="$tleading"	><Regular fontface="FB-REGU"/><Bold fontface="FB-BOLD"/><Italic fontface="FB-ITAL"/><BoldItalic fontface="FB-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-TNUM" fontsize="$tsize"	leading="$tleading"	><Regular fontface="FT-REGU"/><Bold fontface="FT-BOLD"/><Italic fontface="FT-ITAL"/><BoldItalic fontface="FT-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-Book" fontsize="$bsize"	leading="$bleading"	><Regular fontface="FB-BOLD"/><Bold fontface="FB-BOLD"/><Italic fontface="FB-BOIT"/><BoldItalic fontface="FB-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-Init" fontsize="18"		leading="18"		>$initfont</DefineFontfamily>
<DefineFontfamily name="FF-Bibl" fontsize="$size"	leading="$leading"	><Regular fontface="FB-REGU"/><Bold fontface="FB-BOLD"/><Italic fontface="FB-ITAL"/><BoldItalic fontface="FB-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-Bnot" fontsize="$nsize"	leading="$leading"	><Regular fontface="FT-REGU"/><Bold fontface="FT-BOLD"/><Italic fontface="FT-ITAL"/><BoldItalic fontface="FT-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-Bnum" fontsize="$nsize"	leading="$leading"	>$numbfont</DefineFontfamily>
<DefineFontfamily name="FF-Foot" fontsize="$fsize"	leading="10"		><Regular fontface="FB-REGU"/><Bold fontface="FB-BOLD"/><Italic fontface="FB-ITAL"/><BoldItalic fontface="FB-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-Fnum" fontsize="$fsize"	leading="10"		><Regular fontface="FT-REGU"/><Bold fontface="FT-BOLD"/><Italic fontface="FT-ITAL"/><BoldItalic fontface="FT-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-HeaF" fontsize="$headfont"	leading="20"	><Regular fontface="FB-BOLD"/><Bold fontface="FB-BOLD"/><Italic fontface="FB-BOIT"/><BoldItalic fontface="FB-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-TocF" fontsize="$tsize"	leading="$tleading"	><Regular fontface="FB-REGU"/><Bold fontface="FB-BOLD"/><Italic fontface="FB-ITAL"/><BoldItalic fontface="FB-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-PixF" fontsize="$pixtext2"	leading="$pixlead2"	><Regular fontface="FB-REGU"/><Bold fontface="FB-BOLD"/><Italic fontface="FB-ITAL"/><BoldItalic fontface="FB-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-PmaF" fontsize="$maptext"	leading="$maplead"	><Regular fontface="FB-REGU"/><Bold fontface="FB-BOLD"/><Italic fontface="FB-ITAL"/><BoldItalic fontface="FB-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-BakF" fontsize="14"		leading="$backvl"	><Regular fontface="FB-BOIT"/></DefineFontfamily>
<DefineFontfamily name="FF-BteF" fontsize="13"		leading="$backtl"	><Regular fontface="FB-BOLD"/></DefineFontfamily>
<DefineFontfamily name="FF-AioF" fontsize="50"		leading="$backll"	><Regular fontface="FB-BOLD"/></DefineFontfamily>
<DefineFontfamily name="FF-Refs" fontsize="$rsize"	leading="$rleading"	><Regular fontface="FB-REGU"/><Bold fontface="FB-BOLD"/><Italic fontface="FB-ITAL"/><BoldItalic fontface="FB-BOIT"/></DefineFontfamily>
EOT;
}


/*** GLOSSARY REFERENCES */
function AION_GLOSSARY_REFERENCES_GET( $bible, &$database, $args) {
	$database['T_GLOSSARY_REFERENCES'] = $args['database'][T_UNTRANSLATE];
}
function AION_GLOSSARY_REFERENCES_PUT( $bible, $database, $args, $tt22, $langspeed) {
	foreach($database['T_GLOSSARY_REFERENCES'] as $key => $verse) {
		$BOOKX = array_search($verse['BOOK'], $args['database']['T_BOOKS']['CODE']);
		$BOOKENGLISH = $args['database']['T_BOOKS']['ENGLISH'][$BOOKX];
		$BOOK = $args['database']['T_BOOKS'][$bible][$BOOKX];
		if(strpos($BOOK,'"')!==FALSE || strpos($BOOKENGLISH,'"')!==FALSE) { AION_ECHO("ERROR! book name quote problem! $BOOK $BOOKENGLISH"); }
		if (empty($BOOK) || $BOOK=='NULL') { $BOOK = $BOOKENGLISH; }
		$CHAPTER = $args['database']['T_NUMBERS'][$bible][(int)$verse['CHAPTER']];
		$VERSE = $args['database']['T_NUMBERS'][$bible][(int)$verse['VERSE']];
		$database['T_GLOSSARY_REFERENCES'][$key]['ENGLISH_BOOK']=$BOOKENGLISH;
		$database['T_GLOSSARY_REFERENCES'][$key]['ENGLISH_CHAPTER']=(int)$verse['CHAPTER'];
		$database['T_GLOSSARY_REFERENCES'][$key]['ENGLISH_VERSE']=(int)$verse['VERSE'];
		$database['T_GLOSSARY_REFERENCES'][$key]['FOREIGN_BOOK']=$BOOK;
		$database['T_GLOSSARY_REFERENCES'][$key]['FOREIGN_CHAPTER']=$CHAPTER;
		$database['T_GLOSSARY_REFERENCES'][$key]['FOREIGN_VERSE']=$VERSE;
	}	
	$references = "<references_element>\n";
	foreach($database['T_GLOSSARY_REFERENCES'] as $key => $verse) {
		$BOOK = $database['T_GLOSSARY_REFERENCES'][$key]['FOREIGN_BOOK'];
		$LANG = ($BOOK == $database['T_GLOSSARY_REFERENCES'][$key]['ENGLISH_BOOK'] ? "English (USA)" : $langspeed);
		$CHAP = $database['T_GLOSSARY_REFERENCES'][$key]['FOREIGN_CHAPTER'];
		$VERS = $database['T_GLOSSARY_REFERENCES'][$key]['FOREIGN_VERSE'];
		$MARK = (empty($database['T_GLOSSARY_REFERENCES'][$key]['MARK']) ? "" : $database['T_GLOSSARY_REFERENCES'][$key]['MARK']);
		$GLOS = 'ABYSS';		if (stripos($verse['WORD'],$GLOS)!==FALSE) {	$references .= "<$GLOS BOOK=\"$BOOK\" CHAPTER=\"$CHAP\" VERSE=\"$VERS\" MARK=\"$MARK\" LANG=\"$LANG\"></$GLOS>\n"; }
		$GLOS = 'AIDIOS';		if (stripos($verse['WORD'],$GLOS)!==FALSE) {	$references .= "<$GLOS BOOK=\"$BOOK\" CHAPTER=\"$CHAP\" VERSE=\"$VERS\" MARK=\"$MARK\" LANG=\"$LANG\"></$GLOS>\n"; }
		$GLOS = 'AIONS';		if (stripos($verse['WORD'],$GLOS)!==FALSE) {	$references .= "<$GLOS BOOK=\"$BOOK\" CHAPTER=\"$CHAP\" VERSE=\"$VERS\" MARK=\"$MARK\" LANG=\"$LANG\"></$GLOS>\n"; }
		$GLOS = 'AIONIAN';		if (stripos($verse['WORD'],$GLOS)!==FALSE) {	$references .= "<$GLOS BOOK=\"$BOOK\" CHAPTER=\"$CHAP\" VERSE=\"$VERS\" MARK=\"$MARK\" LANG=\"$LANG\"></$GLOS>\n"; }
		$GLOS = 'ELEESE';		if (stripos($verse['WORD'],$GLOS)!==FALSE) {	$references .= "<$GLOS BOOK=\"$BOOK\" CHAPTER=\"$CHAP\" VERSE=\"$VERS\" MARK=\"$MARK\" LANG=\"$LANG\"></$GLOS>\n"; }
		$GLOS = 'GEHENNA';		if (stripos($verse['WORD'],$GLOS)!==FALSE) {	$references .= "<$GLOS BOOK=\"$BOOK\" CHAPTER=\"$CHAP\" VERSE=\"$VERS\" MARK=\"$MARK\" LANG=\"$LANG\"></$GLOS>\n"; }
		$GLOS = 'HADES';		if (stripos($verse['WORD'],$GLOS)!==FALSE) {	$references .= "<$GLOS BOOK=\"$BOOK\" CHAPTER=\"$CHAP\" VERSE=\"$VERS\" MARK=\"$MARK\" LANG=\"$LANG\"></$GLOS>\n"; }
		$GLOS = 'LOF';			if (stripos($verse['WORD'],$GLOS)!==FALSE) {	$references .= "<$GLOS BOOK=\"$BOOK\" CHAPTER=\"$CHAP\" VERSE=\"$VERS\" MARK=\"$MARK\" LANG=\"$LANG\"></$GLOS>\n"; }
		$GLOS = 'SHEOL';		if (stripos($verse['WORD'],$GLOS)!==FALSE) {	$references .= "<$GLOS BOOK=\"$BOOK\" CHAPTER=\"$CHAP\" VERSE=\"$VERS\" MARK=\"$MARK\" LANG=\"$LANG\"></$GLOS>\n"; }
		$GLOS = 'TARTARUS';		if (stripos($verse['WORD'],$GLOS)!==FALSE) {	$references .= "<$GLOS BOOK=\"$BOOK\" CHAPTER=\"$CHAP\" VERSE=\"$VERS\" MARK=\"$MARK\" LANG=\"$LANG\"></$GLOS>\n"; }
		$GLOS = 'QUESTIONED';	if (stripos($verse['WORD'],$GLOS)!==FALSE) {	$references .= "<$GLOS BOOK=\"$BOOK\" CHAPTER=\"$CHAP\" VERSE=\"$VERS\" MARK=\"$MARK\" LANG=\"$LANG\"></$GLOS>\n"; }
	}
	$references .= "</references_element>";
	if (!file_put_contents(($filename="$bible---Aionian-Edition-references_dataset.dataxml"), $references))			{ AION_ECHO("ERROR! file_put_contents: $filename"); }
	if (!file_put_contents(($filename="$bible---Aionian-Edition---STUDY-references_dataset.dataxml"), $references))	{ AION_ECHO("ERROR! file_put_contents: $filename"); }
	if (!file_put_contents(($filename="$bible---POD_KDP_ALL_BODY-references_dataset.dataxml"), $references))		{ AION_ECHO("ERROR! file_put_contents: $filename"); }
	if ($tt22 && !file_put_contents(($filename="$bible---POD_KDP_X22_BODY-references_dataset.dataxml"), $references)){ AION_ECHO("ERROR! file_put_contents: $filename"); }
	if (!file_put_contents(($filename="$bible---POD_KDP_NEW_BODY-references_dataset.dataxml"), $references))		{ AION_ECHO("ERROR! file_put_contents: $filename"); }
}


/*** RESORT HEBREW BIBLE AND OTHERS ***/
function AION_FILE_BIBLE_RESORT( $forprint, &$database ) {
	if ($forprint['LANGUAGE']!="Hebrew") { return; }
	AION_ECHO("WARN! resorting bible: ".$forprint['BIBLE']);
	$hebrew_map = array(
'008' => '031',
'009' => '008',
'010' => '009',
'011' => '010',
'012' => '011',
'013' => '038',
'014' => '039',
'015' => '036',
'016' => '037',
'017' => '034',
'018' => '028',
'019' => '027',
'020' => '029',
'021' => '032',
'022' => '031',
'023' => '012',
'024' => '013',
'025' => '033',
'026' => '014',
'027' => '035',
'028' => '015',
'029' => '016',
'030' => '017',
'031' => '018',
'032' => '019',
'033' => '020',
'034' => '021',
'035' => '022',
'036' => '023',
'037' => '024',
'038' => '025',
'039' => '026',
	);
	foreach($database['T_BIBLE'] as $ref => $verse) {
		if (empty($hebrew_map[$verse['INDEX']])) { continue; }
		$new = $hebrew_map[$verse['INDEX']].'-'.$verse['BOOK'].'-'.$verse['CHAPTER'].'-'.$verse['VERSE'];
		$database['T_BIBLE'][$new] = $verse;
		unset($database['T_BIBLE'][$ref]);
	}
	if (!ksort($database['T_BIBLE'])) { AION_ECHO("ERROR! problem resorting bible: ".$database['T_FORPRINT']['BIBLE']); }
}
