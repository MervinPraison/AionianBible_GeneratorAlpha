<?php
require_once('./aion_common.php');
use \ForceUTF8\Encoding;

// TODO NOTES
// Uncomment the lines to allow copying the latest git hub report
// Change "Field_of" to "place" in Greek Lexicons
// Add Greek Strongs G5306 from copy of G5305

//////////////////////////////////////////////////////////////////////////////////////////////////
// INIT
//$strongs_json_flag = JSON_UNESCAPED_UNICODE;
//$strongs_json_flag = (JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
$strongs_json_flag = (JSON_UNESCAPED_UNICODE);
$SAVETHECOUNTCHECKER = TRUE;




//////////////////////////////////////////////////////////////////////////////////////////////////
// FILENAMES and README
// folders
$FOLDER_SOURCE = "../STEPBible-Data-master/";
//$FOLDER_SOURCE = "../STEPBible-Data-master-production/";
$FOLDER_STAGE = "../www-stage/library/stepbible/";

// input
$INPUT_VIZBI = "../www-stageresources/AB-Viz-Strongs.csv";
$INPUT_OSGRE = "../www-stageresources/AB-OpenScriptures-Strongs-Greek.json";
$INPUT_OSHEB = "../www-stageresources/AB-OpenScriptures-Strongs-Hebrew.json";
$INPUT_TBESG = $FOLDER_SOURCE."TBESG - Translators Brief lexicon of Extended Strongs for Greek - STEPBible.org CC BY.txt";
$INPUT_TFLS1 = $FOLDER_SOURCE."TFLSJ  0-5624 - Translators Formatted full LSJ Bible lexicon - STEPBible.org CC BY.txt";
$INPUT_TFLS2 = $FOLDER_SOURCE."TFLSJ extra - Translators Formatted full LSJ Bible lexicon - STEPBible.org CC BY.txt";
$INPUT_TEGMC = $FOLDER_SOURCE."TEGMC - Translators Expansion of Greek Morphhology Codes - STEPBible.org CC BY.txt";
$INPUT_TAGN1 = $FOLDER_SOURCE."TAGNT Mat-Jhn - Translators Amalgamated Greek NT - STEPBible.org CC-BY.txt";
$INPUT_TAGN2 = $FOLDER_SOURCE."TAGNT Act-Rev - Translators Amalgamated Greek NT - STEPBible.org CC-BY.txt";
$INPUT_TAGX1 = $FOLDER_SOURCE."TAGNT Mat-Jhn - Translators Amalgamated Greek NT - STEPBible.org CC-BY.txt.oldformat";
$INPUT_TAGX2 = $FOLDER_SOURCE."TAGNT Act-Rev - Translators Amalgamated Greek NT - STEPBible.org CC-BY.txt.oldformat";
$INPUT_TBESH = $FOLDER_SOURCE."TBESH - Translators Brief lexicon of Extended Strongs for Hebrew - STEPBible.org CC BY.txt";
$INPUT_TEHMC = $FOLDER_SOURCE."TEHMC - Translators Expansion of Hebrew Morphology Codes - STEPBible.org CC BY.txt";
$INPUT_TOTH1 = $FOLDER_SOURCE."TAHOT Gen-Deu - Translators Amalgamated Hebrew OT - STEPBible.org CC BY.txt";
$INPUT_TOTH2 = $FOLDER_SOURCE."TAHOT Jos-Est - Translators Amalgamated Hebrew OT - STEPBible.org CC BY.txt";
$INPUT_TOTH3 = $FOLDER_SOURCE."TAHOT Job-Sng - Translators Amalgamated Hebrew OT - STEPBible.org CC BY.txt";
$INPUT_TOTH4 = $FOLDER_SOURCE."TAHOT Isa-Mal - Translators Amalgamated Hebrew OT - STEPBible.org CC BY.txt";
$INPUT_TOTX1 = $FOLDER_SOURCE."TAHOT Gen-Deu - Translators Amalgamated Hebrew OT - STEPBible.org CC BY.txt.oldformat";
$INPUT_TOTX2 = $FOLDER_SOURCE."TAHOT Jos-Est - Translators Amalgamated Hebrew OT - STEPBible.org CC BY.txt.oldformat";
$INPUT_TOTX3 = $FOLDER_SOURCE."TAHOT Job-Sng - Translators Amalgamated Hebrew OT - STEPBible.org CC BY.txt.oldformat";
$INPUT_TOTX4 = $FOLDER_SOURCE."TAHOT Isa-Mal - Translators Amalgamated Hebrew OT - STEPBible.org CC BY.txt.oldformat";
// checks
$CHECK_BOOK = "CHECK_BOOKS.txt";
$CHECK_ECSV = "CHECK_EMPTY_STRONGS_CSV.txt";
$CHECK_EHLX = "CHECK_EMPTY_HEBREW_LEX.txt";
$CHECK_EHTG = "CHECK_EMPTY_HEBREW_TAG.txt";
$CHECK_EGLX = "CHECK_EMPTY_GREEK_LEX.txt";
$CHECK_ELSJ = "CHECK_EMPTY_GREEK_LSJ.txt";
$CHECK_EGTG = "CHECK_EMPTY_GREEK_TAG.txt";
$CHECK_FIXS = "CHECK_FIXED.txt";
$CHECK_HTMG = "CHECK_HTML_GREEK_TBESG.htm";
$CHECK_HTML = "CHECK_HTML_GREEK_TFLSJ.htm";
$CHECK_HTAG = "CHECK_HTML_GREEK_TAGNT.htm";
$CHECK_HTMH = "CHECK_HTML_HEBREW_TBESH.htm";
$CHECK_HHOT = "CHECK_HTML_HEBREW_TAHOT.htm";
$CHECK_MISS = "CHECK_MISSING.txt";
$CHECK_MORF = "CHECK_MORPHS.txt";
$CHECK_MORA = "CHECK_MORPHS_ALL.txt";
$CHECK_REFS = "CHECK_REFERENCES.txt";
$CHECK_STRG = "CHECK_STRONGS.txt";
$CHECK_UGRE = "CHECK_UNUSED_GREEK_TBESG.txt";
$CHECK_ULSJ = "CHECK_UNUSED_GREEK_TFLSJ.txt";
$CHECK_UHEB = "CHECK_UNUSED_HEBREW_TBESH.txt";
$CHECK_VARS = "CHECK_VARIANT.txt";
$CHECK_WARN = "CHECK_WARNINGS.txt";
// readme +
$README_FILE = "_README.md";
$HTACCESS_FILE = ".htaccess";
// hebrew
$HEBREW_VIZBI_DATA = "Hebrew_Lexicon_Strongs.txt";
$HEBREW_VIZBI_INDX = "Hebrew_Lexicon_Strongs_Index.json";
$HEBREW_TBESH_DATA = "Hebrew_Lexicon_Tyndale.txt";
$HEBREW_TBESH_INDX = "Hebrew_Lexicon_Tyndale_Index.json";
$HEBREW_MORPH_DATA = "Hebrew_Morphhology.json";
$HEBREW_TAGED_FILE = "Hebrew_Tagged_File.txt";
$HEBREW_TAGED_DATA = "Hebrew_Tagged_Text.txt";
$HEBREW_TAGED_INDX = "Hebrew_Tagged_Text_Index.json";
$HEBREW_TAGED_NUMS = "Hebrew_Tagged_Text_Count.json";
$HEBREW_TAGED_DIFF = "Hebrew_Tagged_Sort_Diff.txt";
$HEBREW_TAGED_FILS = "Hebrew_Tagged_Sort_File.txt";
$HEBREW_TAGED_DATS = "Hebrew_Tagged_Sort_Text.txt";
$HEBREW_USAGE_DATA = "Hebrew_Chapter_Usage.txt";
$HEBREW_USAGE_INDX = "Hebrew_Chapter_Usage_Index.json";
// greek
$GREEK_VIZBI_DATA = "Greek_Lexicon_Strongs.txt";
$GREEK_VIZBI_INDX = "Greek_Lexicon_Strongs_Index.json";
$GREEK_TBESG_DATA = "Greek_Lexicon_Tyndale.txt";
$GREEK_TBESG_INDX = "Greek_Lexicon_Tyndale_Index.json";
$GREEK_TFLSJ_DATA = "Greek_Lexicon_LSJ.txt";
$GREEK_TFLSJ_INDX = "Greek_Lexicon_LSJ_Index.json";
$GREEK_MORPH_DATA = "Greek_Morphhology.json";
$GREEK_TAGED_FILE = "Greek_Tagged_File.txt";
$GREEK_TAGED_DATA = "Greek_Tagged_Text.txt";
$GREEK_TAGED_INDX = "Greek_Tagged_Text_Index.json";
$GREEK_TAGED_NUMS = "Greek_Tagged_Text_Count.json";
$GREEK_TAGED_DIFF = "Greek_Tagged_Sort_Diff.txt";
$GREEK_TAGED_FILS = "Greek_Tagged_Sort_File.txt";
$GREEK_TAGED_DATS = "Greek_Tagged_Sort_Text.txt";
$GREEK_USAGE_DATA = "Greek_Chapter_Usage.txt";
$GREEK_USAGE_INDX = "Greek_Chapter_Usage_Index.json";
// bible
$STEPBIBLE_AMA = "../www-stage/library/stepbible/Holy-Bible---English---STEPBible-Amalgamant---Source-Edition.STEP.txt";
$STEPBIBLE_CON = "../www-stage/library/stepbible/Holy-Bible---English---STEPBible-Concordant---Source-Edition.STEP.txt";
$STEPBIBLE_HEB = "../www-stage/library/stepbible/Holy-Bible---Hebrew---Hebrew-STEPBible---Source-Edition.STEP.txt";
$STEPBIBLE_GRK = "../www-stage/library/stepbible/Holy-Bible---Greek---Greek-STEPBible---Source-Edition.STEP.txt";

// PREPARE THE STAGE
if (!is_dir($FOLDER_SOURCE)) { AION_ECHO("ERROR! Bad unzip($FOLDER_SOURCE)"); }
system("rm -rf $FOLDER_STAGE");
if (!mkdir($FOLDER_STAGE) || !is_dir($FOLDER_STAGE) || !chmod($FOLDER_STAGE,0755)) {	AION_ECHO("ERROR! mkdir($FOLDER_STAGE)"); }



//////////////////////////////////////////////////////////////////////////////////////////////////
// HTACCESS
$HTACCESS = <<<EOT
# security
#cfg,css,eot,gif,gitignore,htaccess,htm,html,ico,jar,jpg,js,lua,md,otf,pdf,php,png,rng,sh,so,svg,tex,ttf,TTF,txt,woff,woff2,xml,xsd
<FilesMatch "\.(php|php5|php6|php7|php8|sh|bash|jar|so|rng|tex|epub|zip|noia)$">
   ForceType application/octet-stream
   Header set Content-Disposition attachment
</FilesMatch>
<FilesMatch "^[^.]+$">
   ForceType application/octet-stream
   Header set Content-Disposition attachment
</FilesMatch>

# php -- BEGIN cPanel-generated handler, do not edit
# Set the “ea-php80” package as the default “PHP” programming language.
<IfModule mime_module>
  AddHandler application/x-httpd-ea-php80 .php .php8 .phtml
</IfModule>
# php -- END cPanel-generated handler, do not edit

EOT;
if (file_put_contents("$FOLDER_STAGE$HTACCESS_FILE", $HTACCESS)===FALSE) { AION_ECHO("ERROR! file_put_contents($HTACCESS_FILE)"); }
unset($HTACCESS); $HTACCESS=NULL;




//////////////////////////////////////////////////////////////////////////////////////////////////
// README
$commentplus = <<<EOT
# Source: Tyndale House, Cambridge, www.TyndaleHouse.com
# Source Content: Hebrew and Greek lexicons, morphhologies, and tagged texts
# Source Link: https://tyndale.github.io/STEPBible-Data
# Source Application: https://www.STEPBible.org
# Source Copyright: Creative Commons Attribution Non-Commercial 4.0

EOT;
$README = <<<EOT

# Readme file
$README_FILE > This file

# Check files
$CHECK_BOOK > Unique Bible book abbreviations in tagged texts 
$CHECK_ECSV > Empty fields in $HEBREW_VIZBI_DATA
$CHECK_EHLX > Empty fields in $HEBREW_TBESH_DATA
$CHECK_EHTG > Empty fields in $HEBREW_TAGED_DATA
$CHECK_EGLX > Empty fields in $GREEK_TBESG_DATA
$CHECK_ELSJ > Empty fields in $GREEK_TFLSJ_DATA
$CHECK_EGTG > Empty fields in $GREEK_TAGED_DATA
$CHECK_FIXS > Textual hygiene change counts
$CHECK_HTMG > HTML errors in the Tyndale Greek Lexicon
$CHECK_HTML > HTML errors in the LSJ Greek Lexicon
$CHECK_HTMH > HTML errors in the Tyndale Hebrew Lexicon
$CHECK_MISS > Manuscript abbreviations in tagged texts, but undefined or missing
$CHECK_MORF > Morphhologies in lexicons and tagged texts, but undefined or missing
$CHECK_REFS > Reference non-standard or missing
$CHECK_STRG > Strongs numbers cannot parse
$CHECK_UGRE > Strongs numbers in Tyndale Greek lexicon, but not in tagged texts
$CHECK_ULSJ > Strongs numbers in LSJ Greek lexicon, but not in tagged texts
$CHECK_UHEB > Strongs numbers in Tyndale Hebrew lexicon, but not in tagged texts
$CHECK_VARS > Variants used in tagged texts, but cannot parse
$CHECK_WARN > General warnings about formats

# Hebrew files
$HEBREW_TBESH_DATA > Extended Strong's Hebrew Lexicon
$HEBREW_TBESH_INDX > json byte index file to Extended Strong's Hebrew Lexicon
$HEBREW_VIZBI_DATA > Strong's Hebrew Lexicon
$HEBREW_VIZBI_INDX > json byte index file to Strong's Hebrew Lexicon
$HEBREW_MORPH_DATA > json index file to Hebrew Lexicon morphhology codes
$HEBREW_TAGED_DATA > Old Testament Strong's Tagged Text
$HEBREW_TAGED_INDX > json index file to Old Testament Strong's Tagged Text
$HEBREW_TAGED_NUMS > json book, chapter, verse, and total Strong's usage count from OT Strong's Tagged Text
$HEBREW_USAGE_DATA > Hebrew Strong's usage indicated by chapter index
$HEBREW_USAGE_INDX > json byte index file to Hebrew Strong's usage indicated by chapter index

# Greek files
$GREEK_TBESG_DATA > Extended Strong's Greek Lexicon
$GREEK_TBESG_INDX > json byte index file to Extended Strong's Greek Lexicon
$GREEK_TFLSJ_DATA > Full Liddell Scott Jones Greek Lexicon
$GREEK_TFLSJ_INDX > json byte index file to Full Liddell Scott Jones Greek Lexicon
$GREEK_VIZBI_DATA > Strong's Greek Lexicon
$GREEK_VIZBI_INDX > json byte index file to Strong's Greek Lexicon
$GREEK_MORPH_DATA > json index file to Greek Lexicon morphhology codes
$GREEK_TAGED_DATA > Translators Amalgamated Greek New Testament
$GREEK_TAGED_INDX > json index file to Translators Amalgamated Greek New Testament
$GREEK_TAGED_NUMS > json book, chapter, verse, and total Strong's usage count from Translators Amalgamated Greek New Testament
$GREEK_USAGE_DATA > Greek Strong's usage indicated by chapter index
$GREEK_USAGE_INDX > json byte index file to Greek Strong's usage indicated by chapter index

EOT;
$README = AION_FILE_DATA_PUT_HEADER("$README_FILE", strlen($README), $commentplus) . $README;
if (file_put_contents("$FOLDER_STAGE$README_FILE", $README)===FALSE) { AION_ECHO("ERROR! file_put_contents($README_FILE)"); }
unset($README); $README=NULL;




//////////////////////////////////////////////////////////////////////////////////////////////////
// SETUP ERROR RESULTS FILES
$callback = function($value) { return implode("\t", $value); };
$database = array();
$database['BOOKS']			= array("Unique Bible book abbreviations in tagged texts","===","");
$database['MISS_MORPHS']	= "Morphhologies in lexicons and tagged texts, but undefined or missing\n===\n\n\n";
$database['MISS_MANU']		= "Manuscript abbreviations in tagged texts, but undefined or missing\n===\n\n\n";
$database['CORRUPT_VARIANT']= "Variants used in tagged texts, but cannot parse\n===\n\n\n";
$database['CORRUPT_STRONGS']= "Strongs numbers cannot parse\n===\n\n\n";
$database['FIXCOUNTS']		= "Textual hygiene change counts\n===\n\n";
$database['REFERENCES']		= "Reference non-standard or missing\n===\n\n";
$database['WARNINGS']		= "General warnings about formats\n===\n\n";




//////////////////////////////////////////////////////////////////////////////////////////////////
// VIZ-STRONGS READ
AION_NEWSTRONGS_CSV( "$INPUT_VIZBI", ",",'VIZLEX',array('STRONGS','WORD','TRANS','PRONOUNCE','DEF','MORPH','LANG'), 'STRONGS', $database, "$FOLDER_STAGE$CHECK_ECSV");
// VIZ-STRONGS WRITE
if (empty($OSHEB = json_decode(file_get_contents($INPUT_OSHEB), true))) { AION_ECHO("ERROR! json_decode($INPUT_OSHEB)"); }
if (empty($OSGRE = json_decode(file_get_contents($INPUT_OSGRE), true))) { AION_ECHO("ERROR! json_decode($INPUT_OSGRE)"); }
AION_NEWSTRONGS_FIX_VIZ($database['VIZLEX'],'H','HEBVIZ',$database,$OSHEB,$OSGRE);
$commentplus = <<<EOT
# Source: Robert Rouse
# Source Content: James Strong's Lexicon, Hebrew
# Source Description: https://en.wikipedia.org/wiki/Strong%27s_Concordance
# Source Copyright: Public Domain
# Source Link: https://viz.bible/
#
# COLUMNS
#	STRONGS		Strong's number
#	WORD		Hebrew word
#	TRANS		Transliterated word
#	PRONOUNCE	Pronunciation
#	LANG		Language
#	MORPH		Part of speech
#	DEF			Definition

EOT;
AION_FILE_DATA_PUT("$FOLDER_STAGE$HEBREW_VIZBI_DATA", $database['HEBVIZ'], $commentplus);
AION_ECHO("VIZ $FOLDER_STAGE$HEBREW_VIZBI_DATA ROWS=".count($database['HEBVIZ']));
AION_unset($database['HEBVIZ']);
AION_NEWSTRONGS_GET_INDEX_LEX("$FOLDER_STAGE$HEBREW_VIZBI_DATA", "$FOLDER_STAGE$HEBREW_VIZBI_INDX");
AION_NEWSTRONGS_GET_INDEX_LEX_CHECKER("$FOLDER_STAGE$HEBREW_VIZBI_INDX", "$FOLDER_STAGE$HEBREW_VIZBI_DATA");
AION_ECHO("VIZ $FOLDER_STAGE$HEBREW_VIZBI_INDX");
AION_NEWSTRONGS_FIX_VIZ($database['VIZLEX'],'G','GREVIZ',$database,$OSGRE,$OSHEB);
AION_unset($OSGRE);
AION_unset($OSHEB);
$commentplus = <<<EOT
# Source: Robert Rouse
# Source Content: James Strong's Lexicon, Greek
# Source Description: https://en.wikipedia.org/wiki/Strong%27s_Concordance
# Source Copyright: Public Domain
# Source Link: https://viz.bible/
#
# COLUMNS
#	STRONGS		Strong's number
#	WORD		Greek word
#	TRANS		Transliterated word
#	PRONOUNCE	Pronunciation
#	LANG		Language
#	MORPH		Part of speech
#	DEF			Definition

EOT;
AION_FILE_DATA_PUT("$FOLDER_STAGE$GREEK_VIZBI_DATA", $database['GREVIZ'], $commentplus);
AION_ECHO("VIZ $FOLDER_STAGE$GREEK_VIZBI_DATA ROWS=".count($database['GREVIZ']));
AION_unset($database['GREVIZ']);
AION_NEWSTRONGS_GET_INDEX_LEX("$FOLDER_STAGE$GREEK_VIZBI_DATA", "$FOLDER_STAGE$GREEK_VIZBI_INDX");
AION_NEWSTRONGS_GET_INDEX_LEX_CHECKER("$FOLDER_STAGE$GREEK_VIZBI_INDX", "$FOLDER_STAGE$GREEK_VIZBI_DATA");
AION_ECHO("VIZ $FOLDER_STAGE$GREEK_VIZBI_INDX");



//////////////////////////////////////////////////////////////////////////////////////////////////
// TYNDALE HEBREW READ
AION_NEWSTRONGS_COD( "$INPUT_TEHMC",'HEBMOR', $database);
$database['HEBLEX'] = array();
AION_NEWSTRONGS_GET( "$INPUT_TBESH",'H0001	H0001G =	H0001G	אָב', NULL, 'HEBLEX',
	array('','STRONGS','STRONGU','WORD','TRANS','MORPH','GLOSS','DEF'),
	array('','STRONGS','STRONGU','WORD','TRANS','MORPH','GLOSS','DEF'), "$FOLDER_STAGE$CHECK_EHLX",
	array('STRONGS','STRONGU','WORD','TRANS','GLOSS','MORPH','DEF'),
	'STRONGS', $database, TRUE);
AION_NEWSTRONGS_GET_LEXY('HEBLEX', $database);
AION_NEWSTRONGS_GET_PREPH("$INPUT_TOTH1", "$INPUT_TOTX1");
AION_NEWSTRONGS_GET_PREPH("$INPUT_TOTH2", "$INPUT_TOTX2");
AION_NEWSTRONGS_GET_PREPH("$INPUT_TOTH3", "$INPUT_TOTX3");
AION_NEWSTRONGS_GET_PREPH("$INPUT_TOTH4", "$INPUT_TOTX4");
// do the greek here so they are done
AION_NEWSTRONGS_GET_PREP("$INPUT_TAGN1", "$INPUT_TAGX1");
AION_NEWSTRONGS_GET_PREP("$INPUT_TAGN2", "$INPUT_TAGX2");
AION_NEWSTRONGS_GET( "$INPUT_TOTX1",'001	GEN	001	001	50100',	NULL, 'HEBRF1',
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','LEXICON','ENGLISH','GLOSS','STRONGS','MORPH','EDITIONS','VAR','SPELL','EXTRA','CONJOIN','INSTANCE','ALT'),
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','','ENGLISH','','STRONGS','MORPH','','','','','','INSTANCE',''),
	"$FOLDER_STAGE$CHECK_EHTG",
	NULL,
	NULL, $database);
if ( file_put_contents(($file="$INPUT_TOTX1.tmp"), json_encode($database['HEBRF1'], $strongs_json_flag)) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }	AION_unset($database['HEBRF1']);
AION_NEWSTRONGS_GET( "$INPUT_TOTX2",'006	JOS	001	001	50100',	NULL, 'HEBRF2',
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','LEXICON','ENGLISH','GLOSS','STRONGS','MORPH','EDITIONS','VAR','SPELL','EXTRA','CONJOIN','INSTANCE','ALT'),
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','','ENGLISH','','STRONGS','MORPH','','','','','','INSTANCE',''),
	"$FOLDER_STAGE$CHECK_EHTG",
	NULL,
	NULL, $database);
if ( file_put_contents(($file="$INPUT_TOTX2.tmp"), json_encode($database['HEBRF2'], $strongs_json_flag)) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }	AION_unset($database['HEBRF2']);
AION_NEWSTRONGS_GET( "$INPUT_TOTX3",'018	JOB	001	001	50100',	NULL, 'HEBRF3',
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','LEXICON','ENGLISH','GLOSS','STRONGS','MORPH','EDITIONS','VAR','SPELL','EXTRA','CONJOIN','INSTANCE','ALT'),
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','','ENGLISH','','STRONGS','MORPH','','','','','','INSTANCE',''),
	"$FOLDER_STAGE$CHECK_EHTG",
	NULL,
	NULL, $database);
if ( file_put_contents(($file="$INPUT_TOTX3.tmp"), json_encode($database['HEBRF3'], $strongs_json_flag)) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }	AION_unset($database['HEBRF3']);
AION_NEWSTRONGS_GET( "$INPUT_TOTX4",'023	ISA	001	001	50100',	NULL, 'HEBRF4',
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','LEXICON','ENGLISH','GLOSS','STRONGS','MORPH','EDITIONS','VAR','SPELL','EXTRA','CONJOIN','INSTANCE','ALT'),
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','','ENGLISH','','STRONGS','MORPH','','','','','','INSTANCE',''),
	"$FOLDER_STAGE$CHECK_EHTG",
	NULL,
	NULL, $database);
if ( file_put_contents(($file="$INPUT_TOTX4.tmp"), json_encode($database['HEBRF4'], $strongs_json_flag)) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }	AION_unset($database['HEBRF4']);
// TYNDALE HEBREW WRITE
if ( file_put_contents($json="$FOLDER_STAGE$HEBREW_MORPH_DATA",($temp=json_encode($database['HEBMOR'], $strongs_json_flag))) === FALSE ) { AION_ECHO("ERROR! json_encode: ".$json ); }
unset($temp); $temp=NULL;
AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_MORPH_DATA ROWS=".count($database['HEBMOR']));

// TOTALLY UGLY - PUT THE MORPH SEARCH AND REPLACE INTO GLOBALS!
// before init load the morph search and replace
//$GLOBALS['MORPH']['LEX_REPLACE'] = AION_NEWSTRONGS_LEX_MORPH(NULL, NULL);
//$GLOBALS['MORPH']['LEX_SEARCH' ] = array_keys($GLOBALS['MORPH']['LEX_REPLACE']);
//if (count($GLOBALS['MORPH']['LEX_REPLACE']) != count($GLOBALS['MORPH']['LEX_SEARCH'])) { AION_ECHO("ERROR! GLOBALS['MORPH']['LEX_REPLACE'] lex morph counts do not match!"); }
//AION_ECHO("WARN! HEBREW TOTALLY UGLY lexicon morph count = ".count($GLOBALS['MORPH']['LEX_REPLACE']));
$GLOBALS['MORPH']['TAG_REPLACE'] = $GLOBALS['MORPH']['TAG_SEARCH'] = array();
foreach($database['HEBMOR'] as $key => $morph) {
	$GLOBALS['MORPH']['TAG_SEARCH'][] = "#={$key}\)#u";
	$GLOBALS['MORPH']['TAG_REPLACE'][] = '=<a href="javascript:void(0)" title="'.trim($morph['M'].', '.$morph['U'],", ").'">'.$key.'</a>)';
	$GLOBALS['MORPH']['TAG_SEARCH'][] = "#={$key}\/#u";
	$GLOBALS['MORPH']['TAG_REPLACE'][] = '=<a href="javascript:void(0)" title="'.trim($morph['M'].', '.$morph['U'],", ").'">'.$key.'</a>/';
	$key1 = substr($key,1);
	$GLOBALS['MORPH']['TAG_SEARCH'][] = "#\/{$key1}\/#u";
	$GLOBALS['MORPH']['TAG_REPLACE'][] = '/<a href="javascript:void(0)" title="'.trim($morph['M'].', '.$morph['U'],", ").'">'.$key1.'</a>/';
	$GLOBALS['MORPH']['TAG_SEARCH'][] = "#\/{$key1}\)#u";
	$GLOBALS['MORPH']['TAG_REPLACE'][] = '/<a href="javascript:void(0)" title="'.trim($morph['M'].', '.$morph['U'],", ").'">'.$key1.'</a>)';
}
AION_ECHO("WARN! HEBREW TOTALLY UGLY tag morph count = ".count($GLOBALS['MORPH']['TAG_REPLACE']));
$htmlheader = <<<EOT
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<title>Aionian Bible Project: $file HTML Errors</title>
<meta name='description' content="Aionian Bible Project: $file HTML Errors">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name='apple-mobile-web-app-capable' content='yes'>
<meta name="generator" content="ABCMS™">
<meta http-equiv='x-ua-compatible' content='ie=edge'>
<style>
	body { padding: 50px;}
	div.head { margin: 20px; }
	div.body { margin: 50px; }
</style>
</head>
<body>
<div class='head'>
<h1>Aionian Bible Project: TAHOT HTML Errors</h1>
</div>

EOT;
if (file_put_contents("$FOLDER_STAGE$CHECK_HHOT",$htmlheader) === FALSE ) { AION_ECHO("ERROR! $FOLDER_STAGE$CHECK_HHOT"); } // FILE_APPEND




// Okay back to business
AION_NEWSTRONGS_GET_FIX_LEX('TBESH', $database['HEBLEX'], $database, $database['HEBMOR'], "$FOLDER_STAGE$CHECK_HTMH");
AION_NEWSTRONGS_GET_FIX_INDEX($database['HEBLEX']);
$commentplus = <<<EOT
# Source: Tyndale House, Cambridge, www.TyndaleHouse.com
# Source Content: Extended Strong's Hebrew Lexicon
# Source Link: https://tyndale.github.io/STEPBible-Data
# Source Application: https://www.STEPBible.org
# Source Copyright: Creative Commons Attribution Non-Commercial 4.0
# Source Definitions: Abridged BDB by https://onlinebible.net, edited by Tyndale House Cambridge
# Source Definitions Copyright: Larry Pierce, larrypierce@alumni.uwaterloo.ca
# Source Definitions Copyright: Explicit usage permission required to use definition in your application
# Source Definitions Copyright: Larry Pierce granted permission for Nainoia Inc applications on 3/11/2019
#
# COLUMNS
#	STRONGS	Extended Strong Numbers
#	WORD	Hebrew form	based on BDB, then normalised
#	TRANS	Transliteration
#	GLOSS	A meaning in one word or as few as possible (by Tyndale scholars)
#	MORPH	Part of speech / grammer
#	DEF		Definitions are based on the Abridged BDB by Online Bible, and edited to conform with the extended Strongs.
#

EOT;
AION_FILE_DATA_PUT("$FOLDER_STAGE$HEBREW_TBESH_DATA", $database['HEBLEX'], $commentplus);
AION_NEWSTRONGS_LEX_MORPH_LEX($database['HEBLEX']);
AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_TBESH_DATA ROWS=".count($database['HEBLEX']));
if (!is_array(($database['HEBRF1'] = json_decode(file_get_contents(($file="$INPUT_TOTX1.tmp")),true)))) {	AION_ECHO("ERROR! json_decode(file_get_contents($file))"); }
AION_NEWSTRONGS_FIX_REF_HEBREW($database['HEBRF1'],'TOTHT',$database, $database['HEBLEX'], $database['HEBMOR']);	AION_unset($database['HEBRF1']);
if (!is_array(($database['HEBRF2'] = json_decode(file_get_contents(($file="$INPUT_TOTX2.tmp")),true)))) {	AION_ECHO("ERROR! json_decode(file_get_contents($file))"); }
AION_NEWSTRONGS_FIX_REF_HEBREW($database['HEBRF2'],'TOTHT',$database, $database['HEBLEX'], $database['HEBMOR']);	AION_unset($database['HEBRF2']);
if (!is_array(($database['HEBRF3'] = json_decode(file_get_contents(($file="$INPUT_TOTX3.tmp")),true)))) {	AION_ECHO("ERROR! json_decode(file_get_contents($file))"); }
AION_NEWSTRONGS_FIX_REF_HEBREW($database['HEBRF3'],'TOTHT',$database, $database['HEBLEX'], $database['HEBMOR']);	AION_unset($database['HEBRF3']);
if (!is_array(($database['HEBRF4'] = json_decode(file_get_contents(($file="$INPUT_TOTX4.tmp")),true)))) {	AION_ECHO("ERROR! json_decode(file_get_contents($file))"); }
AION_NEWSTRONGS_FIX_REF_HEBREW($database['HEBRF4'],'TOTHT',$database, $database['HEBLEX'], $database['HEBMOR']);	AION_unset($database['HEBRF4']);
if (file_put_contents("$FOLDER_STAGE$CHECK_HHOT","</body></html>",FILE_APPEND) === FALSE ) { AION_ECHO("ERROR! $FOLDER_STAGE$CHECK_HHOT"); } // FILE_APPEND
AION_unset($database['HEBMOR']);
AION_NEWSTRONGS_VALIDATE_REF("old", $database, $database['TOTHT']);
AION_NEWSTRONGS_VALIDATE_HEBREW($database['TOTHT'], $FOLDER_STAGE."CHECK_VALIDATE_HEBREW_TRANSLITERATION.txt",				1, "TAHOT Validation: Same ExtendedStrongs H=[Hebrew] with multiple T=[Transliterations]");
AION_NEWSTRONGS_VALIDATE_HEBREW($database['TOTHT'], $FOLDER_STAGE."CHECK_VALIDATE_HEBREW_GRAMMAR.txt",						2, "TAHOT Validation: Same ExtendedStrongs H=[Hebrew] with multiple M=[Morphhologies]");
AION_NEWSTRONGS_VALIDATE_HEBREW($database['TOTHT'], $FOLDER_STAGE."CHECK_VALIDATE_HEBREW_STRONGS.txt",						3, "TAHOT Validation: Same ExtendedStrongs H=[Hebrew] with muptiple S=[Strongs]");
AION_NEWSTRONGS_VALIDATE_HEBREW($database['TOTHT'], $FOLDER_STAGE."CHECK_VALIDATE_HEBREW_STRONGS_TRANSLATION_GAMMAR.txt",	4, "TAHOT Validation: Same ExtendedStrongs H=[Strongs+Translation] with multiple M=[Morphhologies]");
$commentplus = <<<EOT
# Source: Tyndale House, Cambridge, www.TyndaleHouse.com
# Source Content: Old Testament Strong's Tagged Text
# Source Link: https://tyndale.github.io/STEPBible-Data
# Source Application: https://www.STEPBible.org
# Source Copyright: Creative Commons Attribution Non-Commercial 4.0
#
# COLUMNS
#
#	INDX		Book index
#	BOOK		Book name
#	CHAP		Chapter number
#	VERS		Verse number
#	STRONGS		Strongs entry number
#	JOIN		Relation to previous word: 
#				"W"		=> "Next word",
#				"W$"	=> "Next word (Hebrew root)",
#				"W+"	=> "Next word (+following shares Strongs)",
#				"C"		=> "Continue previous word",
#				"C$"	=> "Continue previous word (Hebrew root)",
#				"C+"	=> "Continue previous word (+following shares Strongs)",
#				"J"		=> "Joined with previous word",
#				"J$"	=> "Joined with previous word (Hebrew root)",
#				"D"		=> "Divided from previous word",
#				"D$"	=> "Divided from previous word (Hebrew root)",
#				"L"		=> "Link previous-next word",
#				"P"		=> "Punctuation",
#	TYPE		Source description
#				The STEPBible translator resource tags Old Testament words as L = Leningrad (the default tag); Q = Qere 'spoken' corrections from margin and text pointing; K = Ketiv 'written', Tyndale pointing; R = restored text based on Leningrad parallels; and X = extra words from the Septuagint (LXX), in Hebrew, based on BHS and BHK. Other letters indicate parallels and variants with A = Aleppo; B = Biblia Hebraica Stuttgartensia; C = Cairensis; D = Dead Sea and Judean Desert manuscripts; E = emendation from ancient sources, F = format pointing or word division differences without changing letters; H = Ben Chaim (2nd Rabbinic Bible); P = alternate punctuation; S = scribal traditions; and V = variants from other Hebrew manuscripts. Tags place identical sources outside of parens in upper case. Variant tags are inside parens: uppercase are meaning variants, lower case are minor variants, and differing variants are joined with a “+”. Translators normally follow L, and when this presents a choice between Q and K they follow Q, so K is presented as a variant. Tags in STEP Hebrew are only available when viewed in parallel with STEP English at www.AionianBible.org/Bibles/Hebrew---Hebrew-STEPBible/Genesis/1/parallel-English---STEPBible-Amalgamant.
#				"A"			=> "Aleppo",
#				"B"			=> "Biblia Hebraica Stuttgartensia",
#				"C"			=> "Cairensis",
#				"D"			=> "Dead Sea and Judean Desert manuscripts",
#				"E"			=> "Emendation from ancient sources",
#				"F"			=> "Format pointing or word division difference without letter changes",
#				"H"			=> "Ben Chaim (2nd Rabbinic Bible)",
#				"K"			=> "Ketiv 'written' in the text with Tyndale pointing",
#				"L"			=> "Leningrad",
#				"L(a+bh)"	=> "Leningrad with minor variants: Aleppo plus BHS and Ben Chaim",
#				"L(a+V)"	=> "Leningrad with minor variants: Aleppo plus meaning variants: other Hebrew manuscripts",
#				"L(abh)"	=> "Leningrad with minor variants: Aleppo, BHS, and Ben Chaim",
#				"L(ah+b)"	=> "Leningrad with minor variants: Aleppo and Ben Chaim plus BHS",
#				"L(AH+B)"	=> "Leningrad with meaning variants: Aleppo and Ben Chaim plus BHS",
#				"L(b)"		=> "Leningrad with minor variants: BHS",
#				"L(b+p)"	=> "Leningrad with minor variants: BHS plus alternate punctuation",
#				"L(bah)"	=> "Leningrad with minor variants: Aleppo, BHS, and Ben Chaim",
#				"L(D)"		=> "Leningrad with meaning variants: Dead Sea and Judean Desert manuscripts",
#				"L(E)"		=> "Leningrad with meaning variants: emendation from ancient sources",
#				"L(F)"		=> "Leningrad with meaning variants: format pointing or word division difference without letter changes",
#				"L(H)"		=> "Leningrad with meaning variants: Ben Chaim (2nd Rabbinic Bible)",
#				"L(p)"		=> "Leningrad with minor variants: alternate punctuation",
#				"L(P)"		=> "Leningrad with meaning variants: alternate punctuation",
#				"L(S)"		=> "Leningrad with meaning variants: scribal traditions",
#				"L(V)"		=> "Leningrad with meaning variants: other Hebrew manuscripts",
#				"LA(bh)"	=> "Leningrad and Aleppo with minor variants: BHS and Ben Chaim",
#				"LA(BH)"	=> "Leningrad and Aleppo with meaning variants: BHS and Ben Chaim",
#				"LAB(h)"	=> "Leningrad, Aleppo, and BHS with minor variants: Ben Chaim",
#				"LAB(H)"	=> "Leningrad, Aleppo, and BHS with meaning variants: Ben Chaim",
#				"LAH(b)"	=> "Leningrad, Aleppo, and Ben Chaim with minor variants: BHS",
#				"LB(ah)"	=> "Leningrad and BHS with minor variants: Aleppo and Ben Chaim",
#				"LB(AH)"	=> "Leningrad and BHS with meaning variants: Aleppo and Ben Chaim",
#				"LB(ha)"	=> "Leningrad and BHS with minor variants: Aleppo and Ben Chaim",
#				"LBH(a)"	=> "Leningrad, BHS, and Ben Chaim with minor variants: Aleppo",
#				"LBH(A)"	=> "Leningrad, BHS, and Ben Chaim with meaning variants: Aleppo",
#				"LBH(a+C)"	=> "Leningrad, BHS, and Ben Chaim with minor variants: Aleppo plus meaning variants: Cairensis",
#				"LH(ab)"	=> "Leningrad and Ben Chaim with minor variants: Aleppo and BHS",
#				"P"			=> "Alternate punctuation",
#				"Q"			=> "Qere 'spoken' corrections from margin and text pointing",
#				"Q(k)"		=> "Qere 'spoken' corrections from margin and text pointing, with minor variants: Ketiv 'written', Tyndale pointing",
#				"Q(K)"		=> "Qere 'spoken' corrections from margin and text pointing, with meaning variants: Ketiv 'written', Tyndale pointing",
#				"R"			=> "Restored text based on Leningrad parallels",
#				"S"			=> "Scribal traditions",
#				"V"			=> "Variants from other Hebrew manuscripts",
#				"X"			=> "Extra words from Septuagint (LXX), in Hebrew based on apparatus in BHS and BHK",
#	UNDER		Hebrew underlying word
#	TRANS		Hebrew transliteration
#	LEXICON		Hebrew lexicon word
#	ENGLISH		English word in context
#	GLOSS		English from lexicon
#	MORPH		Morphhology grammar
#	EDITIONS	Found in these editions 
#	VAR			Translation variations
#	SPELL		Spelling variations
#	EXTRA		Extra notes
#	ALT			Alternate strongs numbers used
#

