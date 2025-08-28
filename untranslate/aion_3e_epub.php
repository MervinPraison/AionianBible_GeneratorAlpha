#!/usr/local/bin/php
<?php

/*
STRUCTURE:
EPUB/mimetype
EPUB/META-INF/container.xml
EPUB/META-INF/com.apple.ibooks.display-options.xml
EPUB/epub/epub.opf		(epub 3.0 Open Packaging Format XML file)
EPUB/epub/toc.ncx		(epub 2.0 Navigation Control XML file)
EPUB/epub/epub.css		(Cascading Style Sheets)
EPUB/epub/images
EPUB/epub/images/COVER.jpg
EPUB/epub/fonts
EPUB/epub/chapters

DEFINTIONS:
epub3.0				http://idpf.org/epub/30/spec/epub30-publications.html
epub3.0		opf		http://idpf.org/epub/30/spec/epub30-publications.html#sec-package-def
epub3.0		vocabs	https://idpf.github.io/epub-vocabs/structure/ 
epub2.0.1			http://idpf.org/epub/20/spec/OPS_2.0.1_draft.htm

WEBSITES:
http://idpf.org/
https://www.w3.org/publishing/
http://www.hxa.name/articles/content/epub-guide_hxa7241_2007.html
Opinion plus http://glazman.org/e0/e0.html
W3 definition https://www.w3.org/publishing/epub3/epub-ocf.html
W3 definition https://www.w3.org/Submission/2017/SUBM-epub-ocf-20170125/#sec-container-metainf-manifest.xml
5 elements of OPF file https://www.eboundcanada.org/Resources/whats-in-an-epub-the-opf-file/
https://www.sitepoint.com/building-epub-with-php-and-markdown/
http://idpf.org/epub/30/spec/epub30-changes.html 
http://idpf.org/epub/dir/
https://en.wikipedia.org/wiki/EPUB

NOTES:
Fully ePUb 2 and 3 compatible!
	http://idpf.org/epub/30/spec/epub30-changes.html
	EPUB 3 defines a profile of CSS based on CSS 2.1 with added modules from CSS3, whereas EPUB 2 was based on a specific subset of CSS 2
	http://idpf.org/epub/20/spec/OPS_2.0.1_draft.htm#Section3.0
Find an ePub inspector tool online!
Responsive images? CSS or SVG?
mimetype file must be the first file in the EPUB file's ZIP structure, uncompressed.

*/

/*** globals ***/
$G_BOOKS	= array();
$G_NUMBERS	= array();
$G_VERSIONS	= array();
$G_FORPRINT	= array();
$G_UUID		= NULL;
$G_TITLE	= NULL;
$G_MODIFIED	= NULL;
$G_RTL		= NULL;
$G_COMMENT	= NULL;

/*** init ***/
AION_LOOP_EPUBY(	'/home/inmoti55/public_html/domain.aionianbible.org/www-stageresources',
					'/home/inmoti55/public_html/domain.aionianbible.org/www-stage/library/epub',
					'/home/inmoti55/public_html/domain.aionianbible.org/www-stageresources'
				);
AION_ECHO("DONE!");
return;

/*** aion rtfs make loop ***/
function AION_LOOP_EPUBY($source, $destiny_unzip, $destiny_zip) {
	$database = array();
	AION_FILE_DATA_GET( './aion_database/UNTRANSLATE.txt', 'T_UNTRANSLATE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	AION_FILE_DATA_GET( './aion_database/BOOKS.txt', 'T_BOOKS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/NUMBERS.txt', 'T_NUMBERS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/VERSIONS.txt', 'T_VERSIONS', $database, 'BIBLE', FALSE );
	AION_FILE_DATA_GET( './aion_database/FORPRINT.txt', 'T_FORPRINT', $database, 'BIBLE', FALSE );
	AION_LOOP( array(
		'function'		=> 'AION_LOOP_EPUBY_DOIT',
		'source'		=> $source,
		//'include'		=> "/Holy-Bible---.*(Albanian).*---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---.*(Aionian-Bible|Tsak).*---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---.+(Basic).+---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---.*(Azerb|Gaelic|Somali).*---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---Tsak.*---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---English---Aionian-Bible---Aionian-Edition\.noia$/",
		//'include'		=> "/Holy-Bible---Gamotso---Gamo---Aionian-Edition\.noia$/",
		'include'		=> "/---Aionian-Edition\.noia$/",
		'database'		=> $database,
		'destiny'		=> $destiny_unzip,
		'destiny_zip'	=> $destiny_zip,
		) );
	AION_unset($database); unset($database);
	AION_ECHO("DONE DID IT!");
}
function AION_LOOP_EPUBY_DOIT($args) {
	// BIBLE
	if (!preg_match("/\/Holy-Bible---(.*)---Aionian-Edition\.noia/", $args['filepath'], $matches)) {	AION_ECHO("ERROR! Failed to preg_match(Holy-Bible): ".$args['filepath']); }
	$bible = "Holy-Bible---$matches[1]";
	$bible_basic = $matches[1];
	if (empty($args['database'][T_BOOKS][$bible])) {													AION_ECHO("ERROR! Failed to find BOOK[bible] = $bible"); }
	if (($x=count($args['database'][T_BOOKS][$bible]))!=67) {											AION_ECHO("ERROR! Count(args[T_BOOKS][BIBLE])!=67: $x"); }
	if (empty($args['database'][T_NUMBERS][$bible])) {													AION_ECHO("ERROR! Failed to find NUMBERS[bible] = $bible"); }
	if (empty($args['database'][T_VERSIONS][$bible])) {													AION_ECHO("ERROR! Failed to find VERSIONS[bible] = $bible"); }
	if (empty($args['database'][T_FORPRINT][$bible])) {													AION_ECHO("ERROR! Failed to find FORPRINT[bible] = $bible"); }

	// INIT
	global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
	$G_BOOKS	= $args['database'][T_BOOKS][$bible];
	$G_NUMBERS	= $args['database'][T_NUMBERS][$bible];
	$G_VERSIONS	= $args['database'][T_VERSIONS][$bible];
	if ($G_VERSIONS['DOWNLOAD']=='N') { AION_ECHO("WARN! $bible DOWNLOAD=N"); return; }
	$G_FORPRINT	= $args['database'][T_FORPRINT][$bible];
	$G_UUID		= $G_FORPRINT['UUID'];
	$G_TITLE	= "Holy Bible Aionian Edition: ".$G_VERSIONS['NAMEENGLISH'];
	$G_MODIFIED	= date('Y-m-d\TH:i:s\Z');
	$G_RTL		= (empty($G_VERSIONS['RTL']) ? "" : "dir='rtl'");
	$G_ISO		= (empty($G_VERSIONS['LANGUAGECODEISO']) ? "" : "lang='".$G_VERSIONS['LANGUAGECODEISO']."'");
	$bible_name	= $G_VERSIONS['NAMEENGLISH'];
	$bible_acopy= $G_VERSIONS['ABCOPYRIGHT'];
	$bible_copy	= $G_VERSIONS['COPYRIGHT'];
	$G_COMMENT	= <<<EOF
<!-- Website: https://www.AionianBible.org -->
<!-- Publisher: https://NAINOIA-INC.signedon.net -->
<!-- Repository: https://resources.AionianBible.org -->
<!-- Repository: https://github.com/Nainoia-Inc -->
<!-- Copyright: $bible_acopy -->
<!-- Bible: Holy Bible Aionian Edition(R): $bible_name -->
<!-- Bible text copyright: $bible_copy -->
EOF;

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
	
	if (!empty($G_FORPRINT['JOH3_16'])	&& !($G_FORPRINT['JOH3_16']		= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['JOH3_16'],-1)))) {	AION_ECHO("ERROR! ePub $bible_name preg_rep(JOH3_16)"); }
	if (!empty($G_FORPRINT['GEN3_24'])	&& !($G_FORPRINT['GEN3_24']		= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['GEN3_24'],-1)))) {	AION_ECHO("ERROR! ePub $bible_name preg_rep(GEN3_24)"); } 
	if (!empty($G_FORPRINT['LUK23_34'])	&& !($G_FORPRINT['LUK23_34']	= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['LUK23_34'],-1)))) {	AION_ECHO("ERROR! ePub $bible_name preg_rep(LUK23_34)"); }
	if (!empty($G_FORPRINT['REV21_2_3'])&& !($G_FORPRINT['REV21_2_3']	= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['REV21_2_3'],-1)))) {	AION_ECHO("ERROR! ePub $bible_name preg_rep(REV21_2_3)"); }
	if (!empty($G_FORPRINT['HEB11_8'])	&& !($G_FORPRINT['HEB11_8']		= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['HEB11_8'],-1)))) {	AION_ECHO("ERROR! ePub $bible_name preg_rep(HEB11_8)"); }
	if (!empty($G_FORPRINT['EXO13_17'])	&& !($G_FORPRINT['EXO13_17']	= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['EXO13_17'],-1)))) {	AION_ECHO("ERROR! ePub $bible_name preg_rep(EXO13_17)"); }
	if (!empty($G_FORPRINT['MAR10_45'])	&& !($G_FORPRINT['MAR10_45']	= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['MAR10_45'],-1)))) {	AION_ECHO("ERROR! ePub $bible_name preg_rep(MAR10_45)"); }
	if (!empty($G_FORPRINT['ROM1_1'])	&& !($G_FORPRINT['ROM1_1']		= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['ROM1_1'],-1)))) {		AION_ECHO("ERROR! ePub $bible_name preg_rep(ROM1_1)"); }
	if (!empty($G_FORPRINT['MAT28_19'])	&& !($G_FORPRINT['MAT28_19']	= preg_replace('/\s+/', ' ', preg_replace('/<[^<>]*>/us',' ',$G_FORPRINT['MAT28_19'],-1)))) {	AION_ECHO("ERROR! ePub $bible_name preg_rep(MAT28_19)"); }

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

	// TEMPLATE
	$FOLDER = $args['destiny']."/$bible---Aionian-Edition";
	$FOLDEPUB = "$FOLDER/epub";
	system("rm -rf $FOLDER");
	if (is_dir($FOLDER)) {		AION_ECHO("ERROR! rm -rf failed: $FOLDER"); }
	if (!mkdir($FOLDER,0755)) {	AION_ECHO("ERROR! mkdir failed: $FOLDER"); }
	if (system( "cp -R aion_epub/. $FOLDER") === FALSE ) { AION_ECHO("ERROR! cp -R $FOLDER"); }

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
	$header = <<< EOF
<?xml version="1.0" encoding="utf-8"?>
$G_COMMENT
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops" lang="en">
<head>
<meta charset="utf-8" />
<meta name='viewport' content='user-scalable=yes, initial-scale=1, minimum-scale=1, width=device-width, height=device-height'/>
<link href='../epub.css' rel='stylesheet' />

