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
						TRUE);
						
AION_LOOP_AION		(	'../www-stageresources',	'../www-stageresources',	'../www-stage/library');
AION_LOOP_NOIA		(	'../www-stageresources',	'../www-stage/library');

require_once('./aion_3e_epub.php'); // Aionian Bible epub
AION_LOOP_EPUB_UZIP	(	'../www-stageresources',	'../www-stage/library');

require_once('./aion_3p_pwa.php'); // Aionian Bible PWA
AION_LOOP_DIFF('../www-stage/library/pwa', '../www-production-files/library/pwa', '../diff-www-stagepwa-with-pwa-BEFORE-DEPLOY');

$database = array();
AION_FILE_DATA_GET(			'./aion_database/VERSIONS.txt',	'T_VERSIONS',	$database, 'BIBLE', TRUE );
AION_FILE_DATA_GET(			'./aion_database/BOOKS.txt',	'T_BOOKS',		$database, 'BIBLE', TRUE );
AION_FILE_DATA_GET(			'./aion_database/NUMBERS.txt',	'T_NUMBERS',	$database, 'BIBLE', TRUE );
AION_FILE_DATABASE_BOOKS(	$database );
AION_FILE_DATABASE_PUT(		$database, '../www-stageresources', '../www-stage/library', 'stageresources.AionianBible.org', TRUE);
AION_SITEMAP(				'../www-stage');

AION_LOOP_DIFF		(	'../www-stage/library', 	'../www-production/library',	'../diff-www-stage-with-www-production-BEFORE-DEPLOY', '/\.php$/', '', 'stageresources','resources');
AION_LOOP_DIFF		(	'../www-stageresources', 	'../www-resources',				'../diff-www-stageresources-with-www-resources-BEFORE-DEPLOY', '',
						'/(Aionian-Edition\.noia|Standard-Edition\.noia|Aionian-Edition\.epub|Source-Edition\.epub)$/');
AION_LOOP_DIFF		(	'../raw-fixed', 			'../raw-original',				'../raw-diff');
AION_LOOP_DIFF		(	'../raw-diff', 				'../raw-diff-MARKER',			'../raw-diff-diff');

/*** remove Turkish ***/
system('rm -rf ../www-resources/Holy-Bible---Turkish---Turkish-Bible---*' );
system('chmod 640 ../www-stageresources/Holy-Bible---Turkish---Turkish-Bible---*' );

/*** done ***/
AION_ECHO("REMINDER! COPY TO DATABASE: ../checks/UNTRANSLATEREVERSE.txt");
AION_ECHO("REMINDER! COPY TO DATABASE: ../checks/SKIPPED.txt");
AION_ECHO("REMINDER! COPY TO DATABASE: ../checks/TALLY.txt");
AION_ECHO("REMINDER! COPY TO DATABASE: ../checks/UNICODE_USAGE.txt (with Linux cp and not ftp or Windows!)");
AION_ECHO("DONE!");