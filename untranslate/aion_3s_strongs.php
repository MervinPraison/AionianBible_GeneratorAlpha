#!/usr/local/bin/php
<?php
require_once('./aion_common.php');

// TODO NOTES
// Uncomment the lines to allow copying the latest git hub report
// Change "Field_of" to "place" in Greek Lexicons
// Add Greek Strongs G5306 from copy of G5305

//////////////////////////////////////////////////////////////////////////////////////////////////
// INIT
//$strongs_json_flag = JSON_UNESCAPED_UNICODE;
//$strongs_json_flag = (JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
$strongs_json_flag = (JSON_UNESCAPED_UNICODE);
$SAVETHECOUNTCHECKER = FALSE;




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
$INPUT_TOTH1 = $FOLDER_SOURCE."TOTHT Gen-Deu - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt";
$INPUT_TOTH2 = $FOLDER_SOURCE."TOTHT Jos-Est - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt";
$INPUT_TOTH3 = $FOLDER_SOURCE."TOTHT Job-Sng - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt";
$INPUT_TOTH4 = $FOLDER_SOURCE."TOTHT Isa-Mal - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt";
$INPUT_TOTX1 = $FOLDER_SOURCE."TOTHT Gen-Deu - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt.oldformat";
$INPUT_TOTX2 = $FOLDER_SOURCE."TOTHT Jos-Est - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt.oldformat";
$INPUT_TOTX3 = $FOLDER_SOURCE."TOTHT Job-Sng - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt.oldformat";
$INPUT_TOTX4 = $FOLDER_SOURCE."TOTHT Isa-Mal - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt.oldformat";
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
$CHECK_HTMH = "CHECK_HTML_HEBREW_TBESH.htm";
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
$README_FILE = "AREADME.md";
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
$HEBREW_USAGE_DATA = "Hebrew_Chapter_Usage.txt";
$HEBREW_USAGE_INDX = "Hebrew_Chapter_Usage_Index.json";
$HEBREW_CHAPS_DATA = "Hebrew_Chapter_Usage";
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
$GREEK_USAGE_DATA = "Greek_Chapter_Usage.txt";
$GREEK_USAGE_INDX = "Greek_Chapter_Usage_Index.json";
$GREEK_CHAPS_DATA = "Greek_Chapter_Usage";
// bible
$STEPBIBLE_AMA = "../STEPBible-Data-master/Holy-Bible---English---STEPBible-Amalgamant---Source-Edition.STEP.txt";
$STEPBIBLE_CON = "../STEPBible-Data-master/Holy-Bible---English---STEPBible-Concordant---Source-Edition.STEP.txt";
$STEPBIBLE_NUM = "../STEPBible-Data-master/Holy-Bible---English---STEPBible-StrongsNum---Source-Edition.STEP.txt";


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
$CHECK_UGRE > Strongs numbers in lexicon, but not in tagged texts
$CHECK_ULSJ > Strongs numbers in lexicon, but not in tagged texts
$CHECK_UHEB > Strongs numbers in lexicon, but not in tagged texts
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
$HEBREW_CHAPS_DATA > json per chapter verse Hebrew lexicon data files, also indexed by modulo verse number

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
$GREEK_CHAPS_DATA > json per chapter verse Greek lexicon data files, also indexed by modulo verse number

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
#	STRONGS
#		Strong's number
#	WORD
#		Hebrew word
#	TRANS
#		Transliterated word
#	PRONOUNCE
#		Pronunciation
#	LANG
#		Language
#	MORPH
#		Part of speech
#	DEF
#		Definition

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
#	STRONGS
#		Strong's number
#	WORD
#		Greek word
#	TRANS
#		Transliterated word
#	PRONOUNCE
#		Pronunciation
#	LANG
#		Language
#	MORPH
#		Part of speech
#	DEF
#		Definition

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
$database['HEBLEX']['H0'] = array('STRONGS' => 'H0','WORD' => '-','TRANS' => '-','GLOSS' => 'Omitted by scribes','MORPH' => '','DEF' => 'Qere read word omitted by scribes'); // Add definition for H0, scribe omitted qere
AION_NEWSTRONGS_GET( "$INPUT_TBESH",'H0001	אָב', NULL, 'HEBLEX',
	array('STRONGS','WORD','TRANS','MORPH','GLOSS','DEF',''),
	array('STRONGS','WORD','TRANS','MORPH','GLOSS','DEF',''), "$FOLDER_STAGE$CHECK_EHLX",
	$HEBLEX=array('STRONGS','WORD','TRANS','GLOSS','MORPH','DEF',''),
	'STRONGS', $database, "TBESH");
AION_NEWSTRONGS_GET_PREPH("$INPUT_TOTH1", "$INPUT_TOTX1");
AION_NEWSTRONGS_GET_PREPH("$INPUT_TOTH2", "$INPUT_TOTX2");
AION_NEWSTRONGS_GET_PREPH("$INPUT_TOTH3", "$INPUT_TOTX3");
AION_NEWSTRONGS_GET_PREPH("$INPUT_TOTH4", "$INPUT_TOTX4");
// do the greek here so they are done
AION_NEWSTRONGS_GET_PREP("$INPUT_TAGN1", "$INPUT_TAGX1");
AION_NEWSTRONGS_GET_PREP("$INPUT_TAGN2", "$INPUT_TAGX2");
AION_NEWSTRONGS_GET( "$INPUT_TOTX1",'001	GEN	001	001	01',	NULL, 'HEBRF1',
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','LEXICON','ENGLISH','GLOSS','STRONGS','MORPH','EDITIONS','VAR1','VAR2','SPELL','EXTRA','CONJOIN','INSTANCE','ALTSTRONG'),
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','','ENGLISH','','STRONGS','MORPH','','','','','','CONJOIN','',''),
	"$FOLDER_STAGE$CHECK_EHTG",
	NULL,
	NULL, $database);
if ( file_put_contents(($file="$INPUT_TOTX1.tmp"), json_encode($database['HEBRF1'], $strongs_json_flag)) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }	AION_unset($database['HEBRF1']);
AION_NEWSTRONGS_GET( "$INPUT_TOTX2",'006	JOS	001	001	01',	NULL, 'HEBRF2',
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','LEXICON','ENGLISH','GLOSS','STRONGS','MORPH','EDITIONS','VAR1','VAR2','SPELL','EXTRA','CONJOIN','INSTANCE','ALTSTRONG'),
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','','ENGLISH','','STRONGS','MORPH','','','','','','CONJOIN','',''),
	"$FOLDER_STAGE$CHECK_EHTG",
	NULL,
	NULL, $database);
if ( file_put_contents(($file="$INPUT_TOTX2.tmp"), json_encode($database['HEBRF2'], $strongs_json_flag)) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }	AION_unset($database['HEBRF2']);
AION_NEWSTRONGS_GET( "$INPUT_TOTX3",'018	JOB	001	001	01',	NULL, 'HEBRF3',
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','LEXICON','ENGLISH','GLOSS','STRONGS','MORPH','EDITIONS','VAR1','VAR2','SPELL','EXTRA','CONJOIN','INSTANCE','ALTSTRONG'),
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','','ENGLISH','','STRONGS','MORPH','','','','','','CONJOIN','',''),
	"$FOLDER_STAGE$CHECK_EHTG",
	NULL,
	NULL, $database);
if ( file_put_contents(($file="$INPUT_TOTX3.tmp"), json_encode($database['HEBRF3'], $strongs_json_flag)) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }	AION_unset($database['HEBRF3']);
AION_NEWSTRONGS_GET( "$INPUT_TOTX4",'023	ISA	001	001	01',	NULL, 'HEBRF4',
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','LEXICON','ENGLISH','GLOSS','STRONGS','MORPH','EDITIONS','VAR1','VAR2','SPELL','EXTRA','CONJOIN','INSTANCE','ALTSTRONG'),
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','','ENGLISH','','STRONGS','MORPH','','','','','','CONJOIN','',''),
	"$FOLDER_STAGE$CHECK_EHTG",
	NULL,
	NULL, $database);
if ( file_put_contents(($file="$INPUT_TOTX4.tmp"), json_encode($database['HEBRF4'], $strongs_json_flag)) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }	AION_unset($database['HEBRF4']);
// TYNDALE HEBREW WRITE
if ( file_put_contents($json="$FOLDER_STAGE$HEBREW_MORPH_DATA",($temp=json_encode($database['HEBMOR'], $strongs_json_flag))) === FALSE ) { AION_ECHO("ERROR! json_encode: ".$json ); }
unset($temp); $temp=NULL;
AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_MORPH_DATA ROWS=".count($database['HEBMOR']));
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
#	STRONGS
#		These Extended Strong Numbers are mapped to BDB (and thereby to other modern lexicons) by OpenScriptures.org.
#		This adds about 800 words which are found in modern lexicons but were not differentiated by Strong.
#		Numbers beyond 9000 include non-lexical prefixes and suffixed. They were created by Tyndale House, Cambridge
#		They are designed to be backward compatible with software that uses Strongs numbers. 
#	WORD
#		Hebrew form	based on BDB, then normalised
#	TRANS
#		Transliteration
#	GLOSS
#		A meaning in one word or as few as possible (by Tyndale scholars)
#	MORPH
#		These were created by Tyndale scholars as a simple grammatical value of the main word represented as Language:Type-Gender-Extra. 
#		Language:Type-Gender-Extra.   Language is A=Aramaic, H=Hebrew, G=Greek and n+Name (which is not language specific). 
#		Type is A=Adjective, Adv=Adverb, Art=Article, Cond=Conditional, Conj=Conjunction, Cor=Correlative, DemP=Demonstrative Pn, ImpP=Impersonal Pn, Intg=Interogative,
#			Intj=Interjection, N=Noun, Neg=Negative, Part=Particle, Prep=Preposition, PerP=Personal Pn, PosP=Possessive Pn, RefP=Reflexive Pn, RelP=Relative Pn, V=Verb. 
#		Gender is F=Female, M=Male, N=Neuter, C=Common and P or S is optionally added for Plural Singular
#		Extra for Names is L=Location, P=Person, LG/PG=Gentilic, T=Title (i.e. any other capitalised nouns such as titles, months, gods, planets etc)
#
#		(notes re Morph)
#		Location is only used for places not named after people - eg: Israel = N:N-M-P (for the Person, and nation); Jerusalem = N:N--L; Canaanite is N:N-M-LG; Israelitess is N:N-F-PG
#		Location is a geographical entity such as river, mountain or city eg "Dan", but Gentilic is used for Amon, Syria, Judah, or the tribal area of Dan. The idea is that someone from
#		Dan is probably related to Dan unless he is called a Hittite, but someone from Jerusalem or the city of Dan could be from anywhere even though he is named after the city.
#		So a "Shulemite" (who is prob from Salem ie Shalem aka Jerusalem) is dark-skinned and perhaps not a native from the area.
#		Title is a misc category that incl names of gods, musical term & months and offices such as Pharaoh unless referring to an individual eg Pharaoh Necho who is N:N-M-P
#		When F or M occ with L or T it refers to the gender of that person, not the location, so Jerusalem = N:N--L, Jerusalemites = N:N-G-L, Jerusalemitess = N:N-F-L 
#		When Gentilics related to a person the STEP_LexicalTag points to the Person eg Danites => Dan.  When Gentilics point to a place, the STEP_LexicalTag points to that place,
#		eg Gileadites => Gilead. When there is no numbered tag for the person or place, we probably aren't sure what it is, so the STEP_LexicalTag doesn't have anywhere different to point,
#		eg. Girgashites. Some very common Gentilics (eg Levite) have gained a meaning of their own which may be related to a person but much less so - so the STEP_LexicalTag does not
#		redirect to the entry for that person. 
#		Odd ones: Jew=N:N-G-P, Jewish=N:A, Jewess+Ammonitess=N:N-G-P-F, Canaanite-trader=N:N-G-P / N:N-G-T, Chaldean-magi=N:N-G-L / N:N-G-T,
#			Nephusim=N:N-G-T, Rephaim=N:N-G-P / N:N-G-T, Shulamite+Shunammite+Carmelitess+Jezreelitess=N:N-F-L
#	DEF
#		Definitions are based on the Abridged BDB by Online Bible, and edited to conform with the extended Strongs. They are for guidence only.
#		Permission should be gained from Online Bible before these are applied in any project.  These defs refer to J. Green's A Concise Lexicon
#		of the Biblical Languages (CLBL) and Harris, Archer, & Waltke's Theological Wordbook of the Old Testament (TWOT),
#		These definitions were edited to align with the augmented Strongs by Tyndale House Cambridge. 

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
AION_unset($database['HEBMOR']);
AION_NEWSTRONGS_VALIDATE_REF("old", $database, $database['TOTHT']);
$commentplus = <<<EOT
# Source: Tyndale House, Cambridge, www.TyndaleHouse.com
# Source Content: Old Testament Strong's Tagged Text
# Source Link: https://tyndale.github.io/STEPBible-Data
# Source Application: https://www.STEPBible.org
# Source Copyright: Creative Commons Attribution Non-Commercial 4.0
#
# COLUMNS
#	INDEX
#		Book index
#	BOOK
#		Book abbreviation
#	CHAPTER
#		Chapter number
#	VERSE
#		Verse number (entries within a verse are sorted below, but without an order number)
#	STRONGS
#		Strong's number
#	FLAG
#		Word flag code: W=next word, K=next Ketiv 'written' word, Q=following Qere 'read' word, P=word parts, R=root or related, J=joined words (though not variants), D=divided word (though not variants)
#	MORPH
#		Morphhology and part of speech (see morphhology code file)
#	WORD
#		Hebrew words, divided in parts with '/'

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
	"$INPUT_TOTX1", 'Gen.1.1-01	Gen.1.1-01	בְּרֵאשִׁית',NULL,
	"$INPUT_TOTX2", 'Jos.1.1-01	Jos.1.1-01	וַיְהִי',	NULL,
	"$INPUT_TOTX3", 'Job.1.1-01	Job.1.1-01	אִישׁ',	NULL,
	"$INPUT_TOTX4", 'Isa.1.1-01	Isa.1.1-01	חֲזוֹן',	'Extended Strongs numbers for Prefixes and suffixes:',
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
AION_NEWSTRONGS_GET_INDEX_LEX_CHECKER("$FOLDER_STAGE$HEBREW_TBESH_INDX","$FOLDER_STAGE$HEBREW_TBESH_DATA",TRUE);
AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_TBESH_INDX");



