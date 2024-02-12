#!/usr/local/bin/php
<?php
// Generate PDF Proofer PDFs
require_once('./aion_common.php');
AION_ECHO("PDF PROOFER GENERATION: BEGIN");
if (!chdir("../www-stageresources")) { AION_ECHO("ERROR! chdir()"); }


$NEWBIBLES = array(
"Holy-Bible---Ahirani---Gospels",
"Holy-Bible---Aramaic---Syriac-Peshitta",
"Holy-Bible---Bengali---Contemporary",
"Holy-Bible---Bhadrawahi---Bhadrawahi-Bible",
"Holy-Bible---Bodo-Parja---BOPO-Bible",
"Holy-Bible---Cebuano---Cebuano-Philippine",
"Holy-Bible---Chichewa---Chichewa-Bible",
"Holy-Bible---Chinese---Chinese-Easy-to-Read",
"Holy-Bible---Chinese---Chinese-Sigao-Bible",
"Holy-Bible---Chiyawo---Yao",
"Holy-Bible---Coptic---Sahidic-Bible-2",
"Holy-Bible---Coptic---Sahidic-Coptic-Horner",
"Holy-Bible---Czech---Kralicka",
"Holy-Bible---Czech---Living-Bible",
"Holy-Bible---Danish---Danish-1871-1907",
"Holy-Bible---Danish---Danish-1931-1907",
"Holy-Bible---Desiya---Desiya-Bible",
"Holy-Bible---Dholuo---Dholuo-Bible",
"Holy-Bible---Dutch---Schrift",
"Holy-Bible---English---Anderson-Bible",
"Holy-Bible---English---Berean-Standard",
"Holy-Bible---English---Godbey-Bible",
"Holy-Bible---English---Haweis-Bible",
"Holy-Bible---English---King-James-Version-Cambridge",
"Holy-Bible---English---King-James-Version-Restored-Name",
"Holy-Bible---English---King-James-Version-Revised",
"Holy-Bible---English---Leeser-Tanakh",
"Holy-Bible---English---Literal-Standard",
"Holy-Bible---English---Noyes",
"Holy-Bible---English---Syriac-Peshitta-Etheridge",
"Holy-Bible---English---Syriac-Peshitta-Murdock",
"Holy-Bible---English---Text-Critical",
"Holy-Bible---English---World-English-Bible-Updated",
"Holy-Bible---English---World-English-Bible-Updated-British",
"Holy-Bible---English---Worsley-Bible",
"Holy-Bible---Estonian---For-All",
"Holy-Bible---Ewe---Word-of-Life",
"Holy-Bible---French---Free-for-the-World",
"Holy-Bible---French---French-Crampon-Bible-New",
"Holy-Bible---French---Vulgate-Glaire",
"Holy-Bible---Gamotso---Gamo",
"Holy-Bible---German---German-Albrecht",
"Holy-Bible---German---German-Menge",
"Holy-Bible---German---German-Schlachter",
"Holy-Bible---Gikuyu---Kikuyu",
"Holy-Bible---Gofa---Gofa-Bible",
"Holy-Bible---Greek---Greek-Byzantine",
"Holy-Bible---Greek---Greek-Modern-Kathareuousa",
"Holy-Bible---Greek---Greek-SBL",
"Holy-Bible---Greek---Greek-Scrivener",
"Holy-Bible---Greek---Greek-Statistical-Restoration",
"Holy-Bible---Greek---Greek-Stephanus",
"Holy-Bible---Greek---Greek-TR-Stephanus-Scrivener",
"Holy-Bible---Greek---Text-Critical",
"Holy-Bible---Haitian---Haitian-Creole-Smith",
"Holy-Bible---Haryanvi---Haryanvi-Bible",
"Holy-Bible---Hausa---Contemporary",
"Holy-Bible---Hausa---Hausa-Bible",
"Holy-Bible---Hebrew---Hebrew-Aleppo-Miqra-Mesorah",
"Holy-Bible---Hebrew---Hebrew-Westminster-Leningrad-Kimball",
"Holy-Bible---Hebrew---Living-Bible",
"Holy-Bible---Hindi---Contemporary",
"Holy-Bible---Hungarian---Hungarian-Jewish-Bible",
"Holy-Bible---Hungarian---Magyar-Bible",
"Holy-Bible---Icelandic---Open-Living-Word",
"Holy-Bible---Igbo---Igbo-Bible",
"Holy-Bible---Indonesian---For-All",
"Holy-Bible---Indonesian---New-Indonesian-Translation",
"Holy-Bible---Indonesian---Simple",
"Holy-Bible---Kamano---Kamano-Kafe",
"Holy-Bible---Kannada---Open-Contemporary",
"Holy-Bible---Kiche---Totonicapan",
"Holy-Bible---Korean---Korean-Revised-Version",
"Holy-Bible---Kurdish---Sorani-Bible",
"Holy-Bible---Kuvi---Kuvi-Bible",
"Holy-Bible---Lingala---Lingala-Bible",
"Holy-Bible---Lodhi---Lodhi-Bible",
"Holy-Bible---Luganda---Luganda-Bible",
"Holy-Bible---Mahasu-Pahari---Baghlayani-Bible",
"Holy-Bible---Malagasy---Tandroy-Mahafaly-Bible",
"Holy-Bible---Malayalam---Contemporary",
"Holy-Bible---Malayalam---Malayalam-Bible-1910",
"Holy-Bible---Manipuri---Meitei-Bible",
"Holy-Bible---Munda---Munda-Bible",
"Holy-Bible---Myanmar---Burmese-Judson",
"Holy-Bible---Ndebele---Accessible-Bible",
"Holy-Bible---Ngoni---Ngoni-Bible",
"Holy-Bible---Norwegian---Living-Bible",
"Holy-Bible---Oromo---New-World",
"Holy-Bible---Persian---Open-Contemporary",
"Holy-Bible---Pogolo---Pogoro-Bible",
"Holy-Bible---Polish---Open-Access-Word-of-Life",
"Holy-Bible---Portuguese---Free-for-All",
"Holy-Bible---Romanian---Cyrillic",
"Holy-Bible---Romanian---Free-Bible",
"Holy-Bible---Romani---Eastern-Vlakh",
"Holy-Bible---Romani-Vlax---Servi-Bible",
"Holy-Bible---Sanskrit---Assamese-Script",
"Holy-Bible---Sanskrit---Bengali-Script",
"Holy-Bible---Sanskrit---Burmese-Script",
"Holy-Bible---Sanskrit---Cologne-Script",
"Holy-Bible---Sanskrit---Devanagari-Script",
"Holy-Bible---Sanskrit---Gujarati-Script",
"Holy-Bible---Sanskrit---Harvard-Kyoto-Script",
"Holy-Bible---Sanskrit---IAST-Script",
"Holy-Bible---Sanskrit---ISO-Script",
"Holy-Bible---Sanskrit---ITRANS-Script",
"Holy-Bible---Sanskrit---Kannada-Script",
"Holy-Bible---Sanskrit---Khmer-Script",
"Holy-Bible---Sanskrit---Malayalam-Script",
"Holy-Bible---Sanskrit---Oriya-Script",
"Holy-Bible---Sanskrit---Punjabi-Script",
"Holy-Bible---Sanskrit---Sinhala-Script",
"Holy-Bible---Sanskrit---Tamil-Script",
"Holy-Bible---Sanskrit---Telugu-Script",
"Holy-Bible---Sanskrit---Thai-Script",
"Holy-Bible---Sanskrit---Tibetan-Script",
"Holy-Bible---Sanskrit---Urdu-Script",
"Holy-Bible---Sanskrit---Velthuis-Script",
"Holy-Bible---Setswana---Open-Tswana-Living",
"Holy-Bible---Shona---Rakasununguka",
"Holy-Bible---Spanish---Biblia-Platense-Straubinger",
"Holy-Bible---Spanish---Free-for-the-World",
"Holy-Bible---Spanish---Gods-Word-for-You",
"Holy-Bible---Swahili---Contemporary",
"Holy-Bible---Swedish---Swedish-Bible-1917",
"Holy-Bible---Tagalog---Tagalog-Bible-1905",
"Holy-Bible---Tamil---Open-Contemporary",
"Holy-Bible---Twi---Akuapem-Twi-Bible",
"Holy-Bible---Twi---Asante-Twi-WAKNA",
"Holy-Bible---Twi---Asante-Twi-WASNA",
"Holy-Bible---Ukrainian---Kulish",
"Holy-Bible---Ukrainian---New-Translation",
"Holy-Bible---Vietnamese---Contemporary",
"Holy-Bible---Yombe---Yombe-Bible",
"Holy-Bible---Yoruba---Yoruba-Bible",
);


