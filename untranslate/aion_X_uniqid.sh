#!/usr/local/bin/php
<?php

for($x=0; $x<700; ++$x) {
	//2c3d76cf-bacd-40d3-a370-ea7e4b684bdf
	echo preg_replace("/([[:alnum:]]{8})([[:alnum:]]{4})([[:alnum:]]{4})([[:alnum:]]{4})([[:alnum:]]{12})/", "$1-$2-$3-$4-$5", bin2hex(random_bytes(16)))."\n";
}
