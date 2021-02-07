#!/usr/local/bin/php
<?php

/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));

AION_LOOP_CONV		(	'../source-production',
						'../www-stageresources',
						'../raw-original',
						'../raw-fixed',
						'../checks/UNTRANSLATEREVERSE.txt',
						'../checks/SKIPPED.txt',
						'../checks/TALLY.txt',
						'../checks/UNICODE_USAGE.txt',
						'../checks/TEXTREPAIR.txt',
						'../checks/RAWCHECK.txt',
						FALSE);

AION_LOOP_AION		(	'../www-stageresources',		'../www-stageresources',	'../www-stage/library');


/*** done ***/
AION_ECHO("REMINDER! COPY TO DATABASE: ../checks/UNTRANSLATEREVERSE.txt");
AION_ECHO("REMINDER! COPY TO DATABASE: ../checks/SKIPPED.txt");
AION_ECHO("REMINDER! COPY TO DATABASE: ../checks/TALLY.txt");
AION_ECHO("REMINDER! COPY TO DATABASE: ../checks/UNICODE_USAGE.txt (with Linux cp and not ftp or Windows!)");
AION_ECHO("DONE!");