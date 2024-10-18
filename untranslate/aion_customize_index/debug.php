<?php
/*** GLOSSARY - static content, except for dynamic internal href links ***/
/*
My counts differ from STEPBible TAGS
Aion	STEP=129 by including MAT6:13 and 2PE2:17, but I maintain 127
Hades	STEP=10 because 1CO15:55 is a variant, but I manually add it to match 11
*/
global $_Path;

// SANSKRIT BURMESE
if ("Debug/Sanskrit-Burmese"==$_Path) {
	// Initialize
	$number = 1;
	echo "<h2 class='center'>Debug Sanskrit Burmese</h2>";
	if (!($contents=file_get_contents(($file='../www-stageresources/Holy-Bible---Sanskrit---Burmese-Script---Aionian-Edition.noia')))) {
		echo "<p>Error: file_get_contents($file)</p>"; return;
	}
	echo "<h3>Initialize</h3>";
	echo "<p>";
	echo "Analyzing: $file<br>"; 
	
	// regex medials
	// 	\x{1039}[^\s\x{1039}]{1,1}\x{1039}[^\s\x{1039}]{1,1}\x{1039}[^\s\x{1039}]{1,1}\x{1039}[^\s\x{1039}]{1,1}
	// medial / character
	$m = "[^\s\x{1039}]{1,1}";
	// medial glue
	$g = "\x{1039}";
	// sequence bookend
	$e = "[^\x{1039}]{1,1}";
	echo "Note: This page must be viewed from a Windows 10/11 machine to see the Myanmar Text, mmrtext.ttf rendering<br>";
	echo "Strategy: Find unique medial sequences, a medial defined as a character preceeded by \x{1039}<br>";
	echo "Disclaimer: Medial sequences found may not cover all possibilities or be the complete sequence<br>";
	echo "Fonts: Sequence are tested with Paduak, Google, and Microsoft fonts for testing purposes only<br>";
	echo "Medial or Character: $m<br>";
	echo "Preceeds medial: $g<br>";	
	echo "Bookends sequence: $e<br>";
	echo "</p>";

	// unique medials found
	echo "<h3>Unique Medials Found</h3>";
	echo "<p>";
	$regex = "/$g($m)/u";
	if (preg_match_all($regex, $contents, $matches)===FALSE || empty($matches[1])) {
		echo "Error: preg_match_all($regex)<br></p>";
	}
	else {
		$flipped = array_flip(array_flip($matches[1]));
		foreach($flipped as $medial) {
			echo $number++.") ".($decimal=mb_ord($medial, "UTF-8"))." / 0x".dechex($decimal)." / Paduak( <span class='font-myanmar'>$medial</span> )  NotoGoogle( <span class='font-myanmar-google'>$medial</span> )  Microsoft( <span class='font-myanmar-microsoft'>$medial</span> )<br>";
		}
	}
	echo "</p>";

	// loop through sequences only, string only
	$lookfer = array(
		"Three Medials in Sequence"	=> "/$e($m$g$m$g$m$g$m)$e/u",
		"Two Medials in Sequence"	=> "/$e($m$g$m$g$m)$e/u",
	);
	echo "<h3>All Unique Sequences with 2 and 3 Medials in Microsoft Font / Paduak</h3>";
	echo "<p>";
	foreach($lookfer as $title => $regex) {
		$matches = array();
		if (($total=preg_match_all($regex, $contents, $matches))===FALSE) {
			echo "Error: preg_match_all($regex)<br></p>";
			continue;
		}
		$flipped = array_flip(array_flip($matches[1]));
		foreach($flipped as $key => $sequence) {
			echo $number++.") <span class='font-myanmar-microsoft'>$sequence</span>&nbsp;&nbsp; / &nbsp;&nbsp;<span class='font-myanmar'>$sequence</span><br>";
		}
	}
	echo "</p>";

	// loop through sequences, context only
	$lookfer = array(
		"Three Medials in Sequence"	=> "/$e($m$g$m$g$m$g$m)$e/u",
		"Two Medials in Sequence"	=> "/$e($m$g$m$g$m)$e/u",
	);
	echo "<h3>All Unique Sequences in a Sample Context with 2 and 3 Medials in Microsoft Font / Paduak</h3>";
	echo "<p>";
	foreach($lookfer as $title => $regex) {
		$matches = array();
		if (($total=preg_match_all($regex, $contents, $matches))===FALSE) {
			echo "Error: preg_match_all($regex)<br></p>";
			continue;
		}
		$flipped = array_flip(array_flip($matches[1]));
		foreach($flipped as $key => $sequence) {
			echo $number++.") <span class='font-myanmar-microsoft'>{$matches[0][$key]}</span>&nbsp;&nbsp; / &nbsp;&nbsp;<span class='font-myanmar'>{$matches[0][$key]}</span><br>";
		}
	}
	echo "</p>";
	
	// loop through sequences with detail
	$lookfer = array(
		"Four Medials in Sequence"	=> "/$e($m$g$m$g$m$g$m$g$m)$e/u",
		"Three Medials in Sequence"	=> "/$e($m$g$m$g$m$g$m)$e/u",
		"Two Medials in Sequence"	=> "/$e($m$g$m$g$m)$e/u",
		"One Medial in Sequence"	=> "/$e($m$g$m)$e/u",
	);
	foreach($lookfer as $title => $regex) {
		echo "<h3>$title</h3>";
		echo "<p>";
		$matches = array();
		echo "Regex: $regex<br>"; 
		if (($total=preg_match_all($regex, $contents, $matches))===FALSE) {
			echo "Error: preg_match_all($regex)<br></p>";
			continue;
		}
		$flipped = array_flip(array_flip($matches[1]));
		$unique = count($flipped);
		echo "Result: total sequences = $total, unique sequences = $unique</p>"; 	
		foreach($flipped as $key => $sequence) {
			echo "<b>Context:</b>  Paduak( <span class='font-myanmar'>{$matches[0][$key]}</span> )  NotoGoogle( <span class='font-myanmar-google'>{$matches[0][$key]}</span> )  Microsoft( <span class='font-myanmar-microsoft'>{$matches[0][$key]}</span> )<br>";
			echo "Sequence:  Paduak( <span class='font-myanmar'>$sequence</span> )  NotoGoogle( <span class='font-myanmar-google'>$sequence</span> )  Microsoft( <span class='font-myanmar-microsoft'>$sequence</span> )<br>";
			foreach (mb_str_split($sequence) as $char) {
				echo $number++.") <span class='font-myanmar-microsoft'>$char</span>: ".($decimal=mb_ord($char, "UTF-8"))." / 0x".dechex($decimal)."<br>";
			}
			echo "<br>";
		}
		echo "</p>";
	}
}

// DEBUG NOT FOUND
else {
	echo "<h2 class='center'>Debug Not Found</h2>";
}