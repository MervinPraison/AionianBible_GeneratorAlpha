#!/usr/local/bin/php
<?php
// Generate PDF Proofer PDFs
require_once('./aion_common.php');
AION_ECHO("PDF PROOFER GENERATION: BEGIN");
if (!chdir("../www-stageresources")) { AION_ECHO("ERROR! chdir()"); }


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
	$proofer[] = array('FILE'=>$filename,'PAGE'=>$pagename,'NUMB'=>$pagenumb);
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


// BUILD PDFTK
function build_pdftk($proofer, $filename, $pagename) {
	// pdftk A=in1.pdf B=in2.pdf cat A B output out1.pdf
	$part1 = "";
	$part2 = "";
	$tag = "A";
	foreach($proofer as $proof) {
		if (stripos($proof['FILE'],$filename)===FALSE){ continue; }
		if (stripos($proof['PAGE'],$pagename)===FALSE){ continue; }
		if ((int)$proof['NUMB']==0) {
			$part1 .= " $tag=BIBLE-PROOF-ABLANK.pdf";
			$part2 .= " $tag"."1";
		}
		else {
			$part1 .= " $tag=".$proof['FILE'];
			$part2 .= " $tag".$proof['NUMB'];
		}
		$tag++;
	}
	return "pdftk $part1 cat $part2 output ./AB-PROOFS/BIBLE-PROOF-$pagename$filename";
}
// BUILD PDFTK - DOUBLE
function build_pdftk2($proofer, $filename, $pagename) {
	// pdftk A=in1.pdf B=in2.pdf cat A B output out1.pdf
	$part1 = "";
	$part2 = "";
	$Bpart1 = "";
	$Bpart2 = "";
	$Bcount = 0;
	$tag = "A";
	foreach($proofer as $proof) {
		if (stripos($proof['FILE'],$filename)===FALSE){ continue; }
		if (stripos($proof['PAGE'],$pagename)===FALSE){ continue; }
		++$Bcount;
		if ($Bcount<100) {
			if ((int)$proof['NUMB']==0) {	$part1 .= " $tag=BIBLE-PROOF-ABLANK.pdf";	$part2 .= " $tag"."1"; }
			else {							$part1 .= " $tag=".$proof['FILE'];			$part2 .= " $tag".$proof['NUMB']; }
		}
		else {
			if ((int)$proof['NUMB']==0) {	$Bpart1 .= " $tag=BIBLE-PROOF-ABLANK.pdf";	$Bpart2 .= " $tag"."1"; }
			else {							$Bpart1 .= " $tag=".$proof['FILE'];			$Bpart2 .= " $tag".$proof['NUMB']; }
		}
		
		$tag++;
	}
	if (is_file(($temp = "./AB-PROOFS/temp.pdf"))) { unlink($temp); }
	if (empty($Bpart1)) {	return "pdftk $part1 cat $part2 output ./AB-PROOFS/BIBLE-PROOF-$pagename$filename"; }
	else {					return "pdftk $part1 cat $part2 output $temp; pdftk A=$temp $Bpart1 cat A $Bpart2 output ./AB-PROOFS/BIBLE-PROOF-$pagename$filename;"; }
}
AION_ECHO("PDF PROOFER GENERATION: FUNCTION");


// COVER PDFs
if (file_exists("./AB-PROOFS/BIBLE-PROOF-ACOVER_ALL.pdf"))	{ unlink("./AB-PROOFS/BIBLE-PROOF-ACOVER_ALL.pdf"); }
if (file_exists("./AB-PROOFS/BIBLE-PROOF-ACOVER_HAR.pdf"))	{ unlink("./AB-PROOFS/BIBLE-PROOF-ACOVER_HAR.pdf"); }
if (file_exists("./AB-PROOFS/BIBLE-PROOF-ACOVER_NEW.pdf"))	{ unlink("./AB-PROOFS/BIBLE-PROOF-ACOVER_NEW.pdf"); }
system("pdftk *POD_KDP_ALL_COVER.pdf   cat output ./AB-PROOFS/BIBLE-PROOF-ACOVER_ALL.pdf");
system("pdftk *POD_LULU_HAR_COVER.pdf  cat output ./AB-PROOFS/BIBLE-PROOF-ACOVER_HAR.pdf");
system("pdftk *POD_KDP_NEW_COVER.pdf   cat output ./AB-PROOFS/BIBLE-PROOF-ACOVER_NEW.pdf");
AION_ECHO("PDF PROOFER GENERATION: COVERS");


