#!/usr/local/bin/php
<?php
// Generate PDF Proofer PDFs
require_once('./aion_common.php');
AION_ECHO("HYPHEN STUDY: BEGIN");
if (!chdir("../www-stageresources")) { AION_ECHO("ERROR! chdir()"); }


$BIBLES = array(
"../www-stageresources/Holy-Bible---Coptic---Coptic-Boharic-NT---Aionian-Edition.noia",	// 41
"../www-stageresources/Holy-Bible---Coptic---Coptic-NT---Aionian-Edition.noia",			// 2
"../www-stageresources/Holy-Bible---Coptic---Sahidic-Bible---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Coptic---Sahidic-Coptic-Horner---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Myanmar---Burmese-Common-Bible---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Sanskrit---Burmese-Script---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Sanskrit---Cologne-Script---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Sanskrit---Harvard-Kyoto-Script---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Sanskrit---IAST-Script---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Sanskrit---ISO-Script---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Sanskrit---ITRANS-Script---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Sanskrit---Tamil-Script---Aionian-Edition.noia",
"../www-stageresources/Holy-Bible---Sanskrit---Velthuis-Script---Aionian-Edition.noia",
);

foreach($BIBLES as $bible) {
	$database = array();
	AION_FILE_DATA_GET( $bible, 'T_BIBLE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	$replacements = $replacements1 = $replacements2 = $replacements3 = $replacements4 = $replacements5 = 0;
	foreach($database['T_BIBLE'] as $ref => $verse) {
		if (!($verse['TEXT'] = preg_replace('/(\p{L}[\p{L}\p{M}]{8,10})(\p{L}[\p{L}\p{M}]{8,10})(\p{L}[\p{L}\p{M}]{8,10})(\p{L}[\p{L}\p{M}]{8,10})(\p{L}[\p{L}\p{M}]{8,10})(\p{L}[\p{L}\p{M}]{8,10})/ui', '$1-$2-$3-$4-$5-$6', $verse['TEXT'], -1, $hyphen_count5)) ||
			!($verse['TEXT'] = preg_replace('/(\p{L}[\p{L}\p{M}]{8,10})(\p{L}[\p{L}\p{M}]{8,10})(\p{L}[\p{L}\p{M}]{8,10})(\p{L}[\p{L}\p{M}]{8,10})(\p{L}[\p{L}\p{M}]{8,10})/ui', '$1-$2-$3-$4-$5', $verse['TEXT'], -1, $hyphen_count4)) ||
			!($verse['TEXT'] = preg_replace('/(\p{L}[\p{L}\p{M}]{8,10})(\p{L}[\p{L}\p{M}]{8,10})(\p{L}[\p{L}\p{M}]{8,10})(\p{L}[\p{L}\p{M}]{8,10})/ui', '$1-$2-$3-$4', $verse['TEXT'], -1, $hyphen_count3)) ||
			!($verse['TEXT'] = preg_replace('/(\p{L}[\p{L}\p{M}]{8,10})(\p{L}[\p{L}\p{M}]{8,10})(\p{L}[\p{L}\p{M}]{8,10})/ui', '$1-$2-$3', $verse['TEXT'], -1, $hyphen_count2)) ||
			!($verse['TEXT'] = preg_replace('/(\p{L}[\p{L}\p{M}]{8,10})(\p{L}[\p{L}\p{M}]{8,10})/ui', '$1-$2', $verse['TEXT'], -1, $hyphen_count1))) {
			AION_ECHO("ERROR! preg_replace(hyphen) error: ".preg_last_error() . " ".$verse['BOOK']." ".$verse['CHAPTER']." ".$verse['VERSE']." ".$verse['TEXT']);
		}
		if (preg_match('/([\p{L}\p{M}]{22})/ui', $verse['TEXT'])) {
			AION_ECHO("ERROR! preg_match(22) missed: ".$verse['BOOK']." ".$verse['CHAPTER']." ".$verse['VERSE']." ".$verse['TEXT']);
		}
		$hyphen_count = $hyphen_count1 + $hyphen_count2 + $hyphen_count3 + $hyphen_count4 + $hyphen_count5;
		if ($hyphen_count>0) {
			$replacements += $hyphen_count;
			$replacements1 += $hyphen_count1;
			$replacements2 += $hyphen_count2;
			$replacements3 += $hyphen_count3;
			$replacements4 += $hyphen_count4;
			$replacements5 += $hyphen_count5;
			AION_ECHO("HYPHENATED $hyphen_count1 + $hyphen_count2 + $hyphen_count3 + $hyphen_count4 + $hyphen_count5 = $hyphen_count: ".$verse['BOOK']." ".$verse['CHAPTER']." ".$verse['VERSE']." ".$verse['TEXT']);
		}
	}
	AION_ECHO("TOTAL HYPHEN: $bible = $replacements1 + $replacements2 + $replacements3 + $replacements4 + $replacements5 = $replacements\n\n\n");
	AION_unset($database); unset($database); $database=NULL;
}

AION_ECHO("HYPHEN STUDY: END");