EOT;
$commentplus = AION_FILE_DATA_PUT_HEADER("$HEBREW_TAGED_DATA", strlen($database['TOTHT']), $commentplus);
if ( file_put_contents($file="$FOLDER_STAGE$HEBREW_TAGED_DATA", ($temp=$commentplus.$database['TOTHT'])) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }
unset($temp); $temp=NULL;
AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_TAGED_DATA ROWS=".substr_count($database['TOTHT'], "\n"));
AION_NEWSTRONGS_GET_INDEX_TAG("$FOLDER_STAGE$HEBREW_TAGED_DATA", "$FOLDER_STAGE$HEBREW_TAGED_INDX");
AION_NEWSTRONGS_TAG_INDEX_CHECKER("$FOLDER_STAGE$HEBREW_TAGED_INDX", "$FOLDER_STAGE$HEBREW_TAGED_DATA", array("1.1:1","10.1:1","20.1:1","30.1:1","39.1:1","39.4:6"));
AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_TAGED_INDX");
AION_NEWSTRONGS_COUNT_REF($database['TOTHT'],"$FOLDER_STAGE$HEBREW_TAGED_NUMS");
AION_NEWSTRONGS_COUNT_REF_CHECKER("$FOLDER_STAGE$HEBREW_TAGED_NUMS",
	"$INPUT_TOTH1", NULL, NULL,
	"$INPUT_TOTH2", NULL, NULL,
	"$INPUT_TOTH3", NULL, NULL,
	"$INPUT_TOTH4", NULL, NULL,
	"$FOLDER_STAGE$HEBREW_TAGED_FILE",
	$SAVETHECOUNTCHECKER,
	"H");
AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_TAGED_NUMS");
AION_NEWSTRONGS_USAGE_REF('old', $database['TOTHT'], "$FOLDER_STAGE$HEBREW_USAGE_DATA", "$FOLDER_STAGE$HEBREW_USAGE_INDX");
AION_NEWSTRONGS_USAGE_REF_CHECKER("$FOLDER_STAGE$HEBREW_USAGE_INDX", "$FOLDER_STAGE$HEBREW_USAGE_DATA");
AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_USAGE_DATA");
AION_unset($database['TOTHT']);
AION_NEWSTRONGS_LEX_WIPE($database['HEBLEX']);
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_UHEB",($temp="Strongs numbers in lexicon, but not in tagged texts\n===\n\n".implode("\n", array_map($callback, $database['HEBLEX'])))) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }
unset($temp); $temp=NULL;
AION_unset($database['HEBLEX']);
AION_NEWSTRONGS_GET_INDEX_LEX("$FOLDER_STAGE$HEBREW_TBESH_DATA","$FOLDER_STAGE$HEBREW_TBESH_INDX");
AION_NEWSTRONGS_GET_INDEX_LEX_CHECKER("$FOLDER_STAGE$HEBREW_TBESH_INDX","$FOLDER_STAGE$HEBREW_TBESH_DATA","2428");
AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_TBESH_INDX");
AION_NEWSTRONGS_SORT_REF_CHECKER(
	"$FOLDER_STAGE$HEBREW_TAGED_FILE",
	"$FOLDER_STAGE$HEBREW_TAGED_FILS",
	"$FOLDER_STAGE$HEBREW_TAGED_DATA",
	"$FOLDER_STAGE$HEBREW_TAGED_DATS",
	"$FOLDER_STAGE$HEBREW_TAGED_DIFF",
	"H");




//////////////////////////////////////////////////////////////////////////////////////////////////
// TYNDALE GREEK READ
AION_NEWSTRONGS_COD( "$INPUT_TEGMC",'GREMOR', $database, TRUE);
AION_NEWSTRONGS_GET( "$INPUT_TBESG",'G0001	G0001G =	G0001G	α, Ἀλφα',	NULL, 'GRELEX',
	array('','STRONGS','STRONGU','WORD','TRANS','MORPH','GLOSS','DEF'),
	array('','STRONGS','STRONGU','WORD','TRANS','','GLOSS','DEF'), "$FOLDER_STAGE$CHECK_EGLX",
	array('STRONGS','STRONGU','WORD','TRANS','GLOSS','MORPH','DEF'),
	'STRONGS', $database, TRUE);
AION_NEWSTRONGS_GET_LEXY('GRELEX', $database);
AION_NEWSTRONGS_GET( "$INPUT_TFLS1",'G0001	G0001G =	G0001G	α, Ἀλφα',	NULL, 'GRELSJ',
	array('','STRONGS','STRONGU','WORD','TRANS','MORPH','GLOSS','DEF'),
	array('','STRONGS','STRONGU','WORD','TRANS','','GLOSS','DEF'), "$FOLDER_STAGE$CHECK_ELSJ",
	array('STRONGS','STRONGU','WORD','TRANS','GLOSS','MORPH','DEF'),
	'STRONGS', $database, TRUE);
AION_NEWSTRONGS_GET( "$INPUT_TFLS2",'G6000	G6000 =	G6000	ἀγγέλλω',NULL, 'GRELSJ',
	array('','STRONGS','STRONGU','WORD','TRANS','MORPH','GLOSS','DEF'),
	array('','STRONGS','STRONGU','WORD','TRANS','','GLOSS','DEF'), "$FOLDER_STAGE$CHECK_ELSJ",
	array('STRONGS','STRONGU','WORD','TRANS','GLOSS','MORPH','DEF'),
	'STRONGS', $database, TRUE);
AION_NEWSTRONGS_GET_LEXY('GRELSJ', $database);
// do the greek earlier so they are done
//AION_NEWSTRONGS_GET_PREP("$INPUT_TAGN1", "$INPUT_TAGX1");
//AION_NEWSTRONGS_GET_PREP("$INPUT_TAGN2", "$INPUT_TAGX2");
AION_NEWSTRONGS_GET( "$INPUT_TAGX1", "040	MAT	001	001	00001", NULL, 'GREREF1',
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','LEXICON','ENGLISH','GLOSS','STRONGS','MORPH','EDITIONS','VAR','SPELL','EXTRA','CONJOIN','INSTANCE','ALT'),
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','LEXICON','ENGLISH','GLOSS','STRONGS','MORPH','EDITIONS','','','','CONJOIN','',''),
	"$FOLDER_STAGE$CHECK_EGTG",
	NULL,
	NULL, $database);
AION_NEWSTRONGS_GET( "$INPUT_TAGX2", "044	ACT	001	001	00001", NULL, 'GREREF2',
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','LEXICON','ENGLISH','GLOSS','STRONGS','MORPH','EDITIONS','VAR','SPELL','EXTRA','CONJOIN','INSTANCE','ALT'),
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','LEXICON','ENGLISH','GLOSS','STRONGS','MORPH','EDITIONS','','','','CONJOIN','',''),
	"$FOLDER_STAGE$CHECK_EGTG",
	NULL,
	NULL, $database);
// TYNDALE GREEK WRITE
if ( file_put_contents($json="$FOLDER_STAGE$GREEK_MORPH_DATA",($temp=json_encode($database['GREMOR'], $strongs_json_flag))) === FALSE ) { AION_ECHO("ERROR! json_encode: ".$json ); }
unset($temp); $temp=NULL;
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_MORPH_DATA ROWS=".count($database['GREMOR']));

// TOTALLY UGLY - PUT THE MORPH SEARCH AND REPLACE INTO GLOBALS!
// before init load the morph search and replace
$GLOBALS['MORPH']['TAG_REPLACE'] = $GLOBALS['MORPH']['TAG_SEARCH'] = array();
foreach($database['GREMOR'] as $key => $morph) {
	$GLOBALS['MORPH']['TAG_SEARCH'][] = "#={$key} #u";
	$GLOBALS['MORPH']['TAG_REPLACE'][] = '=<a href="javascript:void(0)" title="'.trim($morph['M'].', '.$morph['U'],", ").'">'.$key.'</a> ';
}
AION_ECHO("WARN! GREEK TOTALLY UGLY tag morph count = ".count($GLOBALS['MORPH']['TAG_REPLACE']));
$htmlheader = <<<EOT
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<title>Aionian Bible Project: $file HTML Errors</title>
<meta name='description' content="Aionian Bible Project: $file HTML Errors">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name='apple-mobile-web-app-capable' content='yes'>
<meta name="generator" content="ABCMS™">
<meta http-equiv='x-ua-compatible' content='ie=edge'>
<style>
	body { padding: 50px;}
	div.head { margin: 20px; }
	div.body { margin: 50px; }
</style>
</head>
<body>
<div class='head'>
<h1>Aionian Bible Project: TAGNT HTML Errors</h1>
</div>

EOT;
if (file_put_contents("$FOLDER_STAGE$CHECK_HTAG",$htmlheader) === FALSE ) { AION_ECHO("ERROR! $FOLDER_STAGE$CHECK_HHOT"); } // FILE_APPEND




// Okay back to business
AION_NEWSTRONGS_GET_FIX_LEX('TBESG', $database['GRELEX'], $database, $database['GREMOR'],"$FOLDER_STAGE$CHECK_HTMG");
AION_NEWSTRONGS_GET_FIX_INDEX($database['GRELEX']);
$commentplus = <<<EOT
# Source: Tyndale House, Cambridge, www.TyndaleHouse.com
# Source Content: Extended Strong's Greek Lexicon
# Source Link: https://tyndale.github.io/STEPBible-Data
# Source Application: https://www.STEPBible.org
# Source Copyright: Creative Commons Attribution Non-Commercial 4.0
# Source Definitions: Uses Abbot-Smith or Middle Liddel or Mounce's Teknia when entries are missing. 
# Source Definitions: (AS) = Abbott Smith - from https://github.com/translatable-exegetical-tools/Abbott-Smith, with corrections and adapted by Tyndale Scholars. 
# Source Definitions: (ML) = Middle Liddell - from Perseus - used for Meaning in the Brief lexicon when there is no entry by (AS)
# Source Definitions: (MT) = Mounce's Teknia Greek dictionary - from www.billmounce.com/greek-dictionary (with permission) - used for Meaning in the Brief lexicon when there is no entry by (AS) or (ML)
#
# COLUMNS
#	STRONGS	Strong's number with extensions
#	WORD	Greek word in unicode lexical form. Based on LSJ but conforming to BADG when the difference may be confusing.
#	TRANS	Transliteration
#	GLOSS	A meaning in one word or as few as possible (by Tyndale scholars)
#	MORPH	Simple gramatical value of the main word represented as Language:Type-Gender-Extra
#	STRONGU	Unified Strong's entry and explanation
#	DEF		Definition, lexical entry.
#

EOT;
AION_FILE_DATA_PUT("$FOLDER_STAGE$GREEK_TBESG_DATA", $database['GRELEX'], $commentplus);
AION_NEWSTRONGS_LEX_MORPH_LEX($database['GRELEX']);
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_TBESG_DATA ROWS=".count($database['GRELEX']));
AION_NEWSTRONGS_GET_FIX_LEX('TFLSJ', $database['GRELSJ'], $database, $database['GREMOR'],"$FOLDER_STAGE$CHECK_HTML");
AION_unset($database['VIZLEX']);
AION_NEWSTRONGS_GET_FIX_INDEX($database['GRELSJ']);
$commentplus = <<<EOT
# Source: Tyndale House, Cambridge, www.TyndaleHouse.com
# Source Content: Full Liddell Scott Jones Greek Lexicon
# Source Link: https://tyndale.github.io/STEPBible-Data
# Source Application: https://www.STEPBible.org
# Source Copyright: Creative Commons Attribution Non-Commercial 4.0
# Source Definitions: Full Liddell-Scott-Jones - from Perseus, with additional features and corrections by Tyndale House, Cambridge
#
# COLUMNS
#	STRONGS	Strong's number with extensions
#	WORD	Greek word in unicode lexical form. Based on LSJ but conforming to BADG when the difference may be confusing.
#	TRANS	Transliteration
#	GLOSS	A meaning in one word or as few as possible (by Tyndale scholars)
#	MORPH	Simple gramatical value of the main word represented as Language:Type-Gender-Extra
#	STRONGU	Unified Strong's entry and explanation
#	DEF		The LJS lexicon uses the Full LSJ formatted by Tyndale House, Cambridge.
#

EOT;
AION_FILE_DATA_PUT("$FOLDER_STAGE$GREEK_TFLSJ_DATA", $database['GRELSJ'], $commentplus);
AION_NEWSTRONGS_LEX_MORPH_LEX($database['GRELSJ']);
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_TFLSJ_DATA ROWS=".count($database['GRELSJ']));
AION_NEWSTRONGS_FIX_REF_GREEK($database['GREREF1'],'GRERE2',$database, $database['GRELEX'], $database['GRELSJ'], $database['GREMOR']);
AION_NEWSTRONGS_FIX_REF_GREEK($database['GREREF2'],'GRERE2',$database, $database['GRELEX'], $database['GRELSJ'], $database['GREMOR']);
if (file_put_contents("$FOLDER_STAGE$CHECK_HTAG","</body></html>",FILE_APPEND) === FALSE ) { AION_ECHO("ERROR! $FOLDER_STAGE$CHECK_HTAG"); } // FILE_APPEND
AION_NEWSTRONGS_VALIDATE_REF("new", $database, $database['GRERE2']);
AION_unset($database['GREREF1']);
AION_unset($database['GREREF2']);
AION_unset($database['GREMOR']);
AION_NEWSTRONGS_VALIDATE_GREEK($database['GRERE2'], $FOLDER_STAGE."CHECK_VALIDATE_GREEK_MORPH.txt",	1, "TAGNT Validation: Same Greek G=[Greek] with multiple M=[dStrong=Grammar]");
AION_NEWSTRONGS_VALIDATE_GREEK($database['GRERE2'], $FOLDER_STAGE."CHECK_VALIDATE_GREEK_GLOSS.txt",	2, "TAGNT Validation: Same Greek G=[Greek] with multiple G=[Dictionary=Gloss]");
$commentplus = <<<EOT
# Source: Tyndale House, Cambridge, www.TyndaleHouse.com
# Source Content: New Testament Strong's Tagged Text
# Source Link: https://tyndale.github.io/STEPBible-Data
# Source Application: https://www.STEPBible.org
# Source Copyright: Creative Commons Attribution Non-Commercial 4.0
#
# COLUMNS
#	INDX		Book index
#	BOOK		Book name
#	CHAP		Chapter number
#	VERS		Verse number
#	STRONGS		Strongs entry number
#	JOIN		Relation to previous word: 
#				"W"		=> "Next word",
#				"C"		=> "Continue the previous word",
#				"J"		=> "Join with previous word",
#				"D"		=> "Divide from previous word",
#				"L"		=> "Link previous-next word",
#				"P"		=> "Punctuation",
#	TYPE		Source description
#				The STEPBible translator resource tags New Testament words as N = Nestlé-Aland NA27 edition with NA28 spelling used by most modern translators; K = Textus Receptus (Scrivener 1894) corrected towards the KJV; and O = Greek in other editions which is not normally used by modern translations or the KJV. NKO without parens, (the default tag), means all editions include the same vocabulary and grammar, though the spelling may vary. Variant tags are inside parens, uppercase are meaning variants and lower case are minor differences and variants. New Testament study is revolutionized by the discovery of earlier manuscripts in North Africa and other discoveries. The NA text is based mostly on these earlier manuscripts, while the TR text was compiled from traditional manuscripts that were available before the earlier ones were found. Later scribes occasionally removed ambiguities with changes like adding phrases to clarify the text. There are no instances of changed theology, confirmed by the huge failed effort to find even one. Less discussed are the words found in the earlier manuscripts, but not in the later. The best explanation is that additions found only in earlier manuscripts and additions found only in later ones are simply two sets of additions by scribes to clarify the text with no theological agenda. So, if you want the very earliest text, use only the words that are in both NA and TR. If you want to include clarifications by North African believers as in modern Bibles, then include words found only in NA. If you want to include the clarifications by Byzantine scribes as in the KJV, then include the words found only in TR, and use the TR variants.
#				"(k)O"		=> "Minor variants in KJV sources, present in other sources, absent in Nestlé-Aland sources",
#				"k"			=> "Minor not translated from KJV sources, absent in Nestlé-Aland and other sources",
#				"K"			=> "Present in KJV sources, absent in Nestlé-Aland and other sources",
#				"k(o)"		=> "Minor not translated from KJV sources, minor variants in other sources, absent in Nestlé-Aland sources",
#				"K(o)"		=> "Present in KJV sources, minor variants in other sources, absent in Nestlé-Aland sources",
#				"K(O)"		=> "Present in KJV sources, meaning variants in other sources, absent in Nestlé-Aland sources",
#				"ko"		=> "Minor not translated from KJV and other sources, absent in Nestlé-Aland sources",
#				"KO"		=> "Identical in KJV and other sources, absent in Nestlé-Aland sources",
#				"n"			=> "Minor not translated from Nestlé-Aland sources, absent in KJV and other sources",
#				"N"			=> "Present in Nestlé-Aland sources, absent in KJV and other sources",
#				"N(k)"		=> "Present in Nestlé-Aland sources, minor variants in KJV sources, absent in other sources",
#				"N(k)(o)"	=> "Present in Nestlé-Aland sources, minor variants in KJV and other sources",
#				"N(k)(O)"	=> "Present in Nestlé-Aland sources, minor variants in KJV sources, meaning variants in other sources",
#				"N(K)(o)"	=> "Present in Nestlé-Aland sources, meaning variants in KJV sources, minor variants in other sources",
#				"N(K)(O)"	=> "Present in Nestlé-Aland sources, meaning variants in KJV and other sources",
#				"N(k)O"		=> "Identical in Nestlé-Aland and other sources, minor variants in KJV sources",
#				"N(K)O"		=> "Identical in Nestlé-Aland and other sources, meaning variants in KJV sources",
#				"n(o)"		=> "Minor not translated from Nestlé-Aland sources, minor variants in other sources, absent in KJV sources",
#				"N(o)"		=> "Present in Nestlé-Aland sources, minor variants in other sources, absent in KJV sources",
#				"N(O)"		=> "Present in Nestlé-Aland sources, meaning variants in other sources, absent in KJV sources",
#				"NK"		=> "Identical in Nestlé-Aland and KJV sources, absent in other sources",
#				"NK(o)"		=> "Identical in Nestlé-Aland and KJV sources, minor variants in other sources",
#				"NK(O)"		=> "Identical in Nestlé-Aland and KJV sources, meaning variants in other sources",
#				"NKO"		=> "Identical in Nestlé-Aland, KJV, and other sources",
#				"no"		=> "Minor not translated from Nestlé-Aland and other sources, absent in KJV sources",
#				"NO"		=> "Identical in Nestlé-Aland and other sources, absent in KJV sources",
#				"o"			=> "Minor not translated from other sources, absent in Nestlé-Aland and KJV sources",
#				"O"			=> "Present in other sources, absent in Nestlé-Aland and KJV sources",
#	UNDER		Hebrew underlying word
#	TRANS		Hebrew transliteration
#	LEXICON		Hebrew lexicon word
#	ENGLISH		English word in context
#	GLOSS		English from lexicon
#	MORPH		Morphhology grammar
#	EDITIONS
#				"Byz"		=> "Byzantine from Robinson/Pierpoint",
#				"Coptic"	=> "Coptic",
#				"ESV"		=> "English Standard Version",
#				"Goodnews"	=> "Goodnews",
#				"KJV"		=> "King James Version",
#				"KJV?"		=> "King James Version possibly",
#				"NA26"		=> "Nestle/Aland 26th Edition",
#				"NA27"		=> "Nestle/Aland 27th Edition",
#				"NA28"		=> "Nestle/Aland 28th Edition, not ECM",
#				"Latin"		=> "Latin",
#				"NIV"		=> "New International Version",
#				"OldLatin"	=> "Old Latin",
#				"OldSyriac"	=> "Old Syriac version",
#				"P46"		=> "Papyri #46",
#				"P66"		=> "Papyri #66",
#				"P66*"		=> "Papyri #66 corrector",
#				"Punc"		=> "Accent variant from punctuation",
#				"SBL"		=> "Society of Biblical Literature Greek NT",
#				"Syriac"	=> "Syriac",
#				"TR"		=> "Textus Receptus",
#				"Treg"		=> "Tregelles",
#				"Tyn"		=> "Tyndale House GNT",
#				"U1"		=> "Uncial Codex #1, Sinaiticus",
#				"U2"		=> "Uncial Codex #2",
#				"U3"		=> "Uncial Codex #3, Alexandrinus",
#				"U4"		=> "Uncial Codex #4",
#				"U5"		=> "Uncial Codex #5, Bezae",
#				"U6"		=> "Uncial Codex #6",
#				"U32"		=> "Uncial Codex #32",
#				"WH"		=> "Westcott/Hort",
#	VAR			Translation variations
#	SPELL		Spelling variations
#	EXTRA		Extra notes
#	ALT			Alternate strongs numbers used
#

EOT;
$commentplus = AION_FILE_DATA_PUT_HEADER("$GREEK_TAGED_DATA", strlen($database['GRERE2']), $commentplus);
if ( file_put_contents($file="$FOLDER_STAGE$GREEK_TAGED_DATA", ($temp=$commentplus.$database['GRERE2'])) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }
unset($temp); $temp=NULL;
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_TAGED_DATA ROWS=".substr_count($database['GRERE2'], "\n"));
AION_NEWSTRONGS_GET_INDEX_TAG("$FOLDER_STAGE$GREEK_TAGED_DATA", "$FOLDER_STAGE$GREEK_TAGED_INDX");
AION_NEWSTRONGS_TAG_INDEX_CHECKER("$FOLDER_STAGE$GREEK_TAGED_INDX", "$FOLDER_STAGE$GREEK_TAGED_DATA", array("43.1:1","43.3:16","50.1:1","60.1:1","66.1:1","66.22:21"));
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_TAGED_INDX");
AION_NEWSTRONGS_COUNT_REF($database['GRERE2'],"$FOLDER_STAGE$GREEK_TAGED_NUMS");
AION_NEWSTRONGS_COUNT_REF_CHECKER("$FOLDER_STAGE$GREEK_TAGED_NUMS",
//	"$INPUT_TAGX1",NULL, NULL,
//	"$INPUT_TAGX2",NULL, NULL,
	"$INPUT_TAGN1",NULL, NULL,
	"$INPUT_TAGN2",NULL, NULL,
	NULL,NULL,NULL,
	NULL,NULL,NULL,
	"$FOLDER_STAGE$GREEK_TAGED_FILE",
	$SAVETHECOUNTCHECKER,
	"G");
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_TAGED_NUMS");
AION_NEWSTRONGS_USAGE_REF('new', $database['GRERE2'], "$FOLDER_STAGE$GREEK_USAGE_DATA", "$FOLDER_STAGE$GREEK_USAGE_INDX");
AION_NEWSTRONGS_USAGE_REF_CHECKER("$FOLDER_STAGE$GREEK_USAGE_INDX", "$FOLDER_STAGE$GREEK_USAGE_DATA");
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_USAGE_DATA");
AION_unset($database['GRERE2']);
AION_NEWSTRONGS_LEX_WIPE($database['GRELEX']);
AION_NEWSTRONGS_LEX_WIPE($database['GRELSJ']);
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_UGRE",
($temp="Strongs numbers in lexicon, but not in tagged texts\n===\n\n".implode("\n", array_map($callback, $database['GRELEX'])))) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }
unset($temp); $temp=NULL;
AION_unset($database['GRELEX']);
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_ULSJ",
($temp="Strongs numbers in lexicon, but not in tagged texts\n===\n\n".implode("\n", array_map($callback, $database['GRELSJ'])))) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }
unset($temp); $temp=NULL;
AION_unset($database['GRELSJ']);
AION_NEWSTRONGS_GET_INDEX_LEX("$FOLDER_STAGE$GREEK_TBESG_DATA", "$FOLDER_STAGE$GREEK_TBESG_INDX");
AION_NEWSTRONGS_GET_INDEX_LEX_CHECKER("$FOLDER_STAGE$GREEK_TBESG_INDX", "$FOLDER_STAGE$GREEK_TBESG_DATA","ALL");
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_TBESG_INDX");
AION_NEWSTRONGS_GET_INDEX_LEX("$FOLDER_STAGE$GREEK_TFLSJ_DATA","$FOLDER_STAGE$GREEK_TFLSJ_INDX");
AION_NEWSTRONGS_GET_INDEX_LEX_CHECKER("$FOLDER_STAGE$GREEK_TFLSJ_INDX","$FOLDER_STAGE$GREEK_TFLSJ_DATA","ALL");
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_TFLSJ_INDX");
AION_NEWSTRONGS_SORT_REF_CHECKER(
	"$FOLDER_STAGE$GREEK_TAGED_FILE",
	"$FOLDER_STAGE$GREEK_TAGED_FILS",
	"$FOLDER_STAGE$GREEK_TAGED_DATA",
	"$FOLDER_STAGE$GREEK_TAGED_DATS",
	"$FOLDER_STAGE$GREEK_TAGED_DIFF",
	"G");





//////////////////////////////////////////////////////////////////////////////////////////////////
// WRITE CHECK RESULTS
AION_NEWSTRONGS_LEX_MORPH(NULL,"$FOLDER_STAGE$CHECK_MORA");
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_BOOK", ($temp=implode("\n", $database['BOOKS']))) === FALSE ) {	AION_ECHO("ERROR! file_put: ".$file ); }
unset($temp); $temp=NULL;
AION_ECHO("CHECK $CHECK_BOOK ROWS=".count($database['BOOKS']));
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_MORF", $database['MISS_MORPHS']) === FALSE) {						AION_ECHO("ERROR! file_put: ".$file ); }
AION_ECHO("CHECK $CHECK_MORF ROWS=".substr_count($database['MISS_MORPHS'], "\n"));
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_MISS", $database['MISS_MANU']) === FALSE) {						AION_ECHO("ERROR! file_put: ".$file ); }
AION_ECHO("CHECK $CHECK_MISS ROWS=".substr_count($database['MISS_MANU'], "\n"));
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_STRG", $database['CORRUPT_STRONGS']) === FALSE ) {				AION_ECHO("ERROR! file_put: ".$file ); }
AION_ECHO("CHECK $CHECK_STRG ROWS=".substr_count($database['CORRUPT_STRONGS'], "\n"));
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_VARS", $database['CORRUPT_VARIANT']) === FALSE ) {				AION_ECHO("ERROR! file_put: ".$file ); }
AION_ECHO("CHECK $CHECK_VARS ROWS=".substr_count($database['CORRUPT_VARIANT'], "\n"));
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_FIXS", $database['FIXCOUNTS']) === FALSE ) {						AION_ECHO("ERROR! file_put: ".$file ); }
AION_ECHO("CHECK $CHECK_FIXS ROWS=".substr_count($database['FIXCOUNTS'], "\n"));
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_REFS", $database['REFERENCES']) === FALSE ) {						AION_ECHO("ERROR! file_put: ".$file ); }
AION_ECHO("CHECK $CHECK_REFS ROWS=".substr_count($database['REFERENCES'], "\n"));
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_WARN", $database['WARNINGS']) === FALSE ) {						AION_ECHO("ERROR! file_put: ".$file ); }
AION_ECHO("CHECK $CHECK_WARN ROWS=".substr_count($database['WARNINGS'], "\n"));






//////////////////////////////////////////////////////////////////////////////////////////////////
// FREE MEMORY
AION_unset($database);
$database = NULL;
unset($database);
gc_collect_cycles();




//////////////////////////////////////////////////////////////////////////////////////////////////
// MAKE STEBBIBLE
AION_NEWSTRONGS_STEPBIBLE(
	"$FOLDER_STAGE$HEBREW_TAGED_DATA",
	"$FOLDER_STAGE$HEBREW_TBESH_INDX",
	"$FOLDER_STAGE$HEBREW_TBESH_DATA",
	"$FOLDER_STAGE$GREEK_TAGED_DATA",
	"$FOLDER_STAGE$GREEK_TBESG_INDX",
	"$FOLDER_STAGE$GREEK_TBESG_DATA",
	"$STEPBIBLE_AMA",
	"$STEPBIBLE_CON",
	"$STEPBIBLE_HEB",
	"$STEPBIBLE_GRK"
	);




///////////////////////////////////////////////////////////////////////////////////////////////////
// COMPARE
AION_LOOP_DIFF('../www-stage/library/stepbible', '../stepbible-stage-DEVELOPMENT', '../STEPBible-Data-master-diff-cooked');


//////////////////////////////////////////////////////////////////////////////////////////////////
/*** done ***/
AION_ECHO("END!");

/*** for the diffs! ***/
echo "\n";
echo "\n";
echo "\n";
echo "\n";
readfile("$FOLDER_STAGE$CHECK_FIXS");

exit;




