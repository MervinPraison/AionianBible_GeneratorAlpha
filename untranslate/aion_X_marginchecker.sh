#!/usr/local/bin/php
<?php
// Check margins
require_once('./aion_common.php');
AION_ECHO("MARGIN CHECKER: BEGIN");

// variables
$bibles = array(
"Holy-Bible---Coptic---Coptic-Boharic-NT",
"Holy-Bible---Coptic---Coptic-NT",
"Holy-Bible---Coptic---Sahidic-Bible",
"Holy-Bible---Coptic---Sahidic-Coptic-Horner",
"Holy-Bible---Myanmar---Burmese-Common-Bible",
"Holy-Bible---Sanskrit---Burmese-Script",
"Holy-Bible---Sanskrit---Cologne-Script",
"Holy-Bible---Sanskrit---Harvard-Kyoto-Script",
"Holy-Bible---Sanskrit---IAST-Script",
"Holy-Bible---Sanskrit---ISO-Script",
"Holy-Bible---Sanskrit---ITRANS-Script",
"Holy-Bible---Sanskrit---Tamil-Script",
"Holy-Bible---Sanskrit---Velthuis-Script",
);

// loop
foreach($bibles as $bible) {
	AION_ECHO("MARGIN CHECKER: BIBLE = $bible");
	$c = FALSE; // check the middle column

		AION_MARGINCHECKER(417, 0,  432, 648, 11, 14, "$bible---Aionian-Edition.pdf",			"right");
if($c){	AION_MARGINCHECKER(212, 31, 216, 648, 11, 14, "$bible---Aionian-Edition.pdf",			"center"); }
		AION_MARGINCHECKER(327, 0,  432, 648, 11, 14, "$bible---Aionian-Edition---STUDY.pdf",	"right");
	
		AION_MARGINCHECKER(414, 0,  432, 648, 13, 17, "$bible---POD_KDP_ALL_BODY.pdf",			"right", "odd");
		AION_MARGINCHECKER(378, 0,  432, 648, 13, 17, "$bible---POD_KDP_ALL_BODY.pdf",			"right", "even");
if($c){	AION_MARGINCHECKER(235, 31, 239, 648, 13, 17, "$bible---POD_KDP_ALL_BODY.pdf",			"center","odd"); }
if($c){	AION_MARGINCHECKER(195, 31, 199, 648, 13, 17, "$bible---POD_KDP_ALL_BODY.pdf",			"center","even"); }
	
		AION_MARGINCHECKER(414, 0,  432, 648, 13, 17, "$bible---POD_KDP_NEW_BODY.pdf",			"right", "odd");
		AION_MARGINCHECKER(378, 0,  432, 648, 13, 17, "$bible---POD_KDP_NEW_BODY.pdf",			"right", "even");
if($c){	AION_MARGINCHECKER(235, 31, 239, 648, 13, 17, "$bible---POD_KDP_NEW_BODY.pdf",			"center","odd"); }
if($c){	AION_MARGINCHECKER(195, 31, 199, 648, 13, 17, "$bible---POD_KDP_NEW_BODY.pdf",			"center","even"); }
}
AION_ECHO("MARGIN CHECKER: END");
exit;


// Check the margins
function AION_MARGINCHECKER($x1, $y1, $x2, $y2, $head, $tail, $file, $margin, $what='') {
	$input = "../www-stageresources/$file";
	if (!file_exists($input)) { return; }
	$output = "../pdf-margin-checker/$file.$margin.pdf";
	if (file_exists($output)) { unlink($output); }
	$alternate	= ($what=="odd" ? "sed '0~2d' | " : ($what=="even" ? "sed '1~2d' | " : ""));
	$result = "$output.out$what.txt";
	if (file_exists($result)) { unlink($result); }
	// first create pfds from margin only. should all be blank
	// https://stackoverflow.com/questions/6183479/cropping-a-pdf-using-ghostscript-9-01
	// https://stackoverflow.com/questions/8158295/what-dimensions-do-the-coordinates-in-pdf-cropbox-refer-to
	// coordinates: left,bottom and right,top
	// 1-inch=72pts, 6x9 = 432x648
	system("gs -o $output -sDEVICE=pdfwrite -c '[/CropBox [$x1 $y1 $x2 $y2]' -c '/PAGES pdfmark' -f $input;");
	// https://stackoverflow.com/questions/12831990/check-pdf-if-document-is-blank-in-bash-or-ruby
	// https://askubuntu.com/questions/410196/remove-first-n-lines-of-a-large-text-file
	// https://www.tutorialspoint.com/remove-the-last-n-lines-of-a-file-in-linux
	// https://stackoverflow.com/questions/21309020/remove-odd-or-even-lines-from-a-text-file
	system("\
gs -dBATCH -dNOPAUSE -dQUIET -sDEVICE=bbox $output 2>&1 |\
sed -e '/%%BoundingBox/d' |\
nl |\
tail -n +$head |\
head -n -$tail |\
$alternate sed -e '/%%HiResBoundingBox: 0.000000 0.000000 0.000000 0.000000/d' |\
tee \
$result \
");
	unlink($output);
	if (!($tmp=file_get_contents($result)) || empty($tmp)) {
		if (file_exists($result)) { unlink($result); }
		AION_ECHO("MARGIN CHECKER: CLEAR $x1, $y1, $x2, $y2, $input, $output, $margin, $what");
	}
	else {
		if (!copy($input, "../pdf-margin-checker/$file")) { AION_ECHO("ERROR! MARGIN CHECKER: failed copy($input, ../pdf-margin-checker/$file)"); }
		AION_ECHO("MARGIN CHECKER: PROBLEM $x1, $y1, $x2, $y2, $input, $output, $margin, $what");
	}
}