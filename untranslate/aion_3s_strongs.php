#!/usr/local/bin/php
<?php

// FLAGS
$DOTHECOUNTCHECKER = TRUE;
//$DOTHECOUNTCHECKER = FALSE;
//$SAVETHECOUNTCHECKER = TRUE;
$SAVETHECOUNTCHECKER = FALSE;

//$DOTHEUSAGEFOLDERS = TRUE;
$DOTHEUSAGEFOLDERS = FALSE;


//////////////////////////////////////////////////////////////////////////////////////////////////
// INIT
//$strongs_json_flag = JSON_UNESCAPED_UNICODE;
$strongs_json_flag = (JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);



//////////////////////////////////////////////////////////////////////////////////////////////////
// FILENAMES and README
// folders
$FOLDER_SOURCE = "../STEPBible-Data-master/";
$FOLDER_STAGE = "../www-stage/library/stepbible/";
// input
$INPUT_VIZBI = "../www-stageresources/AB-Viz-Strongs.csv";
$INPUT_TBESG = $FOLDER_SOURCE."TBESG - Translators Brief lexicon of Extended Strongs for Greek - STEPBible.org CC BY.txt";
$INPUT_TFLS1 = $FOLDER_SOURCE."TFLSJ  0-5624 - Translators Formatted full LSJ Bible lexicon - STEPBible.org CC BY.txt";
$INPUT_TFLS2 = $FOLDER_SOURCE."TFLSJ extra - Translators Formatted full LSJ Bible lexicon - STEPBible.org CC BY.txt";
$INPUT_TEGMC = $FOLDER_SOURCE."TEGMC - Translators Expansion of Greek Morphhology Codes - STEPBible.org CC BY.txt";
$INPUT_TAGN1 = $FOLDER_SOURCE."TAGNT Mat-Jhn - Translators Amalgamated Greek NT - STEPBible.org CC-BY.txt";
$INPUT_TAGN2 = $FOLDER_SOURCE."TAGNT Act-Rev - Translators Amalgamated Greek NT - STEPBible.org CC-BY.txt";
$INPUT_TBESH = $FOLDER_SOURCE."TBESH - Translators Brief lexicon of Extended Strongs for Hebrew - STEPBible.org CC BY.txt";
$INPUT_TEHMC = $FOLDER_SOURCE."TEHMC - Translators Expansion of Hebrew Morphology Codes - STEPBible.org CC BY.txt";
$INPUT_TOTH1 = $FOLDER_SOURCE."TOTHT Gen-Deu - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt";
$INPUT_TOTH2 = $FOLDER_SOURCE."TOTHT Jos-Est - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt";
$INPUT_TOTH3 = $FOLDER_SOURCE."TOTHT Job-Sng - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt";
$INPUT_TOTH4 = $FOLDER_SOURCE."TOTHT Isa-Mal - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt";
// checks
$CHECK_BOOK = "CHECK_BOOKS.txt";
$CHECK_FIXS = "CHECK_FIXED.txt";
$CHECK_HTMG = "CHECK_HTML_GREEK_TBESG.htm";
$CHECK_HTML = "CHECK_HTML_GREEK_TFLSJ.htm";
$CHECK_HTMH = "CHECK_HTML_HEBREW_TBESH.htm";
$CHECK_LEXG = "CHECK_LEXICON_GREEK.txt";
$CHECK_LEXH = "CHECK_LEXICON_HEBREW.txt";
$CHECK_MISS = "CHECK_MISSING.txt";
$CHECK_MORF = "CHECK_MORPHS.txt";
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
$STEPBIBLE_AMA = "./aion_source/Holy-Bible---English---STEPBible-Amalgamant---Source-Edition.STEP.txt";
$STEPBIBLE_CON = "./aion_source/Holy-Bible---English---STEPBible-Concordant---Source-Edition.STEP.txt";



//////////////////////////////////////////////////////////////////////////////////////////////////
// UNPACK THE GITHUB ZIP
system("rm -rf $FOLDER_SOURCE");
system("unzip -q ../www-stageresources/AB-STEPBibleData.zip -d ../");
if (!is_dir($FOLDER_SOURCE)) { AION_ECHO("ERROR! Bad unzip($FOLDER_SOURCE)"); }
// PREPARE THE STAGE
system("rm -rf $FOLDER_STAGE");
if (!mkdir($FOLDER_STAGE) || !is_dir($FOLDER_STAGE) || !chmod($FOLDER_STAGE,0755)) {	AION_ECHO("ERROR! mkdir($FOLDER_STAGE)"); }



//////////////////////////////////////////////////////////////////////////////////////////////////
// HTACCESS
$HTACCESS = <<<EOT
Options +Indexes
IndexOptions -HTMLTable +FancyIndexing +FoldersFirst NameWidth=* +SuppressDescription +SuppressHTMLPreamble
HeaderName .header.htm
IndexIgnore .well-known .htaccess .header.htm .favicon.ico .logo.png desktop.ini

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
$CHECK_FIXS > Textual hygiene change counts
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
$GREEK_TAGED_NUMS > json book, chapter, verse, and total Strong's usage count from Translators Amalgamated Greek New Testament
$GREEK_USAGE_DATA > Greek Strong's usage indicated by chapter index
$GREEK_USAGE_INDX > json byte index file to Greek Strong's usage indicated by chapter index
$GREEK_CHAPS_DATA > json per chapter verse Greek lexicon data files, also indexed by modulo verse number

EOT;
$README = AION_FILE_DATA_PUT_HEADER("$README_FILE", strlen($README), $commentplus) . $README;
if (file_put_contents("$FOLDER_STAGE$README_FILE", $README)===FALSE) { AION_ECHO("ERROR! file_put_contents($README_FILE)"); }




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
AION_NEWSTRONGS_CSV( "$INPUT_VIZBI", ",",'VIZLEX',
array('STRONGS','WORD','TRANS','PRONOUNCE','DEF','MORPH','LANG'), 'STRONGS', $database);
// VIZ-STRONGS WRITE
AION_NEWSTRONGS_FIX_VIZ($database['VIZLEX'],'H','HEBVIZ',$database);
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
AION_NEWSTRONGS_FIX_VIZ($database['VIZLEX'],'G','GREVIZ',$database);
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
AION_NEWSTRONGS_GET( "$INPUT_TBESH",'H0001	אָב', NULL, NULL, NULL, 'HEBLEX',array('STRONGS','WORD','TRANS','MORPH','GLOSS','DEF',''), $HEBLEX=array('STRONGS','WORD','TRANS','GLOSS','MORPH','DEF',''), 'STRONGS', $database, "TBESH");
AION_NEWSTRONGS_GET( "$INPUT_TOTH1",'Gen.1.1-01	Gen.1.1-01	בְּרֵאשִׁית',	NULL, NULL, NULL, 'HEBRF1', array('','REF','','ACCENTS','MORPH','STRONGS'), NULL, NULL, $database);
AION_NEWSTRONGS_GET( "$INPUT_TOTH2",'Jos.1.1-01	Jos.1.1-01	וַיְהִי',		NULL, NULL, NULL, 'HEBRF2', array('','REF','','ACCENTS','MORPH','STRONGS'), NULL, NULL, $database);
AION_NEWSTRONGS_GET( "$INPUT_TOTH3",'Job.1.1-01	Job.1.1-01	אִישׁ',		NULL, NULL, NULL, 'HEBRF3', array('','REF','','ACCENTS','MORPH','STRONGS'), NULL, NULL, $database);
AION_NEWSTRONGS_GET( "$INPUT_TOTH4",'Isa.1.1-01	Isa.1.1-01	חֲזוֹן',		'Extended Strongs numbers for Prefixes and suffixes:', NULL, NULL, 'HEBRF4', array('','REF','','ACCENTS','MORPH','STRONGS'), NULL, NULL, $database);
// TYNDALE HEBREW WRITE
if ( file_put_contents($json="$FOLDER_STAGE$HEBREW_MORPH_DATA",json_encode($database['HEBMOR'], $strongs_json_flag)) === FALSE ) { AION_ECHO("ERROR! json_encode: ".$json ); }
AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_MORPH_DATA ROWS=".count($database['HEBMOR']));
AION_NEWSTRONGS_GET_FIX_LEX('TBESH', $database['HEBLEX'], $database, $database['HEBMOR'], "$FOLDER_STAGE$CHECK_HTMH");
AION_NEWSTRONGS_GET_FIX_INDEX($database['HEBLEX']);
$commentplus = <<<EOT
# Source: Tyndale House, Cambridge, www.TyndaleHouse.com
# Source Content: Extended Strong's Hebrew Lexicon
# Source Link: https://tyndale.github.io/STEPBible-Data
# Source Application: https://www.STEPBible.org
# Source Copyright: Creative Commons Attribution Non-Commercial 4.0
# Source Definitions: Abridged BDB by http://onlinebible.net, edited by Tyndale House Cambridge
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
AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_TBESH_DATA ROWS=".count($database['HEBLEX']));
AION_NEWSTRONGS_FIX_REF_HEBREW($database['HEBRF1'],'TOTHT',$database, $database['HEBLEX'], $database['HEBMOR']);	AION_unset($database['HEBRF1']);
AION_NEWSTRONGS_FIX_REF_HEBREW($database['HEBRF2'],'TOTHT',$database, $database['HEBLEX'], $database['HEBMOR']);	AION_unset($database['HEBRF2']);
AION_NEWSTRONGS_FIX_REF_HEBREW($database['HEBRF3'],'TOTHT',$database, $database['HEBLEX'], $database['HEBMOR']);	AION_unset($database['HEBRF3']);
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
#		Word flag code: W=next word, K=next Ketiv 'written' word, Q=following Qere 'read' word, P=word parts, J=joined words (though not variants), D=divided word (though not variants)
#	MORPH
#		Morphhology and part of speech (see morphhology code file)
#	WORD
#		Hebrew words, divided in parts with '/'

