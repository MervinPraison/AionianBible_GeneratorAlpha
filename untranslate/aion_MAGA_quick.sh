#!/usr/local/bin/php
<?php

/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));


// _3q_
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
system("yes | cp ../checks/UNTRANSLATEREVERSE.txt		./aion_database");
system("yes | cp ../checks/SKIPPED.txt					./aion_database");
system("yes | cp ../checks/TALLY.txt					./aion_database");


// _6q_
AION_LOOP_CHECK_UNTRANSLATE_MODULE(	'../www-stageresources',	'../checks/UNTRANSLATEMODULE.txt',	'../checks/UNTRANSLATECOUNT.txt' );
system("yes | cp ../checks/UNTRANSLATEMODULE.txt		./aion_database");
system("yes | cp ../checks/UNTRANSLATEMODULE.txt.sort	./aion_database");


// _3_
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

$database = array();
AION_FILE_DATA_GET(			'./aion_database/VERSIONS.txt',	'T_VERSIONS',	$database, 'BIBLE', TRUE );
AION_FILE_DATA_GET(			'./aion_database/BOOKS.txt',	'T_BOOKS',		$database, 'BIBLE', TRUE );
AION_FILE_DATA_GET(			'./aion_database/NUMBERS.txt',	'T_NUMBERS',	$database, 'BIBLE', TRUE );
AION_FILE_DATABASE_BOOKS(	$database );
AION_FILE_DATABASE_PUT(		$database, '../www-stageresources', '../www-stage/library', 'stageresources.AionianBible.org', TRUE);
AION_SITEMAP(				'../www-stage');
system("yes | cp ../checks/UNICODE_USAGE.txt			./aion_database");

AION_ECHO("DONE MAGA QUICK!");
exit;

// SPEEDATA 
require_once('./aion_speedata.php');
AION_LOOP_PDF_POD(	'/home/inmoti55/public_html/domain.aionianbible.org/www-stageresources',
					'/home/inmoti55/public_html/domain.aionianbible.org/www-stageresources'
				);

AION_ECHO("DONE MAGA QUICK!");