//////////////////////////////////////////////////////////////////////////////////////////////////
// TYNDALE GREEK READ
AION_NEWSTRONGS_COD( "$INPUT_TEGMC",'GREMOR', $database, TRUE);
AION_NEWSTRONGS_GET( "$INPUT_TBESG",'G0001	G0001G =	G0001G	α, Ἀλφα',	NULL, 'GRELEX',
	array('STRONGS','STRONGU','STRONGD','WORD','TRANS','MORPH','GLOSS','DEF'),
	array('STRONGS','STRONGU','STRONGD','WORD','TRANS','','GLOSS','DEF'), "$FOLDER_STAGE$CHECK_EGLX",
	array('STRONGS','WORD','TRANS','GLOSS','MORPH','STRONGU','STRONGD','DEF'),
	'STRONGS', $database);
AION_NEWSTRONGS_GET_UD('GRELEX', $database);
AION_NEWSTRONGS_GET( "$INPUT_TFLS1",'G0001	G0001G =	G0001G	α, Ἀλφα',	NULL, 'GRELSJ',
	array('STRONGS','STRONGU','STRONGD','WORD','TRANS','MORPH','GLOSS','DEF'),
	array('STRONGS','STRONGU','STRONGD','WORD','TRANS','','GLOSS','DEF'), "$FOLDER_STAGE$CHECK_ELSJ",
	array('STRONGS','WORD','TRANS','GLOSS','MORPH','STRONGU','STRONGD','DEF'),
	'STRONGS', $database);
AION_NEWSTRONGS_GET( "$INPUT_TFLS2",'G6000	G6000 =	G6000	ἀγγέλλω',NULL, 'GRELSJ',
	array('STRONGS','STRONGU','STRONGD','WORD','TRANS','MORPH','GLOSS','DEF'),
	array('STRONGS','STRONGU','STRONGD','WORD','TRANS','','GLOSS','DEF'), "$FOLDER_STAGE$CHECK_ELSJ",
	array('STRONGS','WORD','TRANS','GLOSS','MORPH','STRONGU','STRONGD','DEF'),
	'STRONGS', $database);
AION_NEWSTRONGS_GET_UD('GRELSJ', $database);
// do the greek earlier so they are done
//AION_NEWSTRONGS_GET_PREP("$INPUT_TAGN1", "$INPUT_TAGX1");
//AION_NEWSTRONGS_GET_PREP("$INPUT_TAGN2", "$INPUT_TAGX2");
AION_NEWSTRONGS_GET( "$INPUT_TAGX1", "040	MAT	001	001	01", NULL, 'GREREF1',
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','LEXICON','ENGLISH','GLOSS','STRONGS','MORPH','EDITIONS','VAR1','VAR2','SPELL','EXTRA','CONJOIN','INSTANCE','ALTSTRONG'),
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','LEXICON','ENGLISH','GLOSS','STRONGS','MORPH','EDITIONS','','','','','CONJOIN','',''),
	"$FOLDER_STAGE$CHECK_EGTG",
	NULL,
	NULL, $database);
AION_NEWSTRONGS_GET( "$INPUT_TAGX2", "044	ACT	001	001	01", NULL, 'GREREF2',
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','LEXICON','ENGLISH','GLOSS','STRONGS','MORPH','EDITIONS','VAR1','VAR2','SPELL','EXTRA','CONJOIN','INSTANCE','ALTSTRONG'),
	array('INDX','BOOK','CHAP','VERS','NUMB','TYPE','UNDER','TRANS','LEXICON','ENGLISH','GLOSS','STRONGS','MORPH','EDITIONS','','','','','CONJOIN','',''),
	"$FOLDER_STAGE$CHECK_EGTG",
	NULL,
	NULL, $database);
// TYNDALE GREEK WRITE
if ( file_put_contents($json="$FOLDER_STAGE$GREEK_MORPH_DATA",($temp=json_encode($database['GREMOR'], $strongs_json_flag))) === FALSE ) { AION_ECHO("ERROR! json_encode: ".$json ); }
unset($temp); $temp=NULL;
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_MORPH_DATA ROWS=".count($database['GREMOR']));
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
#	STRONGS
#		Strong's number with extensions
#		G0001  - G5624,  Strongs numbers from original set made by Strong for Greek behind the KJV  
#		G3203  - G3302,  Not used for some reason
#		G5627  - G5799,  Greek morphology codes  (these numbers aren't used in this lexicon) 
#		G5800  - G5893,  Greek Synonyms - see https://studybible.info/strongs/G5800  (these numbers aren't used in this lexicon) 
#		G6000  - G6090,  Extra Strongs Numbers in NASB mainly for variants not known to Strong. (they remain the same so it is backward-compatible with NASB) 
#		G6100  - G9979,  Extra Greek from Apostolic Bible Project mainly for LXX words not found in NT (including Greek names that don't occur in the Hebrew) 
#		G6091  - G6099,  G9980 - G9999, Extra Greek for variants which are not included in NASB or Apostolic Bible  
#		G10000 - G19999, Greek equivalent of Strongs Hebrew numbers for names and transliterated words eg  Abagtha (H0005) = G10005. When there is a NT equivalent, this is the STEP_LexicalTag
#		G20000 - G20199, Words where  the Full LSJ entry refers to the LXX, but they are not referred to in the AB tagging because they only occur in non-Protestant canons or in MSS other than Vaticanus (used by AB)
#	WORD
#		Greek word in unicode lexical form. Based on LSJ but conforming to BADG when the difference may be confusing.
#	TRANS
#		Transliteration
#	GLOSS
#		A meaning in one word or as few as possible (by Tyndale scholars)
#	MORPH
#		Simple gramatical value of the main word represented as Language:Type-Gender-Extra
#		Language is A=Aramaic, H=Hebrew, G=Greek and N=Name (which is not language specific).
#		Type is A=Adjective, Adv=Adverb, Art=Article, Cond=Conditional, Conj=Conjunction, Cor=Correlative, DemP=Demonstrative Pn, ImpP=Impersonal Pn, Intg=Interogative,
#			Intj=Interjection, N=Noun, Neg=Negative, Part=Particle, Prep=Preposition, PerP=Personal Pn, PosP=Possessive Pn, RefP=Reflexive Pn, RelP=Relative Pn, V=Verb.
#		Gender is F=Female, M=Male, N=Neuter, C=Common and P or S is optionally added for Plural Singular
#		Extra for Names is L=Location, P=Person, LG/PG=Gentilic, T=Title (i.e. any other capitalised nouns such as titles, months, gods, planets etc)
#	DEF
#		Definition, lexical entry.
#		The Brief lexicon uses Abbot-Smith or MiddleLiddel or Mounce's Teknia when entries are missing.
#		(AS) = Abbott Smith - from https://github.com/translatable-exegetical-tools/Abbott-Smith, with corrections and adapted by Tyndale Scholars. 
#		(ML) = Middle Liddell - from Perseus - used for Meaning in the Brief lexicon when there is no entry by (AS)
#		(MT) = Mounce's Teknia Greek dictionary - from www.billmounce.com/greek-dictionary (with permission) -  used for Meaning in the Brief lexicon when there is no entry by (AS) or (ML)

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
#	STRONGS
#		Strong's number with extensions
#		G0001  - G5624,  Strongs numbers from original set made by Strong for Greek behind the KJV  
#		G3203  - G3302,  Not used for some reason
#		G5627  - G5799,  Greek morphology codes  (these numbers aren't used in this lexicon) 
#		G5800  - G5893,  Greek Synonyms - see https://studybible.info/strongs/G5800  (these numbers aren't used in this lexicon) 
#		G6000  - G6090,  Extra Strongs Numbers in NASB mainly for variants not known to Strong. (they remain the same so it is backward-compatible with NASB) 
#		G6100  - G9979,  Extra Greek from Apostolic Bible Project mainly for LXX words not found in NT (including Greek names that don't occur in the Hebrew) 
#		G6091  - G6099,  G9980 - G9999, Extra Greek for variants which are not included in NASB or Apostolic Bible  
#		G10000 - G19999, Greek equivalent of Strongs Hebrew numbers for names and transliterated words eg  Abagtha (H0005) = G10005. When there is a NT equivalent, this is the STEP_LexicalTag
#		G20000 - G20199, Words where  the Full LSJ entry refers to the LXX, but they are not referred to in the AB tagging because they only occur in non-Protestant canons or in MSS other than Vaticanus (used by AB)
#	WORD
#		Greek word in unicode lexical form. Based on LSJ but conforming to BADG when the difference may be confusing.
#	TRANS
#		Transliteration
#	GLOSS
#		A meaning in one word or as few as possible (by Tyndale scholars)
#	MORPH
#		Simple gramatical value of the main word represented as Language:Type-Gender-Extra
#		Language is A=Aramaic, H=Hebrew, G=Greek and N=Name (which is not language specific).
#		Type is A=Adjective, Adv=Adverb, Art=Article, Cond=Conditional, Conj=Conjunction, Cor=Correlative, DemP=Demonstrative Pn, ImpP=Impersonal Pn, Intg=Interogative,
#			Intj=Interjection, N=Noun, Neg=Negative, Part=Particle, Prep=Preposition, PerP=Personal Pn, PosP=Possessive Pn, RefP=Reflexive Pn, RelP=Relative Pn, V=Verb.
#		Gender is F=Female, M=Male, N=Neuter, C=Common and P or S is optionally added for Plural Singular
#		Extra for Names is L=Location, P=Person, LG/PG=Gentilic, T=Title (i.e. any other capitalised nouns such as titles, months, gods, planets etc)
#	DEF
#		The LJS lexicon uses the Full LSJ formatted by Tyndale House, Cambridge.
#		Full LSJ - Liddell-Scott-Jones -  from Perseus, with additional features and corrections by Tyndale House, Cambridge:
#		Most abbreviations have been expanded, usually in accordance with the introductions to the lexicons but occasionally made clearer. 
#		Dates have been added to authors by Tyndale House, using standard reference works. 
#		Coding is added to hide bibliographic data under a link stating the earliest date included in that data.
#		(Note, not all devices work well with tooltips, so consider implementing a clickable option such as https://jsfiddle.net/xaAN3/) 