// BUILD PROOFER
$proofer = array();
if (!($handle = fopen("BIBLE-PROOF.messages", "r"))) { AION_ECHO("ERROR! Problem reading messages"); }
while (($line = fgets($handle)) !== false) {
	if (stripos($line,'ABPROOFER')===FALSE){ continue; }
	
	if (!($line = preg_replace("/<[^>]+>/us","",$line))) { AION_ECHO("ERROR! Problem with preg_replace()"); }
	$line = trim($line);
	if (!($line = preg_replace("/[ ]+/us"," ",$line))) { AION_ECHO("ERROR! Problem with preg_replace()"); }
	$profname = strtok($line, ' ');
	$filename = strtok(' ');
	$pagename = strtok(' ');
	$pagenumb = strtok(' ');
	if (!preg_match("/^(Holy-Bible---(.+?)---(.+?))---(.+?)$/",$filename,$match)) { AION_ECHO("ERROR! Problem with preg_match()"); }
	$bible = $match[1];
	if ($profname!='ABPROOFER'){ AION_ECHO("ERROR! Problem parsing proofer: $line"); }
	if (stripos($filename,'.pdf')===FALSE){ AION_ECHO("ERROR! Problem parsing PDF filename: $line"); }
	if (!ctype_digit($pagenumb) || (int)$pagenumb>5000) { AION_ECHO("ERROR! Problem parsing page number: $line"); }
	$proofer[] = array('FILE'=>$filename,'PAGE'=>$pagename,'NUMB'=>$pagenumb,'BIBLE'=>$bible);
}

