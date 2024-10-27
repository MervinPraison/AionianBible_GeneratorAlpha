#!/usr/local/bin/php
<?php



////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
// PWA
AION_LOOP_PWA(	'/home/inmoti55/public_html/domain.aionianbible.org/www-stageresources',
				'/home/inmoti55/public_html/domain.aionianbible.org/www-stage/library/pwa' );
AION_ECHO("DONE!");
return;


// LOOP
function AION_LOOP_PWA($source, $destiny) {
	$database = array();
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATE.txt', 'T_UNTRANSLATE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKS.txt', 'T_BOOKS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/NUMBERS.txt', 'T_NUMBERS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/VERSIONS.txt', 'T_VERSIONS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/FORPRINT.txt', 'T_FORPRINT', $database, 'BIBLE', FALSE );
	AION_LOOP( array(
		'function'		=> 'AION_LOOP_PWA_DOIT',
		'source'		=> $source,
		//'include'		=> "/Holy-Bible---.*(Albanian).*---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---.*(Aionian-Bible|Tsak).*---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---.+(Basic).+---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---.*(Azerb|Gaelic|Somali).*---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---.*(STEPBible).*---Aionian-Edition\.noia$/",
		'include'		=> "/Holy-Bible---English---Aionian-Bible---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---Gamotso---Gamo---Aionian-Edition\.noia$/",
		//'include'		=> "/---Aionian-Edition\.noia$/",
		'database'		=> $database,
		'destiny'		=> $destiny,
		) );
	AION_unset($database); unset($database);
	AION_ECHO("DONE DID IT!");
}


