#!/usr/local/bin/php
<?php
// Generate PDF Proofer PDFs
require_once('./aion_common.php');
AION_ECHO("PDF DIFFS: BEGIN ==========\n\n");


// LOOP PROOF PDFS
$files = array( // DO SOME
	'BIBLE-PROOF-ACOVER.pdf',
	'BIBLE-PROOF-COPYRIGHT---POD_INTERIOR.pdf',
	'BIBLE-PROOF-END-PIX---POD_INTERIOR.pdf',
	'BIBLE-PROOF-GLOSSARY1---POD_INTERIOR.pdf',
	'BIBLE-PROOF-MAP1---POD_INTERIOR.pdf',
	);
$files = array_diff(scandir('../www-stageresources/AB-PROOFS'), array('.', '..')); // DO ALL
foreach($files as $file) {
	//if (preg_match("#_HARD\.pdf$#",$file)) { continue; }
	//if (preg_match("#_NT\.pdf$#",$file)) { continue; }
	if (!preg_match("#\.pdf$#",$file)) { continue; }
	$result = system("diff-pdf -v -m -s --output-diff=../www-stageresources/AB-PROOFS-DIFFS/$file ../www-stageresources/AB-PROOFS/$file ../www-stageresources/AB-PROOFS-MARKER/$file");
	AION_ECHO("PROOF:  result=$result  $file\n");
}

// loop Aionian Bible PDF
$files = array_diff(scandir('../www-stageresources'), array('.', '..'));
foreach($files as $file) {
	if (!preg_match("#---Aionian-Edition\.pdf$#",$file)) { continue; }
	$revised = AION_PDF_PAGECOUNT("../www-stageresources/$file");
	$current = AION_PDF_PAGECOUNT("../www-resources/$file");
	if ($revised==$current) {	$result = system("diff-pdf -v -m -s --output-diff=../www-stageresources/AB-PROOFS-DIFFS/$file ../www-stageresources/$file ../www-resources/$file"); }
	else {						$result = "page count difference revised($revised) != current($current)"; }
	AION_ECHO("AIONIAN:  result=$result  $file\n");
	//break; // just do one!!!
}

echo "\n\n";
AION_ECHO("PDF DIFFS: END ==========");