#!/usr/local/bin/php
<?php



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// PWA
AION_LOOP_PWA(	'/home/inmoti55/public_html/domain.aionianbible.org/www-stageresources',
				'/home/inmoti55/public_html/domain.aionianbible.org/www-stage/library/pwa' );
AION_ECHO("DONE!");
return;



// LOOP
function AION_LOOP_PWA($source, $destiny) {
	$database = array();
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATE.txt',	'T_UNTRANSLATE',	$database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKS.txt',		'T_BOOKS',			$database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/NUMBERS.txt',		'T_NUMBERS',		$database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/VERSIONS.txt',		'T_VERSIONS',		$database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/FORPRINT.txt',		'T_FORPRINT',		$database, 'BIBLE', FALSE );
	AION_LOOP( array(
		'function'		=> 'AION_LOOP_PWA_DOIT',
		'source'		=> $source,
		//'include'		=> "/Holy-Bible---.*(Albanian).*---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---.*(Aionian-Bible|Traditional).*---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---.+(Basic).+---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---.*(Azerb|Gaelic|Somali).*---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---.*(STEPBible).*---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---English---Aionian-Bible---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---Gamotso---Gamo---Aionian-Edition\.noia$/",
		'include'		=> "/---Aionian-Edition\.noia$/",
		'database'		=> $database,
		'destiny'		=> $destiny,
		) );
	AION_unset($database); unset($database);
	AION_ECHO("DONE DID IT!");
}



