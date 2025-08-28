#!/usr/local/bin/php
<?php
///////////////////////////////////////////////////////////////////////////////////////////////////
/*
Holy Bible Aionian Edition® Progressive Web Application, service worker
Publisher: https://NAINOIA-INC.signedon.net
Website: https://www.AionianBible.org
Resources: https://resources.AionianBible.org
Repository: https://github.com/Nainoia-Inc
Copyright: Creative Commons Attribution 4.0 International 

The Aionian Bible project also serves all its translations as Progressive Web Apps.
Each Bible translation is contained in a single HTM file using javascript to paginate.
The PWA listing, manifests, service workers, and icons are served dynamically.
Dyanmic files could be pre-generated, but dynamic results in a simpler GitHub package.
.htaccess rules masquerade each PWA into its own folder allowing multiple-installs.

DOCS
	https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps
	https://pwa-workshop.js.org
	https://web.dev/progressive-web-apps/
	https://www.freecodecamp.org/news/build-a-pwa-from-scratch-with-html-css-and-javascript/
	https://felixgerschau.com/how-to-communicate-with-service-workers/
	Caching external domains too hard so dont do that.
	https://stackoverflow.com/questions/39432717/how-can-i-cache-external-urls-using-service-worker

TESTING
	https://www.validbot.com/tools/app-manifest-wizard.php
	https://www.seoreviewtools.com/pwa-testing-tool/ 

*/

///////////////////////////////////////////////////////////////////////////////////////////////////
// PWA COMPILER
AION_LOOP_PWA(	'/home/inmoti55/public_html/domain.aionianbible.org/www-stageresources',
				'/home/inmoti55/public_html/domain.aionianbible.org/www-stage/library/pwa' );
//AION_LOOP_DIFF('../www-stage/library/pwa', '../www-production-files/library/pwa', '../diff-www-stagepwa-with-pwa-BEFORE-DEPLOY');
AION_ECHO("DONE!");
return;