// BUILD WARNINGS
if (!rewind($handle)) { AION_ECHO("ERROR! Problem rewinding file pointer"); }
$warning = FALSE;
$output = "WARNINGS BELOW\n\n";
while (($line = fgets($handle)) !== false) {
	if (stripos($line,'warning')!==FALSE){ $warning=TRUE; $output .= "$line\n"; continue; }
	if ($warning && stripos($line,'holy-bible')!==FALSE){ $output .= "$line\n\n\n"; $warning=FALSE; }
}
if (!file_put_contents("BIBLE-PROOF.warnings", $output)) { AION_ECHO("ERROR! Problem writing warnings"); }
 
// CLOSE
fclose($handle);
AION_ECHO("PDF PROOFER GENERATION: ARRAY");

// BUILD PDFTK - ONE BY ONE
function build_pdftk_flex($proofer, $filename, $pagename) {
	global $NEWBIBLES;
	// pdftk A=in1.pdf cat A# output A.pdf
	// pdftk A=in1.pdf... cat A B C ... output Final.pdf
	$tempdir = "./temp.proof";
	if (is_dir($tempdir)) { system("rm -rf $tempdir"); }
	if (!mkdir($tempdir)) { exit("Proofer failed to make temp directory"); }
	$counter = 1;
	$countermax = 7;
	$filesize = 0;
	$filemax = 40000000;
	$tag = "AA";
	$temp1 = $temp2 = "";
	$last1 = $last2 = "";
	foreach($proofer as $proof) {
		// skip
		if (stripos($proof['FILE'],$filename)===FALSE){ continue; }
		if (stripos($proof['PAGE'],$pagename)===FALSE){ continue; }
		if (!in_array($proof['BIBLE'], $NEWBIBLES)) { continue; } // checking the new guys only
		//setup
		$file = (0==(int)$proof['NUMB'] ? "BIBLE-PROOF-ABLANK.pdf" : $proof['FILE']);
		$numb = (0==(int)$proof['NUMB'] ? "1" : $proof['NUMB']);
		$filesize += filesize($file);
		// build queue
		$savet = $tag;
		$temp1 .= " $savet=$file";
		$temp2 .= " $savet$numb";
		$output = "$tempdir/$savet.pdf";
		// run queued
		if ($filesize >= $filemax || $counter >= $countermax) {
			system("pdftk $temp1 cat $temp2 output $output");
			$counter = 0;
			$filesize = 0;
			$temp1 = $temp2 = "";
			$last1 .= " $savet=$output";
			$last2 .= " $savet";
		}
		// increment
		$counter++;
		$tag++;
	}
	// run last
	if (!empty($temp1)) {
		system("pdftk $temp1 cat $temp2 output $output");
		$last1 .= " $savet=$output";
		$last2 .= " $savet";
	}
	//run all
	echo "pdftk $last1 cat $last2 output ./AB-PROOFS/BIBLE-PROOF-$pagename$filename";
	system("pdftk $last1 cat $last2 output ./AB-PROOFS/BIBLE-PROOF-$pagename$filename");
	system("rm -rf $tempdir");
	return;
}
AION_ECHO("PDF PROOFER GENERATION: FUNCTION");


