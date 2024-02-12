#!/usr/local/bin/php
<?php

if (!($file_handle = fopen('aion_8_speedata.sh.aionian.out', 'r'))) { exit("error opening file"); }
//if (!($file_handle = fopen('aion_MAGA_quick.out', 'r'))) { exit("error opening file"); }

$bible = NULL;
while(FALSE!==($line=fgets($file_handle))) {

	if (preg_match("#^\*\*\* AION: SPEEDATA BUILDING: ([^\s]+).+$#us", $line, $match)) {
		$bible = $match[1];
	}
	else if (NULL===$bible) {
		continue;
	}
	else if (preg_match("#^.+Glyph (.+)$#us", $line, $match)) {
		$glyph = $match[1];
		echo "{$bible}\t{$glyph}";
	}
}

fclose($file_handle);