EOF;
	$opf_manifest = $opf_spine_old = $opf_spine_new = $ncx_old = $ncx_new = $index_old = $index_new = NULL;
	$ncx_count = 7;
	$ncx_yot = 0;
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
		if (!($text = preg_replace('#\((questioned|[^()]+[gGhH]{1}[[:digit:]]+|note:[^()]+)\)#ui', "<span class='not' dir='ltr'>$prev".' $1 '."$next</span>", $text))) { AION_ECHO("ERROR! preg_replace(gXXX)"); }
		if (!($text = preg_replace('# h7585([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#h7585\' title=\'View definition\'>h7585</a>$1',$text))) { AION_ECHO("ERROR! preg_replace(h7585)"); }
		if (!($text = preg_replace('# g12([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g12\'   title=\'View definition\'>g12</a>$1',	$text))) { AION_ECHO("ERROR! preg_replace(g12)"); }
		if (!($text = preg_replace('# g86([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g86\'   title=\'View definition\'>g86</a>$1',	$text))) { AION_ECHO("ERROR! preg_replace(g86)"); }
		if (!($text = preg_replace('# g126([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g126\'  title=\'View definition\'>g126</a>$1',	$text))) { AION_ECHO("ERROR! preg_replace(g126)"); }
		if (!($text = preg_replace('# g165([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g165\'  title=\'View definition\'>g165</a>$1',	$text))) { AION_ECHO("ERROR! preg_replace(g165)"); }
		if (!($text = preg_replace('# g1653([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g1653\' title=\'View definition\'>g1653</a>$1',$text))) { AION_ECHO("ERROR! preg_replace(g1653)"); }
		if (!($text = preg_replace('# g166([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g166\'  title=\'View definition\'>g166</a>$1',	$text))) { AION_ECHO("ERROR! preg_replace(g166)"); }
		if (!($text = preg_replace('# g1067([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g1067\' title=\'View definition\'>g1067</a>$1',$text))) { AION_ECHO("ERROR! preg_replace(g1067)"); }
		if (!($text = preg_replace('# g3041([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g3041\' title=\'View definition\'>g3041</a>$1',$text))) { AION_ECHO("ERROR! preg_replace(g3041)"); }
		if (!($text = preg_replace('# g4442([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g4442\' title=\'View definition\'>g4442</a>$1',$text))) { AION_ECHO("ERROR! preg_replace(g4442)"); }
		if (!($text = preg_replace('# g5020([^0-9]{1})#ui',	' <a href=\'../rear-2-glossary.xhtml#g5020\' title=\'View definition\'>g5020</a>$1',$text))) { AION_ECHO("ERROR! preg_replace(g5020)"); }
		if ($mark != $text) {	$text = "<span $cssavh>".$text."</span>"; }
		else {					$text = "<span $csstex>".$text."</span>"; }
				
		// CHAPTER
		if ($last_indx && ($book != $last_book || $chap != $last_chap)) {
			$book_index		= array_search($last_book, $args['database']['T_BOOKS']['CODE']);
			$book_english	= $args['database']['T_BOOKS']['ENGLISH'][$book_index];
			$book_foreign	= $args['database']['T_BOOKS'][$bible][$book_index];
			if(strpos($book_english,'"')!==FALSE || strpos($book_foreign,'"')!==FALSE) { AION_ECHO("ERROR! book name quote problem! $book_english $book_foreign"); }
			$chap_number	= $args['database']['T_NUMBERS'][$bible][$last_chaN];
			$book_format	= "<h2 $cssbok>$book_foreign $chap_number</h2>\n<div class='chapnav'>\n<a href='../index.xhtml' title='View Table of Contents'>TOC</a>\n";
			if ($last_chaN!=1) {
				if (file_exists("$FOLDEPUB/chapters/$last_indx-$last_book-001.xhtml")) {
					$book_format .= ", <a href='$last_indx-$last_book-001.xhtml' class='ff' $G_ISO $G_RTL title='View book chapter index'>Chapters</a>\n";
				}
				else {
					AION_ECHO("WARN! 'Chapters' link missing $FOLDEPUB/chapters/$last_indx-$last_book-001.xhtml");
				}
			}
			else if (($book_chapters = $args['database']['T_BOOKS']['CHAPTERS'][array_search($last_book,$args['database']['T_BOOKS']['CODE'])])>1) {
				$book_format .= ", Chapter \n";
				for($x=1; $x<=$book_chapters; $x++) {
					$reffy = "{$verse['INDEX']}-{$verse['BOOK']}-".sprintf('%03d',$x);
					// super ugly strategy to confirm there are no verses in the chapter 
					// what we really need is a next and prev function for an associative array element, but too costly
					// https://www.reddit.com/r/PHP/comments/6dtoci/given_a_key_whats_the_most_elegant_way_to_get_the/
					if (empty($database['T_BIBLE']["{$reffy}-001"]) &&
						empty($database['T_BIBLE']["{$reffy}-002"]) &&
						empty($database['T_BIBLE']["{$reffy}-003"]) &&
						empty($database['T_BIBLE']["{$reffy}-004"]) &&
						empty($database['T_BIBLE']["{$reffy}-005"]) &&
						empty($database['T_BIBLE']["{$reffy}-006"]) &&
						empty($database['T_BIBLE']["{$reffy}-007"]) &&
						empty($database['T_BIBLE']["{$reffy}-008"]) &&
						empty($database['T_BIBLE']["{$reffy}-009"]) &&
						empty($database['T_BIBLE']["{$reffy}-010"]) &&						
						empty($database['T_BIBLE']["{$reffy}-011"]) &&
						empty($database['T_BIBLE']["{$reffy}-012"]) &&
						empty($database['T_BIBLE']["{$reffy}-013"]) &&
						empty($database['T_BIBLE']["{$reffy}-014"]) &&
						empty($database['T_BIBLE']["{$reffy}-015"]) &&
						empty($database['T_BIBLE']["{$reffy}-016"]) &&
						empty($database['T_BIBLE']["{$reffy}-017"]) &&
						empty($database['T_BIBLE']["{$reffy}-018"]) &&
						empty($database['T_BIBLE']["{$reffy}-019"]) &&
						empty($database['T_BIBLE']["{$reffy}-020"]) &&	
						empty($database['T_BIBLE']["{$reffy}-021"]) &&
						empty($database['T_BIBLE']["{$reffy}-022"]) &&
						empty($database['T_BIBLE']["{$reffy}-023"]) &&
						empty($database['T_BIBLE']["{$reffy}-024"]) &&
						empty($database['T_BIBLE']["{$reffy}-025"]) &&
						empty($database['T_BIBLE']["{$reffy}-026"]) &&
						empty($database['T_BIBLE']["{$reffy}-027"]) &&
						empty($database['T_BIBLE']["{$reffy}-028"]) &&
						empty($database['T_BIBLE']["{$reffy}-029"]) &&
						empty($database['T_BIBLE']["{$reffy}-030"]) &&
						empty($database['T_BIBLE']["{$reffy}-031"]) &&
						empty($database['T_BIBLE']["{$reffy}-032"]) &&
						empty($database['T_BIBLE']["{$reffy}-033"]) &&
						empty($database['T_BIBLE']["{$reffy}-034"]) &&
						empty($database['T_BIBLE']["{$reffy}-035"]) &&
						empty($database['T_BIBLE']["{$reffy}-036"]) &&
						empty($database['T_BIBLE']["{$reffy}-037"]) &&
						empty($database['T_BIBLE']["{$reffy}-038"]) &&
						empty($database['T_BIBLE']["{$reffy}-039"]) &&
						empty($database['T_BIBLE']["{$reffy}-040"])) {
						AION_ECHO("WARN! $bible_basic Skipping TOC $reffy");
						continue;
					}
					$book_format .= ($x==$last_chaN ? "" : " <a href='$last_indx-$last_book-".sprintf('%03d',$x).".xhtml' title='View book chapter'>$x</a>\n");
				}
			}
			$book_format .= "</div>\n";
			$book_trailer = "<div class='chapbot'>\n<a href='https://www.aionianbible.org/Publisher/$bible_basic/$book_index/$last_chaN' title='Report Bible text questions and concerns to Nainoia Inc'>Report Issue</a>\n</div>\n";
			$contents = "$header<title>$book_english $last_chaN</title>\n</head>\n<body>\n<div>\n$book_format<div class='chap'>\n$contents</div>\n$book_trailer</div>\n</body>\n</html>\n";
			$file = "chapters/$last_indx-$last_book-$last_chap.xhtml";
			if (file_put_contents("$FOLDEPUB/$file", $contents) === FALSE) { AION_ECHO("ERROR! file_put_contents($FOLDEPUB/$file)"); }
			$contents = NULL;
			// epub opf, ncx, and index
			$id = "x_".$last_book."_".$last_chap;
			$opf_manifest .= "<item href='$file' id='$id' media-type='application/xhtml+xml' />\n";
			if((int)$last_indx < 40) {	$opf_spine_old	.= "<itemref idref='$id' linear='yes' />\n"; }
			else {						$opf_spine_new	.= "<itemref idref='$id' linear='yes' />\n"; }
			if((int)$last_indx < 40) {	$ncx_old		.= "<navPoint id='nav$ncx_count' playOrder='$ncx_count'><navLabel><text>$book_english</text></navLabel><content src='$file' /></navPoint>\n"; ++$ncx_count; $ncx_yot = 1; }
			else {						$ncx_count		+= $ncx_yot;
										$ncx_new		.= "<navPoint id='nav$ncx_count' playOrder='$ncx_count'><navLabel><text>$book_english</text></navLabel><content src='$file' /></navPoint>\n"; ++$ncx_count; $ncx_yot = 0; }
			if ((int)$last_chap == 1) {
			if((int)$last_indx < 40) {	$index_old		.= "<li class='olnon'><a href='$file' class='ff' $G_ISO $G_RTL title='View Bible book'>$book_foreign</a></li>\n"; }
			else {						$index_new		.= "<li class='olnon'><a href='$file' class='ff' $G_ISO $G_RTL title='View Bible book'>$book_foreign</a></li>\n"; }
			}	
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
	if(strpos($book_english,'"')!==FALSE || strpos($book_foreign,'"')!==FALSE) { AION_ECHO("ERROR! book name quote problem! $book_english $book_foreign"); }
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
	$book_trailer = "<div class='chapbot'>\n<a href='https://www.aionianbible.org/Publisher/$bible_basic/$book_index/$last_chaN' title='Report Bible text questions and concerns to Nainoia Inc'>Report Issue</a>\n</div>\n";
	$contents = "$header<title>$book_english $last_chaN</title>\n</head>\n<body>\n<div>\n$book_format<div class='chap'>$contents</div>\n$book_trailer</div>\n</body>\n</html>\n";
	$file = "chapters/$last_indx-$last_book-$last_chap.xhtml";	
	if (file_put_contents("$FOLDEPUB/$file", $contents) === FALSE) { AION_ECHO("ERROR! file_put_contents($FOLDEPUB/$file)"); }

	// opf manifest variables
	$id = "x_".$last_book."_".$last_chap;
	$opf_manifest .= "<item href='$file' id='$id' media-type='application/xhtml+xml' />\n";
	if((int)$last_indx < 40) {	$opf_spine_old	.= "<itemref idref='$id' linear='yes' />\n"; }
	else {						$opf_spine_new	.= "<itemref idref='$id' linear='yes' />\n"; }
	if((int)$last_indx < 40) {	$ncx_old		.= "<navPoint id='nav$ncx_count' playOrder='$ncx_count'><navLabel><text>$book_english</text></navLabel><content src='$file' /></navPoint>\n"; ++$ncx_count; $ncx_yot = 1; }
	else {						$ncx_count		+= $ncx_yot;
								$ncx_new		.= "<navPoint id='nav$ncx_count' playOrder='$ncx_count'><navLabel><text>$book_english</text></navLabel><content src='$file' /></navPoint>\n"; ++$ncx_count; $ncx_yot = 0; }
	if ((int)$last_chap == 1) {
	if((int)$last_indx < 40) {	$index_old		.= "<li class='olnon'><a href='$file' class='ff' $G_ISO $G_RTL title='View Bible book'>$book_foreign</a></li>\n"; }
	else {						$index_new		.= "<li class='olnon'><a href='$file' class='ff' $G_ISO $G_RTL title='View Bible book'>$book_foreign</a></li>\n"; }
	}
	
	// UNSET
	AION_unset($database); unset($database); $database=NULL;

	// CREATE Links
	AION_EPUBY_LINKS($FOLDEPUB);
	// CREATE /images/COVER.jpg
	// CREATE /fonts
	// CREATE /images
	if (file_put_contents($file="$FOLDEPUB/copyright", $G_COMMENT) === FALSE) { AION_ECHO("ERROR! file_put_contents($file)"); } // CREATE copyright
	if (!file_exists(($file="../www-stageresources/$bible---EPUB_COVER.jpg")) || !copy($file, "$FOLDEPUB/images/COVER.jpg")) {
		AION_ECHO("WARN! FAILED COVER copy($file)");
		if (!copy(($file="../www-stageresources/Holy-Bible---English---Aionian-Bible---EPUB_COVER.jpg"), "$FOLDEPUB/images/COVER.jpg")) { AION_ECHO("ERROR! FAILED copy($file)"); }
	}
	AION_EPUBY_EPUB_CSS($FOLDEPUB, $opf_manifest);									// CREATE epub.css
	AION_EPUBY_EPUB_OPF($FOLDEPUB, $opf_manifest, $opf_spine_old, $opf_spine_new);	// CREATE epub.opf
	AION_EPUBY_EPUB_NCX($FOLDEPUB, $ncx_old, $ncx_new);								// CREATE toc.ncx
	AION_EPUBY_IMAGE_XHTML("$FOLDEPUB/front-1-cover.xhtml","","images/COVER.jpg");
	AION_EPUBY_FRONT_2_COPYRIGHT_XHTML($FOLDEPUB, "$G_ISO $G_RTL");					// CREATE front-2-copyright.xhtml
	AION_EPUBY_FRONT_3_PREFACE_XHTML($FOLDEPUB);									// CREATE front-3-preface.xhtml
	AION_EPUBY_FRONT_4_AIONIAN_XHTML($FOLDEPUB);									// CREATE front-4-aionian.xhtml
	AION_EPUBY_FRONT_INDEX_XHTML($FOLDEPUB, $index_old, $index_new);				// CREATE index.xhtml
	if (!empty($index_old)) { AION_EPUBY_IMAGE_VERSE_XHTML("$FOLDEPUB/middle-gen.xhtml",			$G_FORPRINT['W_OLD'],	"images/DORE-OLD.jpg",		$G_FORPRINT["GEN3_24"] ); }
	if (!empty($index_new)) { AION_EPUBY_IMAGE_VERSE_XHTML("$FOLDEPUB/middle-mat.xhtml",			$G_FORPRINT['W_NEW'],	"images/DORE-NEW.jpg",		$G_FORPRINT["LUK23_34"] ); }
	if (!empty($index_new)) { AION_EPUBY_IMAGE_VERSE_XHTML("$FOLDEPUB/middle-rev.xhtml",			"New Jerusalem",		"images/DORE-REV.jpg",		$G_FORPRINT["REV21_2_3"] ); }
	AION_EPUBY_REAR_1_READERS_GUIDE_XHTML($FOLDEPUB);								// CREATE rear-1-readers-guide.xhtml
	AION_EPUBY_REAR_1b_PROJECT_HISTORY_XHTML($FOLDEPUB);							// CREATE rear-1b-project-history.xhtml
	AION_EPUBY_REAR_2_GLOSSARY_XHTML($FOLDEPUB, $h7585, $g12, $g86, $g126, $g165, $g1653, $g166, $g1067, $g3041, $g5020, $questioned); // CREATE rear-2-glossary.xhtml
	AION_EPUBY_REAR_3_HISTORY_PAST_XHTML($FOLDEPUB);								// CREATE rear-3-history-past.xhtml
	AION_EPUBY_REAR_4_HISTORY_FUTURE_XHTML($FOLDEPUB);								// CREATE rear-4-history-future.xhtml
	AION_EPUBY_REAR_5_HISTORY_DESTINY_XHTML($FOLDEPUB);								// CREATE rear-5-history-destiny.xhtml
	AION_EPUBY_IMAGE_VERSE_XHTML("$FOLDEPUB/rear-5-map-abraham.xhtml",	"Abraham's Journeys",			"images/MAP-ABRAHAM.jpg",	$G_FORPRINT["HEB11_8"],		TRUE);
	AION_EPUBY_IMAGE_VERSE_XHTML("$FOLDEPUB/rear-6-map-exodus.xhtml",	"Israel's Exodus",				"images/MAP-EXODUS.jpg",	$G_FORPRINT["EXO13_17"],	TRUE);
	AION_EPUBY_IMAGE_VERSE_XHTML("$FOLDEPUB/rear-7-map-jesus.xhtml",	"Jesus' Journeys",				"images/MAP-JESUS.jpg",		$G_FORPRINT["MAR10_45"],	TRUE, "better");
	AION_EPUBY_IMAGE_VERSE_XHTML("$FOLDEPUB/rear-8-map-paul.xhtml",		"Paul's Missionary Journeys",	"images/MAP-PAUL.jpg",		$G_FORPRINT["ROM1_1"],		TRUE);
	AION_EPUBY_IMAGE_VERSE_XHTML("$FOLDEPUB/rear-9-map-world.xhtml",	"Great Commission",				"images/MAP-WORLD.jpg",		$G_FORPRINT["MAT28_19"],	TRUE);
	
	// ZIP
	$FILE = $args['destiny_zip']."/$bible---Aionian-Edition.epub";
	system("rm -rf $FILE");
	system("(cd $FOLDER && zip -X -q -0 $FILE mimetype && zip -X -q -r $FILE META-INF epub)");
	
	// CHECKER
	system("(cd ./aion_epubcheck && java -jar epubcheck.jar $FILE)");
	
	// DONE
	AION_ECHO("EPUB SUCCESS: $bible");
}



