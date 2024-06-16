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

$grand = 0;
$seg = "(\p{L}[\p{L}\p{M}]{7,16})";
foreach($BIBLES as $bible) {
	AION_ECHO("HYPHEN BIBLE: $bible");
	$database = array();
	AION_FILE_DATA_GET( $bible, 'T_BIBLE', $database, array('INDEX','BOOK','CHAPTER','VERSE'), FALSE );
	$hyphen_total = array(0,0,0,0,0,0,0,0,0);
	foreach($database['T_BIBLE'] as $ref => $verse) {
		$hyphen_count = array(0,0,0,0,0,0,0,0,0);
		if (!($verse['TEXT'] = preg_replace("/$seg$seg$seg$seg$seg$seg$seg$seg$seg$seg/ui",	'$1-$2-$3-$4-$5-$6-$7-$8-$9-$10',	$verse['TEXT'], -1, $hyphen_count[0])) || // 7*10+10=80, 16*10+10=170
			!($verse['TEXT'] = preg_replace("/$seg$seg$seg$seg$seg$seg$seg$seg$seg/ui",		'$1-$2-$3-$4-$5-$6-$7-$8-$9',		$verse['TEXT'], -1, $hyphen_count[1])) || // 7*9+9=72,   16*9+9=153
			!($verse['TEXT'] = preg_replace("/$seg$seg$seg$seg$seg$seg$seg$seg/ui",			'$1-$2-$3-$4-$5-$6-$7-$8',			$verse['TEXT'], -1, $hyphen_count[2])) || // 7*8+8=64,   16*8+8=136
			!($verse['TEXT'] = preg_replace("/$seg$seg$seg$seg$seg$seg$seg/ui",				'$1-$2-$3-$4-$5-$6-$7',				$verse['TEXT'], -1, $hyphen_count[3])) || // 7*7+7=56,   16*7+7=119
			!($verse['TEXT'] = preg_replace("/$seg$seg$seg$seg$seg$seg/ui",					'$1-$2-$3-$4-$5-$6',				$verse['TEXT'], -1, $hyphen_count[4])) || // 7*6+6=49,   16*6+6=102
			!($verse['TEXT'] = preg_replace("/$seg$seg$seg$seg$seg/ui",						'$1-$2-$3-$4-$5',					$verse['TEXT'], -1, $hyphen_count[5])) || // 7*5+5=42,   16*5+5=85
			!($verse['TEXT'] = preg_replace("/$seg$seg$seg$seg/ui",							'$1-$2-$3-$4',						$verse['TEXT'], -1, $hyphen_count[6])) || // 7*4+4=35,   16*4+4=68
			!($verse['TEXT'] = preg_replace("/$seg$seg$seg/ui",								'$1-$2-$3',							$verse['TEXT'], -1, $hyphen_count[7])) || // 7*3+3=24,   16*3+3=51
			!($verse['TEXT'] = preg_replace("/$seg$seg/ui",									'$1-$2',							$verse['TEXT'], -1, $hyphen_count[8])) || // 7*2+2=16,   16*2+2=34
			FALSE
			) {
			AION_ECHO("ERROR! preg_replace(hyphen) error: ".preg_last_error() . " ".$verse['BOOK']." ".$verse['CHAPTER']." ".$verse['VERSE']." ".$verse['TEXT']);
		}
		if (preg_match('/([\p{L}\p{M}]{19})/ui', $verse['TEXT'])) {
			AION_ECHO("ERROR! preg_match(19) missed: ".$verse['BOOK']." ".$verse['CHAPTER']." ".$verse['VERSE']." ".$verse['TEXT']);
		}
		$yes = $counts = $total = NULL;
		foreach($hyphen_count as $dex => $num) {
			$num = (int)$num;
			if ($num) { $yes = TRUE; $hyphen_total[$dex] += $num; $total += $num; }
			$counts .= " / $num";
		}
		if ($yes) {
			AION_ECHO("HYPHENATED $counts : $total: ".$verse['BOOK']." ".$verse['CHAPTER']." ".$verse['VERSE']." ".$verse['TEXT']);
		}
	}
	$counts = $total = NULL;
	foreach($hyphen_total as $dex => $num) { $num = (int)$num; $total += $num; $grand += $num; $counts .= " / $num"; }
	AION_ECHO("TOTAL HYPHEN: $bible $counts : $total\n\n\n");
	AION_unset($database); unset($database); $database=NULL;
}
AION_ECHO("TOTAL HYPHEN: GRAND $grand\n\n\n");

AION_ECHO("HYPHEN STUDY: END");