// INTERIOR PDFS
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "TITLE"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "COPYRIGHT"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "PREFACE"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "TOC"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "OT-INTRO"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "OT-PIX"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "OT-PAGE1"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "NT-INTRO"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "NT-PIX"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "NT-PAGE1"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "END-PIX"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "READERS"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "GLOSSARY1"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "GLOSSARY2"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "GLOSSARYA"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "GLOSSARYB"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "MAP1"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "MAP2"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "MAP3"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "MAP4"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "MAP5"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "TIME1"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "TIME2"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "TIME3"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "TIME4"));
system(build_pdftk($proofer, "---POD_KDP_ALL_BODY.pdf", "LAKEOFFIRE"));
AION_ECHO("PDF PROOFER GENERATION: INTERIOR");


system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "TITLE"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "COPYRIGHT"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "PREFACE"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "TOC"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "OT-INTRO"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "OT-PIX"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "OT-PAGE1"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "NT-INTRO"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "NT-PIX"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "NT-PAGE1"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "END-PIX"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "READERS"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "GLOSSARY1"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "GLOSSARY2"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "GLOSSARYA"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "GLOSSARYB"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "MAP1"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "MAP2"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "MAP3"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "MAP4"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "MAP5"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "TIME1"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "TIME2"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "TIME3"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "TIME4"));
system(build_pdftk($proofer, "---POD_KDP_NEW_BODY.pdf", "LAKEOFFIRE"));
AION_ECHO("PDF PROOFER GENERATION: INTERIOR_NT");


system(build_pdftk2($proofer, "---STUDY.pdf", "TITLE"));
system(build_pdftk2($proofer, "---STUDY.pdf", "COPYRIGHT"));
system(build_pdftk2($proofer, "---STUDY.pdf", "PREFACE"));
system(build_pdftk2($proofer, "---STUDY.pdf", "TOC"));
system(build_pdftk2($proofer, "---STUDY.pdf", "OT-INTRO"));
system(build_pdftk2($proofer, "---STUDY.pdf", "OT-PIX"));
system(build_pdftk2($proofer, "---STUDY.pdf", "OT-PAGE1"));
system(build_pdftk2($proofer, "---STUDY.pdf", "NT-INTRO"));
system(build_pdftk2($proofer, "---STUDY.pdf", "NT-PIX"));
system(build_pdftk2($proofer, "---STUDY.pdf", "NT-PAGE1"));
system(build_pdftk2($proofer, "---STUDY.pdf", "END-PIX"));
system(build_pdftk2($proofer, "---STUDY.pdf", "READERS"));
system(build_pdftk2($proofer, "---STUDY.pdf", "GLOSSARY1"));
system(build_pdftk2($proofer, "---STUDY.pdf", "GLOSSARY2"));
system(build_pdftk2($proofer, "---STUDY.pdf", "GLOSSARYA"));
system(build_pdftk2($proofer, "---STUDY.pdf", "GLOSSARYB"));
system(build_pdftk2($proofer, "---STUDY.pdf", "MAP1"));
system(build_pdftk2($proofer, "---STUDY.pdf", "MAP2"));
system(build_pdftk2($proofer, "---STUDY.pdf", "MAP3"));
system(build_pdftk2($proofer, "---STUDY.pdf", "MAP4"));
system(build_pdftk2($proofer, "---STUDY.pdf", "MAP5"));
system(build_pdftk2($proofer, "---STUDY.pdf", "TIMEA"));
system(build_pdftk2($proofer, "---STUDY.pdf", "TIMEB"));
system(build_pdftk2($proofer, "---STUDY.pdf", "LAKEOFFIRE"));
AION_ECHO("PDF PROOFER GENERATION: STUDY");


system(build_pdftk($proofer, "---Aionian-Edition.pdf", "TITLE"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "COPYRIGHT"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "PREFACE"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "TOC"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "OT-INTRO"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "OT-PIX"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "OT-PAGE1"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "NT-INTRO"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "NT-PIX"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "NT-PAGE1"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "END-PIX"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "READERS"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "GLOSSARY1"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "GLOSSARY2"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "GLOSSARYA"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "GLOSSARYB"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "MAP1"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "MAP2"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "MAP3"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "MAP4"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "MAP5"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "TIMEA"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "TIMEB"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "LAKEOFFIRE"));
AION_ECHO("PDF PROOFER GENERATION: ONLINE");

if (is_file(($temp = "./AB-PROOFS/temp.pdf"))) { unlink($temp); }
AION_ECHO("PDF PROOFER GENERATION: DONE");
