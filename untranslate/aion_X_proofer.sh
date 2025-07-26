#!/usr/local/bin/php
<?php
// Generate PDF Proofer PDFs
require_once('./aion_common.php');
AION_ECHO("PDF PROOFER GENERATION: BEGIN");
if (!chdir("../www-stageresources")) { AION_ECHO("ERROR! chdir()"); }
system("cat Holy-Bible*.messages > BIBLE-PROOF.messages");

$NEWBIBLES = array(
"Holy-Bible---Abureni---Abureni-Bible",
"Holy-Bible---Arumanisht---Aromanian-Bible",
"Holy-Bible---Baga-Sitemu---Baga-Sitemu-Bible",
"Holy-Bible---Basa-Gurmana---Basa-Gurmana-Bible",
"Holy-Bible---Boga---Boga-Bible",
"Holy-Bible---Bondei---Bondei-Bible",
"Holy-Bible---Bu---Bauchi-Bu-Bible",
"Holy-Bible---Bwile---Bwile-Bible",
"Holy-Bible---Cishingini---Cishingini-Bible",
"Holy-Bible---Dhanki---Dhanki-Devanagari-Bible",
"Holy-Bible---Dongxiang---Donxian-Bible",
"Holy-Bible---Ekajuk---Ekajuk-Bible",
"Holy-Bible---Etulo---Etulo-Bible",
"Holy-Bible---Falam---Falam-Chin-Bible",
"Holy-Bible---Geji---Geji-Bible",
"Holy-Bible---Havu---Havu-Bible",
"Holy-Bible---Kapin---Kapin-Bible",
"Holy-Bible---Kurama---Kurama-Akurumi-Bible",
"Holy-Bible---Kuturmi---Kuturmi-Bible",
"Holy-Bible---Matumbi---Matumbi-Bible",
"Holy-Bible---Mbe---Mbe-Bible",
"Holy-Bible---Mbula-Bwazza---Mbula-Bwazza-Bible",
"Holy-Bible---Mwaghavul---Mwaghavul-Bible",
"Holy-Bible---Ndwewe---Ndwewe-Bible",
"Holy-Bible---Polci---Polci-Bible",
"Holy-Bible---Powari---Powari-Bible",
"Holy-Bible---Rakhine---Rakhine-Bible",
"Holy-Bible---Reli---Reli-Bible",
"Holy-Bible---Rohingya---Kitabul-Mukaddos-Bible",
"Holy-Bible---Rohingya---Rohingya-Bible",
"Holy-Bible---Romani---Balkans-Arli-Bible",
"Holy-Bible---Saafi-Saafi---Saafi-Saafi-Bible",
"Holy-Bible---Sanga---Sanga-Bible",
"Holy-Bible---Shi---Mashi-Bible",
"Holy-Bible---Sholaga---Sholaga-Bible",
"Holy-Bible---Somau-Karia---Somau-Karia-Bible",
"Holy-Bible---Taabwa---Kitaabua-Bible",
"Holy-Bible---Tarok---Tarok-Nigeria-Bible",
"Holy-Bible---Tavoyan---Tavoyan-Bible",
"Holy-Bible---Teke-Tyee---Teke-Tyee-Bible",
"Holy-Bible---Tharu-Rana---Rana-Tharu-Bible",
"Holy-Bible---Tichurong---Tichurong-Bible",
"Holy-Bible---Tsikimba---Tsikimba-Bible",
"Holy-Bible---Tsishingini---Tsishingini-Bible",
"Holy-Bible---Vaagri-Booli---Vaagri-Booli-Bible",
"Holy-Bible---Vaghri---Vaghri-Bible",
"Holy-Bible---Vidunda---Vidunda-Bible",
"Holy-Bible---Waddar---Waddar-Bible",
"Holy-Bible---Waja---Waja-Bible",
"Holy-Bible---Wolio---Kitabi-Momangkilona-Bible",
"Holy-Bible---Yaka---Yaka-Bible",
"Holy-Bible---Yalunka---Yalunka-Bible",
"Holy-Bible---Yamap---Yamap-Bible",
"Holy-Bible---Yansi---Yansi-Bible",
"Holy-Bible---Yiddish-Eastern---Eastern-Yiddish-Bible",
"Holy-Bible---Yipunu---Punu-Bible",
"Holy-Bible---Zapotec-Loxicha---Loxicha-Zapotec-Bible",
"Holy-Bible---Zinza---Zinza-Bible",
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
		//if (!in_array($proof['BIBLE'], $NEWBIBLES)) { continue; } // checking the new guys only or not new guys
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
if (file_exists("./AB-PROOFS/BIBLE-PROOF-ACOVER_ALL.pdf"))	{ unlink("./AB-PROOFS/BIBLE-PROOF-ACOVER_ALL.pdf"); }
if (file_exists("./AB-PROOFS/BIBLE-PROOF-ACOVER_HAR.pdf"))	{ unlink("./AB-PROOFS/BIBLE-PROOF-ACOVER_HAR.pdf"); }
if (file_exists("./AB-PROOFS/BIBLE-PROOF-ACOVER_NEW.pdf"))	{ unlink("./AB-PROOFS/BIBLE-PROOF-ACOVER_NEW.pdf"); }
if (file_exists("./AB-PROOFS/BIBLE-PROOF-ACOVER_JOH.pdf"))	{ unlink("./AB-PROOFS/BIBLE-PROOF-ACOVER_JOH.pdf"); }
system("pdftk *POD_KDP_ALL_COVER.pdf   cat output ./AB-PROOFS/BIBLE-PROOF-ACOVER_ALL.pdf");
system("pdftk *POD_LULU_HAR_COVER.pdf  cat output ./AB-PROOFS/BIBLE-PROOF-ACOVER_HAR.pdf");
system("pdftk *POD_KDP_NEW_COVER.pdf   cat output ./AB-PROOFS/BIBLE-PROOF-ACOVER_NEW.pdf");
system("pdftk *POD_JOHN_COVER.pdf      cat output ./AB-PROOFS/BIBLE-PROOF-ACOVER_JOH.pdf");

//system("pdftk Holy-Bible---Abureni---Abureni-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Arumanisht---Aromanian-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Baga-Sitemu---Baga-Sitemu-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Basa-Gurmana---Basa-Gurmana-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Boga---Boga-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Bondei---Bondei-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Bu---Bauchi-Bu-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Bwile---Bwile-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Cishingini---Cishingini-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Dhanki---Dhanki-Devanagari-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Dongxiang---Donxian-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Ekajuk---Ekajuk-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Etulo---Etulo-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Falam---Falam-Chin-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Geji---Geji-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Havu---Havu-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Kapin---Kapin-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Kurama---Kurama-Akurumi-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Kuturmi---Kuturmi-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Matumbi---Matumbi-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Mbe---Mbe-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Mbula-Bwazza---Mbula-Bwazza-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Mwaghavul---Mwaghavul-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Ndwewe---Ndwewe-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Polci---Polci-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Powari---Powari-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Rakhine---Rakhine-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Reli---Reli-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Rohingya---Kitabul-Mukaddos-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Rohingya---Rohingya-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Romani---Balkans-Arli-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Saafi-Saafi---Saafi-Saafi-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Sanga---Sanga-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Shi---Mashi-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Sholaga---Sholaga-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Somau-Karia---Somau-Karia-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Taabwa---Kitaabua-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Tarok---Tarok-Nigeria-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Tavoyan---Tavoyan-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Teke-Tyee---Teke-Tyee-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Tharu-Rana---Rana-Tharu-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Tichurong---Tichurong-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Tsikimba---Tsikimba-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Tsishingini---Tsishingini-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Vaagri-Booli---Vaagri-Booli-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Vaghri---Vaghri-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Vidunda---Vidunda-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Waddar---Waddar-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Waja---Waja-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Wolio---Kitabi-Momangkilona-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Yaka---Yaka-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Yalunka---Yalunka-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Yamap---Yamap-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Yansi---Yansi-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Yiddish-Eastern---Eastern-Yiddish-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Yipunu---Punu-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Zapotec-Loxicha---Loxicha-Zapotec-Bible---POD_KDP_ALL_COVER.pdf Holy-Bible---Zinza---Zinza-Bible---POD_KDP_ALL_COVER.pdf  cat output ./AB-PROOFS/BIBLE-PROOF-ACOVER_ALL.pdf");


AION_ECHO("PDF PROOFER GENERATION: COVERS");

// INTERIOR PDFS
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "TITLE");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "COPYRIGHT");
build_pdftk_flex($proofer, "---POD_KDP_ALL_BODY.pdf", "HISTORY");
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

build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "TITLE");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "COPYRIGHT");
build_pdftk_flex($proofer, "---POD_KDP_NEW_BODY.pdf", "HISTORY");
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
build_pdftk_flex($proofer, "---STUDY.pdf", "HISTORY");
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
build_pdftk_flex($proofer, "---Aionian-Edition.pdf", "HISTORY");
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

build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "TITLE");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "COPYRIGHT");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "PREFACE");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "OT-PIX");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "OT-PAGE1");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "NT-PIX");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "NT-PAGE1");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "END-PIX");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "VERSES");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "READERS");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "GLOSSARY1");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "GLOSSARY2");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "MAP1");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "MAP2");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "MAP3");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "MAP4");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "TIME1");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "TIME2");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "TIME3");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "TIME4");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "LAKEOFFIRE");
build_pdftk_flex($proofer, "---POD_JOHN_BODY.pdf", "MAP5");
AION_ECHO("PDF PROOFER GENERATION: JOHN"); 