//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCTIONS
// Convert new Hebrew TAHOT back to old format
function AION_NEWSTRONGS_GET_PREPH($file, $fout) {
	// get the data
	$newmess = "PREPH\t$file";
	if ( !is_file( $file ) ) {											AION_ECHO("ERROR! $newmess !is_file()"); }
	if ( ($contents = file_get_contents( $file )) === FALSE ) {			AION_ECHO("ERROR! $newmess !file_get_contents()"); }
	if ( mb_detect_encoding($contents, "UTF-8", TRUE) === FALSE ) {
		//AION_ECHO("ERROR! $newmess !mb_detect_encoding()");
		
		AION_ECHO("WARN! $newmess !mb_detect_encoding()");
		if (file_put_contents( "$file.UTF8-BAD", $contents ) === FALSE ) { AION_ECHO("ERROR! $newmess !file_put_contents()"); }
		$contents = Encoding::toUTF8($contents);
		if (mb_detect_encoding($contents, "UTF-8", TRUE) === FALSE ) { AION_ECHO("ERROR! $newmess !mb_detect_encoding()"); }
		if (file_put_contents( $file, $contents ) === FALSE ) { AION_ECHO("ERROR! $newmess !file_put_contents()"); }
		
	}
	else {
		$contents2 = Encoding::toUTF8($contents);
		if ($contents2 != $contents && file_put_contents( "$file.UTF8-DIFF", $contents2 ) === FALSE ) { AION_ECHO("ERROR! $newmess !file_put_contents()"); }
		unset($contents2);
	}
	mb_regex_encoding("UTF-8");
	mb_internal_encoding("UTF-8");
	$lines = mb_split("\n", $contents);
	$output = array();
	$abooks = AION_BIBLES_LIST();
	$tbooks = AION_BIBLES_LIST_TYN();
	$count = 0;
	// loop through every line
	foreach( $lines as $data ) {
		++$count;
/* sample word line
Eng (Heb) Ref & Type	Hebrew	Transliteration	Translation	dStrongs	Grammar	Meaning Variants	Spelling Variants	Root dStrong+Instance	Alternative Strongs+Instance	Conjoin word	Expanded Strong tags					
Gen.1.1#01=L	בְּ/רֵאשִׁ֖ית	be./re.Shit	in/ beginning	H9003/{H7225G}	HR/Ncfsa			H7225G			H9003=ב=in/{H7225G=רֵאשִׁית=: beginning»first:1_beginning}					
Gen.1.1#02=L	בָּרָ֣א	ba.Ra'	he created	{H1254A}	HVqp3ms			H1254A			{H1254A=בָּרָא=to create}					
Gen.1.1#03=L	אֱלֹהִ֑ים	'E.lo.Him	God	{H0430G}	HNcmpa			H0430G			{H0430G=אֱלֹהִים=God»LORD@Gen.1.1-Heb}					
Gen.1.1#04=L	אֵ֥ת	'et	<obj.>	{H0853}	HTo			H0853_A			{H0853=אֵת=[Obj.]}					
Gen.1.1#05=L	הַ/שָּׁמַ֖יִם	ha./sha.Ma.yim	the/ heavens	H9009/{H8064}	HTd/Ncmpa			H8064			H9009=ה=the/{H8064=שָׁמַיִם=heaven}					
Gen.1.1#06=L	וְ/אֵ֥ת	ve./'Et	and/ <obj.>	H9002/{H0853}	HC/To			H0853_B			H9002=ו=and/{H0853=אֵת=[Obj.]}					
Gen.1.1#07=L	הָ/אָֽרֶץ\׃	ha./'A.retz	the/ earth	H9009/{H0776G}\H9016	HTd/Ncfsa			H0776G			H9009=ה=the/{H0776G=אֶ֫רֶץ=: country;_planet»land:2_country;_planet}\H9016=׃=verseEnd									
Eng (Heb) Ref & Type	Hebrew	Transliteration	Translation	dStrongs	Grammar	Meaning Variants	Spelling Variants	Root dStrong+Instance	Alternative Strongs+Instance	Conjoin word	Expanded Strong tags					
Deu.23.1(23.2)#01=L	לֹֽא\־	lo'-	not	{H3808}\H9014	HTn			H3808			{H3808=לֹא=not}\H9014=־=link					
Deu.23.1(23.2)#02=L	יָבֹ֧א	ya.Vo'	he will go	{H0935G}	HVqi3ms			H0935G			{H0935G=בּוֹא=: come»to come (in):1_come;_go_in}					
Deu.23.1(23.2)#03=L	פְצֽוּעַ\־	fe.tzu.a'-	[one who] is wounded of	{H6481}\H9014	HVqsmsc			H6481			{H6481=פָּצַע=to wound}\H9014=־=link					
Deu.23.1(23.2)#04=L	דַּכָּ֛א	da.Ka'	crushing	{H1795}	HNcfsa			H1795			{H1795=דַּכָּה=crushing}					
Deu.23.1(23.2)#05=L	וּ/כְר֥וּת	u./khe.Rut	and/ [one who] is cut off of	H9002/{H3772G}	HC/Vqsmsc			H3772G			H9002=ו=and/{H3772G=כָּרַת=: cut»to cut:1_cut;_fell}					
Deu.23.1(23.2)#06=L	שָׁפְכָ֖ה	sha.fe.Khah	penis	{H8212}	HNcfsa			H8212			{H8212=שׇׁפְכָה=penis}					
Deu.23.1(23.2)#07=L	בִּ/קְהַ֥ל	bi/k.Hal	in/ [the] assembly of	H9003/{H6951}	HR/Ncmsc			H6951			H9003=ב=in/{H6951=קָהָל=assembly}					
Deu.23.1(23.2)#08=L	יְהוָֽה\׃\ \ס	Yah.weh	Yahweh	{H3068G}\H9016\ \H9018	HNpt			H3068G			{H3068G=יהוה=LORD»LORD@Gen.1.1-Heb}\H9016=׃=verseEnd\ \H9018=ס=section				
Eng (Heb) Ref & Type	Hebrew	Transliteration	Translation	dStrongs	Grammar	Meaning Variants	Spelling Variants	Root dStrong+Instance	Alternative Strongs+Instance	Conjoin word	Expanded Strong tags	
*/
		// not a verse word line
		if (!preg_match('/^[[:alnum:]]{3}\.\d+\.\d+/', $data)) {
			continue;
		}
		
		// verse word line with alternate references, though don't use alternate reference
		//                     1                  2     3      X      X       4     5          6        7         8         9*        10*       11        12         13       14        15        16      17  
		else if (preg_match('/^([[:alnum:]]{3})\.(\d+)\.(\d+)\((\d+)\.(\d+)\)#(\d+)=([^\t]+)\t([^\t]*)\t([^\t]+)\t([^\t]+)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)(.*)$/', $data, $match)) {
			// Check for Qere and just echo a warning to keep track of these lines
			//                 1                  2     3      X      X       4     5          6        7         8         9+        10+       11        12         13       14        15        16      17  
			if (!preg_match('/^([[:alnum:]]{3})\.(\d+)\.(\d+)\((\d+)\.(\d+)\)#(\d+)=([^\t]+)\t([^\t]*)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)(.*)$/', $data)) {
				AION_ECHO("WARN! line=$count $newmess Qere empty fields 9 & 10: $data");
			}
			// pad the word number for LXX 4 digit word numbers
			if (strlen($match[6])!=2 && strlen($match[6])!=4) { AION_ECHO("ERROR! line=$count $newmess bad word sort number: $data"); }
			$psatmp = $match[6];
			$match[6] .= (strlen($match[6])==4 ? '' : '00');
			// Psalms special case, verse #0 words prefixed onto verse #1
			if ('Psa'==$match[1] && (int)$match[3]==0) {
				$match[3] = '1';
				$match[6] = '00'.$match[5].$psatmp;
			}
			// alternate reference numbering independent if partial verse, so if moving backwards, bump word number to beginning of verse
			else if ((int)$match[2]==(int)$match[4]+1 || // chapter-1
				($match[2]==$match[4] && (int)$match[3]>(int)$match[5])) { // verse-1
				$match[6] = '3'.$match[6];
			}
			// alternate reference numbering independent if partial verse, so if moving forwards, bump word number to end of verse
			else if ((int)$match[2]+1==(int)$match[4] || // chapter+1
				($match[2]==$match[4] && (int)$match[3]<(int)$match[5])) { // same chapter and verse+1
				$match[6] = '7'.$match[6];
			}
			// hey why are we here??? BOMB
			else {
				AION_ECHO("ERROR! line=$count $newmess bad reversification: $data");
			}

			// renumber the match array to be like regular verse word lines
			// unset($match[2]); unset($match[3]); // use the parened alternate reference, NOT ANY MORE!
			unset($match[4]); unset($match[5]); // use the standard reference and unset the alternate
			$match = array_values($match);			
		}
		
		// regular verse word line with no alternate reference
		//                     1                 2      3     4     5         6         7         8         9*        10*       11        12        13        14        15        16      17
		else if (preg_match('/^([[:alnum:]]{3})\.(\d+)\.(\d+)#(\d+)=([^\t]+)\t([^\t]*)\t([^\t]+)\t([^\t]+)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)(.*)$/', $data, $match)) {
			//  Check for Qere and just echo a warning to keep track of these lines
			//                 1                 2      3     4     5         6         7         8         9+        10+       11        12        13        14        15        16      17
			if (!preg_match('/^([[:alnum:]]{3})\.(\d+)\.(\d+)#(\d+)=([^\t]+)\t([^\t]*)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)(.*)$/', $data)) {
				AION_ECHO("WARN! line=$count $newmess Qere empty fields 9 & 10: $data");
			}
			// adjust the word number for LXX 4 digit word numbers
			if (strlen($match[4])!=2 && strlen($match[4])!=4) { AION_ECHO("ERROR! line=$count $newmess bad word sort number: $data"); }
			if (strlen($match[4])==2) { $match[4] .= '00'; }
			// Psalms special case, verse #0 words prefixed onto verse #1
			if ('Psa'==$match[1] && (int)$match[3]==0) {
				$match[3] = '1';
				$match[4] = '0'.$match[4];
			}
			else {
				$match[4] = '5'.$match[4]; // these words tagged with 5 in the middle of 3 and 7 above
			}
		}

		// hey we should not be here
		else {
			AION_ECHO("ERROR! line=$count $newmess bad line: $data");
		}
		
		// is there a value beyond valid fields, or word number not 5 digits? BOMB!
		if (!empty(trim($match[17])) || !empty($match[18]) || !empty($match[19]) || !empty($match[20]) || strlen($match[4])!=5) {
			AION_ECHO("ERROR! line=$count $newmess bad fields: $data");
		}

		// minimally parse and sanitize
		// book name and index 
		$book = strtoupper($match[1]);
		if (empty($tbooks[$book])) { AION_ECHO("ERROR! $newmess missing book='$book'\n".print_r($line,TRUE)); }
		$book = $tbooks[$book];
		$indx = sprintf('%03d', (int)array_search($book,array_keys($abooks)));
		$chap = sprintf('%03d', (int)$match[2]);
		$vers = sprintf('%03d', (int)$match[3]);		
		$numb = sprintf('%05d', (int)$match[4]);
		// remove spaces from type field
		$match[5] = preg_replace("#[\s]+#u","",$match[5]);
		// more clean up
		$match[6] = trim(preg_replace("#\s+#u"," ",$match[6]));
		$match[7] = trim(preg_replace("#\s+#u"," ",$match[7]));
		$match[8] = trim(preg_replace("#\s+#u"," ",$match[8]));
		$match[16] = preg_replace("#[{]+#u","",$match[16]);
		$match[16] = preg_replace("#[}]+#u","$",$match[16]);
		$match[16] = preg_replace("#([^\d]{1})[\d]{0,3}_#u",'$1 ',$match[16]); // scratch out the underlines
		$match[16] = trim(preg_replace("#\s+#u"," ",$match[16]));
		$match[10] = preg_replace("#\s+#u","",$match[10]);
		$match[11] = trim(preg_replace("#\s+#u"," ",$match[11]));
		$match[12] = trim(preg_replace("#\s+#u"," ",$match[12]));
		$match[13] = trim(preg_replace("#\s+#u"," ",$match[13]));
		$match[14] = trim(preg_replace("#\s+#u"," ",$match[14]));
		$match[9] = trim(preg_replace("#\s+#u","",$match[9]));

		// Error checks
		// DSTRONG === Extended STRONGS ??
		if (FALSE===preg_match_all("#H[\d]{1,5}[A-Za-z]{0,1}#u", $match[9],  $dstrongs, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! preg_match_all(DSTRONGS)\n".print_r($data,TRUE)); }
		if (FALSE===preg_match_all("#H[\d]{1,5}[A-Za-z]{0,1}#u", $match[16], $xstrongs, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! preg_match_all(XSTRONGS)\n".print_r($data,TRUE)); }
		if ($dstrongs[0] !== $xstrongs[0]) { AION_ECHO("ERROR! DSTRONGS !== XSTRONGS\n".print_r($dstrongs,TRUE)."\n".print_r($xstrongs,TRUE)."\n".print_r($data,TRUE)); }
		// Root STRONG in DSTRONGS ??
		if (!empty($match[9])) {
			if (FALSE===preg_match_all("#H[\d]{1,5}[A-Za-z]{0,1}#u", $match[13], $rstrongs, PREG_PATTERN_ORDER) || empty($rstrongs[0])) { AION_ECHO("ERROR! preg_match_all(RSTRONGS)!=1\n".print_r($data,TRUE)); }
			foreach($rstrongs[0] as $rstrongs1) {
				if (!preg_match("#\{{$rstrongs1}\}#u", $match[9])) { AION_ECHO("ERROR! preg_match(RSTRONGS not in DSTRONGS)\n".print_r($rstrongs,TRUE)."\n".print_r($data,TRUE)); }
			}
		}
		// Var or Alternate STRONGS in DSTRONGS ??
		if (FALSE===preg_match_all("#H[\d]{1,5}[A-Za-z]{0,1}#u", $match[11], $vstrongs, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! preg_match_all(ASTRONGS)\n".print_r($astrongs,TRUE)."\n".print_r($data,TRUE)); }
		if (count(array_intersect($dstrongs[0], $vstrongs[0]))) { AION_ECHO("WARN! VSTRONGS in DSTRONGS: $data"); }
		if (FALSE===preg_match_all("#H[\d]{1,5}[A-Za-z]{0,1}#u", $match[14], $astrongs, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! preg_match_all(ASTRONGS)\n".print_r($astrongs,TRUE)."\n".print_r($data,TRUE)); }
		if (count(array_intersect($dstrongs[0], $astrongs[0]))) { AION_ECHO("WARN! ASTRONGS in DSTRONGS: $data"); }

		// Alternate meaning present?
		$maintype = substr($match[5],1);
		if (!empty($match[5][1]) && ctype_upper($match[5][1]) && !preg_match("#{$match[5][1]}=#u", $match[11])) { AION_ECHO("WARN! TYPE not in ALTERNATE: $data"); }
		if (!empty($match[5][2]) && ctype_upper($match[5][2]) && !preg_match("#{$match[5][2]}=#u", $match[11])) { AION_ECHO("WARN! TYPE not in ALTERNATE: $data"); }
		if (!empty($match[5][3]) && ctype_upper($match[5][3]) && !preg_match("#{$match[5][3]}=#u", $match[11])) { AION_ECHO("WARN! TYPE not in ALTERNATE: $data"); }
		if (FALSE===preg_match("#^([A-Za-z]{1})=#ui", $match[11], $mtypes)) { AION_ECHO("ERROR! preg_match_all(MTYPES)\n".print_r($data,TRUE)); }
		if (!empty($mtypes[1]) && (!ctype_upper($mtypes[1]) || FALSE===strpos($maintype, $mtypes[1]))) { AION_ECHO("WARN! ALTERNATE=$mtypes1 not in TYPE=$maintype: $data"); }
		// Alternate spelling present?
		if (!empty($match[5][1]) && ctype_lower($match[5][1]) && !preg_match("#{$match[5][1]}=#ui", $match[12])) { AION_ECHO("WARN! TYPE not in SPELLING: $data"); }
		if (!empty($match[5][2]) && ctype_lower($match[5][2]) && !preg_match("#{$match[5][2]}=#ui", $match[12])) { AION_ECHO("WARN! TYPE not in SPELLING: $data"); }
		if (!empty($match[5][3]) && ctype_lower($match[5][3]) && !preg_match("#{$match[5][3]}=#ui", $match[12])) { AION_ECHO("WARN! TYPE not in SPELLING: $data"); }
		if (FALSE===preg_match_all("#([A-Za-z]{1})=#ui", $match[12], $mtypes, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! preg_match_all(MTYPES)\n".print_r($data,TRUE)); }
		if (!empty($mtypes[1])) {
			foreach($mtypes[1] as $mtypes1) {
				$mtypes1 = strtolower($mtypes1);
				if (FALSE===strpos($maintype, $mtypes1)) { AION_ECHO("WARN! SPELLING=$mtypes1 not in TYPE=$maintype: $data"); }
			}
		}
		
		// rows
		$output[] = "$indx	$book	$chap	$vers	$numb	$match[5]	$match[6]	$match[7]		$match[8]		$match[16]	$match[10]		$match[11]	$match[12]			$match[13]	$match[14]";
	}

	//sort and implode
	sort($output); // by book index, chapter, verse, and adjusted word number!
	// put a header on the file
	array_unshift($output, "INDEX	BOOK	CHAP	VERS	NUMB	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	STRONGS	MORPH	EDITIONS	VAR	SPELL	EXTRA	CONJOIN	INSTANCE	ALT");
	$output = implode("\n", $output);

	// result
	if (!($bytes=file_put_contents($fout, $output))) {		AION_ECHO("ERROR! $newmess !file_put_contents()"); }
	AION_unset($output); $output=NULL; unset($output);
	AION_unset($contents); $contents=NULL; unset($contents);
	AION_unset($lines); $lines=NULL; unset($lines);
	gc_collect_cycles();
	AION_ECHO("SUCCESS! $newmess lines=$count bytes=$bytes");
}



// Convert new format TAGNT back to old format
function AION_NEWSTRONGS_GET_PREP($file,$fout) {
	// load the data
	$newmess = "PREP\t$file";
	if ( !is_file( $file ) ) {											AION_ECHO("ERROR! $newmess !is_file()"); }
	if ( ($contents = file_get_contents( $file )) === FALSE ) {			AION_ECHO("ERROR! $newmess !file_get_contents()"); }
	if ( mb_detect_encoding($contents, "UTF-8", TRUE) === FALSE ) {
		AION_ECHO("ERROR! $newmess !mb_detect_encoding()");
		/*
		if (file_put_contents( "$file.UTF8-BAD", $contents ) === FALSE ) { AION_ECHO("ERROR! $newmess !file_put_contents()"); }
		$contents = Encoding::toUTF8($contents);
		if (mb_detect_encoding($contents, "UTF-8", TRUE) === FALSE ) { AION_ECHO("ERROR! $newmess !mb_detect_encoding()"); }
		if (file_put_contents( $file, $contents ) === FALSE ) { AION_ECHO("ERROR! $newmess !file_put_contents()"); }
		*/
	}
	else {
		$contents2 = Encoding::toUTF8($contents);
		if ($contents2 != $contents && file_put_contents( "$file.UTF8-DIFF", $contents2 ) === FALSE ) { AION_ECHO("ERROR! $newmess !file_put_contents()"); }
		unset($contents2);
	}
	mb_regex_encoding("UTF-8");
	mb_internal_encoding("UTF-8");
	$lines = mb_split("\n", $contents);
	$output = array();
	$abooks = AION_BIBLES_LIST();
	$tbooks = AION_BIBLES_LIST_TYN();
	$prevmatch = NULL;
	$count = 0;
	$indx_last = $chap_last = $vers_last = $numbnumb = NULL;
	// loop through all the lines
	foreach( $lines as $data ) {
		++$count;
/*
LATEST
Word & Type	Greek	English translation	dStrongs = Grammar	Dictionary form =  Gloss	editions	1st variant	2nd variant	Spellings	Spanish translation	Sub-meaning	Conjoin word	sStrong+Instance	Alt Strongs
Mat.1.1#01=NKO	Βίβλος (Biblos)	[The] book	G0976=N-NSF	βίβλος=book	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				Libro	book	#01	G0976			
Mat.1.1#02=NKO	γενέσεως (geneseōs)	of [the] genealogy	G1078=N-GSF	γένεσις=origin	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				de origen	origin	#02	G1078			
Word & Type	Greek	English translation	dStrongs = Grammar	Dictionary form =  Gloss	editions	1st variant	2nd variant	Spellings	Spanish translation	Sub-meaning	Conjoin word	sStrong+Instance	Alt Strongs
Act.2.11[2.10]#01=NKO	Ἰουδαῖοί (Ioudaioi)	Jews	G2453=N-NPM-PG	Ἰουδαῖος=Jewish 	BRTWSHNMI				judíos	Jewish»Jews@2Ki.25.25	Act.2.11[2.10]#01	G2453			
Act.2.11[2.10]#02=NKO	τε (te)	both	G5037=CONJ	τε=and/both	BRTWSHNMI				y	both	Act.2.11[2.10]#02	G5037			
Act.2.11[2.10]#03=NKO	καὶ (kai)	and	G2532=CONJ	καί=and	BRTWSHNMI				también	and	Act.2.11[2.10]#03	G2532_A			
Act.2.11[2.10]#04=NKO	προσήλυτοι, (prosēlutoi)	converts,	G4339=N-NPM	προσήλυτος=proselyte	BRTWSHNMI				prosélitos	proselyte	Act.2.11[2.10]#04	G4339			
Act.2.11#05=NKO	Κρῆτες (Krētes)	[11] Cretans	G2912=N-NPM-LG	Κρής=Cretan	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				cretenses	Caphtor»Caphtor|Crete@Deu.2.23	#05	G2912	
*/
		// not a verse word line, continue
		if (!preg_match('/^[[:alnum:]]{3}\.\d+\.\d+/', $data)) {
			continue;
		}
		
		// verse word line with alternate KJV reference
		// 1                 2      3      4      5       6     7         8         9         10        11        12        13*       14*       15*       16*       17*       18*       19*       20*     21*
		else if (preg_match('/^([[:alnum:]]{3})\.(\d+)\.(\d+)\[(\d+)\.(\d+)\]#(\d+)=([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)(.*)$/', $data, $match)) {
			// skip the alternate flipped of Philipians 1:16-17
			if ($match[1]=='Php' && $match[2]=='1' && ($match[3]=='16' || $match[3]=='17')) {
				if (strlen($match[6])!=2 && strlen($match[6])!=4) { AION_ECHO("ERROR! line=$count $newmess bad word sort number: $data"); }
				$match[6] = (strlen($match[6])==4 ? '2'.$match[6] : '2'.$match[6].'00'); // same as Hebrew logic for 4 digit LXX word number, BUT no cases of this
			}
			// moving back one verse same book and chapter - pre-pend word number with '6' so moved back to end of previous verse
			else if ($match[2]==$match[4] && // same chapter
				(int)$match[3]==(int)$match[5]+1) { // verse-1
				$match[2] = $match[4];
				$match[3] = $match[5];
				if (strlen($match[6])!=2 && strlen($match[6])!=4) { AION_ECHO("ERROR! line=$count $newmess bad word sort number: $data"); }
				$match[6] = (strlen($match[6])==4 ? '6'.$match[6] : '6'.$match[6].'00'); // same as Hebrew logic for 4 digit LXX word number, BUT no cases of this
			}
			// moving forward one verse same book and chapter or chapter+1 - pre-pend word number with '0' so moved to front of next verse
			else if ((int)$match[2]+1==(int)$match[4] || // chapter+1
				($match[2]==$match[4] && (int)$match[3]+1==(int)$match[5])) { // same chapter and verse+1
				$match[2] = $match[4];
				$match[3] = $match[5];
				if (strlen($match[6])!=2 && strlen($match[6])!=4) { AION_ECHO("ERROR! line=$count $newmess bad word sort number: $data"); }
				$match[6] = (strlen($match[6])==4 ? '0'.$match[6] : '0'.$match[6].'00'); // same as Hebrew logic for 4 digit LXX word number, BUT no cases of this
			}
			// hey why are we here??? BOMB
			else {
				AION_ECHO("ERROR! line=$count $newmess bad reversification: $data");
			}
			// alternate verse and word number copied to standard so remove alternate reindex array to match array without alternate
			// note that we do this in the TAGNT but we do not do this in the TAHOT
			unset($match[4]);
			unset($match[5]);
			$match = array_values($match);
		}
		
		else if (
		// regular verse word line - pre-pend word number with '2' so moved to middle of any pre-pends and appends
		//            1                 2      3     4     5         6         7         8         9         10        11*       12*       13*       14*       15*       16*       17*       18*     19*
		preg_match('/^([[:alnum:]]{3})\.(\d+)\.(\d+)#(\d+)=([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)(.*)$/', $data, $match) ||
		// regular verse word line, but skipped non-KJV alternate references - pre-pend word number with '2' so moved to middle of any pre-pends and appends
		//            1                 2      3                           4     5         6         7         8         9         10        11*       12*       13*       14*       15*       16*       17*       18*     19*
		preg_match('/^([[:alnum:]]{3})\.(\d+)\.(\d+)[{(]{1}\d+\.\d+[)}]{1}#(\d+)=([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)(.*)$/', $data, $match)
		) {
			// Custom - Add Acts 19:41
			if ($match[1]=='Act' && $match[2]=='19' && $match[3]=='40' && (int)$match[4]>21) { $match[3] = 41; }
			// Custom - Add 2Cor 13:13
			if ($match[1]=='2Co' && $match[2]=='13' && $match[3]=='12' && (int)$match[4]>5) { $match[3] = 13; }
			// bump all word numbers to '2' to allow reversification insertions beforehand if needed
			if (strlen($match[4])!=2 && strlen($match[4])!=4) { AION_ECHO("ERROR! line=$count $newmess bad word sort number: $data"); }
			$match[4] = (strlen($match[4])==4 ? '2'.$match[4] : '2'.$match[4].'00'); // same as Hebrew logic for 4 digit LXX word number, BUT no cases of this
		}
		
		// hey, bombing here!
		else {
			AION_ECHO("ERROR! line=$count $newmess bad line: $data");
		}
		
		// is there a value beyond valid fields, or word number not 5 digits? BOMB!
		if (!empty(trim($match[19])) || strlen($match[4])!=5) {
			AION_ECHO("ERROR! line=$count $newmess bad fields: $data");
		}
		
		// some precursor parsing
		// book name and index 
		$prevmatch = $match;
		$book = strtoupper($match[1]);
		if (empty($tbooks[$book])) { AION_ECHO("ERROR! $newmess missing book='$book'\n".print_r($line,TRUE)); }
		$book = $tbooks[$book];
		$indx = sprintf('%03d', (int)array_search($book,array_keys($abooks)));
		$chap = sprintf('%03d', (int)$match[2]);
		$vers = sprintf('%03d', (int)$match[3]);		
		// special attention to $numb, could use complicated logic or simply use the original order!
		//$numb = sprintf('%05d', (int)$match[4]); // this is complicated logic
		if ($indx.$chap.$vers != $indx_last.$chap_last.$vers_last) { $numb = '00001'; $numbnumb = 1; }
		else { $numb = sprintf('%05d', $numbnumb); }
		$indx_last = $indx;
		$chap_last = $chap;
		$vers_last = $vers;
		++$numbnumb;
		
		// remove spaces from type field
		$match[5] = preg_replace("#[\s]+#u","",$match[5]);
		// break apart Greek and Transliteration
		$twopieces = mb_split("[()]{1}", $match[6]);
		if(count($twopieces) != 3 || !empty($twopieces[2])) { AION_ECHO("ERROR! line=$count $newmess Greek/Translit format problem, $data"); }
		$greek = trim(preg_replace("#[¶()]+#u","",$twopieces[0])," []"); // rip these out - ¶ [[
		$translit = trim(preg_replace("#[()]+#u","",$twopieces[1]));
		// reconstruct strongs and morph as originally
		$strongs = $morph = NULL;
		if (preg_match("#[¦]+#u",$match[8])) { AION_ECHO("ERROR! line=$count $newmess WHATWHAT? $data"); }
		$match[8] = preg_replace("#[\+]+#u","+",$match[8]);
		$match[8] = mb_split("\+", $match[8]);
		foreach($match[8] as $key => $part) {
			$pieces = mb_split("=", $part);
			if (2!==count($pieces) ||
				!preg_match('/G[0-9]{1,5}/', $pieces[0]) || 
				!preg_match('/[A-Z\-]+/', $pieces[1])) {				AION_ECHO("ERROR! line=$count $newmess BAD STRONGS/MORPH $data"); }
			$strongs .= trim($pieces[0])."+";
			$morph .= trim($pieces[1])."+";
		}
		$strongs = trim($strongs," +");
		$morph = trim($morph," +");
		// reconstruct dictionary and gloss
		$dictionary = $gloss = NULL;
		$match[9] = preg_replace("#[\s]+#u"," ",$match[9]);
		$match[9] = preg_replace("#[\+]+#u","+",$match[9]);
		$match[9] = mb_split("\+", $match[9]);
		foreach($match[9] as $key => $part) {
			$pieces = mb_split("=", $part);
			if (2!==count($pieces)) {									AION_ECHO("ERROR! line=$count $newmess BAD DICTIONARY/GLOSS $data"); }
			$dictionary .= trim($pieces[0])."+";
			$gloss .= trim($pieces[1])."+";
		}
		$dictionary = trim($dictionary," +");
		$gloss = trim($gloss," +");
		// trim
		$match[7] = trim(preg_replace("#\s+#u"," ",$match[7]));
		$match[10] = preg_replace("#[\s]+#u"," ",$match[10]); // editions
		$match[10] = trim(preg_replace("#[+]+#u","+",$match[10]),"+ "); // editions
		$match[11] = trim(preg_replace("#\s+#u"," ",$match[11])," +");
		$match[12] = trim(preg_replace("#\s+#u"," ",$match[12])," +");
		// 13 is spanish, not needed
		if (preg_match("#{$match[14]}#u",$gloss)) { $match[14] = NULL; } // Remove repeated words in the extra column 
		$match[14] = trim(preg_replace("#\s+#u"," ",$match[14]));
		$match[15] = trim(preg_replace("#\s+#u"," ",$match[15]));
		$match[16] = trim(preg_replace("#\s+#u"," ",$match[16]));
		$match[17] = trim(preg_replace("#\s+#u"," ",$match[17]));

		// Error checks
		//Word & Type	Greek	English translation	dStrongs = Grammar	Dictionary form =  Gloss	editions	1st variant	2nd variant	Spellings		Spanish translation	Sub-meaning	Conjoin word	sStrong+Instance	Alt Strongs
		//Mat.1.1#01=M + T + O	Βίβλος (Biblos)	[The] book	G0976=N-NSF	βίβλος=book	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				Libro	book	#01	G0976				
		//Mat.1.1#02=M + T + O	γενέσεως (geneseōs)	of [the] genealogy	G1078=N-GSF	γένεσις=origin	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				de origen	origin	#02	G1078				
		//Mat.1.1#03=M + T + O	Ἰησοῦ (Iēsou)	of Jesus	G2424G=N-GSM-P	Ἰησοῦς=Jesus/Joshua	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				de Jesús	Jesus»Jesus|Jesus@Mat.1.1	#03	G2424				
		//Act.2.11#01 (2.10)=M + T + O	Ἰουδαῖοί (Ioudaioi)	Jews	G2453G=N-NPM-PG	Ἰουδαῖος=Jewish 	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				judíos	Jewish»Jews@2Ki.25.25	#01	G2453				
		//Act.2.11#02 (2.10)=M + T + O	τε (te)	both	G5037=CONJ	τε=and/both	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				y	both	#02	G5037				
		//Act.2.11#03 (2.10)=M + T + O	καὶ (kai)	and	G2532=CONJ	καί=and	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				también	and	#03	G2532_A				
		//Act.2.11#04 (2.10)=M + T + O	προσήλυτοι, (prosēlutoi)	converts,	G4339=N-NPM	προσήλυτος=proselyte	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				prosélitos	proselyte	#04	G4339	
		// Word & Type _|_ Greek_|_ English translation_|_ dStrongs = Grammar_|_ Dictionary form = Gloss_|_ editions_|_ 1st variant_|_ 2nd variant_|_ Spellings_|_ Spanish translation_|_ Sub-meaning_|_ Conjoin word_|_ sStrong+Instance_|_ Alt Strongs
		// the sStrong should always have the same numbers as the dStrongs on the same line. 
		if (FALSE===preg_match_all("#G[\d]{1,5}#u", $strongs,   $dstrongs,  PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! preg_match_all(DSTRONGS)\n".print_r($data,TRUE)); }
		if (FALSE===preg_match_all("#G[\d]{1,5}#u", $match[16], $sstrongs,  PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! preg_match_all(SSTRONGS)\n".print_r($data,TRUE)); }
		if (!array_intersect($dstrongs[0], $sstrongs[0]) == $dstrongs[0]) { AION_ECHO("ERROR! DSTRONGS !== SSTRONGS: $data\n".print_r($dstrongs[0],TRUE)."\n".print_r($sstrongs[0],TRUE)); }
		// The conjoin word and dStrong  Alt Strongs on the same line should always be different from each other
		if (FALSE===preg_match_all("#G[\d]{1,5}#u", $strongs,   $dstrongs, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! preg_match_all(DSTRONGS)\n".print_r($data,TRUE)); }
		if (FALSE===preg_match_all("#G[\d]{1,5}#u", $match[15], $cstrongs, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! preg_match_all(CSTRONGS)\n".print_r($data,TRUE)); }
		if (FALSE===preg_match_all("#G[\d]{1,5}#u", $match[17], $astrongs, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! preg_match_all(ASTRONGS)\n".print_r($data,TRUE)); }
		$mstrongs = array_merge($dstrongs[0],$cstrongs[0],$astrongs[0]);
		if (count($mstrongs) != count(array_unique($mstrongs))) { AION_ECHO("WARN! Greek Strongs not unique on same line: $data\n".print_r($dstrongs,TRUE)."\n".print_r($cstrongs,TRUE)."\n".print_r($astrongs,TRUE)); }
		// the Greek , the Variant and the Spellings on the same line should all be different from each other
		$greek1 = $greek2 = $greek3 = NULL;
		if (FALSE===($greek1=preg_replace("#[[:punct:]]+#u", "", $greek))) { AION_ECHO("ERROR! preg_replace(greek)\n".print_r($data,TRUE)); }
		if (FALSE===(preg_match_all("#(^|¦)\s*([^\(]+)\s*\(#u", $match[11], $greek2, PREG_PATTERN_ORDER))) { AION_ECHO("ERROR! preg_match_all(greek2)\n".print_r($data,TRUE)); }
		if (FALSE===(preg_match_all("#:\s*([^:;\s]+)\s*;#u", $match[12], $greek3, PREG_PATTERN_ORDER))) { AION_ECHO("ERROR! preg_match_all(greek4)\n".print_r($data,TRUE)); }
		$mstrongs = array_map('trim',array_merge(array($greek1), $greek2[2], $greek3[1]));
		if (count($mstrongs) != count(array_unique($mstrongs))) { AION_ECHO("WARN! Greek not unique on same line: $data\n".print_r($mstrongs,TRUE)); }
		// lay it out
		$output[] = "$indx	$book	$chap	$vers	$numb	$match[5]	$greek	$translit	$dictionary	$match[7]	$gloss	$strongs	$morph	$match[10]	$match[11]	$match[12]	$match[14]	$match[15]	$match[16]	$match[17]";
	}
	//sort and implode
	sort($output);
	array_unshift($output, "INDEX	BOOK	CHAP	VERS	NUMB	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	STRONGS	MORPH	EDITIONS	VAR	SPELL	EXTRA	CONJOIN	INSTANCE	ALT");
	$output = implode("\n", $output);
	// result
	if (!($bytes=file_put_contents($fout, $output))) {		AION_ECHO("ERROR! $newmess !file_put_contents()"); }
	AION_unset($output); $output=NULL; unset($output);
	AION_unset($contents); $contents=NULL; unset($contents);
	AION_unset($lines); $lines=NULL; unset($lines);
	gc_collect_cycles();
	AION_ECHO("SUCCESS! $newmess lines=$count bytes=$bytes");
}


// Read TAB delimited file
function AION_NEWSTRONGS_GET($file, $begin, $end, $table, $keys, $required, $checkfile, $keysord, $key, &$result, $flag=NULL) {
	$newmess = "GET\t$file";
	if ( !is_array( $result ) ) {										AION_ECHO("ERROR! $newmess result !is_array() "); }
	if ( !is_array( $keys ) ) {											AION_ECHO("ERROR! $newmess keys !is_array()"); }
	if ( $key && !in_array( $key, $keys ) ) {							AION_ECHO("ERROR! $newmess key=$key not in keys !in_array()"); }
	if ( is_array($keysord) &&
		 strlen($test=trim(implode("",array_diff($keys,$keysord))))) {	AION_ECHO("ERROR! $newmess key=$test not in keysord"); }
	if (file_put_contents($checkfile, "EMPTY?\n", FILE_APPEND)===FALSE){AION_ECHO("ERROR! file_put_contents($checkfile)"); }
	if ( !is_file( $file ) ) {											AION_ECHO("ERROR! $newmess !is_file()"); }
	if ( ($contents = file_get_contents( $file )) === FALSE ) {			AION_ECHO("ERROR! $newmess !file_get_contents()"); }
	if ( mb_detect_encoding($contents, "UTF-8", TRUE) === FALSE ) {		AION_ECHO("ERROR! $newmess !mb_detect_encoding()"); }
	mb_regex_encoding("UTF-8");
	mb_internal_encoding("UTF-8");
	if ($begin && (!($contents=preg_replace("/^.*?$begin/us",$begin,$contents,-1,$count)) || $count!=1)) {		AION_ECHO("ERROR! $newmess no beginning='$begin' $count"); }
	if ($end && (!($contents=preg_replace("/$end.*$/us","",$contents,-1,$count)) || $count!=1)) {	AION_ECHO("ERROR! $newmess no ending='$end' $count"); }
	$contents = AION_NEWSTRONGS_GET_FIX($file, $contents, $result);
	if (!defined($table)) { define($table, $table); }
	$lines = mb_split("\n", $contents);
	if (!isset($result[$table]) || !is_array($result[$table])) { $result[$table] = array(); }
	$count_keys = count($keys);
	$count_meta = 0;
	$count = 0;
	$previous = NULL;
	foreach( $lines as $data ) {
		++$count;
		if (empty($data) || $data[0]=='#' || $data[0]=='$' || preg_match("#^\s*$#us",$data)) { continue; }
		$line = $data;
		$data = mb_split("\t", $data);
		$count_data = count($data);
		if ( !$count_meta ) {
			$count_meta = $count_data;
			if ( $count_meta != $count_keys) {							AION_ECHO("ERROR! $newmess line=$count count(meta=$count_meta != count_keys=$count_keys) line='$line'"); }
		}
		if ( !$count_data || $count_meta != $count_data ) {				AION_ECHO("ERROR! $newmess line=$count count(meta=$count_meta != data=$count_data line='$line'"); }
		$once = TRUE;
		for ( $newd = array(), $x = 0; $x < $count_data; $x++ ) {
			if (!empty($keys[$x])) {
				$data[$x] = trim($data[$x]);
				$newd[$keys[$x]] = $data[$x];
				// also check if value is empty
				if ($once && !empty($required[$x]) && empty($newd[$keys[$x]])) {
					$temp = implode(",",$data);
					AION_ECHO("WARN! Empty fields, $table, $temp");
					if (file_put_contents($checkfile, "$temp\n", FILE_APPEND)===FALSE) {	AION_ECHO("ERROR! file_put_contents($checkfile)"); }
					$once = FALSE;
				}
			}
		}
		if (is_array($keysord)) { $newS = array(); foreach( $keysord as $k) { if (!empty($k)) { $newS[$k] = $newd[$k]; } } unset($newd); $newd = $newS; }
		if ( !$key ) { $result[$table][] = $newd; }
		else {
			// fix strongs number key assignment in lexicons
			$assignkey = $newd[$key];
			if ($flag && $key=='STRONGS' && !($assignkey=preg_replace("#^([HG]{1}[0-9]{1,5}[A-Za-z]{0,1}).*$#ui",'$1',$assignkey))) {
				AION_ECHO("ERROR! $newmess bad lexicon strongs format key reassignment, line='$line'");
			}
			if (!empty($result[$table][$assignkey])) {					AION_ECHO("ERROR! $newmess line=$count array key overlap! $key=".$newd[$key]); }
			else { $result[$table][$assignkey] = $newd; }
		}
		AION_unset($newS); $newS=NULL; unset($newS);
		AION_unset($newd); $newd=NULL; unset($newd);
		$previous = $data;
		AION_unset($data); $data=NULL; unset($data);
	}
	AION_unset($contents); $contents=NULL; unset($contents);
	AION_unset($lines); $lines=NULL; unset($lines);
	gc_collect_cycles();
	AION_ECHO("SUCCESS! $newmess lines=$count array=".count($result[$table]));
}


// Clean up
function AION_NEWSTRONGS_GET_FIX($file, $contents, &$result) {
	$newmess = "FIX\t$file";
	// tags
	if (empty($result['FIXCOUNTS'])) { $result['FIXCOUNTS']="Fix counts for input files\n"; }
	$result['FIXCOUNTS'].="\n\n\n";
	//$contents = preg_replace($reg="#(<b>|</b>|<i>|</i>|<u>|</u>)#usi",		" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tformat=$count\n"; }
	$contents = preg_replace($reg="#(<greek>|</greek>)#usi",					" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tgreek=$count\n"; }
	$contents = preg_replace($reg="#(<note>|</note>)#usi",						" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tnote=$count\n"; }
	$contents = preg_replace($reg="#(<author>|</author>)#usi",					" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tauthor=$count\n"; }
	$contents = preg_replace($reg="#(<date>|</date>)#usi",						" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tdate=$count\n"; }
	$contents = preg_replace($reg="#(<corr>|</corr>)#usi",						" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tcorr=$count\n"; }
	$contents = preg_replace($reg="#(<def>|</def>)#usi",						" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tdef=$count\n"; }
	$contents = preg_replace($reg="#(<Lat>|</Lat>)#usi",						" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tlatin=$count\n"; }
	$contents = preg_replace($reg="#<re>[ ]*<re>#usi",							"<re>",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\t<re>2to1=$count\n"; }
	$contents = preg_replace($reg="#</re>[ ]*</re>#usi",						"</re>",$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\t<re>2to1=$count\n"; }
	//$contents = preg_replace($reg="#<re>(.+?)</re>#usi",						" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\t<re>=$count\n"; }
	$contents = preg_replace($reg="#(<re>|</re>)#usi",							" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\t<re>=$count\n"; }
	$contents = preg_replace($reg="#(<ref[^<>]*>|</ref>)#usi",					" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tref=$count\n"; }
	$contents = preg_replace($reg="#(<hi [^<>]*>|</hi>)#usi",					" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\thi=$count\n"; }
	$contents = preg_replace($reg="#(<span [^<>]*>|</span>)#usi",				" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tspan=$count\n"; }
	$contents = preg_replace($reg="#<gramGrp/>#usi",							" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tgramGrp=$count\n"; }
	//$contents = preg_replace($reg="#<a href(.+?)</a>#usi",					" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tahrefs=$count\n"; }
	$contents = preg_replace($reg="#<foreign[^<>]*>#usi",						" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tforeign=$count\n"; }
	$contents = preg_replace($reg="#</foreign[^<>]*>#usi",						" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tforeign=$count\n"; }
	$contents = preg_replace($reg="#<Level[0-9]{1}>#usi",						" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tlevel#=$count\n"; }
	$contents = preg_replace($reg="#</Level[0-9]{1}>#usi",						") ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tlevel/=$count\n"; }
	$contents = preg_replace($reg="#(<br[ /]*>|<lb[ /]*>)#usi",					" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tbreaks=$count\n"; }
	$contents = preg_replace($reg="#&nbsp;#usi",								" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tnbsp=$count\n"; }
	// Strongs	
	$contents = preg_replace($reg="#(H|G)[0]+([1-9]+[0-9]*)#usi",				"$1$2",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tnumbno=$count\n"; }
	// Junk
	$contents = preg_replace($reg="#(†)#usi",									" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tcross=$count\n"; }
	$contents = preg_replace($reg="#<->#usi",									" - ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\ttags=$count\n"; }
	$contents = preg_replace($reg="# __([0-9]+)\. #usi",						" $1) ",$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tunderN=$count\n"; }
	$contents = preg_replace($reg="#_[_]+#usi",									" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tunders=$count\n"; }
	// LSJ
	$contents = preg_replace($reg="#\(From Abbott-Smith\. LSJ has no entry\)=\t#usi","(Abbott-Smith)",$contents,-1,$count); if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tabbsmi=$count\n"; }
	$contents = preg_replace($reg="#\(from Middle LSJ\)=\t#usi","(Middle LSJ)",$contents,-1,$count);				if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tmidlsj=$count\n"; }
	// Javascript
	$contents = preg_replace($reg="#javascript:void0#usi","javascript:void(0)",$contents,-1,$count);				if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tjavavoid0=$count\n"; }
	// Punctuation
	$contents = preg_replace($reg="#[([]+[ [:punct:]]*[)\]]+#usi",				" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tbracket=$count\n"; }
	$contents = preg_replace($reg="#[ ]*[ \-—,:;?!.]+[ ]*([,.:;!?]{1})#usi",	'$1',	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tpunct=$count\n"; }
	// Space
	$contents = preg_replace($reg="#([([]+)[ ]+#usi",							"$1",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tspace-bracket=$count\n"; }
	$contents = preg_replace($reg="#[ ]+([)\]]+)#usi",							"$1",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tspace-bracket=$count\n"; }
	$contents = preg_replace($reg="#[ ]+#usi",									" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tspaces=$count\n"; }
	$contents = preg_replace($reg="#[ ]*\r\n#usi",								"\n",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t\ttrim-newline=$count\n"; }
	// bye bye
	return($contents);
}




// Clean up the Lexicon before writing
function AION_NEWSTRONGS_GET_FIX_LEX($file, &$lines, &$database, $morph_array, $html_file) {
	// init
	$counter_lex = $counter_tag = 0;
	$previous = libxml_use_internal_errors(true);
	$dom = New DOMDocument();
	libxml_clear_errors();
	$newmess = "FIX_LEX\t$file";
	// start the HTML error file
	$html_html = <<<EOT
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<title>Aionian Bible Project: $file HTML Errors</title>
<meta name='description' content="Aionian Bible Project: $file HTML Errors">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<meta name='apple-mobile-web-app-capable' content='yes'>
<meta name="generator" content="ABCMS™">
<meta http-equiv='x-ua-compatible' content='ie=edge'>
<style>
	body { padding: 50px;}
	div.head { margin: 20px; }
	div.body { margin: 50px; }
</style>
</head>
<body>
<div class='head'>
<h1>Aionian Bible Project: $file HTML Errors</h1>
</div>

EOT;
	// process the lines
	foreach( $lines as $x => $line ) {
		$strongs = $line['STRONGS'];
		if (!preg_match("#^[HG]{1}[0-9]{1,5}[A-Za-z]{0,1}$#u",$strongs)) { AION_ECHO("ERROR! $newmess bad strongs format\n".print_r($line,TRUE)); }
		if (preg_match("#^H90[2-4]{1}[0-9]{1}$#ui",$x) && !preg_match("#H:#ui",$lines[$x]['MORPH'])) { $lines[$x]['MORPH'] = "H:".$lines[$x]['MORPH']; } // fix line morphhology
		if (FALSE===($cleanword = preg_replace("#[()]+#ui"," ", $line['WORD']))) { AION_ECHO("ERROR! Problem cleaning word (WORD)\n".print_r($line,TRUE)); }
		if (preg_match("#^".$cleanword."[,:;. ]*[ ]+(.+)$#ui",$line['DEF'],$match) && isset($match[1])) {  // fix if word same as def 1st word, then delete def first word
			$lines[$x]['DEF'] = $match[1];
		}
		$lines[$x]['STRONGS'] = $line['STRONGS'] = substr($strongs,1); // wack off the first letter
		
		// fix morph
		$fixed = $lines[$x]['MORPH'];
		if (($fixed=preg_replace("#-M/F#ui", "-B", $fixed))===FALSE) { AION_ECHO("ERROR! $newmess preg_replace M/F   failure\n".print_r($line,TRUE)); }
		if (($fixed=preg_replace("#-M/N#ui", "-L", $fixed))===FALSE) { AION_ECHO("ERROR! $newmess preg_replace M/N   failure\n".print_r($line,TRUE)); }
		if (($fixed=preg_replace("#-F/N#ui", "-E", $fixed))===FALSE) { AION_ECHO("ERROR! $newmess preg_replace F/N   failure\n".print_r($line,TRUE)); }
		if (($fixed=preg_replace("#[ ]+#ui", "",   $fixed))===FALSE) { AION_ECHO("ERROR! $newmess preg_replace space failure\n".print_r($line,TRUE)); }
		$lines[$x]['MORPH'] = $line['MORPH'] = $fixed; // fix morphhology
		// COMPOUND MORPHHOLOGY INTERPRETATION
		//	/ means or eg it is either a noun or a personal name
		//	+ means it is part of the def when it is a phrase with more than one word and they are different types of words
		$mparts = mb_split("[/+]{1}", $line['MORPH']);
		foreach($mparts as $mpart) {
			if (!empty($mpart) && !AION_NEWSTRONGS_LEX_MORPH($mpart)) {
				$database['MISS_MORPHS'] .= ($warn="$newmess\tstrongs='$strongs'\tmissing morph='$mpart'\n");
				AION_ECHO("WARN! $warn".print_r($line,TRUE)."\n\n\n");
			}
		}
		// count and hyperlink MORPH in DEF
		// A handful of search and replace errors noted on 11/30/23. If data has not changed this search and replace is not needed!
		/*
		if (!empty($line['DEF'])) {
			foreach($GLOBALS['MORPH']['LEX_SEARCH'] as $find) { if (preg_match_all("#{$find}#u", $line['DEF'], $matches, PREG_PATTERN_ORDER)) {
				AION_ECHO("WARN! LEX MORPH SWAP = '{$find}' in: ".$line['DEF']);
				$counter_lex += count($matches[0]); } } // lex morphs?
			foreach($GLOBALS['MORPH']['TAG_SEARCH'] as $find) { if (preg_match_all("#{$find}#u", $line['DEF'], $matches, PREG_PATTERN_ORDER)) {
				AION_ECHO("WARN! TAG MORPH SWAP = '{$find}' in: ".$line['DEF']);
				$counter_tag += count($matches[0]); } } // lex morphs?
		}
		*/
		// look for broken tags and bad html
		$report='';
		if (preg_match_all("#.{0,30}<[^abiuw>]{1}[^>]*[^abiuw]{1}>.{0,30}#ui",$lines[$x]['DEF'],$match,PREG_PATTERN_ORDER)) {
			foreach($match[0] as $x => $suspect) { $n=$x+1; $report .= "$n) '$suspect'\n"; }
			AION_ECHO($warn="WARN! $newmess strongs='$strongs' suspect '<tag>' found\n$report".print_r($line,TRUE)."\n\n\n");
			$database['WARNINGS'] .= $warn;
		}
		else if (preg_match_all("#.{0,30}<[^abiuw]{1}[^abiuw]{1}.{0,30}#ui",$lines[$x]['DEF'],$match,PREG_PATTERN_ORDER)) {
			foreach($match[0] as $x => $suspect) { $n=$x+1; $report .= "$n) '$suspect'\n"; }
			AION_ECHO($warn="WARN! $newmess strongs='$strongs' suspect '<' unclosed found\n$report".print_r($line,TRUE)."\n\n\n");
			$database['WARNINGS'] .= $warn;
		}
		else if (preg_match_all("#^[^<]*>.{0,30}#ui",$lines[$x]['DEF'],$match,PREG_PATTERN_ORDER)) {
			foreach($match[0] as $x => $suspect) { $n=$x+1; $report .= "$n) '$suspect'\n"; }
			AION_ECHO($warn="WARN! $newmess strongs='$strongs' suspect '>' unopened found\n$report".print_r($line,TRUE)."\n\n\n");
			$database['WARNINGS'] .= $warn;
		}
		else {
			$dom->loadHTML("<html><body>".$lines[$x]['DEF']."</body></html>");
			if (!empty(libxml_get_errors())) {
				$html_html .= "<div class='body'>".preg_replace("#([[:punct:]]+) #u","$1\n",$lines[$x]['DEF'])."</div>\n";
				AION_ECHO($warn="WARN! $newmess strongs='$strongs' DOMHTML Error".print_r($line,TRUE)."\n".print_r(libxml_get_errors(),TRUE)."\n\n\n");
				$database['WARNINGS'] .= $warn;
				libxml_clear_errors();
			}
		}
	}
	// morph count result
	// likewise from above - nothing to report, this is turned off!
	/*
	AION_ECHO("WARN! AION_NEWSTRONGS_GET_FIX_LEX({$file}) lex morph usage = {$counter_lex}");
	AION_ECHO("WARN! AION_NEWSTRONGS_GET_FIX_LEX({$file}) tag morph usage = {$counter_tag}");
	*/
	// end
	libxml_clear_errors();
	libxml_use_internal_errors($previous);
	// write the html file
	$html_html .= "</body>\n</html>\n";
	if (file_put_contents($html_file, $html_html) === FALSE ) { AION_ECHO("ERROR! file_put: ".$html_file ); }
	AION_ECHO("CHECK HTML debug file written: $html_file");
}


// build list of lexicon morphhologies
function AION_NEWSTRONGS_LEX_MORPH_LEX($lex) {
	foreach($lex as $entry ) { AION_NEWSTRONGS_LEX_MORPH($entry['MORPH']); }
}

// Clean up the Lexicon before writing
function AION_NEWSTRONGS_LEX_MORPH($morph, $output=NULL) {
// save the morphs!
static $morphs = array();
if ($morph===NULL && $output!==NULL) {
	ksort($morphs, SORT_NATURAL);
	if (file_put_contents($output,implode("\n", array_keys($morphs))) === FALSE ) { AION_ECHO("ERROR! AION_NEWSTRONGS_LEX_WIPE file_put_contents $output" ); }	
}
static $lookup = array(
'A:A'=>'Aramaic Adjective',
'A:Adv'=>'Aramaic Adverb',
'A:Cond'=>'Aramaic Conditional',
'A:Conj'=>'Aramaic Conjunction',
'A:DemP'=>'Aramaic Demonstrative Pronoun',
'A:ImpP/A:Intg'=>'Aramaic Impersonal Pronoun / Interogative',
'A:ImpP'=>'Aramaic Impersonal Pronoun',
'A:Intg'=>'Aramaic Interogative',
'A:Intj'=>'Aramaic Interjection',
'A:PRT-I'=>'Aramaic Interogative',
'A:N--T'=>'Aramaic Noun Title',
'A:N-F'=>'Aramaic Noun Female',
'A:N-M'=>'Aramaic Noun Male',
'A:N'=>'Aramaic Noun',
'A:Neg'=>'Aramaic Negative',
'A:Part'=>'Aramaic Particle',
'A:PerP-CP'=>'Aramaic Personal Pronoun Common Plural',
'A:PerP-CS'=>'Aramaic Personal Pronoun Common Singular',
'A:PerP-MP'=>'Aramaic Personal Pronoun Male Plural',
'A:PerP-MS'=>'Aramaic Personal Pronoun Male Singular',
'A:Prep'=>'Aramaic Preposition',
'A:V+A:N'=>'Aramaic Verb Noun',
'A:V'=>'Aramaic Verb',
'G:A--C'=>'Greek Adjective Comparative',
'G:A--S'=>'Greek Adjective Superlative',
'G:A-F'=>'Greek Adjective Female',
'G:A-M'=>'Greek Adjective Male',
'G:A-NUI'=>'Greek Number (Indeclinable)',
'G:A/G:ADV'=>'Greek Adjective OR Adverb',
'G:ADV-C'=>'Greek Adverb Common',
'G:ADV-I'=>'Greek Adverb Interrogative',
'G:ADV-N'=>'Greek Adverb Neuter',
'G:ADV-S'=>'Greek Adverb Superlative',
'G:ADV-T'=>'Greek Adverb Title',
'G:ADV/G:A'=>'Greek Adverb OR Greek Adjective',
'G:ADV'=>'Greek Adverb',
'G:A'=>'Greek Adjective',
'G:C-'=>'Greek Pronoun',
'G:COND+G:PRT-N+G:CONJ'=>'Greek Conditional WITH Greek Negative WITH Greek Conjunction',
'G:COND+G:PRT-N'=>'Greek Conditional WITH Greek Negative',
'G:COND'=>'Greek Conditional',
'G:CONJ+G:P-1'=>'Greek Conjunction WITH Personal Pronoun (1st person)',
'G:CONJ-N'=>'Greek Conjunction Neuter',
'G:CONJ'=>'Greek Conjunction',
'G:D'=>'Greek Demonstrative Pronoun',
'G:F-1'=>'Greek Reflexive Pronoun (1st person)',
'G:F-2'=>'Greek Reflexive Pronoun (2nd person)',
'G:F-3'=>'Greek Reflexive Pronoun (3rd person)',
'G:'=>'Greek',
'G:I'=>'Greek Interogative',
'G:INJ'=>'Greek Interjection',
'G:K'=>'Greek Correlative',
'G:N-B'=>'Greek Noun Male/Female',
'G:N-F/G:A-F'=>'Greek Noun Female OR Adjective Female',
'G:N-F/G:V'=>'Greek Noun Female OR Verb',
'G:N-F'=>'Greek Noun Female',
'G:N-L'=>'Greek Noun Male/Neuter',
'G:N-LI'=>'Greek Letter (Indeclinable)',
'G:N-M'=>'Greek Noun Male',
'G:N-N'=>'Greek Noun Neuter',
'G:N-PRI'=>'Greek Noun Proper (Indeclinable)',
'G:N'=>'Greek Noun',
'G:P-1'=>'Greek Personal Pronoun (1st person)',
'G:P-2'=>'Greek Personal Pronoun (2nd person)',
'G:P'=>'Greek Personal Pronoun (3rd person)',
'G:PREP/G:A'=>'Greek Preposition OR Adjective',
'G:PREP'=>'Greek Preposition',
'G:PRT-I'=>'Greek Particle - Interogative',
'G:PRT-N+G:CONJ+G:PRT-N'=>'Greek Negative JOINED TO Greek Conjunction WITH Greek Negative',
'G:PRT-N+G:CONJ'=>'Greek Negative JOINED TO Greek Conjunction',
'G:PRT-N+G:PRT-N'=>'Greek Negative WITH Greek Negative',
'G:PRT-N'=>'Greek Particle Neuter',
'G:PRT'=>'Greek Particle',
'G:Q'=>'Greek Correlative or Interrogative',
'G:R'=>'Greek Relative Pronoun',
'G:S-1'=>'Greek Possessive Pronoun (1st person)',
'G:S-2'=>'Greek Possessive Pronoun (2nd person)',
'G:T+G:V+G:CONJ+G:T+G:V+G:CONJ+G:T+G:V'=>'Greek Article WITH Greek Verb WITH Greek Conjunction WITH Greek Article WITH Greek Verb WITH Greek Conjunction WITH Greek Article WITH Greek Verb',
'G:T'=>'Greek Article',
'G:V'=>'Greek Verb',
'G:W'=>'Greek',
'G:X'=>'Greek Indefinite Pronoun',
'G:Α'=>'Greek Adjective',
'H:A-F'=>'Hebrew Adjective Female',
'H:A-M'=>'Hebrew Adjective Male',
'H:A/H:N-M'=>'Hebrew Adjective OR Noun (Masculine)',
'H:A'=>'Hebrew Adjective',
'H:Adv'=>'Hebrew Adverb',
'H:Cond'=>'Hebrew Conditional',
'H:Conj'=>'Hebrew Conjunction',
'H:DemP'=>'Hebrew Demonstrative Pronoun',
'H:INJ'=>'Hebrew Interjection',
'H:IndP'=>'Hebrew Hebrew Indefinite Pronoun',
'H:Intg'=>'Hebrew Interogative',
'H:Intj'=>'Hebrew Interjection',
'H:N-B'=>'Hebrew Noun Male/Female',
'H:N-F'=>'Hebrew Noun Female',
'H:N-M/H:A'=>'Hebrew Noun (Masculine) OR Adjective',
'H:N-M/H:Adv'=>'Hebrew Noun (Masculine) OR Adverb',
'H:N-M/N:N--L'=>'Hebrew Noun (Masculine) OR Proper Name of a Location',
'H:N-M/N:N--T'=>'Hebrew Noun (Masculine) OR Proper Name of some kind',
'H:N-M/N:N-M-T'=>'Hebrew Noun (Masculine) OR Proper Name (Masculine) of some kind',
'H:N-M'=>'Hebrew Noun Male',
'H:N'=>'Hebrew Noun',
'H:Neg'=>'Hebrew Negative',
'H:Op1c'=>'Hebrew us, personal pronoun - verb/prep. 1st person common plural',
'H:Op2f'=>'Hebrew you, personal pronoun - verb/prep. 2nd person feminine plural',
'H:Op2m'=>'Hebrew you, personal pronoun - verb/prep. 2nd person masculine plural',
'H:Op3f'=>'Hebrew them, personal pronoun - verb/prep. 3rd person feminine plural',
'H:Op3m'=>'Hebrew them, personal pronoun - verb/prep. 3rd person masculine plural',
'H:Os1c'=>'Hebrew me, personal pronoun - verb/prep. suffix: 1st person common singular',
'H:Os2f'=>'Hebrew you, personal pronoun - verb/prep. 2nd person feminine singular',
'H:Os2m'=>'Hebrew you, personal pronoun - verb/prep. 2nd person masculine singular',
'H:Os3f'=>'Hebrew her, personal pronoun - verb/prep. 3rd person feminine singular',
'H:Os3m'=>'Hebrew him, personal pronoun - verb/prep. 3rd person masculine singular',
'H:PRT-I'=>'Hebrew Particle',
'H:Part'=>'Hebrew Particle',
'H:PerP-CP'=>'Hebrew Personal Pronoun Common Plural',
'H:PerP-CS'=>'Hebrew Personal Pronoun Common Singular',
'H:PerP-FP'=>'Hebrew Personal Pronoun Female Plural',
'H:PerP-FS'=>'Hebrew Personal Pronoun Female Singular',
'H:PerP-MP'=>'Hebrew Personal Pronoun Male Plural',
'H:PerP-MS'=>'Hebrew Personal Pronoun Male Singular',
'H:Pp1c'=>'Hebrew our, personal posessive - noun suffix: 1st person common plural',
'H:Pp2f'=>'Hebrew your, personal posessive - noun suffix: 2nd person feminine plural',
'H:Pp2m'=>'Hebrew your, personal posessive - noun suffix: 2nd person masculine plural',
'H:Pp3f'=>'Hebrew their, personal posessive - noun suffix: 3rd person feminine plural',
'H:Pp3m'=>'Hebrew their, personal posessive - noun suffix: 3rd person masculine plural',
'H:Prep+H:RelP'=>'Hebrew Preposition JOINED TO Relative Pronoun',
'H:Prep/H:Conj'=>'Hebrew Preposition OR Conjunction',
'H:Prep'=>'Hebrew Preposition',
'H:Ps1c'=>'Hebrew my, personal posessive - noun suffix: 1st person common singular',
'H:Ps2f'=>'Hebrew your, personal posessive - noun suffix: 2nd person feminine singular',
'H:Ps2m'=>'Hebrew your, personal posessive - noun suffix: 2nd person masculine singular',
'H:Ps3f'=>'Hebrew her, personal posessive - noun suffix: 3rd person feminine singular',
'H:Ps3m'=>'Hebrew his, personal posessive - noun suffix: 3rd person masculine singular',
'H:RelP'=>'Hebrew Relative Pronoun',
'H:Sp1c'=>'Hebrew we, subject pronoun - subject 1st person common plural',
'H:Sp2f'=>'Hebrew you, subject pronoun - subject 2nd person feminine plural',
'H:Sp2m'=>'Hebrew you, subject pronoun - subject 2nd person masculine plural',
'H:Sp3f'=>'Hebrew they, subject pronoun - subject 3rd person feminine plural',
'H:Sp3m'=>'Hebrew they, subject pronoun - subject 3rd person masculine plural',
'H:Ss1c'=>'Hebrew I, subject pronoun -  subject: 1st person common singular',
'H:Ss2f'=>'Hebrew you, subject pronoun - subject 2nd person feminine singular',
'H:Ss2m'=>'Hebrew you, subject pronoun - subject 2nd person masculine singular',
'H:Ss3f'=>'Hebrew she, subject pronoun - subject 3rd person feminine singular',
'H:Ss3m'=>'Hebrew he, subject pronoun - subject 3rd person masculine singular',
'H:V'=>'Hebrew Verb',
'N:A'=>'Proper Name Adjective',
'N:A--LG'=>'Proper Name Adjective Gentilic Location',
'N:A--PG'=>'Proper Name Adjective Gentilic Person',
'N:A-F'=>'Proper Name Adjective Feminine person',
'N:A--L'=>'Proper Name Adjective Location',
'N:ADV-T'=>'Proper Name Adverb',
'N:N' => 'Proper Name of a Location or Person with no stated gender',
'N:N--L/N:N--LG/N:N-M-P'=>'Proper Name of a Location OR of a Location in Gentilic sense OR of a Male Person',
'N:N--L/N:N--LG'=>'Proper Name of a Location OR of a Location in Gentilic sense',
'N:N--L/N:N-M-P'=>'Proper Name of a Location OR of a Male Person',
'N:N--L/N:N-M-T'=>'Proper Name of a Location OR Male of some kind',
'N:N--LG/N:N-M-P'=>'Proper Name of a Location in Gentilic sense OR of a Male Person',
'N:N--LG'=>'Proper Name Noun Gentilic Location',
'N:N--L'=>'Proper Name Noun Location',
'N:N--PG'=>'Proper Name Noun Gentilic Person',
'N:N--TG'=>'Proper Name Noun Gentilic Title',
'N:N--T'=>'Proper Name Noun Title',
'N:N-F-LG'=>'Proper Name Noun Female Gentilic Location',
'N:N-F-L'=>'Proper Name Noun Female Location',
'N:N-F-P/N:N--L'=>'Proper Name of a Female Person OR of a Location',
'N:N-F-PG'=>'Proper Name Noun Female Gentilic Person',
'N:N-F-P'=>'Proper Name Noun Female Person',
'N:N-F-T/N:N--L'=>'Proper Name of a Female of some kind OR of a Location',
'N:N-F-T'=>'Proper Name Noun Female Title',
'N:N-M-LG'=>'Proper Name Noun Male Gentilic Location',
'N:N-M-L'=>'Proper Name Noun Male Location',
'N:N-M-P/N:A'=>'Proper Name of a Male Person OR Adjectival',
'N:N-M-P/N:N--L'=>'Proper Name of a Male Person OR of a Location',
'N:N-M-P/N:N-F-P/N:N--L'=>'Proper Name of a Male Person OR of a Female Person OR of a Location',
'N:N-M-P/N:N-F-P'=>'Proper Name of a Male Person OR of a Female Person',
'N:N-M-P/N:N-M-PG'=>'Proper Name of a Male Person OR of a Male Person in Gentilic sense',
'N:N-M-P/N:N-M-T'=>'Proper Name of a Male Person OR Male of some kind',
'N:N-M-PG'=>'Proper Name Noun Male Gentilic Person',
'N:N-M-P'=>'Proper Name Noun Male Person',
'N:N-M-T'=>'Proper Name Noun Male Title',
'Prefix'=>'Prefix',
'Punct.'=>'Punctuation',
'Suffix'=>'Suffix',
);
if ($morph===NULL && $output===NULL) { return $lookup; }
if (empty($morph)) { return TRUE; }
$missing = (empty($lookup[$morph]) ? 'missing' : '');
$text = (empty($lookup[$morph]) ? '' : $lookup[$morph]);
$morphs["{$morph}\t{$text}\t{$missing}"] = TRUE;
if (!empty($missing)) { return FALSE; }
return TRUE;

}


// lexicon wipe used to leave unused
function AION_NEWSTRONGS_LEX_WIPE(&$lexicon) {
	foreach( $lexicon as $strongs => $entry ) {
		if (empty($entry['WORD']) &&
			empty($entry['TRANS']) &&
			empty($entry['MORPH']) &&			
			empty($entry['DEF'])) {
			unset($lexicon[$strongs]);
		}
		else {
			unset($lexicon[$strongs]['TRANS']);
			unset($lexicon[$strongs]['MORPH']);
			unset($lexicon[$strongs]['DEF']);
			$lexicon[$strongs]['VARIANT'] = (empty($lexicon[$strongs]['VARIANT']) ? "" : $lexicon[$strongs]['VARIANT']);
		}
	}
}



// lexicon fill strongs number holes and also pad to same line length
function AION_NEWSTRONGS_GET_FIX_INDEX(&$lines) {
	// sort
	ksort($lines,SORT_NATURAL);
}


// create lexicon index file
function AION_NEWSTRONGS_GET_INDEX_LEX($input, $output) {
	// init
	$newmess = "INDEX_LEX\t$input\t$output";
	if ( ($contents = file_get_contents( $input )) === FALSE ) {		AION_ECHO("ERROR! $newmess !file_get_contents()"); }
	if ( mb_detect_encoding($contents, "UTF-8", TRUE) === FALSE ) {		AION_ECHO("ERROR! $newmess !mb_detect_encoding()"); }
	mb_regex_encoding("UTF-8");
	mb_internal_encoding("UTF-8");	
	// loop through lines
	$bytes = 0;
	$index = array();
	$line = strtok($contents, "\n");
	while ($line !== false) {
		$strongs = trim(substr($line, 0, strpos($line, "\t")));
		if ($line[0]!="#" && $strongs!="STRONGS") {		
			if (!preg_match("#^([\d]{1,5})([A-Za-z]{0,1})$#u", $strongs, $match)) {	AION_ECHO("ERROR! $newmess !preg_match(strongs=$strongs)"); }
			if ($strongs != $match[1]) { // mark the bald strongs number with all the extensions!
				$index[$match[1]] = (empty($index[$match[1]]) ? $bytes : $index[$match[1]].','.$bytes );
			}
			$index[$strongs] = $bytes;
		}
		$bytes += (strlen($line) + 1);
		$line = strtok( "\n" );
	}
	// write the json array
	global $strongs_json_flag;
	if (file_put_contents($output,json_encode($index, $strongs_json_flag)) === FALSE ) { AION_ECHO("ERROR! $newmess file_put_contents $output" ); }
	return;
}


// Count all strongs references
function AION_NEWSTRONGS_GET_INDEX_LEX_CHECKER($index_file, $lexicon_file, $exception=NULL) {
	$newmess = "INDEX_LEX_CHECKER $index_file";
	// read data
	$index = json_decode(file_get_contents($index_file), true);
	if (empty($index)) {														AION_ECHO("ERROR! $newmess !json_decode($index_file)"); }
	if (!($fd=fopen($lexicon_file, 'r'))) {										AION_ECHO("ERROR! $newmess !fopen($lexicon_file)"); }
	// loop through counts
	foreach($index as $strongs => $positions) {
		$positionsA = explode(",", $positions);
		// Exception for H2428 which has H2428 and H2428b, but no H2428a
		$extension =
			($exception=="ALL"		? "[A-Za-z]{0,1}" :
			($strongs==$exception	? "[A-Za-z]{0,1}" :
			(count($positionsA)>1	? "[A-Za-z]{1}" : "")));
		foreach($positionsA as $position) {
			if (fseek($fd, $position) ||
				!($line=fgets($fd)) ||
				!preg_match("#^$strongs$extension\t#u",$line)) {
				AION_ECHO("WARN! $newmess NOTFOUND! strongs=$strongs positions=$positions line=$line");
			}
		}
	}
	fclose($fd);
	return;
}


// Greek lexicon uStrongs and dStrongs merge
function AION_NEWSTRONGS_GET_LEXY($table,&$database) {
	$newmess = "AION_NEWSTRONGS_GET_LEXY()";
	$fixed = $fixedmore1 = $fixedmore2 = $fixedmore3 = 0;
	$howmany = count($database[$table]);
	foreach($database[$table] as $key => $entry) {
		// fix the STRONGS, DSTRONGS, and USTRONGS
/*
eStrong	dStrong	uStrong
G0001	G0001H =	G0001H
G0002	G0002 = the Greek of	H0175
G0005	G0005 = a Name of	H3068G
H0001	H0001G =	H0001G
H0001	H0001H = a Part of	H2438H, 
H0001	H0001I = a Part of	H0022G
H0002	H0002 = in Aramaic of	H0001G
*/
		if (!preg_match("#^([GH]{1}[\d]+[A-Z]{0,1})[ ]*=[ ]*(.*)[ ]*$#ui", $entry['STRONGS'], $match) ||
			!preg_match("#^([GH]{1}[\d]+[A-Z]{0,1}).*$#ui", $entry['STRONGU'], $matchu)) {
			AION_ECHO("ERROR! $newmess STRONGS OR STRONGU fouled in $table howmany = $howmany, strongs key=$key\n".print_r($entry,TRUE));
		}
		$entry['STRONGS'] = $database[$table][$key]['STRONGS'] = $match[1];
		$database[$table][$key]['STRONGU'] = ($match[1] == $matchu[1] && empty($match[2]) ? '' : $match[2].' '.$matchu[1]);

		// trim definition
		$database[$table][$key]['DEF'] = trim($database[$table][$key]['DEF'], " ,/:|\~`@#$%^&*+");

		// fix Definition, remove 1) with no 2)
		$count = 0;
		if ($entry['STRONGS'][0] == "H" && $entry['STRONGS'] != "H1166H" && !preg_match("#[ ]+2\)#ui",$entry['DEF'])) {
			if (!($database[$table][$key]['DEF'] = preg_replace("#(^|[ ]+)1\)#ui", '$1', $database[$table][$key]['DEF'], -1, $count)) || $count>1 ||
				!($database[$table][$key]['DEF'] = preg_replace($reg="#[ ]+#usi"," ", $database[$table][$key]['DEF']))) {
				AION_ECHO("ERROR! $newmess outline removal error $count\n".print_r($entry,TRUE));
			}
			$fixed += $count;
			if ($count && preg_match("#[ ]+[3-9]+[\d]*\)#ui", $entry['DEF'])) {
				AION_ECHO("WARN! $newmess Weird, no '2)' removed '1)' but found '3)' $newmess $count\n".print_r($entry,TRUE));
			}
		}

		// hyperlink (AS) (MT) (ML)
		// Source Definitions: (AS) = Abbott Smith - from https://github.com/translatable-exegetical-tools/Abbott-Smith, with corrections and adapted by Tyndale Scholars. 
		// Source Definitions: (ML) = Middle Liddell - from Perseus - used for Meaning in the Brief lexicon when there is no entry by (AS)
		// Source Definitions: (MT) = Mounce's Teknia Greek dictionary - from www.billmounce.com/greek-dictionary (with permission) - used for Meaning in the Brief lexicon when there is no entry by (AS) or (ML)
		// <a href="javascript:void(0)" title="Nestle/Aland 28th Edition, not ECM">NA28</a>
		$count1 = $count2 = $count3 = 0;
		if ($entry['STRONGS'][0] == "G" && !empty($database[$table][$key]['DEF'])) {
			if (!($database[$table][$key]['DEF'] = preg_replace("#\(AS\)#u", '(<a href="javascript:void(0)" title="Abbott Smith">AS</a>)',						$database[$table][$key]['DEF'], -1, $count1)) ||
				!($database[$table][$key]['DEF'] = preg_replace("#\(ML\)#u", '(<a href="javascript:void(0)" title="Middle Liddell, Perseus">ML</a>)',			$database[$table][$key]['DEF'], -1, $count2)) ||
				!($database[$table][$key]['DEF'] = preg_replace("#\(MT\)#u", '(<a href="javascript:void(0)" title="Mounce\'s Teknia Greek dictionary">MT</a>)',	$database[$table][$key]['DEF'], -1, $count3))) {
				AION_ECHO("ERROR! $newmess problem with (AS) (ML) (MT)\n".print_r($entry,TRUE));
			}
			$fixedmore1 += $count1;
			$fixedmore2 += $count2;
			$fixedmore3 += $count3;
		}

		// hyperlink strong numbers
		$database[$table][$key]['DEF'] = AION_NEWSTRONGS_HYPERLINK($newmess, $database[$table][$key]['DEF']);
		$database[$table][$key]['STRONGU'] = AION_NEWSTRONGS_HYPERLINK($newmess, $database[$table][$key]['STRONGU']);
		
		// other fixes
		if ($entry['STRONGS'] == 'H9001') { $database[$table][$key]['GLOSS'] = 'and'; } // Fix H9001
	}
	$database['FIXCOUNTS'].="$newmess removed Hebrew '1)' times=$fixed\n";	
	$database['FIXCOUNTS'].="$newmess replaced (AS) times=$fixedmore1\n";
	$database['FIXCOUNTS'].="$newmess replaced (MT) times=$fixedmore2\n";
	$database['FIXCOUNTS'].="$newmess replaced (ML) times=$fixedmore3\n";
}



// Search and replace text Strongs with glossary hyperlink!
function AION_NEWSTRONGS_HYPERLINK($newmess, $text) {
	if (empty($text)) { return $text; }
	if (NULL===($text = preg_replace("#(^|[^[:alnum:]]{1})G([\d]+)#u", '$1g$2', $text))) { AION_ECHO("ERROR! $newmess Problem converting G to lowercase"); }
	if (NULL===($text = preg_replace("#(^|[^[:alnum:]]{1})H([\d]+)#u", '$1h$2', $text))) { AION_ECHO("ERROR! $newmess Problem converting H to lowercase"); }
	if (NULL===($text = preg_replace(
		"#(^|[^[:alnum:]]{1})([gh]{1}[\d]+[A-Za-z]{0,1})#ui",
		"\$1<a href='/Strongs/strongs-\$2' onclick='return ABMM(\"/Strongs\",\"/strongs-\$2\");'>\$2</a>",
		$text))) {
		AION_ECHO("ERROR! $newmess Problem converting strongs number to href links");
	}
	return $text;
}



// Search and replace text Strongs with glossary hyperlink!
// Philistine @ Gen.21.32-Zec
// /Bibles/English---Aionian-Bible/Genesis/21/32
function AION_NEWSTRONGS_EXTRAREF($newmess, $text, &$count) {
	// do nothing
	if (empty($text)) { return $text; }
	if (!preg_match("#\s*@\s*([[:alnum:]]{3})\.(\d+)\.(\d+)(-[[:alnum:]]{3})?(.*)$#u", $text, $match)) { return $text; }
	// get book maps
	static $abooks = NULL; if ($abooks===NULL) { $abooks = AION_BIBLES_LIST(); }
	if ($abooks['1SA']=='1 Samuel') { foreach($abooks as $key => $book) { $abooks[$key] = str_replace(" ", "-", $book); } }
	static $tbooks = NULL; if ($tbooks===NULL) { $tbooks = AION_BIBLES_LIST_TYN(); $tbooks['MKR'] = 'MAR'; } // + addition because of bug
	// get book and chapter
	$book = strtoupper($match[1]);
	if (empty($tbooks[$book])) { AION_ECHO("ERROR! $newmess EXTRAREF missing Tyndale book='$book' text='$text'"); }
	$book = $tbooks[$book];
	if (empty($abooks[$book])) { AION_ECHO("ERROR! $newmess EXTRAREF missing Aionian book='$book' text='$text'"); }
	$book = $abooks[$book];
	$chap = (int)$match[2];
	$vers = (int)$match[3];
	// range
	if (empty($match[4])) { $range = $next = NULL; }
	else if ($match[4][0]=='-' && ctype_digit(substr($match[4],1))) { $range = $match[4]; $next = NULL; }
	else {
		$range = NULL;
		$next = $match[4];
		// commented out for now - not much gained with hyperlinking the reference end point
		/*
		$keep = substr($match[4],1);
		$book2 = strtoupper($keep);
		if (empty($tbooks[$book2])) { AION_ECHO("ERROR! $newmess EXTRAREF2 missing Tyndale book2='$book2' text='$text'"); }
		$book2 = $tbooks[$book2];
		if (empty($abooks[$book2])) { AION_ECHO("ERROR! $newmess EXTRAREF2 missing Aionian book='$book2' text='$text'"); }
		$book2 = $abooks[$book2];
		$next = "-<a href='/Bibles/English---Aionian-Bible/{$book2}' onclick='return ABMM(\"/Bibles\",\"/{$book2}\");'>{$keep}</a>";
		*/
	}
	// extra 
	$extra = $match[5];
	// insert the link
	if (NULL===($text = preg_replace(
		"#{$match[0]}#u",
		" @ <a href='/Bibles/English---Aionian-Bible/{$book}/{$chap}' onclick='return ABMM(\"/Bibles\",\"/{$book}/{$chap}\");'>{$match[1]}.{$chap}.{$vers}{$range}</a>{$next}{$extra}",
		$text))) {
		AION_ECHO("ERROR! $newmess Problem converting tag reference to href link text='$text'");
	}
	++$count;
	return $text;
}



// Viz need its own fixing
function AION_NEWSTRONGS_FIX_VIZ($input,$what,$table,&$database,$osstrongs,$osstrongs2) {
	$database[$table] = array();
	// copy and correct
	// OpenScriptures array format
	//"H2":{"lemma":"אַב","xlit":"ʼab","pron":"ab","derivation":"(Aramaic) corresponding to H1 (אָב)","strongs_def":"{father}","kjv_def":"father."},
	// Hebrew = lemma, xlit, pron, derivation, strongs_def, kjv_def
	//"G1615":{"strongs_def":" to complete fully","derivation":"from G1537 (ἐκ) and G5055 (τελέω);","translit":"ekteléō","lemma":"ἐκτελέω","kjv_def":"finish"},
	// Greek = lemma, translit, derivation, strongs_def, kjv_def
	// error check Open Scripture to Viz strongs
	foreach( $osstrongs as $key => $entry ) {
		if(empty($input[$key])) { AION_ECHO("ERROR! OpenScripture Strong not found in Viz Strong! strongs=$key"); }
		if ($what=='G') { $osstrongs[$key]['xlit'] = $osstrongs[$key]['translit']; }
	}
	// construct the table
	foreach( $input as $x => $line ) {
		if (!preg_match("#^$what#ui",$line['STRONGS'])) { continue; } // build greek and hebrew separately
		if(empty($osstrongs[$x])) { AION_ECHO("ERROR! Viz Strong not found in OpenScripture Strong! strongs=$x"); }
		$line['STRONGS'] = substr($line['STRONGS'], 1); // wack off the first character
		if (empty($line['WORD']) && empty($line['TRANS']) && empty($line['DEF'])) { continue; } // skip empty lines
		if (!empty($database[$table][$line['STRONGS']])) { AION_ECHO("ERROR! Duplicate strongs entry! strongs=".$line['STRONGS']); } // whoa, why not empty?
		/*
		$database[$table][$line['STRONGS']] = array(
			'STRONGS'	=> $line['STRONGS'],
			'WORD'		=> $line['WORD'],
			'TRANS'		=> $line['TRANS'],
			'PRONOUNCE'	=> $line['PRONOUNCE'],
			'LANG'		=> $line['LANG'],
			'MORPH'		=> $line['MORPH'],
			'DEF'		=> $line['DEF'],
		);
		*/
		// build definition and error check
		$definition = trim(
			(empty($osstrongs[$x]['strongs_def'])	? '' : $osstrongs[$x]['strongs_def']."; ").
			(empty($osstrongs[$x]['kjv_def'])		? '' : $osstrongs[$x]['kjv_def']."; ").
			(empty($osstrongs[$x]['derivation'])	? '' : $osstrongs[$x]['derivation']), " ;:,");
		if (!($definition = preg_replace("#([GH]{1})[0]*([\d]+)#ui", '$1$2', $definition))) { AION_ECHO("ERROR! Strongs = $x Problem stripping zeros"); }
		if (FALSE===preg_match_all("#([GH]{1}[\d]+)#ui", $definition, $match, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! Strongs = $x Problem finding strong numbers in definition"); }
		if (!empty($match[0]) && is_array($match[0])) {
			foreach($match[0] as $strongone) {
				if(empty($osstrongs[$strongone]) && empty($osstrongs2[$strongone])) {
					// warn
					AION_ECHO("WARN! Strongs OpenScripture definition = $x referencing strongs not found = $strongone");
					// fix
					// Entry G137  derivation references G5869 which does not exist / should be H5869 
					// Entry G25   derivation references G5689 which does not exist / should be G5368
					// Entry G3304 derivation references G3203 which does not exist / should be G3303
					// Entry G3305 derivation references G3203 which does not exist / should be G3303  
					// Entry G3642 derivation references G6590 which is an extended number / should be G5590
					// Entry G4460 derivation references G7343 which is an extended number / should be H7543
					if      ($strongone=="G5869") { if (!($definition = preg_replace("#$strongone#ui", "H5869", $definition))) { AION_ECHO("ERROR! Strongs = $x Problem replacing $strongone"); } }
					else if ($strongone=="G5689") { if (!($definition = preg_replace("#$strongone#ui", "G5368", $definition))) { AION_ECHO("ERROR! Strongs = $x Problem replacing $strongone"); } }
					else if ($strongone=="G3203") { if (!($definition = preg_replace("#$strongone#ui", "G3303", $definition))) { AION_ECHO("ERROR! Strongs = $x Problem replacing $strongone"); } }
					else if ($strongone=="G6590") { if (!($definition = preg_replace("#$strongone#ui", "G5590", $definition))) { AION_ECHO("ERROR! Strongs = $x Problem replacing $strongone"); } }
					else if ($strongone=="G7343") { if (!($definition = preg_replace("#$strongone#ui", "H7543", $definition))) { AION_ECHO("ERROR! Strongs = $x Problem replacing $strongone"); } }
					else                                                                                                       { AION_ECHO("ERROR! Strongs = $x Problem replacing unidentified problem"); }
				}
			}
		}
		$definition = trim($definition, " ,/:|\~`@#$%^&*+");
		$definition = AION_NEWSTRONGS_HYPERLINK("AION_NEWSTRONGS_FIX_VIZ() hyperlink problem", $definition);
		$database[$table][$line['STRONGS']] = array(
			'STRONGS'	=> $line['STRONGS'],
			'WORD'		=> $osstrongs[$x]['lemma'],
			'TRANS'		=> $osstrongs[$x]['xlit'],
			'PRONOUNCE'	=> (!empty($osstrongs[$x]['pron']) ? $osstrongs[$x]['pron'] : $line['PRONOUNCE']),
			'LANG'		=> $line['LANG'],
			'MORPH'		=> $line['MORPH'],
			'DEF'		=> $definition,
		);
		if (($what=='H' && $line['WORD'] != $osstrongs[$x]['lemma']) || $line['TRANS'] != $osstrongs[$x]['xlit']) {
			AION_ECHO("WARN! Strongs OpenScripture != Viz: strongs=$x word: ".$line['WORD']." != ".$osstrongs[$x]['lemma']." xlit: ".$line['TRANS']." != ".$osstrongs[$x]['xlit']);
		}
	}
	ksort($database[$table],SORT_NATURAL);
}



//
// big daddy reference parser HEBREW!
//
function AION_NEWSTRONGS_FIX_REF_HEBREW($input,$table,&$database, &$lex_array, $morph_array) {
	// INITIALIZE
	$domprevious = libxml_use_internal_errors(true);
	$dom = New DOMDocument();
	libxml_clear_errors();

	$lex2_array = array();
	$KetivQere_last = $last_indx = $last_chap = $last_vers = NULL;
	if (empty($database[$table])) {
		$database[$table] = "INDX	BOOK	CHAP	VERS	STRONGS	JOIN	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	MORPH	EDITIONS	VAR	SPELL	EXTRA	ALT\n";
	}
	$strongs_counts = array();
	static $tagtypes = array(
	"A"			=> "Aleppo",
	"B"			=> "Biblia Hebraica Stuttgartensia",
	"C"			=> "Cairensis",
	"D"			=> "Dead Sea and Judean Desert manuscripts",
	"E"			=> "Emendation from ancient sources",
	"F"			=> "Format pointing or word division difference without letter changes",
	"H"			=> "Ben Chaim (2nd Rabbinic Bible)",
	"K"			=> "Ketiv 'written' in the text with Tyndale pointing",
	"L"			=> "Leningrad",
	"L(a+bh)"	=> "Leningrad with minor variants: Aleppo plus BHS and Ben Chaim",
	"L(a+V)"	=> "Leningrad with minor variants: Aleppo plus meaning variants: other Hebrew manuscripts",
	"L(abh)"	=> "Leningrad with minor variants: Aleppo, BHS, and Ben Chaim",
	"L(ah+b)"	=> "Leningrad with minor variants: Aleppo and Ben Chaim plus BHS",
	"L(AH+B)"	=> "Leningrad with meaning variants: Aleppo and Ben Chaim plus BHS",
	"L(b)"		=> "Leningrad with minor variants: BHS",
	"L(b+p)"	=> "Leningrad with minor variants: BHS plus alternate punctuation",
	"L(bah)"	=> "Leningrad with minor variants: Aleppo, BHS, and Ben Chaim",
	"L(D)"		=> "Leningrad with meaning variants: Dead Sea and Judean Desert manuscripts",
	"L(E)"		=> "Leningrad with meaning variants: emendation from ancient sources",
	"L(F)"		=> "Leningrad with meaning variants: format pointing or word division difference without letter changes",
	"L(H)"		=> "Leningrad with meaning variants: Ben Chaim (2nd Rabbinic Bible)",
	"L(p)"		=> "Leningrad with minor variants: alternate punctuation",
	"L(P)"		=> "Leningrad with meaning variants: alternate punctuation",
	"L(S)"		=> "Leningrad with meaning variants: scribal traditions",
	"L(V)"		=> "Leningrad with meaning variants: other Hebrew manuscripts",
	"LA(bh)"	=> "Leningrad and Aleppo with minor variants: BHS and Ben Chaim",
	"LA(BH)"	=> "Leningrad and Aleppo with meaning variants: BHS and Ben Chaim",
	"LAB(h)"	=> "Leningrad, Aleppo, and BHS with minor variants: Ben Chaim",
	"LAB(H)"	=> "Leningrad, Aleppo, and BHS with meaning variants: Ben Chaim",
	"LAH(b)"	=> "Leningrad, Aleppo, and Ben Chaim with minor variants: BHS",
	"LB(ah)"	=> "Leningrad and BHS with minor variants: Aleppo and Ben Chaim",
	"LB(AH)"	=> "Leningrad and BHS with meaning variants: Aleppo and Ben Chaim",
	"LB(ha)"	=> "Leningrad and BHS with minor variants: Aleppo and Ben Chaim",
	"LBH(a)"	=> "Leningrad, BHS, and Ben Chaim with minor variants: Aleppo",
	"LBH(A)"	=> "Leningrad, BHS, and Ben Chaim with meaning variants: Aleppo",
	"LBH(a+C)"	=> "Leningrad, BHS, and Ben Chaim with minor variants: Aleppo plus meaning variants: Cairensis",
	"LH(ab)"	=> "Leningrad and Ben Chaim with minor variants: Aleppo and BHS",
	"P"			=> "Alternate punctuation",
	"Q"			=> "Qere 'spoken' corrections from margin and text pointing",
	"Q(k)"		=> "Qere 'spoken' corrections from margin and text pointing, with minor variants: Ketiv 'written', Tyndale pointing",
	"Q(K)"		=> "Qere 'spoken' corrections from margin and text pointing, with meaning variants: Ketiv 'written', Tyndale pointing",
	"R"			=> "Restored text based on Leningrad parallels",
	"S"			=> "Scribal traditions",
	"V"			=> "Variants from other Hebrew manuscripts",
	"X"			=> "Extra words from Septuagint (LXX), in Hebrew based on apparatus in BHS and BHK",
	);
	
	// LOOP LINES
	foreach( $input as $line ) {
		
		// GET WORD & MESSAGE
		$WORDUP = $line['UNDER'];
		$reference = "{$line['BOOK']} {$line['CHAP']}:{$line['VERS']}>{$line['NUMB']}";
		$line['REF'] = $line['BOOK'].'.'.$line['CHAP'].'.'.$line['VERS'];
		$newmess = "FIX_REF\tHebrew\tref='{$reference}'\tword='$WORDUP'\tmorph='{$line['MORPH']}'\tstrongs='{$line['STRONGS']}'";

		// CHECK UNDER FOR DASH 
		if (preg_match("#\-#u", $line['UNDER'])) { AION_ECHO("WARN! hebrew=='-' impossible dash!\n".print_r($line,TRUE)); }

		// CHECK TYPE
		if (empty($tagtypes[$line['TYPE']])) {
			$database['MISS_MANU'] .= ($warn="$newmess\tmissing tag type: {$line['TYPE']}\n");
			AION_ECHO("WARN!\t$newmess\t$warn\n".print_r($line,TRUE)."\n\n\n");
		}

		// PARSE REFERENCE
		$book = $line['BOOK'];
		$database['BOOKS'][$book] = $book; // collect unique book names
		$indx = (int)$line['INDX'];
		$chap = (int)$line['CHAP'];
		$vers = (int)$line['VERS'];
		$numb = (int)$line['NUMB'];
		$dataref = "{$indx}\t{$book}\t{$chap}\t{$vers}";
		
		// OCCURRENCE # of STRONGS? ERROR CHECKER - HERE AND BELOW
		if ($vers != $last_vers) {
			foreach($strongs_counts as $key => $check) {
				if (1==$check) { AION_ECHO($warn="WARN! FIX_REF\tref='{$last['REF']}' Strongs sequence error, one found, multi indicated! $key\n".print_r($last,TRUE)."\n".print_r($strongs_counts,TRUE)."\n\n\n"); }
			}
			$strongs_counts = array();
		}
		
		// CHECK SORT
		if ($last_indx && (
			($last_indx >  $indx) ||
			($last_indx <  $indx && ($last_indx+1 != $indx || 1 != $chap || 1 != $vers)) ||
			($last_indx == $indx && ($last_chap   >  $chap)) ||
			($last_indx == $indx &&  $last_chap   <  $chap && ($last_chap+1 != $chap || 1 != $vers)) ||
			($last_indx == $indx &&  $last_chap   == $chap &&  $last_vers+1 != $vers && $last_vers != $vers) ||
			($last_indx == $indx &&  $last_chap   == $chap &&  $last_vers   == $vers && $last_numb >= $numb)
			)) {
			AION_ECHO($warn="WARN! $newmess reference sort order problem!\n".print_r($line,TRUE)."\n\n\n");
			$database['WARNINGS'] .= $warn;			
		}
		$last_indx = $indx;
		$last_chap = $chap;
		$last_vers = $vers;
		$last_numb = $numb;

		// REMOVE JUNK!
		$englishbefore = $line['ENGLISH'];
		if (!empty($line['ENGLISH']) &&
			!($line['ENGLISH']=preg_replace("#\s*[([{]+[\d.:]+[)}\]]+\s*#uis", " ", $line['ENGLISH']))) { AION_ECHO("ERROR! Failed to clean junk out of ENGLISH\n".print_r($line,TRUE)); }
		if ($englishbefore != $line['ENGLISH']) {
			if (!($line['ENGLISH']=trim(preg_replace("#\s+#uis", " ", $line['ENGLISH'])))) { AION_ECHO("ERROR! Failed to reduce spaces in ENGLISH\n".print_r($line,TRUE)); }
			AION_ECHO($warn="WARN! $newmess remove junk in ENGLISH={$englishbefore}\n".print_r($line,TRUE)."\n\n\n");
			$database['WARNINGS'] .= $warn;	
		}
		
		// REMOVE MORE JUNK!
		//: PERSON»face:6_(PERSON_eg_'his_face' ie 'him')[face]
		//: to[ears_of](PERSON)»ear:3_to[ears_of](PERSON)
		$strongsbefore = $line['STRONGS'];
		if (!empty($line['STRONGS']) && (
										   // : PERSON»face: (PERSON eg 'his face' ie 'him')[face]
			!($line['STRONGS']=preg_replace("#:\s*PERSON\s*»\s*face\s*:\s*\(\s*PERSON\s+eg\s+'\s*his\s+face\s*'\s+ie\s+'\s*him\s*'\s*\)\s*\[\s*face\s*\]#uis", "face (his face, person)", $line['STRONGS'])) ||
										   // : to[ears of](PERSON)»ear: to[ears of](PERSON)$
			!($line['STRONGS']=preg_replace("#:\s*to\s*\[ears\s+of\]\s*\(PERSON\)\s*»\s*ear\s*:\s*to\s*\[\s*ears\s+of\s*\]\s*\(\s*PERSON\s*\)#uis", "ear (to ears of, person)", $line['STRONGS'])))) {
			AION_ECHO("ERROR! Failed to clean junk out of STRONGS\n".print_r($line,TRUE)); }
		if ($strongsbefore != $line['STRONGS']) {
			if (!($line['STRONGS']=trim(preg_replace("#\s+#uis", " ", $line['STRONGS'])))) { AION_ECHO("ERROR! Failed to reduce spaces in STRONGS\n".print_r($line,TRUE)); }
			AION_ECHO($warn="WARN! $newmess remove junk in STRONGS={$strongsbefore}\n".print_r($line,TRUE)."\n\n\n");
			$database['WARNINGS'] .= $warn;	
		}

		// PARSE HEBREW and STRONGS
		//"W"	=> "Next word",
		//"W$"	=> "Next word (Hebrew root)",
		//"W+"	=> "Next word (+following shares Strongs)",
		//"C"	=> "Continue previous word",
		//"C$"	=> "Continue previous word (Hebrew root)",
		//"C+"	=> "Continue previous word (+following shares Strongs)",
		//"J"	=> "Joined with previous word",
		//"J$"	=> "Joined with previous word (Hebrew root)",
		//"D"	=> "Divided from previous word",
		//"D$"	=> "Divided from previous word (Hebrew root)",
		//"L"	=> "Link previous-next word",
		//"P"	=> "Punctuation",
		//
		// Delimiter is "/" unless punctuation then "\"
		$wpart = mb_split("[/\\\\]{1}", $WORDUP);
		$spart = mb_split("[/\\\\]{1}", $line['STRONGS']);
		$jointype = preg_split("#([/\\\\]{1})#uis", $line['STRONGS'], -1, PREG_SPLIT_DELIM_CAPTURE);
		foreach($jointype as $jkey => $thisone) {
			if ('/'==$thisone) {		$jointype[$jkey] = 'C'; }
			else if ('\\'==$thisone) {	$jointype[$jkey] = 'P'; }
			else {						unset($jointype[$jkey]); }
		}
		array_unshift($jointype, 'W'); // Specify jointype for first component which has no delimiter
		if (count($spart) != count($jointype)) {
			AION_ECHO("ERROR!\tStrongs count != Delimiter count\n".print_r($line,TRUE)."\n\n\n".print_r($spart,TRUE)."\n\n\n".print_r($jointype,TRUE)."\n\n\n");
		}
		if (count($wpart) != count($spart)) { // must be equal
			$database['CORRUPT_STRONGS'] .= ($warn="$newmess\tHebrew '/' Strongs and Word dividers not equal!\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
		}
		// PARSE TRANS, ENGLISH, and MORPHHOLOGY
		$tpart = array_map('trim', mb_split("[/\\\\]{1}", $line['TRANS']));
		$epart = array_map('trim', mb_split("[/\\\\]{1}", $line['ENGLISH']));
		$mpart = array_map('trim', mb_split("[/\\\\]{1}", $line['MORPH']));
		if (count($tpart) != count($epart) || count($epart) != count($mpart)) { // must be equal
			$database['CORRUPT_STRONGS'] .= ($warn="$newmess\tHebrew '/' Transliteration, English, and Morpphology dividers not equal!\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
		}
		if (($sparty=count($spart)) < ($tparty=count($tpart))) { // strongs parts must be >= transliterations
			AION_ECHO("ERROR!\tsparty < tparty\n".print_r($line,TRUE)."\n\n\n");
		}
		else if ($sparty > $tparty) { // if strongs > transliterations, then must be punctuations!
			for ($xparty=$tparty; $xparty<$sparty; ++$xparty) {
				if ($jointype[$xparty] != 'P') {
					$database['CORRUPT_STRONGS'] .= ($warn="$newmess\tHebrew '/' delimiters not equal and not punctuation, $tparty != $sparty, $xparty\n");
					AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n".print_r($jointype,TRUE)."\n\n\n");
				}
			}
		}
		if (empty($mpart[0])) { // beware the few Qere with no morphhology
			$database['MISS_MORPHS'] .= ($warn="$newmess\tempty 1st part morph=".$line['MORPH']."\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
		}
		// Hebrew shares 1st letter of 1st morphhology with subsequent morphhologies
		foreach($mpart as $key => $morph) { if ($key && !empty($morph)) { $mpart[$key] = $mpart[0][0].$mpart[$key]; } }

		// LOOP THRU HEBREW STRONG COMPONENTS
		// STEPBIBLE TAG format compresses multiple components into one line, but we unpack that into multiple lines
		foreach($spart as $key => $part) {
			// INITIALIZE
			$newmess = "FIX_REF\tHebrew\tref='{$reference}'\tword='$WORDUP'\tenglish='{$line['ENGLISH']}'\tmorph='{$line['MORPH']}'\tstrongs='{$line['STRONGS']}'";
			// PARSE EACH COMPONENT INTO THREE PIECES: X=X=X»X
			$strongs_array = mb_split("=", $part);
			// reglue the 3rd component if 4 or more components and warn if so
			for($x=3; isset($strongs_array[$x]); $x++) {
				$strongs_array[2] .= ("=".$strongs_array[$x]);
				$database['CORRUPT_STRONGS'] .= ($warn="$newmess\tStrongs malformed with >3=\n");
				AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
			}
			// INITIALIZE MORE
			if (!isset($strongs_array[0])) { AION_ECHO("ERROR! $newmess Strongs !isset()\n".print_r($line,TRUE)); }
			$strongs = $strongs_array[0];
			$strongs_gloss = NULL;
			$strongs_punctuation = FALSE;
			$extra = NULL;
			// typically joined words parts, but sometimes divided parts into separate words
			// strongs //=joined, but variants divided, / / and /_/=divided, but variants joined, and /-/ Qere ignores Ketiv
			// Hebrew tagged text
			// 1. Each line of the tagged text is the beginning of a new word, W or K if Ketiv
			// 3. Within one line multiple Strongs numbers joined with a '/' are parts of the same word, P
			// 4. Within one line multiple Strongs numbers joined with a '//' are two words now joined, J
			// 5. Within one line multiple Strongs numbers joined with a '/ /' or  '/_/' are a word now divided into separate words, D 
			// W=next word, Ketiv=written word, Qere=read word, P=word parts, R=Root or related, J=joined words, D=divided word

			// PARSE SPECIAL CASES - QK FIRST!
			// 007,JDG,016,025,50200,QK,, ,, ,,,,,K= ki (כִּי) "for" (H3588A=HR)												,L= כְּי ¦;,,,,H3588A
			// 008,RUT,003,012,50500,QK,, ,, ,,,,,K= 'im (אִם) "if" (H518B=HTc)												,L= אם ¦;,,,,H518B, H3588B_c
			// 009,1SA,009,001,50400,QK,, ,, ,,,,,K= ya.Min (יָמִין) "-jamin" (H3225I=HNpm)									,L= יָמִ֗ין ¦;,,,,H3225I
			// 009,1SA,024,008,70600,QK,, ,, ,,,,,K= min- (מִן\־) "from" (H4480A\H9014=HR)									,L= מֵֽן\־ ¦;,,,,H4480A
			// 010,2SA,013,033,51500,QK,, ,, ,,,,,K= 'im- (אִם\־) "except" (H518B\H9014=HTc)									,L= אִם\־ ¦;,,,,H518B, H3588B
			// 012,2KI,005,018,52300,QK,, ,, ,,,,,K= na' (נָא) "please" (H4994=HTj)											,L= נא ¦;,,,,H4994
			// 014,2CH,034,006,50700,QK,, ,, ,,,,,K= be./har (בְּ/הַר) "in/ [the] hill country of" (H9003/H2022G=HR/Ncbsc)		,L= בְּ/הַרְ ¦;,,,,H2022G
			// 023,ISA,044,024,51600,QK,, ,, ,,,,,K= mi (מִי) "who [was]?" (H4310=HPi)										,L= מֵי ¦;,,,,H4310, H4325G
			// 024,JER,038,016,51000,QK,, ,, ,,,,,K= 'et (אֵת) "<obj.>" (H853=HTo)											,L= את ¦;,,,,H853_a
			// 024,JER,039,012,51100,QK,, ,, ,,,,,K= 'im (אִם) "except" (H518B=HTc)											,L= אם ¦;,,,,H518B, H3588B_b
			// 024,JER,051,003,50300,QK,, ,, ,,,,,K= yid.rokh (יִדְרֹךְ) "he bend" (H1869=HVqi3ms)								,L= ידרך ¦;,,,,H1869_A
			// 025,LAM,001,006,50200,QK,, ,, ,,,,,K= min- (מִן\־) "from" (H4480A\H9014=HR)									,L= מִן\־ ¦;,,,,H4480A
			// 025,LAM,004,003,51000,QK,, ,, ,,,,,K= ki (כִּי) "for" (H3588A=HTc)												,L= כַּיְ ¦;,,,,H3588A
			// 026,EZE,048,016,51200,QK,, ,, ,,,,,K= cha.mesh (חֲמֵשׁ) "five" (H2568=HAcbsc)									,L= חמש ¦;,,,,H2568_B

			if ($strongs=="" && 'Q(K)'==$line['TYPE'] && empty($WORDUP)) {
				if (!empty($line['TRANS']) ||
					!empty($line['MORPH']) ||
					//                  1            2             3              4                          5       6        
					!preg_match("#^K=\s+([^\s]+)\s+\(([^)]+)\)\s+\"([^\"]+)\"\s+\((H\d+[[:alpha:]]*)[\/\\\\]*([^=]*)=([^)]+)\)$#ui",$line['VAR'], $match)) {
					AION_ECHO("ERROR! $newmess strongs='' only for a few qere!\n".print_r($line,TRUE));
				}
				// Parse and rebuild into a line in my own format
				AION_ECHO("WARN! $newmess QERE Special!\n".print_r($line,TRUE));
				$strongs = AION_NEWSTRONGS_STRONGS_PARSE($newmess, $match[4], FALSE, $lex_array, $lex2_array); // just check it
				if (count($strongs)>1) { AION_ECHO("ERROR! $newmess strongs='' for Qere too many strongs!\n".print_r($line,TRUE)); }
				$strongs2 = NULL;
				$strongs = $strongs[0];
				$translit = $match[1];
				$english = $match[3];
				if ($english=='&') { $english = 'and'; }
				if (!($english = preg_replace('/([,:;])+/ui', '$1 ', $english)) ||
					!($english = preg_replace('/<obj\.>/ui', 'obj', $english)) ||
					!($english = preg_replace('/\s+/ui', ' ', $english))) {
					AION_ECHO("ERROR! qere gloss preg_replace()!\n".print_r($line,TRUE));
				}
				$english = '<'.trim($english,' :;').'>';
				$under = $match[2];
				$morph = ($match[6]=='HR/Ncbsc' ? 'HNcbsc' : $match[6]); // only one of this case
				if (empty($morph) || (!empty($morph) && empty($morph_array[$morph]))) {
					$database['MISS_MORPHS'] .= ($warn="$newmess\tmissing morph='$morph'\n");
					AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
				}
				// INDX	BOOK	CHAP	VERS	STRONGS	JOIN	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	MORPH	EDITIONS	VAR	SPELL	EXTRA	ALT
				// THESE CASES RESULT IN A DOUBLE LINE
				if (!empty($match[5])) {
					$strongs2 = AION_NEWSTRONGS_STRONGS_PARSE($newmess, $match[5], FALSE, $lex_array, $lex2_array); // just check it
					if (count($strongs2)>1) { AION_ECHO("ERROR! $newmess strongs='' for Qere too many strongs2!\n".print_r($line,TRUE)); }
					$strongs2 = $strongs2[0];
					//1Sa.24.8(24.9)#06=Q(K)		[ ]	[ ]			K= min- (מִן\־) "from" (H4480A\H9014=HR)	L= מֵֽן\־ ¦ ;									
					//Lam.1.6#02=Q(K)		[ ]	[ ]			K= min- (מִן\־) "from" (H4480A\H9014=HR)	L= מִן\־ ¦ ;	
					if ($strongs=="H4480A" && $strongs2=="H9014") {
					$database[$table] .= "{$dataref}	{$strongs}	{$jointype[$key]}	{$line['TYPE']}	מִן\־	min-	מֵֽן	from	from	HR		L= מֵֽן\־		Scribes omitted word recorded as a variant	\n";
					$database[$table] .= "{$dataref}	{$strongs2}	L	{$line['TYPE']}	מִן\־		[־ִ]	[-]	[link]					Scribes omitted word recorded as a variant	\n";
					}
					//2Sa.13.33#15=Q(K)		[ ]	[ ]			K= 'im- (אִם\־) "except" (H0518B\H9014=HTc)	L= אִם\־ ¦ ;									
					else if ($strongs=="H518B" && $strongs2=="H9014") {
					$database[$table] .= "{$dataref}	{$strongs}	{$jointype[$key]}	{$line['TYPE']}	אִם\־	im-	אִם	except	except	HTc		L= אִם\־		Scribes omitted word recorded as a variant	\n";
					$database[$table] .= "{$dataref}	{$strongs2}	L	{$line['TYPE']}	אִם\־		[־]	[-]	[link]					Scribes omitted word recorded as a variant	\n";
					}
					//2Ch.34.6#07=Q(K)		[ ]	[ ]			K= be./har (בְּ/הַר) "in/ [the] hill country of" (H9003/H2022G=HR/Ncbsc)	L= בְּ/הַרְ ¦ ;	
					else if ($strongs=="H9003" && $strongs2=="H2022G") {
					$database[$table] .= "{$dataref}	{$strongs}	{$jointype[$key]}	{$line['TYPE']}	בְּ/הַר	be.	ב	in	in	HR				Scribes omitted word recorded as a variant	\n";
					$database[$table] .= "{$dataref}	{$strongs2}	C	{$line['TYPE']}	בְּ/הַר	har	הַר	[the] hill country of	[the] hill country of	HNcbsc				Scribes omitted word recorded as a variant	\n";
					}
					// BOMB
					else { AION_ECHO("ERROR! $newmess QereKetiv should not be here!\n".print_r($line,TRUE)); }
				}
				// SINGLE QK LINE
				else {
					$database[$table] .= "{$dataref}	{$strongs}	{$jointype[$key]}	{$line['TYPE']}	{$under}	{$translit}	{$under}	{$english}	{$english}	{$morph}	{$line['EDITIONS']}		{$line['SPELL']}	Scribes omitted word recorded as a variant	\n";
				}
				// Done with this case, so continue
				continue;
			}
			// PARSE SPECIAL CASE - Nothing in this case! So next component is Punctuation or a Join
			else if ($strongs=="") {
				if (!preg_match("#//#ui",$WORDUP)) { AION_ECHO("ERROR! $newmess Found // in strongs BUT !word\n".print_r($line,TRUE)); }
				if ($jointype[$key+1] != 'P') { $jointype[$key+1] = "J"; }
				continue;
			}
			// PARSE SPECIAL CASE - Nothing in this case! So next component is Punctuation or a Divide
			else if ($strongs==" " || $strongs=="_") {
				if (!preg_match("#/\s*/#ui",$WORDUP) && !preg_match("#\\\\\s*\\\\#ui",$WORDUP) &&
					!preg_match("#/_/#ui",$WORDUP) && !preg_match("#\\\\_\\\\#ui",$WORDUP)) {
					AION_ECHO("ERROR! $newmess Found // or / / or /_/ in strongs BUT !word=='$WORDUP'\n".print_r($line,TRUE));
				}
				if ($jointype[$key+1] != 'P') { $jointype[$key+1] = "D"; }
				continue;
			}
			// ILLEGAL
			else if ($strongs=="-" || $strongs=="־") {
				AION_ECHO("ERROR! $newmess strongs='-'\n".print_r($line,TRUE));
			}
			// PARSE COMMON CASE - Most entries here
			else {
				// initialize and error checks
				$strongs = trim($strongs);
				$part = trim($part);
				if ($strongs==$part) { AION_ECHO("ERROR! strongs==part impossible!\n".print_r($line,TRUE)); }
				if (!($strongs_hebrew = (empty($strongs_array[1]) ? NULL : trim($strongs_array[1])))) {
					AION_ECHO("ERROR! Strongs empty Hebrew part $newmess\n".print_r($line,TRUE));
				}
				if (preg_match("#\-#u", $strongs_hebrew)) { AION_ECHO("WARN! lexicon=='-' impossible dash!\n".print_r($line,TRUE)); }
				// parse the 3rd component, gloss and extra
				$strongs_array[2] = trim($strongs_array[2],":; ");
				// remove trailing '$+' and add to join type
				// note that the '$' was added when '{}' where stripped in AION_NEWSTRONGS_GET_PREPH()
				if (preg_match('#^(.+)([$+]+)$#ui', $strongs_array[2], $engmatch)) {
					$strongs_array[2] = $engmatch[1];
					if ('P' != $jointype[$key]) { $jointype[$key] .= $engmatch[2]; }
				}
				if (empty($strongs_array[2])) {
					AION_ECHO("ERROR! Strongs empty English part $newmess\n".print_r($line,TRUE));
				}
				// build the EXTRA field from the 3rd component
				else if (preg_match("#^([^»]+)»(.+)$#ui", $strongs_array[2], $match) && ($strongs_gloss=trim($match[1],",:; "))) {
					$extra = $match[2];
					$extra = preg_replace("#\d+_#u", "", $extra);
					$extra = preg_replace("#@#u", " @ ", $extra);
					$extra = preg_replace("#[_ ]+#u", " ", $extra);
					$extra = trim($extra," @:;,-$+");
					if ($extra) {
						//»between:1_between
						//»to call:2_call_by;name
						//»LORD@Gen.1.1-Heb
						//»to see:1_see;show
						//: true»truth:2_true
						// parse pieces, clean, and remove duplication
						if (($pieces = mb_split("[:;]+", $extra))) {
							foreach($pieces as $k => $piece) { $pieces[$k] = trim($piece," @:;,-+$"); }
							$pieces = array_flip(array_flip($pieces)); // values to keys, keys to values to remove duplicates.
							foreach($pieces as $k => $piece) { // wipe additional if the same as english or gloss!
								if ((!empty($epart[$key]) && mb_strtolower($piece) == mb_strtolower($epart[$key])) || mb_strtolower($piece) == mb_strtolower($strongs_gloss)) {
									unset($pieces[$k]);
								}
							}
							if (!empty($pieces)) { $extra = implode(", ", $pieces); }
							else { $extra = ''; }
						}
					}
				}
				// Simple case
				else {
					$strongs_gloss = trim($strongs_array[2],",:; ");
				}
				// HANDLE PUNCTUATION
				static $punctuation = array(
					'־' => 'link',			// H9014
					'׀' => 'separate',		// H9015
					'׃' => 'fullstop',		// H9016
					'פ' => 'chapter',		// H9017
					'ס' => 'paragraph',		// H9018
					'׆' => 'section',		// H9019
				);
				if (!empty($punctuation[$strongs_hebrew])) {
					if ('P'!=$jointype[$key]) {
						AION_ECHO("WARN! Hey punctuation not marked! key={$key} hebrew='{$strongs_hebrew}' punct='{$punctuation[$strongs_hebrew]}' $newmess\n".print_r($line,TRUE)."\n".print_r($jointype,TRUE));
					}
					$jointype[$key] = 'P';
					if ('־'==$strongs_hebrew) { $jointype[$key] = "L"; }
					$strongs_gloss = "[".$punctuation[$strongs_hebrew]."]";
					$strongs_hebrew = "[$strongs_hebrew]";
					$strongs_punctuation = TRUE;
				}
				else {
					if ('P'==$jointype[$key]) { AION_ECHO("WARN! Hey punctuation is marked! $newmess\n".print_r($line,TRUE)); }
				}
				if ($strongs_gloss=='&') { $strongs_gloss = 'and'; }
				if (!($strongs_gloss = preg_replace('/[ ]*([,:;])+/ui', '$1 ', $strongs_gloss)) ||
					!($strongs_gloss = preg_replace('/obj\./ui', 'obj', $strongs_gloss)) ||
					!($strongs_gloss = preg_replace('/^[ ]*emph\.[ ]*$/ui', '[emphasis]', $strongs_gloss)) ||
					!($strongs_gloss = preg_replace('/\s+/ui', ' ', $strongs_gloss))) {
					AION_ECHO("ERROR! gloss preg_replace()!\n".print_r($line,TRUE));
				}
				$strongs_gloss = trim($strongs_gloss,' ,:;');
				if (preg_match("#־#u", $strongs_gloss)) { AION_ECHO("WARN! gloss=='־' impossible dash!\n".print_r($line,TRUE)); }
			}

			// VALIDATE STRONGS
			$strongs = AION_NEWSTRONGS_STRONGS_PARSE($newmess, $strongs, FALSE, $lex_array, $lex2_array);
			if (count($strongs)>1) { AION_ECHO("ERROR! $newmess More than one Hebrew Strongs!\n".print_r($line,TRUE)); }
			$strongs = $strongs[0]; // TOTHT used to have possible multiple strongs in this slot, but no more
			
			// VALIDATE MORPHS
			$morph = (empty($mpart[$key]) ? NULL : $mpart[$key]);
			if (!$strongs_punctuation && empty($morph) && !empty($mpart[$key-1]) && ("$book $chap $vers $numb"=='1CH 27 12 50600' || "$book $chap $vers $numb"=='NEH 2 13 51700')) {
				$morph = $mpart[$key-1];
				$database['MISS_MORPHS'] .= ($warn="$newmess\tfixing morph='$morph'\n");
				AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
			}
			if (($key==0 && empty($morph)) || (!empty($morph) && empty($morph_array[$morph]))) {
				$database['MISS_MORPHS'] .= ($warn="$newmess\tmissing morph='$morph'\n");
				AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
			}

			// VALIDATE TRANSLITERATION
			if (!($trans = (empty($tpart[$key]) ? NULL : $tpart[$key])) && !$strongs_punctuation) {
				$warn="$newmess\tmissing transliteration TRAN='$trans'\n";
				// special case for misplaced transliterations
				if (!empty($tpart[$key-1]) && ("$book $chap $vers $numb"=='1CH 27 12 50600' || "$book $chap $vers $numb"=='NEH 2 13 51700')) {
					$trans = $tpart[$key-1];					
					$warn="$newmess\tfixing transliteration TRAN='$trans'\n";
				}
				AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
			}
			if (preg_match("#־#u", $trans)) { AION_ECHO("WARN! trans=='־' impossible dash!\n".print_r($line,TRUE)); }
			if (!empty($punctuation[$trans]) || $trans=='-') { $trans = ''; } // wipe trans if punctuation

			// VALIDATE ENGLISH
			if (!($english = (empty($epart[$key]) ? NULL : $epart[$key]))) {
				if ($strongs_punctuation) { 	$english = ($strongs_hebrew=='[־]' ? '-' : $strongs_hebrew); }
				else if (isset($epart[$key])) {	$english = NULL; }
				else {
					$warn="$newmess\tmissing english piece\tHEBREW='$strongs_hebrew' GLOSS='$strongs_gloss' ENG='$english'\n";
					if (!empty($epart[$key-1]) && ("$book $chap $vers $numb"=='1CH 27 12 50600' || "$book $chap $vers $numb"=='NEH 2 13 51700')) {
						$english = $epart[$key-1];					
						$warn="$newmess\tfixing english piece\tHEBREW='$strongs_hebrew' GLOSS='$strongs_gloss' ENG='$english'\n";
					}
					AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
				}
			}
			if (!empty($english) && !($english = preg_replace('/obj\./iu', 'obj', $english))) {
				AION_ECHO("ERROR! english obj preg_replace()!\n".print_r($line,TRUE));
			}
			if (preg_match("#־#u", $english)) { AION_ECHO("WARN! english=='־' impossible dash!\n".print_r($line,TRUE)); }
			if (!empty($punctuation[$english]) || $english == "-") { $english = "[$english]"; } // bracket punctuation

			//  OCCURRENCE # of STRONGS? ERROR CHECKER - HERE AND ABOVE
			if (!($snum = preg_replace('#^(H\d+)[A-Za-z]*$#','$1', $strongs))) { AION_ECHO("ERROR! sequence strong preg_replace()!\n".print_r($line,TRUE)); }
			$occur = 1;
			$instance = $line['INSTANCE'];
			if (preg_match("#{$snum}[A-Za-z]{0,1}_([A-Za-z]{1})#ui", $instance, $match)) { // ok we are counting something
				$occurdig = ord(strtoupper($match[1])) - 64;
				if (empty($strongs_counts[$snum])) { if (1 != $occurdig) { AION_ECHO($warn="WARN! FIX_REF\tref='{$line['REF']}' Strongs sequence error, second but no first! $snum\n".print_r($line,TRUE)."\n\n\n"); } }
				else if ($strongs_counts[$snum] == -1) { AION_ECHO($warn="WARN! FIX_REF\tref='{$line['REF']}' Strongs sequence error, sequenced and unsequenced! $snum\n".print_r($line,TRUE)."\n\n\n"); }
				else if ($strongs_counts[$snum] + 1 != $occurdig) { AION_ECHO($warn="WARN! FIX_REF\tref='{$line['REF']}' Strongs sequence error, missed sequence! $snum\n".print_r($line,TRUE)."\n\n\n"); }
				$strongs_counts[$snum] = $occurdig;
				if ($occurdig < 1 || $occurdig > 26) { AION_ECHO("ERROR! $newmess occurmap not found!\n".print_r($line,TRUE)); } // what, where is the map?
				$occur = $occurdig;
				if (ctype_lower($match[1])) { $occur *= -1; }
				$instance = "{$snum}_{$match[1]}";
			}
			// strongs not found in instance so reset instance
			else {
				if (!preg_match("#{$snum}#u", $instance)) {
					$occur = NULL;
					if (!preg_match("#^H90#u", $snum)) { AION_ECHO($warn="WARN! FIX_REF\tref='{$line['REF']}' Strongs sequence error, used but not in instance column! $snum\n".print_r($line,TRUE)); }
				}
				$strongs_counts[$snum] = -1;
				$instance = $snum;
			}
			// alt instance counter
			if ($key==0 && preg_match('#^(H\d+)[A-Za-z]{0,1}_([A-Za-z]{1}).*$#ui', $line['ALT'], $match) && ($anum=$match[1]) && !preg_match("#{$anum}#ui", $line['INSTANCE'])) {
				$occurdig = ord(strtoupper($match[2])) - 64;
				if (empty($strongs_counts[$anum])) { if (1 != $occurdig) { AION_ECHO($warn="WARN! FIX_REF\tref='{$line['REF']}' Alt Strongs sequence error, second but no first! $anum\n".print_r($line,TRUE)."\n\n\n"); } }
				else if ($strongs_counts[$anum] == -1) { AION_ECHO($warn="WARN! FIX_REF\tref='{$line['REF']}' Alt Strongs sequence error, sequenced and unsequenced! $anum\n".print_r($line,TRUE)."\n\n\n"); }
				else if ($strongs_counts[$anum] + 1 != $occurdig) { AION_ECHO($warn="WARN! FIX_REF\tref='{$line['REF']}' Alt Strongs sequence error, missed sequence! $anum\n".print_r($line,TRUE)."\n\n\n"); }
				$strongs_counts[$anum] = $occurdig;
				if ($occurdig < 1 || $occurdig > 26) { AION_ECHO("ERROR! $newmess occurmap not found!\n".print_r($line,TRUE)); } // what, where is the map?
			}
			// second alt instance counter
			if ($key==0 && preg_match('#.+(H\d+)[A-Za-z]{0,1}_([A-Za-z]{1}).*$#ui', $line['ALT'], $match) && ($anum=$match[1]) && !preg_match("#{$anum}#ui", $line['INSTANCE'])) {
				$occurdig = ord(strtoupper($match[2])) - 64;
				if (empty($strongs_counts[$anum])) { if (1 != $occurdig) { AION_ECHO($warn="WARN! FIX_REF\tref='{$line['REF']}' Alt Strongs sequence error, second but no first! $anum\n".print_r($line,TRUE)."\n\n\n"); } }
				else if ($strongs_counts[$anum] == -1) { AION_ECHO($warn="WARN! FIX_REF\tref='{$line['REF']}' Alt Strongs sequence error, sequenced and unsequenced! $anum\n".print_r($line,TRUE)."\n\n\n"); }
				else if ($strongs_counts[$anum] + 1 != $occurdig) { AION_ECHO($warn="WARN! FIX_REF\tref='{$line['REF']}' Alt Strongs sequence error, missed sequence! $anum\n".print_r($line,TRUE)."\n\n\n"); }
				$strongs_counts[$anum] = $occurdig;
				if ($occurdig < 1 || $occurdig > 26) { AION_ECHO("ERROR! $newmess occurmap not found!\n".print_r($line,TRUE)); } // what, where is the map?
			}

			// VALIDATE STRONGS IN VAR and ALT!
			if (!empty($line['VAR'])) { AION_NEWSTRONGS_STRONGS_PARSE($newmess, $line['VAR'], TRUE, $lex_array, $lex2_array); }
			if (!empty($line['ALT'])) { AION_NEWSTRONGS_STRONGS_PARSE($newmess, $line['ALT'], TRUE, $lex_array, $lex2_array); }

			// Cleanup SPELL
			if (NULL===($spell = preg_replace("#[|¦;]+#ui", " ; ", $line['SPELL'])) ||
				NULL===($spell = preg_replace("#\s+#ui", " ", $spell))) {
				AION_ECHO("ERROR! spell preg_replace()!\n".print_r($line,TRUE));
			}
			$spell = trim($spell, "; ");

			// CLEAN UP ALTERNATE - Strip the _[A-Za-z]{1}
			if (NULL===($alternate = preg_replace("#_[A-Za-z]{1}#ui", "", $line['ALT']))) {
				AION_ECHO("ERROR! alternate preg_replace()!\n".print_r($line,TRUE));
			}
			
			// VALIDATE JOINTYPE
			if (!in_array($jointype[$key], array("W","W$","W+","C","C$","C+","J","J$","D","D$","L","P"))) {
				AION_ECHO("ERROR! bad join type! {$jointype[$key]}\n".print_r($line,TRUE));
			}

			// TAHOT Leaders in VAR and SPELL
			// VALIDATE VARIANT AND SPELL FORMAT
			// also '¦'
			$VAR = $line['VAR'];

			static $leader_count = 0;
			static $tahot_leaders = array(
				// Punc
				"#^[¦[[:punct:]]\s]+#u" => "",
				"#[¦[[:punct:]]\s]+$#u" => "",
				// first var
				"#^A\/H=\s*#u"	=> "Aleppo/BenChaim = ",
				"#^A\/V=\s*#u"	=> "Aleppo/OtherHebrew = ",
				"#^B=\s*#u"		=> "BHS = ",
				"#^C=\s*#u"		=> "Cairensis = ",
				"#^D=\s*#u"		=> "DeadSeaManuscripts = ",
				"#^E=\s*#u" 	=> "BarthelemySources = ",
				"#^F=\s*#u"		=> "Formatting = ",
				"#^H=\s*#u"		=> "BenChaim = ",
				"#^K=\s*#u"		=> "Ketiv = ",
				"#^L=\s*#u"		=> "Leningrad = ",
				"#^P=\s*#u"		=> "Alt Punctuation = ",
				"#^S=\s*#u"		=> "Sopherim = ",
				"#^V=\s*#u"		=> "Other Hebrew = ",
				// beyond var
				"#¦\s*A\/H=\s*#u"	=> "¦ Aleppo/BenChaim = ",
				"#¦\s*A\/V=\s*#u"	=> "¦ Aleppo/OtherHebrew = ",
				"#¦\s*B=\s*#u"		=> "¦ BHS = ",
				"#¦\s*C=\s*#u"		=> "¦ Cairensis = ",
				"#¦\s*D=\s*#u"		=> "¦ DeadSeaManuscripts = ",
				"#¦\s*E=\s*#u" 		=> "¦ BarthelemySources = ",
				"#¦\s*F=\s*#u"		=> "¦ Formatting = ",
				"#¦\s*H=\s*#u"		=> "¦ BenChaim = ",
				"#¦\s*K=\s*#u"		=> "¦ Ketiv = ",
				"#¦\s*L=\s*#u"		=> "¦ Leningrad = ",
				"#¦\s*P=\s*#u"		=> "¦ Alt Punctuation = ",
				"#¦\s*S=\s*#u"		=> "¦ Sopherim = ",
				"#¦\s*V=\s*#u"		=> "¦ Other Hebrew = ",
			);
			static $tahot_leaders_search = NULL; if (NULL===$tahot_leaders_search) { $tahot_leaders_search = array_keys($tahot_leaders); } // edition search and replace
			if (!empty($VAR))  { if (!($VAR =preg_replace($tahot_leaders_search,$tahot_leaders,$VAR,-1,$counter)) || $counter>3) { AION_ECHO("ERROR! LEADER! ".print_r($line,TRUE)); } $leader_count += $counter; }
			if (!empty($spell)) { if (!($spell=preg_replace($tahot_leaders_search,$tahot_leaders,$spell,-1,$counter)) || $counter>3) { AION_ECHO("ERROR! LEADER! ".print_r($line,TRUE)); } $leader_count += $counter; }

			// HTMLSPECIALCHARS
			$VAR = htmlspecialchars($VAR);
			$spell = htmlspecialchars($spell);
			$extra = htmlspecialchars($extra);
			
			// Hyperlink Expand!
			$VAR = AION_NEWSTRONGS_HYPERLINK($newmess, $VAR);
			$alternate = AION_NEWSTRONGS_HYPERLINK($newmess, $alternate);
			static $extra_count = 0;
			$extra = AION_NEWSTRONGS_EXTRAREF($newmess, $extra, $extra_count);

			// Morph expand!
			static $tag_morph_var = 0;
			static $tag_morph_xtra = 0;
			global $FOLDER_STAGE, $CHECK_HHOT;
			if (!empty($VAR)) { if (!($VAR=preg_replace($GLOBALS['MORPH']['TAG_SEARCH'],$GLOBALS['MORPH']['TAG_REPLACE'],$VAR,-1,$counter))) { AION_ECHO("ERROR! MORPHY! ".print_r($line,TRUE)); } $tag_morph_var += $counter; }
			if ($VAR.$spell.$extra.$alternate) {
				$testhtml = "$VAR<br>$spell<br>$extra<br>$alternate<br><br>";
				$dom->loadHTML("<html><body>$testhtml</body></html>");
				if (!empty(libxml_get_errors())) {
					$testhtml = "<div class='body'>".preg_replace("#([[:punct:]]+) #u","\$1\n",$testhtml)."</div>\n";
					AION_ECHO($warn="WARN! $newmess strongs='$strongs' DOMHTML Error".print_r($line,TRUE)."\n".print_r(libxml_get_errors(),TRUE)."\n\n\n");
					$database['WARNINGS'] .= $warn;
					libxml_clear_errors();
					if (file_put_contents("$FOLDER_STAGE$CHECK_HHOT",$testhtml,FILE_APPEND) === FALSE ) { AION_ECHO("ERROR! $FOLDER_STAGE$CHECK_HHOT"); } // FILE_APPEND
				}
			}

			// OUTPUT LINE
			$database[$table] .=
				$dataref . "\t".
				$strongs . "\t".
				$jointype[$key] . "\t".
				$line['TYPE'] . "\t".
				$line['UNDER'] . "\t".
				$trans . "\t".
				$strongs_hebrew . "\t".
				$english . "\t".
				$strongs_gloss . "\t".
				$morph . "\t".
				$line['EDITIONS'] . "\t".
				$VAR . "\t".
				$spell . "\t".
				$extra . "\t".
				//$line['CONJOIN'] . "\t".
				//$instance . "\t".
				//$occur . "\t".
				$alternate."\n";				
		}
		$last = $line;
	}
	// report the morph search and replace results
	AION_ECHO("WARN! AION_NEWSTRONGS_FIX_REF_HEBREW tag morph var usage = {$tag_morph_var}");
	AION_ECHO("WARN! AION_NEWSTRONGS_FIX_REF_HEBREW tag morph xtra usage = {$tag_morph_xtra}");
	AION_ECHO("WARN! AION_NEWSTRONGS_FIX_REF_HEBREW leader swap count = {$leader_count}");
	AION_ECHO("WARN! AION_NEWSTRONGS_FIX_REF_HEBREW extra link count = {$extra_count}");
	libxml_clear_errors();
	libxml_use_internal_errors($domprevious);
}


// PARSE STRONGS #
function AION_NEWSTRONGS_STRONGS_PARSE($newmess, $strongs, $variant, &$lex_array, &$lex2_array) {
	// parse?
	// add logic to optionally include strongs extension [A-Z] and convert to lowercase or don't include
	if (FALSE===preg_match_all("#(.*?)([GH]{1}[\d]{1,5})([A-Za-z]{0,1})#u", $strongs, $parsed, PREG_SET_ORDER)) { AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs) !preg_match_all()"); }
	// totally empty or more than 1 ?
	if (empty($parsed)) { AION_ECHO("ERROR! $newmess PARSE(strongs='$strongs') hey empty strongs!"); }
	$found = count($parsed);
	if (!$variant && $found != 1) { AION_ECHO("ERROR! $newmess PARSE(strongs='$strongs') hey more than 1 strongs!"); }
	if ($variant && $found > 4) { AION_ECHO("WARN! $newmess PARSE(strongs='$strongs' variant=$variant) hey more than variants=$found strongs!");
	}
	// validate
	$strong_return = array();
	foreach($parsed as $x => $set) {
		// init
		$connector = $set[1];
		$strong = $set[2];
		$strongX = (empty($set[3]) ? NULL : $strong.$set[3]);
		// connectors okay?
		if ($x==0 && !$variant && !empty($connector)) {		AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs, strong=$strong) first connector not empty = '$connector'"); }
		else if ($x && !$variant && $connector != "+") {	AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs, strong=$strong) invalid connector = '$connector'"); }
		// lexicon 1 entry?
		if ($strongX && !empty($lex_array[$strongX])) {		$strong_return[] = $strong = $strongX;
			$lex_array[$strong]['WORD'] = $lex_array[$strong]['TRANS'] = $lex_array[$strong]['MORPH'] = $lex_array[$strong]['DEF'] = NULL; // found
		}
		else if (!empty($lex_array[$strong])) {				$strong_return[] = $strong;
			$lex_array[$strong]['WORD'] = $lex_array[$strong]['TRANS'] = $lex_array[$strong]['MORPH'] = $lex_array[$strong]['DEF'] = NULL; // found
		}
		else if (!empty($lex_array[$strong.'G'])) {			$strong_return[] = $strong.'G'; AION_ECHO("WARN! $newmess PARSE(strongs=$strongs, strong=$strong/$strongX, variant=$variant, substitute=$strong.G ) variant.G in lexicon");
		}
		else if (!empty($lex_array[$strong.'A'])) {			$strong_return[] = $strong.'A'; AION_ECHO("WARN! $newmess PARSE(strongs=$strongs, strong=$strong/$strongX, variant=$variant, substitute=$strong.A ) variant.A in lexicon");
		}
		else if (!$variant) {								AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs, strong=$strong/$strongX) not in lexicon"); } // not found
		else {												AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs, strong=$strong/$strongX) variant not in lexicon"); } // not found
		// lexicon 2 entry?
		if (!empty($lex2_array)) {
			if (!empty($lex2_array[$strong])) {				$lex2_array[$strong]['WORD'] = $lex2_array[$strong]['TRANS'] = $lex2_array[$strong]['MORPH'] = $lex2_array[$strong]['DEF'] = NULL; } // found
			else if (!empty($lex2_array[$strong.'G'])) {	AION_ECHO("WARN! $newmess PARSE(strongs=$strongs, strong=$strong/$strongX, variant=$variant, substitute=$strong.G ) variant.G in lexicon2"); }
			else if (!$variant) {							AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs, strong=$strong/$strongX) not in lexicon2"); } // not found
			else {											AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs, strong=$strong/$strongX) variant not in lexicon2"); } // not found
		}
		// variant only?
		if ($variant) {
			if (!empty($lex_array[$strong])) {	$lex_array[$strong]['VARIANT'] = "Variant usage ONLY"; }
			if (!empty($lex2_array[$strong])) {	$lex2_array[$strong]['VARIANT'] = "Variant usage ONLY"; }
		}
		// build return
	}
	return $strong_return;
}


//
// big daddy reference parser GREEK!
//
function AION_NEWSTRONGS_FIX_REF_GREEK($input, $table, &$database, &$lex_array, &$lex2_array, $morph_array) {
	// INITIALIZE
	$domprevious = libxml_use_internal_errors(true);
	$dom = New DOMDocument();
	libxml_clear_errors();

	static $vartrans = array(
		"Byz"		=> "Byzantine from Robinson/Pierpoint",
		"Coptic"	=> "Coptic",
		"ESV"		=> "English Standard Version",
		"Goodnews"	=> "Goodnews",
		"KJV"		=> "King James Version",
		"KJV?"		=> "King James Version possibly",
		"NA26"		=> "Nestle/Aland 26th Edition",
		"NA27"		=> "Nestle/Aland 27th Edition",
		"NA28"		=> "Nestle/Aland 28th Edition, not ECM",
		"Latin"		=> "Latin",
		"NIV"		=> "New International Version",
		"OldLatin"	=> "Old Latin",
		"OldSyriac"	=> "Old Syriac version",
		"P46"		=> "Papyri #46",
		"P66"		=> "Papyri #66",
		"P66*"		=> "Papyri #66 corrector",
		"Punc"		=> "Accent variant from punctuation",
		"SBL"		=> "Society of Biblical Literature Greek NT",
		"Syriac"	=> "Syriac",
		"TR"		=> "Textus Receptus",
		"Treg"		=> "Tregelles",
		"Tyn"		=> "Tyndale House GNT",
		"U1"		=> "Uncial Codex #1, Sinaiticus",
		"U2"		=> "Uncial Codex #2",
		"U3"		=> "Uncial Codex #3, Alexandrinus",
		"U4"		=> "Uncial Codex #4",
		"U5"		=> "Uncial Codex #5, Bezae",
		"U6"		=> "Uncial Codex #6",
		"U32"		=> "Uncial Codex #32",
		"WH"		=> "Westcott/Hort",
	);

	$last = $last_indx = $last_chap = $last_vers = $orig_vers = $last_orig_vers = NULL;
	if (empty($database[$table])) {
		$database[$table] = "INDX	BOOK	CHAP	VERS	STRONGS	JOIN	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	MORPH	EDITIONS	VAR	SPELL	EXTRA	ALT\n";
	}
	$strongs_counts = array();
	
	// LOOP THRU ALL LINES
	//array('REF','','TYPE','WORD','ENGLISH','STRONGS','','EDITIONS','MEANING2','MEANING3','','ADDITIONAL','CONJOIN'),
	// Mat.001.001	01	M + T + O	Βίβλος (Biblos)	[The] book	G0976=N-NSF	βίβλος=book	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz			Libro	book	
	// Mat.001.001	02	M + T + O	γενέσεως (geneseōs)	of [the] genealogy	G1078=N-GSF	γένεσις=origin	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz			de origen	origin	
	// Mat.001.001	03	M + T + O	Ἰησοῦ (Iēsou)	of Jesus	G2424G=N-GSM-P	Ἰησοῦς=Jesus/Joshua	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz			de Jesús	Jesus»Jesus|Jesus@Mat.1.1	
	// Mat.001.001	04	M + T + O	Χριστοῦ (Christou)	Christ	G5547=N-GSM-T	Χριστός=Christ	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz			Ungido	Christ»Christ|Jesus@Mat.1.1	
	static $act1940 = 0;
	static $cor1312 = 0;
	foreach( $input as $line ) {
		// SKIP EMPTY
		if (empty(implode("",$line))) { continue; }

		// 1CO15:55
//INDEX	BOOK	CHAP	VERS	NUMB	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	STRONGS	MORPH	EDITIONS	VAR	SPELL	EXTRA	CONJOIN	INSTANCE	ALT
//042	LUK	016	023	00004	NKO	ᾅδῃ	hadē	ᾍδης	Hades	Hades	G0086	N-DSM	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz			Sheol»Sheol|Hell@Gen.37.35	#04	G0086	
//046	1CO	015	055	00008	NKO	θάνατε,	thanate	θάνατος	O death,	death	G2288	N-VSM-T	NA28+NA27+Tyn+SBL+WH+Treg	ᾍδη (ˍˍHadē) O Hades - G0086=N-VSM-L in: TR+Byz			#08	G2288_b	G0086		
		if ($line['BOOK'].$line['CHAP'].$line['VERS'].$line['NUMB']=="1CO01505500008") {
			$line['UNDER']		= 'ᾍδη';
			$line['TRANS']		= 'hadē';
			$line['LEXICON']	= 'ᾍδης';
			$line['ENGLISH']	= 'O Hades,';
			$line['GLOSS']		= 'Hades';
			$line['STRONGS']	= 'G86';
			$line['MORPH']		= 'N-VSM-L';
			$line['EDITIONS']	= 'TR+Byz';
			$line['VAR']		= 'θάνατος (thanate) O death - G2288=N-VSM-T in: NA28+NA27+Tyn+SBL+WH+Treg';
			$line['EXTRA']		= 'Sheol»Sheol|Hell@Gen.37.35';
			$line['CONJOIN']	= '#08';
			$line['INSTANCE']	= 'G86';
			$line['ALT']		= 'G2288';
		}
		
		// SETUP REFERENCE
		$line['REF']=$line['BOOK'].'.'.$line['CHAP'].'.'.$line['VERS'];

		// INITIALIZE
		$WORDUP = trim($line['UNDER']);
		$WORDYEP = trim($line['LEXICON']);
		$newmess = "FIX_REF\tref='".$line['REF']."'\tword='$WORDUP'\tmorph='".$line['MORPH']."'\tstrongs='".$line['STRONGS']."'";

		// REMOVE JUNK
		$englishbefore = $line['ENGLISH'];
		if (!empty($line['ENGLISH']) &&
			(!($line['ENGLISH']=preg_replace("#\s*\[pl\.\]\s*#uis", " ", $line['ENGLISH'])) ||
			!($line['ENGLISH']=preg_replace("#\s*[({[]+[\d.:]+[)}\]]+\s*#uis", " ", $line['ENGLISH'])) ||
			!($line['ENGLISH']=preg_replace("#\s*[({[]+\d+[\d.:a-zA-Z]*[)}\]]+\s*#uis", " ", $line['ENGLISH'])))) { AION_ECHO("ERROR! Failed to clean junk out of ENGLISH\n".print_r($line,TRUE)); }
		if ($englishbefore != $line['ENGLISH']) {
			if (!($line['ENGLISH']=trim(preg_replace("#\s+#uis", " ", $line['ENGLISH'])))) { AION_ECHO("ERROR! Failed to reduce spaces in ENGLISH\n".print_r($line,TRUE)); }
			AION_ECHO($warn="WARN! $newmess remove junk in ENGLISH={$englishbefore}\n".print_r($line,TRUE)."\n\n\n");
			$database['WARNINGS'] .= $warn;	
		}

		// FIX MORPHS
		$line['MORPH'] = preg_replace("/ /u", '',($morph_before=$line['MORPH'])); // remove unexpected spaces
		if ($line['MORPH']!=$morph_before) {
			$database['MISS_MORPHS'] .= ($warn="$newmess\tspace morph=".$line['MORPH']."\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
		}

		// VALIDATE TAGNT TYPE 
		static $tagnttypemissing = array();
		static $tagnttype = array(
	"(k)O"		=> "Minor variants in KJV sources, present in other sources, absent in Nestlé-Aland sources",
	"k"			=> "Minor not translated from KJV sources, absent in Nestlé-Aland and other sources",
	"K"			=> "Present in KJV sources, absent in Nestlé-Aland and other sources",
	"k(o)"		=> "Minor not translated from KJV sources, minor variants in other sources, absent in Nestlé-Aland sources",
	"K(o)"		=> "Present in KJV sources, minor variants in other sources, absent in Nestlé-Aland sources",
	"K(O)"		=> "Present in KJV sources, meaning variants in other sources, absent in Nestlé-Aland sources",
	"ko"		=> "Minor not translated from KJV and other sources, absent in Nestlé-Aland sources",
	"KO"		=> "Identical in KJV and other sources, absent in Nestlé-Aland sources",
	"n"			=> "Minor not translated from Nestlé-Aland sources, absent in KJV and other sources",
	"N"			=> "Present in Nestlé-Aland sources, absent in KJV and other sources",
	"N(k)"		=> "Present in Nestlé-Aland sources, minor variants in KJV sources, absent in other sources",
	"N(k)(o)"	=> "Present in Nestlé-Aland sources, minor variants in KJV and other sources",
	"N(k)(O)"	=> "Present in Nestlé-Aland sources, minor variants in KJV sources, meaning variants in other sources",
	"N(K)(o)"	=> "Present in Nestlé-Aland sources, meaning variants in KJV sources, minor variants in other sources",
	"N(K)(O)"	=> "Present in Nestlé-Aland sources, meaning variants in KJV and other sources",
	"N(k)O"		=> "Identical in Nestlé-Aland and other sources, minor variants in KJV sources",
	"N(K)O"		=> "Identical in Nestlé-Aland and other sources, meaning variants in KJV sources",
	"n(o)"		=> "Minor not translated from Nestlé-Aland sources, minor variants in other sources, absent in KJV sources",
	"N(o)"		=> "Present in Nestlé-Aland sources, minor variants in other sources, absent in KJV sources",
	"N(O)"		=> "Present in Nestlé-Aland sources, meaning variants in other sources, absent in KJV sources",
	"NK"		=> "Identical in Nestlé-Aland and KJV sources, absent in other sources",
	"NK(o)"		=> "Identical in Nestlé-Aland and KJV sources, minor variants in other sources",
	"NK(O)"		=> "Identical in Nestlé-Aland and KJV sources, meaning variants in other sources",
	"NKO"		=> "Identical in Nestlé-Aland, KJV, and other sources",
	"no"		=> "Minor not translated from Nestlé-Aland and other sources, absent in KJV sources",
	"NO"		=> "Identical in Nestlé-Aland and other sources, absent in KJV sources",
	"o"			=> "Minor not translated from other sources, absent in Nestlé-Aland and KJV sources",
	"O"			=> "Present in other sources, absent in Nestlé-Aland and KJV sources",
		);
		if (empty($tagnttype[$line['TYPE']]) && empty($tagnttypemissing[$line['TYPE']])) {
			$tagnttypemissing[$line['TYPE']] = TRUE;
			AION_ECHO("WARN! $newmess word type missing {$line['TYPE']}\n".print_r($line,TRUE));
		}

		// PARSE REFERENCE
		$book = $line['BOOK'];
		$database['BOOKS'][$book] = $book; // unique book names
		$indx = (int)$line['INDX'];
		$chap = (int)$line['CHAP'];
		$vers = (int)$line['VERS'];
		$numb = (int)$line['NUMB'];
		$reference = "{$indx}\t{$book}\t{$chap}\t{$vers}";

		// OCCURRENCE # of STRONGS? ERROR CHECK AND BELOW
		// first calculate the original verse number before KJV adjustment because sequence based on that!
		$orig_vers =
			($line['NUMB'][0]=='0'	? $vers - 1 :
			($line['NUMB'][0]=='2'	? $vers :
			($line['NUMB'][0]=='6'	? $vers + 1 : $vers)));

		if ($orig_vers != $last_orig_vers) {
			foreach($strongs_counts as $key => $check) {
				if (1==$check) { AION_ECHO($warn="WARN! FIX_REF\tref='{$last['REF']}' Strongs sequence error, one found, multi indicated! $key moved={$line['NUMB']})\n".print_r($last,TRUE)."\n".print_r($strongs_counts,TRUE)."\n\n\n"); }
			}
			$strongs_counts = array();
		}

		// VALIDATE REFERENCE SORT
		if ($last_indx && (
			($last_indx >  $indx) ||
			($last_indx <  $indx && ($last_indx+1 != $indx || 1 != $chap || 1 != $vers)) ||
			($last_indx == $indx &&  $last_chap >    $chap) ||
			($last_indx == $indx &&  $last_chap <    $chap && ($last_chap+1 != $chap || 1 != $vers)) ||
			($last_indx == $indx &&  $last_chap ==   $chap &&  $last_vers+1 != $vers && $last_vers != $vers) ||
			($last_indx == $indx &&  $last_chap ==   $chap &&  $last_vers ==   $vers && $last_numb >= $numb)
			)) {
			AION_ECHO($warn="WARN! $newmess reference sort order problem!\n".print_r($line,TRUE)."\n\n\n");
			$database['WARNINGS'] .= $warn;			
		}
		$last_indx = $indx;
		$last_chap = $chap;
		$last_vers = $vers;
		$last_numb = $numb;
		$last_orig_vers = $orig_vers;
		
		// SKIP EMPTY STRONGS AND WARN
		// waiting to skip in order to verify all the above checks
		if (empty($line['STRONGS'])) {
			$database['CORRUPT_STRONGS'] .= ($warn="$newmess\tword with empty strongs\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
			continue;
		}

		// PARSE STRONGS AND MORPHS
		$jointype = "W"; // W=next word, Ketiv=written word, Qere=read word, P=word parts, R=root or related, J=joined words, D=divided word
		$jointype_orig = $jointype;
		$spart = mb_split("\+", $line['STRONGS']);
		$mpart = mb_split("\+", $line['MORPH']);
		if (count($spart) != count($mpart)) { // MUST BE SAME
			$database['CORRUPT_STRONGS'] .= ($warn="$newmess\tGreek '+' dividers not equal, strongs != morphs\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
		}
		if (empty($mpart[0])) { // CANNOT BE EMPTY
			$database['MISS_MORPHS'] .= ($warn="$newmess\tempty 1st part morph=".$line['MORPH']."\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
		}

		// LOOP THRU COMPONENTS IF MULTIPLE STRONGS
		foreach($spart as $key => $part) {
			// INITIALIZE
			$newmess = "FIX_REF\tref='".$line['REF']."'\tword='$WORDUP'\tmorph='".$line['MORPH']."'\tstrongs='".$line['STRONGS']."'";
			$strongs = $part;
			
			// VALIDATE STRONGS
			$strongs = AION_NEWSTRONGS_STRONGS_PARSE($newmess, $strongs, FALSE, $lex_array, $lex2_array);
			if (count($strongs)>1) { AION_ECHO("ERROR! $newmess More than one Greek Strongs!\n".print_r($line,TRUE)); }
			$strongs = $strongs[0]; // return an array for Hebrew, but only one here!

			// OCCURRENCE # of STRONGS? ERROR CHECK AND ABOVE
			// build 3 arrays
			// get strongs bald
			if (!preg_match_all("#(G\d+)([a-zA-Z]{0,1})#u", $strongs, $match_use0, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess preg_match_all(strong occurance) $strongs\n".print_r($line,TRUE)); }
			$strongsbald = $match_use0[1][0];
			// 1st array of all strongs numbers used in STRONGS and VAR
			if (!preg_match_all("#(G\d+)([a-zA-Z]{0,1})#u", $line['STRONGS'], $match_use1, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess preg_match_all(strong occurance) $strongs\n".print_r($line,TRUE)); }
			$match_use2 = array(array(),array(),array());
			if (FALSE===preg_match_all("#(G\d+)([a-zA-Z]{0,1})=#u", $line['VAR'], $match_use2, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess preg_match_all(strong occurance2)\n".print_r($line,TRUE)); }
			$match_use = array();
			$match_use[1] = array_merge($match_use1[1], $match_use2[1]);
			// 2nd array of all strongs numbers used in INSTANCE and ALT
			$match_ins = array(array(),array(),array());
			if (!preg_match_all("#(G\d+)[_]{0,1}([a-zA-Z]{0,1})#u", $line['INSTANCE'], $match_ins, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess preg_match_all(strong instance)\n".print_r($line,TRUE)); }
			$match_alt = array(array(),array(),array());
			if (FALSE===preg_match_all("#(G\d+)[_]{0,1}([a-zA-Z]{0,1})#u", $line['ALT'], $match_alt, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess preg_match_all(strong alts)\n".print_r($line,TRUE)); }
			// compare 1st and 2nd array, should be equal
			$match_use_test = array_keys(array_flip(array_merge($match_use1[1], $match_use2[1])));	sort($match_use_test);
			$match_ins_test = array_keys(array_flip(array_merge($match_ins[1], $match_alt[1])));	sort($match_ins_test);
			if (array_diff($match_use_test, $match_ins_test)) { AION_ECHO($warn="WARN! FIX_REF\tref='{$line['REF']}' Strongs sequence error, Instances NOT IN InstanceColumn! ".implode(',',$match_use_test)." != ".implode(',',$match_ins_test)."\n".print_r($line,TRUE)); } // used to be equal, but now ALT without mention in Variant, so just confirm that used strongs listed in sequence+alt!
			// 3rd array, strongs numbers with _[A-Z] counters
			$match_num = array(array(),array(),array());
			if (FALSE===preg_match_all("#(G\d+)_([a-zA-Z]{1})#u", $line['INSTANCE'], $match_num, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess preg_match_all(strong counts)\n".print_r($line,TRUE)); }
			// set the non-counted strongs to -1
			//$stronglist = array_merge($match_use0[1], $match_use2[1]); // use $match_use0 instead of $match_use1 to avoid cases of double strongs #s
			$stronglist = array_merge($match_use0[1]); // do not include variant column in this check for now
			$stronglist = array_keys(array_flip($stronglist));
			foreach($stronglist as $use) {
				if (!in_array($use, $match_num[1])) {
					if (!empty($strongs_counts[$use])) { AION_ECHO($warn="WARN! FIX_REF\tref='{$line['REF']}' Strongs sequence error, used but not in instance column! $use\n".print_r($line,TRUE)); } // what, how already assigned?
					else { $strongs_counts[$use] = -1; }
				}
			}
			// okay verify the counts
			$foundit = $okey = NULL;
			foreach($match_num[1] as $okey => $snum) {
				// the main strongs in the record, set the 'occur'
				if ($snum == $strongsbald) { $foundit = $okey; }
				// skip the next assignments if two or more strongs numbers on this line because we already did it the 1st time
				if ($key>0) { continue; }
				// all strongs in the record
				$occurdig = ord(strtoupper($match_num[2][$okey])) - 64;
				if (empty($strongs_counts[$snum])) { if (1 != $occurdig) { AION_ECHO($warn="WARN! FIX_REF\tref='{$line['REF']}' Strongs sequence error, second sequence but no first! $snum\n".print_r($line,TRUE)."\n\n\n"); } }
				else if ($strongs_counts[$snum] == -1) { AION_ECHO($warn="WARN! FIX_REF\tref='{$line['REF']}' Strongs sequence error, sequenced and unsequenced! $snum\n".print_r($line,TRUE)."\n\n\n"); }
				else if ($strongs_counts[$snum] + 1 != $occurdig) { AION_ECHO($warn="WARN! FIX_REF\tref='{$line['REF']}' Strongs sequence error, missed sequence! $snum\n".print_r($line,TRUE)."\n\n\n"); }
				$strongs_counts[$snum] = $occurdig;
			}
			// assign 'occur'
			if ($line['REF']=='2Co.013.012' || $line['REF']=='2Co.013.013' || $line['REF']=='Rev.013.001') {	$occur = NULL; }
			else if (NULL === $foundit || $okey === NULL || empty($match_num[1])) {								$occur = 1; }
			else {
				$occurdig = ord(strtoupper($match_num[2][$foundit])) - 64;
				if ($occurdig < 1 || $occurdig > 26) { AION_ECHO("ERROR! $newmess occurmap not found!\n".print_r($line,TRUE)); } // what, where is the map?
				$occur = $occurdig;
				if (ctype_lower($match_num[2][$foundit])) { $occur *= -1; }
			}

			// VALIDATE MORPHS
			$morph = trim(($key==0 ? $mpart[0] : (empty($mpart[$key]) ? "Unknown" : $mpart[$key])));
			if (empty($morph) || empty($morph_array[$morph])) {
				$database['MISS_MORPHS'] .= ($warn="$newmess\tmissing morph=$morph key=$key mpart[key]=".$mpart[$key]."\n");
				AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
			}
			
			// VALIDATE EDITIONS
//Word & Type	Greek	English translation	dStrongs = Grammar	Dictionary form =  Gloss	editions	Meaning variants	Spelling variants	Spanish translation	Sub-meaning	Conjoin word	sStrong+Instance	Alt Strongs				
//Mat.5.30#32=N(K)O	ἀπέλθῃ.¶ (apelthē)	may depart.	G0565=V-2AAS-3S	ἀπέρχομαι=to go away	NA28+NA27+Tyn+SBL+WH+Treg	βληθῇ (ˍˍblēthēa) may be cast - G0906=V-APS-3S in: moved «3:TR+Byz		vaya	to go away	#32	G0565	G0906_b		
//Mat.8.31#11=N(K)O	ἀπόστειλον (aposteilon)	do send away	G0649=V-AAM-2S	ἀποστέλλω=to send	NA28+NA27+Tyn+SBL+WH+Treg	ἀπελθεῖν (ˍˍapelthein) to go away - G0565=V-2AAN in: moved »1:TR+Byz		envía como emisarios	to send	#11	G0649	G0565
//Mat.14.3#13=N(k)O	ἀπέθετο (apetheto)	put [him] aside	G0659=V-2AMI-3S	ἀποτίθημι=to put aside	NA28+NA27+Tyn+SBL+WH+Treg	ἔθετο (ˍetheto) put [him] - G5087=V-2AMI-3S in: moved «3:TR+Byz		puso	to put aside	#13	G0659	G5087	
//Act.9.12#06=NKO	Ἁνανίαν (Hananian)	Ananias	G0367H=N-ASM-P	Ἀνανίας=Ananias	Tyn; moved »1:NA28+NA27+SBL+WH+Treg+TR+Byz		Tyn; moved »1:Byz+TR: Ἀνανίαν ; 	Ananías	Ananias»Ananias|Ananias@Act.9.10-	#06	G0367		
//Act.19.38#10=NKO	ἔχουσι (echousi)	have	G2192=V-PAI-3P	ἔχω=to have/be	NA28+SBL+WH+Treg+Byz; moved »3:NA27+Tyn+TR		Byz+Treg+WH+SBL+NA28; moved »3:TR: ἔχουσιν ; 	están teniendo	to have	#10	G2192		
//Php.3.12#07=NK(O)	τετελείωμαι, (teteleiōmai)	have been perfected,	G5048=V-RPI-1S	τελειόω=to perfect	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz	δεδικαίωμαι (ₓₓdedikaiōmai) have been perfected, - G1344=V-RPI-1S in: P46		he sido completado	to perfect	#07	G5048	G1344				
			$editions  = $line['EDITIONS'];
			$editions .= (preg_match("#^.+\s+in:\s+([^«»]+)$#us", $line['VAR']) ? ("+".preg_replace("#^.+\s+in:\s+([^«»]+)$#us", '$1', $line['VAR'])) : "");
			// Tyn+WH: Δαυεὶδ ; +TR: Δαβὶδ ; 
			// TR«9+Byz«9: τὴν ; 
			// Byz0
			// NA28+NA27+Tyn+WH+Treg+TR.24:+Byz
			$tempspell = preg_replace("#[«»]+[\d.]+#us", "+", $line['SPELL']);
			$editions .= (!preg_match("#^([^;:]+):.+$#us", $tempspell) ? "" : ("+".preg_replace("#^([^;:]+):.+$#us",  '$1', $tempspell)));
			$editions .= (!preg_match("#^[^;]+;([^;:]+):.+$#us", $tempspell) ? "" : ("+".preg_replace("#^[^;]+;([^;:]+):.+$#us",  '$1', $tempspell)));
			$editions .= (!preg_match("#^[^;]+;[^;]+;([^;:]+):.+$#us", $tempspell) ? "" : ("+".preg_replace("#^[^;]+;[^;]+;([^;:]+):.+$#us",  '$1', $tempspell)));
			$editions  = preg_replace("#\+Byz0#u", "+Byz", $editions);
			$editions  = preg_replace("#\.[\d.:;]+\+#u", "+", $editions);
			$editions  = preg_replace("#[«»]+[\d.:;]+#u", "+", $editions);
			$editions  = preg_replace("#\s+#u", "+", $editions);
			$editions  = preg_replace("#0([\d]+)#u", 'U$1', $editions); // replace 0 with U for unicals
			$editions  = trim(preg_replace("#[+]+#u", "+", $editions),"+");
			if (($editions_diff=array_diff(explode("+", $editions), array_keys($vartrans)))) {
				$database['MISS_MANU'] .= ($warn="$newmess\tmissing manuscript edition: ".implode(",",$editions_diff)." from editions=$editions\n");
				AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");	
			}
			// FIX EDITIONS
			$line['EDITIONS'] = preg_replace("#\+Byz0#u", "+Byz", $line['EDITIONS']);
			$line['EDITIONS'] = preg_replace("#\.[\d.:;]+\+#u", "+", $line['EDITIONS']);
			$line['EDITIONS'] = preg_replace("#[«»]+[\d.;:]+#u", "+", $line['EDITIONS']);
			$line['EDITIONS'] = preg_replace("#\s+#u", "+", $line['EDITIONS']);
			$line['EDITIONS'] = preg_replace("#0([\d]+)#u", 'U$1', $line['EDITIONS']); // replace 0 with U for unicals
			$line['EDITIONS'] = trim(preg_replace("#[+]+#u", "+", $line['EDITIONS']),"+");			

			// FIX EXTRA
			// Abraham»Abraham|Abraham@Gen.11.26
			$extra = $line['EXTRA'];
			$extra = preg_replace("#\d+_#u", "", $extra);
			$extra = preg_replace("#[_ ]+#u", " ", $extra);
			$extra = trim($extra," @:;,-$+");
			if (preg_match("#^([^»|@]+)[»|]+([^»|@]+)[»|]+([^»|@]+)(@.+)$#us", $extra, $extramatch)) {
				if      ($extramatch[1] == $extramatch[2] && $extramatch[1] == $extramatch[3]) {	$extra = $extramatch[3].$extramatch[4]; }
				else if ($extramatch[1] == $extramatch[2]) {										$extra = $extramatch[1].", ".$extramatch[3].$extramatch[4]; }
				else if ($extramatch[1] == $extramatch[3]) {										$extra = $extramatch[2].", ".$extramatch[3].$extramatch[4]; }
			}
			else if (preg_match("#^([^»|@]+)[»|]+([^»|@]+)(@.+)$#us", $extra, $extramatch)) {
				if      ($extramatch[1] == $extramatch[2]) {										$extra = $extramatch[2].$extramatch[3]; }
			}
			else if (preg_match("#^([^»|@]+)[»|]+([^»|@]+)[»|]+([^»|@]+)$#us", $extra, $extramatch)) {
				if      ($extramatch[1] == $extramatch[2] && $extramatch[1] == $extramatch[3]) {	$extra = $extramatch[3]; }
				else if ($extramatch[1] == $extramatch[2]) {										$extra = $extramatch[1].", ".$extramatch[3]; }
				else if ($extramatch[1] == $extramatch[3]) {										$extra = $extramatch[2].", ".$extramatch[3]; }
			}
			else if (preg_match("#^([^»|@]+)[»|]+([^»|@]+)$#us", $extra, $extramatch)) {
				if      ($extramatch[1] == $extramatch[2]) {										$extra = $extramatch[2]; }
			}
			$extra = preg_replace("#[»|]+#u", ", ", $extra);
			$extra = preg_replace("#@#u", " @ ", $extra);
			$extra = trim($extra," @:;,-$+");

			// VALIDATE STRONGS # IN VAR AND ALT
			if (!empty($line['VAR'])) { AION_NEWSTRONGS_STRONGS_PARSE($newmess, $line['VAR'], TRUE, $lex_array, $lex2_array); }
			if (!empty($line['ALT'])) { AION_NEWSTRONGS_STRONGS_PARSE($newmess, $line['ALT'], TRUE, $lex_array, $lex2_array); }

			// CLEAN UP ALTERNATE - Strip the _[A-Za-z]{1}
			if (NULL===($alternate = preg_replace("#_[A-Za-z]{1}#ui", "", $line['ALT']))) {
				AION_ECHO("ERROR! alternate preg_replace()!\n".print_r($line,TRUE));
			}

			// HTMLSPECIALCHARS
			$VAR = htmlspecialchars($line['VAR']);
			$spell = htmlspecialchars($line['SPELL']);
			$extra = htmlspecialchars($extra);
			
			// Hyperlink Expand!
			$VAR = AION_NEWSTRONGS_HYPERLINK($newmess, $VAR);
			$alternate = AION_NEWSTRONGS_HYPERLINK($newmess, $alternate);
			static $extra_count = 0;
			$extra = AION_NEWSTRONGS_EXTRAREF($newmess, $extra, $extra_count);

			// Morph expand!
			static $tag_morph_var = 0;
			global $FOLDER_STAGE, $CHECK_HTAG;
			if (!empty($VAR)) { if (!($VAR=preg_replace($GLOBALS['MORPH']['TAG_SEARCH'],$GLOBALS['MORPH']['TAG_REPLACE'],$VAR,-1,$counter))) { AION_ECHO("ERROR! MORPHY! ".print_r($line,TRUE)); } $tag_morph_var += $counter; }
			if ($VAR.$spell.$extra.$alternate) {
				$testhtml = "$VAR<br>$spell<br>$extra<br>$alternate<br><br>";
				$dom->loadHTML("<html><body>$testhtml</body></html>");
				if (!empty(libxml_get_errors())) {
					$testhtml = "<div class='body'>".preg_replace("#([[:punct:]]+) #u","\$1\n",$testhtml)."</div>\n";
					AION_ECHO($warn="WARN! $newmess strongs='$strongs' DOMHTML Error".print_r($line,TRUE)."\n".print_r(libxml_get_errors(),TRUE)."\n\n\n");
					$database['WARNINGS'] .= $warn;
					libxml_clear_errors();
					if (file_put_contents("$FOLDER_STAGE$CHECK_HTAG",$testhtml,FILE_APPEND) === FALSE ) { AION_ECHO("ERROR! $FOLDER_STAGE$CHECK_HTAG"); } // FILE_APPEND
				}
			}

			// OUTPUT LINE!
			// The Greek and Hebrew columns need to be same/similar because aionbible.org/index.php processes the Greek and Hebrew columns
			// INDX	BOOK	CHAP	VERS	STRONGS	JOIN	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	MORPH	EDITIONS	VAR	SPELL	EXTRA	CONJOIN	INSTANCE	OCCUR	ALT
			$database[$table] .=
				$reference."\t".
				$strongs."\t".
				$jointype."\t".
				trim($line['TYPE'])."\t".
				$WORDUP."\t".
				$line['TRANS']."\t".
				$WORDYEP."\t".
				trim($line['ENGLISH'])."\t".
				$line['GLOSS']."\t".
				$morph."\t".
				$line['EDITIONS']."\t".
				$VAR."\t".
				$spell."\t".
				$extra."\t".
				//trim($line['CONJOIN'])."\t".
				//trim($line['INSTANCE'])."\t".
				//"$occur\t".
				$alternate."\n";
			// W=next word, J=joined words
			$jointype = "J";
		}
		$last = $line;
	}
	// OCCURRENCE # of STRONGS? ERROR CHECK - LAST CHECK!
	foreach($strongs_counts as $key => $check) {
		if (1==$check) { AION_ECHO($warn="WARN! FIX_REF\tref='{$last['REF']}' Strongs sequence error, one found, multi indicated strongs={$key}!\n".print_r($last,TRUE)."\n".print_r($strongs_counts,TRUE)."\n\n\n"); }
	}
	// report the morph search and replace results
	AION_ECHO("WARN! AION_NEWSTRONGS_FIX_REF_GREEK tag morph var usage = {$tag_morph_var}");
	AION_ECHO("WARN! AION_NEWSTRONGS_FIX_REF_GREEK extra link count = {$extra_count}");
	libxml_clear_errors();
	libxml_use_internal_errors($domprevious);
}



// Recreate the sort order fo TAHOT and TAGNT to look for TAG reference sort errors
function AION_NEWSTRONGS_SORT_REF_CHECKER($step, $stepsort, $jeff, $jeffsort, $diff, $hebrew) {
	// Read STEP file write the sort order
	$newmess = "SORT_REF_CHECKER($step)";
	if (($data  = file_get_contents( $step )) === FALSE ) { AION_ECHO("ERROR! $newmess !file_get_contents($step)"); }
	$abooks = AION_BIBLES_LIST();
	$tbooks = AION_BIBLES_LIST_TYN();
	$tagsort = NULL;
	$indx_last = $chap_last = $vers_last = NULL;
	$numb = 1;
	if (($line = strtok($data, "\n")) !== FALSE) { do {
/*
Eng (Heb) Ref & Type	Hebrew	Transliteration	Translation	dStrongs	Grammar	Meaning Variants	Spelling Variants	Root dStrong+Instance	Alternative Strongs+Instance	Conjoin word	Expanded Strong tags					
Num.29.39#09=L	וּ/לְ/מִנְחֹ֣תֵי/כֶ֔ם	u./le./min.Cho.tei./Khem	and/ to/ grain offerings/ your	H9002/H9005/{H4503G}/H9026	HC/R/Ncfpc/Sp2mp			H4503G			H9002=ו=and/H9005=ל=to/{H4503G=מִנְחָה=: offering»offering:1_offering;_sacrifice}/H9026=Pp2m=your					
Num.29.39#10=L	וּ/לְ/נִסְכֵּי/כֶ֖ם	u./le./nis.kei./Khem	and/ to/ drink offerings/ your	H9002/H9005/{H5262}/H9026	HC/R/Ncmpc/Sp2mp			H5262			H9002=ו=and/H9005=ל=to/{H5262=נֶ֫סֶךְ=drink offering}/H9026=Pp2m=your					
Num.29.39#11=L	וּ/לְ/שַׁלְמֵי/כֶֽם\׃	u./le./shal.mei./Khem	and/ to/ peace offerings/ your	H9002/H9005/{H8002}/H9026\H9016	HC/R/Ncmpc/Sp2mp			H8002			H9002=ו=and/H9005=ל=to/{H8002=שֶׁ֫לֶם=peace offering}/H9026=Pp2m=your\H9016=׃=verseEnd					
Num.29.40(30.1)#01=L	וַ/יֹּ֥אמֶר	va/i.Yo.mer	and/ he said	H9001/{H0559}	Hc/Vqw3ms			H0559			H9001=ו=&/{H0559=אָמַר=to say}					
Num.29.40(30.1)#02=L	מֹשֶׁ֖ה	mo.Sheh	Moses	{H4872}	HNpm			H4872_A			{H4872=מֹשֶׁה=Moses»Moses@Exo.2.10-Rev}					
Num.29.40(30.1)#03=L	אֶל\־	'el-	to	{H0413}\H9014	HR			H0413			{H0413=אֶל=to(wards)}\H9014=־=link			
Lam.1.6#02=Q(K)		[ ]	[ ]			K= min- (מִן\־) "from" (H4480A\H9014=HR)	L= מִן\־ ¦ ;									
Lam.4.3#10=Q(K)		[ ]	[ ]			K= ki (כִּי) "for" (H3588A=HTc)	L= כַּיְ ¦ ;									
Ezk.48.16#12=Q(K)		[ ]	[ ]			K= cha.mesh (חֲמֵשׁ) "five" (H2568=HAcbsc)	L= חמש ¦ ;			

Mat.15.6{15.5}#09=KO	τὴν (tēn)	the	G3588=T-ASF	ὁ=the/this/who	BRT				la	the	Mat.15.6{15.5}#09»10:G3384	G3588_b			
Mat.15.6{15.5}#10=KO	μητέρα (mētera)	mother	G3384=N-ASF	μήτηρ=mother	BRT				madre	mother	Mat.15.6{15.5}#10	G3384			
Mat.15.6{15.5}#11=KO	αὐτοῦ, (autou)	of him	G0846=P-GSM	αὐτός=he/she/it/self	BRT				de él	of him	Mat.15.6{15.5}#11«10:G3384	G0846_b			
Mat.15.6#12=NKO	καὶ (kai)	{6} And	G2532=CONJ	καί=and	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				E	and	#12	G2532_B			
Mat.15.6#13=NKO	ἠκυρώσατε (ēkurōsate)	you made void	G0208=V-AAI-2P	ἀκυρόω=to nullify	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				invalidaron	to nullify	#13	G0208			
Mat.15.6#14=N(k)O	τὸν (ton)	the	G3588=T-ASM	ὁ=the/this/who	NA28+NA27+Tyn+SBL+WH+Treg	τὴν (ˍtēn) the - G3588=T-ASF in: Byz+TR			la	the	#14»15:G3056	G3588_C	
*/
		// get the line pieces
		$match = NULL;
		if (!(
			('H'==$hebrew &&
			(preg_match("#^([^.]{3})\.([\d]+)\.([\d]+)[^\t]*\t[^\t]*\t[^\t]*\t[^\t]*\t([^\t]+)#ui", $line, $match) ||
			 preg_match("#^([^.]{3})\.([\d]+)\.([\d]+)[^\t]*\t[^\t]*\t[^\t]*\t[^\t]*\t\t[^\t]*\tK=\s+[^\s]+\s+\([^)]+\)\s+\"[^\"]+\"\s+\(([^)]+)\)#ui", $line, $match))) ||

			('G'==$hebrew &&
			(preg_match("#^([^.]{3})\.([\d]+)\.([\d]+)\#[\d]+=[^\t]*\t[^\t]*\t[^\t]*\t([^\t]+)#ui", $line, $match) ||
			 preg_match("#^([^.]{3})\.([\d]+)\.([\d]+)[({]{1}[\d]+\.[\d]+[)}]{1}\#[\d]+=[^\t]*\t[^\t]*\t[^\t]*\t([^\t]+)#ui", $line, $match)) ||
			 preg_match("#^([^.]{3})\.([\d]+)\.([\d]+)\[([\d]+)\.([\d]+)\]\#[\d]+=[^\t]*\t[^\t]*\t[^\t]*\t([^\t]+)#ui", $line, $match))
			
		)) { continue; }
		// if greek and alternate references
		if (!empty($match[5]) && !empty($match[6])) {
			if ('G'!=$hebrew) { AION_ECHO("ERROR! $newmess strongs wrong wrong!\n".print_r($line,TRUE)); }
			// exception here
			// Php.1.16#11 (1.17)=M + T + O	κεῖμαι· (keimai)	I am appointed;	G2749=V-PNI-1S	κεῖμαι=to lay/be appointed	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				estoy yaciendo	to lay	#11	G2749				
			// Php.1.17#01 (1.16)=M + T + O	οἱ (hoi)	[16] the [ones]	G3588=T-NPM	ὁ=the/this/who	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				Los	[those] which	#01»10:G3633	G3588_A				
			if ("Php.1.16" != "{$match[1]}.{$match[2]}.{$match[3]}" && "Php.1.17" != "{$match[1]}.{$match[2]}.{$match[3]}") {
				$match[2] = $match[4];
				$match[3] = $match[5];
			}
			unset($match[4]); unset($match[5]);
			$match = array_values($match);
		}
		// parse the pieces
		$book = strtoupper($match[1]);
		if (empty($tbooks[$book])) { AION_ECHO("ERROR! $newmess missing book='$book'\n".print_r($line,TRUE)); }
		$book = $tbooks[$book];
		$indx = sprintf('%03d', (int)array_search($book,array_keys($abooks)));
		$chap = sprintf('%03d', (int)$match[2]);
		$vers = sprintf('%03d', (int)$match[3]);
		// custom fixes
		if ("H"==$hebrew && "PSA"==$book && "000"==$vers) { $vers = "001"; }
		// get strong!
		if (FALSE===preg_match_all("#[GH]{1}[\d]+#u", $match[4], $parsed, PREG_PATTERN_ORDER) || empty($parsed[0])) { AION_ECHO("ERROR! $newmess preg_match_all() !preg_match_all() \n\n$line\n\n".print_r($match,TRUE)); }
		foreach($parsed[0] as $strongs) {
			if (!($strongs=preg_replace("#([GH]{1})[0]*#u", '$1', $strongs))) { AION_ECHO("ERROR! $newmess preg_replace(GH000)"); }
			// word number not needed in Hebrew because we assume the TAHOT sort order within the verse and we DO NOT resort below
			// however for the Greek we do use the alternate verse references, but again our word number preserves the TAGNT word order within that change
			// in a nutshell in TAGNT if words are moving back a verse they are still already positioned properly, and same if moving forward a verse
			if ('H'==$hebrew) {	$numbX = ''; }
			else if ($indx != $indx_last || $chap != $chap_last || $vers != $vers_last) { $numbX = "\t001"; $numb = 1; }
			else { $numbX = "\t".sprintf('%03d', (int)$numb); }
			++$numb;
			$tagsort .= "{$indx}\t{$book}\t{$chap}\t{$vers}{$numbX}\t{$strongs}\n";
			$indx_last = $indx;
			$chap_last = $chap;
			$vers_last = $vers;
		}
	} while (($line = strtok( "\n" ))); }
	$length = strlen($tagsort);
	if (FALSE===file_put_contents($stepsort, $tagsort)) { AION_ECHO("ERROR! $newmess !file_put_contents($stepsort) length=$length\n".print_r(error_get_last(),TRUE)); }
	unset($tagsort);
	
	// Read TAG file write the sort order
	$newmess = "SORT_REF_CHECKER($jeff)";
	if (($data  = file_get_contents( $jeff )) === FALSE ) { AION_ECHO("ERROR! $newmess !file_get_contents($jeff)"); }
	$tagsort = NULL;
	$indx_last = $chap_last = $vers_last = NULL;
	$numb = 1;
	if (($line = strtok($data, "\n")) !== FALSE) { do {
/*
INDX	BOOK	CHAP	VERS	STRONGS	JOIN	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	MORPH	EDITIONS	VAR	SPELL	EXTRA	ALT
1	GEN	1	1	H9003	W	L	בְּ/רֵאשִׁ֖ית	be.	ב	in	in	HR						
1	GEN	1	1	H7225G	C$	L	בְּ/רֵאשִׁ֖ית	re.Shit	רֵאשִׁית	beginning	beginning	HNcfsa					first	
1	GEN	1	1	H1254A	W$	L	בָּרָ֣א	ba.Ra'	בָּרָא	he created	to create	HVqp3ms						
*/
		if (!preg_match("#^([\d]+)\t([^\t]+)\t([\d]+)\t([\d]+)\t([GH]{1}[\d]+)#u", $line, $match)) { continue; }
		$indx = sprintf('%03d', (int)$match[1]);
		$book = $match[2];
		$chap = sprintf('%03d', (int)$match[3]);
		$vers = sprintf('%03d', (int)$match[4]);
		$strongs = $match[5];
		// read above comments about word order number
		if ('H'==$hebrew) {	$numbX = ''; }
		else if ($indx != $indx_last || $chap != $chap_last || $vers != $vers_last) { $numbX = "\t001"; $numb = 1; }
		else { $numbX = "\t".sprintf('%03d', (int)$numb); }
		++$numb;
		$tagsort .= "{$indx}\t{$book}\t{$chap}\t{$vers}{$numbX}\t{$strongs}\n";
		$indx_last = $indx;
		$chap_last = $chap;
		$vers_last = $vers;
	} while (($line = strtok( "\n" ))); }
	$length = strlen($tagsort);
	if (FALSE===file_put_contents($jeffsort, $tagsort)) { AION_ECHO("ERROR! $newmess !file_put_contents($jeffsort) length=$length\n".print_r(error_get_last(),TRUE)); }
	unset($tagsort);	

	// Sort and diff the two files!
	// Hebrew assumed the TAHOT is already in the right order and does NOT use the alternate references
	// Greek we use the alternate references, but again the word should already be in the right order.
	// So the resort below is NOT needed, test that by only sorting one of the files!
	if ("H"!=$hebrew) {
		system("sort -o {$stepsort} {$stepsort}" );
		//system("sort -o {$jeffsort} {$jeffsort}" );
	}
	system("diff {$stepsort} {$jeffsort} > {$diff}" );
}
	


// Count all strongs references
function AION_NEWSTRONGS_COUNT_REF($references, $output) {
	// init
	$newmess  = "COUNT_REF($output) ";
	$yeah_array = $book_array = $chap_array = $vers_array = array();
	$indx_last = $chap_last = $vers_last = NULL;
	$references .= "0\t0\t0\t0\tH99999\t"; // add empty line to flush the last line
	$line = strtok($references, "\n");  // skip first line
	$line = strtok( "\n" ); // get second line
	// distinct strongs numbers
	while ($line !== false) {
		// TAG for Hebrew and Greek reference  "$indx\t$book\t$chap\t$vers\t$strongs ...
		if (!preg_match("#^(\d+)\t([A-Z0-9]+)\t(\d+)\t(\d+)\t([GH]{1})([\d]{1,5})([A-Za-z]{0,1})\t#u", $line, $match)) {	AION_ECHO("ERROR! $newmess corrupt hebrew/greek ref\n".print_r($line,TRUE)); }
		$indx = $match[1];
		$chap = $match[3];
		$vers = $match[4];
		// not the last line
		if ("0"!=$indx) {
			$snum = $match[6];
			$sext = $match[7];
			// mark the strong number, even without the extension
			$book_array[$snum] = $chap_array[$snum] = TRUE;
			$vers_array[$snum] = (empty($vers_array[$snum]) ? 1 : $vers_array[$snum]+1);
			// also mark the extension
			if (!empty($sext)) {
				$book_array[$snum.$sext] = $chap_array[$snum.$sext] = TRUE;
				$vers_array[$snum.$sext] = (empty($vers_array[$snum.$sext]) ? 1 : $vers_array[$snum.$sext]+1);
			}
		}
		// counts
		if ($indx_last !== NULL) {
			// increment the yeah array(book,chapter,verse,word-count);  
			if ($indx != $indx_last) {
				foreach($book_array as $s => $x) {
					if (!isset($yeah_array[$s])) { $yeah_array[$s] = array(0,0,0,0); }
					++$yeah_array[$s][0]; // increment strongs # used in book
				}
				unset($book_array);	$book_array = array();
			}
			if ($indx != $indx_last || $chap != $chap_last) {
				foreach($chap_array as $s => $x) {
					if (!isset($yeah_array[$s])) { $yeah_array[$s] = array(0,0,0,0); }
					++$yeah_array[$s][1]; // increment strongs # used in chapter
				}
				unset($chap_array);	$chap_array = array();
			}
			if ($indx != $indx_last || $chap != $chap_last || $vers != $vers_last) {
				foreach($vers_array as $s => $x) {
					if (!isset($yeah_array[$s])) { $yeah_array[$s] = array(0,0,0,0); }
					++$yeah_array[$s][2]; // increment strongs # used in verse
					$yeah_array[$s][3] += $x;  // increment strongs # word count
				}
				unset($vers_array);	$vers_array = array();
			}
		}
		// wrap up and next
		$indx_last = $indx;
		$chap_last = $chap;
		$vers_last = $vers;
		$line = strtok( "\n" );		
	}
	// sort
	ksort($yeah_array, SORT_NATURAL);
	// write the json array
	global $strongs_json_flag;
	if (file_put_contents($output,json_encode($yeah_array, $strongs_json_flag)) === FALSE ) { AION_ECHO("ERROR! $newmess file_put_contents $output" ); }
	return;
}


// Validate all strongs references
function AION_NEWSTRONGS_VALIDATE_REF($test, &$datareturn, $references) {
	// init
	$newmess  = "VALIDATE_REF() ";
	// get the standard
	$database = array();
	AION_FILE_DATA_GET( './aion_database/BOOKSSTANDARD.noia', 'T_BOOKSSTANDARD', $database, array('BOOK','CHAPTER','VERSE'), FALSE );
	$standard = array();
	foreach($database['T_BOOKSSTANDARD'] as $key => $verse) {
		if ($test=="old" && (int)$verse['INDEX']>39) { continue; }
		if ($test=="new" && (int)$verse['INDEX']<=39) { continue; }
		$index = $verse['BOOK']."-".(int)$verse['CHAPTER']."-".(int)$verse['VERSE'];
		$standard[$index] = TRUE;
	}
	AION_unset($database); $database=NULL; unset($database);
	// compare references to standard
	$last_book = $last_chap = $last_vers = $last_index = NULL;
	$line = strtok($references, "\n"); // skip first line
	$line = strtok( "\n" ); // read second line
	while ($line !== false) {
		if (!preg_match("#^(\d+)\t([A-Z0-9]+)\t(\d+)\t(\d+)#u", $line, $match)) {	AION_ECHO("ERROR! $newmess corrupt ref\n".print_r($line,TRUE)); }
		$book = $match[2];
		$chap = (int)$match[3];
		$vers = (int)$match[4];
		$index = $book."-".$chap."-".$vers;
		// non-standard found
		if (empty($standard[$index])) {
			AION_ECHO($warn="WARN! $newmess REFERENCE NON-STANDARD = $line\n");
			$datareturn['REFERENCES'] .= $warn;
		}
		// reference skipped
		if (((!$last_book || $book!=$last_book) && ($chap!=1 || $vers!=1)) ||
			($book==$last_book && $chap!=$last_chap && ($chap!=$last_chap+1 || $vers!=1)) ||
			($book==$last_book && $chap==$last_chap && $vers!=$last_vers && $vers!=$last_vers+1)) {
			AION_ECHO($warn="WARN! $newmess REFERENCE SKIPPED > $line\n");
			$datareturn['REFERENCES'] .= $warn;
		}
		// blank out the standard array as proof that we have been there!
		// blanked out after passed the reference
		if ($last_index && $index != $last_index) {
			unset($standard[$last_index]);
		}
		// wrap up and next
		$last_book = $book;
		$last_chap = $chap;
		$last_vers = $vers;
		$last_index = $index;
		$line = strtok( "\n" );		
	}
	unset($standard[$last_index]);
	// reference omitted?
	if (!empty($standard)) {
		AION_ECHO($warn="WARN! $newmess REFERENCE OMITTED\n".print_r($standard,TRUE)."\n\n\n");
		$datareturn['REFERENCES'] .= $warn;
	}
	else {
		AION_ECHO("EXCELLENT! ALL REFERENCES ACCOUNTED\n");
	}
	return;
}


// Validate all hebrew words and transliterations
//AION_NEWSTRONGS_VALIDATE_HEBREW($database['TOTHT'], $FOLDER_STAGE."CHECK_VALIDATE_HEBREW_TRANSLITERATION.txt",			1, "TAHOT Validation: Same ExtendedStrongs H=[Hebrew] with multiple T=[Transliterations]");
//AION_NEWSTRONGS_VALIDATE_HEBREW($database['TOTHT'], $FOLDER_STAGE."CHECK_VALIDATE_HEBREW_GRAMMAR.txt",					2, "TAHOT Validation: Same ExtendedStrongs H=[Hebrew] with multiple M=[Morphhologies]");
//AION_NEWSTRONGS_VALIDATE_HEBREW($database['TOTHT'], $FOLDER_STAGE."CHECK_VALIDATE_HEBREW_STRONGS.txt",					3, "TAHOT Validation: Same ExtendedStrongs H=[Hebrew] with muptiple S=[Strongs]");
//AION_NEWSTRONGS_VALIDATE_HEBREW($database['TOTHT'], $FOLDER_STAGE."CHECK_VALIDATE_HEBREW_STRONGS_TRANSLATION_GAMMAR.txt",	4, "TAHOT Validation: Same ExtendedStrongs H=[Strongs+Translation] with multiple M=[Morphhologies]");
function AION_NEWSTRONGS_VALIDATE_HEBREW($tahot, $output, $flag, $header) {
	// init
	$newmess  = "VALIDATE_HEBREW() ";
	if ($flag < 1 || $flag > 4) { AION_ECHO("ERROR! $newmess bad flag($flag)"); }
	if (file_put_contents($output, "$header\n\n")===FALSE) { AION_ECHO("ERROR! $newmess file_put_contents($output)"); }
	// loop through TAHOT
	$studythis = array();
	$line = strtok($tahot, "\n"); // skip first line
	$line = strtok( "\n" ); // read second line
	while ($line !== false) {
		$pieces = explode("\t", $line);
		if (($tmp=count($pieces))!=18) { AION_ECHO("ERROR! $newmess piece count 18 != $tmp\n".print_r($line,TRUE)); }
		//"INDX	BOOK	CHAP	VERS	STRONGS	JOIN	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	MORPH	EDITIONS	VAR	SPELL	EXTRA	ALT\n";
		$mainkey = ($flag==4 ? $pieces[4]." | ".$pieces[11] : $pieces[9]);
						$studythis[$mainkey]['C']				= (!isset($studythis[$mainkey]['C'])				? 1 : $studythis[$mainkey]['C'] + 1);
		if ($flag==1) {	$studythis[$mainkey]['T'][$pieces[8]]	= (!isset($studythis[$mainkey]['T'][$pieces[8]])	? 1 : $studythis[$mainkey]['T'][$pieces[8]] + 1); }
		if ($flag==2) {	$studythis[$mainkey]['M'][$pieces[12]]	= (!isset($studythis[$mainkey]['M'][$pieces[12]])	? 1 : $studythis[$mainkey]['M'][$pieces[12]] + 1); }
		if ($flag==3) {	if (!preg_match("#H[\d]{1,5}#u", $pieces[4], $strongs)) { AION_ECHO("ERROR! $newmess preg_match strongs failed!\n".print_r($line,TRUE)); }
						$strongs = $strongs[0];
						$studythis[$mainkey]['S'][$strongs]		= (!isset($studythis[$mainkey]['S'][$strongs])		? 1 : $studythis[$mainkey]['S'][$strongs] + 1);
		}
		if ($flag==4) {	$studythis[$mainkey]['M'][$pieces[12]]	= (!isset($studythis[$mainkey]['M'][$pieces[12]])	? 1 : $studythis[$mainkey]['M'][$pieces[12]] + 1); }
		$line = strtok( "\n" );		
	}
	// loop through result
	foreach($studythis as $key => $line) {
		if (($flag==1 && count($line['T'])<2) ||
			($flag==2 && count($line['M'])<2) ||
			($flag==3 && count($line['S'])<2) ||
			($flag==4 && count($line['M'])<2)) { continue; }
		if      ($flag==1) { $report = "H=[$key] T=[".implode("|",array_keys($line['T']))."]\n"; }
		else if ($flag==2) { $report = "H=[$key] M=[".implode("|",array_keys($line['M']))."]\n"; }
		else if ($flag==3) { $report = "H=[$key] S=[".implode("|",array_keys($line['S']))."]\n"; }
		else if ($flag==4) { $report = "H=[$key] M=[".implode("|",array_keys($line['M']))."]\n"; }
		if (file_put_contents($output, $report, FILE_APPEND)===FALSE) { AION_ECHO("ERROR! $newmess file_put_contents($output)"); }
	}
	AION_unset($studythis);
	gc_collect_cycles();
	AION_ECHO("EXCELLENT! TAHOT HEBREW WORDS VALIDATED: $output\n");
	return;
}




// Validate all Greek words and transliterations
//AION_NEWSTRONGS_VALIDATE_GREEK($database['GRERE2'], $FOLDER_STAGE."CHECK_VALIDATE_GREEK_MORPH.txt",	1, "TAGNT Validation: Same Greek G=[Greek] with multiple M=[dStrong=Grammar]");
//AION_NEWSTRONGS_VALIDATE_GREEK($database['GRERE2'], $FOLDER_STAGE."CHECK_VALIDATE_GREEK_GLOSS.txt",	2, "TAGNT Validation: Same Greek G=[Greek] with multiple G=[Dictionary=Gloss]");
function AION_NEWSTRONGS_VALIDATE_GREEK($tagnt, $output, $flag, $header) {
	// init
	$newmess  = "VALIDATE_GREEK() ";
	if ($flag < 1 || $flag > 2) { AION_ECHO("ERROR! $newmess bad flag($flag)"); }
	if (file_put_contents($output, "$header\n\n")===FALSE) { AION_ECHO("ERROR! $newmess file_put_contents($output)"); }
	// loop through TAGNT
	$studythis = array();
	$line = strtok($tagnt, "\n"); // skip first line
	$line = strtok( "\n" ); // read second line
	while ($line !== false) {
		$pieces = explode("\t", $line);
		if (count($pieces)!=18) { AION_ECHO("ERROR! $newmess piece count != 18\n".print_r($line,TRUE)); }
		//"INDX	BOOK	CHAP	VERS	STRONGS	JOIN	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	MORPH	EDITIONS	VAR	SPELL	EXTRA	ALT\n";
		$mainkey = preg_replace("#[[:punct:]\s]+#u","",$pieces[7]);
						$studythis[$mainkey]['C']								= (!isset($studythis[$mainkey]['C'])								? 1 : $studythis[$mainkey]['C'] + 1);
		if ($flag==1) {	$studythis[$mainkey]['M']["{$pieces[4]}={$pieces[12]}"]	= (!isset($studythis[$mainkey]['M']["{$pieces[4]}={$pieces[12]}"])	? 1 : $studythis[$mainkey]['M']["{$pieces[4]}={$pieces[12]}"] + 1); }
		if ($flag==2) {	$studythis[$mainkey]['G']["{$pieces[9]}={$pieces[11]}"]	= (!isset($studythis[$mainkey]['G']["{$pieces[9]}={$pieces[11]}"])	? 1 : $studythis[$mainkey]['G']["{$pieces[9]}={$pieces[11]}"] + 1); }
		$line = strtok( "\n" );		
	}
	// loop through result
	foreach($studythis as $key => $line) {
		if (($flag==1 && count($line['M'])<2) ||
			($flag==2 && count($line['G'])<2)) { continue; }
		if      ($flag==1) { $report = "G=[$key] M=[".implode("|",array_keys($line['M']))."]\n"; }
		else if ($flag==2) { $report = "G=[$key] G=[".implode("|",array_keys($line['G']))."]\n"; }
		if (file_put_contents($output, $report, FILE_APPEND)===FALSE) { AION_ECHO("ERROR! $newmess file_put_contents($output)"); }
	}
	AION_unset($studythis);
	gc_collect_cycles();
	AION_ECHO("EXCELLENT! TAGNT GREEK WORDS VALIDATED: $output\n");
	return;
}




// strongs references chapter usage
function AION_NEWSTRONGS_USAGE_REF($test, $references, $file, $file_index) {
	// init
	$newmess  = "USAGE_REF() ";
	$chapters = AION_BIBLES_CHAPTER_INDEX();
	$usage_length = ($test=="old" ? 929 : 260);
	$usage = array();
	// usage
	$line = strtok($references, "\n"); // skip first line
	$line = strtok( "\n" ); // get second line
	while ($line !== false) {
		// parse the line
		if (!preg_match("#^(\d+)\t([A-Z0-9]+)\t(\d+)\t(\d+)\t([GH]{1})([0-9]{1,5})([A-Za-z]{0,1})#u", $line, $match)) {	AION_ECHO("ERROR! $newmess corrupt ref\n".print_r($line,TRUE)); }
		$book = $match[2];
		$chap = (int)$match[3];
		$strg = $match[6];
		$extn = $match[6].$match[7];
		// create usage array
		if (!isset($usage[$strg])) {					$usage[$strg] = array( 'STRONGS'=>$strg, 'USAGE'=>str_pad("",$usage_length)); }
		if ($extn != $strg && !isset($usage[$extn])) {	$usage[$extn] = array( 'STRONGS'=>$extn, 'USAGE'=>str_pad("",$usage_length)); }
		// record usage
		if (!isset($chapters[$book])) {															AION_ECHO("ERROR! $newmess book chapter index not found\n".print_r($line,TRUE)); }
		$indx = $chapters[$book] + $chap - 1; // calculate the byte index to the chapter number to mark the string, 0 = gen 1
		if (!isset($usage[$strg]['USAGE'][$indx])) {											AION_ECHO("ERROR! $newmess book chapter index usage not set\n".print_r($line,TRUE)); }
		// usage for a bald strongs number INCLUDES the usage of the strongs extended!!!
		$usage[$strg]['USAGE'][$indx] = 'X'; 
		if ($extn != $strg) {
			if (!isset($usage[$extn]['USAGE'][$indx])) {										AION_ECHO("ERROR! $newmess book chapter index usage not set\n".print_r($line,TRUE)); }
			$usage[$extn]['USAGE'][$indx] = 'X';
		}
		// next
		$line = strtok( "\n" );		
	}
	// save file
	ksort($usage, SORT_NATURAL);
	AION_FILE_DATA_PUT($file, $usage);
	// loop and build index
	if ( ($contents = file_get_contents( $file )) === FALSE ) {									AION_ECHO("ERROR! $newmess !file_get_contents()"); }
	$bytes = 0;
	$index = array();
	$line = strtok($contents, "\n");
	while ($line !== false) {
		$strongs = trim(substr($line, 0, strpos($line, "\t")));
		if ($line[0]!="#" && $strongs!="STRONGS") {		
			if (!preg_match("#[\d]{1,5}[A-Za-z]{0,1}#u", $strongs)) {								AION_ECHO("ERROR! $newmess !preg_match(strongs=$strongs)"); }
			$index[$strongs] = $bytes;
		}
		$bytes += (strlen($line) + 1);
		$line = strtok( "\n" );
	}
	// write the json array
	global $strongs_json_flag;
	if (file_put_contents($file_index,json_encode($index, $strongs_json_flag)) === FALSE ) {	AION_ECHO("ERROR! $newmess file_put_contents $output" ); }
	return;
}


// strongs references chapter usage checker
function AION_NEWSTRONGS_USAGE_REF_CHECKER($index_file, $usage_file) {
	$newmess = "INDEX_USAGE_CHECKER $index_file";
	// read data
	$index = json_decode(file_get_contents($index_file), true);
	if (empty($index)) {														AION_ECHO("ERROR! $newmess !json_decode($index_file)"); }
	if (!($fd=fopen($usage_file, 'r'))) {										AION_ECHO("ERROR! $newmess !fopen($usage_file)"); }
	// loop through counts
	foreach($index as $strongs => $position) {
		if (fseek($fd, $position) ||
			!($line=fgets($fd)) ||
			!preg_match("#^$strongs\t#u",$line)) {
			AION_ECHO("WARN! $newmess NOTFOUND! strongs=$strongs positions=$positions line=$line");
		}
	}
	fclose($fd);
	return;
}


// Count all strongs references in raw file and also the count file and compare!
function AION_NEWSTRONGS_COUNT_REF_CHECKER($countsF, $source1, $begin1, $end1, $source2, $begin2, $end2, $source3, $begin3, $end3, $source4, $begin4, $end4, $file, $save, $letter) {
	$newmess = "COUNT_REF_CHECKER $countsF";
	// read data
	$counts = json_decode(file_get_contents($countsF), true);
	if (empty($counts)) {																						AION_ECHO("ERROR! $newmess !json_decode($countsF)"); }
	if (($source  = file_get_contents( $source1 )) === FALSE ) {												AION_ECHO("ERROR! $newmess !file_get_contents($source1)"); }
	if ($begin1 && (!($source=preg_replace("/^.*?$begin1/us",$begin1,$source,-1,$count)) || $count!=1)) {		AION_ECHO("ERROR! $newmess $source1 no beginning='$begin1' $count"); }
	if ($end1   && (!($source=preg_replace("/$end1.*$/us","",$source,-1,$count)) || $count!=1)) {				AION_ECHO("ERROR! $newmess $source1 no ending='$end1' $count"); }
	if (($sourceT = file_get_contents( $source2 )) === FALSE ) {												AION_ECHO("ERROR! $newmess !file_get_contents($source2)"); }
	if ($begin2 && (!($sourceT=preg_replace("/^.*?$begin2/us",$begin2,$sourceT,-1,$count)) || $count!=1)) {		AION_ECHO("ERROR! $newmess $source2 no beginning='$begin2' $count"); }
	if ($end2   && (!($sourceT=preg_replace("/$end2.*$/us","",$sourceT,-1,$count)) || $count!=1)) {				AION_ECHO("ERROR! $newmess $source2 no ending='$end2' $count"); }
	$source = "\n" . $source . $sourceT;
	if ($source3) {
		if (($sourceT = file_get_contents( $source3 )) === FALSE ) {											AION_ECHO("ERROR! $newmess !file_get_contents($source3)"); }
		if ($begin3 && (!($sourceT=preg_replace("/^.*?$begin3/us",$begin3,$sourceT,-1,$count)) || $count!=1)) {	AION_ECHO("ERROR! $newmess $source3 no beginning='$begin3' $count"); }
		if ($end3   && (!($sourceT=preg_replace("/$end3.*$/us","",$sourceT,-1,$count)) || $count!=1)) {			AION_ECHO("ERROR! $newmess $source3 no ending='$end3' $count"); }
		$source .= $sourceT;
	}
	if ($source4) {
		if (($sourceT = file_get_contents( $source4 )) === FALSE ) {											AION_ECHO("ERROR! $newmess !file_get_contents($source4)"); }
		if ($begin4 && (!($sourceT=preg_replace("/^.*?$begin4/us",$begin4,$sourceT,-1,$count)) || $count!=1)) {	AION_ECHO("ERROR! $newmess $source4 no beginning='$begin4' $count"); }
		if ($end4   && (!($sourceT=preg_replace("/$end4.*$/us","",$sourceT,-1,$count)) || $count!=1)) {			AION_ECHO("ERROR! $newmess $source4 no ending='$end4' $count"); }
		$source .= $sourceT;
	}
	unset($sourceT);
	// remove comments first preg_replace('/^[ \t]*[\r\n]+/m', '', $str);
	if ($save && $file && !file_put_contents($file, $source)) {													AION_ECHO("ERROR! $newmess !file_put_contents($file)"); }
	if ((!($source=preg_replace("/^#.*$/um", "", $source))) ||
		(!($source=preg_replace("/^[^.]{4}.*[\r\n]+/um", "", $source))) ||
		(!($source=preg_replace("/^[ \t]*[\r\n]+/um", "", $source)))) {
		AION_ECHO("ERROR! $newmess problem removing comments");
	}
	// save the file if requested / only needed for debugging the count checker
	if ($save && $file && !file_put_contents($file, $source)) {													AION_ECHO("ERROR! $newmess !file_put_contents($file)"); }
	// loop through counts
	foreach($counts as $strongs => $numbers) {
		if (FALSE===preg_match("#^([0-9]{1,5})([A-Za-z]{0,1})$#u", $strongs, $match)) { AION_ECHO("ERROR! $newmess !preg_match()"); }
		$strongs = $letter.sprintf('%04d',$match[1]).$match[2];
		$special = $letter.sprintf('%04d',$match[1]);
		$parsed = $parsed2 = $parsed3 = NULL;
		if ($letter=='H') {
			if (empty($match[2])) {
				if (FALSE===preg_match_all("#($strongs)[a-zA-Z]{0,1}\s*=[^\t/\\\\]+=#u", $source, $parsed, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess !preg_match_all()"); }
				if (FALSE===preg_match_all("#\t\tK=[^\n\t]+($strongs)[a-zA-Z]{0,1}[[:punct:]]#u", $source, $parsed2, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess !preg_match_all()"); }
			}
			else {
				if (FALSE===preg_match_all("#($strongs)\s*=[^\t/\\\\]+=#u", $source, $parsed, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess !preg_match_all()"); }
				if (FALSE===preg_match_all("#\t\tK=[^\n\t]+($strongs)[[:punct:]]#u", $source, $parsed2, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess !preg_match_all()");	}
				if (FALSE===preg_match_all("#($special)\s*=[^\t/\\\\]+=#u", $source, $parsed3, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess !preg_match_all()"); }
			}
			$found   = (empty($parsed[1] )  || !is_array($parsed[1] ) ? 0 : count($parsed[1] ));
			$found  += (empty($parsed2[1])  || !is_array($parsed2[1]) ? 0 : count($parsed2[1]));
			$found3  = (empty($parsed3[1])  || !is_array($parsed3[1]) ? 0 : count($parsed3[1]));
		}
		// redo Greek to use orig file! with this regex "/\n[^#\t]{1}[^\t]+\t[^\t]+\t[^\t]+\tG0976=/ui"
		else {
			if (empty($match[2])) {
				if (FALSE===preg_match_all("/\n[^#\t]{1}[^\n\t]+\t[^\n\t]+\t[^\n\t]+\t[^\n\t]*($strongs)[A-Z]{0,1}=/u", $source, $parsed, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess !preg_match_all()"); }
				if (FALSE===preg_match_all("/^[^#\t]{1}[^\n\t]+\t[^\n\t]+\t[^\n\t]+\t[^\n\t]*($strongs)[A-Z]{0,1}=/u", $source, $parsed2, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess !preg_match_all()"); }
			}
			else {
				if (FALSE===preg_match_all("/\n[^#\t]{1}[^\n\t]+\t[^\n\t]+\t[^\n\t]+\t[^\n\t]*($strongs)=/u", $source, $parsed, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess !preg_match_all()"); }
				if (FALSE===preg_match_all("/^[^#\t]{1}[^\n\t]+\t[^\n\t]+\t[^\n\t]+\t[^\n\t]*($strongs)=/u", $source, $parsed2, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess !preg_match_all()"); }
				if (FALSE===preg_match_all("/\n[^#\t]{1}[^\n\t]+\t[^\n\t]+\t[^\n\t]+\t[^\n\t]*($special)=/u", $source, $parsed3, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess !preg_match_all()"); }
			}
			$found  = (empty($parsed[1])  || !is_array($parsed[1] ) ? 0 : count($parsed[1] ));
			$found += (empty($parsed2[1]) || !is_array($parsed2[1]) ? 0 : count($parsed2[1]));
			$found3 = (empty($parsed3[1])  || !is_array($parsed3[1]) ? 0 : count($parsed3[1]));
		}
		if ($numbers[3] != $found) {
			AION_ECHO("WARN! $newmess count mismatch for $strongs: $numbers[3] != $found, but $special found3 = $found3 (variant.[AG] -OR- Q(K) issue?)");
		}
	}
	return;
}



// create tagged index file
function AION_NEWSTRONGS_GET_INDEX_TAG($input, $output) {
	// init
	$newmess = "INDEX_TAG\t$input\t$output";
	if ( ($contents = file_get_contents( $input )) === FALSE ) {		AION_ECHO("ERROR! $newmess !file_get_contents()"); }
	if ( mb_detect_encoding($contents, "UTF-8", TRUE) === FALSE ) {		AION_ECHO("ERROR! $newmess !mb_detect_encoding()"); }
	mb_regex_encoding("UTF-8");
	mb_internal_encoding("UTF-8");	
	// loop through lines
	$bytes = 0;
	$last_vers = 0;
	$index = array();
	$line = strtok($contents, "\n");
	while ($line !== false) {
		// parse the line
		if (ctype_digit($line[0])) {	
			if (!preg_match("#^(\d+)\t([A-Z0-9]+)\t(\d+)\t(\d+)\t#u", $line, $match)) {	AION_ECHO("ERROR! $newmess corrupt reference tag\n".print_r($line,TRUE)); }
			$indx = $match[1];
			$book = $match[2];
			$chap = $match[3];
			$vers = $match[4];
			if ($vers != $last_vers) {
				//$key = "$book$chap$vers";
				$key = (int)$indx.".".(int)$chap.":".(int)$vers;
				if (isset($index[$key])) { AION_ECHO("ERROR! $newmess reference tag index already set???\n".print_r($line,TRUE)); }
				$index[$key] = $bytes;
			}
			$last_vers = $vers;
		}
		$bytes += (strlen($line) + 1);
		$line = strtok( "\n" );
	}
	// write the json array
	global $strongs_json_flag;
	if (file_put_contents($output,json_encode($index, $strongs_json_flag)) === FALSE ) { AION_ECHO("ERROR! $newmess file_put_contents $output" ); }
	return;
}


// tagged index checker
function AION_NEWSTRONGS_TAG_INDEX_CHECKER($index_file, $tag_file, $verses) {
	$newmess = "INDEX_TAG_CHECKER $index_file";
	// read data
	$index = json_decode(file_get_contents($index_file), true);
	if (empty($index)) {						AION_ECHO("ERROR! $newmess !json_decode($index_file)"); }
	if (!($fd=fopen($tag_file, 'r'))) {			AION_ECHO("ERROR! $newmess !fopen($usage_file)"); }
	// loop through counts
	foreach($verses as $verse) {
		AION_ECHO("$newmess CHECKING: $verse");
		if (empty($index[$verse])) {			AION_ECHO("WARN! $newmess index not found! $verse"); continue; }
		if (fseek($fd, $index[$verse])) {		AION_ECHO("ERROR! $newmess fseek error to byte =".$index[$verse]); }
		$howmany = 0;
		while(($line=fgets($fd))) {
			if (!preg_match("#^(\d+)\t([A-Z0-9]+)\t(\d+)\t(\d+)\t#u", $line, $match)) {	AION_ECHO("ERROR! $newmess corrupt reference tag\n".print_r($line,TRUE)); }
			$indx = $match[1];
			$book = $match[2];
			$chap = $match[3];
			$vers = $match[4];
			$key = (int)$indx.".".(int)$chap.":".(int)$vers;
			if ($key != $verse) {
				if (!$howmany) { AION_ECHO("ERROR! $newmess reference tag index FAILED!\n".print_r($line,TRUE)); }
				break;
			}
			$howmany++;
			echo "$newmess howmany=$howmany $line";
		}
	}
	fclose($fd);
	return;
}



// Read a CSV file!
function AION_NEWSTRONGS_CSV($file, $delim, $table, $keys, $key, &$result, $checkfile) {
	$newmess = "CSV($file)";
	if ( !is_array( $result ) ) {												AION_ECHO("ERROR! $newmess result !is_array()"); }
	if ( !is_array( $keys ) ) {													AION_ECHO("ERROR! $newmess keys !is_array()"); }
	if ( $key && !in_array( $key, $keys ) ) {									AION_ECHO("ERROR! $newmess key='$key' not in keys !in_array()"); }
	if ( isset($result[$table]) ) {												AION_ECHO("ERROR! $newmess table='$table' already loaded"); }
	if ( !is_file( $file ) ) {													AION_ECHO("ERROR! $newmess !is_file()"); }
    if (($handle = fopen($file, 'r')) === FALSE) {								AION_ECHO("ERROR! $newmess !fopen()"); }
	$sample = fgetcsv($handle, 3000, $delim); // skip first line
	if ( mb_detect_encoding(implode(' ',$sample), "UTF-8", true) === FALSE ) {	AION_ECHO("ERROR! $newmess !mb_detect_encoding()"); }
	if (($kcount=count($sample)) != count($keys)) {								AION_ECHO("ERROR! $newmess key count problem ".count($sample)." ".count($keys)); }
	mb_regex_encoding("UTF-8");
	mb_internal_encoding("UTF-8");
	if (!defined($table)) { define($table, $table); }
	$result[$table] = array();
	$count=0;
	while (($row = fgetcsv($handle, 3000, $delim)) !== FALSE) {
		++$count;
		if (count($row) != $kcount) {											AION_ECHO("ERROR! $newmess row key count problem ".print_r($row,TRUE)); }
		// check for empty fields
		foreach($row as $element) {
			if (empty($element)) {
				$temp = implode(",",$row);
				AION_ECHO("WARN! Empty fields, $file, $temp");
				if (file_put_contents($checkfile, "$temp\n", FILE_APPEND)===FALSE) {	AION_ECHO("ERROR! file_put_contents($checkfile)"); }
				break;
			}
		}
		$newd = array_combine($keys, $row);
		if ($key && !empty($result[$table][$newd[$key]])) {						AION_ECHO("ERROR! $newmess array key overlap! $key ".$newd[$key]); }
		else if ($key) {	$result[$table][$newd[$key]] = $newd; }
		else {				$result[$table][] = $newd; }
		AION_unset($newd); $newd=NULL; unset($newd);
		AION_unset($row); $row=NULL; unset($row);
	}
    fclose($handle);
	AION_ECHO("SUCCESS! $newmess lines=$count array=".count($result[$table]));
}


// Read the morphhology code file!
function AION_NEWSTRONGS_COD($file, $table, &$result, $defaultmorph=FALSE) {
	$newmess = "COD($file)";
	if ( !is_array( $result ) ) {									AION_ECHO("ERROR! $newmess result !is_array()"); }
	if ( isset($result[$table]) ) {									AION_ECHO("ERROR! $newmess table='$table' already loaded"); }
	if ( !is_file( $file ) ) {										AION_ECHO("ERROR! $newmess !is_file()"); }
    if (($handle = fopen($file, 'r')) === FALSE) {					AION_ECHO("ERROR! $newmess !fopen()"); }
	if (($line = fgets($handle))===FALSE) {							AION_ECHO("ERROR! $newmess !fgets()"); }
	$line = trim($line," \t\n\r\0\x0B\"");
	if ( mb_detect_encoding($line, "UTF-8", true) === FALSE ) {		AION_ECHO("ERROR! $newmess !mb_detect_encoding()"); }
	mb_regex_encoding("UTF-8");
	mb_internal_encoding("UTF-8");
	if (!defined($table)) { define($table, $table); }
	$result[$table] = array();
	$blockcount = 0;
	$morph = '';
	$count=0;
	while(($line = fgets($handle))) {
		++$count;
		$line = trim($line," \t\n\r\0\x0B\"");
		if ($blockcount==0 && $line!='$') {
			continue;
		}
		else if ($blockcount==0 && $line=='$') {
			$blockcount=1;
			continue;
		}
		else if ($blockcount==1) {
			$morph = strtok($line, " \t");
			if (!empty($result[$table][$morph])) {					AION_ECHO("ERROR! $newmess array key overlap  morph='$morph'"); }
			static $morphhologies = NULL;
			if (!$morphhologies) {
				$morphhologies = array(
"A" => "Adjective",
"ADV" => "Adverb",
"ARAM" => "Aramaic transliterated word",
"C" => "Reciprocal pronoun",
"COND" => "Conditional particle or conjunction",
"CONJ" => "Conjunction or conjunctive particle",
"D" => "Demonstrative pronoun",
"F" => "Reflexive pronoun",
"HEB" => "Hebrew transliterated word",
"I" => "Interrogative pronoun",
"INJ" => "Interjection",
"K" => "Correlative pronoun",
"N" => "Noun",
"NUI" => "Adjective",
"P" => "Personal pronoun",
"PREP" => "Preposition",
"PRT" => "Interrogative Particle",
"Q" => "Correlative or Interrogative pronoun",
"R" => "Relative pronoun",
"S" => "Posessive pronoun",
"T" => "Definite article",
"V" => "Verb",
"X" => "Indefinite pronoun",
);
			}
			$part = strtok($morph, "-");
			if ($defaultmorph && !empty($morphhologies[$part])) {
				$result[$table][$morph] = array("M"=>$morphhologies[$part],		"U"=>"");
			}
			else if (!$defaultmorph) {
				$result[$table][$morph] = array("M"=>"morphhology",				"U"=>"");
			}
			else {
				$result[$table][$morph] = array("M"=>"morphhology unavailable",	"U"=>"");
				AION_ECHO("ERROR! $newmess definition missing morph='$morph'");
			}
			$blockcount=2;
			continue;
		}
		else if ($blockcount==2) {
			if (empty($morph) || empty($result[$table][$morph])) {	AION_ECHO("ERROR! $newmess array key missing morph='$morph'"); }
			else if (empty($line)) {								AION_ECHO("ERROR! $newmess detail missing morph='$morph'"); }
			else { $result[$table][$morph]['M'] = $line; }
			$blockcount=3;
			continue;
		}
		else if ($blockcount==3) {
			if (empty($morph) || empty($result[$table][$morph])) {	AION_ECHO("ERROR! $newmess array key missing morph='$morph'"); }
			else if (empty($line)) {								AION_ECHO("ERROR! $newmess usage missing morph='$morph'"); }
			else if (strcasecmp($line,'a conjunction')) {
				$result[$table][$morph]['U'] = $line;
			}
		}
		$blockcount=0;
		$morph = '';
	}
    fclose($handle);
	AION_ECHO("SUCCESS! $newmess lines=$count array=".count($result[$table]));
}



// CREATE THE STEPBIBLE
function AION_NEWSTRONGS_STEPBIBLE($hebtag,$hebdex,$heblex,$gretag,$gredex,$grelex,$bible_ama,$bible_con,$bible_heb,$bible_grk) {
	// setup
	$newmess = "STEPBIBLE\t$bible_ama";
	mb_regex_encoding("UTF-8");
	mb_internal_encoding("UTF-8");	
	$bibledata_ama = "// STEPBible Amalgamant, compiled by ABCMS (alpha)\n";
	$bibledata_con = "// STEPBible Concordant, compiled by ABCMS (alpha)\n";
	$bibledata_heb = "// STEPBible Hebrew, compiled by ABCMS (alpha)\n";
	$bibledata_grk = "// STEPBible Greek, compiled by ABCMS (alpha)\n";
	$bibledata_key = <<<EOF
// Source: Scripture Tools for Every Person
// https://www.STEPBible.org
// https://github.com/STEPBible/STEPBible-Data
//

EOF;
	$bibledata_key_ot = <<<EOF
//  Old Testament Source Legend
//	The STEPBible translator resource tags Old Testament words as L = Leningrad (the default tag); Q = Qere 'spoken' corrections from margin and text pointing; K = Ketiv 'written', Tyndale pointing; R = restored text based on Leningrad parallels; and X = extra words from the Septuagint (LXX), in Hebrew, based on BHS and BHK. Other letters indicate parallels and variants with A = Aleppo; B = Biblia Hebraica Stuttgartensia; C = Cairensis; D = Dead Sea and Judean Desert manuscripts; E = emendation from ancient sources, F = format pointing or word division differences without changing letters; H = Ben Chaim (2nd Rabbinic Bible); P = alternate punctuation; S = scribal traditions; and V = variants from other Hebrew manuscripts. Tags place identical sources outside of parens in upper case. Variant tags are inside parens: uppercase are meaning variants, lower case are minor variants, and differing variants are joined with a “+”. Translators normally follow L, and when this presents a choice between Q and K they follow Q, so K is presented as a variant. Tags in STEP Hebrew are only available when viewed in parallel with STEP English at www.AionianBible.org/Bibles/Hebrew---Hebrew-STEPBible/Genesis/1/parallel-English---STEPBible-Amalgamant.
//	"A"			=> "Aleppo",
//	"B"			=> "Biblia Hebraica Stuttgartensia",
//	"C"			=> "Cairensis",
//	"D"			=> "Dead Sea and Judean Desert manuscripts",
//	"E"			=> "Emendation from ancient sources",
//	"F"			=> "Format pointing or word division difference without letter changes",
//	"H"			=> "Ben Chaim (2nd Rabbinic Bible)",
//	"K"			=> "Ketiv 'written' in the text with Tyndale pointing",
//	"L"			=> "Leningrad",
//	"L(a+bh)"	=> "Leningrad with minor variants: Aleppo plus BHS and Ben Chaim",
//	"L(a+V)"	=> "Leningrad with minor variants: Aleppo plus meaning variants: other Hebrew manuscripts",
//	"L(abh)"	=> "Leningrad with minor variants: Aleppo, BHS, and Ben Chaim",
//	"L(ah+b)"	=> "Leningrad with minor variants: Aleppo and Ben Chaim plus BHS",
//	"L(AH+B)"	=> "Leningrad with meaning variants: Aleppo and Ben Chaim plus BHS",
//	"L(b)"		=> "Leningrad with minor variants: BHS",
//	"L(b+p)"	=> "Leningrad with minor variants: BHS plus alternate punctuation",
//	"L(bah)"	=> "Leningrad with minor variants: Aleppo, BHS, and Ben Chaim",
//	"L(D)"		=> "Leningrad with meaning variants: Dead Sea and Judean Desert manuscripts",
//	"L(E)"		=> "Leningrad with meaning variants: emendation from ancient sources",
//	"L(F)"		=> "Leningrad with meaning variants: format pointing or word division difference without letter changes",
//	"L(H)"		=> "Leningrad with meaning variants: Ben Chaim (2nd Rabbinic Bible)",
//	"L(p)"		=> "Leningrad with minor variants: alternate punctuation",
//	"L(P)"		=> "Leningrad with meaning variants: alternate punctuation",
//	"L(S)"		=> "Leningrad with meaning variants: scribal traditions",
//	"L(V)"		=> "Leningrad with meaning variants: other Hebrew manuscripts",
//	"LA(bh)"	=> "Leningrad and Aleppo with minor variants: BHS and Ben Chaim",
//	"LA(BH)"	=> "Leningrad and Aleppo with meaning variants: BHS and Ben Chaim",
//	"LAB(h)"	=> "Leningrad, Aleppo, and BHS with minor variants: Ben Chaim",
//	"LAB(H)"	=> "Leningrad, Aleppo, and BHS with meaning variants: Ben Chaim",
//	"LAH(b)"	=> "Leningrad, Aleppo, and Ben Chaim with minor variants: BHS",
//	"LB(ah)"	=> "Leningrad and BHS with minor variants: Aleppo and Ben Chaim",
//	"LB(AH)"	=> "Leningrad and BHS with meaning variants: Aleppo and Ben Chaim",
//	"LB(ha)"	=> "Leningrad and BHS with minor variants: Aleppo and Ben Chaim",
//	"LBH(a)"	=> "Leningrad, BHS, and Ben Chaim with minor variants: Aleppo",
//	"LBH(A)"	=> "Leningrad, BHS, and Ben Chaim with meaning variants: Aleppo",
//	"LBH(a+C)"	=> "Leningrad, BHS, and Ben Chaim with minor variants: Aleppo plus meaning variants: Cairensis",
//	"LH(ab)"	=> "Leningrad and Ben Chaim with minor variants: Aleppo and BHS",
//	"P"			=> "Alternate punctuation",
//	"Q"			=> "Qere 'spoken' corrections from margin and text pointing",
//	"Q(k)"		=> "Qere 'spoken' corrections from margin and text pointing, with minor variants: Ketiv 'written', Tyndale pointing",
//	"Q(K)"		=> "Qere 'spoken' corrections from margin and text pointing, with meaning variants: Ketiv 'written', Tyndale pointing",
//	"R"			=> "Restored text based on Leningrad parallels",
//	"S"			=> "Scribal traditions",
//	"V"			=> "Variants from other Hebrew manuscripts",
//	"X"			=> "Extra words from Septuagint (LXX), in Hebrew based on apparatus in BHS and BHK",
//

EOF;
	$bibledata_key_nt = <<<EOF
//  New Testament Source Legend
//	The STEPBible translator resource tags New Testament words as N = Nestlé-Aland NA27 edition with NA28 spelling used by most modern translators; K = Textus Receptus (Scrivener 1894) corrected towards the KJV; and O = Greek in other editions which is not normally used by modern translations or the KJV. NKO without parens, (the default tag), means all editions include the same vocabulary and grammar, though the spelling may vary. Variant tags are inside parens, uppercase are meaning variants and lower case are minor differences and variants. New Testament study is revolutionized by the discovery of earlier manuscripts in North Africa and other discoveries. The NA text is based mostly on these earlier manuscripts, while the TR text was compiled from traditional manuscripts that were available before the earlier ones were found. Later scribes occasionally removed ambiguities with changes like adding phrases to clarify the text. There are no instances of changed theology, confirmed by the huge failed effort to find even one. Less discussed are the words found in the earlier manuscripts, but not in the later. The best explanation is that additions found only in earlier manuscripts and additions found only in later ones are simply two sets of additions by scribes to clarify the text with no theological agenda. So, if you want the very earliest text, use only the words that are in both NA and TR. If you want to include clarifications by North African believers as in modern Bibles, then include words found only in NA. If you want to include the clarifications by Byzantine scribes as in the KJV, then include the words found only in TR, and use the TR variants.
//	"(k)O"		=> "Minor variants in KJV sources, present in other sources, absent in Nestlé-Aland sources",
//	"k"			=> "Minor not translated from KJV sources, absent in Nestlé-Aland and other sources",
//	"K"			=> "Present in KJV sources, absent in Nestlé-Aland and other sources",
//	"k(o)"		=> "Minor not translated from KJV sources, minor variants in other sources, absent in Nestlé-Aland sources",
//	"K(o)"		=> "Present in KJV sources, minor variants in other sources, absent in Nestlé-Aland sources",
//	"K(O)"		=> "Present in KJV sources, meaning variants in other sources, absent in Nestlé-Aland sources",
//	"ko"		=> "Minor not translated from KJV and other sources, absent in Nestlé-Aland sources",
//	"KO"		=> "Identical in KJV and other sources, absent in Nestlé-Aland sources",
//	"n"			=> "Minor not translated from Nestlé-Aland sources, absent in KJV and other sources",
//	"N"			=> "Present in Nestlé-Aland sources, absent in KJV and other sources",
//	"N(k)"		=> "Present in Nestlé-Aland sources, minor variants in KJV sources, absent in other sources",
//	"N(k)(o)"	=> "Present in Nestlé-Aland sources, minor variants in KJV and other sources",
//	"N(k)(O)"	=> "Present in Nestlé-Aland sources, minor variants in KJV sources, meaning variants in other sources",
//	"N(K)(o)"	=> "Present in Nestlé-Aland sources, meaning variants in KJV sources, minor variants in other sources",
//	"N(K)(O)"	=> "Present in Nestlé-Aland sources, meaning variants in KJV and other sources",
//	"N(k)O"		=> "Identical in Nestlé-Aland and other sources, minor variants in KJV sources",
//	"N(K)O"		=> "Identical in Nestlé-Aland and other sources, meaning variants in KJV sources",
//	"n(o)"		=> "Minor not translated from Nestlé-Aland sources, minor variants in other sources, absent in KJV sources",
//	"N(o)"		=> "Present in Nestlé-Aland sources, minor variants in other sources, absent in KJV sources",
//	"N(O)"		=> "Present in Nestlé-Aland sources, meaning variants in other sources, absent in KJV sources",
//	"NK"		=> "Identical in Nestlé-Aland and KJV sources, absent in other sources",
//	"NK(o)"		=> "Identical in Nestlé-Aland and KJV sources, minor variants in other sources",
//	"NK(O)"		=> "Identical in Nestlé-Aland and KJV sources, meaning variants in other sources",
//	"NKO"		=> "Identical in Nestlé-Aland, KJV, and other sources",
//	"no"		=> "Minor not translated from Nestlé-Aland and other sources, absent in KJV sources",
//	"NO"		=> "Identical in Nestlé-Aland and other sources, absent in KJV sources",
//	"o"			=> "Minor not translated from other sources, absent in Nestlé-Aland and KJV sources",
//	"O"			=> "Present in other sources, absent in Nestlé-Aland and KJV sources",
//

EOF;
	$bibledata_ama .= ($bibledata_key . $bibledata_key_ot . $bibledata_key_nt);
	$bibledata_con .= ($bibledata_key . $bibledata_key_ot . $bibledata_key_nt);
	$bibledata_heb .= ($bibledata_key . $bibledata_key_ot);
	$bibledata_grk .= ($bibledata_key . $bibledata_key_nt);
	
	// HEBREW open tag, lex index, and lex
	if (($contents = file_get_contents( $hebtag )) === FALSE) { 	AION_ECHO("ERROR! $newmess !file_get_contents($hebtag)"); }
	$index = json_decode(file_get_contents($hebdex), true);
	if (empty($index)) {											AION_ECHO("ERROR! $newmess !json_decode($hebdex)"); }
	if (!($fd=fopen($heblex, 'r'))) {								AION_ECHO("ERROR! $newmess !fopen($heblex)"); }
	// hebrew loop tags
	$last_book = "XXX"; $last_vers = 0;
	$last_wtype = "L";
	$fullstop = TRUE;
	$line = strtok($contents, "\n");
	while ($line !== false) {
		if (!ctype_digit($line[0])) { $line = strtok( "\n" ); continue; }
		//                 INDX   BOOK         CHAP   VERS   STRONGS                             JOIN      TYPE      UNDER     TRANS     LEXICON   ENGLISH
        //                 1      2            3      4      5        6                          7         8         9         10        11        12
		if (!preg_match("#^(\d+)\t([A-Z0-9]+)\t(\d+)\t(\d+)\t([GH]{1})([0-9]{1,5}[A-Za-z]{0,1})\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]*)\t([^\t]+)\t([^\t]+)#u", $line, $match)) {	AION_ECHO("ERROR! $newmess corrupt ref tag\n".print_r($line,TRUE)); }
		$book = $match[2]; $chap = (int)$match[3]; $vers = (int)$match[4]; $strg = $match[6]; $join = $match[7]; $under = $match[9]; $amal = $match[12]; $wtype = $match[8];
		$book = strtoupper($book); if (!ctype_digit($book[0])) { $book[1] = strtolower($book[1]); } $book[2] = strtolower($book[2]);
		if ($book != $last_book) { AION_ECHO("BUILDING Concordant STEPBible! $book"); $last_book = $book; }
		if ($vers != $last_vers) {
			$wtype_close = ($last_wtype=="L" ? "" : " *{$last_wtype}*)");
			$bibledata_ama .= ("$wtype_close\n$book $chap:$vers ");
			$bibledata_con .= ("$wtype_close\n$book $chap:$vers ");
			$bibledata_heb .= ("\n$book $chap:$vers ");
			$last_vers = $vers;
			$last_wtype = "L";
		}
		// underlying HEBREW
		//if (NULL===($under = preg_replace("#׃#usi"," ׃ ",$under))) { AION_ECHO("ERROR! $newmess !preg_replace($under)"); }		
		if (NULL===($under = preg_replace("#׀#usi"," ׀ ",$under))) { AION_ECHO("ERROR! $newmess !preg_replace($under)"); }
		if (NULL===($under = preg_replace("#[\\\\/]+#usi","",$under))) { AION_ECHO("ERROR! $newmess !preg_replace($under)"); }
		// remove <words>
		if (NULL===($amal = preg_replace("#<[^<>]+>#usi","",$amal))) { AION_ECHO("ERROR! $newmess !preg_replace($amal)"); }
		/* capitalize if following punctuation
		static $punctuation = NULL; if ($punctuation === NULL) { $punctuation = array(
			'־' => 'link',			// H9014
			'׀' => 'separate',		// H9015
			'׃' => 'fullstop',		// H9016
			'פ' => 'chapter',		// H9017
			'ס' => 'paragraph',		// H9018
			'׆' => 'section',		// H9019
		*/
		if ($amal=="[׆]" || $amal=="[׃]" || $amal=="[ס]" || $amal=="[פ]") {	$fullstop = TRUE; }
		else if ($fullstop && isset($amal[0]) && preg_match("#^[[:alpha:]]{1}#",$amal[0])) {	$fullstop = FALSE; $amal[0] = mb_strtoupper($amal[0]); }
		// lexicon entry
		$orig = $strg;
		if ((empty($index[$strg]) || fseek($fd, $index[$strg]) || !($entry=fgets($fd)) || !preg_match("#^$strg\t#u",$entry)) &&
			(empty($index[($strg = $orig.'A')]) || fseek($fd, $index[$strg]) || !($entry=fgets($fd)) || !preg_match("#^$strg\t#u",$entry)) &&
			(empty($index[($strg = $orig.'G')]) || fseek($fd, $index[$strg]) || !($entry=fgets($fd)) || !preg_match("#^$strg\t#u",$entry))) {
			AION_ECHO("ERROR! $newmess dex lex not found, index=".$index[$strg].": $line, $entry");
		}
		$defs = explode("\t",$entry);
		$word = trim($defs[4]);
		if ($wtype==$last_wtype) {			$wtype_close = "";					$wtype_open = " "; }
		else if ($wtype=="L") {				$wtype_close = " *{$last_wtype}*)";	$wtype_open = " "; }
		else  if ($last_wtype!="L") { 		$wtype_close = " *{$last_wtype}*)";	$wtype_open = " ("; }
		else {							 	$wtype_close = "";					$wtype_open = " ("; }
		$last_wtype = $wtype;
		// build the bible word by word
		$bibledata_ama .= "$wtype_close$wtype_open$amal";
		$bibledata_con .= "$wtype_close$wtype_open$word";
		if ('W'==$join[0]) {
			$wtype_openH = (preg_match('#־$#u', $under) ? "" : " ");
			$bibledata_heb .= "$under$wtype_openH";
		}
		$line = strtok( "\n" );
	}
	// last wtype
	$wtype_close = ($last_wtype=="L" ? "" : " *{$last_wtype}*)");
	$bibledata_ama .= ("$wtype_close");
	$bibledata_con .= ("$wtype_close");
	
	fclose($fd);
	unset($contents); $contents=NULL;
	unset($index); $index=NULL;
	
	// GREEK open tag, lex index, and lex
	if (($contents = file_get_contents( $gretag )) === FALSE) {		AION_ECHO("ERROR! $newmess !file_get_contents($gretag)"); }
	$index = json_decode(file_get_contents($gredex), true);
	if (empty($index)) {											AION_ECHO("ERROR! $newmess !json_decode($gredex)"); }
	if (!($fd=fopen($grelex, 'r'))) {								AION_ECHO("ERROR! $newmess !fopen($grelex)"); }
	// greek loop tags
	$last_book = "XXX"; $last_vers = 0;
	$last_wtype = "NKO";
	$line = strtok($contents, "\n");
	while ($line !== false) {
		if (!ctype_digit($line[0])) { $line = strtok( "\n" ); continue; }
		//                 INDX   BOOK         CHAP   VERS   STRONGS                             JOIN      TYPE      UNDER     TRANS     LEXICON   ENGLISH
		//                 1      2            3      4      5        6                          7         8         9         10        11        12
		if (!preg_match("#^(\d+)\t([A-Z0-9]+)\t(\d+)\t(\d+)\t([GH]{1})([0-9]{1,5}[A-Za-z]{0,1})\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]*)\t([^\t]+)\t([^\t]+)#u", $line, $match)) {	AION_ECHO("ERROR! $newmess corrupt ref tag\n".print_r($line,TRUE)); }
		$book = $match[2]; $chap = (int)$match[3]; $vers = (int)$match[4]; $strg = $match[6]; $under = $match[9]; $amal = $match[12]; $wtype = $match[8];
		$book = strtoupper($book); if (!ctype_digit($book[0])) { $book[1] = strtolower($book[1]); } $book[2] = strtolower($book[2]);
		if ($book != $last_book) { AION_ECHO("BUILDING Concordant STEPBible! $book"); $last_book = $book; }
		if ($vers != $last_vers) {
			$wtype_close = ($last_wtype=="NKO" ? "" : " *{$last_wtype}*)");
			$bibledata_ama .= ("$wtype_close\n$book $chap:$vers ");
			$bibledata_con .= ("$wtype_close\n$book $chap:$vers ");
			$bibledata_grk .= ("$wtype_close\n$book $chap:$vers ");
			$last_vers = $vers;
			$last_wtype = "NKO";
		}
		// remove <words>
		if (NULL===($amal = preg_replace("#<[^<>]+>#usi","",$amal))) { AION_ECHO("ERROR! $newmess !preg_replace($amal)"); }
		// lexicon entry
		$orig = $strg;
		if ((empty($index[$strg]) || fseek($fd, (int)$index[$strg]) || !($entry=fgets($fd)) || !preg_match("#^$strg\t#u",$entry)) &&
			(empty($index[($strg = $orig.'A')]) || fseek($fd, $index[$strg]) || !($entry=fgets($fd)) || !preg_match("#^$strg\t#u",$entry)) &&
			(empty($index[($strg = $orig.'G')]) || fseek($fd, $index[$strg]) || !($entry=fgets($fd)) || !preg_match("#^$strg\t#u",$entry))) {
			AION_ECHO("ERROR! $newmess dex lex not found, index=".$index[$strg].": $line, $entry");
		}
		$defs = explode("\t",$entry);
		$word = trim($defs[4]);
		if ($wtype==$last_wtype) {			$wtype_close = "";					$wtype_open = " "; }
		else if ($wtype=="NKO") {			$wtype_close = " *{$last_wtype}*)";	$wtype_open = " "; }
		else  if ($last_wtype!="NKO") { 	$wtype_close = " *{$last_wtype}*)";	$wtype_open = " ("; }
		else {							 	$wtype_close = "";					$wtype_open = " ("; }
		$last_wtype = $wtype;
		// build the bible word by word
		$bibledata_ama .= "$wtype_close$wtype_open$amal";
		$bibledata_con .= "$wtype_close$wtype_open$word";
		$bibledata_grk .= "$wtype_close$wtype_open$under";
		$line = strtok( "\n" );
	}
	// last wtype
	$wtype_close = ($last_wtype=="NKO" ? "" : " *{$last_wtype}*)");
	$bibledata_ama .= ("$wtype_close\n");
	$bibledata_con .= ("$wtype_close\n");
	$bibledata_heb .= ("\n");
	$bibledata_grk .= ("$wtype_close\n");
	// close
	fclose($fd);
	unset($contents); $contents=NULL;
	unset($index); $index=NULL;

	// final cleanup
	/* capitalize if following punctuation
	static $punctuation = NULL; if ($punctuation === NULL) { $punctuation = array(
		'־' => 'link',			// H9014
		'׀' => 'separate',		// H9015
		'׃' => 'fullstop',		// H9016
		'פ' => 'chapter',		// H9017
		'ס' => 'paragraph',		// H9018
		'׆' => 'section',		// H9019
	*/
	// almalgamant
	if (!($bibledata_ama=preg_replace("#\[־\]#ui", " ", $bibledata_ama))) {					AION_ECHO("ERROR! $newmess: preg_replace([־])"); }	
	if (!($bibledata_ama=preg_replace("#\[\-\]#ui", " ", $bibledata_ama))) {				AION_ECHO("ERROR! $newmess: preg_replace([-])"); }	
	if (!($bibledata_ama=preg_replace("#[ ]*\[׆\][ ]*#ui", ". ", $bibledata_ama))) {		AION_ECHO("ERROR! $newmess: preg_replace([׆])"); }	// full stop
	if (!($bibledata_ama=preg_replace("#[ ]*\[ס\][ ]*#ui", ". ", $bibledata_ama))) {		AION_ECHO("ERROR! $newmess: preg_replace([ס])"); }	// full stop	
	if (!($bibledata_ama=preg_replace("#[ ]*\[פ\][ ]*#ui", ". ", $bibledata_ama))) {		AION_ECHO("ERROR! $newmess: preg_replace([פ])"); }	// full stop
	if (!($bibledata_ama=preg_replace("#[ ]*\[׃\][ ]*#ui", ". ", $bibledata_ama))) {		AION_ECHO("ERROR! $newmess: preg_replace([׃])"); }	// full stop
	if (!($bibledata_ama=preg_replace("#[. ]*\.[. ]*#ui", ". ", $bibledata_ama))) {			AION_ECHO("ERROR! $newmess: preg_replace(...)"); }	// full stop	
	if (!($bibledata_ama=preg_replace("#[. ]*([?!]+)[. ]*#ui", '$1 ', $bibledata_ama))) {	AION_ECHO("ERROR! $newmess: preg_replace(...)"); }	// replace full stop
	if (!($bibledata_ama=preg_replace("#[\-־]+[ ]*[\-־]+#ui", "-", $bibledata_ama))) {		AION_ECHO("ERROR! $newmess: preg_replace([\s-־])"); }	
	if (!($bibledata_ama=preg_replace("#[ ]*[\-־]+[ ]*#ui", "-", $bibledata_ama))) {		AION_ECHO("ERROR! $newmess: preg_replace([\s-־])"); }	
	if (!($bibledata_ama=preg_replace("#[\-־]+[ ]*[\-־]+#ui", "-", $bibledata_ama))) {		AION_ECHO("ERROR! $newmess: preg_replace([\s-־])"); }	
	if (!($bibledata_ama=preg_replace("#[ ]*[\-־]+[ ]*#ui", "-", $bibledata_ama))) {		AION_ECHO("ERROR! $newmess: preg_replace([\s-־])"); }
	if (!($bibledata_ama=preg_replace("#\[׀\]#ui", " - ", $bibledata_ama))) {				AION_ECHO("ERROR! $newmess: preg_replace([׀])"); }	
	if (!($bibledata_ama=preg_replace("#<[^>\n\r]+>#ui", " ", $bibledata_ama))) {			AION_ECHO("ERROR! $newmess: preg_replace(<[^>]+>)"); }
	// concordant
	if (!($bibledata_con=preg_replace("#obj\.#ui", "obj", $bibledata_con))) {				AION_ECHO("ERROR! $newmess: preg_replace(obj[.]*)"); }
	// both
	if (!($bibledata_ama=preg_replace("#\(\s+\*[+[:alnum:]]+\)#ui", " ", $bibledata_ama))){	AION_ECHO("ERROR! $newmess: preg_replace(\(\s+\*[+[:alnum:]]+\))"); }
	if (!($bibledata_ama=preg_replace("#([[{(]{1})\s+#ui", '$1', $bibledata_ama))) {		AION_ECHO("ERROR! $newmess: preg_replace(([[{(]{1})\s+)"); }
	if (!($bibledata_con=preg_replace("#\s+([\]})]{1})#ui", '$1', $bibledata_con))) {		AION_ECHO("ERROR! $newmess: preg_replace(\s+([\]})]{1}))"); }
	//all
	if (!($bibledata_ama=preg_replace("#[ ]+#ui", " ", $bibledata_ama))) {					AION_ECHO("ERROR! $newmess: preg_replace([ ]+)"); }
	if (!($bibledata_con=preg_replace("#[ ]+#ui", " ", $bibledata_con))) {					AION_ECHO("ERROR! $newmess: preg_replace([ ]+)"); }	
	if (!($bibledata_heb=preg_replace("#[ ]+#ui", " ", $bibledata_heb))) {					AION_ECHO("ERROR! $newmess: preg_replace([ ]+)"); }
	if (!($bibledata_grk=preg_replace("#[ ]+#ui", " ", $bibledata_grk))) {					AION_ECHO("ERROR! $newmess: preg_replace([ ]+)"); }		
	
	// write the Bible
	if (file_put_contents($bible_ama,$bibledata_ama) === FALSE ) {							AION_ECHO("ERROR! $newmess file_put_contents($bible_ama)" ); }
	if (file_put_contents($bible_con,$bibledata_con) === FALSE ) {							AION_ECHO("ERROR! $newmess file_put_contents($bible_con)" ); }
	if (file_put_contents($bible_heb,$bibledata_heb) === FALSE ) {							AION_ECHO("ERROR! $newmess file_put_contents($bible_heb)" ); }
	if (file_put_contents($bible_grk,$bibledata_grk) === FALSE ) {							AION_ECHO("ERROR! $newmess file_put_contents($bible_grk)" ); }
	// done
	AION_ECHO("DONE $newmess");
	return;
}