// Glossary page links!
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



// Links and alternates
function AION_EPUBY_LINKS($folder=NULL) {
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
	$object->X_ROM_1116	= ($folder && file_exists("$folder/chapters/045-ROM-011.xhtml") ? "<a href='chapters/045-ROM-011.xhtml' title='View reference'>Romans 11:16</a>"			: "Romans 11:16");
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



// CREATE epub.css
function AION_EPUBY_EPUB_CSS($folder, &$opf_manifest) {
global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
$file = "$folder/epub.css";
// BASE FONT
$l = "notosans-basic";
$f = "notosans-basic-regular";
$opf_manifest .= "<item href='fonts/$l.license'	id='basic_lic'	media-type='application/text/plain' />";
$opf_manifest .= "<item href='fonts/$f.woff'	id='basic_wof'	media-type='application/font-woff' />";		// or /font/woff
$opf_manifest .= "<item href='fonts/$f.ttf'		id='basic_ttf'	media-type='application/font-sfnt' />";		// or /font/ttf
$basic_font = <<< EOF
/* Basic Font */ 
@font-face {
	font-family:
		'NotoSans';
	src:
		url('fonts/$f.woff')	format('woff'),
		url('fonts/$f.ttf')		format('truetype');
}

EOF;
if (!copy("./aion_customize_index/fonts/$l.license",	"$folder/fonts/$l.license")){	AION_ECHO("ERROR! AION_EPUBY_EPUB_CSS copy font($l)"); }
if (!copy("./aion_customize_index/fonts/$f.woff",		"$folder/fonts/$f.woff")) {		AION_ECHO("ERROR! AION_EPUBY_EPUB_CSS copy font($f)"); }
if (!copy("./aion_customize_index/fonts/$f.ttf",		"$folder/fonts/$f.ttf")) {		AION_ECHO("ERROR! AION_EPUBY_EPUB_CSS copy font($f)"); }

// GENTIUM FONT
$l = "gentiumplus";
$f = "gentiumplus-r";
$opf_manifest .= "<item href='fonts/$l.license'	id='gentiumplus_lic'	media-type='application/text/plain' />";
$opf_manifest .= "<item href='fonts/$f.woff'	id='gentiumplus_wof'	media-type='application/font-woff' />";		// or /font/woff
$opf_manifest .= "<item href='fonts/$f.ttf'		id='gentiumplus_ttf'	media-type='application/font-sfnt' />";		// or /font/ttf
$gentium_font = <<< EOF
/* GentiumPlus Font */ 
@font-face {
	font-family:
		'GentiumPlus';
	src:
		url('fonts/$f.woff')	format('woff'),
		url('fonts/$f.ttf')		format('truetype');
}

EOF;
if (!copy("./aion_customize_index/fonts/$l.license",	"$folder/fonts/$l.license")){	AION_ECHO("ERROR! AION_EPUBY_EPUB_CSS copy font($l)"); }
if (!copy("./aion_customize_index/fonts/$f.woff",		"$folder/fonts/$f.woff")) {		AION_ECHO("ERROR! AION_EPUBY_EPUB_CSS copy font($f)"); }
if (!copy("./aion_customize_index/fonts/$f.ttf",		"$folder/fonts/$f.ttf")) {		AION_ECHO("ERROR! AION_EPUBY_EPUB_CSS copy font($f)"); }

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
if (empty($font)) {				$foreign_font = NULL; }
else if (empty($fray[$font])) {	AION_ECHO("ERROR! AION_EPUBY_EPUB_CSS font not found: $font"); }
else {
$l = $fray[$font][0];
$f = $fray[$font][1];
$n = $fray[$font][2];
$c = $fray[$font][3]; // unused, all use same tag!
$opf_manifest .= "<item href='fonts/$l.license'	id='foreign_lic'	media-type='application/text/plain' />";
$opf_manifest .= "<item href='fonts/$f.woff'	id='foreign_wof'	media-type='application/font-woff' />";		// or /font/woff
$opf_manifest .= "<item href='fonts/$f.ttf'		id='foreign_ttf'	media-type='application/font-sfnt' />";		// or /font/ttf
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
if (!copy("./aion_customize_index/fonts/$l.license",	"$folder/fonts/$l.license")) {	AION_ECHO("ERROR! AION_EPUBY_EPUB_CSS copy font($l)"); }
if (!copy("./aion_customize_index/fonts/$f.woff",		"$folder/fonts/$f.woff")) {		AION_ECHO("ERROR! AION_EPUBY_EPUB_CSS copy font($f)"); }
if (!copy("./aion_customize_index/fonts/$f.ttf",		"$folder/fonts/$f.ttf")) {		AION_ECHO("ERROR! AION_EPUBY_EPUB_CSS copy font($f)"); }
}

$contents = <<< EOF
/***
$G_COMMENT
***/

/*** PALETTE
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
***/

/*** FONT ***/
$basic_font
$gentium_font
$foreign_font
html,body { font-family: 'NotoSans', 'Arial', 'sans-serif', 'GentiumPlus'; }

/*** BASE ***/
html { height: 100%; }
body { height: 100%; margin: 0; min-width: 360px; font-size: 100%; color: #191919; }
h1, h2, h3, h4 { margin: 0 0 10px 0; }
p, form { margin: 0 0 10px 0; }
img { max-width: 100%; height: auto; border: 1px solid #C5C5C5; }
img.simple { max-width: 100%; height: auto; display: block; margin-left: auto; margin-right: auto; margin-bottom: 10px; border: 0; }
div.better { width: 50%; }
a { text-decoration: none; color: #663399; }
a:hover { color: #9966CC; }
.hidden { display: none; }
.left { text-align: left; }
.center { text-align: center; }
.right { text-align: right; }
.italic { font-style: italic; }

/*** Ordered list ***/
.olbeg { list-style-type: lower-roman; clear: left; }
.olnop { list-style-type: none; margin-right: 10px; }
.oltoc { list-style-type: none; margin-right: 10px; font-weight: 700; }
.olnon { list-style-type: none; float: left; margin-right: 10px; }
.olhed { list-style-type: none; clear: left; float: left; font-weight: 700; margin-right: 10px; }
.olend { list-style-type: upper-alpha; clear: left; }
.olinA { list-style-type: upper-alpha; clear: left; float: left; margin-right: 10px; }
.oline { list-style-type: none; float: left; margin-right: 15px; }

/*** Things ***/
.title { text-align: center; }
.chapnav { margin-bottom: 7px; }
.chapbot { margin-top: 7px; }
.chap { }
.cov { text-align: center; margin: auto; } 
.map { text-align: center; margin: auto; }
.pix { max-width: 50%; height: auto; border: 1px solid #C5C5C5; float: right; margin: 0 0 10px 10px; }
.j316 { font-weight: 600; font-style: italic; }
.cap { text-align: center; font-style: italic; }
.tag { color: #191919; }
.bok { text-align: center; }
.ver { }
.ref { font-style: normal; } 
.tex { }
.avh { background-color: #E0D6EB; }
.lan { }
.num { font-weight: 700; }
.not { font-weight: 700; color: #663399; white-space: nowrap; } 
.rtl-tab { width: 100%; text-align: right; }
.rtl-ref { width: 50px; text-align: right; }
.social img { border: 0px; }

EOF;
if (file_put_contents($file, $contents) === FALSE) { AION_ECHO("ERROR! AION_FILE_DATA_PUT file_put_contents($file)"); }
return;
}


// CREATE epub.opf
function AION_EPUBY_EPUB_OPF($folder, $opf_manifest, $opf_spine_old, $opf_spine_new) {
global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
$file = "$folder/epub.opf";
$lang = (empty($G_VERSIONS['LANGUAGECODEISO']) ? "en" : $G_VERSIONS['LANGUAGECODEISO']);
$opf_spine_old = (empty($opf_spine_old) ? NULL : "<itemref idref='xgen' linear='yes' />\n".$opf_spine_old);
$opf_spine_new = (empty($opf_spine_new) ? NULL : "<itemref idref='xmat' linear='yes' />\n".$opf_spine_new."<itemref idref='xrev' linear='yes' />\n");
$intro_old = (empty($opf_spine_old) ? '' : "<item href='middle-gen.xhtml' id='xgen' media-type='application/xhtml+xml' />\n");
$intro_new = (empty($opf_spine_new) ? '' : "<item href='middle-mat.xhtml' id='xmat' media-type='application/xhtml+xml' />\n");
$outro_new = (empty($opf_spine_new) ? '' : "<item href='middle-rev.xhtml' id='xrev' media-type='application/xhtml+xml' />\n");
$contents = <<< EOF
<?xml version="1.0" encoding="utf-8"?>
$G_COMMENT
<package xmlns="http://www.idpf.org/2007/opf" prefix="ibooks: http://vocabulary.itunes.apple.com/rdf/ibooks/vocabulary-extensions-1.0/" version="3.0" unique-identifier="uid">
<metadata xmlns:calibre="http://calibre.kovidgoyal.net/2009/metadata" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dcterms="http://purl.org/dc/terms/" xmlns:opf="http://www.idpf.org/2007/opf" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<dc:identifier id="uid">urn:uuid:$G_UUID</dc:identifier>
<dc:title>$G_TITLE</dc:title>
<dc:language>$lang</dc:language>
<dc:creator>Nainoia Inc</dc:creator>
<dc:publisher>Nainoia Inc</dc:publisher>
<dc:rights>Nainoia Inc, CC-BY-ND 4.0</dc:rights>
<dc:date>2020-06-21</dc:date>
<dc:subject>The Holy Bible, Christian Scriptures</dc:subject>
<dc:description>The Holy Bible Aionian Edition® is the world’s first Bible un-translation! What is an un-translation? Bibles are translated into each of our languages from the original Hebrew, Aramaic, and Koine Greek. Occasionally, the best word translation cannot be found and these words are transliterated letter by letter. Four well known transliterations are Christ, baptism, angel, and apostle. The meaning is then preserved more accurately through context and a dictionary. The Aionian Bible un-translates and instead transliterates eleven additional Aionian Glossary words to help us better understand God’s love for individuals and all mankind, and the nature of afterlife destinies.</dc:description>
<meta property='dcterms:modified'>$G_MODIFIED</meta>
<meta property='dcterms:dateCopyrighted'>2020-06-21</meta>
<meta property='ibooks:specified-fonts'>true</meta>
<meta name='cover' content='images/COVER.jpg' />
</metadata>
<manifest>
<item href='copyright' id='epub_copyright' media-type='text/plain' />
<item href='epub.css' id='epub_css' media-type='text/css' />
<item href='toc.ncx' id='epub_ncx' media-type='application/x-dtbncx+xml' />
<item href='front-1-cover.xhtml' id='xcover' media-type='application/xhtml+xml' />
<item href='front-2-copyright.xhtml' id='xcopyright' media-type='application/xhtml+xml' />
<item href='front-3-preface.xhtml' id='xpreface' media-type='application/xhtml+xml' />
<item href='front-4-aionian.xhtml' id='xaionian' media-type='application/xhtml+xml' />
<item href='index.xhtml' id='xindex' media-type='application/xhtml+xml' properties='nav' />
$intro_old$intro_new$outro_new<item href='rear-1-readers-guide.xhtml' id='xreaders' media-type='application/xhtml+xml' />
<item href='rear-1b-project-history.xhtml' id='xhistory' media-type='application/xhtml+xml' />
<item href='rear-2-glossary.xhtml' id='xglossary' media-type='application/xhtml+xml' />
<item href='rear-3-history-past.xhtml' id='xpast' media-type='application/xhtml+xml' />
<item href='rear-4-history-future.xhtml' id='xfuture' media-type='application/xhtml+xml' />
<item href='rear-5-history-destiny.xhtml' id='xdestiny' media-type='application/xhtml+xml' />
<item href='rear-5-map-abraham.xhtml' id='xabraham' media-type='application/xhtml+xml' />
<item href='rear-6-map-exodus.xhtml' id='xexodus' media-type='application/xhtml+xml' />
<item href='rear-7-map-jesus.xhtml' id='xjesus' media-type='application/xhtml+xml' />
<item href='rear-8-map-paul.xhtml' id='xpaul' media-type='application/xhtml+xml' />
<item href='rear-9-map-world.xhtml' id='xworld' media-type='application/xhtml+xml' />
<item href='images/COVER.jpg' id='cover' media-type='image/jpeg' properties='cover-image' />
<item href='images/BOOK-Life-Time-Entirety-A-Study-of-AION-Heleen-Keizer.jpg' id='img_book_keizer' media-type='image/jpeg' />
<item href='images/BOOK-Terms-for-Eternity-Aionios-and-Aidios-in-Classical-and-Christian-Texts-Ramelli-Konstan.jpg' id='img_book_ramelli' media-type='image/jpeg' />
<item href='images/DORE-NEW.jpg' id='img_dore_new' media-type='image/jpeg' />
<item href='images/DORE-OLD.jpg' id='img_dore_old' media-type='image/jpeg' />
<item href='images/DORE-REV.jpg' id='img_dore_rev' media-type='image/jpeg' />
<item href='images/HISTORY-FUTURE.jpg' id='img_future' media-type='image/jpeg' />
<item href='images/HISTORY-PAST.jpg' id='img_past' media-type='image/jpeg' />
<item href='images/LOGO.jpg' id='img_logo' media-type='image/jpeg' />
<item href='images/MAP-ABRAHAM.jpg' id='img_abraham' media-type='image/jpeg' />
<item href='images/MAP-EXODUS.jpg' id='img_exodus' media-type='image/jpeg' />
<item href='images/MAP-JESUS.jpg' id='img_jesus' media-type='image/jpeg' />
<item href='images/MAP-PAUL.jpg' id='img_paul' media-type='image/jpeg' />
<item href='images/MAP-WORLD.jpg' id='img_world' media-type='image/jpeg' />
<item href='images/Aionian-Bible-Facebook.png' id='img_facebook' media-type='image/png' />
<item href='images/Aionian-Bible-Twitter.png' id='img_twitter' media-type='image/png' />
<item href='images/Aionian-Bible-LinkedIn.png' id='img_linkedin' media-type='image/png' />
<item href='images/Aionian-Bible-Instagram.png' id='img_instagram' media-type='image/png' />
<item href='images/Aionian-Bible-Pinterest.png' id='img_pinterest' media-type='image/png' />
<item href='images/Aionian-Bible-Youtube.png' id='img_youtube' media-type='image/png' />
<item href='images/Aionian-Bible-GooglePlay.png' id='img_googleplay' media-type='image/png' />
<item href='images/Aionian-Bible-TOR.png' id='img_tor' media-type='image/png' />
<item href='images/Aionian-Bible-Button-Buy-Square.png' id='img_buy' media-type='image/png' />
<item href='images/Aionian-Bible-Button-Your-Gift-Email-Newsletter-Home.png' id='img_emailnews' media-type='image/png' />
$opf_manifest
</manifest>
<spine toc="epub_ncx">
<itemref idref='xcover' linear='yes' />
<itemref idref='xcopyright' linear='yes' />
<itemref idref='xpreface' linear='yes' />
<itemref idref='xaionian' linear='yes' />
<itemref idref='xindex' linear='yes' />
$opf_spine_old$opf_spine_new<itemref idref='xreaders' linear='yes' />
<itemref idref='xhistory' linear='yes' />
<itemref idref='xglossary' linear='yes' />
<itemref idref='xpast' linear='yes' />
<itemref idref='xfuture' linear='yes' />
<itemref idref='xdestiny' linear='yes' />
<itemref idref='xabraham' linear='yes' />
<itemref idref='xexodus' linear='yes' />
<itemref idref='xjesus' linear='yes' />
<itemref idref='xpaul' linear='yes' />
<itemref idref='xworld' linear='yes' />
</spine>
<guide>
<reference type="cover" title="Cover" href="front-1-cover.xhtml" />
<reference type="toc" title="Table of Contents" href="index.xhtml" />
<reference type="text" title="Preface" href="front-3-preface.xhtml" />
</guide>
</package>
EOF;
if (file_put_contents($file, $contents) === FALSE) { AION_ECHO("ERROR! AION_FILE_DATA_PUT file_put_contents($file)"); }
return;
}



// CREATE epub-toc.ncx
function AION_EPUBY_EPUB_NCX($folder, $ncx_old, $ncx_new) {
global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
$co = substr_count($ncx_old, "\n");
$cn = substr_count($ncx_new, "\n");
$ncx_old = (empty($ncx_old) ? NULL : "<navPoint id='nav6' playOrder='6' ><navLabel><text>Genesis</text> </navLabel><content src='middle-gen.xhtml' /></navPoint>\n".$ncx_old);
// 6 if no OT -OR- if OT then OT count + 7
$cnB = (empty($ncx_old) ? 6 : $co + 7);
$ncx_new = (empty($ncx_new) ? NULL : "<navPoint id='nav$cnB' playOrder='$cnB' ><navLabel><text>Matthew</text></navLabel><content src='middle-mat.xhtml' /></navPoint>\n".$ncx_new);
// 6 if no OT/NT -OR- if OT and no NT then OT count + 7 -OR- if NT and no OT then NT count + 7 -OR- if OT/NT then all counts + 8
$cnE = (empty($ncx_old) && empty($ncx_new) ? 6 : (empty($ncx_new) ? $co + 7 : (empty($ncx_old) ? $cn + 7 : $co + $cn + 8)));
$ncx_new = (empty($ncx_new) ? NULL : $ncx_new."<navPoint id='nav$cnE' playOrder='$cnE' ><navLabel><text>Revelation</text></navLabel><content src='middle-rev.xhtml' /></navPoint>\n");
$cnE += (empty($ncx_new) ? 0 : 1);
$ff = "trim";
$file = "$folder/toc.ncx";
$contents = <<< EOF
<?xml version="1.0" encoding="utf-8"?>
$G_COMMENT
<ncx xmlns="http://www.daisy.org/z3986/2005/ncx/" version="2005-1">
<head>
<meta name="dtb:uid" content="urn:uuid:$G_UUID" />
<meta name="dtb:depth" content="1" />
<meta name="dtb:totalPageCount" content="0" />
<meta name="dtb:maxPageNumber" content="0" />
</head>
<docTitle><text>$G_TITLE</text></docTitle>
<docAuthor><text>Nainoia Inc, CC-BY-ND 4.0</text></docAuthor>
<navMap>
<navPoint id='nav1' playOrder='1'><navLabel><text>Cover</text></navLabel><content src='front-1-cover.xhtml' /></navPoint>
<navPoint id='nav2' playOrder='2'><navLabel><text>Copyright</text></navLabel><content src='front-2-copyright.xhtml' /></navPoint>
<navPoint id='nav3' playOrder='3'><navLabel><text>Preface</text></navLabel><content src='front-3-preface.xhtml' /></navPoint>
<navPoint id='nav4' playOrder='4'><navLabel><text>Aiōnios and Aïdios</text></navLabel><content src='front-4-aionian.xhtml' /></navPoint>
<navPoint id='nav5' playOrder='5'><navLabel><text>Table of Contents</text></navLabel><content src='index.xhtml' /></navPoint>
$ncx_old$ncx_new<navPoint id='nav{$ff($cnE+0)}' playOrder='{$ff($cnE+0)}'><navLabel><text>Reader's Guide</text></navLabel><content src='rear-1-readers-guide.xhtml' /></navPoint>
<navPoint id='nav{$ff($cnE+1)}' playOrder='{$ff($cnE+1)}'><navLabel><text>Project History</text></navLabel><content src='rear-1b-project-history.xhtml' /></navPoint>
<navPoint id='nav{$ff($cnE+2)}' playOrder='{$ff($cnE+2)}'><navLabel><text>Glossary</text></navLabel><content src='rear-2-glossary.xhtml' /></navPoint>
<navPoint id='nav{$ff($cnE+3)}' playOrder='{$ff($cnE+3)}'><navLabel><text>History Past</text></navLabel><content src='rear-3-history-past.xhtml' /></navPoint>
<navPoint id='nav{$ff($cnE+4)}' playOrder='{$ff($cnE+4)}'><navLabel><text>History Future</text></navLabel><content src='rear-4-history-future.xhtml' /></navPoint>
<navPoint id='nav{$ff($cnE+5)}' playOrder='{$ff($cnE+5)}'><navLabel><text>Destiny</text></navLabel><content src='rear-5-history-destiny.xhtml' /></navPoint>
<navPoint id='nav{$ff($cnE+6)}' playOrder='{$ff($cnE+6)}'><navLabel><text>Abraham</text></navLabel><content src='rear-5-map-abraham.xhtml' /></navPoint>
<navPoint id='nav{$ff($cnE+7)}' playOrder='{$ff($cnE+7)}'><navLabel><text>Exodus</text></navLabel><content src='rear-6-map-exodus.xhtml' /></navPoint>
<navPoint id='nav{$ff($cnE+8)}' playOrder='{$ff($cnE+8)}'><navLabel><text>Jesus</text></navLabel><content src='rear-7-map-jesus.xhtml' /></navPoint>
<navPoint id='nav{$ff($cnE+9)}' playOrder='{$ff($cnE+9)}'><navLabel><text>Paul</text></navLabel><content src='rear-8-map-paul.xhtml' /></navPoint>
<navPoint id='nav{$ff($cnE+10)}' playOrder='{$ff($cnE+10)}'><navLabel><text>World</text></navLabel><content src='rear-9-map-world.xhtml' /></navPoint>
</navMap>
</ncx>
EOF;
if (file_put_contents($file, $contents) === FALSE) { AION_ECHO("ERROR! AION_FILE_DATA_PUT file_put_contents($file)"); }
return;
}



// CREATE front-2-copyright.xhtml
function AION_EPUBY_FRONT_2_COPYRIGHT_XHTML($folder, $css) {
global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
$j316 = $G_FORPRINT['JOH3_16'];
$versionFO_CP = ($G_VERSIONS['NAME']==$G_VERSIONS['NAMEENGLISH'] ? '' : "<h3 class='center ff' $css>".$G_VERSIONS['NAME']."</h3>");
$versionEN_CP = "<h3 class='center'>".$G_VERSIONS['NAMEENGLISH']."</h3>";
$versionCC_CP = "Copyright: ".
 (empty($G_VERSIONS['ABCOPYRIGHT']) ? ("<a href='https://creativecommons.org/licenses/by/4.0/' target='_target'>Creative Commons Attribution 4.0 International, 2018-".date("Y")."</a>") :
 ((FALSE!==stripos($G_VERSIONS['ABCOPYRIGHT'],"Creative Commons Attribution 4.0 International")) ? ("<a href='https://creativecommons.org/licenses/by/4.0/' target='_blank'>".$G_VERSIONS['ABCOPYRIGHT']."</a>") :
 $G_VERSIONS['ABCOPYRIGHT']))."<br />";
$langlink = "<a href='https://en.wikipedia.org/wiki/ISO_639:".$G_VERSIONS['LANGUAGECODE']."' target='_blank' title='Ethnologue language description'>".$G_VERSIONS['LANGUAGECODE']."</a>";
$versionLA_CP = "Language: ".$G_VERSIONS['LANGUAGEENGLISH'].($G_VERSIONS['LANGUAGEENGLISH']==$G_VERSIONS['LANGUAGE'] ? "<br />" : " [ <span $css>".$G_VERSIONS['LANGUAGE']."</span> ] $langlink<br />");
$versionLO_CP = (empty($G_VERSIONS['COUNTRY']) ? "" : "Locations: ".$G_VERSIONS['COUNTRY']."<br />");
$versionDE_CP = (empty($G_VERSIONS['DESCRIPTION']) ? "" : "<br />".$G_VERSIONS['DESCRIPTION']."<br />");
$versionSS_CP  = "Source: ".$G_VERSIONS['SOURCE'].(empty($G_VERSIONS['YEAR']) ? "" : ", ".$G_VERSIONS['YEAR'])."<br />";
$versionSS_CP .= "Source copyright: ".$G_VERSIONS['COPYRIGHT']."<br />";
$versionSS_CP .= $G_VERSIONS['SOURCEVERSION'];
$versionSS_CP .= "Source text: <a href='".$G_VERSIONS['SOURCELINK']."' target='_blank' title='Download Source File'>".$G_VERSIONS['SOURCELINK']."</a><br />";
$onlinelink = "https://www.AionianBible.org/Bibles/".str_replace("Holy-Bible---","",$G_VERSIONS['BIBLE']);
$onionlink = "https://www.AionianBible.org/TOR/Bibles/".str_replace("Holy-Bible---","",$G_VERSIONS['BIBLE']);
$epublink = "https://resources.AionianBible.org/".$G_VERSIONS['BIBLE']."---Aionian-Edition.epub";
$pdflink = "https://resources.AionianBible.org/".$G_VERSIONS['BIBLE']."---Aionian-Edition.pdf";
$studylink = "https://resources.AionianBible.org/".$G_VERSIONS['BIBLE']."---Aionian-Edition---STUDY.pdf";
$datalink = "https://resources.AionianBible.org/".$G_VERSIONS['BIBLE']."---Aionian-Edition.noia";
$everythinglink = "https://resources.AionianBible.org";
$rundate = date("n/j/Y");
if (NULL===($extension_text=preg_replace("#<[^<>]*>#ui"," ",trim($G_FORPRINT['EXTENSION'])))) { AION_ECHO("ERROR! preg_replace(<>)".$G_FORPRINT['BIBLE']." ".$G_FORPRINT['EXTENSION']); }
$extension_text = (empty($extension_text) ? "" : "\nAdditional Information:<br /><br />$extension_text");
$file = "$folder/front-2-copyright.xhtml";
$contents = <<< EOF
<?xml version="1.0" encoding="utf-8"?>
$G_COMMENT
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops">
<head>
<meta charset="utf-8" />
<meta name='viewport' content='width=device-width,initial-scale=1'/>
<title>$G_TITLE</title>
<link href='epub.css' rel='stylesheet' />
</head>
<body>
<img src="./images/LOGO.jpg" alt="Holy Bible Aionian Edition" class='simple' />
$versionEN_CP
$versionFO_CP
$j316<br />
<br />
The world’s first Holy Bible untranslation<br />
Also known as the Purple Bible<br />
100% Free to Copy and Print at <a href='https://www.AionianBible.org' target='_blank' title='Holy Bible Aionian Edition online'>AionianBible.org</a><br />
<a href='https://www.AionianBible.org/Buy' target='_blank' title='Holy Bible Aionian Edition hardcopy print at Amazon and Lulu'>Buy hardcopy print format</a><br />
All profits are given to <a href='https://CoolCup.org' target='_blank' title='Cool Cup of Water Project'>CoolCup.org</a><br /> 
<br />
Publisher: Nainoia Inc<br />
$versionCC_CP
$versionLA_CP
$versionLO_CP
Formatted: ABCMS on $rundate<br />
Online: <a href='$onlinelink' target='_blank' title='Read online'>Read</a> and <a href='$onionlink' target='_blank' title='Read TOR anonymously'>TOR Anonymously</a><br />
Download: 
<a href='$epublink' target='_blank' title='Download this ePub'>This ePub</a>, 
<a href='$pdflink' target='_blank' title='Download PDF'>PDF</a>, 
<a href='$studylink' target='_blank' title='Download Study PDF'>Study PDF</a>, 
<a href='$datalink' target='_blank' title='Download Data File'>Data File</a>, and 
<a href='$everythinglink' target='_blank' title='Download Everything'>Everything</a><br />
$versionDE_CP
<br />
$versionSS_CP
<br />
We pray for a modern public domain translation in every language. Report concerns to <a href='https://nainoia-inc.signedon.net/' target='_blank' title='Publisher of the Holy Bible Aionian Edition'>Nainoia Inc</a>. Volunteer help appreciated! Given to our family, friends, and fellowman for Christ’s victory of grace!<br />
<br />$extension_text
<p><a href='index.xhtml' title='Table of Contents'>TOC</a></p>
</body>
</html>
EOF;
if (file_put_contents($file, $contents) === FALSE) { AION_ECHO("ERROR! AION_FILE_DATA_PUT file_put_contents($file)"); }
return;
}



// CREATE front-3-preface.xhtml
function AION_EPUBY_FRONT_3_PREFACE_XHTML($folder) {
global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
$W_PREF = $G_FORPRINT['W_PREF'];
$languagehtml = $G_VERSIONS['LANGUAGEHTML'];
$epublink = "https://resources.AionianBible.org/".$G_VERSIONS['BIBLE']."---Aionian-Edition.epub";
$links = AION_EPUBY_LINKS();
$file = "$folder/front-3-preface.xhtml";
$contents = <<< EOF
<?xml version="1.0" encoding="utf-8"?>
$G_COMMENT
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops">
<head>
<meta charset="utf-8" />
<meta name='viewport' content='width=device-width,initial-scale=1'/>
<title>$G_TITLE</title>
<link href='epub.css' rel='stylesheet' />
</head>
<body>
<h2 class='title'>$W_PREF</h2>
<p class='center'>$languagehtml<a href='https://www.AionianBible.org/Preface' target='_blank'>www.AionianBible.org/Preface</a></p>
<p>The <i>Holy Bible Aionian Edition®</i> is the world’s first Bible <i>un-translation</i>! What is an <i>un-translation</i>? Bibles are translated into each of our languages from the original Hebrew, Aramaic, and Koine Greek. Occasionally, the best word translation cannot be found and these words are transliterated letter by letter. Four well known transliterations are <i>Christ</i>, <i>baptism</i>, <i>angel</i>, and <i>apostle</i>. The meaning is then preserved more accurately through context and a dictionary. The Aionian Bible un-translates and instead transliterates eleven additional <a href='rear-2-glossary.xhtml' title='Aionian Glossary'>Aionian Glossary</a> words to help us better understand God’s love for individuals and all mankind, and the nature of afterlife destinies.</p>

<p>The first three words are <a href='rear-2-glossary.xhtml#g165' title='Aionian Glossary g165'><i>aiōn</i></a>, <a href='rear-2-glossary.xhtml#g166' title='Aionian Glossary g166'><i>aiōnios</i></a>, and <a href='rear-2-glossary.xhtml#g126' title='Aionian Glossary g126'><i>aïdios</i></a>, typically translated as <i>eternal</i> and also <i>world</i> or <i>eon</i>. The Aionian Bible is named after an alternative spelling of <i>aiōnios</i>. Consider that researchers question if <i>aiōn</i> and <i>aiōnios</i> actually mean <i>eternal</i>. Translating <i>aiōn</i> as <i>eternal</i> in {$links->X_MAT_28} makes no sense, as all agree. The Greek word for eternal is <i>aïdios</i>, used in {$links->X_ROM_1} about God and in {$links->X_JUD_1} about demon imprisonment. Yet what about <i>aiōnios</i> in {$links->X_JOH_3}? Certainly we do not question whether salvation is eternal! However, <i>aiōnios</i> means something much more wonderful than infinite time! Ancient Greeks used <i>aiōn</i> to mean eon or age. They also used the adjective <i>aiōnios</i> to mean entirety, such as <i>complete</i> or even <i>consummate</i>, but never infinite time. Read <a href='front-4-aionian.xhtml' title='Book abstracts of Dr. Heleen Keizer and Ramelli and Konstan'>Dr. Heleen Keizer and Ramelli and Konstan</a> for proofs. So <i>aiōnios</i> is the perfect description of God's Word which has <i>everything</i> we need for life and godliness! And the <i>aiōnios</i> life promised in {$links->X_JOH_3} is not simply a ticket to eternal life in the future, but the invitation through faith to the <i>consummate</i> life beginning now! <i>Aiōnios</i> life with Christ is <a href='https://www.aionianbible.org/Buy' target='_blank' title='Purchase Better Than Forever T-Shirts'><i>Better than Forever</i></a>.</p>

<p>The next seven words are <a href='rear-2-glossary.xhtml#h7585' title='Aionian Glossary h7585'><i>Sheol</i></a>, <a href='rear-2-glossary.xhtml#g86' title='Aionian Glossary g86'><i>Hadēs</i></a>, <a href='rear-2-glossary.xhtml#g1067' title='Aionian Glossary g1067'><i>Geenna</i></a>, <a href='rear-2-glossary.xhtml#g5020' title='Aionian Glossary g5020'><i>Tartaroō</i></a>, <a href='rear-2-glossary.xhtml#g12' title='Aionian Glossary g12'><i>Abyssos</i></a>, and <a href='rear-2-glossary.xhtml#g3041' title='Aionian Glossary g3041 g4442'><i>Limnē Pyr</i></a>. These words are often translated as <i>Hell</i>, the place of eternal punishment. However, <i>Hell</i> is ill-defined when compared with the Hebrew and Greek. For example, <i>Sheol</i> is the abode of deceased believers and unbelievers and should never be translated as <i>Hell</i>. <i>Hadēs</i> is a temporary place of punishment, {$links->X_REV_20}. <i>Geenna</i> is the Valley of Hinnom, Jerusalem's refuse dump, a temporal judgment for sin. <i>Tartaroō</i> is a prison for demons, mentioned once in {$links->X_2PE_2}. <i>Abyssos</i> is a temporary prison for the Beast and Satan. Translators are also inconsistent because <i>Hell</i> is used by the <a href='https://www.kingjamesbibleonline.org/' title='View the King James Version Bible' target='_blank'>King James Version</a> fifty-four times, the <a href='https://www.thenivbible.com/' target='_blank' title='View the New International Version Bible'>New International Version</a> fourteen times, and the <a href='https://ebible.org/web/' title='View the World English Bible' target='_blank'>World English Bible</a> zero times. Finally, <i>Limnē Pyr</i> is the Lake of Fire, yet {$links->X_MAT_25} explains that these fires are <a href='rear-5-history-destiny.xhtml' title='Matthew 25:41 and the Lake of Fire'>prepared for the Devil and his angels</a>. So there is reason to review our conclusions about the destinies of redeemed mankind and fallen angels.</p>

<p>The eleventh word, <a href='rear-2-glossary.xhtml#g1653' title='Aionian Glossary g1653'><i>eleēsē</i></a>, reveals the grand conclusion of grace in {$links->X_ROM_11}. Please understand these eleven words. The original translation is unaltered and a highlighted note is added to 64 Old Testament and 200 New Testament verses. Also to help parallel study and Strong's Concordance use, apocryphal text is removed and most variant verse numbering is mapped to the English standard. The Aionian Bible republishes public domain and Creative Common Bible texts. We thank our sources at <a href='https://ebible.org' target='_blank' title='Visit eBible.org, a DBA of Wycliffe, Inc, founded by Michael Paul Johnson'>eBible.org</a>, <a href='https://crosswire.org' target='_blank' title='Visit the Crosswire Bible Society'>Crosswire.org</a>, <a href='https://unbound.biola.edu' target='_blank' title='Visit the Biola University Unbound Bible Project'>unbound.Biola.edu</a>, <a href='https://bible4u.net/' target='_blank' title='Bible4U Uncensored Bible'>Bible4U.net</a>, and <a href='https://NHEB.net' target='_blank' title='Visit the New Heart English Bible'>NHEB.net</a>. The Aionian Bible is copyrighted with the <a href='https://creativecommons.org/licenses/by/4.0' target='_blank' title='Visit Copyright definition'>Creative Commons Attribution 4.0 International</a> license, allowing 100% freedom to copy and print, if respecting source text copyrights. Review the <a href='rear-1-readers-guide.xhtml' title='Readers guide for the Aionian Bible'>Reader's Guide</a>, <a href='rear-1b-project-history.xhtml' title='Project history for the Aionian Bible'>Project History</a>, <a href='rear-5-map-abraham.xhtml' title='Maps and Illustations'>Maps</a>, and <a href='rear-3-history-past.xhtml' title='Timelines and Illustations'>Timelines</a>. Read <a href='https://www.aionianbible.org' title='Read and Study Bible'>online</a> with the <a href='https://www.aionianbible.org/Google-Play' target='_blank' title='Aionian Bible free online at Google Play'>Android</a> and <a href='https://www.aionianbible.org/AppleApp' title='iPhone Apple App' target='_blank'>Apple App</a>, also the <a href='https://www.aionianbible.org/TOR' target='_blank' title='TOR Network'>TOR Network</a>, and buy Bibles at <a href='https://www.aionianbible.org/Buy' title='Holy Bible Aionian Edition at Amazon.com and Lulu.com' target='_blank'>Amazon.com and Lulu.com</a>.Follow at <a href='https://www.AionianBible.org/Facebook' target='_blank' title='Visit the Aionian Bible on Facebook'>Facebook/AionianBible</a>, help <a href='https://www.AionianBible.org/Promote' target='_blank' title='Promote, Sponsor, Advertise, Market'>Promote</a> and <a href='https://www.AionianBible.org/Third-Party-Publisher-Resources' target='_blank' title='Third Party Publisher Resources'>Publish</a>, review the <a href='https://www.AionianBible.org/Privacy' target='_blank' title='Privacy Policy'>Privacy Policy</a>, and contact the  <a href='https://www.AionianBible.org/Publisher' target='_blank' title='Contact Nainoia, Inc'>Publisher</a>.  The <a href='https://www.AionianBible.org/Bibles/English---Aionian-Bible' target='_blank' title='Holy Bible Aionian Edition: Aionian Bible'><span class='notranslate'>Aionian</span>  Bible</a> is the recommended English translation. All profits are given to <a href='https://CoolCup.org' target='_blank' title='Cool Cup of Water Project'>CoolCup.org</a>.</p>

<p>Why purple? King Jesus’ Word is royal and purple is the color of royalty!</p>

<p class='social'>
<a href='https://www.aionianbible.org/Facebook'		target='_blank' title='Facebook/AionianBible'>	<img src='images/Aionian-Bible-Facebook.png'	alt='Facebook'	title='Aionian Bible on Facebook' /></a>
<a href='https://www.aionianbible.org/Twitter'		target='_blank' title='Twitter/AionianBible'>	<img src='images/Aionian-Bible-Twitter.png'		alt='Twitter'	title='Aionian Bible on Twitter' /></a>
<a href='https://www.aionianbible.org/LinkedIn'		target='_blank' title='LinkedIn/AionianBible'>	<img src='images/Aionian-Bible-LinkedIn.png'	alt='LinkedIn'	title='Aionian Bible on LinkedIn' /></a>
<a href='https://www.aionianbible.org/Instagram'	target='_blank' title='Instagram/AionianBible'>	<img src='images/Aionian-Bible-Instagram.png'	alt='Instagram'	title='Aionian Bible on Instagram' /></a>
<a href='https://www.aionianbible.org/Pinterest'	target='_blank' title='Pinterest/AionianBible'>	<img src='images/Aionian-Bible-Pinterest.png'	alt='Pinterest'	title='Aionian Bible on Pinterest' /></a>
<a href='https://www.aionianbible.org/YouTube'		target='_blank' title='YouTube/AionianBible'>	<img src='images/Aionian-Bible-Youtube.png'		alt='YouTube'	title='Aionian Bible on Youtube' /></a>
<a href='https://www.aionianbible.org/Google-Play'	target='_blank' title='GooglePlay/AionianBible'><img src='images/Aionian-Bible-GooglePlay.png'	alt='GooglePlay' title='Aionian Bible on GooglePlay' /></a>
<a href='https://www.aionianbible.org/TOR'			target='_blank' title='TOR/AionianBible'>		<img src='images/Aionian-Bible-TOR.png'			alt='TOR'		title='Aionian Bible on The Onion Router network' /></a>
<a href='https://www.aionianbible.org/EmailNews'	target='_blank'	title='EmailNews/AionianBible'><img src='images/Aionian-Bible-Button-Your-Gift-Email-Newsletter-Home.png' alt='EmailNews' title='Aionian Bible Gift and Newsletter' /></a>
<a href='https://www.aionianbible.org/Buy'			target='_blank' title='Buy Aionian Bibles and T-Shirts'><img src='images/Aionian-Bible-Button-Buy-Square.png' alt='Buy Bibles' title='Buy Aionian Bible in print' /></a><br />
</p>

<p><a href='index.xhtml' title='Table of Contents'>TOC</a> / <a href='$epublink' target='_blank' title='Download this ePub'>Download this ePub!</a></p>
</body>
</html>
EOF;
if (file_put_contents($file, $contents) === FALSE) { AION_ECHO("ERROR! AION_FILE_DATA_PUT file_put_contents($file)"); }
return;
}


// CREATE front-4-aionian.xhtml
function AION_EPUBY_FRONT_4_AIONIAN_XHTML($folder) {
global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
$languagehtml = $G_VERSIONS['LANGUAGEHTML'];
$file = "$folder/front-4-aionian.xhtml";
$contents = <<< EOF
<?xml version="1.0" encoding="utf-8"?>
$G_COMMENT
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops">
<head>
<meta charset="utf-8" />
<meta name='viewport' content='width=device-width,initial-scale=1'/>
<title>$G_TITLE</title>
<link href='epub.css' rel='stylesheet' />
</head>
<body>
<h2 class="title">Aiōnios and Aïdios</h2>
<p class='center'>$languagehtml<a href='https://www.AionianBible.org/Aionios-and-Aidios' target='_blank'>www.AionianBible.org/Aionios-and-Aidios</a></p>
<p><img src="images/BOOK-Life-Time-Entirety-A-Study-of-AION-Heleen-Keizer.jpg" alt="Life Time Entirety, A Study of AION by Heleen Keizer" class='pix' />Dr. Heleen Keizer wrote <b><i>Life Time Entirety</i></b> to explain the meaning of the Greek word aiōn. She begins, "<i>The Greek word aiōn has a wide ranging meaning as well as a wide ranging history: it is most commonly translated as ‘eternity’ but has as its first meaning ‘life’ or ‘lifetime’; it has its place in Greek literature and philosophy, but also in the Greek Bible, where it represents the Hebrew word ‘olâm.</i>" Her 315 page PhD dissertation shows that the Greek word aiōn originally denotes life time, duration, or complete life, but not eternal. You can read her <a href='https://www.aionianbible.org/Life-Time-Entirety-Keizer' target='_blank' title='Visit Dr. Keizers dissertation online'>dissertation online</a> or an <a href='https://www.aionianbible.org/Life-Time-Entirety-Keizer-Abstract' target='_blank' title='View an abstract of Dr. Keizers dissertation'>abstract of her conclusions here</a>.</p>

<p><img src="images/BOOK-Terms-for-Eternity-Aionios-and-Aidios-in-Classical-and-Christian-Texts-Ramelli-Konstan.jpg" alt="Terms for Eternity Aionios and Aidios in Classical and Christian Texts by Ramelli and Konstan" class='pix' />Ilaria Ramelli and David Konstan wrote <b><i>Terms for Eternity: Aionios and Aidios in Classical and Christian Texts</i></b>, <a href='https://www.aionianbible.org/Terms-for-Eternity-Ramelli-Konstan' target='_blank' title='Purchase Ramelli and Konstan at Amazon.com'>available at Amazon</a>. This highly technical volume quotes hundreds of sources from classical literature, the Septuagint, early church fathers, and church fathers after Origen to determine the meaning and usage of <i>Aiōnios</i> and <i>Aïdios</i>.  They conclude that <i>Aïdios</i> nearly always means eternal in the absolute sense.  <i>Aïdios</i> is used twice in the Bible: Romans 1:20 concerning God and Jude 6 concerning the bonds on fallen angels.  <i>Aiōnios</i>, however, has a range of meanings including life, age, generation, and eon.  They argue that <i>Aiōnios</i> can also mean eternal, but only when God is the subject.  Ramelli and Konstan concur with Keizer and conclude saying, "<i>Needless to say, the ethical implications of this question are profound.</i>"</p>

<p>Every quest for the truth must have the wisdom to eliminate what we prefer to be true and also the courage to eliminate what we fear to be true in order to discover what Christ says is actually true.</p>

<p><a href='index.xhtml' title='Table of Contents'>TOC</a></p>
</body>
</html>
EOF;
if (file_put_contents($file, $contents) === FALSE) { AION_ECHO("ERROR! AION_FILE_DATA_PUT file_put_contents($file)"); }
return;
}


// CREATE index.xhtml
function AION_EPUBY_FRONT_INDEX_XHTML($folder, $index_old, $index_new) {
global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
$W_PREF = $G_FORPRINT['W_PREF'];
$W_TOC	= $G_FORPRINT['W_TOC'];
$W_OLD	= $G_FORPRINT['W_OLD'];
$W_NEW	= $G_FORPRINT['W_NEW'];
$W_APDX	= $G_FORPRINT['W_APDX'];
$W_READ	= $G_FORPRINT['W_READ'];
$W_GLOS	= $G_FORPRINT['W_GLOS'];
$W_DESTINY = $G_FORPRINT['W_DESTINY'];
$intro_old = (empty($index_old) ? "" : "<li class='olhed'><a href='middle-gen.xhtml' title='View Old Testament'>$W_OLD</a></li>\n");
$intro_new = (empty($index_new) ? "" : "<li class='olhed'><a href='middle-mat.xhtml' title='View New Testament'>$W_NEW</a></li>\n");
$outro_new = (empty($index_new) ? "" : "<li class='olhed'><a href='middle-rev.xhtml' title='View New Testament conclusion'>New Jerusalem</a></li>\n");
$beginning = (empty($index_old) ? "middle-mat.xhtml" : "middle-gen.xhtml");
$file = "$folder/index.xhtml";
$contents = <<< EOF
<?xml version="1.0" encoding="utf-8"?>
$G_COMMENT
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops">
<head>
 <meta charset="utf-8" />
 <meta name='viewport' content='width=device-width,initial-scale=1'/>
 <title>$G_TITLE</title>
 <link href='epub.css' rel='stylesheet' />
</head>
<body>
<h2 class="title">$W_TOC</h2>
<nav epub:type="toc" id="toc">
<ol class='nav'>
<li class='olnop'><a href='front-1-cover.xhtml' title='View Cover'>Cover</a></li>
<li class='olbeg' value='1'><a href='front-2-copyright.xhtml' title='View Copyright'>Copyright</a></li>
<li class='olbeg'><a href='front-3-preface.xhtml' title='View Preface'>$W_PREF</a></li>
<li class='olbeg'><a href='front-4-aionian.xhtml' title='View explanation of Aiōnios and Aïdios'>Aiōnios and Aïdios</a></li>
<li class='oltoc'><a href='index.xhtml' title='Table of Contents'>$W_TOC</a></li>
$intro_old$index_old$intro_new$index_new$outro_new<li class='olend' value='1'><a href='rear-1-readers-guide.xhtml' title='View Readers Guide'>$W_READ</a></li>
<li class='olend'><a href='rear-1b-project-history.xhtml' title='Project History'>Project History</a></li>
<li class='olend'><a href='rear-2-glossary.xhtml' title='View Aionian Glossary'>$W_GLOS</a></li>
<li class='olinA'><a href='rear-3-history-past.xhtml' title='View chart of history past'>History Past</a></li>
<li class='oline'><a href='rear-4-history-future.xhtml' title='View chart of history future'>History Future</a></li>
<li class='oline'><a href='rear-5-history-destiny.xhtml' title='View explanation of mankinds destiny'>$W_DESTINY</a></li>
<li class='olinA' value='4'><a href='rear-5-map-abraham.xhtml' title='View map of Abrahams Journeys'>Abraham's Journeys</a></li>
<li class='oline'><a href='rear-6-map-exodus.xhtml' title='View map of Israels Exodus'>Israel's Exodus</a></li>
<li class='oline'><a href='rear-7-map-jesus.xhtml' title='View map of Jesus Journeys'>Jesus' Journeys</a></li>
<li class='oline'><a href='rear-8-map-paul.xhtml' title='View map of Pauls Missionary Journeys'>Paul's Missionary Journeys</a></li>
<li class='oline'><a href='rear-9-map-world.xhtml' title='View map of World Nations'>World Nations</a></li>
</ol>
</nav>
<nav epub:type='landmarks' class='hidden' hidden='hidden'>
<h2>Guide</h2>
<ol>
<li><a epub:type='cover' href='front-1-cover.xhtml'>Cover</a></li>
<li><a epub:type='frontmatter' href='front-2-copyright.xhtml'>Copyright</a></li>
<li><a epub:type='toc' href='#toc'>$W_TOC</a></li>
<li><a epub:type='preface' href='front-3-preface.xhtml'>$W_PREF</a></li>
<li><a epub:type='bodymatter' href='$beginning'>Bible</a></li>
<li><a epub:type='loi' href='rear-1-readers-guide.xhtml'>$W_APDX</a></li>
<li><a epub:type='glossary' href='rear-2-glossary.xhtml'>$W_GLOS</a></li>
</ol>
</nav>
</body>
</html>
EOF;
if (file_put_contents($file, $contents) === FALSE) { AION_ECHO("ERROR! AION_FILE_DATA_PUT file_put_contents($file)"); }
return;
}



// CREATE rear-1-readers-guide.xhtml
function AION_EPUBY_REAR_1_READERS_GUIDE_XHTML($folder) {
global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
$W_READ = $G_FORPRINT['W_READ'];
$languagehtml = $G_VERSIONS['LANGUAGEHTML'];
$links = AION_EPUBY_LINKS();
$file = "$folder/rear-1-readers-guide.xhtml";
$contents = <<< EOF
<?xml version="1.0" encoding="utf-8"?>
$G_COMMENT
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops">
<head>
<meta charset="utf-8" />
<meta name='viewport' content='width=device-width,initial-scale=1'/>
<title>$G_TITLE</title>
<link href='epub.css' rel='stylesheet' />
</head>
<body>
<h2 class='title'>$W_READ</h2>
<p class='center'>$languagehtml<a href='https://www.AionianBible.org/Readers-Guide' target='_blank'>www.AionianBible.org/Readers-Guide</a></p>

<p>The Aionian Bible republishes public domain and Creative Common Bible texts that are 100% free to copy and print. The original translation is unaltered and notes are added to help your study. The notes show the location of eleven special Greek and Hebrew <a href='rear-2-glossary.xhtml' title='Aionian Glossary'>Aionian Glossary</a> words to help us better understand God’s love for individuals and for all mankind, and the nature of afterlife destinies.</p>

<p>Who has the authority to interpret the Bible and examine the underlying Hebrew and Greek words? That is a good question! We read in {$links->X_1JO_2}, <i>"As for you, the anointing which you received from him remains in you, and you do not need for anyone to teach you. But as his anointing teaches you concerning all things, and is true, and is no lie, and even as it taught you, you remain in him."</i> Every Christian is qualified to interpret the Bible! Now that does not mean we will all agree. Each of us is still growing in our understanding of the truth. However, it does mean that there is no infallible human or tradition to answer all our questions. Instead the Holy Spirit helps each of us to know the truth and grow closer to God and each other.</p>

<p>The Bible is a library with 66 books in the Protestant Canon. The best way to learn God’s word is to read entire books. Read the book of {$links->X_GEN_1}. Read the book of {$links->X_JOH_1}. Read the entire Bible library. Topical studies and cross-referencing can be good. However, the safest way to understand context and meaning is to read whole Bible books. Chapter and verse numbers were added for convenience in the 16th century, but unfortunately they can cause the Bible to seem like an encyclopedia. The Aionian Bible is formatted with simple verse numbering, minimal notes, and no cross-referencing in order to encourage the reading of Bible books.</p>
<p>Bible reading must also begin with prayer. Any Christian is qualified to interpret the Bible with God’s help. However, this freedom is also a responsibility because without the Holy Spirit we cannot interpret accurately. We read in {$links->X_1CO_2}, <i>"And we speak of these things, not with words taught by human wisdom, but with those taught by the Spirit, comparing spiritual things with spiritual things. Now the natural person does not receive the things of the Spirit of God, for they are foolishness to him, and he cannot understand them, because they are spiritually discerned."</i> So we cannot understand in our natural self, but we can with God’s help through prayer.</p>

<p>The Holy Spirit is the best writer and he uses literary devices such as introductions, conclusions, paragraphs, and metaphors. He also writes various genres including historical narrative, prose, and poetry. So Bible study must spiritually discern and understand literature. Pray, read, observe, interpret, and apply. Finally, <i>"Do your best to present yourself approved by God, a worker who does not need to be ashamed, properly handling the word of truth."</i> {$links->X_2TI_2}. <i>"God has granted to us his precious and exceedingly great promises; that through these you may become partakers of the divine nature, having escaped from the corruption that is in the world by lust. Yes, and for this very cause adding on your part all diligence, in your faith supply moral excellence; and in moral excellence, knowledge; and in knowledge, self-control; and in self-control patience; and in patience godliness; and in godliness brotherly affection; and in brotherly affection, love. For if these things are yours and abound, they make you to be not idle nor unfruitful to the knowledge of our Lord Jesus Christ.</i> {$links->X_2PE_1}.</p>

<p><a href='rear-5-map-abraham.xhtml' title='Middle Eastern and Mediterranean Bible maps'>Middle Eastern and Mediterranean maps</a> and <a href='rear-3-history-past.xhtml' title='Bible timelines and Church history charts'>Bible timelines and Church history charts</a> are also available to help your study.</p>

<p><a href='index.xhtml' title='Table of Contents'>TOC</a></p>
</body>
</html>
EOF;
if (file_put_contents($file, $contents) === FALSE) { AION_ECHO("ERROR! AION_FILE_DATA_PUT file_put_contents($file)"); }
return;
}


// CREATE rear-1b-project-history.xhtml
function AION_EPUBY_REAR_1b_PROJECT_HISTORY_XHTML($folder) {
global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
$W_READ = $G_FORPRINT['W_READ'];
$languagehtml = $G_VERSIONS['LANGUAGEHTML'];
$links = AION_EPUBY_LINKS();
$file = "$folder/rear-1b-project-history.xhtml";
$contents = <<< EOF
<?xml version="1.0" encoding="utf-8"?>
$G_COMMENT
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops">
<head>
<meta charset="utf-8" />
<meta name='viewport' content='width=device-width,initial-scale=1'/>
<title>$G_TITLE</title>
<link href='epub.css' rel='stylesheet' />
</head>
<body>
<h2 class='title'>Project History</h2>
<p class='center'>$languagehtml<a href='https://www.AionianBible.org/History' target='_blank'>www.AionianBible.org/History</a></p>

<p>The Aionian Bible republishes public domain and Creative Common Bible texts that are 100% free to copy and print. All versions are available online at <a href='https://www.Aionianbible.org/Read' target='_blank' title='The worlds first Holy Bible untranslation'>AionianBible.org</a> in web page, ePub, text, and PDF format.  Also read online with the  <a href='https://www.Aionianbible.org/Google-Play' target='_blank' title='Aionian Bible free online at Google Play'>Android</a>  and  <a href='https://www.Aionianbible.org/Apple-iOS-App' target='_blank' title='Apple iOS App'>Apple iOS App</a>.  Buy print Bibles at <a href='https://www.Aionianbible.org/Buy' target='_blank' title='Holy Bible Aionian Edition at Amazon.com and Lulu.com'>Amazon.com and Lulu.com</a>.<br /><br /></p>

<p><b>09/01/25</b> 538 translations now available in 291 languages.<br /></p>

<p><b>06/21/25</b> 468 translations now available in 230 languages.<br /></p>

<p><b>03/12/25</b> 382 translations now available in 166 languages.<br /></p>

<p><b>01/28/25</b> All profits are given to <a href='https://CoolCup.org' target='_blank' title='Cool Cup of Water Project'>CoolCup.org</a>.<br /></p>

<p><b>11/24/24</b> Progressive Web Application <a href='https://pwa.aionianbible.org/' target='_blank' title='PWA format'>off-line format</a>.<br /></p>

<p><b>10/20/24</b> Gospel Primer <a href='https://www.aionianbible.org/Buy' target='_blank' title='Buy at Amazon and Lulu'>handout format</a>.<br /></p>

<p><b>08/18/24</b> <a href='https://creativecommons.org/licenses/by/4.0/' target='_blank' title='Copyright license'>Creative Commons Attribution 4.0 International</a>, if source allows.<br /></p>

<p><b>08/05/24</b> 378 translations now available in 165 languages.<br /></p>

<p><b>05/02/24</b> 370 translations now available in 164 languages.<br /></p>

<p><b>02/04/24</b> 352 translations now available in 142 languages.<br /></p>

<p>
<b>12/04/23</b> <a href='rear-2-glossary.xhtml#g1653' title='Aionian Glossary g165'>Eleēsē (g1653)</a> added to the <a href='rear-2-glossary.xhtml' title='View Aionian Glossary'>Aionian Glossary</a>.<br />
</p>

<p>
<b>02/14/23</b> Aionian Bible published for anonymous access on the <a href='https://www.aionianbible.org/TOR' target='_blank' title='TOR Network'>TOR Network</a>.<br />
</p>

<p><b>02/14/22</b> <a href='https://en.wikipedia.org/wiki/Strong%27s_Concordance' target='_blank' title='Strongs Concordance history at wikipedia'>Strong's Concordance</a> from <a href='https://viz.bible' target='_blank' title='Strongs Concordance source'>viz.bible</a>, <a href='https://github.com/openscriptures/strongs' target='_blank' title='improved Strongs Concordance source'>Open Scriptures</a>, and <a href='https://github.com/STEPBible/STEPBible-Data' target='_blank' title='STEPBible Enhanced Strongs Concordance'>STEPBible Enhanced Strong's</a> at <a href='https://www.Aionianbible.org/Strongs' target='_blank' title='Strongs Enhanced Concordance and Glossary'>AionianBible.org/Strongs</a>.<br /></p>

<p><b>01/23/22</b> Volunteers celebrate with pie and prayer.<br /></p>

<p><b>01/09/22</b> <a href='https://resources.aionianbible.org/AB-StudyPack/' target='_blank' title='Aionian Bible language StudyPacks'>StudyPack</a> resources for Bible translation and underlying language study now available.<br /></p>

<p><b>01/01/22</b> 216 translations now available in 99 languages.<br /></p>

<p>
<b>12/20/21</b> Social media presence on 
<a href='https://www.Aionianbible.org/Facebook'		target='_blank' title='Facebook/AionianBible'>Facebook</a>,
<a href='https://www.Aionianbible.org/Twitter'		target='_blank' title='Twitter/AionianBible'>Twitter</a>,
<a href='https://www.Aionianbible.org/LinkedIn'		target='_blank' title='LinkedIn/AionianBible'>LinkedIn</a>,
<a href='https://www.Aionianbible.org/Instagram'	target='_blank' title='Instagram/AionianBible'>Instagram</a>,
<a href='https://www.Aionianbible.org/Pinterest'	target='_blank' title='Pinterest/AionianBible'>Pinterest</a>,
<a href='https://www.Aionianbible.org/YouTube'		target='_blank' title='YouTube/AionianBible'>YouTube</a>,
<a href='https://www.aionianbible.org/Google-Play'	target='_blank' title='GooglePlay/AionianBible'>GooglePlay</a>, and
<a href='https://www.Aionianbible.org/EmailNews'	target='_blank' title='EmailNews/AionianBible'>MailChimp</a><br />
</p>

<p><b>11/17/21</b> <a href='https://www.Aionianbible.org/Bible-Cover' target='_blank' title='Buy the Aionian Bible Branded Leather Bible Cover'>Aionian Bible Branded Leather Bible Covers</a> now available.<br /></p>

<p><b>03/31/21</b> 214 translations now available in 99 languages.<br /></p>

<p><b>12/01/20</b> Right to left and Hindic languages now available in PDF format.<br /></p>

<p><b>08/29/20</b> Aionian Bibles now available in ePub format.<br /></p>

<p><b>05/25/20</b> Illustrations by Gustave Doré, <a href='https://resources.aionianbible.org/Gustave-Dore-La-Grande-Bible-de-Tours/' title='Gustave Dorés La Grande Bible de Tours' target='_blank'>La Grande Bible de Tours</a>, (Felix Just, S.J., <a href='https://catholic-resources.org/Art/Dore.htm' title='Catholic Resources' target='_blank'>Catholic-Resources.org/Art/Dore.htm</a>).<br /></p>

<p><b>02/22/20</b> Aionian Bibles <a href='https://www.aionianbible.org/Buy' target='_blank' title='in print at Amazon and Lulu'>available in print</a> at <a href='https://www.Aionianbible.org/Lulu' target='_blank' title='Aionian Bibles in print at Lulu.com'>Lulu.com</a>.<br /></p>

<p><b>10/31/19</b> 174 translations now available in 74 languages.<br /></p>

<p><b>10/28/19</b> Aionian Bible project nursed as another J. and J. pray.<br /></p>

<p><b>03/24/19</b> 135 translations now available in 67 languages.<br /></p>

<p><b>11/17/18</b> 104 translations now available in 57 languages.<br /></p>

<p><b>10/20/18</b> 70 translations now available in 33 languages.<br /></p>

<p><b>09/15/18</b> Aionian Bible project dedicated as J. and J. pray again.<br /></p>

<p><b>03/06/18</b> Aionian Bibles <a href='https://www.aionianbible.org/Buy' target='_blank' title='in print at Amazon and Lulu'>available in print</a> at <a href='https://www.Aionianbible.org/Amazon' target='_blank' title='Aionian Bibles in print at Amazon.com'>Amazon.com</a>.<br /></p>

<p><b>02/01/18</b> <i>Holy Bible Aionian Edition®</i>  trademark registered.<br /></p>

<p><b>07/30/17</b> 42 translations now available in 22 languages.<br /></p>

<p><b>07/01/17</b> <i>'The Purple Bible'</i> nickname begins.<br /></p>

<p><b>01/16/17</b> <a href='https://www.Aionianbible.org/Google-Play' target='_blank' title='Aionian Bible free online at Google Play'>Aionian Bible Google Play Store App</a> published.<br /></p>

<p><b>01/01/17</b> <a href='https://creativecommons.org/licenses/by-nd/4.0' target='_blank' title='Copyright license'>Creative Commons Attribution No Derivative Works 4.0</a> license added.<br /></p>

<p><b>12/07/16</b> <a href='https://NAINOIA-INC.signedon.net' target='_blank' title='Nainoia, Inc. exists for Christian mission promotion, technical support services, and Bible translation'>Nainoia Inc</a> established as non-profit corporation.<br /></p>

<p><b>06/21/16</b> 30 translations available in 12 languages.<br /></p>

<p><b>01/11/16</b> <a href='https://www.Aionianbible.org' target='_blank' title='The worlds first Holy Bible untranslation'>AionianBible.org</a> domain registered.<br /></p>

<p><b>06/21/15</b> Aionian Bible project birthed as G. and J. pray.<br /></p>

<p><b>12/18/13</b> Aionian Bible project announced as J. and J. pray.<br /></p>

<p><b>04/15/85</b> Aionian Bible project conceived as B. and J. pray.<br /></p>

<p><b>06/21/75</b> Two boys, P. and J., wonder if Jesus saves all and pray.<br /></p>

<p><a href='index.xhtml' title='Table of Contents'>TOC</a></p>
</body>
</html>
EOF;
if (file_put_contents($file, $contents) === FALSE) { AION_ECHO("ERROR! AION_FILE_DATA_PUT file_put_contents($file)"); }
return;
}


// CREATE rear-2-glossary.xhtml
function AION_EPUBY_REAR_2_GLOSSARY_XHTML($folder, $h7585, $g12, $g86, $g126, $g165, $g1653, $g166, $g1067, $g3041, $g5020, $questioned) {
global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
$W_GLOS = $G_FORPRINT['W_GLOS'];
$links = AION_EPUBY_LINKS(); //{$links->X_ROM_11}
$languagehtml = $G_VERSIONS['LANGUAGEHTML'];
$questioned = (empty($questioned) ? "<div>None yet noted</div><br />" : $questioned);
$file = "$folder/rear-2-glossary.xhtml";
$contents = <<< EOF
<?xml version="1.0" encoding="utf-8"?>
$G_COMMENT
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops">
<head>
<meta charset="utf-8" />
<meta name='viewport' content='width=device-width,initial-scale=1'/>
<title>$G_TITLE</title>
<link href='epub.css' rel='stylesheet' />
</head>
<body>
<h2 class='title'>$W_GLOS</h2>
<p class='center'>$languagehtml<a href='https://www.AionianBible.org/Glossary' target='_blank'>www.AionianBible.org/Glossary</a></p>
<p>The <i>Aionian Bible</i> un-translates and instead transliterates eleven special words to help us better understand the extent of God’s love for individuals and all mankind, and the nature of afterlife destinies.  The original translation is unaltered and a note is added to 64 Old Testament and 200 New Testament verses. Compare the definitions below to the <a href='https://www.aionianbible.org/Strongs' target='_blank' title='Visit the Strongs Concordance'>Strong's Concordance</a>.  Follow the links below to study the word's usage.</p>

<h3><i><a class='tag' id="g12">Abyssos</a></i></h3>
Language: Koine Greek<br />
Speech: proper noun, place<br />
Strongs: g12<br />
Meaning:<br />
<div style='margin-left: 15px;'>Temporary prison for special fallen angels such as Apollyon, the Beast, and Satan.</div>
Usage: 9 times in 3 books, 6 chapters, and 9 verses<br />
$g12<br />

<h3><i><a class='tag' id="g126">aïdios</a></i></h3>
Language: Koine Greek<br />
Speech: adjective<br />
Strongs: g126<br />
Meaning:<br /><div style='margin-left: 15px;'>Lasting, enduring forever, eternal.</div>
Usage: 2 times in Romans 1:20 and Jude 6<br />
$g126<br />

<h3><i><a class='tag' id="g165">aiōn</a></i></h3>
Language: Koine Greek<br />
Speech: noun<br />
Strongs: g165<br />
Meaning:<br /><div style='margin-left: 15px;'>A lifetime or time period with a beginning and end, an era, an age, the completion of which is beyond human perception, but known only to God the creator of the aiōns, Hebrews 1:2. Never meaning simple <i>endless or infinite chronological time</i> in Koine Greek usage. Read <a href='front-4-aionian.xhtml' title='Book abstracts of Dr. Heleen Keizer and Ramelli and Konstan'>Dr. Heleen Keizer and Ramelli and Konstan</a> for proofs.</div>
Usage: 127 times in 22 books, 75 chapters, and 102 verses<br />
$g165<br />

<h3><i><a class='tag' id="g166">aiōnios</a></i></h3>
Language: Koine Greek<br />
Speech: adjective<br />
Strongs: g166<br />
Meaning:<br /><div style='margin-left: 15px;'>From start to finish, pertaining to the age, lifetime, entirety, complete, or even consummate. Never meaning simple <i>endless or infinite chronological time</i> in Koine Greek usage. Read <a href='front-4-aionian.xhtml' title='Book abstracts of Dr. Heleen Keizer and Ramelli and Konstan'>Dr. Heleen Keizer and Ramelli and Konstan</a> for proofs.</div>
Usage: 71 times in 19 books, 44 chapters, and 69 verses<br />
$g166<br />

<h3><i><a class='tag' id="g1653">eleēsē</a></i></h3>
Language: Koine Greek<br />
Speech: verb<br />
Strongs: g1653<br />
Meaning:<br /><div style='margin-left: 15px;'>To have pity on, to show mercy. Typically, the subjunctive mood indicates possiblity, not certainty. However, a subjunctive in a purpose clause is a resulting action as certain as the causal action. The subjunctive in a purpose clause functions as an indicative, not an optative. Thus, the grand conclusion of grace theology in {$links->X_ROM_11} must be clarified. God's mercy on all is not a possibility, but a certainty. See <a href='https://www.ntgreek.org' target='_blank'>www.ntgreek.org</a>.</div>
Usage: 1 time in this conjugation, {$links->X_ROM_11}<br />
$g1653<br />

<h3><i><a class='tag' id="g1067">Geenna</a></i></h3>
Language: Koine Greek<br />
Speech: proper noun, place<br />
Strongs: g1067<br />
Meaning:<br />
<div style='margin-left: 15px;'>Valley of Hinnom, Jerusalem's trash dump, a place of ruin, destruction, and judgment in this life, or the next, though not eternal to Jesus' audience.</div>
Usage: 12 times in 4 books, 7 chapters, and 12 verses<br />
$g1067<br />

<h3><i><a class='tag' id="g86">Hadēs</a></i></h3>
Language: Koine Greek<br />
Speech: proper noun, place<br />
Strongs: g86<br />
Meaning:<br />
<div style='margin-left: 15px;'>Synonomous with <i>Sheol</i>, though in New Testament usage <i>Hades</i> is the temporal place of punishment for deceased unbelieving mankind, distinct from <i>Paradise</i> for deceased believers.</div>
Usage: 11 times in 5 books, 9 chapters, and 11 verses<br />
$g86<br />

<h3><i><a class='tag' id="g3041"></a><a class='tag' id="g4442">Limnē Pyr</a></i></h3>
Language: Koine Greek<br />
Speech: proper noun, place<br />
Strongs: g3041 g4442<br />
Meaning:<br />
<div style='margin-left: 15px;'>Lake of Fire, final punishment for those not named in the Book of Life, prepared for the Devil and his angels, Matthew 25:41.</div>
Usage: Phrase 5 times in the New Testament<br />
$g3041<br />

<h3><i><a class='tag' id="h7585">Sheol</a></i></h3>
Language: Hebrew<br />
Speech: proper noun, place<br />
Strongs: h7585<br />
Meaning:<br />
<div style='margin-left: 15px;'>The grave or temporal afterlife world of both the righteous and unrighteous, believing and unbelieving, until the general resurrection.</div>
Usage: 66 times in 17 books, 50 chapters, and 64 verses<br />
$h7585<br />

<h3><i><a class='tag' id="g5020">Tartaroō</a></i></h3>
Language: Koine Greek<br />
Speech: proper noun, place<br />
Strongs: g5020<br />
Meaning:<br />
<div style='margin-left: 15px;'>Temporary prison for particular fallen angels awaiting final judgment.</div>
Usage: 1 time in 2 Peter 2:4<br />
$g5020<br />

<h3><i><a class='tag' id="questioned">Questioned</a></i></h3>
Questioned verse translations do not contain Aionian Glossary words, but may wrongly imply eternal or Hell.<br />
<br />
$questioned
<p><a href='index.xhtml' title='Table of Contents'>TOC</a></p>
</body>
</html>
EOF;
if (file_put_contents($file, $contents) === FALSE) { AION_ECHO("ERROR! AION_FILE_DATA_PUT file_put_contents($file)"); }
return;
}



// CREATE rear-3-history-past.xhtml
function AION_EPUBY_REAR_3_HISTORY_PAST_XHTML($folder) {
global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
$file = "$folder/rear-3-history-past.xhtml";
$contents = <<< EOF
<?xml version="1.0" encoding="utf-8"?>
$G_COMMENT
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops">
<head>
<meta charset="utf-8" />
<meta name='viewport' content='width=device-width,initial-scale=1'/>
<title>$G_TITLE</title>
<link href='epub.css' rel='stylesheet' />
</head>
<body>
<h2 class='title'>History Past</h2>
<div class='cover'><img src="images/HISTORY-PAST.jpg" alt="History Past" /></div>

<p>Derived from <a href='https://www.aionianbible.org/Uusher' target='_blank' title='Download PDF'>The Annals of the World by James Uusher</a> and <a href='https://www.aionianbible.org/Wikipedia-Timeline-of-Christian-Missions' target='_blank' title='Visit Wikipedia'>Timeline of Christian missions, Wikipedia</a>.</p>

<p><a href='index.xhtml' title='Table of Contents'>TOC</a> / <a href='https://www.aionianbible.org/Timeline' target='_blank' title='Download printable chart'>Printable version</a></p>
</body>
</html>
EOF;
if (file_put_contents($file, $contents) === FALSE) { AION_ECHO("ERROR! AION_FILE_DATA_PUT file_put_contents($file)"); }
return;	
}



// CREATE rear-4-history-future.xhtml
function AION_EPUBY_REAR_4_HISTORY_FUTURE_XHTML($folder) {
global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
$file = "$folder/rear-4-history-future.xhtml";
$contents = <<< EOF
<?xml version="1.0" encoding="utf-8"?>
$G_COMMENT
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops">
<head>
<meta charset="utf-8" />
<meta name='viewport' content='width=device-width,initial-scale=1'/>
<title>$G_TITLE</title>
<link href='epub.css' rel='stylesheet' />
</head>
<body>
<h2 class='title'>History Future</h2>

<div class='cover'><img src="images/HISTORY-FUTURE.jpg" alt="History Future" /></div>

<p>The chart indicates the whereabouts of God, mankind, and angels throughout the ages of history.  Note that the punishment of deceased unbelieving mankind in Hades is temporal as promised when Jesus said <i>“the gates of Hades will not prevail”</i>, Paul wrote <i>“Hades where is your victory?”</i>, and John wrote <i>“Hades gives up.”</i>  Also note that certain fallen angels are already held in a separate prison, Tartarus, awaiting final judgment and sentencing to the Lake of Fire which is <i>“prepared for the Devil and his angels,”</i> according to Matthew 25:41.  Satan’s rebellion will be crushed and Christ will be victorious in the salvation of all his people.  You too can know your name is already written in Heaven through faith in Jesus Christ!</p>

<p><a href='index.xhtml' title='Table of Contents'>TOC</a> / <a href='https://www.aionianbible.org/Future' target='_blank' title='Download printable chart'>Printable version</a></p>
</body>
</html>
EOF;
if (file_put_contents($file, $contents) === FALSE) { AION_ECHO("ERROR! AION_FILE_DATA_PUT file_put_contents($file)"); }
return;	
}




// CREATE rear-5-history-destiny.xhtml
function AION_EPUBY_REAR_5_HISTORY_DESTINY_XHTML($folder) {
global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
$W_DESTINY = $G_FORPRINT['W_DESTINY'];
$links = AION_EPUBY_LINKS();
$languagehtml = $G_VERSIONS['LANGUAGEHTML'];
$file = "$folder/rear-5-history-destiny.xhtml";
$contents = <<< EOF
<?xml version="1.0" encoding="utf-8"?>
$G_COMMENT
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops">
<head>
<meta charset="utf-8" />
<meta name='viewport' content='width=device-width,initial-scale=1'/>
<title>$G_TITLE</title>
<link href='epub.css' rel='stylesheet' />
</head>
<body>
<h2 class='title'>$W_DESTINY</h2>
<p class='center'>$languagehtml<a href='https://www.AionianBible.org/Destiny' target='_blank'>www.AionianBible.org/Destiny</a></p>

<p>The Aionian Bible shows the location of eleven special Greek and Hebrew <a href='rear-2-glossary.xhtml' title='Aionian Glossary'>Aionian Glossary</a> words to help us better understand God’s love for individuals and for all mankind, and the nature of after-life destinies. The underlying Hebrew and Greek words typically translated as <i>Hell</i> show us that there are not just two after-life destinies, Heaven or Hell.  Instead, there are a number of different locations, each with different purposes, different durations, and different inhabitants. Locations include 1) Old Testament <a href='rear-2-glossary.xhtml#h7585' title='Aionian Glossary h7585'><i>Sheol</i></a> and New Testament <a href='rear-2-glossary.xhtml#g86' title='Aionian Glossary g86'><i>Hadēs</i></a>, 2) <a href='rear-2-glossary.xhtml#g1067' title='Aionian Glossary g1067'><i>Geenna</i></a>,
3) <a href='rear-2-glossary.xhtml#g5020' title='Aionian Glossary g5020'><i>Tartaroō</i></a>, 4) <a href='rear-2-glossary.xhtml#g12' title='Aionian Glossary g12'><i>Abyssos</i></a>, 5) <a href='rear-2-glossary.xhtml#g3041' title='Aionian Glossary g3041 g4442'><i>Limnē Pyr</i></a>, 6) {$links->X_PARADISE}, 7) {$links->X_NEWHEAVEN}, and 8) {$links->X_NEWEARTH}. So there is reason to review our conclusions about the destinies of redeemed mankind and fallen angels.</p>

<p>The key observation is that fallen angels will be present at the final judgment, {$links->X_2PE_2} and  {$links->X_JUD_1}. Traditionally, we understand the separation of the Sheep and the Goats at the final judgment to divide believing from unbelieving mankind, {$links->X_SHEEP} and {$links->X_GREAT}. However, the presence of fallen angels alternatively suggests that Jesus is separating redeemed mankind from the fallen angels.  We do know that Jesus is the helper of mankind and not the helper of the Devil, {$links->X_HEB_2}. We also know that Jesus has atoned for the sins of all mankind, both believer and unbeliever alike, {$links->X_ALLALL}. Deceased believers are rewarded in Paradise, {$links->X_LUK_23}, while unbelievers are punished in Hades as the story of Lazarus makes plain, {$links->X_LUK_16}. Yet less commonly known, the punishment of this selfish man and all unbelievers is before the final judgment, is temporal, and is punctuated when Hades is evacuated, {$links->X_REV_20}. So is there hope beyond Hades for unbelieving mankind? Jesus promised, <i>“the gates of Hades will not prevail,”</i> {$links->X_MAT_16}. Paul asks, <i>“Hades where is your victory?”</i> {$links->X_1CO_15}. John wrote, <i>“Hades gives up,”</i> {$links->X_REV_20}.</p>

<p>Jesus comforts us saying, <i>“Do not be afraid,”</i> because he holds the keys to <i>unlock</i> death and Hades, {$links->X_REV_1}. Yet too often our <i>Good News</i> sounds like a warning to <i>“be afraid”</i> because Jesus holds the keys to <i>lock</i> Hades!  Wow, we have it backwards!  Hades will be evacuated!  And to guarrantee hope, once emptied, Hades is thrown into the Lake of Fire, never needed again, {$links->X_REV_20}.</p>

<p>Finally, we read that anyone whose name is not written in the Book of Life is thrown into the Lake of Fire, the second death, with no exit ever mentioned or promised, {$links->X_REV_21}. So are those evacuated from Hades then, <i>“out of the frying pan, into the fire?”</i>  Certainly, the Lake of Fire is the destiny of the Goats.  But, do not be afraid. Instead, read the Bible's explicit mention of the purpose of the Lake of Fire and the identity of the Goats. <i>“Then he will say also to those on the left hand, ‘Depart from me, you cursed, into the consummate fire which is prepared for... the devil and his angels,’”</i> {$links->X_MAT_25}. Bad news for the Devil. Good news for all mankind!</p>

<p>Faith is not a pen to write your own name in the Book of Life. Instead, faith is the glasses to see that the love of Christ for all mankind has already written our names in Heaven. <i>“If the first fruit is holy, so is the lump,”</i> {$links->X_ROM_1116}.  Though unbelievers will suffer regrettable punishment in Hades, redeemed mankind will never enter the Lake of Fire, prepared for the devil and his angels. And as God promised, all mankind will worship Christ together forever, {$links->X_PHI_2}.</p>

<p><a href='index.xhtml' title='Table of Contents'>TOC</a></p>
</body>
</html>
EOF;
if (file_put_contents($file, $contents) === FALSE) { AION_ECHO("ERROR! AION_FILE_DATA_PUT file_put_contents($file)"); }
return;	
}




// CREATE image page
function AION_EPUBY_IMAGE_XHTML($file, $title, $image) {
global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
$title = (empty($title) ? "" : "\n<h2 class='title'>$title</h2>");
$contents = <<< EOF
<?xml version="1.0" encoding="utf-8"?>
$G_COMMENT
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops">
<head>
<meta charset="utf-8" />
<meta name='viewport' content='width=device-width,initial-scale=1'/>
<title>$G_TITLE</title>
<link href='epub.css' rel='stylesheet' />
</head>
<body>$title
<div class='cov'><img src="$image" alt="$title" /></div>
</body>
</html>
EOF;
if (file_put_contents($file, $contents) === FALSE) { AION_ECHO("ERROR! AION_FILE_DATA_PUT file_put_contents($file)"); }
return;
}



// CREATE image verse page
function AION_EPUBY_IMAGE_VERSE_XHTML($file, $title, $image, $verse, $map=FALSE, $css=NULL) {
global $G_BOOKS, $G_NUMBERS, $G_VERSIONS, $G_FORPRINT, $G_UUID, $G_TITLE, $G_MODIFIED, $G_RTL, $G_COMMENT;
$title = (empty($title) ? "" : "<h2 class='title'>$title</h2>");
$map = ($map ? " / <a href='https://www.aionianbible.org/Maps' target='_blank' title='Download printable image'>Printable version</a>" : NULL);
$contents = <<< EOF
<?xml version="1.0" encoding="utf-8"?>
$G_COMMENT
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops">
<head>
<meta charset="utf-8" />
<meta name='viewport' content='width=device-width,initial-scale=1'/>
<title>$G_TITLE</title>
<link href='epub.css' rel='stylesheet' />
</head>
<body>$title
<div class='map $css'><img src="$image" /></div>
$verse

<p><a href='index.xhtml' title='Table of Contents'>TOC</a>$map</p>
</body>
</html>
EOF;
if (file_put_contents($file, $contents) === FALSE) { AION_ECHO("ERROR! AION_EPUBY_IMAGE_VERSE_XHTML file_put_contents($file)"); }
return;
}