// BIBLE
function AION_LOOP_PWA_DOIT($args) {
	// TEMPLATE VARIABLES
	$PWA = new stdClass();
	$PWA->modified = date("n/j/Y");

	// BIBLE
	if (!preg_match("/\/Holy-Bible---(.*)---Aionian-Edition\.noia/", $args['filepath'], $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']); }
	$bible = $PWA->bible = "Holy-Bible---$matches[1]";
	$PWA->bible_basic = $matches[1];
	$error = "{$PWA->bible_basic} PWA,";
	if (empty($args['database'][T_BOOKS][$bible])) {													AION_ECHO("ERROR! $error Failed to find BOOK[bible]"); }
	if (($x=count($args['database'][T_BOOKS][$bible]))!=67) {											AION_ECHO("ERROR! $error Count(args[T_BOOKS][BIBLE])!=67: $x"); }
	if (empty($args['database'][T_NUMBERS][$bible])) {													AION_ECHO("ERROR! $error Failed to find NUMBERS[bible]"); }
	if (empty($args['database'][T_VERSIONS][$bible])) {													AION_ECHO("ERROR! $error Failed to find VERSIONS[bible]"); }
	if (empty($args['database'][T_FORPRINT][$bible])) {													AION_ECHO("ERROR! $error Failed to find FORPRINT[bible]"); }

	// GLOBALS
	global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
	$G_BOOKS	= $args['database'][T_BOOKS][$bible];
	$G_NUMBERS	= $args['database'][T_NUMBERS][$bible];
	$G_VERSIONS	= $args['database'][T_VERSIONS][$bible];
	$G_FORPRINT	= $args['database'][T_FORPRINT][$bible];
	$G_TITLE	= "Holy Bible Aionian Edition: ".$G_VERSIONS['NAMEENGLISH'];
	$G_MODIFIED	= date('Y-m-d\TH:i:s\Z');
	$G_RTL		= (empty($G_VERSIONS['RTL']) ? "" : "dir='rtl'");
	$G_ISO		= (empty($G_VERSIONS['LANGUAGECODEISO']) ? "" : "lang='".$G_VERSIONS['LANGUAGECODEISO']."'");
	$PWA->bible_name	= $G_VERSIONS['NAMEENGLISH'];
	$PWA->bible_acopy	= $G_VERSIONS['ABCOPYRIGHT'];
	$PWA->bible_copy	= $G_VERSIONS['COPYRIGHT'];
	$PWA->bible_text	= NULL;
	$PWA->bible_numb	= 0;

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
	$G_VERSIONS['SOURCEVERSION'] = (filemtime($base.$sour)===FALSE ? '' : ("Source version: ".date("n/j/Y", filemtime($base.$sour))."<br />"));

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
	$G_VERSIONS['LANGUAGEHTML'] = (empty($G_VERSIONS['LANGUAGE']) || $G_VERSIONS['LANGUAGE']=="English" ? "" : "<span $csslan>".$G_VERSIONS['LANGUAGE']."</span> at ");
	
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
		? "<span class='j316'><span $csstex>".$G_FORPRINT['JOH3_16']."</span> Aionian ".$G_FORPRINT['W_LIFE']."!</span>"
		: (!empty($G_FORPRINT['JOH3_16'])
		? "<span class='j316'><span $csstex>".$G_FORPRINT['JOH3_16']."</span> ".$G_FORPRINT['W_LIFE']." Aionian!</span>"
		: "<span class='j316'>For God so loved the world that he gave his only begotten Son that whoever believes in him should not perish, but have... Aionian Life!</span>"));
	$G_FORPRINT['GEN3_24'] = (!empty($G_FORPRINT['GEN3_24'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['GEN3_24']."<br />".$front.$G_FORPRINT['GEN3_24_B'].$backot."</span></p>"
		: "<p class='cap'>“So he drove out the man; and he placed cherubim at the east of the garden of Eden, and a flaming sword which turned every way, to guard the way to the tree of life.”<br />Genesis 3:24</p>");
	$G_FORPRINT['LUK23_34'] = (!empty($G_FORPRINT['LUK23_34'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['LUK23_34']."<br />".$front.$G_FORPRINT['LUK23_34_B'].$back."</span></p>"
		: "<p class='cap'>“Jesus said, ‘Father, forgive them, for they don’t know what they are doing.’ Dividing his garments among them, they cast lots.”<br />Luke 23:34</p>");
	$G_FORPRINT['REV21_2_3'] = (!empty($G_FORPRINT['REV21_2_3'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['REV21_2_3']."<br />".$front.$G_FORPRINT['REV21_2_3_B'].$back."</span></p>"
		: "<p class='cap'>“I saw the holy city, New Jerusalem, coming down out of heaven from God, prepared like a bride adorned for her husband. I heard a loud voice out of heaven saying, ‘Behold, God’s dwelling is with people, and he will dwell with them, and they will be his people, and God himself will be with them as their God.’”<br />Revelation 21:2-3</p>");
	$G_FORPRINT['HEB11_8'] = (!empty($G_FORPRINT['HEB11_8'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['HEB11_8']."<br />".$front.$G_FORPRINT['HEB11_8_B'].$back."</span></p>"
		: "<p class='cap'>“By faith, Abraham, when he was called, obeyed to go out to the place which he was to receive for an inheritance. He went out, not knowing where he went”<br />Hebrews 11:8</p>");
	$G_FORPRINT['EXO13_17'] = (!empty($G_FORPRINT['EXO13_17'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['EXO13_17']."<br />".$front.$G_FORPRINT['EXO13_17_B'].$backot."</span></p>"
		: "<p class='cap'>“When Pharaoh had let the people go, God didn’t lead them by the way of the land of the Philistines, although that was near; for God said, ‘Lest perhaps the people change their minds when they see war, and they return to Egypt’”<br />Exodus 13:17</p>");
	$G_FORPRINT['MAR10_45'] = (!empty($G_FORPRINT['MAR10_45'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['MAR10_45']."<br />".$front.$G_FORPRINT['MAR10_45_B'].$back."</span></p>"
		: "<p class='cap'>“For the Son of Man also came not to be served, but to serve, and to give his life as a ransom for many”<br />Mark 10:45</p>");
	$G_FORPRINT['ROM1_1'] = (!empty($G_FORPRINT['ROM1_1'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['ROM1_1']."<br />".$front.$G_FORPRINT['ROM1_1_B'].$back."</span></p>"
		: "<p class='cap'>“Paul, a servant of Jesus Christ, called to be an apostle, set apart for the Good News of God”<br />Romans 1:1</p>");
	$G_FORPRINT['MAT28_19'] = (!empty($G_FORPRINT['MAT28_19'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['MAT28_19']."<br />".$front.$G_FORPRINT['MAT28_19_B'].$back."</span></p>"
		: "<p class='cap'>“Go and make disciples of all nations, baptizing them in the name of the Father and of the Son and of the Holy Spirit”<br />Matthew 28:19</p>");

	// GET BIBLE	
	$database = array();
	AION_FILE_DATA_GET( $args['filepath'], 'T_BIBLE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	// CREATE Glossary Page Links
	$h7585	= glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "h7585");
	$g12	= glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g12");
	$g86	= glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g86");
	$g126	= glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g126");
	$g165	= glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g165");
	$g1653	= glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g163");
	$g166	= glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g166");
	$g1067	= glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g1067");
	$g3041	= glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g3041");
	$g5020	= glossarylinks($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g5020");
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
	$ref_prev = $chp_prev = NULL;
	foreach($database['T_UNTRANSLATE'] as $ref => $verse) { // assign the previous aionian note link
		if (empty($database['T_BIBLE'][$ref])) { continue; }
		$ref_chap = $verse['INDEX'].'-'.$verse['BOOK'].'-'.$verse['CHAPTER'];
		$chp_prev = ($ref_prev===NULL ? "" : ($ref_chap == $ref_prev ? $chp_prev : $ref_prev));
		$database['T_UNTRANSLATE'][$ref]['PREV'] = ($chp_prev ? "<a href='./$chp_prev.xhtml' title='View previous annotation'>&lt;</a>"  : "");
		$ref_prev = $ref_chap;
	}
	$ref_prev = $chp_prev = NULL;
	foreach(array_reverse($database['T_UNTRANSLATE']) as $ref => $verse) { // assign the next aionian note link
		if (empty($database['T_BIBLE'][$ref])) { continue; }
		$ref_chap = $verse['INDEX'].'-'.$verse['BOOK'].'-'.$verse['CHAPTER'];
		$chp_prev = ($ref_prev===NULL ? "" : ($ref_chap == $ref_prev ? $chp_prev : $ref_prev));
		$database['T_UNTRANSLATE'][$ref]['NEXT'] = ($chp_prev ? "<a href='./$chp_prev.xhtml' title='View next annotation'>&gt;</a>"  : "");
		$ref_prev = $ref_chap;
	}
	
	// CREATE chapter files
	$last_indx = $last_book = $last_chap = $contents = NULL;
	foreach($database['T_BIBLE'] as $ref => $verse) {
		// INIT
		$indx = $verse['INDEX'];
		$book = $verse['BOOK'];
		$chap = $verse['CHAPTER'];
		$chaN = (int)$chap;
		$vers = $verse['VERSE'];
		$verN = (int)$vers;
		$text = $verse['TEXT'];
		// Highlight Aionian!
		$prev = (empty($database['T_UNTRANSLATE'][$ref]['PREV']) ? "&lt;" : $database['T_UNTRANSLATE'][$ref]['PREV']);
		$next = (empty($database['T_UNTRANSLATE'][$ref]['NEXT']) ? "&gt;" : $database['T_UNTRANSLATE'][$ref]['NEXT']);
		$mark = $text;
		if (!($text = preg_replace('#\((questioned|[^()]+[gGhH]{1}[[:digit:]]+|note:[^()]+)\)#ui', "<span class='not' dir='ltr'>$prev".' $1 '."$next</span>", $text))) { AION_ECHO("ERROR! $error preg_replace(gXXX)"); }
		if (!($text = preg_replace('# h7585([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#h7585\' title=\'View definition\'>h7585</a>$1',$text))) { AION_ECHO("ERROR! $error preg_replace(h7585)"); }
		if (!($text = preg_replace('# g12([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g12\'   title=\'View definition\'>g12</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g12)"); }
		if (!($text = preg_replace('# g86([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g86\'   title=\'View definition\'>g86</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g86)"); }
		if (!($text = preg_replace('# g126([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g126\'  title=\'View definition\'>g126</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g126)"); }
		if (!($text = preg_replace('# g165([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g165\'  title=\'View definition\'>g165</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g165)"); }
		if (!($text = preg_replace('# g1653([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g1653\' title=\'View definition\'>g1653</a>$1',$text))) { AION_ECHO("ERROR! $error preg_replace(g1653)"); }
		if (!($text = preg_replace('# g166([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g166\'  title=\'View definition\'>g166</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g166)"); }
		if (!($text = preg_replace('# g1067([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g1067\' title=\'View definition\'>g1067</a>$1',$text))) { AION_ECHO("ERROR! $error preg_replace(g1067)"); }
		if (!($text = preg_replace('# g3041([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g3041\' title=\'View definition\'>g3041</a>$1',$text))) { AION_ECHO("ERROR! $error preg_replace(g3041)"); }
		if (!($text = preg_replace('# g4442([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g4442\' title=\'View definition\'>g4442</a>$1',$text))) { AION_ECHO("ERROR! $error preg_replace(g4442)"); }
		if (!($text = preg_replace('# g5020([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g5020\' title=\'View definition\'>g5020</a>$1',$text))) { AION_ECHO("ERROR! $error preg_replace(g5020)"); }
		if ($mark != $text) {	$text = "<span $cssavh>".$text."</span>"; }
		else {					$text = "<span $csstex>".$text."</span>"; }
				
		// CHAPTER
		if ($last_indx && ($book != $last_book || $chap != $last_chap)) {
			$book_index		= array_search($last_book, $args['database']['T_BOOKS']['CODE']);
			if ((int)$indx==40) {
				$PWA->bible_text .= <<< EOF
`
<h2>New Testament</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`,
EOF;
			$PWA->bible_numb++;
			}
			$book_english	= $args['database']['T_BOOKS']['ENGLISH'][$book_index];
			$book_foreign	= $args['database']['T_BOOKS'][$bible][$book_index];
			if(strpos($book_english,'"')!==FALSE || strpos($book_foreign,'"')!==FALSE) { AION_ECHO("ERROR! $error book name quote problem! $book_english $book_foreign"); }
			$chap_number	= $args['database']['T_NUMBERS'][$bible][$last_chaN];
			$book_format	= "<h2 $cssbok>$book_foreign $chap_number</h2>\n<div class='chapnav'>\n<a title='Table of Contents' href='#' onclick=\"ABDO(\${Ztoc});return false;\">TOC</a>
			\n";
			if ($last_chaN!=1) {
				$book_format .= ", <a href='$last_indx-$last_book-001.xhtml' class='ff' $G_ISO $G_RTL title='View book chapter index'>Chapters</a>\n";
			}
			else if (($book_chapters = $args['database']['T_BOOKS']['CHAPTERS'][array_search($last_book,$args['database']['T_BOOKS']['CODE'])])>1) {
				$book_format .= ", Chapter \n";
				for($x=1; $x<=$book_chapters; $x++) {
					$reffy = "{$verse['INDEX']}-{$verse['BOOK']}-".sprintf('%03d',$x);
					if (empty($database['T_BIBLE']["{$reffy}-001"]) &&
						empty($database['T_BIBLE']["{$reffy}-002"]) &&
						empty($database['T_BIBLE']["{$reffy}-003"])) {
						AION_ECHO("WARN! $error Skipping TOC $reffy");
						continue;
					}
					$book_format .= ($x==$last_chaN ? "" : " <a href='$last_indx-$last_book-".sprintf('%03d',$x).".xhtml' title='View book chapter'>$x</a>\n");
				}
			}
			$book_format .= "</div>\n";
			$PWA->bible_text .= "`$book_format<div class='chap'>\n$contents</div>`,\n";
			$PWA->bible_numb++;
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
	$book_format	= "<h2 $cssbok>$book_foreign $chap_number</h2>\n<div class='chapnav'>\n<a href='../index.xhtml' title='View Table of Contents'>TOC</a>\n";
	if ($last_chaN!=1) {
		$book_format .= ", <a href='$last_indx-$last_book-001.xhtml' class='ff' $G_ISO $G_RTL title='View book chapter index'>Chapters</a>\n";
	}
	else if (($book_chapters = $args['database']['T_BOOKS']['CHAPTERS'][array_search($last_book,$args['database']['T_BOOKS']['CODE'])])>1) {
		$book_format .= ", Chapter \n";
		for($x=1; $x<=$book_chapters; $x++) { $book_format .= ($x==$last_chaN ? "" : " <a href='$last_indx-$last_book-".sprintf('%03d',$x).".xhtml' title='View book chapter'>$x</a>\n"); }
	}
	$book_format .= "</div>\n";
	$PWA->bible_text .= "`$book_format<div class='chap'>$contents</div>`,\n";
	$PWA->bible_numb++;
	$contents = NULL;

	// DYNAMIC STUFF
	$PWA->font = AION_PWA_FONT();
	// WRITE AND VALIDATE
	if (file_put_contents($file="{$args['destiny']}/$bible---Aionian-Edition.htm", AION_PWA_CONTENTS($PWA)) === FALSE) { AION_ECHO("ERROR! $error file_put_contents($file)"); } // CREATE copyright
	// DONE
	AION_unset($database); unset($database); $database=NULL;
	AION_ECHO("PWA SUCCESS: $bible");
}



////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
// LINKS IN GLOSSARY
function glossarylinks($bible, $biblearray, $untranslate, $books, $cssbok, $strongs) {
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



////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
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



////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
// CSS
function AION_PWA_FONT() {
global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
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
		url('fonts/$f.woff')	format('woff'),
		url('fonts/$f.ttf')		format('truetype');
}
.ff { font-family: 'NotoSans', '$n', 'Arial', 'sans-serif', 'GentiumPlus'; }

EOF;
}

return $foreign_font;
}



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// CONTENTS
function AION_PWA_CONTENTS($PWA) {
return <<< EOF
<!-- Aionian Bible Progressive Web Application -->
<!-- Website: https://www.AionianBible.org -->
<!-- Publisher: https://NAINOIA-INC.signedon.net -->
<!-- Repository: https://resources.AionianBible.org -->
<!-- Repository: https://github.com/Nainoia-Inc -->
<!-- Copyright: {$PWA->bible_acopy} -->
<!-- Bible: Holy Bible Aionian Edition(R): {$PWA->bible_name} -->
<!-- Bible text copyright: {$PWA->bible_copy} -->



<!--------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Holy Bible Aionian Edition® ~ PWA ~ {$PWA->bible_name}</title>



<!--------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------->
<meta name="description" content="Holy Bible Aionian Edition® ~ The world's first Holy Bible untranslation! ~ Progressive Web App ~ {$PWA->bible_name}">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="generator" content="ABCMS™">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta property="og:url" content="https://www.aionianbible.org">
<meta property="og:type" content="website">
<meta property="og:title" content="Holy Bible Aionian Edition® ~ PWA ~ {$PWA->bible_name}">
<meta property="og:description" content="Holy Bible Aionian Edition® ~ The world's first Holy Bible untranslation! ~ Progressive Web App ~ {$PWA->bible_name}">
<meta property="og:image" content="images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-1.jpg">
<meta property="og:image" content="images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-2.jpg">
<meta property="og:image" content="images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-3.jpg">
<meta property="og:image" content="images/MEME-AionianBible-The-Worlds-First-Bible-Untranslation-4.jpg">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
<link rel="manifest" href="{$PWA->bible}.webmanifest">



<style>
/***************************************************************************************************/
/***************************************************************************************************/
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
		url('fonts/notosans-basic-regular.woff2')	format('woff2'),
		url('fonts/notosans-basic-regular.woff')	format('woff'),
		url('fonts/notosans-basic-regular.ttf')		format('truetype');
}
@font-face {
	font-family:
		'GentiumPlus';
	src:
		url('fonts/gentiumplus-r.woff2')			format('woff2'),
		url('fonts/gentiumplus-r.woff')				format('woff'),
		url('fonts/gentiumplus-r.ttf')				format('truetype');
}
{$PWA->font}
html,body	{ font-family: 'NotoSans', 'Arial', 'sans-serif', 'GentiumPlus'; }

/* BASE */
html { height: 100%; }
body { height: 100%; margin: 0; min-width: 360px; font-size: 100%; color: #191919; }
h1, h2, h3, h4 { margin: 0 0 10px 0; }
p, form { margin: 0 0 10px 0; }
img { max-width: 100%; height: auto; }
a { text-decoration: none; color: #663399; }
a:hover { color: #9966CC; }
.hidden { display: none; }
.center { text-align: center; }
.italic { font-style: italic; }

/* FIELDS */
.field-header2, .field-header1, .field-header { font-weight: bold; }
.field-field {}
.field-header1, .field-header-no-bold, .field-header { margin-top: 15px; }
.field-label { display: inline-block; font-style: italic;  vertical-align: top; }
.field-value { display: inline-block; margin-left: 15px; }
.field-links.decorated a { text-decoration: underline; }

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
#horz { margin: 0 auto; display: inline-block; padding: 5px 5px 100px 5px;  }
#home a { text-decoration: none; color: #191919; }
#home a:hover #butt { border: 1px solid #9966CC; border-radius: 7px;	background-color: #F0EBF5; }
#home a:hover #aion { color: #663399; }
#butt { margin: 0 auto; padding: 10px; text-align: center; }
#butt h2	{ margin: 10px 0 20px 0; }
#j316 { padding: 10px 0; font-style: italic; font-size: 110%; font-weight: bold; }
#aion { padding: 0 0 15px 0; font-style: italic; font-size: 130%; font-weight: bold; }
#moto { margin: 10px 0 0 0; color: #663399; }
.RegisteredTM { font-size: 75%; }

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
@media screen and (max-width: 511px) {
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



<!--------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------->
</head>
<body>
<br>
Loading Aionian Bible<br>
Progressive Web Application<br>
Javascript needed<br>
Cookies wanted<br>



<script>
/***************************************************************************************************/
/***************************************************************************************************/

// Globals
var AB_Accessible	= null;
var AB_Bookmark		= null;
var AB_Bookmark2	= null;
var AB_Page			= 0;

// Bible index
const Zcov = 0;
const Zcop = 1;
const Zpre = 2;
const Zaio = 3;
const Ztoc = 4;
const Zoti = 5;
const Zgen = 6;
const Zend = {$PWA->bible_numb} +  6;
const Zrea = {$PWA->bible_numb} +  7;
const Zpro = {$PWA->bible_numb} +  8;
const Zglo = {$PWA->bible_numb} +  9;
const Zpas = {$PWA->bible_numb} + 10;
const Zfut = {$PWA->bible_numb} + 11;
const Zdes = {$PWA->bible_numb} + 12;
const Zabe = {$PWA->bible_numb} + 13;
const Zisr = {$PWA->bible_numb} + 14;
const Zjes = {$PWA->bible_numb} + 15;
const Zpau = {$PWA->bible_numb} + 16;
const Zwor = {$PWA->bible_numb} + 17;

// Bible
const AB_Bible = [
/****** COVER ******/ `
<div id='home'>
<div id='vert'>
<div id='horz'>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">
<div id='butt'>
<h2>Welcome to the <i>Holy Bible Aionian Edition<span class='RegisteredTM'>®</span></i></h2>
<div id='logo'><img src='images/Holy-Bible-Aionian-Edition-PURPLE-HOME.png' alt='Aionian Bible' /></div>
<div id='j316'>For God so loved the world,<BR />that he gave his only begotten Son,<BR />that whoever believes in him<BR />should not perish, but have...</div>
<div id='aion'>aionian life!</div>
<div id='moto'>The world's first Holy Bible <span style="text-decoration: underline;">untranslation</span><BR />Three hundred seventy-six versions<BR />One hundred sixty-five languages<BR />Anonymous on TOR network<BR />100% free to copy &amp; print<BR />Updated {$PWA->modified}<BR /><BR />Also known as<BR />'The Purple Bible'
</div>
</div>
</a>
</div>
</div>
</div>
`,


/****** COPYRIGHT ******/ `
<h2>Copyright</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`,


/****** PREFACE ******/ `
<h2>Preface</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`,


/****** AIONIOS ******/ `
<h2>Aiōnios and Aïdios</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`,


/****** TOC ******/ `
<h2>Table of Contents</h2>
Hello world!<br>
<a title="Cover"						href="#" onclick="ABDO(\${Zcov});return false;">Cover</a><br>
<a title="Copyright"					href="#" onclick="ABDO(\${Zcop});return false;">Copyright</a><br>
<a title="Preface"						href="#" onclick="ABDO(\${Zpre});return false;">Preface</a><br>
<a title="Aiōnios and Aïdios"			href="#" onclick="ABDO(\${Zaio});return false;">Aiōnios and Aïdios</a><br>
<a title="Table of Contents"			href="#" onclick="ABDO(\${Ztoc});return false;">Table of Contents</a><br>
<a title="Old Testament"				href="#" onclick="ABDO(\${Zoti});return false;">Old Testament</a><br>
<a title="Genesis"						href="#" onclick="ABDO(\${Zgen});return false;">Genesis</a><br>
<a title="The End"						href="#" onclick="ABDO(\${Zend});return false;">The End</a><br>
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

/****** OT IMAGE ******/ `
<h2>Old Testament</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`,


/****** BIBLE ******/
{$PWA->bible_text}


/****** END IMAGE ******/ `
<h2>End Image</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`,


/****** READERS ******/ `
<h2>Reader's Guide</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`,


/****** PROJECT ******/ `
<h2>Project History</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`,


/****** GLOSSARY ******/ `
<h2>Aionian Glossary</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`,


/****** PAST ******/ `
<h2>History Past</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`,


/****** FUTURE ******/ `
<h2>History Future</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`,


/****** DESTINY ******/ `
<h2>Destiny</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`,


/****** ABRAHAM ******/ `
<h2>Abraham's Journneys</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`,


/****** ISRAEL ******/ `
<h2>Israel's Exodus</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`,


/****** JESUS ******/ `
<h2>Jesus' Journeys</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`,


/****** PAUL ******/ `
<h2>Paul's Missionary Journeys</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`,


/****** WORLD ******/ `
<h2>World Nations</h2>
Hello world!<br>
<a title="Table of Contents" href="#" onclick="ABDO(\${Ztoc});return false;">TOC</a>
`

];



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// load the page
// functions
function ABDO(goto) {
	if (typeof AB_Bible[goto] === 'undefined') {
		if (AB_Page == 0 && goto < 0) {		return; }
		else if (goto >= AB_Bible.length) { return; }
		else { alert("Invalid link");		return; }
	}
	AB_Page = goto;
	if (AB_Page == 0) { head = tail = ''; }
	else {
		head = `
<div id='page'>
<div id='sticky-body'>
<div id='head'>
<div id='head-hi'>
<div id='logo1'><a href='#' title='Aionian Bible homepage' onclick="ABDO(\${Zcov});return false;"><img src='images/Holy-Bible-Aionian-Edition-PURPLE-LOGO.png' alt='Aionian Bible' /></a></div>
<div id='logo2'><a href='#' title='Aionian Bible homepage' onclick="ABDO(\${Zcov});return false;"><img src='images/Holy-Bible-Aionian-Edition-PURPLE-AB.png' alt='Aionian Bible' /></a></div>
<div id='menu'>
<a href='#' title='Preface and mission' onclick="ABDO(\${Zpre});return false;">Preface</a><a href='#' title='Bookmarked Bible' onclick='return AionianBible_Bookmark();'>Read</a><a href='#' title='Font Size Accessibility' onclick='AionianBible_Accessible();' id='accessible'>+</a></div></div>
</div><div id='body' class=''>
`;
		tail = `
</div>
<div id='sticky-push'></div>
</div>
<div id='sticky-foot'> 	
<div id='tail'><a href='https://www.AionianBible.org' title='The world's first Holy Bible un-translation!' target='_blank'>AionianBible.org Online</a></div>
</div>
</div>
`;
	}
	document.getElementsByTagName("body")[0].innerHTML = head + AB_Bible[AB_Page] + tail;
	AB_Accessible = document.getElementById("body");
	if (null!==AB_Accessible) {
		AB_Accessible.className = AionianBible_readCookie("AionianBible.Accessible");
	}
}
ABDO(AB_Page);


// write cookie
function AionianBible_writeCookie(cname, cvalue) {
	var date = new Date();
	date.setTime(date.getTime() + (1000 * 24 * 60 * 60 * 1000));
	document.cookie = cname + "=" + cvalue + ";expires=" + date.toUTCString() + ";path=/";
}


// read cookie
function AionianBible_readCookie(name) {
	var nameEQ = name + "=";
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


// onload assign globals, write bookmark cookie
window.onload = function() {
	AB_Bookmark = window.location.pathname.replace(/^\/+|\/+$/g,"");
	if (null!==AB_Bookmark && 0===AB_Bookmark.indexOf("Bibles/",0)) {
		AionianBible_writeCookie("AionianBible.Bookmark", AB_Bookmark);
	}
	else {
		AB_Bookmark = AionianBible_readCookie("AionianBible.Bookmark");
	}
	AB_Bookmark2 = AionianBible_readCookie("AionianBible.Bookmark2");
}


// set and get
function AionianBible_Set() {
	AB_Bookmark2 = window.location.pathname.replace(/^\/+|\/+$/g,"");
	if (null!==AB_Bookmark2) {
		AionianBible_writeCookie("AionianBible.Bookmark2", AB_Bookmark2);
	}
	return false;
}
function AionianBible_Get() {
	if (null!==AB_Bookmark2) {
		window.location.assign("/"+AB_Bookmark2);
	}
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


// goto bookmark
function AionianBible_Bookmark(default_goto) {
	if (null===AB_Bookmark) {
		if (default_goto) {
			window.location.assign(default_goto);
		}
		else {
			return true;
		}
	}
	else {
		window.location.assign("/"+AB_Bookmark);
	}
	return false;
}


// goto mark with bookmark components
function AionianBible_Makemark(default_goto, plus_goto) {
	if (null===AB_Bookmark) {
		return true;
	}
	var search = AB_Bookmark.split("/",2);
	if (null===search || 2>search.length || 0>search[1].length) {
		return true;
	}
	var bible = search[1];
	var parallel = AB_Bookmark.match(/\/parallel-[a-zA-Z0-9-]+/);
	if (null===parallel) {
		var parallel = "";
	}
	if ("undefined"===typeof plus_goto) {
		var plus_goto = "";
	}
	window.location.assign(default_goto+"/"+bible+parallel+plus_goto);
	return false;
}
function ABMM(default_goto, plus_goto) { return AionianBible_Makemark(default_goto, plus_goto); }


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

</script>



<!--------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------->
</body>
</html>
EOF;
}