// COVER PDFs
/*
if (file_exists("./AB-PROOFS/BIBLE-PROOF-ACOVER_ALL.pdf"))	{ unlink("./AB-PROOFS/BIBLE-PROOF-ACOVER_ALL.pdf"); }
if (file_exists("./AB-PROOFS/BIBLE-PROOF-ACOVER_HAR.pdf"))	{ unlink("./AB-PROOFS/BIBLE-PROOF-ACOVER_HAR.pdf"); }
if (file_exists("./AB-PROOFS/BIBLE-PROOF-ACOVER_NEW.pdf"))	{ unlink("./AB-PROOFS/BIBLE-PROOF-ACOVER_NEW.pdf"); }
system("pdftk *POD_KDP_ALL_COVER.pdf   cat output ./AB-PROOFS/BIBLE-PROOF-ACOVER_ALL.pdf");
system("pdftk *POD_LULU_HAR_COVER.pdf  cat output ./AB-PROOFS/BIBLE-PROOF-ACOVER_HAR.pdf");
system("pdftk *POD_KDP_NEW_COVER.pdf   cat output ./AB-PROOFS/BIBLE-PROOF-ACOVER_NEW.pdf");
AION_ECHO("PDF PROOFER GENERATION: COVERS");
*/

// INTERIOR PDFS
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "TITLE");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "COPYRIGHT");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "PREFACE");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "TOC");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "OT-INTRO");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "OT-PIX");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "OT-PAGE1");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "NT-INTRO");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "NT-PIX");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "NT-PAGE1");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "END-PIX");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "READERS");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "GLOSSARY1");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "GLOSSARY2");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "GLOSSARYA");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "GLOSSARYB");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "MAP1");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "MAP2");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "MAP3");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "MAP4");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "MAP5");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "TIME1");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "TIME2");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "TIME3");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "TIME4");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "LAKEOFFIRE");
AION_ECHO("PDF PROOFER GENERATION: INTERIOR");

exit;

build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "TITLE");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "COPYRIGHT");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "PREFACE");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "TOC");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "OT-INTRO");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "OT-PIX");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "OT-PAGE1");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "NT-INTRO");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "NT-PIX");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "NT-PAGE1");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "END-PIX");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "READERS");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "GLOSSARY1");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "GLOSSARY2");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "GLOSSARYA");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "GLOSSARYB");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "MAP1");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "MAP2");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "MAP3");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "MAP4");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "MAP5");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "TIME1");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "TIME2");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "TIME3");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "TIME4");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "LAKEOFFIRE");
AION_ECHO("PDF PROOFER GENERATION: INTERIOR_NT");


build_pdftk_flex($proofer, "---STUDY.pdf", "TITLE");
build_pdftk_flex($proofer, "---STUDY.pdf", "COPYRIGHT");
build_pdftk_flex($proofer, "---STUDY.pdf", "PREFACE");
build_pdftk_flex($proofer, "---STUDY.pdf", "TOC");
build_pdftk_flex($proofer, "---STUDY.pdf", "OT-INTRO");
build_pdftk_flex($proofer, "---STUDY.pdf", "OT-PIX");
build_pdftk_flex($proofer, "---STUDY.pdf", "OT-PAGE1");
build_pdftk_flex($proofer, "---STUDY.pdf", "NT-INTRO");
build_pdftk_flex($proofer, "---STUDY.pdf", "NT-PIX");
build_pdftk_flex($proofer, "---STUDY.pdf", "NT-PAGE1");
build_pdftk_flex($proofer, "---STUDY.pdf", "END-PIX");
build_pdftk_flex($proofer, "---STUDY.pdf", "READERS");
build_pdftk_flex($proofer, "---STUDY.pdf", "GLOSSARY1");
build_pdftk_flex($proofer, "---STUDY.pdf", "GLOSSARY2");
build_pdftk_flex($proofer, "---STUDY.pdf", "GLOSSARYA");
build_pdftk_flex($proofer, "---STUDY.pdf", "GLOSSARYB");
build_pdftk_flex($proofer, "---STUDY.pdf", "MAP1");
build_pdftk_flex($proofer, "---STUDY.pdf", "MAP2");
build_pdftk_flex($proofer, "---STUDY.pdf", "MAP3");
build_pdftk_flex($proofer, "---STUDY.pdf", "MAP4");
build_pdftk_flex($proofer, "---STUDY.pdf", "MAP5");
build_pdftk_flex($proofer, "---STUDY.pdf", "TIMEA");
build_pdftk_flex($proofer, "---STUDY.pdf", "TIMEB");
build_pdftk_flex($proofer, "---STUDY.pdf", "LAKEOFFIRE");
AION_ECHO("PDF PROOFER GENERATION: STUDY");


build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "TITLE");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "COPYRIGHT");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "PREFACE");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "TOC");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "OT-INTRO");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "OT-PIX");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "OT-PAGE1");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "NT-INTRO");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "NT-PIX");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "NT-PAGE1");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "END-PIX");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "READERS");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "GLOSSARY1");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "GLOSSARY2");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "GLOSSARYA");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "GLOSSARYB");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "MAP1");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "MAP2");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "MAP3");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "MAP4");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "MAP5");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "TIMEA");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "TIMEB");
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "LAKEOFFIRE");
AION_ECHO("PDF PROOFER GENERATION: ONLINE");

