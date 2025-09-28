<?php

/*** init ***/
use \ForceUTF8\Encoding;

$punct_arrays = array(
	'(',')','{','}','[',']','<','>','«','»',
	"'",'"','‘','’','“','”','„',
	':',';',',','.','?','!',
	'~','`','-','=','/','…',
	'|','+','\\','@','#','$','%','^','&','*','_',
	);
$punct_string = '';
foreach($punct_arrays as $value) { $punct_string .= "(\\$value)|";	}
$punct_output = "BIBLE	".implode("	", $punct_arrays)."	[:punct:]\n";

AION_LOOP_ANALYSIS(	'/home/inmoti55/public_html/domain.aionianbible.org/www-stageresources');

if (!file_put_contents('/home/inmoti55/public_html/domain.aionianbible.org/checks/PUNCTUATION.txt', $punct_output)) { AION_ECHO("ERROR! Punctuation INIT file_put_contents(PUNCTUATION.txt)"); }

AION_CHECK_DIFF_TWO_FILES('./aion_database/PUNCTUATION.txt', '../checks/PUNCTUATION.txt', '../checks/ADIFF.PUNCTUATION.txt');

AION_ECHO("DONE!");
return;

/*** aion rtfs make loop ***/
function AION_LOOP_ANALYSIS($source) {
	$database = array();
	$punctuation = "";
	AION_LOOP( array(
		'function'		=> 'AION_LOOP_ANALYSIS_DOIT',
		'source'		=> $source,
		'destiny'		=> $source,
		'include'		=> "/---Source-Edition\.[^.]+\.txt$/",
		//'include'		=> "/Holy-Bible---A.+---Source-Edition\.[^.]+\.txt$/",
		//'include'		=> "/---American-Standard.+---Source-Edition\.[^.]+\.txt$/",
		//'include'		=> "/Holy-Bible---English---Webster-Bible-Revised---Source-Edition\.[^.]+\.txt$/",		
		//'include'		=> "/Holy-Bible---.+Amalgamant---Source-Edition\.[^.]+\.txt$/",
		'database'		=> $database,
		) );
	AION_ECHO("DONE DID IT!");
}
function AION_LOOP_ANALYSIS_DOIT($args) {
	global $punct_arrays, $punct_string, $punct_output;

	// BIBLE?
	if (!preg_match("/^Holy-Bible---(.*)---Source-Edition\.[^.]+\.txt$/us", $args['filename'], $matches)) {	AION_ECHO("ERROR! Punctuation INIT Failed to preg_match(Holy-Bible): ".$args['filepath']); }
	$bible = "Holy-Bible---$matches[1]";
	$file_aionian  = $args['source']."/$bible---Aionian-Edition.noia";

	// GET BIBLE, REMOVE COMMENTS AND EMPTY LINES
	if (!($data_aionian = file_get_contents($file_aionian))) {												AION_ECHO("ERROR! Punctuation INIT file_get_contents($file_aionian)"); }
	$data_aionian = Encoding::toUTF8($data_aionian);
	if(!($data_aionian=preg_replace('/^\h*\v+/um', '', $data_aionian))) {									AION_ECHO("ERROR! Punctuation INIT preg_replace(delete blanks) $file_aionian"); }
	if(!($data_aionian=preg_replace('/^(#[^\v]*|INDEX\t[^\v]*)\v+/um', '', $data_aionian))) {				AION_ECHO("ERROR! Punctuation INIT preg_replace(delete comments) $file_aionian"); }

	// GET PUNCTUATION
	if (FALSE===preg_match_all("#({$punct_string}([[:punct:]]))#us", $data_aionian, $matches, PREG_PATTERN_ORDER)) { AION_ECHO("ERROR! Punctuation ENCLOSURES preg_match_all() $bible"); }
	unset($matches[0]);
	unset($matches[1]);
	foreach($matches as $k1 => $v1) { foreach($matches[$k1] as $k2 => $v2) { if (empty($v2)) { unset($matches[$k1][$k2]); } } }
	$result = array();
	foreach($punct_arrays as $k => $v) { $result[$v] = count($matches[$k+2]); }
	$result['[:punct:]'] = implode(" ",array_flip(array_flip($matches[$k+3])));
	$punct_output .= ("{$bible}	" . implode("	", $result) . "\n");

	AION_ECHO("PUNCTUATION SUCCESS: $bible");
}