EOT;
AION_FILE_DATA_PUT("$FOLDER_STAGE$GREEK_TFLSJ_DATA", $database['GRELSJ'], $commentplus);
AION_NEWSTRONGS_LEX_MORPH_LEX($database['GRELSJ']);
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_TFLSJ_DATA ROWS=".count($database['GRELSJ']));
AION_NEWSTRONGS_FIX_REF_GREEK($database['GREREF1'],'GRERE2',$database, $database['GRELEX'], $database['GRELSJ'], $database['GREMOR']);
AION_NEWSTRONGS_FIX_REF_GREEK($database['GREREF2'],'GRERE2',$database, $database['GRELEX'], $database['GRELSJ'], $database['GREMOR']);
AION_NEWSTRONGS_VALIDATE_REF("new", $database, $database['GRERE2']);
AION_unset($database['GREREF1']);
AION_unset($database['GREREF2']);
AION_unset($database['GREMOR']);
$commentplus = <<<EOT
# Source: Tyndale House, Cambridge, www.TyndaleHouse.com
# Source Content: New Testament Strong's Tagged Text
# Source Link: https://tyndale.github.io/STEPBible-Data
# Source Application: https://www.STEPBible.org
# Source Copyright: Creative Commons Attribution Non-Commercial 4.0
#
# COLUMNS
#	INDEX
#		Book index
#	BOOK
#		Book abbreviation
#	CHAPTER
#		Chapter number
#	VERSE
#		Verse number (entries within a verse are sorted below, but without an order number)
#	STRONGS
#		Strong's number
#	FLAG
#		Word flag code: W=next word, J=joined words,  A=additional word in non-NA texts
#	MORPH
#		Morphhology and part of speech (see morphhology code file)
#	WORD
#		Greek word
#	ENGLISH
#		English synonym
#	ENTRY
#		Word entry type
#		"NA=TR"	=NA same TR				133304 words are translated in both traditional KJV and modern Bibles.	NA27/28 + TR + others all having the same meaning
#		"NA~TR"	=NA diff TR				3922 words may translate differently in traditional and modern Bibles.	NA27/28 + others having the same meaning but there are.also .. 	| Variants = different meanings in TR + others
#		"NA-TR"	=NA not TR				761 words are translated in most modern Bibles but not in the KJV.		NA27/28 + others having the same meaning but not TR
#		"KJV"	=TR not NA,NIV/ESV		3573 words are translated in the KJV but not in most modern Bibles.		TR + others having the same meaning but not NA27/28
#		"KJV+"	=TR not NA. In NIV/ESV	??? 3573 words are translated in the KJV but not in most modern Bibles.	TR + others having the same meaning but not NA27/28
#		"KJV++"	=TR+NIV/ESV not NA		227 words are translated in the KJV and in some modern Bibles.			TR + others having the same meaning but not NA27/28
#		"NATR?"	Not in NA or TR			245 words occur in early manuscripts but not translated in most Bibles.	Others having a word that is not found in TR or NA27/28
#
#		This text is a Bible translator resource from the STEPBible Tyndale Amalgamated Hebrew and Greek.
#		The Greek text is tagged 'NA=TR' (default Nestle/Aland = Textus Receptus) 133,304 words from NA27/28+TR+others with same meaning,
#		'NA~TR' 3,922 words from NA27/28 with different meanings in TR, 'NA-TR' 761 words in NA27/28 not in TR,
#		'KJV' 3,573 words in TR not in NA27/28, 'KJV+' 3,573 words in TR+Older Bibles but not in NA27/28,
#		'KJV++' 227 words in TR+Modern Bibles but not in NA27/28, 'NATR?' 245 words not found in NA27/28 or TR.
#		New Testament study is revolutionized by the discovery of earlier manuscripts in the North African sands and other discoveries.
#		Most modern Bibles rely on these new discoveries. The NA text is based mostly on these earlier manuscripts,
#		but the TR text was put together from later ones, before the earlier ones were found.
#		Apparently later scribes often removed ambiguities with changes like adding the name "Jesus" instead of "he",
#		adding prepositions such as "with" and "to" instead of relying on Greek cases like dative and genitive,
#		and occasionally adding phrases to clarify the text. There are no instances of changed theology confirmed by the huge failed effort to find even one.
#		Less discussed are the words found in the earlier manuscripts, but not in the later.
#		Of these there are 548 differences with no impact to meaning and 277 scribal clarification differences.
#		And these are only mildly significant changes like "72" for "70" disciples sent out in Luke 10:1,17,
#		"Spirit of Jesus" for "Jesus" in Acts 16:7, "as you now walk" in 1Th 4:1, "according to God" in 1Pet 5:2,
#		"show mercy to others" in Jude 23, and "and a third of the earth was burned" in Rev 8:7.
#		The best explanation is that the additions found only in earlier manuscripts and the additions found only
#		in later ones are simply two sets of additions by scribes to clarify the text with no theological agenda.
#		So, if you want the very earliest text, use only the words that are in both NA and TR.
#		If you want to include clarifications by North African believers like modern Bibles, then include words found only in NA.
#		If you want to include the clarifications by Byzantine scribes like the KJV, then include the words found only in TR, and use the TR variants.
#
#	PUNC 
#		Punctuation based on the oldest manuscripts
#	EDITIONS
#		"Byz"		=> "Byzantine from Robinson/Pierpoint",
#		"Coptic"	=> "Coptic",
#		"ESV"		=> "English Standard Version",
#		"Goodnews"	=> "Goodnews",
#		"KJV"		=> "King James Version",
#		"NA26"		=> "Nestle/Aland 26th Edition",
#		"NA27"		=> "Nestle/Aland 27th Edition",
#		"NA28"		=> "Nestle/Aland 28th Edition, not ECM",
#		"NIV"		=> "New International Version",
#		"OldLatin"	=> "Old Latin",
#		"OldSyriac"	=> "Old Syriac version",
#		"P66"		=> "Papyri #66",
#		"P66*"		=> "Papyri #66 corrector",
#		"Punc"		=> "Accent variant from punctuation",
#		"SBL"		=> "Society of Biblical Literature Greek NT",
#		"TR"		=> "Textus Receptus",
#		"Treg"		=> "Tregelles",
#		"Tyn"		=> "Tyndale House GNT",
#		"U1"		=> "Uncial #1",
#		"U2"		=> "Uncial #2",
#		"U3"		=> "Uncial #3",
#		"U4"		=> "Uncial #4",
#		"U5"		=> "Uncial #5",
#		"U6"		=> "Uncial #6",
#		"U32"		=> "Uncial #32",
#		"WH"		=> "Westcott/Hort",
#	SPELLINGS
#		Variant spellings
#	MEANINGS
#		Variant meanings
#	ADDITIONAL
#		Additional meaning references
#	CONJOIN
#		Links like articles and particles with their connecting word 

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
	"$INPUT_TAGX1",NULL, NULL,
	"$INPUT_TAGX2",NULL, NULL,
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
AION_NEWSTRONGS_GET_INDEX_LEX_CHECKER("$FOLDER_STAGE$GREEK_TBESG_INDX", "$FOLDER_STAGE$GREEK_TBESG_DATA");
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_TBESG_INDX");
AION_NEWSTRONGS_GET_INDEX_LEX("$FOLDER_STAGE$GREEK_TFLSJ_DATA","$FOLDER_STAGE$GREEK_TFLSJ_INDX");
AION_NEWSTRONGS_GET_INDEX_LEX_CHECKER("$FOLDER_STAGE$GREEK_TFLSJ_INDX","$FOLDER_STAGE$GREEK_TFLSJ_DATA");
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_TFLSJ_INDX");






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
	"$STEPBIBLE_NUM"
	);




///////////////////////////////////////////////////////////////////////////////////////////////////
// COMPARE
AION_LOOP_DIFF(
	'../www-stage/library/stepbible',
 	'../www-production/library/stepbible',
	'../STEPBible-Data-master-diff-cooked');
//	'',
//	'/\.(md|txt|json|htm)$/');
AION_CHECK_DIFF_TWO_FILES(
	'../source-stage/Holy-Bible---English---STEPBible-Amalgamant---Source-Edition.STEP.txt',
	'../www-resources/Holy-Bible---English---STEPBible-Amalgamant---Source-Edition.STEP.txt',
	'../STEPBible-Data-master-diff-cooked/Holy-Bible---English---STEPBible-Amalgamant---Source-Edition.STEP.txt');