// LOOP
function AION_LOOP_PWA($source, $destiny) {
	system("cd {$destiny}; ln -s ../../images ./images; ln -s ../../fonts ./fonts");
	$database = array();
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATE.txt',	'T_UNTRANSLATE',	$database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKS.txt',		'T_BOOKS',			$database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/NUMBERS.txt',		'T_NUMBERS',		$database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/VERSIONS.txt',		'T_VERSIONS',		$database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/FORPRINT.txt',		'T_FORPRINT',		$database, 'BIBLE', FALSE );
	AION_LOOP( array(
		'function'		=> 'AION_LOOP_PWA_DOIT',
		'source'		=> $source,
		//'include'		=> "/Holy-Bible---.*(Korean).*---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---.*(Amo|Aionian-Bible|Traditional|Sencillo|Masoretic).*---Aionian-Edition\.noia$/",
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
	global $G_PWA, $G_LINKS, $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT;
	$G_PWA = new stdClass();
	static $modified = NULL; if ($modified==NULL) { $modified = date("n/j/Y"); }
	$G_PWA->modified = $modified;

	// BIBLE
	if (!preg_match("/\/Holy-Bible---(.*)---Aionian-Edition\.noia/", $args['filepath'], $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']); }
	$bible = $G_PWA->bible = "Holy-Bible---$matches[1]";
	$G_PWA->bible2 = "Holy-Bible---$matches[1]---Aionian-Edition";
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
	if ($G_VERSIONS['DOWNLOAD']=='N') { AION_ECHO("WARN! $error DOWNLOAD=N"); return; }
	$G_FORPRINT	= $args['database'][T_FORPRINT][$bible];
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
	$G_VERSIONS['SOURCEVERSION'] = (filemtime($base.$sour)===FALSE ? $G_VERSIONS['YEAR'] : date("n/j/Y", filemtime($base.$sour)));

	// BIBLE CSS
	$cssiso	= (empty($G_VERSIONS['LANGUAGECODEISO']) ? "" : "lang='".$G_VERSIONS['LANGUAGECODEISO']."'");
	$cssdir = (empty($G_VERSIONS['RTL']) ? "" : "dir='rtl'");
	$csshed = "class='ff' $cssiso $cssdir";
	$cssbok = "class='ff bok' $cssiso $cssdir";
	$cssrtl = "class='ff rtl' $cssiso $cssdir";
	$cssver = "class='ff ver' $cssiso $cssdir";
	$csstex = "class='ff tex' $cssiso $cssdir";
	$cssavh = "class='ff tex avh' $cssiso $cssdir";
	$cssnum = "class='ff num' $cssiso $cssdir";
	$csslan = "class='ff lan' $cssiso $cssdir";
	
	// PREPARE FIELDS
	$G_PWA->bible_lang = (empty($G_VERSIONS['LANGUAGE']) || $G_VERSIONS['LANGUAGE']=="English" ? "English" : ("{$G_VERSIONS['LANGUAGEENGLISH']}" . ($G_VERSIONS['LANGUAGE'] == $G_VERSIONS['LANGUAGEENGLISH'] ? "" : " / <span $csslan>{$G_VERSIONS['LANGUAGE']}</span>")));
	$G_PWA->bible_locs = (empty($G_VERSIONS['COUNTRY']) ? $G_PWA->bible_lang : $G_VERSIONS['COUNTRY']);
	$G_PWA->bible_title = ($G_VERSIONS['NAMEENGLISH'] == $G_VERSIONS['NAME'] ? $G_VERSIONS['NAME'] : "{$G_VERSIONS['NAMEENGLISH']}<br><span $csslan>{$G_VERSIONS['NAME']}</span>");
	
	// PREPARE Language Headings
	$G_FORPRINT['W_PREF']	= (empty($G_FORPRINT['W_PREF'])		? "Preface"					: "Preface / <span $csshed>".$G_FORPRINT['W_PREF']."</span>");
	$G_FORPRINT['W_OLD']	= (empty($G_FORPRINT['W_OLD'])		? "Old Testament"			: "Old Testament / <span $csshed>".$G_FORPRINT['W_OLD']."</span>");
	$G_FORPRINT['W_NEW']	= (empty($G_FORPRINT['W_NEW'])		? "New Testament"			: "New Testament / <span $csshed>".$G_FORPRINT['W_NEW']."</span>");
	$G_FORPRINT['W_TOC']	= (empty($G_FORPRINT['W_TOC'])		? "Table of Contents"		: "Table of Contents / <span $csshed>".$G_FORPRINT['W_TOC']."</span>");
	$G_FORPRINT['W_APDX']	= (empty($G_FORPRINT['W_APDX'])		? "Appendix"				: "Appendix / <span $csshed>".$G_FORPRINT['W_APDX']."</span>");
	$G_FORPRINT['W_READ']	= (empty($G_FORPRINT['W_READ'])		? "Reader's Guide"			: "Reader's Guide / <span $csshed>".$G_FORPRINT['W_READ']."</span>");
	$G_FORPRINT['W_GLOS']	= (empty($G_FORPRINT['W_GLOS'])		? "Aionian Glossary"		: "Aionian Glossary / <span $csshed>".$G_FORPRINT['W_GLOS']."</span>");
	$G_FORPRINT['W_MAP']	= (empty($G_FORPRINT['W_MAP'])		? "Maps"					: "Maps / <span $csshed>".$G_FORPRINT['W_MAP']."</span>");
	$G_FORPRINT['W_ILUS']	= (empty($G_FORPRINT['W_ILUS'])		? "Illustrations by Doré"	: "Illustrations by Doré / <span $csshed>".$G_FORPRINT['W_ILUS']."</span>");
	$G_FORPRINT['W_DESTINY']= (empty($G_FORPRINT['W_DESTINY'])	? "Destiny"					: "Destiny / <span $csshed>".$G_FORPRINT['W_DESTINY']."</span>");
	$G_FORPRINT['W_HIST']	= (empty($G_FORPRINT['W_HIST'])		? "History"					: "History / <span $csshed>".$G_FORPRINT['W_HIST']."</span>");
	
	// REMOVE XML
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

	$G_FORPRINT['W_LIFE'] = (empty($G_FORPRINT['W_LIFE']) ? "Life" : "<span $csstex>".$G_FORPRINT['W_LIFE']."</span>");
	$G_FORPRINT['JOH3_16'] = preg_replace("#`#ui", "\`", (!empty($G_FORPRINT['JOH3_16']) && empty($G_FORPRINT['W_LIFEX'])
		? "<div id='j316'><span $csstex>".$G_FORPRINT['JOH3_16']."</span></div><div id='aion'>Aionian ".$G_FORPRINT['W_LIFE']."!</div>"
		: (!empty($G_FORPRINT['JOH3_16'])
		? "<div id='j316'><span $csstex>".$G_FORPRINT['JOH3_16']."</span></div><div id='aion'>".$G_FORPRINT['W_LIFE']." Aionian!</div>"
		: "<div id='j316'>For God so loved the world that he gave his only begotten Son that whoever believes in him should not perish, but have...</div><div id='aion'>Aionian Life!</div>")), -1);
	$G_FORPRINT['GEN3_24'] = preg_replace("#`#ui", "\`", (!empty($G_FORPRINT['GEN3_24'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['GEN3_24']."<br><span class='ref'>".$front.$G_FORPRINT['GEN3_24_B'].$backot."</span></span></p>"
		: "<p class='cap'>“So he drove out the man; and he placed cherubim at the east of the garden of Eden, and a flaming sword which turned every way, to guard the way to the tree of life.”<br><span class='ref'>Genesis 3:24</span></p>"), -1);
	$G_FORPRINT['LUK23_34'] = preg_replace("#`#ui", "\`", (!empty($G_FORPRINT['LUK23_34'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['LUK23_34']."<br><span class='ref'>".$front.$G_FORPRINT['LUK23_34_B'].$back."</span></span></p>"
		: "<p class='cap'>“Jesus said, ‘Father, forgive them, for they don’t know what they are doing.’ Dividing his garments among them, they cast lots.”<br><span class='ref'>Luke 23:34</span></p>"), -1);
	$G_FORPRINT['REV21_2_3'] = preg_replace("#`#ui", "\`", (!empty($G_FORPRINT['REV21_2_3'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['REV21_2_3']."<br><span class='ref'>".$front.$G_FORPRINT['REV21_2_3_B'].$back."</span></span></p>"
		: "<p class='cap'>“I saw the holy city, New Jerusalem, coming down out of heaven from God, prepared like a bride adorned for her husband. I heard a loud voice out of heaven saying, ‘Behold, God’s dwelling is with people, and he will dwell with them, and they will be his people, and God himself will be with them as their God.’”<br><span class='ref'>Revelation 21:2-3</span></p>"), -1);
	$G_FORPRINT['HEB11_8'] = preg_replace("#`#ui", "\`", (!empty($G_FORPRINT['HEB11_8'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['HEB11_8']."<br><span class='ref'>".$front.$G_FORPRINT['HEB11_8_B'].$back."</span></span></p>"
		: "<p class='cap'>“By faith, Abraham, when he was called, obeyed to go out to the place which he was to receive for an inheritance. He went out, not knowing where he went”<br><span class='ref'>Hebrews 11:8</span></p>"), -1);
	$G_FORPRINT['EXO13_17'] = preg_replace("#`#ui", "\`", (!empty($G_FORPRINT['EXO13_17'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['EXO13_17']."<br><span class='ref'>".$front.$G_FORPRINT['EXO13_17_B'].$backot."</span></span></p>"
		: "<p class='cap'>“When Pharaoh had let the people go, God didn’t lead them by the way of the land of the Philistines, although that was near; for God said, ‘Lest perhaps the people change their minds when they see war, and they return to Egypt’”<br><span class='ref'>Exodus 13:17</span></p>"), -1);
	$G_FORPRINT['MAR10_45'] = preg_replace("#`#ui", "\`", (!empty($G_FORPRINT['MAR10_45'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['MAR10_45']."<br><span class='ref'>".$front.$G_FORPRINT['MAR10_45_B'].$back."</span></span></p>"
		: "<p class='cap'>“For the Son of Man also came not to be served, but to serve, and to give his life as a ransom for many”<br><span class='ref'>Mark 10:45</span></p>"), -1);
	$G_FORPRINT['ROM1_1'] = preg_replace("#`#ui", "\`", (!empty($G_FORPRINT['ROM1_1'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['ROM1_1']."<br><span class='ref'>".$front.$G_FORPRINT['ROM1_1_B'].$back."</span></span></p>"
		: "<p class='cap'>“Paul, a servant of Jesus Christ, called to be an apostle, set apart for the Good News of God”<br><span class='ref'>Romans 1:1</span></p>"), -1);
	$G_FORPRINT['MAT28_19'] = preg_replace("#`#ui", "\`", (!empty($G_FORPRINT['MAT28_19'])
		? "<p class='cap'><span $csstex>".$G_FORPRINT['MAT28_19']."<br><span class='ref'>".$front.$G_FORPRINT['MAT28_19_B'].$back."</span></span></p>"
		: "<p class='cap'>“Go and make disciples of all nations, baptizing them in the name of the Father and of the Son and of the Holy Spirit”<br><span class='ref'>Matthew 28:19</span></p>"), -1);

	// GET BIBLE	
	$database = array();
	AION_FILE_DATA_GET( $args['filepath'], 'T_BIBLE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );

	// CREATE Glossary Chapter Links
	$G_PWA->h7585	= AION_PWA_GLOLINKS($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "h7585");
	$G_PWA->g12		= AION_PWA_GLOLINKS($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g12");
	$G_PWA->g86		= AION_PWA_GLOLINKS($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g86");
	$G_PWA->g126	= AION_PWA_GLOLINKS($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g126");
	$G_PWA->g165	= AION_PWA_GLOLINKS($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g165");
	$G_PWA->g1653	= AION_PWA_GLOLINKS($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g163");
	$G_PWA->g166	= AION_PWA_GLOLINKS($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g166");
	$G_PWA->g1067	= AION_PWA_GLOLINKS($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g1067");
	$G_PWA->g3041	= AION_PWA_GLOLINKS($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g3041");
	$G_PWA->g5020	= AION_PWA_GLOLINKS($bible, $database['T_BIBLE'], $args['database']['T_UNTRANSLATE'], $args['database']['T_BOOKS'], $cssbok, "g5020");

	// CREATE Glossary Questioned Links
	$database['T_UNTRANSLATE'] = $args['database']['T_UNTRANSLATE'];
	$G_PWA->questioned = NULL;
	foreach($database['T_BIBLE'] as $ref => $verse) { // grab the questioned verses
		if (!preg_match('#\(questioned|note:[^()]+\)#ui', $verse['TEXT'])) { continue; }
		$database['T_UNTRANSLATE'][$ref] = $verse;
		$database['T_UNTRANSLATE'][$ref]['WORD'] = 'note';
		$database['T_UNTRANSLATE'][$ref]['STRONGS'] = '';
		if (!preg_match('#\(questioned\)#ui', $verse['TEXT'])) { continue; }		
		$ref_chap = $verse['INDEX'].'-'.$verse['BOOK'].'-'.$verse['CHAPTER'];
		$book_index		= array_search($verse['BOOK'], $args['database']['T_BOOKS']['CODE']);
		$book_foreign	= $args['database']['T_BOOKS'][$bible][$book_index];
		$chaN = (int)$verse['CHAPTER'];
		$reference = (int)$verse['CHAPTER'].":".(int)$verse['VERSE'];
		$title = $args['database']['T_BOOKS']['ENGLISH'][$book_index]." ".$reference;
		$reference = (empty($database['T_BIBLE'][$ref]) ? $reference : "<a title='$title' href='?{$book_index}-{$chaN}' onclick=\"ABDO('{$book_index}-{$chaN}'); return false;\">$reference</a>");	
		$G_PWA->questioned .= "<div><span $cssbok>$book_foreign</span> $reference</div>";
	}
	ksort($database['T_UNTRANSLATE']);

	// BUILD Bible Map array
	// Find the Aionian verses and chapter numbers
	// *** Note some logic below could be put in page builder loop below more efficiently, but need two loops anyway to build aionian verse array
	// Javascript object linking PWA page names to their page number in the page array
	$G_PWA->bible_map = <<<EOF
const AB_Map = {
'PWA'		:	0,
'TOC'		:	1,
'Copyright'	:	2,
'Preface'	:	3,
'Aionian'	:	4,


EOF;

	$G_PWA->bible_menu = NULL; // bible book names for the TOC
	$links = array(); // handy array of all book and chapter page numbers
	$aions = array(); // array of page numbers with aionian verses
	$last_indx = $last_book = $last_chap = NULL;
	$yes_ot = $yes_nt = FALSE;
	$pageindex = 5;
	foreach($database['T_BIBLE'] as $ref => $verse) {
		// init
		$indx = $verse['INDEX'];
		$book = $verse['BOOK'];
		$chap = $verse['CHAPTER'];
		$chaN = (int)$verse['CHAPTER'];
		// new book name found
		if ($book != $last_book) {
			$book_index		= array_search($book, $args['database']['T_BOOKS']['CODE']);
			$book_english	= $args['database']['T_BOOKS']['ENGLISH'][$book_index];
			$book_foreign	= $args['database']['T_BOOKS'][$bible][$book_index];
			if(strpos($book_english,'"')!==FALSE || strpos($book_foreign,'"')!==FALSE) { AION_ECHO("ERROR! $error book name quote problem! $book_english $book_foreign"); }
			// warning if beginning chapters missed
			for($x = 1; $x < (int)$chap; $x++) {
				AION_ECHO("WARN! $error Skipping TOC {$verse['INDEX']}-{$verse['BOOK']}-".sprintf('%03d',$x));
			}
			// Add OT intro to TOC 
			if (!$yes_ot && (int)$indx<40) {
				$yes_ot = TRUE;
				$G_PWA->bible_menu .= "<br><b><a title='Old Testament' href='?Old' onclick=\"ABDO('Old');return false;\">{$G_FORPRINT['W_OLD']}</a></b><br>";
				$G_PWA->bible_map .= "'Old':{$pageindex},"; // map
				$pageindex++;
			}
			// Add NT intro to TOC
			if (!$yes_nt && (int)$indx>39) {
				$yes_nt = TRUE;
				$G_PWA->bible_menu = trim($G_PWA->bible_menu," ,");
				if ($yes_ot) { $G_PWA->bible_menu .= "<br>"; }
				$G_PWA->bible_menu .= "<br><b><a title='New Testament' href='?New' onclick=\"ABDO('New');return false;\">{$G_FORPRINT['W_NEW']}</a></b><br>";
				$G_PWA->bible_map .= "'New':{$pageindex},"; // map
				$pageindex++;
			}
			// Add Book name to TOC
			$G_PWA->bible_menu .= "<a title='View Book' href='?{$book_index}' onclick=\"ABDO('{$book_index}');return false;\">$book_foreign</a>, ";
			$links[$book] = array($chaN => $pageindex);
			$G_PWA->bible_map .= "'{$book_index}':{$pageindex},"; // map
			$G_PWA->bible_map .= "'{$book_index}-{$chaN}':{$pageindex},"; // map
			$pageindex++;
		}
		// new chapter found
		else if ($chap != $last_chap) {
			for($x = 1 + (int)$last_chap; $x < (int)$chap; $x++) {
				AION_ECHO("WARN! $error Skipping TOC {$verse['INDEX']}-{$verse['BOOK']}-".sprintf('%03d',$x));
			}
			$links[$book][$chaN] = $pageindex;
			$G_PWA->bible_map .= "'{$book_index}-{$chaN}':{$pageindex},"; // map
			$pageindex++;
		}
		// aionian verse array
		if (false===array_search($pageindex-1, $aions) && preg_match('#\((questioned|[^()]+[gGhH]{1}[[:digit:]]+|note:[^()]+)\)#ui', $verse['TEXT'])) {
			$aions[] = $pageindex-1;
		}
		// next
		$last_indx = $indx;
		$last_book = $book;
		$last_chap = $chap;
	}
	// end of bible map
	$G_PWA->bible_map .= <<<EOF

'Appendix'	:	{$pageindex} +  0,
'Jerusalem'	:	{$pageindex} +  0,
'Readers'	:	{$pageindex} +  1,
'Project'	:	{$pageindex} +  2,
'Glossary'	:	{$pageindex} +  3,
'Past'		:	{$pageindex} +  4,
'Future'	:	{$pageindex} +  5,
'Destiny'	:	{$pageindex} +  6,
'Maps'		:	{$pageindex} +  7,
'Abraham'	:	{$pageindex} +  7,
'Israel'	:	{$pageindex} +  8,
'Jesus'		:	{$pageindex} +  9,
'Paul'		:	{$pageindex} +  10,
'World'		:	{$pageindex} +  11
};

EOF;
	$G_PWA->bible_menu = trim($G_PWA->bible_menu," ,");
	$G_LINKS = AION_PWA_LINKS($links); // links need to see if verse reference exists
	$aions_flip = array_flip($aions); // slick means to easily determine the previous and next aionian verse page number
	
	// CHAPTERS
	$last_indx = $last_book = $last_chap = $contents = NULL;
	$yes_ot = $yes_nt = FALSE;
	$gotticks = TRUE;
	foreach($database['T_BIBLE'] as $ref => $verse) {
		// INIT
		$indx = $verse['INDEX'];
		$book = $verse['BOOK'];
		$chap = $verse['CHAPTER'];
		$chaN = (int)$chap;
		$vers = $verse['VERSE'];
		$verN = (int)$vers;
		// warn if ticks replaced
		$text = preg_replace("#`#ui", "\`", $verse['TEXT'], -1, $ticks);
		if ($gotticks && $ticks) { $gotticks = FALSE; AION_ECHO("WARN! $error backticks escaped in text"); }
		
		// hyperlink aannotations, use slick aions_flip to determine next and previous page
		$pn = $G_PWA->bible_numb+5;
		$prev = (!isset($aions_flip[$pn]) || !isset($aions[$aions_flip[$pn]-1]) || !($pf=$aions[$aions_flip[$pn]-1]) ? "(" : "<a href='?{$pf}' onclick='ABDO({$pf});return false;' title='View previous annotation'>&lt;</a>");
		$next = (!isset($aions_flip[$pn]) || !isset($aions[$aions_flip[$pn]+1]) || !($pf=$aions[$aions_flip[$pn]+1]) ? ")" : "<a href='?{$pf}' onclick='ABDO({$pf});return false;' title='View next annotation'>&gt;</a>");
		$mark = $text;
		if (!($text = preg_replace('#\((questioned|[^()]+[gGhH]{1}[[:digit:]]+|note:[^()]+)\)#ui', "<span class='not' dir='ltr'>$prev".' $1 '."$next</span>",	$text))) { AION_ECHO("ERROR! $error preg_replace(gXXX)"); }
		if (!($text = preg_replace('# h7585([^0-9]{1})#ui',	' <a href="?Glossary#h7585" onclick="ABDO(\'Glossary\',\'h7585\');	return false;"	title=\'View definition\'>h7585</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(h7585)"); }
		if (!($text = preg_replace('# g12([^0-9]{1})#ui',	' <a href="?Glossary#g12" onclick="ABDO(\'Glossary\',\'g12\');	return false;"	title=\'View definition\'>g12</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g12)"); }
		if (!($text = preg_replace('# g86([^0-9]{1})#ui',	' <a href="?Glossary#g86" onclick="ABDO(\'Glossary\',\'g86\');	return false;"	title=\'View definition\'>g86</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g86)"); }
		if (!($text = preg_replace('# g126([^0-9]{1})#ui',	' <a href="?Glossary#g126" onclick="ABDO(\'Glossary\',\'g126\');	return false;"	title=\'View definition\'>g126</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g126)"); }
		if (!($text = preg_replace('# g165([^0-9]{1})#ui',	' <a href="?Glossary#g165" onclick="ABDO(\'Glossary\',\'g165\');	return false;"	title=\'View definition\'>g165</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g165)"); }
		if (!($text = preg_replace('# g1653([^0-9]{1})#ui',	' <a href="?Glossary#g1653" onclick="ABDO(\'Glossary\',\'g1653\');return false;"	title=\'View definition\'>g1653</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g1653)"); }
		if (!($text = preg_replace('# g166([^0-9]{1})#ui',	' <a href="?Glossary#g166" onclick="ABDO(\'Glossary\',\'g166\');	return false;"	title=\'View definition\'>g166</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g166)"); }
		if (!($text = preg_replace('# g1067([^0-9]{1})#ui',	' <a href="?Glossary#g1067" onclick="ABDO(\'Glossary\',\'g1067\');return false;"	title=\'View definition\'>g1067</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g1067)"); }
		if (!($text = preg_replace('# g3041([^0-9]{1})#ui',	' <a href="?Glossary#g3041" onclick="ABDO(\'Glossary\',\'g3041\');return false;"	title=\'View definition\'>g3041</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g3041)"); }
		if (!($text = preg_replace('# g4442([^0-9]{1})#ui',	' <a href="?Glossary#g4442" onclick="ABDO(\'Glossary\',\'g4442\');return false;"	title=\'View definition\'>g4442</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g4442)"); }
		if (!($text = preg_replace('# g5020([^0-9]{1})#ui',	' <a href="?Glossary#g5020" onclick="ABDO(\'Glossary\',\'g5020\');return false;"	title=\'View definition\'>g5020</a>$1',	$text))) { AION_ECHO("ERROR! $error preg_replace(g5020)"); }
		if ($mark != $text) {	$text = "<span $cssavh>".$text."</span>"; }
		else {					$text = "<span $csstex>".$text."</span>"; }
		// OT INTRO, before first chapter
		if (!$yes_ot && $book != $last_book && (int)$indx<40) {
			$yes_ot = TRUE;
			$G_PWA->bible_text .= <<< EOF
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
{$G_FORPRINT['W_OLD']}
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>
<div class="map"><img src="images/Gustave-Dore-Bible-Tour-Hebrew-OT-003-Adam-and-Eve-Are-Driven-out-of-Eden.jpg" alt="Adam and Eve are driven out of Eden"></div>
{$G_FORPRINT['GEN3_24']}
`,

EOF;
			$G_PWA->bible_numb++;
		}
		// CHAPTER
		if ($last_indx && ($book != $last_book || $chap != $last_chap)) {
			$book_index		= array_search($last_book, $args['database']['T_BOOKS']['CODE']);
			$book_english	= $args['database']['T_BOOKS']['ENGLISH'][$book_index];
			$book_foreign	= $args['database']['T_BOOKS'][$bible][$book_index];
			if(strpos($book_english,'"')!==FALSE || strpos($book_foreign,'"')!==FALSE) { AION_ECHO("ERROR! $error book name quote problem! $book_english $book_foreign"); }
			$book_form		= ($book_english == $book_foreign ? $book_english : "$book_english / <span $cssbok>$book_foreign</span>");
			$chap_number	= $args['database']['T_NUMBERS'][$bible][$last_chaN];
			$book_format	= NULL;
			if ($last_chaN==1 && count($links[$last_book])>1) {
				$book_format .= "<div class='chapnav'>Chapter";
				foreach($links[$last_book] as $c => $p) {
					$book_format .= ($c==1 ? "" : " <a title='View Chapter' href='?{$book_index}-{$c}' onclick=\"ABDO('{$book_index}-{$c}');return false;\">$c</a>\n");
				}
				$book_format .= "</div>\n";
			}
			$G_PWA->bible_text .= <<<EOF
`
<h2>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
<a title='View Book Chapters' href='?{$book_index}' onclick="ABDO('{$book_index}');return false;">{$book_form}</a> {$chap_number}
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>
{$book_format}
<div class='chap'>
{$contents}
</div>
<div id="word-menu-bottom">
<h2>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
<a title='View Book Chapters' href='?{$book_index}' onclick="ABDO('{$book_index}');return false;">{$book_form}</a> {$chap_number}
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>
</div>
`,

EOF;
			$G_PWA->bible_numb++;
			$contents = NULL;
		}
		// NT INTRO after last OT chapter
		if (!$yes_nt && $book != $last_book && (int)$indx>39) {
				$yes_nt = TRUE;
				$G_PWA->bible_text .= <<< EOF
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
{$G_FORPRINT['W_NEW']}
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>
<div class="map"><img src="images/Gustave-Dore-Bible-Tour-NT-Gospel-215-The-Crucifixion-of-Jesus-and-Two-Criminals.jpg" alt="The Crucifixion of Jesus and Two Criminals"></div>
{$G_FORPRINT['GEN3_24']}
`,

EOF;
			$G_PWA->bible_numb++;
		}
		// VERSE - build the chapter verse by verse
		$verF = $args['database']['T_NUMBERS'][$bible][$verN];
		$verF = ($verF == $verN ? "" : "<span $cssnum> $verF </span>");
		if ($cssdir) {	$contents .= "<table class='rtl-tab'><tr><td>$text</td><td class='rtl-ref'>$verF<span class='num'> $verN</span></td></tr></table>\n"; }
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
	$book_form = ($book_english == $book_foreign ? $book_english : "$book_english / <span $cssbok>$book_foreign</span>");
	$chap_number	= $args['database']['T_NUMBERS'][$bible][$last_chaN];
	$book_format	= NULL;
	if ($last_chaN==1 && count($links[$last_book])>1) {
		$book_format .= "<div class='chapnav'>Chapter";
		foreach($links[$last_book] as $c => $p) {
			$book_format .= ($c==1 ? "" : " <a title='View Chapter' href='?{$book_index}-{$c}' onclick=\"ABDO('{$book_index}-{$c}');return false;\">$c</a>\n");
		}
		$book_format .= "</div>\n";
	}
	$G_PWA->bible_text .= <<<EOF
`
<h2>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
<a title='View Book Chapters' href='?{$book_index}' onclick="ABDO('{$book_index}');return false;">{$book_form}</a> {$chap_number}
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>
{$book_format}
<div class='chap'>
{$contents}
</div>
<div id="word-menu-bottom">
<h2>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
<a title='View Book Chapters' href='?{$book_index}' onclick="ABDO('{$book_index}');return false;">{$book_form}</a> {$chap_number}
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>
</div>
`,

EOF;
	$G_PWA->bible_numb++;
	$contents = NULL;

	// DYNAMIC STUFF
	$G_PWA->fontname = $G_PWA->fontfiles = NULL;
	$G_PWA->font = AION_PWA_FONT($G_PWA->fontname, $G_PWA->fontfiles);
	// WRITE AND VALIDATE
	$file = "{$args['destiny']}/{$bible}---Aionian-Edition.htm";
	if (is_file($file)) { unlink($file); }
	if (file_put_contents($file, AION_PWA_CONTENTS()) === FALSE) { AION_ECHO("ERROR! $error file_put_contents($file)"); }

	// DONE
	AION_unset($database); unset($database); $database=NULL;
	AION_ECHO("PWA SUCCESS: $bible");
}





///////////////////////////////////////////////////////////////////////////////////////////////////
// LINKS IN GLOSSARY
function AION_PWA_GLOLINKS($bible, $biblearray, $untranslate, $books, $cssbok, $strongs) {
	$links = "<div>";
	$lastbook = NULL;
	foreach($untranslate as $ref => $verse) {
		if (($strongs=="g12" && $verse['STRONGS']!="g12") || !preg_match("#$strongs#ui", $verse['STRONGS'])) { continue; }
		$ref_chap = $verse['INDEX'].'-'.$verse['BOOK'].'-'.$verse['CHAPTER'];
		$book_index = array_search($verse['BOOK'], $books['CODE']);
		$book_foreign = (empty($books[$bible][$book_index]) || $books[$bible][$book_index]=='NULL'  ? $books['ENGLISH'][$book_index] : $books[$bible][$book_index]);
		$chaN = (int)$verse['CHAPTER'];
		$reference = (int)$verse['CHAPTER'].":".(int)$verse['VERSE'];
		$title = $books['ENGLISH'][$book_index]." ".$reference;
		$links .=	($lastbook==NULL ? "<span $cssbok>$book_foreign</span> " :
					($book_foreign != $lastbook ? ", <span $cssbok>$book_foreign</span> " : ", ")) .
					(empty($biblearray[$ref]) ? $reference : "<a title='$title' href='?{$book_index}-{$chaN}' onclick=\"ABDO('{$book_index}-{$chaN}'); return false;\">$reference</a>");
		$lastbook = $book_foreign;
	}
	return "$links</div>";
}





///////////////////////////////////////////////////////////////////////////////////////////////////
// LINKS TO GLOSSARY
function AION_PWA_LINKS($links) {
	$object = new stdClass();
	$object->X_GEN_1	= (!empty($links['GEN'][1])		? "<a title='View Reference' href='?Genesis'			onclick=\"ABDO('Genesis');			return false;\">Genesis</a>"				: "Genesis");
	$object->X_MAT_25	= (!empty($links['MAT'][25])	? "<a title='View Reference' href='?Matthew-25'			onclick=\"ABDO('Matthew-25');		return false;\">Matthew 25:41</a>"			: "Matthew 25:41");
	$object->X_MAT_28	= (!empty($links['MAT'][28])	? "<a title='View Reference' href='?Matthew-28'			onclick=\"ABDO('Matthew-28');		return false;\">Matthew 28:20</a>"			: "Matthew 28:20");
	$object->X_JOH_1	= (!empty($links['JOH'][1])		? "<a title='View Reference' href='?John'				onclick=\"ABDO('John');				return false;\">John</a>"					: "John");
	$object->X_JOH_3	= (!empty($links['JOH'][3])		? "<a title='View Reference' href='?John-3'				onclick=\"ABDO('John-3');			return false;\">John 3:16</a>"				: "John 3:16");
	$object->X_ROM_1	= (!empty($links['ROM'][1])		? "<a title='View Reference' href='?Romans-1'			onclick=\"ABDO('Romans-1');			return false;\">Romans 1:20</a>"			: "Romans 1:20");
	$object->X_ROM_11	= (!empty($links['ROM'][11])	? "<a title='View Reference' href='?Romans-11'			onclick=\"ABDO('Romans-11');		return false;\">Romans 11:32</a>"			: "Romans 11:32");
	$object->X_ROM_1116	= (!empty($links['ROM'][11])	? "<a title='View Reference' href='?Romans-11'			onclick=\"ABDO('Romans-11');		return false;\">Romans 11:16</a>"			: "Romans 11:16");
	$object->X_1CO_2	= (!empty($links['1CO'][2])		? "<a title='View Reference' href='?1-Corinthians-2'	onclick=\"ABDO('1-Corinthians-2');	return false;\">1 Corinthians 2:13-14</a>"	: "1 Corinthians 2:13-14");
	$object->X_2TI_2	= (!empty($links['2TI'][2])		? "<a title='View Reference' href='?2-Timothy-2'		onclick=\"ABDO('2-Timothy-2');		return false;\">2 Timothy 2:15</a>"			: "2 Timothy 2:15");
	$object->X_2PE_1	= (!empty($links['2PE'][1])		? "<a title='View Reference' href='?2-Peter-1'			onclick=\"ABDO('2-Peter-1');		return false;\">2 Peter 1:4-8</a>"			: "2 Peter 1:4-8");
	$object->X_2PE_2	= (!empty($links['2PE'][2])		? "<a title='View Reference' href='?2-Peter-2'			onclick=\"ABDO('2-Peter-2');		return false;\">2 Peter 2:4</a>"			: "2 Peter 2:4");
	$object->X_1JO_2	= (!empty($links['1JO'][2])		? "<a title='View Reference' href='?1-John-2'			onclick=\"ABDO('1-John-2');			return false;\">1 John 2:27</a>"			: "1 John 2:27");
	$object->X_JUD_1	= (!empty($links['JUD'][1])		? "<a title='View Reference' href='?Jude-1'				onclick=\"ABDO('Jude-1');			return false;\">Jude 6</a>"					: "Jude 6");
	$object->X_REV_20	= (!empty($links['REV'][20])	? "<a title='View Reference' href='?Revelation-20'		onclick=\"ABDO('Revelation-20');	return false;\">Revelation 20:13-14</a>"	: "Revelation 20:13-14");
	// Additional links on Lake of Fire page
	$object->X_PARADISE	= (!empty($links['LUK'][23])	? "<a title='View Reference' href='?Luke-23'			onclick=\"ABDO('Luke-23');			return false;\">Paradise</a>"				: "Paradise");
	$object->X_NEWHEAVEN= (!empty($links['REV'][21])	? "<a title='View Reference' href='?Revelation-21'		onclick=\"ABDO('Revelation-21');	return false;\">The New Heaven</a>"			: "The New Heaven");
	$object->X_NEWEARTH	= (!empty($links['REV'][21])	? "<a title='View Reference' href='?Revelation-21'		onclick=\"ABDO('Revelation-21');	return false;\">The New Earth</a>"			: "The New Earth");
	$object->X_SHEEP	= (!empty($links['MAT'][25])	? "<a title='View Reference' href='?Matthew-25'			onclick=\"ABDO('Matthew-25');		return false;\">Matthew 25:31-46</a>"		: "Matthew 25:31-46");
	$object->X_GREAT	= (!empty($links['REV'][20])	? "<a title='View Reference' href='?Revelation-20'		onclick=\"ABDO('Revelation-20');	return false;\">Revelation 20:11-15</a>"	: "Revelation 20:11-15");
	$object->X_HEB_2	= (!empty($links['HEB'][2])		? "<a title='View Reference' href='?Hebrews-2'			onclick=\"ABDO('Hebrews-2');		return false;\">Hebrews 2</a>"				: "Hebrews 2");
	$object->X_ALLALL	= (!empty($links['1JO'][2])		? "<a title='View Reference' href='?1-John-2'			onclick=\"ABDO('1-John-2');			return false;\">1 John 2:1-2</a>"			: "1 John 2:1-2");
	$object->X_LUK_16	= (!empty($links['LUK'][16])	? "<a title='View Reference' href='?Luke-16'			onclick=\"ABDO('Luke-16');			return false;\">Luke 16:19-31</a>"			: "Luke 16:19-31");
	$object->X_LUK_23	= (!empty($links['LUK'][23])	? "<a title='View Reference' href='?Luke-23'			onclick=\"ABDO('Luke-23');			return false;\">Luke 23:43</a>"				: "Luke 23:43");
	$object->X_MAT_16	= (!empty($links['MAT'][16])	? "<a title='View Reference' href='?Matthew-16'			onclick=\"ABDO('Matthew-16');		return false;\">Matthew 16:18</a>"			: "Matthew 16:18");
	$object->X_1CO_15	= (!empty($links['1CO'][15])	? "<a title='View Reference' href='?1-Corinthians-15'	onclick=\"ABDO('1-Corinthians-15');	return false;\">1 Corinthians 15:55</a>"	: "1 Corinthians 15:55");
	$object->X_PHI_2	= (!empty($links['PHI'][2])		? "<a title='View Reference' href='?Philippians-2'		onclick=\"ABDO('Philippians-2');	return false;\">Philippians 2:9-11</a>"		: "Philippians 2:9-11");
	$object->X_REV_1	= (!empty($links['REV'][1])		? "<a title='View Reference' href='?Revelation-1'		onclick=\"ABDO('Revelation-1');		return false;\">Revelation 1:18</a>"		: "Revelation 1:18");
	$object->X_REV_21	= (!empty($links['REV'][21])	? "<a title='View Reference' href='?Revelation-21'		onclick=\"ABDO('Revelation-21');	return false;\">Revelation 21:1-8</a>"		: "Revelation 21:1-8");
	$object->X_JOH_15	= (!empty($links['JOH'][15])	? "<a title='View Reference' href='?John-15'			onclick=\"ABDO('John-15');			return false;\">John 15:16</a>"				: "John 15:16");
	return $object;
}





///////////////////////////////////////////////////////////////////////////////////////////////////
// CSS
function AION_PWA_FONT(&$fontname, &$fontfiles) {
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
'font-ethiopic.css'			=> array('noto-ethiopic',				'noto-ethiopic-serif-regular',	'font-ethiopic',		'font-ethiopic'		),
'font-ethiopic-plus.css'	=> array('abyssinicaSIL-regular',		'abyssinicaSIL-regular',		'font-ethiopic-plus',	'font-ethiopic-plus'),
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
if (empty($font)) {				$fontname = $foreign_font = $fontfiles = NULL; }
else if (empty($fray[$font])) {	AION_ECHO("ERROR! AION_EPUBY_EPUB_CSS font not found: $font"); }
else {
$l = $fray[$font][0];
$f = $fray[$font][1];
$n = $fray[$font][2];
$c = $fray[$font][3]; // unused, all use same tag!
$fontname = $f;
$foreign_font = <<< EOF
@font-face {
	font-family:
		'$n';
	src:
		url('fonts/{$f}.woff')	format('woff'),
		url('fonts/{$f}.ttf')	format('truetype');
}
.ff { font-family: 'NotoSans', '$n', 'Arial', 'sans-serif', 'GentiumPlus'; }

EOF;

$fontfiles = <<<EOF
'fonts/{$f}.woff',
'fonts/{$f}.ttf',
EOF;
}

return $foreign_font;
}





///////////////////////////////////////////////////////////////////////////////////////////////////
// CONTENTS
function AION_PWA_CONTENTS() {
global $G_PWA, $G_LINKS, $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $AION_PWA_IMAGE_PAGED;	
return <<< EOF
<!-- Title: Holy Bible Aionian Edition® Progressive Web Application -->
<!-- SubTitle: {$G_VERSIONS['NAMEENGLISH']} -->
<!-- Short: {$G_VERSIONS['SHORT']} -->
<!-- Font: {$G_PWA->fontname} -->
<!-- Publisher: https://NAINOIA-INC.signedon.net -->
<!-- Formatted: ABCMS on {$G_PWA->modified} -->
<!-- Website: https://www.AionianBible.org -->
<!-- Resources: https://resources.AionianBible.org -->
<!-- Repository: https://github.com/Nainoia-Inc -->
<!-- Copyright: {$G_VERSIONS['ABCOPYRIGHT']} -->
<!-- Language: {$G_VERSIONS['LANGUAGEENGLISH']} -->
<!-- Source: {$G_VERSIONS['SOURCE']} -->
<!-- Source copyright: {$G_VERSIONS['COPYRIGHT']} -->
<!-- Source version: {$G_VERSIONS['SOURCEVERSION']} -->
<!-- Source text: {$G_VERSIONS['SOURCELINK']} -->

<!-- The Aionian Bible project also serves all its translations as Progressive Web Apps. -->
<!-- Each Bible translation is contained in a single HTM file using javascript to paginate. -->
<!-- The PWA listing, manifests, service workers, and icons are served dynamically. -->
<!-- Dynamic files could be pre-generated, but dynamic results in a simpler GitHub package. -->
<!-- .htaccess rules masquerade each PWA into its own folder allowing multiple-installs. -->




<!--////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Holy Bible Aionian Edition® ~ {$G_VERSIONS['NAMEENGLISH']} ~ {$G_VERSIONS['SHORT']}</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="application-name" content="Holy Bible Aionian Edition® ~ {$G_VERSIONS['NAMEENGLISH']} ~ The world's first Holy Bible untranslation! ~ Progressive Web Application PWA">
<meta name="description" content="Holy Bible Aionian Edition® ~ {$G_VERSIONS['NAMEENGLISH']} ~ The world's first Holy Bible untranslation! ~ Progressive Web Application PWA">
<meta name="mobile-web-app-capable" content="yes">
<meta name="generator" content="ABCMS™">
<meta name="version" content="{$G_PWA->modified}">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
<link rel="manifest" href="pwa.json">






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
#F8F8F8 super light gray
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
{$G_PWA->font}
html,body	{ font-family: 'NotoSans', 'Arial', 'sans-serif', 'GentiumPlus'; }

/* BASE */
html { height: 100%; }
body { height: 100%; margin: 0; min-width: 360px; font-size: 100%; color: #191919; background-color: #F8F8F8; }
h1, h2, h3, h4 { margin: 0 0 10px 0; }
p { margin: 0 0 10px 0; }
img { max-width: 100%; height: auto; }
a { text-decoration: none; color: #663399; }
a:hover { color: #9966CC; }
.center { text-align: center; }

/* THINGS */
.title { text-align: center; }
.title2 { font-size: 125%; font-weight: bold; }
.chapnav { margin-bottom: 7px; }
.chapnav a { margin-left: 2px; display: inline-block; }
.map { text-align: center; margin: auto; }
.map img { border: 1px solid #C5C5C5; }
.cap { text-align: center; font-style: italic; width: 80%; margin: 0 auto; display: block; }
.ref { font-style: normal; } 
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

/* HOME */
#home1 { margin: 0 auto; text-align: center; }
#home1 a:hover #home2 { border: 1px solid #9966CC; border-radius: 7px;	background-color: #F0EBF5; }
#home1 .black { color: #191919; }
#home1 a { display: inline-block; }
#home1 a:hover #aion { color: #663399; }
#home2 { padding: 0 10px; }
#j316 { padding: 10px 0; font-style: italic; font-size: 110%; font-weight: bold; width: 420px; margin: 0 auto; color: #191919; }
#aion { padding: 0 0 15px 0; font-style: italic; font-size: 130%; font-weight: bold; color: #191919; }
#moto { margin: 10px 0 0 0; color: #663399; }
.RegisteredTM { font-size: 75%; }
#upin.home { text-align: center; font-weight: bold; color: red; }

/* PAGE HEAD */
#page {	height: 100%; max-width: 1280px; margin: 0 auto; padding: 0 10px; background-color: #FFFFFF; }
#head { position: fixed; width: 100%; max-width: 1280px; min-width: 360px; background-color: #FFFFFF; }
#head-hi { max-height: 42px; margin-top: 10px; padding: 2px 15px; border: 1px solid #663399; border-radius: 7px; background-color: #663399; overflow: hidden; }
#logo { }
#logo1 { display: inline-block !important; float: left; }
#logo2 { display: none !important; }
#body.large { font-size: 150%; }
#body.larger { font-size: 200%; }
#menu { display: inline-block; float: right; white-space: nowrap; }
#menu a { color: #FFFFFF; margin: 0px 0px 0px 10px; display: inline-block; font-size: 175%; }
#menu a:hover { color: #E0D6EB; }
#menu a#accessible { font-weight: bold; font-size: 200%;  }

/* BODY */
#body {	max-width: 1024px; margin: 0 auto; padding: 80px 3% 40px 3%; }
#body h1, #body h2 { text-align: center; }
body.word-toc  #body { max-width: 1024px; margin: 0 auto; padding: 110px 3% 2% 3%; }
body.word-read #body { max-width: 1024px; margin: 0 auto; padding: 110px 3% 2% 3%; }

/*** WORD ***/
#word { }
#word .word-bible a { padding: 15px 5px; border: 1px solid #EDEDED; display: block; }
#word .word-bible.odd a { background-color: #EDEDED; }
#word .word-bible.aionian-bible a { background-color: #E0D6EB; }
#word .word-bible a:hover { color: #FFFFFF; background-color: #9966CC; border: 1px solid #9966CC; }
#word .word-bible.aionian-bible a:hover { color: #FFFFFF; background-color: #9966CC; border: 1px solid #9966CC; }

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
#word-menu-float a  { position: fixed; width: 32px; height: 40%; top: 30%; background-color: #D3D3D3; color: #FFFFFF; border-radius: 10px; text-align: center; display: table; }
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

/*** MAPS ***/
#maps { text-align: center; width: 100%; }
#maps .left { text-align: left; }
#maps img { text-align: center; margin: 10px auto; border: solid black 1px; }
#maps div { margin: 0 auto; }
#maps div.portrait { max-width: 360px; }
#maps div.timeline { max-width: 800px; }
#maps div.map a:hover img { border: 1px solid #9966CC; }
#maps div.caption { margin: 0 0 40px 0; }
#maps div.caption .verse { font-style: italic; }

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
	#tail { border: none; border-top: 1px solid #9966CC; border-radius: 0; }
	#sticky-foot { background-color: #663399; }
	#page {	padding: 0; }
}
@media screen and (max-width: 640px) {
	#j316 { width: 360px; }
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
	div.chapnav,
	#sticky-push,
	#sticky-foot { display: none !important; }
}
</style>





<!--////////////////////////////////////////////////////////////////////////////////////////////////////-->
</head>
<body>
<div id='page'>
<div id='sticky-body'>
<div id='head'>
<div id='head-hi'>
<div id='logo1'><a href='?PWA' title='Aionian Bible homepage' onclick="ABDO('PWA');return false;"><img src='images/Holy-Bible-Aionian-Edition-PURPLE-LOGO-PWA.png' alt='Aionian Bible'></a></div>
<div id='logo2'><a href='?PWA' title='Aionian Bible homepage' onclick="ABDO('PWA');return false;"><img src='images/Holy-Bible-Aionian-Edition-PURPLE-AB-PWA.png' alt='Aionian Bible'></a></div>
<div id='menu'>
<a href="?TOC" title="Table of Contents" onclick="ABDO('TOC');return false;">TOC</a>
<a href='?Bookmark' title='Go to Bookmark' onclick='AionianBible_Get();return false;'>Get</a> 
<a href='?Bookmark' title='Set Bookmark' onclick='AionianBible_Set();return false;'>Set</a>
<a href="?Prev" title="Previous page" class="nav left" onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
<a href="?Next" title="Next page" class="nav right" onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
<a href='#' title='Font Size Accessibility' onclick='AionianBible_Accessible();' id='accessible'>+</a></div></div>
</div>
<div id="word-menu-float" class="notranslate">
<a href="?Prev" title="Previous page" class="nav left" onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
<a href="?Next" title="Next page" class="nav right" onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</div>
<div id='body'>

<div id='upin' class='home'><span class='java'>( Javascript and cookies required )<br></span></div>
<div id='home1'>
<a title="Return to last page read or TOC" href="?Bookmark" onclick="ABDO('Bookmark'); return false;">
<div id='home2'>
<h2 class='title'>
{$G_PWA->bible_title}<br>
<span class='black'>Welcome to the <i>Holy&nbsp;Bible&nbsp;Aionian&nbsp;Edition<span class='RegisteredTM'>®</span></i></span>
</h2>
<div id="logo"><img src="images/Holy-Bible-Aionian-Edition-PURPLE-HOME.png" alt="Aionian Bible"></div>
{$G_FORPRINT['JOH3_16']}
<div id='moto'>
One of the world's first Holy Bible <u>untranslations</u><br>
One of three hundred seventy-six versions<br>
One of one hundred sixty-five languages<br>
Anonymous on TOR network<br>
100% free to copy &amp; print<br>
Updated {$G_PWA->modified}<br>
<br>
Also known as 'The Purple Bible'
</div>
</div>
</a>
</div>

</div>
<div id='sticky-push'></div>
</div>
<div id='sticky-foot'> 
<div id='tail'><a title="Table of Contents" href="?TOC" onclick="ABDO('TOC'); return false;">{$G_VERSIONS['NAMEENGLISH']}</a> ~ <a href='https://www.AionianBible.org/Read' title='AionianBible.org' target='_blank'>AionianBible.org for all Bibles</a></div>
</div>
</div>





<script>
///////////////////////////////////////////////////////////////////////////////////////////////////
// Globals to control javascript paging
var AB_Accessible	= null;
var AB_Bookmark		= 'TOC';
var AB_Bookmark2	= 'TOC';
var AB_Page			= 0;





///////////////////////////////////////////////////////////////////////////////////////////////////
// Bible pages object map page name to AB_Bible index
{$G_PWA->bible_map}





///////////////////////////////////////////////////////////////////////////////////////////////////
// Bible pages array of all Bible content by chapter
const AB_Bible = [





///////////////////////////////////////////////////////////////////////////////////////////////////
// Homepage populated dynamically from HTML #body on page load so homepage is only defined one place
``,





///////////////////////////////////////////////////////////////////////////////////////////////////
// TOC - Table of Contents
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
{$G_FORPRINT['W_TOC']}
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a><br>
<a title="Return to last page read or TOC" href="?Bookmark" onclick="ABDO('Bookmark'); return false;">{$G_PWA->bible_title}</a>
</h2>
<a title="AionianBible.org online"		href="https://www.AionianBible.org/Read" target="_blank">AionianBible.org for all Bibles</a><br>
<div id='upin'></div>
<a title="Copyright"					href="?Copyright"	onclick="ABDO('Copyright');	return false;">Copyright</a><br>
<a title="Preface"						href="?Preface"		onclick="ABDO('Preface');	return false;">{$G_FORPRINT['W_PREF']}</a><br>
<a title="Aiōnios and Aïdios"			href="?Aionian"		onclick="ABDO('Aionian');	return false;">Aiōnios and Aïdios</a>
<br>
{$G_PWA->bible_menu}<br>
<br>
<a title="Appendix"						href="?Appendix"	onclick="ABDO('Appendix');	return false;"><b>{$G_FORPRINT['W_APDX']}</b></a><br>
<a title="New Jerusalem"				href="?Jerusalem"	onclick="ABDO('Jerusalem');	return false;">New Jerusalem</a><br>
<a title="Reader's Guide"				href="?Readers"		onclick="ABDO('Readers');	return false;">{$G_FORPRINT['W_READ']}</a><br>
<a title="Project History"				href="?Project"		onclick="ABDO('Project');	return false;">Project {$G_FORPRINT['W_HIST']}</a><br>
<a title="Aionian Glossary"				href="?Glossary"	onclick="ABDO('Glossary');	return false;">{$G_FORPRINT['W_GLOS']}</a><br>
<a title="History Past"					href="?Past"		onclick="ABDO('Past');		return false;">History Past</a><br>
<a title="History Future"				href="?Future"		onclick="ABDO('Future');	return false;">History Future</a><br>
<a title="Destiny"						href="?Destiny"		onclick="ABDO('Destiny');	return false;">{$G_FORPRINT['W_DESTINY']}</a><br>
<br>
<a title="Maps"							href="?Maps"		onclick="ABDO('Maps');		return false;"><b>{$G_FORPRINT['W_MAP']}</b></a><br>
<a title="Abraham's Journeys"			href="?Abraham"		onclick="ABDO('Abraham');	return false;">Abraham's Journeys</a><br>
<a title="Israel's Exodus"				href="?Israel"		onclick="ABDO('Israel');	return false;">Israel's Exodus</a><br>
<a title="Jesus' Journeys"				href="?Jesus"		onclick="ABDO('Jesus');		return false;">Jesus' Journeys</a><br>
<a title="Paul's Missionary Journeys"	href="?Paul"		onclick="ABDO('Paul');		return false;">Paul's Missionary Journeys</a><br>
<a title="World Nations"				href="?World"		onclick="ABDO('World');		return false;">World Nations</a><br>
<br>
<a href='https://resources.aionianbible.org/Gustave-Dore-La-Grande-Bible-de-Tours/' target='_blank' title='La Grande Bible de Tours by Gustave Doré'>{$G_FORPRINT['W_ILUS']}</a>.<br>
Swipe right and left to page.
`,





///////////////////////////////////////////////////////////////////////////////////////////////////
// COPYRIGHT
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
Copyright
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a><br>
<a title="Return to last page read or TOC" href="?Bookmark" onclick="ABDO('Bookmark'); return false;">{$G_PWA->bible_title}</a>
</h2>
Publisher: Nainoia Inc<br>
Copyright: <a href='https://creativecommons.org/licenses/by/4.0/' target='_blank'>Creative Commons Attribution 4.0 International, 2018-2024</a><br>
Language: {$G_PWA->bible_lang}<br>
Locations: {$G_PWA->bible_locs}<br>
Formatted: ABCMS <a href='https://en.wikipedia.org/wiki/Progressive_web_app' target='_blank' title='Web pages designed for off-line viewing'>Progressive Web Application</a> on {$G_PWA->modified}<br>
Formats:
<a href='https://www.AionianBible.org/Bibles/{$G_PWA->bible_basic}' target='_blank' title='Read online'>Online</a>,
<a href='https://www.AionianBible.org/TOR/Bibles/{$G_PWA->bible_basic}' target='_blank' title='Read TOR anonymously'>TOR Anonymously</a>,
<a href='https://www.AionianBible.org/Buy' target='_blank' title='Hardcopy print at Amazon and Lulu'>print</a>,
<a href='https://resources.AionianBible.org/Holy-Bible---{$G_PWA->bible_basic}---Aionian-Edition.epub' target='_blank' title='Download this ePub'>ePub</a>, 
<a href='https://resources.AionianBible.org/Holy-Bible---{$G_PWA->bible_basic}---Aionian-Edition.pdf' target='_blank' title='Download PDF'>PDF</a>, 
<a href='https://resources.AionianBible.org/Holy-Bible---{$G_PWA->bible_basic}---Aionian-Edition---STUDY.pdf' target='_blank' title='Download Study PDF'>Study PDF</a>, 
<a href='https://resources.AionianBible.org/Holy-Bible---{$G_PWA->bible_basic}---Aionian-Edition.noia' target='_blank' title='Download Data File'>Data File</a>, and
<a href='https://resources.AionianBible.org' target='_blank' title='Download Everything'>Everything</a><br>
<br>
Source: {$G_VERSIONS['SOURCE']}<br>
Source copyright: {$G_VERSIONS['COPYRIGHT']}<br>
Source version: {$G_VERSIONS['SOURCEVERSION']}<br>
Source text: <a href='{$G_VERSIONS['SOURCELINK']}' target='_blank' title='Download Source File'>{$G_VERSIONS['SOURCELINK']}</a><br>
<br>
We pray for a modern public domain translation in every language.<br>
Report concerns to <a href='https://nainoia-inc.signedon.net/' target='_blank' title='Publisher of the Holy Bible Aionian Edition'>Nainoia Inc</a>. Volunteer help appreciated!<br>
All profits are given to <a href='https://CoolCup.org' target='_blank' title='Cool Cup of Water Project'>CoolCup.org</a><br>
<br>
Celebrate Jesus Christ’s victory of grace!<br>
`,





///////////////////////////////////////////////////////////////////////////////////////////////////
// PREFACE
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
{$G_FORPRINT['W_PREF']}
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>

<p>This a Progressive Web App (PWA) format of one <i class='notranslate'>Holy Bible Aionian Edition®</i>. PWAs are special webpages designed to install an App icon and be available offline on a smart device if an Internet connection is not available. Visit <a href='https://www.AionianBible.org/Read' target='_blank' title='Select from all AionianBible.org translations'>AionianBible.org</a> for all Bibles.</p>

<p>The  <i class='notranslate'>Holy Bible Aionian Edition®</i>  is the world’s first Bible <i>un-translation</i>!  What is an  <i>un-translation</i>?  Bibles are translated into each of our languages from the original Hebrew, Aramaic, and Koine Greek.  Occasionally, the best word translation cannot be found and these words are transliterated letter by letter.  Four well known transliterations are  <i>Christ</i>,  <i>baptism</i>,  <i>angel</i>, and  <i>apostle</i>.  The meaning is then preserved more accurately through context and a dictionary.  The  <span class='notranslate'>Aionian</span>  Bible un-translates and instead transliterates eleven additional <a href="?Glossary" title="Aionian glossary" onclick="ABDO('Glossary');return false;"><span class='notranslate'>Aionian</span> Glossary</a> words to help us better understand God’s love for individuals and all mankind, and the nature of afterlife destinies.</p>

<p>The first three words are  <a href="?Glossary#g165" title="Aionian glossary g165" onclick="ABDO('Glossary','g165');return false;"><i class='notranslate'>aiōn</i></a>,  <a href="?Glossary#g166" title="Aionian glossary g166" onclick="ABDO('Glossary','g166');return false;"><i class='notranslate'>aiōnios</i></a>, and  <a href="?Glossary#g126" title="Aionian glossary g126" onclick="ABDO('Glossary','g126');return false;"><i class='notranslate'>aïdios</i></a>,  typically translated as  <i>eternal</i>  and also  <i>world</i>  or  <i>eon</i>. The  <span class='notranslate'>Aionian</span>  Bible is named after an alternative spelling of  <i class='notranslate'>aiōnios</i>. Consider that researchers question if  <i class='notranslate'>aiōn</i>  and  <i class='notranslate'>aiōnios</i>  actually mean <i>eternal</i>. Translating  <i class='notranslate'>aiōn</i>  as <i>eternal</i> in  {$G_LINKS->X_MAT_28}  makes no sense, as all agree. The Greek word for eternal is  <i class='notranslate'>aïdios</i>, used in  {$G_LINKS->X_ROM_1}  about God and in  {$G_LINKS->X_JUD_1}  about demon imprisonment. Yet what about  <i class='notranslate'>aiōnios</i>  in  {$G_LINKS->X_JOH_3}? Certainly we do not question whether salvation is eternal! However,  <i class='notranslate'>aiōnios</i>  means something much more wonderful than infinite time! Ancient Greeks used  <i class='notranslate'>aiōn</i>  to mean eon or age. They also used the adjective  <i class='notranslate'>aiōnios</i>  to mean entirety, such as  <i>complete</i>  or even <i>consummate</i>, but never infinite time. Read <a href="?Aionian" title="Aiōn and Aiōnios" onclick="ABDO('Aionian');return false;">Dr. Heleen Keizer and Ramelli and Konstan</a> for proofs. So  <i class='notranslate'>aiōnios</i>  is the perfect description of God's Word which has  <i>everything</i>  we need for life and godliness! And the  <i class='notranslate'>aiōnios</i>  life promised in  {$G_LINKS->X_JOH_3}  is not simply a ticket to eternal life in the future, but the invitation through faith to the  <i>consummate</i>  life beginning now!  <i class='notranslate'>Aiōnios</i>  life with Christ is <a href='https://www.AionianBible.org/Buy#Better' target='_blank'><i>Better than Forever</i></a>.</p>

<p>The next seven words are  <a href="?Glossary#h7585" title="Aionian glossary h7585" onclick="ABDO('Glossary','h7585');return false;"><i class='notranslate'>Sheol</i></a>,  <a href="?Glossary#g86" title="Aionian glossary g86" onclick="ABDO('Glossary','g86');return false;"><i class='notranslate'>Hadēs</i></a>,  <a href="?Glossary#g1067" title="Aionian glossary g1067" onclick="ABDO('Glossary','g1067');return false;"><i class='notranslate'>Geenna</i></a>,  <a href="?Glossary#g5020" title="Aionian glossary g5020" onclick="ABDO('Glossary','g5020');return false;"><i class='notranslate'>Tartaroō</i></a>,  <a href="?Glossary#g12" title="Aionian glossary g12" onclick="ABDO('Glossary','g12');return false;"><i class='notranslate'>Abyssos</i></a>, and  <a href="?Glossary#g3041" title="Aionian glossary g3041 g4442" onclick="ABDO('Glossary','g3041');return false;"><i class='notranslate'>Limnē Pyr</i></a>. These words are often translated as  <i>Hell</i>, the place of eternal punishment. However,  <i>Hell</i>  is ill-defined when compared with the Hebrew and Greek.  For example,  <i class='notranslate'>Sheol</i>  is the abode of deceased believers and unbelievers and should never be translated as  <i>Hell</i>.  <i class='notranslate'>Hadēs</i>  is a temporary place of punishment,  {$G_LINKS->X_REV_20}.  <i class='notranslate'>Geenna</i>  is the Valley of Hinnom, Jerusalem's refuse dump, a temporal judgment for sin.  <i class='notranslate'>Tartaroō</i>  is a prison for demons, mentioned once in  {$G_LINKS->X_2PE_2}.  <i class='notranslate'>Abyssos</i>  is a temporary prison for the Beast and Satan. Translators are also inconsistent because  <i>Hell</i>  is used by the  <a href='https://www.AionianBible.org/Bibles/English---King-James-Version' target='_blank' title='King James Version'>King James Version</a>  54 times, the  <a href='https://www.thenivbible.com/' target='_blank' title='New International Version Bible'>New International Version</a>  14 times, and the  <a href='https://www.AionianBible.org/Bibles/English---World-English-Bible' target='_blank' title='World English Bible'>World English Bible</a>  zero times.  Finally,  <i class='notranslate'>Limnē Pyr</i>  is the Lake of Fire, yet  {$G_LINKS->X_MAT_25}  explains that these fires are  <a href="?Destiny" title="Lake of Fire prepared for the Devil and his angels" onclick="ABDO('Destiny');return false;">prepared for the Devil and his angels</a>. So there is reason to review our conclusions about the destinies of redeemed mankind and fallen angels.</p>

<p>The eleventh word,  <a href="?Glossary#g1653" title="Aionian glossary g1653" onclick="ABDO('Glossary','g1653');return false;"><i class='notranslate'>eleēsē</i></a>, reveals the grand conclusion of grace in  {$G_LINKS->X_ROM_11}. Please understand these eleven words.  The original translation is unaltered and a highlighted note is added to 64 Old Testament and 200 New Testament verses.  Also to help parallel study and <a href='https://www.AionianBible.org/Strongs' target='_blank' title='Strongs Enhanced Concordance and Glossary'>Strong's Enhanced Concordance</a> use, apocryphal text is removed and most variant verse numbering is mapped to the English standard.  The  <span class='notranslate'>Aionian</span>  Bible republishes public domain and Creative Common Bible texts.  We thank our sources at  <a href='https://ebible.org' target='_blank' title='eBible.org, a DBA of Wycliffe, Inc, founded by Michael Paul Johnson'>eBible.org</a>, <a href='https://crosswire.org' target='_blank' title='The Crosswire Bible Society'>Crosswire.org</a>,  <a href='https://unbound.biola.edu' target='_blank' title='The Biola University Unbound Bible Project'>unbound.Biola.edu</a>,  <a href='https://Bible4u.net' target='_blank' title='Bible4U Uncensored bible'>Bible4u.net</a>, and  <a href='https://NHEB.net' target='_blank' title='New Heart English Bible'>NHEB.net</a>.  The <span class='notranslate'>Aionian</span>  Bible is copyrighted with the <a href='https://creativecommons.org/licenses/by/4.0' target='_blank' title='Copyright license'>Creative Commons Attribution 4.0 International</a> license, allowing 100% freedom to copy and print, if respecting source text copyrights.  Review the project  <a href="?Project" title="Project History" onclick="ABDO('Project');return false;">History</a>, <a href="?Readers" title="Readers guide for the Aionian Bible" onclick="ABDO('Readers');return false;">Reader's Guide</a>, and <a href="?Maps" title="Maps, Timelines, and Illustations" onclick="ABDO('Maps');return false;">Maps</a>. Read  <a href='https://www.AionianBible.org/Read' target='_blank' title='Read and Study Bible'>online</a>  with the  <a href='https://www.AionianBible.org/Google-Play' target='_blank' target='_blank' title='Aionian Bible free online at Google Play'><span class='notranslate'>Android</span></a>  and <a href='https://www.AionianBible.org/Apple-iOS-App' target='_blank' title='Apple iOS App'><span class='notranslate'>Apple iOS App</span></a>, also the <a href='https://www.AionianBible.org/TOR' target='_blank' title='TOR Network'>TOR Network</a>, <a href='https://www.AionianBible.org/AB-CUSTOM-VERSES.txt' target='_blank'>request custom formatted verses</a>, and buy Bibles at <a href='https://www.AionianBible.org/Buy' target='_blank' title='Holy Bible Aionian Edition at Amazon.com and Lulu.com'>Amazon.com and Lulu.com</a>.  Follow at <a href='https://www.AionianBible.org/Facebook' target='_blank' title='Visit the Aionian Bible on Facebook'>Facebook/AionianBible</a>, help <a href='https://www.AionianBible.org/Promote' target='_blank' title='Promote, Sponsor, Advertise, Market'>Promote</a> and <a href='https://www.AionianBible.org/Third-Party-Publisher-Resources' target='_blank' title='Third Party Publisher Resources'>Publish</a>, review the <a href='https://www.AionianBible.org/Privacy' target='_blank' title='Privacy Policy'>Privacy Policy</a>, and contact the  <a href='https://www.AionianBible.org/Publisher' target='_blank' title='Contact Nainoia, Inc'>Publisher</a>.  The <a href='https://www.AionianBible.org/Bibles/English---Aionian-Bible' target='_blank' title='Holy Bible Aionian Edition: Aionian Bible'><span class='notranslate'>Aionian</span>  Bible</a> is the recommended English translation.  All profits are given to <a href='https://CoolCup.org' target='_blank' title='Cool Cup of Water Project'>CoolCup.org</a>.</p>

<p>Why purple? King Jesus’ Word is royal and purple is the color of royalty!</p>
`,





///////////////////////////////////////////////////////////////////////////////////////////////////
// AIONIOS
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
Aiōnios and Aïdios
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>

<p>Dr. Heleen Keizer wrote <b><i>Life Time Entirety</i></b> to explain the meaning of the Greek word aiōn. She begins, "<i>The Greek word aiōn has a wide ranging meaning as well as a wide ranging history: it is most commonly translated as ‘eternity’ but has as its first meaning ‘life’ or ‘lifetime’; it has its place in Greek literature and philosophy, but also in the Greek Bible, where it represents the Hebrew word ‘olâm.</i>" Her 315 page PhD dissertation shows that the Greek word aiōn originally denotes life time, duration, or complete life, but not eternal. You can read her <a href='https://www.aionianbible.org/Life-Time-Entirety-Keizer' target='_blank' title='Visit Dr. Keizers dissertation online'>dissertation online</a> or an <a href='https://www.aionianbible.org/Life-Time-Entirety-Keizer-Abstract' target='_blank' title='View an abstract of Dr. Keizers dissertation'>abstract of her conclusions here</a>.</p>

<p>Ilaria Ramelli and David Konstan wrote <b><i>Terms for Eternity: Aionios and Aidios in Classical and Christian Texts</i></b>, <a href='https://www.aionianbible.org/Terms-for-Eternity-Ramelli-Konstan' target='_blank' title='Purchase Ramelli and Konstan at Amazon.com'>available at Amazon</a>. This highly technical volume quotes hundreds of sources from classical literature, the Septuagint, early church fathers, and church fathers after Origen to determine the meaning and usage of <i>Aiōnios</i> and <i>Aïdios</i>.  They conclude that <i>Aïdios</i> nearly always means eternal in the absolute sense.  <i>Aïdios</i> is used twice in the Bible: Romans 1:20 concerning God and Jude 6 concerning the bonds on fallen angels.  <i>Aiōnios</i>, however, has a range of meanings including life, age, generation, and eon.  They argue that <i>Aiōnios</i> can also mean eternal, but only when God is the subject.  Ramelli and Konstan concur with Keizer and conclude saying, "<i>Needless to say, the ethical implications of this question are profound.</i>"</p>

<p>Every quest for the truth must have the wisdom to eliminate what we prefer to be true and also the courage to eliminate what we fear to be true in order to discover what Christ says is actually true.</p>
`,





///////////////////////////////////////////////////////////////////////////////////////////////////
// BIBLE
{$G_PWA->bible_text}





///////////////////////////////////////////////////////////////////////////////////////////////////
// END IMAGE
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
New Jerusalem
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>

<div class="map"><img src="images/Gustave-Dore-Bible-Tour-NT-Gospel-241-The-New-Jerusalem.jpg" alt="New Jerusalem"></div>
{$G_FORPRINT['REV21_2_3']}
`,





///////////////////////////////////////////////////////////////////////////////////////////////////
// READERS
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
{$G_FORPRINT['W_READ']}
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>

<p>The Aionian Bible republishes public domain and Creative Common Bible texts that are 100% free to copy and print. The original translation is unaltered and notes are added to help your study. The notes show the location of eleven special Greek and Hebrew <a href="?Glossary" title="Aionian glossary" onclick="ABDO('Glossary');return false;"><span class='notranslate'>Aionian</span> Glossary</a> words to help us better understand God’s love for individuals and for all mankind, and the nature of afterlife destinies.</p>

<p>Who has the authority to interpret the Bible and examine the underlying Hebrew and Greek words? That is a good question! We read in {$G_LINKS->X_1JO_2}, <i>"As for you, the anointing which you received from him remains in you, and you do not need for anyone to teach you. But as his anointing teaches you concerning all things, and is true, and is no lie, and even as it taught you, you remain in him."</i> Every Christian is qualified to interpret the Bible! Now that does not mean we will all agree. Each of us is still growing in our understanding of the truth. However, it does mean that there is no infallible human or tradition to answer all our questions. Instead the Holy Spirit helps each of us to know the truth and grow closer to God and each other.</p>

<p>The Bible is a library with 66 books in the Protestant Canon. The best way to learn God’s word is to read entire books. Read the book of {$G_LINKS->X_GEN_1}. Read the book of {$G_LINKS->X_JOH_1}. Read the entire Bible library. Topical studies and cross-referencing can be good. However, the safest way to understand context and meaning is to read whole Bible books. Chapter and verse numbers were added for convenience in the 16th century, but unfortunately they can cause the Bible to seem like an encyclopedia. The Aionian Bible is formatted with simple verse numbering, minimal notes, and no cross-referencing in order to encourage the reading of Bible books.</p>

<p>Bible reading must also begin with prayer. Any Christian is qualified to interpret the Bible with God’s help. However, this freedom is also a responsibility because without the Holy Spirit we cannot interpret accurately. We read in {$G_LINKS->X_1CO_2}, <i>"And we speak of these things, not with words taught by human wisdom, but with those taught by the Spirit, comparing spiritual things with spiritual things. Now the natural person does not receive the things of the Spirit of God, for they are foolishness to him, and he cannot understand them, because they are spiritually discerned."</i> So we cannot understand in our natural self, but we can with God’s help through prayer.</p>

<p>The Holy Spirit is the best writer and he uses literary devices such as introductions, conclusions, paragraphs, and metaphors. He also writes various genres including historical narrative, prose, and poetry. So Bible study must spiritually discern and understand literature. Pray, read, observe, interpret, and apply. Finally, <i>"Do your best to present yourself approved by God, a worker who does not need to be ashamed, properly handling the word of truth."</i> {$G_LINKS->X_2TI_2}. <i>"God has granted to us his precious and exceedingly great promises; that through these you may become partakers of the divine nature, having escaped from the corruption that is in the world by lust. Yes, and for this very cause adding on your part all diligence, in your faith supply moral excellence; and in moral excellence, knowledge; and in knowledge, self-control; and in self-control patience; and in patience godliness; and in godliness brotherly affection; and in brotherly affection, love. For if these things are yours and abound, they make you to be not idle nor unfruitful to the knowledge of our Lord Jesus Christ.</i> {$G_LINKS->X_2PE_1}.</p>

<p><a href="?Maps" title="Middle Eastern and Mediterranean Bible maps" onclick="ABDO('Maps');return false;">Middle Eastern and Mediterranean maps</a> and 

<a href="?Past" title="Bible timelines and Church history charts" onclick="ABDO('Past');return false;">Bible timelines and Church history charts</a> are also available to help your study.</p>
`,





///////////////////////////////////////////////////////////////////////////////////////////////////
// HISTORY
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
Project History
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>

<p>
The <span class='notranslate'>Aionian</span>  Bible republishes public domain and Creative Common Bible texts that are 100% free to copy and print.
All versions are available online at <a href='https://www.AionianBible.org/Read' target='_blank' title='The worlds first Holy Bible untranslation'>AionianBible.org</a> in web page, ePub, text, and PDF format.  Also read online with the  <a href='https://www.AionianBible.org/Google-Play' target='_blank' title='Aionian Bible free online at Google Play'><span class='notranslate'>Android</span></a>  and  <a href='https://www.AionianBible.org/Apple-iOS-App' target='_blank' title='Apple iOS App'><span class='notranslate'>Apple iOS App</span></a>.  Buy print Bibles at <a href='https://www.AionianBible.org/Buy' target='_blank' title='Holy Bible Aionian Edition at Amazon.com and Lulu.com'><span class='notranslate'>Amazon.com and Lulu.com</span></a>.<br>
<br>
</p><p>
<b>09/01/25</b>&nbsp;&nbsp;538 translations now available in 291 languages.<br>
</p><p>
<b>06/21/25</b>&nbsp;&nbsp;468 translations now available in 230 languages.<br>
</p><p>
<b>03/12/25</b>&nbsp;&nbsp;382 translations now available in 166 languages.<br>
</p><p>
<b>01/28/25</b>&nbsp;&nbsp;All profits are given to <a href='https://CoolCup.org' target='_blank' title='Cool Cup of Water Project'>CoolCup.org</a>.<br>
</p><p>
<b>11/24/24</b>&nbsp;&nbsp;Progressive Web Application <a href='https://pwa.aionianbible.org/' target='_blank' title='PWA format'>off-line format</a>.<br>
</p><p>
<b>10/20/24</b>&nbsp;&nbsp;Gospel Primer <a href='https://www.aionianbible.org/Buy' target='_blank' title='Buy at Amazon and Lulu'>handout format</a>.<br>
</p><p>
<b>08/18/24</b>&nbsp;&nbsp;<a href='https://creativecommons.org/licenses/by/4.0/' target='_blank' title='Copyright license'>Creative Commons Attribution 4.0 International</a>, if source allows.<br>
</p><p>
<b>08/05/24</b>&nbsp;&nbsp;378 translations now available in 165 languages.<br>
</p><p>
<b>05/01/24</b>&nbsp;&nbsp;370 translations now available in 164 languages.<br>
</p><p>
<b>02/04/24</b>&nbsp;&nbsp;352 translations now available in 142 languages.<br>
</p><p>
<b>12/04/23</b>&nbsp;&nbsp;
<a href="?Glossary#g1653" title="View definition" onclick="ABDO('Glossary','g1653');return false;"><i class='notranslate'>Eleēsē</i></a> added to the <a href="?Glossary" title="Strongs Enhanced Concordance and Glossary" onclick="ABDO('Glossary');return false;"><i class='notranslate'>Aionian Glossary</i></a>.<br>
</p><p>
<b>02/14/23</b>&nbsp;&nbsp;Aionian Bible published for anonymous access on the <a href='https://www.AionianBible.org/TOR' target='_blank' title='TOR Network'>TOR Network</a>.<br>
</p><p>
<b>02/14/22</b>&nbsp;&nbsp;<a href='https://en.wikipedia.org/wiki/Strong%27s_Concordance' target='_blank' title='Strongs Concordance history at wikipedia'>Strong's Concordance</a> from <a href='https://viz.bible' target='_blank' title='Strongs Concordance source'>viz.bible</a>, <a href='https://github.com/openscriptures/strongs' target='_blank' title='improved Strongs Concordance source'>Open Scriptures</a>, and <a href='https://github.com/STEPBible/STEPBible-Data' target='_blank' title='STEPBible Enhanced Strongs Concordance'>STEPBible Enhanced Strong's</a> at <a href='https://www.AionianBible.org/Strongs' target='_blank' title='Strongs Enhanced Concordance and Glossary'>AionianBible.org/Strongs</a>.<br>
</p><p>
<b>01/23/22</b>&nbsp;&nbsp;Volunteers celebrate with pie and prayer.<br>
</p><p>
<b>01/09/22</b>&nbsp;&nbsp;<a href='https://resources.aionianbible.org/AB-StudyPack/' target='_blank' title='Aionian Bible language StudyPacks'>StudyPack</a> resources for Bible translation and underlying language study now available.<br>
</p><p>
<b>01/01/22</b>&nbsp;&nbsp;216 translations now available in 99 languages.<br>
</p><p>
<b>12/20/21</b>&nbsp;&nbsp;Social media presence on 
<a href='https://www.AionianBible.org/Facebook'		target='_blank' title='Facebook/AionianBible'>Facebook</a>,
<a href='https://www.AionianBible.org/Twitter'		target='_blank' title='Twitter/AionianBible'>Twitter</a>,
<a href='https://www.AionianBible.org/LinkedIn'		target='_blank' title='LinkedIn/AionianBible'>LinkedIn</a>,
<a href='https://www.AionianBible.org/Instagram'	target='_blank' title='Instagram/AionianBible'>Instagram</a>,
<a href='https://www.AionianBible.org/Pinterest'	target='_blank' title='Pinterest/AionianBible'>Pinterest</a>,
<a href='https://www.AionianBible.org/YouTube'		target='_blank' title='YouTube/AionianBible'>YouTube</a>,
<a href='https://www.AionianBible.org/Google-Play'	target='_blank' title='GooglePlay/AionianBible'>GooglePlay</a>, and
<a href='https://www.AionianBible.org/EmailNews'	target='_blank' title='EmailNews/AionianBible'>MailChimp</a><br>
</p><p>
<b>11/17/21</b>&nbsp;&nbsp;<a href='https://www.AionianBible.org/Bible-Cover' target='_blank' title='Buy the Aionian Bible Branded Leather Bible Cover'>Aionian Bible Branded Leather Bible Covers</a> now available.<br>
</p><p>
<b>03/31/21</b>&nbsp;&nbsp;214 translations now available in 99 languages.<br>
</p><p>
<b>12/01/20</b>&nbsp;&nbsp;Right to left and Hindic languages now available in PDF format.<br>
</p><p>
<b>08/29/20</b>&nbsp;&nbsp;Aionian Bibles now available in ePub format.<br>
</p><p>
<b>05/25/20</b>&nbsp;&nbsp;Illustrations by Gustave Doré, <a href='https://resources.aionianbible.org/Gustave-Dore-La-Grande-Bible-de-Tours/' title='Gustave Dorés La Grande Bible de Tours' target='_blank'>La Grande Bible de Tours</a>, (Felix Just, S.J., <a href='https://catholic-resources.org/Art/Dore.htm' title='Catholic Resources' target='_blank'>Catholic-Resources.org/Art/Dore.htm</a>).<br>
</p><p>
<b>02/22/20</b>&nbsp;&nbsp;Aionian Bibles <a href='https://www.aionianbible.org/Buy' target='_blank' title='in print at Amazon and Lulu'>available in print</a> at <a href='https://www.AionianBible.org/Lulu' target='_blank' title='Aionian Bibles in print at Lulu.com'>Lulu.com</a>.<br>
</p><p>
<b>10/31/19</b>&nbsp;&nbsp;174 translations now available in 74 languages.<br>
</p><p>
<b>10/28/19</b>&nbsp;&nbsp;<span class='notranslate'>Aionian</span>  Bible project nursed as another J. and J. pray.<br>
</p><p>
<b>03/24/19</b>&nbsp;&nbsp;135 translations now available in 67 languages.<br>
</p><p>
<b>11/17/18</b>&nbsp;&nbsp;104 translations now available in 57 languages.<br>
</p><p>
<b>10/20/18</b>&nbsp;&nbsp;70 translations now available in 33 languages.<br>
</p><p>
<b>09/15/18</b>&nbsp;&nbsp;<span class='notranslate'>Aionian</span>  Bible project dedicated as J. and J. pray again.<br>
</p><p>
<b>03/06/18</b>&nbsp;&nbsp;Aionian Bibles <a href='https://www.aionianbible.org/Buy' target='_blank' title='in print at Amazon and Lulu'>available in print</a> at <a href='https://www.AionianBible.org/Amazon' target='_blank' title='Aionian Bibles in print at Amazon.com'>Amazon.com</a>.<br>
</p><p>
<b>02/01/18</b>&nbsp;&nbsp;<i class='notranslate'>Holy Bible Aionian Edition®</i>  trademark registered.<br>
</p><p>
<b>07/30/17</b>&nbsp;&nbsp;42 translations now available in 22 languages.<br>
</p><p>
<b>07/01/17</b>&nbsp;&nbsp;<i>'The Purple Bible'</i> nickname begins.<br>
</p><p>
<b>01/16/17</b>&nbsp;&nbsp;<a href='https://www.AionianBible.org/Google-Play' target='_blank' title='Aionian Bible free online at Google Play'><span class='notranslate'>Aionian</span>  Bible Google Play Store App</a> published.<br>
</p><p>
<b>01/01/17</b>&nbsp;&nbsp;<a href='https://creativecommons.org/licenses/by-nd/4.0' target='_blank' title='Copyright license'>Creative Commons Attribution No Derivative Works 4.0</a> license added.<br>
</p><p>
<b>12/07/16</b>&nbsp;&nbsp;<a href='https://NAINOIA-INC.signedon.net' target='_blank' title='Nainoia, Inc. exists for Christian mission promotion, technical support services, and Bible translation'>Nainoia Inc</a> established as non-profit corporation.<br>
</p><p>
<b>06/21/16</b>&nbsp;&nbsp;30 translations available in 12 languages.<br>
</p><p>
<b>01/11/16</b>&nbsp;&nbsp;<a href='https://www.AionianBible.org' target='_blank' title='The worlds first Holy Bible untranslation'>AionianBible.org</a> domain registered.<br>
</p><p>
<b>06/21/15</b>&nbsp;&nbsp;<span class='notranslate'>Aionian</span>  Bible project birthed as G. and J. pray.<br>
</p><p>
<b>12/18/13</b>&nbsp;&nbsp;<span class='notranslate'>Aionian</span>  Bible project announced as J. and J. pray.<br>
</p><p>
<b>04/15/85</b>&nbsp;&nbsp;<span class='notranslate'>Aionian</span>  Bible project conceived as B. and J. pray.<br>
</p><p>
<b>06/21/75</b>&nbsp;&nbsp;Two boys, P. and J., wonder if Jesus saves all and pray.<br>
</p>
`,





///////////////////////////////////////////////////////////////////////////////////////////////////
// GLOSSARY
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
{$G_FORPRINT['W_GLOS']}
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>

<p>The <i>Aionian Bible</i> un-translates and instead transliterates eleven special words to help us better understand the extent of God’s love for individuals and all mankind, and the nature of afterlife destinies.  The original translation is unaltered and a note is added to 64 Old Testament and 200 New Testament verses. Compare the definitions below to the <a href='https://www.AionianBible.org/Strongs' target='_blank' title='Strongs Enhanced Concordance and Glossary'>Strong's Concordance</a>.  Follow the links below to study the word's usage.</p>

<h3><i><a id="g12">Abyssos</a></i></h3>
Language: Koine Greek<br>
Speech: proper noun, place<br>
Strongs: g12<br>
Meaning:<br>
<div style='margin-left: 15px;'>Temporary prison for special fallen angels such as Apollyon, the Beast, and Satan.</div>
Usage: 9 times in 3 books, 6 chapters, and 9 verses<br>
{$G_PWA->g12}<br>

<h3><i><a id="g126">aïdios</a></i></h3>
Language: Koine Greek<br>
Speech: adjective<br>
Strongs: g126<br>
Meaning:<br><div style='margin-left: 15px;'>Lasting, enduring forever, eternal.</div>
Usage: 2 times in Romans 1:20 and Jude 6<br>
{$G_PWA->g126}<br>

<h3><i><a id="g165">aiōn</a></i></h3>
Language: Koine Greek<br>
Speech: noun<br>
Strongs: g165<br>
Meaning:<br><div style='margin-left: 15px;'>A lifetime or time period with a beginning and end, an era, an age, the completion of which is beyond human perception, but known only to God the creator of the aiōns, Hebrews 1:2. Never meaning simple <i>endless or infinite chronological time</i> in Koine Greek usage. Read <a href="?Aionian" title="Book abstracts of Dr. Heleen Keizer and Ramelli and Konstan" onclick="ABDO('Aionian');return false;">Dr. Heleen Keizer and Ramelli and Konstan</a> for proofs.</div>
Usage: 127 times in 22 books, 75 chapters, and 102 verses<br>
{$G_PWA->g165}<br>

<h3><i><a id="g166">aiōnios</a></i></h3>
Language: Koine Greek<br>
Speech: adjective<br>
Strongs: g166<br>
Meaning:<br><div style='margin-left: 15px;'>From start to finish, pertaining to the age, lifetime, entirety, complete, or even consummate. Never meaning simple <i>endless or infinite chronological time</i> in Koine Greek usage. Read <a href="?Aionian" title="Book abstracts of Dr. Heleen Keizer and Ramelli and Konstan" onclick="ABDO('Aionian');return false;">Dr. Heleen Keizer and Ramelli and Konstan</a> for proofs.</div>
Usage: 71 times in 19 books, 44 chapters, and 69 verses<br>
{$G_PWA->g166}<br>

<h3><i><a id="g1653">eleēsē</a></i></h3>
Language: Koine Greek<br>
Speech: verb<br>
Strongs: g1653<br>
Meaning:<br><div style='margin-left: 15px;'>To have pity on, to show mercy. Typically, the subjunctive mood indicates possiblity, not certainty. However, a subjunctive in a purpose clause is a resulting action as certain as the causal action. The subjunctive in a purpose clause functions as an indicative, not an optative. Thus, the grand conclusion of grace theology in Romans 11:32 must be clarified. God's mercy on all is not a possibility, but a certainty. See <a href='https://www.ntgreek.org' target='_blank'>www.ntgreek.org</a>.</div>
Usage: 1 time in this conjugation, {$G_LINKS->X_ROM_11}<br>
{$G_PWA->g1653}<br>

<h3><i><a id="g1067">Geenna</a></i></h3>
Language: Koine Greek<br>
Speech: proper noun, place<br>
Strongs: g1067<br>
Meaning:<br>
<div style='margin-left: 15px;'>Valley of Hinnom, Jerusalem's trash dump, a place of ruin, destruction, and judgment in this life, or the next, though not eternal to Jesus' audience.</div>
Usage: 12 times in 4 books, 7 chapters, and 12 verses<br>
{$G_PWA->g1067}<br>

<h3><i><a id="g86">Hadēs</a></i></h3>
Language: Koine Greek<br>
Speech: proper noun, place<br>
Strongs: g86<br>
Meaning:<br>
<div style='margin-left: 15px;'>Synonomous with <i>Sheol</i>, though in New Testament usage <i>Hades</i> is the temporal place of punishment for deceased unbelieving mankind, distinct from <i>Paradise</i> for deceased believers.</div>
Usage: 11 times in 5 books, 9 chapters, and 11 verses<br>
{$G_PWA->g86}<br>

<h3><i><a id="g3041"></a><a id="g4442">Limnē Pyr</a></i></h3>
Language: Koine Greek<br>
Speech: proper noun, place<br>
Strongs: g3041 g4442<br>
Meaning:<br>
<div style='margin-left: 15px;'>Lake of Fire, final punishment for those not named in the Book of Life, prepared for the Devil and his angels, Matthew 25:41.</div>
Usage: Phrase 5 times in the New Testament<br>
{$G_PWA->g3041}<br>

<h3><i><a id="h7585">Sheol</a></i></h3>
Language: Hebrew<br>
Speech: proper noun, place<br>
Strongs: h7585<br>
Meaning:<br>
<div style='margin-left: 15px;'>The grave or temporal afterlife world of both the righteous and unrighteous, believing and unbelieving, until the general resurrection.</div>
Usage: 66 times in 17 books, 50 chapters, and 64 verses<br>
{$G_PWA->h7585}<br>

<h3><i><a id="g5020">Tartaroō</a></i></h3>
Language: Koine Greek<br>
Speech: proper noun, place<br>
Strongs: g5020<br>
Meaning:<br>
<div style='margin-left: 15px;'>Temporary prison for particular fallen angels awaiting final judgment.</div>
Usage: 1 time in 2 Peter 2:4<br>
{$G_PWA->g5020}<br>

<h3><i><a id="questioned">Questioned</a></i></h3>
Questioned verse translations do not contain Aionian Glossary words, but may wrongly imply eternal or Hell.<br>
{$G_PWA->questioned}
`,





///////////////////////////////////////////////////////////////////////////////////////////////////
// PAST
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
History Past
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>

<div id='maps'>
<div class="map timeline"><img src="images/Timeline-History-Aionian-Bible.jpg" alt="History Past"></div>
<p class='left'>Derived from <a href='https://www.aionianbible.org/Uusher' target='_blank' title='Download PDF'>The Annals of the World by James Uusher</a> and <a href='https://www.aionianbible.org/Wikipedia-Timeline-of-Christian-Missions' target='_blank' title='Visit Wikipedia'>Timeline of Christian missions, Wikipedia</a>. <a href='https://www.aionianbible.org/Timeline' target='_blank' title='Download printable chart'>Printable version</a></p>
</div>
`,





///////////////////////////////////////////////////////////////////////////////////////////////////
// FUTURE
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
History Future
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>

<div id='maps'>
<div class="map timeline"><img src="images/Timeline-Eschatology-Aionian-Bible.jpg" alt="History Future"></div>
<p class='left'>The chart indicates the whereabouts of God, mankind, and angels throughout the ages of history.  Note that the punishment of deceased unbelieving mankind in Hades is temporal as promised when Jesus said <i>“the gates of Hades will not prevail”</i>, Paul wrote <i>“Hades where is your victory?”</i>, and John wrote <i>“Hades gives up.”</i>  Also note that certain fallen angels are already held in a separate prison, Tartarus, awaiting final judgment and sentencing to the Lake of Fire which is <i>“prepared for the Devil and his angels,”</i> according to Matthew 25:41.  Satan’s rebellion will be crushed and Christ will be victorious in the salvation of all his people.  You too can know your name is already written in Heaven through faith in Jesus Christ! <a href='https://www.aionianbible.org/Future' target='_blank' title='Download printable chart'>Printable version</a></p>
</div>
`,





///////////////////////////////////////////////////////////////////////////////////////////////////
// DESTINY
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
{$G_FORPRINT['W_DESTINY']}
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>

<p>The Aionian Bible shows the location of eleven special Greek and Hebrew <a href="?Glossary" title="Aionian Glossary" onclick="ABDO('Glossary');return false;">Aionian Glossary</a> words to help us better understand God’s love for individuals and for all mankind, and the nature of after-life destinies. The underlying Hebrew and Greek words typically translated as <i>Hell</i> show us that there are not just two after-life destinies, Heaven or Hell.  Instead, there are a number of different locations, each with different purposes, different durations, and different inhabitants. Locations include 1) Old Testament <a href="?Glossary#h7585" title="Aionian glossary h7585" onclick="ABDO('Glossary','h7585');return false;"><i>Sheol</i></a> and New Testament <a href="?Glossary#g86" title="Aionian glossary g86" onclick="ABDO('Glossary','g86');return false;"><i>Hadēs</i></a>, 2) <a href="?Glossary#g1067" title="Aionian glossary g1067" onclick="ABDO('Glossary','g1067');return false;"><i>Geenna</i></a>, 3) <a href="?Glossary#g5020" title="Aionian glossary g5020" onclick="ABDO('Glossary','g5020');return false;"><i>Tartaroō</i></a>, 4) <a href="?Glossary#g12" title="Aionian glossary g12" onclick="ABDO('Glossary','g12');return false;"><i>Abyssos</i></a>, 5) <a href="?Glossary#g3041" title="Aionian glossary g3041" onclick="ABDO('Glossary','g3041');return false;"><i>Limnē Pyr</i></a>, 6) {$G_LINKS->X_PARADISE}, 7) {$G_LINKS->X_NEWHEAVEN}, and 8) {$G_LINKS->X_NEWEARTH}. So there is reason to review our conclusions about the destinies of redeemed mankind and fallen angels.</p>

<p>The key observation is that fallen angels will be present at the final judgment, {$G_LINKS->X_2PE_2} and  {$G_LINKS->X_JUD_1}. Traditionally, we understand the separation of the Sheep and the Goats at the final judgment to divide believing from unbelieving mankind, {$G_LINKS->X_SHEEP} and {$G_LINKS->X_GREAT}. However, the presence of fallen angels alternatively suggests that Jesus is separating redeemed mankind from the fallen angels.  We do know that Jesus is the helper of mankind and not the helper of the Devil, {$G_LINKS->X_HEB_2}. We also know that Jesus has atoned for the sins of all mankind, both believer and unbeliever alike, {$G_LINKS->X_ALLALL}. Deceased believers are rewarded in Paradise, {$G_LINKS->X_LUK_23}, while unbelievers are punished in Hades as the story of Lazarus makes plain, {$G_LINKS->X_LUK_16}. Yet less commonly known, the punishment of this selfish man and all unbelievers is before the final judgment, is temporal, and is punctuated when Hades is evacuated, {$G_LINKS->X_REV_20}. So is there hope beyond Hades for unbelieving mankind? Jesus promised, <i>“the gates of Hades will not prevail,”</i> {$G_LINKS->X_MAT_16}. Paul asks, <i>“Hades where is your victory?”</i> {$G_LINKS->X_1CO_15}. John wrote, <i>“Hades gives up,”</i> {$G_LINKS->X_REV_20}.</p>

<p>Jesus comforts us saying, <i>“Do not be afraid,”</i> because he holds the keys to <i>unlock</i> death and Hades, {$G_LINKS->X_REV_1}. Yet too often our <i>Good News</i> sounds like a warning to <i>“be afraid”</i> because Jesus holds the keys to <i>lock</i> Hades!  Wow, we have it backwards!  Hades will be evacuated!  And to guarrantee hope, once emptied, Hades is thrown into the Lake of Fire, never needed again, {$G_LINKS->X_REV_20}.</p>

<p>Finally, we read that anyone whose name is not written in the Book of Life is thrown into the Lake of Fire, the second death, with no exit ever mentioned or promised, {$G_LINKS->X_REV_21}. So are those evacuated from Hades then, <i>“out of the frying pan, into the fire?”</i>  Certainly, the Lake of Fire is the destiny of the Goats.  But, do not be afraid. Instead, read the Bible's explicit mention of the purpose of the Lake of Fire and the identity of the Goats. <i>“Then he will say also to those on the left hand, ‘Depart from me, you cursed, into the consummate fire which is prepared for... the devil and his angels,’”</i> {$G_LINKS->X_MAT_25}. Bad news for the Devil. Good news for all mankind!</p>

<p>Faith is not a pen to write your own name in the Book of Life. Instead, faith is the glasses to see that the love of Christ for all mankind has already written our names in Heaven. <i>“If the first fruit is holy, so is the lump,”</i> {$G_LINKS->X_ROM_1116}.  Though unbelievers will suffer regrettable punishment in Hades, redeemed mankind will never enter the Lake of Fire, prepared for the devil and his angels. And as God promised, all mankind will worship Christ together forever, {$G_LINKS->X_PHI_2}.</p>
`,





///////////////////////////////////////////////////////////////////////////////////////////////////
// ABRAHAM
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
Abraham's Journey
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>

<div id='maps'>
<div class="map"><img src="images/MAP-Abrahams-Journey.jpg" alt="Abraham's Journey"></div>
<div class='caption'>{$G_FORPRINT['HEB11_8']}</div>
</div>
`,





///////////////////////////////////////////////////////////////////////////////////////////////////
// ISRAEL
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
Israel's Exodus
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>

<div id='maps'>
<div class="map"><img src="images/MAP-Israels-Exodus.jpg" alt="Israel's Exodus"></div>
<div class='caption'>{$G_FORPRINT['EXO13_17']}</div>
</div>
`,





///////////////////////////////////////////////////////////////////////////////////////////////////
// JESUS
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
Jesus' Journeys
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>

<div id='maps'>
<div class="map portrait"><img src="images/MAP-Jesus-Journeys.jpg" alt="Jesus' Journeys"></div>
<div class='caption'>{$G_FORPRINT['MAR10_45']}</div>
</div>
`,





///////////////////////////////////////////////////////////////////////////////////////////////////
// PAUL
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
Paul's Missionary Journeys
<a title='Next Page' class='nav right' href='?Next' onclick="ABDO('Next');return false;"><span class="nav cgt">&gt;</span></a>
</h2>

<div id='maps'>
<div class="map"><img src="images/MAP-Pauls-Missionary-Journeys.jpg" alt="Paul's Missionary Journeys"></div>
<div class='caption'>{$G_FORPRINT['ROM1_1']}</div>
</div>
`,





///////////////////////////////////////////////////////////////////////////////////////////////////
// WORLD
`
<h2 class='title'>
<a title='Previous Page' class='nav left' href='?Prev' onclick="ABDO('Prev');return false;"><span class="nav clt">&lt;</span></a>
World Nations
</h2>

<div id='maps'>
<div class="map"><img src="images/MAP-World-Nations.jpg" alt="World Nations"></div>
<div class='caption'>{$G_FORPRINT['MAT28_19']}</div>
</div>
`

];





///////////////////////////////////////////////////////////////////////////////////////////////////
// PAGER - The heart of the PWA that allows navigating through the page content array AB_Bible
function ABDO(goto, anchor=null, push=true) {
	// validate request
	if      (typeof goto == 'number')  {				gonu = goto; }
	else if (typeof goto != 'string')  {				gonu = null; }
	else if (goto == 'Prev') {							gonu = AB_Page - 1;			goto = gonu; }
	else if (goto == 'Next') {							gonu = AB_Page + 1;			goto = gonu; }
	else if (AB_Map.hasOwnProperty(goto)) {				gonu = AB_Map[goto]; }
	else if (goto.match(/^[\d]+$/)) {					gonu = +goto; }
	else if (goto != 'Bookmark') {						gonu = null; }
	else if (typeof AB_Bookmark == 'number')  {			gonu = AB_Bookmark;			goto = AB_Bookmark; }
	else if (typeof AB_Bookmark != 'string')  {			gonu = null; }
	else if (typeof AB_Map[AB_Bookmark] == 'number') {	gonu = AB_Map[AB_Bookmark];	goto = AB_Bookmark; }
	else if (AB_Bookmark.match(/^[\d]+$/)) {			gonu = +AB_Bookmark;		goto = AB_Bookmark; }
	else {												gonu = null; }
	if (gonu === null || typeof AB_Bible[gonu] == 'undefined') {
		if (gonu !== null && ((AB_Page == 0 && gonu == -1) || (AB_Page == AB_Bible.length-1 && gonu == AB_Bible.length))) { return; }
		alert("Returning to TOC, invalid page: " + goto);
		goto = 'TOC';
		gonu = AB_Map['TOC'];
	}

	// page assign, bookmark, load
	AB_Page = gonu;
	if (AB_Page > 2 && AB_Bookmark != goto) {
		AB_Bookmark = goto;
		AionianBible_writeCookie("AionianBible.Bookmark", AB_Bookmark);
	}
	document.getElementById('body').innerHTML = AB_Bible[AB_Page];

	// Set the update and install links 
	if (AB_Page < 2) {
		AionianBible_PWA_UpdateInstall();
	}

	// push history to browser
	if (anchor && anchor[0]=='#') { anchor = anchor.substring(1); }
	if (push && (window.history.state === null || typeof window.history.state.go == "undefined" || window.history.state.go != goto)) {
		const anchor2 = (anchor ? '#' + anchor : '');
		window.history.pushState({go:goto}, '', window.location.pathname + "?" + goto + anchor2);
	}

	// set font accessibility and scroll to anchor
	AB_Accessible = document.getElementById('body');
	if (null !== AB_Accessible) {
		AB_Accessible.className = AionianBible_readCookie("AionianBible.Accessible");
	}
	if (anchor) { document.getElementById(anchor).scrollIntoView(true); window.scrollBy(0,-70); }
	else { window.scrollTo(0, 0); }
}





///////////////////////////////////////////////////////////////////////////////////////////////////
// BROWSER HISTORY - Since we page without re-loading this sets the brower history
window.addEventListener('popstate', function (event) {
    if (event.state) {
		ABDO(event.state.go, null, false);
	}
}, false);





///////////////////////////////////////////////////////////////////////////////////////////////////
// COOKIES - Used for bookmarking pages
function AionianBible_writeCookie(cname, cvalue) {
	var date = new Date();
	date.setTime(date.getTime() + (1000 * 24 * 60 * 60 * 1000));
	document.cookie = cname + ".{$G_PWA->bible_basic}" + "=" + cvalue + ";expires=" + date.toUTCString() + ";SameSite=Strict;path=/";
}
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





///////////////////////////////////////////////////////////////////////////////////////////////////
// BOOKMARK - Save bookmarks to Cookies
function AionianBible_Set() {
	AB_Bookmark2 = AB_Page;
	AionianBible_writeCookie("AionianBible.Bookmark2", AB_Bookmark2);
	return false;
}
function AionianBible_Get() {
	ABDO(AB_Bookmark2);
	return false;
}





///////////////////////////////////////////////////////////////////////////////////////////////////
// ACCESSIBILITY - Increase font size for readability
function AionianBible_Accessible() {
	AB_Accessible = document.getElementById('body');
	if (null !== AB_Accessible) {
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





///////////////////////////////////////////////////////////////////////////////////////////////////
// SWIPE - Swipe pagination
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
			if (swipedir == 'right') {		ABDO('Prev'); }
			else if (swipedir == 'left') {	ABDO('Next'); }
		} );
	}, false);
}
AionianBible_SwipeLinks();





///////////////////////////////////////////////////////////////////////////////////////////////////
// RELOAD - Reload the HTM file and all resources
function AionianBible_Reload() {
	const myRequest = new Request(window.location.href);
	fetch(myRequest,{cache: 'reload'}).then((response) => {
		if (response.status == 200) {
			const headers = response.headers;
			var modified = '';
			if (headers) { modified = ' dated: ' + headers.get('last-modified'); }
			alert('Update Bible App from source' + modified);
			location.reload();
		}
		else {
			alert('Bible App update unavailable');
		}
	}).catch(err => {
		alert('Bible App update error');
	});
}




///////////////////////////////////////////////////////////////////////////////////////////////////
// PWA - Display install and update links accordingly, called from various contexts
var AionianBible_PWA_InstallPromptEvent = null;
function AionianBible_PWA_UpdateInstall() {
	var upin = document.getElementById('upin');
	if (upin) {
		// No install prompt or 'minimal-ui' display so must already be installed
		if (!AionianBible_PWA_InstallPromptEvent || window.matchMedia('(display-mode: minimal-ui)').matches) {
			upin.innerHTML = "<a title='Internet connection required' href='?PWA' onclick='AionianBible_Reload();return false;'>( Update Bible App )</a><br>";
		}
		// offer install function */
		else {
			upin.innerHTML = "<a href='?PWA' onclick='AionianBible_PWA_InstallPrompt();return false;' title='Install Progressive Web Application'>( Install Bible App )</a><br>";
		}
	}
}
// install prompt event captured on page load
async function AionianBible_PWA_InstallPrompt() {
	if (AionianBible_PWA_InstallPromptEvent) {
		const result = await AionianBible_PWA_InstallPromptEvent.prompt();
		console.log(`Aionian Bible App install prompt: \${result.outcome}`);
		AionianBible_PWA_InstallPromptEvent = null;
		AionianBible_PWA_UpdateInstall();
	}
}
// message the service worker to reload the cache - currently unused
async function AionianBible_PWA_ReInstall() {
	if ("serviceWorker" in navigator && navigator.serviceWorker.controller) {
		navigator.serviceWorker.controller.postMessage({
			type: 'AionianBible_PWA_ReInstall',
		});
		console.log(`Aionian Bible App recache message sent`);
	}
}




///////////////////////////////////////////////////////////////////////////////////////////////////
// ONLOAD - Initialize the PWA
window.onload = function() {
	// bookmarks
	AB_Bookmark = AionianBible_readCookie("AionianBible.Bookmark");
	if (AB_Bookmark === null) {
		AB_Bookmark = 'TOC';
		AionianBible_writeCookie("AionianBible.Bookmark", AB_Bookmark);
	}
	AB_Bookmark2 = AionianBible_readCookie("AionianBible.Bookmark2");
	if (AB_Bookmark2 === null) {
		AB_Bookmark2 = 'TOC';
		AionianBible_writeCookie("AionianBible.Bookmark", AB_Bookmark2);
	}

	// remove javascript warning and save homepage to array
	var upin = document.getElementById('upin');
	if (upin) { upin.innerHTML = ''; }
	AB_Bible[0] = document.getElementById('body').innerHTML;

	// load queried page
	const query = window.location.search;
	if (query && query != "?PWA") {
		ABDO(query.substring(1), window.location.hash);
	}
	// homepage already loaded, but indicate update or install
	else {
		window.history.replaceState({go:'PWA'}, '', location.pathname + "?PWA");
		AionianBible_PWA_UpdateInstall();
	}

	// seize the install prompt
	window.addEventListener("beforeinstallprompt", (event) => {
		event.preventDefault();
		AionianBible_PWA_InstallPromptEvent = event;
		AionianBible_PWA_UpdateInstall();
	});

	// register the service worker
	if ("serviceWorker" in navigator) {
		navigator.serviceWorker.register("pwa.js");
	}

	console.log(`Aionian Bible App onload: complete`);
}

</script>





<!--////////////////////////////////////////////////////////////////////////////////////////////////////-->
</body>
</html>
EOF;
}
