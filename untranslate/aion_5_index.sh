#!/usr/local/bin/php
<?php



/*** init ***/
require_once('./aion_common.php');
AION_ECHO("START " . basename(__FILE__, '.php'));

/*** install custom files ***/
AION_LOOP_HTMS('../www-stageresources', '../www-stage/library', '../www-production/library');

/*** install index ***/
AION_INSTALL_INDEX('../www-stage');

/*** database ***/
$database = array();
AION_FILE_DATA_GET(			'./aion_database/FORPRINT.txt',	'T_FORPRINT',	$database, 'BIBLE', TRUE );
AION_FILE_DATA_GET(			'./aion_database/VERSIONS.txt',	'T_VERSIONS',	$database, 'BIBLE', TRUE );
AION_FILE_DATA_GET(			'./aion_database/BOOKS.txt',	'T_BOOKS',		$database, 'BIBLE', TRUE );
AION_FILE_DATA_GET(			'./aion_database/NUMBERS.txt',	'T_NUMBERS',	$database, 'BIBLE', TRUE );
AION_FILE_DATABASE_BOOKS(	$database );
AION_FILE_DATABASE_PUT(		$database, '../www-stageresources', '../www-stage/library', TRUE);

/*** speller ***/
AION_LOOP_SPELL('aion_X_spell.sh', '../spellcheck');

/*** sitemap ***/
//AION_SITEMAP(				'../www-stage');

/*** done ***/
AION_ECHO("DONE!");
