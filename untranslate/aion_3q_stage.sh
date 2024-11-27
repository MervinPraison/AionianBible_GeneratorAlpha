#!/usr/local/bin/php
<?php

/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));

AION_LOOP_CONV		(	'../www-stageresources',
						'../www-stageresources',
						'../raw-original',
						'../raw-fixed',
						'../checks/UNTRANSLATEREVERSE.txt',
						'../checks/SKIPPED.txt',
						'../checks/TALLY.txt',
						'../checks/UNICODE_USAGE.txt',
						'../checks/TEXTREPAIR.txt',
						'../checks/RAWCHECK.txt',
						'../checks/TAGS.txt',
						FALSE);

AION_LOOP_AION		(	'../www-stageresources',		'../www-stageresources',	'../www-stage/library');

/*** remove Turkish ***/
system('rm -rf ../www-resources/Holy-Bible---Turkish---Turkish-Bible---*' );
system('chmod 640 ../www-stageresources/Holy-Bible---Turkish---Turkish-Bible---*' );

/*** done ***/
AION_ECHO("REMINDER! COPY TO DATABASE: ../checks/UNTRANSLATEREVERSE.txt");
AION_ECHO("REMINDER! COPY TO DATABASE: ../checks/SKIPPED.txt");
AION_ECHO("REMINDER! COPY TO DATABASE: ../checks/TALLY.txt");
AION_ECHO("REMINDER! COPY TO DATABASE: ../checks/UNICODE_USAGE.txt (with Linux cp and not ftp or Windows!)");
AION_ECHO("DONE!");