EOT;
$commentplus = AION_FILE_DATA_PUT_HEADER("$HEBREW_TAGED_DATA", strlen($database['TOTHT']), $commentplus);
if ( file_put_contents($file="$FOLDER_STAGE$HEBREW_TAGED_DATA", $commentplus.$database['TOTHT']) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }
AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_TAGED_DATA ROWS=".substr_count($database['TOTHT'], "\n"));
AION_NEWSTRONGS_GET_INDEX_TAG("$FOLDER_STAGE$HEBREW_TAGED_DATA", "$FOLDER_STAGE$HEBREW_TAGED_INDX");
AION_NEWSTRONGS_TAG_INDEX_CHECKER("$FOLDER_STAGE$HEBREW_TAGED_INDX", "$FOLDER_STAGE$HEBREW_TAGED_DATA", array("GEN001001","MAL004006"));
AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_TAGED_INDX");
AION_NEWSTRONGS_COUNT_REF($database['TOTHT'],"$FOLDER_STAGE$HEBREW_TAGED_NUMS");
if ($DOTHECOUNTCHECKER) {
	AION_NEWSTRONGS_COUNT_REF_CHECKER("$FOLDER_STAGE$HEBREW_TAGED_NUMS",
		"$INPUT_TOTH1", 'Gen.1.1-01	Gen.1.1-01	בְּרֵאשִׁית',NULL,
		"$INPUT_TOTH2", 'Jos.1.1-01	Jos.1.1-01	וַיְהִי',	NULL,
		"$INPUT_TOTH3", 'Job.1.1-01	Job.1.1-01	אִישׁ',	NULL,
		"$INPUT_TOTH4", 'Isa.1.1-01	Isa.1.1-01	חֲזוֹן',	'Extended Strongs numbers for Prefixes and suffixes:',
		"$FOLDER_STAGE$HEBREW_TAGED_FILE",
		$SAVETHECOUNTCHECKER);
}
AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_TAGED_NUMS");
AION_NEWSTRONGS_USAGE_REF('old', $database['TOTHT'], "$FOLDER_STAGE$HEBREW_USAGE_DATA", "$FOLDER_STAGE$HEBREW_USAGE_INDX");
AION_NEWSTRONGS_USAGE_REF_CHECKER("$FOLDER_STAGE$HEBREW_USAGE_INDX", "$FOLDER_STAGE$HEBREW_USAGE_DATA");
AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_USAGE_DATA");
AION_unset($database['TOTHT']);
AION_NEWSTRONGS_LEX_WIPE($database['HEBLEX']);
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_UHEB","Strongs numbers in lexicon, but not in tagged texts\n===\n\n".implode("\n", array_map($callback, $database['HEBLEX']))) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }
AION_unset($database['HEBLEX']);
AION_NEWSTRONGS_GET_INDEX_LEX("$FOLDER_STAGE$HEBREW_TBESH_DATA","$FOLDER_STAGE$HEBREW_TBESH_INDX");
AION_NEWSTRONGS_GET_INDEX_LEX_CHECKER("$FOLDER_STAGE$HEBREW_TBESH_INDX","$FOLDER_STAGE$HEBREW_TBESH_DATA");
AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_TBESH_INDX");






//////////////////////////////////////////////////////////////////////////////////////////////////
// TYNDALE GREEK READ
AION_NEWSTRONGS_COD( "$INPUT_TEGMC",'GREMOR', $database, TRUE);
AION_NEWSTRONGS_GET( "$INPUT_TBESG",'G0001	alpha',	NULL, NULL, NULL, 'GRELEX',array('STRONGS','GLOSS','WORD','TRANS','MORPH','DEF'), $GRELEX=array('STRONGS','WORD','TRANS','GLOSS','MORPH','DEF'), 'STRONGS', $database);
AION_NEWSTRONGS_GET( "$INPUT_TFLS1",'G0001	Ἀλφα',	NULL, NULL, NULL, 'GRELSJ',array('STRONGS','WORD','TRANS','GLOSS','MORPH','DEF',''), $GRELSJ=array('STRONGS','WORD','TRANS','GLOSS','MORPH','DEF',''), 'STRONGS', $database);
AION_NEWSTRONGS_GET( "$INPUT_TFLS2",'G6000	ἀγγέλλω',NULL, NULL, NULL,'GRELSJ',array('STRONGS','WORD','TRANS','GLOSS','MORPH','DEF',''), $GRELSJ=array('STRONGS','WORD','TRANS','GLOSS','MORPH','DEF',''), 'STRONGS', $database);
$thisfind = array("/42_Mrk\.004\.006/us","/44_Jhn\.009\.003/us");
$thisreplace = array("42_Mrk.004.005","44_Jhn.008.059");
AION_NEWSTRONGS_GET( "$INPUT_TAGN1",'41_Mat.001.001	=NA same TR ~~	Βίβλος	', NULL, $thisfind, $thisreplace, 'GREREF1',array('REF','TYPE','WORD','ENGLISH','STRONGS','MORPH','','','EDITIONS','SPELLINGS','MEANINGS','','ADDITIONAL','','CONJOIN',''), NULL, NULL, $database);
AION_NEWSTRONGS_GET( "$INPUT_TAGN2",'45_Act.001.001	=NA same TR ~~	Τὸν	', "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\r\t", NULL, NULL, 'GREREF2',array('REF','TYPE','WORD','ENGLISH','STRONGS','MORPH','','','EDITIONS','SPELLINGS','MEANINGS','','ADDITIONAL','','CONJOIN',''), NULL, NULL, $database);
// TYNDALE GREEK WRITE
if ( file_put_contents($json="$FOLDER_STAGE$GREEK_MORPH_DATA",json_encode($database['GREMOR'], $strongs_json_flag)) === FALSE ) { AION_ECHO("ERROR! json_encode: ".$json ); }
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
#		G5800  - G5893,  Greek Synonyms - see http://studybible.info/strongs/G5800  (these numbers aren't used in this lexicon) 
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
#		G5800  - G5893,  Greek Synonyms - see http://studybible.info/strongs/G5800  (these numbers aren't used in this lexicon) 
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
#		(Note, not all devices work well with tooltips, so consider implementing a clickable option such as http://jsfiddle.net/xaAN3/) 

EOT;
AION_FILE_DATA_PUT("$FOLDER_STAGE$GREEK_TFLSJ_DATA", $database['GRELSJ'], $commentplus);
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
#		"NA=TR"		=NA same TR				133304 words are translated in both traditional KJV and modern Bibles.	NA27/28 + TR + others all having the same meaning
#		"NA!=TR"	=NA diff TR				3922 words may translate differently in traditional and modern Bibles.	NA27/28 + others having the same meaning but there are.also .. 	| Variants = different meanings in TR + others
#		"NA"		=NA not TR				761 words are translated in most modern Bibles but not in the KJV.		NA27/28 + others having the same meaning but not TR
#		"NIV"		=TR+NIV/ESV not NA		227 words are translated in the KJV and in some modern Bibles.			TR + others having the same meaning but not NA27/28
#		"TR"		=TR not NA,NIV/ESV		3573 words are translated in the KJV but not in most modern Bibles.		TR + others having the same meaning but not NA27/28
#		"TR+"		=TR not NA. In NIV/ESV	?
#		"Other"		Not in NA or TR			245 words occur in early manuscripts but not translated in most Bibles.	Others having a word that is not found in TR or NA27/28
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
if ( file_put_contents($file="$FOLDER_STAGE$GREEK_TAGED_DATA", $commentplus.$database['GRERE2']) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_TAGED_DATA ROWS=".substr_count($database['GRERE2'], "\n"));
AION_NEWSTRONGS_GET_INDEX_TAG("$FOLDER_STAGE$GREEK_TAGED_DATA", "$FOLDER_STAGE$GREEK_TAGED_INDX");
AION_NEWSTRONGS_TAG_INDEX_CHECKER("$FOLDER_STAGE$GREEK_TAGED_INDX", "$FOLDER_STAGE$GREEK_TAGED_DATA", array("JOH001001","JOH003016","REV022021"));
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_TAGED_INDX");
AION_NEWSTRONGS_COUNT_REF($database['GRERE2'],"$FOLDER_STAGE$GREEK_TAGED_NUMS");
if ($DOTHECOUNTCHECKER) {
	AION_NEWSTRONGS_COUNT_REF_CHECKER("$FOLDER_STAGE$GREEK_TAGED_NUMS",
		"$INPUT_TAGN1", '41_Mat.001.001	=NA same TR ~~	Βίβλος	',	NULL,
		"$INPUT_TAGN2", '45_Act.001.001	=NA same TR ~~	Τὸν	',		"\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\r\t",
		NULL,NULL,NULL,
		NULL,NULL,NULL,
		"$FOLDER_STAGE$GREEK_TAGED_FILE",
		$SAVETHECOUNTCHECKER);
}
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_TAGED_NUMS");
AION_NEWSTRONGS_USAGE_REF('new', $database['GRERE2'], "$FOLDER_STAGE$GREEK_USAGE_DATA", "$FOLDER_STAGE$GREEK_USAGE_INDX");
AION_NEWSTRONGS_USAGE_REF_CHECKER("$FOLDER_STAGE$GREEK_USAGE_INDX", "$FOLDER_STAGE$GREEK_USAGE_DATA");
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_USAGE_DATA");
AION_unset($database['GRERE2']);
AION_NEWSTRONGS_LEX_WIPE($database['GRELEX']);
AION_NEWSTRONGS_LEX_WIPE($database['GRELSJ']);
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_UGRE",
"Strongs numbers in lexicon, but not in tagged texts\n===\n\n".implode("\n", array_map($callback, $database['GRELEX']))) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }
AION_unset($database['GRELEX']);
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_ULSJ",
"Strongs numbers in lexicon, but not in tagged texts\n===\n\n".implode("\n", array_map($callback, $database['GRELSJ']))) === FALSE ) { AION_ECHO("ERROR! file_put: ".$file ); }
AION_unset($database['GRELSJ']);
AION_NEWSTRONGS_GET_INDEX_LEX("$FOLDER_STAGE$GREEK_TBESG_DATA", "$FOLDER_STAGE$GREEK_TBESG_INDX");
AION_NEWSTRONGS_GET_INDEX_LEX_CHECKER("$FOLDER_STAGE$GREEK_TBESG_INDX", "$FOLDER_STAGE$GREEK_TBESG_DATA");
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_TBESG_INDX");
AION_NEWSTRONGS_GET_INDEX_LEX("$FOLDER_STAGE$GREEK_TFLSJ_DATA","$FOLDER_STAGE$GREEK_TFLSJ_INDX");
AION_NEWSTRONGS_GET_INDEX_LEX_CHECKER("$FOLDER_STAGE$GREEK_TFLSJ_INDX","$FOLDER_STAGE$GREEK_TFLSJ_DATA");
AION_ECHO("GREEK $FOLDER_STAGE$GREEK_TFLSJ_INDX");






