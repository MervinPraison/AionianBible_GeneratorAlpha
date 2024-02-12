#!/usr/local/bin/php
<?php
ini_set("memory_limit", "1024M");
require_once('./aion_common_encoding.php');
use \ForceUTF8\Encoding;
mb_regex_encoding("UTF-8");
mb_internal_encoding("UTF-8");

if ( ($contents = file_get_contents( "../STEPBible-Data-master/PROBLEM.txt" )) === FALSE ) { exit("file_get_contents()=error\n"); }
$fixed = Encoding::fixUTF8($contents);

// simple length comparison
echo "strlen(orig/fixed) = ".strlen($contents)." / ".strlen($fixed)."\n";
echo "mb_strlen(orig/fixed) = ".mb_strlen($contents)." / ".mb_strlen($fixed)."\n";
if (($mb_fixed = preg_split('//u', $fixed, -1, PREG_SPLIT_NO_EMPTY))===FALSE) { exit("preg_split()=error\n"); }
echo "mb_split(orig/fixed) = NA / ".count($mb_fixed)."\n";
echo "mb_detect_encoding(whole orig/fixed) = ".(mb_detect_encoding($contents, "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding($fixed, "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(100 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,0,100), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,0,100), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(1000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,0,1000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,0,1000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(10000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,0,10000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,0,10000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(100000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,0,100000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,0,100000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(1000000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,0,1000000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,0,1000000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(2000000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,0,2000000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,0,2000000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(2100000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,2000000,2100000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,2000000,2100000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(2200000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,2100000,2200000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,2100000,2200000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(2300000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,2200000,2300000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,2200000,2300000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(2400000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,2300000,2400000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,2300000,2400000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(2500000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,2400000,2500000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,2400000,2500000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(2600000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,2500000,2600000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,2500000,2600000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(2700000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,2600000,2700000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,2600000,2700000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(2800000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,2700000,2800000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,2700000,2800000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(2900000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,2800000,2900000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,2800000,2900000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(3000000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,2900000,3000000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,2900000,3000000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(4000000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,3000000,4000000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,3000000,4000000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(5000000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,4000000,5000000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,4000000,5000000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(6000000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,5000000,6000000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,5000000,6000000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(7000000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,6000000,7000000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,6000000,7000000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
echo "mb_detect_encoding(8000000 orig/fixed) = ".(mb_detect_encoding(mb_substr($contents,7000000,8000000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")." / ".(mb_detect_encoding(mb_substr($fixed,7000000,8000000), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";

echo "\nPROBLEM SEARCH 1:\n";
for($x=2000000;  $x <= 2300000; $x+=100) {
	if (mb_detect_encoding(mb_substr($contents,$x,100), "UTF-8", TRUE)===FALSE) {
		echo "counter: $x\n";
		continue;
		
		echo "mb_detect_encoding($x orig) = BAD\n";
		echo "mb_detect_encoding(-300 orig) = ".(mb_detect_encoding(mb_substr($contents,$x-300,300), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
		echo "mb_detect_encoding(+300 orig) = ".(mb_detect_encoding(mb_substr($contents,$x+1,300), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
		echo "\n\n".mb_substr($contents,$x-300,300)." ||| ".mb_substr($contents,$x,1)." ||| ".mb_substr($contents,$x+1,300)."\n\n\n\n\n\n\n";
		if (1 || (($x)%1000)==0) { echo "counter: $x\n"; }
	}
}

exit;

echo "\nPROBLEM SEARCH 2:\n\n";
for($x=2000000;  $x < 2300000; ++$x) {
	if (mb_detect_encoding(mb_substr($contents,$x,1), "UTF-8", TRUE)===FALSE) {
		echo "mb_detect_encoding($x orig) = BAD\n";
		echo "mb_detect_encoding(-300 orig) = ".(mb_detect_encoding(mb_substr($contents,$x-300,300), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
		echo "mb_detect_encoding(+300 orig) = ".(mb_detect_encoding(mb_substr($contents,$x+1,300), "UTF-8", TRUE)!==FALSE?"OK":"BAD")."\n";
		echo "\n\n".mb_substr($contents,$x-300,300)." ||| ".mb_substr($contents,$x,1)." ||| ".mb_substr($contents,$x+1,300)."\n\n\n\n\n\n\n";
		if (1 || (($x)%1000)==0) { echo "counter: $x\n"; }
	}
}

exit;

for($x=2000000;  $x < 2300000; $x+=100) {
	if (mb_detect_encoding(mb_substr($contents,$x,100), "UTF-8", TRUE)===FALSE) {
		if (preg_match("#.+\n([^.]{3}\.[\d]+\.[\d]+.+)#u",mb_substr($contents,$x-300,300),$match)) {
			echo "{$match[1]}\n";
		}
		else {
			echo "Unknown reference: $x\n";
		}
	}
}

exit;

$num = 1;
foreach ($mb_contents as $v) {
	if ( mb_detect_encoding($v, "UTF-8", TRUE) === FALSE ) {
		echo "\n\nnum: $num\n\n";
		echo "\n\n'{$v}'\n\n";
		exit("\n\nmb_detect_encoding()=error\n\n");
	}
	++$num;
}


$num = 1;
for($x=0;  $x < $mb_length; ++$x) {
	if ( mb_detect_encoding($contents[$x], "UTF-8", TRUE) === FALSE ) {
		echo "\n\nnum: $num\n\n";
		echo "\n\n'{$contents[$x]}'\n\n";
		exit("\n\nmb_detect_encoding()=error\n\n");
	}
	++$num;
}

$lines = mb_split("\n", $contents);
$num = 1;
foreach( $lines as $data ) {
	if ( mb_detect_encoding($data, "UTF-8", TRUE) === FALSE ) {
		echo "\n\nnum: $num\n\n";
		echo "\n\n'$data'\n\n";
		exit("\n\nmb_detect_encoding()=error\n\n");
	}
	++$num;
}