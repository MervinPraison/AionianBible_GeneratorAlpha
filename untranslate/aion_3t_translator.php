#!/usr/local/bin/php
<?php

/////////////////////////////////////////////////////////////////
// BEGIN
AION_ECHO("BEGIN");

/////////////////////////////////////////////////////////////////
// INIT
$PACKS = array(
	'Arabic'	=> array("Holy-Bible---Arabic---New-Arabic-Bible","Holy-Bible---Arabic---Arabic-Van-Dyck-Bible"),
	'Bengali'	=> array("Holy-Bible---Bengali---Bengali-Bible"),
	'Chinese'	=> array("Holy-Bible---Chinese---Chinese-Union-Version-Simplified","Holy-Bible---Chinese---Chinese-Union-Version-Traditional",),
	'English'	=> array("Holy-Bible---English---World-English-Bible","Holy-Bible---English---Catholic-Public-Domain"),
	'French'	=> array("Holy-Bible---French---French-Louis-Segond-1910-Bible","Holy-Bible---French---French-Crampon-Bible"),
	'German'	=> array("Holy-Bible---German---German-Elberfelder-1905","Holy-Bible---German---German-Katholiche-Riessler"),
	'Hindi'		=> array("Holy-Bible---Hindi---Hindi-Bible"),
	'Japanese'	=> array("Holy-Bible---Japanese---Japanese-Kougo-yaku","Holy-Bible---Japanese---Japanese-Meiji-yaku","Holy-Bible---Japanese---New-Japanese-New-Testament"),
	'Korean'	=> array("Holy-Bible---Korean---Korean-RV"),
	'Portuguese'=> array("Holy-Bible---Portuguese---Biblia-Livre","Holy-Bible---Portuguese---Almeida-Bible-1911"),
	'Panjabi'	=> array("Holy-Bible---Panjabi---Punjabi-Bible"),
	'Russian'	=> array("Holy-Bible---Russian---Russian-Synodal-Translation"),
	'Spanish'	=> array("Holy-Bible---Spanish---Free-Bible","Holy-Bible---Spanish---Sencillo-Bible"),
	);
	$thedate = date('m/d/Y H:i:s');
	$theyear = date('Y');
	$HEADER = <<<EOT
# File Name: A-StudyPack.txt
# File Date: $thedate
# File Purpose: Supporting resource for the Aionian Bible project
# File Location: http://resources.AionianBible.org
# File Source: Nainoia Inc Aionian Bible and STEPBible
# File Copyright: Creative Commons Attribution No Derivative Works 4.0, 2018-$theyear
# File Copyright Format: Creative Commons Attribution No Derivative Works 4.0, 2018-$theyear
# File Generator: ABCMS (alpha)
# File Accuracy: Contact publisher with corrections to file format or content
# Publisher Name: Nainoia Inc
# Publisher Contact: http://www.AionianBible.org/Publisher
# Publisher Mission: http://www.AionianBible.org/Preface
# Publisher Website: http://NAINOIA-INC.signedon.net
# Publisher Facebook: https://www.Facebook.com/AionianBible
# STEPBible Copyright: Creative Commons Attribution 4.0
# STEPBible Source Link: https://github.com/STEPBible/STEPBible-Data
#
# INTRODUCTION:
# This file as a resource for Bible translation and study of the underlying languages.
# Please report concerns at http://www.AionianBible.org/Publisher.
# If your language StudyPack is not available contact http://www.AionianBible.org/Publisher.
# Please report STEPBible concerns at https://github.com/STEPBible/STEPBible-Data
#
# FILES:
# AREADME.txt									Explanation
# Greek-Lexicon.txt								Tyndale Greek extended Strongs lexicon
# Greek-Morphhology.txt							Greek word morphhology code definitions
# Hebrew-Lexicon.txt							Tyndale Hebrew extended Strongs lexicon
# Hebrew-Morphhology.txt						Hebrew word morphhology code definitions
# Holy-Bible---[language]---A-StudyPack.txt		Resource text for Bible study and translation
#
# STUDY AND TRANSLATION:
# 1. Use notepad++ or a text editor with REGEX and Master REGEX for text search and edits.
# 2. Honor the 66 books of the Old and New Testaments as the unique, inerrant, inspired Word of God in the original autographs, and the final authority in all matters of faith and conduct, 2 Tim 3:16.
# 3. Translate Abyssos, Geenna, Hadēs, Limnē Pyr, Sheol, and Tartaroō as distinct locations.
# 4. Translate aïdios as eternal.
# 5. Translate aiōn as age or eon.
# 6. Translate aiōnios as pertaining to the age, life, lifetime, entire, whole, or consummate.
# 7. Do not change the Holy Spirit's choice of gendered words.
# 8. Do not paraphrase, but translate, respecting contexts of the phrase, sentence, paragraph, book, author, testament, Bible, and history.
# 9. Create your new translation editing the NEW: line
#