AION_CHECK_DIFF_TWO_FILES(
	'../source-stage/Holy-Bible---English---STEPBible-Concordant---Source-Edition.STEP.txt',
	'../www-resources/Holy-Bible---English---STEPBible-Concordant---Source-Edition.STEP.txt',
	'../STEPBible-Data-master-diff-cooked/Holy-Bible---English---STEPBible-Concordant---Source-Edition.STEP.txt');




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
// Convert new format TAGOT back to old format
function AION_NEWSTRONGS_GET_PREPH($file, $fout) {
	// init
	$newmess = "PREPH\t$file";
	if ( !is_file( $file ) ) {											AION_ECHO("ERROR! $newmess !is_file()"); }
	if ( ($contents = file_get_contents( $file )) === FALSE ) {			AION_ECHO("ERROR! $newmess !file_get_contents()"); }
	if ( mb_detect_encoding($contents, "UTF-8", TRUE) === FALSE ) {		AION_ECHO("ERROR! $newmess !mb_detect_encoding()"); }
	mb_regex_encoding("UTF-8");
	mb_internal_encoding("UTF-8");
	$lines = mb_split("\n", $contents);
	$output = array();
	$abooks = AION_BIBLES_LIST();
	$tbooks = AION_BIBLES_LIST_TYN();
	$count = 0;
	// parse
	foreach( $lines as $data ) {
		++$count;
		// word line
		//Heb (&Eng) Ref & Type	Hebrew	Transliteration	English translation	dStrongs = Lexical = Gloss	Grammar	Meaning Variants	Spelling Variants	Conjoin word	sStrong+Instance	Alt Strongs
		//Gen.1.1#01=M +T	בְּ/רֵאשִׁ֖ית	be./re.Shit	in/ beginning	H9003=ב=in / {H7225G=רֵאשִׁית=: beginning»first:1_beginning}	HR/Ncfsa			H7225		
		//Gen.1.1#02=M +T	בָּרָ֣א	ba.Ra'	he created	{H1254A=בָּרָא=to create}	HVqp3ms			H1254		
		//Gen.1.1#03=M +T	אֱלֹהִ֑ים	'E.lo.Him	God	{H0430G=אֱלֹהִים=God»LORD@Gen.1.1-Heb}	HNcmpa			H0430		
		//Deu.23.1#08 (22.30#08)=M +T	יְגַלֶּ֖ה	ye.ga.Leh	he will uncover	{H1540I=גָּלָה=: uncover[things]»to reveal:3_uncover[things]}	HVpi3ms			H1540		
		//Deu.23.1#09 (22.30#09)=M +T	כְּנַ֥ף	ke.Naf	[the] skirt of	{H3671=כָּנָף=wing}	HNcfsc			H3671		
		//Deu.23.1#10 (22.30#10)=M +T	אָבִֽי/ו/׃/ /ס	'a.Vi/v	father/ his	{H0001G=אָב=father} / H9023=Ps3m=his / H9016=׃=verseEnd / /H9018=ס=section	HNcmsc/Sp3ms			H0001_B	
		if (!preg_match('/^[[:alnum:]]{3}\.\d+\.\d+#\d+/', $data)) {
			continue;
		}
		else if (preg_match('/^([[:alnum:]]{3})\.(\d+)\.(\d+)#(\d+) \((\d+)\.(\d+)#(\d+)\)=([^\t]+)\t([^\t]*)\t([^\t]*)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)(.*)$/', $data, $match)) {
			// renumber the match array for kjv references
			unset($match[2]);
			unset($match[3]);
			unset($match[4]);
			$match = array_values($match);			
		}
		else if (!preg_match('/^([[:alnum:]]{3})\.(\d+)\.(\d+)#(\d+)=([^\t]+)\t([^\t]*)\t([^\t]*)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)(.*)$/', $data, $match)) {
			AION_ECHO("ERROR! line=$count $newmess bad line: $data");
		}
		// value in field 16?
		if (!empty(preg_replace("#\s+#","",$match[16]))) {
			AION_ECHO("ERROR! line=$count $newmess bad fields: $data");
		}
		// book name and index 
		$book = strtoupper($match[1]);
		if (empty($tbooks[$book])) { AION_ECHO("ERROR! $newmess missing book='$book'\n".print_r($line,TRUE)); }
		$book = $tbooks[$book];
		$indx = sprintf('%03d', (int)array_search($book,array_keys($abooks)));
		$chap = sprintf('%03d', (int)$match[2]);
		$vers = sprintf('%03d', (int)$match[3]);		
		$numb = sprintf('%02d', (int)$match[4]);
		// remove spaces from type field
		$match[5] = preg_replace("#[\s\+]+#u","",$match[5]);
		$match[5] = preg_replace("#\[#u","(",$match[5]);
		$match[5] = preg_replace("#\]#u",")",$match[5]);		
		$match[5] = preg_replace("#\(M\)#u","m",$match[5]);
		$match[5] = preg_replace("#\(T\)#u","t",$match[5]);
		$match[5] = preg_replace("#\(O\)#u","o",$match[5]);
		// more clean up
		$match[6] = trim(preg_replace("#\s+#u"," ",$match[6]));
		$match[7] = trim(preg_replace("#\s+#u"," ",$match[7]));
		$match[8] = trim(preg_replace("#\s+#u"," ",$match[8]));
		$match[9] = preg_replace("#[{}]+#u","",$match[9]);
		$match[9] = preg_replace("#[/d]*_#u"," ",$match[9]);
		$match[9] = trim(preg_replace("#\s+#u"," ",$match[9]));
		$match[10] = preg_replace("#\s+#u","",$match[10]);
		$match[11] = trim(preg_replace("#\s+#u"," ",$match[11]));
		$match[12] = trim(preg_replace("#\s+#u"," ",$match[12]));
		$match[13] = trim(preg_replace("#\s+#u"," ",$match[13]));
		$match[14] = trim(preg_replace("#\s+#u"," ",$match[14]));
		$match[15] = trim(preg_replace("#\s+#u"," ",$match[15]));
		// rows
		$output[] = "$indx	$book	$chap	$vers	$numb	$match[5]	$match[6]	$match[7]		$match[8]		$match[9]	$match[10]		$match[11]		$match[12]		$match[13]	$match[14]	$match[15]";
	}
	//sort and implode
	sort($output);
	array_unshift($output, "INDEX	BOOK	CHAP	VERS	NUMB	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	STRONGS	MORPH	EDITIONS	VAR1	VAR2	SPELL	EXTRA	CONJOIN	INSTANCE	ALTSTRONG");
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
	// init
	$newmess = "PREP\t$file";
	if ( !is_file( $file ) ) {											AION_ECHO("ERROR! $newmess !is_file()"); }
	if ( ($contents = file_get_contents( $file )) === FALSE ) {			AION_ECHO("ERROR! $newmess !file_get_contents()"); }
	if ( mb_detect_encoding($contents, "UTF-8", TRUE) === FALSE ) {		AION_ECHO("ERROR! $newmess !mb_detect_encoding()"); }
	mb_regex_encoding("UTF-8");
	mb_internal_encoding("UTF-8");
	$lines = mb_split("\n", $contents);
	$output = array();
	$abooks = AION_BIBLES_LIST();
	$tbooks = AION_BIBLES_LIST_TYN();
	$count = 0;
	// parse
	foreach( $lines as $data ) {
		++$count;
		//Word & Type	Greek	English translation	dStrongs = Grammar	Dictionary form =  Gloss	editions	1st variant	2nd variant	Spellings		Spanish translation	Sub-meaning	Conjoin word	sStrong+Instance	Alt Strongs
		//Mat.1.1#01=M + T + O	Βίβλος (Biblos)	[The] book	G0976=N-NSF	βίβλος=book	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				Libro	book	#01	G0976				
		//Mat.1.1#02=M + T + O	γενέσεως (geneseōs)	of [the] genealogy	G1078=N-GSF	γένεσις=origin	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				de origen	origin	#02	G1078				
		//Mat.1.1#03=M + T + O	Ἰησοῦ (Iēsou)	of Jesus	G2424G=N-GSM-P	Ἰησοῦς=Jesus/Joshua	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				de Jesús	Jesus»Jesus|Jesus@Mat.1.1	#03	G2424				
		//Act.2.11#01 (2.10)=M + T + O	Ἰουδαῖοί (Ioudaioi)	Jews	G2453G=N-NPM-PG	Ἰουδαῖος=Jewish 	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				judíos	Jewish»Jews@2Ki.25.25	#01	G2453				
		//Act.2.11#02 (2.10)=M + T + O	τε (te)	both	G5037=CONJ	τε=and/both	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				y	both	#02	G5037				
		//Act.2.11#03 (2.10)=M + T + O	καὶ (kai)	and	G2532=CONJ	καί=and	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				también	and	#03	G2532_A				
		//Act.2.11#04 (2.10)=M + T + O	προσήλυτοι, (prosēlutoi)	converts,	G4339=N-NPM	προσήλυτος=proselyte	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz				prosélitos	proselyte	#04	G4339	
		if (!preg_match('/^[[:alnum:]]{3}\.\d+\.\d+#\d+/', $data)) {
			continue;
		}
		else if (preg_match('/^([[:alnum:]]{3})\.(\d+)\.(\d+)#(\d+) \((\d+)\.(\d+)\)=([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)(.*)$/', $data, $match)) {
			$match[2] = $match[5]; unset($match[5]);
			$match[3] = $match[6]; unset($match[6]);
			$match = array_values($match);	
		}
		else if (!preg_match('/^([[:alnum:]]{3})\.(\d+)\.(\d+)#(\d+)=([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)(.*)$/', $data, $match)) {
			AION_ECHO("ERROR! line=$count $newmess bad line: $data");
		}
		// value in field 22?
		if (!empty(preg_replace("#\s+#","",$match[20]))) {
			AION_ECHO("ERROR! line=$count $newmess bad fields: $data");
		}
		// book name and index 
		$book = strtoupper($match[1]);
		if (empty($tbooks[$book])) { AION_ECHO("ERROR! $newmess missing book='$book'\n".print_r($line,TRUE)); }
		$book = $tbooks[$book];
		$indx = sprintf('%03d', (int)array_search($book,array_keys($abooks)));
		$chap = sprintf('%03d', (int)$match[2]);
		$vers = sprintf('%03d', (int)$match[3]);		
		$numb = sprintf('%02d', (int)$match[4]);
		// remove spaces from type field
		$match[5] = preg_replace("#[\s\+]+#u","",$match[5]);
		if ($match[5]=="M(T)(O)(O)") { $match[5]="M(T)(O)"; }
		$match[5] = preg_replace("#\(M\)#u","m",$match[5]);
		$match[5] = preg_replace("#\(T\)#u","t",$match[5]);
		$match[5] = preg_replace("#\(O\)#u","o",$match[5]);
		// Transliteration
		$twopieces = mb_split("[()]{1}", $match[6]);
		if(count($twopieces) != 3 || !empty($twopieces[2])) { AION_ECHO("ERROR! line=$count $newmess Greek/Translit format problem, $data"); }
		$greek = trim($twopieces[0]);
		$translit = trim(preg_replace("#[()]+#u","",$twopieces[1]));
		// reconstruct strongs and morph
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
		// construct dictionary and gloss
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
		// remove extra 
		if (preg_match("#$match[15]#u",$gloss)) { $match[15] = NULL; }
		// trim
		$match[7] = trim(preg_replace("#\s+#u"," ",$match[7]));
		$match[10] = trim(preg_replace("#\s+#u"," ",$match[10]));
		$match[11] = trim(preg_replace("#\s+#u"," ",$match[11]));
		$match[12] = trim(preg_replace("#\s+#u"," ",$match[12]));
		$match[13] = trim(preg_replace("#\s+#u"," ",$match[13]));
		$match[15] = trim(preg_replace("#\s+#u"," ",$match[15]));
		$match[16] = trim(preg_replace("#\s+#u"," ",$match[16]));
		$match[17] = trim(preg_replace("#\s+#u"," ",$match[17]));
		$match[18] = trim(preg_replace("#\s+#u"," ",$match[18]));
		$match[19] = trim(preg_replace("#\s+#u"," ",$match[19]));
		// lay it out
		$output[] = "$indx	$book	$chap	$vers	$numb	$match[5]	$greek	$translit	$dictionary	$match[7]	$gloss	$strongs	$morph	$match[10]	$match[11]	$match[12]	$match[13]	$match[15]	$match[16]:$match[17]	$match[18]	$match[19]";
	}
	//sort and implode
	sort($output);
	array_unshift($output, "INDEX	BOOK	CHAP	VERS	NUMB	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	STRONGS	MORPH	EDITIONS	VAR1	VAR2	SPELL	EXTRA	CONJOIN	INSTANCE	ALTSTRONG");
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
	define($table, $table);
	$lines = mb_split("\n", $contents);
	if ($flag=="TBESH") { AION_NEWSTRONGS_GET_FIX2($file, $lines, $result); }
	if (!is_array($result[$table])) { $result[$table] = array(); }
	$count_keys = count($keys);
	$count_meta = 0;
	$count = 0;
	$previous = NULL;
	foreach( $lines as $data ) {
		++$count;
		if ($data[0]=='#' || $data[0]=='$' || preg_match("#^\s*$#us",$data)) { continue; }
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
				$newd[$keys[$x]] = trim($data[$x]);
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
			if (!empty($result[$table][$newd[$key]])) {					AION_ECHO("WARN! $newmess line=$count array key overlap! $key=".$newd[$key]); }
			else { $result[$table][$newd[$key]] = $newd; }
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




// Hebrew file if not more than one list item then delete the "1)"
function AION_NEWSTRONGS_GET_FIX2($file, &$lines, &$result) {
	$newmess = "FIX2\t$file";
	$fixed = 0;
	foreach( $lines as $x => $line ) {
		if (empty($line)) { unset($lines[$x]); continue; }
		$count = 0;
		if (!preg_match("#[\t ]+2\)#ui",$line)) {
			if (!($lines[$x] = preg_replace("#([\t ]+)1\)#ui",'$1',$line,-1,$count)) || $count>1 ||
				!($lines[$x] = preg_replace($reg="#[ ]+#usi"," ", $lines[$x]))) {
				AION_ECHO("ERROR! $newmess $count\n".print_r($line,TRUE));
			}
			$fixed += $count;
			if (preg_match("#[\t ]+[3-9]+[\d]*\)#ui",$line)) {
				AION_ECHO("WARN! Weird, no '2)' removed '1)' but found '3)' $newmess $count\n".print_r($line,TRUE));
			}
		}
	}
	$result['FIXCOUNTS'].="$newmess removed Hebrew '1)' times=$fixed\n";
}


// Clean up the Lexicon before writing
function AION_NEWSTRONGS_GET_FIX_LEX($file, &$lines, &$database, $morph_array, $html_file) {
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
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0"/>
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
		if (!($strongsclean=preg_replace("#^([HG]{1}[0-9]{1,5})([a-z]{0,1})$#ui","$1",$strongs))) { AION_ECHO("ERROR! $newmess bad strongs format\n".print_r($line,TRUE)); }
		if (preg_match("#^H90[2-4]{1}[0-9]{1}$#ui",$x) && !preg_match("#H:#ui",$lines[$x]['MORPH'])) { $lines[$x]['MORPH'] = "H:".$lines[$x]['MORPH']; } // fix line morphhology
		if (preg_match("#^".$line['WORD']."[,]*[ ]+(.+)$#ui",$line['DEF'],$match)) { $lines[$x]['DEF'] = $match[1]; } // fix if word same as def 1st word, then delete def first word
		$lines[$x]['STRONGS'] = $line['STRONGS'] = substr($line['STRONGS'],1); // wack off the first letter
		
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
	// end
	libxml_clear_errors();
	libxml_use_internal_errors($previous);
	// write the html file
	$html_html .= "</body>\n</html>\n";
	if (file_put_contents($html_file, $html_html) === FALSE ) { AION_ECHO("ERROR! file_put: ".$html_file ); }
	AION_ECHO("CHECK HTML debug file written: $html_file");
}


// build list of leixcon morphhologies
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
'N:A--LG'=>'Proper Name Adjective Gentilic Location',
'N:A--PG'=>'Proper Name Adjective Gentilic Person',
'N:ADV-T'=>'Proper Name Adverb',
'N:A'=>'Proper Name Adjective',
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
);
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
			if (!preg_match("#^([\d]{1,5})([a-z]{0,1})$#u", $strongs, $match)) {	AION_ECHO("ERROR! $newmess !preg_match(strongs=$strongs)"); }
			if ($strongs != $match[1]) { // mark the bald strongs number with all the extensions!
				$index[$match[1]] .= (empty($index[$match[1]]) ? $bytes : ','.$bytes );
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
function AION_NEWSTRONGS_GET_INDEX_LEX_CHECKER($index_file, $lexicon_file, $exception=FALSE) {
	$newmess = "INDEX_LEX_CHECKER $index_file";
	// read data
	$index = json_decode(file_get_contents($index_file), true);
	if (empty($index)) {														AION_ECHO("ERROR! $newmess !json_decode($index_file)"); }
	if (!($fd=fopen($lexicon_file, 'r'))) {										AION_ECHO("ERROR! $newmess !fopen($lexicon_file)"); }
	// loop through counts
	foreach($index as $strongs => $positions) {
		$positionsA = explode(",", $positions);
		// Exception for H2428 which has H2428 and H2428b, but no H2428a
		$extension = ($exception && $strongs=="2428" ? "[a-z]{0,1}" : (count($positionsA)>1 ? "[a-z]{1}" : ""));
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


// Greek leixon uStrongs and dStrongs merge
function AION_NEWSTRONGS_GET_UD($table,&$database) {
	foreach($database[$table] as $key => $entry) {
		if (empty($entry['STRONGU']) || empty($entry['STRONGD'])) { AION_ECHO("ERROR! STRONGU OR STRONGD Missing from $table strongs=".$entry['STRONGS']); }
		if (preg_match("#^[^=]+=(.+)$#u", $entry['STRONGU'], $match)) {
			$database[$table][$key]['STRONGU'] = trim($match[1])." ".preg_replace("#([GH]{1})[0]+(\d+)#u",'$1$2',trim($entry['STRONGD']));
		}
		else { $database[$table][$key]['STRONGU'] = NULL; }
		unset($database[$table][$key]['STRONGD']);
	}
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
		$definition = $osstrongs[$x]['strongs_def']."; ".$osstrongs[$x]['kjv_def']."; ".$osstrongs[$x]['derivation'];
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
		if (!($definition = preg_replace("#G([\d]+)#ui", 'g$1', $definition))) { AION_ECHO("ERROR! Strongs = $x Problem converting G to lowercase"); }
		if (!($definition = preg_replace("#H([\d]+)#ui", 'h$1', $definition))) { AION_ECHO("ERROR! Strongs = $x Problem converting H to lowercase"); }
		if (!($definition = preg_replace(
			"#([gh]{1}[\d]+)#ui",
			"<a href='/Strongs/strongs-\$1' title='Strongs Enhanced Concordance entry \$1' onclick='return AionianBible_Makemark(\"/Strongs\",\"/strongs-\$1\");'>\$1</a>",
			$definition))) {
			AION_ECHO("ERROR! Strongs = $x Problem converting strongs number to href links");
		}
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
// MY CODES
// W or K = next word
// Q = Qere entry for the previous Ketiv word NOTE!! there are D divided words in Q entries so not all D can begin a total new word block!!!!!
// P = word part, part of same word but parts have their own Strongs number and definition
// R = word root or related with distinct Strongs number and definition
// J = joined with previous word, though variants may not be joined
// D = next word, divided from previous, though variants may not be divided
// 
// Hebrew tagged text
// 1. Each line of the tagged text is the beginning of a new word, W or K if Ketiv
// 2. Except if line tagged Q it is associated with the previous K entry
// 3. Within one line multiple Strongs numbers joined with a '/' are parts of the same word, P
// 4. Within one line multiple Strongs numbers joined with a '//' are two words now joined, J
// 5. Within one line multiple Strongs numbers joined with a '/ /' or  '/_/' are a word now divided into separate words, D  
//
function AION_NEWSTRONGS_FIX_REF_HEBREW($input,$table,&$database, &$lex_array, $morph_array) {
	// INITIALIZE
	$lex2_array = array();
	$KetivQere_last = $last_indx = $last_chap = $last_vers = NULL;
	if (empty($database[$table])) {
		//INDX	BOOK	CHAP	VERS	NUMB	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	STRONGS	MORPH	EDITIONS	VAR1	VAR2	SPELL	EXTRA	CONJOIN	INSTANCE	ALTSTRONG
		$database[$table] = "INDX	BOOK	CHAP	VERS	JOIN	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	STRONGS	MORPH	EDITIONS	VAR1	VAR2	SPELL	EXTRA	CONJOIN\n";
	}
	
	// LOOP THRU ALL TAG LINES
	foreach( $input as $line ) {
		
		// GET WORD & MESSAGE
		$WORDUP = $line['UNDER'];
		$newmess = "FIX_REF\tHebrew\tref='{$line['BOOK']} {$line['CHAP']}:{$line['VERS']}>{$line['NUMB']}'\tword='$WORDUP'\tmorph='{$line['MORPH']}'\tstrongs='{$line['STRONGS']}'";

		// PARSE REFERENCE
		$book = $line['BOOK'];
		$database['BOOKS'][$book] = $book; // collect unique book names
		$indx = (int)$line['INDX'];
		$chap = (int)$line['CHAP'];
		$vers = (int)$line['VERS'];
		$numb = (int)$line['NUMB'];
		
		// CHECK SORT
		if ($last_indx && (
			($last_indx >  $indx) ||
			($last_indx <  $indx && ($last_indx+1 != $indx || 1 != $chap || 1 != $vers)) ||
			($last_indx == $indx && ($last_chap   >  $chap)) ||
			($last_indx == $indx &&  $last_chap   <  $chap && ($last_chap+1 != $chap || 1 != $vers)) ||
			($last_indx == $indx &&  $last_chap   == $chap &&  $last_vers+1 != $vers && $last_vers != $vers) ||
			($last_indx == $indx &&  $last_chap   == $chap &&  $last_vers   == $vers && $last_numb+1 != $numb)
			)) {
			AION_ECHO($warn="WARN! $newmess reference sort order problem!\n".print_r($line,TRUE)."\n\n\n");
			$database['WARNINGS'] .= $warn;			
		}
		$last_indx = $indx;
		$last_chap = $chap;
		$last_vers = $vers;
		$last_numb = $numb;
		
		// PARSE STRONGS AND MORPHS
		$jointype = "W"; // W=next word, Ketiv=written word, Qere=read word, P=word parts, R=Root or related, J=joined words, D=divided word
		$jointype_orig = $jointype;
		$wpart = mb_split("/", $WORDUP);
		$spart = mb_split("/", $line['STRONGS']);
		if (count($wpart) != count($spart)) {
			$database['CORRUPT_STRONGS'] .= ($warn="$newmess\tHebrew '/' dividers not equal, under=$part_word / strongs=$part_strg\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
		}
		$tpart = array_map('trim', mb_split("/", $line['TRANS']));
		$epart = array_map('trim', mb_split("/", $line['ENGLISH']));
		$mpart = array_map('trim', mb_split("/", $line['MORPH']));
		if (count($tpart) != count($epart) || count($tpart) != count($mpart)) {
			$database['CORRUPT_STRONGS'] .= ($warn="$newmess\tHebrew '/' dividers not equal, tran=$part_tran / english=$part_engl / morph=$part_morf\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
		}
		if (empty($mpart[0])) { // beware the few Qere with no morphhology
			$database['MISS_MORPHS'] .= ($warn="$newmess\tempty 1st part morph=".$line['MORPH']."\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
		}
		$letter = $mpart[0][0]; // Hebrew shares 1st letter of 1st morphhology with subsequent morphhologies

		// LOOP THRU HEBREW PARTS BY STRONG NUMBER
		foreach($spart as $key => $part) {
			// INIT
			$newmess = "FIX_REF\tHebrew\tref='".$line['REF']."'\tword='$WORDUP'\tmorph='".$line['MORPH']."'\tstrongs='".$line['STRONGS']."'";
			// AND FURTHER STRONGS PARSE INTO THREE: X=X=X»X
			$strongs_array = mb_split("=", $part);
			// reglue the 3rd component if 4 or more equals
			for($x=3; isset($strongs_array[$x]); $x++) {
				$strongs_array[2] .= ("=".$strongs_array[$x]);
				$database['CORRUPT_STRONGS'] .= ($warn="$newmess\tStrongs malformed with >3=\n");
				AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
			}
			$strongs = $strongs_array[0];
			$strongs_gloss = NULL;
			$strongs_gloss_punct = FALSE;
			$strongs_additional = NULL;
			// typically joined words parts, but sometimes divided parts into separate words
			// strongs //=joined, but variants divided, / / and /_/=divided, but variants joined, and /-/ Qere ignores Ketiv
			// W=next word, Ketiv=written word, Qere=read word, P=word parts, R=Root or related, J=joined words, D=divided word
			if ($strongs=="") {
				if (!preg_match("#//#ui",$WORDUP)) { AION_ECHO("ERROR! $newmess Found // in strongs BUT !word\n".print_r($line,TRUE)); }
				$jointype = "J";
				continue;
			}
			else if ($strongs==" " || $strongs=="_") {
				if (!preg_match("#/ /#ui",$WORDUP) && !preg_match("#/_/#ui",$WORDUP)) { AION_ECHO("ERROR! $newmess Found / / or /_/ in strongs BUT !word\n".print_r($line,TRUE)); }
				$jointype = "D";
				continue;
			}
			else if ($strongs=="-") {
				// Ketiv: in/ [the] hill country of = בְּ/הַר =H2022G = HR/Ncbsc ;
				if (!empty($WORDUP) ||
					!empty($line['TRANS']) ||
					$line['MORPH']!='-=' ||
					preg_match("#^Ketiv:\s+([^=]+)\s+=\s+([^= ]+)\s+=\s+([^= ]+)\s+=\s+([^= ]*) ;$#ui",$line['VAR1'], $match)) {
					AION_ECHO("ERROR! $newmess strongs='-' only for a few Ketiv!\n".print_r($line,TRUE));
				}
				$strongs = AION_NEWSTRONGS_STRONGS_PARSE($newmess, $match[3], FALSE, $lex_array, $lex2_array); // just check it
				if (count($strongs)>1) {
					AION_ECHO("ERROR! $newmess strongs='-' for Ketiv too many strongs!\n".print_r($line,TRUE));
				}
				$jointype = "K";
				$english = $match[1];
				$under = $match[2];
				$morph = ($match[4]=='HR/Ncbsc' ? 'HNcbsc' : $match[4]); // only one of this case when strongs=='-'
				$var1 = '';
				// Ketiv output with Qere omission!
				// INDX	BOOK	CHAP	VERS	JOIN	TYPE	UNDER	TRANS	LEXICON	ENGLISH	GLOSS	STRONGS	MORPH	EDITIONS	VAR1	VAR2	SPELL	EXTRA	CONJOIN
				$database[$table] .= "{$line['INDX']}	{$line['BOOK']}	{$line['CHAP']}	{$line['VERS']}	$jointype	{$line['TYPE']}	{$under}	{$line['TRANS']}	{$under}	{$english}		{$strongs[0]}	{$morph}	{$line['EDITIONS']}	{$var1}	{$line['VAR2']}	{$line['SPELL']}	Omitted by scribes	{$strongs[0]}\n";
				continue;
			}
			// hebrew and additional
			else {
				$strongs = trim($strongs);
				$part = trim($part);
				if ($strongs==$part) { AION_ECHO("ERROR! strongs==part impossible!\n".print_r($line,TRUE)); }
				if (!($strongs_hebrew = (empty($strongs_array[1]) ? NULL : trim($strongs_array[1])))) {
					AION_ECHO("WARN! Strongs empty Hebrew part $newmess\n".print_r($line,TRUE));
				}
				if (empty($strongs_array[2])) {
					AION_ECHO("WARN! Strongs empty English part $newmess\n".print_r($line,TRUE));
				}
				else if (preg_match("#^([^»]+)»(.+)$#ui", $strongs_array[2], $match) && ($strongs_gloss=trim($match[1]))) {
					if (($strongs_additional = $match[2])) {
						//»between:1_between
						//»to call:2_call_by;name
						//»LORD@Gen.1.1-Heb
						//»to see:1_see;show
						// parse pieces, clean, and remove duplication
						if (($pieces = mb_split("[:;]+", $strongs_additional))) {
							foreach($pieces as $key => $piece) { $pieces[$key] = trim($piece); }
							$pieces = array_flip(array_flip($pieces)); // values to keys, keys to values to remove duplicates.
							foreach($pieces as $key => $piece) { if ($piece==$strongs_gloss || $piece==$line['ENGLISH']) { unset($pieces[$key]); } }
							if (!empty($pieces)) { $strongs_additional = implode(": ", $pieces); }
						}
					}
				}
				else {
					$strongs_gloss = trim($strongs_array[2]);
				}
				// OKAY
				//	verseEnd :
				//	emph?
				// FIX
				//	obj.
				//	section
				//	link
				//	seq
				//	para
				if (preg_match("/^[[:punct:] ]+$/", $strongs_hebrew)) {
					$strongs_gloss = "[$strongs_gloss]";
					$strongs_gloss_punct = TRUE;
				}
			}
			// error check strongs format and return array!
			$strongs = AION_NEWSTRONGS_STRONGS_PARSE($newmess, $strongs, FALSE, $lex_array, $lex2_array);
			
			// MORPHS
			$morph = ($key==0 ? $mpart[0] : (empty($mpart[$key]) ? '' : $letter.$mpart[$key]));
			if (($key==0 && empty($mpart[0])) || (!empty($morph) && empty($morph_array[$morph]))) {
				$database['MISS_MORPHS'] .= ($warn="$newmess\tmissing morph='$morph'\n");
				AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
			}

			// TRANSLITERATION
			if (!($trans = (empty($tpart[$key]) ? '' : $tpart[$key])) && !$strongs_gloss_punct) {
				$warn="$newmess\tmissing transliteration\n";
				AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
			}

			// ENGLISH
			if (!($english = (empty($epart[$key]) ? '' : $epart[$key]))) {
				if ($strongs_gloss_punct) {
					$english = $strongs_hebrew;
				}
				else {
					$warn="$newmess\tmissing english piece\n";
					AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
				}
			}

			// construct the output
			foreach($strongs as $strong) {
				$database[$table] .= "{$line['INDX']}	{$line['BOOK']}	{$line['CHAP']}	{$line['VERS']}	{$jointype}	{$line['TYPE']}	{$line['UNDER']}	{$trans}	$strongs_hebrew	{$line['ENGLISH']}	$strongs_gloss	{$strong}	{$morph}	{$line['EDITIONS']}	{$line['VAR1']}	{$line['VAR2']}	{$line['SPELL']}	$strongs_additional	{$line['CONJOIN']}\n";				
				$jointype = "R";
			}
			unset($strongs); $strongs = NULL;
			// W=next word, Ketiv=written word, Qere=read word, P=word parts, R=Root or related, J=joined words, D=divided word
			$jointype = "P";
		}
	}
}


// parse the strongsid
function AION_NEWSTRONGS_STRONGS_PARSE($newmess, $strongs, $variant, &$lex_array, &$lex2_array) {
	// parse?
	// add logic to optionally include strongs extension [A-Z] and convert to lowercase or don't include
	if (FALSE===preg_match_all("#(.*?)([GH]{1}[\d]{1,5})([A-Za-z]{0,1})#u", $strongs, $parsed, PREG_SET_ORDER)) { AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs) !preg_match_all()"); }
	// totally empty
	if (empty($parsed)) { AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs) hey empty strongs!"); }
	// validate
	$strong_return = array();
	foreach($parsed as $x => $set) {
		// init
		$connector = $set[1];
		$strong = $set[2];
		$strongX = (empty($set[3]) ? NULL : $strong.strtolower($set[3]));
		// connectors okay?
		if ($x==0 && !empty($connector)) { AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs, strong=$strong) first connector not empty = '$connector'"); }
		else if ($x && !in_array($connector, ($variant ? array("«","+") : array("«") ))) { AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs, strong=$strong) invalid connector = '$connector'"); }
		// lexicon 1 entry?
		if ($strongX && !empty($lex_array[$strongX])) {	$strong_return[] = $strong = $strongX; }
		else if (!empty($lex_array[$strong])) {			$strong_return[] = $strong; }
		else if (!empty($lex_array[$strong.'a'])) {		$strong_return[] = $strong.'a'; }
		else {											AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs, strong=$strong/$strongX) not in lexicon"); } // not found
		$lex_array[$strong]['WORD'] = $lex_array[$strong]['TRANS'] = $lex_array[$strong]['MORPH'] = $lex_array[$strong]['DEF'] = NULL; // found
		// lexicon 2 entry?
		if (!empty($lex2_array)) {
			if (empty($lex2_array[$strong])) {			AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs, strong=$strong/$strongX) not in lexicon2"); } // not found
			$lex2_array[$strong]['WORD'] = $lex2_array[$strong]['TRANS'] = $lex2_array[$strong]['MORPH'] = $lex2_array[$strong]['DEF'] = NULL; // found
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
// MY CODES
// W or K = next word
// Q = Qere entry for the previous Ketiv word NOTE!! there are D divided words in Q entries so not all D can begin a total new word block!!!!!
// P = word part, part of same word but parts have their own Strongs number and definition
// J = joined with previous word, though variants may not be joined
// D = next word, divided from previous, though variants may not be divided
// 
// Greek tagged text
// 1. Each line of the tagged text is the beginning of a new word, W
// 2. Within one line a second Strong number joined with a '+' indicates a J
//
// Greek punctuation
//
// “.”  Full stop (low dot)
// “.¶” Full stop and paragraph end
// “·”  Semi-colon (high dot)
// “,”  Comma pause
// “;”  Question mark (only looks like semi-colon.  It is a unicode character.
// “;¶” Question mark and paragraph end
// ˹  Ἀμώς  ˺·  Punctuation out side the bracket, variant only concerns the word and not the punctuation
// "and will not honor his father << or his mother >>, anbd ..." the phrase "or his mother" is only found in some MSS, but they all have a comma, so the comma is outside the brackets. 
//
// =NA same TR					133304 words are translated in both traditional KJV and modern Bibles.			NA27/28 + TR + others all having the same meaning				
// =NA diff TR					3922 words may translate differently in traditional and modern Bibles.			NA27/28 + others having the same meaning but there are.also .. 	| Variants = different meanings in TR + others
// =NA not TR					761 words are translated in most modern Bibles but not in the KJV.				NA27/28 + others having the same meaning but not TR				
// =TR+NIV/ESV not NA			227 words are translated in the KJV and in some modern Bibles.					TR + others having the same meaning but not NA27/28				
// =TR not NA,NIV/ESV			3573 words are translated in the KJV but not in most modern Bibles.				TR + others having the same meaning but not NA27/28				
// Not in NA or TR				245 words occur in early manuscripts but not translated in most Bibles.			Others having a word that is not found in TR or NA27/28	
// 
//
// M + T + O	 133565 words translated in traditional (eg KJV) and modern Bibles (eg ESV, NIV).	NA27/28+TR+other editions all have this same word		633 variants in other editions
// M+(T)(+O)	 4164 words that might be translated differently in traditional and modern Bibles.	NA27/28 has a word that differs from TR and perhaps others		3147 variants in TR and 59 in others
// T (+O)	 3958 words that are translated in the KJV but not in most modern Bibles.	TR   has a word that is not present in NA27 nor usually in others		38 variants in other editions
// M (+O)	 934 words that are translated in most modern Bibles but not in the KJV.	NA27 has a word that is not present in TR   nor usually in others		12 variants in other editions
//  = not in NA nor TR	 289 words occuring in other editions that are rarely translated in Bibles.	Some editions have a word that is not present in TR or NA27/28	
//
// Variant markers
//  ¦ indicates the difference CAN'T be expressed in the translation - in English, at least. 
//  | indicates the difference MIGHT be expressed in the translation, but one can't look at a translation and decide which Greek variant it followed
//  ‖ indicates that difference SHOULD be expressed in the translation, so by looking at a translation, one can decide which Greek variant it followed
// 
function AION_NEWSTRONGS_FIX_REF_GREEK($input, $table, &$database, &$lex_array, &$lex2_array, $morph_array) {
	// INITIALIZE
	static $vartrans = NULL;
	if (!$vartrans) {
		$vartrans = array(
			"Byz"		=> "Byzantine from Robinson/Pierpoint",
			"Coptic"	=> "Coptic",
			"ESV"		=> "English Standard Version",
			"Goodnews"	=> "Goodnews",
			"KJV"		=> "King James Version",
			"NA26"		=> "Nestle/Aland 26th Edition",
			"NA27"		=> "Nestle/Aland 27th Edition",
			"NA28"		=> "Nestle/Aland 28th Edition, not ECM",
			"NIV"		=> "New International Version",
			"OldLatin"	=> "Old Latin",
			"OldSyriac"	=> "Old Syriac version",
			"P66"		=> "Papyri #66",
			"P66*"		=> "Papyri #66 corrector",
			"Punc"		=> "Accent variant from punctuation",
			"SBL"		=> "Society of Biblical Literature Greek NT",
			"TR"		=> "Textus Receptus",
			"Treg"		=> "Tregelles",
			"Tyn"		=> "Tyndale House GNT",
			"U1"		=> "Uncial #1",
			"U2"		=> "Uncial #2",
			"U3"		=> "Uncial #3",
			"U4"		=> "Uncial #4",
			"U5"		=> "Uncial #5",
			"U6"		=> "Uncial #6",
			"U32"		=> "Uncial #32",
			"WH"		=> "Westcott/Hort",
		);
	}
	$last_indx = $last_chap = $last_vers = NULL;
	if (empty($database[$table])) {
		$database[$table] = "INDEX\tBOOK\tCHAPTER\tVERSE\tSTRONGS\tFLAG\tMORPH\tWORD\tENGLISH\tENTRY\tPUNC\tEDITIONS\tVARIATION1\tVARIATION2\tADDITIONAL\tCONJOIN\tOCCUR\tALT\n";
	}
	$strongs_counts = array();
	$last = NULL;
	
	// LOOP THRU ALL LINES
	//array('REF','','TYPE','WORD','ENGLISH','STRONGS','','EDITIONS','MEANING2','MEANING3','','ADDITIONAL','CONJOIN'),
	// Mat.001.001	01	M + T + O	Βίβλος (Biblos)	[The] book	G0976=N-NSF	βίβλος=book	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz			Libro	book	
	// Mat.001.001	02	M + T + O	γενέσεως (geneseōs)	of [the] genealogy	G1078=N-GSF	γένεσις=origin	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz			de origen	origin	
	// Mat.001.001	03	M + T + O	Ἰησοῦ (Iēsou)	of Jesus	G2424G=N-GSM-P	Ἰησοῦς=Jesus/Joshua	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz			de Jesús	Jesus»Jesus|Jesus@Mat.1.1	
	// Mat.001.001	04	M + T + O	Χριστοῦ (Christou)	Christ	G5547=N-GSM-T	Χριστός=Christ	NA28+NA27+Tyn+SBL+WH+Treg+TR+Byz			Ungido	Christ»Christ|Jesus@Mat.1.1	
	static $act1940 = 0;
	static $cor1312 = 0;
	foreach( $input as $line ) {
		// skip empty
		if (empty(implode("",$line))) { continue; }

		// Custom reversification, change the reference of the original Greek edition to the KJV standard, only when outside KJV references
		if ($line['REF'] == '3Jn.001.015') {		$line['REF'] = '3Jn.001.014'; }
		else if ($line['REF'] == 'Rev.012.018') {	$line['REF'] = 'Rev.013.001'; }
		else if ($line['REF'] == 'Act.019.040') {	++$act1940; if ($act1940>21) { $line['REF'] = 'Act.019.041'; } }
		else if ($line['REF'] == '2Co.013.012') {	++$cor1312;	if ($cor1312>5) { $line['REF'] = '2Co.013.013'; } }
		else if ($line['REF'] == '2Co.013.013') {	$line['REF'] = '2Co.013.014'; }
		
		// INIT
		$WORDUP = trim($line['WORD']);
		$WORDYEP = trim($line['DICTIONARY']);
		$newmess = "FIX_REF\tref='".$line['REF']."'\tword='$WORDUP'\tmorph='".$line['MORPH']."'\tstrongs='".$line['STRONGS']."'";

		// Check and fix!
		$line['ENGLISH'] = trim($line['ENGLISH']);
		if (preg_match("#^[^<]*<[^>]*$#u", $line['ENGLISH']) ||
			preg_match("#^[^(]*\([^)]*$#u", $line['ENGLISH']) ||
			preg_match("#^[^[]*\[[^\]]*$#u", $line['ENGLISH'])
			) {
			AION_ECHO($warn="WARN! $newmess suspect tag in English word\n".print_r($line,TRUE)."\n\n\n");
			$database['WARNINGS'] .= $warn;

		}
		// specific fixes
		if ($line['ENGLISH']=='(only') { $line['ENGLISH']='only'; }
		else if ($line['ENGLISH']=='[8.1] And') { $line['ENGLISH']='And'; }
		else if ($line['ENGLISH']=='[8b] all') { $line['ENGLISH']='all'; }
		else if ($line['ENGLISH']=='you [pl.] may pray,') { $line['ENGLISH']='you may pray,'; }
		else if ($line['ENGLISH']=='you [pl.] will be') { $line['ENGLISH']='you will be'; }
		if (!($line['ENGLISH'] = preg_replace("/</us",'(',$line['ENGLISH']))) { AION_ECHO("ERROR! REF_GREEK() preg_replace(".$line['ENGLISH']); }
		if (!($line['ENGLISH'] = preg_replace("/>/us",')',$line['ENGLISH']))) { AION_ECHO("ERROR! REF_GREEK() preg_replace(".$line['ENGLISH']); }

		// SPACE MORPH
		$line['MORPH'] = preg_replace("/ /u", '',($morph_before=$line['MORPH'])); // remove unexpected spaces
		if ($line['MORPH']!=$morph_before) {
			$database['MISS_MORPHS'] .= ($warn="$newmess\tspace morph=".$line['MORPH']."\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
		}

		// TAGNT entry type
		$entry = $line['TYPE'];
		if (!preg_match('#^(M|MO|MT|MTO|MTo|Mo|MtO|Mto|O|T|TO|To|tO)$#', $entry)) {							AION_ECHO("ERROR! $newmess word type missing\n".print_r($line,TRUE)); }

		// PARSE REFERENCE
		$book = $line['BOOK'];
		$database['BOOKS'][$book] = $book; // unique book names
		$indx = $line['INDX'];
		$chap = $line['CHAP'];
		$vers = $line['VERS'];
		$numb = $line['NUMB'];

		// OCCURRENCE # of STRONGS? ERROR CHECK
		if ((int)$vers != (int)$last_vers) {
			foreach($strongs_counts as $key => $check) {
				if (1==$check) { AION_ECHO($warn="WARN! FIX_REF\tref='{$last['REF']}' Strong order sequence error, one but no two of strongs={$key}!\n".print_r($last,TRUE)."\n".print_r($strongs_counts,TRUE)."\n\n\n"); }
			}
			$strongs_counts = array();
		}

		// Sorted properly?
		if ($last_indx && (
			($last_indx >  (int)$indx) ||
			($last_indx <  (int)$indx && ($last_indx+1 != (int)$indx || 1 != (int)$chap || 1 != (int)$vers)) ||
			($last_indx == (int)$indx &&  $last_chap >  (int)$chap) ||
			($last_indx == (int)$indx &&  $last_chap <  (int)$chap && ($last_chap+1 != (int)$chap || 1 != (int)$vers)) ||
			($last_indx == (int)$indx &&  $last_chap == (int)$chap &&  $last_vers+1 != (int)$vers && $last_vers != (int)$vers) ||
			($last_indx == (int)$indx &&  $last_chap == (int)$chap &&  $last_vers == (int)$vers &&   $last_numb+1 != (int)$numb)
			)) {
			AION_ECHO($warn="WARN! $newmess reference sort order problem!\n".print_r($line,TRUE)."\n\n\n");
			$database['WARNINGS'] .= $warn;			
		}
		$last_indx = (int)$indx;
		$last_chap = (int)$chap;
		$last_vers = (int)$vers;
		$last_numb = (int)$numb;
		
		// SKIP EMPTY AND PUNCTUATION
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
		if (empty($mpart[0])) {
			$database['MISS_MORPHS'] .= ($warn="$newmess\tempty 1st part morph=".$line['MORPH']."\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
		}

		// LOOP THRU PARTS
		foreach($spart as $key => $part) {
			// INIT
			$newmess = "FIX_REF\tref='".$line['REF']."'\tword='$WORDUP'\tmorph='".$line['MORPH']."'\tstrongs='".$line['STRONGS']."'";

			// STRONGS
			$strongs = $part;
			
			// error check strongs format
			$strongs = AION_NEWSTRONGS_STRONGS_PARSE($newmess, $strongs, FALSE, $lex_array, $lex2_array);
			if (count($strongs)>1) { AION_ECHO("ERROR! $newmess More than one Greek Strongs!\n".print_r($line,TRUE)); }
			$strongs = $strongs[0]; // return an array for Hebrew, but only one here!

			// OCCURRENCE # of STRONGS?
			static $occurmap= array('A'=>'1st','B'=>'2nd','C'=>'3rd','D'=>'4th','E'=>'5th','F'=>'6th','G'=>'7th','H'=>'8th','I'=>'9th','J'=>'10th','K'=>'11th','L'=>'12th','M'=>'13th',
			'N'=>'14th','O'=>'15th','P'=>'16th','Q'=>'17th','R'=>'18th','S'=>'19th','T'=>'20th','U'=>'21st','V'=>'22nd','W'=>'23rd','X'=>'24th','Y'=>'25th','Z'=>'26th');
			$occur = 'once';
			$match = NULL;
			if (preg_match("#{$strongs}_([a-zA-Z]{1})#u", $line['OCCUR'], $match)) {
				$occur = (empty($occurmap[strtoupper($match[1])]) ? 'multiple' : $occurmap[strtoupper($match[1])]);
				if (ctype_lower($match[1])) { $occur .= ' (varied)'; }
			}
			if ($line['REF']=='2Co.013.012' || $line['REF']=='2Co.013.013' || $line['REF']=='Rev.013.001') {
				$occur = NULL;
			}
			if (!empty($match[1]) && !empty($occurmap[strtoupper($match[1])])) {
				$occurdig = (int)$occurmap[strtoupper($match[1])];
				if (empty($strongs_counts[$strongs])) { if (1 != $occurdig) { AION_ECHO($warn="WARN! $newmess Strong order sequence error, two but no one! $strongs > $occurdig\n".print_r($line,TRUE)."\n\n\n"); } }
				else if ($strongs_counts[$strongs] + 1 != $occurdig) { AION_ECHO($warn="WARN! $newmess Strong order sequence error, missed sequence! $strongs > $occurdig\n".print_r($line,TRUE)."\n\n\n"); }
				$strongs_counts[$strongs] = $occurdig;
			}
			if (preg_match("#(G\d+)[A-Z]{0,1}_([a-zA-Z]{1})#u", $line['VARIATION1'], $match) && $strongs!=$match[1]) {
				$occurdig = (int)$occurmap[strtoupper($match[2])];
				if (empty($strongs_counts[$match[1]])) { if (1 != $occurdig) { AION_ECHO($warn="WARN! $newmess Strong order sequence error, two but no one! $match[1] > $occurdig\n".print_r($line,TRUE)."\n\n\n"); } }
				else if ($strongs_counts[$match[1]] + 1 != $occurdig) { AION_ECHO($warn="WARN! $newmess Strong order sequence error, missed sequence! $match[1] > $occurdig\n".print_r($line,TRUE)."\n\n\n"); }
				$strongs_counts[$match[1]] = $occurdig;
			}
			if (preg_match("#(G\d+)[A-Z]{0,1}_([a-zA-Z]{1})#u", $line['VARIATION2'], $match) && $strongs!=$match[1]) {
				$occurdig = (int)$occurmap[strtoupper($match[2])];
				if (empty($strongs_counts[$match[1]])) { if (1 != $occurdig) { AION_ECHO($warn="WARN! $newmess Strong order sequence error, two but no one! $match[1] > $occurdig\n".print_r($line,TRUE)."\n\n\n"); } }
				else if ($strongs_counts[$match[1]] + 1 != $occurdig) { AION_ECHO($warn="WARN! $newmess Strong order sequence error, missed sequence! $match[1] > $occurdig\n".print_r($line,TRUE)."\n\n\n"); }
				$strongs_counts[$match[1]] = $occurdig;
			}

			// MORPHS
			$morph = trim(($key==0 ? $mpart[0] : (empty($mpart[$key]) ? "Unknown" : $mpart[$key])));
			if (empty($morph) || empty($morph_array[$morph])) {
				$database['MISS_MORPHS'] .= ($warn="$newmess\tmissing morph=$morph key=$key mpart[key]=".$mpart[$key]."\n");
				AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
			}
			// Editions
			$editions = explode('+', trim(preg_replace('/^0(\d+)/', '+U$1', preg_replace('/\+0(\d+)/', '+U$1', preg_replace('/[[:punct:]]+/', '+', preg_replace('/[<>]+\d+[:]+/', '+', preg_replace('/<14\.(24|25|26):/', '+', preg_replace('/\s+/', '', $line['EDITIONS'])))))),';+, '));
			if (($editions_diff=array_diff($editions, array_keys($vartrans)))) {
				$database['MISS_MANU'] .= ($warn="$newmess\tmissing manuscript edition: ".implode(",",$editions_diff)." from editions=".$line['EDITIONS']."\n");
				AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");	
			}
			$editions = trim(preg_replace('/[+]+/', '+', preg_replace('/\s+/', '', $line['EDITIONS'])),";+, ");
			
			// Meaning processor
			if (empty($line['MEANINGS'])) {
				$meanings = NULL;
			}
			else {
				// parse the meanings
				if (!($meanarray=preg_split("/(¦|\||‖)/", $line['MEANINGS']))) {
					AION_ECHO("ERROR! $newmess problem parsing MEANINGS 1\n".print_r($line,TRUE));	
				}
				foreach($meanarray as $mean) {
					if (empty($mean)) { continue; }
					//TR+Byz+NIV = ἀμών = "Amon," = G300 = N-ASM-P
					if (!preg_match("#^([^=]+)[=]+([^=]+)[=]+([^=]+)[=]+([^=]+)[=]+([^=]+)$#u",$mean,$match)) {
						AION_ECHO("ERROR! $newmess problem parsing MEANINGS 2\nmeaning='$mean'\nmeanarray=\n".print_r($meanarray,TRUE)."\n".print_r($line,TRUE));
					}
					// editions?
					$editionsM = explode('+', trim(preg_replace('/^0(\d+)/', '+U$1', preg_replace('/\+0(\d+)/', '+U$1', preg_replace('/[[:punct:]]+/', '+', preg_replace('/[<>]+\d+[:]+/', '+', preg_replace('/<14\.(24|25|26):/', '+', preg_replace('/\s+/', '', $match[1])))))),';+, '));
					if (($editions_diff=array_diff($editionsM, array_keys($vartrans)))) {
						$database['MISS_MANU'] .= ($warn="$newmess\tmissing manuscript edition: ".implode(",",$editions_diff)." from editions=".$match[1]."\n");
						AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");	
					}
					// strongs?
					AION_NEWSTRONGS_STRONGS_PARSE($newmess, trim($match[4]), TRUE, $lex_array, $lex2_array);
					// morph?
					if (empty($match[5])) {
						$database['MISS_MORPHS'] .= ($warn="$newmess\tmeaning missing morph='".$match[5]."'\n");
						AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
					}
					else {
						$mpartsX = mb_split("[/+]{1}", $match[5]);
						foreach($mpartsX as $mpartX) {
							if (empty($mpartX) || empty($morph_array[trim($mpartX)])) {
								$database['MISS_MORPHS'] .= ($warn="$newmess\tmeaning missing morph='$mpartX'\n");
								AION_ECHO("WARN! $warn".print_r($line,TRUE)."\n\n\n");
							}
						}
					}
				}
				// reassign delimiters
				// “|VC ”  - ¦ indicates the difference CAN'T be expressed in the translation - in English, at least. 
				// “|VM ”  - | | indicates the difference MIGHT be expressed in the translation, but one can't look at a translation and decide which Greek variant it followed
				// “|VS ”  - ‖ indicates that difference SHOULD be expressed in the translation, so by looking at a translation, one can decide which Greek variant it followed
				$meanings = trim(preg_replace('/¦\s*/','|VC ', preg_replace('/\|\s*/','|VM ', preg_replace('/‖\s*/','|VS ', $line['MEANINGS']))));
			}
			
			// construct the output
			// The Greek and Hebrew columns need to be similar because same functions process first columns of Greek and Hebrew
			// INDEX	BOOK	CHAPTER	VERSE	STRONGS	FLAG	MORPH	WORD
			//$database[$table] = "INDEX\tBOOK\tCHAPTER\tVERSE\tSTRONGS\tFLAG\tMORPH\tWORD\tENGLISH\tENTRY\tPUNC\tEDITIONS\tSPELLINGS\tMEANINGS\tADDITIONAL\tCONJOIN\n";
			//
			$database[$table] .=
				("$indx\t$book\t$chap\t$vers\t$strongs\t$jointype\t$morph\t$WORDYEP\t".
				$line['ENGLISH']."\t".
				$entry."\t".
				$WORDUP."\t".
				"$editions\t".
				$line['VARIATION1']."\t".
				$line['VARIATION2']."\t".
				trim($line['ADDITIONAL'])."\t".
				trim($line['CONJOIN'])."\t".
				"$occur\t".
				trim($line['ALT'])."\n");
			// W=next word, J=joined words
			$jointype = "J";
		}
		$last = $line;
	}
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
		if (!preg_match("#^(\d+)\t([A-Z0-9]+)\t(\d+)\t(\d+)\t([GH]{1})([\d]{1,5})([a-z]{0,1})\t#u", $line, $match)) {	AION_ECHO("ERROR! $newmess corrupt hebrew/greek ref\n".print_r($line,TRUE)); }
		$indx = $match[1];
		$chap = $match[3];
		$vers = $match[4];
		// not the last line
		if ("0"!=$indx) {
			$snum = $match[6];
			$sext = $match[7];
			// mark the strong number, even without the extension
			$book_array[$snum] = $chap_array[$snum] = TRUE;
			$vers_array[$snum] += 1;
			// also mark the extension
			if (!empty($sext)) {
				$book_array[$snum.$sext] = $chap_array[$snum.$sext] = TRUE;
				$vers_array[$snum.$sext] += 1;
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
		if (!preg_match("#^(\d+)\t([A-Z0-9]+)\t(\d+)\t(\d+)\t([GH]{1})([0-9]{1,5})([a-z]{0,1})#u", $line, $match)) {	AION_ECHO("ERROR! $newmess corrupt ref\n".print_r($line,TRUE)); }
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
			if (!preg_match("#[\d]{1,5}[a-z]{0,1}#u", $strongs)) {								AION_ECHO("ERROR! $newmess !preg_match(strongs=$strongs)"); }
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
	$newmess = "COUNT_REF_CHECKER $counts";
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
		if ($begin4 && !($sourceT=preg_replace("/^.*?$begin4/us",$begin4,$sourceT,-1,$count)) || $count!=1) {	AION_ECHO("ERROR! $newmess $source4 no beginning='$begin4' $count"); }
		if ($end4   && !($sourceT=preg_replace("/$end4.*$/us","",$sourceT,-1,$count)) || $count!=1) {			AION_ECHO("ERROR! $newmess $source4 no ending='$end4' $count"); }
		$source .= $sourceT;
	}
	unset($sourceT);
	// remove comments first
	if ((!$source=preg_replace("/^#.*$/um", "", $source))) {
		AION_ECHO("ERROR! $newmess problem removing comments");
	}
	// save the file if requested / only needed for debugging the count checker
	if ($save && $file && !file_put_contents($file, $source)) {													AION_ECHO("ERROR! $newmess !file_put_contents($file)"); }
	// loop through counts
	foreach($counts as $strongs => $numbers) {
		if ($strongs == "0") { continue; }
		if (FALSE===preg_match("#^([0-9]{1,5})([a-z]{0,1})$#u", $strongs, $match)) { AION_ECHO("ERROR! $newmess !preg_match()"); }
		$strongs = $letter.sprintf('%04d',$match[1]).$match[2];
		if ($letter=='H') {
			if (FALSE===preg_match_all("#($strongs)[^\d]{1}#u", $source, $parsed, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess !preg_match_all()"); } // to avoid Greek conjoined strongs #s, [^:]{1} or (?<!:)
		}
		else {
			if (FALSE===preg_match_all("#\n[^\t]+\t[^\t]+\t[^\t]+\t[^\t]+\t[^\t]+\t[^\t]*($strongs)[^\d]{1}#u", $source, $parsed, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess !preg_match_all()"); } // to avoid Greek conjoined strongs #s, [^:]{1} or (?<!:)
		}
		if ($numbers[3] != ($found=count($parsed[1]))) {
			AION_ECHO("WARN! $newmess count mismatch (Greek strong+strong with meaning strong refs doubled?) for $strongs: $numbers[3] != $found");
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
	define($table, $table);
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
	define($table, $table);
	$result[$table] = array();
	$blockcount = 0;
	$morph = '';
	$count=0;
	$function = '';
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
function AION_NEWSTRONGS_STEPBIBLE($hebtag,$hebdex,$heblex,$gretag,$gredex,$grelex,$bible_ama,$bible_con,$bible_num) {
	// setup
	$newmess = "STEPBIBLE\t$bible_ama";
	mb_regex_encoding("UTF-8");
	mb_internal_encoding("UTF-8");	
	$bibledata_ama = "// STEPBible Amalgamant, compiled by ABCMS (alpha)\n\n";
	$bibledata_con = "// STEPBible Concordant, compiled by ABCMS (alpha)\n\n";
	$bibledata_num = "// STEPBible StrongsNum, compiled by ABCMS (alpha)\n\n";
	
	// HEBREW open tag, lex index, and lex
	if (($contents = file_get_contents( $hebtag )) === FALSE) { 	AION_ECHO("ERROR! $newmess !file_get_contents($hebtag)"); }
	$index = json_decode(file_get_contents($hebdex), true);
	if (empty($index)) {											AION_ECHO("ERROR! $newmess !json_decode($hebdex)"); }
	if (!($fd=fopen($heblex, 'r'))) {								AION_ECHO("ERROR! $newmess !fopen($heblex)"); }
	// hebrew loop tags
	$last_book = "XXX"; $last_vers = 0;
	$line = strtok($contents, "\n");
	while ($line !== false) {
		if (!ctype_digit($line[0])) { $line = strtok( "\n" ); continue; }
		//INDEX	BOOK	CHAPTER	VERSE	STRONGS	FLAG	MORPH	WORD	ENGLISH	PART	ADDITIONAL
		if (!preg_match("#^(\d+)\t([A-Z0-9]+)\t(\d+)\t(\d+)\t([GH]{1})([0-9]{1,5}[a-z]{0,1})\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t#u", $line, $match)) {	AION_ECHO("ERROR! $newmess corrupt ref tag\n".print_r($line,TRUE)); }
		$book = $match[2]; $chap = (int)$match[3]; $vers = (int)$match[4]; $strg = $match[6]; $flag = $match[7]; $amal = $match[10];
		if ($flag=="R") { $line = strtok( "\n" ); continue; }
		$book = strtoupper($book); if (!ctype_digit($book[0])) { $book[1] = strtolower($book[1]); } $book[2] = strtolower($book[2]);
		if ($book != $last_book) { AION_ECHO("BUILDING Concordant STEPBible! $book"); $last_book = $book; }
		if ($vers != $last_vers) {
			$bibledata_ama .= "\n$book $chap:$vers "; $last_vers = $vers;
			$bibledata_con .= "\n$book $chap:$vers "; $last_vers = $vers;
			$bibledata_num .= "\n$book $chap:$vers "; $last_vers = $vers;
		}
		// lexicon entry
		if ($strg=="0") { $line = strtok( "\n" ); continue; }
		if (empty($index[$strg])) { 								AION_ECHO("ERROR! $newmess lex dex not found: $line"); }
		if (fseek($fd, $index[$strg]) || !($entry=fgets($fd)) ||
			!preg_match("#^$strg\t#u",$entry)) {					AION_ECHO("ERROR! $newmess dex lex not found, index=".$index[$strg].": $line, $entry"); }
		$defs = explode("\t",$entry);
		$bibledata_ama .= (" ".$amal);
		$bibledata_con .= (" ".$defs[3]);
		$bibledata_num .= (" ".$strg);
		$line = strtok( "\n" );
	}
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
	$last_wtype = "MTO";
	$line = strtok($contents, "\n");
	while ($line !== false) {
		if (!ctype_digit($line[0])) { $line = strtok( "\n" ); continue; }
		//INDEX	BOOK	CHAPTER	VERSE	STRONGS	FLAG	MORPH	WORD	ENGLISH	ENTRY	PUNC	EDITIONS	VARIATION1	VARIATION2	ADDITIONAL	CONJOIN
		if (!preg_match("#^(\d+)\t([A-Z0-9]+)\t(\d+)\t(\d+)\t([GH]{1})([0-9]{1,5}[a-z]{0,1})\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t#u", $line, $match)) {	AION_ECHO("ERROR! $newmess corrupt ref tag\n".print_r($line,TRUE)); }
		$book = $match[2]; $chap = (int)$match[3]; $vers = (int)$match[4]; $strg = $match[6]; $flag = $match[7]; $amal = $match[10]; $wtype = $match[11];
		if ($flag=="R") { $line = strtok( "\n" ); continue; }
		$book = strtoupper($book); if (!ctype_digit($book[0])) { $book[1] = strtolower($book[1]); } $book[2] = strtolower($book[2]);
		if ($book != $last_book) { AION_ECHO("BUILDING Concordant STEPBible! $book"); $last_book = $book; }
		if ($vers != $last_vers) {
			$wtype_close = ($last_wtype=="MTO" ? "" : " *$last_wtype)");
			$bibledata_ama .= ("$wtype_close\n$book $chap:$vers ");
			$bibledata_con .= ("$wtype_close\n$book $chap:$vers ");
			$bibledata_num .= ("$wtype_close\n$book $chap:$vers ");
			$last_vers = $vers;
			$last_wtype = "MTO";
		}
		// skip lines
		if ($strg=="0") { $line = strtok( "\n" ); continue; }
		// lexicon entry
		if (empty($index[$strg])) { 								AION_ECHO("ERROR! $newmess lex dex not found: $line"); }
		if (fseek($fd, $index[$strg]) || !($entry=fgets($fd)) ||
			!preg_match("#^$strg\t#u",$entry)) {					AION_ECHO("ERROR! $newmess dex lex not found, index=".$index[$strg].": $line, $entry"); }
		$defs = explode("\t",$entry);
		$word = $defs[3];
		// TAGNT entry type
		// "M" => "Modern Bibles only, not KJV and other Bibles",
		// "MO" => "Modern and other Bibles, not KJV Bible",
		// "MT" => "Modern and KJV Bibles, not other Bibles",
		// "MTO" => "Modern, KJV, and other Bibles",
		// "MTo" => "Modern and KJV Bibles, variants in other Bibles",
		// "Mo" => "Modern Bibles, variants in other Bibles, not KJV Bible",
		// "MtO" => "Modern and other Bibles, variants in KJV Bible",
		// "Mto" => "Modern Bibles, variants in KJV and other Bibles",
		// "O" => "Other Bibles only, not modern and KJV Bibles",
		// "T" => "KJV Bible only, not modern and other Bibles",
		// "TO" => "KJV and other Bibles only, not modern Bibles",
		// "To" => "KJV Bible, variants in other Bibles, not modern bibles",
		if ($wtype==$last_wtype) {			$wtype_close = "";					$wtype_open = " "; }
		else if ($wtype=="MTO") {			$wtype_close = " *$last_wtype)";	$wtype_open = " "; }
		else  if ($last_wtype!="MTO") { 	$wtype_close = " *$last_wtype)";	$wtype_open = " (* "; }
		else {							 	$wtype_close = "";					$wtype_open = " (* "; }
		$last_wtype = $wtype;
		// build the bible word by word
		$bibledata_ama .= "$wtype_close$wtype_open$amal";
		$bibledata_con .= "$wtype_close$wtype_open$word";
		$bibledata_num .= "$wtype_close$wtype_open$strg";
		$line = strtok( "\n" );
	}
	// last wtype
	$wtype_close = ($last_wtype=="MTO" ? "" : " *$last_wtype)");
	$bibledata_ama .= ("$wtype_close\n");
	$bibledata_con .= ("$wtype_close\n");	
	$bibledata_num .= ("$wtype_close\n");
	// close
	fclose($fd);
	unset($contents); $contents=NULL;
	unset($index); $index=NULL;

	// OKAY
	//	verseEnd :
	//	emph?
	// FIX
	//	obj.
	//	section
	//	link
	//	seq
	//	para	
	if (!($bibledata_ama=preg_replace("#\[obj\.\]#ui", "[obj]", $bibledata_ama))) {				AION_ECHO("ERROR! $newmess: preg_replace([obj])"); }
	if (!($bibledata_con=preg_replace("#\[obj\.\]#ui", "[obj]", $bibledata_con))) {				AION_ECHO("ERROR! $newmess: preg_replace([obj])"); }	

	if (!($bibledata_ama=preg_replace("#obj\.#ui", "[obj]", $bibledata_ama))) {					AION_ECHO("ERROR! $newmess: preg_replace([obj])"); }
	if (!($bibledata_con=preg_replace("#obj\.#ui", "[obj]", $bibledata_con))) {					AION_ECHO("ERROR! $newmess: preg_replace([obj])"); }

	if (!($bibledata_ama=preg_replace("#\bsection\b#ui", "[section]", $bibledata_ama))) {		AION_ECHO("ERROR! $newmess: preg_replace([section])"); }
	if (!($bibledata_con=preg_replace("#\bsection\b#ui", "[section]", $bibledata_con))) {		AION_ECHO("ERROR! $newmess: preg_replace([section])"); }

	if (!($bibledata_ama=preg_replace("#\blink\b#ui", "[link]", $bibledata_ama))) {				AION_ECHO("ERROR! $newmess: preg_replace([link])"); }
	if (!($bibledata_con=preg_replace("#\blink\b#ui", "[link]", $bibledata_con))) {				AION_ECHO("ERROR! $newmess: preg_replace([link])"); }

	if (!($bibledata_ama=preg_replace("#\bseq\b#ui", "[seq]", $bibledata_ama))) {				AION_ECHO("ERROR! $newmess: preg_replace([seq])"); }
	if (!($bibledata_con=preg_replace("#\bseq\b#ui", "[seq]", $bibledata_con))) {				AION_ECHO("ERROR! $newmess: preg_replace([seq])"); }

	if (!($bibledata_ama=preg_replace("#\bpara\b#ui", "[para]", $bibledata_ama))) {				AION_ECHO("ERROR! $newmess: preg_replace([para])"); }
	if (!($bibledata_con=preg_replace("#\bpara\b#ui", "[para]", $bibledata_con))) {				AION_ECHO("ERROR! $newmess: preg_replace([para])"); }

	if (!($bibledata_ama=preg_replace("#\|#u", "/", $bibledata_ama))) {							AION_ECHO("ERROR! $newmess: preg_replace(slash)"); }	
	if (!($bibledata_con=preg_replace("#\|#u", "/", $bibledata_con))) {							AION_ECHO("ERROR! $newmess: preg_replace(slash)"); }

	if (!($bibledata_ama=preg_replace("#[\t ]+#u", " ", $bibledata_ama))) {						AION_ECHO("ERROR! $newmess: preg_replace(spaces)"); }	
	if (!($bibledata_con=preg_replace("#[\t ]+#u", " ", $bibledata_con))) {						AION_ECHO("ERROR! $newmess: preg_replace(spaces)"); }
	if (!($bibledata_num=preg_replace("#[\t ]+#u", " ", $bibledata_num))) {						AION_ECHO("ERROR! $newmess: preg_replace(spaces)"); }

	if (!($bibledata_ama=preg_replace("#<the>#ui", "[the]", $bibledata_ama))) {					AION_ECHO("ERROR! $newmess: preg_replace(the)"); }	
	if (!($bibledata_con=preg_replace("#<the>#ui", "[the]", $bibledata_con))) {					AION_ECHO("ERROR! $newmess: preg_replace(the)"); }
	
	// write the Bible
	if (file_put_contents($bible_ama,$bibledata_ama) === FALSE ) {								AION_ECHO("ERROR! $newmess file_put_contents($bible_ama)" ); }
	if (file_put_contents($bible_con,$bibledata_con) === FALSE ) {								AION_ECHO("ERROR! $newmess file_put_contents($bible_con)" ); }
	if (file_put_contents($bible_num,$bibledata_num) === FALSE ) {								AION_ECHO("ERROR! $newmess file_put_contents($bible_num)" ); }
	// done
	AION_ECHO("DONE $newmess");
	return;
}