//////////////////////////////////////////////////////////////////////////////////////////////////
// WRITE CHECK RESULTS
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_BOOK", implode("\n", $database['BOOKS'])) === FALSE ) {	AION_ECHO("ERROR! file_put: ".$file ); }
AION_ECHO("CHECK $CHECK_BOOK ROWS=".count($database['BOOKS']));
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_MORF", $database['MISS_MORPHS']) === FALSE) {			AION_ECHO("ERROR! file_put: ".$file ); }
AION_ECHO("CHECK $CHECK_MORF ROWS=".substr_count($database['MISS_MORPHS'], "\n"));
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_MISS", $database['MISS_MANU']) === FALSE) {				AION_ECHO("ERROR! file_put: ".$file ); }
AION_ECHO("CHECK $CHECK_MISS ROWS=".substr_count($database['MISS_MANU'], "\n"));
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_STRG", $database['CORRUPT_STRONGS']) === FALSE ) {		AION_ECHO("ERROR! file_put: ".$file ); }
AION_ECHO("CHECK $CHECK_STRG ROWS=".substr_count($database['CORRUPT_STRONGS'], "\n"));
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_VARS", $database['CORRUPT_VARIANT']) === FALSE ) {		AION_ECHO("ERROR! file_put: ".$file ); }
AION_ECHO("CHECK $CHECK_VARS ROWS=".substr_count($database['CORRUPT_VARIANT'], "\n"));
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_FIXS", $database['FIXCOUNTS']) === FALSE ) {				AION_ECHO("ERROR! file_put: ".$file ); }
AION_ECHO("CHECK $CHECK_FIXS ROWS=".substr_count($database['FIXCOUNTS'], "\n"));
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_REFS", $database['REFERENCES']) === FALSE ) {			AION_ECHO("ERROR! file_put: ".$file ); }
AION_ECHO("CHECK $CHECK_REFS ROWS=".substr_count($database['REFERENCES'], "\n"));
if ( file_put_contents($file="$FOLDER_STAGE$CHECK_WARN", $database['WARNINGS']) === FALSE ) {				AION_ECHO("ERROR! file_put: ".$file ); }
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
	"$STEPBIBLE_CON"
	);




//////////////////////////////////////////////////////////////////////////////////////////////////
// WRITE THE USAGE FOLDER FORMAT
if ($DOTHEUSAGEFOLDERS) {
	AION_NEWSTRONGS_USAGE_FOLDER("$FOLDER_STAGE$HEBREW_TAGED_DATA",	"$FOLDER_STAGE$HEBREW_VIZBI_DATA",	"$FOLDER_STAGE$HEBREW_TBESH_DATA",	NULL,								"$FOLDER_STAGE$HEBREW_CHAPS_DATA");
	AION_ECHO("HEBREW $FOLDER_STAGE$HEBREW_CHAPS_DATA");
	AION_NEWSTRONGS_USAGE_FOLDER("$FOLDER_STAGE$GREEK_TAGED_DATA",	"$FOLDER_STAGE$GREEK_VIZBI_DATA",	"$FOLDER_STAGE$GREEK_TBESG_DATA",	"$FOLDER_STAGE$GREEK_TFLSJ_DATA",	"$FOLDER_STAGE$GREEK_CHAPS_DATA");
	AION_ECHO("GREEK $FOLDER_STAGE$GREEK_CHAPS_DATA");
}






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