EOT;
AION_ECHO("INIT");
$database = array();
AION_FILE_DATA_GET('./aion_database/VERSIONS.txt',	'T_VERSIONS',	$database, 'BIBLE', TRUE );
$abooks = AION_BIBLES_LIST();
$tbooks = AION_BIBLES_LIST_TYN();

/////////////////////////////////////////////////////////////////
// LOOP THE LIST
foreach($PACKS as $lang => $pack) {
	// create folder and file
	$studypack="Holy-Bible---$lang---A-StudyPack";
	$studyfile="$studypack/Holy-Bible---$lang---A-StudyPack.txt";
	AION_ECHO("Attempting: $lang: $studypack");
	system("rm -rf $studypack");
	if (!mkdir($studypack)) { AION_ECHO("ERROR! mkdir()"); }
	if (!($studyhandle = fopen($studyfile, "w"))) { AION_ECHO("ERROR! fopen($studyfile)"); }
	// hebrew tags
	$files = array(
		"../STEPBible-Data-master/TOTHT Gen-Deu - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt",
		"../STEPBible-Data-master/TOTHT Jos-Est - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt",
		"../STEPBible-Data-master/TOTHT Job-Sng - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt",
		"../STEPBible-Data-master/TOTHT Isa-Mal - Translators OT Hebrew Tagged text - STEPBible.org CC BY.txt",
		);
	foreach($files as $file) {
		AION_ECHO("Processing: $file");
		if (!($handle = fopen($file, "r"))) { AION_ECHO("ERROR! fopen($file)"); }
		$notyet = TRUE;
		$last === NULL;
		while (($line = fgets($handle)) !== false) {
			if (empty($line)) { continue; }
			if ($notyet) { if (!preg_match("#^Gen.1.1-01	#u",$line) && !preg_match("#^Jos.1.1-01	#u",$line) && !preg_match("#^Job.1.1-01	#u",$line) && !preg_match("#^Isa.1.1-01	#u",$line)) { continue; } $notyet = FALSE; }
			// Gen.1.1-01	Gen.1.1-01	בְּרֵאשִׁית	בְּ/רֵאשִׁ֖ית	HR/Ncfsa	H9003=ב=in/H7225=רֵאשִׁית=first_§1_beginning
			if (!preg_match("#^([^\t]+)\t([[:alnum:]]+)[[:punct:]]+([\d]+)[[:punct:]]+([\d]+)[[:punct:]]+([\d]+)([KQkq]{0,1})\t(.*)$#iu",$line,$match)) { AION_ECHO("ERROR! corrupt hebrew ref: $line"); }
			$book = strtoupper($match[2]);
			if (empty($tbooks[$book])) { AION_ECHO("ERROR! missing book='$book': $line"); }
			$book = $tbooks[$book];
			$indx = sprintf('%03d', (int)array_search($book,array_keys($abooks)));
			$chap = sprintf('%03d', (int)$match[3]);
			$vers = sprintf('%03d', (int)$match[4]);
			$match[6] = strtolower($match[6]);
			$sort = "ZZ".sprintf('%03d', 100+(int)$match[5]).$match[6];
			$yeah = ($match[6]=='k' ? 'Ketiv: ' : ($match[6]=='q' ? 'Qere: ' : '')) . $match[7];
			// block intro
			if ($last!="$indx$book$chap$vers") {
				if (fwrite($studyhandle,"$indx	$book	$chap	$vers	XX000	\n")===false) { AION_ECHO("ERROR! fwrite($file: $line)"); }
				if (fwrite($studyhandle,"$indx	$book	$chap	$vers	XX000	\n")===false) { AION_ECHO("ERROR! fwrite($file: $line)"); }
				$last="$indx$book$chap$vers";
			}
			// write the verse word
			if (fwrite($studyhandle,"$indx	$book	$chap	$vers	$sort	$yeah\n")===false) { AION_ECHO("ERROR! fwrite($file: $line)"); }
			if (preg_match("#^Mal.3.24-15	#u",$line)) { break; } 			
		}
		fclose($handle);
	}
	// greek tags
	$files = array(
		"../STEPBible-Data-master/TAGNT Mat-Jhn - Translators Amalgamated Greek NT - STEPBible.org CC-BY.txt",
		"../STEPBible-Data-master/TAGNT Act-Rev - Translators Amalgamated Greek NT - STEPBible.org CC-BY.txt",
		);
	foreach($files as $file) {
		AION_ECHO("Processing: $file");
		if (!($handle = fopen($file, "r"))) { AION_ECHO("ERROR! fopen($file)"); }
		$notyet = TRUE;
		$indx = NULL;
		while (($line = fgets($handle)) !== false) {
			if (empty($line) || ctype_space($line)) { $indx = NULL; continue; }
			if ($notyet) { if (!preg_match("/^# Mat.1.1	/u",$line) && !preg_match("/^# Act.1.1	/u",$line)) { $indx = NULL; continue; } $notyet = FALSE; }
			// first line
			if (preg_match("/^# ([[:alnum:]]{3})\.([[:digit:]]{1,3})\.([[:digit:]]{1,3})\t(.+)$/u",$line,$match)) {
				$book = strtoupper($match[1]);
				if (empty($tbooks[$book])) { AION_ECHO("ERROR! missing book='$book': $line"); }
				$book = $tbooks[$book];
				$indx = sprintf('%03d', (int)array_search($book,array_keys($abooks)));
				$chap = sprintf('%03d', (int)$match[2]);
				$vers = sprintf('%03d', (int)$match[3]);
				$order = 0;
				$sort = 'ZZ001';
				$yeah = "GRK:	".$match[4];
				// block intro
				if (fwrite($studyhandle,"$indx	$book	$chap	$vers	XX000	\n")===false) { AION_ECHO("ERROR! fwrite($file: $line)"); }
				if (fwrite($studyhandle,"$indx	$book	$chap	$vers	XX000	\n")===false) { AION_ECHO("ERROR! fwrite($file: $line)"); }
			}
			else if ($indx === NULL) {
				AION_ECHO("ERROR! INDX==NULL $file: $line)");
			}
			// more lines
			else if (preg_match("/^#_(.+)$/u",$line,$match)) {
				$order = ($order < 100 ? 100 : $order);
				$sort = sprintf('ZZ%03d', $order);
				if (preg_match("/^#_Translation\s+(.+)$/u",$line,$match2)) {	$yeah = "STP:	".$match2[1]; }
				else {															$yeah = $match[1]; }
			}
			// bible word lines
			else if (preg_match("/^([[:digit:]]{2})_([[:alnum:]]{3})\.([[:digit:]]{3})\.([[:digit:]]{3})\t(.+)$/u",$line,$match)) {
				$bookT = strtoupper($match[2]);
				if (empty($tbooks[$bookT])) { AION_ECHO("ERROR! missing book='$bookT': $line"); }
				$bookT = $tbooks[$bookT];
				$indxT = sprintf('%03d', (int)array_search($bookT,array_keys($abooks)));
				$chapT = sprintf('%03d', (int)$match[3]);
				$versT = sprintf('%03d', (int)$match[4]);
				if ($indx!=$indxT || $book!=$bookT || $chap!=$chapT) {												AION_ECHO("WARN! bad big reference skipped: $line"); continue; }
				if ((int)$versT == (int)$vers + 1) {		$order = ($order < 200 || $order > 299 ? 200 : $order);	AION_ECHO("WARN! bad reference forwarded: $line"); }
				else if ((int)$versT == (int)$vers - 1) {	$order = ($order < 800 ? 800 : $order);					AION_ECHO("WARN! bad reference backwarded: $line"); }
				else if ((int)$versT != (int)$vers) {																AION_ECHO("WARN! bad verse reference skipped: $line"); continue; }
				else {										$order = ($order < 300 ? 300 : $order); }
				$sort = sprintf('ZZ%03d', $order);
				$yeah = $match[5];
			}
			else {
				AION_ECHO("ERROR! bad line no matchee: $line");
			}
			if ($order > 999) {
				AION_ECHO("ERROR! bad order number=$order: $line");
			}
			if (fwrite($studyhandle,"$indx	$book	$chap	$vers	$sort	$yeah\n")===false) { AION_ECHO("ERROR! fwrite($file: $line)"); }
			++$order;
		}
		fclose($handle);
	}		
	// cat bibles
	$order = 10;
	$first = TRUE;
	foreach($pack as $bible) {
		AION_ECHO("Processing: $bible");
		if ($order>99) { break; }
		$short = (empty($database['T_VERSIONS'][$bible]['SHORT']) ? 'xxx' : $database['T_VERSIONS'][$bible]['SHORT']);
		$sort = sprintf('ZZ%03d', $order);
		AION_ECHO("Processing: $bible $short $sort");
		if ($first) {
		system("cat ../www-stageresources/$bible---Aionian-Edition.noia | sed -r \"s/[[:digit:]]+	[[:alnum:]]+	[[:digit:]]+	[[:digit:]]+	/&YY000	NEW:	/\" >> $studyfile"); }
		system("cat ../www-stageresources/$bible---Aionian-Edition.noia | sed -r \"s/[[:digit:]]+	[[:alnum:]]+	[[:digit:]]+	[[:digit:]]+	/&$sort	$short:	/\" >> $studyfile");
		++$order;
		$first = FALSE;
	}
	$sort = sprintf('ZZ%03d', $order);
	AION_ECHO("Processing: Aionian Bible EAB $sort");
	system("cat ../www-stageresources/Holy-Bible---English---Aionian-Bible---Aionian-Edition.noia | sed -r \"s/[[:digit:]]+	[[:alnum:]]+	[[:digit:]]+	[[:digit:]]+	/&$sort	EAB:	/\" >> $studyfile");
	++$order;
	$sort = sprintf('ZZ%03d', $order);
	AION_ECHO("Processing: STEP Bible STP $sort");
	system("cat ../www-stageresources/Holy-Bible---English---STEPBible-Amalgamant---Aionian-Edition.noia | sed -r -e '/^0[4-9]+/d' | sed -r \"s/[[:digit:]]+	[[:alnum:]]+	[[:digit:]]+	[[:digit:]]+	/&$sort	STP:	/\" >> $studyfile");
	// sort and add header
	AION_ECHO("Sort: $studyfile");
	if (file_put_contents("$studyfile.sort", $HEADER)===FALSE) {																											AION_ECHO("ERROR! file_put_contents(1)"); }
	system("cat $studyfile | sed -r -e '/^[[:space:]]*$/d' -e '/^#/d' | sort | sed -r -e 's/^.*XX000//' -e 's/YY000	//' -e 's/^.*ZZ[[:alnum:]]+/#/' >> $studyfile.sort");
	if (!rename("$studyfile.sort", $studyfile)) { AION_ECHO("ERROR! Rename() failed: $studyfile"); }
	// write the files
	AION_ECHO("Copy: more files");
	if (!copy("../STEPBible-Data-master/TBESG - Translators Brief lexicon of Extended Strongs for Greek - STEPBible.org CC BY.txt", "$studypack/Greek-Lexicon.txt")) {		AION_ECHO("ERROR! copy(2)"); }
	if (!copy("../STEPBible-Data-master/TBESH - Translators Brief lexicon of Extended Strongs for Hebrew - STEPBible.org CC BY.txt", "$studypack/Hebrew-Lexicon.txt")) {	AION_ECHO("ERROR! copy(3)"); }
	if (!copy("../STEPBible-Data-master/TEGMC - Translators Expansion of Greek Morphhology Codes - STEPBible.org CC BY.txt", "$studypack/Greek-Morphhology.txt")) {			AION_ECHO("ERROR! copy(4)"); }
	if (!copy("../STEPBible-Data-master/TEHMC - Translators Expansion of Hebrew Morphology Codes - STEPBible.org CC BY.txt", "$studypack/Hebrew-Morphhology.txt")) {		AION_ECHO("ERROR! copy(5)"); }	
	if (file_put_contents("$studypack/AREADME.txt", $HEADER)===FALSE) {																										AION_ECHO("ERROR! file_put_contents(6)"); }
	// zip the files
	AION_ECHO("Zip: $studypack");
	system("zip -9 -rv ../www-resources/$studypack.zip $studypack");
	system('rm -rf $studypack');
}

/////////////////////////////////////////////////////////////////
// CLOSE UP

/////////////////////////////////////////////////////////////////
// DONE
AION_ECHO("DONE");
