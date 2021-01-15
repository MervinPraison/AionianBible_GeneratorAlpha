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
	$pdftk = "pdftk ";
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
	$pdftk .= $part1;
	$pdftk .= " cat ";
	$pdftk .= $part2;
	$pdftk .= " output ./AB-PROOFS/BIBLE-PROOF-$pagename$filename";
	return $pdftk;
}
AION_ECHO("PDF PROOFER GENERATION: FUNCTION");

// COVER PDFs
if (file_exists("./AB-PROOFS/BIBLE-PROOF-ACOVER.pdf"))		{ unlink("./AB-PROOFS/BIBLE-PROOF-ACOVER.pdf"); }
if (file_exists("./AB-PROOFS/BIBLE-PROOF-ACOVER_NT.pdf"))	{ unlink("./AB-PROOFS/BIBLE-PROOF-ACOVER_NT.pdf"); }
if (file_exists("./AB-PROOFS/BIBLE-PROOF-ACOVER_HARD.pdf"))	{ unlink("./AB-PROOFS/BIBLE-PROOF-ACOVER_HARD.pdf"); }
system("pdftk *POD_COVER.pdf           cat output ./AB-PROOFS/BIBLE-PROOF-ACOVER.pdf");
system("pdftk *POD_COVER_NT.pdf        cat output ./AB-PROOFS/BIBLE-PROOF-ACOVER_NT.pdf");
system("pdftk *POD_COVER_LULU_HARD.pdf cat output ./AB-PROOFS/BIBLE-PROOF-ACOVER_HARD.pdf");
AION_ECHO("PDF PROOFER GENERATION: COVERS");


// INTERIOR PDFS
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "TITLE"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "COPYRIGHT"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "TOC"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "OT-INTRO"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "OT-PIX"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "OT-PAGE1"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "NT-INTRO"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "NT-PIX"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "NT-PAGE1"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "END-PIX"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "READERS"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "GLOSSARY1"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "GLOSSARY2"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "GLOSSARYA"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "GLOSSARYB"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "MAP1"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "MAP2"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "MAP3"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "MAP4"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "MAP5"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "TIME1"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "TIME2"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "TIME3"));
system(build_pdftk($proofer, "---POD_INTERIOR.pdf", "TIME4"));
AION_ECHO("PDF PROOFER GENERATION: INTERIOR");


system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "TITLE"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "COPYRIGHT"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "TOC"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "OT-INTRO"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "OT-PIX"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "OT-PAGE1"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "NT-INTRO"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "NT-PIX"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "NT-PAGE1"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "END-PIX"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "READERS"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "GLOSSARY1"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "GLOSSARY2"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "GLOSSARYA"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "GLOSSARYB"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "MAP1"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "MAP2"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "MAP3"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "MAP4"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "MAP5"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "TIME1"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "TIME2"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "TIME3"));
system(build_pdftk($proofer, "---POD_INTERIOR_NT.pdf", "TIME4"));
AION_ECHO("PDF PROOFER GENERATION: INTERIOR_NT");


system(build_pdftk($proofer, "---STUDY.pdf", "TITLE"));
system(build_pdftk($proofer, "---STUDY.pdf", "COPYRIGHT"));
system(build_pdftk($proofer, "---STUDY.pdf", "TOC"));
system(build_pdftk($proofer, "---STUDY.pdf", "OT-INTRO"));
system(build_pdftk($proofer, "---STUDY.pdf", "OT-PIX"));
system(build_pdftk($proofer, "---STUDY.pdf", "OT-PAGE1"));
system(build_pdftk($proofer, "---STUDY.pdf", "NT-INTRO"));
system(build_pdftk($proofer, "---STUDY.pdf", "NT-PIX"));
system(build_pdftk($proofer, "---STUDY.pdf", "NT-PAGE1"));
system(build_pdftk($proofer, "---STUDY.pdf", "END-PIX"));
system(build_pdftk($proofer, "---STUDY.pdf", "READERS"));
system(build_pdftk($proofer, "---STUDY.pdf", "GLOSSARY1"));
system(build_pdftk($proofer, "---STUDY.pdf", "GLOSSARY2"));
system(build_pdftk($proofer, "---STUDY.pdf", "GLOSSARYA"));
system(build_pdftk($proofer, "---STUDY.pdf", "GLOSSARYB"));
system(build_pdftk($proofer, "---STUDY.pdf", "MAP1"));
system(build_pdftk($proofer, "---STUDY.pdf", "MAP2"));
system(build_pdftk($proofer, "---STUDY.pdf", "MAP3"));
system(build_pdftk($proofer, "---STUDY.pdf", "MAP4"));
system(build_pdftk($proofer, "---STUDY.pdf", "MAP5"));
system(build_pdftk($proofer, "---STUDY.pdf", "TIMEA"));
system(build_pdftk($proofer, "---STUDY.pdf", "TIMEB"));
AION_ECHO("PDF PROOFER GENERATION: STUDY");


system(build_pdftk($proofer, "---Aionian-Edition.pdf", "TITLE"));
system(build_pdftk($proofer, "---Aionian-Edition.pdf", "COPYRIGHT"));
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
AION_ECHO("PDF PROOFER GENERATION: ONLINE");


AION_ECHO("PDF PROOFER GENERATION: DONE");