// BIBLE
function AION_LOOP_PWA_DOIT($args) {
	// GLOBALS
	global $G_PWA, $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_RTL;
	$G_PWA = new stdClass();
	$G_PWA->modified = date("n/j/Y");

	// BIBLE
	if (!preg_match("/\/Holy-Bible---(.*)---Aionian-Edition\.noia/", $args['filepath'], $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']); }
	$bible = $G_PWA->bible = "Holy-Bible---$matches[1]";
	$G_PWA->bible_basic = $matches[1];
	$error = "{$G_PWA->bible_basic} PWA,";
	if (empty($args['database'][T_BOOKS][$bible])) {													AION_ECHO("ERROR! $error Failed to find BOOK[bible]"); }
	if (($x=count($args['database'][T_BOOKS][$bible]))!=67) {											AION_ECHO("ERROR! $error Count(args[T_BOOKS][BIBLE])!=67: $x"); }
	if (empty($args['database'][T_NUMBERS][$bible])) {													AION_ECHO("ERROR! $error Failed to find NUMBERS[bible]"); }
	if (empty($args['database'][T_VERSIONS][$bible])) {													AION_ECHO("ERROR! $error Failed to find VERSIONS[bible]"); }
	if (empty($args['database'][T_FORPRINT][$bible])) {													AION_ECHO("ERROR! $error Failed to find FORPRINT[bible]"); }

	// ASSIGNMENTS
	$G_BOOKS	= $args['database'][T_BOOKS][$bible];
	$G_NUMBERS	= $args['database'][T_NUMBERS][$bible];
	$G_VERSIONS	= $args['database'][T_VERSIONS][$bible];
	$G_FORPRINT	= $args['database'][T_FORPRINT][$bible];
	$G_RTL		= (empty($G_VERSIONS['RTL']) ? "" : "dir='rtl'");
	$G_ISO		= (empty($G_VERSIONS['LANGUAGECODEISO']) ? "" : "lang='".$G_VERSIONS['LANGUAGECODEISO']."'");
	$G_PWA->bible_text	= NULL;
	$G_PWA->bible_numb	= 0;

	// SOURCE
	$base = $args['source'].'/'.$bible;
	$sour = (
		(is_file($base.'---Source-Edition.STEP.txt')	? '---Source-Edition.STEP.txt' :
		(is_file($base.'---Source-Edition.NHEB.txt')	? '---Source-Edition.NHEB.txt' :
		(is_file($base.'---Source-Edition.VPL.txt')		? '---Source-Edition.VPL.txt' :
		(is_file($base.'---Source-Edition.UNBOUND.txt')	? '---Source-Edition.UNBOUND.txt' :
		(is_file($base.'---Source-Edition.B4U.txt')		? '---Source-Edition.B4U.txt' :
		(is_file($base.'---Source-Edition.SWORD.txt')	? '---Source-Edition.SWORD.txt' : NULL)))))));
	if (empty($sour) || !AION_filesize($base.$sour)) { AION_ECHO("ERROR! $error AION_FILE_DATABASE_PUT no source extension found!"); }
	$G_VERSIONS['SOURCEVERSION'] = (filemtime($base.$sour)===FALSE ? '' : ("Source version: ".date("n/j/Y", filemtime($base.$sour))."<br>"));

	// CREATE CUSTOM EPUB FOLDER FILES
	// BIBLE CSS
	$csshed = "class='ff' $G_ISO $G_RTL";
	$cssbok = "class='ff bok' $G_ISO $G_RTL";
	$cssrtl = "class='ff rtl' $G_ISO $G_RTL";
	$cssver = "class='ff ver' $G_ISO $G_RTL";
	$csstex = "class='ff tex' $G_ISO $G_RTL";
	$cssavh = "class='ff tex avh' $G_ISO $G_RTL";
	$cssnum = "class='ff num' $G_ISO $G_RTL";
	$csslan = "class='ff lan' $G_ISO $G_RTL";
	
	// PREPARE LANGUAGE
	$G_VERSIONS['LANGUAGEHTML'] = (empty($G_VERSIONS['LANGUAGE']) || $G_VERSIONS['LANGUAGE']=="English" ? "English" : "{$G_VERSIONS['LANGUAGEENGLISH']} / <span $csslan>{$G_VERSIONS['LANGUAGE']}</span>");
	
	// PREPARE Language Headings
	$G_FORPRINT['W_PREF']	= (empty($G_FORPRINT['W_PREF'])		? "Preface"				: "Preface / <span $csshed>".$G_FORPRINT['W_PREF']."</span>");
	$G_FORPRINT['W_OLD']	= (empty($G_FORPRINT['W_OLD'])		? "Old Testament"		: "Old Testament / <span $csshed>".$G_FORPRINT['W_OLD']."</span>");
	$G_FORPRINT['W_NEW']	= (empty($G_FORPRINT['W_NEW'])		? "New Testament"		: "New Testament / <span $csshed>".$G_FORPRINT['W_NEW']."</span>");
	$G_FORPRINT['W_TOC']	= (empty($G_FORPRINT['W_TOC'])		? "Table of Contents"	: "Table of Contents / <span $csshed>".$G_FORPRINT['W_TOC']."</span>");
	$G_FORPRINT['W_APDX']	= (empty($G_FORPRINT['W_APDX'])		? "Appendix"			: "Appendix / <span $csshed>".$G_FORPRINT['W_APDX']."</span>");
	$G_FORPRINT['W_READ']	= (empty($G_FORPRINT['W_READ'])		? "Reader's Guide"		: "Reader's Guide / <span $csshed>".$G_FORPRINT['W_READ']."</span>");
	$G_FORPRINT['W_GLOS']	= (empty($G_FORPRINT['W_GLOS'])		? "Aionian Glossary"	: "Aionian Glossary / <span $csshed>".$G_FORPRINT['W_GLOS']."</span>");
	$G_FORPRINT['W_MAP']	= (empty($G_FORPRINT['W_MAP'])		? "Maps"				: "Maps / <span $csshed>".$G_FORPRINT['W_MAP']."</span>");
	$G_FORPRINT['W_ILUS']	= (empty($G_FORPRINT['W_ILUS'])		? "Illustrations"		: "Illustrations / <span $csshed>".$G_FORPRINT['W_ILUS']."</span>");
	$G_FORPRINT['W_DESTINY']= (empty($G_FORPRINT['W_DESTINY'])	? "Destiny"				: "Destiny / <span $csshed>".$G_FORPRINT['W_DESTINY']."</span>");
	$G_FORPRINT['W_HIST']	= (empty($G_FORPRINT['W_HIST'])		? "History"				: "History / <span $csshed>".$G_FORPRINT['W_HIST']."</span>");
	
	// REMOVE any XML
	$G_FORPRINT['JOH3_16']	= trim($G_FORPRINT['JOH3_16']);
	$G_FORPRINT['GEN3_24']	= trim($G_FORPRINT['GEN3_24']);
	$G_FORPRINT['LUK23_34']	= trim($G_FORPRINT['LUK23_34']);
	$G_FORPRINT['REV21_2_3']= trim($G_FORPRINT['REV21_2_3']);
	$G_FORPRINT['HEB11_8']	= trim($G_FORPRINT['HEB11_8']);
	$G_FORPRINT['EXO13_17']	= trim($G_FORPRINT['EXO13_17']);
	$G_FORPRINT['MAR10_45']	= trim($G_FORPRINT['MAR10_45']);
	$G_FORPRINT['ROM1_1']	= trim($G_FORPRINT['ROM1_1']);
	$G_FORPRINT['MAT28_19']	= trim($G_FORPRINT['MAT28_19']);	
	
	if (!empty($G_FORPRINT['JOH3_16'])	&& !($G_FORPRINT['JOH3_16']		= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['JOH3_16'],-1)))) {	AION_ECHO("ERROR! $error preg_rep(JOH3_16)"); }
	if (!empty($G_FORPRINT['GEN3_24'])	&& !($G_FORPRINT['GEN3_24']		= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['GEN3_24'],-1)))) {	AION_ECHO("ERROR! $error preg_rep(GEN3_24)"); } 
	if (!empty($G_FORPRINT['LUK23_34'])	&& !($G_FORPRINT['LUK23_34']	= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['LUK23_34'],-1)))) {	AION_ECHO("ERROR! $error preg_rep(LUK23_34)"); }
	if (!empty($G_FORPRINT['REV21_2_3'])&& !($G_FORPRINT['REV21_2_3']	= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['REV21_2_3'],-1)))) {	AION_ECHO("ERROR! $error preg_rep(REV21_2_3)"); }
	if (!empty($G_FORPRINT['HEB11_8'])	&& !($G_FORPRINT['HEB11_8']		= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['HEB11_8'],-1)))) {	AION_ECHO("ERROR! $error preg_rep(HEB11_8)"); }
	if (!empty($G_FORPRINT['EXO13_17'])	&& !($G_FORPRINT['EXO13_17']	= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['EXO13_17'],-1)))) {	AION_ECHO("ERROR! $error preg_rep(EXO13_17)"); }
	if (!empty($G_FORPRINT['MAR10_45'])	&& !($G_FORPRINT['MAR10_45']	= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['MAR10_45'],-1)))) {	AION_ECHO("ERROR! $error preg_rep(MAR10_45)"); }
	if (!empty($G_FORPRINT['ROM1_1'])	&& !($G_FORPRINT['ROM1_1']		= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['ROM1_1'],-1)))) {		AION_ECHO("ERROR! $error preg_rep(ROM1_1)"); }
	if (!empty($G_FORPRINT['MAT28_19'])	&& !($G_FORPRINT['MAT28_19']	= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['MAT28_19'],-1)))) {	AION_ECHO("ERROR! $error preg_rep(MAT28_19)"); }

	// PREPARE Verse Captions
	$front	= "";
	$back   = "";
	$backot = "";
	if ($G_FORPRINT['LANGUAGE']=="Hebrew") {
		$front	= " ( ";
		$back   = " HRNT ) ";
		$backot   = " ) ";
	}
	$G_FORPRINT['W_LIFE'] = (empty($G_FORPRINT['W_LIFE'])	? "Life"				: "<span $csstex>".$G_FORPRINT['W_LIFE']."</span>");
	$G_FORPRINT['JOH3_16'] = (!empty($G_FORPRINT['JOH3_16']) && empty($G_FORPRINT['W_LIFEX'])
		? "<span class='j316'><span $csstex>".$G_FORPRINT['JOH3_16']."</span><br>Aionian ".$G_FORPRINT['W_LIFE']."!</span>"
		: (!empty($G_FORPRINT['JOH3_16'])
		? "<span class='j316'><span $csstex>".$G_FORPRINT['JOH3_16']."</span><br>".$G_FORPRINT['W_LIFE']." Aionian!</span>"
		: "<span class='j316'>For God so loved the world that he gave his only begotten Son that whoever believes in him should not perish, but have...<br>Aionian Life!</span>"));
	$G_FORPRINT['GEN3_24'] = (!empty($G_FORPRINT['GEN3_24'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['GEN3_24']."<br /><span class='ref'>".$front.$G_FORPRINT['GEN3_24_B'].$backot."</span></span></p>"
		: "<p class='cap'>“So he drove out the man; and he placed cherubim at the east of the garden of Eden, and a flaming sword which turned every way, to guard the way to the tree of life.”<br /><span class='ref'>Genesis 3:24</span></p>");
	$G_FORPRINT['LUK23_34'] = (!empty($G_FORPRINT['LUK23_34'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['LUK23_34']."<br /><span class='ref'>".$front.$G_FORPRINT['LUK23_34_B'].$back."</span></span></p>"
		: "<p class='cap'>“Jesus said, ‘Father, forgive them, for they don’t know what they are doing.’ Dividing his garments among them, they cast lots.”<br /><span class='ref'>Luke 23:34</span></p>");
	$G_FORPRINT['REV21_2_3'] = (!empty($G_FORPRINT['REV21_2_3'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['REV21_2_3']."<br /><span class='ref'>".$front.$G_FORPRINT['REV21_2_3_B'].$back."</span></span></p>"
		: "<p class='cap'>“I saw the holy city, New Jerusalem, coming down out of heaven from God, prepared like a bride adorned for her husband. I heard a loud voice out of heaven saying, ‘Behold, God’s dwelling is with people, and he will dwell with them, and they will be his people, and God himself will be with them as their God.’”<br /><span class='ref'>Revelation 21:2-3</span></p>");
	$G_FORPRINT['HEB11_8'] = (!empty($G_FORPRINT['HEB11_8'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['HEB11_8']."<br /><span class='ref'>".$front.$G_FORPRINT['HEB11_8_B'].$back."</span></span></p>"
		: "<p class='cap'>“By faith, Abraham, when he was called, obeyed to go out to the place which he was to receive for an inheritance. He went out, not knowing where he went”<br /><span class='ref'>Hebrews 11:8</span></p>");
	$G_FORPRINT['EXO13_17'] = (!empty($G_FORPRINT['EXO13_17'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['EXO13_17']."<br /><span class='ref'>".$front.$G_FORPRINT['EXO13_17_B'].$backot."</span></span></p>"
		: "<p class='cap'>“When Pharaoh had let the people go, God didn’t lead them by the way of the land of the Philistines, although that was near; for God said, ‘Lest perhaps the people change their minds when they see war, and they return to Egypt’”<br /><span class='ref'>Exodus 13:17</span></p>");
	$G_FORPRINT['MAR10_45'] = (!empty($G_FORPRINT['MAR10_45'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['MAR10_45']."<br /><span class='ref'>".$front.$G_FORPRINT['MAR10_45_B'].$back."</span></span></p>"
		: "<p class='cap'>“For the Son of Man also came not to be served, but to serve, and to give his life as a ransom for many”<br /><span class='ref'>Mark 10:45</span></p>");
	$G_FORPRINT['ROM1_1'] = (!empty($G_FORPRINT['ROM1_1'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['ROM1_1']."<br /><span class='ref'>".$front.$G_FORPRINT['ROM1_1_B'].$back."</span></span></p>"
		: "<p class='cap'>“Paul, a servant of Jesus Christ, called to be an apostle, set apart for the Good News of God”<br /><span class='ref'>Romans 1:1</span></p>");
	$G_FORPRINT['MAT28_19'] = (!empty($G_FORPRINT['MAT28_19'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['MAT28_19']."<br /><span class='ref'>".$front.$G_FORPRINT['MAT28_19_B'].$back."</span></span></p>"
		: "<p class='cap'>“Go and make disciples of all nations, baptizing them in the name of the Father and of the Son and of the Holy Spirit”<br /><span class='ref'>Matthew 28:19</span></p>");

	// GET BIBLE	
	$database = array();
	AION_FILE_DATA_GET( $args['filepath'], 'T_BIBLE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	// CREATE Glossary Page Links
	$h7585	= pwa_glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "h7585");
	$g12	= pwa_glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g12");
	$g86	= pwa_glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g86");
	$g126	= pwa_glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g126");
	$g165	= pwa_glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g165");
	$g1653	= pwa_glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g163");
	$g166	= pwa_glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g166");
	$g1067	= pwa_glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g1067");
	$g3041	= pwa_glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g3041");
	$g5020	= pwa_glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g5020");
	// CREATE Chapter Glossary Links
	$database['T_UNTRANSLATE'] = $args['database']['T_UNTRANSLATE'];
	$questioned = NULL;
	foreach($database['T_BIBLE'] as $ref => $verse) { // grab the questioned verses
		if (!preg_match('#\(questioned|note:[^()]+\)#ui', $verse['TEXT'])) { continue; }
		$database['T_UNTRANSLATE'][$ref] = $verse;
		$database['T_UNTRANSLATE'][$ref]['WORD'] = 'note';
		$database['T_UNTRANSLATE'][$ref]['STRONGS'] = '';
		if (!preg_match('#\(questioned\)#ui', $verse['TEXT'])) { continue; }		
		$ref_chap = $verse['INDEX'].'-'.$verse['BOOK'].'-'.$verse['CHAPTER'];
		$book_index		= array_search($verse['BOOK'], $args['database']['T_BOOKS']['CODE']);
		$book_foreign	= $args['database']['T_BOOKS'][$bible][$book_index];
		$reference = (int)$verse['CHAPTER'].":".(int)$verse['VERSE'];
		$title = $args['database']['T_BOOKS']['ENGLISH'][$book_index]." ".$reference;
		$reference = (empty($database['T_BIBLE'][$ref]) ? $reference : "<a href='chapters/$ref_chap.xhtml' title='$title'>$reference</a>");	
		$questioned .= "<div><span $cssbok>$book_foreign</span> $reference</div>";
	}
	ksort($database['T_UNTRANSLATE']);

	// Find the Aionian verses and chapter numbers
	// bible starts on page 7, content array index 6
	$G_PWA->bible_menu = NULL;
	$G_PWA->bible_nti = 6;
	$last_indx = $last_book = $last_chap = NULL;
	$links = array();
	$aions = array();
	$pageindex = 6;
	foreach($database['T_BIBLE'] as $ref => $verse) {
		// init
		$indx = $verse['INDEX'];
		$book = $verse['BOOK'];
		$chap = $verse['CHAPTER'];
		$chaN = (int)$verse['CHAPTER'];
		// marker
		if ($book != $last_book) {
			for($x = 1; $x < (int)$chap; $x++) {
				AION_ECHO("WARN! $error Skipping TOC {$verse['INDEX']}-{$verse['BOOK']}-".sprintf('%03d',$x));
			}
			if ($last_indx && (int)$indx==40) { $pageindex++; }
			$G_PWA->bible_menu .= "<a title='View Book' href='#' onclick='ABDO({$pageindex});return false;'>$book</a>, ";
			$links[$book] = array($chaN => $pageindex);
			$pageindex++;
		}
		else if ($chap != $last_chap) {
			for($x = 1 + (int)$last_chap; $x < (int)$chap; $x++) {
				AION_ECHO("WARN! $error Skipping TOC {$verse['INDEX']}-{$verse['BOOK']}-".sprintf('%03d',$x));
			}
			$links[$book][$chaN] = $pageindex;
			$pageindex++;
		}
		// aionian
		if (false===array_search($pageindex-1, $aions) && preg_match('#\((questioned|[^()]+[gGhH]{1}[[:digit:]]+|note:[^()]+)\)#ui', $verse['TEXT'])) {
			$aions[] = $pageindex-1;
		}
		// next
		$last_indx = $indx;
		$last_book = $book;
		$last_chap = $chap;
	}
	$aions_flip = array_flip($aions);
	//error_log(print_r($aions,TRUE));
	//error_log(print_r($aions_flip,TRUE));
	
	// CREATE chapter files
	$last_indx = $last_book = $last_chap = $contents = NULL;
	$gotticks = TRUE;
	foreach($database['T_BIBLE'] as $ref => $verse) {
		// INIT
		$indx = $verse['INDEX'];
		$book = $verse['BOOK'];
		$chap = $verse['CHAPTER'];
		$chaN = (int)$chap;
		$vers = $verse['VERSE'];
		$verN = (int)$vers;
		$text = preg_replace("#`#ui", "\`", $verse['TEXT'], -1, $ticks);
		if ($gotticks && $ticks) { $gotticks = FALSE; AION_ECHO("WARN! $error backticks escaped in text"); }
		
		// Annotations
		$pn = $G_PWA->bible_numb+6;
		$prev = (!isset($aions_flip[$pn]) || !isset($aions[$aions_flip[$pn]-1]) || !($pf=$aions[$aions_flip[$pn]-1]) ? "(" : "<a href='#' onclick='ABDO({$pf});return false;' title='View previous annotation'>&lt;</a>");
		$next = (!isset($aions_flip[$pn]) || !isset($aions[$aions_flip[$pn]+1]) || !($pf=$aions[$aions_flip[$pn]+1]) ? ")" : "<a href='#' onclick='ABDO({$pf});return false;' title='View next annotation'>&gt;</a>");
		$mark = $text;
		if (!($text = preg_replace('#\((questioned|[^()]+[gGhH]{1}[[:digit:]]+|note:[^()]+)\)#ui', "<span class='not' dir='ltr'>$prev".' $1 '."$next</span>",	$text))) { AION_ECHO("ERROR! $error preg_replace(gXXX)"); }
		if (!($text = preg_replace('# h7585([^0-9]{1})#ui',	' <a href="#" onclick="ABDO(-1,\'h7585\');	return false;"	title=\'View definition\'>h7585</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(h7585)"); }
		if (!($text = preg_replace('# g12([^0-9]{1})#ui',	' <a href="#" onclick="ABDO(-1,\'g12\');	return false;"	title=\'View definition\'>g12</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g12)"); }
		if (!($text = preg_replace('# g86([^0-9]{1})#ui',	' <a href="#" onclick="ABDO(-1,\'g86\');	return false;"	title=\'View definition\'>g86</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g86)"); }
		if (!($text = preg_replace('# g126([^0-9]{1})#ui',	' <a href="#" onclick="ABDO(-1,\'g126\');	return false;"	title=\'View definition\'>g126</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g126)"); }
		if (!($text = preg_replace('# g165([^0-9]{1})#ui',	' <a href="#" onclick="ABDO(-1,\'g165\');	return false;"	title=\'View definition\'>g165</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g165)"); }
		if (!($text = preg_replace('# g1653([^0-9]{1})#ui',	' <a href="#" onclick="ABDO(-1,\'g1653\');	return false;"	title=\'View definition\'>g1653</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g1653)"); }
		if (!($text = preg_replace('# g166([^0-9]{1})#ui',	' <a href="#" onclick="ABDO(-1,\'g166\');	return false;"	title=\'View definition\'>g166</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g166)"); }
		if (!($text = preg_replace('# g1067([^0-9]{1})#ui',	' <a href="#" onclick="ABDO(-1,\'g1067\');	return false;"	title=\'View definition\'>g1067</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g1067)"); }
		if (!($text = preg_replace('# g3041([^0-9]{1})#ui',	' <a href="#" onclick="ABDO(-1,\'g3041\');	return false;"	title=\'View definition\'>g3041</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g3041)"); }
		if (!($text = preg_replace('# g4442([^0-9]{1})#ui',	' <a href="#" onclick="ABDO(-1,\'g4442\');	return false;"	title=\'View definition\'>g4442</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g4442)"); }
		if (!($text = preg_replace('# g5020([^0-9]{1})#ui',	' <a href="#" onclick="ABDO(-1,\'g5020\');	return false;"	title=\'View definition\'>g5020</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g5020)"); }
		if ($mark != $text) {	$text = "<span $cssavh>".$text."</span>"; }
		else {					$text = "<span $csstex>".$text."</span>"; }
				
		// CHAPTER
		if ($last_indx && ($book != $last_book || $chap != $last_chap)) {
			$book_index		= array_search($last_book, $args['database']['T_BOOKS']['CODE']);
			$book_english	= $args['database']['T_BOOKS']['ENGLISH'][$book_index];
			$book_foreign	= $args['database']['T_BOOKS'][$bible][$book_index];
			if(strpos($book_english,'"')!==FALSE || strpos($book_foreign,'"')!==FALSE) { AION_ECHO("ERROR! $error book name quote problem! $book_english $book_foreign"); }
			$chap_number	= $args['database']['T_NUMBERS'][$bible][$last_chaN];
			if (!($first=reset($links[$book]))) { AION_ECHO("ERROR! $error links[$book][first] empty"); }
			$book_format	= "<h2 $cssbok><a title='View Chapter Menu' href='#' onclick='ABDO({$first});return false;'>$book_foreign</a> $chap_number</h2>\n";
			if ($last_chaN==1 && $links[$book]>1) {
				$book_format .= "<div class='chapnav'>Chapter";
				foreach($links[$book] as $c => $p) {
					$book_format .= ($c==1 ? "" : " <a title='View Chapter' href='#' onclick='ABDO({$p});return false;'>$c</a>\n");
				}
				$book_format .= "</div>\n";
			}
			$G_PWA->bible_text .= "`$book_format<div class='chap'>\n$contents</div>`,\n";
			$G_PWA->bible_numb++;
			if ($book != $last_book && (int)$indx==40) {
				$G_PWA->bible_text .= <<< EOF
`
<h2>{$G_FORPRINT['W_NEW']}</h2>
<div class="map"><img src="https://resources.aionianbible.org/Gustave-Dore-La-Grande-Bible-de-Tours/web/Gustave-Dore-Bible-Tour-NT-Gospel-215-The-Crucifixion-of-Jesus-and-Two-Criminals.jpg" alt="The Crucifixion of Jesus and Two Criminals"></div>
{$G_FORPRINT['GEN3_24']}
`,
EOF;
				$G_PWA->bible_nti = $G_PWA->bible_numb;
				$G_PWA->bible_numb++;
			}
			$contents = NULL;
		}
		// VERSE
		$verF = $args['database']['T_NUMBERS'][$bible][$verN];
		$verF = ($verF == $verN ? "" : "<span $cssnum> $verF </span>");
		if ($G_RTL) {	$contents .= "<table class='rtl-tab'><tr><td>$text</td><td class='rtl-ref'>$verF<span class='num'> $verN</span></td></tr></table>\n"; }
		else {			$contents .= "<span $cssver><span class='num'>$verN </span>$verF$text</span>\n"; }
		// END
		$last_indx = $indx;
		$last_book = $book;
		$last_chap = $chap;
		$last_chaN = $chaN;
	}
	// handle last record
	$book_index		= array_search($last_book, $args['database']['T_BOOKS']['CODE']);
	$book_english	= $args['database']['T_BOOKS']['ENGLISH'][$book_index];
	$book_foreign	= $args['database']['T_BOOKS'][$bible][$book_index];
	if(strpos($book_english,'"')!==FALSE || strpos($book_foreign,'"')!==FALSE) { AION_ECHO("ERROR! $error book name quote problem! $book_english $book_foreign"); }
	$chap_number	= $args['database']['T_NUMBERS'][$bible][$last_chaN];
	if (!($first=reset($links[$book]))) { AION_ECHO("ERROR! $error links[$book][first] empty"); }
	$book_format	= "<h2 $cssbok><a title='View Chapter Menu' href='#' onclick='ABDO({$first});return false;'>$book_foreign</a> $chap_number</h2>\n<div class='chapnav'>\n";
	if ($last_chaN==1 && $links[$book]>1) {
		$book_format .= "<div class='chapnav'>Chapter";
		foreach($links[$book] as $c => $p) {
			$book_format .= ($c==1 ? "" : " <a title='View Chapter' href='#' onclick='ABDO({$p});return false;'>$c</a>\n");
		}
		$book_format .= "</div>\n";
	}
	$G_PWA->bible_text .= "`$book_format<div class='chap'>$contents</div>`,\n";
	$G_PWA->bible_numb++;
	$contents = NULL;

	// DYNAMIC STUFF
	$G_PWA->font = AION_PWA_FONT();
	// WRITE AND VALIDATE
	if (file_put_contents($file="{$args['destiny']}/$bible---Aionian-Edition.htm", AION_PWA_CONTENTS()) === FALSE) { AION_ECHO("ERROR! $error file_put_contents($file)"); } // CREATE copyright
	// DONE
	AION_unset($database); unset($database); $database=NULL;
	AION_ECHO("PWA SUCCESS: $bible");
}



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// LINKS IN GLOSSARY
function pwa_glossarylinks($bible, $biblearray, $untranslate, $books, $cssbok, $strongs) {
	$links = "<div>";
	$lastbook = NULL;
	foreach($untranslate as $ref => $verse) {
		if (($strongs=="g12" && $verse['STRONGS']!="g12") || !preg_match("#$strongs#ui", $verse['STRONGS'])) { continue; }
		$ref_chap = $verse['INDEX'].'-'.$verse['BOOK'].'-'.$verse['CHAPTER'];
		$book_index = array_search($verse['BOOK'], $books['CODE']);
		$book_foreign = (empty($books[$bible][$book_index]) || $books[$bible][$book_index]=='NULL'  ? $books['ENGLISH'][$book_index] : $books[$bible][$book_index]);
		$reference = (int)$verse['CHAPTER'].":".(int)$verse['VERSE'];
		$title = $books['ENGLISH'][$book_index]." ".$reference;
		$links .=	($lastbook==NULL ? "<span $cssbok>$book_foreign</span> " :
					($book_foreign != $lastbook ? ", <span $cssbok>$book_foreign</span> " : ", ")) . (empty($biblearray[$ref]) ? $reference : "<a href='chapters/$ref_chap.xhtml' title='$title'>$reference</a>");
		$lastbook = $book_foreign;
	}
	return "$links</div>";
}



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// LINKS TO GLOSSARY
function AION_PWA_LINKS($folder=NULL) {
static $object = NULL;
if (empty($object) || $folder) {
	$object = new stdClass();
	$object->X_GEN_1	= ($folder && file_exists("$folder/chapters/001-GEN-001.xhtml") ? "<a href='chapters/001-GEN-001.xhtml' title='View reference'>Genesis</a>"					: "Genesis");
	$object->X_MAT_25	= ($folder && file_exists("$folder/chapters/040-MAT-025.xhtml") ? "<a href='chapters/040-MAT-025.xhtml' title='View reference'>Matthew 25:41</a>"			: "Matthew 25:41");
	$object->X_MAT_28	= ($folder && file_exists("$folder/chapters/040-MAT-028.xhtml") ? "<a href='chapters/040-MAT-028.xhtml' title='View reference'>Matthew 28:20</a>"			: "Matthew 28:20");
	$object->X_JOH_1	= ($folder && file_exists("$folder/chapters/043-JOH-001.xhtml") ? "<a href='chapters/043-JOH-001.xhtml' title='View reference'>John</a>"					: "John");
	$object->X_JOH_3	= ($folder && file_exists("$folder/chapters/043-JOH-003.xhtml") ? "<a href='chapters/043-JOH-003.xhtml' title='View reference'>John 3:16</a>"				: "John 3:16");
	$object->X_ROM_1	= ($folder && file_exists("$folder/chapters/045-ROM-001.xhtml") ? "<a href='chapters/045-ROM-001.xhtml' title='View reference'>Romans 1:20</a>"				: "Romans 1:20");
	$object->X_ROM_11	= ($folder && file_exists("$folder/chapters/045-ROM-011.xhtml") ? "<a href='chapters/045-ROM-011.xhtml' title='View reference'>Romans 11:32</a>"			: "Romans 11:32");
	$object->X_1CO_2	= ($folder && file_exists("$folder/chapters/046-1CO-002.xhtml") ? "<a href='chapters/046-1CO-002.xhtml' title='View reference'>1 Corinthians 2:13-14</a>"	: "1 Corinthians 2:13-14");
	$object->X_2TI_2	= ($folder && file_exists("$folder/chapters/055-2TI-002.xhtml") ? "<a href='chapters/055-2TI-002.xhtml' title='View reference'>2 Timothy 2:15</a>"			: "2 Timothy 2:15");
	$object->X_2PE_1	= ($folder && file_exists("$folder/chapters/061-2PE-001.xhtml") ? "<a href='chapters/061-2PE-001.xhtml' title='View reference'>2 Peter 1:4-8</a>"			: "2 Peter 1:4-8");
	$object->X_2PE_2	= ($folder && file_exists("$folder/chapters/061-2PE-002.xhtml") ? "<a href='chapters/061-2PE-002.xhtml' title='View reference'>2 Peter 2:4</a>"				: "2 Peter 2:4");
	$object->X_1JO_2	= ($folder && file_exists("$folder/chapters/062-1JO-002.xhtml") ? "<a href='chapters/062-1JO-002.xhtml' title='View reference'>1 John 2:27</a>"				: "1 John 2:27");
	$object->X_JUD_1	= ($folder && file_exists("$folder/chapters/065-JUD-001.xhtml") ? "<a href='chapters/065-JUD-001.xhtml' title='View reference'>Jude 6</a>"					: "Jude 6");
	$object->X_REV_20	= ($folder && file_exists("$folder/chapters/066-REV-020.xhtml") ? "<a href='chapters/066-REV-020.xhtml' title='View reference'>Revelation 20:13-14</a>"		: "Revelation 20:13-14");
	// Additional links on Lake of Fire page
	$object->X_PARADISE	= ($folder && file_exists("$folder/chapters/042-LUK-023.xhtml") ? "<a href='chapters/042-LUK-023.xhtml' title='View Luke 23:43'>Paradise</a>"				: "Paradise");
	$object->X_NEWHEAVEN= ($folder && file_exists("$folder/chapters/066-REV-021.xhtml") ? "<a href='chapters/066-REV-021.xhtml' title='View Revelation 21'>The New Heaven</a>"		: "The New Heaven");
	$object->X_NEWEARTH	= ($folder && file_exists("$folder/chapters/066-REV-021.xhtml") ? "<a href='chapters/066-REV-021.xhtml' title='View Revelation 21'>The New Earth</a>"		: "The New Earth");
	$object->X_SHEEP	= ($folder && file_exists("$folder/chapters/040-MAT-025.xhtml") ? "<a href='chapters/040-MAT-025.xhtml' title='View reference'>Matthew 25:31-46</a>"		: "Matthew 25:31-46");
	$object->X_GREAT	= ($folder && file_exists("$folder/chapters/066-REV-020.xhtml") ? "<a href='chapters/066-REV-020.xhtml' title='View reference'>Revelation 20:11-15</a>"		: "Revelation 20:11-15");
	$object->X_HEB_2	= ($folder && file_exists("$folder/chapters/058-HEB-002.xhtml") ? "<a href='chapters/058-HEB-002.xhtml' title='View reference'>Hebrews 2</a>"				: "Hebrews 2");
	$object->X_ALLALL	= ($folder && file_exists("$folder/chapters/062-1JO-002.xhtml") ? "<a href='chapters/062-1JO-002.xhtml' title='View reference'>1 John 2:1-2</a>"			: "1 John 2:1-2");
	$object->X_LUK_16	= ($folder && file_exists("$folder/chapters/042-LUK-016.xhtml") ? "<a href='chapters/042-LUK-016.xhtml' title='View reference'>Luke 16:19-31</a>"			: "Luke 16:19-31");
	$object->X_LUK_23	= ($folder && file_exists("$folder/chapters/042-LUK-023.xhtml") ? "<a href='chapters/042-LUK-023.xhtml' title='View reference'>Luke 23:43</a>"				: "Luke 23:43");
	$object->X_MAT_16	= ($folder && file_exists("$folder/chapters/040-MAT-016.xhtml") ? "<a href='chapters/040-MAT-016.xhtml' title='View reference'>Matthew 16:18</a>"			: "Matthew 16:18");
	$object->X_1CO_15	= ($folder && file_exists("$folder/chapters/046-1CO-015.xhtml") ? "<a href='chapters/046-1CO-015.xhtml' title='View reference'>1 Corinthians 15:55</a>"		: "1 Corinthians 15:55");
	$object->X_PHI_2	= ($folder && file_exists("$folder/chapters/050-PHI-002.xhtml") ? "<a href='chapters/050-PHI-002.xhtml' title='View reference'>Philippians 2:9-11</a>"		: "Philippians 2:9-11");
	$object->X_REV_1	= ($folder && file_exists("$folder/chapters/066-REV-001.xhtml") ? "<a href='chapters/066-REV-001.xhtml' title='View reference'>Revelation 1:18</a>"			: "Revelation 1:18");
	$object->X_REV_21	= ($folder && file_exists("$folder/chapters/066-REV-021.xhtml") ? "<a href='chapters/066-REV-021.xhtml' title='View reference'>Revelation 21:1-8</a>"		: "Revelation 21:1-8");
	$object->X_JOH_15	= ($folder && file_exists("$folder/chapters/043-JOH-015.xhtml") ? "<a href='chapters/043-JOH-015.xhtml' title='View reference'>John 15:16</a>"				: "John 15:16");
}
return $object;
}



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// CSS
function AION_PWA_FONT() {
global $G_VERSIONS;
// FOREIGN FONT 
$fray = array(
/* FILE									LICENSE								FONT						NAME					CSS */
'font-arabic.css'			=> array('notonaskharabicui',			'notonaskharabicui-regular',	'font-arabic',			'font-arabic'		),
'font-aramaic.css'			=> array('estrangelo_edessa',			'estrangelo_edessa',			'font-aramaic',			'font-aramaic'		),
'font-armenian.css'			=> array('arnamu_serif',				'arnamu_serif',					'font-armenian',		'font-armenian'		),
'font-babelstonehan.css'	=> array('babelstonehan',				'babelstonehan',				'font-babelstonehan',	'font-babelstonehan'),
'font-bengali.css'			=> array('solaimanlipi',				'solaimanlipi',					'font-bengali',			'font-bengali'		),
'font-cherokee.css'			=> array('donisiladv',					'donisiladv',					'font-cherokee',		'font-cherokee'		),
'font-coptic.css'			=> array('newathu5_5',					'newathu5_5',					'font-coptic',			'font-coptic'		),
'font-devanagari.css'		=> array('notoserifdevanagari',			'notoserifdevanagari-regular',	'font-devanagari',		'font-devanagari'	),
'font-ezra.css'				=> array('ezra_sil',					'ezra_sil',						'font-ezra',			'font-ezra'			),
'font-gujarati.css'			=> array('notoserifgujarati',			'notoserifgujarati-regular',	'font-gujarati',		'font-gujarati'		),
'font-hindi.css'			=> array('akshar_unicode',				'akshar_unicode',				'font-hindi',			'font-hindi'		),
'font-kannada.css'			=> array('notoserifkannada',			'notoserifkannada-regular',		'font-kannada',			'font-kannada'		),
'font-khmer.css'			=> array('busra',						'busra',						'font-khmer',			'font-khmer'		),
'font-korean.css'			=> array('unbatang',					'unbatang',						'font-korean',			'font-korean'		),
'font-malayalam.css'		=> array('notoserifmalayalam',			'notoserifmalayalam-regular',	'font-malayalam',		'font-malayalam'	),
'font-myanmar.css'			=> array('padauk-regular',				'padauk-regular',				'font-myanmar',			'font-myanmar'		),
'font-oriya.css'			=> array('notosansoriyaui',				'notosansoriyaui-regular',		'font-oriya',			'font-oriya'		),
'font-panjabi.css'			=> array('notosansgurmukhiui',			'notosansgurmukhiui-regular',	'font-panjabi',			'font-panjabi'		),
'font-persian.css'			=> array('notonaskharabicui',			'notonaskharabicui-regular',	'font-persian',			'font-persian'		),
'font-sinhala.css'			=> array('abhayalibre',					'abhayalibre',					'font-sinhala',			'font-sinhala'		),
'font-tamil.css'			=> array('notoseriftamil',				'notoseriftamil-semicondensed',	'font-tamil',			'font-tamil'		),
'font-telugu.css'			=> array('notoseriftelugu',				'notoseriftelugu-regular',		'font-telugu',			'font-telugu'		),
'font-thai.css'				=> array('notoserifthai_semicondensed',	'notoserifthai_semicondensed',	'font-thai',			'font-thai'			),
'font-tibetan.css'			=> array('notoseriftibetan',			'notoseriftibetan',				'font-tibetan',			'font-tibetan'		),
);
$font = $G_VERSIONS['LANGUAGESTYLE'];
if (empty($font)) {				$foreign_font = NULL; }
else if (empty($fray[$font])) {	AION_ECHO("ERROR! AION_EPUBY_EPUB_CSS font not found: $font"); }
else {
$l = $fray[$font][0];
$f = $fray[$font][1];
$n = $fray[$font][2];
$c = $fray[$font][3]; // unused, all use same tag!
$foreign_font = <<< EOF
@font-face {
	font-family:
		'$n';
	src:
		url('https://www.AionianBible.org/fonts/$f.woff')	format('woff'),
		url('https://www.AionianBible.org/fonts/$f.ttf')		format('truetype');
}
.ff { font-family: 'NotoSans', '$n', 'Arial', 'sans-serif', 'GentiumPlus'; }

EOF;
}

return $foreign_font;
}





///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// CONTENTS
function AION_PWA_CONTENTS() {
global $G_PWA, $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_RTL, $AION_PWA_IMAGE_PAGED;	
return <<< EOF
<!-- HTML: Aionian Bible Progressive Web Application -->
<!-- Publisher: https://NAINOIA-INC.signedon.net -->
<!-- Website: https://www.AionianBible.org -->
<!-- Resources: https://resources.AionianBible.org -->
<!-- Repository: https://github.com/Nainoia-Inc -->
<!-- Bible: Holy Bible Aionian Edition® {$G_VERSIONS['NAMEENGLISH']} -->
<!-- Copyright: {$G_VERSIONS['ABCOPYRIGHT']} -->
<!-- Language: {$G_VERSIONS['LANGUAGEENGLISH']} -->
<!-- Formatted: ABCMS on {$G_PWA->modified} -->
<!-- Source: {$G_VERSIONS['SOURCE']} -->
<!-- Source copyright: {$G_VERSIONS['COPYRIGHT']} -->
<!-- Source version: {$G_VERSIONS['SOURCEVERSION']} -->
<!-- Source text: {$G_VERSIONS['SOURCELINK']} -->



<!--////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Holy Bible Aionian Edition® ~ PWA ~ {$G_VERSIONS['NAMEENGLISH']}</title>



<!--////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--////////////////////////////////////////////////////////////////////////////////////////////////////-->
<meta name="description" content="Holy Bible Aionian Edition® ~ The world's first Holy Bible untranslation! ~ Progressive Web App ~ {$G_VERSIONS['NAMEENGLISH']}">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="generator" content="ABCMS™">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta property="og:url" content="https://www.aionianbible.org">
<meta property="og:type" content="website">
<meta property="og:title" content="Holy Bible Aionian Edition® ~ PWA ~ {$G_VERSIONS['NAMEENGLISH']}">
<meta property="og:description" content="Holy Bible Aionian Edition® ~ The world's first Holy Bible untranslation! ~ Progressive Web App ~ {$G_VERSIONS['NAMEENGLISH']}">
<meta property="og:image" content="https://www.AionianBible.org/images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-1.jpg">
<meta property="og:image" content="https://www.AionianBible.org/images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-2.jpg">
<meta property="og:image" content="https://www.AionianBible.org/images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-3.jpg">
<meta property="og:image" content="https://www.AionianBible.org/images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-4.jpg">
<link rel="shortcut icon" href="https://www.AionianBible.org/images/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" sizes="180x180" href="https://www.AionianBible.org/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="https://www.AionianBible.org/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="https://www.AionianBible.org/images/favicon-16x16.png">
<link rel="manifest" href="{$G_PWA->bible}.webmanifest">



<!--////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--////////////////////////////////////////////////////////////////////////////////////////////////////-->
<style>
/* PALETTE
PURPLE
#663399 purple text
#9966CC purple highlight
#E0D6EB purple background
#F0EBF5 cover background
BLUE
#006699 blue text
#CCE0EB blue background
OTHER
#191919 black text
#C5C5C5 gray dark
#EDEDED gray light
#FFFFFF white
#000000 black
*/

/* FONT */
@font-face {
	font-family:
		'NotoSans';
	src:
		url('https://www.AionianBible.org/fonts/notosans-basic-regular.woff2')	format('woff2'),
		url('https://www.AionianBible.org/fonts/notosans-basic-regular.woff')	format('woff'),
		url('https://www.AionianBible.org/fonts/notosans-basic-regular.ttf')		format('truetype');
}
@font-face {
	font-family:
		'GentiumPlus';
	src:
		url('https://www.AionianBible.org/fonts/gentiumplus-r.woff2')			format('woff2'),
		url('https://www.AionianBible.org/fonts/gentiumplus-r.woff')				format('woff'),
		url('https://www.AionianBible.org/fonts/gentiumplus-r.ttf')				format('truetype');
}
{$G_PWA->font}
html,body	{ font-family: 'NotoSans', 'Arial', 'sans-serif', 'GentiumPlus'; }

/* BASE */
html { height: 100%; }
body { height: 100%; margin: 0; min-width: 360px; font-size: 100%; color: #191919; }
h1, h2, h3, h4 { margin: 0 0 10px 0; }
p { margin: 0 0 10px 0; }
img { max-width: 100%; height: auto; }
a { text-decoration: none; color: #663399; }
a:hover { color: #9966CC; }
.hidden { display: none; }
.center { text-align: center; }
.italic { font-style: italic; }

/* THINGS */
.title { text-align: center; }
.chapnav { margin-bottom: 7px; }
.chapbot { margin-top: 7px; }
.cov { text-align: center; margin: auto; } 
.map { text-align: center; margin: auto; }
.map img { border: 1px solid #C5C5C5; }
.cap { text-align: center; font-style: italic; width: 70%; margin: 0 auto; display: block; }
.ref { font-style: normal; } 
.tag { color: #191919; }
.bok { text-align: center; }
.avh { background-color: #E0D6EB; }
.num { font-weight: 700; }
.not { font-weight: 700; color: #663399; white-space: nowrap; } 
.rtl-tab { width: 100%; text-align: right; }
.rtl-ref { width: 50px; text-align: right; }

/* STICKY */
#sticky-body, #sticky-push, #sticky-foot { margin: 0; padding: 0; }
#sticky-body { min-height: 100%; height: auto !important; margin: 0 auto -33px auto; }
#sticky-push, #sticky-foot { height: 33px; clear: both; }
:target:before { content:""; display:block; height:110px; margin:-110px 0 0; } /* static header target adjustment */

/* PAGE */
#page {	height: 100%; max-width: 1280px; margin: 0 auto; }

/* HOME */
#home { display: table; position: absolute; height: 100%; width: 100%; }
#vert { display: table-cell; vertical-align: middle; text-align: center; }
#horz { margin: 0 auto; display: inline-block; padding: 10px 10px 100px 10px;  }
#home a { text-decoration: none; color: #191919; }
#home a:hover #butt { border: 1px solid #9966CC; border-radius: 7px;	background-color: #F0EBF5; }
#home a:hover #aion { color: #663399; }
#butt { margin: 0 auto; padding: 10px; text-align: center; }
#butt h2	{ margin: 10px 0 20px 0; }
#j316 { padding: 10px 0; font-style: italic; font-size: 110%; font-weight: bold; width: 360px; margin: 0 auto; }
#aion { padding: 0 0 15px 0; font-style: italic; font-size: 130%; font-weight: bold; }
#moto { margin: 10px 0 0 0; color: #663399; }
.RegisteredTM { font-size: 75%; }
#icon { padding: 0 0 15px 0; position: fixed; bottom: 0; right: 0; width: 57px; text-align: right; }
#icon a { margin: 3px 15px 0 0; display: block; }
#icon a:hover { margin-right: 17px; }
#java { position: fixed; top: 0; left: 0; margin: 0; padding: 0; width: 100%; text-align: center; }

/* HEAD */
#head { position: fixed; width: 100%; max-width: 1280px; min-width: 360px; background-color: #FFFFFF; }
#head-hi { max-height: 42px; margin-top: 10px; padding: 2px 15px; border: 1px solid #663399; border-radius: 7px; background-color: #663399; overflow: hidden; }
#head-lo { max-height: 70px; max-width: 1024px; margin: 0px auto; padding: 7px 3%; background-color: #FFFFFF; border-bottom: 1px solid #9966CC; overflow: auto; }
#logo { }
#logo1 { display: inline-block !important; float: left; }
#logo2 { display: none !important; }
#body.large { font-size: 150%; }
#body.larger { font-size: 200%; }
#menu { display: inline-block; float: right; white-space: nowrap; }
#menu a { color: #FFFFFF; margin: 0px 0px 0px 15px; display: inline-block; font-size: 175%; }
#menu a:hover { color: #E0D6EB; }
#menu a#accessible { font-weight: bold; font-size: 200%;  }

/* BODY */
#body {	max-width: 1024px; margin: 0 auto; padding: 80px 3% 10px 3%; }
#body h1, #body h2, #body h3 { text-align: center; }
body.word-toc  #body { max-width: 1024px; margin: 0 auto; padding: 110px 3% 2% 3%; }
body.word-read #body { max-width: 1024px; margin: 0 auto; padding: 110px 3% 2% 3%; }

/*** WORD ***/
#word { }
#word .word-bible a { padding: 15px 5px; border: 1px solid #EDEDED; display: block; }
#word .word-bible.odd a { background-color: #EDEDED; }
#word .word-bible.aionian-bible a { background-color: #E0D6EB; }
#word .word-bible a:hover { color: #FFFFFF; background-color: #9966CC; border: 1px solid #9966CC; }
#word .word-bible.aionian-bible a:hover { color: #FFFFFF; background-color: #9966CC; border: 1px solid #9966CC; }
#word .word-buy { padding: 15px 5px; border: 1px solid #EDEDED; display: block; }
#word .word-buy.odd { background-color: #EDEDED; }
#word .word-buy.odd.aionian-bible { background-color: #E0D6EB; }
#word .word-buy a:hover { color: #FFFFFF; background-color: #9966CC; border: 1px solid #9966CC; }
#word .word-buy .buylinks { color: #000000; font-size: 90%; }
#word .word-buy .buylinks a { text-decoration: underline; color: #000000; }
#word .word-buy .buylinks a:hover { color: #FFFFFF; background-color: #9966CC; border: 1px solid #9966CC; }
#word-quick a { display: inline-block; margin: 0 3px 10px 4px }
#word .word-custom { margin-bottom: 20px; }

#word-menu { font-size: 130%; }
#word-menu .word-tocs { margin-right: 5px; }
#word-menu .nav { font-weight: 900; padding-left: 5px; padding-right: 5px; }
#word-menu .sgt { font-weight: 900; padding-left: 5px; padding-right: 3px; }
#word-menu .nup { font-weight: 900; padding-left: 5px; padding-right: 5px; }
#word-menu .navx { font-weight: 900; padding-left: 5px; padding-right: 5px; }
#word-menu .navxx { font-weight: 900; padding-left: 3px; padding-right: 5px; }
#word-menu a:hover { background-color: #EDEDED; }
#word-menu { overflow: auto; }
#word-menu .word-menu-l { float: left; }
#word-menu .word-menu-l .word-book { background-color: #E0D6EB; }
#word-menu .word-menu-l .word-strongs { background-color: #CCE0EB; }
#word-menu .word-strongs a { color: #006699; }
#word-menu .word-menu-r { float: right; }

#word-menu-float { position: fixed; width: 0px; height: 0px; bottom: 0px; left: 0px; font-size: 200%; }
#word-menu-float a  { position: fixed; width: 32px; height: 40%; top: 30%; background-color: #EDEDED; color: #FFFFFF; border-radius: 10px; text-align: center; display: table; }
#word-menu-float a span  { display: table-cell; vertical-align: middle; }
#word-menu-float a.left  { left:  7px; }
#word-menu-float a.right { right: 7px; }
#word-menu-float a:hover { background-color: #C5C5C5; }
@media screen and (max-width: 1279px) {
	#word-menu-float { display: none; }
}
@media screen and (min-width: 1280px) {
	#word-menu-bottom { display: none; }
	#word-menu-bottom.always { display: block; }
}


#word .word-para { margin-bottom: 15px; }
#word .word-para-ref { font-weight: bold; }
#word .word-para-ref.rtlref { text-align: right; }
#word .word-para-one { }
#word .word-para-one.allverses { margin-bottom: 15px; }
#word.aionian .word-para-two { margin-left: 0; }
#word .word-para-two { margin-left: 12px; }
#word .word-para-two .word-text { background-color: #F0EBF5; font-style: italic; }
#word .word-para-two .word-text .word-aionian { background-color: #F0EBF5; }
#word .word-para-two .word-text .word-questioned { background-color: #F0EBF5; }
#word .word-para-two.word-ltr .verse-num { margin-right: 12px; }
#word .word-verse { font-weight: bold; }
#word .word-verse-lang { font-weight: bold; }
#word .word-text { }
#word .word-questioned { background-color: #E0D6EB; }
#word .word-questioned .word-footnote { font-weight: bold; font-style: italic; }
#word .word-aionian { background-color: #E0D6EB; }
#word .word-aionian .word-footnote { font-weight: bold; font-style: italic; }
#word .word-aionian-questioned { background-color: #EDEDED; padding: 10px; }
#word .word-text.strongs,
#word .word-text.strongs .word-aionian { background-color: #CCE0EB; }

#word .word-rtl { margin-bottom: 10px; width: 100%; }
#word .word-rtl.allverses { margin-bottom: 15px; }
#word .word-rtl .word-text { text-align: right; width: 100%; }
#word .word-rtl .word-refs { width: 15px; vertical-align: top; text-align: right; white-space: nowrap; }
#word .word-rtl .word-verse { font-weight: bold; margin-left: 5px;  margin-right: 0px; }
#word .word-rtl .word-verse-lang { font-weight: bold; margin-left: 10px; margin-right: 0px; }

#word.questioned hr { border-top: 1px solid #9966CC; border-bottom: 0px; margin-top: 35px; }
#word-links { margin-top: 7px; }
#body div.word-warning { margin-top: 7px; }
div.word-warning { color: red; }

/*** STRONGS ***/
.word-blue { color: #006699; }

/*** MAPS ***/
#maps { text-align: center; width: 100%; }
#maps img { text-align: center; margin: 10px auto; border: solid black 1px; }
#maps div { margin: 0 auto; }
#maps div.portrait { max-width: 360px; }
#maps div.timeline { max-width: 800px; }
#maps div.map a:hover img { border: 1px solid #9966CC; }
#maps div.caption { margin: 0 0 40px 0; }
#maps div.caption .verse { font-style: italic; }

/*** DORE ***/
#dore { text-align: center; width: 100%; }
#dore img { text-align: center; margin: 15px auto 0 auto; /* border: solid black 1px; */ }

/* TAIL */
#tail {
	min-width: 360px;
	max-width: 1024px;
	margin: 0 auto;
	text-align: center;
	font-size: 80%;
	font-style: italic;
	padding: 2px;
	border: 1px solid #663399;
	border-radius: 7px;
	color: #FFFFFF;
	background-color: #663399;
}
#tail a { color: #FFFFFF; }
#tail a:hover { color: #E0D6EB; }

/* RESPONSIVE */
@media screen and (max-width: 1279px) {
	#head-hi { margin-top: 0; }
	#head-hi { border: none; border-bottom: 1px solid #9966CC; border-radius: 0; }
	#accessible { top: 10px; }
}
@media screen and (max-width: 1023px) {
	#icon { padding: 0 0 5px 0; }
	#icon a { margin: 1px 10px 0 0; }
	#icon img { width: 24px; height: 24px; }
	#tail { border: none; border-top: 1px solid #9966CC; border-radius: 0; }
	#sticky-foot { background-color: #663399; }
	#page {	padding: 0; }
}
@media screen and (max-width: 640px) {
	#logo1 { display: none !important; }
	#logo2 { display: inline-block !important; float: left; }
	#word-menu .crunch { display: none; }
	#word-menu .word-book-name { font-size: 60% !important; }
}
/* PRINT */
@media print {
	#sticky-body { margin: 0 auto !important; }
	#body { padding: 10px 5% 2% !important; }
	#head,
	#word-menu-float,
	#word-menu-bottom,
	#word-links,
	#social-footer,
	#sticky-push,
	#sticky-foot { display: none !important; }
}
</style>



<!--////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--////////////////////////////////////////////////////////////////////////////////////////////////////-->
</head>
<body>
<div id='land'>
<div id='home'>
<div id='vert'>
<div id='horz'>
<a title="Table of Contents" href="#" onclick="ABDO(null); return false;">
<div id='butt'>
<h2 id='welcome'>{$G_VERSIONS['NAMEENGLISH']}<br>Welcome to the <i>Holy&nbsp;Bible&nbsp;Aionian&nbsp;Edition<span class='RegisteredTM'>®</span></i></h2>
<div id='logo'><img src='https://www.AionianBible.org/images/Holy-Bible-Aionian-Edition-PURPLE-HOME.png' alt='Aionian Bible'></div>
<div id='j316'>{$G_FORPRINT['JOH3_16']}
<div id='moto'>The world's first Holy Bible <span style="text-decoration: underline;">untranslation</span><br>Three hundred seventy-six versions<br>One hundred sixty-five languages<br>Anonymous on TOR network<br>100% free to copy &amp; print<br>Updated {$G_PWA->modified}<br><br>Also known as<br>'The Purple Bible'
</div>
</div>
</a>
</div>
</div>
</div>
<div id='java'>Loading javascript and cookies...</div>
<div id='icon'>
<a href='https://www.AionianBible.org'				target='_blank' title='AionianBible.org'>		<img src='https://www.AionianBible.org/images/Aionian-Bible-Online.png' alt='AionianBible.org' title='Visit AionianBible.org online for all Bibles'></a>
<a href='https://www.AionianBible.org/Facebook'		target='_blank' title='Facebook/AionianBible'>	<img src='https://www.AionianBible.org/images/Aionian-Bible-Facebook.png' alt='Facebook' title='Aionian Bible on Facebook'></a>
<a href='https://www.AionianBible.org/Twitter'		target='_blank' title='Twitter/AionianBible'>	<img src='https://www.AionianBible.org/images/Aionian-Bible-Twitter.png' alt='Twitter' title='Aionian Bible on Twitter'></a>
<a href='https://www.AionianBible.org/LinkedIn'		target='_blank' title='LinkedIn/AionianBible'>	<img src='https://www.AionianBible.org/images/Aionian-Bible-LinkedIn.png' alt='LinkedIn' title='Aionian Bible on LinkedIn'></a>
<a href='https://www.AionianBible.org/Instagram'	target='_blank' title='Instagram/AionianBible'>	<img src='https://www.AionianBible.org/images/Aionian-Bible-Instagram.png' alt='Instagram' title='Aionian Bible on Instagram'></a>
<a href='https://www.AionianBible.org/Pinterest'	target='_blank' title='Pinterest/AionianBible'>	<img src='https://www.AionianBible.org/images/Aionian-Bible-Pinterest.png' alt='Pinterest' title='Aionian Bible on Pinterest'></a>
<a href='https://www.AionianBible.org/YouTube'		target='_blank' title='YouTube/AionianBible'>	<img src='https://www.AionianBible.org/images/Aionian-Bible-Youtube.png' alt='YouTube' title='Aionian Bible on Youtube'></a>
<a href='https://www.AionianBible.org/Google-Play'	target='_blank' title='GooglePlay/AionianBible'><img src='https://www.AionianBible.org/images/Aionian-Bible-GooglePlay.png' alt='GooglePlay' title='Aionian Bible on GooglePlay'></a>
<a href='https://www.AionianBible.org/TOR'			target='_blank' title='TOR/AionianBible'>		<img src='https://www.AionianBible.org/images/Aionian-Bible-TOR.png' alt='TOR' title='Aionian Bible on The Onion Router network'></a>
<a href='https://www.AionianBible.org/EmailNews'	target='_blank' title='EmailNews/AionianBible'>	<img src='https://www.AionianBible.org/images/Aionian-Bible-Button-Your-Gift-Email-Newsletter.png' alt='EmailNews' title='Aionian Bible Gift and Newsletter'></a>
<a href='https://www.AionianBible.org/Buy' title='Buy Aionian Bibles and T-Shirts'>					<img src='https://www.AionianBible.org/images/Aionian-Bible-Button-Buy-Square.png' alt='Buy Bibles' title='Buy Aionian Bible in print'></a>
</div>
</div>


<script>
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// Bible page indices
const Zcov = 0;
const Zcop = 1;
const Zpre = 2;
const Zaio = 3;
const Ztoc = 4;
const Zoti = 5;
const Zgen = 6;
const Znti = {$G_PWA->bible_nti} +  6;
const Zend = {$G_PWA->bible_numb} +  6;
const Zrea = {$G_PWA->bible_numb} +  7;
const Zpro = {$G_PWA->bible_numb} +  8;
const Zglo = {$G_PWA->bible_numb} +  9;
const Zpas = {$G_PWA->bible_numb} + 10;
const Zfut = {$G_PWA->bible_numb} + 11;
const Zdes = {$G_PWA->bible_numb} + 12;
const Zabe = {$G_PWA->bible_numb} + 13;
const Zisr = {$G_PWA->bible_numb} + 14;
const Zjes = {$G_PWA->bible_numb} + 15;
const Zpau = {$G_PWA->bible_numb} + 16;
const Zwor = {$G_PWA->bible_numb} + 17;



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// Globals
var AB_Accessible	= null;
var AB_Bookmark		= Ztoc;
var AB_Bookmark2	= Ztoc;
var AB_Page			= 0;



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// Bible pages
const AB_Bible = [



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// COVER - populated from HTML body on page load
``,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// COPYRIGHT
`
<h2 class='center'>Copyright</h2>
<span class='j316'><span class='ff tex' lang='en' >For God so loved the world, that he gave his only begotten Son, that whoever believes in him should not perish, but have ...</span> Aionian Life!</span><br>
<br>
The world’s first Holy Bible untranslation<br>
Also known as the Purple Bible<br>
100% Free to Copy and Print at <a href='https://www.AionianBible.org' target='_blank' title='Holy Bible Aionian Edition online'>AionianBible.org</a><br>
<a href='https://www.AionianBible.org/Buy' target='_blank' title='Holy Bible Aionian Edition hardcopy print at Amazon and Lulu'>Buy hardcopy print format</a><br>
<br>
Publisher: Nainoia Inc<br>
Copyright: <a href='https://creativecommons.org/licenses/by/4.0/' target='_blank'>Creative Commons Attribution 4.0 International, 2018-2024</a><br>
Language: {$G_VERSIONS['LANGUAGEHTML']}<br>
Formatted: ABCMS on {$G_PWA->modified}<br>
Online: <a href='https://www.AionianBible.org/Bibles/English---Aionian-Bible' target='_blank' title='Read online'>Read</a> and <a href='https://www.AionianBible.org/TOR/Bibles/English---Aionian-Bible' target='_blank' title='Read TOR anonymously'>TOR Anonymously</a><br>
Download: 
<a href='https://resources.AionianBible.org/Holy-Bible---English---Aionian-Bible---Aionian-Edition.epub' target='_blank' title='Download this ePub'>This ePub</a>, 
<a href='https://resources.AionianBible.org/Holy-Bible---English---Aionian-Bible---Aionian-Edition.pdf' target='_blank' title='Download PDF'>PDF</a>, 
<a href='https://resources.AionianBible.org/Holy-Bible---English---Aionian-Bible---Aionian-Edition---STUDY.pdf' target='_blank' title='Download Study PDF'>Study PDF</a>, 
<a href='https://resources.AionianBible.org/Holy-Bible---English---Aionian-Bible---Aionian-Edition.noia' target='_blank' title='Download Data File'>Data File</a>, and 
<a href='https://resources.AionianBible.org' target='_blank' title='Download Everything'>Everything</a><br>

<br>
Source: Nainoia Inc Aionian Verse retranslation of World English Bible Updated via Marshall, 2018-2024<br>
Source copyright: Creative Commons Attribution 4.0 International<br>
Source version: 10/1/2024<br>
Source text: <a href='https://www.AionianBible.org' target='_blank'>https://www.AionianBible.org</a><br>
<br>
We pray for a modern public domain translation in every language. Report concerns to <a href='https://nainoia-inc.signedon.net/' target='_blank' title='Publisher of the Holy Bible Aionian Edition'>Nainoia Inc</a>. Volunteer help appreciated! Given to our family, friends, and fellowman for Christ’s victory of grace!<br>
`,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// PREFACE
`
<h2 class='center'>{$G_FORPRINT['W_PREF']}</h2>

<p>The  <i class='notranslate'>Holy Bible Aionian Edition®</i>  is the world’s first Bible <i>un-translation</i>!  What is an  <i>un-translation</i>?  Bibles are translated into each of our languages from the original Hebrew, Aramaic, and Koine Greek.  Occasionally, the best word translation cannot be found and these words are transliterated letter by letter.  Four well known transliterations are  <i>Christ</i>,  <i>baptism</i>,  <i>angel</i>, and  <i>apostle</i>.  The meaning is then preserved more accurately through context and a dictionary.  The  <span class='notranslate'>Aionian</span>  Bible un-translates and instead transliterates eleven additional <a href="#" title="Aionian glossary" onclick="ABDO(\${Zglo});return false;"><span class='notranslate'>Aionian</span> Glossary</a> words to help us better understand God’s love for individuals and all mankind, and the nature of afterlife destinies.</p>

<p>The first three words are  <a href='/Glossary#g165' title='Aionian Glossary g165' onclick='return AionianBible_Makemark("/Glossary","#g165");'><i class='notranslate'>aiōn</i></a>,  <a href='/Glossary#g166' title='Aionian Glossary g166' onclick='return AionianBible_Makemark("/Glossary","#g166");'><i class='notranslate'>aiōnios</i></a>, and  <a href='/Glossary#g126' title='Aionian Glossary g126' onclick='return AionianBible_Makemark("/Glossary","#g126");'><i class='notranslate'>aïdios</i></a>,  typically translated as  <i>eternal</i>  and also  <i>world</i>  or  <i>eon</i>. The  <span class='notranslate'>Aionian</span>  Bible is named after an alternative spelling of  <i class='notranslate'>aiōnios</i>. Consider that researchers question if  <i class='notranslate'>aiōn</i>  and  <i class='notranslate'>aiōnios</i>  actually mean <i>eternal</i>. Translating  <i class='notranslate'>aiōn</i>  as <i>eternal</i> in  <a href='/Bibles/English---Aionian-Bible/Matthew/28' title='Matthew 28:20' onclick='return AionianBible_Makemark("/Bibles","/Matthew/28");'>Matthew 28:20</a>  makes no sense, as all agree. The Greek word for eternal is  <i class='notranslate'>aïdios</i>, used in  <a href='/Bibles/English---Aionian-Bible/Romans/1' title='Romans 1:20' onclick='return AionianBible_Makemark("/Bibles","/Romans/1");'>Romans 1:20</a>  about God and in  <a href='/Bibles/English---Aionian-Bible/Jude/1' title='Jude 6' onclick='return AionianBible_Makemark("/Bibles","/Jude/1");'>Jude 6</a>  about demon imprisonment. Yet what about  <i class='notranslate'>aiōnios</i>  in  <a href='/Bibles/English---Aionian-Bible/John/3' title='John 3:16' onclick='return AionianBible_Makemark("/Bibles","/John/3");'>John 3:16</a>? Certainly we do not question whether salvation is eternal! However,  <i class='notranslate'>aiōnios</i>  means something much more wonderful than infinite time! Ancient Greeks used  <i class='notranslate'>aiōn</i>  to mean eon or age. They also used the adjective  <i class='notranslate'>aiōnios</i>  to mean entirety, such as  <i>complete</i>  or even <i>consummate</i>, but never infinite time. Read <a href='/Aionios-and-Aidios'>Dr. Heleen Keizer and Ramelli and Konstan</a> for proofs. So  <i class='notranslate'>aiōnios</i>  is the perfect description of God's Word which has  <i>everything</i>  we need for life and godliness! And the  <i class='notranslate'>aiōnios</i>  life promised in  <a href='/Bibles/English---Aionian-Bible/John/3' title='John 3:16' onclick='return AionianBible_Makemark("/Bibles","/John/3");'>John 3:16</a>  is not simply a ticket to eternal life in the future, but the invitation through faith to the  <i>consummate</i>  life beginning now!  <i class='notranslate'>Aiōnios</i>  life with Christ is <a href='/Buy#Better'><i>Better than Forever</i></a>.</p>

<p>The next seven words are  <a href='/Glossary#h7585' title='Aionian Glossary h7585' onclick='return AionianBible_Makemark("/Glossary","#h7585");'><i class='notranslate'>Sheol</i></a>,  <a href='/Glossary#g86' title='Aionian Glossary g86' onclick='return AionianBible_Makemark("/Glossary","#g86");'><i class='notranslate'>Hadēs</i></a>,  <a href='/Glossary#g1067' title='Aionian Glossary g1067' onclick='return AionianBible_Makemark("/Glossary","#g1067");'><i class='notranslate'>Geenna</i></a>,  <a href='/Glossary#g5020' title='Aionian Glossary g5020' onclick='return AionianBible_Makemark("/Glossary","#g5020");'><i class='notranslate'>Tartaroō</i></a>,  <a href='/Glossary#g12' title='Aionian Glossary g12' onclick='return AionianBible_Makemark("/Glossary","#g12");'><i class='notranslate'>Abyssos</i></a>, and  <a href='/Glossary#g3041' title='Aionian Glossary g3041 g4442' onclick='return AionianBible_Makemark("/Glossary","#g3041");'><i class='notranslate'>Limnē Pyr</i></a>. These words are often translated as  <i>Hell</i>, the place of eternal punishment. However,  <i>Hell</i>  is ill-defined when compared with the Hebrew and Greek.  For example,  <i class='notranslate'>Sheol</i>  is the abode of deceased believers and unbelievers and should never be translated as  <i>Hell</i>.  <i class='notranslate'>Hadēs</i>  is a temporary place of punishment,  <a href='/Bibles/English---Aionian-Bible/Revelation/20' title='Revelation 20:13-14' onclick='return AionianBible_Makemark("/Bibles","/Revelation/20");'>Revelation 20:13-14</a>.  <i class='notranslate'>Geenna</i>  is the Valley of Hinnom, Jerusalem's refuse dump, a temporal judgment for sin.  <i class='notranslate'>Tartaroō</i>  is a prison for demons, mentioned once in  <a href='/Bibles/English---Aionian-Bible/2-Peter/2' title='2 Peter 2:4' onclick='return AionianBible_Makemark("/Bibles","/2-Peter/2");'>2 Peter 2:4</a>.  <i class='notranslate'>Abyssos</i>  is a temporary prison for the Beast and Satan. Translators are also inconsistent because  <i>Hell</i>  is used by the  <a href='/Bibles/English---King-James-Version' title='King James Version'>King James Version</a>  54 times, the  <a href='https://www.thenivbible.com/' target='_blank' title='New International Version Bible'>New International Version</a>  14 times, and the  <a href='/Bibles/English---World-English-Bible' title='World English Bible'>World English Bible</a>  zero times.  Finally,  <i class='notranslate'>Limnē Pyr</i>  is the Lake of Fire, yet  <a href='/Bibles/English---Aionian-Bible/Matthew/25' title='Matthew 25:41' onclick='return AionianBible_Makemark("/Bibles","/Matthew/25");'>Matthew 25:41</a>  explains that these fires are  <a href='/Destiny' title='Lake of Fire prepared for the Devil and his angels'>prepared for the Devil and his angels</a>. So there is reason to review our conclusions about the destinies of redeemed mankind and fallen angels.</p>

<p>The eleventh word,  <a href='/Glossary#g1653' title='Aionian Glossary g1653' onclick='return AionianBible_Makemark("/Glossary","#g1653");'><i class='notranslate'>eleēsē</i></a>, reveals the grand conclusion of grace in  <a href='/Bibles/English---Aionian-Bible/Romans/11' title='Romans 11:32' onclick='return AionianBible_Makemark("/Bibles","/Romans/11");'> Romans 11:32</a>. Take the time to understand these eleven words.  The original translation is unaltered and a highlighted note is added to 64 Old Testament and 200 New Testament verses.  Also to help parallel study and <a href='/Strongs' title='Strongs Enhanced Concordance and Glossary' onclick='return AionianBible_Makemark("/Strongs");'>Strong's Enhanced Concordance</a> use, apocryphal text is removed and most variant verse numbering is mapped to the English standard.  The  <span class='notranslate'>Aionian</span>  Bible republishes public domain and Creative Common Bible texts.  We thank our sources at  <a href='https://ebible.org' target='_blank' title='eBible.org, a DBA of Wycliffe, Inc, founded by Michael Paul Johnson'>eBible.org</a>, <a href='https://crosswire.org' target='_blank' title='The Crosswire Bible Society'>Crosswire.org</a>,  <a href='https://unbound.biola.edu' target='_blank' title='The Biola University Unbound Bible Project'>unbound.Biola.edu</a>,  <a href='https://Bible4u.net' target='_blank' title='Bible4U Uncensored bible'>Bible4u.net</a>, and  <a href='https://NHEB.net' target='_blank' title='New Heart English Bible'>NHEB.net</a>.  The <span class='notranslate'>Aionian</span>  Bible is copyrighted with the <a href='https://creativecommons.org/licenses/by/4.0' target='_blank' title='Copyright license'>Creative Commons Attribution 4.0 International</a> license, allowing 100% freedom to copy and print, if respecting source text copyrights.  Review the project  <a href='/History' title='History and change log'>History</a>, <a href='/Readers-Guide' title='Readers guide for the Aionian Bible'>Reader's Guide</a>, and <a href='/Maps' title='Maps, Timelines, and Illustations'>Maps</a>. Read  <a href='/Read' title='Read and Study Bible' onclick='return AionianBible_Bookmark("/Read");'>online</a>  with the  <a href='/Google-Play' target='_blank' title='Aionian Bible free online at Google Play'><span class='notranslate'>Android</span></a>  and <a href='/Apple-iOS-App' title='Apple iOS App'><span class='notranslate'>Apple iOS App</span></a>, also the <a href='/TOR' target='_blank' title='TOR Network'>TOR Network</a>, <a href='/AB-CUSTOM-VERSES.txt'>request custom formatted verses</a>, and buy Bibles at <a href='/Buy' title='Holy Bible Aionian Edition at Amazon.com and Lulu.com'>Amazon.com and Lulu.com</a>.  Follow at <a href='/Facebook' target='_blank'>Facebook/AionianBible</a>, help <a href='/Promote' title='Promote, Sponsor, Advertise, Market'>Promote</a> and <a href='/Third-Party-Publisher-Resources' title='Third Party Publisher Resources'>Publish</a>, review the <a href='/Privacy' title='Privacy Policy'>Privacy Policy</a>, and contact the  <a href='/Publisher' title='Contact Nainoia, Inc'>Publisher</a>.  The <a href='/Bibles/English---Aionian-Bible' title='Holy Bible Aionian Edition: Aionian Bible'><span class='notranslate'>Aionian</span>  Bible</a> is the recommended English translation.</p>

<p>Why purple? King Jesus’ Word is royal… and purple is the color of royalty!</p>
`,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// AIONIOS
`
<h2>Aiōnios and Aïdios</h2>
Hello world!<br>
`,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// TOC
`
<h2>{$G_FORPRINT['W_TOC']}</h2>
Swipe right and left for next and previous page<br>
<a title="Cover"						href="#" onclick="ABDO(\${Zcov});return false;">Cover</a><br>
<a title="Copyright"					href="#" onclick="ABDO(\${Zcop});return false;">Copyright</a><br>
<a title="Preface"						href="#" onclick="ABDO(\${Zpre});return false;">Preface</a><br>
<a title="Aiōnios and Aïdios"			href="#" onclick="ABDO(\${Zaio});return false;">Aiōnios and Aïdios</a><br>
<a title="Old Testament"				href="#" onclick="ABDO(\${Zoti});return false;">Old Testament</a><br>
<a title="New Testament"				href="#" onclick="ABDO({$G_PWA->bible_nti});return false;">New Testament</a><br>
{$G_PWA->bible_menu}<br>
<a title="The New Jerusalem"			href="#" onclick="ABDO(\${Zend});return false;">The New Jerusalem</a><br>
<a title="Reader's Guide"				href="#" onclick="ABDO(\${Zrea});return false;">Reader's Guide</a><br>
<a title="Project History"				href="#" onclick="ABDO(\${Zpro});return false;">Project History</a><br>
<a title="Aionian Glossary"				href="#" onclick="ABDO(\${Zglo});return false;">Aionian Glossary</a><br>
<a title="History Past"					href="#" onclick="ABDO(\${Zpas});return false;">History Past</a><br>
<a title="History Future"				href="#" onclick="ABDO(\${Zfut});return false;">History Future</a><br>
<a title="Destiny"						href="#" onclick="ABDO(\${Zdes});return false;">Destiny</a><br>
<a title="Abraham's Journeys"			href="#" onclick="ABDO(\${Zabe});return false;">Abraham's Journeys</a><br>
<a title="Israel's Exodus"				href="#" onclick="ABDO(\${Zisr});return false;">Israel's Exodus</a><br>
<a title="Jesus' Journeys"				href="#" onclick="ABDO(\${Zjes});return false;">Jesus' Journeys</a><br>
<a title="Paul's Missionary Journeys"	href="#" onclick="ABDO(\${Zpau});return false;">Paul's Missionary Journeys</a><br>
<a title="World Nations"				href="#" onclick="ABDO(\${Zwor});return false;">World Nations</a><br>
`,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// OT IMAGE
`
<h2>{$G_FORPRINT['W_OLD']}</h2>
<div class="map"><img src="https://resources.aionianbible.org/Gustave-Dore-La-Grande-Bible-de-Tours/web/Gustave-Dore-Bible-Tour-Hebrew-OT-003-Adam-and-Eve-Are-Driven-out-of-Eden.jpg" alt="Adam and Eve are driven out of Eden"></div>
{$G_FORPRINT['GEN3_24']}
`,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// BIBLE
{$G_PWA->bible_text}



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// END IMAGE
`
<h2>New Jerusalem</h2>
<div class="map"><img src="https://resources.aionianbible.org/Gustave-Dore-La-Grande-Bible-de-Tours/web/Gustave-Dore-Bible-Tour-NT-Gospel-241-The-New-Jerusalem.jpg" alt="The New Jerusalem"></div>
{$G_FORPRINT['REV21_2_3']}
`,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// READERS
`
<h2>{$G_FORPRINT['W_READ']}</h2>
`,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// HISTORY
`
<h2 class='center'>Project History</h2>
<p>
The <span class='notranslate'>Aionian</span>  Bible republishes public domain and Creative Common Bible texts that are 100% free to copy and print.
All versions are available online at <a href='/Read' title='The worlds first Holy Bible untranslation'>AionianBible.org</a> in web page, ePub, text, and PDF format.  Also read online with the  <a href='/Google-Play' target='_blank' title='Aionian Bible free online at Google Play'><span class='notranslate'>Android</span></a>  and  <a href='/Apple-iOS-App' title='Apple iOS App'><span class='notranslate'>Apple iOS App</span></a>.  Buy print Bibles at <a href='/Buy' title='Holy Bible Aionian Edition at Amazon.com and Lulu.com'><span class='notranslate'>Amazon.com and Lulu.com</span></a>.<br />
<br />
</p><p>
<b>08/18/24</b>&nbsp;&nbsp;<a href='https://creativecommons.org/licenses/by/4.0/' target='_blank' title='Copyright license'>Creative Commons Attribution 4.0 International</a>, if source allows.<br />
</p><p>
<b>08/05/24</b>&nbsp;&nbsp;377 translations now available in 166 languages.<br />
</p><p>
<b>05/01/24</b>&nbsp;&nbsp;370 translations now available in 164 languages.<br />
</p><p>
<b>02/04/24</b>&nbsp;&nbsp;352 translations now available in 142 languages.<br />
</p><p>
<b>12/04/23</b>&nbsp;&nbsp;<a href='/Glossary#g1653' title='View definition' onclick='return AionianBible_Makemark("/Glossary","#g1653");'>Eleēsē</a> added to the <a href='/Glossary' title='Strongs Enhanced Concordance and Glossary' onclick='return AionianBible_Makemark("/Glossary","");'>Aionian Glossary</a>.<br />
</p><p>
<b>02/14/23</b>&nbsp;&nbsp;Aionian Bible published for anonymous access on the <a href='/TOR' target='_blank' title='TOR Network'>TOR Network</a>.<br />
</p><p>
<b>02/14/22</b>&nbsp;&nbsp;<a href='https://en.wikipedia.org/wiki/Strong%27s_Concordance' target='_blank' title='Strongs Concordance history at wikipedia'>Strong's Concordance</a> from <a href='https://viz.bible' target='_blank' title='Strongs Concordance source'>viz.bible</a>, <a href='https://github.com/openscriptures/strongs' target='_blank' title='improved Strongs Concordance source'>Open Scriptures</a>, and <a href='https://github.com/STEPBible/STEPBible-Data' target='_blank' title='STEPBible Enhanced Strongs Concordance'>STEPBible Enhanced Strong's</a> at <a href='/Strongs' title='Strongs Enhanced Concordance and Glossary' onclick='return AionianBible_Makemark("/Strongs");'>AionianBible.org/Strongs</a>.<br />
</p><p>
<b>01/09/22</b>&nbsp;&nbsp;<a href='https://resources.aionianbible.org/AB-StudyPack/' target='_blank' title='Aionian Bible language StudyPacks'>StudyPack</a> resources for Bible translation and underlying language study now available.<br />
</p><p>
<b>01/01/22</b>&nbsp;&nbsp;216 translations now available in 99 languages.<br />
</p><p>
<b>12/20/21</b>&nbsp;&nbsp;Social media presence on 
<a href='/Facebook'		target='_blank' title='Facebook/AionianBible'>Facebook</a>,
<a href='/Twitter'		target='_blank' title='Twitter/AionianBible'>Twitter</a>,
<a href='/LinkedIn'		target='_blank' title='LinkedIn/AionianBible'>LinkedIn</a>,
<a href='/Instagram'	target='_blank' title='Instagram/AionianBible'>Instagram</a>,
<a href='/Pinterest'	target='_blank' title='Pinterest/AionianBible'>Pinterest</a>,
<a href='/YouTube'		target='_blank' title='YouTube/AionianBible'>YouTube</a>,
<a href='/Google-Play'	target='_blank' title='GooglePlay/AionianBible'>GooglePlay</a>, and
<a href='/EmailNews'	target='_blank' title='EmailNews/AionianBible'>MailChimp</a><br />
</p><p>
<b>11/17/21</b>&nbsp;&nbsp;<a href='/Bible-Cover'  title='Buy the Aionian Bible Branded Leather Bible Cover'>Aionian Bible Branded Leather Bible Covers</a> now available.<br />
</p><p>
<b>03/31/21</b>&nbsp;&nbsp;214 translations now available in 99 languages.<br />
</p><p>
<b>12/01/20</b>&nbsp;&nbsp;Right to left and Hindic languages now available in PDF format.<br />
</p><p>
<b>08/29/20</b>&nbsp;&nbsp;Aionian Bibles now available in ePub format.<br />
</p><p>
<b>05/25/20</b>&nbsp;&nbsp;Illustrations by Gustave Doré, <a href='https://resources.aionianbible.org/Gustave-Dore-La-Grande-Bible-de-Tours/' title='Gustave Dorés La Grande Bible de Tours' target='_blank'>La Grande Bible de Tours</a>, (Felix Just, S.J., <a href='https://catholic-resources.org/Art/Dore.htm' title='Catholic Resources' target='_blank'>Catholic-Resources.org/Art/Dore.htm</a>).<br />
</p><p>
<b>02/22/20</b>&nbsp;&nbsp;Aionian Bibles available in print at <a href='/Lulu' target='_blank' title='Aionian Bibles in print at Lulu.com'>Lulu.com</a>.<br />
</p><p>
<b>10/31/19</b>&nbsp;&nbsp;174 translations now available in 74 languages.<br />
</p><p>
<b>10/28/19</b>&nbsp;&nbsp;<span class='notranslate'>Aionian</span>  Bible project nursed as J. and J. pray.<br />
</p><p>
<b>03/24/19</b>&nbsp;&nbsp;135 translations now available in 67 languages.<br />
</p><p>
<b>11/17/18</b>&nbsp;&nbsp;104 translations now available in 57 languages.<br />
</p><p>
<b>10/20/18</b>&nbsp;&nbsp;70 translations now available in 33 languages.<br />
</p><p>
<b>03/06/18</b>&nbsp;&nbsp;Aionian Bibles available in print at <a href='/Amazon' target='_blank' title='Aionian Bibles in print at Amazon.com'>Amazon.com</a>.<br />
</p><p>
<b>02/01/18</b>&nbsp;&nbsp;<i class='notranslate'>Holy Bible Aionian Edition®</i>  trademark registered.<br />
</p><p>
<b>07/30/17</b>&nbsp;&nbsp;42 translations now available in 22 languages.<br />
</p><p>
<b>07/01/17</b>&nbsp;&nbsp;<i>'The Purple Bible'</i> nickname begins.<br />
</p><p>
<b>01/16/17</b>&nbsp;&nbsp;<a href='/Google-Play' target='_blank' title='Aionian Bible free online at Google Play'><span class='notranslate'>Aionian</span>  Bible Google Play Store App</a> published.<br />
</p><p>
<b>01/01/17</b>&nbsp;&nbsp;<a href='https://creativecommons.org/licenses/by-nd/4.0' target='_blank' title='Copyright license'>Creative Commons Attribution No Derivative Works 4.0</a> license added.<br />
</p><p>
<b>12/07/16</b>&nbsp;&nbsp;<a href='https://NAINOIA-INC.signedon.net' target='_blank' title='Nainoia, Inc. exists for Christian mission promotion, technical support services, and Bible translation'>Nainoia Inc</a> established as non-profit corporation.<br />
</p><p>
<b>06/21/16</b>&nbsp;&nbsp;30 translations available in 12 languages.<br />
</p><p>
<b>01/11/16</b>&nbsp;&nbsp;<a href='/'  title='The worlds first Holy Bible untranslation'>AionianBible.org</a> domain registered.<br />
</p><p>
<b>06/21/15</b>&nbsp;&nbsp;<span class='notranslate'>Aionian</span>  Bible project birthed as G. and J. pray.<br />
</p><p>
<b>12/18/13</b>&nbsp;&nbsp;<span class='notranslate'>Aionian</span>  Bible project announced as J. and J. pray.<br />
</p><p>
<b>04/15/85</b>&nbsp;&nbsp;<span class='notranslate'>Aionian</span>  Bible project conceived as B. and J. pray.<br />
</p>
`,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// GLOSSARY
`
<h2>{$G_FORPRINT['W_GLOS']}</h2>
`,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// PAST
`
<h2>History Past</h2>
<div class="map"><img src="https://www.AionianBible.org//images/Timeline-History-Aionian-Bible.jpg" alt="History Past"></div>
`,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// FUTURE
`
<h2>History Future</h2>
<div class="map"><img src="https://www.AionianBible.org//images/Timeline-Eschatology-Aionian-Bible.jpg" alt="History Future"></div>
`,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// DESTINY
`
<h2>{$G_FORPRINT['W_DESTINY']}</h2>
`,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// ABRAHAM
`
<h2>Abraham's Journey</h2>
<div class="map"><img src="https://www.AionianBible.org//images/MAP-Abrahams-Journey.jpg" alt="Abraham's Journey"></div>
{$G_FORPRINT['HEB11_8']}
`,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// ISRAEL
`
<h2>Israel's Exodus</h2>
<div class="map"><img src="https://www.AionianBible.org//images/MAP-Israels-Exodus.jpg" alt="Israel's Exodus"></div>
{$G_FORPRINT['EXO13_17']}
`,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// JESUS
`
<h2>Jesus' Journeys</h2>
<div class="map"><img src="https://www.AionianBible.org//images/MAP-Jesus-Journeys.jpg" alt="Jesus' Journeys"></div>
{$G_FORPRINT['MAR10_45']}
`,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// PAUL
`
<h2>Paul's Missionary Journeys</h2>
<div class="map"><img src="https://www.AionianBible.org//images/MAP-Pauls-Missionary-Journeys.jpg" alt="Paul's Missionary Journeys"></div>
{$G_FORPRINT['ROM1_1']}
`,



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// WORLD
`
<h2>World Nations</h2>
<div class="map"><img src="https://www.AionianBible.org//images/MAP-World-Nations.jpg" alt="World Nations"></div>
{$G_FORPRINT['MAT28_19']}
`

];



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// load the page
// functions
function ABDO(goto, anchor=null) {
	// validate goto
	if (null === goto) { goto = AB_Bookmark; }
	else if (-1 === goto) { goto = Zglo; }
	if (typeof AB_Bible[goto] === 'undefined') {
		if ((AB_Page == 0 && goto < 0) || goto >= AB_Bible.length) { return; }
		alert("Oops, invalid link = " + goto);
		return;
	}
	AB_Page = goto;
	// bookmark current page
	if (AB_Page > 0 && AB_Bookmark != AB_Page) {
		AB_Bookmark = AB_Page;
		AionianBible_writeCookie("AionianBible.Bookmark", AB_Bookmark);
	}
	// homepage
	if (AB_Page == 0) { head = tail = ''; }
	// regular page
	else {
		head = `
<div id='page'>
<div id='sticky-body'>
<div id='head'>
<div id='head-hi'>
<div id='logo1'><a href='#' title='Aionian Bible homepage' onclick="ABDO(\${Zcov});return false;"><img src='https://www.AionianBible.org/images/Holy-Bible-Aionian-Edition-PURPLE-LOGO.png' alt='Aionian Bible'></a></div>
<div id='logo2'><a href='#' title='Aionian Bible homepage' onclick="ABDO(\${Zcov});return false;"><img src='https://www.AionianBible.org/images/Holy-Bible-Aionian-Edition-PURPLE-AB.png' alt='Aionian Bible'></a></div>
<div id='menu'>
<a href="#" title="Table of Contents" onclick="ABDO(\${Ztoc});return false;">Menu</a>
<a href='#' title='Go to Bookmark' onclick='AionianBible_Get();'>Get</a> 
<a href='#' title='Set Bookmark' onclick='AionianBible_Set();'>Set</a>
<a href="#" title="Previous page" class="nav left" onclick="ABDO(\${AB_Page}-1);return false;"><span class="nav clt">&lt;</span></a>
<a href="#" title="Next page" class="nav right" onclick="ABDO(\${AB_Page}+1);return false;"><span class="nav cgt">&gt;</span></a>
<a href='#' title='Font Size Accessibility' onclick='AionianBible_Accessible();' id='accessible'>+</a></div></div>
</div>
<div id="word-menu-float" class="notranslate">
<a href="#" title="Previous chapter" class="nav left" onclick="ABDO(\${AB_Page}-1);return false;"><span class="nav clt">&lt;</span></a>
<a href="#" title="Next chapter" class="nav right" onclick="ABDO(\${AB_Page}+1);return false;"><span class="nav cgt">&gt;</span></a>
</div>
<div id='body' class=''>
`;
		tail = `
</div>
<div id='sticky-push'></div>
</div>
<div id='sticky-foot'> 
<div id='tail'><a href='https://www.AionianBible.org' title='Visit AionianBible.org online for all Bibles' target='_blank'>Visit AionianBible.org online for all Bibles</a></div>
</div>
</div>
`;
	}
	document.getElementsByTagName("body")[0].innerHTML = head + AB_Bible[AB_Page] + tail;
	AB_Accessible = document.getElementById("body");
	if (null !== AB_Accessible) {
		AB_Accessible.className = AionianBible_readCookie("AionianBible.Accessible");
	}
	if (anchor === null) {	window.scrollTo(0,0); }
	else {					location.hash = "#" + anchor; }
}




///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// write cookie
function AionianBible_writeCookie(cname, cvalue) {
	var date = new Date();
	date.setTime(date.getTime() + (1000 * 24 * 60 * 60 * 1000));
	document.cookie = cname + ".{$G_PWA->bible_basic}" + "=" + cvalue + ";expires=" + date.toUTCString() + ";SameSite=Strict;path=/";
}



// read cookie
function AionianBible_readCookie(cname) {
	var nameEQ = cname + ".{$G_PWA->bible_basic}" + "=";
	var ca = document.cookie.split(";");
	for (var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (" "==c.charAt(0)) {
			c = c.substring(1,c.length);
		}
		if (0==c.indexOf(nameEQ)) {
			return c.substring(nameEQ.length,c.length);
		}
	}
	return null;
}



// onload
window.onload = function() {
	// get bookmarks
	AB_Bookmark = AionianBible_readCookie("AionianBible.Bookmark");
	if (null === AB_Bookmark) {
		AB_Bookmark = Ztoc;
		AionianBible_writeCookie("AionianBible.Bookmark", AB_Bookmark);
	}
	AB_Bookmark2 = AionianBible_readCookie("AionianBible.Bookmark2");
	if (null === AB_Bookmark2) {
		AB_Bookmark2 = Ztoc;
		AionianBible_writeCookie("AionianBible.Bookmark", AB_Bookmark2);
	}
	// lazy load hompage for javascript warning
    var now = new Date().getTime();
    while(new Date().getTime() < now + 3000){ }
	document.getElementById("java").outerHTML = '';
	AB_Bible[0] = document.getElementById("land").innerHTML;
}



// set and get
function AionianBible_Set() {
	AB_Bookmark2 = AB_Page;
	AionianBible_writeCookie("AionianBible.Bookmark2", AB_Bookmark2);
	return false;
}
function AionianBible_Get() {
	ABDO(AB_Bookmark2);
	return false;
}



// toggle accessibility
function AionianBible_Accessible() {
	AB_Accessible = document.getElementById("body");
	if (null!==AB_Accessible) {
		AB_Accessible.className = AionianBible_readCookie("AionianBible.Accessible");
		if ("larger"==AB_Accessible.className) {
			AB_Accessible.className = "";
			AionianBible_writeCookie("AionianBible.Accessible", "");
		}
		else if ("large"!=AB_Accessible.className) {
			AB_Accessible.className = "large";
			AionianBible_writeCookie("AionianBible.Accessible", "large");
		}
		else {
			AB_Accessible.className = "larger";
			AionianBible_writeCookie("AionianBible.Accessible", "larger");
		}
	}
	return false;
}


// swipe detect from http://www.javascriptkit.com/javatutors/touchevents2.shtml
function AionianBible_SwipeListener(handleswipe) {
	var swipedir, startX, startY, distX, distY, elapsedTime, startTime;
	document.body.addEventListener('touchstart', function(e) {
		var touchobj = e.changedTouches[0];
		swipedir = 'none';
		startX = touchobj.pageX;
		startY = touchobj.pageY;
		startTime = new Date().getTime(); // first contact
	}, false);
	document.body.addEventListener('touchend', function(e){
		var touchobj = e.changedTouches[0];
		distX = touchobj.pageX - startX; // horizontal distance
		distY = touchobj.pageY - startY; // vertical distance
		elapsedTime = new Date().getTime() - startTime; // time elapsed
		if (elapsedTime <= 300 && Math.abs(distX) >= 150 && Math.abs(distY) <= 100) { // time? horizontal? vertical?
			swipedir = (distX < 0)? 'left' : 'right'; // negative if left swipe, otherwise right
		}
		handleswipe(swipedir);
	}, false);
}
function AionianBible_SwipeLinks() {
	window.addEventListener('load', function() {
		AionianBible_SwipeListener(function(swipedir) {
			if (swipedir == 'right') {		ABDO(AB_Page - 1); }
			else if (swipedir == 'left') {	ABDO(AB_Page + 1); }
		} );
	}, false);
}
AionianBible_SwipeLinks();


// cache fetcher
// https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps/Guides/Caching



</script>



<!--////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--////////////////////////////////////////////////////////////////////////////////////////////////////-->
</body>
</html>
EOF;
}