// Read TAB delimited file
function AION_NEWSTRONGS_GET($file, $begin, $end, $thisfind, $thisreplace, $table, $keys, $keysord, $key, &$result, $flag=NULL) {
	$newmess = "GET\t$file";
	if ( !is_array( $result ) ) {										AION_ECHO("ERROR! $newmess result !is_array() "); }
	if ( !is_array( $keys ) ) {											AION_ECHO("ERROR! $newmess keys !is_array()"); }
	if ( $key && !in_array( $key, $keys ) ) {							AION_ECHO("ERROR! $newmess key=$key not in keys !in_array()"); }
	if ( is_array($keysord) &&
		 strlen($test=trim(implode("",array_diff($keys,$keysord))))) {	AION_ECHO("ERROR! $newmess key=$test not in keysord"); }
	if ( !is_file( $file ) ) {											AION_ECHO("ERROR! $newmess !is_file()"); }
	if ( ($contents = file_get_contents( $file )) === FALSE ) {			AION_ECHO("ERROR! $newmess !file_get_contents()"); }
	if ( mb_detect_encoding($contents, "UTF-8", TRUE) === FALSE ) {		AION_ECHO("ERROR! $newmess !mb_detect_encoding()"); }
	mb_regex_encoding("UTF-8");
	mb_internal_encoding("UTF-8");
	if (!($contents=preg_replace("/^.*?$begin/us",$begin,$contents,-1,$count)) || $count!=1) {		AION_ECHO("ERROR! $newmess no beginning='$begin' $count"); }
	if ($end && (!($contents=preg_replace("/$end.*$/us","",$contents,-1,$count)) || $count!=1)) {	AION_ECHO("ERROR! $newmess no ending='$end' $count"); }
	if (is_array($thisfind)) {
		foreach($thisfind as $index => $value) {
			if (!($contents=preg_replace($value,$thisreplace[$index],$contents,1,$count)) || $count!=1) { AION_ECHO("ERROR! $newmess bad replace($value) with $count"); }
		}
	}
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
		if (empty($data) || $data[0]=='#' || $data[0]=='$') { continue; }
		$line = $data;
		$data = mb_split("\t", $data);
		$count_data = count($data);
		if ( !$count_meta ) {
			$count_meta = $count_data;
			if ( $count_meta != $count_keys) {							AION_ECHO("ERROR! $newmess line=$count count(meta=$count_meta != count_keys=".count($keys).") line='$line'"); }
		}
		if ( !$count_data || $count_meta != $count_data ) {				AION_ECHO("ERROR! $newmess line=$count count(meta=$count_meta != data=$count_data line='$line'"); }
		for ( $newd = array(), $x = 0; $x < $count_data; $x++ ) {	if (!empty($keys[$x])) { $newd[$keys[$x]] = trim($data[$x]); } }
		if (is_array($keysord)) { $newS = array(); foreach( $keysord as $k) { if (!empty($k)) { $newS[$k] = $newd[$k]; } } unset($newd); $newd = $newS; }
		if ( !$key ) { $result[$table][] = $newd; }
		else {
			if (!empty($result[$table][$newd[$key]])) {					AION_ECHO("ERROR! $newmess line=$count array key overlap! $key=".$newd[$key]); }
			$result[$table][$newd[$key]] = $newd;
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
	$contents = preg_replace($reg="#<re>(.+?)</re>#usi",						" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\t<re>=$count\n"; }
	$contents = preg_replace($reg="#(<ref[^>]*>|</ref>)#usi",					" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tref=$count\n"; }
	$contents = preg_replace($reg="#(<hi [^>]*>|</hi>)#usi",					" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\thi=$count\n"; }
	$contents = preg_replace($reg="#(<span [^>]*>|</span>)#usi",				" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tspan=$count\n"; }
	$contents = preg_replace($reg="#<gramGrp/>#usi",							" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tgramGrp=$count\n"; }
	//$contents = preg_replace($reg="#<a href(.+?)</a>#usi",					" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tahrefs=$count\n"; }
	$contents = preg_replace($reg="#<foreign(.+?)>#usi",						" ",	$contents,-1,$count);		if ($count) { $result['FIXCOUNTS'].="$newmess\t$reg\tforeign=$count\n"; }
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
		if (!preg_match("#[^[:alnum:]]+2\) #ui",$line) &&
			(!($lines[$x] = preg_replace("#([ \t]+)1\) #ui","$1",$line,-1,$count)) ||
			$count>1)) {
			AION_ECHO("ERROR! $newmess $count\n".print_r($line,TRUE));
		}
		$fixed += $count;
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
		
		// fix morph
		$fixed = $lines[$x]['MORPH'];
		if (($fixed=preg_replace("#-M/F#ui", "-B", $fixed))===FALSE) { AION_ECHO("ERROR! $newmess preg_replace M/F   failure\n".print_r($line,TRUE)); }
		if (($fixed=preg_replace("#-M/N#ui", "-L", $fixed))===FALSE) { AION_ECHO("ERROR! $newmess preg_replace M/N   failure\n".print_r($line,TRUE)); }
		if (($fixed=preg_replace("#-F/N#ui", "-E", $fixed))===FALSE) { AION_ECHO("ERROR! $newmess preg_replace F/N   failure\n".print_r($line,TRUE)); }
		if (($fixed=preg_replace("#[ ]+#ui", "",   $fixed))===FALSE) { AION_ECHO("ERROR! $newmess preg_replace space failure\n".print_r($line,TRUE)); }
		$line['MORPH'] = $lines[$x]['MORPH'] = $fixed; // fix morphhology
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
		if (preg_match_all("#.{0,30}<[^abiu>]{1}[^>]*[^abiu]{1}>.{0,30}#ui",$lines[$x]['DEF'],$match,PREG_PATTERN_ORDER)) {
			foreach($match[0] as $x => $suspect) { $n=$x+1; $report .= "$n) '$suspect'\n"; }
			AION_ECHO($warn="WARN! $newmess strongs='$strongs' suspect '<tag>' found\n$report".print_r($line,TRUE)."\n\n\n");
			$database['WARNINGS'] .= $warn;
		}
		else if (preg_match_all("#.{0,30}<[^abiu]{1}[^abiu]{1}.{0,30}#ui",$lines[$x]['DEF'],$match,PREG_PATTERN_ORDER)) {
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


// Clean up the Lexicon before writing
function AION_NEWSTRONGS_LEX_MORPH($morph) {
// define Language:Type-Gender-Extra
static $language = NULL;
if (!$language) { $language = array(
"A"=>"Aramaic","H"=>"Hebrew","G"=>"Greek","N"=>"Proper Name"); }
static $type = NULL;
if (!$type) { $type = array(
"A"=>"Adjective","Adv"=>"Adverb","Art"=>"Article","Cond"=>"Conditional","Conj"=>"Conjunction","Cor"=>"Correlative","DemP"=>"Demonstrative Pronoun","ImpP"=>"Impersonal Pronoun",
"Intg"=>"Interogative","Intj"=>"Interjection","N"=>"Noun","Neg"=>"Negative","Part"=>"Particle","Prep"=>"Preposition","PerP"=>"Personal Pronoun","PosP"=>"Possessive Pronoun",
"RefP"=>"Reflexive Pronoun","RelP"=>"Relative Pronoun","V"=>"Verb",
"Imperat"=>"Imperative",
"IndP"=>"Hebrew Indefinite Pronoun",
"Ps1c"=>"my, personal posessive - noun suffix: 1st person common singular",
"Ps2m"=>"your, personal posessive - noun suffix: 2nd person masculine singular",
"Ps2f"=>"your, personal posessive - noun suffix: 2nd person feminine singular",
"Ps3m"=>"his, personal posessive - noun suffix: 3rd person masculine singular",
"Ps3f"=>"her, personal posessive - noun suffix: 3rd person feminine singular",
"Pp1c"=>"our, personal posessive - noun suffix: 1st person common plural",
"Pp2m"=>"your, personal posessive - noun suffix: 2nd person masculine plural",
"Pp2f"=>"your, personal posessive - noun suffix: 2nd person feminine plural",
"Pp3m"=>"their, personal posessive - noun suffix: 3rd person masculine plural",
"Pp3f"=>"their, personal posessive - noun suffix: 3rd person feminine plural",
"Os1c"=>"me, personal pronoun - verb/prep. suffix: 1st person common singular",
"Os2m"=>"you, personal pronoun - verb/prep. 2nd person masculine singular",
"Os2f"=>"you, personal pronoun - verb/prep. 2nd person feminine singular",
"Os3m"=>"him, personal pronoun - verb/prep. 3rd person masculine singular",
"Os3f"=>"her, personal pronoun - verb/prep. 3rd person feminine singular",
"Op1c"=>"us, personal pronoun - verb/prep. 1st person common plural",
"Op2m"=>"you, personal pronoun - verb/prep. 2nd person masculine plural",
"Op2f"=>"you, personal pronoun - verb/prep. 2nd person feminine plural",
"Op3m"=>"them, personal pronoun - verb/prep. 3rd person masculine plural",
"Op3f"=>"them, personal pronoun - verb/prep. 3rd person feminine plural",
"Ss1c"=>"I, subject pronoun -  subject: 1st person common singular",
"Ss2m"=>"you, subject pronoun - subject 2nd person masculine singular",
"Ss2f"=>"you, subject pronoun - subject 2nd person feminine singular",
"Ss3m"=>"he, subject pronoun - subject 3rd person masculine singular",
"Ss3f"=>"she, subject pronoun - subject 3rd person feminine singular",
"Sp1c"=>"we, subject pronoun - subject 1st person common plural",
"Sp2m"=>"you, subject pronoun - subject 2nd person masculine plural",
"Sp2f"=>"you, subject pronoun - subject 2nd person feminine plural",
"Sp3m"=>"they, subject pronoun - subject 3rd person masculine plural",
"Sp3f"=>"they, subject pronoun - subject 3rd person feminine plural",
); } 
static $gender = NULL;
if (!$gender) { $gender = array(
"F"=>"Female","M"=>"Male","N"=>"Neuter","C"=>"Common","B"=>"Male/Female","L"=>"Male/Neuter","E"=>"Female/Neuter",
"FS"=>"Female Singular","MS"=>"Male Singular","NS"=>"Neuter Singular","CS"=>"Common Singular","BS"=>"Male/Female Singular","LS"=>"Male/Neuter Singular","ES"=>"Female/Neuter Singular",
"FP"=>"Female Plural","MP"=>"Male Plural","NP"=>"Neuter Plural","CP"=>"Common Plural","BP"=>"Male/Female Plural","LP"=>"Male/Neuter Plural","EP"=>"Female/Neuter Plural"); }
static $extra = NULL;
if (!$extra) { $extra = array(
"L"=>"Location","P"=>"Person","LG"=>"Gentilic Location","PG"=>"Gentilic Person","T"=>"Title","TG"=>"Gentilic Title"); }
// check
if (empty($morph)) { return TRUE; }
$parts = mb_split("[:\-]{1}", $morph);
if ( empty($parts[0]) || empty($language[$parts[0]]))	{ return FALSE; } // bad language
if (!empty($parts[1]) && empty($type[$parts[1]]))		{ return FALSE; } // bad type
if (!empty($parts[2]) && empty($gender[$parts[2]]))		{ return FALSE; } // bad gender
if (!empty($parts[3]) && empty($extra[$parts[3]]))		{ return FALSE; } // bad extra
if (!empty($parts[4]))									{ return FALSE; } // bad whoa!
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
			if (!preg_match("#([GH]{1}[\d]{1,5})([a-z]{0,1})#u", $strongs, $match)) {	AION_ECHO("ERROR! $newmess !preg_match(strongs=$strongs)"); }
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
function AION_NEWSTRONGS_GET_INDEX_LEX_CHECKER($index_file, $lexicon_file) {
	$newmess = "INDEX_LEX_CHECKER $index_file";
	// read data
	$index = json_decode(file_get_contents($index_file), true);
	if (empty($index)) {														AION_ECHO("ERROR! $newmess !json_decode($index_file)"); }
	if (!($fd=fopen($lexicon_file, 'r'))) {										AION_ECHO("ERROR! $newmess !fopen($lexicon_file)"); }
	// loop through counts
	foreach($index as $strongs => $positions) {
		$positionsA = explode(",", $positions);
		// Exception for H2428 which has H2428 and H2428b, but no H2428a
		$extension = ($strongs=="H2428" ? "[a-z]{0,1}" : (count($positionsA)>1 ? "[a-z]{1}" : ""));
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


// Viz need its own fixing
function AION_NEWSTRONGS_FIX_VIZ($input,$what,$table,&$database) {
	$database[$table] = array();
	// copy and correct
	foreach( $input as $x => $line ) {
		if (!preg_match("#^$what#ui",$line['STRONGS'])) { continue; } // build greek and hebrew separately
		if (empty($line['WORD']) && empty($line['TRANS']) && empty($line['DEF'])) { continue; } // skip empty lines
		$database[$table][$line['STRONGS']] = array(
			'STRONGS'	=> $line['STRONGS'],
			'WORD'		=> $line['WORD'],
			'TRANS'		=> $line['TRANS'],
			'PRONOUNCE'	=> $line['PRONOUNCE'],
			'LANG'		=> $line['LANG'],
			'MORPH'		=> $line['MORPH'],
			'DEF'		=> $line['DEF'],
		);
	}
	ksort($database[$table],SORT_NATURAL);
}


//
// big daddy reference parser HEBREW!
// MY CODES
// W or K = next word
// Q = Qere entry for the previous Ketiv word NOTE!! there are D divided words in Q entries so not all D can begin a total new word block!!!!!
// P = word part, part of same word but parts have their own Strongs number and definition
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
	// INIT
	static $abooks = NULL, $tbooks = NULL;
	if (!$abooks) {
		$abooks = AION_BIBLES_LIST();
		$tbooks = AION_BIBLES_LIST_TYN();
	}
	$lex2_array = array();
	$mark = $KetivQere_last = $line_last = $newmess_last = $last_indx = $last_chap = $last_vers = NULL;
	if (empty($database[$table])) {
		$database[$table] = "INDEX\tBOOK\tCHAPTER\tVERSE\tSTRONGS\tFLAG\tMORPH\tWORD\n";
	}
	
	// LOOP THRU ALL LINES
	foreach( $input as $line ) {
		
		// INIT
		$WORDUP = (empty($line['ACCENTS']) ? $line['WORD'] : $line['ACCENTS']);
		$newmess = "FIX_REF\tHebrew\tref='".$line['REF']."'\tword='$WORDUP'\tmorph='".$line['MORPH']."'\tstrongs='".$line['STRONGS']."'";

		// PARSE REFERENCE
		if (!preg_match("#^([0-9A-Za-z]+)[[:punct:]]+([\d]+)[[:punct:]]+([\d]+)[[:punct:]]+([\d]+)([kq]{0,1})$#u",$line['REF'],$match)) {	AION_ECHO("ERROR! $newmess corrupt hebrew ref\n".print_r($line,TRUE)); }
		$book = strtoupper($match[1]);
		$database['BOOKS'][$book] = $book; // unique book names
		if (empty($tbooks[$book])) { AION_ECHO("ERROR! $newmess missing book='$book'\n".print_r($line,TRUE)); }
		$book = $tbooks[$book];
		$indx = sprintf('%03d', (int)array_search($book,array_keys($abooks)));
		$chap = sprintf('%03d', (int)$match[2]);
		$vers = sprintf('%03d', (int)$match[3]);
		
		// Sorted properly?
		if ($last_indx && (
			($last_indx >  (int)$indx) ||
			($last_indx <  (int)$indx && ($last_indx+1 != (int)$indx || 1 != (int)$chap || 1 != (int)$vers)) ||
			($last_indx == (int)$indx && ($last_chap >  (int)$chap)) ||
			($last_indx == (int)$indx && ($last_chap <  (int)$chap && ($last_chap+1 != (int)$chap || 1 != (int)$vers))) ||
			($last_indx == (int)$indx && ($last_chap == (int)$chap && ($last_vers+1 != (int)$vers && $last_vers != (int)$vers)))
			)) {
			AION_ECHO($warn="WARN! $newmess reference sort order problem!\n".print_r($line,TRUE)."\n\n\n");
			$database['WARNINGS'] .= $warn;			
		}
		$last_indx = (int)$indx;
		$last_chap = (int)$chap;
		$last_vers = (int)$vers;
		
		// Ketiv / Qere
		$KetivQere = (empty($match[5]) ? "" : strtoupper($match[5])); // Ketiv = 'written' & Qere = 'read'
		if (($KetivQere=="Q" && $KetivQere_last!="K") || ($KetivQere_last=="K" && $KetivQere!="Q")) {
			$database['CORRUPT_STRONGS'] .= ($warn="$newmess\tKetiv Qere confusion!\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");			
		}
		$KetivQere_last = $KetivQere;
		
		// SKIP EMPTY AND PUNCTUATION
		if (empty($line['STRONGS'])) { // continue here to allow for book name error checks and collection above
			if (!empty($WORDUP) && !preg_match("#^(,|\.|\(|\)|]|]]|\[|\[\[|·|;|—|¶)$#ui",$WORDUP)) {
				$database['CORRUPT_STRONGS'] .= ($warn="$newmess\tword with empty strongs\n");
				AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
			}
			continue;
		}

		// DUPLICATES?
		if ((!empty($line_last['REF']) && $line_last['REF']==$line['REF']) ||
			($line_last != NULL && (!($difference=array_diff($line,$line_last)) || !count($difference)))) {
			$database['CORRUPT_STRONGS'] .= ($warn="$newmess_last\n$newmess\tTagged text repeated Hebrew reference or identical entry\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");			
		}
		
		// HEBREW PART COUNTS SAME?
		$part_word = substr_count($WORDUP, "/");	
		$part_morf = substr_count($line['MORPH'], "/");	
		$part_strg = substr_count($line['STRONGS'], "/");
		if ($part_word != $part_strg) {
			$database['CORRUPT_STRONGS'] .= ($warn="$newmess_last\n$newmess\tHebrew '/' dividers not equal, word=$part_word / morf=$part_morf / strongs=$part_strg\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
		}
		$line_last = $line;
		$newmess_last = $newmess;
		
		// PARSE STRONGS AND MORPHS
		$jointype = (empty($KetivQere) ? "W" : $KetivQere); // W=next word, Ketiv=written word, Qere=read word, P=word parts, J=joined words, D=divided word
		$jointype_orig = $jointype;
		$spart = mb_split("/", $line['STRONGS']);
		$mpart = mb_split("/", $line['MORPH']);
		if (empty($mpart[0])) { // beware the few Qere with no strongs number
			$database['MISS_MORPHS'] .= ($warn="$newmess\tempty 1st part morph=".$line['MORPH']."\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
		}
		$letter = $mpart[0][0]; // Hebrew shares 1st letter of 1st morphhology with subsequent morphhologies

		// LOOP THRU GREEK+ and HEBREW/ PARTS
		foreach($spart as $key => $part) {
			// INIT
			$newmess = "FIX_REF\tHebrew\tref='".$line['REF']."'\tword='$WORDUP'\tmorph='".$line['MORPH']."'\tstrongs='".$line['STRONGS']."'";
			// STRONGS
			$strongs = mb_split("=", $part);
			$strongs = $strongs[0];			
			// typically joined words parts, but sometimes divided parts into separate words
			// strongs //=joined, but variants divided, / / and /_/=divided, but variants joined, and /-/ Qere ignores Ketiv
			// W=next word, Ketiv=written word, Qere=read word, P=word parts, J=joined words, D=divided word
			if ($strongs=="") {
				if (!preg_match("#//#ui",$WORDUP)) { AION_ECHO("ERROR! $newmess Found // in strongs BUT !word\n".print_r($line,TRUE)); }
				$jointype = "J";
				continue;
			}
			else if ($strongs==" " || $strongs=="_") {
				if (!preg_match("#/ /#ui",$WORDUP) && !preg_match("#/_/#ui",$WORDUP)) { AION_ECHO("ERROR! $newmess Found / / or /_/ in strongs BUT !word\n".print_r($line,TRUE)); }
				if ($jointype_orig == 'K' || $jointype_orig == 'Q') {
					AION_ECHO($warn="WARN! $newmess Divided word found in '$jointype_orig' entry will be challenge to display!\n".print_r($line,TRUE)."\n\n\n");
					$database['WARNINGS'] .= $warn;
				}
				$jointype = "D";
				continue;
			}
			else if ($strongs=="-") {
				if ($key || $KetivQere!='Q') { AION_ECHO("ERROR! $newmess strongs='-' only for a few Qere!\n".print_r($line,TRUE)); }
				$jointype = "Q";
				// Qere omission output!
				$database[$table] .= "$indx\t$book\t$chap\t$vers\tH0\t$jointype\t\t\n";
				continue;
			}
			// error check strongs format
			$strongs = AION_NEWSTRONGS_STRONGS_PARSE($newmess, $strongs, FALSE, $lex_array, $lex2_array);
			
			// MORPHS
			$morph = ($key==0 ? $mpart[0] : (empty($mpart[$key]) ? '' : $letter.$mpart[$key]));
			if (!empty($morph) && empty($morph_array[$morph])) {
				$database['MISS_MORPHS'] .= ($warn="$newmess\tmissing morph='$morph'\n");
				AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
			}

			// grab a list of the Strongs numbers from the VARIANT field here!
			// ie format > HW=Δαυεὶδ=G1138=N-GSM-P; R=Δαβὶδ=G1138=N-GSM-P;
			static $vartrans = NULL;
			if (!$vartrans) {
				$vartrans = array(
					"B" => "Byzantine from Robinson/Pierpoint",
					"N" => "Nestle/Aland 27th Edition",
					"M" => "Nestle/Aland 28th Edition, not ECM",
					"R" => "Textus Receptus",
					"S" => "SBLGNT",
					"T" => "Tregelles",
					"W" => "Westcott/Hort",
					"w" => "Westcott/Hort margin",
					"H" => "Tyndale House GNT",
					"I" => "Unknown",
				);
			}
			// construct the output
			$database[$table] .= "$indx\t$book\t$chap\t$vers\t$strongs\t$jointype\t$morph\t$WORDUP\n";
			// W=next word, Ketiv=written word, Qere=read word, P=word parts, J=joined words, D=divided word
			$jointype = "P";
			$mark = $indx.$book.$chap.$vers;
		}
	}
}


// parse the strongsid
function AION_NEWSTRONGS_STRONGS_PARSE($newmess, $strongs, $variant, &$lex_array, &$lex2_array) {
	// parse?
	if (FALSE===preg_match_all("#(.*?)([GH]{1}[\d]{1,5}[a-z]{0,1})#u", $strongs, $parsed, PREG_SET_ORDER)) { AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs) !preg_match_all()"); }
	// totally empty
	if (empty($parsed)) { AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs) hey empty strongs!"); }
	// validate
	$strong_return = "";
	foreach($parsed as $x => $set) {
		// init
		$connector = $set[1];
		$strong = $set[2];
		// connectors okay?
		if ($x==0 && !empty($connector)) { AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs, strong=$strong) first connector not empty = '$connector'"); }
		else if ($x && !in_array($connector, ($variant ? array("«","+") : array("«") ))) { AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs, strong=$strong) invalid connector = '$connector'"); }
		// lexicon entry?
		if (!empty($lex_array)) {
			if (empty($lex_array[$strong])) { AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs, strong=$strong) not in lexicon"); } // not found
			else { $lex_array[$strong]['WORD'] = $lex_array[$strong]['TRANS'] = $lex_array[$strong]['MORPH'] = $lex_array[$strong]['DEF'] = NULL; } // found
		}
		if (!empty($lex2_array)) {
			if (empty($lex2_array[$strong])) { AION_ECHO("ERROR! $newmess PARSE(strongs=$strongs, strong=$strong) not in lexicon2"); } // not found
			else { $lex2_array[$strong]['WORD'] = $lex2_array[$strong]['TRANS'] = $lex2_array[$strong]['MORPH'] = $lex2_array[$strong]['DEF'] = NULL; } // found
		}
		// variant only?
		if ($variant) {
			if (!empty($lex_array[$strong])) {	$lex_array[$strong]['VARIANT'] = "Variant usage ONLY"; }
			if (!empty($lex2_array[$strong])) {	$lex2_array[$strong]['VARIANT'] = "Variant usage ONLY"; }
		}
		// build return
		$strong_return .= ($connector.$strong);
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
// Variant markers
//  ¦ indicates the difference CAN'T be expressed in the translation - in English, at least. 
//  | indicates the difference MIGHT be expressed in the translation, but one can't look at a translation and decide which Greek variant it followed
//  ‖ indicates that difference SHOULD be expressed in the translation, so by looking at a translation, one can decide which Greek variant it followed
// 
function AION_NEWSTRONGS_FIX_REF_GREEK($input, $table, &$database, &$lex_array, &$lex2_array, $morph_array) {
	// INIT
	static $abooks = NULL, $tbooks = NULL;
	if (!$abooks) {
		$abooks = AION_BIBLES_LIST();
		$tbooks = AION_BIBLES_LIST_TYN();
	}
	$last_indx = $last_chap = $last_vers = NULL;
	if (empty($database[$table])) {
		$database[$table] = "INDEX\tBOOK\tCHAPTER\tVERSE\tSTRONGS\tFLAG\tMORPH\tWORD\tENGLISH\tENTRY\tPUNC\tEDITIONS\tSPELLINGS\tMEANINGS\tADDITIONAL\tCONJOIN\n";
	}
	
	// LOOP THRU ALL LINES
	static $act1940 = 0;
	static $cor1312 = 0;
	foreach( $input as $line ) {
		// empty
		if (empty(implode("",$line))) { continue; }

		// Custom reversification, change the reference of the original Greek edition to the KJV standard, only when outside KJV references
		if ($line['REF'] == '65_3Jn.001.015') {
			$line['REF'] = '65_3Jn.001.014';
		}
		else if ($line['REF'] == '67_Rev.012.018') {
			$line['REF'] = '67_Rev.013.001';
		}
		else if ($line['REF'] == '45_Act.019.040') {
			++$act1940;
			if ($act1940>21) { $line['REF'] = '45_Act.019.041'; }
		}
		else if ($line['REF'] == '48_2Co.013.012') {
			++$cor1312;
			if ($cor1312>5) { $line['REF'] = '48_2Co.013.013'; }
		}
		else if ($line['REF'] == '48_2Co.013.013') {
			$line['REF'] = '48_2Co.013.014';
		}
		
		// INIT
		$WORDUP = trim($line['WORD']);
		$newmess = "FIX_REF\tref='".$line['REF']."'\tword='$WORDUP'\tmorph='".$line['MORPH']."'\tstrongs='".$line['STRONGS']."'";

		// Check and fix!
		$line['ENGLISH'] = trim($line['ENGLISH']);
		if (preg_match("#^[^<]*<[^>]*$#u", $line['ENGLISH']) ||
			preg_match("#^[^(]*\([^)]*$#u", $line['ENGLISH']) ||
			preg_match("#^[^[]*\[[^\]]*$#u", $line['ENGLISH'])
			) {
			AION_ECHO($warn="WARN! $newmess suspect tag in English word\n".print_r($line,TRUE)."\n\n\n");
			$database['WARNINGS'] .= $warn;
			if ($line['ENGLISH']=='<the.') { $line['ENGLISH']='<the>'; }
			else if ($line['ENGLISH']=='Blessed [is[') { $line['ENGLISH']='Blessed [is]'; }
		}
		if (!($line['ENGLISH'] = preg_replace("/</us",'(',$line['ENGLISH']))) { AION_ECHO("ERROR! REF_GREEK() preg_replace(".$line['ENGLISH']); }
		if (!($line['ENGLISH'] = preg_replace("/>/us",')',$line['ENGLISH']))) { AION_ECHO("ERROR! REF_GREEK() preg_replace(".$line['ENGLISH']); }

		// SPACE MORPH
		$line['MORPH'] = preg_replace("/ /u", '',$morph_before=$line['MORPH']);
		if ($line['MORPH']!=$morph_before) {
			$database['MISS_MORPHS'] .= ($warn="$newmess\tspace morph=".$line['MORPH']."\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
		}

		// TAGNT entry type
		if (preg_match('#^=NA same TR#',$line['TYPE'])) {					$entry="NA=TR"; }
		else if (preg_match('#^=NA diff TR.*#',$line['TYPE'])) {			$entry="NA!=TR"; }
		else if (preg_match('#^=NA not TR.*#',$line['TYPE'])) {				$entry="NA"; }
		else if (preg_match('#^=TR\+NIV\/ESV not NA.*#',$line['TYPE'])) {	$entry="NIV"; }
		else if (preg_match('#^=TR not NA or NIV\/ESV.*#',$line['TYPE'])) {	$entry="TR"; }
		else if (preg_match('#^=TR not NA. In NIV\/ESV.*#',$line['TYPE'])) {$entry="TR+"; }
		else if (preg_match('#^Not in NA or TR.*#',$line['TYPE'])) {		$entry="Other"; }
		else { AION_ECHO("ERROR! $newmess word type missing\n".print_r($line,TRUE)); }

		// spellings
		$spellings = trim(preg_replace('/\s+([,;]+)/','$1', preg_replace('/\s+/',' ', $line['SPELLINGS']))," ,;");
		$WORDYEP = trim(strtok($spellings, ",;"));
		
		// PARSE REFERENCE
		// 41_Mat.001.001	002
		if (!preg_match("#^[\d]+[[:punct:]]+([0-9A-Za-z]+)[[:punct:]]+([\d]+)[[:punct:]]+([\d]+)$#u",$line['REF'],$match)) {	AION_ECHO("ERROR! $newmess corrupt ref\n".print_r($line,TRUE)); }
		$book = strtoupper($match[1]);
		$database['BOOKS'][$book] = $book; // unique book names
		if (empty($tbooks[$book])) { AION_ECHO("ERROR! $newmess missing book='$book'\n".print_r($line,TRUE)); }
		$book = $tbooks[$book];
		$indx = sprintf('%03d', (int)array_search($book,array_keys($abooks)));
		$chap = sprintf('%03d', (int)$match[2]);
		$vers = sprintf('%03d', (int)$match[3]);

		// Sorted properly?
		if ($last_indx && (
			($last_indx >  (int)$indx) ||
			($last_indx <  (int)$indx && ($last_indx+1 != (int)$indx || 1 != (int)$chap || 1 != (int)$vers)) ||
			($last_indx == (int)$indx &&  $last_chap >  (int)$chap) ||
			($last_indx == (int)$indx &&  $last_chap <  (int)$chap && ($last_chap+1 != (int)$chap || 1 != (int)$vers)) ||
			($last_indx == (int)$indx &&  $last_chap == (int)$chap &&  $last_vers+1 != (int)$vers && $last_vers != (int)$vers)
			)) {
			AION_ECHO($warn="WARN! $newmess reference sort order problem!\n".print_r($line,TRUE)."\n\n\n");
			$database['WARNINGS'] .= $warn;			
		}
		$last_indx = (int)$indx;
		$last_chap = (int)$chap;
		$last_vers = (int)$vers;
		
		// SKIP EMPTY AND PUNCTUATION
		if (empty($line['STRONGS'])) {
			$database['CORRUPT_STRONGS'] .= ($warn="$newmess\tword with empty strongs\n");
			AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
			continue;
		}
		
		// PARSE STRONGS AND MORPHS
		$jointype = "W"; // W=next word, Ketiv=written word, Qere=read word, P=word parts, J=joined words, D=divided word
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

			// MORPHS
			$morph = trim(($key==0 ? $mpart[0] : (empty($mpart[$key]) ? "Unknown" : $mpart[$key])));
			if (empty($morph) || empty($morph_array[$morph])) {
				$database['MISS_MORPHS'] .= ($warn="$newmess\tmissing morph=$morph key=$key mpart[key]=".$mpart[$key]."\n");
				AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");
			}
			// Editions
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
			$editions = explode('+', trim(preg_replace('/^0(\d+)/', '+U$1', preg_replace('/\+0(\d+)/', '+U$1', preg_replace('/[[:punct:]]+/', '+', preg_replace('/[<>]+\d+[:]+/', '+', preg_replace('/<14\.(24|25|26):/', '+', preg_replace('/\s+/', '', trim($line['EDITIONS']))))))),';+, '));
			if (($editions_diff=array_diff($editions, array_keys($vartrans)))) {
				$database['MISS_MANU'] .= ($warn="$newmess\tmissing manuscript edition: ".implode(",",$editions_diff)." from editions=".$line['EDITIONS']."\n");
				AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");	
			}
			$editions = trim(preg_replace('/[+]+/', '+', preg_replace('/\s+/', '', $line['EDITIONS'])),";+, ");
			
			// editions and spelling
			if (substr_count($editions,";") != substr_count($spellings,";") || substr_count($editions,",") != substr_count($spellings,",")) {
				$database['CORRUPT_VARIANT'] .= ($warn="$newmess\tdifferent edition and spelling count: '$editions' / '$spellings'\n");
				AION_ECHO("WARN!\t$warn".print_r($line,TRUE)."\n\n\n");					
			}

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
					$editionsM = explode('+', trim(preg_replace('/^0(\d+)/', '+U$1', preg_replace('/\+0(\d+)/', '+U$1', preg_replace('/[[:punct:]]+/', '+', preg_replace('/[<>]+\d+[:]+/', '+', preg_replace('/<14\.(24|25|26):/', '+', preg_replace('/\s+/', '', trim($match[1]))))))),';+, '));
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
			
			// Additional meaning parse
			// Jacob§Jacob|Israel@Gen.25.26
			$additional = trim(preg_replace('/\d+_/','', $line['ADDITIONAL']));
			if (!empty($additional)) {
				if (preg_match("#^([^§@]+)[§]+([^§@]+)[@]+([^§@]+)$#u",$additional,$addmatch)) {
					if (preg_match("#(§§|@@)#u",$additional)) {
						AION_ECHO("WARN! $newmess problem parsing ADDITIONAL doubles: $additional\n".print_r($line,TRUE));
					}
					$addmatch[1] = trim($addmatch[1]);
					$addmatch[2] = trim($addmatch[2]);
					$addmatch[2] = preg_replace("#^".$addmatch[1]."$#u", "", $addmatch[2]);
					$addmatch[2] = preg_replace("#^".$addmatch[1]."[|/]+#u", "", $addmatch[2]);
					$addmatch[2] = preg_replace("#[|/]+".$addmatch[1]."$#u", "", $addmatch[2]);
					$addmatch[2] = trim($addmatch[2]);
					if (!empty($addmatch[2])) { $addmatch[2]= " (".$addmatch[2].")"; }
					$addmatch[3] = trim($addmatch[3]);
					if (preg_match("#^([^.]+)\.(\d+)\.([\d+]+)$#u",$addmatch[3],$addref)) {
						$addmatch[3] = trim($addref[1])." ".trim($addref[2]).":".trim($addref[3]);
					}
					else {
						AION_ECHO("WARN! $newmess problem parsing ADDITIONAL reference: $additional\n".print_r($line,TRUE));
					}
					$addmatch[3] = " @ ".$addmatch[3];
					$additional = $addmatch[1].$addmatch[2].$addmatch[3];
				}
				else if (preg_match("#^([^§@]+)[§]+([^§@]+)$#u",$additional,$addmatch)) {
					$addmatch[1] = trim($addmatch[1]);
					$addmatch[2] = trim($addmatch[2]);
					$addmatch[2] = preg_replace("#^".$addmatch[1]."$#u", "", $addmatch[2]);
					$addmatch[2] = preg_replace("#^".$addmatch[1]."\|#u", "", $addmatch[2]);
					$addmatch[2] = preg_replace("#\|".$addmatch[1]."$#u", "", $addmatch[2]);
					$addmatch[2] = trim($addmatch[2]);
					if (!empty($addmatch[2])) { $addmatch[2]= " (".$addmatch[2].")"; }
					$additional = $addmatch[1].$addmatch[2];
				}
				else if (preg_match("#[§@]+#u",$additional)) {
					AION_ECHO("WARN! $newmess problem parsing ADDITIONAL whole: $additional\n".print_r($line,TRUE));
				}
			}
		
			// construct the output
			// The Greek and Hebrew columns need to be similar because same functions process first columns of Greek and Hebrew
			// INDEX	BOOK	CHAPTER	VERSE	STRONGS	FLAG	MORPH	WORD
			//
			$database[$table] .=
				("$indx\t$book\t$chap\t$vers\t$strongs\t$jointype\t$morph\t$WORDYEP\t".
				$line['ENGLISH']."\t".
				$entry."\t".
				$WORDUP."\t".
				"$editions\t".
				"$spellings\t".
				"$meanings\t".
				"$additional\t".
				trim($line['CONJOIN'])."\n");
			// W=next word, J=joined words
			$jointype = "J";
		}
	}
}


// Count all strongs references
function AION_NEWSTRONGS_COUNT_REF($references, $output) {
	// init
	$newmess  = "COUNT_REF($output) ";
	$yeah_array = $book_array = $chap_array = $vers_array = array();
	$indx_last = $chap_last = $vers_last = NULL;
	$references .= "0\t0\t0\t0\t0\n";
	$line = strtok($references, "\n"); // add empty line to flush the last line
	$line = strtok( "\n" ); // skip first line
	// distinct strongs numbers
	while ($line !== false) {
		// reference  "$indx\t$book\t$chap\t$vers\t$strongs\t$jointype\t$morph\t$WORDUP$variants\n";
		if (!preg_match("#^(\d+)\t([A-Z0-9]+)\t(\d+)\t(\d+)#u", $line, $match)) {	AION_ECHO("ERROR! $newmess corrupt hebrew ref\n".print_r($line,TRUE)); }
		$indx = $match[1];
		$chap = $match[3];
		$vers = $match[4];
		// strongs
		if (FALSE===preg_match_all("#(?<!:)([GH]{1}[\d]{1,5})([a-z]{0,1})#u", $line, $parsed, PREG_SET_ORDER)) { AION_ECHO("ERROR! $newmess !preg_match_all()"); } // to avoid Greek conjoined strongs #s, [^:]{1} or (?<!:)
		foreach($parsed as $s) {
			$book_array[$s[1]] = $chap_array[$s[1]] = TRUE;
			$vers_array[$s[1]] += 1;
			if (!empty($s[2])) {
				$book_array[$s[1].$s[2]] = $chap_array[$s[1].$s[2]] = TRUE;
				$vers_array[$s[1].$s[2]] += 1;
			}
		}
		// counts
		if ($indx_last !== NULL) {
			if ($indx != $indx_last) {
				foreach($book_array as $s => $x) {
					if (!isset($yeah_array[$s])) { $yeah_array[$s] = array(0,0,0,0); }
					++$yeah_array[$s][0];
				}
				unset($book_array);	$book_array = array();
			}
			if ($indx != $indx_last || $chap != $chap_last) {
				foreach($chap_array as $s => $x) {
					if (!isset($yeah_array[$s])) { $yeah_array[$s] = array(0,0,0,0); }
					++$yeah_array[$s][1];
				}
				unset($chap_array);	$chap_array = array();
			}
			if ($indx != $indx_last || $chap != $chap_last || $vers != $vers_last) {
				foreach($vers_array as $s => $x) {
					if (!isset($yeah_array[$s])) { $yeah_array[$s] = array(0,0,0,0); }
					++$yeah_array[$s][2];
					$yeah_array[$s][3] += $x;
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
	$line = strtok($references, "\n");
	$line = strtok( "\n" ); // skip first line
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
	$line = strtok($references, "\n");
	$line = strtok( "\n" ); // skip first line
	while ($line !== false) {
		// parse the line
		if (!preg_match("#^(\d+)\t([A-Z0-9]+)\t(\d+)\t(\d+)\t([GH]{1}[0-9]{1,5})([a-z]{0,1})#u", $line, $match)) {	AION_ECHO("ERROR! $newmess corrupt hebrew ref\n".print_r($line,TRUE)); }
		$book = $match[2];
		$chap = (int)$match[3];
		$strg = $match[5];
		$extn = $match[5].$match[6];
		// create usage array
		if (!isset($usage[$strg])) {					$usage[$strg] = array( 'STRONGS'=>$strg, 'USAGE'=>str_pad("",$usage_length)); }
		if ($extn != $strg && !isset($usage[$extn])) {	$usage[$extn] = array( 'STRONGS'=>$extn, 'USAGE'=>str_pad("",$usage_length)); }
		// record usage
		if (!isset($chapters[$book])) {															AION_ECHO("ERROR! $newmess book chapter index not found\n".print_r($line,TRUE)); }
		$indx = $chapters[$book] + $chap - 1;
		if (!isset($usage[$strg]['USAGE'][$indx])) {											AION_ECHO("ERROR! $newmess book chapter index usage not set\n".print_r($line,TRUE)); }
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
			if (!preg_match("#[GH]{1}[\d]{1,5}[a-z]{0,1}#u", $strongs)) {						AION_ECHO("ERROR! $newmess !preg_match(strongs=$strongs)"); }
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


// Count all strongs references
function AION_NEWSTRONGS_COUNT_REF_CHECKER($countsF, $source1, $begin1, $end1, $source2, $begin2, $end2, $source3, $begin3, $end3, $source4, $begin4, $end4, $file, $save) {
	$newmess = "COUNT_REF_CHECKER $counts";
	// read data
	$counts = json_decode(file_get_contents($countsF), true);
	if (empty($counts)) {																						AION_ECHO("ERROR! $newmess !json_decode($countsF)"); }
	if (($source  = file_get_contents( $source1 )) === FALSE ) {												AION_ECHO("ERROR! $newmess !file_get_contents($source1)"); }
	if ($begin1 && !($source=preg_replace("/^.*?$begin1/us",$begin1,$source,-1,$count)) || $count!=1) {			AION_ECHO("ERROR! $newmess $source1 no beginning='$begin1' $count"); }
	if ($end1   && !($source=preg_replace("/$end1.*$/us","",$source,-1,$count)) || $count!=1) {					AION_ECHO("ERROR! $newmess $source1 no ending='$end1' $count"); }
	if ($source2) {
		if (($sourceT = file_get_contents( $source2 )) === FALSE ) {											AION_ECHO("ERROR! $newmess !file_get_contents($source2)"); }
		if ($begin2 && !($sourceT=preg_replace("/^.*?$begin2/us",$begin2,$sourceT,-1,$count)) || $count!=1) {	AION_ECHO("ERROR! $newmess $source2 no beginning='$begin2' $count"); }
		if ($end2   && !($sourceT=preg_replace("/$end2.*$/us","",$sourceT,-1,$count)) || $count!=1) {			AION_ECHO("ERROR! $newmess $source2 no ending='$end2' $count"); }
		$source .= $sourceT;
	}
	if ($source3) {
		if (($sourceT = file_get_contents( $source3 )) === FALSE ) {											AION_ECHO("ERROR! $newmess !file_get_contents($source3)"); }
		if ($begin3 && !($sourceT=preg_replace("/^.*?$begin3/us",$begin3,$sourceT,-1,$count)) || $count!=1) {	AION_ECHO("ERROR! $newmess $source3 no beginning='$begin3' $count"); }
		if ($end3   && !($sourceT=preg_replace("/$end3.*$/us","",$sourceT,-1,$count)) || $count!=1) {			AION_ECHO("ERROR! $newmess $source3 no ending='$end3' $count"); }
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
	// save the file
	if ($save && $file && !file_put_contents($file, $source)) {													AION_ECHO("ERROR! $newmess !file_put_contents($file)"); }
	// loop through counts
	foreach($counts as $strongs => $numbers) {
		if ($strongs == "H0") { continue; }
		if (FALSE===preg_match("#^([GH]{1})([0-9]{1,5})([a-z]{0,1})$#u", $strongs, $match)) { AION_ECHO("ERROR! $newmess !preg_match()"); }
		$strongs = $match[1].sprintf('%04d',$match[2]).$match[3];
		if (FALSE===preg_match_all("#(?<!:)($strongs)[^\d]{1}#u", $source, $parsed, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! $newmess !preg_match_all()"); } // to avoid Greek conjoined strongs #s, [^:]{1} or (?<!:)
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
			$book = $match[2];
			$chap = $match[3];
			$vers = $match[4];
			if ($vers != $last_vers) {
				if (isset($index["$book$chap$vers"])) { AION_ECHO("ERROR! $newmess reference tag index already set???\n".print_r($line,TRUE)); }
				$index["$book$chap$vers"] = $bytes;
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
		while(($line=fgets($fd))) {
			if (!preg_match("#^(\d+)\t([A-Z0-9]+)\t(\d+)\t(\d+)\t#u", $line, $match)) {	AION_ECHO("ERROR! $newmess corrupt reference tag\n".print_r($line,TRUE)); }
			$book = $match[2];
			$chap = $match[3];
			$vers = $match[4];
			if ("$book$chap$vers" != $verse) { break; }
			echo "$newmess $line";
		}
	}
	fclose($fd);
	return;
}



// Read a CSV file!
function AION_NEWSTRONGS_CSV($file, $delim, $table, $keys, $key, &$result) {
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


// THE WHOLE SHEBANG
function AION_NEWSTRONGS_USAGE_FOLDER($tagf, $lex1, $lex2, $lex3, $fold) {
	$newmess = "USAGE FOLDER $fold ";
	// read the info
	$database = array();
	if (($tags = file_get_contents( $tagf )) === FALSE) { AION_ECHO("ERROR! $newmess !file_get_contents($tagf)"); }
	if ($lex1) {	AION_FILE_DATA_GET( $lex1, 'T_LEX1', $database, array('STRONGS'),	FALSE ); }
	if ($lex2) {	AION_FILE_DATA_GET( $lex2, 'T_LEX2', $database, array('STRONGS'),	FALSE ); }
	if ($lex3) {	AION_FILE_DATA_GET( $lex3, 'T_LEX3', $database, array('STRONGS'),	FALSE ); }
	// make folders
	$modulo = 10; // chapter files will only contain verses grouped by modulo return values of 0 through 9
	system('rm -rf '.$fold);
	if (!mkdir($fold)) { AION_ECHO("ERROR! !mkdir: $fold"); }
	for($x=0; $x < $modulo; ++$x) { if (!mkdir("$fold/$x")) { AION_ECHO("ERROR! !mkdir: $fold/$x"); } }
	// make chapter jsons
	$last_index = $last_book = $last_chapter = NULL;
	$json = array();
	for($x=0; $x < $modulo; ++$x) { $json[$x] = array(); } // separate json for each modulo return
	$tags .= "\t\t\t\t\t\t\t\t\t\r\n";
	$line = strtok($tags,"\n");
	while ($line !== false) {
		$tagA = explode("\t",$line);
		if ($tagA[0][0]=="#" || $tagA[0]=="INDEX" || count($tagA)<8) { $line = strtok( "\n" ); continue; }
		$tag = array(
			"INDEX"		=> $tagA[0],
			"BOOK"		=> $tagA[1],
			"CHAPTER"	=> $tagA[2],
			"VERSE"		=> $tagA[3],
			"STRONGS"	=> $tagA[4],
			"FLAG"		=> $tagA[5],
			"MORPH"		=> $tagA[6],
			"WORD"		=> $tagA[7],
			);
		if (!empty($tagA[8] )) { $tag["ENGLISH"]	= $tagA[8];  }
		if (!empty($tagA[9] )) { $tag["ENTRY"]		= $tagA[9];  }
		if (!empty($tagA[10])) { $tag["PUNC"]		= $tagA[10]; }
		if (!empty($tagA[11])) { $tag["EDITIONS"]	= $tagA[11]; }
		if (!empty($tagA[12])) { $tag["SPELLINGS"]	= $tagA[12]; }
		if (!empty($tagA[13])) { $tag["MEANINGS"]	= $tagA[13]; }
		if (!empty($tagA[14])) { $tag["ADDITIONAL"]	= $tagA[14]; }
		if (!empty($tagA[15])) { $tag["CONJOIN"]	= $tagA[15]; }
		
		// write the json file
		if ($last_book && ($last_book != $tag['BOOK'] || $last_chapter != $tag['CHAPTER'])) {
			global $strongs_json_flag;
			for($x=0; $x < $modulo; ++$x) {
				if (file_put_contents(($file="$fold/$x/$last_index-$last_book-$last_chapter.json"),json_encode($json[$x], $strongs_json_flag)) === FALSE ) {	AION_ECHO("ERROR! $newmess file_put_contents $file" ); }
			}
			AION_unset($json); unset($json); $json = NULL; $json = array();
		}
		// build the json file
		$strongs = $tag["STRONGS"];
		if (FALSE===preg_match("#^([GH]{1}[0-9]{1,5})([a-z]{0,1})$#u", $strongs, $match)) { AION_ECHO("ERROR! $newmess !preg_match()"); }
		$strongsX = $match[1]; // assuming TBESH H#####[a-z] is related to STRONGS H#####
		$temp = array(
			"S"	=> $strongs,
			"F"	=> $tag["FLAG"], 
			"M"	=> $tag["MORPH"],
			"W"	=> $tag["WORD"],
			);
		if (!empty($tag["ENGLISH"])) {					$temp["E"] = $tag["ENGLISH"]; }
		if (!empty($tag["ENTRY"])) {					$temp["N"] = $tag["ENTRY"]; }
		if (!empty($tag["PUNC"])) {						$temp["P"] = $tag["PUNC"]; }
		if (!empty($tag["EDITIONS"])) {					$temp["D"] = $tag["EDITIONS"]; }
		if (!empty($tag["SPELLINGS"])) {				$temp["L"] = $tag["SPELLINGS"]; }
		if (!empty($tag["MEANINGS"])) {					$temp["G"] = $tag["MEANINGS"]; }
		if (!empty($tag["ADDITIONAL"])) {				$temp["A"] = $tag["ADDITIONAL"]; }
		if (!empty($tag["CONJOIN"])) {					$temp["C"] = $tag["CONJOIN"]; }
		//if (!empty($database['T_LEX1'][$strongsX])) {	$temp["1"] = AION_NEWSTRONGS_ASSOCIATIVE_RENAME($database['T_LEX1'][$strongsX]); }
		//if (!empty($database['T_LEX2'][$strongs])) {	$temp["2"] = AION_NEWSTRONGS_ASSOCIATIVE_RENAME($database['T_LEX2'][$strongs]); }
		//if (!empty($database['T_LEX3'][$strongs])) {	$temp["3"] = AION_NEWSTRONGS_ASSOCIATIVE_RENAME($database['T_LEX3'][$strongs]); }
		$json[((int)$tag['VERSE'] % $modulo)][(int)$tag['VERSE']][] = $temp;
		AION_unset($temp); unset($temp); $temp = NULL;
		// mark position
		$last_index		= $tag['INDEX'];
		$last_book		= $tag['BOOK'];
		$last_chapter	= $tag['CHAPTER'];
		$last_verse		= $tag['VERSE'];
		$line = strtok( "\n" );
	}
	// clear memory
	AION_unset($database); unset($database); $database = NULL;
}
function AION_NEWSTRONGS_ASSOCIATIVE_RENAME($before) {
	$after = array();
	foreach($before as $key => $value) { $after["$key[0]"] = $value; }
	return($after);
}


// UGLY DEBUG
function AION_NEWSTRONGS_UGLYDEBUG() {
	static $abooks = NULL, $tbooks = NULL;
	if (!$abooks) {
		$abooks = AION_BIBLES_LIST();
		$tbooks = AION_BIBLES_LIST_TYN();
	}
	$strongs = "H9016";
	$total = $lines = 0;
	$contents =	file_get_contents("./aion_strongs/TOTHT - Tyndale OT Hebrew Tagged text Gen-Deu - TyndaleHouse.com STEPBible.org CC BY-NC.txt") .
				file_get_contents("./aion_strongs/TOTHT - Tyndale OT Hebrew Tagged text Jos-Est - TyndaleHouse.com STEPBible.org CC BY-NC.txt") .
				file_get_contents("./aion_strongs/TOTHT - Tyndale OT Hebrew Tagged text Job-Sng - TyndaleHouse.com STEPBible.org CC BY-NC.txt") .
				file_get_contents("./aion_strongs/TOTHT - Tyndale OT Hebrew Tagged text Isa-Mal - TyndaleHouse.com STEPBible.org CC BY-NC.txt") . "\n";
	$len = strlen($contents);
	$line = strtok($contents, "\n");
	while ($line !== false) {
		if (preg_match_all("#$strongs#u", $line, $matches, PREG_PATTERN_ORDER)) {
			//Gen.8.17-13	Gen.8.17-13	הָאָרֶץ	הָ/אָ֖רֶץ	HTd/Ncbsa	H9009=ה=the/H0776=אֶ֫רֶץ=land_§3_planet
			//Gen.8.17-14.K	Gen.8.17-14k	הוֹצֵא	הוֹצֵא	HVhv2ms	H3318=יָצָא=to come out_§2_send|take_out|release
			//Gen.8.17-14.Q	Gen.8.17-14q	הַיְצֵא	הַיְצֵ֣א	HVhv2ms	H3318=יָצָא=to come out_§2_send|take_out|release
			if (!preg_match("#^[[:alnum:]]{3}\.\d+\.\d+\-\d+[.KQ]*\t([[:alnum:]]{3})\.(\d+)\.(\d+)\-#u", $line, $refs)) {	AION_ECHO("ERROR! AION_NEWSTRONGS_UGLYDEBUG() preg_match line=$line"); }
			if (empty($tbooks[($book=strtoupper($refs[1]))])) {	AION_ECHO("ERROR! AION_NEWSTRONGS_UGLYDEBUG() !tbooks line=$line books=$book"); }
			$book = $tbooks[$book];
			$indx = sprintf('%03d', (int)array_search($book,array_keys($abooks)));
			$total += ($x=count($matches[0]));
			while($x-- > 0) { echo $indx."\t".$book."\t".sprintf('%03d', (int)$refs[2])."\t".sprintf('%03d', (int)$refs[3])."\t$strongs\n"; }
		}
		++$lines;
		$line = strtok( "\n" );		
	}
	echo "FILESIZE = $len / LINES = $lines / TOTAL $strongs = $total";
}


// CREATE THE STEPBIBLE
function AION_NEWSTRONGS_STEPBIBLE($hebtag,$hebdex,$heblex,$gretag,$gredex,$grelex,$bible_ama,$bible_con) {
	// setup
	$newmess = "STEPBIBLE\t$bible_ama";
	mb_regex_encoding("UTF-8");
	mb_internal_encoding("UTF-8");	
	$bibledata_ama = "// STEPBible Amalgamant, compiled by ABCMS (alpha)\n\n";
	$bibledata_con = "// STEPBible Concordant, compiled by ABCMS (alpha)\n\n";
	
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
		if (!preg_match("#^(\d+)\t([A-Z0-9]+)\t(\d+)\t(\d+)\t([GH]{1}[0-9]{1,5}[a-z]{0,1})#u", $line, $match)) {	AION_ECHO("ERROR! $newmess corrupt ref tag\n".print_r($line,TRUE)); }
		$book = $match[2]; $chap = (int)$match[3]; $vers = (int)$match[4]; $strg = $match[5];
		$book = strtoupper($book); if (!ctype_digit($book[0])) { $book[1] = strtolower($book[1]); } $book[2] = strtolower($book[2]);
		if ($book != $last_book) { AION_ECHO("BUILDING Concordant STEPBible! $book"); $last_book = $book; }
		if ($vers != $last_vers) {
			$bibledata_ama .= "\n$book $chap:$vers "; $last_vers = $vers;
			$bibledata_con .= "\n$book $chap:$vers "; $last_vers = $vers;
		}
		// lexicon entry
		if ($strg=="H0" || $strg=="G0") { $line = strtok( "\n" ); continue; }
		if (empty($index[$strg])) { 								AION_ECHO("ERROR! $newmess lex dex not found: $line"); }
		if (fseek($fd, $index[$strg]) || !($entry=fgets($fd)) ||
			!preg_match("#^$strg\t#u",$entry)) {					AION_ECHO("ERROR! $newmess dex lex not found, index=".$index[$strg].": $line, $entry"); }
		$defs = explode("\t",$entry);
		$bibledata_ama .= (" ".$defs[3]);
		$bibledata_con .= (" ".$defs[3]);
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
	$line = strtok($contents, "\n");
	while ($line !== false) {
		if (!ctype_digit($line[0])) { $line = strtok( "\n" ); continue; }
		if (!preg_match("#^(\d+)\t([A-Z0-9]+)\t(\d+)\t(\d+)\t([GH]{1}[0-9]{1,5}[a-z]{0,1})\t([^	]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t([^\t]*)\t#u", $line, $match)) {	AION_ECHO("ERROR! $newmess corrupt ref tag\n".print_r($line,TRUE)); }
		$book = $match[2]; $chap = (int)$match[3]; $vers = (int)$match[4]; $strg = $match[5]; $amal = $match[9]; $wtype = $match[10];
		$book = strtoupper($book); if (!ctype_digit($book[0])) { $book[1] = strtolower($book[1]); } $book[2] = strtolower($book[2]);
		if ($book != $last_book) { AION_ECHO("BUILDING Concordant STEPBible! $book"); $last_book = $book; }
		if ($vers != $last_vers) {
			$bibledata_ama .= "\n$book $chap:$vers "; $last_vers = $vers;
			$bibledata_con .= "\n$book $chap:$vers "; $last_vers = $vers;
		}
		// skip lines
		if ($strg=="H0" || $strg=="G0") { $line = strtok( "\n" ); continue; }
		$wordtypes = array(
			//"NA=TR", 	// =NA same TR		133304 words are translated in both traditional KJV and modern Bibles.	NA27/28 + TR + others all having the same meaning
			//"NA!=TR",	// =NA diff TR		3922 words may translate differently in traditional and modern Bibles.	NA27/28 + others having the same meaning but there are.also .. 	| Variants = different meanings in TR + others
			//"NA",		// =NA not TR		761 words are translated in most modern Bibles but not in the KJV.		NA27/28 + others having the same meaning but not TR
			//"NIV",	// =TR+NIV/ESV not NA		227 words are translated in the KJV and in some modern Bibles.			TR + others having the same meaning but not NA27/28
			//"TR+",	// =TR not NA. In NIV/ESV	
			"TR",		// =TR not NA,NIV/ESV		3573 words are translated in the KJV but not in most modern Bibles.		TR + others having the same meaning but not NA27/28
			"Other",	// Not in NA or TR			245 words occur in early manuscripts but not translated in most Bibles.	Others having a word that is not found in TR or NA27/28
			);
		if ($wtype=="TR" || $wtype=="Other") { $line = strtok( "\n" ); continue; }
		// lexicon entry
		if (empty($index[$strg])) { 								AION_ECHO("ERROR! $newmess lex dex not found: $line"); }
		if (fseek($fd, $index[$strg]) || !($entry=fgets($fd)) ||
			!preg_match("#^$strg\t#u",$entry)) {					AION_ECHO("ERROR! $newmess dex lex not found, index=".$index[$strg].": $line, $entry"); }
		$defs = explode("\t",$entry);
		$bibledata_ama .= (" ".$amal);
		$bibledata_con .= (" ".$defs[3]);
		$line = strtok( "\n" );
	}
	fclose($fd);
	unset($contents); $contents=NULL;
	unset($index); $index=NULL;

	// fixes
	if (!($bibledata_ama=preg_replace("#\[obj\.\]#ui", "[definite]", $bibledata_ama))) {	AION_ECHO("ERROR! $newmess: preg_replace([obj.])"); }
	if (!($bibledata_con=preg_replace("#\[obj\.\]#ui", "[definite]", $bibledata_con))) {	AION_ECHO("ERROR! $newmess: preg_replace([obj.])"); }	

	if (!($bibledata_ama=preg_replace("#[ ]+#u", " ", $bibledata_ama))) {				AION_ECHO("ERROR! $newmess: preg_replace(spaces)"); }	
	if (!($bibledata_con=preg_replace("#[ ]+#u", " ", $bibledata_con))) {				AION_ECHO("ERROR! $newmess: preg_replace(spaces)"); }

	if (!($bibledata_ama=preg_replace("#<the>#ui", "(the)", $bibledata_ama))) {			AION_ECHO("ERROR! $newmess: preg_replace(spaces)"); }	
	if (!($bibledata_con=preg_replace("#<the>#ui", "(the)", $bibledata_con))) {			AION_ECHO("ERROR! $newmess: preg_replace(spaces)"); }
	
	// write the Bible
	if (file_put_contents($bible_ama,$bibledata_ama."\n") === FALSE ) {					AION_ECHO("ERROR! $newmess file_put_contents($bible_ama)" ); }
	if (file_put_contents($bible_con,$bibledata_con."\n") === FALSE ) {					AION_ECHO("ERROR! $newmess file_put_contents($bible_con)" ); }

	// done
	AION_ECHO("DONE $newmess");
	return;
}

