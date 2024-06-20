#!/usr/local/bin/php
<?php
// Generate PDF Proofer PDFs
require_once('./aion_common.php');
AION_ECHO("HYPHEN STUDY: BEGIN");
if (!chdir("../www-stageresources")) { AION_ECHO("ERROR! chdir()"); }

$BIBLES = array(
//"../www-stageresources/Holy-Bible---Coptic---Coptic-Boharic-NT---Aionian-Edition.noia",	// 41
//"../www-stageresources/Holy-Bible---Coptic---Coptic-NT---Aionian-Edition.noia",			// 2
//"../www-stageresources/Holy-Bible---Coptic---Sahidic-Bible---Aionian-Edition.noia",
//"../www-stageresources/Holy-Bible---Coptic---Sahidic-Coptic-Horner---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Myanmar---Burmese-Common-Bible---Aionian-Edition.noia",
//"../www-stageresources/Holy-Bible---Sanskrit---Burmese-Script---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Sanskrit---Cologne-Script---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Sanskrit---Harvard-Kyoto-Script---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Sanskrit---IAST-Script---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Sanskrit---ISO-Script---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Sanskrit---ITRANS-Script---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Sanskrit---Tamil-Script---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Sanskrit---Velthuis-Script---Aionian-Edition.noia",
);

//https://www.regular-expressions.info/unicode.html
// \p{L}\p{M}\p{Z}\p{S}\p{N}\p{P}\p{C}

$grand = 0;
foreach($BIBLES as $bible) {
	AION_ECHO("HYPHEN BIBLE: $bible");
	$database = array();
	AION_FILE_DATA_GET( $bible, 'T_BIBLE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	$total = 0;
	$burmese = (preg_match("/Burmese/ui", $bible) ? TRUE : FALSE);
	foreach($database['T_BIBLE'] as $ref => $verse) {
		$before = $verse['TEXT'];
		if (($burmese && !($verse['TEXT'] = preg_replace("/([\p{L}\p{M}\p{S}\p{N}\p{C}]{40,50})(\p{L}[\p{L}\p{M}\p{S}\p{N}\p{C}]{40,50})/ui", '$1-$2', $verse['TEXT'], -1, $special))) ||
			(!$burmese && !($verse['TEXT'] = preg_replace("/([\p{L}\p{M}\p{S}\p{N}\p{C}]{25,30})(\p{L}[\p{L}\p{M}\p{S}\p{N}\p{C}]{25,30})/ui", '$1-$2', $verse['TEXT'], -1, $special)))) {
			AION_ECHO("ERROR! preg_replace(hyphen) error: ".preg_last_error() . " ".$verse['BOOK']." ".$verse['CHAPTER']." ".$verse['VERSE']." ".$verse['TEXT']);
		}
		if ($special) {
			AION_ECHO("HYPHEN COUNT: $special\t$ref\t$before\t{$verse['TEXT']}");
			$total += $special;
			$grand += $special;
		}
	}
	AION_ECHO("HYPHEN TOTAL: $bible = $total\n\n\n");
	AION_unset($database); unset($database); $database=NULL;
}
AION_ECHO("HYPHEN GRAND: $grand\n\n\n");
